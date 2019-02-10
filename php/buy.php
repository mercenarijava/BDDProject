<?php
	include 'db_helper.php';
	include 'session.php';
	$games = json_decode($_POST["games"], TRUE);
    connect();
	if(isset($_SESSION['email'])){

        // get payment type
        // if payment type == null return e1
        $payment_type = getPaymentTypeOfUser($_SESSION['email']);
        if(mysqli_num_rows($payment_type) == 0){
            echo "e1";
        }else{
            $results=mysqli_fetch_array($payment_type);
            $payment_type_id = $results["payment_type"];
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