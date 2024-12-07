<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        // Periksa apakah user sudah login
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_data')['level'] !== 'guru') {
            redirect(site_url('auth_petugas'));
        }
    }

    // Halaman Guru
    public function index() {
        $this->load->view('guru/index');
    }
    public function update() {
        // Ambil data dari form
        $id_petugas = $this->input->post('id_petugas');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $no_hp = $this->input->post('no_hp');
        $level = $this->input->post('level');



        // Data untuk diupdate
        $data = [
            'username' => $username,
            'nama_guru' => $nama,
            'no_hp' => $no_hp,
            'jabatan' => $jabatan,
        ];

        // Lakukan update
        $this->db->where('id_petugas', $id_petugas);
        if ($this->db->update('data_petugas', $data)) {
            // Jika berhasil
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            // Jika gagal
            $this->session->set_flashdata('error', 'Data tidak berhasil diubah.');
        }

        redirect('pages/dataguru');
    }
}
