<?php
$img = $_GET["img"];
strip_tags($img);
$img = strip_tags($img);
?>
<html prefix="og: http://ogp.me/ns#">
<head>
<meta name="description" content="UnPS-GAMA IMGSHARE" />
<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
<meta name="author" content="David Todd" />
<?php
if ($img == null){
	$title = " ";
}else{ 
	$title = " - Now Showing: " . $img;
	print "<meta property='og:title' content='". $img ."' />\n";
	print "<meta property='og:url' content='http://unps-gama.tk/img/index.php?img=". $img ."' />\n";
	print "<meta property='og:image' content='http://unps-gama.tk/img/". $img ."' />\n";
	print "<meta property='og:description' content='http://unps-gama.tk/img/". $img ."' />\n";
}
print "<title>GAMA IMGShare" . $title ."</title>\n";
?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" language="JavaScript">
function set_body_height()
{
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
</style>
<body background="https://si0.twimg.com/profile_background_images/468495900/bg.gif" text="greem" link="red" vlink="purple">
<div align="center">

<a href="http://unps-gama.tk/img/">
<img src="http://unps-gama.tk/upload/Pictures/header.png" alt="To UnPS-GAMA" title="To Home" />
</a>
<br>
<?php

include('getfiles.php');




if ($img == null){
echo "<img src='zen1.png' align='left'><p>You didn't specify an image. This is an image hoster.<img src='zen1.png' align='right'> <br />Please specify an image with the url: <font color='blue'><code>unps-gama.tk/img/?img=(IMGAGE STUFF HERE)</code></font></p><br /><h4>Want to upload pictures?</h4><a href='imgup.php'>Image Uploader Here</a><br /><hr /><br />" . "<table><tr><td><P>List of files:</p></td><td>" . $thelist . "</td></table>";

}else{
echo "<table><div align='center'>\n";
echo "<tr><td><div align='center'><a href='./'><b><---- Back to Index</b></a></div></td><tr>\n";
echo "<tr><td><div align='center'><a href='http://unps-gama.tk/img/" . $img . "'><img id='the_pic' class='center fit' src='" . $img . "' /></a></div></td></tr>\n";
echo "<tr><td><div align='center'><p>Currently viewing: <a href='http://unps-gama.tk/img/" . $img . "'>" . $img . "</a></p></div><tr><td>\n";
echo "<tr><td><div align='center'><a href='./'><b><---- Back to Index</b></a><tr><td></div></table>\n";
}
?>
<br></div>
</body></html>
