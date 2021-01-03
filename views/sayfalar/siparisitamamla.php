<?php require 'views/header.php';  ?>


<?php

//BU SAYFANIN GÖRÜNTÜLENMESİNDE OTURUM KONTROLÜ YANI SIRA SEPETTE ÜRÜN VARMI DİYE KONTROL
//EDİLECEK VE SEPETTE ÜRÜN YOK İSE BU SAYFA GÖRÜNTÜLENEMEYECEK 

 if (Session::get("kulad") && Session::get("uye")) : ?>

	<div class="container" id="sipTamamlaİskelet" >
    
    	<div class="row">
        
            <div class="col-md-7" id="soltaraf">
                <div class="row">
                
                    <div class="col-md-6">

                        <div class="row" id="uyelik">

                            <div class="col-md-12"><h4>ÜYELİK BİLGİLERİ</h4></div>

                            <?php 
                                // FORMU BAŞLATMA
                                Form::Olustur("1",array("method"=>"POST","action"=>URL."/uye/siparisTamamlandi")); 
                            ?>

                            <?php $sonuc = $harici -> UyeBilgileriniGetir(); ?>

                            <div class="col-md-3" id="label">Ad</div>
                            <div class="col-md-9" id="input">

                                <?php Form::Olustur("2",array("type" => "text", "name" => "ad", 
                                "id" => "sipAd", "value" => $sonuc[0]["ad"], "class"=>"form-control")) ?>

                            </div>
                            <div class="col-md-3" id="label">Soyad</div>
                            <div class="col-md-9" id="input">

                                <?php Form::Olustur("2",array("type" => "text", "name" => "soyad", 
                                "id" => "sipSoyad", "value" => $sonuc[0]["soyad"], "class"=>"form-control")) ?>

                            </div>
                            <div class="col-md-3" id="label">Mail</div>
                            <div class="col-md-9" id="input">

                                <?php Form::Olustur("2",array("type" => "text", "name" => "mail", 
                                "id" => "sipMail", "value" => $sonuc[0]["mail"], "class"=>"form-control")) ?>

                            </div>
                            <div class="col-md-3" id="label">Telefon</div>
                            <div class="col-md-9" id="input">

                                <?php Form::Olustur("2",array("type" => "text", "name" => "telefon", 
                                "id" => "sipTlf", "value" => $sonuc[0]["telefon"], "class"=>"form-control")) ?>

                            </div>

                            <div class="col-md-12" id="radioBtn">

                                <?php Form::Olustur("2",array("type" => "radio", "name" => "bilgiTercih",
                                "checked"=>"checked","value"=>0)) ?> Üyelik Bilgilerimi Kullan

                            </div>

                            <div class="col-md-12" id="radioBtn">

                                <?php Form::Olustur("2",array("type" => "radio", "name" => "bilgiTercih","value"=>1)) ?> 
                                Farklı Bilgiler Kullan

                            </div>

                        
                        </div>

                    </div>
                    
                    
                    <div class="col-md-6">

                    <div class="row" id="uyelik">

                        <div class="col-md-12"><h4>ADRESLER</h4></div>
                        
                        
                        <?php 
                        
                            // db den üyenin adreslerini getirir
                        
                            foreach ($harici-> UyeAdresleriniGetir() as $deger) :
                                
                                echo '<div class="col-md-12" id="adresSatir">
                                <div class="row" id="adressecim">
								<div class="col-md-9">'.$deger["adres"].'</div>
								<div class="col-md-3">';
                                 
                                // varsayılan 1 ise radio butonu seçili getirir
								if ($deger["varsayilan"]==1) :
                                Form::Olustur("2",
                                array("type" => "radio",
                                "value" => $deger["id"], "name" => "adrestercih",
                                "checked"=>"checked","id"=>"radioBtn"));	
	
	                            echo "Varsayılan";
	
	                            else:
	
                                Form::Olustur("2",
                                array("type" => "radio",
                                "value" => $deger["id"], "name" => "adrestercih",
                                "id"=>"radioBtn"));			 
                                
                                endif;
								 
                            echo'</div>								 
								 </div>
								 
								 </div>';
                            endforeach;

                        ?>

                        </div>
                    
                    </div>
                    
                <div class="col-md-12">
                
                    <div class="row" id="uyelik">

                        <div class="col-md-12"><h4>ÖDEME YÖNTEMİ</h4></div>

                        <div class="col-md-6" id="adresSatir">

                            <label>

                            <?php
                            Form::Olustur("2", 
                            array("type"=>"radio","name"=>"odeme",
                            "value" => "1", "checked"=>"checked")); ?> HAVALE / EFT

                            </label>

                        </div>
                        
                        <div class="col-md-6" id="adresSatir">

                            <label>

                            <?php
                            Form::Olustur("2", 
                            array("type"=>"radio",
                            "disabled"=>"disabled")); ?> KREDİ KARTI (Yakında)

                            </label>

                        </div>

                    </div>              
                
                </div>
                
                </div>
         
            </div>
            
            <div class="col-md-5">
                    
                <div class="row" id="sagtaraf">
                
                <div class="col-md-12" id="baslik"><h3>SEPETTEKİ ÜRÜNLERİNİZ</h3></div>
                <div class="col-md-3" id="icbaslik">Ürün Ad</div>
                <div class="col-md-3" id="icbaslik">Adet</div>
                <div class="col-md-3" id="icbaslik">Birim Fiyat</div>
                <div class="col-md-3" id="icbaslik">Toplam</div>
                
                <!-- SEPETTEKİ ÜRÜNLER BURADA LİSTELENECEK -->

                <?php 

                
                $toplamAdet=0;
                $toplamfiyat=0;

                // eğer cookie(sepette ürün) varsa buraya girer   
                foreach ($_COOKIE["urun"] as $id => $adet) :
                
                // hariciden ürünün adını çeker
				$GelenUrun=$harici->UrunCek($id);
				
                echo'  

                <div class="col-md-3" id="icurunler">'.$GelenUrun[0]["urunad"].'</div>
                <div class="col-md-3" id="icurunler">'.$adet.'</div>
                <div class="col-md-3" id="icurunler">'.number_format($GelenUrun[0]["fiyat"],2,'.',',').'</div>
                <div class="col-md-3" id="icurunler">'.number_format($GelenUrun[0]["fiyat"]*$adet,2,',','.').'</div>';

                $toplamAdet  += $adet;
                $toplamfiyat += $GelenUrun[0]["fiyat"]*$adet;
		
				endforeach; 
			
                echo'
                <div class="col-md-3" id="toplam">Toplam Adet</div>
                <div class="col-md-3" id="toplam">'.$toplamAdet.'</div>
                <div class="col-md-3" id="toplam">Toplam Tutar</div>
                <div class="col-md-3" id="toplam">'.number_format($toplamfiyat,2,',','.').'</div>';	
				
				?>
                
            </div>
            <div class="row">

                <div class="col-md-12">

                    <?php

                        Form::Olustur("2",
                        array("type" => "hidden","value"=>$toplamfiyat,"name"=>"toplam"));
                        // TAMAMLA BUTONU
                        Form::Olustur("2",array("type" => "submit", "value"=>"TAMAMLA","class"=>"btn btn_1"));
                        // FORMU KAPATMA
                        Form::Olustur("kapat");

                        // hata olursa
                        if (isset($veri["bilgi"])) :			
                            
                            echo $veri["bilgi"];		
                            
                        endif;

                    ?>

                </div>

            </div>
            
        </div>
                
    </div>
</div>

<?php
    else:
	
	header("Location:".URL);
	
	endif;
?>


<?php require 'views/footer.php'; ?> 		
        
        
        
       