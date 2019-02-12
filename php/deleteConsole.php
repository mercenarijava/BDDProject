<?php

include "db_helper.php";

$id = $_GET['id'];

connect();
$sql = "DELETE FROM games_console WHERE id_console = '$id'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
$sql = "DELETE FROM console WHERE id = '$id'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
disconnect();
?>
