<?php

class LoginModel extends CI_Model {

    public function _getLogin($get = null) {

        $this->db->where('tb_akun_level !=', '4');
        $usernameCek = $this->db->get_where('tb_akun', ['tb_akun_username' => $get['tb_akun_username']])->num_rows();

        $this->db->where('tb_akun_level !=', '4');
        $passwordCek = $this->db->get_where('tb_akun', ['tb_akun_password' => md5($get['tb_akun_password'])])->num_rows();

        $result['status'] = false;
        $result['message'] = null;
        $result['data'] = null;

        if($usernameCek > 0 && $passwordCek > 0) {
            
            $result['status'] = true;
            $result['message'] = 'Berhasil masuk';

            $this->db->where('tb_akun_level !=', '4');
            $result['data'] = $this->db->get_where('tb_akun', ['tb_akun_username' => $get['tb_akun_username'], 'tb_akun_password' => md5($get['tb_akun_password'])])->result_array();

        }else if($usernameCek <= 0 && $passwordCek > 0) {
            
            $result['message'] = 'Username salah';

        }else if($usernameCek > 0 && $passwordCek <= 0) {
            
            $result['message'] = 'Password salah';

        }else if($usernameCek <= 0 && $passwordCek <= 0) {
            
            $result['message'] = 'Username & Password salah';

        }

        return $result;
    
    }

    public function _getAllAccount(){
        return $this->db->get('tb_akun')->result_array();
    }

    public function _postLogin($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_akun', $data);
            return $this->db->affected_rows();
       }
        
    }

}