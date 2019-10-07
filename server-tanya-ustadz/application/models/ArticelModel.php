<?php

class ArticelModel extends CI_Model {

    public function getArticel($id = null) {

        if($id === null) {

            return $this->db->get('tb_artikel')->result_array();
        
        }else {

            return $this->db->get_where('tb_artikel', ['id_tb_artikel' => $id])->result_array();

        }
    
    }

    public function postArticel($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_artikel', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function deleteArticel($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_artikel', ['id_tb_artikel' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putArticel($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_artikel', $data, ['id_tb_artikel' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}