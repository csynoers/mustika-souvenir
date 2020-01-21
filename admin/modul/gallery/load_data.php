<?php
require_once '../../../josys/db_connect.php';
include_once '../../../josys/class/Database.php';

$database 	= new Database($db);
function cek_pesan($teks){
 
$key = array(".jpg",".png",".jpeg");
$hasil = 0;
$jml_kata = count($key);
for ($i=0;$i<$jml_kata;$i++){
	if (stristr($teks,$key[$i])){ $hasil=1; }
}
 
return $hasil;
 
}
$totalRow = $database->count_rows($table="gallery", $where_clause="");

$query = '';
$output = array();
$query .= "SELECT * FROM gallery ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR link LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_gallery DESC ';
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
$noImg = 'hqdefault';
foreach($result as $row)
{

	if ($row["status"] == '0') {
		$status = 'Hidden';
	}else{
		$status = 'Publish';
	}
	$image = '';
	if($row["link"] == ''){
		$image = '<img src="../joimg/gallery/thumbnail/'.$row["image"].'" class="img-thumbnail" width="100" height="auto" />';
	}else{
		$url = $row['link']; 
		$parts = explode('=',$url);
		$last = end($parts);
		$image = '<a href="'.$url.'" target="blank_"> <img alt="" src="http://img.youtube.com/vi/'.$last.'/'.$noImg.'.jpg" alt="'.$row["title"].'" width="100" height="auto"/> </a>';
	}
	

	$sub_array = array();
	$sub_array[] = $no;
	$sub_array[] = $image;
	$sub_array[] = $row["category"];
	$sub_array[] = $row["title"];
	$sub_array[] = $row["dateTime"];
	$sub_array[] = $status;
	$sub_array[] = '
		<button type="button" name="update" id="'.$row["id_gallery"].'" class="btn btn-warning btn-sm btn-flat update"><i class="fa fa-edit"></i> Edit</button>
		<button type="button" name="delete" id="'.$row["id_gallery"].'" class="btn btn-danger btn-sm btn-flat pull-right delete"><i class="fa fa-trash-o"></i> Del</button>';
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