<body bgcolor="black" text="greem"><div align="center">
<img src="http://unps-gama.tk/upload/Pictures/header.png"><br>
<h4>Welcome to the UnPS-GAMA page shortener</h4>
<?php
include('getfiles.php');
echo "<table><tr><td><P>List of links already:</p></td></tr><tr><td>" . $thelist . "</td></tr></table>";
?>
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
