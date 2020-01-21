<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['user_session'])){
  header("Location: index.php");
}
if ($_SESSION['level']=='admin') {
  $levelUsers = 'admin';
  $actProfil = '';
  # code...
}else{
  $levelUsers = 'petugas';
  $actProfil = 'disabled=""';
}
include_once 'config.php';
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel Admin</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/icon.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a class="logo">
      <span class="logo-mini"><b>MS</b></span>
      <span class="logo-lg"><b><?php echo $config['web_name'];?></b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <?php
            $countMsg = $database->count_rows($table="messages", $where_clause="WHERE status = '0'");
            echo '
            <li class="dropdown messages-menu">
              <a href="media.php?module=search" title="Cari Properti" >
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">'.$countMsg.'</span>
              </a>
            </li>
            ';
            $countSearch = $database->count_rows($table="messages_search", $where_clause="WHERE status = '0'");
            echo '
            <li class="dropdown messages-menu">
              <a href="media.php?module=messages" title="Pesan Masuk" >
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">'.$countSearch.'</span>
              </a>
            </li>
            ';
          ?>
          <li>
              <a href="<?php echo $config["web_index"];?>" target="_blank" title="View Web"><i class="fa fa-eye"></i></a>
          </li>
        
           <li class="user user-menu">
            <a href="javascript:void(0);" id="logout" title="Log Out">
              <i class="fa fa-power-off"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../joimg/users/<?php echo $_SESSION['image'] ;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['fullname'] ;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>       
        <?php if ($_SESSION['level']=='admin') { ?>
          <li class="<?php if ($_GET['module']=='home'){ echo 'active';}?>">
            <a href="media.php?module=home">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="<?php if ($_GET['module']=='users'){ echo 'active';}?>">
            <a href="media.php?module=users">
              <i class="fa fa-user"></i> <span>Users</span>
            </a>
          </li>

          <li class="treeview <?php if ( $_GET['module']=='information' || $_GET['module']=='subinformation' || $_GET['module']=='city' || $_GET['module']=='gallery' || $_GET['module']=='articles'){ echo 'active menu-open';}?>">
            <a href="#">
              <i class="fa fa-list"></i> <span>Menu</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="media.php?module=information"><i class="fa fa-circle-o"></i> Category(Product)</a></li>
              <li><a href="media.php?module=gallery"><i class="fa fa-circle-o"></i> Galeri</a></li>
              <li><a href="media.php?module=articles"><i class="fa fa-circle-o"></i> Berita</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['module']=='search' || $_GET['module']=='messages'){ echo 'active menu-open';}?>">
            <a href="#">
              <i class="fa fa-envelope-o"></i> <span>Messages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              
              <li><a href="media.php?module=search"><i class="fa fa-circle-o"></i> Cari Properti</a></li>
              <li><a href="media.php?module=messages"><i class="fa fa-circle-o"></i> Pesan Masuk</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['module']=='slide' || $_GET['id']=='5' || $_GET['id']=='6' || $_GET['id']=='7'){ echo 'active menu-open';}?>">
            <a href="#">
              <i class="fa fa-globe"></i> <span>Pages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="media.php?module=pages&id=5"><i class="fa fa-circle-o"></i> About</a></li>
              <li><a href="media.php?module=slide"><i class="fa fa-circle-o"></i> Slide / Banner</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['module']=='contact' || $_GET['module']=='address' || $_GET['module']=='sosmed'){ echo 'active menu-open';}?>">
            <a href="#">
              <i class="fa fa-phone"></i> <span>Hubungi Kami</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">              
              <li><a href="media.php?module=contact"><i class="fa fa-circle-o"></i> Kontak</a></li>
              <li><a href="media.php?module=address"><i class="fa fa-circle-o"></i> Alamat</a></li>
              <li><a href="media.php?module=sosmed"><i class="fa fa-circle-o"></i> Sosmed</a></li>
            </ul>
          </li>          
          <li class="treeview <?php if ($_GET['id']=='1' || $_GET['id']=='2' || $_GET['id']=='3'){ echo 'active menu-open';}?>">
            <a href="#">
              <i class="fa fa-globe"></i> <span>Seo Web</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="media.php?module=pages&id=1"><i class="fa fa-circle-o"></i> Title</a></li>
              <li><a href="media.php?module=pages&id=2"><i class="fa fa-circle-o"></i> Keyword</a></li>
              <li><a href="media.php?module=pages&id=3"><i class="fa fa-circle-o"></i> Description</a></li>
            </ul>
          </li>
          
        <?php } elseif($_SESSION['level']=='imam jamaah') {?>
          <li class="<?php if ($_GET['module']=='register'){ echo 'active';}?>">
            <a href="media.php?module=register"><i class="fa fa-newspaper-o"></i><span>Pendaftaran</span></a>
          </li>
        <?php } else { echo "not found";}?>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">  
    <?php require_once "modul.php"; ?>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href=""><?php echo $config['web_name'];?></a>.</strong> All rights reserved.
  </footer>

</div>
<?php include "modul/profile/profile_v.php"; ?>
<?php if ($_GET['module']!='information' AND $_GET['module']!='subinformation' AND $_GET['module']!='messages' AND $_GET['module']!='search' AND $_GET['module']!='contact' AND $_GET['module']!='slide' AND $_GET['module']!='sosmed' AND $_GET['module']!='address' AND $_GET['module']!='gallery' AND $_GET['module']!='users' AND $_GET['module']!='articles' AND $_GET['module']!='city') { ?>
   <script src="bower_components/jquery/dist/jquery.min.js"></script>
<?php } ?>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
   $(document).on('click', '#logout', function(){
      if(confirm("yakin akan keluar dari panel admin ?")){
        window.location.assign("logout.php")
      }
      else{
        return false; 
      }
    });
</script>
<script>
  $(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});
</script>
</body>
</html>