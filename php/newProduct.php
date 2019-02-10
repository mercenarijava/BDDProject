<?php

include "db_helper.php";

connect();

$name = $_GET['name'];
$description = $_GET['description'];
$category = $_GET['category'];
$console = $_GET['console'];
$price = $_GET['price'];
$quantity =$_GET['quantity'];
$img =$_GET['img'];

//control if there isn't the product yet
$sql = "SELECT G.id,G.title,G.category,G.description,V.price,V.free_quantity FROM games AS G WHERE title='$name'";
$result = $GLOBALS['connection']->query($sql);
if($result->num_rows > 0){
	$sql = "UPDATE games SET category='$category',logo='$img',description='$description' WHERE title = '$name'";
	$result = $GLOBALS['connection']->query($sql);
	
		//get id of product
	$sql_idg = "SELECT id FROM games WHERE title ='$name'";
	$result_idg = $GLOBALS['connection']->query($sql_idg);
	$row_idg = $result_idg->fetch_assoc();
	$idg = (int)$row_idg['id'];

	//get id of console
	$sql_idc = "SELECT id FROM console WHERE name ='$console'";
	$result_idc = $GLOBALS['connection']->query($sql_idc);
	$row_idc = $result_idc->fetch_assoc();
	$idc = (int)$row_idc['id'];
	
	//control if the relationship already exist
	$sql = "SELECT id FROM videogames WHERE id_game = '$idg' AND id_console = '$idc'";
	$result = $GLOBALS['connection']->query($sql);
	
	if($result->num_rows > 0){
		$sql = "UPDATE videogames (price,free_quantity) VALUES('$price','$quantity')";
		$result = $GLOBALS['connection']->query($sql);
		disconnect();
	}
	else{
		//create a logical relation between console and product
		$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$idg','$idc')";
		$result_relation = $GLOBALS['connection']->query($sql_relation);
		disconnect();
	}
}
else{
	//insert new game
	$sql = "INSERT INTO games (title,category,logo,description) VALUES('$name','$category','$img','$description')";
	$result = $GLOBALS['connection']->query($sql);

	//get id of product
	$sql_idg = "SELECT id FROM games WHERE title ='$name'";
	$result_idg = $GLOBALS['connection']->query($sql_idg);
	$row_idg = $result_idg->fetch_assoc();
	$idg = (int)$row_idg['id'];

	//get id of console
	$sql_idc = "SELECT id FROM console WHERE name ='$console'";
	$result_idc = $GLOBALS['connection']->query($sql_idc);
	$row_idc = $result_idc->fetch_assoc();
	$idc = (int)$row_idc['id'];
	
	//control if the relationship already exist
	$sql = "SELECT id FROM videogames WHERE id_game = '$idg' AND id_console = '$idc'";
	$result = $GLOBALS['connection']->query($sql);
	
	if($result->num_rows > 0){
		$sql = "UPDATE videogames (price,free_quantity) VALUES('$price','$quantity')";
		$result = $GLOBALS['connection']->query($sql);
		disconnect();
	}
	else{
		//create a logical relation between console and product
		$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$idg','$idc')";
		$result_relation = $GLOBALS['connection']->query($sql_relation);
		disconnect();
	}
}
?>