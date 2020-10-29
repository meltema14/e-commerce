<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

        <div class="row col-sm-5 mx-auto m-2 border bg-light">
            
            <div class="col-lg-12 text-center">KAYIT FORMU<hr></div>


            <div class="col-lg-6 p-2"> Adı : </div>
            <div class="col-lg-6 p-2"> 

            <!-- kayit.php içerisindeki kontrol methodu çalışır-->
            <form action="<?php echo URL; ?>/kayit/kontrol" method="post">  
            <input type="text" name="ad" class="form-control" > </div>

            <div class="col-lg-6 p-2"> Soyadı :</div>
            <div class="col-lg-6 p-2"> <input type="text" name="soyad" class="form-control"></div>

            <div class="col-lg-6 p-2"> Yaşı :</div>
            <div class="col-lg-6 p-2" > <input type="text" name="yas" class="form-control"></div><br>

            <div class="col-lg-12 mb-2 text-center"> <input type="submit" name="buton" value="EKLE" class="btn btn-success"></div><br>


            </div>

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>