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

        $result = $this->LoginModel->getLogin($get);
        
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

    public function index_post() {

        $data = [
            'tb_kategori_nama' => $this->post('tb_kategori_nama'),
        ];

        $result = $this->LoginModel->postLogin($data);
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
