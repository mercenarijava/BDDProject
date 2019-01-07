<?php

include "db_helper.php";

$name = $_GET['info'];

connect();
$q = "INSERT INTO console(name, model) VALUES('$name','$name')";
$res = $GLOBALS['connection']->query($q);
disconnect();
?>
