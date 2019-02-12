<?php

include "db_helper.php";

$info = $_GET['info'];

connect();
if($info == '*'){
  $sql = "SELECT name, id from console";
  $prep = $GLOBALS['connection']->prepare($sql);
  $prep->execute();
  $result = $prep->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($result);
  disconnect();
}
else{
  $sql = "SELECT C.name FROM console as C, games as G, games_console as GC WHERE C.id = GC.id_console AND G.id = GC.id_game AND G.title ='$info'";
  $result = $GLOBALS['connection']->query($sql);
  $prep = $GLOBALS['connection']->prepare($sql);
  $prep->execute();
  $result = $prep->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($result);
  disconnect();
}
?>
