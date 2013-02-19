<?php

	/*------------------------------------------
	 * Helper.GenThumb.php - Function for generating thumbnails on upload
	 * 
	 * Copyright (c) 2013 David Todd (c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */

	function genthumb($imageName){
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
		
		switch($stype) {
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
 
		if($w> $h){
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

		switch($stype) {
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

?>