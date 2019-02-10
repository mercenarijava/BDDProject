<?php
	include 'session.php';
	include 'db_helper.php';
	
	connect();
	
	$date = $_POST['year'].'-'.$_POST['month'].'-00';//date($_POST['year'].'-'.$_POST['month'].'-00');
	echo $_POST['id'].' - '.$_POST['owner'].' - '.$date;
	modifyCreditCard($_POST['id'], $_POST['owner'], $date);
	
	header('Location: ../settings.php'.'?creditCard=true');
	disconnect();
	exit();

?>