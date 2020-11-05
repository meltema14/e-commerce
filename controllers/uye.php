<?php

// giriş yapma kontrolcusu
class uye extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // uye_model ile bağlantısını sağladık
        $this->Modelyukle('uye');

    }

    function giris() {

        // girişe basıldığında giriş sayfası açılacak
        $this->view->goster("sayfalar/giris");

    }

    function hesapOlustur() {

        // hesap oluştura basıldığında üye kayıt formu açılacak
        $this->view->goster("sayfalar/uyeol");

    }

    /*
    üye girişi yapıldığında kullanıcı adı ve şifre boş mu diye kontrol edecek
    Gelen veride bir sorun yoksa giriş verirlerinin eşleşip eşleşmediğini kontrol edicez
    */
    function girisKontrol() {

        $ad = $this->form->get("ad")->bosmu();
        $sifre = $this->form->get("sifre")->bosmu();

        // formda yazılan herhangi bi yerin boş olması
        // bir hata var demek
        if(!empty($this->form->error)):

            // boşluk varsa error arrayinde nerede olduğunu göstericek
            $this->view->goster("sayfalar/giris",array(
            "header" =>$this->model->ayar(),
            "bilgi" => $this->form->error));


        // gelen veride sorun yoksa
        else:

            // gelen verilerden eşleşen var mı diye db ye soruyoruz
            // 0 ya da 1 olarak geri döndürecek
            $sonuc=$this->model->GirisKontrol("uye_panel", "ad='$ad' and sifre='$sifre'");

            // giriş yapıldıysa
            if($sonuc==1):

                // kullanıcı paneline girecek, oturum başlayacak
                // olması gereken bu $this->bilgi->basarili("Giriş Başarılı","/uye/Form");
                $this->bilgi->basarili("Giriş Başarılı","/magaza");

            else:

                // eşleşme yok yani üye yok
                $this->view->goster("sayfalar/giris",
                array(
                "bilgi" => "Kullanıcı Adı veya Şifresi Hatalıdır")
                );
            

            endif;


        endif;


    }

}




?>