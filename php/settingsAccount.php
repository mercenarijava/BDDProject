<?php
	include 'session.php';
	include 'db_helper.php';
	
	connect();
	if(strlen($_POST['password'])==0){
		//echo $_POST['email'];
		//echo $_SESSION['email'];
		//Modify Email
		echo (modifyEmail($_SESSION['email'], $_POST['email'])==true)?1:0;
		if(modifyEmail($_SESSION['email'], $_POST['email'])){
			$_SESSION['email'] = $_POST['email'];
			header('Location: ../settings.php'.'?email=true');
		}
		else{
			//header('Location: ../settings.php'.'?email=false');
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
	//exit();
?>