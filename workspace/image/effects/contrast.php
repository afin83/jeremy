<?php
/*---------------------------------------------------------------------------*/
	
	class EffectContrast {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'strength'	=> 1
			));
			
			$query->acceptInteger('strength', '/^\-?[1-9][0-9]*$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			imagefilter($resource->image, IMG_FILTER_CONTRAST, $this->settings->strength);
		}
	}
	
/*---------------------------------------------------------------------------*/
?>