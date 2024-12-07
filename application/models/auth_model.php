<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Mendapatkan data user berdasarkan username
    // public function get_user($username) {
    //     $this->db->where('username', $username);
    //     $query = $this->db->get('data_petugas');
    //     return $query->row_array();
    // }
    public function get_user($username) { 
        $this->db->where('username', $username); 
        $query = $this->db->get('data_petugas'); 
        return $query->row_array();
    }
    public function get_user_siswa($username) { 
        $this->db->where('username', $username); 
        $query = $this->db->get('data_siswa'); 
        return $query->row_array();
    }
    public function get_siswa_by_nis($nis){
        $this->db->where('nis', $nis); 
        $query = $this->db->get('data_siswa'); 
        return $query->row_array();
    }
}
