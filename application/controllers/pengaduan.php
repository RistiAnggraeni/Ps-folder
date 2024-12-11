<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Petugas_model');
        $this->load->model('Pengaduan_model');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('nis')) {
            redirect('login');
        }
    }

    public function index()
    {
        redirect('pages2/home');
    }

    public function submit()
    {
       
        $this->load->library('upload');
        $this->load->helper('form');

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 10240;

        $this->upload->initialize($config);

        // Validasi jika file berhasil diunggah
        if (!$this->upload->do_upload('foto')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('pages2/home');
        } else {
            $upload_data = $this->upload->data();

            // Simpan data ke database
            $data = [
                'tgl_pengaduan' => date('Y-m-d'),
                'waktu'         => date('H:i'),
                'nis'           => $this->session->userdata('nis'),
                'isi_laporan'   => $this->input->post('isi_pengaduan'),
                'judul_pengaduan' => $this->input->post('judul'),
                'status'        => 'belum ditanggapi',
                'id_petugas'    => $this->input->post('id_petugas'),
                'gambar'        => $upload_data['file_name'],
                'filter'        => '1',
                'status_nama'   => $this->input->post('status_nama')
            ];

            $this->db->insert('pengaduan', $data);
            $this->session->set_flashdata('success', 'Pengaduan berhasil dikirim.');
            redirect('pages2/home');
        }
    }

    public function hapusaduan($id_pengaduan)
    {
        $this->db->where('id_pengaduan', $id_pengaduan);
        $deleted = $this->db->delete('pengaduan'); 

       
        if ($deleted) {
            // Penghapusan berhasil, set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', 'Aduan berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            // Penghapusan gagal, set flashdata untuk pesan error
            $this->session->set_flashdata('message', 'Gagal menghapus aduan.');
            $this->session->set_flashdata('message_type', 'danger');
        }
       
        redirect('pages2/daftaraduan');
    }
public function updatepengaduan($id_pengaduan)
    {
        
        $data = [
            'judul_pengaduan' => $this->input->post('judul'),
            'isi_laporan' => $this->input->post('isi_laporan'),
            'id_petugas' => $this->input->post('kepada'),
        ];

        if ($_FILES['gambar']['name']) {
            // Menangani upload gambar
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
            } else {
                // Menangani error upload gambar
                $this->session->set_flashdata('error', 'Gagal mengunggah gambar: ' . $this->upload->display_errors('', ''));
                redirect('pages2/daftaraduan');
                return;
            }
        }

        $this->db->where('id_pengaduan', $id_pengaduan);
        $update_status = $this->db->update('pengaduan', $data);

        if ($update_status) {
            $this->session->set_flashdata('success', 'Aduan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Aduan tidak berhasil diperbarui.');
        }

        // Redirect kembali ke halaman daftar aduan
        redirect('pages2/daftaraduan');
    }
}
