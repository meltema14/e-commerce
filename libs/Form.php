<?php

// ------- FORM KONTROLLERİ YAPILACAK ----------

// post edilmiş elemanları kullanacak veya denetleyeceğiz
// miras aldık çünkü burada yapılan işlemlerin ardından bize bilgi sunacak bu bilgiye ulaşabilmek için.
class Form extends Bilgi {

    public $deger, $veri;
    public $error=array(); // hatalardan dolayı dolacak kontorlorü sağlaycak array


    // keyi post çeker gibi çekip süzgeçten geçirerek this->veri olarak değişkene değer atayacak
    function get ($key){  // $key = form elemanının name i

        $this -> deger = $key; // hangi inputun boş olduğunu yakalamak için

        $this -> veri = htmlspecialchars(strip_tags($_POST[$key]));
        
        return $this; // diyerek alttaki fonksiyona devam edebiliriz

    }

    // yukarıdaki get işleminden gelen sonucuna göre burası çalışacak
    function bosmu() {

    // gelen değer boşsa
    if (empty($this -> veri)) :

        $this->error[]=$this -> deger . " boş olamaz";

        // bilgi dosyası etkileşimi
        return $this;

    else:

        // hata yoksa veriyi dışarı aktar
        return $this->veri;

    endif;
    }

}

?>