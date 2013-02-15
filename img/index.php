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
	 * Recently Uploaded Pictures on sidebar - OUTPUT DONE - FIX INPUT (upload)
	 * Automatic thumbnail generation - genthumb() (100px x 100px)
	 * Force Spaces in tags
	 * Fix headstuff() and title()
	 * Multiple tags without search?
	 * Classes?
	 *
	 * -----------------------------------------------------------
	 */
		
	require('helper.get.php'); // Helper.Get.php - Holds the functions for get - uname, tag, search, and upload
	require('helper.clean.php'); // Helper.Clean.php - Holds the functions for cleaning input and output
	require('helper.genthumb.php'); // Helper.GenThumb.php - Function for generating thumbnails on upload
	require('img.extra.php'); // Img.Extra.php - Extra main functions
	require('img.main.php'); // Img.Main.php - Main program
	
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
	 * Recently Uploaded Pictures on sidebar - OUTPUT DONE - FIX INPUT (upload)
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