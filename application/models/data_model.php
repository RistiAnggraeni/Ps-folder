<?php
class Data_model extends CI_Model {
    public function get_all_siswa() {
        return $this->db->get('data_siswa')->result_array();
    }
    public function get_all_petugas() {
        return $this->db->get('data_petugas')->result_array();
    }
    public function tambah_petugas($data) {
        return $this->db->insert('data_petugas', $data);
    }
    public function tambah_siswa($data) {
        return $this->db->insert('data_siswa', $data);
    }
    public function nis_exists($nis) {
        $this->db->where('nis', $nis);
        $query = $this->db->get('data_siswa');
        return $query->num_rows() > 0; // Jika ada hasil, berarti NIS sudah ada
    }
    
    public function get_all_daftar() {
        return $this->db->get('daftar_reset')->result_array();
    }
    public function get_user_by_id($id) {
        $this->db->where('id_petugas', $id);
        $query = $this->db->get('data_petugas'); // Ganti 'users' sesuai dengan nama tabel Anda
        return $query->row_array(); // Ambil hasil sebagai array
    }
    public function get_user_by_nis($nis) {
        $this->db->where('nis', $nis);
        $query = $this->db->get('data_siswa');
        return $query->row_array(); 
    }
    public function update_password($user_id, $hashed_password) {
        // Update password ke database berdasarkan user_id
        $this->db->set('password_now', $hashed_password);
        $this->db->where('id_petugas', $user_id);
        return $this->db->update('data_petugas'); // Return true jika berhasil
    }
    public function update_password2($user_nis, $hashed_password) {
        // Update password ke database berdasarkan nis
        $this->db->set('password_now', $hashed_password);
        $this->db->where('nis', $user_nis);
        return $this->db->update('data_siswa'); // Return true jika berhasil
    }
}
