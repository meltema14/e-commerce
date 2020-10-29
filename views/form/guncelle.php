<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

    <?php 
        // data olarak veri geldi parçalıyoruz
        foreach ($data as $value):
                // gelen arraydeki id değerini $id atadık
            $id = $value["id"];
            $ad = $value["ad"];
            $soyad = $value["soyad"];
            $yas = $value["yas"];



        endforeach;

    ?>

        <div class="row col-sm-5 mx-auto m-2 border bg-light">
            
            <div class="col-lg-12 text-center text-danger">GÜNCELLEME FORMU<hr></div>


            <div class="col-lg-6 p-2"> Adı : </div>
            <div class="col-lg-6 p-2"> 

            <!-- kayit.php içerisindeki guncelleson methodu çalışır-->
            <form action="<?php echo URL; ?>/kayit/guncelleson" method="post">  
            <input type="text" name="ad" class="form-control" value="<?php echo $ad;  ?>"> </div>

            <div class="col-lg-6 p-2"> Soyadı :</div>
            <div class="col-lg-6 p-2"> 
            <input type="text" name="soyad" class="form-control" value="<?php echo $soyad;  ?>"></div>

            <div class="col-lg-6 p-2"> Yaşı :</div>
            <div class="col-lg-6 p-2" > 
            <input type="text" name="yas" class="form-control" value="<?php echo $yas;  ?>"></div><br>

            <input type="hidden" name="kayitid" class="form-control" value="<?php echo $id;  ?>"></div><br>

            <div class="col-lg-12 mb-2 text-center"> <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-success"></div><br>


            </div>

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>