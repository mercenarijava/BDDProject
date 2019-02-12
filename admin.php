<?php
	include 'php/session.php';								/* IMPORTANT DON'T DELETE */
	include 'page_component/navbar.php';					/* IMPORTANT DON'T DELETE */
	include 'page_component/footer.php';					/* IMPORTANT DON'T DELETE */

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
	bckg_navbar(1);

	?>

	<section class="general-form">
		<div class="container title-page p-0">
			<h1 id="title">Admin</h1>
			<p>
				Search, modify, delete.
			</p>
			<hr style="border: 1px solid #fff; width: 100%;">
		</div>
  <!-- table -->
  <div class="row mt-5">
      <div class="container mt-5">
        <div class="row">

<!-- TABELLA UTENTI -->

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


<!-- TABELLA PRODOTTI -->


          <div class="col col-lg-6">

            <div class="input-group mb-3">
              <input type="text" id="textProduct" class="form-control" placeholder="Prodotto" aria-label="Recipient's username" aria-describedby="ricerca-utente">
              <div class="input-group-append">
                <button class="btn btn-login" id="ricerca-utente" onclick="findProductData();">Ricerca / +</buttom>
              </div>
            </div>

					<div id="tab_prodotti" style="display:none">
            <table class="table table-sm">
              <h3 class="mb-5">Prodotto:</h3>
              <tbody>
                <tr>
                  <th scope="row" class="pt-3">Nome prodotto</th>
                  <td><p class="pt-2">
                    <input type="text" class="form-control" id="nomeProdotto" aria-label="Username" aria-describedby="basic-addon1">
                  </p></td>
                </tr>
								<tr>
                    <th scope="row" class="pt-3">Descrizione</th>
                    <td><p class="pt-2">
                      <input type="text" class="form-control" id="descrizione" aria-label="Username" aria-describedby="basic-addon1">
                    </p></td>
                  </tr>
                <tr>
                  <th scope="row" class="pt-3">Categoria</th>
                  <td><p class="pt-2">
                    <input type="text" class="form-control" id="categoria" aria-label="Username" aria-describedby="basic-addon1">
                  </p></td>
                </tr>
                <tr>
                  <th scope="row" class="pt-3">Console</th>
                  <td><p class="pt-2">
<!--                   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                    <select class="custom-select" id="inputGroupSelect01" onchange="selectChanged(this)">

                    </select>
<!--                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                  </p></td>
                </tr>
                <tr>
                  <th scope="row" class="pt-3">Prezzo</th>
                  <td><p class="pt-2">
                    <input type="text" class="form-control" id="prezzo" aria-label="Username" aria-describedby="basic-addon1">
                  </p></td>
                </tr>
								<tr>
                    <th scope="row" class="pt-3">Quantità</th>
                    <td><p class="pt-2">
                      <input type="text" class="form-control" id="quantita" aria-label="Username" aria-describedby="basic-addon1">
                    </p></td>
                </tr>
                <tr>
                  <th scope="row" class="pt-3">Immagine copertina</th>
                  <td>
                    <form>
                      <div class="form-group pt-2">
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                      </div>
                    </form>
                  </td>
                </tr>

              </tbody>
            </table>
            <button name="button mr-3 mb-3" class="btn float-right mr-2 btn-verde" onclick="updateProduct();">Salva</button> <button name="button" id ="button_elimina_prodotto" onclick="deleteProduct();" class="btn float-right mr-2 mb-3 btn-verde">Elimina</button>
					</div>
          </div>

        </div>
      </div>

    </div>


		<div class="row">
			<div class="container">
				<div class="row mt-5">
					<div class="col col-lg-3">

					</div>
					<div class="col col-lg-6">

						<div class="input-group">
							<input type="text" class="form-control" id ="name_console" aria-label="Text input with segmented dropdown button" placeholder="Aggiungi console">
							<div class="input-group-append">
								<button type="button" onclick="addConsole();" class="btn btn-login">
										Aggiungi
								</button>
							</div>
						</div>

						<table class="table mt-5" id="tableConsole">
							<!-- <h3>Console Disponibili</h3> -->
							<thead class="thead-light">
								<tr>
									<th scope="col">Console Disponibili:</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

					</div>
					<div class="col col-lg-3">

					</div>
				</div>

				</div>

			</div>

	</section>







  <!-- Modal -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Impostazione Username -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>

          <!-- Impostazione Password -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">PS</span>
            </div>
            <input type="text" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-color" data-dismiss="modal">Entra</button>
        </div>
      </div>
    </div>
  </div>

  <?php
	/**
		IMPORTANT, DON'T DELETE or MODIFY.
	*/
	footer();

	?>


  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/logo.js"></script>
  <script type="text/javascript" src="js/admin_function.js"></script>
</body>
</html>
