<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}else{
	require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';
	include_once '../../../josys/function/Seo.php';

	$database 	= new Database($db);

	if ($_POST['act']=='btn-add') {
		$output = array();
		
		$category = $database->get_enum($table="information", $fields="category");
		  foreach ($category as $key => $value) {
      	$output['category'][] = '<option value="'.$value.'">'.$value.'</option>';
      }

		echo json_encode($output);
	}

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="information", $where_clause="WHERE id_information ='$_POST[id]'", $fetch="");
				$output["title"] = $statement["title"];
				$output["status"] = $statement["status"];
			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "Add"){
			
		  	$seo 		= substr(seo($_POST['title']), 0, 100);
				//data yang akan di insert berbentuk array
			$form_data = array(
			  	"title" 		=> "$_POST[title]",
			    "seo" 			=> "$seo",
			    "status"		=> "$_POST[status]"
			);

			//proses insert ke database
            $database->insert($table="information", $array=$form_data);
		}

		if($_POST["operation"] == "Edit")
		{

			$seo		= substr(seo($_POST['title']), 0, 100);
			//data yang akan diupdate berbentuk array
			$form_data = array(
				"title" 		=> "$_POST[title]",
			    "seo" 			=> "$seo",
			    "status"		=> "$_POST[status]"
			);

			//proses update ke database
            $database->update($table="information", $array=$form_data, $fields_key="id_information", $id="$_POST[id]");
		}
	}
		

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
			$check = $database->count_rows($table="sub_information", $where_clause="WHERE id_information = '$_POST[id]'");
	        if(empty($check) || $check == '0') {
	        
		        $database->delete($table="information", $fields_key="id_information", $id="$_POST[id]");
	
				echo 'Sukses! information Berhasil dihapus.';
	        }else{

	            echo 'Maaf! Data Gagal Dihapus, information sedang digunakan silahkan cek kembali.';
	        }
	      	

			
		}
	}

}

?>