<?php

class CategoryModel extends CI_Model {

    public function getCategory($id = null) {

        if($id === null) {

            return $this->db->get('tb_kategori')->result_array();
        
        }else {

            return $this->db->get_where('tb_kategori', ['id_tb_kategori' => $id])->result_array();

        }
    
    }

    public function postCategory($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_kategori', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function deleteCategory($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_kategori', ['id_tb_kategori' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putCategory($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_kategori', $data, ['id_tb_kategori' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}