<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function kirim_pesan()
    {
        $this->form_validation->set_rules('isi_pesan', 'Pesan', 'required');
        $pengaduan_hash = $this->input->post('id_pengaduan'); // Mengambil hash dari request

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Pesan tidak boleh kosong');
            redirect('pages3/chat-guru?id_pengaduan=' . $pengaduan_hash);
        } else {
            // Cari id_pengaduan berdasarkan hash
            $this->db->select('id_pengaduan');
            $this->db->where('MD5(id_pengaduan)', $pengaduan_hash);
            $pengaduan = $this->db->get('pengaduan')->row_array();

            if (!$pengaduan) {
                $this->session->set_flashdata('error', 'Data pengaduan tidak valid.');
                redirect('pages3/chat-guru?id_pengaduan=' . $pengaduan_hash);
            }

            $id_pengaduan = $pengaduan['id_pengaduan']; // ID asli dari hash
            $isi_pesan = $this->input->post('isi_pesan');
            $sender_type = $this->input->post('sender_type');
            $id_petugas = $this->session->userdata('id_petugas'); 
            $nis = $this->session->userdata('nis'); 

            $lampiran = '';
            if ($_FILES['lampiran']['name']) {
                $config['upload_path'] = './uploads/lampiran/';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $config['max_size'] = 10240; 
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('lampiran')) {
                    $upload_data = $this->upload->data();
                    $lampiran = $upload_data['file_name'];
                } else {
                    // Jika gagal upload, set pesan error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('pages3/chat-guru?id_pengaduan=' . $pengaduan_hash);
                }
            }

            $data = array(
                'id_pengaduan' => $id_pengaduan,
                'tanggapan' => $isi_pesan,
                'id_petugas' => ($sender_type == 'guru') ? $id_petugas : null,
                'nis' => ($sender_type == 'siswa') ? $nis : null,
                'sender_type' => $sender_type,
                'attachment' => $lampiran,
                'tgl_tanggapan' => date('Y-m-d'),
                'jam_menit' => date('H:i:s'),
            );

            $this->db->insert('tanggapan', $data);

            if ($sender_type == 'guru') {
                $this->db->select('status');
                $this->db->where('id_pengaduan', $id_pengaduan);
                $pengaduan_status = $this->db->get('pengaduan')->row_array();
                
                if ($pengaduan_status && $pengaduan_status['status'] === 'belum ditanggapi') {
                    $this->db->where('id_pengaduan', $id_pengaduan);
                    $this->db->update('pengaduan', ['status' => 'ditanggapi']);
                }
            }

            $this->session->set_flashdata('success', 'Pesan berhasil dikirim');
            redirect('pages3/chat-guru?id_pengaduan=' . $pengaduan_hash);
        }
    }
    public function kirim_pesan_siswa()
    {
        $this->form_validation->set_rules('isi_pesan', 'Pesan', 'required');
        $pengaduan_hash = $this->input->post('id_pengaduan'); // Mengambil hash dari request

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Pesan tidak boleh kosong');
            redirect('pages2/chat-siswa?id_pengaduan=' . $pengaduan_hash);
        } else {
            // Cari id_pengaduan berdasarkan hash
            $this->db->select('id_pengaduan');
            $this->db->where('MD5(id_pengaduan)', $pengaduan_hash);
            $pengaduan = $this->db->get('pengaduan')->row_array();

            if (!$pengaduan) {
                $this->session->set_flashdata('error', 'Data pengaduan tidak valid.');
                redirect('pages2/chat-siswa?id_pengaduan=' . $pengaduan_hash);
            }

            $id_pengaduan = $pengaduan['id_pengaduan']; // ID asli dari hash
            $isi_pesan = $this->input->post('isi_pesan');
            $sender_type = $this->input->post('sender_type');
            $id_petugas = $this->session->userdata('id_petugas'); 
            $nis = $this->session->userdata('nis'); 

            $lampiran = '';
            if ($_FILES['lampiran']['name']) {
                $config['upload_path'] = './uploads/lampiran/';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $config['max_size'] = 10240; 
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('lampiran')) {
                    $upload_data = $this->upload->data();
                    $lampiran = $upload_data['file_name'];
                } else {
                    // Jika gagal upload, set pesan error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('pages2/chat-siswa?id_pengaduan=' . $pengaduan_hash);
                }
            }

            $data = array(
                'id_pengaduan' => $id_pengaduan,
                'tanggapan' => $isi_pesan,
                'id_petugas' => ($sender_type == 'guru') ? $id_petugas : null,
                'nis' => ($sender_type == 'siswa') ? $nis : null,
                'sender_type' => $sender_type,
                'attachment' => $lampiran,
                'tgl_tanggapan' => date('Y-m-d'),
                'jam_menit' => date('H:i:s'),
            );

            $this->db->insert('tanggapan', $data);

            if ($sender_type == 'guru') {
                $this->db->select('status');
                $this->db->where('id_pengaduan', $id_pengaduan);
                $pengaduan_status = $this->db->get('pengaduan')->row_array();
                
                if ($pengaduan_status && $pengaduan_status['status'] === 'belum ditanggapi') {
                    $this->db->where('id_pengaduan', $id_pengaduan);
                    $this->db->update('pengaduan', ['status' => 'ditanggapi']);
                }
            }

            $this->session->set_flashdata('success', 'Pesan berhasil dikirim');
            redirect('pages2/chat-siswa?id_pengaduan=' . $pengaduan_hash);
        }
    }
}
