<?php

	/*------------------------------------------
	 * Img.Extra.php - Extra main functions
	 * 
	 * Copyright (c) 2013 David Todd (c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */
	
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
		$thethumbs = '';
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
			<h4>Uploaded Pictures:</h4><br />
		";
		$thethumbs = explode("-", $thethumbs);
		// The following code has a bunch of whitespaces in it to make the html look nice when its source is looked at
		$output = "	<table cellspacing=\"0\" cellpadding=\"0\" width=\"520\"  border=\"0\">\n";
		$output .= "				<tr>\n";
		$dir = opendir("Pictures");
		$counter = 0;
		while (false !== ($fname = readdir($dir))){
			if ($fname != '.' && $fname != '..'){
				$output .= "					<td>";
				if(in_array($fname, $thethumbs)){ // Totally figured out how to use in_array by looking at default php scripts (Thank you wingrep :3)
					$output .= '<a href="?img='.$fname.'"><img src="thumbs/'.$fname.'" alt="'.$fname.'" title="'.$fname.'"/></a>';
				}else{
					$output .= '<a href="?img='.$fname.'"><img src="nothumb.png" alt="'.$fname.'" title="'.$fname.'"/></a>';
				}
				//$output .= "<img src='thumbs/$fname' alt='$fname' title='$fname' border=\"0\" />";
				$output .= "</td>\n";
				$counter += 1;
				if ($counter % 5 == 0){ 
					$output .= "				</tr><tr>\n"; 
				}
			}
		}
		closedir( $dir );
		$output .= "				</tr>\n";
		$output .= "			</table>		";
		// End of weird whitespaces
		echo $output;
		echo"
			</center>
		";
	}
	
?>