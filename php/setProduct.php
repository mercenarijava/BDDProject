<?php

include "db_helper.php";

$id = $_GET['id'];
$name = $_GET['name'];
$description = $_GET['description'];
$category = $_GET['category'];
$console = $_GET['console'];
$price = $_GET['price'];
$quantity =$_GET['quantity'];
$img =$_GET['img'];

connect();
$sql = "UPDATE games SET title='$name',category='$category',logo='$img',description='$description' WHERE id = '$id'";
$result = $GLOBALS['connection']->query($sql);
//get id of console
$sql_idc = "SELECT id FROM console WHERE name ='$console'";
$result_idc = $GLOBALS['connection']->query($sql_idc);
$row_idc = $result_idc->fetch_assoc();
$idc = (int) $row_idc['id'];

//control if the relationship already exist
$sql = "SELECT id FROM videogames WHERE id_game = '$id' AND id_console = '$idc'";
$result = $GLOBALS['connection']->query($sql);
if($result->num_rows > 0){
	//set price and quantity
	$sql ="UPDATE videogames SET free_quantity='$quantity',price='$price' WHERE id_game='$id' AND id_console='$idc'";
	$result = $GLOBALS['connection']->query($sql);
	disconnect();
}
else{
	//create a logical relation between console and product
	$sql_relation = "INSERT INTO videogames (price,free_quantity,id_game,id_console) VALUES('$price','$quantity','$id','$idc')";
	$result_relation = $GLOBALS['connection']->query($sql_relation);
	disconnect();
}
?>
