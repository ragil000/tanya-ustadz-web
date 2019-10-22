<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyQuestionController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('users/MyQuestionModel');
		$this->load->model('LibraryRMYModel');
    }

	public function index()
	{
		$id_tb_akun = $_SESSION['id_tb_akun'];
		$this->LibraryRMYModel->data['data'] = $this->MyQuestionModel->_getMyQuestion($id_tb_akun);
		$this->LibraryRMYModel->data['pertanyaanSayaActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('users/my-question');
		$this->load->view('templates/footer');
	}
}