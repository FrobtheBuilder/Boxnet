<?php
    function connectdb() {
        global $user;
        $db = new mysqli($user["host"], $user["name"], $user["password"], $user["database"] );
        return $db;
    }
    
    function populate($pitem, $pdb, $pmethod) {
        $result = $pdb->query("select count(*) from items;");
        $rowcount = (int) $result->fetch_assoc()['count(*)'];
        $result->close();
            
        switch ($pmethod) {
            case "random":
                $randrow = rand(1, $rowcount);
                    
                $result = $pdb->query("select * from items where id=$randrow;");
                $resultobject = $result->fetch_object();
                $result->close();
                    
                $pitem->set($resultobject);
                
                break;
        }
        return $pitem;
    }
    
    function write($pitem, $pdb, $pmethod) {
        switch ($pmethod) {
            case "add":
                echo "insert into `items`(`name`, `image`, `desc`, `value`, `nsfw`) 
                                values ('$pitem->name', '$pitem->image', '$pitem->desc', $pitem->value, $pitem->nsfw)";
                return $pdb->query("insert into `items`(`name`, `image`, `desc`, `value`, `nsfw`) 
                                values ('$pitem->name', '$pitem->image', '$pitem->desc', $pitem->value, $pitem->nsfw)");

                break;
        }
    }
?>