<?php
    $conn = pg_connect('postgres://lhfaeztmdritlk:196767882407a8320eeb5c75baa3a89ca95a1d8d491ce84db4c039565103be19@ec2-34-232-245-127.compute-1.amazonaws.com:5432/dbv1i1bscp30v3');
    
    if(!$conn){echo "Cannot to connect the datasbase";}
?>