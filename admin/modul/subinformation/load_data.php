<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';
$database 	= new Database($db);

$id_info = $_POST['id'];
$totalRow = $database->count_rows($table="sub_information", $where_clause="WHERE id_information = $id_info AND title LIKE '%".$_POST['search']['value']."%'");

$output = array();
$query = '';
$query .= "SELECT * FROM sub_information ";
$query .= 'WHERE id_information = '.$id_info.' ';
if(isset($_POST["search"]["value"]))
{
	$query .= 'AND title LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY dateTime DESC ';
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
		$image = '<img src="../joimg/information/'.$row["image"].'" class="img-thumbnail" width="80" height="auto" />';
	}else{
		$image = '';
	}

	$status = '<div class="form-group"><label><input type="radio" class="flat-red change-status" value="1" data-id="'.$row["id_subinformation"].'" 
	'; 

  	if ($row["status"]=="1") { $status .= "checked";};
  $status .= ' > Publish </label> </br><label><input type="radio" class="flat-red change-status" value="0" data-id="'.$row["id_subinformation"].'" 
  '; 

 		if ($row["status"]=="0") { $status .= "checked";};
  $status .= '> Hidden </label></div>';

  $premium = '<div class="form-group"><label><input type="radio" class="flat-red change-premium" value="1" data-id="'.$row["id_subinformation"].'" 
	'; 

  	if ($row["premium"]=="1") { $premium .= "checked";};
  $premium .= ' > Yes </label> </br><label><input type="radio" class="flat-red change-premium" value="0" data-id="'.$row["id_subinformation"].'" 
  '; 

 		if ($row["premium"]=="0") { $premium .= "checked";};
  $premium .= '> No </label></div>';

	// $city   = $database->select($fields="*", $table="city", $where_clause="WHERE city_id = '$row[city_id]'", $fetch='');
	
	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $image;
	$sub_array[] = $row["kode"].'<button style="margin-top:6px;" data-id="'.$row["id_subinformation"].'" class="add-image-info btn btn-sm btn-flat btn-info"><i class="fa fa-plus"></i> More Image</button>';
	$sub_array[] = $row["title"];
	// $sub_array[] = $city["city_name"];
	$sub_array[] = 'Rp. '.number_format($row["price"], 0, ".", ".");
	$sub_array[] = $row["dateTime"];
	$sub_array[] = $premium;
	$sub_array[] = $status;
	$sub_array[] = '
		<button type="button" name="update" id="'.$row["id_subinformation"].'" class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Edit</button>
		<button type="button" name="delete" id="'.$row["id_subinformation"].'" class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
	$no++;
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$totalRow,
	"data"				=>	$data,
	"sql"				=>  $query
);
echo json_encode($output);
?>