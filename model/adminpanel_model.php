<?php

// admin panel kontrolcusu
class adminpanel_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }

    function Verial ($tabloisim, $kosul) { // siparişleri çeker

        return $this->db->listele($tabloisim, $kosul);

    }

    function Guncelle($tabloisim,$sutunlar,$veriler,$kosul) { // kargodurum güncelle
		
        return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
        
	}


    

}

?>