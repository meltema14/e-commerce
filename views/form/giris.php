<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

        <div class="row col-sm-5 mx-auto m-2 border bg-light">
            
            <div class="col-lg-12 text-center">GİRİŞ FORMU<hr></div>


            <div class="col-lg-6 p-2"> Kullanıcı Adı : </div>
            <div class="col-lg-6 p-2"> 

            <!-- kayit.php içerisindeki kontrol methodu çalışır-->
            <form action="<?php echo URL; ?>/login/giriskontrol" method="post">  
            <input type="text" name="ad" class="form-control" > </div>

            <div class="col-lg-6 p-2"> Şifre :</div>
            <div class="col-lg-6 p-2"> 
            
            <input type="password" name="sifre" class="form-control"></div>

            

            <div class="col-lg-12 mb-2 text-center"> 

            <input type="submit" name="buton" value="GİRİŞ YAP" class="btn btn-success"></div><br>


            </div>

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>