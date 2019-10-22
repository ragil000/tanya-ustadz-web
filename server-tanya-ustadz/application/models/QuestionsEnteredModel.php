<?php

class QuestionsEnteredModel extends CI_Model {

    public function getAllQuestionsEntered($id_tb_pertanyaan = null) {

        if($id_tb_pertanyaan === null) {

            return $this->db->get_where('tb_pertanyaan', ['tb_pertanyaan_level' => '0'])->result_array();
        
        }else if($id_tb_pertanyaan != null){

            return $this->db->get_where('tb_pertanyaan', ['tb_pertanyaan_level' => '0', 'id_tb_pertanyaan' => $id_tb_pertanyaan])->result_array();

        }
    
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