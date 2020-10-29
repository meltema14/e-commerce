<?php

// ana model dosyasından miras aldık
class kayit_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }

    function kontrolet($tabload, $sutunlarim, $veri) {

                              //  tabloismi, sütunisimleri, veriler
        return $this-> db -> Ekle($tabload, $sutunlarim, $veri);

    }

    function listeleme($tabload, $kosul) {

        //   DB deki listele fonksiyona ulaşma
        return $this-> db -> listele($tabload, $kosul);

    }   

    function silme($tabload, $kosul) {

        //   DB deki listele fonksiyona ulaşma
        return $this-> db -> sil($tabload, $kosul);

    } 

    function kayitguncel($tabload, $sutunlar, $veri, $kosul) {

        //   DB deki listele fonksiyona ulaşma
        return $this-> db -> guncelle($tabload, $sutunlar, $veri, $kosul);

    } 

    function kayitarama($tabload, $kosul) {

        //   DB deki arama fonksiyona ulaşma
        return $this-> db -> arama($tabload, $kosul);

    } 


}

?>