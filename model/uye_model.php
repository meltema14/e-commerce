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

    function UyeKayit($tabloisim, $sutunadlari, $veriler) {

        // db ye sorgu atıcaz, yani db den veri çekicez

        return $this->db->Ekle($tabloisim, $sutunadlari, $veriler);

    }

    function yorumlarial($tabloisim, $kosul) {

        // db den yorumları çekme
        return $this->db->listele($tabloisim, $kosul);

    }

    function yorumSil($tabloisim, $kosul) {

        // db den yorumları çekme
        return $this->db->sil($tabloisim, $kosul);

    }



}

?>