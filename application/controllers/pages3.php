<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages3 extends CI_Controller
{
    public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Pengaduan_model');
    if (!$this->session->userdata('logged_in')) {
        redirect(site_url('pertama'));
    }
}

    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/guru/' . $page . '.php')) {
        }

        $data['title'] = ucfirst($page); 
        
        if ($page === 'akunguru') {
    
            if (!$this->session->userdata('logged_in')) {
                redirect('login'); 
            }

            $user_id = $this->session->userdata('id_petugas');
            $this->load->model('Data_model');
            $data['user'] = $this->Data_model->get_user_by_id($user_id);
        }
        if ($page === 'home') {
            $id_petugas = $this->session->userdata('id_petugas');
            $data['pengaduan'] = $this->Pengaduan_model->get_pengaduan_by_petugas($id_petugas);
           
            //----------------------------------------------------------------------
            $this->db->where('id_petugas', $id_petugas);
            $this->db->where_in('pengaduan.status', ['ditanggapi']);
            $jumlah_ditanggapi = $this->db->count_all_results('pengaduan');
            
            $data['jumlah_ditanggapi'] = $jumlah_ditanggapi;
            //----------------------------------------------------------------------
            $this->db->where('id_petugas', $id_petugas);
            $this->db->where_in('pengaduan.status', ['finish']);
            $jumlah_finish = $this->db->count_all_results('pengaduan');
            
            $data['jumlah_finish'] = $jumlah_finish;
                
        }
        if ($page === 'chat-guru') {
        
            $pengaduan_hash = $this->input->get('id_pengaduan');
            //=====================================================
            $id_pengaduan_decrypt = $this->Pengaduan_model->decrypt_pengaduan_id($pengaduan_hash);
            //=====================================================

            if (!$pengaduan_hash) {
                show_error('Data tidak valid.', 404, 'Not Found');
            }

            $this->db->select('pengaduan.*, data_siswa.username, data_siswa.nis');
            $this->db->from('pengaduan');
            $this->db->join('data_siswa', 'pengaduan.nis = data_siswa.nis', 'left');
            $this->db->where('md5(pengaduan.id_pengaduan)', $pengaduan_hash);
            $pengaduan = $this->db->get()->row_array();

            if (!$pengaduan) {
                show_error('Pengaduan tidak ditemukan.', 404, 'Not Found');
            }

            if ($pengaduan['status_nama'] == '1') {
                $pengaduan['username'] = substr($pengaduan['username'], 0, 1) . str_repeat('*', strlen($pengaduan['username']) - 1);
            }
            $tanggapan = $this->Pengaduan_model->get_chat($id_pengaduan_decrypt);
            $this->Pengaduan_model->mark_responses_as_read($id_pengaduan_decrypt);

            $data = [
                'pengaduan' => $pengaduan,
                'tanggapan' => $tanggapan,
            ];
          
        }
        if ($page === 'aduan-ditanggapi') {
            $id_petugas = $this->session->userdata('id_petugas');

            $data['aduan_ditanggapi'] = $this->Pengaduan_model->get_aduan_ditanggapi_petugas($id_petugas);
           //===========================================================================
            foreach ($data['aduan_ditanggapi'] as &$aduan) {
                $aduan['unread_count'] = $this->Pengaduan_model->count_unread_responses($aduan['id_pengaduan']);
            }


        }
        if ($page === 'aduan-selesai') {
            $id_petugas = $this->session->userdata('id_petugas');

            $data['aduan_selesai'] = $this->Pengaduan_model->get_aduan_selesai_petugas($id_petugas);
           

        }
        $data['content'] = $this->load->view('guru/' . $page, isset($data) ? $data : [], true);
        $this->load->view('guru/index', $data);

    }

}
