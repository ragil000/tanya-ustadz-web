<?php
use GuzzleHttp\Client;

class UsersModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getMyQuestion($id_tb_akun = null){
        
        $response = $this->_client->request('GET', 'UsersController', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getSimilarityData($id_tb_akun = null){
        
        $response = $this->_client->request('GET', 'UsersController/getSimilarityData', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getMyQuestionAnswered($id_tb_akun = null){
        
        $response = $this->_client->request('GET', 'UsersController/getMyQuestionAnswered', [
            'query' => [
                'id_tb_akun' => $id_tb_akun
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _similarMyQuestion($id_tb_pertanyaan, $id_tb_penjawab){
        
        $data = [
            'id_tb_pertanyaan' => $id_tb_pertanyaan,
            'id_tb_penjawab' => $id_tb_penjawab
        ];

        $response = $this->_client->request('POST', 'UsersController/similarMyQuestion', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _postMyQuestion($post){
        
        $data = [
            'id_tb_akun' => $_SESSION['id_tb_akun'],
            'tb_pertanyaan_isi' => $post['tb_pertanyaan_isi'],
            'tb_pertanyaan_level' => '0',
        ];

        $response = $this->_client->request('POST', 'QuestionController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _deleteMyQuestion($id_tb_pertanyaan = null){

        $data = [
            'id_tb_pertanyaan' => $id_tb_pertanyaan
        ];
        
        $response = $this->_client->request('DELETE', 'UsersController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }
   
}