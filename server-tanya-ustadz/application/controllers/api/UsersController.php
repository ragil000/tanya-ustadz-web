<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UsersController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('UsersModel');

    }

    public function index_get(){

        $id_tb_akun = $this->get('id_tb_akun');

        $result = $this->UsersModel->_getMyQuestion($id_tb_akun);

        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => null,
                'message' => 'Data kosong'
            ], 200);

        }

    }

    public function getSimilarityData_get(){

        $id_tb_akun = $this->get('id_tb_akun');

        $result = $this->UsersModel->_getSimilarityData($id_tb_akun);

        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => null,
                'message' => 'Data kosong'
            ], 200);

        }

    }

    public function getMyQuestionAnswered_get(){

        $id_tb_akun = $this->get('id_tb_akun');

        $result = $this->UsersModel->_getMyQuestionAnswered($id_tb_akun);

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

    public function similarMyQuestion_post() {

        $data = [
            'id_tb_pertanyaan' => $this->post('id_tb_pertanyaan'),
            'id_tb_penjawab' => $this->post('id_tb_penjawab')
        ];

        $result = $this->UsersModel->_similarMyQuestion($data);
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

    public function index_post() {

        $tgl = date("Y-m-d");
        $data = [
            'id_tb_akun' => $this->post('id_tb_akun'),
            'tb_pertanyaan_isi' => $this->post('tb_pertanyaan_isi'),
            'tb_pertanyaan_level' => $this->post('tb_pertanyaan_level'),
            'tb_pertanyaan_tgl' => $tgl
        ];

        $result = $this->UsersModel->_postQuestion($data);
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

        $id_tb_pertanyaan = $this->delete('id_tb_pertanyaan');

        $result = $this->UsersModel->_deleteMyQuestion($id_tb_pertanyaan);

        if($result > 0) {

            $this->response([
                'status' => true,
                'id_tb_pertanyaan' => $id_tb_pertanyaan,
                'message' => 'Data berhasil dihapus'
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal dihapus'
            ], 400);

        }

    }

}
