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
				<form method="POST" class="bckg-form content-form content-orders shopping-cart" action="php/buy.php">
					<div class="row boder-bottom align-items-center py-5">
						<div class="col-sm-7">
							<img src="img/call-of-duty-mw2-cover.jpg" alt="" height="150" width="120" class="mr-3">
							<span class="font-weight">Call of duty</span>
						</div>
						<div class="col-sm-2 text-right">
							<input type="number" min="01" max="20" class="form-input num-items" maxlength="2" name="num-game-1" id="num-game-1" placeholder="1" required="" value="1">
						</div>
						<div class="col-sm-2 text-right">
							<span class="font-weight">50,00€</span>
						</div>
						<div class="col-sm-1 text-right">
							<object data="icon/delete.svg" type="image/svg+xml" height="25" width="25" id="delete1">
								X
							</object>
						</div>
					</div>
					<div class="row boder-bottom align-items-center py-5">
						<div class="col-sm-7">
							<img src="img/fortnite.jpg" alt="" height="150" width="120" class="mr-3">
							<span class="font-weight">Fortnite</span>
						</div>
						<div class="col-sm-2 text-right">
							<input type="number" min="01" max="20" class="form-input num-items" maxlength="2" name="num-game-2" id="num-game-2" placeholder="1" required="" value="1">
						</div>
						<div class="col-sm-2 text-right">
							<span class="font-weight">30,00€</span>
						</div>
						<div class="col-sm-1 text-right">
							<object data="icon/delete.svg" type="image/svg+xml" height="25" width="25" id="delete2">
								X
							</object>
						</div>
					</div>
					
					<div class="row justify-content-end align-items-center">
						<div class="col-4  boder-bottom py-5">
							<li>Subtotal</li>
							<li>Shipping</li>
						</div>
						<div class="col-4 boder-bottom py-5 text-right">
							<li>80,00€</li>
							<li>FREE</li>
						</div>
					</div>
					<div class="row justify-content-end align-items-center">
						<div class="col-4">
							<li>Total</li>
						</div>
						<div class="col-4 text-right">
							<li id="total">80,00€</li>
						</div>
					</div>
					<div class="row justify-content-end align-items-center py-5">
						<input type="submit" name="buy" id="buy" class="form-submit col-3 btn-buy" value="BUY">
					</div>
				</form>
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
	</body>
</html>