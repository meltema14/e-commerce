<?php

// veritabanı işlemleri yapabilmemiz için model yükleyecek
class magaza extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // modeli yükledik
        $this-> Modelyukle('magaza');

        $data1 = 5;
        
        // tasarım dosyalarını gösterebilmek için kullanıyoruz
        $this-> view -> goster("sayfalar/index", 
        array(
                    // sorgu sonunda gelen sonucu header olarak taşır
        "header" => $this->model->ayarlar("ayarlar"),
        "data1" => $data1
        ));



    }

    

}




?>