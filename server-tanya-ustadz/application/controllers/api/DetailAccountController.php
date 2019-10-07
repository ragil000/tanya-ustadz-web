<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class DetailAccountController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('DetailAccountModel');

    }

    public function index_get(){

        $id = $this->get('id');

        $result = $this->DetailAccountModel->getDetailAccount($id);
        
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

        $data = [
            'id_tb_akun' => $this->post('id_tb_akun'),
            'tb_akun_detail_nama' => $this->post('tb_akun_detail_nama'),
            'tb_akun_detail_gender' => $this->post('tb_akun_detail_gender'),
            'tb_akun_detail_agama' => $this->post('tb_akun_detail_agama'),
            'tb_akun_detail_deskripsi' => $this->post('tb_akun_detail_deskripsi'),
        ];

        $result = $this->DetailAccountModel->postDetailAccount($data);
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

        $result = $this->DetailAccountModel->deleteDetailAccount($id);

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
            'tb_akun_detail_nama' => $this->put('tb_akun_detail_nama'),
            'tb_akun_detail_gender' => $this->put('tb_akun_detail_gender'),
            'tb_akun_detail_agama' => $this->put('tb_akun_detail_agama'),
            'tb_akun_detail_deskripsi' => $this->put('tb_akun_detail_deskripsi'),
        ];

        $result = $this->DetailAccountModel->putDetailAccount($data, $id);
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
