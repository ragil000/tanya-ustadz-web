<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$result['berandaActive'] = '';
		$result['pertanyaanSayaActive'] = '';

		$this->load->view('templates/header', $result);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');
	}
}
