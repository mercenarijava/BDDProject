<?php
	/**
		INFORMATION:
			
			This file contains all the functions needed to create
			the navigation bar of the blockgame site.
		
		IMPORTANT:	
			DON'T MODIFY or DELETE function.
	*/

	/**
		Return PAGES link for the navbar bckg only for HOME-PAGE.
		
		@return: string;
	*/
	function pages_home_navbar(){
		$home="";
		$pc="";
		$xbox="";
		$ps4="";
		$ps3="";
		$nintendo="";
		if(!isset($_GET["console"])){ 
			$home = "active"; 
		}
		else{
			switch ($_GET["console"]){ 
				case "switch":
					$pc = "active";
					break;
				case "xboxone":
					$xbox = "active";
					break;
				case "ps4":
					$ps4 = "active";
					break;
				case "ps3":
					$ps3 = "active";
					break;
				case "nintendo":
					$nintendo = "active";
					break;
				default:
					$home = "active";
					break;
			}
		}
		return 
				'<!-- PAGES -->
				<ul class="navbar-nav pr-3 mt-2 mt-lg-0">
					<li class="nav-item '.$home.'" id="home">
						<a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item '.$pc.'" id="pc">
						<a class="nav-link" href="home.php?console=switch">Switch</a>
					</li>
					<li class="nav-item '.$xbox.'" id="xbox">
						<a class="nav-link" href="home.php?console=xboxone">XBOX</a>
					</li>
					<li class="nav-item '.$ps4.'" id="ps4" >
						<a class="nav-link" href="home.php?console=ps4">PS4</a>
					</li>
					<li class="nav-item '.$ps3.'" id="ps3">
						<a class="nav-link" href="home.php?console=ps3">PS3</a>
					</li>
					<li class="nav-item '.$nintendo.'" id="nintendo">
						<a class="nav-link" href="home.php?console=nintendo">Nintendo</a>
					</li>
				</ul>
				<!-- PAGES -->';
	}
	
	/**
		Return PAGES link for the navbar bckg.
		
		@return: string;
	*/
	function pages_navbar(){
		return 
		'<!-- Pages -->
		<ul class="navbar-nav pr-3 mt-2 mt-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="home.php?console=switch">Switch</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="home.php?console=xboxone">XBOX</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="home.php?console=ps4">PS4</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="home.php?console=ps3">PS3</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="home.php?console=nintendo">Nintendo</a>
			</li>
		</ul>
		<!-- Pages -->';
	}

	
	/**
		Return SEARCH for the navbar bckg.
		
		@return: string;
	*/
	function search_navbar(){
		return	'<!-- Search -->
				<div class="form-inline mr-auto bckg-form-container-size my-lg-0">
					<input class="form-control bckg-input-search" type="search" placeholder="GAMES" id="input_search">
					<button class="btn bckg-btn my-2 my-sm-0" id="btn_search">
						<object data="icon/search2.svg" type="image/svg+xml">
							Search
						</object>
					</button>
				</div>
				<!-- Search -->';
	}
	
	
	/**
		Return the login and register or the account menu.
		
		@return: string;
	*/
	function login_register_or_account(){
		return  (isset($_SESSION["email"]))
				?'
				<!-- Account -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Account
					</a>
					<div class="dropdown-menu dropdown-account" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="orders.php">Ordini</a>
						<a class="dropdown-item" href="settings.php">Impostazioni</a>
						'.(($_SESSION["email"] == "admin@blockgame.com")
						?'
						<a class="dropdown-item" href="admin.php">Admin</a>
						':''
						).'
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="php/logout.php">Exit</a>
					</div>
				</li>
				<!-- Account -->
				':'<!-- Login, Register -->
				<li class="nav-item nav-item-login mb-auto">
					<a class="btn login-btn nav-link my-2 my-sm-0" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
				</li>
				<!-- Login, Register -->';
	}
	
	
	/**
		Return the shopping cart link/menu.
		
		@return: string;
	*/
	function shopping_cart(){
		$href="'shopping-cart.php'";
		return 
				'<!-- ShoppingChart -->
				<li class="nav-item dropdown dropdown-visible" onClick="window.location.href='.$href.'">
					<a class="nav-link" data-target="#ShoppingChart" href="#shopping-cart.php" id="shopping-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

					</a>
					<div class="dropdown-menu dropdown-account dropdown-shop" aria-labelledby="shopping-cart">

						<div id="viewChartButton" class="row mx-0 my-3">
							<div class="col">
								<a class = "btn viewShop" href="shopping-cart.php">View cart</a>
							</div>
						</div>
					</div>
				</li>
				<!-- ShoppingChart -->';
	}
	
	
	
	/**
		Complete the right part of navbar wich include Login, Register, Account, ShoppingChart.
		
		@return: string, the right part of navbar;
	*/
	function login_register_or_account_and_shopping_cart(){
		return '
		<!-- Login, Register, Account, ShoppingChart -->
		<ul class="navbar-nav mt-2 mt-lg-0">
			'.login_register_or_account().''.
			shopping_cart().'
		</ul>
		<!-- Login, Register, Account, ShoppingChart -->';
	}


	/**
		Print the BCKG navigation bar on the page.
		
		@home: specific '1' for home-page '0' for other page; 
	*/
	function bckg_navbar($home){
	echo 
	'<!-- NAVBAR -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark bckg-navbar">			
		<a class="navbar-brand bckg-navbar-brand" href="home.php">
			<img src="logo/logo-esteso.png" alt="BlockGame" id="logo">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			'.(($home)?pages_home_navbar():pages_navbar()).'
			'.search_navbar().'
			'.login_register_or_account_and_shopping_cart().'
		</div>
	</nav>
	<!-- NAVBAR -->';
	
	}
	
?>