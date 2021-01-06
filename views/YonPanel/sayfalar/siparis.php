<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="row">

      <div class="col-xl-12 col-md-12 mb-12 text-center">

   <?php 

   // aynı sipariş numarısından birden fazla varsa bunu tek  1 sipariş olarak gösterme
   $dizim = array(); // sip_no tutar
   $sayi = 0;
   foreach ($veri["data"] as $value):

      if (!in_array($value["siparis_no"], $dizim)): // sipariş numarası dizide daha önce yoksa
         $sayi++;
      endif;

   $dizim[] = $value["siparis_no"]; // döngüden gelen sip noları diziye tanımladım
   endforeach;

   ?>


      <!-- BAŞLIK -->
      
      <div class="row text-left border-bottom-mvc mb-2">

         <div class="col-xl-4 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">

            <h1 class="h3 mb-0 text-gray-800">

               <i class="fas fa-th basliktext"></i> SİPARİŞLER

            </h1>

         </div>

         <div class="col-xl-4 col-md-12 mb-12 p-2">

            <h1 class="h3 mb-0 text-gray-800">Toplam sipariş : 

            <?php 

               echo $sayi;

            ?>
            
            </h1>

         </div>


         <div class="col-xl-4 col-md-12 mb-12 text-right">

            <div class="row">

               <div class="col-xl-8">

                  <form action="#" method="post">

                  <input type="text" class="form-control" name="sipno" placeholder="Sipariş numarası" />

               </div>

               <div class="col-xl-4">

                  <input type="submit" value="ARA" class="btn btn-sm btn-mvc btn-block mt-1" />

                  </form>

               </div>

            </div>
         </div>

      </div>
      <!-- BAŞLIK -->

      <?php

      $dizi2 = array();

      foreach ($veri["data"] as $value):
         // sipariş numarası dizi2de yoksa yeni ürünü alt dive atacak
         if (!in_array($value["siparis_no"], $dizi2)): 
           

      ?>


      <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
      <div class="row arkaplan p-1 mt-2 pb-0">

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Sipariş No :</span> <span class="spantext"><?php echo $value["siparis_no"]; ?></span>

         </div>

         <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Üye id :</span> <span class="spantext">21554</span>

         </div>

         <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Kargo Durumu :</span> <span class="spantext">
            <?php 
            
            switch($value["kargodurum"]) :
              
            case "0":
            echo "Tedarik Sürecinde";
            break;

            case "1":
            echo "Paketleniyor";
            break;

            case "2":
            echo "Kargoya verildi";
            break;
            endswitch;

            ?>
            </span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Ödeme Türü :</span> <span class="spantext"><?php echo $value["odemeturu"]; ?></span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Tarih :</span> <span class="spantext"><?php echo $value["tarih"]; ?></span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 geneltext bg-gradient-mvc">

            <a href="#" class="btn btn-sm btn-success btn-block mb-1">DURUM GÜNCELLE</a>

         </div>

         <!--  ÜRÜNLER-->
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">

            <div class="row">   

               <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADI</div>
               <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADET</div>
               <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN FİYAT</div>
               <div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">TOPLAM FİYAT</div>

            </div>

            <?php

               endif;
               echo '<div class="row border border-light">   

               <div class="col-lg-3 text-dark kalinyap p-2">'.$value["urunad"].'</div>
               <div class="col-lg-3 text-dark kalinyap p-2">'.$value["urunadet"].'</div>
               <div class="col-lg-3 text-dark kalinyap p-2">'.$value["urunfiyat"].'</div>
               <div class="col-lg-3 text-dark kalinyap p-2">'.$value["toplamfiyat"].'</div>

               </div>';
               // yazma işlemi bittikten sonra aynı sipariş noyu diziye ataarak döngüye devam eder
               $dizi2[] = $value["siparis_no"];
               endforeach;


            ?>

            <!-- TOPLAM FİYAT -->      
            <div class="row"> 
                      
               <div class="col-lg-9 text-dark kalinyap p-2"></div>    
               <div class="col-lg-2  geneltext2 text-right p-2"><span>SİPARİŞ TOPLAMI :</span></div>  
               <div class="col-lg-1  geneltext2 text-left kalinyap p-2"><span >34.40</span></div>        
               
            </div>    
            <!-- TOPLAM FİYAT --> 

         </div>
         <!--  ÜRÜNLER  -->

      </div>
      <!-- SİPARİŞİN İSKELETİ BİTİYOR -->

   

</div>
<!-- /.row bitiyor -->

</div>
<!-- /.container-fluid -->


<?php require 'views/YonPanel/footer.php'; ?>