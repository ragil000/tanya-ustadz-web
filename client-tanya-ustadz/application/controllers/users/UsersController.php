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
		$this->LibraryRMYModel->data['dataMyQuestion'] = $this->UsersModel->_getMyQuestion($id_tb_akun);
		$this->LibraryRMYModel->data['dataAll'] = $this->UsersModel->_getMyQuestionAnswered($id_tb_akun);
		$this->LibraryRMYModel->data['dataSimilarity'] = $this->UsersModel->_getSimilarityData($id_tb_akun);
		
		$tb_pertanyaan_isi = $this->LibraryRMYModel->data['dataMyQuestion']['data'][0]['tb_pertanyaan_isi'];

		$this->load->model('multi/VSMModel');
		$this->LibraryRMYModel->data['dataSuggest'] = $this->VSMModel->_getVSM($tb_pertanyaan_isi);
		
		$this->LibraryRMYModel->data['dataSuggest'] = $this->LibraryRMYModel->_rangking($this->LibraryRMYModel->data['dataSuggest']['data']);

		$this->LibraryRMYModel->data['pertanyaanSayaActive'] = 'active';
		
		// print_r($this->LibraryRMYModel->data['dataSuggest']);
		// die;
		
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

	public function deleteMyQuestion($id_tb_pertanyaan = null){
				
		$this->LibraryRMYModel->data['pertanyaanSayaActive'] = 'active';
		
		$this->LibraryRMYModel->data['result'] = $this->UsersModel->_deleteMyQuestion($id_tb_pertanyaan);
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'user/pertanyaan-saya');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('users/my-question');
			$this->load->view('templates/footer');
		}
		
	}

	public function similarMyQuestion($id_tb_pertanyaan = null, $id_tb_penjawab = null){
		
		$this->LibraryRMYModel->data['result'] = $this->UsersModel->_similarMyQuestion($id_tb_pertanyaan, $id_tb_penjawab);
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