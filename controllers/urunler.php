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

        // $sonuc[0]["katid"]
        // and id!=".$id

        $this-> view -> goster("sayfalar/urundetay",
        array(

        // id si kimin kaç geldiyse onu veriyi data1 e postladık
        "data1" => $sonuc,

        // -stoğu azalanlar- kısmında o an ekranda olan ürünün id sini muaf tutarak(göstermeyerek) kategori id si aynı olanları  gösterir
        "data2" => $this->model->uruncek("urunler", "where katid=".$sonuc[0]["katid"]." and id!= ".$id." and stok < 200 order by stok asc LIMIT 10"),

        // -benzer ürünler- (kategori idsi aynı olanları bu kısımda göstericek)
        // id!= .$id. = o an ekranda gösterilen ürünün benzer ürünlerde çıkmaması için
        "data3" => $this->model->uruncek("urunler", "where katid=".$sonuc[0]["katid"]." and id!= .$id  LIMIT 3"),

        // onaylanmış yorumları db den çekme (ürünidsi gelen id ye eşit olanları al )
        // durum 1 ise onaylanmış yorum 0 ise onaylanmamış
        "data4" =>$this->model->uruncek("yorumlar","where urunid=$id and durum=1")
        ));

        // "data3" => $this->model->uruncek("urunler", "where katid=".$sonuc[0]["katid"]." and id!= .$id. and stok > 180  LIMIT 3")
        // echo $id. " = ". $ad;

    }

    // DİĞER KATEGORİLER ALANINA ALT KATEGORİYİ ÇEKME
    function kategori($id, $ad) {

        // katid si id ye eşit olanları sayfalar/kategori gönder
        $sonuc = $this->model->uruncek("urunler", "where katid=".$id);

        // çocuk id ye ait olan diğer kategorileri listeleme
        $CocukKatBul = $this->model->uruncek("alt_kategori","where id=".$id);
        // 13

        // sayfalara kategori olarak gönderdme
        $this-> view -> goster("sayfalar/kategori",
        array(

        // alt_kategoriye bağlandık. çocuk kat idsi ilgili kategorinin idsi hangisiyse onunla eşleşen tüm kayıtları bulma
        "data1" => $sonuc,
        "data2" => $this->model->uruncek("alt_kategori",
        "where cocuk_kat_id=".$CocukKatBul[0]["cocuk_kat_id"]." and id!=$id"),
        "data3" => $this->model->uruncek("urunler", "where katid=".$id." and durum=1  LIMIT 5")

        ));

        /*

        // -benzer ürünler- (kategori idsi aynı olanları bu kısımda göstericek)
        // id!= .$id. = o an ekranda gösterilen ürünün benzer ürünlerde çıkmaması için
        "data3" => $this->model->uruncek("urunler", "where katid=".$sonuc[0]["katid"]." and id!= .$id  LIMIT 3"),

        // onaylanmış yorumları db den çekme (ürünidsi gelen id ye eşit olanları al )
        // durum 1 ise onaylanmış yorum 0 ise onaylanmamış
        "data4" =>$this->model->uruncek("yorumlar","where urunid=$id and durum=1")
        */

    }



    

}
?>