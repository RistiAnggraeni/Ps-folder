<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_siswa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        if ($this->session->userdata('logged_in') && $this->router->method == 'index') {
        redirect(site_url('pages2')); 
    }
    }

    // Halaman Login
    public function index() {

        $this->load->view('login');
    }

    
    public function login() {
        $nis = $this->input->post('nis');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

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

        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Confirm password berbeda dengan password pertama');
            redirect(site_url('auth_siswa'));
        }

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
                if ($user['password_lama'] === $password) {
                    $this->set_user_session($user);
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

    private function set_user_session($user) {
        // Simpan data user ke sesi
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('user_data', $user);
        $this->session->set_userdata('nis', $user['nis']);
        $this->session->set_userdata('level', $user['level']);
        $this->session->set_userdata('username', $user['username']);

        redirect(site_url('pages2/home'));
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('pertama'));
    }
}
