<?php


// sayfa yükleme viewi
class View {

    // ilk hali: ($dosyaad, $header = null, $yonlen = null, $data1 = null, $data2 = null, $data3 = null) {
    // null olanlar verilirse çalışacak verilmezse hata vermeyecek
    public function goster($dosyaad, array $veri = NULL) { 
        
        // require yani bir dosya dahil eder
        require 'views/'. $dosyaad . '.php'; 


    }


}




?>