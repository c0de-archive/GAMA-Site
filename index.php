<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
session_start();



if(isset($_GET['mysourceisyours'])) {
   show_source('index.php');
   die();
 }

$token = uniqid(mt_rand(), TRUE);
$_SESSION['token'] = $token;

//$_SESSION['loginid'] = 580658027;

function userpic(){
	$email = "tehfoxy.c0de@gmail.com";
	$default = "http://fox.gy/fCDIjceUvkk.png";	
	$size = 100;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
	return $grav_url;
	//return "http://unps-gama.info/upload/Pictures/zen-avi-hf.png";
}
function username(){
	return "c0de";
}
function shortlinknum(){
	return 55;
}
function imgnum(){
	return 20;
}


$last_modified = filemtime("index.php");
$footer = '
	<p>
	Copyright &copy; 2012-2013 UnPS-GAMATechnologies<br />
	Last Modified: '.date("m/j/y h:i:s a", $last_modified).' 
	Last viewed on: '.date( "m/d/Y h:i:s a").' Server time.
	</p>
'
?>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="description" content="Main page for UnProfessional Standards" />
<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
<meta name="author" content="David Todd" />
<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" href="site.css" />
<title>UnProfessional Standards GAMATechnologies</title>

<script type="text/javascript">
 function unhide(divID) {
	var item = document.getElementById(divID);
	if (item) {
		item.className = 'unhidden';
		if (document.getElementById( "link1" )){
			document.getElementById( "link1" ).setAttribute( "onClick", "hide('friends');" );
		}
	}
 }
  function hide(divID) {
	var item = document.getElementById(divID);
	if (item) {
		item.className = 'hidden';
		if (document.getElementById( "link1" )){
			document.getElementById( "link1" ).setAttribute( "onClick", "unhide('friends');" );
		}
	}
 }
 
  function msg(){
	alert('What are you doing fox!? This isn\'t part of the demo');
 }
</script>
 
 <style type="text/css">
	.hidden { 
		-webkit-transition: all 0.45s ease;
		-moz-transition: all 0.45s ease;
		-o-transition: all 0.45s ease;
		-ms-transition: all 0.45s ease;
		transition: all 0.45s ease;
		display: none; 
	}
	.unhidden { 
		-webkit-transition: all 0.45s ease;
		-moz-transition: all 0.45s ease;
		-o-transition: all 0.45s ease;
		-ms-transition: all 0.45s ease;
		transition: all 0.45s ease;
		display: block; 
	}
 </style>

</head>
<body onload="javascript:checkads();">
<div id="container">
	<div id="header-bg-bg">
		<div id="header-bg">
			<div id="header">
				<a href="#">
					<img src="header.png" alt="UnPS-GAMA Header logo" />
				</a>
			</div>
		</div>
	</div>
	<div id="navigation-bg">
		<div id="navigation">
			<ul>
				<li><a href="#" onclick="javascript:unhide('home');hide('about');hide('contact');">Home</a></li>
				<li><a href="#" onclick="javascript:unhide('about');hide('home');hide('contact');">About</a></li>
				<li><a href="#" onclick="javascript:unhide('contact');hide('home');hide('about');">Contact Us</a></li>
				<li><a href="http://unps.us">URL Shortner</a></li>
				<li><a href="http://img.unps-gama.info">IMGShare</a></li>
				<li><a href="http://p.unps.us">Projects</a></li>
				<li><a href="privacy.html">Privacy Policy</a></li>
				<li><a href="ToS.html">Terms of Service</a></li>
				<li><a href="http://www.unps-gama.info/fp/flatpress">Personal Blog</a></li>
				<li><a href="http://www.unps-gama.info/upload/">Uploads</a></li>
				<li><a href="https://github.com/alopexc0de/GAMA-Site">GitHub</a></li>
			</ul>
		</div>
	</div>
	<div id="content-container1">
		<div id="content-container2">
			<div id="section-navigation" align="center">
				<table>
					<tr>
						<td>
							<ul>
								<li><h4>User Area:</h4><hr /></li>
								<li id="login" style="text-align:center" class="<?php if(isset($_SESSION['loginid']) && $_SESSION['loginid'] != '' || $_SESSION['loginid'] != null) echo"hidden";  ?>">
									<form id="user" name="user" action="#" method="post">
										<input name="uname" id="uname" class="uname" title="Insert Username Here" placeholder="Username" value="" type="text" size="20" />
										<br />
										<input name="upass" id="upass" class="upass" title="Insert Password Here" placeholder="Password" value="" type="password" size="20" />
										<br />
										<input name="register" id="register" value="Register" type="submit" />
										<input name="login" id="login" value="Login" type="submit" />
									</form>
									<hr />
								</li>
								<li id="main" style="text-align:center" class="<?php if(isset($_SESSION['loginid']) && $_SESSION['loginid'] != '' || $_SESSION['loginid'] != null) echo "unhidden"; else echo "hidden";  ?>">
									<img src="<?php echo userpic(); ?>" alt="Profile Picture of <?php echo username(); ?>" title="Profile Picture of <?php echo username(); ?>">
									<br />
									<?php echo username()."\r\n<br />"; ?>
									<a href="profile.php">User Profile</a><br />
									<?php echo shortlinknum()." <a href=\"http://unps.us/?links\">Shortened Links</a><br />\r\n"; ?>
									<?php echo imgnum()." <a href=\"http://img.unps-gama.info/?imgs\">Uploaded Images</a><br />\r\n"; ?>
									<a href="logout.php?token=<?php echo $token; ?>">Logout</a>
									<hr />
								</li>
							</ul>
							<br />
						</td>
					</tr>
					<tr>
						<td>
							<ul>
								<li><h4>Offered Services:</h4><hr /></li>
								<li><a href="http://teamspeak.com/">TeamSpeak</a> - ts.unps.us:9987</li>
								<li><a href="http://img.unps-gama.info">Image Host</a></li>
								<li><a href="http://unps.us">URL Shortner</a></li>
								<li><a href="upload.html">File Storage</a> (up to 20MB)</li>
								<hr />
							</ul>
							<br />
						</td>
					</tr>
					<!--<tr> I didn't really like how this was pulled off. I may readd this later, or it could be dead code
						<td>
							<ul>
								<li><a id="link1" href="#" onclick="javascript:unhide('friends');"><h4>Friends</h4></a></li>
								<div id="friends" class="hidden" align="center">
									<hr /><br />
									<li><a href="http://furcast.fm"> Furcast </a></li>
									<li><a href="http://fridaynighttech.com"> Friday Night Tech </a></li>
									<li><a href="http://xanacreations.com"> XanaCreations </li>
									<li><a href="http://doridian.de"> Doridian </li>
									<li><a href="https://foxcav.es"> FoxCaves </a></li>
									<li><a href="http://ruinsofmc.com"> Ruins of Minecraft </a></li>
									<hr />
								</div>
							</ul>
						</td>
					</tr>-->
				</table>
			</div>
			<div id="content">
				<div id="home" class="unhidden">
					<h2>
						UnProfessional Standards - GAMATechnologies | Home Page
					</h2><hr />
					<div class="content-post-wrapper">
						<div id="content-post">
							<h3>
								@Dec 10th, 2012 - Sometime: 
							</h3><hr />
							<p>
								I've created something of a project repo. This will be where I test a lot of things before I commit them. 
								Some directories will be password protected to have a closed beta for some people. Anything not protected, unless otherwise stated in the comments, is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. To view a copy of this license, visit <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">http://creativecommons.org/licenses/by-nc-sa/3.0/</a>
							</p>
						</div>
					</div>
					<br />
					<div class="content-post-wrapper">
						<div id="content-post">
							<h3>
								@Nov 16, 2012 - 1933 EST: 
							</h3><hr />
							<p>
								Our new updated image host, which can be found at <a href="http://img.unps-gama.info/">IMGShare</a>, is one of our recent changes. Others include a <br /><a href="http://unps-gama.info/ToS.html">Terms of Service</a>, and a <a href="http://unps-gama.info/privacy.html">Privacy Policy</a>.
							</p>
						</div>
					</div>
					<br />
					<div class="content-post-wrapper">
						<div id="content-post">
							<h3>
								@Nov 2, 2012 - 0130 EST: 
							</h3><hr />
							<p>
								We have officially launched with an actual domain name! In the next few days you'll also see some changes to this site, hopefully for the better. I have been hard at work setting up an email system, and it has caused a lot of grief. If you see webmail one day, then great, I managed to get the mysql working with postfix and whatever I choose to use for webmail. Registration is, as always going to be free. I am also currently adding mysql to other sections of my site, and I'm debating on requiring user login for uploading files and pictures. I have added a privacy policy <a href="http://www.unps-gama.info/privacy.html">Here</a>. So have fun with that.
							</p>
						</div>
					</div>
					<br />
					<div class="content-post-wrapper">
						<div id="content-post">
							<p>
								Hello and welcome to the newly designed UnPS-GAMA website! The past week has mainly been spent upgrading my image share system, and it is nearly at completion. I have been absolutly dreading redesiging this page, but I decided today, September 13th 2012 at 1500 EST, that I would finally get to work. I decided to start more from scratch and pull in the things that I wanted. Currently this is beta and not every page is done with formatting. Pages that I'm happy with for now (aside for not having CSS2 or XHTML1 compliance) are the <a href="http://www.unps-gama.info/404.html">404</a> page, and pretty much anything with the <a href="http://www.unps-gama.info/img">image host</a>. Pages that I need to work on are the upload, contact us, and about pages so far. As of now, they'll just redirect to the 404 page until I get to them.<br />As I have placement tests for college today, I am trying to get as much done as I can before then, <strike>but it could be unlikely that I get the page uploaded and live until then.</strike> I got it uploaded and debugged quickly. There are some alignment issues but good otherwise. Updates soon to follow.
							</p>
						</div>
					</div>
					<br />
					<div id="content-foot">
						<?php echo $footer; ?>
					</div>
				</div>
				<div id="about" class="hidden">
					<h2>
						UnProfessional Standards - GAMATechnologies | About Us
					</h2>
					<hr />
					<div class="content-post-wrapper">
						<div id="content-post">
							<p>
								What I do is I host web services. If you want to use me for anything, then feel free to contact me at <a href="mailto:c0de@unps-gama.info">c0de</a>. Most of what I offer is free for anyone, and I can terminate service for anybody, including to the point of not being able to access anything on the GAMA network. If I decide to terminate service however, I will compress any of your files and give you a link. The link is only good for ~48 hours before it will be deleted automatically. Services that I offer by default are listed to the left, these are free for anyone who wants to use them. Depending on your request I might be able to host other things though, just ask.
								<br />
								Our privacy policy can be found <a href="privacy.html">Here</a>, and our Terms of Service can be found: <a href="ToS.html">Here</a>.
							</p>
						</div>
					</div>
					<br />
					<div id="content-foot">
						<?php echo $footer; ?>
					</div>
				</div>
				<div id="contact" class="hidden">
					<h2>
						UnProfessional Standards - GAMATechnologies | Contact Us
					</h2><hr />
					<div class="content-post-wrapper">
						<div id="content-post">
							<h3>
								So You Want to Contact me? Lets see what I can do for you...
							</h3><hr />
							<p>
								I have quite an online presence, but here I'll list just a few places to easily get in contact with me :3
								<br />
								<ul style="list-style-type: none;">
									<li>Skype: <a href="skype:alopexlagopus-c0de?chat">alopexlagopus-c0de</a></li><br />
									<li>Email: <a href="mailto:c0de@unps-gama.info">c0de@unps-gama.info</a></li><br />
									<li>Facebook: <a href="http://facebook.com/alopexc0de">alopexc0de</a></li><br />
									<li>HF: <a href="http://www.hackforums.net/member.php?action=profile&uid=1216472">alopexlagopus</a></li>
								<ul />
							</p>
						</div>
					</div>
					<br />
					<div id="content-foot">
						<?php echo $footer; ?>
					</div>
				</div>
			</div>
			<div id="aside">
				<div id="ads">
					<script type="text/javascript" id="theads" "><!--
						google_ad_client = "ca-pub-6762927271223365";
						/* sidebar ads */
						google_ad_slot = "1523932882";
						google_ad_width = 120;
						google_ad_height = 240;
						//-->
					</script>
					<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
				</div>
				<div id='noa' class="hidden">
					<p>
						The reason you're seeing this is because either through our fault, or you just have an adblocker, the ads have failed to load. 
						<br /> 
						Ads are great you know. I pay for these domains out of pocket, it doesn't hurt to click an ad once in a while...
					</p>
				</div>
				<br />
				<ul>
					<li>
						<h3>
							Upload Files (20MB limit)
						</h3><hr />
						<p>
							If you can't find your file, check <a href="#">Uploads</a> for your files.
						</p>
						<form enctype="multipart/form-data" method="post" action="upload.php">
							<label for="file">Filename:</label>
							<input id="file" type="file" name="file" /><br />
							<input value="Upload!" type="submit" name="submit" />
						</form>
						<hr />
					</li>
				</ul>
				<br />
				<ul>
					<li>
						<h3>Files currently on GAMA: </h3><hr />
						<?php 
							include 'upload-list.php';
							getDirectory( "./upload" ); 
						?>
						<hr />
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>
