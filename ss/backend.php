<?php
    require "auth.php";
    require "item.php";
    require "db.php";
    header("Content-Type: application/json");
    



    $returnitem = populate(new Item(), connectdb(), "random");
	echo json_encode($returnitem);
?>