<?php
session_start();
    include_once("connection.php");
    $minId = pg_query($conn, "select min(ProID) from public.product");
    $maxId = pg_query($conn, "select max(ProID) from public.product");
    if(!$minId || !$maxId){
        echo "error" .$minId .$maxId;
    }
    $ramId = rand($minId, $maxId);
    $_SESSION[$Id] = $ramId;
?>
