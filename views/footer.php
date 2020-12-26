<div class="footer">
		<div class="container">
		 <div class="footer_top">
			<div class="span_of_4">
				<div class="col-md-3 span1_of_4">

					<h4>En Çok Satanlar</h4>
					<ul class="f_nav">

					<?php

					foreach($harici->encoksatan as $deger):

						echo '<li><a href="'.URL.'/urunler/detay/'.$deger["id"].'/'.
						$harici->seo($deger["urunad"]).'">'.$deger["urunad"].'</a></li>';

					endforeach;

					?>

					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Yardım</h4>
					<ul class="f_nav">
						<li><a href="<?php echo URL; ?>/sayfalar/kargonezamangelir">Kargo ne zaman gelir</a></li>
						<li><a href="<?php echo URL; ?>/sayfalar/iadehakki">İade hakkı</a></li>
						<li><a href="<?php echo URL; ?>/sayfalar/musterihizmetleri">Müşteri hizmetleri</a></li>
						<li><a href="<?php echo URL; ?>/sayfalar/gizlilikpolitikasi">Gizlilik politikası</a></li>
						<li><a href="<?php echo URL; ?>/sayfalar/satissozlesmesi">Satış sözleşmesi</a></li>
						<li><a href="<?php echo URL; ?>/sayfalar/iletisim">Bize Ulaşın</a></li>
					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Stoğu Azalanlar</h4>
					<ul class="f_nav">
						<li><a href="account.html">Giriş yap</a></li>
						<li><a href="register.html">Üye ol</a></li>
						<li><a href="#">Liste oluştur</a></li>
						<li><a href="checkout.html">Sepetim</a></li>
						<li><a href="#">Üyelik Hakları</a></li>
						<li><a href="#">Üyelik Avantajları</a></li>
					</ul>					
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Popüler Kategoriler</h4>
					<ul class="f_nav">
						<li><a href="#">Yeni ürünler</a></li>
						<li><a href="#">Erkek</a></li>
						<li><a href="#">Kadın</a></li>
						<li><a href="#">Çocuk</a></li>
						<li><a href="#">Aksesuar</a></li>
						<li><a href="#">Çanta</a></li>
						<li><a href="#">Saat</a></li>
						<li><a href="#">Oyuncak</a></li>
					</ul>			
				</div>
				<div class="clearfix"></div>
				</div>
		  </div>
		  <div class="cards text-center">
				<img src="images/cards.jpg" alt="" />
		  </div>
		  <div class="copyright text-center">
				<p>© 2019 Eshop. All Rights Reserved | Design by   <a href="http://w3layouts.com">  W3layouts</a></p>
		  </div>
		</div>
		</div>
</body>
</html>