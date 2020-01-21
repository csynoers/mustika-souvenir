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

	if(isset($_POST["act"])){
		if($_POST["act"] == "Edit")
		{
		 	$lokasi_file    = $_FILES['fupload']['tmp_name'];
		  	$tipe_file      = $_FILES['fupload']['type'];
		  	$nama_file      = $_FILES['fupload']['name'];

			$seo		= substr(seo('logo'), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik	= $seo.'-'.$acak.'-'.$nama_file;

			if(!empty($lokasi_file))
			{

	            $show   = $database->select($fields="image", $table="modul", $where_clause="WHERE id_modul = '$_POST[id]'", $fetch='');
				if($show['image'] != '')
				{
					unlink("../../../joimg/modul/$show[image]");
				}

	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/modul/");

	            //data yang akan diupdate berbentuk array
				$form_data = array(
					"link" => "$_POST[title]",
					"static_content" => "$_POST[description]",
				    "image" 		=> "$nama_file_unik"
				);

				//proses update ke database
	            $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id="$_POST[id]");
			}
			else
			{
				//data yang akan diupdate berbentuk array
				$form_data = array(
					"link" => "$_POST[title]",
					"static_content" => "$_POST[description]"
					
				);

				//proses update ke database
	            $database->update($table="modul", $array=$form_data, $fields_key="id_modul", $id="$_POST[id]");

			}

		}
	}
}

?>