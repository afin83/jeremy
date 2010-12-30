<?php
/*---------------------------------------------------------------------------*/
	
	class Filter {
		public $date = 0;
		public $file = null;
		
		public function __construct($query) {
			$file = "./filters/{$query->filter}.php";
			
			if (is_readable($file)) {
				$this->date = filemtime($file);
				$this->file = $file;
			}
		}
		
		public function apply($image) {
			if ($this->file) {
				include_once($this->file);
			}
		}
	}
	
/*---------------------------------------------------------------------------*/
	
	function __autoload($class) {
		if (preg_match('/^effect/i', $class)) {
			$file = strtolower(substr($class, 6));
			
			require_once("./effects/{$file}.php");
		}
	}
	
/*---------------------------------------------------------------------------*/
?>