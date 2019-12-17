<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class LoginController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('LoginModel');

    }

    public function index_get(){

        $get = $this->get();

        $result = $this->LoginModel->_getLogin($get);
        
        if($result['status']) {

            $this->response([
                'status' => $result['status'],
                'data' => $result['data'],
                'message' => $result['message']
            ], 200);

        }else {

            $this->response([
                'status' => $result['status'],
                'data' => $result['data'],
                'message' => $result['message']
            ], 201);

        }

    }

    public function getAllAccount_get(){
        $result = $this->LoginModel->_getAllAccount();
        
        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => $result,
                'message' => 'Data kosong'
            ], 201);

        }
    }

    public function index_post() {

        $data = [
            'tb_akun_username' => $this->post('tb_akun_username'),
            'tb_akun_password' => $this->post('tb_akun_password'),
            'tb_akun_level' => $this->post('tb_akun_level'),
            'tb_akun_tgl' => date('Y-m-d'),
        ];

        $result = $this->LoginModel->_postLogin($data);
        if($result > 0) {

            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], 201);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], 400);

        }

    }

    public function index_delete() {

        $id = $this->delete('id');

        $result = $this->LoginModel->deleteLogin($id);

        if($result > 0) {

            $this->response([
                'status' => true,
                'id' => $id,
                'message' => 'Data berhasil dihapus'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal dihapus'
            ], 400);

        }

    }

    public function index_put() {

        $id = $this->put('id');
        $data = [
            'tb_kategori_nama' => $this->put('tb_kategori_nama'),
        ];

        $result = $this->LoginModel->putLogin($data, $id);
        if($result > 0) {

            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], 400);

        }

    } 

}
