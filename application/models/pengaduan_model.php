<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{
    
    public function save_pengaduan($data)
    {
        return $this->db->insert('pengaduan', $data);
    }
    public function get_all_pengaduan()
    {
        $this->db->select('pengaduan.*, data_siswa.nama_lengkap, data_siswa.kelas');
        $this->db->from('pengaduan');
        $this->db->join('data_siswa', 'pengaduan.nis = data_siswa.nis', 'left');
        $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');
        $this->db->order_by('pengaduan.waktu', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_pengaduan_by_petugas($id_petugas)
{
    $this->db->select('pengaduan.*, data_siswa.username, md5(pengaduan.id_pengaduan) as pengaduan_hash');
    $this->db->from('pengaduan');
    $this->db->join('data_siswa', 'pengaduan.nis = data_siswa.nis', 'left');
    
    $this->db->where('pengaduan.filter', '1');
    $this->db->where_in('pengaduan.status', ['belum ditanggapi']);
    $this->db->where('pengaduan.id_petugas', $id_petugas);
    $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');
    $this->db->order_by('pengaduan.waktu', 'DESC');

    $query = $this->db->get();

    return $query->result_array();
}

    public function updateStatus($id_pengaduan, $status)
    {
        $this->db->where('id_pengaduan', $id_pengaduan);
        return $this->db->update('pengaduan', ['status' => $status]);
    }
    public function updateStatus_tiga($id_pengaduan, $status)
    {
        $this->db->where('md5(id_pengaduan)', $id_pengaduan);
        return $this->db->update('pengaduan', ['status' => $status]);
    }
    public function updateFilter($id_pengaduan, $filter)
    {
        $this->db->where('id_pengaduan', $id_pengaduan);
        return $this->db->update('pengaduan', ['filter' => $filter]);
    }
    public function get_daftar_aduan($nis)
    {
        $this->db->select('pengaduan.*, data_petugas.nama_guru');
        $this->db->from('pengaduan');
        $this->db->join('data_petugas', 'data_petugas.id_petugas = pengaduan.id_petugas', 'left');
        $this->db->where('pengaduan.nis', $nis);
        $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');  
        $this->db->order_by('pengaduan.waktu', 'DESC');
        $query = $this->db->get();
        return $query->result_array(); 
    }
   public function get_aduan_ditanggapi($nis)
    {
        $this->db->select('pengaduan.*, data_petugas.nama_guru');
        $this->db->join('data_petugas', 'data_petugas.id_petugas = pengaduan.id_petugas');
        $this->db->where('pengaduan.status', 'ditanggapi');
        $this->db->where_in('pengaduan.nis', $nis);
        $query = $this->db->get('pengaduan');
        return $query->result_array();
    }
    public function get_aduan_ditanggapi_petugas($id_petugas)
    {
        $this->db->select('pengaduan.*, data_siswa.nama_lengkap, data_siswa.username');
        $this->db->join('data_siswa', 'data_siswa.nis = pengaduan.nis');
        $this->db->where('pengaduan.status', 'ditanggapi');
        $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');  
        $this->db->order_by('pengaduan.waktu', 'DESC');
        $this->db->where_in('pengaduan.id_petugas', $id_petugas);
        $query = $this->db->get('pengaduan');
        return $query->result_array();
    }
    public function get_aduan_selesai_petugas($id_petugas)
    {
        $this->db->select('pengaduan.*, data_siswa.nama_lengkap, data_siswa.username');
        $this->db->join('data_siswa', 'data_siswa.nis = pengaduan.nis');
        $this->db->where('pengaduan.status', 'finish');
        $this->db->where_in('pengaduan.id_petugas', $id_petugas);
        $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');  
        $this->db->order_by('pengaduan.waktu', 'DESC');
        $query = $this->db->get('pengaduan');
        return $query->result_array();
    }

    public function get_pengaduan_by_id($id_pengaduan)
    {

        $this->db->select('pengaduan.*, data_petugas.nama_guru , data_petugas.jabatan, data_petugas.level');
        $this->db->from('pengaduan'); 
        $this->db->join('data_petugas', 'pengaduan.id_petugas = data_petugas.id_petugas', 'left');
        $this->db->where('pengaduan.id_pengaduan', $id_pengaduan); 
        $query = $this->db->get(); 
        
        return $query->row_array(); 
    }
    public function get_all_guru()
    {
        $this->db->select('id_petugas, nama_guru, jabatan, level');
        $this->db->from('data_petugas');
        $this->db->where('level', 'guru'); 
        $query = $this->db->get();
        return $query->result_array(); 
    }
     public function get_pengaduan_by_md5($md5_id_pengaduan) {
        $this->db->where('md5(id_pengaduan)', $md5_id_pengaduan);
        $query = $this->db->get('pengaduan');
        return $query->row_array();
    }

    public function get_tanggapan_by_id_pengaduan($id_pengaduan) {
        $this->db->where('id_pengaduan', $id_pengaduan);
        $query = $this->db->get('tanggapan');
        return $query->row_array();
    }

    public function update_is_read($id_tanggapan) {
        $this->db->set('is_read', 1)
                 ->where('id_tanggapan', $id_tanggapan)
                 ->update('tanggapan');
    }

    public function get_pengaduan_ditanggapi() {
        $this->db->select('pengaduan.*, data_petugas.nama_guru');
        $this->db->join('data_petugas', 'data_petugas.id_petugas = pengaduan.id_petugas');
        $this->db->where('pengaduan.status', 'ditanggapi');
        $query = $this->db->get('pengaduan');
        return $query->result_array();
    }

    //===================================================================================
    public function count_unread_responses($id_pengaduan)
    {
        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->where('is_read', '0');
        return $this->db->count_all_results('tanggapan');
    }
public function mark_responses_as_read($id_pengaduan)
{
    $this->db->where('id_pengaduan', $id_pengaduan);
    $this->db->where('is_read', '0');
    $this->db->update('tanggapan', ['is_read' => '1']);
}
public function decrypt_pengaduan_id($pengaduan_hash)
{
    $this->db->select('id_pengaduan');
    $this->db->where('MD5(id_pengaduan)', $pengaduan_hash);
    $result = $this->db->get('pengaduan')->row_array();
    return $result ? $result['id_pengaduan'] : null;
}
public function get_chat($id_pengaduan)
{
    $this->db->select('*');
    $this->db->from('tanggapan');
    $this->db->where('id_pengaduan', $id_pengaduan);
    $this->db->order_by('tgl_tanggapan', 'ASC');
    $this->db->order_by('jam_menit', 'ASC'); // Jika waktu tanggapan disimpan secara terpisah
    return $this->db->get()->result_array();
}


}
