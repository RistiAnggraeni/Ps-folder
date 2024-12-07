<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        // Periksa apakah user sudah login
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_data')['level'] !== 'admin') {
            redirect(site_url('auth_petugas'));
        }
    }

    // Halaman Admin
    public function index() {
        $this->load->view('admin/index');
    }
}
