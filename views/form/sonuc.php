<?php require 'views/header.php'; // İlk önce headerı dahil ettik
?> 

    <div class="col-lg-12">

    <?php 
    
    if (is_array($data)) : // array olup olmamasına bakar

        echo '<div class="alert alert-danger mt-5">';

        foreach ($data as $value):

            echo $value . "<br>";

        endforeach;

        echo '</div>';

    else:

        echo $data;

    endif;
    
    
     ?>
        

    </div>

    </form>

    </div>


<?php require 'views/footer.php';  ?>