<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
$database 	= new Database($db);
$totalRow = $database->count_rows($table="slide", $where_clause="");

$query = '';
$output = array();
$query .= "SELECT * FROM slide ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
	/*$query .= 'OR link LIKE "%'.$_POST["search"]["value"].'%" ';*/
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_slide DESC ';
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
		if ($row["kategori"]=='video') {
			$image = '
				<video width="200" controls>
				  <source src="../joimg/slide/'.$row["image"].'" type="video/mp4">
				</video>';
			$disabled = 'disabled';
		}else{
			$image = '
				<img src="../joimg/slide/'.$row["image"].'" class="img-thumbnail" width="100" height="auto" />';
			$disabled = '';
		}
	}else{
		$image = '';
	}

	if ($row["status"] == '0') {
		$status = 'Hidden';
	}else{
		$status = 'Publish';
	}

	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $image;
	$sub_array[] = $row["title"];
	/*$sub_array[] = $row["link"];*/
	$sub_array[] = $row["dateTime"];
	$sub_array[] = $status;
	$sub_array[] = '
		<button type="button" name="update" id="'.$row["id_slide"].'" '.$disabled.' class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Edit</button>';
		// <button type="button" name="delete" id="'.$row["id_slide"].'" '.$disabled.' class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
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