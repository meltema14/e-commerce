<?php

// veritabanı işlemleri yapabilmemiz için model yükleyecek
class magaza extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        $this-> Modelyukle('magaza');

        // tasarım dosyalarını gösterebilmek için kullanıyoruz
        $this-> view -> goster("index/index");

    }

    

}




?>