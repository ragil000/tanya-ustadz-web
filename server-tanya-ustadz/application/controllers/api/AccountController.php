<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class AccountController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('AccountModel');

    }

    public function index_get(){

        $id = $this->get('id');

        $result = $this->AccountModel->getAccount($id);
        
        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data kosong'
            ], 404);

        }

    }

    public function index_post() {

        $tgl = date("Y-m-d");
        $data = [
            'tb_akun_username' => $this->post('tb_akun_username'),
            'tb_akun_password' => md5($this->post('tb_akun_password')),
            'tb_akun_level' => $this->post('tb_akun_level'),
            'tb_akun_tgl' => $tgl
        ];

        $result = $this->AccountModel->postAccount($data);
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

        $result = $this->AccountModel->deleteAccount($id);

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
            'tb_akun_username' => $this->put('tb_akun_username'),
            'tb_akun_password' => md5($this->put('tb_akun_password')),
            'tb_akun_level' => $this->put('tb_akun_level'),
        ];

        $result = $this->AccountModel->putAccount($data, $id);
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
