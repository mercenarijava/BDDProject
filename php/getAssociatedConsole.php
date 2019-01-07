<?php

include "db_helper.php";

$info = $_GET['info'];

connect();
if($info == '*'){
  $sql = "SELECT name, id from console";
  $result = $GLOBALS['connection']->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
    disconnect();
 }
 disconnect();
}
else{
  $sql = "SELECT C.name FROM console as C, games as G, games_console as GC WHERE C.id = GC.id_console AND G.id = GC.id_game AND G.title ='$info'";
  $result = $GLOBALS['connection']->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
    disconnect();
 }
 disconnect();
}
disconnect();
?>
