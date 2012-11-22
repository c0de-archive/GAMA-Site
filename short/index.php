<?php 
require('dbsettings.php'); 

function input($input){
	if ($input == null) die("No Input Provided, Aborting\r\n<br>");
	$input = mysql_real_escape_string($input);
	return $input;
}

function prepOutputText($text) {
	if ($text == null) die("No Input Provided, Aborting\r\n<br>");
	$output = htmlentities(stripslashes($text),ENT_QUOTES);
	return $output;
}

if(isset($_GET['l'])) {
	$l = $_GET['l'];
	$l = input($l);
	$sql = "SELECT id, link, shortlink FROM $tbl_name WHERE shortlink='$l'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count == 1){
		while ($row = mysql_fetch_assoc($result)){ // Attempt to pull all data concerning that one user from table	
			$id = $row['id'];
			$link = $row['link'];
			$short = $row['shortlink'];
			mysql_close();
			echo "Redirecting you to your site, please wait...";
			$link = prepOutputText($link);
			header("location:".$link);
		}	
	}else{
		echo "Hmmm... It appears that your link doesn't exist in my database. Try again?";
		header("location:http://unps.us/");
	}
}
?>
<title>URL Shortner</title>
<link rel="shortcut icon" type="image/ico" href="http://unps-gama.info/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="http://unps-gama.info/favicon.ico" />
<body bgcolor="black" text="greem"><div align="center">
<img src="http://unps-gama.info/upload/Pictures/header.png"><br>
<h4>Welcome to the UnPS-GAMA link shortner</h4><hr>
<?php
if(!$_POST['submit']){
?>
<form action="index.php" method="POST">
<p>Destination:<br><input name="dest" id="dest" title="Insert URL here" value="Insert URL here" type="text" size="30" ></p>
<input type="submit" name="submit" value="submit">
</form>

<?php
	}
if($_POST["submit"]){
	if(isset($_POST['dest'])) {
		$dest=$_POST['dest'];
		$dest = input($dest);
		$sql = "SELECT id, link, shortlink FROM $tbl_name WHERE link='$dest'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		if($count == 1){
			while ($row = mysql_fetch_assoc($result)){ // Attempt to pull all data concerning that one user from table	
				$id = $row['id'];
				$link = $row['link'];
				$short = $row['shortlink'];
				echo "From what I can tell, this particular link was already shortened before.<br>Here's the link: <a href=\"http://unps.us/?l=$short\">http://unps.us/?l=$short</a>";
			}	
		}else{
			$short = substr(number_format(time() * rand(),0,'',''),0,10);
			$sql="INSERT INTO $tbl_name (link, shortlink) VALUES ('$dest', '$short')";
			$result=mysql_query($sql);
			if($result){
				echo "It appears that I have succeded in making a short link.<br>You'll find it here: <a href=\"http://unps.us/?l=$short\">http://unps.us/?l=$short</a> ";
			}else {
				echo "There was a problem trying to register your link - Could be a database error";
			}
		}
	}
	if(!$dest){
			echo '
				Sorry, you are not able to shorten something without a url <br>
				<a href="http://unps.us">Back to index</a><br>
				<a href="http://unps-gama.info">Home</a>
			';	
		}
}
mysql_close();
?>
