<?php 
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	
	redirect_login_true(); /* IMPORTANT DON'T DELETE */
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
		
		<!-- Register -->
		<section class="general-form background-transparent">
            <div class="fullbackground-img">
				<img src="img/battlefield-1-1.jpg"></img>
            </div>
			<div class="container-form">
				<h1>Create account</h1>
				<p>
                        Have already an account ? <a href="login.php" class="footer-link ">Login here</a>
                </p>
                <div class="content-form">
                    <form method="POST" id="signup-form" class="bckg-form" action="php/register.php">
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" required/>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-input" name="surname" id="surname" placeholder="Your Surname" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" pattern=".{6,}" title="Six or more characters" required/>
                            <span toggle="#password" class="zmdi zmdi-eye-off field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="confirm_password" id="confirm_password" placeholder="Repeat your password" required/>
							<span class="zmdi field-icon" id="message"></span>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-input" name="address" id="address" placeholder="Your address" required/>
                        </div>
						<div class="form-group">
                            <input type="tel" class="form-input" name="phone" id="phone" placeholder="Your phone number" pattern="[1-9]{1}[0-9]{9}" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>
		<!-- Register -->
		
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
		<script src="js/check_password.js"></script>
	</body>
</html>