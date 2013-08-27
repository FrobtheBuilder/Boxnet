<?php
    require "auth.php";
    header("Content-Type: application/json");

	class Item {

		public $name;
		public $image;
		public $desc;
		public $value;
		public $nsfw;
        public $db;

		function __construct($pname = "default", $pimage = "default.jpg", 
			$pdesc = "this is a default object", $pvalue = 1, $pnsfw = false) {
			$this->name = $pname;
			$this->image = $pimage;
			$this->desc = $pdesc;
			$this->value = $pvalue;
			$this->nsfw = $pnsfw;
		}
        
        function set($pobject) {
			$this->name = $pobject->name;
			$this->image = $pobject->image;
			$this->desc = $pobject->desc;
			$this->value = $pobject->value;
			$this->nsfw = $pobject->nsfw;
		}
	}

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

    $returnitem = populate(new Item(), connectdb(), "random");
	echo json_encode($returnitem);
?>