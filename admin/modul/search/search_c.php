<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}else{
	require_once '../../../josys/db_connect.php';
	include_once '../../../josys/class/Database.php';

	$database 	= new Database($db);
	
	$sid  = session_id();
	if ($_POST['act']=='btn-edit') {
		if(isset($_POST["id"])){
			$output = array();
			$statement = $database->select($fields="*", $table="messages_search", $where_clause="WHERE id_messages = $_POST[id]", $fetch="");
				if ($statement["status"] == '0') {
					$status = 'Wait ..';
				}else{
					$status = 'Read ..';
				}
				$output["nama"] = $statement["fullname"];
				$output["email"] = $statement["email"];
				$output["phone"] = $statement["phone"];
				$output["description"] = $statement["description"];
				$output["status"] = $status;
				$output["facilities"] = $statement["facilities"];

				$info = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $statement[id_information]", $fetch="");
					$output["information"] = $info["title"];

				$city = $database->select($fields="*", $table="city", $where_clause="WHERE city_id = $statement[city_id]", $fetch="");
					$output["city"] = $city["city_name"];

			echo json_encode($output);
		}
	}


	if(isset($_POST["operation"])){
		if($_POST["operation"] == "Reply"){

			// $email = $database->select($fields="email", $table="users", $where_clause="WHERE id_session = '$sid'", $fecth="");
			$subject = $_POST['subject'];
			$header .= "Content-Type: text/html; charset=iso-8859-1\r\n"; 
			$header .= "Reply-To: New User <info@mustikasouvenir.com>\r\n"; 
			$header .= "Return-Path: Admin mustikasouvenir.com \r\n"; 
			$header .= "From: mustikasouvenir.com \r\n";
			$messages = "
					<div class='contents-mail' style='width:500px; margin: auto;border:1px solid #eee;'>
						<div class='panel-body' style='margin: 10px;'>
							<div class='logo' style='width: 30%;float: left;'>
								<img width='130' src='http://mustikasouvenir.com/assets/images/logo_sm.png' style='margin-right: 5px;'/>
							</div>
							<div class='contact' style='text-align: right;'>
								Email : info@mustikasouvenir.com <br>
								WA   : +6281232524676
							</div>
								".$_POST['messages']."
							</div>
						</div>
					</div>";
			mail($_POST['email'],$subject,$messages,$header);

			//data yang akan diupdate berbentuk array
			$form_data = array(
			    "status"		=> "1"
			);

			//proses update ke database
	        $database->update($table="messages_search", $array=$form_data, $fields_key="id_messages", $id="$_POST[id]");
		}
	}

	if ($_POST['act']=='btn-delete') {
		if(isset($_POST["id"]))
		{
	        $database->delete($table="messages_search", $fields_key="id_messages", $id="$_POST[id]");

		}
	}
}
?>