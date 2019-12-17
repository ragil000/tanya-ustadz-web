<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    private $sessionData = array();
    public function __construct(){
        parent::__construct();

        $this->load->model('multi/LoginModel');
        $this->load->model('LibraryRMYModel');
        
    }

	public function index(){
        if(isset($_SESSION['id_tb_akun'])){
			redirect(base_url()."multi/beranda");
        }
        
		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');

    }
    
    public function setLogin()
	{

        $post = $this->input->post();
        $this->LibraryRMYModel->data['result'] = $this->LoginModel->_setLogin($post);

        $data = $this->LibraryRMYModel->data['result']['data'][0];
        
        $this->sessionData = array(
            'id_tb_akun' => $data['id_tb_akun'],
            'tb_akun_username' => $data['tb_akun_username'],
            'tb_akun_level' => $data['tb_akun_level']
        );

        $this->session->set_userdata($this->sessionData);

        redirect(base_url()."multi/masuk");
        
    }

    public function setLogout()
	{
        
        $this->sessionData = array('id_tb_akun', 'tb_akun_username', 'tb_akun_level');

        $this->session->unset_userdata($this->sessionData);

		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/login');
		$this->load->view('templates/footer');
    }

    public function register()
	{
        
        $this->LibraryRMYModel->data['result'] = $this->LoginModel->_getAllAccount();

		$this->load->view('templates/header', $this->LibraryRMYModel->data);
		$this->load->view('multi/register');
		$this->load->view('templates/footer');

    }

    public function postRegister(){
		
		$post = $this->input->post();
		
		$this->LibraryRMYModel->data['result'] = $this->LoginModel->_postRegister($post);
		
		if($this->LibraryRMYModel->data['result']['status']){
			redirect(base_url().'multi/masuk');
		}else{
			$this->load->view('templates/header', $this->LibraryRMYModel->data);
			$this->load->view('multi/register');
			$this->load->view('templates/footer');
		}
		
	}

}