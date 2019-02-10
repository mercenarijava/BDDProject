<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	include 'php/db_helper.php';							/* IMPORTANT DON'T DELETE */
	
	redirect_login_false(); 					/* IMPORTANT DON'T DELETE */
	
	connect();
	$result = getInfoUser($_SESSION['email']);
	$result_payment = getCreditCard($result['payment_type']);
	if($result_payment){
		$array = explode("-", $result_payment["expiration_date"]);
		$year = $array[0];
		$month = $array[1];
	}
	disconnect();
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
	</head>
	<body>
		
		<?php 
		/**
			IMPORTANT, DON'T DELETE or MODIFY.
		*/
		bckg_navbar(0);
		
		?>
		
		<!-- Settings -->
		<section class="general-form">
			<div class = "container">
				<div class = "title-page container-form">
					<h1>Settings</h1>
					<p>
						Here you find all your settings necessary for your account.
					</p>
				</div>
				<div class = "bckg-settings row">
					<!-- Navbar Settings -->
					<div class = "bckg-settings-nav col-sm-3">
						<ul class="nav flex-column nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="false">Info personali</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="option-payment-tab" data-toggle="tab" href="#option-payment" role="tab" aria-controls="option-payment" aria-selected="false">Opzioni di pagameto</a>
							</li>
						</ul>
					</div>
					<!-- Navbar Settings -->
					
					<!-- Content Settings -->
					<div class="tab-content bckg-settings-content col-sm-9" id="myTabContent" >
					
						<!-- Account Settings -->
						<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
							<div class="container-form">
								<div class="content-form settings-form">
									<form method="POST" id="account-form" class="bckg-form" action="php/settingsAccount.php">
										<div class="form-group">
											<span>Email:</span>
											<input type="email" class="form-input padlock" name="email" id="email" placeholder="<?php echo $result["username"]; ?>" value="<?php echo $result["username"]; ?>" readonly required/>
											<span toggle="#email" class="zmdi zmdi zmdi-lock-outline field-icon toggle-email-padlock" id="lock-outline" onClick="padlock('lock-outline','email')"></span>
										</div>
										<div class="form-group">
											<span>Password:</span>
											<input type="password" class="form-input padlock" name="password" id="password" placeholder="************" pattern=".{6,}" title="Six or more characters" readonly />
											<span toggle="#password" class="zmdi zmdi-eye-off field-icon toggle-password" style="margin-right:39px;" ></span>
											<span toggle="#password" class="zmdi zmdi zmdi-lock-outline field-icon toggle-password-padlock" id="lock-outline-password" onClick="padlock('lock-outline-password','password')"></span>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" id="submitAccount" class="form-submit settings-btn" value="Modifica account"/>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Account Settings -->
						
						<!-- Personal info Settings -->
						<div class="tab-pane fade" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
							<div class="container-form">
								<div class="content-form settings-form">
									<form method="post" id="personal-info-form" class="bckg-form" action="php/settingsInfo.php">
										<div class="form-group">
											<span>Name:</span>
											<input type="text" class="form-input padlock" name="name" id="name" placeholder="<?php echo $result["name"]; ?>" value="<?php echo $result["name"]; ?>" readonly required/>
											<span toggle="#name" class="zmdi zmdi zmdi-lock-outline field-icon toggle-name" id="lock-outline-name" onClick="padlock('lock-outline-name','name')"></span>
										</div>
										<div class="form-group">
											<span>Surname:</span>
											<input type="text" class="form-input padlock" name="surname" id="surname" placeholder="<?php echo $result["surname"]; ?>" value="<?php echo $result["surname"]; ?>" readonly required/>
											<span toggle="#surname" class="zmdi zmdi zmdi-lock-outline field-icon toggle-surname" id="lock-outline-surname" onClick="padlock('lock-outline-surname','surname')"></span>
										</div>
										<div class="form-group">
											<span>Address:</span>
											<input type="text" class="form-input padlock" name="address" id="address" placeholder="<?php echo $result["address"]; ?>" value="<?php echo $result["address"]; ?>" readonly required/>
											<span toggle="#address" class="zmdi zmdi zmdi-lock-outline field-icon toggle-address" id="lock-outline-address" onClick="padlock('lock-outline-address','address')"></span>
										</div>
										<div class="form-group">
											<span>Phone:</span>
											<input type="tel" class="form-input padlock" name="phone" id="phone" placeholder="<?php echo $result["phone"]; ?>" value="<?php echo $result["phone"]; ?>" pattern="[1-9]{1}[0-9]{9}" readonly required/>
											<span toggle="#phone" class="zmdi zmdi zmdi-lock-outline field-icon toggle-phone" id="lock-outline-phone" onClick="padlock('lock-outline-phone','phone')"></span>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" id="submitPersonalInfo" class="form-submit settings-btn" value="Modifica info"/>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Personal info Settings -->
						
						<!-- Option Payment Settings -->
						<div class="tab-pane fade" id="option-payment" role="tabpanel" aria-labelledby="option-payment-tab">
							<div class="container-form">
								<div class="content-form settings-form">
									<form id="pay-cards" class="bckg-form">
										<div class="form-group row bckg-head">
											<div>
												<span class="col-sm-4">Carta di credito</span>
												<span class="col-sm-4">Scandeza</span>
												<span class="col-sm-4">Titolare</span>
											</div>
										</div>
										<?php if($result_payment){?>
										<div class="form-group row option" onmouseover="blurElements('info1'); show('modify1','delete1');" onmouseout="notBlurElements('info1'); hide('modify1','delete1');">
											<div id="info1">
												<span class="col-sm-4"><?php echo $result_payment["key_payment"]; ?></span>
												<span class="col-sm-4"><?php echo $result_payment["expiration_date"]; ?></span>
												<span class="col-sm-4"><?php echo $result_payment["owner"]; ?></span>
											</div>
											<input type="button" name="submit" id="modify1" class="form-submit modify" value="Modifica" data-toggle="modal" data-target="#modifyCreditCardModal"/>
											<input type="button" name="submit" id="delete1" class="form-submit delete" value="Elimina" onClick="deletePaymentType(<?php echo $result['payment_type'].",'".$_SESSION['email']."'"; ?>)"/>
										</div>
										<?php  }else{ echo "Nessuna carta di credito salvata."; }?>
										<div class="form-group">
											<input type="button" name="submit" id="submitOptionPayment" class="form-submit settings-btn"  value="Aggiungi carta" data-toggle="modal" data-target="#addCreditCardModal"/>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Option Payment Settings -->
						
							<!---- Modal MODIFY Credit Card ---->
						<div class="modal fade" id="modifyCreditCardModal" tabindex="-1" role="dialog" aria-labelledby="modifyCreditCardModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body container-fom">
										<div class="content-form settings-form">
											<form method="POST" id="modify-credit-card-form" class="bckg-form" action="php/modifyCreditCard.php">
												<div class="form-group">
													<span>ID:</span>
													<input type="text" class="form-input" name="id" id="idModify" placeholder="<?php echo $result['payment_type']; ?>" value = "<?php echo $result['payment_type']; ?>" style="background-color: gainsboro;" readonly required/>
												</div>
												<div class="form-group">
													<span>Numero di carta:</span>
													<input type="text" class="form-input" name="number" id="numberModify" placeholder="<?php echo $result_payment["key_payment"]; ?>" value = "<?php echo $result_payment["key_payment"]; ?> "style="background-color: gainsboro;" readonly required/>
												</div>
												<div class="form-group">
													<span>Propietario:</span>
													<input type="text" class="form-input" name="owner" id="ownerModify" placeholder="<?php echo $result_payment["owner"]; ?>" value = "<?php echo $result_payment["owner"]; ?>" required/>
												</div>
												<div class="form-group">
													<div class="row ml-0">
														<span class="col-sm-12 pl-0">Data di scadenza:</span>
													</div>
													<div class="row ml-0">
														<input type="number" min="01" max="12" class="form-input col-sm-3 ml-0" maxlength="2" name="month" id="monthModify"  placeholder="<?php echo $month ?>" value="<?php echo $month ?>" required/>
														<span class="col-sm-1 ml-0">/</span>
														<input type="number" min="2019" max="2040" class="form-input col-sm-4 ml-0" maxlength="4" name="year" id="yearModify" placeholder="<?php echo $year ?>" value="<?php echo $year ?>" required/>
													</div>
												</div>
												<div class="form-group">
													<input type="submit" name="submit" id="modifyCreditCard" class="form-submit modify" value="Modifica"/>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!---- Modal MODIFY Credit Card ---->
						
							<!---- Modal ADD Credit Card ---->
						<div class="modal fade" id="addCreditCardModal" tabindex="-1" role="dialog" aria-labelledby="addCreditCardModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body container-fom">
										<div class="content-form settings-form">
											<form method="POST" id="add-credit-card-form" class="bckg-form" action="php/addCreditCard.php">
												<div class="form-group">
													<span>Propietario:</span>
													<input type="text" class="form-input" name="owner" id="name-surname"required/>
												</div>
												<div class="form-group">
													<span>Numero di carta:</span>
													<input type="text" class="form-input" pattern="[0-9]{16}" title="Il Numero di carta deve avere 26 numeri" name="cardNumber" id="cardNumber" required />
												</div>
												<div class="form-group">
													<span>CVV:</span>
													<input type="text" class="form-input" pattern="[0-9]{3}" title="Il CVV è composto di soli 3 numeri" name="cvv" id="cvv" required/>
													<a href="https://www.cvvnumber.com/cvv.html" target="_blank" style="font-size:11px">What is my CVV code?</a>
												</div>
												<div class="form-group">
													<div class="row ml-0">
														<span class="col-sm-12 pl-0">Data di scadenza:</span>
													</div>
													<div class="row ml-0">
														<input type="number" min="01" max="12" class="form-input col-sm-3 ml-0" maxlength="2" name="month" id="month"  required/>
														<span class="col-sm-1 ml-0">/</span>
														<input type="number" min="2019" max="2040" class="form-input col-sm-4 ml-0" maxlength="4" name="year" id="year" required/>
													</div>
												</div>
												<div class="form-group">
													<input type="submit" name="submit" id="addCreditCard" class="form-submit" value="Aggiungi"/>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!---- Modal ADD Credit Card ---->
						
						<!-- Option Payment Settings -->
						
					</div>
					<!-- Content Settings -->
				
				</div>
			</div>
		</section>
		<!-- Settings -->
		
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
		<script type="text/javascript" src="js/padlock.js"></script>
		<script type="text/javascript" src="js/settings.js"></script>
	</body>
</html>