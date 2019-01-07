<?php
	/**
		Print the footer on the page.
		
		IMPORTANT DON'T DELETE!!
	*/
	function footer(){
	echo
	'<!-- Footer -->
		<footer class="page-footer" >
			<!-- Footer Links -->
			<div class="container footer-container text-center text-md-left mt-5">

				<!-- Grid row -->
				<div class="row mt-3">

					<!-- Payment methods column -->
					<div class="payment-methods col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

						<!-- Content -->
						<h6 class="text-uppercase font-weight-bold">Payment methods</h6>
						<hr class="deep mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
						<p>
							<object data="icon/paypal-1.svg" type="image/svg+xml">
								Paypal
							</object>
						</p>
						<p>
							<object data="icon/visa.svg" type="image/svg+xml">
								Visa
							</object>
						</p>
						<p>
							<object data="icon/mastercard.svg" type="image/svg+xml">
								Mastercard
							</object>
						</p>
						<p>
							<object data="icon/american-express.svg" type="image/svg+xml">
								American Express
							</object>
						</p>

					</div>
					<!-- Payment methods column -->

					<!-- Products column -->
					<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

						<!-- Products Links -->
						<h6 class="text-uppercase font-weight-bold">Products</h6>
						<hr class="deep mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
						<p>
							<a href="home.php?console=PC">PC</a>
						</p>
						<p>
							<a href="home.php?console=XBOX">XBOX</a>
						</p>
						<p>
							<a href="home.php?console=PS4">Playstation 4</a>
						</p>
						<p>
							<a href="home.php?console=PS3">Playstation 3</a>
						</p>
						<p>
							<a href="home.php?console=Nintendo">Nintendo</a>
						</p>

					</div>
					<!-- Products column -->

					<!-- Users column -->
					<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

						<!-- Useful Links -->
						<h6 class="text-uppercase font-weight-bold">Users</h6>
						<hr class="deep mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
						'.
						((isset($_SESSION["email"]))
						?'
						<p>
							<a href="settings.php">Your Account</a>
						</p>
						<p>
							<a href="orders.php">Orders</a>
						</p>'
						:'
						<p>
							<a href="login.php">Your Account</a>
						</p>
						<p>
							<a href="register.php">Register</a>
						</p>'
						).'
						<p>
							<a href="help.php">Help</a>
						</p>

					</div>
					<!-- Users column -->

					<!-- Contact column -->
					<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

						<!-- Links -->
						<h6 class="text-uppercase font-weight-bold">Contact</h6>
						<hr class="deep mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
						<p>
							<i class="fa fa-home mr-3"></i><a href="https://goo.gl/maps/JpXq9vGSghG2" target="_blank">Via Torino 153, 30172 Venezia - IT</a></p>
						<p>
							<i class="fa fa-envelope mr-3"></i><a href="mailto:info@blockgame.com">info@blockgame.com</a></p>
						<p>
							<i class="fa fa-phone mr-3"></i> +39 041 234 8519</p>
						<p>
							<i class="fa fa-print mr-3"></i> +39 041 234 8520</p>

					</div>
					<!-- Contact column -->

				</div>
				<!-- Grid row -->

			</div>
			<!-- Footer Links -->

			<!-- Copyright -->
			<div class="footer-copyright text-center py-3">© 2018 
			  <a href=""> BlockGame</a>
			</div>
			<!-- Copyright -->

		  </footer>
		<!-- Footer -->';
	}
?>