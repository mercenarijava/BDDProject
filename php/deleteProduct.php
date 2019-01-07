<?php

include "db_helper.php";

$id = $_GET['id'];

connect();
$sql = "DELETE FROM games_console WHERE id_game = '$id'";
$result = $GLOBALS['connection']->query($sql);
$sql = "DELETE FROM games WHERE id = '$id'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
