<?php

// giriş yapma kontrolcusu
class uye extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // uye_model ile bağlantısını sağladık
        $this->Modelyukle('uye');
        // her kontorolcünün constructında çalıştır
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
            if($sonuc):

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
            $sonuc=$this->model->Eklemeİslemi("uye_panel", 
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
        
        $this->view->goster("sayfalar/panel",
        // varsayılan olarak ekranda direkt siparişler gözükecek
        array("siparisler" => $this->model->yorumlarial("siparisler","where uyeid=".Session::get("uye"))));
          
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

    function Yorumsil (){   // YORUM SİL

        // posttan geldiyse veri
        if ($_POST) :

            // posttan gelen idyi db ye sorgu atarak yorumu silme
            $this->model->yorumSil("yorumlar", " id=".$_POST["yorumid"]);

        endif;

    }

    function adresSil () {  // ADRES SİL

        // posttan geldiyse veri
        if ($_POST) :

            // posttan gelen idyi db ye sorgu atarak yorumu silme
            $this->model->adresSil("adresler", " id=".$_POST["adresid"]);

        endif;

    }

    function YorumGuncelle () { // YORUM GÜNCELLE

        if($_POST) :
            /*
            $_POST["yorum"];
            $_POST["yorumid"]; */

            $this->model->yorumGuncelle("yorumlar",
            // sütunlar
            array("icerik","durum"),
            // sütunlara karşılık gelen değerler
            array($_POST["yorum"],"0"),"id=".$_POST["yorumid"]);

        endif;

    }

    function AdresGuncelle () {  // ADRES GÜNCELLE

        if($_POST) :
            /*
            $_POST["yorum"];
            $_POST["yorumid"]; */

            $this->model->yorumGuncelle("adresler",
            // sütunlar
            array("adres"),
            // sütunlara karşılık gelen değerler
            array($_POST["adres"]),"id=".$_POST["adresid"]);

        endif;

    }

    // -----------------------------------------------------------------

    // ---------   HESAP AYARLARI   -------------
    function hesapayarlarim() {	
	
        $this->view->goster("sayfalar/panel",array(
        // ilgili üyeyi ayarlar keyine attık
        "ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye"))));		  
            
    }
        
    function sifredegistir() {	// ŞİFRE DEĞİŞTİR
       
        $this->view->goster("sayfalar/panel",array(
            // üye idsini tutuyo
        "sifredegistir" => Session::get("uye")));	
      
    }
        
    function siparislerim() {	// ÜYENİN SİPARİŞLERİNİ GETİRİR
    
        $this->view->goster("sayfalar/panel",array(
        "siparisler" => $this->model->yorumlarial("siparisler","where uyeid=".Session::get("uye"))));		
           
    }

    function ayarGuncelle() {   // ÜYE KENDİ AYARLARINI GÜNCELLİYOR


        // form classına gidip ad ve şifre boş mu değil mi diye bakar
        $ad = $this->form->get("ad")->bosmu();
        $soyad = $this->form->get("soyad")->bosmu();
        $mail = $this->form->get("mail")->bosmu();
        $telefon = $this->form->get("telefon")->bosmu();
        $uyeid = $this->form->get("uyeid")->bosmu();

        $this->form->GercektenMailmi($mail);

        // hesap ayarlarında yazılan herhangi bi yerin boş olması
        // bir hata var demek
        if(!empty($this->form->error)):

            // boş bırakılan varsa error arrayinde hangisi olduğunu göstericek
            $this->view->goster("sayfalar/panel",
            array(
            "ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye")),
            "bilgi" => $this->bilgi->uyari("danger", " Girilen bilgiler hatalıdır."),
            ));

        // gelen veride sorun yoksa
        else:

            $sonuc=$this->model->ayarlarGuncelle("uye_panel", 
            array("ad", "soyad", "mail", "telefon"),
            array($ad, $soyad, $mail, $telefon), "id=".$uyeid );
            

            // sonuç başarılıysa
            if($sonuc):

                $this->view->goster("sayfalar/panel",
                array(
                "ayarlar" => "ok",
                // güncelleme başarılı uyarısından 3sn sonra anasayfaya yönlendirme
                "bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI", "/uye/panel")
                )); 

            else:

                $this->view->goster("sayfalar/panel",
                array(
                "ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye")),
                "bilgi" => $this->bilgi->uyari("danger", " Güncelleme sırasında hata oluştu")
                ));
            
            endif;


        endif;
    


    }
    //------------------------------------------

    // -----------      ŞİFRE İŞLEMLERİ     -------------

    function sifreguncelle() {   // ÜYE ŞİFRESİNİ GÜNCELLİYOR


        // form classına gidip ad ve şifre boş mu değil mi diye bakar
        $msifre = $this->form->get("msifre")->bosmu();
        $yen1 = $this->form->get("yen1")->bosmu();
        $yen2 = $this->form->get("yen2")->bosmu();
        $uyeid = $this->form->get("uyeid")->bosmu();

        // şifrelerin uyumlu olup olmamasını karşılaştırır
        $sifre = $this->form->sifreKarsilastir($yen1, $yen2); // şifrelenmiş yeni hali alıyorum

        /*
            ÖNCE GELEN ŞİFRE SORGULANACAK DOĞRU MU DİYE
            EĞER DOĞRU İSE DEVAM EDECEK
            HATALI İSE İŞLEM BİTECEK
        */

        // mevcut şifreyi şifreleme
        $msifre = $this->form->sifrele($msifre);

        // hesap ayarlarında yazılan herhangi bi yerin boş olması
        // bir hata var demek
        if(!empty($this->form->error)):

            // boş bırakılan varsa error arrayinde hangisi olduğunu göstericek
            $this->view->goster("sayfalar/panel",
            array(
            // şifre değiştire üyenin idsini gönder
            "sifredegistir" => Session::get("uye"),
            "bilgi" => $this->bilgi->uyari("danger", " Girilen bilgiler hatalıdır.")
            ));

        // gelen veride sorun yoksa
        else:

            // MEVBUT ŞİFRE(eski şifre) DOĞRUYSA
            // giriş yapıldığında kullanıcı adına ve mevcut şifresine bakar
            $sonuc2=$this->model->GirisKontrol("uye_panel", "ad='".Session::get("kulad")."' and sifre='$msifre'");

            // giriş yapıldıysa
            if($sonuc2):

                $sonuc=$this->model->sifreGuncelle("uye_panel", 
                array("sifre"),
                // yeni yazılmış şifrenin şifrelenmiş haliyle değiştir
                array($sifre), "id=".$uyeid);

                // şifre güncelleme başarılıysa
                if($sonuc):

                    $this->view->goster("sayfalar/panel",
                    array(
                    "sifredegistir" => "ok",
                    // güncelleme başarılı uyarısından 3sn sonra anasayfaya yönlendirme
                    "bilgi" => $this->bilgi->basarili("ŞİFRE DEĞİŞTİRME BAŞARILI", "/uye/panel")
                    )); 

                else:

                    $this->view->goster("sayfalar/panel",
                    array(
                    "sifredegistir" => Session::get("uye"),
                    "bilgi" => $this->bilgi->uyari("danger", " Şifre değiştirme sırasında hata oluştu")
                    ));
                
                endif;

            // HATA VARSA
            else:

                $this->view->goster("sayfalar/panel",
                array(
                // şifre değiştire üyenin idsini gönder
                "sifredegistir" => Session::get("uye"),
                "bilgi" => $this->bilgi->uyari("danger", " Mevcut şifre hatalıdır. ")
                ));

            endif;

        endif;
    
    }

    // SİPARİŞ TAMAMLANDI
    function siparisTamamlandi() {

        if ($_POST) : // POST İLE GELİNDİYSE

        $ad=$this->form->get("ad")->bosmu();
        $soyad=$this->form->get("soyad")->bosmu();
        $mail=$this->form->get("mail")->bosmu();
        $telefon=$this->form->get("telefon")->bosmu();
        $toplam=$this->form->get("toplam")->bosmu();

        $odeme=$this->form->get("odeme")->bosmu();
        $adrestercih=$this->form->get("adrestercih")->bosmu();
        $odemeturu = ($odeme==1) ? "Nakit" : "Hata"; 
        $tarih=date("d.m.Y");

        // formda boş varsa
        if (!empty($this->form->error)) :

            $this->view->goster("sayfalar/siparistamamla",
            array("bilgi" => $this->bilgi->uyari("danger","Bilgiler eksiksiz doldurulmalıdır")));
        
        else:
    
        // 0-99999999 arasında random sayı verir
        $siparisNo=mt_rand(0,99999999);
        $uyeid=Session::get("uye");
        
        // toplu sorgu işlemini başlatma
        $this->model->TopluislemBaslat();

        // sepette ürün varsa
        if (isset($_COOKIE["urun"])) :

            
            // cookiedeki siparişleri tabloya kaydetme
            foreach ($_COOKIE["urun"] as $id => $adet) :
                
                // siparişleri çek
                $GelenUrun=$this->model->SiparisTamamlamaUrunCek("urunler","where id=".$id);
        
                $this->model->SiparisTamamlama(
                array(
                $siparisNo, 
                $adrestercih, 
                $uyeid, 
                $GelenUrun[0]["urunad"], 
                $adet,
                $GelenUrun[0]["fiyat"],
                $GelenUrun[0]["fiyat"]*$adet,
                $odemeturu,
                $tarih
                ));

            endforeach;

        
        else:
            // sepetteki ürünün siparişi tamamlandıktan sonra anasayfaya yönlendirir
            $this->bilgi->direktYonlen("/");

        endif;
        // toplu sorgu işlemini bitirme
        $this->model->TopluislemTamamla();

        // İŞLEM BİTTİĞİNDE COOKİE(SEPET) BOŞALTIR
        Cookie::SepetiBosalt();
        
        $TeslimatBilgileri=$this->model->Ekleİslemi("teslimatbilgileri",
        array("siparis_no","ad","soyad","mail","telefon"),
        array(
        $siparisNo, 
        $ad, 
        $soyad, 
        $mail, 
        $telefon
        ));

        // ekleme işleminde bi problem yoksa
        if ($TeslimatBilgileri): 
		
            $this->view->goster("sayfalar/siparistamamlandi",
            array(
            "siparisno" => $siparisNo,
            "toplamtutar" => $toplam		
            ));	
   
        else:
            
            $this->view->goster("sayfalar/siparisitamamla",
            array("bilgi" => $this->bilgi->uyari("danger","Sipariş oluşturulurken hata oluştu")));
            
        endif; 

    endif;
// POST İLE GELİNMEDİYSE    
else:

    $this->bilgi->direktYonlen("/");

endif;

    }
    
}




?>