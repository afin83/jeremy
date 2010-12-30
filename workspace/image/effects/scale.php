<?php
/*---------------------------------------------------------------------------*/
	
	class EffectScale {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'bg'		=> 'ffffff',
				'width'		=> 0,
				'height'	=> 0,
				'trim'		=> false,
				'xalign'	=> 'center',
				'yalign'	=> 'center'
			));
			
			$query->acceptString('bg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptInteger('width', '/^[1-9][0-9]*$/');
			$query->acceptInteger('height', '/^[1-9][0-9]*$/');
			$query->acceptBoolean('trim', '/.*/');
			$query->acceptString('xalign', '/^(left|center|right|[0-9]+)$/');
			$query->acceptString('yalign', '/^(top|center|bottom|[0-9]+)$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			$width = $this->settings->width;
			$height = $this->settings->height;
			
			// Find original dimensions:
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			// Find ratios:
			if ($width > 0 and $height > 0) {
				$ratioX = ($imageWidth / $width);
				$ratioY = ($imageHeight / $height);
				
			} else if ($width > 0) {
				$ratioX = ($imageWidth / $width);
				$height = round($imageHeight / $ratioX);
				$ratioY = $ratioX;
				
			} else if ($height > 0) {
				$ratioY = ($imageHeight / $height);
				$width = round($imageWidth / $ratioY);
				$ratioX = $ratioY;
			}
			
			$colour = new Colour($this->settings->bg);
			
			// Prepare new image:
			$new = imagecreatetruecolor($width, $height);
			$bg = $colour->allocate($new);
			imagefill($new, 0, 0, $bg);
			
			// Fit:
			if (!$this->settings->trim) {
				if ($ratioX > $ratioY) {
					$ratio = $ratioX;
				} else {
					$ratio = $ratioY;
				}
				
			// Trim:
			} else {
				if ($ratioX < $ratioY) {
					$ratio = $ratioX;
				} else {
					$ratio = $ratioY;
				}
			}
			
			// Find dimensions:
			$newWidth = round($imageWidth / $ratio);
			$newHeight = round($imageHeight / $ratio);
			
			// Calculate X alignment:
			if ($this->settings->xalign == 'left') {
				$offsetX = 0;
				
			} else if ($this->settings->xalign == 'right') {
				$offsetX = round(
					min($newWidth, $width)
					- max($newWidth, $width)
				);
				
			} else {
				$xalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$xalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetX = round((
					min($newWidth, $width)
					- max($newWidth, $width)
				) / $xalign);
			}
			
			// Invert X:
			if ($newWidth < $width) {
				$offsetX = 0 - $offsetX;
			}
			
			// Calculate Y alignment:
			if ($this->settings->yalign == 'top') {
				$offsetY = 0;
				
			} else if ($this->settings->yalign == 'bottom') {
				$offsetY = round(
					min($newHeight, $height)
					- max($newHeight, $height)
				);
				
			} else {
				$yalign = 2;
				
				if (is_numeric($this->settings->yalign)) {
					$yalign = (integer)$this->settings->yalign / 25;
				}
				
				$offsetY = round((
					min($newHeight, $height)
					- max($newHeight, $height)
				) / $yalign);
			}
			
			// Invert Y:
			if ($newHeight < $height) {
				$offsetY = 0 - $offsetY;
			}
			
			imagecopyresampled(
				$new, $resource->image,
				$offsetX, $offsetY, 0, 0,
				$newWidth, $newHeight,
				$imageWidth, $imageHeight
			);
			
			$resource->image = $new;
		}
	}

/*---------------------------------------------------------------------------*/
?>