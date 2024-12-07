<?php
class Petugas_model extends CI_Model
{
    // Ambil data petugas berdasarkan ID
    public function get_petugas_by_id($id_petugas)
    {
        return $this->db->get_where('data_petugas', ['id_petugas' => $id_petugas])->row_array();
    }

    // Update password_now ke kosong
    public function update_password($id_petugas, $password_now)
    {
        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('data_petugas', ['password_now' => $password_now]);
    }
    public function get_all_petugas()
    {
        $this->db->where('level', 'guru');  // Pastikan ada kolom 'level' dengan nilai 'guru'
        $query = $this->db->get('data_petugas'); // Sesuaikan dengan nama tabel yang digunakan
        return $query->result_array();  // Mengambil hasil sebagai array
        
    }
}
