<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>URL Shortner</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="description" content="Link shortener for UnProfessional Standards" />
	<meta name="keywords" content="GAMA,UnPS,upstandards,unps-gama,gama-unps,unps,gama,davitech,davitodd" />
	<meta name="author" content="David Todd" />
	<link rel="shortcut icon" type="image/ico" href="http://unps-gama.info/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="http://unps-gama.info/favicon.ico" />
	<link rel="stylesheet" href="style.css" />
	
</head>

<?php 
require('dbsettings.php'); // Gotta connect to dem databases

function input($input){ // Cleans input to be used in mysql
	if ($input == null) die("No Input Provided, Aborting\r\n<br />");
	$input = mysql_real_escape_string($input);
	return $input;
}

function prepOutputText($text) { // Takes mysql string and makes it able to be used
	if ($text == null) die("No Input Provided, Aborting\r\n<br />");
	$output = htmlentities(stripslashes($text),ENT_QUOTES);
	return $output;
}

function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE){
        return true;
    }else{
        return false;
    }
}

$submit; // Declare this since my logs are annoying me to no end x.x

if(isset($_GET['l'])) { // if there is a link...
	$l = $_GET['l']; // Bring the link into a variable
	$l = input($l); // Clean said variable to be used in mysql
	$sql = "SELECT id, link, shortlink FROM $tbl_name WHERE shortlink='$l'"; // Find the link in the table
	$result = mysql_query($sql); // mysql stuff
	$count = mysql_num_rows($result); // How many rows were found?
	if($count == 1){ // There should only be one row
		while ($row = mysql_fetch_assoc($result)){ // Start pulling data from the row
			$id = $row['id']; // Lets get the id - not used, just a number used to identify the link or something, it's unique
			$link = $row['link']; // This is the full link
			$short = $row['shortlink']; // This is the short link - Should be a unique number
			mysql_close(); // close the mysql connection
			echo "Redirecting you to your site, please wait..."; // never seen
			$link = prepOutputText($link); // make the link work
			header("location:".$link); // redirect right away
		}	
	}else{
		echo "Hmmm... It appears that your link doesn't exist in my database. Try again?"; // not seen
		header("location:http://unps.us/"); // redirect right away
	}
}
?>

<body id="content">
		<img src="http://unps-gama.info/upload/Pictures/header.png" alt="Header image" /><br />
		<h4>Welcome to the UnPS-GAMA link shortner</h4>
		<p>All you gotta do is put a link into the box and click submit</p>
	
		<form id="short" title="short" action="index.php" method="POST" >
			<input name="dest" id="dest" class="dest" title="Insert URL here" placeholder="Insert URL here" value="" type="text" size="50" />
			<br /><p></p>
			<input type="submit" name="submit" value="submit" />
		</form>

		<?php
			if($_POST["submit"]){ // If submit button was pressed...
				if(isset($_POST['dest'])) { // If the text box has something in it
					$dest=$_POST['dest']; // Pull that into a variable
					if (strpos(strtolower($dest), 'http://') === false) { // Simple test to see if http:// not part of the link
						if (strpos(strtolower($dest), 'https://') === false){ // Simple test to see if https:// not part of the link passing the above check
							$dest = 'http://'.$dest; // Add http:// to link 
						}
					}
					$dest = input($dest); // Clean the variable for mysql
					$sql = "SELECT id, link, shortlink FROM $tbl_name WHERE link='$dest'"; // Check the table if the link was posted before
					$result = mysql_query($sql); // mysql stuff
					$count = mysql_num_rows($result); // Count the rows returned, if any
					if($count == 1){ // If a row is returned, there should only be one
						while ($row = mysql_fetch_assoc($result)){ // Pull all the data from the returned row
							$id = $row['id']; // Lets get the id - not used, just a number used to identify the link or something, it's unique
							$link = $row['link']; // This is the full link
							$short = $row['shortlink']; // This is the short link - Should be a unique number
							echo "From what I can tell, this particular link was already shortened before.<br>Here's the link: <a href=\"http://unps.us/?l=$short\" target=\"$short\">http://unps.us/?l=$short</a>"; // Return link that's already in table
						}	
					}else{ // If no row is returned, it is assumed that the link isn't there
						if(checkRemoteFile($dest) !== true) die("Hmmm it seems that your link is dead.\r\nPlease try again"); // Check to see if the host is alive
						$short = substr(number_format(time() * rand(),0,'',''),0,10); // Create a random number 10 digits long
						$short = base_convert($short, 10, 36); // Convert the 10 digit random number into Base36
						$sql="INSERT INTO $tbl_name (link, shortlink) VALUES ('$dest', '$short')"; // Try to add the link and short link into table
						$result=mysql_query($sql); // mysql stuff
						if($result){ // If the link is added to the table
							echo "It appears that I have succeded in making a short link.<br>You'll find it here (right click, copy link): <a href=\"http://unps.us/?l=$short\" target=\"$short\">http://unps.us/?l=$short</a> ";
						}else { // If the link is not added to the table
							echo "There was a problem trying to register your link - Could be a database error";
						}
					}
				}
				if(!$dest){ // If the textbox was empty when loaded
						echo ' 
							<p>Sorry, you are not able to shorten something without a url<br /></p>\r\n
							<a href="http://unps.us">Back to index</a><br />\r\n
							<a href="http://unps-gama.info">Home</a>
						';	
					}
				}
		mysql_close(); // Close any mysql connections still open
		?>
</body>
</html>
