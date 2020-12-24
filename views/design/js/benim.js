
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
			$.post("<?php echo URL; ?>/uye/adresSil",{"adresid":deger}, function(donen) {

			if (donen) {

			$("#Sonuc").html("Adres başarıyla silindi.");

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


	}


	

}
