<?php
	include 'db_helper.php';
	include 'session.php';
	$order_id = json_decode($_POST["id"], TRUE);
    connect();
	if(isset($_SESSION['email'])){
		$allContents = getContentsByOrderId($order_id);
		while($contents = mysqli_fetch_array($allContents)){
			$free_quantity = getQuantity($contents['videogame_id']) + $contents['QUANTITY'];
			updateGameQuantity($contents['videogame_id'], $free_quantity);
		}
		deleteOrdersById($order_id);
	    echo "s1";
	}else{
	    echo "e2";
	}
	disconnect();
?>