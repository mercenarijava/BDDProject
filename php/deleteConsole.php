<?php

include "db_helper.php";

$id = $_GET['id'];

connect();
$sql = "DELETE FROM games_console WHERE id_console = '$id'";
$result = $GLOBALS['connection']->query($sql);
$sql = "DELETE FROM console WHERE id = '$id'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
