<?php


// sayfa yükleme viewi
class View {

    // null olanlar verilirse çalışacak verilmezse hata vermeyecek
    public function goster($dosyaad, $data = null, $yonlen = null) { 
        // require yani bir dosya dahil eder
        require 'views/'. $dosyaad . '.php'; 


    }


}




?>