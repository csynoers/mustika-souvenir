<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}else{
	require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';
	include_once '../../../josys/function/Seo.php';
	include_once '../../../josys/class/Upload.php';
	include_once 'youtube.php';
	
	$database 	= new Database($db);
	$upload     = new Upload();
	
	if ($_POST['act']=='btn-add') {
		if(isset($_POST["act"])){
			$output = array();
            $category = $database->get_enum($table="gallery", $fields="category");
            foreach ($category as $key => $val) {
				$output['category'][] = '<option value="'.$val.'">'.$val.'</option>';           
			}
			echo json_encode($output);
		}
	}

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="gallery", $where_clause="WHERE id_gallery = $_POST[id]", $fetch="");
				$output["title"] = $statement["title"];
				$output["status"] = $statement["status"];

			if ($statement['category'] == 'video') {
		        $output['image_gallery'] = '
		        	<div class="col-md-8">
		        		<div class="form-group">
			        		<label for="title">link *</label>
			        		<textarea name="link" id="link" class="form-control" placeholder="Enter link">'.$statement["link"].'</textarea>
		        		</div>
		        	</div>
		        	<div class="col-4">'.youtube($statement["link"]).'</div>';
		      
		      }else{
		        $output['image_gallery'] = '
		        	<div class="col-sm-6">
				        <label>Select Image</label>
				        <input type="file" name="fupload" id="fupload" />
				        <span class="msg_images"></span>
		        	</div>
			        <div class="col-sm-6">
			        	<img src="../joimg/gallery/'.$statement["image"].'" class="img-thumbnail" width="100px" height="auto" />
			        </div>';
		      }

			$category = $database->get_enum($table="gallery", $fields="category");
				foreach ($category as $key => $val_cat) {
					if($val_cat == $statement['category']){
						$sc = 'selected="select"';
						$output['select'] = $sc;
					}else{
						$sc = '';
						$output['select'] = $sc;
					}
					$output['category'][] = '<option value="'.$val_cat.'" '.$sc.'">'.$val_cat.'</option>';
					         
				}
			
			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "Add"){
			
			if (empty($_POST['title'])) {
				$seo = 'batuartspace_bali';
			}else{
				$seo 		= substr(seo($_POST['title']), 0, 100);
			}
				if ($_POST["category"] == 'image') {
					 $path = "../../../joimg/gallery/";
			  		foreach ($_FILES['fupload']['name'] as $f => $name) {
			  			$lokasi_file	= $_FILES['fupload']['tmp_name'][$f];
							$tipe_file 		= $_FILES['fupload']['type'][$f];
						 	$nama_file 		= $_FILES['fupload']['name'][$f];

					  	$acak           = rand(000,999);
					  	$nama_file_unik = $seo.'-'.$acak.'-'.$nama_file;


             	if (move_uploaded_file($_FILES['fupload']['tmp_name'][$f], $path.$nama_file_unik)) { 
		           	 
		           		$upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/gallery/", $thumbDirectory="../../../joimg/gallery/thumbnail/", $thumbWidth="350");
		         
		            //insert banyak gambar ke database produkgambar
									$form_data = array(
										    "title" 			=> "$_POST[title]",
										    "category" 		=> "$_POST[category]",
										    "seo" 				=> "$seo",
										    "image" 			=> "$nama_file_unik",
										    "status"			=> "$_POST[status]"
										);

				            $database->insert($table="gallery", $array=$form_data);
				        
				       }
		      	}
		    
		      

		    }else{
	    		$form_data = array(
				  	"title" 		=> "$_POST[title]",
				  	"category" 	=> "$_POST[category]",
				    "seo" 			=> "$seo",
				    "link"			=> "$_POST[link]",
				    "status"		=> "$_POST[status]"
				);

				//proses insert ke database
	         $database->insert($table="gallery", $array=$form_data);
		    }
		}

		if($_POST["operation"] == "Edit")
		{
			if (empty($_POST['title'])) {
				$seo = 'batuartspace_bali';
			}else{
				$seo 		= substr(seo($_POST['title']), 0, 100);
			}
			if ($_POST["category"] == 'image' AND !empty($_FILES['fupload']['tmp_name'])) {
		 	
				$lokasi_file	= $_FILES['fupload']['tmp_name'];
				$tipe_file 		= $_FILES['fupload']['type'];
			  $nama_file 		= $_FILES['fupload']['name'];

			  	$acak           = rand(000,999);
			  	$nama_file_unik = $seo.'-'.$acak.'-'.$nama_file;
			
					$show   = $database->select($fields="image", $table="gallery", $where_clause="WHERE id_gallery = '$_POST[id]'", $fetch='');
					if($show['image'] != '')
					{
						unlink("../../../joimg/gallery/$show[image]");
						unlink("../../../joimg/gallery/thumbnail/$show[image]");
					}
            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/gallery/");
        
            //Proses Resize / thumbnail Image
          	$upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/gallery/", $thumbDirectory="../../../joimg/gallery/thumbnail/", $thumbWidth="350");

				    //data yang akan di insert berbentuk array
					$form_data = array(
					    "title" 			=> "$_POST[title]",
					    "category" 			=> "$_POST[category]",
					    "seo" 				=> "$seo",
					    "image" 			=> "$nama_file_unik",
					    "status"			=> "$_POST[status]"
					);

					//proses insert ke database
		        $database->update($table="gallery", $array=$form_data, $fields_key="id_gallery", $id="$_POST[id]");

		    }else{
	    	//data yang akan di insert berbentuk array
				$form_data = array(
				  	"title" 		=> "$_POST[title]",
				  	"category" 		=> "$_POST[category]",
				    "seo" 			=> "$seo",
				    "link"			=> "$_POST[link]",
				    "status"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="gallery", $array=$form_data, $fields_key="id_gallery", $id="$_POST[id]");
		    }
		}
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{

	        $show   = $database->select($fields="image", $table="gallery", $where_clause="WHERE id_gallery = '$_POST[id]'", $fetch='');
				
			if($show['image'] != ''){
				unlink("../../../joimg/gallery/$show[image]");
				unlink("../../../joimg/gallery/thumbnail/$show[image]");
	            $database->delete($table="gallery", $fields_key="id_gallery", $id="$_POST[id]");
			}else{
	            $database->delete($table="gallery", $fields_key="id_gallery", $id="$_POST[id]");
			}

		}
	}
}
?>