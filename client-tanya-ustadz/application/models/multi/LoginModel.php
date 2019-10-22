<?php
use GuzzleHttp\Client;

class LoginModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _setLogin($post){
        
        if($post != null){
            $response = $this->_client->request('GET', 'LoginController', [
                'query' => [
                    'tb_akun_username' => $post['tb_akun_username'],
                    'tb_akun_password' => $post['tb_akun_password']
                ]
            ]);
    
            $result = json_decode($response->getBody()->getContents(), true);
    
            return $result;
        }else {

            return null;
        
        }

    }

}