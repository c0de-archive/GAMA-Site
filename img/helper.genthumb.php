<?php

	/*------------------------------------------
	 * Helper.GenThumb.php - Function for generating thumbnails on upload
	 * Copied from http://webcheatsheet.com/php/create_thumbnail_images.php and modified for my use
	 * 
	 * Copyright (c) 2013 David Todd (c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */

	function genthumb($imageName){ // Generates one thumbnail of one picture on demand
		//echo "Placeholder for automatic 100x100px thumbnail generation of new pictures<br />\n";
		$nw = 100;
		$nh = 100;
		$source = "Pictures/".$imageName;
		$dest = "thumbs/".$imageName;
		
		$stype = explode(".", $source);
		$stype = $stype[count($stype)-1];
		
		$size = getimagesize($source);
		$w = $size[0];
		$h = $size[1];
		
		switch(strtolower($stype)) {
			case 'gif':
				$simg = imagecreatefromgif($source);
				break;
			case 'jpg':
				$simg = imagecreatefromjpeg($source);
				break;
			case 'png':
				$simg = imagecreatefrompng($source);
				break;
		}
		
		$dimg = imagecreatetruecolor($nw, $nh);
		$wm = $w/$nw;
		$hm = $h/$nh;
		$h_height = $nh/2;
		$w_height = $nw/2;
 
		if($w> $h){ // Debating whether or not to keep the cropping
			$adjusted_width = $w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
		}elseif(($w <$h) || ($w == $h)){     
			$adjusted_height = $h / $wm;     
			$half_height = $adjusted_height / 2;     
			$int_height = $half_height - $h_height;         
			imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h); 
		}else{     
			imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h); 
		}   

		switch(strtolower($stype)) {
			case 'gif':
				imagegif($dimg,$dest,100);
				break;
			case 'jpg':
				imagejpeg($dimg,$dest,100);
				break;
			case 'png':
				imagepng($dimg,$dest,9);
				break;
		}
		//imagejpeg($dimg,$dest,100);
	}
	
	function createThumbs(){ // Generates a thumbnail for every image in the Pictures directory - Resource heavy
	$pathToImages = 'Pictures/';
	$pathToThumbs = 'thumbs/';
	$dir = opendir( $pathToImages );
	while (false !== ($fname = readdir( $dir ))) {
		$info = pathinfo($pathToImages . $fname);
		if ($fname == "." || $fname == "..") continue;
		$nw = 100;
		$nh = 100;
		$source = $pathToImages.$fname;

		$stype = explode(".", $source);
		$stype = $stype[count($stype)-1];	

		echo "Creating thumbnail for {$fname}..";
		
		$size = getimagesize($source);
		$w = $size[0];
		$h = $size[1];
		
		switch(strtolower($stype)) {
			case 'gif':
				$simg = imagecreatefromgif($source);
				break;
			case 'jpg':
				$simg = imagecreatefromjpeg($source);
				break;
			case 'png':
				$simg = imagecreatefrompng($source);
				break;
		}
			
		$dimg = imagecreatetruecolor($nw, $nh);
		$wm = $w/$nw;
		$hm = $h/$nh;
		$h_height = $nh/2;
		$w_height = $nw/2;
 
		if($w> $h){ // Debating whether or not to keep the cropping
			$adjusted_width = $w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
		}elseif(($w <$h) || ($w == $h)){     
			$adjusted_height = $h / $wm;     
			$half_height = $adjusted_height / 2;     
			$int_height = $half_height - $h_height;         
			imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h); 
		}else{     
			imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h); 
		}   

		switch(strtolower($stype)) {
			case 'gif':
				imagegif($dimg, "{$pathToThumbs}{$fname}" ,100);
				echo ". Done. <img src='thumbs/$fname'><br>\n";
				break;
			case 'jpg':
				imagejpeg($dimg, "{$pathToThumbs}{$fname}" ,100);
				echo ". Done. <img src='thumbs/$fname'><br>\n";
				break;
			case 'png':
				imagepng($dimg, "{$pathToThumbs}{$fname}" ,9);
				echo ". Done. <img src='thumbs/$fname'><br>\n";
				break;
		}
	}
	closedir( $dir );
	die("<script>alert('All thumbnails have been refreshed.');</script>");
}

?>