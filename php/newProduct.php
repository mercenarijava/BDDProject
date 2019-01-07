<?php

include "db_helper.php";

$name = $_GET['name'];
$description = $_GET['description'];
$category = $_GET['category'];
$console = $_GET['console'];
$price = $_GET['price'];
$quantity =$_GET['quantity'];
$img =$_GET['img'];

connect();
  //insert new game
$sql = "INSERT INTO games (title,price,free_quantity,category,logo,description) VALUES('$name','$price',
'$quantity','$category','$img','$description')";
$result = $GLOBALS['connection']->query($sql);

 //get id of product
$sql_idg = "SELECT id FROM games WHERE title ='$name'";
$result_idg = $GLOBALS['connection']->query($sql_idg);
$row_idg = $result_idg->fetch_assoc();
$idg = (int) $row_idg['id'];

   //get id of console
$sql_idc = "SELECT id FROM console WHERE name ='$console'";
$result_idc = $GLOBALS['connection']->query($sql_idc);
$row_idc = $result_idc->fetch_assoc();
$idc = (int) $row_idc['id'];

   //create a logical relation between console and product
$sql_relation = "INSERT INTO games_console (id_game,id_console) VALUES ('$idg','$idc')";
$result_relation = $GLOBALS['connection']->query($sql_relation);
disconnect();
?>
