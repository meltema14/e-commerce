<?php require 'views/header.php'; // İlk önce headerı dahil ettik ?>


<!-- content-section-starts -->
<div class="container">
	<div class="products-page">
		<div class="products">
			<div class="product-listy">
				<h2>DİĞER KATEGORİLER</h2>
				<ul class="product-list">

				<?php

					// ürünün adı ile id sini alıyoruz
					foreach($veri["data2"] as $value) :

						// stoğu azalanlardaki ürünlere link veriyoruz
						echo ' <li><a href="'.URL.'/urunler/detay/'.$value["id"].'/'.$ayarlar->seo($value["ad"]).'"> '
						.$value["ad"]. '</a></li>';

					endforeach;


				?>
					
				</ul>
			</div>
		</div>
		<div class="new-product">
			<div class="new-product-top">
				<ul class="product-top-list">
					<li><a href="index.html">Anasayfa</a>&nbsp;<span>&gt;</span></li>
					<li><span class="act">Kategori</span>&nbsp;</li>
				</ul>
				<p class="back">  
					<select class="form-control">
						
							<option value="">İndirim Oranı</option>
							<option value="">Fiyat Artan</option>
							<option value="">Fiyat Azalan</option>

					</select>
				</p>
				<div class="clearfix"></div>
			</div>
			
			<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
				<div class="cbp-vm-options">
					<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Izgara</a>
					<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">Listeli</a>
				</div>
				<div class="pages">   
				<div class="limiter visible-desktop">
				<label>Gösterilecek Adet</label>
					<select >
						<option value="" selected="selected">9</option>
						<option value="">15</option>
						<option value="">30</option>
					</select>         
			</div>
		</div>
		<div class="clearfix"></div>
			<ul>

				<?php

					// ürünün adı ile id sini alıyoruz
					foreach($veri["data1"] as $value) :

					// kaç tane ürün varsa kategorilerde gösterilir
					echo '
					<li>
						"<a class="cbp-vm-image" href="single.html">
							<div class="simpleCart_shelfItem">
								<div class="view view-first">
									<div class="inner_content clearfix">
										<div class="product_image">
											<img src="'.URL.'/views/design/images/'.$value["res1"].'" class="img-responsive" alt="'.$value["urunad"].'"/>
											<div class="mask">
												<div class="info">İNCELE</div>
											</div>
											<div class="product_container">
												<div class="cart-left">
													<p class="title">'.$value["urunad"].'</p>
												</div>
												<div class="pricey"><span class="item_price">'.number_format($value["fiyat"],2,".",",").'</span></div>
												<div class="clearfix"></div>
											</div>		
										</div>
									</div>
								</div>
						</a>"
								<a class="cbp-vm-icon cbp-vm-add item_add" href="#">Ekle</a>
							</div>
					</li>';

					

						// stoğu azalanlardaki ürünlere link veriyoruz
						echo ' <li><a href="'.URL.'/urunler/detay/'.$value["id"].'/'.$ayarlar->seo($value["urunad"]).'"> '
						.$value["urunad"]. '</a></li>';

					endforeach;
				?>


				

			</ul>
		</div>
		<script src="<?php  echo URL; ?>/views/design/js/cbpViewModeSwitch.js" type="text/javascript"></script>
		<script src="<?php  echo URL; ?>/views/design/js/classie.js" type="text/javascript"></script>
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- content-section-ends -->
<div class="other-products">
	<div class="container">
		<h3 class="like text-center">ÖNE ÇIKAN ÜRÜNLER</h3>        			
		<ul id="flexiselDemo3">
			<li><a href="single.html"><img src="images/l1.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l2.jpg" class="img-responsive"/></a>						
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Praising pain</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l3.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Neque porro</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l4.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Equal blame</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l5.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$649</span></a></p>
				</div>
			</li>
		</ul>
		<script type="text/javascript">
			$(window).load(function() {
				$("#flexiselDemo3").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,    		
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: { 
						portrait: { 
							changePoint:480,
							visibleItems: 1
						}, 
						landscape: { 
							changePoint:640,
							visibleItems: 2
						},
						tablet: { 
							changePoint:768,
							visibleItems: 3
						}
					}
				});
			
			});
		</script>
		<script type="text/javascript" src="<?php  echo URL; ?>/views/design/js/jquery.flexisel.js"></script>
	</div>
</div>
<!-- content-section-ends-here -->






<?php require 'views/footer.php';   ?> 
        
      
      