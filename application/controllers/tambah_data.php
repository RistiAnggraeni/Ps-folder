<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah_data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_model'); // Memuat model untuk operasi database
        $this->load->library('form_validation'); // Memuat library validasi
        $this->load->library('session');
    }
// menambah data guru dan petugas
    public function store() {
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('mapel', 'Mapel/Jabatan', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric');
        $this->form_validation->set_rules('level', 'Level', 'required|in_list[Admin,Guru]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirmPassword', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form dengan error message
            // Siapkan pesan error spesifik untuk setiap field
        $errors = [
            'nis' => form_error('nis'),
            'username' => form_error('username'),
            'nama_lengkap' => form_error('nama_lengkap'),
            'kelas' => form_error('kelas'),
            'password' => form_error('password'),
            'confirmPassword' => form_error('confirmPassword'),
        ];
        $this->session->set_flashdata('errors', $errors);
            redirect('pages/tambah-guru');
        } else {
            // Jika validasi berhasil, simpan data ke database
            $data = [
                'username' => $this->input->post('username'),
                'nama_guru' => $this->input->post('nama'),
                'no_hp' => $this->input->post('no_hp'),
                'password_lama' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                'jabatan' => $this->input->post('mapel')
            ];

            if ($this->Data_model->tambah_petugas($data)) {
                // Redirect ke halaman sukses
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('tambah_data/success');
            } else {
                // Jika gagal menyimpan
                $this->session->set_flashdata('error', 'Gagal menambahkan data. Silakan coba lagi.');
                redirect('tambah_data');
            }
        }
    }
    //menambahkan data siswa
    public function store2() {
        // Aturan validasi form dengan pesan kustom
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username harus diisi.'
        ]);
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|numeric|callback_check_nis_unique', [
            'required' => 'NIS harus diisi.',
            'numeric' => 'NIS harus berupa angka.',
            'check_nis_unique' => 'NIS sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama harus diisi.'
        ]);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', [
            'required' => 'Kelas harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'required' => 'Password harus diisi.',
            'min_length' => 'Password harus minimal 6 karakter.'
        ]);
        $this->form_validation->set_rules('confirmPassword', 'Konfirmasi Password', 'required|matches[password]', [
            'required' => 'Konfirmasi Password harus diisi.',
            'matches' => 'Konfirmasi Password tidak cocok dengan Password.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Ambil semua pesan error
            $fields = ['username', 'nis', 'nama', 'kelas', 'password', 'confirmPassword'];
            foreach ($fields as $field) {
                $error_message = form_error($field, '<p class="text-danger">', '</p>');
                if (!empty($error_message)) {
                    $this->session->set_flashdata("error_{$field}", strip_tags($error_message));
                }
            }
            redirect('pages/tambah-siswa'); // Redirect kembali ke form
        } else {
            // Jika validasi berhasil, simpan data ke database
            $data = [
                'username' => $this->input->post('username'),
                'nis' => $this->input->post('nis'),
                'nama_lengkap' => $this->input->post('nama'),
                'password_lama' => $this->input->post('password'),
                'kelas' => $this->input->post('kelas'),
                'status' => '1'
            ];

            if ($this->Data_model->tambah_siswa($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('tambah_data/success2');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data. Silakan coba lagi.');
                redirect('tambah_data');
            }
        }
    }


    public function check_nis_unique($nis) {
        if ($this->Data_model->nis_exists($nis)) {
            $this->form_validation->set_message('check_nis_unique', 'NIS Sudah Terdaftar');
            return FALSE;
        } else {
            return TRUE;
        }
    }

  
    // Fungsi untuk mengubah password
    public function change_password() {
        // Periksa apakah method request adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $password_new = $this->input->post('password_new', true); // Menggunakan XSS filtering
            $confirmPassword_new = $this->input->post('confirmPassword_new', true);

            // Validasi password
            if (strlen($password_new) < 6) {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('pages/akunpet');
                return;
            }

            if ($password_new !== $confirmPassword_new) {
                $this->session->set_flashdata('error', 'Password tidak cocok!');
                redirect('pages/akunpet'); // Redirect ke form ganti password
                return;
            }
            // Hash password
            $hashed_password = password_hash($password_new, PASSWORD_DEFAULT);
            
            // Ambil user_id dari session
            if (!$this->session->userdata['id_petugas']) {
                $this->session->set_flashdata('error', 'Pengguna tidak terautentikasi!');
                redirect('login'); // Redirect ke halaman login
                return;
            }
            $user_id = $this->session->userdata['id_petugas'];

            // Update password melalui model
            $result = $this->Data_model->update_password($user_id, $hashed_password);

            if ($result) {
                $this->session->set_flashdata('success', 'Password berhasil diubah!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah password!');
            }

            redirect('pages/akunpet'); // Redirect ke halaman profil pengguna
        } else {
            // Jika bukan POST, kembalikan ke form
            redirect('pages/akunpet');
        }
    }

    public function change_passwordguru() {
        // Periksa apakah method request adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $password_new = $this->input->post('password_new', true); // Menggunakan XSS filtering
            $confirmPassword_new = $this->input->post('confirmPassword_new', true);

            // Validasi password
            if (strlen($password_new) < 6) {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('pages3/akunguru');
                return;
            }

            if ($password_new !== $confirmPassword_new) {
                $this->session->set_flashdata('error', 'Password tidak cocok!');
                redirect('pages3/akunguru'); // Redirect ke form ganti password
                return;
            }
            // Hash password
            $hashed_password = password_hash($password_new, PASSWORD_DEFAULT);
            
            // Ambil user_id dari session
            if (!$this->session->userdata['id_petugas']) {
                $this->session->set_flashdata('error', 'Pengguna tidak terautentikasi!');
                redirect('login'); // Redirect ke halaman login
                return;
            }
            $user_id = $this->session->userdata['id_petugas'];

            // Update password melalui model
            $result = $this->Data_model->update_password($user_id, $hashed_password);

            if ($result) {
                $this->session->set_flashdata('success', 'Password berhasil diubah!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah password!');
            }

            redirect('pages3/akunguru'); // Redirect ke halaman profil pengguna
        } else {
            // Jika bukan POST, kembalikan ke form
            redirect('pages3/akunguru');
        }
    }

    public function change_password2() {
        // Periksa apakah method request adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $password_new = $this->input->post('password_new', true); // Menggunakan XSS filtering
            $confirmPassword_new = $this->input->post('confirmPassword_new', true);

            // Validasi password
            if (strlen($password_new) < 6) {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('pages2/akun');
                return;
            }

            if ($password_new !== $confirmPassword_new) {
                $this->session->set_flashdata('error', 'Password tidak cocok!');
                redirect('pages2/akun'); // Redirect ke form ganti password
                return;
            }
            // Hash password
            $hashed_password = password_hash($password_new, PASSWORD_DEFAULT);
            
            // Ambil user_id dari session
            if (!$this->session->userdata['nis']) {
                $this->session->set_flashdata('error', 'Pengguna tidak terautentikasi!');
                redirect('login'); // Redirect ke halaman login
                return;
            }
            $user_nis = $this->session->userdata['nis'];

            // Update password melalui model
            $result = $this->Data_model->update_password2($user_nis, $hashed_password);

            if ($result) {
                $this->session->set_flashdata('success', 'Password berhasil diubah!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah password!');
            }

            redirect('pages2/akun'); // Redirect ke halaman profil pengguna
        } else {
            // Jika bukan POST, kembalikan ke form
            redirect('pages2/akun');
        }
    }
    
    public function reset_passwordform() {
        // Ambil data input dari form
        $nis = $this->input->post('nis');
        $username = $this->input->post('username');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $kelas = $this->input->post('kelas');

        // Validasi: Pastikan semua kolom diisi
        if (empty($nis) || empty($username) || empty($nama_lengkap) || empty($kelas)) {
            $this->session->set_flashdata('error', 'Semua kolom wajib diisi.');
            redirect('pertama/reset_form'); // Kembali ke halaman reset password
            return;
        }

        // Cek apakah sudah ada pengajuan reset dengan nis yang sama
        $this->load->model('Siswa_model');
        if ($this->Siswa_model->check_existing_reset_request($nis)) {
            $this->session->set_flashdata('error', 'Pengajuan reset password sudah dilakukan sebelumnya.');
            redirect('pertama/reset_form'); // Kembali ke halaman reset password
            return;
        }

        // Cek apakah data siswa valid
        $siswa = $this->Siswa_model->get_siswa_by_nis($nis);

        if (!$siswa) {
            $this->session->set_flashdata('error', 'NIS tidak ditemukan.');
            redirect('pertama/reset_form');
            return;
        }

        // Periksa apakah username, nama lengkap, dan kelas sesuai dengan data di database
        if ($siswa['username'] !== $username || $siswa['nama_lengkap'] !== $nama_lengkap || $siswa['kelas'] !== $kelas) {
            $this->session->set_flashdata('error', 'Data yang Anda masukkan tidak valid.');
            redirect('pertama/reset_form');
            return;
        }

        // Jika semua valid, simpan data ke tabel daftar_reset
        $data = [
            'nis' => $nis,
            'username' => $username,
            'nama_lengkap' => $nama_lengkap,
            'kelas' => $kelas
        ];

        $this->Siswa_model->insert_reset_request($data); // Fungsi untuk memasukkan ke tabel daftar_reset

        // Set flashdata sukses
        $this->session->set_flashdata('success', 'Pengajuan reset password berhasil.');
        redirect('pertama/reset_form'); // Redirect kembali ke halaman reset
    }



    public function success() {
        $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan.');
        redirect('pages/tambah-guru');
    }
    public function success2() {
        $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan.');
        redirect('pages/tambah-siswa');
    }
    
}