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
        
        $response = $this->_client->request('GET', 'QuestionsEnteredController', [
           
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getQuestionEnteredById($id_tb_pertanyaan){
        
        $response = $this->_client->request('GET', 'QuestionsEnteredController', [
            'query' => [
                'id_tb_pertanyaan' => $id_tb_pertanyaan
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getAllUstadzsAnswered($id_tb_akun){

        $response = $this->_client->request('GET', 'QuestionsEnteredController/getAllUstadzsAnswered', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _postMyAnswer($post){
        
        $data = [
            'id_tb_pertanyaan' => $post['id_tb_pertanyaan'],
            'tb_jawaban_isi' => $post['tb_jawaban_isi'],
            'tb_jawaban_gambar' => 'default.jpg',
            'tb_jawaban_rating' => '0'
        ];

        $response = $this->_client->request('POST', 'QuestionsEnteredController', [
            'form_params' => $data
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