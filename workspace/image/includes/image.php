<?php
/*---------------------------------------------------------------------------*/
	
	function imagecreatefromfile($file) {
		if (!is_readable($file)) {
			throw new Exception("Unable to find image <code>{$file}</code>.", E_USER_ERROR);
		}
		
		if (!$info = @getimagesize($file)) {
			throw new Exception("Unable to open image <code>{$file}</code>.", E_USER_ERROR);
		}
		
		switch($info['mime']) {	
			case 'image/gif':
				return imagecreatefromgif($file);
				break;
				
			case 'image/png':
				return imagecreatefrompng($file);
				break;
				
			case 'image/jpeg':
				//if ($info['channels'] > 3) {
				//	throw new Exception("Image not in RGB mode <code>{$file}</code>.", E_USER_ERROR);
				//}
				
				return imagecreatefromjpeg($file);
				break;
				
			default:
				throw new Exception("Image of unknown type <code>{$file}</code>.", E_USER_ERROR);
				break;			
		}
		
		return null;
	}
	
/*---------------------------------------------------------------------------*/
	
	class Image {
		public $image;
		private $info;
		public $settings;
		private $source;
		private $cache;
		
		public function __construct($settings) {
			$this->settings = $settings;
			$this->source = $this->settings->path . urldecode($this->settings->file);
			$this->image = imagecreatefromfile($this->source);
			$this->mime = getimagesize($this->source);
		}
		
		public function cached($filter) {
			if($this->mime['mime'] == "image/png") {
				$this->cache = './cache/' . implode('-', array(
					$this->settings->filter,
					md5($this->settings->file),
				)) . '.png';				
			} else {
				$this->cache = './cache/' . implode('-', array(
					$this->settings->filter,
					md5($this->settings->file),
				)) . '.jpg';
			}			
			
			if (!is_readable($this->cache) or filemtime($this->cache) < $filter->date) {
				return false;
			}
			
			return true;
		}
		
		public function write() {
			if($this->mime['mime'] == "image/png") {
				imageinterlace($this->image);
				imagesavealpha($this->image, true);
				imagepng($this->image, $this->cache);
			} else {
				imagejpeg($this->image, $this->cache,85);
			}
		
			@chmod($this->cache, 0775);
		}
		
		public function read($nocache = false) {
			if (headers_sent()) return false;
			
			$path = implode('/', array(
				dirname($_SERVER['SCRIPT_NAME']),
				ltrim($this->cache, './')
			));
			
			if (!$nocache) {
				header("Status: 301");
				header("Location: {$path}");
				
			} else {
				header('Content-Type: text/html');
				printf(
					'<img src="%s" alt="" width="%d" height="%d" />',
					$path, imagesx($this->image), imagesy($this->image)
				);
			}
			
			return true;
		}
	}
	
/*---------------------------------------------------------------------------*/
?>