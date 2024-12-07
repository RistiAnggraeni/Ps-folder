<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswaguru extends CI_Controller {

    public function update() {
        // Ambil data dari form
        $nis = $this->input->post('nis');
        $username = $this->input->post('username');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $kelas = $this->input->post('kelas');

        // Periksa apakah NIS sudah digunakan siswa lain
        $existing_nis = $this->db->get_where('data_siswa', ['nis' => $nis])->row_array();
        if ($existing_nis && $existing_nis['nis'] != $nis) {
            // Jika NIS sudah digunakan siswa lain
            $this->session->set_flashdata('error', 'NIS sudah terdaftar.');
            redirect('pages/rincisiswa');
        }

        // Data untuk diupdate
        $data = [
            'nis' => $nis,
            'username' => $username,
            'nama_lengkap' => $nama_lengkap,
            'kelas' => $kelas,
        ];

        // Lakukan update
        $this->db->where('nis', $nis);
        if ($this->db->update('data_siswa', $data)) {
            // Jika berhasil
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            // Jika gagal
            $this->session->set_flashdata('error', 'Data tidak berhasil diubah.');
        }

        // Redirect kembali ke halaman daftar siswa
        redirect('pages/datasiswa');
    }
    public function update2() {
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
