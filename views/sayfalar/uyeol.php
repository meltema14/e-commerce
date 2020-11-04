<?php require 'views/header.php'; // İlk önce headerı dahil ettik ?> 

<!-- registration-form -->
<div class="registration-form">
	<div class="container">
	<div class="dreamcrub">
			   	 <ul class="breadcrumbs">
                    <li class="home">
					<a href="<?php echo URL;?>" title="Anasayfa">Anasayfa</a>&nbsp;
                       <span>&gt;</span>
                    </li>
                    <li class="women">
                       Üye Ol
                    </li>
                </ul>
                <ul class="previous">
                	<li><a href="<?php echo URL;?>">Geri Dön</a></li>
                </ul>
                <div class="clearfix"></div>
			   </div>
		<h2>ÜYE KAYIT FORMU</h2>
		<div class="registration-grids">
			<div class="reg-form">
				<div class="reg">
					 <p>Welcome, please enter the following details to continue.</p>
					 <form>
						 <ul>
							 <li class="text-info">Adınız: </li>
							 <li><input type="text" name="ad"></li>
						 </ul>
						 <ul>
							 <li class="text-info">Soyadınız: </li>
							 <li><input type="text" name="soyad"></li>
						 </ul>				 
						<ul>
							 <li class="text-info">Mail Adresi: </li>
							 <li><input type="text" name="mail"></li>
						 </ul>
						 <ul>
							 <li class="text-info"> Sifre:</li>
							 <li><input type="password" name="sifre"></li>
						 </ul>
						 <ul>
							 <li class="text-info">Sifre Tekrar:</li>
							 <li><input type="password" name="sifretekrar"></li>
						 </ul>
						 <ul>
							 <li class="text-info">Telefon:</li>
							 <li><input type="text" name="telefon"></li>
						 </ul>						
						 <input type="submit" name="TAMAMLA">
						 <p class="click">Üye olarak politikaları kabul etmiş olursunuz.  <a href="#">Policy Terms and Conditions.</a></p> 
					 </form>
				 </div>
			</div>
			<div class="reg-right">
				 <h3>Üyelik tamamen ücretsiz</h3>
				 <div class="strip"></div>
				 <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio 
				 libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
				 <h3 class="lorem">Üyelik Avantajları</h3>
				 <div class="strip"></div>
				 <p>Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- registration-form -->


<?php require 'views/footer.php';   ?> 
        
      
      