<?php 
class DaftarReset_model extends CI_Model
{
    // Hapus data dari tabel daftar_reset berdasarkan NIS
    public function delete_by_nis($nis)
    {
        $this->db->delete('daftar_reset', ['nis' => $nis]);
    }
}
