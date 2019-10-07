<?php

class AccountModel extends CI_Model {

    public function getAccount($id = null) {

        if($id === null) {

            return $this->db->get('tb_akun')->result_array();
        
        }else {

            return $this->db->get_where('tb_akun', ['id_tb_akun' => $id])->result_array();

        }
    
    }

    public function postAccount($data = null) {

        if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_akun', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function deleteAccount($id = null) {

        if($id === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_akun', ['id_tb_akun' => $id]);
            return $this->db->affected_rows();
            
        }

    }

    public function putAccount($data = null, $id = null) {

        if($id === null || $data === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_akun', $data, ['id_tb_akun' => $id]);
            return $this->db->affected_rows();
            
        }

    }

}