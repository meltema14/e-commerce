<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">

    <div class="col-xl-12 col-md-12 mb-12 text-center">

      <?php

      if (isset($veri["bilgi"])) :

        echo $veri["bilgi"];

      endif;

      if (isset($veri["uyeGuncelle"])) :

        if (!$_POST) :

          ?>

          <!-- BAŞLIK -->

          <div class="row text-left border-bottom-mvc mb-2">

            <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">
              <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜYE GÜNCELLE </h1>
            </div>


          </div>
          <!-- BAŞLIK -->

          <!--  FORMUN İSKELETİ-->

          <div class="col-xl-12 col-md-12  text-center">

            <div class="row text-center">

              <div class="col-xl-4 col-md-6 mx-auto">


                <div class="row bg-gradient-beyazimsi">

                  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2">
                    <h3>Üye Bilgileri Güncelle</h3>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Üye Adı</div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">

                    <?php

                    Form::Olustur("1", array(
                      "action" => URL . "/panel/uyeguncelleSon",
                      "method" => "POST"
                    ));

                    Form::OlusturSelect("1", array("name" => "durum", "class" => "form-control"));

                    Form::OlusturOption(array("value" => "0"), false, "Aktif");

                    Form::OlusturOption(array("value" => "1"), false, "Pasif");

                    Form::OlusturSelect("2", null);  

                    ?>
                    
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
                    
                    <?php

                    Form::Olustur("2", array("type" => "submit", "value" => "GÜNCELLE", "class" => "btn btn-success"));

                    Form::Olustur("2", array("type" => "hidden", "name" => "sipno", "value" => $veri["KargoGuncelle"][0]["siparis_no"]));

                    Form::Olustur("kapat");   
                    ?>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <!--  FORMUN İSKELETİ-->
          <?php

        endif;

      endif; // KARGO DURUM GÜNCELLEME

      // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
      if (isset($veri["data"])) :

        ?>

        <!-- BAŞLIK -->

        <div class="row text-left border-bottom-mvc mb-2">

          <div class="col-lg-2 col-xl-2 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜYELER </h1>
          </div>


          <div class="col-lg-3 col-xl-3 col-md-12 mb-12 p-2">
            <h1 class="h3 mb-0 text-gray-800">Toplam Üye : <?php echo count($veri["data"]); ?></h1>
          </div>


          <div class="col-xl-7 col-md-12 mb-12 text-right">
            <div class="row">

              <div class="col-xl-4 pt-2">ÜYE ARA</div>

              <div class="col-xl-4">
                <?php

                Form::Olustur("1", array(
                  "action" => URL . "/panel/uyearama",
                  "method" => "POST"
                ));


                Form::Olustur("2", array("type" => "text", "name" => "aramaverisi", "class" => "form-control", "placeholder" => "Herhangi bir kriter"));

                ?>

              </div>
              <div class="col-xl-4">

                <?php

                Form::Olustur("2", array("type" => "submit", "value" => "ARA", "class" => "btn btn-sm btn-mvc btn-block mt-1"));

                Form::Olustur("kapat");   ?>

              </div>

            </div>

          </div>

        </div>
        <!-- BAŞLIK -->

        <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        <div class="row arkaplan p-1 mt-2 pb-0">
          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Üye İd</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Üye Adı</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Üye Soyadı</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Mail Adresi</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Telefon</span>

          </div>

          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Durum</span>

          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3   geneltext bg-gradient-mvc">
            <span>İşlemler</span>
          </div>

          <!--  ÜRÜNLER-->

          <?php foreach ($veri["data"] as $value) : ?>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">

            <?php

            echo '<div class="row border border-light">
							     
            <div class="col-lg-1 col-xl-1 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["id"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["ad"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["soyad"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["mail"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["telefon"] . '</div> 
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">durum</div> 
                
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-right">
            <a href="' . URL . '/panel/uyeGuncelle/' . $value["id"] . '" class="fas fa-sync mt-1 guncelbuton"></a></div>
                      
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-left">               
            <a href="' . URL . '/panel/uyeSil/' . $value["id"] . '" class="fas fa-times   silbuton"></a>  </div>
            </div> 
            
            </div>';

          endforeach;

          ?>

            <!-- -->

            </div>

            <!-- SİPARİŞİN İSKELETİ BİTİYOR -->

          <?php endif; ?>

        </div>

    </div>
    <!-- /.row bitiyor -->

  </div>
  <!-- /.container-fluid -->

<?php require 'views/YonPanel/footer.php'; ?>