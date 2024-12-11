<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaduan_model');
        
    }

    public function updateStatus()
    {
        $id_pengaduan = $this->input->post('id_pengaduan');
        $status = $this->input->post('status');

        if (empty($id_pengaduan) || empty($status)) {
            $this->session->set_flashdata('error', 'Data tidak valid.');
            redirect('pages3/home'); // Redirect kembali ke halaman utama
        }

        // Update status di database
        $update = $this->Pengaduan_model->updateStatus($id_pengaduan, $status);

        if ($update) {
            $this->session->set_flashdata('success', 'Pengaduan berhasil diselesaikan.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyelesaikan pengaduan.');
        }
        redirect('pages3/home');
    }
    public function updateFilter()
    {
        $id_pengaduan = $this->input->post('id_pengaduan');
        $filter = $this->input->post('filter');

        // Perbarui filter di database
        $this->load->model('Pengaduan_model');
        $update = $this->Pengaduan_model->updateFilter($id_pengaduan, $filter);

        if ($update) {
            $this->session->set_flashdata('success', 'Filter berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui filter.');
        }
        redirect('pages/home');
    }
    public function selesai_pengaduan()
    {
            $id_pengaduan = $this->input->post('id_pengaduan');
            $status = $this->input->post('status');

            if (empty($id_pengaduan) || empty($status)) {
                $this->session->set_flashdata('error', 'Data tidak valid.');
                redirect('pages3/aduan-ditanggapi'); // Redirect kembali ke halaman utama
            }

            $update = $this->Pengaduan_model->updateStatus($id_pengaduan, $status);

            if ($update) {
                $this->session->set_flashdata('success', 'Status pengaduan berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunah status pengaduan pengaduan.');
            }

            redirect('pages3/aduan-ditanggapi');
    }
    public function hapus_buka_pengaduan()
    {

            $id_pengaduan = $this->input->post('id_pengaduan');
            $status = $this->input->post('status');

            if (empty($id_pengaduan) || empty($status)) {
                $this->session->set_flashdata('error', 'Data tidak valid.');
                redirect('pages3/aduan-selesai');
            }

            $update = $this->Pengaduan_model->updateStatus($id_pengaduan, $status);

            if ($update) {
                $this->session->set_flashdata('success', 'Status pengaduan berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunah status pengaduan pengaduan.');
            }

            // Redirect kembali ke halaman utama
            redirect('pages3/aduan-selesai');
        }
}
