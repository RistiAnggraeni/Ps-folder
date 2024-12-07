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
    public function get_pengaduan_by_petugas()
    {

    $this->db->select('pengaduan.*, data_siswa.username');
        $this->db->from('pengaduan');
        $this->db->join('data_siswa', 'pengaduan.nis = data_siswa.nis', 'left');

        // Tambahkan filter dan kondisi status
        $this->db->where('pengaduan.filter', '1');
        $this->db->where_in('pengaduan.status', ['belum ditanggapi', 'ditanggapi']);

        // Urutkan berdasarkan tanggal dan waktu pengaduan
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
    public function get_pengaduan_by_id($id_pengaduan)
{
    $this->db->where('id_pengaduan', $id_pengaduan);
    $query = $this->db->get('pengaduan');
    return $query->row(); // Mengambil 1 baris data
}

}
