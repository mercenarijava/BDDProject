<?php

include "db_helper.php";

connect();
//set var
$nome = $_GET['nome'];
$cognome = $_GET['cognome'];
$username = $_GET['usern'];
$indirizzo = $_GET['indirizzo'];
$cell = $_GET['cell'];
$pwd = $_GET['pwd'];
$old_username =$_GET['textUser'];

$sql = "UPDATE users SET name='$nome',surname='$cognome',address='$indirizzo',phone='$cell',username='$username',password='$pwd' WHERE username='$old_username'";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
disconnect();
?>
