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
        
        function connect() {
            $this->db = new mysqli("localhost", $user["name"], $user["password"], "boxnet" );
        }
        
        function populate($pmethod = "random") {
            switch ($pmethod) {
                case "random":
                    $result = $this->db->query("select count(*) from items;");
                    var_dump($result);
                    //$count = $result->fetch_object()->
                    //$result->close();
                    
                    //$this->db->query("select * from items where id=");
                    break;
            }
        }

	}



	$defaultitem = new Item();
    $defaultitem->connect();
    $defaultitem->populate("random");
	echo json_encode($defaultitem, JSON_NUMERIC_CHECK);
?>

