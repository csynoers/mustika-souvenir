<?php
/*======== DATABASE KONEKSI DENGAN MENGGUNAKAN KONSEPPDO ===========*/

$DB_HOST		= 	"localhost";
$DB_NAME		= 	"scm_mustika_souvenir";
$DB_USERNAME	= 	"root";
$DB_PASSWORD 	= 	"";

$DB_DSN  		= 	"mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8";

$DB_OPTIONS 	= 	array(
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
						PDO::ATTR_EMULATE_PREPARES => true,
       					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					);
try {
    $db = new PDO($DB_DSN, $DB_USERNAME, $DB_PASSWORD, $DB_OPTIONS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//echo "Success to get DB handle";
} catch (PDOException $e) {
	echo "Failed to get database handle: " . $e->getMessage() . "\n";
	exit();
}

?>