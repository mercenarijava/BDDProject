<?php
	include 'session.php';								/* IMPORTANT DON'T DELETE */
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	$payment_id = json_decode($_POST["payment_id"], TRUE);
	$username = json_decode($_POST["username"], TRUE);
	connect();
	if($_SESSION['email']=="admin@blockgame.com"){
		modifyCreditCardId(0, $username);
		deleteCreditCard($payment_id);
		echo "s1";
	}else{
	    echo "e2";
	}
	
	disconnect();
	exit;
?>