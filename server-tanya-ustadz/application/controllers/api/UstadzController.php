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

    public function index_post() {

        $tgl = date("Y-m-d");
        $data = [
            'id_tb_pertanyaan' => $this->post('id_tb_pertanyaan'),
            'tb_jawaban_isi' => $this->post('tb_jawaban_isi'),
            'tb_jawaban_gambar' => $this->post('tb_jawaban_gambar'),
            'tb_jawaban_rating' => $this->post('tb_jawaban_rating'),
        ];
        
        $result = $this->UstadzModel->_postAnswer($data);
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

        $result = $this->MyQuestionModel->deleteQuestion($id);

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
            'id_tb_pertanyaan' => $this->put('id_tb_pertanyaan'),
            'tb_artikel_isi' => $this->put('tb_artikel_isi'),
            'tb_artikel_author' => $this->put('tb_artikel_author'),
            'tb_artikel_level' => $this->put('tb_artikel_level'),
        ];

        $result = $this->MyQuestionModel->putQuestion($data, $id);
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
