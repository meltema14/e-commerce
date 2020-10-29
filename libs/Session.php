<?php


class Session {

    // oturum hareketi burdan başlar
    public static function init() {

        session_start();

    }

    // sessionu oluşturmaya yarar
    public static function set($key, $value) {

        // $_SESSION["kulad"] = "meltem";
        $_SESSION[$key] = $value;

    }

    // oluşturulan sessiondan değer almamıza yarar
    public static function get ($key) {

        // key değeri varsa döndürür yoksa bi şey yapmaz
        if(isset($_SESSION[$key]))
            
        // verilen keyin değerini(value) döndürür
        return $_SESSION[$key];


    }

    // çıkış işlemlerinde (sessionları yok etme)
    public static function destroy() {

        session_destroy();

    }


}




?>