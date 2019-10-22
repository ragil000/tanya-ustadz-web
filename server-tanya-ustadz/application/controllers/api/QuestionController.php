<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class QuestionController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('QuestionModel');

    }

    public function index_get(){

        $id_tb_pertanyaan = $this->get('id_tb_pertanyaan');
        $id_tb_akun = $this->get('id_tb_akun');

        $result = $this->QuestionModel->getQuestion($id_tb_pertanyaan, $id_tb_akun);
        
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
            'id_tb_akun' => $this->post('id_tb_akun'),
            'tb_pertanyaan_isi' => $this->post('tb_pertanyaan_isi'),
            'tb_pertanyaan_level' => $this->post('tb_pertanyaan_level'),
            'tb_pertanyaan_tgl' => $tgl
        ];

        $result = $this->QuestionModel->postQuestion($data);
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

        $result = $this->QuestionModel->deleteQuestion($id);

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

        $result = $this->QuestionModel->putQuestion($data, $id);
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
