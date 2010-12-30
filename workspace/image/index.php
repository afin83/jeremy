<?php
/*---------------------------------------------------------------------------*/
	
	include_once('./includes/query.php');
	include_once('./includes/image.php');
	include_once('./includes/filter.php');
	include_once('./includes/colour.php');

/*---------------------------------------------------------------------------*/
	
	$query = new Query($_GET, array(
		'path'		=> '../',
		'file'		=> 'default.png',
		'filter'	=> 'unknown'
	));
	
	$query->acceptString('file', '/.+$/');
	$query->acceptString('path', '/.+$/');
	$query->acceptString('filter', '/^[a-z0-9\-]+$/');
	$query = $query->results();
	
/*---------------------------------------------------------------------------*/
	
	try {
		header('content-type: image/jpeg');
		header('Expires: access + 6 months');
		
		$nocache = isset($_GET['nocache']);
		$image = new Image($query);
		$filter = new Filter($query);
		
		// Regenerate?
		if (!$image->cached($filter) or $nocache) {
			$filter->apply($image);
			$image->write();
		}
		
		$image->read($nocache);
		
	} catch (Exception $error) {
		header('content-type: text/html');
		
		echo $error->getMessage();
	}
	
/*---------------------------------------------------------------------------*/
?>