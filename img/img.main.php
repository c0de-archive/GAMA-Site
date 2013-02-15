<?php

	/*------------------------------------------
	 * Img.Main.php - Main program
	 * 
	 * Copyright (c) 2013 David Todd(c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */

	function imgstuff(){
		// My little cheat to be able to display all the different items in the same area
		uname();
		tag();
		search();
		upload();
		// Basically all my functions are used as part of one big one, but more organized into smaller sections
		if (empty($_GET['img']) || $_GET['img'] == null || $_GET['img'] == ''){
			$img = '';
		}else{
			$img = $_GET["img"]; // get the image
		}
		if(!empty($img) || $img != null || $img != ''){
			require('dbsettings.php');
			$img = sanitize($img); // clean image string
			$sql = "SELECT * FROM `share` WHERE `name` = '$img' LIMIT 1";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			};
			$row = $result->fetch_assoc();
			if ($row){
				$_SESSION['noimg'] = false;
				$_SESSION['id'] = $row['id'];
				$_SESSION['img'] = $row['name'];
				$_SESSION['location'] = $row['location'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['size'] = $row['size'];
				$_SESSION['time'] = $row['time'];
				$_SESSION['comment'] = $row['comment'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['tags'] = $row['tags'];
				echo "<center><img id='the_pic' class='fit' src=\"".$_SESSION['location']."/$img\" /><br /></center>";
				//echo "$id<br>$img<br>$location<br>$type<br>$size<br>$time<br>$comment<br>$username<br>$tags\n";
			}else{
				$_SESSION['noimg'] = true;
				echo "<center><h3>That image was not found in our database D:</h3></center>";
			}
			$result->free();
		}else{
			if($_SESSION['noimg'] == 'search' || $_SESSION['noimg'] == 'tag' || $_SESSION['noimg'] == 'uname'){
			}else{
				noimg();
				$_SESSION['noimg'] = true;
			}
		}
	}

?>