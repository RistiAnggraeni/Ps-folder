<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaduan_model'); // Pastikan ada model ini
        
    }

    // Method untuk update status pengaduan
    public function updateStatus()
    {
        
        // Ambil input dari form
        $id_pengaduan = $this->input->post('id_pengaduan');
        $status = $this->input->post('status');

        // Validasi input
        if (empty($id_pengaduan) || empty($status)) {
            $this->session->set_flashdata('error', 'Data tidak valid.');
            redirect('pages3/home'); // Redirect kembali ke halaman utama
        }

        // Update status di database
        $update = $this->Pengaduan_model->updateStatus($id_pengaduan, $status);

        if ($update) {
            $this->session->set_flashdata('success', 'Status berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status.');
        }

        // Redirect kembali ke halaman utama
        redirect('pages3/home');
    }
    public function updateFilter()
    {
        
        // Ambil data dari POST
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

        // Redirect kembali ke halaman utama
        redirect('pages/home');
    }

}
