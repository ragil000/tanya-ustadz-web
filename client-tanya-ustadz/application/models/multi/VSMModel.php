<?php
use GuzzleHttp\Client;

class VSMModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getVSM($tb_pertanyaan_isi = null){
        
        $response = $this->_client->request('GET', 'VSMController', [
            'query' => [
                'tb_pertanyaan_isi' => $tb_pertanyaan_isi
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}