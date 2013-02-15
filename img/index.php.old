<?php
	session_start();
	
	/* -----------------------------------------------------------
	 *
	 * UnPS-GAMA Image Host
	 * Copyright (c) 2013 UnPS-GAMATechnologies
	 * Author: David Todd (c0de) of http://www.unps-gama.info and http://unps.us
	 *
	 * -----------------------------------------------------------
	 * 							TODO:
	 *
	 * JavaScript fo show bigger image if clicked 
	 * Recently Uploaded Pictures on sidebar
	 * Automatic thumbnail generation - genthumb() (100px x 100px)
	 * Force Spaces in tags
	 * Fix headstuff() and title()
	 * Multiple tags without search?
	 * Classes?
	 *
	 * -----------------------------------------------------------
	 */
	
	$thelist = '';
	$img = '';
	$id = '';
	$location = '';
	$type = '';
	$size = '';
	$time = '';
	$comment = '';
	$username = '';
	$tags = '';
	$_SESSION['noimg'] = ''; 
	
	// GET functions
	
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
			//echo "<br /><hr /><br />";
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
			//echo "<br /><hr /><br />";
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
			//echo "<br /><hr /><br />";
		}
	}
	
	function upload(){
		if(isset($_GET['upload'])){
			$max_file_size="4096";
			$file_uploads="1";
			$websitename="UnPS-GAMA Image Host Uploader";
			$allow_types=array("jpg","gif","png","bmp","JPEG","JPG","GIF","PNG");
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
							<b>Allowed Types:</b> jpg, gif, png, bmp<br />
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
			$extensions = array('png', 'gif', 'jpg', 'jpeg', 'bmp'); 
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
							$sql="INSERT INTO `share` (name, location, type, size, time, comment, username, tags) VALUES ('$name', '$location', '$type', '$size', '$time', '$upcomment', '$upusername', '$tags')";
							if($result = $db->query($sql)){
								//$sql = "UPDATE `recentpics` SET name = '-$name' WHERE id = 1"; // Not currently working
								//$result=mysql_query($sql);
								//if($result){
									move_uploaded_file($_FILES["file"]["tmp_name"], "Pictures/" . $name);
									$donefile = 'Pictures/'.$name;
									genthumb($donefile);
									echo "Stored at: <a href='?img=$name'>". $name."</a>";
								//}else{
								//	echo "There was a problem uploading this file.";
								//}
							}elseif(!$result = $db->query($sql)){
								die('There was a problem trying to upload your file - [' . $db->error . ']');
							}else{
								echo "There was a problem trying to upload your file - Could be a database error";
							}
						}
					}
				}
			}else{
				die("File too big!");
			}
		}
	}
	
	// END OF GET FUNCTIONS
	
	function genthumb($input){
		echo "Placeholder for automatic 100x100px thumbnail generation of new pictures<br />\n";
	}
	
	function sanitize($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		include('dbsettings.php');
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = $db->real_escape_string($output);
		$output = strtolower($output);
		return $output;
	}
	
	function comment($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		include('dbsettings.php');
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = $db->real_escape_string($output);
		return $output;
	}
	
	function cln_file_name($string) {
		$cln_filename_find=array("/\.[^\.]+$/", "/[^\d\w\s-]/", "/\s\s+/", "/[-]+/", "/[_]+/");
		$cln_filename_repl=array("", "", " ", "-", "_");
		$string=preg_replace($cln_filename_find, $cln_filename_repl, $string);
		return trim($string);
	}
	
	// MAIN PROGRAM
	
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
	
	// END OF MAIN PROGRAM
	
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
		// Last Modified not working, so removed for the time being
		if($handle = opendir('Pictures')){
			while(false != ($file = readdir($handle))){
				if($file != "." && $file != ".." && $file != ".htaccess"){
					//$thelist .= '<a href="?img='.$file.'"><img src="thumbs/'.$file.'" alt="Thumbnail for '.$file.'" /><br /> └ '.$file.'</a></font><br /><p></p>'."\n";
					$thelist .= "-".$file;
				}
			}
			closedir($handle);
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
		foreach($thelist as $pics){
			if($pics == '' || $pics == null){
				echo '';
			}else{
				echo '<a href="?img='.$pics.'"><img src="thumbs/'.$pics.'" alt="'.$pics.'" title="'.$pics.'"/></a>'."\n		";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
<!--
	 * -----------------------------------------------------------
	 *
	 * UnPS-GAMA Image Host
	 * Copyright (c) 2013 UnPS-GAMATechnologies
	 * Author: David Todd (c0de) of http://www.unps-gama.info and http://unps.us
	 *
	 * -----------------------------------------------------------
	 * 							TODO:
	 *
	 * JavaScript fo show bigger image if clicked 
	 * Recently Uploaded Pictures on sidebar
	 * Automatic thumbnail generation - genthumb() (100px x 100px)
	 * Force spaces on tags
	 * Fix headstuff() and title()
	 * Multiple tags without search?
	 * Classes?
	 *
	 * -----------------------------------------------------------
	 *
-->
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="description" content="Image Host for UnProfessional Standards" />
		<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
		<meta name="author" content="David Todd" />
		<?php //headstuff(); ?>
		<title>UnPS-GAMA Image Host<?php //title(); ?></title>
		<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<script src="jquery.js"></script>
		<script type="text/javascript" language="JavaScript">
			function set_body_height(){
				var wh = $(window).height();
				$('body').attr('style', 'height:' + wh + 'px;');
			}
			$(document).ready(function() {
				set_body_height();
				$(window).bind('resize', function() { set_body_height(); });
			});
		</script>
		<style type="text/css">
			.fit {
				max-width: 100%;
				max-height: 100%;
			}
		</style>
	</head>
	<body>
		<div id="page_wrap">
			<div id="header">
				<img src="header.png" alt="Header image"/>
			</div>
			
			<div id="main_navi">
				<ul class="left">
					<li><a href="http://www.unps-gama.info">Home</a></li>
					<li><a href="../img">Images</a></li>
					<li><a href="http://unps.us" target="_unps">Shortener</a></li>
					<li><a href="http://p.unps.us" target="_pro">Projects</a></li>
					<li><a href="https://github.com/alopexc0de/GAMA-Site" target="_git">GitHub</a></li>
					<li><a href="http://www.unps-gama.info/ToS.html">Terms of Service</a></li>
					<li><a href="http://www.unps-gama.info/privacy.html">Privacy Policy</a></li>
				</ul>
		
				<ul class="right">
					<li class="twitter"><a href="http://twitter.com/upstandards" title="Follow UnPS on twitter">TWITTER</a></li>
				</ul>	
			</div>
			
			<div class="clear"></div>
			
			<div id="container">
				<div id="main">
					<div class="sticky">
						Thumbnails need work
					</div>
					<div class="post">
						<div class="entry"><!-- Begin image stuff php -->
							<?php 
								imgstuff();
							?>
						</div>
					</div>
				</div>
				
				<div id="sidebar">
					<ul>
						<li class="widget widget_search">
							<div id="search">
								<form action="" method="get" name="search" id="search">
									<input name="search" id="search" type="text" placeholder="Search" />
									<input id="submit" name="submit" type="submit" value=" Search " />
								</form>
							</div>
						</li>
					</ul>
					<!--<br /> Might not keep this
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<span>
									ADS GO HERE
									<script type="text/javascript">
										//<!--
										google_ad_client = "ca-pub-6762927271223365";
										/* sidebar ads */
										google_ad_slot = "1523932882";
										google_ad_width = 120;
										google_ad_height = 240;
										//- ->
									</script>
									<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
								</span>
							</div>
						</li>
					</ul>-->
					<!--<br /> Might not keep this
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<span>
									Social Media Buttons Here
								</span>
							</div>
						</li>
					</ul>-->
					<!-- This is what I want the end result of the recently uploaded pictures to look like- ->
					<br />
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<h3>Recently Uploaded Pictures</h3><br />
								<a href="?img=1607vhu.png"><img src="thumbs/1607vhu.png" alt="1607vhu.png" title="1607vhu.png"/></a>
								<a href="?img=icbqp9.jpg"><img src="thumbs/icbqp9.jpg" alt="icbqp9.jpg" title="icbqp9.jpg"/></a>
							</div>
						</li>
					</ul>
					<!-------- Make what's commented below resemble (in output) what happens above-->
					<br />
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<h3>Recently Uploaded Pictures</h3><br />
								<?php // Not currently working
									require('dbsettings.php');
									$sql = "SELECT * FROM `recentpics` WHERE `id` = 1";
									if(!$result = $db->query($sql)){
										die('There was an error running the query [' . $db->error . ']');
									}
									$row = $result->fetch_assoc();
									if ($row){
										$name = $row['name'];
										$name = explode("-", $name);
										foreach($name as $names){
											//echo '<a href="?img='.$names.'"><img src="thumbs/'.$names.'"></a>';
											echo '<a href="?img='.$names.'"><img src="thumbs/'.$names.'" alt="'.$names.'" title="'.$names.'"/></a>'."\n		";
										}
									}else{
										echo "Error getting images from database";
									}
								?>
							</div>
						</li>
					</ul>
					<!-- textstuff is right under here (not shown unless picture is viewed though) -->
					<?php
					if($_SESSION['noimg'] == false){
						echo "
						<br />
						<ul>
							<li class=\"widget widget_text\">
								<div class=\"textwidget\">
									";
						textstuff();
						echo "
								</div>
							</li>
						</ul>
						";
					}
					?>
					<br />
						<ul>
							<li class="widget widget_text">
								<div class="textwidget">
									<h4>Want to upload pictures?</h4>
									<a href='?upload'>Image Uploader Here</a>
								</div>
							</li>
						</ul>
				</div>
			</div>
		</div>
		<div id="footer">
			<div class="footer_wrapper">
				<div class="footer_left">
					<p>
						<a href="http://www.unps-gama.info/privacy.html">Privacy Policy</a> - <a href="http://www.unps-gama.info/ToS.html">Terms of Service</a> - Modified <a href="http://imotta.cn/wordpress/pyrmont-theme-v2-for-wordpress.html">Pyrmont V2</a> - <strong>Copyright &copy; 2012-2013 UnPS-GAMA</strong> 
					</p>
				</div>
			</div>
		</div>
	</body>
</html>
<?php session_unset(); session_destroy(); ?>