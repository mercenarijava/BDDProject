<?php
	include 'session.php';
	include 'db_helper.php';
	
	connect();
	if(strlen($_POST['password'])==0){
		//Modify Email
		if(modifyEmail($_SESSION['email'], $_POST['email'])){
			$_SESSION['email'] = $_POST['email'];
			header('Location: ../settings.php'.'?email=true');
		}
		else{
			header('Location: ../settings.php'.'?email=false');
		}
	}
	else{
		if(modifyAccount($_SESSION['email'], $_POST['email'], $_POST['password'])){
			$_SESSION['email'] = $_POST['email'];
			header('Location: ../settings.php'.'?accountModify=true');
		}
		else{
			header('Location: ../settings.php'.'?accountModify=false');
		}
	}
	disconnect();
	exit();
?>