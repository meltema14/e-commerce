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

    function giris() { // ADMİN PANEL GİRİŞ SAYFASI

        // yönetim paneli giriş ekranını yükledik
        $this->view->goster("YonPanel/sayfalar/index");

    }

    function siparisler() { // ADMİN PANEL SİPARİS SAYFASI

        // yönetim paneli siparisler ekranını yükledik
        $this->view->goster("YonPanel/sayfalar/siparis");

    }
    
     
}




?>