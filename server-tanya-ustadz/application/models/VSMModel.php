<?php

class VSMModel extends CI_Model {

    public function ceckTermData($tb_pertanyaan_isi_array) {

        $Q = json_decode($tb_pertanyaan_isi_array, true);
        $D = array();

        $datas = $this->db->get('tb_textpreprocessing')->result_array();
        foreach($datas as $data){
            $dataCeck = json_decode($data['tb_textpreprocessing_array'], true);

            $dataPush = array(
                'id_tb_pertanyaan' => $data['id_tb_pertanyaan'],
                'tb_textpreprocessing_array' => $data['tb_textpreprocessing_array'],
            );

            foreach($dataCeck as $indexD => $valueD){
                foreach($Q as $indexQ => $valueQ){
                    if($indexQ === $indexD){
                        // array_push($D, $dataPush);
                        break;
                    }
                }
                if($indexQ === $indexD){
                    array_push($D, $dataPush);
                    break;
                }
            }
        }

        $union = $this->unionArray($Q, $D);
        return $this->rumusOne($union, $D);
        // return $this->unionArray($Q, $D);
        // return $D;
    }

    public function unionArray($Q, $D) {

        $union = array();

        foreach($Q as $indexQ => $valueQ){
            foreach($D as $d){
                $data = json_decode($d['tb_textpreprocessing_array'], true);
                foreach($data as $indexD => $valueD){
                    if(array_key_exists($indexD, $union)){
                        if($indexQ === $indexD){
                            $union[$indexD] = $valueQ;
                        }
                    }else{
                        if($indexQ === $indexD){
                            $union[$indexD] = $valueQ;
                        }else{
                            $union[$indexD] = 0;
                        }
                    }
                }
            }

            if(!array_key_exists($indexQ, $union)){
                $union[$indexQ] = $valueQ;
            }
        }

        return $union;

    }

    public function rumusOne($union, $D){
        
        $QD = array();
        
        foreach($D as $d){
            $data = json_decode($d['tb_textpreprocessing_array'], true);
            $dataArray = array();
            $totalQD = 0;
            $RQD = 0;
            $similarity = 0;

            foreach($data as $indexD => $valueD){
                foreach($union as $indexU => $valueU){
                    $RQD = $this->rumusTwo($union, $data);
                    if($indexU === $indexD){
                        $dataArray[$indexD] = $valueU*$valueD;
                        break;
                    }else{
                        $dataArray[$indexD] = 0*$valueD;
                    }
                }
            }

            foreach($dataArray as $indexA => $valueA){
                $totalQD = $totalQD+$valueA;
            }
            $similarity = $this->similarity($totalQD, (float)$RQD);

            $this->load->model("QuestionModel");
            $dataQuestion = $this->QuestionModel->_getQuestionById($d['id_tb_pertanyaan']);

            $dataPush = array(
                'id_tb_pertanyaan' => $d['id_tb_pertanyaan'],
                'tb_textpreprocessing_array' => $dataArray,
                'tb_jawaban_gambar' => $dataQuestion[0]['tb_jawaban_gambar'],
                'tb_jawaban_judul' => $dataQuestion[0]['tb_jawaban_judul'],
                'tb_jawaban_isi' => $dataQuestion[0]['tb_jawaban_isi'],
                'tb_penjawab_tgl' => $dataQuestion[0]['tb_penjawab_tgl'],
                'id_tb_jawaban' => $dataQuestion[0]['id_tb_jawaban'],
                'tb_akun_detail_nama' => $dataQuestion[0]['tb_akun_detail_nama'],
                'QD' => $totalQD,
                'RQD' => $RQD,
                'similarity' => $similarity
            );

            array_push($QD, $dataPush);
            $totalQD = 0;
        }

        return $QD;

    }

    public function rumusTwo($union, $d){
        
        $RQ = 0;

        foreach($union as $indexU => $valueU){
            $RQ = $RQ + ($valueU*$valueU);
        }
        // $RQ = number_format(sqrt($RQ), 3);

        $RD = 0;
        foreach($d as $indexD => $valueD){
            $RD = $RD + ($valueD*$valueD);
        }
        // $RD = number_format(sqrt($RD), 3);

        return sqrt($RD*$RQ);

    }

    public function similarity($QD, $RQD){

        $similarity = $QD/$RQD;
        return number_format($similarity, 3);
    
    }

    // public function rumusTwoX($union, $D){
        
    //     $RQ = 0;
    //     $UD = array();

    //     foreach($union as $indexU => $valueU){

    //         $RQ = $RQ + ($valueU*$valueU);

    //     }
    //     $RQ = number_format(sqrt($RQ), 3);

    //     foreach($D as $d){
    //         $data = json_decode($d['tb_textpreprocessing_array'], true);
    //         $dataArray = array();
    //         $RD = 0;

    //         foreach($data as $indexD => $valueD){
    //             $dataArray[$indexD] = $valueD;
    //             $RD = $RD + ($valueD*$valueD);
    //         }
    //         $RD = number_format(sqrt($RD), 3);

    //         $dataPush = array(
    //             'id_tb_pertanyaan' => $d['id_tb_pertanyaan'],
    //             'tb_textpreprocessing_array' => $dataArray,
    //             'QD' => number_format($RD*$RQ, 3)
    //         );

    //         array_push($UD, $dataPush);
    //     }

    //     return $UD;

    // }

    public function coba(){
        $datas = $this->db->get('tb_textpreprocessing')->result_array();
        return $datas;
    }


}