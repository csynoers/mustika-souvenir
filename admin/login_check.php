<?php
	session_start();
	include "config.php";

	if(isset($_POST['btn-login']))
	{
        if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
            $username   = $security->anti_injection($_POST['username']);
        }else{
            $username = $_POST['username'];
        }
		
		$password   = $security->anti_injection($_POST['password']);

        $result = $database->count_rows($table="users", $where_clause="WHERE username='$username' OR email = '$username' AND blokir='N'");
        if ($result > 0) {
            $users = $database->select($fields="*", $table="users", $where_clause="WHERE username='$username' OR email = '$username' AND blokir='N'", $fetch="");

            if ($security->decrypt($users["password"]) === $password) {
                $_SESSION['id_users']       = $users['id_users'];
                $_SESSION['fullname']       = $users['fullname'];
                $_SESSION['username']       = $users['username'];
                $_SESSION['email']          = $users['email'];
                $_SESSION['phone']          = $users['phone'];
                $_SESSION['image']          = $users['image'];
                $_SESSION['password']       = $users['password'];
                $_SESSION['level']          = $users['level'];

                $sid_lama = session_id();

                session_regenerate_id();

                $sid_baru = session_id();

                $form_data = array(
                    'id_session' => $sid_baru,
                );

                $database->update($table="users", $array=$form_data, $fields_key="id_users", $id="$_SESSION[id_users]");
                echo "ok"; // log in
                //echo $pass;
                $_SESSION['user_session'] = $sid_baru;

            }else{
                echo "Maaf, Password salah";
            }

        }else{
            echo "Maaf, Username salah ";
        }
		
	}

?>