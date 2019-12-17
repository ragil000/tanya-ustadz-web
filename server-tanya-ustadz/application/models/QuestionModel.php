<?php

class QuestionModel extends CI_Model {

    public function getQuestion($id_tb_pertanyaan = null, $id_tb_akun = null) {

        if($id_tb_pertanyaan === null && $id_tb_akun === null) {

            return $this->db->get('tb_pertanyaan');
        
        }else if($id_tb_pertanyaan != null && $id_tb_akun != null){

            return $this->db->get_where('tb_pertanyaan', ['id_tb_pertanyaan' => $id_tb_pertanyaan, 'id_tb_akun' => $id_tb_akun])->result_array();

        }else if($id_tb_pertanyaan != null && $id_tb_akun === null){

            return $this->db->get_where('tb_pertanyaan', ['id_tb_pertanyaan' => $id_tb_pertanyaan])->result_array();

        }else if($id_tb_pertanyaan === null && $id_tb_akun != null){

            return $this->db->get_where('tb_pertanyaan', ['id_tb_akun' => $id_tb_akun])->result_array();

        }
    
    }

    public function _getQuestionById($id_tb_pertanyaan = null){
        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        $this->db->join('tb_pengedit', 'tb_pengedit.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
        $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
        return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.id_tb_pertanyaan' => $id_tb_pertanyaan])->result_array();
    }

    public function postQuestion($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_pertanyaan', $data);
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