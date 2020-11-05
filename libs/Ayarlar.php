<?php

/*

BURADA SİTENİN TÜM AYARLARINI KONTROL EDİLECEK

*/

class Ayarlar extends Model{


    public $sonuc, $title, $sayfaAciklama, $anahtarKelime, $sloganUst1, $sloganAlt1, $sloganUst2, $sloganAlt2, $sloganUst3, $sloganAlt3;
    

    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct();

       // diziden dönen sonuç
       $this-> sonuc = $this->db->listele("ayarlar");

       // anlık değerleri almak için
       $this->title = $this-> sonuc[0]["title"];
       $this->sayfaAciklama = $this-> sonuc[0]["sayfaAciklama"];
       $this->anahtarKelime = $this-> sonuc[0]["anahtarKelime"];
       $this->sloganUst1 = $this-> sonuc[0]["sloganUst1"];
       $this->sloganAlt1 = $this-> sonuc[0]["sloganAlt1"];;
       $this->sloganUst2 = $this-> sonuc[0]["sloganUst2"];;
       $this->sloganAlt2 = $this-> sonuc[0]["sloganAlt2"];;
       $this->sloganUst3 = $this-> sonuc[0]["sloganUst3"];;
       $this->sloganAlt3 = $this-> sonuc[0]["sloganAlt3"];;

    }

    

  

}




?>