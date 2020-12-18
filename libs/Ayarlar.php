<?php

/*

BURADA SİTENİN TÜM AYARLARINI KONTROL EDİLECEK

*/

class Ayarlar extends Model{


    public $sonuc, $title, $sayfaAciklama, $anahtarKelime, $sloganUst1, $sloganAlt1, $sloganUst2, $sloganAlt2, $sloganUst3, $sloganAlt3;
    

    function __construct()
    {
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

    // linkteki türkçe karakterleri ingilizce karakterlere çeviriyo
    function seo($s) {
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

    // kategorileri db den çekiyoruz. İLERİDE DAHA KULLANILABİLİR ŞEKİLDE GÜNCELLENECEK (BURADA YAPTIĞIM ESKİ USUL)
    function LinkleriGetir(){

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

    // bültene kayıt işlemi
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

    // gelen $id hangi ürüne aitse onları döndürür
    function UrunCek($id) {

        return $this->db->listele("urunler", "where id=".$id);

    }

  

}




?>