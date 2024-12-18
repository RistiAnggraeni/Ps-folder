<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database
    }

    public function import() {
        // Pastikan file diunggah
        if (empty($_FILES['file']['name'])) {
            $this->session->set_flashdata('error', 'No file selected.');
            redirect('pages/dataguru');
        }

        // Path file
        $file_mime = $_FILES['file']['type'];
        $file_path = $_FILES['file']['tmp_name'];

        try {
            // Baca file Excel
            $spreadsheet = IOFactory::load($file_path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // Proses data (contoh: menyimpan ke database)
            foreach ($sheetData as $key => $row) {
                // Lewati header
                if ($key == 1) continue;

                // Contoh data yang dimasukkan ke database
                $data = [
                    'username'  => $row['A'], // Kolom A di Excel
                    'nama_guru' => $row['B'], // Kolom B di Excel
                    'no_hp' => $row['C'], // Kolom C di Excel
                    'jabatan' => $row['D'],
                    'level' => $row['E'],
                    'password_lama' => $row['F'],
                ];

                // Insert data ke tabel
                $this->db->insert('data_petugas', $data);
            }

            // Cek apakah ada error dalam insert
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'File imported successfully.');
            } else {
                $this->session->set_flashdata('error', 'No data inserted.');
            }

        } catch (\Exception $e) {
            // Tangani pengecualian jika terjadi kesalahan
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
        }

        // Redirect kembali ke halaman 'excel'
        redirect('pages/dataguru');
    }

public function import_for_siswa() {
        // Pastikan file diunggah
        if (empty($_FILES['file']['name'])) {
            $this->session->set_flashdata('error', 'No file selected.');
            redirect('pages/datasiswa');
        }

        // Path file
        $file_mime = $_FILES['file']['type'];
        $file_path = $_FILES['file']['tmp_name'];

        try {
            // Baca file Excel
            $spreadsheet = IOFactory::load($file_path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // Proses data (contoh: menyimpan ke database)
            foreach ($sheetData as $key => $row) {
                // Lewati header
                if ($key == 1) continue;

                // Contoh data yang dimasukkan ke database
                $data = [
                    'nis'  => $row['A'], // Kolom A di Excel
                    'username' => $row['B'], // Kolom B di Excel
                    'nama_lengkap' => $row['C'], // Kolom C di Excel
                    'kelas' => $row['D'],
                    'password_lama' => $row['E'],
                    'status' => '1',
                ];

                // Insert data ke tabel
                $this->db->insert('data_siswa', $data);
            }

            // Cek apakah ada error dalam insert
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'File imported successfully.');
            } else {
                $this->session->set_flashdata('error', 'No data inserted.');
            }

        } catch (\Exception $e) {
            // Tangani pengecualian jika terjadi kesalahan
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
        }

        // Redirect kembali ke halaman 'excel'
        redirect('pages/datasiswa');
    }
}