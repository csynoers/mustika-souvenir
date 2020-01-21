<?php
	error_reporting(0);
	require_once '../../../josys/db_connect.php';
  include_once '../../../josys/class/Database.php';
  include_once "../../../josys/class/Tanggal.php";
  include_once "../../../josys/class/Rupiah.php";

	$tanggal   = new Tanggal();
  $database 	= new Database($db);

	$limit = $_POST['limit_home'];
	
	$output = array();
	$totalRow = $database->count_rows($table="sub_information", $where_clause="WHERE status = '1'");
	$total_pages = ceil($totalRow/$limit);
	$sub_information   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' order by dateTime DESC LIMIT $limit", $fetch='all');
	
	if ($totalRow == 0) {
		$output['results'] = '
			<div class="col-sm-12">
				<div class="error-box">
					<div class="error-banner">
						<h1>!! <span>!!!</span> !!</h1>
						<p>Oops!! Data yang anda minta belum tersedia ..</p>
					</div>
				</div>
			</div>';
	}else{
		   
		
	  foreach ($sub_information as $key => $value) {
	  	$cat = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $value[id_information]", $fetch='');
	  	$arrSer = explode(' ', $value["sertification"]);
			$sertif = $arrSer[0];
			if ($value["premium"] == '1') {
				$st = 'box-highlight';
				$moreImg = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = '$value[id_subinformation]'", $fetch='all');
					$img = '
					<div id="img-highlight-'.$value["id_subinformation"].'" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
					      <img src="joimg/information/thumbnail/'.$value["image"].'" alt="'.$value["title"].'" class="img-fluid">
					    </div>';
							foreach ($moreImg as $keyImg => $valueImg) {
								$img .= '
						    <div class="carousel-item">
						      <img src="joimg/information/thumbnail/'.$valueImg["image"].'" alt="'.$value["title"].'" class="img-fluid">
						    </div>
							  ';
							}
					$img .= '
						</div>
					  <button class="carousel-control-prev" href="#img-highlight-'.$value["id_subinformation"].'" data-slide="prev">
					  	<span><i class="mdi mdi-chevron-left"></i></span>
					  </button>
					  <button class="carousel-control-next" href="#img-highlight-'.$value["id_subinformation"].'" data-slide="next">
					    <span><i class="mdi mdi-chevron-right"></i></span>
					  </button>
					</div>';
					$label = '<div class="badge images-badge">Premium</div>';

			}else{

				$label = '';
				$st = '';
				$img = '<img src="joimg/information/thumbnail/'.$value["image"].'" alt="'.$value["title"].'" class="img-fluid">';
			}
			$output['results'][] = '
				<div class="item col-xs-4 col-md-3 col-lg-3 grid-group-item '.$st.'">
        	<a href="souvenir-'.$cat["seo"].'-'.$value["seo"].'-'.$value["id_subinformation"].'">
        		'.$label.'
          	<div class="thumbnail card">
              <div class="img-event">
                '.$img.'
              </div>
              <div class="caption card-body">
                <h5 class="title-text title-nowrap">'.$value["title"].'</h5>
						    <h6 class="subtitle-nowrap mb-1 mb-md-2">'.$value["address"].'</h6>
						    <div class="d-flex mb-1 mb-md-2">
							  	<ul class="text-nowrap list-border list-unstyled list-inline mb-0">
						       	<li class="list-inline-item"><b>'.$cat["title"].'</b></li>
						       	<li class="list-inline-item"><b>Kode : '.$value["kode"].'</b></li>
						      </ul>
						    </div>
						    <div class="d-flex align-items-center">
							    <h6 class="mb-0 title-nowrap flex-grow-1"><b>'.Rupiah::tanpa_nol($value["price"]).' </b></h6>
							    <p class="mb-0"><small><i class="mdi mdi-clock"></i> '.$tanggal->TimeElapsedString($value["dateTime"]).'</small></p>
						    </div>
              </div>
          	</div>
          </a>
        </div>
			';
		}
	}

	echo json_encode($output);
  		
  	
?>
