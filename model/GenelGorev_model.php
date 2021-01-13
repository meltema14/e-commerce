<?php


class GenelGorev_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }

    function Verial($tabloisim, $kosul) {

        // db ye sorgu atıcaz, yani db den veri çekicez
        return $this->db->listele($tabloisim, $kosul);
    }
    
    function YorumEkleme($tabloisim, $sutunadlari, $veriler) {

        // db ye sorgu atıcaz, yani db den veri çekicez
        return $this->db->Ekle($tabloisim, $sutunadlari, $veriler);
    }

    function BultenEkleme($tabloisim, $sutunadlari, $veriler) {

        // db ye sorgu atıcaz, yani db den veri çekicez
        return $this->db->Ekle($tabloisim, $sutunadlari, $veriler);
    }

    function iletisimForm($tabloisim, $sutunadlari, $veriler) {

        // db ye sorgu atıcaz, yani db den veri çekicez
        return $this->db->Ekle($tabloisim, $sutunadlari, $veriler);
    }


    
}

?>