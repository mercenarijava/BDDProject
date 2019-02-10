<?php
	include 'session.php';								/* IMPORTANT DON'T DELETE */
	include 'db_helper.php';								/* IMPORTANT DON'T DELETE */
	
	$videogame_id = json_decode($_POST["id_videogame"], TRUE);
	$order_id = json_decode($_POST["id_order"], TRUE);
	$quantity = json_decode($_POST["quantity"], TRUE);
	connect();
	if($_SESSION['email']=="admin@blockgame.com"){
		$free_quantity = getQuantity($videogame_id) + $quantity;
		updateGameQuantity($videogame_id, $free_quantity);
		deleteContent($videogame_id, $order_id);
		echo "s1";
	}else{
	    echo "e2";
	}
	
	disconnect();
	exit;
?>