<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	
	if(!isset($_GET['buy']) || (isset($_SESSION['email']) && isset($_GET['buy']) && $_GET['buy']!= 'success' )){ /* IMPORTANT */
		header('Location: ./');
	}
?>
<html lang="en">
	<head>
		<title>BlockGame</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="logo/logo-icon-a.png" type="image/png" sizes="16x16">
		<link rel="stylesheet" href="css/stylecard.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="css/video.css">
		<link rel="stylesheet" href="css/login-signin.css">
	</head>
	<body>
		
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		bckg_navbar(0);
		
		?>
		
		<!-- BUY -->
		<section class="general-form background-transparent" style="min-height: -webkit-fill-available;">
			<div class="fullbackground-img">
				<img src="img/watch-dogs-2.jpg"></img>
            </div>
			<div class="row m-0 py-5 justify-content-center text-center" style="position: absolute; top: 37%; width:100%; background-color: #000000b0;">
				<?php 
				if(isset($_SESSION['email']))
				{
					if(isset($_GET['buy']) && $_GET['buy']=="success"){?>
				<h1 class="col-sm-12">Thank you for buying.</h2>
				<h2 class="col-sm-12">Enjoy your games.</h2>
				<h3 class="col-sm-12"><a href="home.php" class="footer-link ">Go to home...</a></h3>
				<?php
					}
				}
				else{
				?>
				<h1 class="col-sm-12"> - Execute the login <a href="login.php" class="footer-link ">Login</a></h1>
				<h2 class="col-sm-12"> - If you don't have a BlockGame account yet <a href="register.php" class="footer-link ">register now</a></h1>
				<?php
				}
				?>
			</div>
        </section>
		<!-- BUY -->
		
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		footer();
		
		?>
		
		<!-- Script -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/scrolldown.js"></script>
		<script type="text/javascript" src="js/logo.js"></script>
		<script src="js/password-hide.js"></script>
	</body>
</html>