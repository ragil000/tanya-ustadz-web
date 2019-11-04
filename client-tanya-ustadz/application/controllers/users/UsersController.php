<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('users/UsersModel');
		$this->load->model('LibraryRMYModel');

		if(!isset($_SESSION['id_tb_akun'])){
			redirect(base_url()."multi/masuk");
		}
		
    }

	public function index() {

		$id_tb_akun = $_SESSION['id_tb_akun'];
		$this->LibraryRMYModel->data['data'] = $this->UsersModel->_getMyQuestion($id_tb_akun);
		$this->LibraryRMYModel->data['pertanyaanSayaActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('users/my-question');
		$this->load->view('templates/footer');
	}

	public function postMyQuestion(){
		
		$post = $this->input->post();
		
		$this->LibraryRMYModel->data['result'] = $this->UsersModel->_postMyQuestion($post);
		$this->LibraryRMYModel->data['pertanyaanSayaActive'] = 'active';
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'user/pertanyaan-saya');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('users/my-question');
			$this->load->view('templates/footer');
		}
		
	}

}