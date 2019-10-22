<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class VSMController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('VSMModel');
        $this->load->model('TextPreprocessingModel');

    }

    public function index_get(){

        $tb_pertanyaan_isi = $this->get('tb_pertanyaan_isi');

        $tb_pertanyaan_isi_array = $this->TextPreprocessingModel->getIndexing($tb_pertanyaan_isi);
        $result = $this->VSMModel->ceckTermData($tb_pertanyaan_isi_array);
        // $result = $this->TextPreprocessingModel->getIndexing($tb_pertanyaan_isi);

        $this->response([
            'status' => true,
            'data' => $result,
            'message' => 'Data tertampil'
        ], 200);

        // if($result) {

        //     $this->response([
        //         'status' => true,
        //         'data' => $result,
        //         'message' => 'Data tertampil'
        //     ], 200);

        // }else {

        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data kosong'
        //     ], 404);

        // }

    }

}
