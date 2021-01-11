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

      if (isset($veri["urunGuncelle"])) :

        if (!$_POST) :

      ?>

          <!-- BAŞLIK -->

          <div class="row text-left border-bottom-mvc mb-2">

            <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">
              <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜRÜN GÜNCELLE </h1>
            </div>


          </div>
          <!-- BAŞLIK -->

          <!--  FORMUN İSKELETİ-->

          <div class="col-xl-12 col-md-12  text-center">

            <div class="row text-center">

              <div class="col-xl-4 col-md-6 mx-auto">


                <div class="row bg-gradient-beyazimsi">

                  <div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2">
                    <h3>Ürün Güncelle</h3>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Ürün Adı</div>
                  <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">

                    <?php

                    Form::Olustur("1", array(
                      "action" => URL . "/panel/urunguncelleSon",
                      "method" => "POST"
                    ));

                    Form::OlusturSelect("1", array("name" => "durum", "class" => "form-control"));

                    Form::OlusturOption(array("value" => "0"), false, "Aktif");

                    Form::OlusturOption(array("value" => "1"), false, "Pasif");


                    Form::OlusturSelect("2", null);  ?></div>


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

      endif;

      // tüm ürünlerin gelmesi
      if (isset($veri["data"])) :

        ?>

        <!-- BAŞLIK -->

        <div class="row text-left border-bottom-mvc mb-2">

          <div class="col-lg-2 col-xl-2 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜRÜNLER </h1>
          </div>


          <div class="col-lg-3 col-xl-3 col-md-12 mb-12 p-2">
            <h1 class="h3 mb-0 text-gray-800">Toplam Ürün : <?php echo count($veri["data"]); ?></h1>
          </div>

          <div class="col-xl-7 col-md-12 mb-12 text-right">
            <div class="row">

              <div class="col-xl-4 ">
                <?php
                Form::Olustur("1", array(
                  "action" => URL . "/panel/katgoregetir",
                  "method" => "POST"
                ));

                Form::OlusturSelect("1", array("name" => "katid", "class" => "form-control", "id" => "dene"));

                // data2: alt kategorilere bağlanıp tüm kategorileri çekme
                foreach ($veri["data2"] as $deger) :

                  Form::OlusturOption(array("value" => $deger["id"]), false, $deger["ad"]);

                endforeach;

                Form::OlusturSelect("2", null);

                ?>

              </div>

              <div class="col-xl-2 ">

                <?php

                Form::Olustur("2", array("type" => "submit", "value" => "GETİR", "class" => "btn btn-sm btn-mvc btn-block mt-1"));
                Form::Olustur("kapat");
                ?>
              </div>

              <div class="col-xl-4">
                <?php

                Form::Olustur("1", array(
                  "action" => URL . "/panel/urunarama",
                  "method" => "POST"
                ));

                Form::Olustur("2", array("type" => "text", "name" => "arama", "class" => "form-control", "placeholder" => "Herhangi bir kriter"));

                ?>

              </div>
              <div class="col-xl-2">

                <?php

                Form::Olustur("2", array("type" => "submit", "value" => "ARA", "class" => "btn btn-sm btn-mvc btn-block mt-1"));

                Form::Olustur("kapat");   
                
                ?>


              </div>

            </div>

          </div>

        </div>
        <!-- BAŞLIK -->

        <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        <div class="row arkaplan p-1 mt-2 pb-0">
          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Ürün Ad</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Bölüm</span>
          </div>

          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Kumas</span>
          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Renk</span>
          </div>

          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Fiyat</span>

          </div>

          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Stok</span>

          </div>
          <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
            <span>Satış Adeti</span>

          </div>

          <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3   geneltext bg-gradient-mvc">
            <span>İşlemler</span>
          </div>

          <!--  ÜRÜNLER-->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0" id="geldi">

          </div>

          <?php foreach ($veri["data"] as $value) : ?>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">

            <?php
            //    EN ÇOK SATAN, ÖNE ÇIKAN, STANDARDI GÖSTEREN DURUM
            echo '<div class="row border border-light">
							     
            <div class="col-lg-2 col-xl-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["urunad"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">';
            
            echo $value["durum"] == 0 ? "<span class='text-info'>Standart</span>" : "";
            echo $value["durum"] == 1 ? "<span class='text-danger'>En Çok Satan</span>" : "";
            echo $value["durum"] == 2 ? "<span class='text-success'>Öne Çıkanlar</span>" : "";
            
            echo'</div>

            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["kumas"] . '</div>
            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["renk"] . '</div>
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["fiyat"] . '</div> 
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["stok"] . '</div> 
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">' . $value["satisadet"] . '</div> 
                
            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-right">
            <a href="' . URL . '/panel/urunGuncelle/' . $value["id"] . '" class="fas fa-sync mt-1 guncelbuton"></a></div>
                      
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-left">               
            <a href="' . URL . '/panel/urunSil/' . $value["id"] . '" class="fas fa-times   silbuton"></a>  </div>
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