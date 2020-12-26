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
    
    // en alt kısımdaki yer
    function kargonezamangelir() {

        $this-> view -> goster("sayfalar/diger/kargonezaman");

    }
    // en alt kısımdaki yer
    function iadehakki() {

        $this-> view -> goster("sayfalar/diger/iadehakki");

    }
    // en alt kısımdaki yer
    function musterihizmetleri() {

        $this-> view -> goster("sayfalar/diger/musterihizmetleri");

    }
    // en alt kısımdaki yer
    function gizlilikpolitikasi() {

        $this-> view -> goster("sayfalar/diger/gizlilikpolitikasi");

    }
    // en alt kısımdaki yer
    function satissozlesmesi() {

        $this-> view -> goster("sayfalar/diger/satissozlesmesi");

    }



}

?>