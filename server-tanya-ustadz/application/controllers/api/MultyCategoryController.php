<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class MultyCategoryController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('MultyCategoryModel');

    }

    public function index_get(){

        $id = $this->get('id');

        $result = $this->MultyCategoryModel->getMultyCategory($id);
        
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

        // echo '`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '\\', '|', '[', ']', '{', '}', ';', ':', '\'', '"', ',', '<', '.', '>', '/', '?';

    }

    public function index_post() {

        $data = [
            'id_tb_artikel' => $this->post('id_tb_artikel'),
            'id_tb_kategori' => $this->post('id_tb_kategori')
        ];

        $result = $this->MultyCategoryModel->postMultyCategory($data);
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

        $result = $this->MultyCategoryModel->deleteMultyCategory($id);

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
            'id_tb_artikel' => $this->put('id_tb_artikel'),
            'id_tb_kategori' => $this->put('id_tb_kategori')
        ];

        $result = $this->MultyCategoryModel->putMultyCategory($data, $id);
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
