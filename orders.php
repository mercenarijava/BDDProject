<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	
	redirect_login_false(); /* IMPORTANT DON'T DELETE */
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
	</head>
	<body>
		
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		bckg_navbar(0);
		
		?>
		
		<!-- ORDERS -->
		<section class="general-form">
			<div class = "container">
				<div class = "title-page">
					<h1>My orders</h1>
					<p>
						Here you find all your orders.
					</p>
				</div>
				<div class = "bckg-form content-form content-orders bckg-settings-content">
					<div class="bckg-table table-striped">
						<div class="row bckg-table-thead font-weight-bold">
							<div class="col-3">
								<span>Date</span>
							</div>
							<div class="col-5">
								<span>Game</span>
							</div>
							<div class="col-2 text-right">
								<span>n°</span>
							</div>
							<div class="col-2 text-right">
								<span>Price</span>
							</div>
						</div>
						<div class="bckg-table-body option">
							<div class="bckg-row row py-2" onmouseover="blurElements('info1'); showSingleElem('delete1');" onmouseout="notBlurElements('info1'); hideSingleElem('delete1')">
								<div class="row align-items-center mx-0" id="info1" style="width:100%">
									<div class="col-3">
										<span scope="row">17/12/2018</span>
									</div>
									<div class="col-5">
										<img src="img/call-of-duty-mw2-cover.jpg" alt="" height="90" width="70" class="mr-3">
										<span>Call of duty</span>
									</div>
									<div class="col-2 text-right">
										<span style="font-size:10px">x</span>
										<span id="quantity" class="font-weight-bold">1</span>
									</div>
									<div class="col-2 text-right">
										<span>50€</span>
									</div>
								</div>
								<input type="button" name="submit" id="delete1" class="form-submit delete" value="Elimina"/>
							</div>
							<div class="bckg-row row py-2" onmouseover="blurElements('info2'); showSingleElem('delete2');" onmouseout="notBlurElements('info2'); hideSingleElem('delete2')">
								<div class="row align-items-center mx-0" id="info2" style="width:100%">
									<div class="col-3">
										<span scope="row">10/12/2018</span>
									</div>
									<div class="col-5">
										<img src="img/fifa-19.jpg" alt="" height="90" width="70" class="mr-3">
										<span>Fifa</span>
									</div>
									<div class="col-2 text-right">
										<span style="font-size:10px">x</span>
										<span id="quantity" class="font-weight-bold">1</span>
									</div>
									<div class="col-2 text-right">
										<span>80€</span>
									</div>
								</div>
								<input type="button" name="submit" id="delete2" class="form-submit delete" value="Elimina"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ORDERS -->
		
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