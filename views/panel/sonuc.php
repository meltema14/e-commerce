<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

    <?php 

    // array ise yani hata var ise bu şekilde çalışacak
    if (is_array($data)) : // array olup olmamasına bakar

        // arrayın elemanı var mı 
        if (count ($data) > 0) :

        echo '<div class="alert alert-danger mt-5">';

        foreach ($data as $value):

            echo $value . "<br>";

        endforeach;

        echo '</div>';

        else:

            echo $yonlen;

        endif;

    else:

        echo $data;

        echo $yonlen;

    endif;
    
    
     ?>
        

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>