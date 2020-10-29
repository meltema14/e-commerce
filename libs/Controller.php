<?php

//----------- ANA KONTROLCÜ -----------//

class Controller{

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // diğer kontrolcülerin erişmesi için gerekli sınıfları dahil ediyoruz
        $this -> view = new View();

        $this -> form = new Form();

        $this -> bilgi = new Bilgi();

    }

    // ihtiyacımız olan modeli dahil ediyoruz
    public function Modelyukle($name) {

        // yüklenecek yol
        // name yerine p yazarken projeyi yükleyecek, ü yazarsak üyeyi yğkleyecek gibi
        $yol='model/'.$name.'_model.php';

        // $yol değişkeninde dosya varsa yükleyecek
        if (file_exists($yol)) :

            require $yol; // varsa dahil etti
            $modelsinifname = $name . '_model'; // sınıfı dahil etmek için dosya name i lazım
            $this->model = new $modelsinifname();
            
        endif;

    }


}




?>