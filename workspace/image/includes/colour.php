<?php
/*---------------------------------------------------------------------------*/
	
	class Colour {
		private $red = 0;
		private $green = 0;
		private $blue = 0;
		private $alpha = 0;
		
		public function __construct($colour) {
			// Find colour values:
			if (
				strlen($colour) == 6
				or strlen($colour) == 8
			) {
				$rgb = str_split($colour, 2);
				
			} else {
				$rgb = str_split($colour, 1);
			}
			
			// Turn to RGB values:
			foreach ($rgb as $index => $colour) {
				$rgb[$index] = hexdec(str_pad($colour, 2, 'f'));
			}
			
			$this->red = $rgb[0];
			$this->green = $rgb[1];
			$this->blue = $rgb[2];
			
			if (@$rgb[3]) {
				$this->alpha = floor($rgb[3] / 2);
			}
		}
		
		public function red() {
			return $this->red;
		}
		
		public function green() {
			return $this->green;
		}
		
		public function blue() {
			return $this->blue;
		}
		
		public function alpha() {
			return $this->alpha;
		}
		
		public function allocate($image) {
			return imagecolorallocatealpha(
				$image, $this->red, $this->green,
				$this->blue, $this->alpha
			);
		}
	}

/*---------------------------------------------------------------------------*/
?>