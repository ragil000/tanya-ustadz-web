<?php

class EditorsModel extends CI_Model {

    public function _getAnswersReadyPublish($id_tb_penjawab = null) {

        if($id_tb_penjawab === null) {

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by('tb_penjawab.tb_penjawab_tgl', 'DESC');
            $this->db->order_by('tb_penjawab.id_tb_penjawab', 'DESC');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '2'])->result_array();
        
        }else if($id_tb_penjawab != null){

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            // $this->db->order_by('tb_penjawab.tb_penjawab_tgl', 'DESC');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '2', 'id_tb_penjawab' => $id_tb_penjawab])->result_array();

        }
    
    }

    public function _getPublishedAnswers($id_tb_akun = null, $id_tb_penjawab = null) {

        if($id_tb_akun == null && $id_tb_penjawab == null) {

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_pengedit.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_pengedit.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->join('tb_penjawab', 'tb_penjawab.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
            $this->db->order_by('tb_pengedit.id_tb_pengedit', 'DESC');
            return $this->db->get_where('tb_pengedit', ['tb_pertanyaan.tb_pertanyaan_level' => '3'])->result_array();
        
        }else if($id_tb_akun != null && $id_tb_penjawab == null){

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_pengedit.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_pengedit.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->join('tb_penjawab', 'tb_penjawab.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
            $this->db->order_by('tb_pengedit.id_tb_pengedit', 'DESC');
            return $this->db->get_where('tb_pengedit', ['tb_pertanyaan.tb_pertanyaan_level' => '3', 'tb_pengedit.id_tb_akun' => $id_tb_akun])->result_array();

        }else if($id_tb_akun != null && $id_tb_penjawab != null){

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_pengedit.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_pengedit.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->join('tb_penjawab', 'tb_penjawab.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            // $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
            return $this->db->get_where('tb_pengedit', ['tb_pertanyaan.tb_pertanyaan_level' => '3', 'tb_penjawab.id_tb_penjawab' => $id_tb_penjawab])->result_array();

        }
    
    }

    public function _getAllUstadzsAnswered($id_tb_akun = null){

        if($id_tb_akun === null) {
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by('tb_penjawab.tb_penjawab_tgl', 'DESC');
            $this->db->order_by('tb_penjawab.id_tb_penjawab', 'DESC');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '2'])->result_array();
        
        }else if($id_tb_akun != null){
            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->order_by('tb_penjawab.tb_penjawab_tgl', 'DESC');
            $this->db->order_by('tb_penjawab.id_tb_penjawab', 'DESC');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '2', 'tb_penjawab.id_tb_akun' => $id_tb_akun])->result_array();
        
        }
        

    }

    public function _postPublishedAnswer($data = null, $data2 = null, $data3 = null) {

       if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_pengedit', $data);

            $this->db->update('tb_jawaban', $data2, ['id_tb_jawaban' => $data3['id_tb_jawaban']]);

            $this->db->update('tb_pertanyaan', ['tb_pertanyaan_level' => '3'], ['id_tb_pertanyaan' => $data3['id_tb_pertanyaan']]);

            return $this->db->affected_rows();
       }
        
    }

    public function _putPublishedAnswer($data = null, $dataID = null) {

        if($data === null || $dataID === null) {

            return $this->db->affected_rows();
        
        }else {

            $this->db->update('tb_jawaban', $data, ['id_tb_jawaban' => $dataID['id_tb_jawaban']]);
            $this->db->update('tb_pengedit', ['tb_pengedit_tgl' => $dataID['tb_pengedit_tgl']], ['id_tb_pengedit' => $dataID['id_tb_pengedit']]);
            return $this->db->affected_rows();
            
        }

    }

    public function _deletePublishedAnswer($id_tb_pertanyaan = null, $id_tb_jawaban = null) {

        if($id_tb_pertanyaan == null && $id_tb_jawaban == null) {
    
            return $this->db->affected_rows();
        
        }else {

            $data = [
                'tb_pertanyaan_level' => '2'
            ];

            $data2 = [
                'tb_jawaban_judul' => '',
                'tb_jawaban_gambar' => 'default.jpg'
            ];

            $this->db->update('tb_pertanyaan', $data, ['id_tb_pertanyaan' => $id_tb_pertanyaan]);
            $this->db->update('tb_jawaban', $data2, ['id_tb_jawaban' => $id_tb_jawaban]);
            $this->db->delete('tb_pengedit', ['id_tb_jawaban' => $id_tb_jawaban]);
            $this->db->delete('tb_textpreprocessing', ['id_tb_pertanyaan' => $id_tb_pertanyaan]);
            return $this->db->affected_rows();
            
        }

    }

}