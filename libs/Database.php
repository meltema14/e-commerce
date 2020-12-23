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

    function Ekle($tabloisim, $sutunadlari, $veriler) { // ekleme

        // genel bi sorgu yapısı oluşturuyoruz
        // en değişkenler belirleniyo(tablo adı, sütun adı, sütun adlarına karşılık gelen value değerleri)


        // arrayin içerisindeki eleman sayısını buluyoruz
        $sutunsayi = count($sutunadlari);

        // kaç tane veri olduğunu belirleme
        for($i = 0; $i<$sutunsayi; $i++):

            // dizi her döndüğünde dizi değişkenine ? ekleyecek
            $this-> dizi []= '?';

        endfor;

         
        $sonVal = join(",", $this -> dizi); // yukarıdaki gelen verilerin arasına ,(virgül) koyduk (join = include)

        $sonhal = join(",", $sutunadlari); // sutunadlarının arasına da ,(virgül) koyduk(ad,soyad,mail vb)
 

        // miras aldığımız Modelimize dahil edilen db ye eriştik 
        $sorgu = $this -> prepare('insert into '.$tabloisim.' ('.$sonhal.') VALUES ('.$sonVal.')'); 

        // formdan gelen verileri arraye veriyoruz
        if ($sorgu -> execute($veriler)) :
            // return $this-> bilgi -> basarili("Ekleme başarılı", "/uye/kayitekle");
            // eklendiyse
            return 1;
        else:
            //eklenmediyse
            return 0;
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
                                                            
            return true;

        else:

            return false;

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

    function giriskontrol($tabloisim, $kosul) { //giriş kontrol

        // burada ciddi işler var

        $sorgum = "select * from " . $tabloisim . " where " .$kosul;
        $son = $this -> prepare($sorgum);
        $son -> execute();
        
       
        // başarılı bi giriş var mı(0,1)
        if ($son -> rowCount() > 0) :

            // giriş yapan kullanıcı verisini döndürür
            return $son->fetchAll();

        else:

            return false;

        endif;

    }

    
}

?>