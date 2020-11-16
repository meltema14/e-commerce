<?php

// ------- FORM KONTROLLERİ YAPILACAK ----------

// post edilmiş elemanları kullanacak veya denetleyeceğiz
// miras aldık çünkü burada yapılan işlemlerin ardından bize bilgi sunacak bu bilgiye ulaşabilmek için.
class Form extends Bilgi {

    public $deger, $veri;
    public $error = array(), $sonuc = array(); // hatalardan dolayı dolacak kontorlorü sağlayacak array


    // keyi post çeker gibi çekip süzgeçten geçirerek devam eder
    function get ($key){  // $key = form elemanının name i

        $this -> deger = $key; // hangi inputun boş olduğunu yakalamak için

        $this -> veri = htmlspecialchars(strip_tags($_POST[$key]));
        
        return $this; // diyerek alttaki fonksiyona devam ediyoruz

    }

    // yukarıdaki get işleminden gelen sonucuna göre burası çalıştırıyor
    function bosmu() {

        // gelen değer boşsa
        if (empty($this -> veri)) :

            // error arrayine boş olan verileri(mesela adı boş geldi bu array tutar bunu) atıyoruz
            $this->error[]=$this -> deger . " boş olamaz";

            // bilgi dosyası etkileşimi
            return $this;

        else:

            // hata yoksa veriyi dışarı aktar
            return $this->veri;

        endif;

    }

    // $email: dışarıdan veri alıcak
    function GercektenMailmi($email) { // mail kontrol

        // substr: istenilen yerden sonrasını parçalar
        // strpos: verilen metni verilen check point ile böler( yani @ den sonrasına bakar)
        // +1 ise, @(0.) başladığı için bi sonraki karakteri alır
        $sunucu = substr($email, strpos($email, '@') + 1);

        // sunucu değişkenine bakıp gelen sonucu sonuc değişkenine aktarıyor
        // sonuç varsa 1 geçerli mail adresi yoksa sonuç 0 döner
        // getmxrr: @ den sonrasi içingerçekte öyle bi mail var mı diye sorgular
        getmxrr($sunucu, $this -> sonuc);

        // arrayin içerisine veri gelmediyse
        if(!count($this -> sonuc) > 0):

            $this->error[] = " Mail adresi geçersiz";

        endif;

    }

    function sifrele($veri) {

        /* şifreleme yöntemleri: md5, sha1, base64(encode-decode)
         gzdeflate: veri sıkışrtırma yöntemi 
         serialize: verileri tutabilmesi için
         BU ŞEKİLDE VERİYİ 3, 4 KERE ŞİFRELEMİŞ OLUYORUZ
        */
        return base64_encode(gzdeflate(gzcompress(serialize($veri))));

    }

    // şifreyi çözme
    function coz($veri) {

        return unserialize(gzuncompress(gzinflate(base64_decode($veri))));

    }



    function sifreKarsilastir($deger, $deger2) {

        // değerler birbirine eşit değilse
        if($deger != $deger2) :

            $this->error[] = " Girilen şifreler uyumsuz";

        else:

            // şifre verisi aynı ise o veriyi şifrelereyek bize verir
            return $this->sifrele($deger);

        endif;

    }

}

?>