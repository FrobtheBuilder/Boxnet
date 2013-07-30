<?php
	header("Content-Type: application/json");

	class Item {

		public $name;
		public $image;
		public $desc;
		public $value;
		public $nsfw;

		function __construct($pname = "default", $pimage = "default.jpg", 
								$pdesc = "this is a default object", $pvalue = 1, $pnsfw = false) {
			$this->name = $pname;
			$this->image = $pimage;
			$this->desc = $pdesc;
			$this->value = $pvalue;
			$this->nsfw = $pnsfw;
		}

	}



	$defaultitem = new Item();
	echo json_encode($defaultitem, JSON_NUMERIC_CHECK);
?>