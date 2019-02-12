<?php

include "db_helper.php";

connect();

$name = $_GET['name'];
$description = $_GET['description'];
$category = $_GET['category'];
$console = $_GET['console'];
$price = (int)$_GET['price'];
$quantity = (int)$_GET['quantity'];
$img =$_GET['img'];

//control if there isn't the product yet
$sql = "SELECT G.id,G.title,G.category,G.description FROM games AS G WHERE title='$name'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
$result = $prep->fetchAll(PDO::FETCH_ASSOC);
if($prep->rowCount() > 0){
	$sql = "UPDATE games SET category='$category',logo='$img',description='$description' WHERE title = '$name'";
	$prep = $GLOBALS['connection']->prepare($sql);
	$prep->execute();
	$result = $prep->fetchAll(PDO::FETCH_ASSOC);

		//get id of product
	$sql_idg = "SELECT id FROM games WHERE title ='$name'";
	$prep = $GLOBALS['connection']->prepare($sql_idg);
	$prep->execute();
	$row_idg = $prep->fetchAll(PDO::FETCH_ASSOC);
	$idg = (int)$row_idg[0]['id'];

	//get id of console
	$sql_idc = "SELECT id FROM console WHERE name ='$console'";
	$prep = $GLOBALS['connection']->prepare($sql_idc);
	$prep->execute();
	$row_idc = $prep->fetchAll(PDO::FETCH_ASSOC);
	$idc = (int)$row_idc[0]['id'];

	//control if the relationship already exist
	$sql = "SELECT id FROM videogames WHERE id_game = '$idg' AND id_console = '$idc'";
	$prep = $GLOBALS['connection']->prepare($sql);
	$prep->execute();
	$result = $prep->fetchAll(PDO::FETCH_ASSOC);
	if($prep->rowCount() > 0){
		$id_videogames = (int)$result[0]['id'];
		$sql = "UPDATE videogames (price,free_quantity) VALUES('$price','$quantity') WHERE id = '$id_videogames'";
		$prep = $GLOBALS['connection']->prepare($sql);
		$prep->execute();
		disconnect();
	}
	else{
		//create a logical relation between console and product
		$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$idg','$idc')";
		$prep = $GLOBALS['connection']->prepare($sql_relation);
		$prep->execute();
		disconnect();
	}
}
else{
	//insert new game
	$sql = "INSERT INTO games (title,category,logo,description) VALUES('$name','$category','$img','$description')";
	$prep = $GLOBALS['connection']->prepare($sql);
	$prep->execute();

	//get id of product
	$sql_idg = "SELECT id FROM games WHERE title ='$name'";
	$prep = $GLOBALS['connection']->prepare($sql_idg);
	$prep->execute();
	$row_idg = $prep->fetchAll(PDO::FETCH_ASSOC);
	$idg = (int)$row_idg[0]['id'];

	//get id of console
	$sql_idc = "SELECT id FROM console WHERE name ='$console'";
	$prep = $GLOBALS['connection']->prepare($sql_idc);
	$prep->execute();
	$row_idc = $prep->fetchAll(PDO::FETCH_ASSOC);
	$idc = (int)$row_idc[0]['id'];

	//control if the relationship already exist
	$sql = "SELECT id FROM videogames WHERE id_game = '$idg' AND id_console = '$idc'";
	$prep = $GLOBALS['connection']->prepare($sql);
	$prep->execute();
	$result = $prep->fetchAll(PDO::FETCH_ASSOC);

	if($prep->rowCount() > 0){
		$id_videogames = (int)$result[0]['id'];
		$sql = "UPDATE videogames (price,free_quantity) VALUES('$price','$quantity') WHERE ";
		$prep = $GLOBALS['connection']->prepare($sql);
		$prep->execute();
		disconnect();
	}
	else{
		//create a logical relation between console and product
		$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$idg','$idc')";
		$prep = $GLOBALS['connection']->prepare($sql_relation);
		$prep->execute();
		disconnect();
	}
}
?>
