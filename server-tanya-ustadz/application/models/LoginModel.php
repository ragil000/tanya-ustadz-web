<?php

class LoginModel extends CI_Model {

    public function getLogin($get = null) {

        $usernameCek = $this->db->get_where('tb_akun', ['tb_akun_username' => $get['tb_akun_username']])->num_rows();
        $passwordCek = $this->db->get_where('tb_akun', ['tb_akun_password' => md5($get['tb_akun_password'])])->num_rows();

        $result['status'] = false;
        $result['message'] = null;
        $result['data'] = null;

        if($usernameCek > 0 && $passwordCek > 0) {
            
            $result['status'] = true;
            $result['message'] = 'Berhasil masuk';
            $result['data'] = $this->db->get_where('tb_akun', ['tb_akun_password' => md5($get['tb_akun_password'])])->result_array();

        }else if($usernameCek <= 0 && $passwordCek > 0) {
            
            $result['message'] = 'Username salah';

        }else if($usernameCek > 0 && $passwordCek <= 0) {
            
            $result['message'] = 'Password salah';

        }else if($usernameCek <= 0 && $passwordCek <= 0) {
            
            $result['message'] = 'Username & Password salah';

        }

        return $result;
    
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