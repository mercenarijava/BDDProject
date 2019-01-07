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

connect();
$sql = "INSERT INTO users (name,surname,city,address,cap,piva,email,phone,username,password) VALUES ('$nome','$cognome','$citta',
'$indirizzo','$cap','$piva','$email','$cell','$username','$pwd')";
$result = $GLOBALS['connection']->query($sql);
disconnect();
?>
