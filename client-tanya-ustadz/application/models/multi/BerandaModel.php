<?php
use GuzzleHttp\Client;

class BerandaModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getBerandaTop(){
        
        $response = $this->_client->request('GET', 'BerandaController/getBerandaTop', [
        
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getBerandaBottom(){
        
        $response = $this->_client->request('GET', 'BerandaController/getBerandaBottom', [
        
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getBerandaRight(){
        
        $response = $this->_client->request('GET', 'BerandaController/getBerandaRight', [
        
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getBerandaSearch($post){
        
        $response = $this->_client->request('GET', 'BerandaController/getBerandaSearch', [
            'query' => [
                'query_search' => $post['query_search']
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getSinglePost($id_tb_jawaban = null){
        
        $response = $this->_client->request('GET', 'BerandaController', [
            'query' => [
                'id_tb_jawaban' => $id_tb_jawaban
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getDetailUstadz($id_tb_akun_detail){
        
        $response = $this->_client->request('GET', 'BerandaController/getDetailUstadz', [
            'query' => [
                'id_tb_akun_detail' => $id_tb_akun_detail
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}