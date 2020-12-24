
$(document).ready(function(e) {

  // header sepet ikonu
  $("#SepetDurum").load("http://localhost/mvcproje/GenelGorev/SepetKontrol");

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

      url:'http://localhost/mvcproje/GenelGorev/YorumFormKontrol',

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

    url:'http://localhost/mvcproje/GenelGorev/BultenKayit',

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

    url:'http://localhost/mvcproje/GenelGorev/iletisim',

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

    url:'http://localhost/mvcproje/GenelGorev/SepeteEkle',

    data:$('#SepeteForm').serialize(),

    success: function(donen_veri) {

      // formun içini temizler
      $('#SepeteForm').trigger("reset");

      // ürün sepete eklendiğinde yukarı doğru animasyonla kaydırma
      $("html,body").animate({scrollTop : 0}, "slow");

      // sepete eklediğinde load yapıp güncel değeri sepet ikonunda gösterir 
      $("#SepetDurum").load("http://localhost/mvcproje/GenelGorev/SepetKontrol");

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
  $.post("http://localhost/mvcproje/GenelGorev/UrunGuncelle",{"urunid":id, "adet":adet}, function() {

  
  window.location.reload();

  });


});

// -----------------------------------------------------------------

// üye-panel yorumlar- guncelle butonu
$('#GuncelButonlarinanasi input[type="button"]').click(function(){

  /* tıklanan butonun data-value özelliğini(yani urunid) yakaladık
  alert($(this).attr('data-value'));
  */
  var id = $(this).attr('data-value');
  
  var textArea = $("<textarea id='"+id+"' name='yorum' style='width:%100 height:200px' />");

  // textareanin içini spandan gelen değerle doldur
  textArea.val($(".sp"+id).html());

  $(".sp"+id).parent().append(textArea);

  // spanı uçur
  $(".sp"+id).remove();
  input.focus();

});

// sayfanın genelinde textareadaki hareketi yakala
$(document).on('blur', 'textarea[name=yorum]', function() {

  // textarea ekle ve html işemini value değeri olarak yaz
  $(this).parent().append($('<span/>').html($(this).val()));
  var id = $(this).attr("id");
  // textarea kaldır
  $(this).remove();

  // UrunGuncelle methoduna id ve adeti gönderdik
  $.post("http://localhost/mvcproje/uye/YorumGuncelle",{"yorumid":id, "yorum":$(this).val()}, function(donen) {

  //alert(donen);
  window.location.reload();

  });


});

// ------------------------------------------------------------------
// üye-panel adresler- guncelle butonu
$('#AdresGuncelButonlarinanasi input[type="button"]').click(function(){

  /* tıklanan butonun data-value özelliğini(yani urunid) yakaladık
  alert($(this).attr('data-value'));
  */
  var id = $(this).attr('data-value');
  
  var textArea = $("<textarea id='"+id+"' name='adres' style='width:%100 height:%100 ' />");

  // textareanin içini spandan gelen değerle doldur
  textArea.val($(".adresSp"+id).html());

  $(".adresSp"+id).parent().append(textArea);

  // spanı uçur
  $(".adresSp"+id).remove();
  input.focus();

});

// sayfanın genelinde textareadaki hareketi yakala
$(document).on('blur', 'textarea[name=adres]', function() {

  // textarea ekle ve html işemini value değeri olarak yaz
  $(this).parent().append($('<span/>').html($(this).val()));
  var id = $(this).attr("id");
  // textarea kaldır
  $(this).remove();

  // UrunGuncelle methoduna id ve adeti gönderdik
  $.post("http://localhost/mvcproje/uye/AdresGuncelle",{"adresid":id, "adres":$(this).val()}, function(donen) {

  //alert(donen);
  window.location.reload();

  });


});



});

// linkten gelen degeri urunid olarak karşılıyoruz
function UrunSil(deger, kriter) {

switch (kriter) {

  case "sepetsil":

    // post edildiğinde UrunSil fonk. gider
    $.post("http://localhost/mvcproje/GenelGorev/UrunSil",{"urunid":deger}, function() {

    window.location.reload();

    });

  break;

  case "yorumsil":

    // post edildiğinde UrunSil fonk. gider
    $.post("http://localhost/mvcproje/uye/Yorumsil",{"yorumid":deger}, function(donen) {

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
    $.post("http://localhost/mvcproje/uye/adresSil",{"adresid":deger}, function(donen) {

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
