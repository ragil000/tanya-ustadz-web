<?php

class LibraryRMYModel extends CI_Model {

    public $data;
    public function __construct(){
        parent::__construct();

        $this->data['berandaActive'] = '';
        $this->data['pertanyaanSayaActive'] = '';
        $this->data['pertanyaanMasukActive'] = '';
        $this->data['jawabanSayaActive'] = '';
    }

    public function _dateIND($date){
        $bulan = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $hari = array(
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jum\'at',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Ahad'
        );

        $split = explode('-', $date);
        $indexHari = date('l', strtotime($date));

        return $hari[$indexHari].', '.$split[2].' '.$bulan[$split[1]].' '.$split[0];
    }

    public function _splitText($string, $limit = 100) {

        $string = strip_tags($string);
        if (strlen($string) > $limit) {

            // truncate string
            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;

    }

    public function _rangking(){
        $numbers = array( 101.5, 201.1, 301.3, 391.3, 403.1, 401.3, 301, 501, 601, 501, 701);
        rsort($numbers);

        $arrlength = count($numbers);
        $rank = 1;
        $prev_rank = $rank;

        for($x = 0; $x < $arrlength; $x++) {

            if ($x==0) {
                echo $numbers[$x]."- Rank".($rank);
            }

        elseif ($numbers[$x] != $numbers[$x-1]) {
                $rank++;
                $prev_rank = $rank;
                echo $numbers[$x]."- Rank".($rank);
        }

        else{
                $rank++;
                echo $numbers[$x]."- Rank".($prev_rank);
            }

        echo "<br>";
        }
    }

    public function coba(){
        echo "<script>alert('berhasil');</script>";
    }

}