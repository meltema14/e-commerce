<?php

// -----------    ANA MODEL   ----------------

class Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // Database.php deki database i dahil ettik
        $this -> db = new Database();

    }



}

?>