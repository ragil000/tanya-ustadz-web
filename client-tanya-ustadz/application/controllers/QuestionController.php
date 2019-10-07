<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionController extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('QuestionModel');
    }

	public function index()
	{
        $result['data'] = $this->QuestionModel->getQuestion();
        
		$this->load->view('templates/header');
		$this->load->view('pages/question', $result);
		$this->load->view('templates/footer');
	}
}
