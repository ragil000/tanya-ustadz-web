<?php

class DetailAccountModel extends CI_Model {

    public function getDetailAccount($id = null) {

        if($id === null) {

            return $this->db->get('tb_akun_detail')->result_array();
        
        }else {

            return $this->db->get_where('tb_akun_detail', ['id_tb_akun_detail' => $id])->result_array();

        }
    
    }

    public function postDetailAccount($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_akun_detail', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function deleteDetailAccount($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_akun_detail', ['id_tb_akun_detail' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putDetailAccount($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_akun_detail', $data, ['id_tb_akun_detail' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}