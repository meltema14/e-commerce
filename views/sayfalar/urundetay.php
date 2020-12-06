<?php require 'views/header.php'; // İlk önce headerı dahil ettik ?> 

<!-- content-section-starts -->
<div class="container">
	   <div class="products-page">
			<div class="products">
				<div class="product-listy">
					<h2>Stoğu Azalanlar</h2>
					<ul class="product-list">

						<?php

						// ürünün adı ile id sini alıyoruz
						foreach($veri["data2"] as $value) :

							// stoğu azalanlardaki ürünlere link veriyoruz
							echo ' <li><a href="'.URL.'/urunler/detay/'.$value["id"].'/'.$ayarlar->seo($value["urunad"]).'"> '
							.$value["urunad"]. '</a></li>';

						endforeach;


						?>
						
					</ul>
				</div>
			
				

			</div>
			<div class="new-product">
				<div class="col-md-5 zoom-grid">
					<div class="flexslider">
						<ul class="slides">

							<li data-thumb="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res1"]; ?>">
								<div class="thumb-image"> 
									<img src="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res1"]; ?>" data-imagezoom="true" class="img-responsive" alt="
									<?php /* vt deki urunadı çekiyoruz */ echo $veri["data1"][0]["urunad"];?>" /> 
								</div>
							</li>

							<li data-thumb="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res2"]; ?>">
								<div class="thumb-image"> 
									<img src="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res2"]; ?>" data-imagezoom="true" class="img-responsive" alt="
									<?php /* vt deki urunadı çekiyoruz */ echo $veri["data1"][0]["urunad"];?>" /> 
								</div>
							</li>

							<li data-thumb="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res3"]; ?>">
							<div class="thumb-image"> 
								<img src="<?php  echo URL; ?>/views/design/images/<?php echo $veri["data1"][0]["res3"]; ?>" data-imagezoom="true" class="img-responsive" alt="
								<?php /* vt deki urunadı çekiyoruz */ echo $veri["data1"][0]["urunad"];?>" /> 
							</div>
							</li> 
						</ul>
					</div>
				</div>
				<div class="col-md-7 dress-info">
					<div class="dress-name">

						<h3>
							<?php /* vt deki urunadı çekiyoruz */ echo $veri["data1"][0]["urunad"];?>
						</h3>
						<span><?php /* vt deki fiyat çekiyoruz (1.250,60)*/ echo number_format($veri["data1"][0]["fiyat"],2,".",",") ;?></span>
						<div class="clearfix"></div>
						<p><b>ÜRÜN HAKKINDA AÇIKLAMA</b><?php /* vt deki aciklamayı çekiyoruz */ echo $veri["data1"][0]["aciklama"];?></p>
					</div>
					<div class="span span1">
						<p class="left">KUMAŞ</p>
						<p class="right"><?php /* vt deki kuması çekiyoruz */ echo $veri["data1"][0]["kumas"];?></p>
						<div class="clearfix"></div>
					</div>
					<div class="span span2">
						<p class="left">ÜRETİM YERİ</p>
						<p class="right"><?php /* vt deki uretimYeri çekiyoruz */ echo $veri["data1"][0]["urtYeri"];?></p>
						<div class="clearfix"></div>
					</div>
					<div class="span span3">
						<p class="left">RENK</p>
						<p class="right"><?php /* vt deki renkleri çekiyoruz */ echo $veri["data1"][0]["renk"];?></p>
						<div class="clearfix"></div>
					</div>
					<div class="span span4">
						<p class="left">BEDEN</p>
						<p class="right"><span class="selection-box "><select class="form-control" name="domains">
										   <option>M</option>
										   <option>L</option>
										   <option>XL</option>
										   <option>FS</option>
										   <option>S</option>
									   </select></span></p>
						<div class="clearfix"></div>
					</div>
					<div class="purchase">
						<input type="submit" class="btn btn-success" value="Sepete Ekle">
						
						<div class="clearfix"></div>
					</div>
				<script src="<?php  echo URL; ?>/views/design/js/imagezoom.js"></script>
					<!-- FlexSlider -->
					<script defer src="<?php  echo URL; ?>/views/design/js/jquery.flexslider.js"></script>
					<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
					</script>
				</div>
				<div class="clearfix"></div>
					<div class="reviews-tabs">


					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#bilgi" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Daha fazla bilgi</a></li>
			  <li role="presentation" class=""><a href="#ozellik" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Özellikler</a></li>
			  
              
    			<li role="presentation" class=""><a href="#yorum" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Yorumlar (
				  <?php echo count($veri["data4"]) ?> )</a></li>
              
              
			</ul>
			<div id="myTabContent" class="tab-content">
			  <div role="tabpanel" class="tab-pane fade active in" id="bilgi" aria-labelledby="home-tab">
				<p><?php echo $veri["data1"][0]["ekstraBilgi"]; ?></p>
			  </div>
			  <div role="tabpanel" class="tab-pane fade " id="ozellik" aria-labelledby="profile-tab">
				<p><?php echo $veri["data1"][0]["ozellik"]; ?></p>
			  </div>
			  <div role="tabpanel" class="tab-pane fade" id="yorum" aria-labelledby="dropdown1-tab">


				 <!-- Yorum başla -->
				 
				 <?php

 					// durum 0 ise yani onaylanmış yorum yok ise	
					if (count($veri["data4"])==0):

						echo "<h4>Bu ürüne ait yorum bulunmamaktadır.</h4>" ;

					// tüm yorumları göster
					else:

						// ürünün adı ile id sini alıyoruz
						foreach($veri["data4"] as $value) :

					
						echo '<div class="media response-info">
						<div class="media-left response-text-left">								
							<h5>'.$value["ad"].'</h5>
						</div>
						
						
						<div class="media-body response-text-right">
							<p>'.$value["icerik"].'</p>
							<ul>
								<li>'.$value["tarih"].'</li>
								
							</ul>
						</div>
						<div class="clearfix"> </div>
						</div>';
						

						endforeach;

					endif;


					


				 ?>
                        
                
			  </div>
			  
			</div>
		   </div>
		   
		
	</div>

			</div>
			<div class="clearfix"></div>
			</div>
   </div>
   <div class="other-products products-grid">
		<div class="container">
			<header>
				<h3 class="like text-center">BENZER ÜRÜNLER</h3>   
			</header>		

			<?php
				
				// kategoriye ait -benzer ürünleri- gönderiyoruz
				foreach($veri["data3"] as $value) :


					// stoğu azalanlardaki ürünlere link veriyoruz
					echo '<div class="col-md-4 product simpleCart_shelfItem text-center">
					<a href="'.URL.'/urunler/detay/'.$value["id"].'/'. $ayarlar->seo($value["urunad"]).'">

					<img src="'.URL.'/views/design/images/'.$value["res1"].'" alt="'.$value["urunad"].'" /></a>

					<div class="mask">
						<a href="'.URL.'/urunler/detay/'.$value["id"].'/'. $ayarlar->seo($value["urunad"]).'">İNCELE</a>
					</div>

					<a class="product_name" href="'.URL.'/urunler/detay/'.$value["id"].'/'. $ayarlar->seo($value["urunad"]).'">'.$value["urunad"].'</a>
					<p><a class="item_add" href="#"><i></i> <span class="item_price">'
					. number_format($value["fiyat"],2,".",",").'</span></a></p>
				</div>';

				endforeach;
			?>


					<div class="clearfix"></div>
				   </div>
				   </div>
   <!-- content-section-ends -->
		<div class="news-letter">
			<div class="container">
				<div class="join">
					<h6>BÜLTENE KAYIT</h6>
					<div class="sub-left-right">
						<form>
							<input type="text" value="Mail Adresinizi Yazınız" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email Here';}" />
							<input type="submit" value="KAYIT OL" />
						</form>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>

<?php require 'views/footer.php';   ?> 
        
      
      