<?php
use GuzzleHttp\Client;

class SuperModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getAllAccount($tb_akun_username){
        
        $response = $this->_client->request('GET', 'SuperController', [
            'query' => [
                'tb_akun_username' => $tb_akun_username
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getAllNonactiveAccount(){
        
        $response = $this->_client->request('GET', 'SuperController/getAllNonactiveAccount', [
            
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _postAccount(){
        
        $data = [
            'tb_akun_username' => $this->input->post('tb_akun_username', true),
            'tb_akun_password' => md5($this->input->post('tb_akun_password', true)),
            'tb_akun_level' => $this->input->post('tb_akun_level', true),
        ];

        $response = $this->_client->request('POST', 'SuperController', [
            'form_params' => $data
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

        $response = $this->_client->request('POST', 'SuperController', [
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

        $response = $this->_client->request('PUT', 'SuperController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _deleteAccount($id_tb_akun){

        $data = [
            'id_tb_akun' => $id_tb_akun,
        ];
        
        $response = $this->_client->request('DELETE', 'SuperController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}