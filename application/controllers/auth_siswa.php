<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_siswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model'); // Memuat model autentikasi
        $this->load->library('session');
        if ($this->session->userdata('logged_in') && $this->router->method == 'index') {
        redirect(site_url('pages2')); // Ubah sesuai halaman dashboard Anda
    }
    }

    // Halaman Login
    public function index() {

        // Jika tidak login, tampilkan halaman login
        $this->load->view('login');
    }

    
    public function login() {
        $nis = $this->input->post('nis');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');


        // Validasi input kosong
        if (empty($nis) || empty($username) || empty($password) || empty($confirm_password)) {
            $this->session->set_flashdata('error', 'Semua kolom wajib diisi');
            redirect(site_url('auth_siswa'));
        }

        $siswa = $this->Auth_model->get_siswa_by_nis($nis); 
        if (!$siswa) { 
            $this->session->set_flashdata('error', 'NIS yang anda masukkan tidak terdaftar'); 
            redirect(site_url('auth_siswa')); 
            return; 
        }

        // Validasi password dan confirm password
        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Confirm password berbeda dengan password pertama');
            redirect(site_url('auth_siswa'));
        }

        // Ambil data pengguna dari database
        $user = $this->Auth_model->get_user_siswa($username);

        if ($user) {
            if (!empty($user['password_now'])) {
            
                // Bandingkan password hash dengan nilai di database
                if (password_verify($password, $user['password_now'])) {
                    $this->set_user_session($user); // Fungsi untuk menyimpan data ke sesi
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah');
                    redirect(site_url('auth_siswa'));
                }
            } else {
                // Jika password_now kosong, gunakan password_lama (tanpa hash)
                if ($user['password_lama'] === $password) {
                    $this->set_user_session($user); // Fungsi untuk menyimpan data ke sesi
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah');
                    redirect(site_url('auth_siswa'));
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect(site_url('auth_siswa'));
        }
    }

    // Fungsi untuk menyimpan data pengguna ke sesi dan mengarahkan berdasarkan level
    private function set_user_session($user) {
        // Simpan data user ke sesi
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('user_data', $user);
        $this->session->set_userdata('nis', $user['nis']);
        $this->session->set_userdata('level', $user['level']);
        $this->session->set_userdata('username', $user['username']);

        redirect(site_url('pages2/home'));
        // redirect(site_url('auth_siswa'));
        // if ($user['level'] === 'guru') {
        //     redirect(site_url('guru/index'));
        // } elseif ($user['level'] === 'admin') {
        //     redirect(site_url('pages/home'));
        // } else {
        //     // Redirect default jika level tidak dikenali
        //     redirect(site_url('auth_petugas'));
        // }
    }


    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('pertama'));
    }
}
