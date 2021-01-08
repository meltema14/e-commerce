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
    
    function siparisarama() {   // SİPARİŞ NO İLE ARAMA

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

                if ($aramatercih=="sipno") :
				
				
                    $this->view->goster("YonPanel/sayfalar/siparis",array(
                    
                    // aranan numarayı arayıp data parametrisine gönderdim
                    "data" => $this->model->arama("siparisler","siparis_no LIKE '".$aramaverisi."'")));	
                    
                elseif($aramatercih=="uyebilgi"):
                    
                    // eşleşen üyenin bilgisini alma
                    // üye panelden id ad soyad sütunlarında aranan veriyi içeren varsa alıcak
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
     
}




?>