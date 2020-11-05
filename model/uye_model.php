<?php

// giriş yapma kontrolcusu
class uye_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }


    function GirisKontrol($tabloisim, $kosul) {

        // db ye sorgu atıcaz, yani db den veri çekicez

        return $this->db->giriskontrol($tabloisim, $kosul);


    }



}

?>