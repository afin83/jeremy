<?php
/*---------------------------------------------------------------------------*/
	
	class EffectTile {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'xtimes'	=> 1,
				'ytimes'	=> 1
			));
			
			$query->acceptInteger('xtimes', '/^[1-9][0-9]*$/');
			$query->acceptInteger('ytimes', '/^[1-9][0-9]*$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			$width = $imageWidth * $this->settings->xtimes;
			$height = $imageHeight * $this->settings->xtimes;
			
			$new = imagecreatetruecolor($width, $height);
			
			imagesettile($new, $resource->image);
			imagefill($new, 0, 0, IMG_COLOR_TILED);
			
			$resource->image = $new;
		}
	}
	
/*---------------------------------------------------------------------------*/
?>