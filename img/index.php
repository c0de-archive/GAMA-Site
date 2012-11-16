<html prefix="og: http://ogp.me/ns#">
	<head>
		<meta name="description" content="UnPS-GAMA IMGSHARE" />
		<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
		<meta name="author" content="David Todd" />
		<link rel="shortcut icon" type="image/ico" href="http://unps-gama.info/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="http://unps-gama.info/favicon.ico" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
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
		<style>
			* {
				padding: 0;
				margin: 0;
			}
			.fit {
				max-width: 100%;
				max-height: 100%;
			}
			.center {
				display: block;
				margin: auto;
			}
			.image{
				text-align: center;
				max-width: 100%;
				max-height: 100%;
				color: #fff;
				float: center;
			}
			.info{
				text-align: right;
				max-width: 100%;
				max-height: 100%;
				color: #fff;
				float: right;
			}
		</style>
	</head>
	<body background="https://si0.twimg.com/profile_background_images/468495900/bg.gif" text="white" link="red" vlink="purple">
		<div align="center">
			<a href="http://www.unps-gama.info/">
				<img src="http://unps-gama.info/upload/Pictures/header.png" alt="To UnPS-GAMA" title="To Home" />
			</a>
		<br>

<?php
function sanatize($input){
	if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
	$output = strip_tags($input);
	$output = stripslashes($output);
	$output = mysql_real_escape_string($output);
	$output = strtolower($output);
	return $output;
}

$img = $_GET["img"]; // get the image
if(isset($img) || $img != null || $img != ''){
require('dbsettings.php');

$img = sanatize($img); // clean image string

$sql = "SELECT id, name, location, type, size, time, comment, username FROM $tbl_name WHERE name='$img'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if($count == 1){
	$i = 0;
	while ($row = mysql_fetch_assoc($result)){ // Attempt to pull all data concerning that one user from table	
		$id = $row['id'];
		$img = $row['name'];
		$location = $row['location'];
		$type = $row['type'];
		$size = $row['size'];
		$time = $row['time'];
		$comment = $row['comment'];
		$username = $row['username'];

		echo "<meta property='og:title' content='". $img ."' />\n";
		echo "<meta property='og:url' content='http://img.unps-gama.info/index.php?img=". $img ."' />\n";
		echo "<meta property='og:image' content='http://img.unps-gama.info/". $location."/".$img ."' />\n";
		echo "<meta property='og:description' content='http://img.unps-gama.info/". $comment ."' />\n";
		$title = " - Now Showing: " . $img;
		echo "<title>GAMA IMGShare" . $title ."</title>\n";
		echo "
						<table id=\"image\">
							<tr>
								<td><img id='the_pic' class='fit' src=\"$location/$img\" /></td>
								<td>
									<table id=\"info\">
							<tr>
								<td>
									Currently Viewing: $img
								</td>
							</tr>
							<tr>
								<td>
									Image Type: $type
								</td>
							</tr>
							<tr>
								<td>
									Image Size: $size
								</td>
							</tr>
							<tr>
								<td>
									Time/Date Posted: $time
								</td>
							</tr>
							<tr>
								<td>
									Poster's Username: $username
								</td>
							</tr>
							<tr>
								<td>
									Poster's Comment: $comment
								</td>
							</tr>
							<tr>
								<td>
									<a href=\"index.php\">Back to index</a>
								</td>
							</tr>
						</table>
								</td>
							</tr>
						</table>
						";
		mysql_close();
	}	
}}else{
	include('getfiles.php');
	echo "
		<title>GAMA IMGShare</title>
		<img src='zen1.png' align='left'>
		<p>You didn't specify an image. This is an image hoster.
		<img src='zen1.png' align='right'> 
		<br />
		Please specify an image with the url: <font color='blue'><code>img.unps-gama.info/?img=(IMGAGE STUFF HERE)</code></font></p>
		<br />
		<h4>Want to upload pictures?</h4>
		<a href='imgup.php'>Image Uploader Here</a><br />
		<hr />";
		echo "<table><tr><td><P>List of files:</p></td></tr><tr><td>" . $thelist . "</td></tr></table>";
	mysql_close();
}
?>
</div>
