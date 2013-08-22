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
            $this->db = new mysqli("reda.genderal.org", "boxnet", "whatsinside", "boxnet" );
            return var_dump($this->db);
        }
        
        function populate($pmethod = "random") {
            switch ($pmethod) {
                case "random":
                    
                    break;
            }
        }

	}



	$defaultitem = new Item();
    echo $defaultitem->connect();
	echo json_encode($defaultitem, JSON_NUMERIC_CHECK);
?>

