<?php

class UsersModel extends CI_Model {

    public function _getMyQuestion($id_tb_akun = null) {

        if($id_tb_akun === null) {
            return $this->db->get('tb_pertanyaan')->result_array();
        }else {
            $tb_pertanyaan_level = [0, 1];

            $this->db->order_by("tb_pertanyaan_level", "ASC");
            $this->db->where_in('tb_pertanyaan_level', $tb_pertanyaan_level);
            return $this->db->get_where('tb_pertanyaan', ['id_tb_akun' => $id_tb_akun], 1)->result_array();
        }
    
    }

    public function _getMyQuestionAnswered($id_tb_akun = null) {

        if($id_tb_akun === null) {
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by("tb_pertanyaan.tb_pertanyaan_level", "ASC");
            return $this->db->get('tb_penjawab')->result_array();
        }else {
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by("tb_pertanyaan.tb_pertanyaan_level", "ASC");
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.id_tb_akun' => $id_tb_akun])->result_array();
        }
    
    }

    public function _getSimilarityData($id_tb_akun = null) {

        if($id_tb_akun === null) {
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_similarity.id_tb_pertanyaan');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_pertanyaan = tb_pertanyaan.id_tb_pertanyaan');
            $this->db->join('tb_penjawab', 'tb_penjawab.id_tb_penjawab = tb_similarity.id_tb_penjawab AND tb_penjawab.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_pertanyaan.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->order_by("tb_penjawab.tb_penjawab_tgl", "DESC");
            return $this->db->get('tb_similarity')->result_array();
        }else {
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_similarity.id_tb_pertanyaan');
            $this->db->join('tb_penjawab', 'tb_penjawab.id_tb_penjawab = tb_similarity.id_tb_penjawab');
            $this->db->join('tb_jawaban', 'tb_penjawab.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_pertanyaan.id_tb_akun');
            // $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->order_by("tb_penjawab.tb_penjawab_tgl", "DESC");
            return $this->db->get_where('tb_similarity', ['tb_pertanyaan.id_tb_akun' => $id_tb_akun])->result_array();
        }
    
    }

    public function _postQuestion($data = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_pertanyaan', $data);
            return $this->db->affected_rows();
       }
        
    }

    public function _similarMyQuestion($data = null) {

        if($data === null) {
             return $this->db->affected_rows();
        }else {
            if($data['id_tb_penjawab'] == null){
                $this->db->update('tb_pertanyaan', ['tb_pertanyaan_level' => '1'], ['id_tb_pertanyaan' => $data['id_tb_pertanyaan']]);
            }else{
                $this->db->insert('tb_similarity', $data);
                $this->db->update('tb_pertanyaan', ['tb_pertanyaan_level' => '4'], ['id_tb_pertanyaan' => $data['id_tb_pertanyaan']]);
            }
            return $this->db->affected_rows();
        }
         
     }

    public function _deleteMyQuestion($id_tb_pertanyaan = null) {

        if($id_tb_pertanyaan === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->delete('tb_pertanyaan', ['id_tb_pertanyaan' => $id_tb_pertanyaan]);
            return $this->db->affected_rows();
            
        }

    }

}