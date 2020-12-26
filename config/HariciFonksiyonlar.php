<?php

/*

BURADA SİTENİN TÜM AYARLARI VE DİĞER FONK.LARI TUTULUR

*/

class HariciFonksiyonlar extends Model{


    public $sonuc, $title, $sayfaAciklama, $anahtarKelime, $sloganUst1, $sloganAlt1, $sloganUst2, $sloganAlt2, $sloganUst3, $sloganAlt3;
    public $linkler=array();

    function __construct(){
        // ana modelin __construct miras aldık ki veri tabanına ulaşabilelim
       parent::__construct();

       // diziden dönen sonuç
       $this-> sonuc = $this->db->listele("ayarlar");

       // anlık değerleri almak için
       $this->title = $this-> sonuc[0]["title"];
       $this->sayfaAciklama = $this-> sonuc[0]["sayfaAciklama"];
       $this->anahtarKelime = $this-> sonuc[0]["anahtarKelime"];
       $this->sloganUst1 = $this-> sonuc[0]["sloganUst1"];
       $this->sloganAlt1 = $this-> sonuc[0]["sloganAlt1"];;
       $this->sloganUst2 = $this-> sonuc[0]["sloganUst2"];;
       $this->sloganAlt2 = $this-> sonuc[0]["sloganAlt2"];;
       $this->sloganUst3 = $this-> sonuc[0]["sloganUst3"];;
       $this->sloganAlt3 = $this-> sonuc[0]["sloganAlt3"];;

    }

    // SEO
    function seo($s) { //linkteki türkçe karakterleri ingilizce karakterlere çeviriyo
        $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
        $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
        $s = str_replace($tr,$eng,$s);
        $s = strtolower($s);
        $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
        $s = preg_replace('/\s+/', '-', $s);
        $s = preg_replace('|-+|', '-', $s);
        $s = preg_replace('/#/', '', $s);
        $s = str_replace('.', '', $s);
        $s = trim($s, '-');
        return $s;
    }

    // LİNKLER
    function LinkleriGetir(){ // kategorileri db den çekiyoruz. İLERİDE DAHA KULLANILABİLİR ŞEKİLDE GÜNCELLENECEK (BURADA YAPTIĞIM ESKİ USUL)

        $son = $this -> db -> prepare("select * from ana_kategori");
        $son -> execute();

        // ana_kategoriden dönen veriyi dizi olarak aldık $aktar değişkenine atadık
        while($aktar = $son -> fetch(PDO::FETCH_ASSOC)):

            echo '<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$aktar["ad"].' <b class="caret"></b></a>
            <ul class="dropdown-menu multi-column columns-3">
            <div class="row">';

    
            // çocuk kategoriye bağlan, ana kategorisi eşleşenleri çek
            $son2 = $this -> db ->prepare("select * from cocuk_kategori where ana_kat_id=".$aktar["id"]);
            $son2 -> execute();

                // cocuk_kategoriden dönen veriyi dizi olarak aldık $aktar2 değişkenine atadık
                while($aktar2 = $son2 -> fetch(PDO::FETCH_ASSOC)):
                        
                    echo '<div class="col-sm-4">

                        <ul class="multi-column-dropdown">

                            <h6>'.$aktar2["ad"].'</h6>';

                            // alt_kategori bağlan, çocuk kategorisi eşleşenleri çektik
                            $son3 = $this -> db ->prepare("select * from alt_kategori where cocuk_kat_id=".$aktar2["id"]);
                            $son3 -> execute();

                                // alt_kategoriden dönen veriyi dizi olarak aldık $aktar3 değişkenine atadık
                                while($aktar3 = $son3 -> fetch(PDO::FETCH_ASSOC)):

                                    // sol alt köşede localhost/mvcproje/urunler/kategori/1/tisort şeklinde id ve adı gösteriyoruz
                                    echo'<li><a href="'.URL.'/urunler/kategori/'.$aktar3["id"].'/'.$this->seo($aktar3["ad"])
                                    .'">'.$aktar3["ad"].'</a></li>';

                                endwhile;

                    echo'</ul> </div>';

                endwhile;

            echo '<div class="clearfix"></div>
                </div>
                </ul>
                </li>';

        endwhile;

        /*

        JOİN İŞLEMİ GÜNCELLEMELER İLE EKLENECEK
        yukarıdaki gibi her döngüde tabloları ayrı ayrı değerlendirmektense 
        -left join, right join MYSQL-

        asdasd asdasdas anakategori JOİN altkategori ON anakategori.id=altkategori.id

        yaparak tek sorgu ile iki tabloyu birleştirilebilir.
        */


    }

    // BÜLTENE KAYIT İŞLEMİ
    function bulten() {

        ?>

        <div class="col-md-12" id="Bulten">
            <div class="join">

                <h6>BÜLTENE KAYIT</h6>

                <div class="sub-left-right">

                    <form id="bultenForm">

                        <input type="text" value="Mail Adresinizi Yazınız" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mail Adresinizi Yazınız';}" 
                        name="mailadres" />

                        <input type="button" value="KAYIT OL" id="bultenBtn" />

                    </form>
                    
                </div>

                <div class="clearfix"> </div>

            </div>
        </div>

        <?php

    }

    // ÜRÜN ÇEK
    function UrunCek($id) { // gelen $id hangi ürüne aitse onları döndürür

        return $this->db->listele("urunler", "where id=".$id);

    }

    function UyesiparisGetir ($dizimiz) { // PANEL - ÜYENİN SİPARİŞLERİNİ GETİRİYOR

        ?>
				
        <div class="row">

            <div class="col-md-12 text-center">                    
                    
                <?php
                if (count($dizimiz)!=0) : 
                ?>
                
                <table class="table">
                <tbody>
                
                <tr id="baslik">
                <td>SİPARİŞ NO</td>
                <td>ÜRÜN AD</td>
                <td>ÜRÜN ADET</td>
                <td>ÜRÜN FİYAT</td>
                <td>TOPLAM FİYAT</td>
                <td>KARGO DURUM</td>
                <td>TARİH</td>
            
                </tr>
                
                <?php
                
                foreach ($dizimiz as $deger) :	
                
                echo'<tr id="adresElemanlar">
                
                <td>'.$deger["siparis_no"].'</span></td>
                <td>'.$deger["urunad"].'</td>
                <td>'.$deger["urunadet"].'</td>
                <td>'.$deger["urunfiyat"].'</td>
                <td>'.$deger["toplamfiyat"].'</td>
                <td>'.$deger["kargodurum"].'</td>
                <td>'.$deger["tarih"].'</td>
                
                </tr>';
                
                endforeach;					
                
                ?>
        
                </tbody>
                            
                </table>
                            
                <?php endif; ?>
            
            </div>
                
        </div>           
        
        <?php

    }

    function UyeyorumGetir($dizimiz) {  // PANEL - ÜYENİN YORUMLARINI GETİRİYOR
		                
        echo'<div class="row"><div class="col-md-12 text-center">';
        echo count($dizimiz)>0 ? '<div class="alert alert-info">'.count($dizimiz). " adet yorumunuz var</div>" : '<div class="alert alert-info">Henüz hiçbir ürüne yorum yazmamışsınız.</div>';  
             
        if (count($dizimiz)!=0) : 

            echo'<table class="table">
            <tbody> 
            <tr id="baslik">
            <td>YORUMUNUZ</td>
            <td>ÜRÜN</td>
            <td>TARİH</td>
            <td>DURUM</td>
            <td>GÜNCELLE</td>
            <td>SİL</td>                   
            </tr>';
        
            foreach ($dizimiz as $deger) :	
            
                $GelenUrun=$this->UrunCek($deger["urunid"]);
                echo'<tr id="adresElemanlar">
                <td><span class="sp'.$deger["id"].'">'.$deger["icerik"].'</span></td>
                <td>'.$GelenUrun[0]["urunad"].'</td>
                <td>'.$deger["tarih"].'</td>
                <td>'; echo ($deger["durum"]==0) ? "<span class='onaysiz'>Onaysız</span>" : "<span class='onayli'>Onaylı</span>"; echo'</td>					
                <td id="GuncelButonlarinanasi">					
                <input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" value="Güncelle"></td> <td>';?>
                
                <a onclick='UrunSil("<?php echo $deger["id"] ?>","yorumsil")' class="btn btn-sm btn-danger">SİL</a> <?php echo'</td> </tr>';

            endforeach;
        
            echo '</tbody></table>';
        endif; 
        
        echo '</div></div>';        
  
    } 

    function UyeadresGetir($dizimiz) {  // PANEL - ÜYENİN ADRESLERİNİ GETİRİYOR
		
		
        echo' <div class="row"><div class="col-md-12 text-center">';
        
        echo count($dizimiz)>0 ? '<div class="alert alert-info">'.count($dizimiz). " adet adresiniz kayıtlıdır</div>" : '<div class="alert alert-info">Kayıtlı adresiniz bulunmamaktadır.</div>';  
        
        echo'</div>'; 
                    
        foreach ($dizimiz as $deger) :			
            
            echo'<div class="col-md-2 text-center" id="adresiskelet">
            
            <div class="row" id="adresElemanlar">
            <div class="col-md-12" id="adresİd">
            <span class="adresSp'.$deger["id"].'">'.$deger["adres"].'</span></div>
            <div class="col-md-6" id="AdresGuncelButonlarinanasi">
                    
            <input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" id="AdresGuncelBtn" value="Güncelle">					
                    
            </div>						
            <div class="col-md-6">';?>

            <a onclick='UrunSil("<?php echo $deger["id"] ?>","adresSil")' class="btn btn-sm btn-danger" id="AdresSilBtn">SİL</a> <?php echo'</div>                        
            </div></div>';

        endforeach;		
                        
        echo '</div>'; 	

    } 
    
    function UyeayarlarGetir($dizimiz) {   // PANEL - ÜYENİN AYARLARINI GETİRİYOR	
	
        ?>
        <div class="row text-center">

            <div class="col-md-4"></div> 

            <div class="col-md-4 text-center" id="ortala">
                       
                       <!--  SATIRLAR BAŞLIYOR-->
                       
                <div class="row text-center" id="satirlar">
                    <div class="col-md-12" id="satirlarbaslik">HESAP AYARLARI</div>
                
                
                    <div class="col-md-5" >
                    <form action="<?php echo URL; ?>/uye/ayarGuncelle" method="POST">
                    <label>Ad</label></div>
                    <div class="col-md-7"  ><input type="text" name="ad" value="<?php echo $dizimiz[0]["ad"] ?>" class="form-control" /></div>
     
                    <!--  --------->         
                    <div class="col-md-5"><label>Soyad</label></div>
                    <div class="col-md-7" ><input type="text" name="soyad" value="<?php echo $dizimiz[0]["soyad"] ?>" class="form-control" /></div>
     
                    <!--  --------->         
                    <div class="col-md-5"><label>Mail adresiniz</label></div>
                    <div class="col-md-7" ><input type="text" name="mail" value="<?php echo $dizimiz[0]["mail"] ?>" class="form-control" /></div>
     
                    <!--  --------->         
                    <div class="col-md-5"><label>Telefon</label></div>
                    <div class="col-md-7" ><input type="text" name="telefon" value="<?php echo $dizimiz[0]["telefon"] ?>" class="form-control" /></div>
     
                                    <!--  --------->         
                    <div class="col-md-12">
                    <input type="hidden" name="uyeid"  value="<?php echo $dizimiz[0]["id"] ?>" />
                    <input type="submit" class="btn"  value="GÜNCELLE" /></div>
                    </div>	
                                 
                <!--  SATIRLAR BİTİYOR-->         
     
            </div> 
                    <div class="col-md-4"></div> 

        </div>
                    
                    
        <?php	 
    } 

    function Uyesifredegistir($dizimiz) {   // PANEL - ÜYENİN ŞİFRE DEĞİŞTİRME
		
        ?>
        <div class="row text-center">

            <div class="col-md-4"></div> 
                
                <div class="col-md-4 text-center" id="ortala">
           
                    <!--  SATIRLAR BAŞLIYOR-->
            
                    <div class="row text-center" id="satirlar">

                    <div class="col-md-12" id="satirlarbaslik">ŞİFRE DEĞİŞTİR</div>
                        
                        
                    <div class="col-md-5" >

                    <?php
                        // form başlangıcını oluşturma
                        Form::Olustur("1",array(
                            "action" =>URL."/uye/sifreguncelle",
                            "method" => "POST"
                        ));
                    ?>
                    
                    <label>Mevcut Şifreniz</label></div>

                    <div class="col-md-7"  >

                        <?php
                            // form input oluşturma
                            Form::Olustur("2",array(
                                "type" =>"password",
                                "name" => "msifre",
                                "class" => "form-control"
                            ));
                        ?>

                    </div>

                    <!--  --------->         
                    <div class="col-md-5"><label>Yeni Şifreniz</label></div>
                    <div class="col-md-7" >

                        <?php
                            // form input oluşturma
                            Form::Olustur("2",array(
                                "type" =>"password",
                                "name" => "yen1",
                                "class" => "form-control"
                            ));
                        ?>

                    </div>

                    <!--  --------->         
                    <div class="col-md-5"><label>Şifre (Tekrar)</label></div>

                    <div class="col-md-7" >
                    
                        <?php
                            // form input oluşturma
                            Form::Olustur("2",array(
                                "type" =>"password",
                                "name" => "yen2",
                                "class" => "form-control"
                            ));
                        ?>

                    </div>


                    <!--  --------->         
                    <div class="col-md-12">

                        <?php
                            // form input oluşturma
                            Form::Olustur("2",array(
                                "type" =>"hidden",
                                "name" => "uyeid",
                                "value" => "$dizimiz"
                            ));
                        ?>

                        <?php
                            // form input oluşturma
                            Form::Olustur("2",array(
                                "type" =>"submit",
                                "class" => "btn",
                                "value" => "DEĞİŞTİR"
                            ));
                        ?>
                        
                    </div>	
                     
                    <!--  SATIRLAR BİTİYOR-->         
           
                </div> 
                <div class="col-md-4"></div> 
       </div>
    </div>
        
        
        
        
        
        
        <?php		

    }



  

}




?>