<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UstadzController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('ustadz/UstadzModel');
		$this->load->model('LibraryRMYModel');

		if(!isset($_SESSION['id_tb_akun'])){
			redirect(base_url()."multi/masuk");
		}

    }

	public function index(){

		$this->LibraryRMYModel->data['data'] = $this->UstadzModel->_getAllQuestionsEntered();
        $this->LibraryRMYModel->data['pertanyaanMasukActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('ustadz/questions-entered');
		$this->load->view('templates/footer');

	}

	public function getQuestionEnteredById($id_tb_pertanyaan){

		echo json_encode($this->UstadzModel->_getQuestionEnteredById($id_tb_pertanyaan));

	}

	public function myAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null){

		$this->LibraryRMYModel->data['dataAll'] = $this->UstadzModel->_getAllUstadzsAnswered($_SESSION['id_tb_akun']);
		$this->LibraryRMYModel->data['dataQuestionEntered'] = $this->UstadzModel->_getAllQuestionsEntered();
        $this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		if($id_tb_pertanyaan === null && $id_tb_jawaban === null){
			
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('ustadz/my-answer');
			$this->load->view('templates/footer');
		}else if($id_tb_pertanyaan != null && $id_tb_jawaban != null){

			$this->LibraryRMYModel->data['dataQuestion'] = $this->UstadzModel->_getQuestionEnteredById($id_tb_pertanyaan);
			$this->LibraryRMYModel->data['dataAnswer'] = $this->UstadzModel->_getUstadzsAnsweredById($id_tb_jawaban);

			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('ustadz/my-answer');
			$this->load->view('templates/footer');
		}else if($id_tb_pertanyaan != null && $id_tb_jawaban == null){

			$this->LibraryRMYModel->data['dataQuestion'] = $this->UstadzModel->_getQuestionEnteredById($id_tb_pertanyaan);
			$this->load->view('templates/header', $this->LibraryRMYModel->data);

			$this->load->view('ustadz/my-answer');
			$this->load->view('templates/footer');
		}
		
	}

	public function postMyAnswer(){
		
		$post = $this->input->post();
		
		$this->LibraryRMYModel->data['result'] = $this->UstadzModel->_postMyAnswer($post);
		$this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'ustadz/jawaban-saya');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('ustadz/my-answer');
			$this->load->view('templates/footer');
		}
		
	}

	public function putMyAnswer(){
				
		$this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		if($this->input->post('tb_jawaban_isi', true) == $this->input->post('tb_jawaban_isi_old', true)){
			redirect(base_url().'ustadz/jawaban-saya');
		}else{
			$this->LibraryRMYModel->data['result'] = $this->UstadzModel->_putMyAnswer();
			if($this->LibraryRMYModel->data['result']['status']){
				redirect(base_url().'ustadz/jawaban-saya');
			}else{
				redirect(base_url().'ustadz/jawaban-saya');
			}
		}
		
	}

	public function deleteMyAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null){
				
		$this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		$this->LibraryRMYModel->data['result'] = $this->UstadzModel->_deleteMyAnswer($id_tb_pertanyaan, $id_tb_jawaban);
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'ustadz/jawaban-saya');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('ustadz/my-answer');
			$this->load->view('templates/footer');
		}
		
	}

}