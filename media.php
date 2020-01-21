<?php
/*include "josys/function/time_load.php";
time_load();*/

session_start();
error_reporting(0);
include_once "josys/function/minify_helper.php";
ob_start('minify_html');

//require Import System files
require_once 'josys/db_connect.php';
include_once 'josys/class/Database.php';
include_once "josys/class/Tanggal.php";
include_once "josys/class/Rupiah.php";

$tanggal   = new Tanggal();
$database 	= new Database($db);

//Config Website
$config = array();
$config['web_name']     = 'Mustika Souvenir';
$config['web_index']    = './';

include "template.php";
ob_end_flush();