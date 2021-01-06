<?php require 'views/YonPanel/header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="row">

      <div class="col-xl-12 col-md-12 mb-12 text-center">

         <!-- BAŞLIK -->
         <div class="row text-left border-bottom-mvc mb-2">

            <div class="col-xl-4 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">

               <h1 class="h3 mb-0 text-gray-800">

                  <i class="fas fa-th basliktext"></i> SİPARİŞLER
               </h1>

            </div>

            <div class="col-xl-4 col-md-12 mb-12 p-2">

               <h1 class="h3 mb-0 text-gray-800">Toplam sipariş : 000</h1>

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

      </div>
      <!-- BAŞLIK -->

      <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
      <div class="row arkaplan p-1 mt-2 pb-0">

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Sipariş No :</span> <span class="spantext">454154</span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Üye id :</span> <span class="spantext">454154</span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Kargo Durumu :</span> <span class="spantext">454154</span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Ödeme Türü :</span> <span class="spantext">454154</span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">

            <span>Tarih :</span> <span class="spantext">454154</span>

         </div>

         <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 geneltext bg-gradient-mvc">

            <a href="#" class="btn btn-sm btn-success btn-block mb-1">DURUM GÜNCELLE</a>

         </div>

         <!--  ÜRÜNLER-->
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">

            <div class="row">

               <table class="table table-striped">

                  <tbody>

                     <tr class="bg-gradient-gri text-dark">

                        <td class="kalinyap">ÜRÜN ADI</td>
                        <td class="kalinyap">ÜRÜN ADET</td>
                        <td class="kalinyap">ÜRÜN FİYAT</td>
                        <td class="kalinyap">TOPLAM FİYAT</td>

                     </tr>

                     <tr>

                        <td>gömlek</td>
                        <td>2</td>
                        <td>12.20</td>
                        <td>24.40</td>

                     </tr>

                     <tr>

                        <td>kazak</td>
                        <td>5</td>
                        <td>2</td>
                        <td>10.00</td>

                     </tr>

                  </tbody>

               </table>

               <table class="table text-right p-0 m-0">

                  <tbody>

                     <tr class="geneltext2">

                        <td><span>SİPARİŞ TOPLAMI :</span> <span>34.40</span> </td>

                     </tr>

                  </tbody>

               </table>

            </div>

         </div>
         <!--  ÜRÜNLER  -->

      </div>
      <!-- SİPARİŞİN İSKELETİ BİTİYOR -->

   </div>

</div>
<!-- /.row bitiyor -->

</div>
<!-- /.container-fluid -->


<?php require 'views/YonPanel/footer.php'; ?>