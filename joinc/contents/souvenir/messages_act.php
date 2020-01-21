<?php 
    error_reporting(0);
    require_once '../../../josys/db_connect.php';
    include_once '../../../josys/class/Database.php';
    $database   = new Database($db);
    date_default_timezone_set('Asia/Jakarta');
    $date   = date("Y-m-d H:i:s");
    $name = trim(strip_tags($_POST["fullname"]));
    $description = trim(strip_tags($_POST["description"]));
    $form_data = array(
        "fullname"       => "$name",
        "email"          => "$_POST[email_address]",
        "phone"          => "$_POST[phone]",
        "description"    => "$description",
        "status"         => "0",
        "dateTime"       => "$date"
    );

    //proses insert ke database
    $database->insert($table="messages", $array=$form_data);
    echo '
        <div class="alert alert-success"><i class="mdi mdi-checkbox-marked-circle"></i> &nbsp; Pesan berhasil dikirim. 
                            </div> 
    ';

   
?>


