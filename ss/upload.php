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

    function saveimage($pimage, $ppath) {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $pimage["name"]);
        $extension = end($temp);
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
                    move_uploaded_file($pimage["tmp_name"], $ppath . $pimage["name"]);
                    echo "Stored in: " . $ppath . $pimage["name"];
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
    
    if (saveimage($_FILES['image'], "../assets/img/item/")) {
        $item = new Item($_POST['name'], $_FILES['image']['name'], $_POST['desc'], $_POST['value'], (isset($_POST['nsfw']) && $_POST['nsfw']=="on") ? 1 : 0 );
        var_dump($item);
        echo "<br> <br>";
        if (write($item, connectdb(), "add")) {
            echo "Query Successful";
        }
        else {
            echo "Error in Query";
        }
    }
    
?>
