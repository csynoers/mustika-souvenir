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
			$statement = $database->select($fields="*", $table="articles", $where_clause="WHERE id_articles = $_POST[id]", $fetch="");
				$output["title"] = $statement["title"];
				$output["description"] = $statement["description"];
				$output["status"] = $statement["status"];
				if($statement["image"] != '')
				{
					$output['fupload'] = '<img src="../joimg/articles/'.$statement["image"].'" class="img-thumbnail" width="100px" height="auto" /><input type="hidden" name="hidden_fupload" value="'.$statement["image"].'" />';
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

		  	$seo 		= substr(seo($_POST[title]), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik = $seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file)){
	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/articles/");
	            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/articles/", $thumbDirectory="../../../joimg/articles/thumbnail/", $thumbWidth="350");
			    //data yang akan di insert berbentuk array
				$form_data = array(
				    "title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "description"	=> "$_POST[description]",
				    "image" 		=> "$nama_file_unik",
				    "status"		=> "$_POST[status]"
				);

				//proses insert ke database
	            $database->insert($table="articles", $array=$form_data);
			}
			else
			{
				//data yang akan di insert berbentuk array
				$form_data = array(
				  	"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "description"	=> "$_POST[description]",
				    "status"		=> "$_POST[status]"
				);

				//proses insert ke database
	            $database->insert($table="articles", $array=$form_data);
			}
		}

		if($_POST["operation"] == "Edit")
		{
		 	$lokasi_file    = $_FILES['fupload']['tmp_name'];
		  	$tipe_file      = $_FILES['fupload']['type'];
		  	$nama_file      = $_FILES['fupload']['name'];

			$seo		= substr(seo($_POST[title]), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik	= $seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file))
			{

	            $show   = $database->select($fields="image", $table="articles", $where_clause="WHERE id_articles = '$_POST[id]'", $fetch='');
				if($show['image'] != '')
				{
					unlink("../../../joimg/articles/$show[image]");
					unlink("../../../joimg/articles/thumbnail/$show[image]");
				}

	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/articles/");
	            $upload->thumbnail($imageName=$nama_file_unik, $imageDirectory="../../../joimg/articles/", $thumbDirectory="../../../joimg/articles/thumbnail/", $thumbWidth="350");
	            //data yang akan diupdate berbentuk array
				$form_data = array(
					"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "description"	=> "$_POST[description]",
				    "image" 		=> "$nama_file_unik",
				    "status"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="articles", $array=$form_data, $fields_key="id_articles", $id="$_POST[id]");
			}
			else
			{
				//data yang akan diupdate berbentuk array
				$form_data = array(
					"title" 		=> "$_POST[title]",
				    "seo" 			=> "$seo",
				    "description"	=> "$_POST[description]",
				    "status"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="articles", $array=$form_data, $fields_key="id_articles", $id="$_POST[id]");
			}
		}
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
			$show   = $database->select($fields="image", $table="articles", $where_clause="WHERE id_articles = '$_POST[id]'", $fetch='');
			if($show['image'] != '')
			{
				unlink("../../../joimg/articles/$show[image]");
				unlink("../../../joimg/articles/thumbnail/$show[image]");
	            $database->delete($table="articles", $fields_key="id_articles", $id="$_POST[id]");
			}
			else
			{
	            $database->delete($table="articles", $fields_key="id_articles", $id="$_POST[id]");
			}

		}
	}
}
?>