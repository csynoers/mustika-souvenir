<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}else{
	require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';
	include_once '../../../josys/class/Upload.php';
	include_once '../../../josys/function/Seo.php';

	$database 	= new Database($db);
	$upload     = new Upload();


	if ($_POST['act']=='change-status') {
		if(isset($_POST["id"])){
				$form_data = array(
					"status" 		=> "$_POST[value]"
				);
	        $database->update($table="sub_information", $array=$form_data, $fields_key="id_subinformation", $id="$_POST[id]");
	        echo "Status iklan berhasil diubah !!";
		}
	}

	if ($_POST['act']=='change-premium') {
		if(isset($_POST["id"])){
			$form_data = array(
				"premium" 		=> "$_POST[value]"
			);

	        $database->update($table="sub_information", $array=$form_data, $fields_key="id_subinformation", $id="$_POST[id]");
	        echo "Status premium berhasil diubah !!";
		}
	}

	if ($_POST['act']=='btn-add') {
		$output = array();
		$city = $database->select($fields="*", $table="city", $where_clause="where status = '1' order by city_name asc", $fetch="all");
			foreach ($city as $key => $value) {
				$output['city'][] = '<option value="'.$value["city_id"].'">'.$value["city_name"].'</option>';
			}

		$sertification = $database->get_enum($table="sub_information", $fields="sertification");
		  foreach ($sertification as $key => $value) {
	      	$output['sertification'][] = '<option value="'.$value.'">'.$value.'</option>';
	      }
    
	    $direction = $database->get_enum($table="sub_information", $fields="direction");
		  foreach ($direction as $key => $value) {
	      	$output['direction'][] = '<option value="'.$value.'">'.$value.'</option>';
	      }
		echo json_encode($output);
	}

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="sub_information", $where_clause="WHERE id_subinformation = '$_POST[id]'", $fetch="");
				$output["title"] = $statement["title"];
				$output["price"] = $statement["price"];
				$output["description"] = $statement["description"];
				$output["kode"] = $statement["kode"];
				$output["status"] = $statement["status"];
				$output["premium"] = $statement["premium"];
				if($statement["image"] != '')
				{
					$output['fupload'] = '<img src="../joimg/information/'.$statement["image"].'" class="img-thumbnail" width="100px" height="auto" /><input type="hidden" name="hidden_fupload" value="'.$statement["image"].'" />';
				}
				else
				{
					$output['fupload'] = '<input type="hidden" name="hidden_fupload" value="" />';
				}

			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "Add"){
			function randomID($length = 7) {
			    $characters = '0123456789';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < $length; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    return $randomString;
			}

			$id_reg = randomID();
			$cek = $database->count_rows($table="sub_information", $where_clause="WHERE id_subinformation = '$id_reg'");
	        if ($cek > 0) {
	        	return $randomString;

	        }else{
				$lokasi_file	= $_FILES['fupload']['tmp_name'];
				$tipe_file 		= $_FILES['fupload']['type'];
				$nama_file 		= $_FILES['fupload']['name'];
				$filetypeImage 			= pathinfo(strtolower($nama_file), PATHINFO_EXTENSION);
			  	$seo 		= substr(seo($_POST[title]), 0, 75);
			  	$acak           = rand(000,999);
			  	$nama_file_unik = $seo.'-'.$acak.'.'.$filetypeImage;

				if(!empty($lokasi_file)){
			        $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/information/");
			        $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/information/", $thumbDirectory="../../../joimg/information/thumbnail/", $thumbWidth="350");
					    //data yang akan di insert berbentuk array
						$form_data = array(
							"id_subinformation" => "$id_reg",
							"id_information" 		=> "$_POST[id_information]",
							
							"title" 						=> "$_POST[title]",
							"kode" 					=>"$_POST[kode]",
							"price" 						=> "$_POST[price]",
							"seo" 							=> "$seo",
							"description"				=> "$_POST[description]",
							"premium" 			  	=> "$_POST[premium]",
							
							"status"						=> "$_POST[status]",
							"image" 						=> "$nama_file_unik"
						);

						//proses insert ke database
			    	$database->insert($table="sub_information", $array=$form_data);
			    	//print_r($form_data);
				}
				else
				{
					//data yang akan di insert berbentuk array
					$form_data = array(
						"id_subinformation" => "$id_reg",
						"id_information" 		=> "$_POST[id_information]",
						
						"title" 						=> "$_POST[title]",
						"kode" 					=>"$_POST[kode]",
						"price" 						=> "$_POST[price]",
						"seo" 							=> "$seo",
						"description"				=> "$_POST[description]",

						"premium" 			  	=> "$_POST[premium]",
						"status"						=> "$_POST[status]"
					);

					//proses insert ke database
					$database->insert($table="sub_information", $array=$form_data);
			    	//print_r($form_data);
					
				}
			}
		}

		if($_POST["operation"] == "Edit")
		{
			function randomID($length = 7) {
			    $characters = '0123456789';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < $length; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    return $randomString;
			}

			$id_reg = randomID();
			$cek = $database->count_rows($table="sub_information", $where_clause="WHERE id_subinformation = '$id_reg'");
	        if ($cek > 0) {
	          return $randomString;

	        }else{

				$lokasi_file    = $_FILES['fupload']['tmp_name'];
			  	$tipe_file      = $_FILES['fupload']['type'];
			  	$nama_file      = $_FILES['fupload']['name'];
			  	$filetypeImage 			= pathinfo(strtolower($nama_file), PATHINFO_EXTENSION);
				$seo		= substr(seo($_POST[title]), 0, 75);
			  	$acak           = rand(000,999);
			  	$nama_file_unik	= $seo.'-'.$acak.'.'.$filetypeImage;

				if(!empty($lokasi_file)){

			    	$show   = $database->select($fields="image", $table="sub_information", $where_clause="WHERE id_subinformation = '$_POST[id]'", $fetch='');
						if($show['image'] != '')
						{
							unlink("../../../joimg/information/$show[image]");
							unlink("../../../joimg/information/thumbnail/$show[image]");
						}

				    	$upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/information/");
				    	$upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/information/", $thumbDirectory="../../../joimg/information/thumbnail/", $thumbWidth="350");

			            //data yang akan diupdate berbentuk array
						$form_data = array(
							"id_information" 		=> "$_POST[id_information]",
							
							"title" 						=> "$_POST[title]",
							"kode" 					=>"$_POST[kode]",
							"price" 						=> "$_POST[price]",
							"seo" 							=> "$seo",
							"description"				=> "$_POST[description]",

							"premium" 			  	=> "$_POST[premium]",
							"status"						=> "$_POST[status]",
							"image" 						=> "$nama_file_unik"
						);

						//proses update ke database
			    	$database->update($table="sub_information", $array=$form_data, $fields_key="id_subinformation", $id="$_POST[id]");
						//print_r($form_data);
				}
				else
				{
					//data yang akan diupdate berbentuk array
					$form_data = array(
						"id_information" 		=> "$_POST[id_information]",
						
						"title" 						=> "$_POST[title]",
						"kode" 					=>"$_POST[kode]",
						"price" 						=> "$_POST[price]",
						"seo" 							=> "$seo",
						"description"				=> "$_POST[description]",

						"premium" 			  	=> "$_POST[premium]",
						"status"						=> "$_POST[status]"
					);

					//proses update ke database
			    	$database->update($table="sub_information", $array=$form_data, $fields_key="id_subinformation", $id="$_POST[id]");
			    	//print_r($form_data);
				}
			}
		}	
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
			$show_img   = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = '$_POST[id]'", $fetch="all");
	        if((!empty($show_img)) || ($show_img != '0')) {
				foreach ($show_img as $key_si => $value_si) {
					unlink("../../../joimg/information/$value_si[image]");
					unlink("../../../joimg/information/thumbnail/$value_si[image]");
					$database->delete($table="image_info", $fields_key="id_imageinfo", $id=$value_si['id_imageinfo']);
				}
			}

			$show   = $database->select($fields="image", $table="sub_information", $where_clause="WHERE id_subinformation = '$_POST[id]'", $fetch='');
			if($show['image'] != '')
			{
				unlink("../../../joimg/information/$show[image]");
				unlink("../../../joimg/information/thumbnail/$show[image]");
				$database->delete($table="sub_information", $fields_key="id_subinformation", $id="$_POST[id]");
			}
			else
			{
				$database->delete($table="sub_information", $fields_key="id_subinformation", $id="$_POST[id]");
			}

		}
	}

	if ($_POST['act']=='load-data-info-image'){
		$output = array();
		$statement = $database->select($fields="*", $table="sub_information", $where_clause="WHERE id_subinformation = $_POST[id]", $fetch="");
		$output["title"] = $statement['title'];
		$imgGal = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = $_POST[id]", $fetch="all");
		if (empty($imgGal) || $imgGal == 0) {
			$output["image"] = '';
		}else{
			foreach ($imgGal as $key => $value) {
				$output["image"][] = "
				<div class='col-md-2 mb-1'>
					<button type='button' class='remove-image-gallery' data-id='".$value['id_imageinfo']."'> <i class='fa fa-times'></i></button>
					<img class='img-thumbnail img-gallery' src='../joimg/information/thumbnail/".$value['image']."'></div>";
			}
		}
		echo json_encode($output);
	}

	if ($_POST['act']=='insert-imageinfo'){
		$lastInsertIdPosts = $_POST['id_subinformation'];
		$path = "../../../joimg/information/";
		$seo  = substr(seo($_POST['title_imageinfo']), 0, 75);
    	foreach ($_FILES['fupload_info']['name'] as $f => $name) {
			 	$nama_file 			= $_FILES['fupload_info']['name'][$f];
			 	$filetypeImage 	= pathinfo(strtolower($nama_file), PATHINFO_EXTENSION);
			  	$acak           = rand(000,999);
			  	$nama_file_unik = $seo.'-'.$acak.'.'.$filetypeImage;
         	if (move_uploaded_file($_FILES['fupload_info']['tmp_name'][$f], $path.$nama_file_unik)) { 
           	 
	           	$upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/information/", $thumbDirectory="../../../joimg/information/thumbnail/", $thumbWidth="350");
	         
	            //insert banyak gambar ke database produkgambar
							$form_dataImg = array(
							    "id_subinformation" 	=> "$lastInsertIdPosts",
							    "image" 			=> "$nama_file_unik"
								);

		          $database->insert($table="image_info", $array=$form_dataImg);
	        
		    }
      	}
	      	
	  	$imgGal = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = $lastInsertIdPosts", $fetch="all");
				foreach ($imgGal as $key => $value) {
					echo "
					<div class='col-md-2 mb-1'>
						<button type='button' class='remove-image-gallery' data-id='".$value['id_imageinfo']."'> <i class='fa fa-times'></i></button>
					<img class='img-thumbnail img-gallery' src='../joimg/information/thumbnail/".$value['image']."'></div>";
				}

	}

	if ($_POST['act']=='btn-delete-image') {
		if(isset($_POST["id"]))
		{

	    $show   = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_imageinfo = '$_POST[id]'", $fetch='');
				unlink("../../../joimg/information/$show[image]");
				unlink("../../../joimg/information/thumbnail/$show[image]");
	      $database->delete($table="image_info", $fields_key="id_imageinfo", $id="$_POST[id]");

     	$imgGal = $database->select($fields="*", $table="image_info", $where_clause="WHERE id_subinformation = '$show[id_subinformation]'", $fetch="all");
				foreach ($imgGal as $key => $value) {
					echo "
					<div class='col-md-2 mb-1'>
						<button type='button' class='remove-image-gallery' data-id='".$value['id_imageinfo']."'> <i class='fa fa-times'></i></button>
					<img class='img-thumbnail img-gallery' src='../joimg/information/thumbnail/".$value['image']."'></div>";
				}
		}
	}

}
?>