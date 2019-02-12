<?php

include "db_helper.php";

connect();
$username = $_GET['info'];

$sql = "DELETE FROM users WHERE username = '$username'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
disconnect();
?>
