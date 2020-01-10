<?php

class SuperModel extends CI_Model {

    public function _getAllAccount($id_tb_akun = null, $tb_akun_username = null) {

        if($id_tb_akun === null) {

            // $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->where('tb_akun_level !=', '4');
            $this->db->where('tb_akun_username !=', $tb_akun_username);
            $this->db->order_by("tb_akun_tgl", "DESC");
            $this->db->order_by("tb_akun_level", "DESC");
            return $this->db->get('tb_akun')->result_array();
        
        }else if($id_tb_akun != null){

            // $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->order_by("tb_akun_level", "DESC");
            return $this->db->get_where('tb_akun', ['tb_akun.id_tb_akun' => $id_tb_akun])->result_array();

        }
    
    }

    public function _getAllNonactiveAccount() {

        $this->db->where('tb_akun_level =', '4');
        $this->db->order_by("tb_akun_tgl", "DESC");
        return $this->db->get('tb_akun')->result_array();
    
    }

    public function _postAccount($data = null) {

        if($data === null) {
             return $this->db->affected_rows();
        }else {
             $this->db->insert('tb_akun', $data);
             return $this->db->affected_rows();
        }
         
    }

    public function _postMyAnswer($data = null, $id_tb_akun = null) {

       if($data === null && $id_tb_akun === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_jawaban', $data);
            $id_tb_jawaban = $this->db->insert_id();

            $dataP = [
                'tb_pertanyaan_level' => '2',
            ];

            $this->db->update('tb_pertanyaan', $dataP, ['id_tb_pertanyaan' => $data['id_tb_pertanyaan']]);

            $dataJ = [
                'id_tb_akun' => $id_tb_akun,
                'id_tb_jawaban' => $id_tb_jawaban,
                'tb_penjawab_tgl' => date('Y-m-d'),
            ];

            $this->db->insert('tb_penjawab', $dataJ);

            return $this->db->affected_rows();
       }
        
    }

    public function _putMyAnswer($data = null, $id_tb_jawaban = null) {

        if($id_tb_jawaban === null || $data === null) {

            return $this->db->affected_rows();
           
        }else {

            $this->db->update('tb_jawaban', $data, ['id_tb_jawaban' => $id_tb_jawaban]);
            return $this->db->affected_rows();
            
        }

    }

    public function _deleteAccount($id_tb_akun = null) {

        if($id_tb_akun == null) {

            return $this->db->affected_rows();
        
        }else {

            $data = [
                'tb_akun_level' => '4'
            ];

            $this->db->update('tb_akun', $data, ['id_tb_akun' => $id_tb_akun]);
            return $this->db->affected_rows();
            
        }

    }

}