<?php

// üst slogan, yeni ürünler, en çok satanlar kısmının ayarları bu kontrollerden yapılır
// veritabanı işlemleri yapabilmemiz için model yükleyecek
class magaza extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        @Session::init();

        // modeli yükledik
        $this-> Modelyukle('magaza');

        
        // tasarım dosyalarını gösterebilmek için kullanıyoruz
        $this-> view -> goster("sayfalar/index", 
        array(
                    // modele bağlanarak ürünlerden durum=0 olan ve en son eklenenleri getirir.(ANASAYFADAKİ ÜRÜNLER)
        "data1" => $this->model->anasayfaUrunler("urunler", "where durum=0 order by id desc LIMIT 9"),
                    // durumu 1 olanları getirir
        //"data2" => $this->model->anasayfaUrunler("urunler", "where durum=1 order by id desc"),
        ));



    }

    

}




?>