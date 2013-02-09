<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="description" content="Main page for UnProfessional Standards" />
<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
<meta name="author" content="David Todd" />
<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" href="files/style.css" type="text/css" media="screen" />
<title>UnProfessional Standards GAMATechnologies</title>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24492597-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

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
  function ButtonClicked(field){
	var nomatch = document.getElementById("PasswordSame");
		nomatch.innerHTML = "The Passwords Match";
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

<body>

<div id="page_wrap">
	<div id="header">
		<div class="blog_title">
			<h1>
				<a href="index.php">
					<img src="files/header.png" alt="Link to home" />
				</a>
			</h1>
		</div>
		<div class="clear"></div>
	</div><!-- end header -->
	
	<div id="main_navi">
		<ul class="left">
			<li><a href="#" onclick="javascript:unhide('home');hide('about');hide('contact');">Home</a></li>
			<li><a href="#" onclick="javascript:unhide('about');hide('home');hide('contact');">About</a></li>
			<li><a href="#" onclick="javascript:unhide('contact');hide('home');hide('about');">Contact</a></li>
			<li><a href="http://unps.us" target="_unps">Shortener</a></li>
			<li><a href="http://img.unps-gama.info" target="_img">IMGShare</a></li>
			<li><a href="http://p.unps.us" target="_pro">Projects</a></li>
			<li><a href="https://github.com/alopexc0de/GAMA-Site" target="_git">GitHub</a></li>
    	</ul>
		
		<ul class="right">
			<li class="twitter"><a href="http://twitter.com/upstandards" title="Follow UnPS on twitter">TWITTER</a></li>
			<!--<li class="feed"><a href="rss.xml" title="Get all updates in our feed">RSS</li>-->
		</ul>
	</div><!-- end main_navi --><!-- Images can be up to 624px in width -->
	<div class="clear">
	</div>
	<div id="container">
		<div id="main">
				<div class="unhidden" id="home">
				<div class="post">
				<div class="date">
					2013<br />
					02.04				</div>
				<div class="title">
					<h2><a href="#" onclick="javascript:unhide('ndes');hide('ndesp')">New Design (Again)</a></h2>
					<div class="postmeta">
						<p>c0de just can't make up his mind - might have found something that works</p>
					</div>
				</div><!-- end title -->
				<div class="clear">
				</div>
				<div class="entry">
						<div class="unhidden" id="ndesp">
							<p>
								So yeah. It's only day 3 of not having internet, but I felt like changing everything again.
								The 3 coloum fluid design is out the window since I can't figure out what to put on the left side other than user controls
								and those can go on the right side just fine. So I'm going to be using <a href="http://imotta.cn/wordpress/pyrmont-theme-v2-for-wordpress.html">Pyrmont v2</a> that I made some modifications to.
								This design feels great. Also new header image :D - I really like the blue fire matrix thing that it has going on... 
								<a href="#" onclick="javascript:unhide('ndes');hide('ndesp')">(Click title or here to read full post)</a>
							</p>
						</div>
						<div class="hidden" id="ndes">
							<p>
								So yeah. It's only day 3 of not having internet, but I felt like changing everything again.
								The 3 coloum fluid design is out the window since I can't figure out what to put on the left side other than user controls
								and those can go on the right side just fine. So I'm going to be using <a href="http://imotta.cn/wordpress/pyrmont-theme-v2-for-wordpress.html">Pyrmont v2</a> that I made some modifications to.
								This design feels great. Also new header image :D - I really like the blue fire matrix thing that it has going on.
								Greg said that my new design was 1000 times better than my old one. This was a few weeks ago when I made everything curvy.
								He hasn't seen this version yet, but I think it looks 1000 times better than my super curvy version, not to mention that everything is properly aligned now. It has all the functionality of the curvy version (excepting the non-working login system - I made a working version, but that's on my linux drive) and even a little bit more functionality with better designed CSS.
								I'm very happy with how it looks for now and it's ready to intigrate with my main site. If I get the chance in a few days, I'll upload everything. <br /><br />
								Also as an addendem, I'm writing blog posts in a text file on my desktop and I'll make one big post on my livejournal. -c0de
								<br />
								<a href="#" onclick="javascript:hide('ndes');unhide('ndesp')">(Click here to hide full post)</a>
							</p>
						</div>
					<div class="clear"></div>
				</div><!-- end entry --></div><!-- end post -->
				
				<div class="post">
				<div class="date">
					2012<br />
					12.10				</div>
				<div class="title">
					<h2>New Project Repo thingy</h2>
					<div class="postmeta">
						<p><a href="http://p.unps.us">p.unps.us</a> for hosted projects and demos</p>
					</div>
				</div><!-- end title -->
				<div class="clear">
				</div>
				<div class="entry">
					<p>
						I've created something of a project repo. This will be where I test a lot of things before I commit them. 
						Some directories will be password protected to have a closed beta for some people. Anything not protected, unless otherwise stated in the comments, is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. To view a copy of this license, visit <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">http://creativecommons.org/licenses/by-nc-sa/3.0/</a>
					</p>
					<div class="clear"></div>
				</div><!-- end entry --></div><!-- end post -->
				
				
				<div class="post">
				<div class="date">
					2012<br />
					11.16				</div>
				<div class="title">
					<h2>Site Updates</h2>
				</div><!-- end title -->
				<div class="clear">
				</div>
				<div class="entry">
					<p>
						Our new updated image host, which can be found at <a href="http://img.unps-gama.info/">IMGShare</a>, is one of our recent changes. Others include a <a href="ToS.html">Terms of Service</a> and <a href="privacy.html">Privacy Policy</a>.
					</p>
					<div class="clear"></div>
				</div><!-- end entry --></div><!-- end post -->
				
				<div class="post">
				<div class="date">
					2012<br />
					11.02				</div>
				<div class="title">
					<h2>Offical Domain Launch</h2>
				</div><!-- end title -->
				<div class="clear">
				</div>
				<div class="entry">
					<p>
						We have officially launched with an actual domain name! In the next few days you'll also see some changes to this site, hopefully for the better. I have been hard at work setting up an email system, and it has caused a lot of grief. If you see webmail one day, then great, I managed to get the mysql working with postfix and whatever I choose to use for webmail. Registration is, as always going to be free. I am also currently adding mysql to other sections of my site, and I'm debating on requiring user login for uploading files and pictures. I have added a privacy policy <a href="privacy.html">Here</a>. So have fun with that.
					</p>
					<div class="clear"></div>
				</div><!-- end entry --></div><!-- end post -->
				
				<div class="post">
				<div class="clear">
				</div>
				<div class="entry">
					<p>
						Hello and welcome to the newly designed UnPS-GAMA website! The past week has mainly been spent upgrading my image share system, and it is nearly at completion. I have been absolutly dreading redesiging this page, but I decided today, September 13th 2012 at 1500 EST, that I would finally get to work. I decided to start more from scratch and pull in the things that I wanted. Currently this is beta and not every page is done with formatting. Pages that I'm happy with for now (aside for not having CSS2 or XHTML1 compliance) are the <a href="http://www.unps-gama.info/404.html">404</a> page, and pretty much anything with the <a href="http://www.unps-gama.info/img">image host</a>. Pages that I need to work on are the upload, contact us, and about pages so far. As of now, they'll just redirect to the 404 page until I get to them.<br />As I have placement tests for college today, I am trying to get as much done as I can before then, <strike>but it could be unlikely that I get the page uploaded and live until then.</strike> I got it uploaded and debugged quickly. There are some alignment issues but good otherwise. Updates soon to follow.
					</p>
					<div class="clear"></div>
				</div><!-- end entry --></div><!-- end post -->
				</div>
				<div class="hidden" id="about">
				<div class="post">
					<div class="date">
						2013<br />
						02.02
					</div>
					<div class="title">
						<h2>
							About UnPS-GAMATechnologies
						</h2>
					</div>
					<div class="clear"></div>
					<div class="entry">
						<p>
							UnProfessional Standards - GAMATechnologies, or UnPS-GAMA, originally started as a podcast about the Valve game, Team Fortress 2. 
							The name then was just UnProfessional Standards and it had pretty much two episodes made by the main cast and one episode by one person from the main cast and his friend. This was in 2010, and you can still find the first episode online <a href="http://davitodd.webs.com">Here</a> on this site. <br /><br />
							Now at the time, I had no idea how to run a podcast, and I still don't really know, but it was an unsucessful thing. 
							A couple months past and I asked my friend for permission to have the UnProfessional Standards name as my own since I recorded, edited, coordnated, uploaded and hosted the very short lived podcast. <br /><br />
							I made several attempted uses of the name, I knew I wanted a technology thing, but at that time, I was still young and didn't know much about running a website. I tinkered with things until they worked, and even then they were very basic. 
							I was only using HTML based off of CSS that I had blatently stolen because I had no idea how to use CSS at all and haden't even dared to touch PHP. Things have changed over the past year however. <br /><br />
							I moved off of free hosting (with <a href="http://000webhost.com">000Webhost</a> and a <a href="http://dot.tk">Dot Tk</a> domain) onto a paid VPS (obtained through a very close friend of mine - Thank you Dori <3) and two domains (unps-gama.info and unps.us) that I pay for out of my money. <br /><br />
							I've been using php for a few months now and I have to say that I quite like it and that I'm glad that the vast majority of my site runs on php. In it's current state, this site is more in flux because I'm not happy with layout, but I'm still not the best at CSS, though I have gotten a whole lot better, and I don't know what to actually have on the website.<br /><br />
							What I currently have is the <a href="http://www.unps-gama.ino">main page</a> - a pseudo-blog of sorts for site updates, an <a href="http://img.unps-gama.info">image host</a> that I had put a lot of work into and it's constantly getting new features and losing old ones, a <a href="http://unps.us">link shortener</a> similar to bit.ly and stuff like that - 100% php with a small amount of my own design of CSS and is also constantly being updated, <a href="http://p.unps.us">project repo</a> is where I run live demos and show source code - totally hacked together in 5 minutes could have XSS problems. The only live demo on it is my password hashing function that can be found in multiple locations, including, recently, GitHub. 
							<br /><br />
							The header image itself has a story, going through a lot of revisions. The current one is the 16th and it's sure to change again eventually. The logo on the left and right side of the image was originally the TF2 logo (used without permission) many revisions back. Since then I designed a new logo, based heavily on "The Eye of XANA" from the first series of a French anime called "Code Lyoko". This since has become my own personal logo that can, in a way, be considered a signature from me and it is my copyright as well. Unlike almost anything else that I publish, which I put a Creative Commons license on, my logo has no license and I retain all rights with it. I don't naturally trust other people to design a new header, so I do everything on my own.
							<br /><br />
							The name GAMA, while similar in sound and lettering to XANA, is not the same nor is it based on that name in any way. 
							GAMA comes from my imagination from a few years back in the summer of 2007. 
							It's an acroymn for GAMA Assists Me Alot (gotta love those recursive names~), while originally it stood for Gadget Assists Master Always, basically a self aware friendly self-evolving AI with a solid defination of Master. 
							GAMA was created as a sort of anti-virus to GOMA (Gadget Obeys Master Always), a self aware friendly self-evolving AI that got corrupted with a virus and changed what Master means to mean itself due to loose coding.
							So GAMA won and analysed GOMA's code and integrated itself in places where GOMA once was before.
							GAMA has also become a personal logo to me and what I said above about the logo applies here.
							<br /><br />
							I'm sorry for typing this really long thing. I'm just in a typing mood right now.
						</p>
					</div>
				</div>
				</div>
				<div class="hidden" id="contact">
				<div class="post">
					<div class="date">
						2013<br />
						02.02
					</div>
					<div class="title">
						<h2>
							Contact Me
						</h2>
					</div>
					<div class="clear"></div>
					<div class="entry">
						<p>
							I'm taking a short hiatus from the internet (several months), so you can contact me at <a href="mailto:upstandards@gmail.com">Upstandards[at]gmail.com</a>. My other email: c0de[at]unps-gama.info used to work, but I have suspended that for a while.
						</p>
					</div>
				</div>
				</div>
	    	</div><!-- end main -->
		<div id="sidebar">
			<ul>
				<li class="widget widget_text">
					<div class="textwidget">
						<span>
							ADS GO HERE
							<!--<script type="text/javascript">
								//<!--
								google_ad_client = "ca-pub-6762927271223365";
								/* sidebar ads */
								google_ad_slot = "1523932882";
								google_ad_width = 120;
								google_ad_height = 240;
								//- ->
							</script>
							<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>-->
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
				<br />
			<ul>
				<li class="widget widget_text">
					<div class="textwidget">
						<ul>
							<li><h4>Offered Services:</h4></li>
							<li></li>
							<li><a href="http://teamspeak.com/">TeamSpeak</a> - ts.unps.us:9987</li>
							<li><a href="http://img.unps-gama.info">Image Host</a></li>
							<li><a href="http://unps.us">URL Shortner</a></li>
							<li><a href="upload.html">File Storage</a> (up to 20MB)</li>
						</ul>
					</div>
				</li>
			</ul>
				<br />
			<ul>
				<li class="widget widget_text">
					<div class="textwidget">
						<div style="font-size:12 px">
							<h5>
								Upload Files (20MB limit)
							</h5>
							<form enctype="multipart/form-data" method="post" action="upload.php">
								<label for="file">Filename:</label>
								<input id="file" type="file" name="file" /><br />
								<input value="Upload!" type="submit" name="submit" />
							</form>
							<br /><div align="left">
							<h5>Files Currently on GAMA: </h5>
							<?php
								include 'upload-list.php';
								getDirectory( "./upload" ); 
							?>
							</div>
						</div>
					</div>
				</li>
			</ul><!-- end ul -->
		</div><!-- end sidebar -->
		<div class="clear"></div>
	</div><!-- end container -->
</div><!-- end page_wrap -->
<div id="footer">
	<div class="footer_wrapper">
		<div class="footer_left">
			<p>
				<a href="privacy.html">Privacy Policy</a> - <a href="ToS.html">Terms of Service</a> - Modified <a href="http://imotta.cn/wordpress/pyrmont-theme-v2-for-wordpress.html">Pyrmont V2</a> - <strong>Copyright &copy; 2012-2013 UnPS-GAMA</strong> 
			</p>
		</div>
	</div>
</div><!-- end footer -->
</body></html>
