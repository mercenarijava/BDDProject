<?php

include "db_helper.php";

//set var
$nome = $_GET['nome'];
$cognome = $_GET['cognome'];
$username = $_GET['usern'];
$indirizzo = $_GET['indirizzo'];
$citta = $_GET['citta'];
$cap = $_GET['cap'];
$cell = $_GET['cell'];
$piva = $_GET['piva'];
$email = $_GET['mail'];
$pwd = $_GET['pwd'];
$old_username =$_GET['textUser'];

connect();
$sql = "UPDATE users SET name='$nome',surname='$cognome',
city='$citta',address='$indirizzo',cap='$cap',piva='$piva',
email='$email',phone='$cell',username='$username',
password='$pwd' WHERE username='$old_username'";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
