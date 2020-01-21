<?php
error_reporting(0);
session_start();
if(isset($_SESSION['user_session']) != ""){
    header("Location: media.php?module=home");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <title>Login Admin</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/icon.png">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link href="dist/css/login.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>  
    <div class="signin-form">
        <div class="container">
            <div class="content-center responsive">
                <form class="form-signin" method="post" id="login-form">
                    <div class="logo-login"><img src="../assets/images/logo_sm.png" style="max-width: 100%"></div>
                    <p class="login-box-msg">Sign in to start your panel admin</p>
                   
                    <div id="error"></div>
                    <div class="form-group">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-user"></i>   
                            <input type="text" class="form-control" placeholder="Username or Email" name="username" id="username" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-lock"></i>   
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-login" id="btn-login">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
                        </button> 
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/validation.min.js"></script>
    <script type="text/javascript" src="dist/js/login.js"></script>
</body>
</html>