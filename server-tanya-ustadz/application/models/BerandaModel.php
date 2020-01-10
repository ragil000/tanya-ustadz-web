<?php

class BerandaModel extends CI_Model {

    public function _getMyQuestion($id_tb_akun = null) {

        if($id_tb_akun === null) {
            return $this->db->get('tb_pertanyaan')->result_array();
        }else {
            return $this->db->get_where('tb_pertanyaan', ['id_tb_akun' => $id_tb_akun, 'tb_pertanyaan_level' => '0'])->result_array();
        }
    
    }

    public function _getBerandaTop() {

            $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
            $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
            $this->db->join('tb_pengedit', 'tb_pengedit.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
            $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
            return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '3'], 5)->result_array();
    
    }

    public function _getBerandaBottom() {

        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        $this->db->join('tb_pengedit', 'tb_pengedit.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
        $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
        $this->db->limit(100000000, 5);
        return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '3'])->result_array();

    }

    public function _getBerandaRight() {

        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        $this->db->join('tb_pengedit', 'tb_pengedit.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
        $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'ASC');
        return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '3'], 3)->result_array();

    }

    public function _getBerandaSearch($get) {

        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        $this->db->join('tb_pengedit', 'tb_pengedit.id_tb_jawaban = tb_jawaban.id_tb_jawaban');
        $this->db->or_like('tb_jawaban.tb_jawaban_judul', $get['query_search'], 'both');
        $this->db->or_like('tb_jawaban.tb_jawaban_isi', $get['query_search'], 'both');
        $this->db->or_like('tb_pertanyaan.tb_pertanyaan_isi', $get['query_search'], 'both');
        $this->db->order_by('tb_pengedit.tb_pengedit_tgl', 'DESC');
        return $this->db->get_where('tb_penjawab', ['tb_pertanyaan.tb_pertanyaan_level' => '3', ])->result_array();

    }

    public function _getSinglePost($id_tb_jawaban = null) {

        $this->db->join('tb_akun', 'tb_akun.id_tb_akun = tb_penjawab.id_tb_akun');
        $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
        $this->db->join('tb_jawaban', 'tb_jawaban.id_tb_jawaban = tb_penjawab.id_tb_jawaban');
        $this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_tb_pertanyaan = tb_jawaban.id_tb_pertanyaan');
        return $this->db->get_where('tb_penjawab', ['tb_jawaban.id_tb_jawaban' => $id_tb_jawaban])->result_array();
    
    }

    public function _getDetailUstadz($id_tb_akun_detail = null) {

        if($id_tb_akun_detail === null) {

            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            $this->db->order_by("tb_akun_tgl", "DESC");
            return $this->db->get('tb_akun')->result_array();
        
        }else if($id_tb_akun_detail != null){

            $this->db->join('tb_akun_detail', 'tb_akun.id_tb_akun = tb_akun_detail.id_tb_akun');
            return $this->db->get_where('tb_akun', ['tb_akun_detail.id_tb_akun_detail' => $id_tb_akun_detail])->result_array();

        }
    
    }

}