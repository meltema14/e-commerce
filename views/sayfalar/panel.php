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
                    ?>
                
                <div class="row">

                	<div class="col-md-12 text-center">

                       <?php 
                       // kaç adet yorum geliyosa onu gösterir, yorum yoksa belirtir
                       echo count($veri["yorumlar"])>0 ? 
                       '<div class="alert alert-info">'.count($veri["yorumlar"]). 
                       " adet yorumunuz var" : '<div class="alert alert-info text-center">Henüz hiçbir ürüne yorum yazmamışsınız.</div>';  ?> 
                    
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
                                $GelenUrun=$harici->UrunCek($deger["urunid"]);

                                echo '<tr id="adresElemanlar">
                                <td><span class="sp'.$deger["id"].'">'.$deger["icerik"].'</span></td>
                                <td>'.$GelenUrun[0]["urunad"].'</td>
                                <td>'.$deger["tarih"].'</td>
                                <td>'; echo ($deger["durum"]==0) ? "<span class='onaysiz'>Onaysız</span>" : "<span class='onayli'>Onaylı</span>"; echo'</td>

                                <td id="GuncelButonlarinanasi">
                                
                                <input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" value="Güncelle">



                                </td>
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
                    
                        <div class="row" id="adresElemanlar">
                        
                            <div class="col-md-12" id="adresİd">

                            <span class="adresSp'.$deger["id"].'">'.$deger["adres"].'</span></div>
                            
                            <div class="col-md-6" id="AdresGuncelButonlarinanasi">

                            <input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" id="AdresGuncelBtn" value="Güncelle">

                            </div>

                            <div class="col-md-6">'; ?>
                            
                            
                            <a onclick='UrunSil("<?php echo $deger["id"] ?>", "adresSil")' class="btn btn-sm btn-danger" id="AdresSilBtn">SİL</a>


                        <?php echo '
                        </div>
                        </div></div>';
																																			
					endforeach;
										
					?>               	
                               
                </div>                            
                
                <?php								
				
				break;

                case "ayarlar":

                    ?>
                <div class="row text-center">
                  	<div class="col-md-4"></div> 
                   <div class="col-md-4 text-center" id="ortala">
                   
                   <!--  SATIRLAR BAŞLIYOR-->
                   
                   			 <div class="row text-center" id="satirlar">
                             	<div class="col-md-12" id="satirlarbaslik">HESAP AYARLARI</div>
                             
                             
                             		<div class="col-md-5" >
                                    <form action="" method="">
                                    <label>Ad</label></div>
                                    <div class="col-md-7"  >
                                    <input type="text" name="ad" value="<?php echo $veri["ayarlar"][0]["ad"] ?>" class="form-control" /></div>
                                    
                                        <!--  --------->         
                                    <div class="col-md-5">
                                    <label>Soyad</label></div>
                                    <div class="col-md-7" >
                                    <input type="text" name="soyad" value="<?php echo $veri["ayarlar"][0]["soyad"] ?>" class="form-control" /></div>
                                    
                                        <!--  --------->         
                                    <div class="col-md-5">
                                    <label>Mail adresiniz</label></div>
                                    <div class="col-md-7" >
                                    <input type="text" name="mail" value="<?php echo $veri["ayarlar"][0]["mail"] ?>" class="form-control" /></div>
                                    
                                        <!--  --------->         
                                    <div class="col-md-5">
                                    <label>Telefon</label></div>
                                    <div class="col-md-7" >
                                    <input type="text" name="telefon" value="<?php echo $veri["ayarlar"][0]["telefon"] ?>" class="form-control" /></div>
                                    
                                        <!--  --------->         
                                    <div class="col-md-12">
                                    <input type="hidden" name="uyeid"  value="ÜYENİN İDSİ YAZILACAK" />
                                    <input type="submit" class="btn"  value="GÜNCELLE" /></div>

                                             
                             </div>	
                             
                    <!--  SATIRLAR BİTİYOR-->         
                                
                   </div> 
                 <div class="col-md-4"></div> 
               </div>
                                
				<?php

                break;

                case "sifredegistir":
                
                    ?>
                    <div class="row text-center">
                        <div class="col-md-4"></div> 
                       <div class="col-md-4 text-center" id="ortala">
                       
                       <!--  SATIRLAR BAŞLIYOR-->
                       
                        <div class="row text-center" id="satirlar">
                        <div class="col-md-12" id="satirlarbaslik">ŞİFRE DEĞİŞTİR</div>
                                 
                                 
                            <div class="col-md-5" >
                            <form action="" method="">
                            <label>Mevcut Şifreniz</label></div>
                            <div class="col-md-7"  ><input type="password" name="msifre" value="" class="form-control" /></div>

                            <!--  --------->         
                            <div class="col-md-5"><label>Yeni Şifreniz</label></div>
                            <div class="col-md-7" ><input type="password" name="yen1" value="" class="form-control" /></div>

                            <!--  --------->         
                            <div class="col-md-5"><label>Şifre (Tekrar)</label></div>
                            <div class="col-md-7" ><input type="password" name="yen2" value="" class="form-control" /></div>


                            <!--  --------->         
                            <div class="col-md-12">
                            <input type="hidden" name="uyeid"  value="ÜYENİN İDSİ YAZILACAK" />
                            <input type="submit" class="btn"  value="DEĞİŞTİR" /></div>
                                     
                            </div>	
                                 
                        <!--  SATIRLAR BİTİYOR-->         
                                             
                       </div> 
                     <div class="col-md-4"></div> 
                   </div>
                           
                    
                    <?php

                break;

                case "siparisler":

                    $harici->UyeSiparisGetir($veri["siparisler"]);
                    

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

        
        
        
       