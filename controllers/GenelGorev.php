<?php


class GenelGorev extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk buranın içi çalışır
    function __construct()
    {
        parent::__construct();

        // GenelGorev model dosyasını ekleme
        $this->Modelyukle('GenelGorev');

    }

    function YorumFormKontrol()  { // YORUM KONTROL

        // --------- AD VE YORUM KISMINDA BOŞ VAR MI DİYE KONTROL EDİYORUZ ---------

        $ad = $this->form->get("ad")->bosmu();
        $yorum = $this->form->get("yorum")->bosmu();
        $urunid = $this->form->get("urunid")->bosmu();
        $tarih = date("d-m-Y");

        // ad ya da yorum boşsa
        // bir hata var demek
        if(!empty($this->form->error)):

            echo $this->bilgi->uyari("danger"," lÜTFEN BOŞ ALAN BIRAKMAYINIZ. ");
            
        // gelen ad ve yorum verisinde sorun yoksa
        else:

            // gelen verilerden eşleşen var mı diye db ye soruyoruz
            // 0 ya da 1 olarak geri döndürecek
            $sonuc=$this->model->YorumEkleme("yorumlar", 
            // sütunlar
            array("urunid", "ad", "icerik","tarih"),
            // değerler
            array($urunid, $ad, $yorum, $tarih)
            );

            // giriş yapıldıysa
            if($sonuc==1):

                // üye olma işlemi tamamlandıysa
                /*$this->view->goster("sayfalar/uyeol",
                array("bilgi" => $this->bilgi->uyari("success"," KAYIT BAŞARILI ")));*/
                
                echo $this->bilgi->uyari("success","KAYIT BAŞARILI", 'id="ok"');

            else:

                // eşleşme yok yani üye yok
                /*$this->view->goster("sayfalar/uyeol",
                array(
                "bilgi" => 
                $this->bilgi->uyari("danger"," Kayıt esnasında hata oluştu"))); */

                echo $this->bilgi->uyari("danger"," HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ.");
            

            endif;

        endif;

    }

    function BultenKayit()  { // BÜLTENE KAYIT KONTROL

        // --------- MAİL GEÇERLİ Mİ DİYE KONTROL EDİYORUZ ---------

        $mailadres = $this->form->get("mailadres")->bosmu();

        // girilen mail adresini fonksiyona verdik
        $this->form->GercektenMailmi($mailadres);
        $tarih = date("d-m-Y");


        // mail boşsa
        // bir hata var demek
        if(!empty($this->form->error)):

            echo $this->bilgi->uyari("danger"," GİRİLEN MAİL ADRESİ GEÇERSİZ. ");
            
        // mailde bir sorun yoksa
        else:

            // gelen verilerden eşleşen var mı diye db ye soruyoruz
            // 0 ya da 1 olarak geri döndürecek
            $sonuc=$this->model->iletisimForm("bulten", 
            // sütunlar
            array("mailadres","tarih"),
            // değerler
            array($mailadres, $tarih)
            );

            // KAYIT EDİLDİYSE
            if($sonuc==1):
                
                echo $this->bilgi->uyari("success","Bültene başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz.", 'id="bultenok"');

            else:

                echo $this->bilgi->uyari("danger"," HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ.");
            
            endif;

        endif;

    }

    function iletisim() { // iletişim sayfası formu gönderme

        // textler boş mu dolu mu diye kontrol eder
        $ad = $this->form->get("ad")->bosmu();
        $mail = $this->form->get("mail")->bosmu();
        $konu = $this->form->get("konu")->bosmu();
        $mesaj = $this->form->get("mesaj")->bosmu();

        // girilen mail adresinin gerçek mail adresi olup olmadığını ilgili fonksiyon kontrol eder
        @$this->form->GercektenMailmi($mail);
        $tarih = date("d-m-Y");


        // mail boşsa
        // bir hata var demek
        if(!empty($this->form->error)):

            echo $this->bilgi->uyari("danger"," LÜTFEN TÜM BİLGİLERİ UYGUN GİRİNİZ ");
            
        // mailde bir sorun yoksa
        else:

            // gelen verilerden eşleşen var mı diye db ye soruyoruz
            // 0 ya da 1 olarak geri döndürecek
            $sonuc=$this->model->iletisimForm("iletisim", 
            // sütunlar
            array("ad", "mail", "konu", "mesaj","tarih"),
            // değerler
            array($ad, $mail, $konu, $mesaj, $tarih));

            // KAYIT EDİLDİYSE
            if($sonuc==1):
                
                echo $this->bilgi->uyari("success","Mesajınız alındı. En kısa sürede dönüş yapılacaktır. Teşekkür ederiz.", 'id="formok"');

            else:

                echo $this->bilgi->uyari("danger"," HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ.");
            
            endif;

        endif;

    }

    // form buraya gelecek burdan id ve adet eklenecek
    function SepeteEkle() {

        /*echo $id = $this->form->get("id")->bosmu()."<br>";
        echo $adet = $this->form->get("adet")->bosmu();*/
        
        Cookie::SepeteEkle($this->form->get("id")->bosmu(),
        $this->form->get("adet")->bosmu());

    }

    function UrunSil() { // ürünleri tek tek siler

       
        Cookie::UrunUcur(17);

    }

    function UrunGuncelle() {

        Cookie::Guncelle(4, 7);

    }
    
    function SepetiBosalt() { // bütün ürünleri siler

        Cookie::SepetiBosalt(4, 7);

    }


}

?>