<?php
/*---------------------------------------------------------------------------*/
	
	class EffectBlur {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'strength'	=> 1
			));
			
			$query->acceptInteger('strength', '/^[1-9][0-9]*$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			$times = 0;
			
			while (++$times != $this->settings->strength) {
				imagefilter($resource->image, IMG_FILTER_GAUSSIAN_BLUR);
			}
		}
	}
	
/*---------------------------------------------------------------------------*/
?>