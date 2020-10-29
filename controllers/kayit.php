<?php

// kontrolcü için class oluşturuyoruz.

class kayit extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        parent::__construct();

        $this-> Modelyukle('kayit');
    }

    // kayıt ekle sekmesine basıldığında
    function kayitekle() {

        $this -> view ->goster("form/index");

    }

    
    // kayıt formunda ekle butonuna basıldığında kayit_modele giderek bu fonksiyonu çalıştırır
    function kontrol() {


        // form.php deki bosmu() fonk dönen en son halini değişkene atıyoruz
        $ad = $this -> form -> get("ad") -> bosmu();
        $soyad = $this -> form -> get("soyad") -> bosmu();
        $yas = $this -> form -> get("yas") -> bosmu();

        // form classındaki error boş değilse yani,
        // bir hata varsa 
        if (!empty($this -> form -> error)) :
            

            $this->view->goster("form/sonuc", $this -> form -> error,$this-> bilgi -> hata(false, "/kayit/kayitekle")); // hata değişkenini array olarak sonuc sayfasına gönderir

        else:

                                               //  sütunların arrayi              //  posttan gelen verinin arrayi
        $sonuc = $this -> model -> kontrolet("ogrenci", array("ad", "soyad", "yas"), array($ad, $soyad, $yas));
        

        // formun sonucunu döndürür(oldu/olmadı)
        $this->view->goster("form/sonuc", $sonuc); // formun içindeki sonuc.php sayfasına sonuc değişkenini yollar


        endif;


    }

    function listele(){
                                        //  tablo adı   // koşul
        $sonuc = $this -> model -> listeleme("ogrenci", "order by id desc");
   
        $this->view->goster("form/listele", $sonuc);
    }

    function kayitsil($id){
                                //  tablo adı   // koşul
        $sonuc = $this -> model -> silme("ogrenci", "id=".$id);

        $this->view->goster("form/sonuc", $sonuc);
    }

    function kayitguncelle($id){
                                    //  tablo adı   // koşul
        $sonuc = $this -> model -> listeleme("ogrenci", "where id=" .$id);

        $this->view->goster("form/guncelle", $sonuc);
    }

    function guncelleson() {

        // post edildi
        $ad = $this -> form -> get("ad") -> bosmu();
        $soyad = $this -> form -> get("soyad") -> bosmu();
        $yas = $this -> form -> get("yas") -> bosmu();
        $id = $this -> form -> get("kayitid") -> bosmu();

        // form classındaki error boş değilse yani,
        // bir hata varsa 
        if (!empty($this -> form -> error)) :
            
            $hata =$this -> form -> error;
            $this->view->goster("form/sonuc", $hata); // hata değişkenini array olarak sonuc sayfasına gönderir

        else:

                                                 //  sütun adlarını dışardan verdik         //  posttan gelen verinin arrayi
            $sonuc = $this -> model -> kayitguncel("ogrenci",array("ad", "soyad", "yas") , array($ad, $soyad, $yas), "id=".$id);
        

            // formun sonucunu döndürür(oldu/olmadı)
            $this->view->goster("form/sonuc", $sonuc); // formun içindeki sonuc.php sayfasına sonuc değişkenini yollar

        endif;

    }
    
    function arama() {

        // aranan kelimeyi alıp temizleyerek değişkene atar
        $kelime = $this -> form -> get("kelime") -> bosmu();

        // form classındaki error boş değilse yani,
        // bir hata varsa 
        if (!empty($this -> form -> error)) :
            
            $hata =$this -> form -> error;
            $this->view->goster("form/sonuc", $hata); // hata değişkenini array olarak sonuc sayfasına gönderir

        else:

            // ad veya soyada göre arıyoruz
            $sonuc = $this -> model -> kayitarama("ogrenci", "ad LIKE '%".$kelime."%' or soyad LIKE '%".$kelime."%'");

            // formun sonucunu döndürür(oldu/olmadı)
            $this->view->goster("form/listele", $sonuc); // formun içindeki sonuc.php sayfasına sonuc değişkenini yollar

        endif;

    }



}




?>