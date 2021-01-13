<?php

// define : sabit değişken
// genel url belirtiyoruz ki her yerde tutarlı bi şekilde hareket edebilmek için
// URL parametresini çagırdığımız her yerde sitenin(projenin urlsini kullanabileceğiz)
// ana (kök dizini) tutan parametre
define("URL", "http://localhost/mvcproje");

// controllers klasorunu tek tek cagırmamak ıcın
define ("CONTROLLER","controllers/");

// dökümantasyon olarak dosyaların tutulduğu ana dizin
define ("DOCUMENT",$_SERVER['DOCUMENT_ROOT']);

// resimlerin ekleneceği klasör yolu
define ("RESİMYOL",DOCUMENT."/mvcproje/views/design/images/");




?>