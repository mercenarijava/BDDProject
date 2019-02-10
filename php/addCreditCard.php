<?php
	include 'session.php';
	include 'db_helper.php';
	
	connect();
	
	$date = $_POST['year'].'-'.$_POST['month'].'-00';//date($_POST['year'].'-'.$_POST['month'].'-00');
	echo $date;
	$result = addCreditCard($_SESSION['email'], $_POST['cardNumber'], $_POST['owner'], $_POST['cvv'], $date);
	
	if($result){
		header('Location: ../settings.php'.'?creditCard=true');
	}
	else{
		header('Location: ../settings.php'.'?creditCard=false');
	}
	disconnect();
	exit()


?>