<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    private $sessionData = array();
    public function __construct(){
        parent::__construct();

        $this->load->model('multi/LoginModel');
    }

	public function index()
	{

        $result['berandaActive'] = '';
        $result['pertanyaanSayaActive'] = '';
        
		$this->load->view('templates/header', $result);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');

    }
    
    public function setLogin()
	{

        $post = $this->input->post();
        $result['result'] = $this->LoginModel->_setLogin($post);
        $result['berandaActive'] = '';
        $result['pertanyaanSayaActive'] = '';

        $data = $result['result']['data'][0];
        
        $this->sessionData = array(
            'id_tb_akun' => $data['id_tb_akun'],
            'tb_akun_username' => $data['tb_akun_username'],
            'tb_akun_level' => $data['tb_akun_level']
        );

        $this->session->set_userdata($this->sessionData);

        $this->load->view('templates/header', $result);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');
        
    }

    public function setLogout()
	{

        $result['berandaActive'] = '';
        $result['pertanyaanSayaActive'] = '';
        
        $this->sessionData = array('id_tb_akun', 'tb_akun_username', 'tb_akun_level');

        $this->session->unset_userdata($this->sessionData);

		$this->load->view('templates/header', $result);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');
    }

}