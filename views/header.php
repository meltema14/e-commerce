<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php 
$ayarlar = new Ayarlar();  

ob_start();
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

		// header sepet ikonu
		$("#SepetDurum").load("<?php echo URL; ?>/GenelGorev/SepetKontrol");

		// üye panelinde silindiğinde gözükecek divi varsayılan olarak hide yaptık
		$("#Sonuc").hide();

		// yorum formunun başta görünmez olması için
		$("#FormAnasi").hide();

		$("#yorumEkle").click(function(e){

			$("#FormAnasi").slideToggle();

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

					// idsi ok olan form elemanını yani html değerini(Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır.) yakalıyoruz
					if ($('#ok').html() == "Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır.") {

						// yorum ekleme işlemi başarılı olduktan sonra yorum formunu gizleme
						$("#FormAnasi").fadeOut();

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


	// sepete ekle butonuna basıldığında
	$("#SepetBtn").click(function() {

		$.ajax({

			type:"POST",

			url:'<?php echo URL; ?>/GenelGorev/SepeteEkle',

			data:$('#SepeteForm').serialize(),

			success: function(donen_veri) {

				// formun içini temizler
				$('#SepeteForm').trigger("reset");

				// ürün sepete eklendiğinde yukarı doğru animasyonla kaydırma
				$("html,body").animate({scrollTop : 0}, "slow");

				// sepete eklediğinde load yapıp güncel değeri sepet ikonunda gösterir 
				$("#SepetDurum").load("<?php echo URL; ?>/GenelGorev/SepetKontrol");

				$('#Mevcut').html('<div class="alert alert-success text-center">SEPETE EKLENDİ</div>');
				

				

			},
		});
	});

	// GuncelForm içerisindeki güncelle butonu
	$('#GuncelForm input[type="button"]').click(function(){

		/* tıklanan butonun data-value özelliğini(yani urunid) yakaladık
		alert($(this).attr('data-value'));
		*/
		var id = $(this).attr('data-value');

		// GuncelForm içerisinde inputtaki adeti aldık 
		var adet = $('#GuncelForm input[name="adet'+id+'"]').val();

		// UrunGuncelle methoduna id ve adeti gönderdik
		$.post("<?php echo URL; ?>/GenelGorev/UrunGuncelle",{"urunid":id, "adet":adet}, function() {

		
		window.location.reload();

		});


	});





});

// linkten gelen degeri urunid olarak karşılıyoruz
function UrunSil(deger, kriter) {

	switch (kriter) {

		case "sepetsil":

			// post edildiğinde UrunSil fonk. gider
			$.post("<?php echo URL; ?>/GenelGorev/UrunSil",{"urunid":deger}, function() {

			window.location.reload();

			});

		break;

		case "yorumsil":

			// post edildiğinde UrunSil fonk. gider
			$.post("<?php echo URL; ?>/uye/Yorumsil",{"yorumid":deger}, function(donen) {

			if (donen) {

				$("#Sonuc").html("Yorum başarıyla silindi.");

			}
			else{

				$("#Sonuc").html("Silme işleminde hata oluştu.");

			}
			// yorum silindi yavaş bi şekilde gözükecek
			$("#Sonuc").fadeIn(1000,function(){

				// efekt tamamlandığında gizle
				$("#Sonuc").fadeOut(1000,function(){
					// sonucun içerisini temizleme
					$("#Sonuc").html("");
					// en son işlem bittiğinde sayfayı yenile
					window.location.reload();

				});

			});

		});

		break;

		case "adresSil":

			// post edildiğinde UrunSil fonk. gider
			$.post("<?php echo URL; ?>/GenelGorev/UrunSil",{"urunid":deger}, function() {

			window.location.reload();

			});

		break;


	}


	

}










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
							// giriş yapıldıysa "hesabım" gözükecek
							if(Session::get("kulad")): ?>

								<li><a href="<?php echo URL;?>/uye/panel">Hesabım</a></li>

							<?php else: ?>

								<li><a href="<?php echo URL;?>/uye/giris"><span class="glyphicon glyphicon-user"> </span>Giriş</a></li>
								<li><a href="<?php echo URL;?>/uye/hesapOlustur"><span class="glyphicon glyphicon-lock"> </span>Hesap Oluştur</a></li>	

							<?php
							endif;

						?>

					</ul>
				</div>
				<div class="header-right">
						<div class="cart box_1" id="SepetDurum">


							

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
        

   
