<?php

// ürünler cookielerde tutulacak
class Cookie {
  
    // sepete ekleme 
        public static function SepeteEkle($id, $adet) {


        // sepette ürün var ise
        if (isset($_COOKIE["urun"])) :

            // array_key_exists: elemanın dizi içerisinde var olup olmamasına bakar
            // ürün daha önce sepette varsa mevcut adedin üzerine ekleme yapılacak
            if (array_key_exists($id, $_COOKIE["urun"])) : 

                $adeetal = $_COOKIE["urun"]["$id"];
                $sonadet = $adeetal + $adet;
                // cookienin yeni değerini sonadet olarak değiştir
                setcookie('urun['.$id.']', $sonadet, time()+ 60*60*24,"/");

            else:

                // sepete eklenen ürünün adet ve idsi
                setcookie('urun['.$id.']', $adet, time()+ 60*60*24,"/");

            endif;
        // sepette ürün yoksa
        else:
            
        setcookie('urun['.$id.']', $adet, time()+ 60*60*24,"/");

    endif;  

    }

    // tanımlı olan cookiedeki ürünleri gösterme
    public static function SepeteBak() {

        // ne kadar ürün varsa dizide tutar ihtiyacımız olduğunda çağırabiliriz
        if (isset($_COOKIE["urun"])) :

            // ürünler dizisini id ve adet olarak parçalanmış şekilde vericek
            foreach (($_COOKIE["urun"]) as $id => $adet):

                echo "Ürün İd : ". $id . " Adeti : " . $adet. "<br>";

            endforeach;

        else:

        // eğer ürün yoksa burdan uyarı döndürebiliriz
        return false;
        endif;

    }

    // tanımlı olan cookiedeki ürünleri TEK TEK SİlER
    public static function UrunUcur($id) {

        if (isset($_COOKIE["urun"])) :

            // $adet e false değerini verdik(adet değeri verilmezse hataya düşmesin diye)
            // time()-2: urun['.$id.'] ye ait olan elemanı öldürüyoruz
            setcookie('urun['.$id.']', false, time()-2, "/");

        endif;

    }

    // tanımlı olan cookiedeki ürünleri guncelleme
    public static function Guncelle($id, $adet) {

        if (isset($_COOKIE["urun"])) :

            /*  id 17 adet 6
                id 17 adet 2
                eğer adet üzerine eklenecekse yani toplam adet 8 olacaksa
                asağıdaki gibi formdan gelen adedi o an tutulan mevcut adedin üzerine ilave ediyoruz
            

            $adeetal = $_COOKIE["urun"]["$id"];
            $sonadet = $adeetal + $adet; // 8 rakamına ulaştım
            */



            // $adet e false değerini verdik(adet değeri verilmezse hataya düşmesin diye)
            // time()-2: urun['.$id.'] ye ait olan elemanı öldürüyoruz
            setcookie('urun['.$id.']', $adet, time()+ 60*60*24,"/");

        endif;
       

    }

    // tanımlı olan cookiedeki ürünlerin HEPSİNİ siler
    public static function SepetiBosalt() {

        if (isset($_COOKIE["urun"])) :

            // ürünler dizisini id ve adet olarak parçalanmış şekilde döndürür
            foreach (($_COOKIE["urun"]) as $id => $adet):

                // cookieyi tamamen boşaltır
                setcookie('urun['.$id.']', $adet, time()-2 ,"/");

            endforeach;

        endif;

        // ürün yoksa
        if (!isset($_COOKIE["urun"])) :

            // SEPET BOŞALINCA BURASI DÖNECEK
            return true;

        endif;

    }



}




?>