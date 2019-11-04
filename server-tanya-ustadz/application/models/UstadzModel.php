<?php

class UstadzModel extends CI_Model {

    public function _getAllQuestionsEntered($id_tb_pertanyaan = null) {

        if($id_tb_pertanyaan === null) {

            return $this->db->get_where('tb_pertanyaan', ['tb_pertanyaan_level' => '0'])->result_array();
        
        }else if($id_tb_pertanyaan != null){

            return $this->db->get_where('tb_pertanyaan', ['tb_pertanyaan_level' => '0', 'id_tb_pertanyaan' => $id_tb_pertanyaan])->result_array();

        }
    
    }

    public function _getAllUstadzsAnswered($id_tb_akun = null){

        if($id_tb_akun === null) {
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun', 'left');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban', 'left');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan', 'left');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '1'])->result_array();
        
        }else if($id_tb_akun != null){
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun', 'left');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban', 'left');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan', 'left');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '1', 'tb_penjawab.id_tb_akun' => $id_tb_akun])->result_array();
        
        }
        

    }

    public function _postAnswer($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_jawaban', $data);
            $id_tb_jawaban = $this->db->insert_id();

            $dataP = [
                'tb_pertanyaan_level' => '1',
            ];

            $this->db->update('tb_pertanyaan', $dataP, ['id_tb_pertanyaan' => $data['id_tb_pertanyaan']]);

            $dataJ = [
                'id_tb_akun' => 17,
                'id_tb_jawaban' => $id_tb_jawaban,
                'tb_penjawab_tgl' => date('Y-m-d'),
            ];

            $this->db->insert('tb_penjawab', $dataJ);

            return $this->db->affected_rows();
       }
        
    }

    public function deleteQuestion($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_pertanyaan', ['id_tb_pertanyaan' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putQuestion($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_pertanyaan', $data, ['id_tb_pertanyaan' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}