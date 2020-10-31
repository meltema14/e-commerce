<?php require 'views/header.php'; // İlk önce headerı dahil ettik ?> 

<div class="banner">
		<div class="container">
<div class="banner-bottom">
	<div class="banner-bottom-left">
		<h2>B<br>U<br>Y</h2>
	</div>
	<div class="banner-bottom-right">
		<div  class="callbacks_container">
					<ul class="rslides" id="slider4">
					<li>
								<div class="banner-info">
									<h3>Üst Slogan 1</h3>
									<p>Alt Slogan 1</p>
								</div>
							</li>
							<li>
								<div class="banner-info">
								   <h3>Üst Slogan 2</h3>
									<p>Alt Slogan 2</p>
								</div>
							</li>
							<li>
								<div class="banner-info">
								  <h3>Üst Slogan 3</h3>
									<p>Alt Slogan 3</p>
								</div>								
							</li>
						</ul>
					</div>
					<!--banner-->
	  			<script src="<?php  echo URL; ?>/views/design/js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager:true,
			        nav:false,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
	</div>
	<div class="clearfix"> </div>
</div>
	<div class="shop">
		<a href="single.html">HEMEN BAŞLA</a>
	</div>
	</div>
		</div>
		<!-- content-section-starts-here -->
		<div class="container">
			<div class="main-content">
                
				<div class="products-grid">
				<header>
					<h3 class="head text-center">YENİ ÜRÜNLER</h3>
				</header>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p1.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">Sed ut perspiciatis</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$329</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p2.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">great explorer</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$599.8</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p3.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">similique sunt</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$359.6</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p4.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">shrinking </a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$649.99</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p5.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">perfectly simple</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$750</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p6.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">equal blame</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$295.59</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p7.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">Neque porro</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$380</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p8.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">perfectly simple</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$540.6</span></a></p>
					</div>
					<div class="col-md-4 product simpleCart_shelfItem text-center">
						<a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/p9.jpg" alt="" /></a>
						<div class="mask">
							<a href="single.html">İNCELE</a>
						</div>
						<a class="product_name" href="single.html">praising pain</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">$229.5</span></a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		</div>
		<div class="other-products">
		<div class="container">
			<h3 class="like text-center">EN ÇOK SATANLAR</h3>        			
				     <ul id="flexiselDemo3">
						<li><a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/l1.jpg" class="img-responsive" alt="" /></a>
							<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="single.html">perfectly simple</a>
							<p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
							</div>
						</li>
						<li><a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/l2.jpg" class="img-responsive" alt="" /></a>						
							<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="single.html">praising pain</a>
							<p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
							</div>
						</li>
						<li><a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/l3.jpg" class="img-responsive" alt="" /></a>
							<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="single.html">Neque porro</a>
							<p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
							</div>
						</li>
						<li><a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/l4.jpg" class="img-responsive" alt="" /></a>
							<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="single.html">equal blame</a>
							<p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
							</div>
						</li>
						<li><a href="single.html"><img src="<?php  echo URL; ?>/views/design/images/l5.jpg" class="img-responsive" alt="" /></a>
							<div class="product liked-product simpleCart_shelfItem">
							<a class="like_name" href="single.html">perfectly simple</a>
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
        
      
      