<?php

// ------- FORM KONTROLLERİ YAPILACAK ----------

// hatayı yazdırıp, yönlendirme yapıyor
class Bilgi {

    function basarili($deger, $yol) {

        // $yol: yönlendirileceği sayfa
        // $deger: başarılı ya da başarısız olması(metin)
        return '<div class="alert alert-success mt-5"> '.$deger.'</div>'
        . header("Refresh:3; url=".URL.$yol);
    }


    function hata($deger = false, $yol) {

        // $deger: başarılı ya da başarısız olması(metin)
        return '<div class="alert alert-danger mt-5"> '.$deger.'</div>'
        . header("Refresh:3; url=".URL.$yol);
    }


}

?>