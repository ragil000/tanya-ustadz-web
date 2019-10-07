<?php

class MultyCategoryModel extends CI_Model {

    public function getMultyCategory($id = null) {

        if($id === null) {

            return $this->db->get('tb_multi_kategori')->result_array();
        
        }else {

            return $this->db->get_where('tb_multi_kategori', ['id_tb_multi_kategori' => $id])->result_array();

        }
    
    }

    public function postMultyCategory($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_multi_kategori', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function deleteMultyCategory($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_multi_kategori', ['id_tb_multi_kategori' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putMultyCategory($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_multi_kategori', $data, ['id_tb_multi_kategori' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}