<?php

include "db_helper.php";

//set var
$var = $_GET["var"];

connect();
$sql = "SELECT G.id,G.title,G.category,G.description,V.price,V.free_quantity FROM games AS G, videogames AS V WHERE title='$var' AND G.id=V.id_game LIMIT 1";
$prep = $GLOBALS['connection']->prepare($sql);
$prep->execute();
$result = $prep->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
disconnect();
?>
