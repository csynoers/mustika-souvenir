<?php 
    error_reporting(0);
    require_once '../../../josys/db_connect.php';
    include_once '../../../josys/class/Database.php';
    $database   = new Database($db);
    $c1 = rand(1, 10);
    $c2 = rand(1, 20);
    if (isset($_POST['action'])) {
      if ($_POST['action'] == 'load-data') {
          $output = array();
          $category = $database->select($fields="*", $table="information", $where_clause="WHERE status = '1' order by title asc", $fetch='all');
          $catData = '<option value="" selected="" disabled>-- pilih kategori --</option>';
            foreach ($category as $key => $value) {
              $catData .= '<option value="'.$value["id_information"].'">'.$value["title"].'</option>';
            }

          $city = $database->select($fields="*", $table="city", $where_clause="WHERE status = '1' order by city_name asc", $fetch='all');
          $cityData = '<option value="" selected="" disabled>-- pilih area --</option>';
            foreach ($city as $key => $value) {
              $cityData .= '<option value="'.$value["city_id"].'">'.$value["city_name"].'</option>';
            }

          $output['category'] = $catData;
          $output['area'] = $cityData;
          $output['randomNumber1'] = $c1;
          $output['randomNumber2'] = $c2;
          echo json_encode($output);
      }

      if ($_POST['action'] == 'insert') {
        $output = array();
        date_default_timezone_set('Asia/Jakarta');
        $date   = date("Y-m-d H:i:s");
        $name = trim(strip_tags($_POST["fullname"]));
        $facilities = trim(strip_tags($_POST["facilities"]));
        $description = trim(strip_tags($_POST["description"]));
        $form_data = array(
            "id_information" => "$_POST[category]",
            "city_id"        => "$_POST[area]",
            "fullname"       => "$name",
            "email"          => "$_POST[email_address]",
            "phone"          => "$_POST[phone]",
            "facilities"     => "$facilities",
            "description"    => "$description",
            "status"         => "0",
            "dateTime"       => "$date"
        );

        //proses insert ke database
        $database->insert($table="messages_search", $array=$form_data);
        $output['msg'] = '
            <div class="alert alert-success"><i class="mdi mdi-checkbox-marked-circle"></i> '.$date.' &nbsp; Pesan berhasil dikirim. 
                                </div> 
        ';
        $output['randomNumber1'] = $c1;
        $output['randomNumber2'] = $c2;
        echo json_encode($output);
      }
    }
   

   
?>


