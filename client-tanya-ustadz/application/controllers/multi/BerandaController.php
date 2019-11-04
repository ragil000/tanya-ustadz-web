<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerandaController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('multi/BerandaModel');
		$this->load->model('LibraryRMYModel');
    }

	public function index()
	{
        // $result['data'] = $this->BerandaModel->getBeranda();
		$this->LibraryRMYModel->data['berandaActive'] = 'active';		

		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/beranda');
		$this->load->view('templates/footer');
	}
}
