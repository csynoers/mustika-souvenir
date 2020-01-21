<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}

if ($_GET[module]=='home'){
	if ($_SESSION['level']=='admin' OR $_SESSION['level']=='imam jamaah'){
        $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
        $tanggal = date("Y-m-d");// Mendapatkan tanggal sekarang
        $waktu   = time(); //
        $pengunjung       = $database->count_rows($table="statistik", $where_clause="WHERE tanggal='$tanggal' ");
        $totalpengunjung  = $database->select($fields="COUNT(hits)", $table="statistik", $where_clause="", $fetch="");
        $hits             = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="WHERE tanggal='$tanggal'", $fetch="");
        $totalhits        = $database->select($fields="SUM(hits)", $table="statistik", $where_clause="", $fetch="");
        //echo $_SESSION['user_session'];
      ?>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php if(empty($hits[0])){echo "0";}else{echo $hits[0];}?></h3>
                <p>Today View</p>
              </div>
              <div class="icon">
                <i class="ion ion-eye"></i>
              </div>
             
            </div>
          </div>
    
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php if(empty($pengunjung)){echo "0";}else{echo $pengunjung;}?></h3>
                <p>Today Visitor</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
             
            </div>
          </div>
         
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $totalhits[0];?></h3>
                <p>Total View</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $totalpengunjung[0];?></h3>
                <p>Total Visitor</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
        </div>
      </section>
      
<?php
  }
}

elseif ($_GET['module']=='users'){
  if ($_SESSION['level']=='admin'){
    include "modul/users/users_v.php";
  }
}


elseif ($_GET[module]=='information') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/information/information_v.php";
  }
}

elseif ($_GET[module]=='subinformation') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/subinformation/subinformation_v.php";
  }
}

elseif ($_GET[module]=='gallery') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/gallery/gallery_v.php";
  }
}

elseif ($_GET[module]=='contact') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/contact/contact_v.php";
  }
}

elseif ($_GET[module]=='slide') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/slide/slide_v.php";
  }
}

elseif ($_GET[module]=='sosmed') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/sosmed/sosmed_v.php";
  }
}

elseif ($_GET[module]=='address') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/address/address_v.php";
  }
}


elseif ($_GET[module]=='pages') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/pages/pages_v.php";
  }
}

// Bagian messages
elseif ($_GET[module]=='messages'){
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas'){
    include "modul/messages/messages_v.php";
  }
}


elseif ($_GET[module]=='search') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
    include "modul/search/search_v.php";
  }
}

elseif ($_GET[module]=='city'){
  if ($_SESSION['level']=='admin'){
    include "modul/city/city_v.php";
  }
}

elseif ($_GET[module]=='articles') {
  if ($_SESSION['level']=='admin' OR $_SESSION['level']=='petugas') {
  include "modul/articles/articles_v.php";
  }
}

else{
  echo "<p><b><center>MODUL BELUM ADA ATAU BELUM LENGKAP</center></b></p>";
}
?>
