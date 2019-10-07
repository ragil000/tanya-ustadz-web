<?php

class IndexingModel extends CI_Model {

    public function indexing(){
        foreach($kata as $tok) {
            
            if(array_key_exists($tok, $freq)){
                $freq[$tok] = 1 + $freq[$tok];
            }else{
                $freq[$tok]=1;
            }
        }

        foreach ($freq as $key => $val) {
            //echo "$key => $val<br />";
        }

        echo json_encode($freq);
    }

}