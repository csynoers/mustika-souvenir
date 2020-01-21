<?php
	// error_reporting(0);
	require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';
	include_once "../../../josys/class/Tanggal.php";
	include_once "../../../josys/class/Rupiah.php";
	include_once "get_url.php";
	$tanggal   = new Tanggal();
	$database 	= new Database($db);
 
	$limit = $_POST['limit'];
	if(isset($_POST['page']) && $_POST['page'] != "") {
		$page = $_POST['page'];
		$offset = $limit * ($page-1);
	} else {
		$page = 1;
		$offset = 0;
	}
	$active_view = $_POST["active_view"];
	$title_nowrap = $_POST["title_nowrap"];
	$output = array();

	if (!empty($data['get']['category'])){
		$getCat  = ($data['get']['category']);
		if ($getCat == 'all') {
		  $whereCat  = "id_information LIKE '%%'"; 
		  $removeCat = '';
		  $checkedAllCat = 'checked';
		}else{
		  $cat   = $database->select($fields="*", $table="information", $where_clause="WHERE seo = '$getCat'", $fetch='');
		  $whereCat  = 'id_information = '.$cat["id_information"].'';
		  $removeCat = '<a class="remove-filter" onClick="removeQString(\'category\',\''.$getCat.'\')" >'.$getCat.' </a>';
		  $checkedAllCat = '';
		}
	}else{
		$whereCat  = "id_information LIKE '%%'"; 
		$checkedAllCat = 'checked';
		$getCat = '';
		$removeCat = '';
	}


  if (!empty($data['get']['sorting'])) {
      $sort = ($data['get']['sorting']);
      switch ($sort) {
        case 'price-high':
            $getSort = 'ORDER BY price DESC';
			$sl1 = 'selected';
			$sl2 = '';
			$sl3 = '';
			$sl4 = '';
        break;
        case 'price-low':
            $getSort = 'ORDER BY price ASC';
            $sl2 = 'selected';
			$sl3 = '';
			$sl1 = '';
			$sl4 = '';
        break;
        case 'posted-desc':
            $getSort = 'ORDER BY dateTime DESC';
            $sl3 = 'selected';
			$sl2 = '';
			$sl1 = '';
			$sl4 = '';
        break;
        case 'default':
            $getSort = 'ORDER BY RAND()';
            $sl4 = 'selected';
			$sl3 = '';
			$sl2 = '';
			$sl1 = '';            
        break;
        default:            
      }
      
  }else{
      $getSort = 'ORDER BY RAND()';
      $sl4 = 'selected';
      $sl3 = '';
      $sl2 = '';
      $sl1 = '';
  }

  $output['sorting'] = '
       	<option value="default" '.$sl4.'>Default</option>
        <option value="posted-desc" '.$sl3.'>Terbaru</option>
        <option value="price-low" '.$sl2.'>Harga Terendah</option>
        <option value="price-high" '.$sl1.'>Harga Tertinggi</option>
  ';
	
  if (!empty($data['get']['keyword'])) {
      $keyDefault = ($data['get']['keyword']);
      $key        = str_replace('-', ' ', $keyDefault);
      // $getKey     = mysql_real_escape_string($key);
      $getKey     = $key;
      $varTerm    = explode("-", $getKey);
      $termArray  = array();
      foreach($varTerm as $term){
          $term = trim($term);
          $termArray[] = "title LIKE '%".$term."%' OR description LIKE '%".$term."%'";
      }
      $whereKey = '('.implode(' OR ', $termArray).')';
      $removeKey = '<a class="remove-filter" onClick="removeQString(\'keyword\',\''.$keyDefault.'\')" >Pencarian dari: '.$key.' </a>';
  }else{
      $whereKey = "title LIKE '%%'";
      $removeKey = '';
  }

 	if (!empty($data['get']['price'])) {
      $getPrice       = preg_replace("/[^0-9_]/", '', ($data['get']['price']));
      if ($getPrice == '_') {
          $wherePrice  = "price LIKE '%%'";
       		$removePrice    = '';
       		$output['price_min']='';
       		$output['price_min']='';
      }else{
          $wherePrice     = 'price BETWEEN '.str_replace('_', ' AND ', $getPrice);
          $priceBilangan = explode('_', $getPrice);
          $priceBilangan_ = 'Rp. '.Rupiah::tanpa_nol_rp($priceBilangan[0]).' - Rp. '.Rupiah::tanpa_nol_rp($priceBilangan[1]);
          $minPrice = $priceBilangan[0];
          $maxPrice = $priceBilangan[1];
      		$removePrice    = '<a class="remove-filter" onClick="removeQString(\'price\',\''.$getPrice.'\')" >Harga: '.$priceBilangan_.' </a>';

       		$output['price_min']=$minPrice;
       		$output['price_min']=$maxPrice;
      }     

	}else{
	  $wherePrice     = "price LIKE '%%'"; 
	  $removePrice    = '';
	  $minPrice = '';
	  $maxPrice = '';

	$output['price_min']='';
	$output['price_min']='';
	}
	$output['sidebar_price'] = '
   			<input type="text" name="price-min" placeholder="Min" class="form-control valid-number" value="'.$minPrice.'" required>				   	
   			<input type="text" name="price-max" placeholder="Max" class="form-control valid-number" value="'.$maxPrice.'" required>
   			<button type="submit" class="btn-price"><i class="mdi mdi-chevron-right"></i></button>
	   	
	';


	$sidebar_category = '
				<label class="tblf control__custom control__radio">
			    <input type="radio" name="category" '.$checkedAllCat.' onClick="removeQString(\'category\', \''.$getCat.'\')"/>
			    <div class="control__indicator"></div>
			     <span>Semua Kategori</span>
				</label>';
	$popup_category = '
				<div class="box-radio-btn">
					<input id="cat-1" type="radio" name="category_popup" value="all" '.$checkedAllCat.'>
					<label for="cat-1">All</label>
				</div>';

	$information   = $database->select($fields="*", $table="information", $where_clause="WHERE status = '1' order by dateTime DESC ", $fetch='all');
	$noCat = 2;
	foreach ($information as $key => $valueInfo) {
		if ($valueInfo['seo'] == $getCat) {
			$checked = 'checked';
		}else{
			$checked = '';
		}
		$sidebar_category .= '
				<label class="tblf control__custom control__radio">
			    <input type="radio" name="category" '.$checked.' onClick="changeUrl(\'category\', \''.$valueInfo["seo"].'\')"/>
			    <div class="control__indicator"></div>
			     <span>'.$valueInfo["title"].'</span>
				</label>';
		// $popup_category .= '
		// 		<div class="box-radio-btn">
		// 			<input id="cat-'.$noCat.'" type="radio" name="category_popup" value="'.$valueInfo["seo"].'" '.$checked.'>
		// 			<label for="cat-'.$noCat.'">'.$valueInfo["title"].'</label>
		// 		</div>';
				$popup_category .= '
				<div class="box-radio-btn">
					<input id="cat-'.$noCat.'" type="radio" name="category_popup" value="'.$valueInfo["seo"].'" '.$checked.' onClick="changeUrl(\'category\', \''.$valueInfo["seo"].'\')">
					<label for="cat-'.$noCat.'">'.$valueInfo["title"].'</label>
				</div>';
		$noCat++;
	}
	$output['remove_filter_all'] = '
			<div class="mb-2">'.$removeCat.' '.$removePrice.' '.$removeKey.'</div>
	';

	$output['sidebar_category'] = $sidebar_category;
	
	$output['popup_filter'] = '
		<div class="fmct">
		  <div class="form-group">
		    <label >Kategori</label>
		   	<div class="box-radio">
		   		'.$popup_category.'
	    	</div>
		  </div>
		  <div class="form-group">
		    <label >Harga</label>
		   	<div class="row">
		   		<div class="col-md-6 col-6">
		   			<input type="text" name="price-min" placeholder="Min*" class="form-control valid-number" value="'.$minPrice.'" required>
		   		</div>
		   		<div class="col-md-6 col-6">
		   			<input type="text" name="price-max" placeholder="Max*" class="form-control valid-number" value="'.$maxPrice.'" required>
		   		</div>
		   	</div>
		  </div>		  
		</div>
	';
	

	$totalRow = $database->count_rows($table="sub_information", $where_clause="WHERE status = '1' AND $whereCat AND $wherePrice AND $whereKey");
	$total_pages = ceil($totalRow/$limit);
	$sub_information   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' AND $whereCat AND $wherePrice AND $whereKey $getSort LIMIT $offset, $limit", $fetch='all');

	$output['hidden_value'] = '
		<input type="hidden" name="total_pages" id="total_pages" value="' . $total_pages . '"><input type="hidden" name="page" id="page" value="' . $page . '">';
	$output['count_rows'] = $totalRow;

	if ($totalRow == 0) {
		$output['results'] = '
			<div class="col-sm-12">
				<div class="error-box">
					<div class="error-banner">
						<h1>!! <span>!!!</span> !!</h1>
						<p> Oops!! Data yang anda minta belum tersedia ..</p>
					</div>
				</div>
			</div>';
	}else{
	  foreach ($sub_information as $key => $value) {
	  	$cat = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $value[id_information]", $fetch='');			
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
				<div class="item col-xs-4 col-md-4 col-lg-4 '.$active_view.' '.$st.'">
	              	<a href="souvenir-'.$cat["seo"].'-'.$value["seo"].'-'.$value["id_subinformation"].'">
              		'.$label.'
                	<div class="thumbnail card">
	                    <div class="img-event">
	                      '.$img.'
	                    </div>
	                    <div class="caption card-body">
	                      <h5 class="title-text '.$title_nowrap.'">'.$value["title"].'</h5>
						    <div class="d-flex mb-1 mb-md-2">
							  	<ul class="text-nowrap list-border list-unstyled list-inline mb-0">
							       	<li class="list-inline-item"><b>'.$cat["title"].'</b></li>
							       	<li class="list-inline-item"><b>Kode : '.$value["kode"].'</b></li>
							    </ul>
						    </div>
						    <div class="d-flex align-items-center">
							    <h6 class="mb-0 title-nowrap flex-grow-1"><b>'.Rupiah::tanpa_nol($value["price"]).'</b> </h6>
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