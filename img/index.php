<?php
	session_start();
	$pst = microtime(true);
	
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
	 * Optomize Upload - Uses 4 mysql calls to upload 1 file
	 * Force Spaces in tags
	 * Multiple tags without search?
	 * Classes? - Might just go as far as to seperate the functions
	 * Temporarly dropped support for bitmap files until I learn how to generate those
	 * unps.us picture redirection support? (unps.us/?i=name.ext redirect to img.unps-gama.info/?img=name.ext) 
	 * New idea for recent pictures: Instead of using one row in db and array tricks, use multiple rows and order by dateposted in decending order - $sql = "SELECT * FROM `recentpics` ORDER BY `dateposted` DESC LIMIT 2"; - Should reduce upload sql queries to only two.
	 *
	 * -----------------------------------------------------------
	 *
	 * For unps.us short image link support
	 * if(isset($_GET['i']) && !empty($_GET['i'])){
	 * 	header('location:http://img.unps-gama.info/?img='.$_GET['i']);
	 * }
	 *
	 */
		
	require('helper.get.php'); // Helper.Get.php - Holds the functions for get - uname, tag, search, and upload
	require('helper.clean.php'); // Helper.Clean.php - Holds the functions for cleaning input and output
	require('helper.genthumb.php'); // Helper.GenThumb.php - Function for generating thumbnails on upload
	require('img.extra.php'); // Img.Extra.php - Extra main functions
	require('img.main.php'); // Img.Main.php - Main program
	
	// Refresh the thumbnails on the fly - secretpassword123 will of course be changed when put online
	if(!empty($_GET['generatenewthumbnailsformeprettyplease']) && $_GET['generatenewthumbnailsformeprettyplease'] == 'secretpassword123'){
		createThumbs();
	}
	
	// Declare variables so it doesn't complain to me later x.x
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

	function showads(){
		// Code for ads or something...
		$db = new mysqli('localhost', 'adds', 'password', 'adds'); // hostname. username, password, database
		if($db->connect_errno > 0){
    		die('Unable to connect to database [' . $db->connect_error . ']');
		}

		$rand = mt_rand(1, 6);
		$ads = "SELECT * FROM `ads` WHERE `id` = $rand";

		if(!$result = $db->query($ads)){
			die('There was an error running the query [' . $db->error . ']');
		}
		$row = $result->fetch_assoc();
		if($row){
			return '<a href="'.$row['link'].'" target="_'.$row['cname'].'"><img src="'.$row['image'].'" alt="ad for '.$row['cname'].'" title="'.$row['title'].'" /></a>';
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
	 *                           TODO:
	 *
	 * JavaScript fo show bigger image if clicked 
	 * Optomize Upload - Uses 4 mysql calls to upload 1 file
	 * Force spaces on tags
	 * Multiple tags without search?
	 * Classes? - Might just go as far as to seperate the functions
	 * Temporarly dropped support for bitmap files until I learn how to generate those
	 * unps.us picture redirection support? (unps.us/?i=name.ext redirect to img.unps-gama.info/?img=name.ext)
	 * New idea for recent pictures: Instead of using one row in db and array tricks, use multiple rows and order by dateposted in decending order - $sql = "SELECT * FROM `recentpics` ORDER BY `dateposted` DESC LIMIT 2"; - Should reduce upload sql queries to only two.
	 *
	 * -----------------------------------------------------------
	 *
	 * For unps.us short image link support
	 * if(isset($_GET['i']) && !empty($_GET['i'])){
	 * 	header('location:http://img.unps-gama.info/?img='.$_GET['i']);
	 * }
	 *
-->
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="description" content="Image Host for UnProfessional Standards" />
		<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
		<meta name="author" content="David Todd" />
		<?php
		if(isset($_GET['img']) && !empty($_GET['img'])){
			echo "<meta property=\"og:title\" content=\"".$_GET['img']."\" />\n";
			echo "		<meta property=\"og:url\" content=\"http://img.unps-gama.info/index.php?img=".$_GET['img']."\" />\n";
			echo "		<meta property=\"og:image\" content=\"http://img.unps-gama.info/Pictures/".$_GET['img']."\" />\n";
			echo "		<meta property=\"og:description\" content=\"".$_GET['img']."\" />\n";
			echo "		<title>UnPS-GAMA Image Host - Now Showing: ".$_GET['img']."</title>\n";
		}else{
			echo "<title>UnPS-GAMA Image Host</title>\n";
		}
		?>
		<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.zclip.js"></script>
		<script type="text/javascript" language="JavaScript">
			function set_body_height(){
				var wh = $(window).height();
				$('body').attr('style', 'height:' + wh + 'px;');
			}
			$(document).ready(function() {
				set_body_height();
				$(window).bind('resize', function() { set_body_height(); });
				$('a#copy-description').zclip({
					path:'ZeroClipboard.swf',
					copy:$('a#copy-description').text()
				});
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
			</div> <!-- End Header -->
			
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
			</div> <!-- End Navbar -->
			
			<div class="clear"></div>
			
			<div id="container">
				<div id="mainwide" class="ad">
					<div class="post"><!-- 925x96px seems optimal -->
						<?php
							echo showads();
						?>
					</div> <!-- End Post -->
				</div> <!-- End MainWide -->
				<div id="main">
					<!--<div class="sticky">
						Force spaces on tags
					</div> <!-- End Sticky -->
					<div class="post">
						<div class="entry"><!-- Begin image stuff php -->
							<?php 
								imgstuff();
							?>
						</div> <!-- End Entry -->
					</div> <!-- End Post -->
				</div> <!-- End Main -->
				
				<div id="sidebar">
					<ul> <!-- Searchbar -->
						<li class="widget widget_search">
							<div id="search">
								<form action="" method="get" name="search" id="search">
									<input name="search" id="search" type="text" placeholder="Search" />
									<input id="submit" name="submit" type="submit" value=" Search " /><br />
									<div style="padding-left:29px;padding-top:3px;float:left;">
										<input name="google" id="google" type="checkbox" /> Google Search This
									</div><br />
								</form>
							</div>
						</li>
					</ul>
					<!--<br /> Might not keep this - Social Media Buttons
					<ul>
						<li class="widget widget_text">
							<div class="textwidget">
								<span>
									Social Media Buttons Here
								</span>
							</div>
						</li>
					</ul>-->
					<br />
					<ul> <!-- Recent Pictures -->
						<li class="widget widget_text">
							<div class="textwidget">
								<h3>Recently Uploaded Pictures</h3><p></p>
								<?php
									require('dbsettings.php');
									$sql = "SELECT * FROM `recentpics` WHERE `id` = 1";
									if(!$result = $db->query($sql)){
										die('There was an error running the query [' . $db->error . ']');
									}
									$row = $result->fetch_assoc();
									if ($row){
										$thethumbs = '';
										if($thumbs = opendir('thumbs')){
											while(false != ($fiel = readdir($thumbs))){
												if($fiel != "." && $fiel != ".." && $fiel != ".htaccess"){
													$thethumbs .= "-".$fiel;
												}
											}
											closedir($thumbs);
										}
										$thethumbs = explode("-", $thethumbs);
										$name = $row['name'];
										$name = explode("-", $name);
										foreach($name as $names){
											if(in_array($names, $thethumbs)){
												echo '<a href="?img='.$names.'"><img src="thumbs/'.$names.'" alt="'.$names.'" title="'.$names.'"/></a>'."\n								";
											}else{
												echo '<a href="?img='.$names.'"><img src="nothumb.png" alt="'.$names.'" title="'.$names.'"/></a>'."\n								";
											}
										}
									}else{
										echo "Error getting images from database";
									}
									echo "\n";
								?>
							</div>
						</li>
					</ul>
					<!-- textstuff is right under here (not shown unless picture is viewed though) -->
					<?php // Image info
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
					<ul> <!-- Upload -->
						<li class="widget widget_text">
							<div class="textwidget">
								<h4>Want to upload pictures?</h4>
								<a href='?upload'>Image Uploader Here</a>
							</div>
						</li>
					</ul>
				</div> <!-- End Sidebar -->
			</div> <!-- End Container -->
		</div> <!-- End Page_Wrap -->
		<div id="footer">
			<div class="footer_wrapper">
				<div class="footer_left">
					<p>
						<a href="http://www.unps-gama.info/privacy.html">Privacy Policy</a> - <a href="http://www.unps-gama.info/ToS.html">Terms of Service</a> - Modified <a href="http://imotta.cn/wordpress/pyrmont-theme-v2-for-wordpress.html">Pyrmont V2</a> - <strong>Copyright &copy; 2012-2013 UnPS-GAMA</strong>
					</p>
				</div> <!-- End Footer_Left -->
				<div class="footer_right">
					<p>
						<?php echo "Page generated in: ".round(number_format(microtime(true)-$pst,6), 4)." Seconds"; ?>
					</p>
				</div> <!-- End Footer_Right -->
			</div> <!-- End Footer_Wrapper -->
		</div> <!-- End Footer -->
	</body>
</html>
<?php session_unset(); session_destroy();  // To stop carrying over of unneeded info ?>