<?php
	error_reporting(0);
	require_once '../../../josys/db_connect.php';
  include_once '../../../josys/class/Database.php';

  $database 	= new Database($db);
 
	$limit = $_POST['limit_gallery'];
	if(isset($_POST['page']) && $_POST['page'] != "") {
		$page = $_POST['page'];
		$offset = $limit * ($page-1);
	} else {
		$page = 1;
		$offset = 0;
	}
	$output = array();
	$totalRow = $database->count_rows($table="gallery", $where_clause="WHERE status = '1'");
	$total_pages = ceil($totalRow/$limit);
	$gallery   = $database->select($fields="*", $table="gallery", $where_clause="WHERE status = '1' order by dateTime DESC LIMIT $offset, $limit", $fetch='all');
	$output['hidden_value'] = '
		<input type="hidden" name="total_pages" id="total_pages" value="' . $total_pages . '"><input type="hidden" name="page" id="page" value="' . $page . '">';
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
		$noImg = 'hqdefault';
	  foreach ($gallery as $key => $value) { 
	  	if($value["category"] == 'image'){
          $ahref = '<a href="joimg/gallery/'.$value["image"].'" title="'.$value["title"].'" class="info lightbox-img"><i class="mdi mdi-arrow-expand-all"></i></a>';
          $img  = 'joimg/gallery/thumbnail/'.$value["image"];

      }else{
          $url = $value['link']; 
          $parts = explode('=',$url);
          $last = end($parts);
          $ahref = '<a href="'.$url.'" class="lightbox-video info" title="'.$value["title"].'"><i class="mdi mdi-youtube-play"></i></a>';
          $img = 'http://img.youtube.com/vi/'.$last.'/'.$noImg.'.jpg';
      }
			$output['results'][] = '
			
				<div class="item col-gallery col-6 col-xs-4 col-md-3 col-lg-3 grid-group-item gallery-item zoom-image">
        	
          	<div class="thumbnail card hovereffect">
              <div class="img-event">
                <img src="'.$img.'" alt="'.$value["title"].'" class="img-fluid">
              </div>
              <div class="overlay">
			          '.$ahref.'
			        </div>
          	</div>
          	
        </div>
			';
		}
	}

	echo json_encode($output);
  		
  	
?>
