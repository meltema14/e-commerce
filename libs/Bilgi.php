<?php

// ------- FORM KONTROLLERİ YAPILACAK ----------

// hatayı yazdırıp, yönlendirme yapıyor
class Bilgi {

    function basarili($deger, $yol, $sure=3) {

        // $yol: yönlendirileceği sayfa
        // $deger: başarılı ya da başarısız olması(metin)
        return '<div class="alert alert-success mt-5 text-center"> '.$deger.'</div>'
        . header("Refresh:".$sure."; url=".URL.$yol);
    }


    function hata($deger = false, $yol, $sure=3) {

        // $deger: başarılı ya da başarısız olması(metin)
        return '<div class="alert alert-danger mt-5 text-center"> '.$deger.'</div>'
        . header("Refresh:".$sure."; url=".URL.$yol);
    }

    function uyari($tur, $metin, $id=false) {

        // $tur: başarılı(success) ya da başarısız(danger) olması(uyarinin turu)
        // mt: margin-top
        // $id: varsa eklenicek

        return '<div class="alert alert-'.$tur.' mt-2 p-3 text-center" '. $id.'>'.$metin.'</div>';
    }

    function direktYonlen($yol) {

        // $yol: yönlendirileceği sayfa
        // işlem olduğunda anında yönlenicek
        return header("Location:".URL.$yol);
    }

    function sureliYonlen($zaman,$yol) {
			
        return  header("Refresh:".$zaman."; url=".URL.$yol);
    }


}

?>