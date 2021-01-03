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

    function Ekleİslemi($tabloisim, $sutunadlari, $veriler) {

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

    function adresSil($tabloisim, $kosul) {

        // db den adresleri çekme
        return $this->db->sil($tabloisim, $kosul);

    }

    function yorumGuncelle ($tabloisim, $sutunlar, $veriler, $kosul) {

        return $this->db->guncelle($tabloisim, $sutunlar, $veriler, $kosul);

    }

    function ayarlarGuncelle ($tabloisim, $sutunlar, $veriler, $kosul) {

        return $this->db->guncelle($tabloisim, $sutunlar, $veriler, $kosul);

    }

    function sifreGuncelle ($tabloisim, $sutunlar, $veriler, $kosul) {

        return $this->db->guncelle($tabloisim, $sutunlar, $veriler, $kosul);

    }

    // ------- SİPARİŞ TAMAMLAMA ------
    function  SiparisTamamlamaUrunCek($tabloisim, $kosul) {

        return $this->db->listele($tabloisim, $kosul);

    }

    // toplu sorgu işlemi
    function TopluislemBaslat() {	

        return $this->db->beginTransaction();	
            
    }
        
    function TopluislemTamamla() {

        return $this->db->commit();

    }
    function SiparisTamamlama($veriler) {
	
        return $this->db->siparisTamamla($veriler);
            
    } 



}

?>