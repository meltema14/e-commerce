<?php


class Session {

    public static $db;

    // oturum hareketi burdan başlar
    public static function init() {

        // db classı içindeki fonksiyonlara erişme
        self::$db= new Database();
        // oturum başlatma
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

    
    public static function OturumKontrol($tabloAdi, $deger1, $deger2) {
        
        // oturum acan kullanıcının bilgileri veri tabanı ile eşleşiyor mu
        $sonuc = self::$db->listele($tabloAdi,"where ad='".$deger1."' and id=".$deger2);
        
        // tanımsızsa
        if (!isset($sonuc[0])) :
	
            self::destroy();
            
        endif;
    }


}




?>