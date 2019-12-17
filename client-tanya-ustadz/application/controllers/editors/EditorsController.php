<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditorsController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('editors/EditorsModel');
		$this->load->model('LibraryRMYModel');

		if(!isset($_SESSION['id_tb_akun'])){
			redirect(base_url()."multi/masuk");
		}

    }

	public function index($id_tb_penjawab = null)
	{

		$this->LibraryRMYModel->data['data'] = $this->EditorsModel->_getAnswersReadyPublish();
		$this->LibraryRMYModel->data['jawabanSiapPublisActive'] = 'active';
		
		if($id_tb_penjawab != null){
			$this->LibraryRMYModel->data['dataReady'] = $this->EditorsModel->_getAnswersReadyPublish($id_tb_penjawab);
		}
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('editors/answer-ready-publish');
		$this->load->view('templates/footer');

	}

	public function getAnswerReadyPublishById($id_tb_pertanyaan){

		echo json_encode($this->EditorsModel->_getQuestionEnteredById($id_tb_pertanyaan));

	}

	public function getPublishedAnswers($id_tb_penjawab = null)
	{

		$this->LibraryRMYModel->data['data'] = $this->EditorsModel->_getPublishedAnswers();
		$this->LibraryRMYModel->data['dataOld'] = $this->EditorsModel->_getAnswersReadyPublish();
		$this->LibraryRMYModel->data['jawabanTerpublisActive'] = 'active';

		if($id_tb_penjawab != null){
			$this->LibraryRMYModel->data['dataReady'] = $this->EditorsModel->_getPublishedAnswers($id_tb_penjawab);
		}
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('editors/published-answer');
		$this->load->view('templates/footer');
		
	}

	public function postPublishedAnswer(){
		
		$post = $this->input->post();
		
		$this->LibraryRMYModel->data['result'] = $this->EditorsModel->_postPublishedAnswer($post);
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'editor/jawaban-siap-publis');
		}else{
			redirect(base_url().'editor/jawaban-siap-publis');
		}
		
	}

	public function putPublishedAnswer(){
		
		if($this->input->post('tb_jawaban_judul', true) == $this->input->post('tb_jawaban_judul_old', true) && $this->input->post('tb_jawaban_isi', true) == $this->input->post('tb_jawaban_isi_old', true) && $_FILES['tb_jawaban_gambar']['name'] == null){
			redirect(base_url().'editor/jawaban-terpublis');
		}else{
			$this->LibraryRMYModel->data['result'] = $this->EditorsModel->_putPublishedAnswer();

			if($this->LibraryRMYModel->data['result']['status']){
				redirect(base_url().'editor/jawaban-terpublis');
			}else{
				redirect(base_url().'editor/jawaban-terpublis');
			}
		}
		
	}

	public function deletePublishedAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null, $tb_jawaban_gambar = null){
				
		$this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		$this->LibraryRMYModel->data['result'] = $this->EditorsModel->_deletePublishedAnswer($id_tb_pertanyaan, $id_tb_jawaban, $tb_jawaban_gambar);
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'editor/jawaban-terpublis');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('ustadz/published-answer');
			$this->load->view('templates/footer');
		}
		
	}

}