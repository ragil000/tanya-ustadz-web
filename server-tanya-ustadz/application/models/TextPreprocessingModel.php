<?php

class TextPreprocessingModel extends CI_Model {

    public function caseFolding($pertanyaan = null){

        $caseFolding = strtolower($pertanyaan);

        return $caseFolding;

    }

    public function cleaningData($caseFolding = null){
        $cleaningData = $caseFolding;
        $caracter = array (
                            '`', '~', '!', '@', '#', '$',
                            '%', '^', '&', '*', '(', ')',
                            '-', '_', '=', '+', '\\', '|',
                            '[', ']', '{', '}', ';', ':',
                            '\'', '"', ',', '<', '.', '>',
                            '/', '?', '1', '2', '3', '4',
                            '5', '6', '7', '8', '9', '0'
                        );     
                      
        foreach ($caracter as $i => $value) {
            $cleaningData = str_replace($value, '', $cleaningData);
        }

        return $cleaningData;

    }

    public function tokenizing($cleaningData = null){

        $tokenizing = array();
        $words = preg_split("/[\s,.:]+/", $cleaningData);

        foreach($words as $key => $value) {
            
            $tokenizing[$key] = $value;

        }

        return $tokenizing;

    }

    public function filtering($tokenizing = array()){
        
        $filtering = $tokenizing;
        // Array Stop words
        $commonWords = array(
                                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                                'a', 'about', 'adalah', 'after', 'agak', 'agar', 'akan',
                                'akibat', 'akibatnya', 'all', 'also', 'amatlah', 'an',
                                'and', 'another', 'antara', 'any', 'apa', 'apa', 'apabila',
                                'apakah', 'apalagi', 'are', 'as', 'at', 'atau', 'b', 'bagai',
                                'bagai', 'bagaikan', 'bagaimana', 'bagi', 'bahkan', 'bahwa',
                                'bahwa', 'be', 'because', 'been', 'before', 'beginian', 'begitu',
                                'being', 'belum', 'berdatangan', 'berlainan', 'bersama', 'betulkah',
                                'between', 'biar', 'biarpun', 'bila', 'bilamana', 'bolehkah', 'both',
                                'but', 'by', 'c', 'came', 'can', 'caranya', 'come', 'contoh',
                                'could', 'd', 'dalam', 'dan', 'semenjak', 'sementara', 'semisal',
                                'sepanjang', 'sepantasnyalah', 'seperti', 'sering', 'serta', 'sesudah',
                                'setelah', 'should', 'since', 'so', 'some', 'still', 'such', 'sudah',
                                'sudah', 'supaya', 't', 'take', 'tanpa', 'tapi', 'telah', 'telah',
                                'tentang', 'tentang', 'terhadap', 'terlalu', 'tersebut', 'tersebutlah',
                                'terus', 'tetapi', 'than', 'that', 'the', 'their', 'them', 'then',
                                'there', 'these', 'they', 'this', 'those', 'through', 'to', 'too', 'u',
                                'umpama', 'under', 'untuk', 'up', 'use', 'v', 'very', 'w', 'walau',
                                'walaupun', 'want', 'was', 'way', 'we', 'well', 'were', 'what', 'when',
                                'where', 'which', 'while', 'who', 'will', 'with', 'would', 'x', 'y',
                                'yaitu', 'yakni', 'you', 'your', 'z', 'ada', 'adalah', 'adanya', 'adapun',
                                'agaknya', 'agar', 'akan', 'akankah', 'akhir', 'akhiri', 'akhirnya', 'aku', 'akulah',
                                'amat', 'anda', 'andalah', 'antar', 'antara', 'antaranya', 'apaan', 'apabila', 'apakah',
                                'apalagi', 'apatah', 'artinya', 'asal', 'asalkan', 'atas', 'atau', 'ataukah',
                                'ataupun', 'awal', 'awalnya', 'bagaikan', 'bagaimana', 'bagaimanakah', 'bagaimanapun',
                                'bagi', 'bagian', 'bahkan', 'bahwasanya', 'baik', 'bakal', 'bakalan', 'balik',
                                'banyak', 'bapak', 'baru', 'bawah', 'beberapa', 'begini', 'beginikah', 'beginilah',
                                'begitu', 'begitukah', 'begitulah', 'begitupun', 'bekerja', 'belakang', 'belakangan',
                                'belum', 'belumlah', 'benar', 'benarkah', 'benarlah', 'berada', 'berakhir',
                                'berakhirlah', 'berakhirnya', 'berapa', 'berapakah', 'berapalah', 'berapapun',
                                'berarti', 'berawal', 'berbagai', 'beri', 'berikan', 'berikut', 'berikutnya',
                                'berjumlah', 'berkali-kali', 'berkata', 'berkehendak', 'berkeinginan', 'berkenaan',
                                'berlalu', 'berlangsung', 'berlebihan', 'bermacam', 'bermacam-macam', 'bermaksud', 'bermula',
                                'bersama', 'bersama-sama', 'bersiap', 'bersiap-siap', 'bertanya', 'bertanya-tanya',
                                'berturut', 'berturut-', 'bertutur', 'berujar', 'berupa', 'besar', 'betul', 'biasa',
                                'biasanya', 'bila', 'bilakah', 'bisa', 'bisakah', 'boleh', 'bolehlah', 'buat', 'bukan',
                                'bukankah', 'bukanlah', 'bukannya', 'bulan', 'bung', 'cara', 'cukup', 'cukupkah', 'cukuplah',
                                'cuma', 'dahulu', 'dalam', 'dan', 'dapat', 'dari', 'datang', 'dekat', 'demi', 'demikian',
                                'demikianlah', 'dengan', 'depan', 'di', 'dia', 'diakhiri', 'diakhirinya', 'dialah', 'diantara',
                                'diantaranya', 'diberi', 'diberikan', 'diberikannya', 'dibuat', 'dibuatnya', 'didapat',
                                'didatangkan', 'digunakan', 'diibaratkan', 'diibaratkannya', 'diingat', 'diingatkan',
                                'diinginkan', 'dijawab', 'dijelaskan', 'dijelaskannya', 'dikatakan', 'dikatakannya',
                                'dikerjakan', 'diketahui', 'diketahuinya', 'dikira', 'dilakukan', 'dilalui', 'dilihat',
                                'dimaksud', 'dimaksudkan', 'dimaksudkannya', 'dimaksudnya', 'diminta', 'dimintai', 'dimisalkan',
                                'dimulai', 'dimulailah', 'dimulainya', 'dini', 'dipastikan', 'diperbuat', 'diperbuatnya',
                                'dipergunakan', 'diperkirakan', 'diperlihatkan', 'diperlukannya', 'dipersoalkan', 'dipertanyakan',
                                'dipunyai', 'diri', 'disampaikan', 'disebut', 'disebutkan', 'disebutkannya', 'disini', 'disinilah',
                                'ditambahkan', 'ditandaskan', 'ditanya', 'ditanyai', 'ditanyakan', 'ditegaskan', 'ditujukan',
                                'ditunjuk', 'ditunjuki', 'ditunjukkan', 'ditunjukkannya', 'ditunjuknya', 'dituturkan',
                                'dituturkannya', 'diucapkan', 'diucapkannya', 'diungkapkan', 'dong', 'dua', 'dulu', 'empat',
                                'enggak', 'enggaknya', 'entah', 'entahlah', 'guna', 'gunakan', 'hal', 'hampir', 'hanya', 'hari',
                                'harus', 'haruslah', 'harusnya', 'hendak', 'hendaklah', 'hingga', 'ia', 'ialah', 'ibarat',
                                'ibaratkan', 'ibaratnya', 'ibu', 'if', 'ikut', 'ingat', 'ingat-ingat', 'ingin', 'inginkah',
                                'inginkan', 'ini', 'inikah', 'inilah', 'itu', 'itukah', 'itulah', 'jadi', 'jadilah', 'jadinya',
                                'jangan', 'jangankan', 'janganlah', 'jauh', 'jawab', 'jawaban', 'jawabnya', 'jelas', 'jelaskan',
                                'jelaslah', 'jelasnya', 'jika', 'juga', 'jumlah', 'jumlahnya', 'justru', 'kala', 'kalau',
                                'kalaulah', 'kalaupun', 'kalian', 'kami', 'kamilah', 'kamu', 'kamulah', 'kan', 'kapan',
                                'kapankah', 'kapanpun', 'kasus', 'kata', 'katakan', 'katakanlah', 'katanya', 'ke', 'keadaan',
                                'kebetulan', 'kecil', 'kedua', 'keduanya', 'keinginan', 'kelamaan', 'kelihatan', 'kelihatannya',
                                'kelima', 'keluar', 'kembali', 'kemudian', 'kemungkinan', 'kemungkinannya', 'kepada', 'kepadanya',
                                'kesampaian', 'keseluruhan', 'keseluruhannya', 'keterlaluan', 'ketika', 'khususnya', 'kini',
                                'kinilah', 'kira', 'kira-kira', 'kiranya', 'kita', 'kitalah', 'kurang', 'lagi', 'lagian',
                                'lah', 'lain', 'lainnya', 'lalu', 'lama', 'lamanya', 'lanjut', 'lanjutnya', 'lebih', 'lewat',
                                'lima', 'luar', 'macam', 'maka', 'makanya', 'makin', 'malah', 'malahan', 'mampu', 'mana', 'manakala',
                                'manalagi', 'masa', 'masalah', 'masalahnya', 'masih', 'masihkah', 'masing', 'masing-masing', 'mau',
                                'maupun', 'melainkan', 'melakukan', 'melalui', 'melihat', 'melihatnya', 'memang', 'memastikan',
                                'memberi', 'memberikan', 'membuat', 'memerlukan', 'memihak', 'meminta', 'memintakan', 'memisalkan',
                                'memperbuat', 'mempergunakan', 'memperkirakan', 'memperlihatkan', 'mempersiapkan',
                                'mempersoalkan', 'mempertanyakan', 'mempunyai', 'memulai', 'memungkinkan', 'menaiki',
                                'menambahkan', 'menandaskan', 'menanti', 'menantikan', 'menanti-nanti', 'menanya',
                                'menanyai', 'menanyakan', 'mendapat', 'mendapatkan', 'mendatang', 'mendatangi',
                                'mendatangkan', 'menegaskan', 'mengakhiri', 'mengapa', 'mengatakan', 'mengatakannya',
                                'mengenai', 'mengerjakan', 'mengetahui', 'menggunakan', 'menghendaki', 'mengibaratkan',
                                'mengibaratkannya', 'mengingat', 'mengingatkan', 'menginginkan', 'mengira', 'mengucapkan',
                                'mengucapkannya', 'mengungkapkan', 'menjadi', 'menjawab', 'menjelaskan', 'menuju',
                                'menunjuk', 'menunjuki', 'menunjukkan', 'menunjuknya', 'menurut', 'menuturkan',
                                'menyampaikan', 'menyangkut', 'menyatakan', 'menyebutkan', 'menyeluruh', 'menyiapkan',
                                'merasa', 'mereka', 'merekalah', 'merupakan', 'meski', 'meskipun', 'meyakini', 'meyakinkan',
                                'minta', 'mirip', 'misal', 'misalkan', 'misalnya', 'mula', 'mulai', 'mulailah', 'mulanya',
                                'mungkinkah', 'nah', 'naik', 'namun', 'nanti', 'nantinya', 'nyaris', 'nyatanya',
                                'oleh', 'olehnya', 'pada', 'padahal', 'padanya', 'pak', 'paling', 'panjang',
                                'pantas', 'para', 'pasti', 'penting', 'pentingnya', 'per', 'percuma', 'perlu',
                                'perlukah', 'perlunya', 'pernah', 'persoalan', 'pertama', 'pertama-tama', 'pertanyakan',
                                'pihak', 'pihaknya', 'pukul', 'pula', 'pun', 'punya', 'rasa', 'rasanya', 'rata',
                                'rupanya', 'saat', 'saatnya', 'saja', 'sajalah', 'saling', 'sama', 'sama-sama',
                                'sambil', 'sampai', 'sampaikan', 'sampai-sampai', 'sana', 'sangatlah', 'satu',
                                'saya', 'sayalah', 'se', 'sebab', 'sebabnya', 'sebagaimana', 'sebagainya',
                                'sebagian', 'sebaik', 'sebaik-baiknya', 'sebaiknya', 'sebaliknya', 'sebanyak',
                                'sebegini', 'sebelum', 'sebelumnya', 'sebenarnya', 'seberapa', 'sebesar',
                                'sebetulnya', 'sebisanya', 'sebuah', 'sebut', 'sebutlah', 'sebutnya',
                                'secara', 'secukupnya', 'sedang', 'sedangkan', 'sedemikian', 'sedikit',
                                'sedikitnya', 'seenaknya', 'segala', 'segalanya', 'segera', 'seharusnya',
                                'sehingga', 'seingat', 'sejak', 'sejauh', 'sejenak', 'sejumlah', 'sekadar',
                                'sekadarnya', 'sekali', 'sekalian', 'sekaligus', 'sekali-kali', 'sekarang',
                                'sekarang', 'sekecil', 'seketika', 'sekiranya', 'sekitar', 'sekitarnya',
                                'sekurang-kurangnya', 'sela', 'selain', 'selaku', 'selalu', 'selama',
                                'selama-lamanya', 'selamanya', 'selanjutnya', 'seluruh', 'semacam',
                                'semakin', 'semampu', 'semampunya', 'semasa', 'semasih', 'semata',
                                'semata-mata', 'semaunya', 'sementara', 'semisalnya', 'tadinya',
                                'tahu', 'tahun', 'tak', 'tambah', 'tambahnya', 'tampak', 'tampaknya',
                                'tandas', 'tandasnya', 'tanpa', 'tanya', 'tanyakan', 'tanyanya',
                                'tapi', 'tegas', 'tegasnya', 'tempat', 'tengah', 'tentu', 'tentulah', 'tentunya',
                                'tepat', 'terakhir', 'terasa', 'terbanyak', 'terdahulu', 'terdapat', 'terdiri',
                                'terhadap', 'terhadapnya', 'teringat', 'teringat-ingat', 'terjadi', 'terjadilah',
                                'terjadinya', 'terkira', 'terlebih', 'terlihat', 'termasuk', 'ternyata',
                                'tersampaikan', 'tersebut', 'tertentu', 'tertuju', 'terus', 'terutama',
                                'tetap', 'tetapi', 'tiap', 'tiba', 'tiba-tiba', 'tidak', 'tidakkah',
                                'tidaklah', 'tiga', 'tinggi', 'toh', 'tunjuk', 'turut', 'tutur', 'tuturnya',
                                'ucap', 'ucapnya', 'ujar', 'ujarnya', 'umum', 'umumnya', 'ungkap',
                                'ungkapnya', 'untuk', 'usah', 'usai', 'waduh', 'wah', 'wahai', 'waktu',
                                'waktunya', 'walau', 'walaupun', 'wong', 'yaitu', 'yakin', 'yakni', 'yang'
                            );
        
        foreach($filtering as $key => $value){
            foreach($commonWords as $key2 => $value2){
                if($value == $value2){
                    unset ($filtering[$key]); 
                }
            }
        }

        return $filtering;
    }

    // Bagian stemming
    
    //fungsi untuk mengecek kata dalam tabel dictionary
    public function cekKamus($kata){ 
        // $sql = mysqli_query("SELECT * from dictionary where word ='$kata' LIMIT 1");
        // $result = mysqli_num_rows($sql);
        $this->db->limit(1);
        $result = $this->db->get_where('dictionary', ['word' => $kata])->num_rows();
        
        if($result==1){
            return true; // True jika ada
        }else{
            return false; // jika tidak ada FALSE
        }
    }

    //fungsi untuk menghapus suffix seperti -ku, -mu, -kah, dsb
    public function Del_Inflection_Suffixes($kata){ 
        $kataAsal = $kata;
        
        if(preg_match('/([km]u|nya|[kl]ah|pun)\z/i',$kata)){ // Cek Inflection Suffixes
            $__kata = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i','',$kata);

            return $__kata;
        }
        return $kataAsal;
    }

    // Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
    public function Cek_Prefix_Disallowed_Sufixes($kata){

        if(preg_match('/^(be)[[:alpha:]]+/(i)\z/i',$kata)){ // be- dan -i
            return true;
        }

        if(preg_match('/^(se)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // se- dan -i,-kan
            return true;
        }
        
        if(preg_match('/^(di)[[:alpha:]]+/(an)\z/i',$kata)){ // di- dan -an
            return true;
        }
        
        if(preg_match('/^(me)[[:alpha:]]+/(an)\z/i',$kata)){ // me- dan -an
            return true;
        }
        
        if(preg_match('/^(ke)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // ke- dan -i,-kan
            return true;
        }
        return false;
    }

    // Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
    public function Del_Derivation_Suffixes($kata){
        $kataAsal = $kata;
        if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
            $__kata = preg_replace('/(i|an)\z/i','',$kata);
            if($this->cekKamus($__kata)){ // Cek Kamus
                return $__kata;
            }else if(preg_match('/(kan)\z/i',$kata)){
                $__kata = preg_replace('/(kan)\z/i','',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata;
                }
            }
    /*– Jika Tidak ditemukan di kamus –*/
        }
        return $kataAsal;
    }

    // Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
    public function Del_Derivation_Prefix($kata){
        $kataAsal = $kata;

        /* —— Tentukan Tipe Awalan ————*/
        if(preg_match('/^(di|[ks]e)/',$kata)){ // Jika di-,ke-,se-
            $__kata = preg_replace('/^(di|[ks]e)/','',$kata);
            
            if($this->cekKamus($__kata)){
                return $__kata;
            }
            
            $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                
            if($this->cekKamus($__kata__)){
                return $__kata__;
            }
            
            if(preg_match('/^(diper)/',$kata)){ //diper-
                $__kata = preg_replace('/^(diper)/','',$kata);
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
                
            }
            
            if(preg_match('/^(ke[bt]er)/',$kata)){  //keber- dan keter-
                $__kata = preg_replace('/^(ke[bt]er)/','',$kata);
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
                
        }
        
        if(preg_match('/^([bt]e)/',$kata)){ //Jika awalannya adalah "te-","ter-", "be-","ber-"
            
            $__kata = preg_replace('/^([bt]e)/','',$kata);
            if($this->cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }
            
            $__kata = preg_replace('/^([bt]e[lr])/','',$kata);	
            if($this->cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }	
            
            $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            if($this->cekKamus($__kata__)){
                return $__kata__;
            }
        }
        
        if(preg_match('/^([mp]e)/',$kata)){
            $__kata = preg_replace('/^([mp]e)/','',$kata);
            if($this->cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }
            $__kata__ = $this->Del_Derivation_Suffixes($__kata);
            if($this->cekKamus($__kata__)){
                return $__kata__;
            }
            
            if(preg_match('/^(memper)/',$kata)){
                $__kata = preg_replace('/^(memper)/','',$kata);
                if($this->cekKamus($kata)){
                    return $__kata;
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]eng)/',$kata)){
                $__kata = preg_replace('/^([mp]eng)/','',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]eng)/','k',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]eny)/',$kata)){
                $__kata = preg_replace('/^([mp]eny)/','s',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]e[lr])/',$kata)){
                $__kata = preg_replace('/^([mp]e[lr])/','',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]en)/',$kata)){
                $__kata = preg_replace('/^([mp]en)/','t',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]en)/','',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }
                
            if(preg_match('/^([mp]em)/',$kata)){
                $__kata = preg_replace('/^([mp]em)/','',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]em)/','p',$kata);
                if($this->cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                
                $__kata__ = $this->Del_Derivation_Suffixes($__kata);
                if($this->cekKamus($__kata__)){
                    return $__kata__;
                }
            }	
        }
        return $kataAsal;
    }

    //fungsi pencarian akar kata
    public function stemming($filtering = array()){ 
		
        foreach($filtering as $key => $stemming){
			
			if($this->cekKamus($stemming)){ // Cek Kamus
				$filtering[$key] = $stemming; // Jika Ada maka kata tersebut adalah kata dasar
			}else{ //jika tidak ada dalam kamus maka dilakukan stemming
				$stemming = $this->Del_Inflection_Suffixes($stemming);
				if($this->cekKamus($stemming)){
					$filtering[$key] = $stemming;
				}
				
				$stemming = $this->Del_Derivation_Suffixes($stemming);
				if($this->cekKamus($stemming)){
					$filtering[$key] = $stemming;
				}
				
				$stemming = $this->Del_Derivation_Prefix($stemming);
				if($this->cekKamus($stemming)){
					$filtering[$key] = $stemming;
				}
				
				if($this->cekKamus($stemming) === false){
					unset($filtering[$key]);
				}
				
			}
			
        }
		
        $i = 0;
		foreach($filtering as $key => $value){
			$filtering[$i] = $value;
			unset($filtering[$key]);
			$i++;			
        }
        
        $stemming = $filtering;
		
		return $stemming;
        
    }

    // end Bagian stemming
    
    public function textPreprocessing($pertanyaan = null){

        // $textPreprocessing = array();
        $textPreprocessing = $this->caseFolding($pertanyaan);
        $textPreprocessing = $this->cleaningData($textPreprocessing);
        $textPreprocessing = $this->tokenizing($textPreprocessing);
        $textPreprocessing = $this->filtering($textPreprocessing);
        $textPreprocessing = $this->stemming($textPreprocessing);

        return $textPreprocessing;

    }

    public function indexing($pertanyaan = null){
        
        $indexing = $this->textPreprocessing($pertanyaan);
        $frequency = array();
        foreach($indexing as $key => $value) {
            
            if(array_key_exists($value, $frequency)){
                $frequency[$value] = 1 + $frequency[$value];
            }else{
                $frequency[$value] = 1;
            }

        }

        return $frequency;
    }

    public function postIndexing($data = null){

        if($data === null) {
            return $this->db->affected_rows();
       }else {
            $this->db->insert('tb_textpreprocessing', $data);
            return $this->db->affected_rows();
       }

    }
}