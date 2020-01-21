<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
include_once '../../../josys/class/Security.php';

$security   = new Security();
$database 	= new Database($db);
$totalRow = $database->count_rows($table="users", $where_clause="WHERE id_users != '1'");

$query = '';
$output = array();
$query .= "SELECT * FROM users ";
$query .= "WHERE id_users != '1' " ;
if(isset($_POST["search"]["value"]))
{
	$query .= 'AND fullname LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_users DESC ';
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
	$image = '';
	if($row["image"] != ''){
		$image = '<img src="../joimg/users/'.$row["image"].'" class="img-thumbnail" width="70" height="auto" />';
	}else{
		$image = '';
	}

	if ($row["blokir"] == 'Y') {
		$status = 'Blokir';
	}else{
		$status = 'Active';
	}

	$pass   = $security->decrypt($row['password']);
	//print_r($query);

	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $image;
	$sub_array[] = $row["fullname"];
	$sub_array[] = $row["username"].'</br>'.$row["email"];
	$sub_array[] = $pass;
	$sub_array[] = $row["level"];
	$sub_array[] = $row["dateTime"];
	$sub_array[] = $status;
	$sub_array[] = '
		<button type="button" name="update" id="'.$row["id_users"].'" class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Edit</button>
		<button type="button" name="delete" id="'.$row["id_users"].'" class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
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