<?php

	/*------------------------------------------
	 * Img.Extra.php - Extra main functions
	 * 
	 * Copyright (c) 2013 David Todd (c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */

	function headstuff(){ // Sets the meta tags - WIP/iffy
		if(isset($_SESSION['img'])){
			echo "<meta property=\"og:title\" content=\"".$_SESSION['img']."\" />\n";
			echo "		<meta property=\"og:url\" content=\"http://img.unps-gama.info/index.php?img=".$_SESSION['img']."\" />\n";
			echo "		<meta property=\"og:image\" content=\"http://img.unps-gama.info/".$_SESSION['location']."/".$_SESSION['img']."\" />\n";
			echo "		<meta property=\"og:description\" content=\"".$_SESSION['comment']."\" />\n";
		}
	}
	
	function textstuff(){ // Sets up right side box of info under the other sidebars
		if($_SESSION['noimg'] == false){
			echo "<div align=\"left\">\n";
			echo "<h3>Image Name:</h3><code> - ".$_SESSION['img']."</code>\n";
			echo "<h3>Image Type:</h3><code> - ".$_SESSION['type']."</code>\n";
			echo "<h3>Image Size:</h3><code> - ".$_SESSION['size']."</code>\n";
			echo "<h3>Time Uploaded:</h3><code> - ".$_SESSION['time']."</code>\n";
			echo "<h3>Username:</h3><code> - ";
			$username = $_SESSION['username'];
			echo "<a href=\"?uname=$username\">$username</a>"; // For future use - catagorize by username
			echo "</code>\n";
			echo "<h3>Comment:</h3><code> - ".$_SESSION['comment']."</code>\n";
			echo "<h3>Tags:</h3><code> - ";
			$tags = $_SESSION['tags'];
			$tags = explode(" ", $tags);
			foreach($tags as $tag){
				echo "<a href=\"?tag=$tag\">$tag</a> "; // For future use - catagorize by tag
			}
			echo "</code>\n";
			echo "</div>";
		}
	}
	
	function noimg(){ // Shown in place of the image if one isn't available
		$thelist = '';
		$thethumbs = '';
		$_SESSION['thethumbs'] = '';
		if($handle = opendir('Pictures')){
			while(false != ($file = readdir($handle))){
				if($file != "." && $file != ".." && $file != ".htaccess"){
					$thelist .= "-".$file;
				}
			}
			closedir($handle);
		}
		if($thumbs = opendir('thumbs')){
			while(false != ($fiel = readdir($thumbs))){
				// Test if thumbnail exists if not show nothumb.png
				if($fiel != "." && $fiel != ".." && $fiel != ".htaccess"){
					$thethumbs .= "-".$fiel;
				}
			}
			closedir($thumbs);
		}
		echo "
			<p>
				Please specify an image with the url: 
				<code>
					img.unps-gama.info/?img=(IMGAGE STUFF HERE)
				</code>
			</p>
			<center>
			<h4>Uploaded Pictures:</h4>
		";
		$thelist = explode("-", $thelist);
		$thethumbs = explode("-", $thethumbs);
		foreach($thelist as $pics){
			if($pics == '' || $pics == null){
				echo '';
			}else{ // Checks if there is a thumbnail for the image, if not show nothumb.png
				if(in_array($pics, $thethumbs)){
					echo '<a href="?img='.$pics.'"><img src="thumbs/'.$pics.'" alt="'.$pics.'" title="'.$pics.'"/></a>'."\n		";
				}else{
					echo '<a href="?img='.$pics.'"><img src="nothumb.png" alt="'.$pics.'" title="'.$pics.'"/></a>'."\n		";
				}
			}
		}
		echo"
			</center>
		";
	}
	
	function title(){ // Suffers same problem as headstuff()
		if(!isset($_SESSION['img'])){ 
			echo "";
		}else{
			echo " - Now Showing: ".$_SESSION['img'];
		}
	}

?>