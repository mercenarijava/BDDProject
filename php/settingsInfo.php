<?php
	include 'session.php';
	include 'db_helper.php';
	
	connect();
	echo $_SESSION['email'].' '. $_POST['name'].' '. $_POST['surname'].' '.$_POST['address'].' '.$_POST['phone'];
	$result = modifyPersonalInfo($_SESSION['email'], $_POST['name'], $_POST['surname'], $_POST['address'], $_POST['phone']);
	
	if($result){
		header('Location: ../settings.php'.'?modifyPersonalInfo=true');
	}
	else{
		header('Location: ../settings.php'.'?modifyPersonalInfo=false');
	}
	disconnect();
	exit();
?>