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
            $payment_type_id = $results["id"];
            foreach ($games as $value) {
                updateGameQuantity($value["game_id"], $value["game_quantity"] - $value["buyQuantity"]);
                insertOrder($_SESSION['email'], $value["game_id"], $payment_type_id, $value["buyQuantity"], $value["console_id"]);
            }
	        echo "s1";
        }

	}else{
	    echo "e2";
	}
	disconnect();
?>