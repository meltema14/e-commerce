<?php require 'views/header.php'; // İlk önce headerı dahil ettik ?>




		<!-- checkout -->
		<div class="cart-items">
	<div class="container">
	
			 <h2>SEPETİNİZDEKİ ÜRÜN - <?php echo count($_COOKIE["urun"]); ?></h2>
		<div class="cart-gd">
        
        <?php
		
		
			if (isset($_COOKIE["urun"])) :
		
		
				foreach ($_COOKIE["urun"] as $id => $adet) :
				
				
				$GelenUrun=$ayarlar->UrunCek($id);
				
				 //	$id db ye ilgili ürünü çekicem ve listelicem
				
				echo' <div class="cart-header">
				 <div class="close1">
				 
				
				 
				  <input type="button" class="btn btn-sm btn-success" value="GÜNCELLE">
				   <a href="#" class="btn btn-sm btn-danger">SİL</a> 
				  </div>
				  
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="'.URL.'/views/design/images/'.$GelenUrun[0]["res1"].'" class="img-responsive" alt="'.$GelenUrun[0]["urunad"].'">
						</div>
					   <div class="cart-item-info">
						<h3><a href="#"> '.$GelenUrun[0]["urunad"].' </a></h3>
						
						<ul class="qty">
							<li><h3>Ürün Fiyat</h3>
							<span>'.number_format($GelenUrun[0]["fiyat"],2,'.',',').'</span></li>
							<li><h3>Ürün Adet</h3>
							
		  <input type="number" min="1" max="10" value="'.$adet.'" name="adet" class="form-control" /> 
	
		  
							</li>
						</ul>
							 <div class="delivery" >
							
							 <span>Toplam Fiyat : '.number_format($GelenUrun[0]["fiyat"]*$adet,2,',','.').'</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			 </div>';
				
				endforeach;
				
				echo '
				
				<div class="row toplamAlan_2">
				<div class="col-md-12">	TOPLAM : 0.000,0</div>
				
				</div>
				
				
				
				<div class="row toplamAlan">
				<div class="col-md-12">
				
				<a href="#" class="btn btn_1">ALIŞVERİŞE DEVAM ET</a>
				<a href="#" class="btn btn_1">SİPARİŞİ TAMAMLA</a>
				
				
				
				</div>
				
				</div>';
		
		
	
		
		endif;
	
		
		?>
        
            
				
              
              
              
		</div>
	</div>
</div>

<!-- //checkout -->	












<?php require 'views/footer.php'; ?> 
        
      
      