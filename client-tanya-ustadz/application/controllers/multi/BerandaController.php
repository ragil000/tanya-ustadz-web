<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerandaController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('multi/BerandaModel');
		$this->load->model('LibraryRMYModel');
    }

	public function index()	{
		$this->LibraryRMYModel->data['dataTop'] = $this->BerandaModel->_getBerandaTop();
		$this->LibraryRMYModel->data['dataBottom'] = $this->BerandaModel->_getBerandaBottom();
		$this->LibraryRMYModel->data['dataRight'] = $this->BerandaModel->_getBerandaRight();
		$this->LibraryRMYModel->data['berandaActive'] = 'active';		

		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/beranda');
		$this->load->view('templates/footer');
	}

	public function getSinglePost($id_tb_jawaban = null, $id_tb_pertanya = null) {

		$this->LibraryRMYModel->data['data'] = $this->BerandaModel->_getSinglePost($id_tb_jawaban);
		if($id_tb_pertanya != null){
			$this->LibraryRMYModel->data['id_tb_pertanyaan'] = $id_tb_pertanya;
		}
		$this->LibraryRMYModel->data['berandaActive'] = 'active';		

		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/single-post');
		$this->load->view('templates/footer');
	}
}
