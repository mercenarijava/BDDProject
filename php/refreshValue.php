<?php
    include "db_helper.php";
    $id_prodotto = (int)$_GET["id_prodotto"];
    $console = $_GET["console"];
    $sql = "SELECT id FROM console WHERE name='$console'";
    connect();
    $result_idc = $GLOBALS['connection']->query($sql);
    $row_idc = $result_idc->fetch_assoc();
    $idc = (int)$row_idc['id'];
    $sql ="SELECT price,free_quantity FROM videogames WHERE id_game = '$id_prodotto' AND id_console = '$idc'";
    $result = $GLOBALS['connection']->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
        disconnect();
    }
    else{
        echo json_encode('');
        disconnect();
    }
?>