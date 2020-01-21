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

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="city", $where_clause="WHERE city_id ='$_POST[id]'", $fetch="");
				$output["city_name"] = $statement["city_name"];
				$output["status"] = $statement["status"];
			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "Add"){
			
		  $seo 		= substr(seo($_POST['city_name']), 0, 100);
				//data yang akan di insert berbentuk array
			$form_data = array(
					
			  	"city_name" 	=> "$_POST[city_name]",
			    "seo" 			=> "$seo",
			    "status"		=> "$_POST[status]"
			);

			//proses insert ke database
      $database->insert($table="city", $array=$form_data);
		}

		if($_POST["operation"] == "Edit")
		{

			$seo		= substr(seo($_POST['city_name']), 0, 100);
			//data yang akan diupdate berbentuk array
			$form_data = array(
				
				"city_name" 		=> "$_POST[city_name]",
			    "seo" 			=> "$seo",
			    "status"		=> "$_POST[status]"
			);

			//proses update ke database
            $database->update($table="city", $array=$form_data, $fields_key="city_id", $id="$_POST[id]");
		}
	}
		

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{

		    $database->delete($table="city", $fields_key="city_id", $id="$_POST[id]");
	
			echo 'Sukses! city Berhasil dihapus.';

			
		}
	}

}

?>