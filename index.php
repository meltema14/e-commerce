<?php

//tek tek eklediğimiz harici dosyalarımızı otomatik ekler
spl_autoload_register(function($className)

{
    //libs dosyasındaki tüm dosyaları buraya dahil etmesini söyledik
    $dosyayolu = __DIR__ .'/libs/'. $className . '.php'; // şu an çalışılan dosya yolunu veren fonk __DIR__
    include($dosyayolu);
});

// index dosyası çalıştığında bu dosaları çalıştıracak 

require 'config/genel.php';
require 'config/database.php';
require 'config/HariciFonksiyonlar.php';
require 'Route.php';

$Route = new Route; // URL YÖNLENDİRME


?>