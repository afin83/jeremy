<?php
/*---------------------------------------------------------------------------*/
	
	class Query {
		private $queries;
		private $results;
		
		public function __construct($queries = array(), $defaults = array()) {
			$this->queries = $queries;
			$this->results = $defaults;
		}
		
		public function acceptString($name, $expression) {
			$accept = $this->accept($name, $expression);
			
			if ($accept !== false) $this->results[$name] = $accept;
		}
		
		public function acceptInteger($name, $expression) {
			$accept = $this->accept($name, $expression);
			
			if ($accept !== false) $this->results[$name] = (int)$accept;
		}
		
		public function acceptFloat($name, $expression) {
			$accept = $this->accept($name, $expression);
			
			if ($accept !== false) $this->results[$name] = (float)$accept;
		}
		
		public function acceptBoolean($name, $expression) {
			$accept = $this->accept($name, $expression);
			
			if ($accept !== false) {
				switch(strtolower($accept)) {
					case "true":
					case "yes":
					case "on":
					case "1":
						$this->results[$name] = true; break;
					default:
						$this->results[$name] = false; break;
				}
			}
		}
		
		private function accept($name, $expression) {
			if (!array_key_exists($name, $this->queries)) return false;
			
			if (preg_match($expression, (string)$this->queries[$name])) {
				return $this->queries[$name];
			}
			
			return false;
		}
		
		public function results() {
			return (object)$this->results;
		}
	}
	
/*---------------------------------------------------------------------------*/
?>