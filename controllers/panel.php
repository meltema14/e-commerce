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
        "data" => $this->model->Verial("siparisler",false)

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
				
        else:
            
			$this->bilgi->direktYonlen("/panel/siparisler");
				
		endif;       
  
    }
    
     
}




?>