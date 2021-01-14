<?php require 'views/header.php'; ?>


<?php  

// üye girişi yapıldıysa(oturum açıldıysa) kontrol yap
// oturum açılmadıysa İŞLEMLER kısmı gözükmeyecek
if (Session::get("kulad") && Session::get("uye")) :

    // oturum kontrolü
    Session::OturumKontrol("uye_panel",Session::get("kulad"),Session::get("uye"));

?>

<div class="container" id="UyeCont">
    
    <div class="row">
        
        <div class="col-md-2" id="menu">
            
            <div class="row" id="uyepanel">
                
                <div class="col-md-12" id="baslik">İŞLEMLER</div>
                    
                <ul>
                    <li><a href="<?php echo URL; ?>/uye/siparislerim">Siparislerim</li>
                    <li><a href="<?php echo URL;?>/uye/yorumlarim">Ürün Yorumlarım</li>
                    <li><a href="<?php echo URL;?>/uye/adreslerim">Adreslerim</li>
                    <li><a href="<?php echo URL; ?>/uye/hesapayarlarim">Hesap Ayarları</li>
                    <li><a href="<?php echo URL; ?>/uye/sifredegistir">Şifre İşlemleri</a></li>
                    <li><a href="<?php echo URL;?>/uye/cikis">Oturumu Kapat</a></li>
                    
                </ul>              
                
            </div>	          
            
        </div>   

        <!-- İŞLEM BÖLÜMÜ(sipariş, hesap ayar, adres, yorumlar) -->
        <div class="col-md-10">   

        <!-- Her alanda tek tek kullanmamak için burda yazdık  -->
        <div class="alert alert-success text-center" id="Sonuc"></div>

        <?php 

            // $key: adres, yorumlar gibi kısımlar
            // veri arrayini anahtar ve değer olarak parçaladı
            foreach ($veri as $key => $deger) :

                // parçalanan verinin anahtarına bakar
                switch ($key) :

                case "yorumlar":
                   
                    $harici->UyeyorumGetir($veri["yorumlar"]);
														
				break;
								
                case "adres":
                    
                    $harici->UyeadresGetir($veri["adres"]);      
				
				break;

                case "ayarlar":

                    // GÜNCELLEME BAŞARILI UYARISI
                    if (isset($veri["bilgi"])):
                    echo $veri["bilgi"];
                    endif;

                    $harici->UyeayarlarGetir($veri["ayarlar"]);
                break;

                case "sifredegistir":

                    // ŞİFRE DEĞİŞTİRME BAŞARILI UYARISI
                    if (isset($veri["bilgi"])):
                    echo $veri["bilgi"];
                    endif;
                    
                    $harici->Uyesifredegistir($veri["sifredegistir"]);

                break;

                case "siparisler":

                    $harici->UyesiparisGetir($veri["siparisler"]);
                    
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

        
        
        
       