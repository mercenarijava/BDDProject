<?php
	include 'db_helper.php';
	include 'session.php';
	connect();
	
	$signin_user = signin($_POST["name"], $_POST["surname"], $_POST["address"], $_POST["phone"], $_POST["email"], $_POST["password"]);
	if($signin_user){
		session_login($_POST["email"]);
	}
	else{
		header('Location: ../register.php'.'?signin=false');
	}
	disconnect();
	exit();

?>