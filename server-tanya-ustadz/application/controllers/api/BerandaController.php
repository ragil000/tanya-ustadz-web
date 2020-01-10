<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class BerandaController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    private $starttime;
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        
        $this->starttime = microtime(true);
        
        $this->load->model('BerandaModel');

    }

    public function index_get(){

        $id_tb_jawaban = $this->get('id_tb_jawaban');

        $result = $this->BerandaModel->_getSinglePost($id_tb_jawaban);

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

    public function getBerandaTop_get(){
        
        $result = $this->BerandaModel->_getBerandaTop();

        $endtime = microtime(true);
        // mengitung waktu eksekusi
        $duration = $endtime-$this->starttime;
        $hours = (float)($duration/60/60);
        $minutes = (float)($duration/60)-$hours*60;
        $seconds = (float)$duration-$hours*60*60-$minutes*60;

        $detik = $endtime." dan ".$this->starttime." = ".$duration." = ".number_format($duration/1000, 3);
        // end menghitung waktu eksekusi

        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil',
                'waktu' => $detik
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => $result,
                'message' => 'Data kosong',
                'waktu' => $detik
            ], 200);

        }

    }

    public function getBerandaBottom_get(){
        
        $result = $this->BerandaModel->_getBerandaBottom();

        $endtime = microtime(true);
        // mengitung waktu eksekusi
        $duration = $endtime-$this->starttime;
        $hours = (float)($duration/60/60);
        $minutes = (float)($duration/60)-$hours*60;
        $seconds = (float)$duration-$hours*60*60-$minutes*60;

        $detik = $endtime." dan ".$this->starttime." = ".$duration." = ".number_format($duration/1000, 3);
        // end menghitung waktu eksekusi

        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil',
                'waktu' => $detik
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => $result,
                'message' => 'Data kosong',
                'waktu' => $detik
            ], 200);

        }

    }

    public function getBerandaRight_get(){
        
        $result = $this->BerandaModel->_getBerandaRight();

        $endtime = microtime(true);
        // mengitung waktu eksekusi
        $duration = $endtime-$this->starttime;
        $hours = (float)($duration/60/60);
        $minutes = (float)($duration/60)-$hours*60;
        $seconds = (float)$duration-$hours*60*60-$minutes*60;

        $detik = $endtime." dan ".$this->starttime." = ".$duration." = ".number_format($duration/1000, 3);
        // end menghitung waktu eksekusi

        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil',
                'waktu' => $detik
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => $result,
                'message' => 'Data kosong',
                'waktu' => $detik
            ], 200);

        }

    }

    public function getBerandaSearch_get(){
        $get = $this->get();
        $result = $this->BerandaModel->_getBerandaSearch($get);


        if($result) {

            $this->response([
                'status' => true,
                'data' => $result,
                'message' => 'Data tertampil',
            ], 200);

        }else {

            $this->response([
                'status' => false,
                'data' => $result,
                'message' => 'Data kosong',
            ], 200);

        }

    }

    public function getDetailUstadz_get(){

        $id_tb_akun_detail = $this->get('id_tb_akun_detail');

        $result = $this->BerandaModel->_getDetailUstadz($id_tb_akun_detail);

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

}
