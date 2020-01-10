<?php
use GuzzleHttp\Client;

class UstadzModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getAllQuestionsEntered(){
        
        $response = $this->_client->request('GET', 'UstadzController', [
           
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getQuestionEnteredById($id_tb_pertanyaan){
        
        $response = $this->_client->request('GET', 'UstadzController', [
            'query' => [
                'id_tb_pertanyaan' => $id_tb_pertanyaan
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getDetailEditor($id_tb_jawaban){
        
        $response = $this->_client->request('GET', 'UstadzController/getDetailEditor', [
            'query' => [
                'id_tb_jawaban' => $id_tb_jawaban
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getAllUstadzsAnswered($id_tb_akun){

        $response = $this->_client->request('GET', 'UstadzController/getAllUstadzsAnswered', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getUstadzsAnsweredById($id_tb_jawaban){

        $response = $this->_client->request('GET', 'UstadzController/getUstadzsAnsweredById', [
            'query' => [
                'id_tb_jawaban' => $id_tb_jawaban,
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _postMyAnswer($post){
        
        $data = [
            'id_tb_akun' => $_SESSION['id_tb_akun'],
            'id_tb_pertanyaan' => $post['id_tb_pertanyaan'],
            'tb_jawaban_isi' => $post['tb_jawaban_isi'],
            'tb_jawaban_gambar' => 'default.jpg',
            'tb_jawaban_rating' => '0'
        ];

        $response = $this->_client->request('POST', 'UstadzController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _putMyAnswer(){
        
        $data = [
            'tb_jawaban_isi' => $this->input->post('tb_jawaban_isi', true),
            'id_tb_jawaban' => $this->input->post('id_tb_jawaban', true),
        ];

        $response = $this->_client->request('PUT', 'UstadzController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _deleteMyAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null){

        $data = [
            'id_tb_pertanyaan' => $id_tb_pertanyaan,
            'id_tb_jawaban' => $id_tb_jawaban
        ];
        
        $response = $this->_client->request('DELETE', 'UstadzController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}