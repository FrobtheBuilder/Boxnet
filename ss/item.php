<?php
	class Item {

		public $name;
		public $image;
		public $desc;
		public $value;
		public $nsfw;
        public $db;

		function __construct($pname = "default", $pimage = "default.jpg", 
			$pdesc = "this is a default object", $pvalue = 1, $pnsfw = 0) {
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
		
		function escape($pdb) {
		    $this->name = $pdb->escape_string($this->name);
			$this->image = $pdb->escape_string($this->image);
			$this->desc = $pdb->escape_string($this->desc);
		}
	}
?>