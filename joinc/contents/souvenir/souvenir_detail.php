<?php
$id_subinformation = $_GET['id'];
$iklan   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' AND id_subinformation = '$id_subinformation'", $fetch="");

$information = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $iklan[id_information]", $fetch="");
// $city = $database->select($fields="*", $table="city", $where_clause="WHERE city_id = $iklan[city_id]", $fetch="");
$hits = $iklan['view']+1;
$form_data = array(
            "view"      => "$hits",
            "dateTime"  => "$iklan[dateTime]"
        );
$database->update($table="sub_information", $array=$form_data, $fields_key="id_subinformation", $id="$id_subinformation");
// $waIklan = '+62'.substr(trim($iklan["whatsapp"]), 1);
// $phoneIklan = '+62'.substr(trim($iklan["phone"]), 1);
$linkUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$linkWaDetail = $linkWa."".$waIklan."&text=hallo, saya menemukan listing ini di ".$linkUrl." tolong kirimkan informasi lebih lanjut... ";
// if ($iklan['ac'] == '1') {
// 	$ac = 'Ya';
// }else{
// 	$ac = 'Tidak';
// }
?>
<main role="main" class="flex-shrink-0 souvenir-detail">
	<div class="container">
	  <ol class="breadcrumb bg-transparent p-0 mt-1 mt-md-3">
	    <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
	    <li class="breadcrumb-item"><a href="souvenir">Souvenir</a></li>
	    <li class="breadcrumb-item active text-nowrap" aria-current="page"><?php echo $iklan["title"];?></li>
	  </ol>
	
		<div class="row">
			<div class="col-lg-3 col-md-12 d-none d-lg-block card">
					<div class="sidebar-sticky">
						<div class="sticky-content">
							<div class="list-group sidebar-filter">
								<div class="list-group-item">
								  	<p class="list-title mb-0" data-toggle="collapse" data-target="#sidebar_category"><strong>Kategori </strong></p>
								  	<div class="list-item collapse show" id="sidebar_category">	
								  		<label class="tblf control__custom control__radio">
										    <input type="radio" name="category"  onClick="location.href='souvenir'"/>
										    <div class="control__indicator"></div>
										     <span>Semua Kategori</span>
										</label>
								  	<?php 
								  		$qkat = $database->select("*", "information", "WHERE status = '1'", "all");
								  		foreach ($qkat as $key => $vkat) {
								  			echo '
								  				<label class="tblf control__custom control__radio">
											    <input type="radio" name="category"  onClick="location.href=\'souvenir?category='.$vkat['seo'].'\'"/>
											    <div class="control__indicator"></div>
											     <span>'.$vkat['title'].'</span>
												</label>
								  			';
								  		}
								  	 ?>							  	
									</div>
								</div>
								<div class="list-group-item">
								  	<p class="list-title mb-0" data-toggle="collapse" data-target="#sidebar_price"><strong>Harga </strong></p>
								  	<div class="list-item collapse show" id="sidebar_price">
										<form id="form-sidebar-price" class="d-flex align-items-center mt-2">
											<input type="text" name="price-min" placeholder="Min" class="form-control valid-number" value="" required>				   	
								   			<input type="text" name="price-max" placeholder="Max" class="form-control valid-number" value="" required>
								   			<button type="submit" class="btn-price"><i class="mdi mdi-chevron-right"></i></button>
									   	</form>
								   </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="col-lg-9 col-md-12 page-result">
				<div class=" ">
					<div class="item-slide-detail bg-white">
						<?php if ($iklan["premium"] == 1){
							echo '<div class="badge images-badge">Premium</div>';
						} ?>
						<div id="item-images" class="slider owl-carousel owl-theme zoom-image">
						   
						   	<?php 
						   	$bg_img1  = str_replace(' ', '%20',$iklan["image"]);
						   	echo '

						   		<div class="item">
						   		<div class="bg-blur" style="background-image: url(joimg/information/thumbnail/'.$bg_img1.');"></div>
						   		<a href="joimg/information/'.$iklan["image"].'" title="'.$iklan["title"].'" class="lightbox-img">
							      <img src="joimg/information/'.$iklan["image"].'" alt="'.$value["title"].'" class="image owl-lazy" />
							      </a>
						    	</div>';
								$img  = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = '$id_subinformation'", $fetch="all");
									foreach ($img as $key => $value) {
										$bg_img2  = str_replace(' ', '%20',$value["image"]);
										echo '
										<div class="item">
											<div class="bg-blur" style="background-image: url(joimg/information/'.$bg_img2.');"></div>
											<a href="joimg/information/thumbnail/'.$value["image"].'" title="'.$iklan["title"].'" class="lightbox-img">
									      <img src="joimg/information/'.$value["image"].'" alt="'.$value["title"].'" class="image owl-lazy" />
									      </a>
								    	</div>
										';
									}
								?>
					    </div>
				    
					    <div id="item-thumbs" class="navigation-thumbs owl-carousel">
					    	<?php
					    		echo '
						   		<div class="item">
							      <img src="joimg/information/thumbnail/'.$iklan["image"].'" alt="'.$value["title"].'" class="img-fluid" />
						    	</div>';
					    		foreach ($img as $key => $valueThumb) {
										echo '
										<div class="item">
									      <img src="joimg/information/thumbnail/'.$valueThumb["image"].'" alt="'.$value["title"].'" class="img-fluid" />
								    	</div>
										';
									}
					    	?>
					    </div>
					    <div id="counter-item-slide"></div> 
					</div>
					<div class="bottom-list mt-3 bg-white col-lg-12">
						<?php echo '
						<h4>'.Rupiah::tanpa_nol($iklan["price"]).'</h4>
						<h4 class="mb-1 mb-md-2">'.$iklan["title"].'</h4>
						
						<p class="mb-0">
						<span><i class="mdi mdi-clock"></i> '.$tanggal->indo($iklan["dateTime"]).'</span>
						<span class="float-right"><b>Kode : '.$iklan["kode"].'</b></span>
						</p>'; ?>
						<div class="social-share mt-3">
				          <div class="d-inline-block">
					          <div class="text-share  mb-0">
					              <span class="icon-share"><i class="mdi mdi-share-variant"></i></span>
					              <span class="icon-share-text d-none d-md-inline-block">Share</span>
					          </div>
					          <div class="d-inline-block icon-social mb-0">
					            <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmustikasouvenir.com&t=<?php echo $iklan[seo]?>" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;" class="icon-share facebook mr-2"><i class="mdi mdi-facebook"></i></a>
					            <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fmustikasouvenir.com&text=<?php echo $iklan[seo]?>:%20http%3A%2F%2Fmustikasouvenir.com" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;" class="icon-share twitter mr-2"><i class="mdi mdi-twitter"></i></a>
					            <a href="https://plus.google.com/share?url=http%3A%2F%2Fmustikasouvenir.com" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;" class="icon-share google-plus mr-2"><i class="mdi mdi-google-plus"></i></a>
					            <a href="whatsapp://send?text=<?php echo $linkWaDetail ?>" class="icon-share whatsapp" title="whatsapp"><i class="mdi mdi-whatsapp"></i></a>
					          </div>
				          </div>
				        </div>	
						<?php 
						echo '
						<hr>						
						<div class="show-more">
							'.$iklan["description"].'
							<a href="#" class="show-more-button">Lihat Selengkapnya <i class="mdi mdi-chevron-double-down"></i></a>
						</div>
						'; ?>
					</div>
					<br>
						<h5>Souvenir Lainnya</h5>
					<div class="mt-3 row">
						<?php 
						$qrelated   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' AND id_subinformation != '$id_subinformation' AND id_information = '$iklan[id_information]'  LIMIT 6", $fetch='all');
						foreach ($qrelated as $key => $vrel) {
							$prem = ($vrel['premium']=='1') ? '<div class="badge images-badge">Premium</div>' : '' ;
						echo'
							<div class="item col-xs-4 col-md-4 col-lg-4 '.$active_view.' '.$st.'">
				              	<a href="souvenir-'.$information["seo"].'-'.$vrel["seo"].'-'.$vrel["id_subinformation"].'">
			              		'.$prem.'
			                	<div class="thumbnail card">
				                    <div class="img-event">
				                      <img src="joimg/information/thumbnail/'.$vrel["image"].'" alt="'.$vrel["title"].'" class="img-fluid">
				                    </div>
				                    <div class="caption card-body">
				                      <h5 class="title-text ">'.$vrel["title"].'</h5>
									    <div class="d-flex mb-1 mb-md-2">
										  	<ul class="text-nowrap list-border list-unstyled list-inline mb-0">
										       	<li class="list-inline-item"><b>'.$information["title"].'</b></li>
										       	<li class="list-inline-item"><b>Kode : '.$vrel["kode"].'</b></li>
										    </ul>
									    </div>
									    <div class="d-flex align-items-center">
										    <h6 class="mb-0 title-nowrap flex-grow-1"><b>'.Rupiah::tanpa_nol($vrel["price"]).'</b> </h6>
										    <p class="mb-0"><small><i class="mdi mdi-clock"></i> '.$tanggal->TimeElapsedString($vrel["dateTime"]).'</small></p>
									    </div>
								    </div>
								</div>
								</a>
							</div>
						';
						}


						 ?>
					</div>			
				</div>
			</div>
	</div>
</main>

<script>
	$('#form-sidebar-price').submit(function (event) {
      event.preventDefault();
      
	    var pMin = $('#sidebar_price input[name="price-min"]').val();
	    var pMax = $('#sidebar_price input[name="price-max"]').val();
	    var price = pMin+'_'+pMax;
	 
      $.post('load_souvenir',{price:price},function(data){
      	window.location.assign('souvenir?price='+price);
      });
    });
</script>