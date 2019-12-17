<?php

class UstadzModel extends CI_Model {

    public function _getAllQuestionsEntered($id_tb_pertanyaan = null) {

        if($id_tb_pertanyaan === null) {

            $this->db->order_by("tb_pertanyaan_tgl", "DESC");
            return $this->db->get_where('tb_pertanyaan', ['tb_pertanyaan_level' => '1'])->result_array();
        
        }else if($id_tb_pertanyaan != null){

            return $this->db->get_where('tb_pertanyaan', ['id_tb_pertanyaan' => $id_tb_pertanyaan])->result_array();

        }
    
    }

    public function _getAllUstadzsAnswered($id_tb_akun = null){

        if($id_tb_akun === null) {
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by("tb_pertanyaan.tb_pertanyaan_level", "ASC");
            $this->db->order_by("tb_penjawab.id_tb_penjawab", "DESC");
            $this->db->order_by("tb_penjawab.tb_penjawab_tgl", "DESC");
            return $this->db->get('tb_penjawab')->result_array();
        
        }else if($id_tb_akun != null){
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by("tb_pertanyaan.tb_pertanyaan_level", "ASC");
            $this->db->order_by("tb_penjawab.id_tb_penjawab", "DESC");
            $this->db->order_by("tb_penjawab.tb_penjawab_tgl", "DESC");
            return $this->db->get_where('tb_penjawab', ['tb_penjawab.id_tb_akun' => $id_tb_akun])->result_array();
        
        }
        

    }

    public function _getUstadzsAnsweredById($id_tb_jawaban = null){

        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '2', 'tb_penjawab.id_tb_jawaban' => $id_tb_jawaban])->result_array();        

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

    public function _deleteMyAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null) {

        if($id_tb_pertanyaan == null && $id_tb_jawaban == null) {

            return $this->db->affected_rows();
        
        }else {

            $data = [
                'tb_pertanyaan_level' => '1'
            ];

            $this->db->update('tb_pertanyaan', $data, ['id_tb_pertanyaan' => $id_tb_pertanyaan]);
            $this->db->delete('tb_penjawab', ['id_tb_jawaban' => $id_tb_jawaban]);
            $this->db->delete('tb_jawaban', ['id_tb_jawaban' => $id_tb_jawaban]);
            return $this->db->affected_rows();
            
        }

    }

}