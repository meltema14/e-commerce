<?php

// kontrolcü için class oluşturuyoruz.

class ana extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        parent::__construct();

        // viewdeki göster methodunu çalıştırarak index dosyasındaki index.php iyi çalıştırır.
        $this -> view -> goster("index/index");
    }

    function ilerleme(){

        $this-> Modelyukle('p');

    }



}




?>