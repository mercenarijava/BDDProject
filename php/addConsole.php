<?php

include "db_helper.php";

$name = $_GET['info'];

connect();
$q = "INSERT INTO console(name, model) VALUES('$name','$name')";
$prep = $GLOBALS['connection']->prepare($q);
$prep->execute();
disconnect();
?>
