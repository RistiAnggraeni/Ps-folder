<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
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
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404(); // Halaman tidak ditemukan
        }

        $data['title'] = ucfirst($page); // Set judul halaman

        if ($page === 'home') {
            $this->load->model('Pengaduan_model'); 
            $data['pengaduan'] = $this->Pengaduan_model->get_all_pengaduan();
        
        }
        if ($page === 'datasiswa') {
            $this->load->model('Data_model'); 
            $data['siswa'] = $this->Data_model->get_all_siswa(); 
        }
        if ($page === 'dataguru') {
            $this->load->model('Data_model'); 
            $data['petugas'] = $this->Data_model->get_all_petugas(); 
        }
        if ($page === 'daftarreset') {
            $this->load->model('Data_model'); // Muat model siswa
            $data['dafres'] = $this->Data_model->get_all_daftar(); // Ambil data siswa

        }
        if ($page === 'akunpet') {
        // Ambil data akun berdasarkan sesi pengguna
            if (!$this->session->userdata('logged_in')) {
                redirect('login'); // Arahkan ke login jika belum login
            }

            $user_id = $this->session->userdata('id_petugas');
            $this->load->model('Data_model');
            $data['user'] = $this->Data_model->get_user_by_id($user_id);
        }


        // Muat konten halaman
        $data['content'] = $this->load->view('admin/' . $page, isset($data) ? $data : [], true);

        // Muat layout utama

        $this->load->view('admin/index', $data);

    }

    public function hapus_siswa($nis)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') !== 'admin') {
            show_error('Anda tidak memiliki akses untuk melakukan penghapusan.', 403);
        }

        // Pastikan NIS valid
        if (!is_numeric($nis)) {
            show_error('Invalid NIS', 400);
        }

        // Cek apakah data siswa ada
        $siswa = $this->db->get_where('data_siswa', ['nis' => $nis])->row_array();
        if (!$siswa) {
            show_error('Data siswa tidak ditemukan', 404);
        }

        // Hapus data siswa dari database
        $this->db->delete('data_siswa', ['nis' => $nis]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        $this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
        redirect('pages/datasiswa'); // Ganti 'pages/datasiswa' dengan halaman utama Anda
    }

    public function reset_password($id_petugas)
    {
        // Load model petugas
        $this->load->model('Petugas_model');

        // Ambil data petugas berdasarkan ID
        $petugas = $this->Petugas_model->get_petugas_by_id($id_petugas);

        if ($petugas) {
            // Reset password_now
            $this->Petugas_model->update_password($id_petugas, '');

            // Set flashdata dengan informasi reset berhasil
            $this->session->set_flashdata(
                'success',
                'Reset berhasil dilakukan. Berikut password untuk ' . $petugas['username'] . ': ' . $petugas['password_lama']
            );
        } else {
            $this->session->set_flashdata('error', 'Data petugas tidak ditemukan.');
        }

        // Redirect kembali ke halaman data guru
        redirect('pages/dataguru');
    }

    public function reset_password2($nis)
    {
  
        $this->load->model('Siswa_model');

        $siswa = $this->Siswa_model->get_siswa_by_nis($nis);

        if ($siswa) {
            // Reset password_now
            $this->Siswa_model->update_password($nis, '');

            // Set flashdata dengan informasi reset berhasil
            $this->session->set_flashdata(
                'success',
                'Reset berhasil dilakukan. Berikut password untuk ' . $siswa['username'] . ': ' . $siswa['password_lama']
            );
        } else {
            $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
        }

    
        redirect('pages/datasiswa');
        
    }
    public function reset_password_siswa($nis)
    {
        // Load model yang diperlukan
        $this->load->model('Siswa_model');
        $this->load->model('DaftarReset_model');

        // Ambil data siswa berdasarkan NIS
        $siswa = $this->Siswa_model->get_siswa_by_nis($nis);

        if ($siswa) {
            // Reset password_now di tabel data_siswa
            $this->Siswa_model->update_password($nis, '');

            // Hapus data dari tabel daftar_reset
            $this->DaftarReset_model->delete_by_nis($nis);

            // Set flashdata untuk notifikasi sukses
            $this->session->set_flashdata(
                'success',
                'Reset berhasil dilakukan. Berikut password untuk ' . $siswa['username'] . ': ' . $siswa['password_lama']
            );
        } else {
            // Jika siswa tidak ditemukan
            $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
        }

        // Redirect kembali ke halaman daftar reset
        redirect('pages/daftarreset');
    }


    
    public function hapus_petugas($id_petugas)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') !== 'admin') {
            show_error('Anda tidak memiliki akses untuk melakukan penghapusan.', 403);
        }

        
        if (!is_numeric($id_petugas)) {
            show_error('Invalid id', 400);
        }

        $petugas = $this->db->get_where('data_petugas', ['id_petugas' => $id_petugas])->row_array();
        if (!$petugas) {
            show_error('Data guru tidak ditemukan', 404);
        }

        $this->db->delete('data_petugas', ['id_petugas' => $id_petugas]);

        $this->session->set_flashdata('success', 'Data guru berhasil dihapus.');
        redirect('pages/dataguru');
    }




}
