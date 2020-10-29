<?php

// ana model dosyasından miras aldık
class login_model extends Model {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct(); 

    }

    function giriskontrol($tabload, $kosul) {

        return $this-> db -> giriskontrol($tabload, $kosul);

    }


}

?>