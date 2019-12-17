<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UstadzController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('UstadzModel');

    }

    public function index_get(){

        $id_tb_pertanyaan = $this->get('id_tb_pertanyaan');

        $result = $this->UstadzModel->_getAllQuestionsEntered($id_tb_pertanyaan);

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

    public function getAllUstadzsAnswered_get(){

        $id_tb_akun = $this->get('id_tb_akun');

        $result = $this->UstadzModel->_getAllUstadzsAnswered($id_tb_akun);

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

    public function getUstadzsAnsweredById_get(){

        $id_tb_jawaban = $this->get('id_tb_jawaban');

        $result = $this->UstadzModel->_getUstadzsAnsweredById($id_tb_jawaban);

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

        $tgl = date("Y-m-d");
        $id_tb_akun = $this->post('id_tb_akun');
        $data = [
            'id_tb_pertanyaan' => $this->post('id_tb_pertanyaan'),
            'tb_jawaban_isi' => $this->post('tb_jawaban_isi'),
            'tb_jawaban_gambar' => $this->post('tb_jawaban_gambar'),
            'tb_jawaban_rating' => $this->post('tb_jawaban_rating'),
        ];
        
        $result = $this->UstadzModel->_postMyAnswer($data, $id_tb_akun);
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

        $result = $this->UstadzModel->_putMyAnswer($data, $id_tb_jawaban);
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

        $id_tb_pertanyaan = $this->delete('id_tb_pertanyaan');
        $id_tb_jawaban = $this->delete('id_tb_jawaban');

        $result = $this->UstadzModel->_deleteMyAnswer($id_tb_pertanyaan, $id_tb_jawaban);

        if($result > 0) {

            $this->response([
                'status' => true,
                'id' => $id_tb_pertanyaan,
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
