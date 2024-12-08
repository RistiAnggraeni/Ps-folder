<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages2 extends CI_Controller
{
    public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Petugas_model');
    $this->load->model('Pengaduan_model');
    // Jika belum login, redirect ke halaman login
    if (!$this->session->userdata('logged_in')) {
        redirect(site_url('pertama'));
    }
}

    public function view($page = 'home')
    {
        // Pastikan file view untuk halaman ada
        if (!file_exists(APPPATH . 'views/siswa/' . $page . '.php')) {
            show_404(); // Halaman tidak ditemukan
        }

        $data['title'] = ucfirst($page); // Set judul halaman
    
        if ($page === 'akun') {
        // Ambil data akun berdasarkan sesi pengguna
            if (!$this->session->userdata('logged_in')) {
                redirect('login'); // Arahkan ke login jika belum login
            }

            $user_nis = $this->session->userdata('nis');
            $this->load->model('Data_model');
            $data['user_nis'] = $this->Data_model->get_user_by_nis($user_nis);
        }
        if ($page === 'home') {
            
            $data['petugas'] = $this->Petugas_model->get_all_petugas();
            $nis = $this->session->userdata('nis');
    
            $this->db->where('nis', $nis);
            $jumlah_aduan = $this->db->count_all_results('pengaduan');
            
            $data['jumlah_aduan'] = $jumlah_aduan;
                    

        }
        if ($page === 'daftaraduan') {
            $nis = $this->session->userdata('nis');

            $data['daftar_aduan'] = $this->Pengaduan_model->get_daftar_aduan($nis);        
        }
        if ($page === 'editpengaduan-siswa') {
            $id_pengaduan = $this->input->get('id_pengaduan');
            $data['aduan'] = $this->Pengaduan_model->get_pengaduan_by_id($id_pengaduan);
            $data['data_petugas'] = $this->Pengaduan_model->get_all_guru(); // Mengambil data semua guru
        }



        // Muat konten halaman
        $data['content'] = $this->load->view('siswa/' . $page, isset($data) ? $data : [], true);

        // Muat layout utama

        $this->load->view('siswa/index', $data);

    }

}
