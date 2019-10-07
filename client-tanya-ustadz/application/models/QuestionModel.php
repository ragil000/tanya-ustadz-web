<?php
use GuzzleHttp\Client;

class QuestionModel extends CI_Model{

    public function getQuestion(){
        
        $client = new Client();

        $response = $client->request('GET', 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/QuestionController');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}