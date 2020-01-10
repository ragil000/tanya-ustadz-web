<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class SuperController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('SuperModel');

    }

    public function index_get(){

        $id_tb_akun = $this->get('id_tb_akun');
        $tb_akun_username = $this->get('tb_akun_username');

        $result = $this->SuperModel->_getAllAccount($id_tb_akun, $tb_akun_username);

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
            ], 200);

        }

    }

    public function getAllNonactiveAccount_get(){

        $result = $this->SuperModel->_getAllNonactiveAccount();

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
            ], 200);

        }

    }

    public function index_post() {

        $data = [
            'tb_akun_username' => $this->post('tb_akun_username'),
            'tb_akun_password' => $this->post('tb_akun_password'),
            'tb_akun_level' => $this->post('tb_akun_level'),
            'tb_akun_tgl' => date('Y-m-d'),
        ];

        $result = $this->SuperModel->_postAccount($data);
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

    public function index_put() {

        $id_tb_jawaban = $this->put('id_tb_jawaban');
        $data = [
            'tb_jawaban_isi' => $this->put('tb_jawaban_isi'),
        ];

        $result = $this->SuperModel->_putMyAnswer($data, $id_tb_jawaban);
        if($result > 0) {

            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], 200);

        }

    }

    public function index_delete() {

        $id_tb_akun = $this->delete('id_tb_akun');

        $result = $this->SuperModel->_deleteAccount($id_tb_akun);

        if($result > 0) {

            $this->response([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal dihapus'
            ], 200);

        }

    } 

}
