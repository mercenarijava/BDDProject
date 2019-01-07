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
$sql = "UPDATE games SET title='$name',price='$price',
free_quantity='$quantity',category='$category',logo='$img',description='$description' WHERE id = '$id'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
