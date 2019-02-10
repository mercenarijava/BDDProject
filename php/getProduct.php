<?php

include "db_helper.php";

//set var
$var = $_GET["var"];

connect();
$sql = "SELECT G.id,G.title,G.category,G.description,V.price,V.free_quantity FROM games AS G, videogames AS V WHERE title='$var' AND G.id=V.id_game LIMIT 1";
$result = $GLOBALS['connection']->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo json_encode($row);
  }
  disconnect();
}
else {
	echo json_encode("");
  disconnect();
}
?>
