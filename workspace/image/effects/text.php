<?php
/*---------------------------------------------------------------------------*/
	
	class EffectText {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'bg'		=> 'ffffff',
				'fg'		=> '00000000',
				'font'		=> '',
				'size'		=> 10,
				'text'		=> '',
				'margin'	=> 0,
				'padding'	=> 1,
				'xalign'	=> 'center',
				'yalign'	=> 'center'
			));
			
			$query->acceptString('bg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptString('fg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptString('font', '/.+$/');
			$query->acceptInteger('size', '/^[1-9][0-9]*$/');
			$query->acceptString('text', '/.+$/');
			$query->acceptInteger('margin', '/^[0-9]+$/');
			$query->acceptInteger('padding', '/^[1-9][0-9]*$/');
			$query->acceptString('xalign', '/^(left|center|right)$/');
			$query->acceptString('yalign', '/^(top|center|bottom)$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			// Find original dimensions:
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			$fontbox = imageftbbox(
				$this->settings->size, 0,
				realpath($this->settings->font),
				$this->settings->text
			);
			
			$width = $fontbox[4] - $fontbox[6];
			$width += $this->settings->padding * 2;
			$height = $fontbox[1] - $fontbox[7];
			$height += $this->settings->padding * 2;
			
			$image = imagecreatetruecolor($width, $height);
			
			$bg = new Colour($this->settings->bg);
			$fg = new Colour($this->settings->fg);
			$bg = $bg->allocate($image);
			$fg = $fg->allocate($image);
			
			imagesavealpha($image, true);
			imagesavealpha($resource->image, true);
			imagefill($image, 0, 0, $bg);
			
			imagefttext(
				$image, $this->settings->size, 0,
				$this->settings->padding,
				$this->settings->size + $this->settings->padding,
				$fg, realpath($this->settings->font),
				$this->settings->text
			);
			
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
				$offsetX = 0 - round((
					min($imageWidth, $width)
					- max($imageWidth, $width)
				) / 2);
			}
			
			// Invert X:
			//if ($imageWidth < $width) {
			//	$offsetX = 0 - $offsetX;
			//}
			
			// Calculate Y alignment:
			if ($this->settings->yalign == 'top') {
				$offsetY = $margin;
				
			} else if ($this->settings->yalign == 'bottom') {
				$offsetY = round(
					max($imageHeight, $height)
					- min($imageHeight, $height)
				) - $margin;
								
			} else {
				$offsetY = 0 - round((
					min($imageHeight, $height)
					- max($imageHeight, $height)
				) / 2);
			}
			
			// Invert Y:
			//if ($imageHeight < $height) {
			//	$offsetY = 0 - $offsetY;
			//}
			
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