<?php
/*---------------------------------------------------------------------------*/
	
function imageconvolution2($src, $filter, $filter_div, $offset){
    if ($src==NULL) {
        return 0;
    }
   
    $sx = imagesx($src);
    $sy = imagesy($src);
    $srcback = ImageCreateTrueColor ($sx, $sy);
    ImageCopy($srcback, $src,0,0,0,0,$sx,$sy);
   
    if($srcback==NULL){
        return 0;
    }
       
    for ($y=0; $y<$sy; ++$y){
        for($x=0; $x<$sx; ++$x){
            $new_r = $new_g = $new_b = 0;
            $alpha = imagecolorat($srcback, $pxl[0], $pxl[1]);
            $new_a = $alpha >> 24;
           
            for ($j=0; $j<3; ++$j) {
                $yv = min(max($y - 1 + $j, 0), $sy - 1);
                for ($i=0; $i<3; ++$i) {
                        $pxl = array(min(max($x - 1 + $i, 0), $sx - 1), $yv);
                    $rgb = imagecolorat($srcback, $pxl[0], $pxl[1]);
                    $new_r += (($rgb >> 16) & 0xFF) * $filter[$j][$i];
                    $new_g += (($rgb >> 8) & 0xFF) * $filter[$j][$i];
                    $new_b += ($rgb & 0xFF) * $filter[$j][$i];
                }
            }

            $new_r = ($new_r/$filter_div)+$offset;
            $new_g = ($new_g/$filter_div)+$offset;
            $new_b = ($new_b/$filter_div)+$offset;

            $new_r = ($new_r > 255)? 255 : (($new_r < 0)? 0:$new_r);
            $new_g = ($new_g > 255)? 255 : (($new_g < 0)? 0:$new_g);
            $new_b = ($new_b > 255)? 255 : (($new_b < 0)? 0:$new_b);

            $new_pxl = ImageColorAllocateAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            if ($new_pxl == -1) {
                $new_pxl = ImageColorClosestAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            }
            if (($y >= 0) && ($y < $sy)) {
                imagesetpixel($src, $x, $y, $new_pxl);
            }
        }
    }
    imagedestroy($srcback);
    return 1;
}
	
	class EffectBorder {
		private $settings;
		private $image;
		
		public function __construct($settings) {
			$query = new Query($settings, array(
				'fg'		=> '000000',
				'style'		=> 'solid',
				'size'		=> 1,
				'offset'	=> 0
			));
			
			$query->acceptString('fg', '/^([0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})$/');
			$query->acceptString('style', '/^(solid|dashed|dashed-long|dotted)$/');
			$query->acceptInteger('size', '/^[1-9][0-9]*$/');
			$query->acceptInteger('offset', '/^[0-9]+$/');
			
			$this->settings = $query->results();
		}
		
		public function apply($resource) {
			$top = $left = $this->settings->offset;
			$width = imagesx($resource->image) - 1 - $this->settings->offset;
			$height = imagesy($resource->image) - 1 - $this->settings->offset;
			
			$imageWidth = imagesx($resource->image);
			$imageHeight = imagesy($resource->image);
			
			$image = imagecreatetruecolor($imageWidth, $imageHeight);
			imagesavealpha($image, true);
			
			$bg = new Colour('000000ff');
			$bg = $bg->allocate($image);
			imagefill($image, 0, 0, $bg);
			
			$colour = new Colour($this->settings->fg);
			$colour = $colour->allocate($image);
			
			switch ($this->settings->style) {
				case 'solid': $style = $this->styleSolid($colour); break;
				case 'dashed': $style = $this->styleDashed($colour); break;
				case 'dashed-long': $style = $this->styleDashed($colour, 8); break;
				case 'dotted': $style = $this->styleDotted($colour); break;
			}
			
			$total = $this->settings->size;
			
			// Draw top:
			$current = 0;
			while ($current < $total) {
				imagesetstyle($image, $style);
				imageline(
					$image,
					$top, $top + $current,
					$width - $total, $top + $current,
					IMG_COLOR_STYLED
				);
				
				$current++;
			}
			
			// Draw right:
			$current = 0;
			while ($current < $total) {
				imagesetstyle($image, $style);
				imageline(
					$image,
					$width - $current, $top,
					$width - $current, $height - $total,
					IMG_COLOR_STYLED
				);
				
				$current++;
			}
			
			// Draw bottom:
			$current = 0;
			while ($current < $total) {
				imagesetstyle($image, $style);
				imageline(
					$image,
					$left + $total, $height - $current,
					$width, $height - $current,
					IMG_COLOR_STYLED
				);
				
				$current++;
			}
			
			// Draw left:
			$current = 0;
			while ($current < $total) {
				imagesetstyle($image, $style);
				imageline(
					$image,
					$left + $current, $top + $total,
					$left + $current, $height,
					IMG_COLOR_STYLED
				);
				
				$current++;
			}
			
			// Draw image:
			imagecopyresampled(
				$resource->image, $image,
				0, 0, 0, 0,
				$imageWidth, $imageHeight,
				$imageWidth, $imageHeight
			);
		}
		
		private function styleSolid($colour) {
			return array($colour);
		}
		
		private function styleDashed($colour, $mult = 4) {
			$fill = $mult * $this->settings->size;
			$total = $fill * 2; $current = 0;
			$style = array();
			
			while ($current < $total) {
				if ($current < $fill) {
					$style[] = $colour;
				} else {
					$style[] = IMG_COLOR_TRANSPARENT;
				}
				
				$current++;
			}
			
			return $style;
		}
		
		private function styleDotted($colour) {
			return $this->styleDashed($colour, 1);
		}
	}
	
/*---------------------------------------------------------------------------*/
?>