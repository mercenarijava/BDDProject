<?php

include "db_helper.php";

$id = $_GET['id'];

connect();
$sql = "DELETE FROM games_console WHERE id_game = '$id'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
$sql = "DELETE FROM games WHERE id = '$id'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
disconnect();
?>
