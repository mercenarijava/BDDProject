<?php

include "db_helper.php";

$username = $_GET['info'];

connect();
$sql = "DELETE FROM users WHERE username = '$username'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
