<?php

    /**
     * Connects to a mysql database
     * 
     * @return mysqli the mysqli connection
     */
    function connectdb() {
        global $user;
        $db = new mysqli($user["host"], $user["name"], $user["password"], $user["database"] );
        return $db;
    }
    
    /** 
     * Populates an item object from a mysqli connection
     * 
     * @return The newly populated item, or false on error
     * 
     * @param Item $pitem the item to populate
     * @param mysqli $pdb the database to populate from
     * @param string $pmethod the way to do it
     * @param $pparam any parameters that the given method may require
     */
    function populate($pitem, $pdb, $pmethod, $pparam = null) {
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
                
            case "id":
                if ($pparam > $rowcount) {
                    return false;
                }
                $result = $pdb->query("select * from items where id=$pparam;");
                $resultobject = $result->fetch_object();
                $result->close();
                    
                $pitem->set($resultobject);
                
        }
        return $pitem;
    }
    
    /** 
     * writes an item object to the mysqli connection
     * 
     * @return boolean true on success false otherwise
     * 
     * @param Item $pitem the item to write
     * @param mysqli $pdb the database to write to
     * @param string $pmethod the way to do it
     */
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