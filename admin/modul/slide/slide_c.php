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

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="slide", $where_clause="WHERE id_slide = $_POST[id]", $fetch="");
				$output["title"] = $statement["title"];
				$output["link"] = $statement["link"];
				$output["status"] = $statement["status"];
				if($statement["image"] != '')
				{
					$output['fupload'] = '<img src="../joimg/slide/'.$statement["image"].'" class="img-thumbnail" width="100px" height="auto" /><input type="hidden" name="hidden_fupload" value="'.$statement["image"].'" />';
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
			$lokasi_file	= $_FILES['fupload']['tmp_name'];
			$tipe_file 		= $_FILES['fupload']['type'];
		  	$nama_file 		= $_FILES['fupload']['name'];

		  	$seo 		= substr(seo($_POST['title']), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik = $seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file)){
	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/slide/");

			    //data yang akan di insert berbentuk array
				$form_data = array(
				    "title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "link"	=> "$_POST[link]",
				    "image" 		=> "$nama_file_unik",
				    "status"		=> "$_POST[status]"
				);

				//proses insert ke database
	            $database->insert($table="slide", $array=$form_data);
			}
			else
			{
				//data yang akan di insert berbentuk array
				$form_data = array(
				  	"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "link"	=> "$_POST[link]",
				    "status"		=> "$_POST[status]"
				);

				//proses insert ke database
	            $database->insert($table="slide", $array=$form_data);
			}
		}

		if($_POST["operation"] == "Edit")
		{
			echo ini_set('upload_max_filesize', '10M'); 

		 	$lokasi_file    = $_FILES['fupload']['tmp_name'];
		  	$tipe_file      = $_FILES['fupload']['type'];
		  	$nama_file      = $_FILES['fupload']['name'];

			$seo		= substr(seo($_POST['title']), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik	= $seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file))
			{

	            $show   = $database->select($fields="image", $table="slide", $where_clause="WHERE id_slide = '$_POST[id]'", $fetch='');
				if($show['image'] != '')
				{
					unlink("../../../joimg/slide/$show[image]");
				}

	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/slide/");

	            //data yang akan diupdate berbentuk array
				$form_data = array(
					"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "link"	=> "$_POST[link]",
				    "image" 		=> "$nama_file_unik",
				    "status"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="slide", $array=$form_data, $fields_key="id_slide", $id="$_POST[id]");
			}
			else
			{
				//data yang akan diupdate berbentuk array
				$form_data = array(
					"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "link"	=> "$_POST[link]",
				    "status"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="slide", $array=$form_data, $fields_key="id_slide", $id="$_POST[id]");
			}
		}
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
			$show   = $database->select($fields="image", $table="slide", $where_clause="WHERE id_slide = '$_POST[id]'", $fetch='');
			if($show['image'] != '')
			{
				unlink("../../../joimg/slide/$show[image]");
	            $database->delete($table="slide", $fields_key="id_slide", $id="$_POST[id]");
			}
			else
			{
	            $database->delete($table="slide", $fields_key="id_slide", $id="$_POST[id]");
			}

		}
	}
}
?>