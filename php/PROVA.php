<?php
	include 'db_helper.php';
	include 'session.php';
    connect();
	
	$sql_get_orders = "SELECT id, date FROM orders WHERE username_user = 'lamar@gmail.com'";
	$sql_get_contents = "SELECT g.logo AS LOGO, g.title AS TITLE, k.name AS CONSOLE, c.quantity AS QUANTITY, c.quantity*v.price AS PRICE 
FROM contents c INNER JOIN videogames v ON v.id = c.id_videogame INNER JOIN games g ON g.id = v.id_game INNER JOIN console k ON k.id = v.id_console WHERE c.id_order = '%s';";
	
	$result = $GLOBALS['connection']->query($sql_get_orders);
	
	while($order = mysqli_fetch_array($result)) { 
		echo 	"<div class='bckg-row row py-2 my-4' onmouseover='blurElements('info".$order['id']."'); showSingleElem('delete".$order['id']."');' onmouseout='notBlurElements('info".$order['id']."'); hideSingleElem('delete".$order['id']."')'>
					<div id='info".$order['id']."' style='width:100%'>
						<div class='row mx-0 py-2'>
							<span class='col'>Date: ".$order['date']."</span>
							<span class='col' style='text-align: -webkit-right;'>orders_id: ".$order['id']."</span>
							<hr style='border: 1px solid #000; width: 100%;'>
						</div>";
									
		$sql_contets = sprintf($GLOBALS['sql_get_contents'], $order['id']);
		$result_contents = $GLOBALS['connection']->query($sql_contets);
		
		while($contents = mysqli_fetch_array($result_contents)){
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
								<span>".$contents['PRICE']."</span>
							</div>
						</div>";
		}
		
		echo	"	</div>
					<input type='button' name='submit' id='".$order['id']."' class='form-submit delete' value='Elimina'/>
				</div>";
	}
	disconnect();
?>