<?php

// admin panel kontrolcusu
class panel extends Controller {

    function __construct()
    {
        parent::__construct();

        // adminpanel_model yükledik
        $this->Modelyukle('adminpanel');

        // her kontorolcünün constructında çalıştır
        Session::init();

    }

    function giris() { //  GİRİŞ EKRANI

        // yönetim paneli giriş ekranını yükledik
        $this->view->goster("YonPanel/sayfalar/index");

    }

    //--------------------------------------------------------------------------------

    function siparisler() { // SİPARİSLERİN ANA EKRANI

        // yönetim paneli siparisler ekranına dbden gelen verileri yükleme
        $this->view->goster("YonPanel/sayfalar/siparis",array(
        
        // dönen sonucu dataya gönder
        "data" => $this->model->Verial("siparisler", "order by id desc")

        ));

    }

    function kargoguncelle($sipno) { // SİPARİSLER KARGO DURUM GÜNCELLEME
         
        // yönetim paneli siparisler ekranına dbden gelen verileri yükleme
        $this->view->goster("YonPanel/sayfalar/siparis",array(
        
        // dönen sonucu KargoGuncelle gönder
        "KargoGuncelle" => $this->model->Verial("siparisler", "where siparis_no=".$sipno)

        ));

    }

    function kargoguncelleSon() { // SİPARİSLER KARGO DURUM GÜNCELLEME

        if ($_POST) :	
		
            $sipno=$this->form->get("sipno")->bosmu();
            // selectbox ın value değeri
            $durum=$this->form->get("durum")->bosmu();

            $sonuc=$this->model->Guncelle("siparisler",
		    array("kargodurum"),
		    array($durum),"siparis_no=".$sipno);
	
            if ($sonuc): // sonuç başarılı ise
        
                $this->view->goster("YonPanel/sayfalar/siparis",
                array(
                "bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/siparisler")
                ));
                    
            else:
            
                $this->view->goster("YonPanel/sayfalar/siparis",
                array(
                "data" => $this->model->Verial("siparisler",false),
                "bilgi" => $this->bilgi->uyari("danger","Güncelleme sırasında hata oluştu.")
                ));	
            
            endif;
		// post harici bi yerden giriliyorsa		
        else:
            
			$this->bilgi->direktYonlen("/panel/siparisler");
				
		endif;       
  
    }
    
    function siparisarama() {   // SİPARİŞ ARAMA

        // arama inputundan giriş yapıldıysa
        if ($_POST) :

            $aramatercih=$this->form->get("aramatercih")->bosmu();
		
            $aramaverisi=$this->form->get("aramaverisi")->bosmu();

            // arama kısmı boşsa
            if (!empty($this->form->error)) :
                    
                $this->view->goster("YonPanel/sayfalar/siparis",
                array(		
                "bilgi" => $this->bilgi->hata("BİLGİ GİRİLMELİDİR.","/panel/siparisler",1)
                ));

            // selectboxtan gelen tercihe göre işlem yapma
            else:

                // sipariş numarasına göre arama
                if ($aramatercih=="sipno") :
				
                    $this->view->goster("YonPanel/sayfalar/siparis",array(
                    
                    // aranan numarayı arayıp data parametrisine gönderdim
                    "data" => $this->model->arama("siparisler","siparis_no LIKE '".$aramaverisi."'")));	
                    
                // üye bilgilerine göre arama
                elseif($aramatercih=="uyebilgi"):
                    
                    // eşleşen üyenin bilgisini alma
                    // üye panelden id, ad, soyad sütunlarında aranan veriyi içeren varsa alıcak
                    $bilgicek=$this->model->arama("uye_panel",
                    "id LIKE '%".$aramaverisi."%' or 
                    ad LIKE '%".$aramaverisi."%'  or 
                    soyad LIKE '%".$aramaverisi."%' or 
                    telefon LIKE '%".$aramaverisi."%'");
                    
                    if ($bilgicek):
                
                    $this->view->goster("YonPanel/sayfalar/siparis",array(				
                    "data" => $this->model->Verial("siparisler", "where uyeid=".$bilgicek[0]["id"])			
                    ));		
                    
                    else:
                    
                    $this->view->goster("YonPanel/sayfalar/siparis",
                    array(		
                    "bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/siparisler",2)
                    ));			
                    endif;

                endif;

            endif;

        else:

			$this->bilgi->direktYonlen("/panel/siparisler");		
		
		endif;

    }

    //--------------------------------------------------------------------------------

    function kategoriler() { // KATEGORİLER ANA EKRANA GELİYOR
			
        $this->view->goster("YonPanel/sayfalar/kategoriler",array(
        // kategoriler sayfasına ayrı ayrı sorgu atarak sorgunun sonuçlarını
        // dizi oalrak tablolara gönderme
        "anakategori" => $this->model->Verial("ana_kategori",false),
        "cocukkategori" => $this->model->Verial("cocuk_kategori",false),
        "altkategori" => $this->model->Verial("alt_kategori",false)

        ));
     
    }

    function kategoriGuncelle($kriter,$id){ // KATEGORİ GÜNCELLEME
        // $kriter: ana, çocuk, alt
        $this->view->goster("YonPanel/sayfalar/kategoriguncelleme",array(
            //kategoriguncelleme sayfasına db den cektiğimizsorguları atıyoruz
            "data" => $this->model->Verial($kriter."_kategori","where id=".$id),
            // get ile gelen kriteri(ana, cocuk, alt) gönderme
            "kriter" => $kriter,
            "AnaktegorilerTumu" => $this->model->Verial("ana_kategori",false),
            "CocukkategorilerTumu" => $this->model->Verial("cocuk_kategori",false)
        
        ));	
        
    }

    function kategoriGuncelSon() { // KATEGORİLER GÜNCELLENİYOR VE SON POST İŞLEMİ
    
        if ($_POST) :	

            $kriter=$this->form->get("kriter")->bosmu();
            $kayitid=$this->form->get("kayitid")->bosmu();
            $katad=$this->form->get("katad")->bosmu();

            @$anakatid=$_POST["anakatid"];
            @$cocukkatid=$_POST["cocukkatid"];

            // kategori id boş bırakıldığında hataya düşer
            if (!empty($this->form->error)) :
		
                $this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
                array(		
                "bilgi" => $this->bilgi->hata("Kategori adı girilmelidir.","/panel/kategoriler",1)

            ));

            // hata yoksa
            else:

                // kategori ana ise adı günceller
                if ($kriter=="ana") :

                    $sonuc=$this->model->Guncelle("ana_kategori",
                    array("ad"),
                    array($katad),"id=".$kayitid);
                
                // kategori cocuk ise ana_kat_id ve adı günceller
                elseif($kriter=="cocuk") :
                
                    $sonuc=$this->model->Guncelle("cocuk_kategori",
                    array("ana_kat_id","ad"),
                    array($anakatid,$katad),"id=".$kayitid);

                // kategori alt ise cocuk_kat_id, ana_kat_id, ad günceller
                elseif($kriter=="alt") :

                    $sonuc=$this->model->Guncelle("alt_kategori",
                    array("cocuk_kat_id","ana_kat_id","ad"),
                    array($cocukkatid,$anakatid,$katad),"id=".$kayitid);
                    endif;
                
                // herhangi birinde güncelleme yapıldıysa
                if ($sonuc): 

                    $this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
                    array(
                    "bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/kategoriler",2)
                    ));
                        
                else:

                    $this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
                    array(
                    "bilgi" => $this->bilgi->hata("GÜNCELLEME SIRASINDA HATA OLUŞTU.","/panel/kategoriler",2)
                    ));	
            
                endif;

            endif;
    
            else:

            $this->bilgi->direktYonlen("/panel/kategoriler");
                
            endif;	

    }

    function kategoriSil($kriter,$id) { // KATEGORİ SİL

        $sonuc=$this->model->Sil($kriter."_kategori","id=".$id);
    
        if ($sonuc): 
    
            $this->view->goster("YonPanel/sayfalar/kategoriler",
            array(
            "bilgi" => $this->bilgi->basarili("SİLME BAŞARILI","/panel/kategoriler",2)
            ));
                
        else:
    
            $this->view->goster("YonPanel/sayfalar/kategoriler",
            array(
            "bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.","/panel/kategoriler",2)
            ));	
    
        endif;
    }

    function kategoriEkle($kriter) { // KATEGORİ EKLE

        $this->view->goster("YonPanel/sayfalar/kategoriEkle",
        array("kriter" => $kriter,
        "AnaktegorilerTumu" => $this->model->Verial("ana_kategori",false),
        "CocukkategorilerTumu" => $this->model->Verial("cocuk_kategori",false)));		
    
    } 

    function kategoriEkleSon() { // KATEGORİ EKLE SON

        if ($_POST) :	

			$kriter=$this->form->get("kriter")->bosmu();		
			$katad=$this->form->get("katad")->bosmu();
			
			@$anakatid=$_POST["anakatid"];
			@$cocukkatid=$_POST["cocukkatid"];

            // hata varsa kategoriler sayfasına yönlendir
			if (!empty($this->form->error)) :
			
                $this->view->goster("YonPanel/sayfalar/kategoriekle",
                array(		
                "bilgi" => $this->bilgi->hata("Kategori adı girilmelidir.","/panel/kategoriler",1)
			));		
			
            else:	

                if ($kriter=="ana") :

                    $sonuc=$this->model->Ekleme("ana_kategori",
                    array("ad"),
                    array($katad));
                            
                    elseif($kriter=="cocuk") :

                    $sonuc=$this->model->Ekleme("cocuk_kategori",
                    array("ana_kat_id","ad"),
                    array($anakatid,$katad));
                        
                    elseif($kriter=="alt") :
                
                    $sonuc=$this->model->Ekleme("alt_kategori",
                    array("cocuk_kat_id","ana_kat_id","ad"),
                    array($cocukkatid,$anakatid,$katad));

                endif;

                // sonuç olumlu ise başarılı uyarısı gösterir ve kategoriler sayfasına yönlendirir
                if ($sonuc): 

                    $this->view->goster("YonPanel/sayfalar/kategoriekle",
                    array(
                    "bilgi" => $this->bilgi->basarili("EKLEME BAŞARILI","/panel/kategoriler",2)
                    ));
                        
                else:
            
                    $this->view->goster("YonPanel/sayfalar/kategoriekle",
                    array(
                    "bilgi" => $this->bilgi->hata("EKLEME SIRASINDA HATA OLUŞTU.","/panel/kategoriler",2)
                    ));	
            
                endif;
                
            endif;
		
        else:

            $this->bilgi->direktYonlen("/panel/kategoriler");

        endif;	         

    }   

    //--------------------------------------------------------------------------------

    function uyeler () {  // ÜYELER ANA EKRANA GELİYOR	

        $this->view->goster("YonPanel/sayfalar/uyeler",array(
    
        "data" => $this->model->Verial("uye_panel",false)
    
        ));
    }  

    function uyearama() {	// ÜYE ARAMA

        if ($_POST) :
                
            $aramaverisi=$this->form->get("aramaverisi")->bosmu();
            
            // boş bırakılmadıysa hata yoksa uyeler sayfasına yönlendir
            if (!empty($this->form->error)) :
            
            $this->view->goster("YonPanel/sayfalar/uyeler",
            array(		
            "bilgi" => $this->bilgi->hata("KRİTER GİRİLMELİDİR.","/panel/uyeler",2)
            ));      
            
            else:
                // uye_panele sorgu atıyor
                $bilgicek=$this->model->arama("uye_panel",
                "id LIKE '%".$aramaverisi."%' or 
                ad LIKE '%".$aramaverisi."%'  or 
                soyad LIKE '%".$aramaverisi."%' or 
                telefon LIKE '%".$aramaverisi."%'");
                
                // girilen veri(kriter:ad,soyad,id,telefon) tanımlı ise
                if (isset($bilgicek[0]["id"])):
            
                    $this->view->goster("YonPanel/sayfalar/uyeler",array(
                    // ilgili id yi çekme
                    "data" => $this->model->Verial("uye_panel", "where id=".$bilgicek[0]["id"])			
                    ));		
                
                else:
                
                    $this->view->goster("YonPanel/sayfalar/uyeler",
                    array(		
                    "bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/uyeler",2)
                    ));	
                    		
                endif;
                
            endif;

        else:
            // posttan gelinmiyor ise
            $this->bilgi->direktYonlen("/panel/uyeler");		
    
        endif;
    } 

    function uyeSil($id) {  // ÜYE SİL	

        // üye panelde seçilen idli ürünü sil
		$sonuc=$this->model->Sil("uye_panel","id=".$id);

        // silme başarılıysa üyeler tablosunda SİLME BAŞARILI uyarısı göster
		if ($sonuc): 

			$this->view->goster("YonPanel/sayfalar/uyeler",
			array(
			"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI","/panel/uyeler",2)
            ));
            
		// hata varsa
		else:

			$this->view->goster("YonPanel/sayfalar/uyeler",
			array(
			"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.","/panel/uyeler",2)
			));	

		endif;

    }  
    
    function uyeGuncelle($id) { // ÜYELER GÜNCELLE
			
        $this->view->goster("YonPanel/sayfalar/uyeler",array(	
        "Uyeguncelle" => $this->model->Verial("uye_panel","where id=".$id)	
        ));	

    } 

    function uyeguncelleSon() { // ÜYELER GÜNCEL SON	
        
        // bilgiler posttan girildiyse
		if ($_POST) :	
            
            // forma girilen bilgileri çekme
			$ad=$this->form->get("ad")->bosmu();
			$soyad=$this->form->get("soyad")->bosmu();
			$mail=$this->form->get("mail")->bosmu();
			$telefon=$this->form->get("telefon")->bosmu();
			//$durum=$this->form->get("durum")->bosmu();
			$uyeid=$this->form->get("uyeid")->bosmu();
			$durum=$_POST["durum"];
            
            // formdan girilen verilerden herhangi biri boş bırakıldıysa
			if (!empty($this->form->error)) :
			
                $this->view->goster("YonPanel/sayfalar/uyeler",
                array(		
                "bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.","/panel/uyeler",2)
                ));		
			
            else:	
                    
                $sonuc=$this->model->Guncelle("uye_panel",
                array("ad","soyad","mail","telefon","durum"),
                array($ad,$soyad,$mail,$telefon,$durum),"id=".$uyeid);
                    
                if ($sonuc): 

                    $this->view->goster("YonPanel/sayfalar/uyeler",
                    array(
                    "bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/uyeler",2)
                    ));
                        
                else:
                
                    $this->view->goster("YonPanel/sayfalar/uyeler",
                    array(
                    "bilgi" => $this->bilgi->hata("GÜNCELLEME SIRASINDA HATA OLUŞTU.","/panel/uyeler",2)
                    ));	
                
                endif;
            
            endif;	
				
        else:
            
			$this->bilgi->direktYonlen("/panel/uyeler");
				
		endif;		
		


		
	} 

   
    



}




?>