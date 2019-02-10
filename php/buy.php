<?php
	include 'db_helper.php';
	include 'session.php';
	$games = json_decode($_POST["games"], TRUE);
    connect();
	if(isset($_SESSION['email'])){

        // get payment type
        // if payment type == null return e1
        $payment_type = getPaymentTypeOfUser($_SESSION['email']);
        if(sizeof($payment_type) == 0){
            echo "e1";
        }else{
            $payment_type_id = $payment_type[0]["payment_type"];
			$order_id = insertOrder($_SESSION['email'], $payment_type_id);
			
            foreach ($games as $value) {
                updateGameQuantity($value["game_id"], $value["game_quantity"] - $value["buyQuantity"]);
                insertContents($value["game_id"], $order_id, $value["buyQuantity"]);
            }
	        echo "s1";
        }
	}else{
	    echo "e2";
	}
	disconnect();
?>