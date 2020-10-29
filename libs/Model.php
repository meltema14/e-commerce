<?php


class Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // Database.php deki database sınıfını kullanabilir hale getirdik
        $this -> db = new Database();

    }


}

?>