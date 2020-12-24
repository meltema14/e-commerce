<?php

// giriş yapma kontrolcusu
class uye extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // uye_model ile bağlantısını sağladık
        $this->Modelyukle('uye');
        Session::init();

    }

    function giris() {

        // girişe basıldığında giriş sayfası açılacak
        $this->view->goster("sayfalar/giris");

    }

    function hesapOlustur() {

        // hesap oluştura basıldığında üye kayıt formu açılacak
        $this->view->goster("sayfalar/uyeol");

    }

    function cikis() { // oturumu kapatma

        
        // oturumu kapatma
        Session::destroy();
        $this->bilgi->direktYonlen("/magaza");

    }

    /*
    üye girişi yapıldığında kullanıcı adı ve şifre boş mu diye kontrol edecek
    Gelen veride bir sorun yoksa giriş verirlerinin eşleşip eşleşmediğini kontrol edicez
    */
    function girisKontrol()  { // GİRİŞ KONTROL

        // form classına gidip ad ve şifre boş mu değil mi diye bakar
        $ad = $this->form->get("ad")->bosmu();
        $sifre = $this->form->get("sifre")->bosmu();

        // formda yazılan herhangi bi yerin boş olması
        // bir hata var demek
        if(!empty($this->form->error)):

            // boş bırakılan(kullanıcı adı veya şifre) varsa error arrayinde hangisi olduğunu göstericek
            $this->view->goster("sayfalar/giris",
            array("bilgi" => $this->bilgi->uyari("warning", " Kullanıcı adı ve şifre boş olamaz!")));

        // gelen veride sorun yoksa
        else:

            // buraya gelen şifreyi şifrele fonk. çağırarak şifreleme
            $sifre = $this->form->sifrele($sifre);

            // gelen verilerden eşleşen var mı diye db ye sorgu atma
            // 0 ya da 1 olarak geri döndürür
            $sonuc=$this->model->GirisKontrol("uye_panel", "ad='$ad' and sifre='$sifre'");

            // giriş yapıldıysa
            if(count($sonuc)>0):

                // kullanıcı paneline girecek
                $this->bilgi->direktYonlen("/uye/panel");

                // kulad isimli sessionu başlatma
                Session::init();
                session::set("kulad", $sonuc[0]["ad"]);   

                // üyenin idsi taşınacak  
                session::set("uye", $sonuc[0]["id"]);  

            else:

                // eşleşme yok yani üye yok
                $this->view->goster("sayfalar/giris",
                array("bilgi" => $this->bilgi->uyari("danger"," Kullanıcı adı veya şifre hatalı")));
            
            endif;


        endif;


    }

    function kayitKontrol()  { // ÜYE KAYIT KONTROL

        // --------- FORM ELEMANLARINDA BOŞ VAR MI DİYE KONTROL EDİYORUZ ---------

        $ad = $this->form->get("ad")->bosmu();
        $soyad = $this->form->get("soyad")->bosmu();
        $mail = $this->form->get("mail")->bosmu();
        $sifre = $this->form->get("sifre")->bosmu();
        $sifretekrar = $this->form->get("sifretekrar")->bosmu();
        $telefon = $this->form->get("telefon")->bosmu();

        // girilen mail adresini fonksiyona verdik
        $this->form->GercektenMailmi($mail);

        // şifrelerin uyumlu olup olmama işlemi
        $sifre = $this->form->sifreKarsilastir($sifre, $sifretekrar);


        // formda yazılan herhangi bi yer boşsa
        // bir hata var demek
        if(!empty($this->form->error)):

            // boş bırakılan(kullanıcı adı veya şifre) varsa error arrayinde hangisi olduğunu göstericek
            $this->view->goster("sayfalar/uyeol",
                            // hatayı buraya gönderdik
            array("hata" => $this->form->error));

        // gelen veride sorun yoksa
        else:

            // gelen verilerden eşleşen var mı diye db ye soruyoruz
            // 0 ya da 1 olarak geri döndürecek
            $sonuc=$this->model->UyeKayit("uye_panel", 
            // sütunlar
            array("ad", "soyad", "mail", "sifre", "telefon"),
            // değerler
            array($ad, $soyad, $mail, $sifre, $telefon)
            );

            // giriş yapıldıysa
            if($sonuc==1):

                // üye olma işlemi tamamlandıysa
                $this->view->goster("sayfalar/uyeol",
                array("bilgi" => $this->bilgi->uyari("success"," KAYIT BAŞARILI ")));

            else:

                // eşleşme yok yani üye yok
                $this->view->goster("sayfalar/uyeol",
                array(
                "bilgi" => 
                $this->bilgi->uyari("danger"," Kayıt esnasında hata oluştu")));
            

            endif;


        endif;


    }

   // -----------------------   ÜYE PANELİ   ---------------------------

    function Panel() {// üye bilgileri
        
        $this->view->goster("sayfalar/panel");
          
    }

    function yorumlarim() { // giriş yapan üyenin db den yorumlarını çekme
        
        // Session::get("uye") : Giriş yapmış üyenin idsini taşır       
        $this->view->goster("sayfalar/panel", array(
            "yorumlar" => $this->model->yorumlarial("yorumlar", "where uyeid=".Session::get("uye"))
        ));              
    }

    function adreslerim() { // giriş yapan üyenin db den adreslerini çekme
        
        // Session::get("uye") : Giriş yapmış üyenin idsini taşır       
        $this->view->goster("sayfalar/panel", array(
            "adres" => $this->model->yorumlarial("adresler", "where uyeid=".Session::get("uye"))
        ));       
    }

    function Yorumsil (){

        // posttan geldiyse veri
        if ($_POST) :

            // posttan gelen idyi db ye sorgu atarak yorumu silme
            echo $this->model->yorumSil("yorumlar", " id=".$_POST["yorumid"]);

        endif;

    }

    function adresSil () {

        // posttan geldiyse veri
        if ($_POST) :

            // posttan gelen idyi db ye sorgu atarak yorumu silme
            echo $this->model->adresSil("adresler", " id=".$_POST["adresid"]);

        endif;

    }

    

}




?>