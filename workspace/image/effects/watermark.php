<?php
/*---------------------------------------------------------------------------*/
	
	class EffectWatermark {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'file'		=> '',
				'margin'	=> 0,
				'xalign'	=> 'center',
				'yalign'	=> 'center'
			));
			
			$query->acceptString('file', '/.+$/');
			$query->acceptInteger('margin', '/^[0-9]+$/');
			$query->acceptString('xalign', '/^(left|center|right)$/');
			$query->acceptString('yalign', '/^(top|center|bottom)$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			// Find original dimensions:
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			$image = imagecreatefromfile($this->settings->file);
			imagesavealpha($image, true);
			imagesavealpha($resource->image, true);
			
			$width = imagesx($image);
			$height = imagesy($image);
			$margin = $this->settings->margin;
			
			// Calculate X alignment:
			if ($this->settings->xalign == 'left') {
				$offsetX = $margin;
				
			} else if ($this->settings->xalign == 'right') {
				$offsetX = round(
					max($imageWidth, $width)
					- min($imageWidth, $width)
				) - $margin;
				
			} else {
				$xalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$xalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetX = 0 - round((
					min($imageWidth, $width)
					- max($imageWidth, $width)
				) / $xalign);
			}
			
			// Calculate Y alignment:
			if ($this->settings->yalign == 'top') {
				$offsetY = $margin;
				
			} else if ($this->settings->yalign == 'bottom') {
				$offsetY = round(
					max($imageHeight, $height)
					- min($imageHeight, $height)
				) - $margin;
								
			} else {
				$yalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$yalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetY = 0 - round((
					min($imageHeight, $height)
					- max($imageHeight, $height)
				) / $yalign);
			}
			
			imagecopyresampled(
				$resource->image, $image,
				$offsetX, $offsetY, 0, 0,
				$width, $height,
				$width, $height
			);
		}
	}
	
/*---------------------------------------------------------------------------*/
?>