<?php
$noCall = $database->select($fields="*", $table="contact", $where_clause="WHERE id_contact = '1'", $fetch="");
$noWa = $database->select($fields="*", $table="contact", $where_clause="WHERE id_contact = '2'", $fetch="");
$email = $database->select($fields="*", $table="contact", $where_clause="WHERE id_contact = '3'", $fetch="");
    
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

if ($iphone || $android || $palmpre || $ipod || $berry == true){
  $linkWa = 'https://api.whatsapp.com/send?phone=';
  $linkWaText = 'https://api.whatsapp.com/send?phone='.$noWa["description"].'&text=Hallo, mohon informasi untuk souvenir wilayah jogja dan sekitar ...';

}else {
  $linkWa = 'https://web.whatsapp.com/send?phone=';
  $linkWaText = 'https://web.whatsapp.com/send?phone='.$noWa["description"].'&text=Hallo, mohon informasi untuk souvenir wilayah jogja dan sekitar ...';

}
$linkCall = 'tel:'.$noCall['description']; 
$linkEmail = 'mailto:'.$email['description'];

?>
<header>
  <div class="header-top fixed-top">
  	<div class="container">
  		<div class="row-header">
  			<div class="navbar-light navbar-expand-md">
  				<button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon-menu"></span>
		    	</button>
  			</div>
	  		
		  	<div class="logo">
		  		<a href="<?php echo $config['web_index'];?>" title="<?php echo $config['web_name'];?>"><img src="assets/images/logo_sm.png" alt="<?php echo $config['web_name'];?>"></a>
		  	</div>
		  	
		  	<div class="filter-search">
		  		<div class="fs-content">
		  			<div class="ct-center">
				
						<form class="input-group search-icon" method="post" id="search-form-nav">
						  <input type="text" class="form-control" placeholder="Temukan souvenir disini ..." required="" name="keyword">
						  <div class="input-group-append">
						    <button class="btn btn-outline-secondary" type="submit"></button>
						  </div>
						</form>
					
			        </div>
		  		</div>	
		  	</div>
		  	<!-- <div class="d-none d-md-flex align-items-center contact-icon">
				 <a href="<?php echo $linkWaText;?>"> <i class="mdi mdi-whatsapp"></i> <span class="ml-1">Chat</span></a>			
			</div> -->

	  	</div>
  	</div>
  	

  </div>
  <?php 
  if ($_GET['mod'] == 'news' || $_GET['mod'] == 'news-detail' || $_GET['mod'] == 'search') {
  	$colClass = 'content-news';
  }else{
  	$colClass = '';
  }
  ?>
	<nav class="navbar navbar-expand-md navbar-light bg-white p-0">
		<div class="container <?php echo $colClass;?>">
		    <div class="nav-mobile collapse navbar-collapse" id="navbarCollapse">
		      <ul class="navbar-nav mr-auto">
		      	<?php 
		      		$qh = $database->select("*", "information", "WHERE status = '1'", "all");
		      		foreach ($qh as $key => $vh) {
		      			echo '
		      			<li class="nav-item">
				          <a class="nav-link first" href="souvenir?category='.$vh['seo'].'">'.$vh['title'].'</a>
				        </li>
		      			';
		      		}
		      	 ?>
		      	<li class="nav-item">
		          <a class="nav-link first" href="<?php echo $config['web_index'];?>">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link first" href="souvenir">Souvenir</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link first" href="keunggulan">Keunggulan</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link first" href="cara-pemesanan">Cara Pemesanan</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link first" href="hubungi-kami">Hubungi Kami</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="cari-souvenir-di-jogja">Cari Properti ?</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="galeri-souvenir-jogja">Galeri</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="berita-souvenir">Berita Properti</a>
		        </li>
		      </ul>
		    </div>
		</div>
  </nav>
</header>
<div class="container" id="run-sticky">
	  <div class="run-sticky">	  			
			<div class="runing">
			  	<strong>Info :</strong>
				<ul>				
				  	<li>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</li>
				</ul>
			</div>
	  </div> 
  	
  </div>