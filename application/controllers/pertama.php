<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertama extends CI_Controller {
	

	public function index()
	{
		$this->load->view('login');
	}
	public function login2()
	{
		$this->load->view('loginguru');
	}
	public function reset_form(){
		$this->load->view('resetpass_siswa');
	}
}
