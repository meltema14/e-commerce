<?php

// girişi kontrol edecek kontrolcü oluşturuyoruz.

class login extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        parent::__construct();

        $this-> Modelyukle('login');

    }

    function Form() {

        $this -> view ->goster("form/giris");

    }


    function giriskontrol() {

        $ad = $this -> form -> get("ad") -> bosmu();
        $sifre = $this -> form -> get("sifre") -> bosmu();

        // form classındaki error boş değilse yani,
        // bir hata varsa 
        if (!empty($this -> form -> error)) :

            $this->view->goster("form/sonuc", // dosyayı yüklüyor
            $this -> form -> error, //hataları gösteriyor
            $this-> bilgi -> hata(false, "/login/Form") ); // yönlendirmeyi sağlıyor

        else:

        
        $sonuc = $this -> model -> giriskontrol("panel", "ad='$ad' and sifre='$sifre'");

        // giriş varsa (0: yok)
        if ($sonuc == 1):
            
            header("Location:" .URL. "/panel");

        else:

        // formun sonucunu döndürür(oldu/olmadı)
        $this->view->goster("panel/sonuc", 
        $this -> form -> error, 
        $this-> bilgi -> hata("Eşleşme yok", "/login/Form")); // formun içindeki sonuc.php sayfasına sonuc değişkenini yollar

        // parent::hata(false, "/kayit/kayitekle");
            
        endif;



        endif;


    }
    



}




?>