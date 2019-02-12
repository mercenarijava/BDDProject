<?php
    include "db_helper.php";
    $id_prodotto = (int)$_GET["id_prodotto"];
    $console = $_GET["console"];
    $sql = "SELECT id FROM console WHERE name='$console'";
    connect();
    $prep = $GLOBALS['connection']->prepare($sql);
  	$prep->execute();
  	$row_idc = $prep->fetchAll(PDO::FETCH_ASSOC);
    if($prep->rowCount()>0){
      $idc = (int)$row_idc[0]['id'];
      $sql ="SELECT price,free_quantity FROM videogames WHERE id_game = '$id_prodotto' AND id_console = '$idc'";
      $prep = $GLOBALS['connection']->prepare($sql);
    	$prep->execute();
    	$result = $prep->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
    }
    else echo json_encode("");

?>
