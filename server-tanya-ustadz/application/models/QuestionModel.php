<?php

class QuestionModel extends CI_Model {

    public function getQuestion($id = null) {

        if($id === null) {

            return $this->db->get('tb_pertanyaan')->result_array();
        
        }else {

            return $this->db->get_where('tb_pertanyaan', ['id_tb_pertanyaan' => $id])->result_array();

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