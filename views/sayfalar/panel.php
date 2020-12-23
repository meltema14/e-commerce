<?php require 'views/header.php'; ?>


<?php  

// üye girişi yapıldıysa(oturum açıldıysa) kontrol yap
// oturum açılmadıysa İŞLEMLER kısmı gözükmeyecek
if (Session::get("kulad") && Session::get("uye")) :


?>

<div class="container" id="UyeCont">
    
    <div class="row">
        
        <div class="col-md-2" id="menu">
            
            <div class="row" id="uyepanel">
                
                <div class="col-md-12" id="baslik">İŞLEMLER</div>
                    
                <ul>
                    <li>Siparislerim</li>
                    <li>Hesap Ayarları</li>
                    <li><a href="<?php echo URL;?>/uye/adreslerim">Adreslerim</li>
                    <li><a href="<?php echo URL;?>/uye/yorumlarim">Ürün Yorumlarım</li>
                    <li><a href="<?php echo URL;?>/uye/cikis">Oturumu Kapat</a></li>
                    
                </ul>              
                
            </div>	          
            
        </div>   

        <!-- İŞLEM BÖLÜMÜ(yorumlar, adres) -->
        <div class="col-md-10">
        

        <?php 

            // $key: adres, yorumlar gibi kısımlar
            // veri arrayini anahtar ve değer olarak parçaladı
            foreach ($veri as $key => $deger) :

                // parçalanan verinin anahtarına bakar
                switch ($key) :

                case "yorumlar":
                    // yorumları deger olarak parcala
                    foreach ($veri["yorumlar"] as $deger):

                        echo $deger["ad"]."<br>";

                    endforeach;

                break;

                case "adres":
                    // adresleri deger olarak parcala
                    foreach ($veri["adres"] as $deger):

                        echo $deger["adres"]."<br>";

                    endforeach;


                break;

                case "ayarlar":

                break;

                case "siparisler":

                break;

                endswitch;
                
            endforeach;
        ?>




        </div>
        
    </div>        
	
</div>


<?php


else:
    // anasayfaya yönlendirir
    header("Location:".URL);

endif;   

?>



<?php require 'views/footer.php'; ?> 		
        
        
        
       