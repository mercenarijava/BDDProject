<?php
	include 'session.php';								/* IMPORTANT DON'T DELETE */
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	connect();
	
	if($_SESSION['email']=="admin@blockgame.com"){
		$free_quantity = getQuantity($_POST['videogame_id']) - $_POST['quantity'];
		updateGameQuantity($_POST['videogame_id'], $free_quantity);
		insertContents($_POST['videogame_id'], $_POST['order_id'], $_POST['quantity']);
		header('Location: ../modifyOrder.php'.'?orderId='.$_POST['order_id'].' & videogame = success');
	}
	else{
		header('Location: ../orders.php');
	}
	
	disconnect();
	exit;
?>