<?php
    require "auth.php";
    require "item.php";
    require "db.php";
    
    echo ("Name: ".$_POST['name']."<br> Description: ".$_POST['desc']."<br> Value: ".$_POST["value"]."<br>");
    if (isset($_POST["nsfw"]) && $_POST["nsfw"]=="on") {
        echo "Item is NSFW";
    }
    else {
        echo "Item is worksafe";
    }
    echo "<br><br>";

    /**
     * Saves an image to a folder
     * 
     * @return boolean true on success, false on fail
     * @param image $pimage the image 
     * @param string $ppath the path to the folder, don't forget the trailing slash
     */ 
    function saveimage($pname, $pimage, $ppath) {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $pimage["name"]);
        $extension = end($temp);
        $filename = $pname . "." . $extension;
        if ((($pimage["type"] == "image/gif")
            || ($pimage["type"] == "image/jpeg")
            || ($pimage["type"] == "image/jpg")
            || ($pimage["type"] == "image/pjpeg")
            || ($pimage["type"] == "image/x-png")
            || ($pimage["type"] == "image/png"))
            && ($pimage["size"] < 90000000)
            && in_array($extension, $allowedExts)) {
                
            if ($pimage["error"] > 0) {
                echo "Return Code: " . $pimage["error"] . "<br>";
                return false;
            }
            else {
                echo "Upload: " . $pimage["name"] . "<br>";
                echo "Type: " . $pimage["type"] . "<br>";
                echo "Size: " . ($pimage["size"] / 1024) . " kB<br>";
                echo "Temp file: " . $pimage["tmp_name"] . "<br>";
                        
                if (file_exists($ppath . $pimage["name"])) {
                    echo $pimage["name"] . " already exists. ";
                    return false;
                }
                else {
                    move_uploaded_file($pimage["tmp_name"], $ppath . $filename);
                    echo "Stored in: " . $ppath . $filename;
                    return true;
                }
            }
        }
        else {
            echo "<b>Invalid file</b> <br>".
            "Type: ".$pimage['type'].
            "<br> Size: ".($pimage['size'] / 1024)." kB".
            "<br> and that's no good!";
            
            return false;
        }
    }
    
    
    function checkinput($ptarget) {
        $retval = true;
        /*
        if ( gettype($ptarget['value']) != "integer" ) {
            $retval = false;
            echo "<b>rarity isn't an integer!</b>";
        }*/
        if ( strlen($ptarget['name']) > 20 || strlen($ptarget["desc"]) > 500 ) {
            $retval = false;
            echo "<b>Name longer than 20 characters or description longer than 500 characters!</b>";
        }
        return $retval;
    }
    
    
    if (saveimage($_POST['name'], $_FILES['image'], "../assets/img/item/") && checkinput($_POST)) {
        
        $item = new Item($_POST['name'], 
                            $_POST['name'] . "." . end(explode(".", $_FILES['image']['name'])), 
                            $_POST['desc'], 
                            $_POST['value'], 
                            (isset($_POST['nsfw']) && $_POST['nsfw']=="on") ? 1 : 0 );
                            
        var_dump($item);
        echo "<br> <br>";
        if (write($item, connectdb(), "add")) {
            echo "Query Successful";
        }
        else {
            echo "Error in Query";
        }
    }
    echo '<br> <br> <a href="../index.html">Return</a>';
    
?>
