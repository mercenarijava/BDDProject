<?php
	include 'session.php';								/* IMPORTANT DON'T DELETE */
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	connect();
	
	if($_SESSION['email']=="admin@blockgame.com"){
		$id_order = insertOrder($_POST['email'], $_POST['payment_type']);
		if($id_order){
			header('Location: ../orders.php'.'?order = success');
		}
		else{
			header('Location: ../orders.php'.'?order = failed');
		}
	}
	else{
		header('Location: ../orders.php');
	}
	
	disconnect();
	exit;

?>