<?php
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */
	include 'php/usersList.php';							/* IMPORTANT DON'T DELETE */
	
	redirect_login_false();									/* IMPORTANT DON'T DELETE */
	redirect_admin_false();									/* IMPORTANT DON'T DELETE */
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BlockGame</title>
  <link rel="icon" href="logo/logo-icon-a.png" type="image/png" sizes="16x16">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/video.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/login-signin.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300i,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body onload="tableThread();">


  <?php 
	/**
		IMPORTANT, DON'T DELETE or MODIFY.
	*/
	bckg_navbar(0);
	
	?>

	<section class="general-form">
		<div class="container">
			<div class="title-page p-0">
				<h1 id="title">Users</h1>
				<p>
					Search, modify, delete users.
				</p>
				<hr style="border: 1px solid #fff; width: 100%;">
			</div>
			
			<!-- Ricerca UTENTI -->
			<div class="row">
				<div class="col col-lg-6">
					<div class="input-group mb-3">
					  <input type="text" id="textUser" class="form-control" placeholder="Username" aria-label="Recipient's username" aria-describedby="ricerca-utente">
					  <div class="input-group-append">
						<button class="btn btn-login" id="ricerca-utente" onclick="findUserData();">Ricerca / +</buttom>
					  </div>
					</div>

					<div id="tab_utenti" style="display:none">
						<table class="table table-sm">
						  <h3 class="mb-5">Dati utente:</h3>
						  <tbody>
							<tr>
							  <th scope="row" class="pt-3">Nome</th>
							  <td><p class="pt-2">
								<input type="text" class="form-control" name="nome" id="nome" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
							<tr>
							  <th scope="row" class="pt-3">Cognome</th>
							  <td><p class="pt-2">
								<input type="text" class="form-control" name="cognome" id="cognome" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
							<tr>
							  <th scope="row" class="pt-3">Username</th>
							  <td><p class="pt-2">
								<input type="text" class="form-control" name="username" id="username" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
							<tr>
							  <th scope="row" class="pt-3">Indirizzo</th>
							  <td><p class="pt-2">
							  <input type="text" class="form-control" name="indirizzo" id="indirizzo" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
							<tr>
							  <th scope="row" class="pt-3">Cellulare</th>
							  <td><p class="pt-2">
								  <input type="text" class="form-control" name="cell" id="cell" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
							<tr>
							  <th scope="row" class="pt-3">Password</th>
							  <td><p class="pt-2">
							  <input type="text" class="form-control" name="pwd" id="pwd" aria-label="Username" aria-describedby="basic-addon1">
							  </p></td>
							</tr>
						  </tbody>
						</table>
						<button name="button mr-3" onclick="updateUser();" class="btn float-right mr-2 btn-verde">Salva</button> <button name="button" id ="button_elimina_utente" onclick="deleteUser();" class="btn float-right mr-2 btn-verde">Elimina</button>
					</div>
				</div>
			
			</div>
		
		
			<!-- USERS TABLE -->
			<div class = "bckg-form content-form content-orders bckg-settings-content">
				<div class="table-responsive-md">					
					<table class="table table-striped" style="color:#000">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Name</th>
								<th scope="col">Surname</th>
								<th scope="col">Address</th>
								<th scope="col">Phone</th>
							</tr>
						</thead>
						<tbody>
							<?php
							createList(); 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
  <?php 
	/**
		IMPORTANT, DON'T DELETE or MODIFY.
	*/
	footer();
	
	?>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/logo.js"></script>
  <script type="text/javascript" src="js/admin_function.js"></script>
</body>
</html>
