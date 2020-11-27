<?php
// BAŞLANGIÇTAKİ YÖNLENDİRİCİ DOSYA


class boots{

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // http://localhost/s%C4%B1f%C4%B1rMVC/ayar///
        $url = isset ($_GET["url"]) ? $_GET["url"] : null; // url tanımlı ise getir değilse boş olsun
        $url =rtrim($url, '/'); // yukarıda sonda birden çok / olursa hata vermemesi için trimledik


        $url = explode ('/', $url); // GET ile gelen veriyi / ile parçalama

        //print_r($url);
        /*
        $url[0]; // kontrolcü
        $url[1]; // method yani fonk.
        $url[2]; // parametre

        */

        /*
        Route::run(url):
        tarayıcıdan uyeler diye talep geldiğinde giris meyhoduna yönlendirir
        Route::run(uyeler, uyeler@giris):
        
        

        */

        // eğer kontrolcü yazılmazsa varsayılan olarak magaza kontrolcüsü çalışır
        if(empty($url[0])):

            require 'controllers/magaza.php';  
            $controller = new magaza;

        else:

            $file = 'controllers/' .$url[0]. '.php'; // kontrolcüyü çalıştırıyoruz
                    //controllers/ana.php

                    // kontrolcü başta boş gelmesine karşılık
                    if(file_exists($file)): // $file dosyası varsa

                        require $file; // dahile et
                        $controller = new $url[0]; // kontrolcüyü (sınıfı dahil ediyoruz ) ekle

                    else:

                        require 'controllers/error.php'; //error.php dosyamızı dahil ettik
                        $hata = new hata(); // error classını ekledik
                        
                    
                    endif;
        endif;

        /*kontrolcüyü çalıştırma
        require 'controllers/' .$url[0]. '.php';
                //controllers/ana.php
        */



        // 3.url doluysa
        if (isset($url[3])):

            $controller->{$url[1]}($url[2], $url[3]);
            //$controller -> ileri(10)

        else:

            // 2.url doluysa
            if (isset($url[2])):

                $controller->{$url[1]}($url[2]);
                //$controller -> ileri(10)

            else:
                    // 1.url doluysa
                if (isset($url[1])):

                    $controller->{$url[1]}();
                    // $controller -> ileri()


                endif;

            endif;
            
        endif;
        
    }



}




?>