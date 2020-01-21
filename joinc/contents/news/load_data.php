<?php
	error_reporting(0);
	require_once '../../../josys/db_connect.php';
  include_once '../../../josys/class/Database.php';
  include_once "../../../josys/class/Tanggal.php";

	$tanggal   = new Tanggal();
  $database 	= new Database($db);
 
	$limit = $_POST['limit_news'];
	if(isset($_POST['page']) && $_POST['page'] != "") {
		$page = $_POST['page'];
		$offset = $limit * ($page-1);
	} else {
		$page = 1;
		$offset = 0;
	}
	$output = array();
	$totalRow = $database->count_rows($table="articles", $where_clause="WHERE status = '1'");
	$total_pages = ceil($totalRow/$limit);
	$articles   = $database->select($fields="*", $table="articles", $where_clause="WHERE status = '1' order by dateTime DESC LIMIT $offset, $limit", $fetch='all');
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
	  foreach ($articles as $key => $value) { 
	  	$description = strip_tags(substr($value["description"],0,250));
			$output['results'][] = '
				<div class="item list-group-item news-item">
        	
          	<div class="thumbnail card">
              <div class="img-event">
              <a href="berita-'.$value["seo"].'-'.$value["id_articles"].'">
                <img src="joimg/articles/thumbnail/'.$value["image"].'" alt="'.$value["title"].'" class="img-fluid">
                </a>
              </div>
              <div class="caption card-body">
                <h6 class="mb-1"><a href="berita-'.$value["seo"].'-'.$value["id_articles"].'">'.$value["title"].'</a></h6>
						    <small><i class="mdi mdi-calendar-text"></i> '.$tanggal->indo($value["dateTime"]).'</small>
						    <p class="mb-0 mt-2 d-none d-md-block">'.$description.'.. [selengkapnya]</p>
              </div>
          	</div>
        </div>
			';
		}
	}

	echo json_encode($output);
  		
  	
?>
