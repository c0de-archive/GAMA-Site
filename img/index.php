<?php
	session_start();
	
	/* -----------------------------------------------------------
	 *
	 * UnPS-GAMA Image Host
	 * Copyright (c) 2013 UnPS-GAMATechnologies
	 * Author: David Todd (c0de) of http://www.unps-gama.info
	 *
	 * -----------------------------------------------------------
	 * 							TODO:
	 *
	 * Image tag sorting - Single tag sorting possible
	 * Properly align image in post box
	 * Search with multiple terms
	 * JavaScript fo show bigger image if clicked 
	 * Convert to mysqli
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
	
	function uname(){
		if(!empty($_GET['uname'])){ // Show list of pictures uploaded by certain username
			echo "<center><h4>Pictures uploaded from Username: ".$_GET['uname'].":</h4>";
			require('dbsettings.php');
			$uname = sanitize($_GET['uname']); 
			$sql = "SELECT id, name, location, type, size, time, comment, username, tags FROM $tbl_name WHERE username='$uname'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);
			if($count >= 1){
				$i = 0;
				while ($row = mysql_fetch_assoc($result)){
					$id = $row['id'];
					$img = $row['name'];
					$location = $row['location'];
					$type = $row['type'];
					$size = $row['size'];
					$time = $row['time'];
					$comment = $row['comment'];
					$username = $row['username'];
					$tags = $row['tags'];
					echo "<a href=\"?img=$img\">$img</a> - $time - $size - Tags: ";
					$tags = explode(" ", $tags);
					foreach($tags as $tag){
						echo "<a href=\"?tag=$tag\">$tag</a> "; // For future use - catagorize by tag
					}
					echo "<br />";
				}
			}
			echo "</center><br /><hr /><br />";
		}
	}
	
	function tag(){
		if(!empty($_GET['tag'])){ // Show list of pictures according to one tag - maybe multiple tags in the future
			echo "<center><h4>Pictures uploaded with the tag: ".$_GET['tag'].":</h4>";
			require('dbsettings.php');
			$tag = sanitize($_GET['tag']); 
			$sql = "SELECT id, name, location, type, size, time, comment, username, tags FROM $tbl_name WHERE tags LIKE '%$tag%'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);
			if($count >= 1){
				$i = 0;
				while ($row = mysql_fetch_assoc($result)){
					$id = $row['id'];
					$img = $row['name'];
					$location = $row['location'];
					$type = $row['type'];
					$size = $row['size'];
					$time = $row['time'];
					$comment = $row['comment'];
					$username = $row['username'];
					$tags = $row['tags'];
					echo "<a href=\"?img=$img\">$img</a> - $time - $size - Uploader: <a href=\"?uname=$username\">$username</a><br />";
				}
			}
			echo "</center><br /><hr /><br />";
		}
	}
	
	function search(){
		if(!empty($_GET['search']) && $_GET['submit'] == "Search"){ // Show list of pictures according to search term
			$search = sanitize($_GET['search']);
			$search = explode(" ", $search);
			echo "<center><h4>Pictures found using search terms: ";
			foreach ($search as $searches){
				echo $searches." ";
			}
			echo ":</h4>";
			require('dbsettings.php');
			$sql = "SELECT id, name, location, type, size, time, comment, username, tags FROM $tbl_name WHERE tags LIKE '%".$search[0]."%'";
			for($i=1; $i<count($search); $i++){
				$sql = $sql." AND tags LIKE '%".$search[$i]."%'";
			}
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);
			if($count >= 1){
				$i = 0;
				while ($row = mysql_fetch_assoc($result)){
					$id = $row['id'];
					$img = $row['name'];
					$location = $row['location'];
					$type = $row['type'];
					$size = $row['size'];
					$time = $row['time'];
					$comment = $row['comment'];
					$username = $row['username'];
					$tags = $row['tags'];
					echo "<a href=\"?img=$img\">$img</a> - $time - $size - Uploader: <a href=\"?uname=$username\">$username</a><br />";
				}
			}
			echo "</center><br /><hr /><br />";
		}
	}
	
	function sanitize($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = mysql_real_escape_string($output);
		$output = strtolower($output);
		return $output;
	}
	
	function imgstuff(){
		uname();
		tag();
		search();
		if (empty($_GET['img']) || $_GET['img'] == null || $_GET['img'] == ''){
			$img = '';
		}else{
			$img = $_GET["img"]; // get the image
		}
		if(!empty($img) || $img != null || $img != ''){
			require('dbsettings.php');
			$img = sanitize($img); // clean image string
			$sql = "SELECT id, name, location, type, size, time, comment, username, tags FROM $tbl_name WHERE name='$img' LIMIT 1;";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
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
				echo "<img id='the_pic' class='fit' src=\"".$_SESSION['location']."/$img\" /><br /><p></p>";
				//echo "$id<br>$img<br>$location<br>$type<br>$size<br>$time<br>$comment<br>$username<br>$tags\n";
				mysql_close();
			}else{
				$_SESSION['noimg'] = true;
				echo "<center><h3>That image was not found in our database D:</h3></center>";
			}
		}else{
			noimg();
			$_SESSION['noimg'] = true;
		}
	}
	
	function headstuff(){
		echo "<meta property=\"og:title\" content=\"".$_SESSION['img']."\" />\n";
		echo "		<meta property=\"og:url\" content=\"http://img.unps-gama.info/index.php?img=".$_SESSION['img']."\" />\n";
		echo "		<meta property=\"og:image\" content=\"http://img.unps-gama.info/".$_SESSION['location']."/".$_SESSION['img']."\" />\n";
		echo "		<meta property=\"og:description\" content=\"".$_SESSION['comment']."\" />\n";
	}
	
	function textstuff(){
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
	
	function noimg(){
		$thelist = ''; //'<a href="http://localhost/img/?img=meow.png">meow.png</a> Last Modified: <font align="right" color="green">2/8/2013 11:37PM</font><br />';
		if($handle = opendir('Pictures')){
			while(false != ($file = readdir($handle))){
				if($file != "." && $file != ".." && $file != ".htaccess"){
					$thelist .= '<a href="?img='.$file.'">'.$file.'</a></font><br />';
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
				<table>
					<tr>
						<td>
							<center>List of Uploaded Pictures:</center>
						</td>
					</tr>
					<tr>
						<td>
							<center>$thelist</center>
						</td>
					</tr>
				</table>
			</center>
		";
	}
	
	function title(){
		if(empty($img) || $img = null || $img = ''){ 
			echo "";
		}else{
			echo " - Now Showing: ".$img;
		}
	}
?>						
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="description" content="Image Host for UnProfessional Standards" />
		<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
		<meta name="author" content="David Todd" />
		<?php headstuff(); ?>
		<title>UnPS-GAMA Image Host<?php title(); ?></title>
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
						Tagging and Search Systems are still WIP
					</div>
					<div class="post">
						<div class="entry">
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
								<form action="index.php" method="get" name="search" id="search">
									<input name="search" id="search" type="text" placeholder="Search" />
									<input id="submit" name="submit" type="submit" value="Search" />
								</form>
							</div>
						</li>
					</ul>
					<br />
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
										//-->
									</script>
									<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
								</span>
							</div>
						</li>
					</ul>
					<br />
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<span>
									Social Media Buttons Here
								</span>
							</div>
						</li>
					</ul>
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
					}else{
						echo "
						<br />
						<ul>
							<li class=\"widget widget_text\">
								<div class=\"textwidget\">
									<h4>Want to upload pictures?</h4>
									<a href='imgup.php'>Image Uploader Here</a>
								</div>
							</li>
						</ul>
						";
					}
					?>
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