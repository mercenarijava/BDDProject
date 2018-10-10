<?php
	include 'db_helper.php';
	connect();
	$login_user = login($_POST["username"], $_POST["pass"]);
	$rows = array();
	while($r = mysqli_fetch_assoc($login_user)) {
		$rows[] = $r;
	}
	$exists = mysqli_num_rows($login_user) > 0;
	if($exists){
		echo json_encode($rows[0]);
	}else{
		echo "false";
	}
	disconnect();
?>