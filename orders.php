<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'php/db_helper.php';								/* IMPORTANT DON'T DELETE */
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
					<?php
						if($_SESSION['email'] == "admin@blockgame.com"){
							echo 	"<h1>Orders</h1>
									<p>
										Search, modify, delete orders.
									</p>";
						}else{
							echo 	"<h1>My orders</h1>
									<p>
										Here you find all your orders.
									</p>
									<p id='demo'></p>";
						}
					?>
				</div>
				<div class = "bckg-form content-form content-orders bckg-settings-content">
					<div class="bckg-table table-striped">
						<div class="bckg-table-body option" style="padding:0px">
							<?php
								connect();
								
								if($_SESSION['email'] == "admin@blockgame.com"){
									$allOrders = getOrders();
									echo	"<div class='settings-form bckg-form row'>
												<div class='col'>
													<input type='button' name='addOrder' id='addOrder' class='form-submit settings-btn' value='Inserisci Ordine' data-toggle='modal' data-target='#addOrderModal' style='position:relative; right:0px; width:unset;'/>
												</div>
												<div class='col' align='right'>
													<input class='form-control bckg-input-search' type='search' placeholder='Search...' id='orderSearch' style='position:relative; background-color: #ffffff; border: 1px solid;'  onkeyup='filterOrders();'>
												</div>
											</div>";
									
								}
								else{
									$allOrders = getOrdersByUsername($_SESSION['email']);
									echo	"<div class='settings-form bckg-form row'>
												<div class='col' align='right'>
													<input class='form-control bckg-input-search' type='search' placeholder='Search...' id='orderSearch' style='position:relative; background-color: #ffffff; border: 1px solid;'  onkeyup='filterOrders();'>
												</div>
											</div>";
								}
						?>
						</div>
						<div class="bckg-table-body option">
						<?php
								
								$exists = mysqli_num_rows($allOrders) > 0;
								if($exists == 0){
									echo "<h5 class='row'>Nessun ordine presente,<a href='home.php#shop' class='px-2'>Go to Shop...</a></h5>";
								}
								
								while($order = mysqli_fetch_array($allOrders)) { 
									$info = '"info'.$order['id'].'"';
									$delete = '"delete'.$order['id'].'"';
									$modify = '"modify'.$order['id'].'"';
									$link = '"modifyOrder.php?orderId='.$order['id'].'"';
									$username ='';
									
									if($_SESSION['email'] == "admin@blockgame.com"){
										$username = "<span class='col' style='text-align: -webkit-center;'>".$order['username_user']."</span>";
										echo 	"<div class='order bckg-row row py-2 my-4' onmouseover='blurElements(".$info."); show(".$modify.",".$delete.");' onmouseout='notBlurElements(".$info."); hide(".$modify.",".$delete.")' style='background-color: #ebebeb;'>";
									}
									else{
										echo 	"<div  class='order bckg-row row py-2 my-4' onmouseover='blurElements(".$info."); showSingleElem(".$delete.");' onmouseout='notBlurElements(".$info."); hideSingleElem(".$delete.")' style='background-color: #ebebeb;'>";
									}
									
									echo 		"<div id=".$info." name='info' style='width:100%'>
													<div class='row mx-0 py-2'>
														<span class='col' class='date'>Date: ".$order['date']."</span>
														".$username."
														<span class='col' class='order_id' style='text-align: -webkit-right;'>order_id: ".$order['id']."</span>
														<hr style='border: 1px solid #000; width: 100%;'>
													</div>";
									$allContents = getContentsByOrderId($order['id']);
									while($contents = mysqli_fetch_array($allContents)){
											echo	"<div class='row align-items-center mx-0 py-2' style='width:100%'>
														<div class='col-3'>
															<span scope='row'>".$contents['CONSOLE']."</span>
														</div>
														<div class='col-5'>
															<img src='".$contents['LOGO']."' alt='' height='90' width='70' class='mr-3'>
															<span>".$contents['TITLE']."</span>
														</div>
														<div class='col-2 text-right'>
															<span style='font-size:10px'>x</span>
															<span id='quantity' class='font-weight-bold'>".$contents['QUANTITY']."</span>
														</div>
														<div class='col-2 text-right'>
															<span>".$contents['PRICE']."€</span>
														</div>
													</div>";
									}
									
									echo	"	</div>";
									if($_SESSION['email'] == "admin@blockgame.com"){
										echo "<input type='button' name='submit' id=".$modify." class='form-submit modify' value='Modifica' onclick='window.location=".$link."'>";
									}
									echo 	"	<input type='button' name='submit' id=".$delete." class='form-submit delete' value='Elimina' onclick='deleteOrders(".$order['id'].")'/>
											</div>";
								}
								disconnect();
							?>
						</div>
					</div>
				</div>
				
				<?php
					if($_SESSION['email'] == "admin@blockgame.com"){
				?>
				<!---- Modal ADD Order ---->
				<div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body container-fom">
								<div class="content-form settings-form">
									<form method="POST" id="add-order-form" class="bckg-form" action="php/addOrder.php">
										<div class="form-group">
											<span>Email</span>
											<input type="email" class="form-input" name="email" id="email" maxlength="149" required/>
										</div>
										<div class="form-group">
											<span>Payment type ID</span>
											<input type="text" class="form-input" name="payment_type" id="payment_type" maxlength="11" required/>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" id="add_Order" class="form-submit modify" value="Inserisci ordine"/>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!---- Modal ADD Order ---->				
				<?php
					}
				?>
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
		<script type="text/javascript" src="js/orders.js"></script>
	</body>
</html>