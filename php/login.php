<?php
	include 'db_helper.php';
	include 'session.php';
	connect();
	$login_user = login($_POST["email"], $_POST["password"]);
	$exists = $login_user->rowCount() > 0;
	if($exists){
		session_login($_POST["email"]);
		echo "true";
	}else{
		header('Location: ../login.php'.'?access=false');
		echo "false";
	}
	disconnect();
	exit();
?>