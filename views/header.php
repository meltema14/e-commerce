<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php $ayarlar = new Ayarlar();  


?>
<!DOCTYPE html>
<html>
<head>
<link href="<?php  echo URL; ?>/views/design/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php  echo URL; ?>/views/design/js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="<?php  echo URL; ?>/views/design/css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php  echo URL; ?>/views/design/css/component.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title><?php echo $ayarlar->title; ?></title>

<script>

	$(document).ready(function(e) {

		// yorum formunun başta görünmez olması için
		$("#Formanasi").hide();

		$("#yorumEkle").click(function(e){

			$("#Formanasi").slideToggle();

		});

		// yorumu post etme
		$("#yorumGonder").click(function() {

			/* 
			   url: nereye gönderileceği
			   serialize: formun içinde port edilen tüm verileri yakalar
			   success: urlden dönen cevap başarılıysa
			*/
			$.ajax({

				type:"POST",

				url:'<?php echo URL; ?>/GenelGorev/YorumFormKontrol',

				data:$('#yorumForm').serialize(),

				success: function(donen_veri) {

					// formun içini temizler
					$('#yorumForm').trigger("reset");

					$('#FormSonuc').html(donen_veri);

					// idsi ok olan form elemanını yani html değerini(KAYIT BAŞARILI) yakalıyoruz
					if ($('#ok').html() == "Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır.") {

						// yorum ekleme işlemi başarılı olduktan sonra yorum formunu gizleme
						$("#Formanasi").fadeOut();

					}
				},
			});	
		});


		// adet kısmında, number inputunun tüm klavye hareketlerinin de-active edilmesi
		// evt: event
		// keypress: klavye hareketlerini yakalar
		$("[type='number']").keypress(function (evt){

			// preventDefault: seçilmiş elemanın tüm özelliklerini pasif hale getirir
			evt.preventDefault();

		});

	// bülten butonuna tıklandığında
	$("#bultenBtn").click(function() {

		
		/* 
		url: nereye gönderileceği
		serialize: formun içinde port edilen tüm verileri yakalar
		success: urlden dönen cevap başarılıysa
		*/
		$.ajax({

			type:"POST",

			url:'<?php echo URL; ?>/GenelGorev/BultenKayit',

			data:$('#bultenForm').serialize(),

			success: function(donen_veri) {

				// formun içini temizler
				$('#bultenForm').trigger("reset");

				// Bulten idsinin içini formdan gelen sonuçla doldurduk
				$('#Bulten').html(donen_veri);

				// idsi ok olan form elemanını yani html değerini yakalıyoruz
				if ($('#bultenok').html() == "Bültene başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz.") {

				}
				
			},
		});
	});


	// iletişim butonuna basıldığında
	$("#İletisimbtn").click(function() {

		// $('#iletisimForm').fadeOut();
		
		// $('#FormSonuc').html("merhaba");

		
		$.ajax({

			type:"POST",

			url:'<?php echo URL; ?>/GenelGorev/iletisim',

			data:$('#iletisimForm').serialize(),

			success: function(donen_veri) {

				// formun içini temizler
				$('#iletisimForm').trigger("reset");

				$('#iletisimForm').fadeOut(1000);

				$('#FormSonuc').html(donen_veri);

				

			},
		});
	});







});

</script>

<meta name="description" content="<?php echo $ayarlar->sayfaAciklama; ?>" />
<meta name="keywords" content="<?php echo $ayarlar->anahtarKelime; ?>" />


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<!-- for bootstrap working -->
	<script type="text/javascript" src="<?php  echo URL; ?>/views/design/js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<!-- cart -->
	<script src="<?php  echo URL; ?>/views/design/js/simpleCart.min.js"> </script>
<!-- cart -->
<link rel="stylesheet" href="<?php  echo URL; ?>/views/design/css/flexslider.css" type="text/css" media="screen" />
</head>
<body>
	<!-- header-section-starts -->
	<div class="header">
		<div class="header-top-strip">
			<div class="container">
				<div class="header-top-left">
					<ul>
						<?php
							// giriş yapıldıysa "çıkış yap" gözükecek
							if(Session::get("kulad")==true): ?>

								<a href="<?php echo URL;?>/uye/cikis">ÇIKIŞ YAP</a>

							<?php else: ?>

								<li><a href="<?php echo URL;?>/uye/giris"><span class="glyphicon glyphicon-user"> </span>Giriş</a></li>
								<li><a href="<?php echo URL;?>/uye/hesapOlustur"><span class="glyphicon glyphicon-lock"> </span>Hesap Oluştur</a></li>	

							<?php
							endif;

						?>

					</ul>
				</div>
				<div class="header-right">
						<div class="cart box_1">
							<a href="<?php echo URL; ?>/sayfalar/sepet">
								<h3> <span class="simpleCart_total"> $0.00 </span> (<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span>)<img src="images/bag.png" alt=""></h3>
							</a>	
							<p><a href="javascript:;" class="simpleCart_empty">Sepet Boş</a></p>
							<div class="clearfix"> </div>
						</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- header-section-ends -->
			<div class="banner-top">
		<div class="container">
				<nav class="navbar navbar-default" role="navigation">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
			</button>

				<div class="logo">
					<h1><a href="<?php echo URL;?>"><span>E</span> -Ticaret</a></h1>
				</div>
		</div>
		
	    <!--/.navbar-header-->
	
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        <ul class="nav navbar-nav">
			<li><a href="<?php echo URL; ?>">Anasayfa</a></li>

				<?php 

					// menüler
					$ayarlar->LinkleriGetir();


				?>
				
				<li><a href="<?php echo URL; ?>/sayfalar/iletisim">İletişim</a></li>
	        </ul>
	    </div>
	    <!--/.navbar-collapse-->
	</nav>
	<!--/.navbar-->
</div>
	</div>
        </div>
        

   
