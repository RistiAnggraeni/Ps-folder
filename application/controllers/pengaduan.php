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
        // Muat library dan helper untuk upload file
        $this->load->library('upload');
        $this->load->helper('form');

        // Konfigurasi untuk unggah file
        $config['upload_path']   = './uploads/'; // Pastikan folder ini ada dan writable
        $config['allowed_types'] = 'jpg|jpeg|png'; // Hanya terima file gambar
        $config['max_size']      = 2048; // Ukuran maksimum file (dalam KB)

        $this->upload->initialize($config);

        // Validasi jika file berhasil diunggah
        if (!$this->upload->do_upload('foto')) { // 'foto' adalah nama input file di form
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('pages2/home'); // Kembali ke halaman form
        } else {
            $upload_data = $this->upload->data(); // Data tentang file yang diunggah

            // Simpan data ke database
            $data = [
                'tgl_pengaduan' => date('Y-m-d'),
                'waktu'         => date('H:i'), // Tambahkan waktu saat pengaduan disubmit
                'nis'           => $this->session->userdata('nis'), // Ambil dari session pengguna
                'isi_laporan'   => $this->input->post('isi_pengaduan'),
                'judul_pengaduan' => $this->input->post('judul'),
                'status'        => 'belum ditanggapi',
                'id_petugas'    => $this->input->post('id_petugas'),
                'gambar'        => $upload_data['file_name'], // Nama file yang diunggah
                'filter'        => '1',
                'status_nama'   => $this->input->post('status_nama') // Filter sensor nama
            ];

            $this->db->insert('pengaduan', $data); // Simpan data ke tabel `pengaduan`
            $this->session->set_flashdata('success', 'Pengaduan berhasil dikirim.');
            redirect('pages2/home'); // Arahkan kembali ke halaman home
        }
    }

    public function hapusaduan($id_pengaduan)
{
    // Hapus aduan berdasarkan ID
    $this->db->where('id_pengaduan', $id_pengaduan);
    $deleted = $this->db->delete('pengaduan');  // Mengambil hasil penghapusan

    // Periksa apakah penghapusan berhasil
    if ($deleted) {
        // Penghapusan berhasil, set flashdata untuk pesan sukses
        $this->session->set_flashdata('message', 'Aduan berhasil dihapus.');
        $this->session->set_flashdata('message_type', 'success');
    } else {
        // Penghapusan gagal, set flashdata untuk pesan error
        $this->session->set_flashdata('message', 'Gagal menghapus aduan.');
        $this->session->set_flashdata('message_type', 'danger');
    }
    
    // Redirect ke halaman daftar aduan setelah penghapusan
    redirect('pages2/daftaraduan');
}
public function updatepengaduan($id_pengaduan)
{
    // Menyiapkan data untuk update
    $data = [
        'judul_pengaduan' => $this->input->post('judul'),
        'isi_laporan' => $this->input->post('isi_laporan'),
        'id_petugas' => $this->input->post('kepada'), // Jika perlu disesuaikan
    ];

    // Jika gambar baru diupload
    if ($_FILES['gambar']['name']) {
        // Menangani upload gambar
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $data['gambar'] = $upload_data['file_name']; // Menyimpan nama file gambar baru
        }
    }

    // Update data pengaduan di database
    $this->db->where('id_pengaduan', $id_pengaduan);
    $this->db->update('pengaduan', $data);

    // Set flashdata untuk pesan sukses
    $this->session->set_flashdata('message', 'Aduan berhasil diperbarui.');

    // Redirect kembali ke halaman daftar aduan
    redirect('pages2/daftaraduan');
}



}