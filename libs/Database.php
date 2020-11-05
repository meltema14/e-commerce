<?php


// PDO sınıfından miras aldık 
class Database extends PDO {

    protected $dizi = array();
    protected $dizi2 = array();

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // __constructı miras aldık, veri tabanı bağlantısını sağlar
        parent::__construct('mysql:host='.DB_HOST.'; dbname='.DB_NAME.'; charset=utf8', DB_USER, DB_PASS);


        $this-> bilgi = new Bilgi();


    }

    function ekle($tabloisim, $sutunadlari, $veriler) { // ekleme

        //genel bi sorgu yapısı oluşturuyoruz
        // en değişkenler belirleniyo(tablo adı, sütun adı, sütun adlarına karşılık gelen value değerleri)


        // arrayin içerisindeki eleman sayısını buluyoruz
        $sutunsayi = count($sutunadlari);

        for($i = 0; $i<$sutunsayi; $i++):

            // dizi her döndüğünde dizi değişkenine ? ekleyecek
            $this-> dizi []= '?';

        endfor;

         // ?, daki sondaki virgül hataya sebebiyer vereceği için siliyoruz
        $sonVal = join(",", $this -> dizi);

        $sonhal = join(",", $sutunadlari);


        // miras aldığımız Modelimize dahil edilen db ye eriştik 
        $sorgu = $this -> prepare('insert into '.$tabloisim.' ('.$sonhal.') VALUES ('.$sonVal.')'); 

        // formdan gelen verileri arraye veriyoruz
        if ($sorgu -> execute($veriler)) :
            return $this-> bilgi -> basarili("Ekleme başarılı", "/kayit/kayitekle");
        else:
            return $this-> bilgi -> hata("Veri tabanı hatası", "/kayit/kayitekle");
        endif;
    }

                    // kosul olmadığında hata vermesin diye false
    function listele($tabloisim, $kosul = false) {

        // sorgumuzu oluşturduk
        // kosul verilmediyse
        if($kosul==false):

            $sorgum = "select * from " . $tabloisim;

        else:

            $sorgum = "select * from " . $tabloisim . " " .$kosul;
                                                        // order by , where, and gibi şeyler kullanılabilir
        endif;

        $son = $this -> prepare($sorgum);
        $son -> execute();

        // sorgudan dönen sonucu fetchAll olarak bu fonksiyonun yazıldığı her yere cevap olarak aktarır
        return $son -> fetchAll();

    }

                            // kosul kesinlikle olacağından false ı kaldırdık
    function sil($tabloisim, $kosul) {// silme

        $sorgum = $this -> prepare("delete from ". $tabloisim . ' where ' .$kosul);

        if ($sorgum ->  execute()) : 
                                                            
            return $this-> bilgi -> basarili("Silme başarılı", "/kayit/listele");

        else:

            return $this-> bilgi -> hata("Veri tabanı hatası", "/kayit/listele");

        endif;

    }


    function guncelle($tabloisim, $sutunlar, $veriler, $kosul) { //gümcelleme

        // sütunları değere parçaladık
        foreach ($sutunlar as $deger) :

            // değerin tüm verilerini =? ekleyerek yeni bi diziye aktardım
            $this-> dizi2 [] = $deger . "=?";

        endforeach;

         // ?, daki sondaki virgül hataya sebebiyer vereceği için siliyoruz
        $sonSutnlar = join(",", $this -> dizi2);



        $sorgum = $this -> prepare("update ". $tabloisim . " set "  .$sonSutnlar . "where ". $kosul );

        if ($sorgum ->  execute($veriler)) : 
                                                            
            return $this-> bilgi -> basarili("Güncelleme başarılı", "/kayit/listele");

        else:

            return $this-> bilgi -> hata("Veri tabanı hatası", "/kayit/listele");

        endif;
    }

    function arama($tabloisim, $kosul) {

        // eşleşen kayıt birden fazla olabilir
        $sorgum = "select * from " . $tabloisim . " where " .$kosul;
                                                        // order by , where, and gibi şeyler kullanılabilir

        $son = $this -> prepare($sorgum);
        $son -> execute();

        // sorgudan dönen sonucu fetchAll olarak bu fonksiyonun yazıldığı her yere cevap olarak aktarır
        return $son -> fetchAll();

    }

    function giriskontrol($tabloisim, $kosul) {

        // burada ciddi işler var

        $sorgum = "select * from " . $tabloisim . " where " .$kosul;
        $son = $this -> prepare($sorgum);
        $son -> execute();
        
        // satır sayısı 0 dan büyükse yani eşleşen bir kayıt varsa 
        if ($son -> rowCount() > 0) :

            session::init();    // oturum dosyasından classı başlat 
            session::set("kulad", true);    // kulad isimle sessionu başlat

        endif;

        // satır sayısını geri döndür
        return $son -> rowCount();

    }

    
}

?>