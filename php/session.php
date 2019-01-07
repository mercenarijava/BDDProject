<?php
	// server should keep session data for AT LEAST 1 hour = 3600 sec
	ini_set('session.gc_maxlifetime', 3600);

	// each client should remember their session id for EXACTLY 1 hour = 3600 sec
	session_set_cookie_params(3600);
	
	session_start();
	
	function session_login($email){
		$_SESSION['email']=$email;
		
		header('Location: ../'.'?access=true');
	}
	function session_logout(){
		$_SESSION = array();
		header('Location: ../');
	}
	
	
	/**
		Redirect if login is true
		
		IMPORTANT DON'T DELETE
	*/
	function redirect_login_true(){
		/* login effettuato vai alla home.php */
		if(isset($_SESSION['email'])){
			header('Location: ./');
		}
	}
	
	/**
		Redirect if login is false 
		
		IMPORTANT DON'T DELETE
	*/
	function redirect_login_false(){
		/* login non effettuato vai home.php */
		if(!isset($_SESSION['email'])){
			header('Location: ./login.php');
		}
	}
	
	
	/**
		Redirect if not admin account
		
		IMPORTANT DON'T DELETE
	*/
	function redirect_admin_false(){
		/* login effettuato vai alla home.php */
		if(isset($_SESSION['email']) && $_SESSION['email'] != "admin@blockgame.com"){
			header('Location: ./');
		}
	}
	
?>