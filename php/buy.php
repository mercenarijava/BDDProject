<?php
	include 'session.php';
	
	if(isset($_SESSION['email'])){
		/*Accesso già eseguito allora compra */
		header('Location: ../buy.php'.'?buy=success');
	}
	else{
		header('Location: ../buy.php'.'?buy=failed');
	}
?>