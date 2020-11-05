<?php

// -----------    ANA MODEL   ----------------

class Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // Database.php deki database İ kullanabilir hale getirdik
        $this -> db = new Database();

    }

    // db den sorgu atıp cevabını alıyoruz
    // her modelde yazmamak için burdan çağırıcaz
    function ayar () {

        return $this->db->listele("ayarlar");

    }


}

?>