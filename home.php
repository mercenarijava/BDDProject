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
		<link rel="stylesheet" href="css/video.css">
		<link rel="stylesheet" href="css/login-signin.css">
	</head>
	<body>
	
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		bckg_navbar(1);
		
		?>
		
		<?php if(!isset($_GET["console"])){ ?>
		<!-- VIDEO -->
		<div class="video-header wrap" id="home-video">
			<div class="fullscreen-video-wrap">
				<video src="video/Battlefield1.mp4" autoplay muted loop></video>
			</div>
			<div class="header-overlay">
				<div class="header-content">
					<div class="game-card">
						<div class="card-head">
							<!-- BACKGROUND IMG -->
						</div>
						<div class="card-body-">
						  <div class="product-desc">
							<span class="product-title">
									Battlefield 1
									<span class="badge">
									  New
									</span>
							</span>
							<span class="product-caption">
									Categoria
								  </span>
							<span class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star grey"></i>
								  </span>
						  </div>
						  <div class="product-properties">
							<span class="product-size">
									<h4>Console</h4>
									<ul class="ul-size">
									  <li><a href="#"><img src="img/x360.jpg" alt=""> </a></li>
									  <li><a href="#"><img src="img/ps3.jpg" alt=""> </a></li>
									  <li><a href="#"><img src="img/ps4.jpg" alt=""> </a></li>
									  <li><a href="#"><img src="img/nintendo.jpg" alt=""> </a></li>
									  <li><a href="#"><img src="img/switch.jpg" alt=""> </a></li>
									</ul>
								  </span>

							<button class="product-price" >
									€<b>50,45</b>
								  </button>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<a class="btn arrow-icon" data-target="#shop">
				<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fas" data-icon="angle-down" class="svg-inline--fa fa-angle-down fa-w-10" role="img" viewBox="0 0 320 512">
					<path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/>
				</svg>
			</a>
		</div>
		<!-- VIDEO -->
		<?php } ?>
		
		<!-- SHOP -->
		<section class="section section-a" id="shop">
			<div class="container" style="max-width:1300px">
				<div class="row justify-content-end title-page general-form p-0 pb-5">
					<div class="col-sm-9">
						<?php 
							if(isset($_GET["console"])){
								switch ($_GET["console"]){ 
									case "switch":
										echo '<h1 id="title"><span style="color:#cd7f32;">PC</span> games</h1>';
										break;
									case "xboxone":
										echo '<h1 id="title"><span style="color:#1dc11d;">XBOX</span> games</h1>';
										break;
									case "ps4":
										echo '<h1 id="title"><span style="color:#0072ce;">PS4</span> games</h1>';
										break;
									case "ps3":
										echo '<h1 id="title"><span style="color:#02beec;">PS3</span> games</h1>';
										break;
									case "nintendo":
										echo '<h1 id="title"><span style="color:#ff2c2c;">Nintendo</span> games</h1>';
										break;
									default:
										echo '<h1 id="title">Shop your games</h1>';
										break;
								}
							}
							else{
								echo '<h1 id="title">Shop your games</h1>';
							}
						?>
						<p>
							Find the best games of the moment  
						</p>
						<hr style="border: 1px solid #fff; width: 100%;">
					</div>
				</div>
				
				<!-- FILTER ,GAMES -->
				<div class="row justify-content-center">
					<!-- Filter -->
					<div class="general-form col-sm shop-menu restrict">
						<div class="filtri">
							<h4>Filtra per:</h4>
							<h6>Console</h6>
							<?php
							function console_filter_default(){
								echo '
							<label class="radio-container">PC
								<input type="radio" name="console" value="pc" id="c_pc">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">XBOX
								<input type="radio" name="console" value="xbox" id="c_xboxone">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">PS4
								<input type="radio" name="console" value="ps4" id="c_ps4">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">PS3
								<input type="radio" name="console" value="ps3" id="c_ps3">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Nintendo
								<input type="radio" name="console" value="nintendo" id="c_nintendo">
								<span class="checkmark"></span>
							</label>';
							}
							
							if(!isset($_GET["console"])){
								console_filter_default();
							}
							if(isset($_GET["console"])){
								switch ($_GET["console"]){ 
									case "switch":
										echo '<label class="radio-container">PC
												<input type="radio" name="console" value="pc" id="c_pc" checked>
												<span class="checkmark"></span>
											</label>';
										break;
									case "xboxone":
										echo '<label class="radio-container">XBOX
												<input type="radio" name="console" value="xbox" id="c_xboxone" checked>
												<span class="checkmark"></span>
											</label>';
										break;
									case "ps4":
										echo '<label class="radio-container">PS4
												<input type="radio" name="console" value="ps4" id="c_ps4" checked>
												<span class="checkmark"></span>
											</label>';
										break;
									case "ps3":
										echo '<label class="radio-container">PS3
												<input type="radio" name="console" value="ps3" id="c_ps3" checked>
												<span class="checkmark"></span>
											</label>';
										break;
									case "nintendo":
										echo '<label class="radio-container">Nintendo
												<input type="radio" name="console" value="nintendo" id="c_nintendo" checked>
												<span class="checkmark"></span>
											</label>';
										break;
									default:
										console_filter_default();
										break;
										
								}
							}
							?>
							<h6>Categoria</h6>
							<label class="radio-container">Azione
								<input type="radio" name="categoria" value="azione" id="c_action">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Guida
								<input type="radio" name="categoria" value="guida" id="c_guida">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Guerra
								<input type="radio" name="categoria" value="guerra" id="c_picchiaduro">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Simulazione
								<input type="radio" name="categoria" value="simulazione" id="c_simulazione">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Sport
								<input type="radio" name="categoria" value="sport" id="c_sport">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Strategia
								<input type="radio" name="categoria" value="strategia" id="c_strategia">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="ordina">
							<h4>Ordina per:</h4>
							<h6>Prezzo</h6>
							<label class="radio-container">Crescente
								<input type="radio" name="ordine" checked="checked" value=true id="c_prezzo_crescente">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Decrescente
								<input type="radio" name="ordine" value=falso id="c_prezzo_decrescente">
								<span class="checkmark"></span>
							</label>
							<h6>Alfabetico</h6>
							<label class="radio-container">A-Z
								<input type="radio" name="ordine" value=true id="c_AZ">
								<span class="checkmark"></span>
							</label>
							<label class="radio-container">Z-A
								<input type="radio" name="ordine" value=falso id="c_ZA">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="bckg-form">
							<input type="button" name="submit" id="b_applica_filtro" class="form-submit btn-filter" value="Applica"/>
						</div>
					</div>
					<!-- Filter -->
					
					<!-- GAMES -->
					<div class="col-sm row justify-content-center" id="cards_container">

						
					</div>
					<!-- GAMES -->
				</div>
				<!-- FILTER ,GAMES -->
				
				<!-- PAGINATION -->
				<nav class="mt-5 bckg-page-navigation" aria-label="Page navigation">
					<ul id="pageStepper" class="pagination justify-content-center pt-4">
						<li class="page-item">
							<a class="page-link bckg-page-link" href="#shop" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
							</li>
							<li class="page-item active"><a class="page-link bckg-page-link" href="#shop">1</a></li>
							<li class="page-item"><a class="page-link bckg-page-link" href="#shop">2</a></li>
							<li class="page-item"><a class="page-link bckg-page-link" href="#shop">3</a></li>
							<li class="page-item">
							<a class="page-link bckg-page-link" href="#shop" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
				<!-- PAGINATION -->
			</div>
		</section>
		<!-- SHOP -->
		
		
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
		<script type="text/javascript" src="js/blur.js"></script>
		<script type="text/javascript" src="js/video.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>