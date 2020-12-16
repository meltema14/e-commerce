<?php

// giriş yapma kontrolcusu
class sayfalar extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

    }

    function iletisim() {

        $this-> view -> goster("sayfalar/iletisim");

    }




}

?>