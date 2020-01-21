<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
$database 	= new Database($db);
$totalRow = $database->count_rows($table="information", $where_clause="");

$query = '';
$output = array();
$query .= "SELECT * FROM information ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_information DESC ';
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
		$status = 'Hidden';
	}else{
		$status = 'Publish';
	}
	$countIklan = $database->count_rows($table="sub_information", $where_clause="WHERE id_information = '$row[id_information]'");

	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $row["title"];
	$sub_array[] = '
		<div class="more-btn-info">
			<a href="media.php?module=subinformation&id='.$row["id_information"].'&name='.$row["title"].'" class="btn btn-default btn-sm btn-flat"><i class="fa fa-plus"></i> Add Data 
			</a>
			<span data-toggle="tooltip" title="data tersimpan" class="badge bg-light-blue" data-original-title="3 New Messages">'.$countIklan.'</span>
			</div>';
	$sub_array[] = $status;
	$sub_array[] = $row["dateTime"];
	$sub_array[] = '
		<button type="button" name="update" id="'.$row["id_information"].'" class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Edit</button>
		<button type="button" name="delete" id="'.$row["id_information"].'" class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
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