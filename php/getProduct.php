<?php

include "db_helper.php";

//set var
$var = $_GET["var"];

connect();
$sql = "SELECT id,title,category,price,description,free_quantity FROM games WHERE title='$var'";
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
