<?php

// database ile iletişim halinde olan model dosyamız
// ana model dosyasından miras aldık
class urunler_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }

    function uruncek($tabloisim, $kosul) {

        return $this->db->listele($tabloisim, $kosul);
    }


}

?>