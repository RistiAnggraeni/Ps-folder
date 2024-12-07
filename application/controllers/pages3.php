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

        // Muat konten halaman
        $data['content'] = $this->load->view('guru/' . $page, isset($data) ? $data : [], true);

        // Muat layout utama

        $this->load->view('guru/index', $data);

    }

}
