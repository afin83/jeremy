<?php
/*---------------------------------------------------------------------------*/
	
	class EffectShadow {
		private $settings;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'bg'		=> 'aaaaaa',
				'radius'	=> 10,
				'colour'	=> '000000',
				'xoffset'	=> 25,
				'yoffset'	=> 50
			));
			
			$query->acceptString('bg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptInteger('radius', '/^[1-9][0-9]*$/');
			$query->acceptString('shadow', '/^([0-9a-f]{3}|[0-9a-f]{6})$/');
			$query->acceptInteger('xoffset', '/^[1-9][0-9]*$/');
			$query->acceptInteger('yoffset', '/^[1-9][0-9]*$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			if ($this->settings->xoffset < 0) {
				$xextra = 0 - $this->settings->xoffset;
			} else {
				$xextra = $this->settings->xoffset;
			}
			
			if ($this->settings->yoffset < 0) {
				$yextra = 0 - $this->settings->yoffset;
			} else {
				$yextra = $this->settings->yoffset;
			}
			
			$image = (object)array(
				'width'		=> imagesx($resource->image) + $this->settings->radius + $xextra,
				'height'	=> imagesy($resource->image) + $this->settings->radius + $yextra
			);
			
			$shadow = (object)array(
				'top'		=> round(($image->height - imagesx($resource->image) + $this->settings->yoffset) / 2),
				'left'		=> round(($image->width - imagesx($resource->image) + $this->settings->xoffset) / 2),
				'width'		=> imagesx($resource->image) - 1,
				'height'	=> imagesy($resource->image) - 1
			);
			
			$source = (object)array(
				'top'		=> round(($image->height - imagesy($resource->image)) / 2),
				'left'		=> round(($image->width - imagesx($resource->image)) / 2),
				'width'		=> imagesx($resource->image),
				'height'	=> imagesy($resource->image)
			);
			
			//var_dump($shadow);
			//exit;
			
			$new = imagecreatetruecolor($image->width, $image->height);
			
			$colour = new Colour($this->settings->bg);
			$bg = $colour->allocate($new);
			imagefill($new, 0, 0, $bg);
			
			$colour = new Colour($this->settings->colour);
			$fg = $colour->allocate($new);
			imagefilledrectangle(
				$new, $shadow->left, $shadow->top,
				$shadow->left + $shadow->width,
				$shadow->top + $shadow->height, $fg
			);
			
			$times = 0;
			while (++$times != $this->settings->radius) {
				//imagefilter($new, IMG_FILTER_GAUSSIAN_BLUR);
			}
			
			imagecopyresampled(
				$new, $resource->image,
				$source->left, $source->top, 0, 0,
				$source->width, $source->height,
				$source->width, $source->height
			);
			
			$resource->image = $new;
		}
	}
	
/*---------------------------------------------------------------------------*/
?>