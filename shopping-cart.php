<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */			
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
		<link rel="stylesheet" href="css/settings.css">
		<link rel="stylesheet" href="css/orders.css">
		<link rel="stylesheet" href="css/shopping-cart.css">
	</head>
	<body>
		
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		bckg_navbar(0);
		
		?>
		
		<!-- Shopping  cart -->
		<section class="general-form">
			<div class = "container">
				<div class = "title-page">
					<h1>Your cart</h1>
					<p>
						Free delivery and free returns.
					</p>
				</div>
				<div id="orders_layout" class="bckg-form content-form content-orders shopping-cart">


					<div id="info_buy" class="row justify-content-end align-items-center">
						<div class="col-4  boder-bottom py-5">
							<li>Subtotal</li>
							<li>Shipping</li>
						</div>
						<div class="col-4 boder-bottom py-5 text-right">
							<li id="subtotal" >0,00€</li>
							<li>FREE</li>
						</div>
					</div>
					<div class="row justify-content-end align-items-center">
						<div class="col-4">
							<li>Total</li>
						</div>
						<div class="col-4 text-right">
							<li id="total">0,00€</li>
						</div>
					</div>
					<div class="row justify-content-end align-items-center py-5">
						<input type="button" name="buy" id="buy" class="form-submit col-3 btn-buy" value="BUY">
					</div>
				</div>
			</div>
		</section>
		<!-- Shopping cart -->
		
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
		<script type="text/javascript" src="js/blur.js"></script>
		<script src="js/shoppingCart.js"></script>
	</body>
</html>