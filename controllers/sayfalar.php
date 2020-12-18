<?php

// sayfaları dahil eder
class sayfalar extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

    }

    // iletişim sayfasını dahil etme
    function iletisim() {

        $this-> view -> goster("sayfalar/iletisim");

    }

    // sepet sayfasını dahil etme
    function sepet() {

        $this-> view -> goster("sayfalar/sepet");

    }




}

?>