<?php

// giriş yapma kontrolcusu
class uye extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // uye_model ile bağlantısını sağladık
        $this->Modelyukle('uye');

    }

    function giris() {

        // girişe basıldığında giriş sayfası açılacak
        $this->view->goster("sayfalar/giris");

    }

    function hesapOlustur() {

        // girişe basıldığında giriş sayfası açılacak
        $this->view->goster("sayfalar/uyeol");

    }

}




?>