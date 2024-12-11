<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages2 extends CI_Controller
{
    public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Petugas_model');
    $this->load->model('Pengaduan_model');
    $this->load->model('Data_model'); 
    // Jika belum login, redirect ke halaman login
    if (!$this->session->userdata('logged_in')) {
        redirect(site_url('pertama'));
    }
}

    public function view($page = 'home')
    {

        if (!file_exists(APPPATH . 'views/siswa/' . $page . '.php')) {
            show_404(); // Halaman tidak ditemukan
        }

        $data['title'] = ucfirst($page);
    
        if ($page === 'akun') {

            if (!$this->session->userdata('logged_in')) {
                redirect('login');
            }

            $user_nis = $this->session->userdata('nis');
            $this->load->model('Data_model');
            $data['user_nis'] = $this->Data_model->get_user_by_nis($user_nis);
        }
    
        if ($page === 'home') {
            
            $data['petugas'] = $this->Petugas_model->get_all_petugas();
            $nis = $this->session->userdata('nis');
    
            $this->db->where('nis', $nis);
            $jumlah_aduan = $this->db->count_all_results('pengaduan');
            
            $data['jumlah_aduan'] = $jumlah_aduan;

            $this->db->where('nis', $nis);
            $this->db->where_in('pengaduan.status', ['ditanggapi']);
            $jumlah_ditanggapi = $this->db->count_all_results('pengaduan');
            
            $data['jumlah_ditanggapi'] = $jumlah_ditanggapi;
            
        }
        if ($page === 'daftaraduan') {
            $nis = $this->session->userdata('nis');

            $data['daftar_aduan'] = $this->Pengaduan_model->get_daftar_aduan($nis);        
        }
        if ($page === 'editpengaduan-siswa') {
            $md5_id_pengaduan = $this->input->get('id_pengaduan');
            $data['aduan'] = $this->Pengaduan_model->get_pengaduan_by_md5($md5_id_pengaduan);
            $data['data_petugas'] = $this->Pengaduan_model->get_all_guru();
        }
        if ($page === 'pengaduanDitanggapi-siswa') {
            $nis = $this->session->userdata('nis');

            $data['aduan_ditanggapi'] = $this->Pengaduan_model->get_aduan_ditanggapi($nis);
           

        }
        if ($page === 'chat-siswa') {
             
        
            $pengaduan_hash = $this->input->get('id_pengaduan');

            if (!$pengaduan_hash) {
                show_error('Data tidak valid.', 404, 'Not Found');
            }

            $this->db->select('pengaduan.*, data_petugas.nama_guru, data_petugas.id_petugas');
            $this->db->from('pengaduan');
            $this->db->join('data_petugas', 'pengaduan.id_petugas = data_petugas.id_petugas', 'left');
            $this->db->where('md5(pengaduan.id_pengaduan)', $pengaduan_hash);
            $pengaduan = $this->db->get()->row_array();

            if (!$pengaduan) {
                show_error('Pengaduan tidak ditemukan.', 404, 'Not Found');
            }

            $this->db->select('*');
            $this->db->from('tanggapan');
            $this->db->where('id_pengaduan', $pengaduan['id_pengaduan']);
            $this->db->order_by('tgl_tanggapan', 'ASC');
            $this->db->order_by('jam_menit', 'ASC');
            $tanggapan = $this->db->get()->result_array();

            $data = [
                'pengaduan' => $pengaduan,
                'tanggapan' => $tanggapan,
            ];

        }        if ($page === 'daftar') {
            
            $data['petugas'] = $this->Data_model->get_all_petugas(); 
        }
        $data['content'] = $this->load->view('siswa/' . $page, isset($data) ? $data : [], true);

        $this->load->view('siswa/index', $data);

    }

}
