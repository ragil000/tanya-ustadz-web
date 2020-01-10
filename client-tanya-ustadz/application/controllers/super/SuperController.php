<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('super/SuperModel');
		$this->load->model('LibraryRMYModel');

		if(!isset($_SESSION['id_tb_akun'])){
			redirect(base_url()."multi/masuk");
		}

    }

	public function index(){

		$this->LibraryRMYModel->data['data'] = $this->SuperModel->_getAllAccount($_SESSION['tb_akun_username']);
        $this->LibraryRMYModel->data['dataAkunActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('super/super-page');
		$this->load->view('templates/footer');

	}

	public function nonactiveAccount(){

		$this->LibraryRMYModel->data['data'] = $this->SuperModel->_getAllNonactiveAccount();
        $this->LibraryRMYModel->data['akunNonaktifActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('super/nonactive-page');
		$this->load->view('templates/footer');

	}

	public function postAccount(){
		
		$post = $this->input->post();
		
		$this->LibraryRMYModel->data['result'] = $this->SuperModel->_postAccount($post);
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'super/data-akun');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('super/super-page');
			$this->load->view('templates/footer');
		}
		
	}

	public function deleteAccount($id_tb_akun){
		
		$this->LibraryRMYModel->data['result'] = $this->SuperModel->_deleteAccount($id_tb_akun);
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'super/data-akun');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('super/super-page');
			$this->load->view('templates/footer');
		}
		
	}

	public function putMyAnswer(){
				
		$this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		if($this->input->post('tb_jawaban_isi', true) == $this->input->post('tb_jawaban_isi_old', true)){
			redirect(base_url().'ustadz/jawaban-saya');
		}else{
			$this->LibraryRMYModel->data['result'] = $this->SuperModel->_putMyAnswer();
			if($this->LibraryRMYModel->data['result']['status']){
				redirect(base_url().'ustadz/jawaban-saya');
			}else{
				redirect(base_url().'ustadz/jawaban-saya');
			}
		}
		
	}
	
}