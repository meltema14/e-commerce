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

        <!-- İŞLEM BÖLÜMÜ(sipariş, hesap ayar, adres, yorumlar) -->
        <div class="col-md-10">       

        <?php 

            // $key: adres, yorumlar gibi kısımlar
            // veri arrayini anahtar ve değer olarak parçaladı
            foreach ($veri as $key => $deger) :

                // parçalanan verinin anahtarına bakar
                switch ($key) :

                case "yorumlar":
                    ?>
                
                <div class="row">

                	<div class="col-md-12 text-center">

                    <div class="alert alert-success" id="Sonuc"></div>

                       <?php 
                       // kaç adet yorum geliyosa onu gösterir, yorum yoksa belirtir
                       echo count($veri["yorumlar"])>0 ? 
                       '<div class="alert alert-info">'.count($veri["yorumlar"]). 
                       " adet yorumunuz var" : '<div class="alert alert-info">Henüz hiçbir ürüne yorum yazmamışsınız.</div>';  ?> 
                    
                    </div>
                        <?php
                            // yorum yoksa tablo gözükmez
                            if (count($veri["yorumlar"])!=0) :
                            
                        ?>


                        <table class="table">

                            <tbody>                       
                        
                                <tr id="baslik">

                                    <td>YORUMUNUZ</td>
                                    <td>ÜRÜN</td>
                                    <td>TARİH</td>
                                    <td>DURUM</td>
                                    <td>GÜNCELLE</td>
                                    <td>SİL</td>
                            
                                </tr>
                            
                                <?php
                                
                                foreach ($veri["yorumlar"] as $deger) :	
                                // ürünün adını çekebilmek için
                                $GelenUrun=$ayarlar->UrunCek($deger["urunid"]);

                                echo '<tr>
                                <td>'.$deger["icerik"].'</td>
                                <td>'.$GelenUrun[0]["urunad"].'</td>
                                <td>'.$deger["tarih"].'</td>
                                <td>'; echo ($deger["durum"]==0) ? "Onaysız" : "Onaylı"; echo'</td>
                                <td><a class="btn btn-sm btn-success" href="#">Güncelle</a></td>
                                <td>'; ?>

                                <a onclick='UrunSil("<?php echo $deger["id"] ?>", "yorumsil")' class="btn btn-sm btn-danger">SİL</a> 
                            
                                <?php echo '</td></tr>';
                                                                                                            
                                endforeach;
                                                    
                                ?>
                                                                      
                            </tbody>
                                        
                        </table>
                    
                        <?php endif;  ?>

                    </div>
                           
                </div>                                                                           
                
                <?php
														
				break;
								
				case "adres":
								
				?>
                
                <div class="row">

                  	<div class="col-md-12 text-center">

                        <?php echo count($veri["adres"])>0 ? '<div class="alert alert-info">'.count($veri["adres"]).
                        " adet adresiniz kayıtlıdır</div>" :
                        '<div class="alert alert-info">Kayıtlı adresiniz bulunmamaktadır.</div>' ?>
                            
                    </div> 
                               
                    <?php
					
					foreach ($veri["adres"] as $deger) :	
										
					    echo'<div class="col-md-2 text-center" id="adresiskelet">
                    
                    	<div class="row">
                        	<div class="col-md-12" id="adresİd">'.$deger["adres"].'</div>
                            <div class="col-md-6"><a class="btn btn-sm btn-success" id="AdresGuncelBtn" href="#">Güncelle</a></div>
                            <div class="col-md-6"><a class="btn btn-sm btn-danger" href="#" id="AdresSilBtn">Sil</a></div>
                        
                        </div></div>';
																																			
					endforeach;
										
					?>               	
                               
                </div>                            
                
                <?php								
				
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
	
</div>

<?php

else:
    // anasayfaya yönlendirir
    header("Location:".URL);

endif;   

?>

<?php require 'views/footer.php'; ?> 	

        
        
        
       