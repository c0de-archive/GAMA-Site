<title>URL Shortner</title>
<script language="javascript" type="text/javascript">
function showHide(shID) {
   if (document.getElementById(shID)) {
      if (document.getElementById(shID+'-show').style.display != 'none') {
         document.getElementById(shID+'-show').style.display = 'none';
         document.getElementById(shID).style.display = 'block';
      }
      else {
         document.getElementById(shID+'-show').style.display = 'inline';
         document.getElementById(shID).style.display = 'none';
      }
   }
}
</script>
<style type="text/css">
.api {
	display: none;
	border-top: 1px solid #666;
	border-bottom: 1px solid #666; }
a.showApi, a.hideApi {
	text-decoration: none;
	color: #36f;
	padding-left: 8px; }
a.showApi:hover, a.hideApi:hover {
	border-bottom: 1px dotted #36f; }
</style>
<body bgcolor="black" text="greem"><div align="center">
<img src="http://unps-gama.tk/upload/Pictures/header.png"><br>
<h4>Welcome to the UnPS-GAMA page shortner</h4>
<a href="#" id="api-show" class="showApi" onclick="showHide('api');return false;">Existing Short Links</a>
<div id="api" class="api">
<?php
include('getfiles.php');
echo "<table><tr><td><div align'center'><P>List of links already:</p></div></td></tr><tr><td>" . $thelist . "</td></tr></table>";
?>
<a href="#" id="api-hide" class="hideApi" onclick="showHide('api');return false;">Close Me</a>
</div>
<br><hr><br>
<?php
include("config.php");
if(!$_POST['submit'])
	{
?>
<form action="index.php" method="POST">
  <p>Destination:<br><input name="dest" type="text" size="30" ></p>
<input type="submit" name="submit" value="submit">
</form>

<?php
	}
$dest=$_POST['dest'];
if($_POST["submit"])
	{
		if(isset($_POST['dest']) && $dest != "") 
			{
				$myFile = $random.".html";
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = '

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<meta http-equiv="REFRESH" content="0;url='.$dest.'"></HEAD>
<BODY>
Service by '.$pagepath.'
</BODY>
</HTML>
';
				fwrite($fh, $stringData);
				fclose($fh);	
echo '
Thanks for using '.$pagetitle.' <br>
your link is available here (right click, copy link):<br>
<a href='.$pagepath.$random.' target='.$random.'>'.$pagepath.$random.'</a><br>
<a href="index.php">Back to index</a><br>
<a href="http://unps-gama.tk">Home</a>

';	
			}if($dest == ""){
				echo '
						Sorry, you are not able to shorten something without a url <br>
						<a href="index.php">Back to index</a><br>
						<a href="http://unps-gama.tk">Home</a>

';	
				
		}

	}
?>
