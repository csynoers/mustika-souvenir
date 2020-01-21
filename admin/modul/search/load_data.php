<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
$database 	= new Database($db);
$totalRow = $database->count_rows($table="messages_search", $where_clause="");

$query = '';
$output = array();
$query .= "SELECT * FROM messages_search ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE fullname LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR description LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_messages DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

$no = 1;
foreach($result as $row)
{
	if ($row["status"] == '0') {
		$status = 'Wait ..';
	}else{
		$status = 'Read ..';
	}

	$info = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $row[id_information]", $fetch="");
	$city = $database->select($fields="*", $table="city", $where_clause="WHERE city_id = $row[city_id]", $fetch="");

	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $row["fullname"];
	$sub_array[] = '<strong>'.$info["title"].'</strong> <i class="fa fa-angle-double-right"></i> <strong>'.$city["city_name"].'</strong>';
	$sub_array[] = $row["email"];
	$sub_array[] = $row["phone"];
	$sub_array[] = $row["dateTime"];
	$sub_array[] = $status;
	$sub_array[] = '
		<button type="button" name="update" data-status="'.$row["status"].'" id="'.$row["id_messages"].'" class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Detail</button>
		<button type="button" name="delete" id="'.$row["id_messages"].'" class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
	$no++;
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$totalRow,
	"data"				=>	$data
);
echo json_encode($output);
?>