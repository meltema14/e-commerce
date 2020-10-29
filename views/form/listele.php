-<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

    <table class="table table-bordered mt-2">
                    <thead>
                    <tr class="font-weight-bold">
                    <td>#İD</td>
                    <td>AD</td>
                    <td>SOYAD</td>
                    <td>YAŞ</td>
                    <td>İŞLEM</td>

                    </tr>
                    </thead>	
                    <tbody>  
                    <?php
                    
                
                    // gelen veriyi değerlerine parçalıyoruz
                        foreach ($data as $value):
                
                            echo '<tr>
                            <td>'.$value["id"].'</td>
                            <td>'.$value["ad"].'</td>
                            <td>'.$value["soyad"].'</td>
                            <td>'.$value["yas"].'</td>
                                                            
                            <td> <a href="'. URL .'/kayit/kayitguncelle/'.$value["id"].'" class = "btn btn-success">Güncelle
                            <a href="'. URL .'/kayit/kayitsil/'.$value["id"].'" class = "btn btn-danger">Sil</a></td>
                            </tr>';

                        endforeach;
                
                    ?>             
                    
                    </tbody>
            
            	</table>

    <?php 
    
    
    
    
     ?>
        

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>