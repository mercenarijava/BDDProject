<?php

include "db_helper.php";

$id = (int)$_GET['id'];
$name = $_GET['name'];
$description = $_GET['description'];
$category = $_GET['category'];
$console = $_GET['console'];
$price = $_GET['price'];
$quantity =$_GET['quantity'];
$img =$_GET['img'];

connect();
$sql = "UPDATE games SET title='$name',category='$category',logo='$img',description='$description' WHERE id = '$id'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
//get id of console
$sql_idc = "SELECT id FROM console WHERE name ='$console'";
$prep = $GLOBALS['connection']->prepare($sql_idc);
$prep->execute();
$row_idc = $prep->fetchAll(PDO::FETCH_ASSOC);
if($prep->rowCount()>0){
	$idc = (int)$row_idc[0]['id'];
	//control if the relationship already exist
	$sql = "SELECT id FROM videogames WHERE id_game = '$id' AND id_console = '$idc'";
	$prep = $GLOBALS['connection']->prepare($sql);
	$prep->execute();
	$result = $prep->fetchAll(PDO::FETCH_ASSOC);
	if($prep->rowCount() > 0){
		//set price and quantity
		$sql ="UPDATE videogames SET free_quantity='$quantity',price='$price' WHERE id_game='$id' AND id_console='$idc'";
		$prep = $GLOBALS['connection']->prepare($sql);
		$prep->execute();
		disconnect();
	}
	else{
		//create a logical relation between console and product
		$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$id','$idc')";
		$prep = $GLOBALS['connection']->prepare($sql_relation);
		$prep->execute();
		disconnect();
	}
}
?>
