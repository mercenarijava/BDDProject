<?php

include "db_helper.php";

//set var
$var = $_GET["var"];

connect();
$sql = "SELECT * FROM users WHERE username='$var'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
$result = $prep->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
disconnect();
?>
