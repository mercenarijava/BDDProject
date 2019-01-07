<?php
	include 'db_helper.php';
	include 'session.php';
	connect();
	$login_user = login($_POST["email"], $_POST["password"]);
	$rows = array();
	while($r = mysqli_fetch_assoc($login_user)) {
		$rows[] = $r;
	}
	$exists = mysqli_num_rows($login_user) > 0;
	if($exists){
		session_login($_POST["email"]);
		echo json_encode($rows[0]);
	}else{
		header('Location: ../login.php'.'?access=false');
		echo "false";
	}
	disconnect();
	exit();
?>