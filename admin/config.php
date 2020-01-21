<?php

require_once '../josys/db_connect.php';
include_once '../josys/class/Database.php';
include_once '../josys/class/Security.php';

$database 	= new Database($db);
$security   = new Security();

//Config Name Admin Panel
$config = array();
$config['web_name']     = 'Mustika Souvenir';
$config['web_index']    = '../';
