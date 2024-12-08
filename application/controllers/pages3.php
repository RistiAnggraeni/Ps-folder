<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages3 extends CI_Controller
{
    public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Pengaduan_model');
    // Jika belum login, redirect ke halaman login
    if (!$this->session->userdata('logged_in')) {
        redirect(site_url('pertama'));
    }
}

    public function view($page = 'home')
    {
        // Pastikan file view untuk halaman ada
        if (!file_exists(APPPATH . 'views/guru/' . $page . '.php')) {
            show_404(); // Halaman tidak ditemukan
        }

        $data['title'] = ucfirst($page); // Set judul halaman
        
        if ($page === 'akunguru') {
        // Ambil data akun berdasarkan sesi pengguna
            if (!$this->session->userdata('logged_in')) {
                redirect('login'); // Arahkan ke login jika belum login
            }

            $user_id = $this->session->userdata('id_petugas');
            $this->load->model('Data_model');
            $data['user'] = $this->Data_model->get_user_by_id($user_id);
        }
        if ($page === 'home') {
        
            $data['pengaduan'] = $this->Pengaduan_model->get_pengaduan_by_petugas();
                
        }
        if ($page === 'chat-guru') {
            // Ambil pengaduan hash dari request
            $pengaduan_hash = $this->input->get('id_pengaduan');

            if (!$pengaduan_hash) {
                show_error('Data tidak valid.', 404, 'Not Found');
            }

            $this->db->select('pengaduan.*, data_siswa.username, data_siswa.nis');
            $this->db->from('pengaduan');
            $this->db->join('data_siswa', 'pengaduan.nis = data_siswa.nis', 'left');
            $this->db->where('md5(pengaduan.id_pengaduan)', $pengaduan_hash);
            $pengaduan = $this->db->get()->row_array();

            if (!$pengaduan) {
                show_error('Pengaduan tidak ditemukan.', 404, 'Not Found');
            }

            if ($pengaduan['status_nama'] == '1') {
                $pengaduan['username'] = substr($pengaduan['username'], 0, 1) . str_repeat('*', strlen($pengaduan['username']) - 1);
            }

            // Ambil tanggapan berdasarkan id_pengaduan
            $this->db->select('*');
            $this->db->from('tanggapan');
            $this->db->where('id_pengaduan', $pengaduan['id_pengaduan']);
            $this->db->order_by('tgl_tanggapan', 'ASC');
            $this->db->order_by('jam_menit', 'ASC');
            $tanggapan = $this->db->get()->result_array();

            $data = [
                'pengaduan' => $pengaduan,
                'tanggapan' => $tanggapan,
            ];

        }


        // Muat konten halaman
        $data['content'] = $this->load->view('guru/' . $page, isset($data) ? $data : [], true);

        // Muat layout utama

        $this->load->view('guru/index', $data);

    }

}
