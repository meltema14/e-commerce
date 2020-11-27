<?php

// üst slogan, yeni ürünler, en çok satanlar kısmının ayarları bu kontrollerden yapılır
// veritabanı işlemleri yapabilmemiz için model yükleyecek
class urunler extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        Session::init();

        // modeli yükledik
        $this-> Modelyukle('urunler');

        /*
        // tasarım dosyalarını gösterebilmek için kullanıyoruz
        $this-> view -> goster("sayfalar/index", 
        array(
                    // modele bağlanarak ürünlerden durum=0 olan ve en son eklenenleri getirir
        "data1" => $this->model->anasayfaUrunler("urunler", "where durum=0 order by id desc"),
                    // durumu 1 olanları getirir
        "data2" => $this->model->anasayfaUrunler("urunler", "where durum=1 order by id desc"),
        ));
        */

    }

    // ürünün detay işlemleri
    function detay($id, $ad) {

        // gelen id ye göre ürünlere bağlanarak ilgili ürünün tüm verilerini çekip sayfaya göndereceğiz

        $sonuc = $this->model->uruncek("urunler", "where id=".$id);

        //$sonuc[0]["katid"]

        $this-> view -> goster("sayfalar/urundetay",
        array(
            // id si kimin kaç geldiyse onu veriyi data1 e postladık
        "data1" => $sonuc,

        // ürünün kendi id sini muaf tutarak(göstermeyerek) kategori id si aynı olanları stoğu azalanlar kısmında gösterir
        "data2" => $this->model->uruncek("urunler", "where katid=".$sonuc[0]["katid"]." and id!= ".$id." and stok < 200 order by stok asc LIMIT 10") 

        ));

        // echo $id. " = ". $ad;

    }

    

}




?>