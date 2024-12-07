<?php
class Siswa_model extends CI_Model
{
    // Ambil data petugas berdasarkan ID
    public function get_siswa_by_nis($nis)
    {
        return $this->db->get_where('data_siswa', ['nis' => $nis])->row_array();
    }

    // Update password_now ke kosong
    public function update_password($nis, $password_now)
    {
        $this->db->where('nis', $nis);
        $this->db->update('data_siswa', ['password_now' => $password_now]);
    }
    public function insert_reset_request($data) {
        return $this->db->insert('daftar_reset', $data); // Menyimpan data ke tabel daftar_reset
    }
    public function check_existing_reset_request($nis) {
        $this->db->where('nis', $nis);
        $query = $this->db->get('daftar_reset');
        return $query->num_rows() > 0; // Mengembalikan TRUE jika sudah ada, FALSE jika belum ada
    }
}
