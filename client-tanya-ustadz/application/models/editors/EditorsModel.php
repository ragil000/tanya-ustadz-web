<?php
use GuzzleHttp\Client;

class EditorsModel extends CI_Model{

    private $_client;

    public function __construct(){

        $this->_client = new Client([
            'base_uri' => 'http://localhost/tanya-ustadz-web/server-tanya-ustadz/api/'
        ]);

    }

    public function _getAnswersReadyPublish($id_tb_penjawab = null){
        
        if($id_tb_penjawab === null){
            
            $response = $this->_client->request('GET', 'EditorsController', [
           
            ]);

        }else{

            $response = $this->_client->request('GET', 'EditorsController', [
                'query' => [
                    'id_tb_penjawab' => $id_tb_penjawab
                ]
            ]);

        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getPublishedAnswers($id_tb_penjawab = null){
        
        if($id_tb_penjawab === null){
            
            $response = $this->_client->request('GET', 'EditorsController/getPublishedAnswers', [
                'query' => [
                    'id_tb_akun' => $_SESSION['id_tb_akun'],

                ]
            ]);

        }else{

            $response = $this->_client->request('GET', 'EditorsController/getPublishedAnswers', [
                'query' => [
                    'id_tb_akun' => $_SESSION['id_tb_akun'],
                    'id_tb_penjawab' => $id_tb_penjawab

                ]
            ]);

        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _getQuestionEnteredById($id_tb_pertanyaan){
        
        $response = $this->_client->request('GET', 'EditorsController', [
            'query' => [
                'id_tb_pertanyaan' => $id_tb_pertanyaan
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

    public function _postPublishedAnswer($post){
        $time = time();

        $config['upload_path']          = './assets/img/post/';
        $config['allowed_types']        = 'jpg|png';
        $config['file_name']            = $time.'.jpg';
        $config['overwrite']			= true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('tb_jawaban_gambar')){
            $data = [
                'id_tb_akun' => $_SESSION['id_tb_akun'],
                'id_tb_pertanyaan' => $post['id_tb_pertanyaan'],
                'tb_pertanyaan_isi' => $post['tb_pertanyaan_isi'],
                'id_tb_jawaban' => $post['id_tb_jawaban'],
                'tb_jawaban_judul' => $post['tb_jawaban_judul'],
                'tb_jawaban_isi' => $post['tb_jawaban_isi'],
                'tb_jawaban_gambar' => 'default.jpg'
            ];
    
            $response = $this->_client->request('POST', 'EditorsController', [
                'form_params' => $data
            ]);
    
            $result = json_decode($response->getBody()->getContents(), true);
            
            if($result['status']){
                $response = $this->_client->request('POST', 'TextPreprocessingController', [
                    'form_params' => $data
                ]);
            }

            return $result;
        }else{
            $data = [
                'id_tb_akun' => $_SESSION['id_tb_akun'],
                'id_tb_pertanyaan' => $post['id_tb_pertanyaan'],
                'tb_pertanyaan_isi' => $post['tb_pertanyaan_isi'],
                'id_tb_jawaban' => $post['id_tb_jawaban'],
                'tb_jawaban_judul' => $post['tb_jawaban_judul'],
                'tb_jawaban_isi' => $post['tb_jawaban_isi'],
                'tb_jawaban_gambar' => $time.'.jpg'
            ];
    
            $response = $this->_client->request('POST', 'EditorsController', [
                'form_params' => $data
            ]);
    
            $result = json_decode($response->getBody()->getContents(), true);
            
            if($result['status']){
                $response = $this->_client->request('POST', 'TextPreprocessingController', [
                    'form_params' => $data
                ]);
            }

            return $result;
        }

    }

    public function _putPublishedAnswer(){
        $time = time();
        $config['upload_path']          = './assets/img/post/';
        $config['allowed_types']        = 'jpg|png';
        $config['file_name']            = $time.'.jpg';
        $config['overwrite']			= true;

        $this->load->library('upload', $config);

        if($_FILES['tb_jawaban_gambar']['name'] == null){
            
            $data = [
                'id_tb_pengedit' => $this->input->post('id_tb_pengedit', true),
                'id_tb_jawaban' => $this->input->post('id_tb_jawaban', true),
                'tb_jawaban_judul' => $this->input->post('tb_jawaban_judul', true),
                'tb_jawaban_isi' => $this->input->post('tb_jawaban_isi', true),
                'tb_jawaban_gambar' => $this->input->post('tb_jawaban_gambar_old', true)
            ];
    
            $response = $this->_client->request('PUT', 'EditorsController', [
                'form_params' => $data
            ]);
    
            $result = json_decode($response->getBody()->getContents(), true);
 
            return $result;

        }else{

            if (!$this->upload->do_upload('tb_jawaban_gambar')){
                
                $data = [
                    'id_tb_pengedit' => $this->input->post('id_tb_pengedit', true),
                    'id_tb_jawaban' => $this->input->post('id_tb_jawaban', true),
                    'tb_jawaban_judul' => $this->input->post('tb_jawaban_judul', true),
                    'tb_jawaban_isi' => $this->input->post('tb_jawaban_isi', true),
                    'tb_jawaban_gambar' => $this->input->post('tb_jawaban_gambar_old', true)
                ];
        
                $response = $this->_client->request('PUT', 'EditorsController', [
                    'form_params' => $data
                ]);
        
                $result = json_decode($response->getBody()->getContents(), true);
            
                return $result;

            }else{
                
                $data = [
                    'id_tb_pengedit' => $this->input->post('id_tb_pengedit', true),
                    'id_tb_jawaban' => $this->input->post('id_tb_jawaban', true),
                    'tb_jawaban_judul' => $this->input->post('tb_jawaban_judul', true),
                    'tb_jawaban_isi' => $this->input->post('tb_jawaban_isi', true),
                    'tb_jawaban_gambar' => $config['file_name']
                ];

                if($this->input->post('tb_jawaban_gambar_old', true) != 'default.jpg'){
                    if(file_exists($config['upload_path'].$this->input->post('tb_jawaban_gambar_old', true))){
                        unlink($config['upload_path'].''.$this->input->post('tb_jawaban_gambar_old', true));
                    }
                }
        
                $response = $this->_client->request('PUT', 'EditorsController', [
                    'form_params' => $data
                ]);
        
                $result = json_decode($response->getBody()->getContents(), true);
    
                return $result;

            }

        }

    }

    public function _deletePublishedAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null, $tb_jawaban_gambar = null){

        $config['upload_path']  = './assets/img/post/';

        $data = [
            'id_tb_pertanyaan' => $id_tb_pertanyaan,
            'id_tb_jawaban' => $id_tb_jawaban
        ];

        if($tb_jawaban_gambar != 'default.jpg'){
            if(file_exists($config['upload_path'].$tb_jawaban_gambar)){
                unlink($config['upload_path'].''.$tb_jawaban_gambar);
            }
        }
        
        $response = $this->_client->request('DELETE', 'EditorsController', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;

    }

}