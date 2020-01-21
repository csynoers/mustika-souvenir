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
	include_once '../../../josys/class/Security.php';

	$security   = new Security();
	$database 	= new Database($db);
	$upload     = new Upload();

	if ($_POST['act']=='btn-add') {
		if(isset($_POST["act"])){
			$output = array();
			$level = $database->get_enum($table="users", $fields="level");
                foreach ($level as $key_kon => $value_l) {
                                
					$output['level'][] = '<option value="'.$value_l.'">'.$value_l.'</option>';
					         
				}

			echo json_encode($output);
		}
	}

	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="users", $where_clause="WHERE id_users = $_POST[id]", $fetch="");
				$output["fullname"] = $statement["fullname"];
				$output["username"] = $statement["username"];
				$output["email"] = $statement["email"];
				$output["phone"] = $statement["phone"];
				$output["password"] = $security->decrypt($statement["password"]);
				$output["status"] = $statement["blokir"];
				if($statement["image"] != '')
				{
					$output['fupload'] = '<img src="../joimg/users/'.$statement["image"].'" class="img-thumbnail" width="100px" height="auto" /><input type="hidden" name="hidden_fupload" value="'.$statement["image"].'" />';
				}
				else
				{
					$output['fupload'] = '<input type="hidden" name="hidden_fupload" value="" />';
				}
				
				$level = $database->get_enum($table="users", $fields="level");
                foreach ($level as $key_kon => $value_kon) {
                    if($value_kon == $statement['level']) {
                        $sc = 'selected="select"';
                    }else {
                        $sc = '';
                    }
                                
					$output['level'][] = '<option value="'.$value_kon.'" '.$sc.'">'.$value_kon.'</option>';
					         
				}
			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"]))
	{
		if($_POST["operation"] == "Add"){

		  	$result = $database->count_rows($table="users", $where_clause="WHERE username='$_POST[username]' AND email='$_POST[email]'");

		  	if ($result > 0) {
		  		echo "false";

		  	}else{
		  		$lokasi_file	= $_FILES['fupload']['tmp_name'];
				$tipe_file 		= $_FILES['fupload']['type'];
			  	$nama_file 		= $_FILES['fupload']['name'];

			  	$seo 		= substr(seo($_POST['fullname']), 0, 100);
			  	$acak           = rand(000,999);
			  	$nama_file_unik = $seo.'-'.$acak.'-'.$nama_file;
			  	$password   = $security->encrypt($security->anti_injection($_POST['password']));
		  		if(!empty($lokasi_file)){
	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/users/");

			    //data yang akan di insert berbentuk array
				$form_data = array(
				    "fullname" 		=> "$_POST[fullname]",
				    "username"		=> "$_POST[username]",
				    "password"		=> "$password",
				    "email" 		=> "$_POST[email]",
				    "level" 		=> "$_POST[level]",
				    "phone"			=> "$_POST[phone]",
				    "image" 		=> "$nama_file_unik",
				    "blokir"		=> "$_POST[status]"
				);

				//proses insert ke database
	            $database->insert($table="users", $array=$form_data);
				}
				else
				{
					//data yang akan di insert berbentuk array
					$form_data = array(
					  	"fullname" 		=> "$_POST[fullname]",
					    "username"	=> "$_POST[username]",
					    "password"		=> "$password",
					    "email" 		=> "$_POST[email]",
					    "phone"			=> "$_POST[phone]",
					    "level" 		=> "$_POST[level]",
					    "blokir"		=> "$_POST[status]"
					);

					//proses insert ke database
		            $database->insert($table="users", $array=$form_data);
				}
		  	}
			
		}

		if($_POST["operation"] == "Edit")
		{
			
			$result = $database->count_rows($table="users", $where_clause="WHERE username='$_POST[username]' AND email='$_POST[email]'");
			if ($result > 0) {
				$users = $database->select($fields="*", $table="users", $where_clause="WHERE id_users='$_POST[id]' ", $fetch="");
				$username = $users['username'];
				$email = $users['email'];
				echo 'false';
			}else{
				$username = $_POST['username'];
				$email 	= $_POST['email'];
				echo "true";
			}
		 	$lokasi_file    = $_FILES['fupload']['tmp_name'];
		  	$tipe_file      = $_FILES['fupload']['type'];
		  	$nama_file      = $_FILES['fupload']['name'];

			$seo		= substr(seo($_POST['fullname']), 0, 100);
		  	$acak           = rand(000,999);
		  	$nama_file_unik	= $seo.'-'.$acak.'-'.$nama_file;
		  	$password   = $security->encrypt($security->anti_injection($_POST['password']));

			if(!empty($lokasi_file))
			{

	            $show   = $database->select($fields="image", $table="users", $where_clause="WHERE id_users = '$_POST[id]'", $fetch='');
				if($show['image'] != '')
				{
					unlink("../../../joimg/users/$show[image]");
				}

	            $upload->berkas($fileName=$nama_file_unik, $fileDirectory="../../../joimg/users/");

	            //data yang akan diupdate berbentuk array
				$form_data = array(
					"fullname" 		=> "$_POST[fullname]",
				    "username"		=> "$username",
				    "password"		=> "$password",
				    "email" 		=> "$email",
				    "phone"			=> "$_POST[phone]",
				    "level" 		=> "$_POST[level]",
				    "image" 		=> "$nama_file_unik",
				    "blokir"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="users", $array=$form_data, $fields_key="id_users", $id="$_POST[id]");
			}
			else
			{
				//data yang akan diupdate berbentuk array
				$form_data = array(
					"fullname" 		=> "$_POST[fullname]",
				    "username"		=> "$username",
				    "password"		=> "$password",
				    "email" 		=> "$email",
				    "phone"			=> "$_POST[phone]",
				    "level" 		=> "$_POST[level]",
				    "blokir"		=> "$_POST[status]"
				);

				//proses update ke database
	            $database->update($table="users", $array=$form_data, $fields_key="id_users", $id="$_POST[id]");
			}
		}
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
			$show   = $database->select($fields="image", $table="users", $where_clause="WHERE id_users = '$_POST[id]'", $fetch='');
			if($show['image'] != '')
			{
				unlink("../../../joimg/users/$show[image]");
	            $database->delete($table="users", $fields_key="id_users", $id="$_POST[id]");
			}
			else
			{
	            $database->delete($table="users", $fields_key="id_users", $id="$_POST[id]");
			}

		}
	}
}
?>