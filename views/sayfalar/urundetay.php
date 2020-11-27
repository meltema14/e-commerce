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
      <!-- Main component for a primary marketing message or call to action -->
      <ul class="nav nav-tabs responsive hidden-xs hidden-sm" id="myTab">
        <li class="test-class active"><a class="deco-none misc-class" href="#how-to"> Daha Fazla Bilgi</a></li>
        <li class="test-class"><a href="#features">Özellikler</a></li>
        <li class="test-class"><a class="deco-none" href="#source">Yorumlar (7)</a></li>
      </ul>

      <div class="tab-content responsive hidden-xs hidden-sm">
        <div class="tab-pane active" id="how-to">
		 <p class="tab-text"><?php /* vt deki uretimYeri çekiyoruz */ echo $veri["data1"][0]["ekstraBilgi"];?></p>    
        </div>
        <div class="tab-pane" id="features">
          <p class="tab-text"><?php /* vt deki ozellikleri çekiyoruz */ echo $veri["data1"][0]["ozellik"];?></p>
	
		</div>
        <div class="tab-pane" id="source">
		  <div class="response">
          
						<div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="" />
								</a>
								<h5><a href="#">Yorum Ad</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul>
									<li>Nisan 21, 2019</li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
                        
						<div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="" />
								</a>
								<h5><a href="#">Yorum Ad</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul>
									<li>Nisan 21, 2019</li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
                        
                        <div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="" />
								</a>
								<h5><a href="#">Yorum Ad</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul>
									<li>Nisan 21, 2019</li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
                        
                        <div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="" />
								</a>
								<h5><a href="#">Yorum Ad</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul>
									<li>Nisan 21, 2019</li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
                        
                        <div class="media response-info">
							<div class="media-left response-text-left">
								<a href="#">
									<img class="media-object" src="images/icon1.png" alt="" />
								</a>
								<h5><a href="#">Yorum Ad</a></h5>
							</div>
							<div class="media-body response-text-right">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
									sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul>
									<li>Nisan 21, 2019</li>
									
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
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
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="images/p1.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">Beyaz bluzzz</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$329</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="images/p2.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">Sarı Tişört</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$599.8</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="images/p3.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">Pembe</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$359.6</span></a></p>
					</div>
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
        
      
      