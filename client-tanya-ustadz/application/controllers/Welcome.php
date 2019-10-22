<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$result['berandaActive'] = '';
		$result['pertanyaanSayaActive'] = '';

		$this->load->view('users/templates/header', $result);
		$this->load->view('users/pages/login');
		$this->load->view('users/templates/footer');
	}
}
