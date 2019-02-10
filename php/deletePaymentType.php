<?php
	include 'session.php';
	include "db_helper.php";
	connect();
	
	$id = $_POST["payment_type"];
	$username = $_POST["username"];
	if(isset($_SESSION['email'])){
		modifyOrdersPaymentType(NULL, $id);
		modifyCreditCardId(NULL, $username);
		deleteCreditCard($id);
	    echo "s1";
	}else{
	    echo "e2";
	}
	disconnect();
	exit;
?>