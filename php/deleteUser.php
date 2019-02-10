<?php

include "db_helper.php";

connect();
$username = $_GET['info'];

$sql = "DELETE FROM users WHERE username = '$username'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
