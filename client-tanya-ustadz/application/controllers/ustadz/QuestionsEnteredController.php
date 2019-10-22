<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionsEnteredController extends CI_Controller {

    public function __construct(){
        parent::__construct();

		$this->load->model('ustadz/QuestionsEnteredModel');
		$this->load->model('LibraryRMYModel');
    }

	public function index()
	{

		$this->LibraryRMYModel->data['data'] = $this->QuestionsEnteredModel->_getAllQuestionsEntered();
        $this->LibraryRMYModel->data['pertanyaanMasukActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('ustadz/questions-entered');
		$this->load->view('templates/footer');

	}

	public function getQuestionEnteredById($id_tb_pertanyaan){

		echo json_encode($this->QuestionsEnteredModel->_getQuestionEnteredById($id_tb_pertanyaan));

	}

	public function myAnswer()
	{

		$this->LibraryRMYModel->data['data'] = $this->QuestionsEnteredModel->_getAllQuestionsEntered();
        $this->LibraryRMYModel->data['jawabanSayaActive'] = 'active';
		
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('ustadz/my-answer');
		$this->load->view('templates/footer');

	}

}