<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_petugas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        if ($this->session->userdata('logged_in') && $this->router->method == 'index') {
        redirect(site_url('pages')); 
    }
    }

    public function index() {

        $this->load->view('loginguru');
    }

    
    public function login() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if (empty($username) || empty($password) || empty($confirm_password)) {
            $this->session->set_flashdata('error', 'Semua kolom wajib diisi');
            redirect(site_url('auth_petugas'));
        }

        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Confirm password berbeda dengan password pertama');
            redirect(site_url('auth_petugas'));
        }

        $user = $this->Auth_model->get_user($username);

        if ($user) {
            if (!empty($user['password_now'])) {

                if (password_verify($password, $user['password_now'])) {
                    $this->set_user_session($user);
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah');
                    redirect(site_url('auth_petugas'));
                }
            } else {

                if ($user['password_lama'] === $password) {
                    $this->set_user_session($user); 
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah');
                    redirect(site_url('auth_petugas'));
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect(site_url('auth_petugas'));
        }
    }

    private function set_user_session($user) {

        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('user_data', $user);
        $this->session->set_userdata('level', $user['level']);
        $this->session->set_userdata('id_petugas', $user['id_petugas']);

        if ($user['level'] === 'guru') {
            redirect(site_url('pages3/home'));
        } elseif ($user['level'] === 'admin') {
            redirect(site_url('pages/home'));
        } else {

            redirect(site_url('auth_petugas'));
        }
    }


    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('pertama'));
    }
}
