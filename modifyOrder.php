<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'php/db_helper.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	
	redirect_login_false(); 								/* IMPORTANT DON'T DELETE */
	redirect_admin_false();									/* IMPORTANT DON'T DELETE */
	
	if(!isset($_GET['orderId'])){
		header("Location: ./");
	}
	connect();
	
	$order = getOrdersById($_GET['orderId']);
	$allContents = getContentsByOrderId($order['id']);
	$max_id_videogame = getMaxIdVideogame();
	$min_id_videogame = getMinIdVideogame();
	
	$videogames_quantity = getVideogames();
	$max_quantity = array();
	while($videogame = mysqli_fetch_array($videogames_quantity)){
		$max_quantity[$videogame['videogame_id']] = $videogame['QUANTITY'];
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
					echo	"<h1><a href='orders.php' class='footer-link'>Orders</a>/Order_ID: ".$order['id']."</h1>
							<p>
								Modify order contents or <a href='orders.php' class='footer-link'> GO BACK...</a>
							</p>";
					?>
				</div>
				<div class = "bckg-form content-form content-orders bckg-settings-content">
					<div class="bckg-table table-striped">
						<div class="bckg-table-body option" style="padding:0px">
							<div class='settings-form bckg-form row'>
								<div class='col'>
									<input type='button' name='addOrder' id='addContent' class='form-submit settings-btn' value='Inserisci contenuto' data-toggle='modal' data-target='#addContentModal' style='position:relative; right:0px; width:unset;'/>
								</div>
								<div class='col' align="right">
									<h6><a href='videogames.php' target="_blank">Videogame list --> </a></h6>
								</div>
							</div>
						</div>
						<div class="bckg-table-body option">
							<?php
									$username = "<span class='col' style='text-align: -webkit-center;'>".$order['username_user']."</span>";
													
									while($contents = mysqli_fetch_array($allContents)){
										$info = '"info'.$contents['videogame_id'].'"';
										$delete = '"delete'.$contents['videogame_id'].'"';
										
										echo 	"<div class='bckg-row row py-2 my-4' onmouseover='blurElements(".$info."); showSingleElem(".$delete.");' onmouseout='notBlurElements(".$info."); hideSingleElem(".$delete.")' style='background-color: #ebebeb;'>
											<div id=".$info." style='width:100%'>";
										echo "<div class='row mx-0 py-2'>
														<span class='col'>videogame_id: ".$contents['videogame_id']."</span>
														<hr style='border: 1px solid #000; width: 100%;'>
													</div>";
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
										echo	"</div>
											<input type='button' name='submit' id=".$delete." class='form-submit delete' value='Elimina' onclick='deleteContent(".$contents['videogame_id'].",".$order['id'].",".$contents['QUANTITY'].")'/>
										</div>";
									}
								disconnect();
							?>
						</div>
					</div>
				</div>
			</div>
			
			<!---- Modal ADD Content ---->
				<div class="modal fade" id="addContentModal" tabindex="-1" role="dialog" aria-labelledby="addContentModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body container-fom">
								<div class="content-form settings-form">
									<form method="POST" id="add-content-form" class="bckg-form" action="php/addContent.php">
										<div class="form-group">
											<span>order_id</span>
											<input type="number" class="form-input" name="order_id" id="order_id"  value="<?php echo $order['id']; ?>" readonly="readonly"/>
										</div>
										<div class="form-group">
											<span>ID Videogame</span>
											<input type="number" class="form-input" name="videogame_id" id="videogame_id" min="<?php echo $min_id_videogame; ?>" max="<?php echo $max_id_videogame; ?>" oninput="setQuantity(this.value)" required/>
										</div>
										<div class="form-group">
											<span>Quantity</span>
											<input type="number" class="form-input" name="quantity" id="quantity" min="" max="" required/>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" id="add_content" class="form-submit modify" value="Inserisci contenuto"/>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!---- Modal ADD Content ---->
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
		<script type="text/javascript" src="js/videogameQuantity.js"></script>
	</body>
</html>