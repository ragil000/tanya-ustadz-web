<?php
use GuzzleHttp\Client;

class MyQuestionModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getMyQuestion($id_tb_akun){
        
        $response = $this->_client->request('GET', 'MyQuestionController', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function getAnswerById($id){
        
        $response = $this->_client->request('GET', 'QuestionController', [
            'query' => [
                'id_tb_jawaban' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function deleteAnswer($id){
        
        $response = $this->_client->request('DELETE', 'QuestionController', [
            'form_params' => [
                'id_tb_jawaban' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function postAnswer(){
        
        $data = [
            'tb_jawaban_judul' => $this->input->post('tb_jawaban_judul', true),
        ];

        $response = $this->_client->request('POST', 'QuestionController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function putAnswer($id){
        
        $data = [
            'tb_jawaban_judul' => $this->input->post('tb_jawaban_judul', true),
            'id_tb_jawaban' => $id
        ];

        $response = $this->_client->request('PUT', 'QuestionController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}