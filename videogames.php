<?php
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	include 'php/db_helper.php';							/* IMPORTANT DON'T DELETE */
	
	redirect_login_false();									/* IMPORTANT DON'T DELETE */
	redirect_admin_false();									/* IMPORTANT DON'T DELETE */
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
					<h1>Videogames</h1>
					<p>
						Here you find all videogames.
					</p>
				</div>
				<div class = "bckg-form content-form content-orders bckg-settings-content">
					<div class="bckg-table-body option pr-0">
							<div class="settings-form bckg-form row">
								<div class="col" align="right">
									<input class="form-control bckg-input-search" type="search" placeholder="Search..." id="videogameSearch" style="position:relative; background-color: #ffffff; border: 1px solid;" onkeyup="filterVideogames();">
								</div>
							</div>						
					</div>
					<!-- USERS TABLE -->
					<div class="table-responsive-md">					
						<table class="table table-striped" style="color:#000" id="videogameTable">
							<thead>
								<tr>
									<th scope="col">id_videogames</th>
									<th scope="col">Logo</th>
									<th scope="col">Title</th>
									<th scope="col">Console</th>
									<th scope="col">Price</th>
									<th scope="col">Free quantity</th>
								</tr>
							</thead>
							<tbody id="videogameTable">
								<?php
									connect();
									
									$videogames_list = getVideogames(); 
									
									if ($videogames_list) {
										while($videogame = mysqli_fetch_assoc($videogames_list)){
											
											echo "<tr>
												  <td>".$videogame['videogame_id']."</td>
												  <td><img src='".$videogame['LOGO']."' alt='' height='90' width='70' class='mr-3'></td>
												  <td>".$videogame['TITLE']."</td>
												  <td>".$videogame['CONSOLE']."</td>
												  <td>".$videogame['PRICE']."€</td>
												  <td>".$videogame['QUANTITY']."</td>
												</tr>";
										}		
									}
									disconnect();
								?>
							</tbody>
						</table>
					</div>
					<!-- USERS TABLE -->
				</div>
			</div>
		</section>
		
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