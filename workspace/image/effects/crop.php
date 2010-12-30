<?php
/*---------------------------------------------------------------------------*/
	
	class EffectCrop {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'bg'		=> 'ffffff',
				'width'		=> 0,
				'height'	=> 0,
				'xalign'	=> 'center',
				'yalign'	=> 'center'
			));
			
			$query->acceptString('bg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptInteger('width', '/^[1-9][0-9]*$/');
			$query->acceptInteger('height', '/^[1-9][0-9]*$/');
			$query->acceptString('xalign', '/^(left|center|right)$/');
			$query->acceptString('yalign', '/^(top|center|bottom)$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			$width = $this->settings->width;
			$height = $this->settings->height;
			
			// Find original dimensions:
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			if ($width < 1) $width = $imageWidth;
			if ($height < 1) $height = $imageHeight;
			
			$colour = new Colour($this->settings->bg);
			
			// Prepare new image:
			$new = imagecreatetruecolor($width, $height);
			$bg = $colour->allocate($new);
			imagefill($new, 0, 0, $bg);
			
			// Calculate X alignment:
			if ($this->settings->xalign == 'left') {
				$offsetX = 0;
				
			} else if ($this->settings->xalign == 'right') {
				$offsetX = round(
					min($imageWidth, $width)
					- max($imageWidth, $width)
				);
				
			} else {
				$xalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$xalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetX = round((
					min($imageWidth, $width)
					- max($imageWidth, $width)
				) / $xalign);
			}
			
			// Invert X:
			if ($imageWidth < $width) {
				$offsetX = 0 - $offsetX;
			}
			
			// Calculate Y alignment:
			if ($this->settings->yalign == 'top') {
				$offsetY = 0;
				
			} else if ($this->settings->yalign == 'bottom') {
				$offsetY = round(
					min($imageHeight, $height)
					- max($imageHeight, $height)
				);
								
			} else {
				$yalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$yalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetY = round((
					min($imageHeight, $height)
					- max($imageHeight, $height)
				) / $yalign);
			}
			
			// Invert Y:
			if ($imageHeight < $height) {
				$offsetY = 0 - $offsetY;
			}
			
			imagecopyresampled(
				$new, $resource->image,
				$offsetX, $offsetY, 0, 0,
				$imageWidth, $imageHeight,
				$imageWidth, $imageHeight
			);
			
			$resource->image = $new;
		}
	}
	
/*---------------------------------------------------------------------------*/
?>