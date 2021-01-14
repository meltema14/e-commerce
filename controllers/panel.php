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
                    "data" => $bilgicek			
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
                if ($bilgicek):
            
                    $this->view->goster("YonPanel/sayfalar/uyeler",array(
                    // ilgili id yi çekme
                    "data" =>$bilgicek		
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

    function uyeadresbak($id) { // ÜYELERİN ADRESLERİNİ GETİRİR
			
        $this->view->goster("YonPanel/sayfalar/uyeler",array(	
        "UyeadresBak" => $this->model->Verial("adresler","where uyeid=".$id)	
        ));	

    } 
    
    //--------------------------------------------------------------------------------

    function urunler () {   // ÜRÜNLER GELİYOR

        $this->view->goster("YonPanel/sayfalar/urunler",array(
    
        "data" => $this->model->Verial("urunler",false),
        "data2" => $this->model->Verial("alt_kategori",false)
         
        ));
    
    }  

    function urunarama() {  // ÜRÜNLER ARAMA

		if ($_POST) :

			$aramaverisi = $this->form->get("arama")->bosmu();
            // hata avrsa ürünler sayfasına yönlendirip uyarı verir
			if (!empty($this->form->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",
					array(
					"bilgi" => $this->bilgi->hata("KRİTER GİRİLMELİDİR.", "/panel/urunler", 2)
					)
				);
            
            // hata yoksa ürünler tablosuna bağlanıp aranacak dataları çeker
			else :

				$bilgicek = $this->model->arama("urunler",
					"urunad LIKE '%" . $aramaverisi . "%' or 
		            kumas LIKE '%" . $aramaverisi . "%'  or 
		            urtYeri LIKE '%" . $aramaverisi . "%' or 
		            stok LIKE '%" . $aramaverisi . "%'"
				);

                // gelen veriyi dizi olarak aktarma
				if ($bilgicek) :

					$this->view->goster("YonPanel/sayfalar/urunler", array(

						"data" => $bilgicek,
						"data2" => $this->model->Verial("alt_kategori", false)
					));

				else :

					$this->view->goster("YonPanel/sayfalar/urunler",array(
						"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.", "/panel/urunler", 2)
						)
					);
				endif;

			endif;

        else :
            
			$this->bilgi->direktYonlen("/panel/urunler");

		endif;
    } 

    function urunSil($id) { // ÜRÜNLER SİL	

		$sonuc = $this->model->Sil("urunler", "id=" . $id);

		if ($sonuc) :

			$this->view->goster(
				"YonPanel/sayfalar/urunler",
				array(
					"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI", "/panel/urunler", 2)
				)
			);

		else :

			$this->view->goster(
				"YonPanel/sayfalar/urunler",
				array(
					"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.", "/panel/urunler", 2)
				)
			);

		endif;
	}  
    
    function urunGuncelle($id){ // ÜRÜNLER GÜNCELLE	

		$this->view->goster("YonPanel/sayfalar/urunler", array(
			"Urunguncelle" => $this->model->Verial("urunler", "where id=" . $id),
			"data2" => $this->model->Verial("alt_kategori", false)
		));
    } 
    
    function urunguncelleSon(){ // ÜRÜNLER GÜNCEL SON

		if ($_POST) :

			$urunad = $this->form->get("urunad")->bosmu();
			$katid = $this->form->get("katid")->bosmu();
			$kumas = $this->form->get("kumas")->bosmu();
			$uretimyeri = $this->form->get("uretimyeri")->bosmu();
			$renk = $this->form->get("renk")->bosmu();
			$fiyat = $this->form->get("fiyat")->bosmu();
			$stok = $this->form->get("stok")->bosmu();
			$durum = $this->form->get("durum")->bosmu();
			$urunaciklama = $this->form->get("urunaciklama")->bosmu();
			$urunozellik = $this->form->get("urunozellik")->bosmu();
			$urunekstra = $this->form->get("urunekstra")->bosmu();
			$kayitid = $this->form->get("kayitid")->bosmu();

            if ($this->Upload->uploadPostAl("res1")) : 
                $this->Upload->UploadDosyaKontrol("res1");
			endif;

            if ($this->Upload->uploadPostAl("res2")) : 
                $this->Upload->UploadDosyaKontrol("res2");
			endif;

            if ($this->Upload->uploadPostAl("res3")) : 
                $this->Upload->UploadDosyaKontrol("res3");
			endif;


			if (!empty($this->form->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",array(
					"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.", "/panel/urunler", 2)
				));

			elseif (!empty($this->Upload->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",array(
					"bilgi" => $this->Upload->error,
					"yonlen" => $this->bilgi->sureliYonlen(3, "/panel/urunler")
				));

			else :

				$sutunlar = array("katid", "urunad", "durum", "aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok", "ozellik", "ekstraBilgi");

				$veriler = array($katid, $urunad, $durum, $urunaciklama, $kumas, $uretimyeri, $renk, $fiyat, $stok, $urunozellik, $urunekstra);


				if ($this->Upload->uploadPostAl("res1")) :
                    $sutunlar[] = "res1";
                    // yükleyecek ve sonra veriler arrayine yazıcak
					$veriler[] = $this->Upload->Yukle("res1", true);
				endif;

				if ($this->Upload->uploadPostAl("res2")) :
					$sutunlar[] = "res2";
					$veriler[] = $this->Upload->Yukle("res2", true);
				endif;
				if ($this->Upload->uploadPostAl("res3")) :
					$sutunlar[] = "res3";
					$veriler[] = $this->Upload->Yukle("res3", true);
				endif;

                // güncel hali $sonuc değişkeninde
				$sonuc = $this->model->Guncelle(
					"urunler",
					$sutunlar,
					$veriler,
					"id=" . $kayitid
				);

				if ($sonuc) :

					$this->view->goster(
						"YonPanel/sayfalar/urunler",array(
						"bilgi" => $this->bilgi->basarili("ÜRÜN BAŞARIYLA GÜNCELLENDİ", "/panel/urunler", 2)
					));

				else :

					$this->view->goster(
						"YonPanel/sayfalar/urunler",array(
						"bilgi" => $this->bilgi->hata("GÜNCELLEME SIRASINDA HATA OLUŞTU.", "/panel/urunler", 2)
				    ));

				endif;

			endif;

		else :
			$this->bilgi->direktYonlen("/panel/urunler");


		endif;
    } 
    
	function katgoregetir() { // ÜRÜNLERi KATEGORİYE GÖRE GETİR	

		if ($_POST) :

            // $katid: selectboxtan gelen name
			$katid = $this->form->get("katid")->bosmu();

			$bilgicek = $this->model->Verial("urunler", "where katid=" . $katid);

			if ($bilgicek) :

				$this->view->goster("YonPanel/sayfalar/urunler", array(

					"data" => $bilgicek,
					"data2" => $this->model->Verial("alt_kategori", false)
				));

			else :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",
					array(
						"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.", "/panel/urunler", 2)
					)
				);
			endif;

        else :
            
			$this->bilgi->direktYonlen("/panel/urunler");

		endif;
	} 

    function Urunekleme(){  // ÜRÜN EKLEME

		$this->view->goster("YonPanel/sayfalar/urunler", array(
            "Urunekleme" => true,
            // selectbox
			"data2" => $this->model->Verial("alt_kategori", false)
		));
    }	 
    
    function urunekle(){    // ÜRÜN EKLEME SON	

		if ($_POST) :

            // form verilerinin boş olup olmadığını test eder
			$urunad = $this->form->get("urunad")->bosmu();
			$katid = $this->form->get("katid")->bosmu();
			$kumas = $this->form->get("kumas")->bosmu();
			$uretimyeri = $this->form->get("uretimyeri")->bosmu();
			$renk = $this->form->get("renk")->bosmu();
			$fiyat = $this->form->get("fiyat")->bosmu();
			$stok = $this->form->get("stok")->bosmu();
			$durum = $this->form->get("durum")->bosmu();
			$urunaciklama = $this->form->get("urunaciklama")->bosmu();
			$urunozellik = $this->form->get("urunozellik")->bosmu();
			$urunekstra = $this->form->get("urunekstra")->bosmu();

            // resimleri kontrol eder
			$this->Upload->UploadResimYeniEkleme("res", 3);

            // form elemanlarında boş alan bırakıldıysa
			if (!empty($this->form->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",array(
					"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.", "/panel/urunler", 2)
				));

            // resim yüklemede sorun var mı
			elseif (!empty($this->Upload->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/urunler",array(
					"bilgi" => $this->Upload->error
				));

            // sorun yoksa kayıt işlemine başlar
			else :

				$dosyayukleme = $this->Upload->Yukle();

				$sonuc = $this->model->Ekleme(
					"urunler",
					array("katid", "urunad", "res1", "res2", "res3", "durum", "aciklama", "kumas", "urtYeri", "renk", "fiyat", "stok", "ozellik", "ekstraBilgi"),
					array($katid, $urunad, $dosyayukleme[0], $dosyayukleme[1], $dosyayukleme[2], $durum, $urunaciklama, $kumas, $uretimyeri, $renk, $fiyat, $stok, $urunozellik, $urunekstra)
				);

				if ($sonuc) :

					$this->view->goster(
						"YonPanel/sayfalar/urunler",array(
						"bilgi" => $this->bilgi->basarili("ÜRÜN BAŞARIYLA EKLENDİ", "/panel/urunler", 2)
					));

				else :

					$this->view->goster(
						"YonPanel/sayfalar/urunler",array(
						"bilgi" => $this->bilgi->hata("EKLEME SIRASINDA HATA OLUŞTU.", "/panel/urunler", 2)
					));

				endif;

			endif;

        else :
            
			$this->bilgi->direktYonlen("/panel/urunler");

		endif;
	}	 
   
    //--------------------------------------------------------------------------------

    function bulten () {   // BÜLTEN GELİYOR

        $this->view->goster("YonPanel/sayfalar/bulten",array(
    
        "data" => $this->model->Verial("bulten",false)
         
        ));
    
    }

    function mailSil($id) { // BÜLTEN MAİL SİL	

		$sonuc = $this->model->Sil("bulten", "id=" . $id);

		if ($sonuc) :

			$this->view->goster(
				"YonPanel/sayfalar/bulten",
				array(
					"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI", "/panel/bulten", 2)
				)
			);

		else :

			$this->view->goster(
				"YonPanel/sayfalar/urunler",
				array(
					"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.", "/panel/bulten", 2)
				)
			);

		endif;
    } 
    
    function mailarama() {	// BÜLTEN MAİL ARAMA

        if ($_POST) :
                
            $aramaverisi=$this->form->get("arama")->bosmu();
            // hata varsa
            if (!empty($this->form->error)) :
            
            $this->view->goster("YonPanel/sayfalar/bulten",
            array(		
            "bilgi" => $this->bilgi->hata("MAİL YAZILMALIDIR.","/panel/bulten",2)
            ));      
            
            else:
                // arama sorgu atıyor
                $bilgicek=$this->model->arama("bulten",
                "mailadres LIKE '%".$aramaverisi."%'");
                
                if ($bilgicek):
            
                    $this->view->goster("YonPanel/sayfalar/bulten",array(
                    // ilgili id yi çekme
                    "data" =>$bilgicek		
                    ));		
                
                else:
                
                    $this->view->goster("YonPanel/sayfalar/bulten",
                    array(		
                    "bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/bulten",2)
                    ));	
                    		
                endif;
                
            endif;

        else:
            // posttan gelinmiyor ise
            $this->bilgi->direktYonlen("/panel/bulten");		
    
        endif;
    } 

    function tarihegoregetir() {	// BÜLTEN TARİHE GÖRE ARAMA ARAMA

        if ($_POST) :
                
            $tar1=$this->form->get("tar1")->bosmu();
            $tar2=$this->form->get("tar2")->bosmu();

            // hata varsa
            if (!empty($this->form->error)) :
            
            $this->view->goster("YonPanel/sayfalar/bulten",
            array(		
            "bilgi" => $this->bilgi->hata("TARİHLER BELİRTİLMELİDİR.","/panel/bulten",2)
            ));      
            
            else:
                // uye_panele sorgu atıyor
                $bilgicek=$this->model->Verial("bulten",
                // seçilen iki tarih arasını alır
                "where DATE(tarih) BETWEEN '".$tar1."' and '".$tar2."'");
                
                if ($bilgicek):
            
                    $this->view->goster("YonPanel/sayfalar/bulten",array(
                    // ilgili id yi çekme
                    "data" =>$bilgicek		
                    ));		
                
                else:
                
                    $this->view->goster("YonPanel/sayfalar/bulten",
                    array(		
                    "bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/bulten",2)
                    ));	
                    		
                endif;
                
            endif;

        else:
            // posttan gelinmiyor ise
            $this->bilgi->direktYonlen("/panel/bulten");		
    
        endif;
    } 

    //--------------------------------------------------------------------------------
    
    function sistemayar () {   // SİSTEM AYARLARI GELİYOR

        $this->view->goster("YonPanel/sayfalar/sistemayar",array(
    
        "sistemayar" => $this->model->Verial("ayarlar",false)
         
        ));
    
    }

    function ayarguncelle(){    // SİSTEM AYARLARI GÜNCELLEME SON	

		if ($_POST) :

            // form verilerinin boş olup olmadığını test eder
			$sloganust1 = $this->form->get("sloganust1")->bosmu();
			$sloganalt1 = $this->form->get("sloganalt1")->bosmu();
			$sloganust2 = $this->form->get("sloganust2")->bosmu();
			$sloganalt2 = $this->form->get("sloganalt2")->bosmu();
			$sloganust3 = $this->form->get("sloganust3")->bosmu();
			$sloganalt3 = $this->form->get("sloganalt3")->bosmu();

			$sayfatitle = $this->form->get("sayfatitle")->bosmu();
			$sayfaaciklama = $this->form->get("sayfaaciklama")->bosmu();
            $anahtarkelime = $this->form->get("anahtarkelime")->bosmu();
            $kayitid = $this->form->get("kayitid")->bosmu();

            // form elemanlarında boş alan bırakıldıysa
			if (!empty($this->form->error)) :

				$this->view->goster(
					"YonPanel/sayfalar/sistemayar",array(
					"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.", "/panel/sistemayar", 2)
				));

            // sorun yoksa kayıt işlemine başlar
			else :

				$sonuc = $this->model->Guncelle(
					"ayarlar",
					array("sloganUst1", "sloganAlt1", "sloganUst2", "sloganAlt2", "sloganUst3", "sloganAlt3", "title", "sayfaAciklama", "anahtarKelime"),
					array($sloganust1, $sloganalt1, $sloganust2, $sloganalt2, $sloganust3, $sloganalt3, $sayfatitle, $sayfaaciklama, $anahtarkelime), "id=".$kayitid
				);

				if ($sonuc) :

					$this->view->goster(
						"YonPanel/sayfalar/sistemayar",array(
						"bilgi" => $this->bilgi->basarili("SİSTEM AYARLARI BAŞARIYLA GÜNCELLENDİ", "/panel/sistemayar", 2)
					));

				else :

					$this->view->goster(
						"YonPanel/sayfalar/sistemayar",array(
						"bilgi" => $this->bilgi->hata("GÜNCELLEME SIRASINDA HATA OLUŞTU.", "/panel/sistemayar", 2)
					));

				endif;

			endif;

        else :
            
			$this->bilgi->direktYonlen("/panel/sistemayar");

		endif;
    }

    //--------------------------------------------------------------------------------
    
    function sistembakim () {  // SİSTEM BAKİM

        $this->view->goster("YonPanel/sayfalar/bakim",array(
    
            "sistembakim" => true
             
        ));

    }

    function bakimyap() { // SİSTEM BAKİM BUTONUNA BASILDIĞINDA

        // sistembtn a basıldıysa işlem yap
        if ($_POST["sistembtn"]):

            $bakim = $this->model->bakim("mvcproje");

            if ($bakim) :

                $this->view->goster(
                    "YonPanel/sayfalar/bakim",array(
                    "bilgi" => $this->bilgi->basarili("SİSTEM BAKIMI BAŞARIYLA YAPILDI", "/panel/sistembakim", 2)
                ));

            else :

                $this->view->goster(
                    "YonPanel/sayfalar/bakim",array(
                    "bilgi" => $this->bilgi->hata("BAKIM SIRASINDA HATA OLUŞTU.", "/panel/sistembakim", 2)
                ));

            endif;

        else :
            
            $this->bilgi->direktYonlen("/panel/sistembakim");

        endif;
    }
    
    



}




?>