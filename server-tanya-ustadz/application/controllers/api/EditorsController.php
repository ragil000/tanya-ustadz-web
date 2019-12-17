<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class EditorsController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('EditorsModel');

    }

    public function index_get(){

        $id_tb_penjawab = $this->get('id_tb_penjawab');

        $result = $this->EditorsModel->_getAnswersReadyPublish($id_tb_penjawab);

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

    public function getPublishedAnswers_get(){

        $id_tb_akun = $this->get('id_tb_akun');
        $id_tb_penjawab = $this->get('id_tb_penjawab');

        $result = $this->EditorsModel->_getPublishedAnswers($id_tb_akun, $id_tb_penjawab);

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
            'id_tb_akun' => $this->post('id_tb_akun'),
            'id_tb_jawaban' => $this->post('id_tb_jawaban'),
            'tb_pengedit_tgl' => $tgl,
        ];

        $data2 = [
            'tb_jawaban_judul' => $this->post('tb_jawaban_judul'),
            'tb_jawaban_isi' => $this->post('tb_jawaban_isi'),
            'tb_jawaban_gambar' => $this->post('tb_jawaban_gambar'),
        ];

        $data3 = [
            'id_tb_pertanyaan' => $this->post('id_tb_pertanyaan'),
            'id_tb_jawaban' => $this->post('id_tb_jawaban'),
        ];
        
        $result = $this->EditorsModel->_postPublishedAnswer($data, $data2, $data3);
        if($result > 0) {

            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], 201);

        }else {

            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], 200);

        }

    }

    public function index_put() {

        $tgl = date("Y-m-d");
        $dataID = [
            'id_tb_pengedit' => $this->put('id_tb_pengedit'),
            'id_tb_jawaban' => $this->put('id_tb_jawaban'),
            'tb_pengedit_tgl' => $tgl 
        ];

        $data = [
            'tb_jawaban_judul' => $this->put('tb_jawaban_judul', true),
            'tb_jawaban_isi' => $this->put('tb_jawaban_isi', true),
            'tb_jawaban_gambar' => $this->put('tb_jawaban_gambar', true)
        ];

        $result = $this->EditorsModel->_putPublishedAnswer($data, $dataID);
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

        $result = $this->EditorsModel->_deletePublishedAnswer($id_tb_pertanyaan, $id_tb_jawaban);

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
