<?php

	include 'db_helper.php';
	include 'session.php';

//set var
connect();
$nome = $_GET['nome'];
$cognome = $_GET['cognome'];
$username = $_GET['usern'];
$indirizzo = $_GET['indirizzo'];
$cell = $_GET['cell'];
$pwdn = $_GET['pwd'];

//control if there is an user with the same name
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $GLOBALS['connection']->query($sql);
if ($result->rowCount() > 0) {
		$pwd = crypt($pwdn,'$6$rounds=5000$blockgame$');
    $sql = "UPDATE users SET name='$nome',surname='$cognome',address='$indirizzo',phone='$cell',password='$pwd' WHERE username='$username'";
		$prep = $GLOBALS['connection']->prepare($sql);
		$prep->execute();
}
//insert the new user
else{
  	$pwd = crypt($pwdn,'$6$rounds=5000$blockgame$');
    $sql = "INSERT INTO users (name,surname,address,phone,username,password) VALUES ('$nome','$cognome','$indirizzo','$cell','$username','$pwd')";
		$prep = $GLOBALS['connection']->prepare($sql);
		$prep->execute();
    disconnect();
}
?>
