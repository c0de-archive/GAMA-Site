<?php

	/*------------------------------------------
	 * Helper.Get.php - Holds the functions for get - uname, tag, search, and upload
	 * 
	 * Copyright (c) 2013 David Todd (c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */

	function uname(){
		if(!empty($_GET['uname'])){ // Show list of pictures uploaded by certain username
			echo "<center><h4>Pictures uploaded from Username: ".$_GET['uname'].":</h4></center><br />";
			require('dbsettings.php');
			$uname = sanitize($_GET['uname']); 
			$sql = 'SELECT * FROM `share` WHERE `username` = "'.$uname.'"';
			
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			
			while($row = $result->fetch_assoc()){
				$_SESSION['noimg'] = 'uname';
				$id = $row['id'];
				$img = $row['name'];
				$location = $row['location'];
				$type = $row['type'];
				$size = $row['size'];
				$time = $row['time'];
				$comment = $row['comment'];
				$username = $row['username'];
				$tags = $row['tags'];
				echo "<center><a href=\"?img=$img\"><img src=\"thumbs/$img\" alt=\"Thumbnail of $img\" align=\"middle\"></a><br /><a href=\"?img=$img\">$img</a> - $time - $size <br /> Tags: ";
				$tags = explode(" ", $tags);
				foreach($tags as $tag){
					echo "<a href=\"?tag=$tag\">$tag</a> "; // For future use - catagorize by tag
				}
				echo "</center><br />";
			}
			$result->free();
		}
	}
	
	function tag(){
		if(!empty($_GET['tag'])){ // Show list of pictures according to one tag - maybe multiple tags in the future
			echo "<center><h4>Pictures uploaded with the tag: ".$_GET['tag'].":</h4></center><br />";
			require('dbsettings.php');
			$tag = sanitize($_GET['tag']); 
			$sql = 'SELECT * FROM `share` WHERE `tags` LIKE "%'.$tag.'%"';
			
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			
			while($row = $result->fetch_assoc()){
				$_SESSION['noimg'] = 'tag';
				$id = $row['id'];
				$img = $row['name'];
				$location = $row['location'];
				$type = $row['type'];
				$size = $row['size'];
				$time = $row['time'];
				$comment = $row['comment'];
				$username = $row['username'];
				$tags = $row['tags'];
				echo "<center><a href=\"?img=$img\"><img src=\"thumbs/$img\" alt=\"Thumbnail of $img\" align=\"middle\"></a> <br /> <a href=\"?img=$img\">$img</a> - $time - $size - Uploader: <a href=\"?uname=$username\">$username</a><br /></center><br />";
			}
			$result->free();
		}
	}
	
	function search(){
		if(!empty($_GET['search'])){ // Show list of pictures according to search term
			$search = sanitize($_GET['search']);
			$search = explode(" ", $search);
			echo "<center><h4>Pictures found using search terms: ";
			foreach ($search as $searches){
				echo $searches." ";
			}
			echo ":</h4></center><br />";
			require('dbsettings.php');
			$sql = "SELECT * FROM `share` WHERE `tags` LIKE '%".$search[0]."%'";
			for($i=1; $i<count($search); $i++){
				$sql = $sql." AND `tags` LIKE '%".$search[$i]."%'";
			}
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
	
			while($row = $result->fetch_assoc()){
				$_SESSION['noimg'] = 'search';
				$id = $row['id'];
				$img = $row['name'];
				$location = $row['location'];
				$type = $row['type'];
				$size = $row['size'];
				$time = $row['time'];
				$comment = $row['comment'];
				$username = $row['username'];
				$tags = $row['tags'];
				echo "<center><a href=\"?img=$img\"><img src=\"thumbs/$img\" alt=\"Thumbnail of $img\" align=\"middle\"></a><br /> <a href=\"?img=$img\">$img</a> - $time - $size - Uploader: <a href=\"?uname=$username\">$username</a><br /></center>";
			}
			$result->free();
		}
	}
	
	function upload(){
		if(isset($_GET['upload'])){
			$max_file_size="4096";
			$file_uploads="1";
			$websitename="UnPS-GAMA Image Host Uploader";
			$allow_types=array("jpg","gif","png","JPEG","JPG","GIF","PNG");
			echo "
				<center>
				<form name=\"uploadform\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
				<table>
					<tr>
						<td colspan=\"2\">
							<h3>Upload Pictures Here</h3>
							<pre>All fields required</pre>
						</td>
					</tr>
					<tr>
						<td colspan=\"2\" class=\"upload_info\">
							<b>Allowed Types:</b> jpg, gif, png<br />
							<b>Max size per file:</b> 4 MB.
						</td>
					</tr>
					<tr>
						<td class=\"table_body\" width=\"30%\"><b>Select File:</b> </td>
						<td class=\"table_body\" width=\"70%\"><input type=\"file\" name=\"file\" id=\"file\" size=\"70\" /></td>
					</tr>
					<tr>
						<td class=\"table_body\" width=\"30%\"><b>Your Name: </b></td>
						<td class=\"table_body\" width=\"70%\"><input type=\"text\" name=\"username\" id=\"username\" size=\"70\" /></td>
					</tr>
					<tr>
						<td class=\"table_body\" width=\"30%\"><b>Comment: </b></td>
						<td class=\"table_body\" width=\"70%\"><input type=\"text\" name=\"comment\" id=\"comment\" size=\"70\" /></td>
					</tr>
					<tr>
						<td class=\"table_body\" width=\"30%\"><b>Tags</b> (spaces only):</td>
						<td class=\"table_body\" width=\"70%\"><input type=\"text\" name=\"tags\" id=\"tags\" size=\"70\" /></td>
					</tr>
					<tr>
						<td colspan=\"2\">
							<input type=\"hidden\" name=\"submit\" value=\"true\" />
							<input type=\"reset\" name=\"reset\" value=\" Reset Form \" onclick=\"window.location.reload(true);\" /> &nbsp;
							<input type=\"submit\" value=\" Upload \" /> 
						</td>
					</tr>
				</table>
				</form>
				</center>
				<hr /><br />
			";
		}
		if(isset($_POST['submit'])){
			if(!isset($_POST['username']) || !isset($_POST['comment']) || !isset($_POST['tags'])) die("Please fill in the form completly");
			require('dbsettings.php');
			
			$location = 'Pictures'; 
			$extensions = array('png', 'gif', 'jpg', 'jpeg'); 
			$short = substr(number_format(time() * mt_rand(),0,'',''),0,10); 
			$short = base_convert($short, 10, 36); 
			
			$upusername = $_POST['username'];
			$upcomment = $_POST['comment'];
			$tags = $_POST['tags'];
			$name = $_FILES["file"]["name"]; 
			$type = $_FILES["file"]["type"];
			$size = ($_FILES["file"]["size"] / 1024); // get size of file in Kb
			
			$name = cln_file_name($name);
			$type = sanitize($type);
			$size = sanitize($size); 
			$upcomment = comment($upcomment);
			$tags = sanitize($tags);
			$upusername = sanitize($upusername);
			
			//$notspace = array("\,", ".", "/", "\\", ":", "-", "_", "+", "=", "~", "#", "&", "");
			//$tags = preg_replace($notspace, " ", $tags);
			
			$size = round($size, 2)." Kb";
			$time = date("d/j/y - g:i:s a");
			
			$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			if(!in_array($file_ext, $extensions))die("Wrong or no file extension"); // stop the upload if it's wrong
			$name = $short.".".$file_ext;
			
			if (($_FILES["file"]["size"] < 4000000000)){
				if ($_FILES["file"]["error"] > 0){
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				}else{
					if (file_exists("Pictures/" . $name)){
						echo $name." already exists. ";
					}else{
						if(preg_match('/php/i', $name) || preg_match('/phtml/i', $name) || preg_match('/htaccess/i', $name)){
							echo $name." is not allowed, sorry about that...";
						}else{
							// Somehow bump one of the images from the recently upload table and add new image in its place
							$sql="INSERT INTO `share` (name, location, type, size, time, comment, username, tags) VALUES ('$name', '$location', '$type', '$size', '$time', '$upcomment', '$upusername', '$tags')";
							if($result = $db->query($sql)){
								move_uploaded_file($_FILES["file"]["tmp_name"], "Pictures/" . $name);
								$donefile = 'Pictures/'.$name;
								genthumb($name);
								echo "Stored at: <a href='?img=$name'>". $name."</a>";
							}elseif(!$result = $db->query($sql)){
								die('There was a problem trying to upload your file - [' . $db->error . ']');
							}else{
								echo "There was a problem trying to upload your file - Could be a server error";
							}
						}
					}
				}
			}else{
				die("File too big!");
			}
		}
	}

?>