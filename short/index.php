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

/*function is_available($url, $timeout = 30) {
	$ch = curl_init(); // get cURL handle
	$opts = array(CURLOPT_RETURNTRANSFER => true, // do not output to browser
				  CURLOPT_URL => $url,            // set URL
				  CURLOPT_NOBODY => true, 		  // do a HEAD request only
				  CURLOPT_TIMEOUT => $timeout);   // set timeout
	curl_setopt_array($ch, $opts); 
	curl_exec($ch); // do it!
	$retval = curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200; // check if HTTP OK
	curl_close($ch); // close handle
	return $retval;
}*/

function GetServerStatus($site, $port){
	$status = array("OFFLINE", "ONLINE");
	$fp = @fsockopen($site, $port, $errno, $errstr, 2);
	if (!$fp){
		return $status[0];
	} else{ 
		return $status[1];
	}
}

$submit;

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
<p>All you gotta do is put a link into the box and click submit</p>
<?php
if(!$_POST['submit']){
?>
<form id="short" action="index.php" method="POST" >
<p>Destination:<br><input name="dest" id="dest" class="dest" title="Insert URL here" placeholder="Insert URL here" value="" type="text" size="30" ></p>
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
			if (strpos($dest, 'http://') === false) {
				if (strpos($dest, 'https://') === false){
					$ip = gethostbyname($dest);
					$dest = 'http://'.$dest;
				}
			}
			if (strpos($dest, 'http://') !== false) {
				if (strpos($dest, 'https://') !== false){
					$dest = str_replace("https://", "", $dest);
					$ip = gethostbyname($dest);
					$dest = 'https://'.$dest;
				}
				$dest = str_replace("http://", "", $dest);
				$ip = gethostbyname($dest);
				$dest = 'http://'.$dest;
			}
			if(GetServerStatus($ip, 80) != "ONLINE") die("Hmmm it seems that your link is dead.\r\nPlease try again");
			$short = substr(number_format(time() * rand(),0,'',''),0,10);
			$short = base_convert($short, 10, 36); 
			$sql="INSERT INTO $tbl_name (link, shortlink) VALUES ('$dest', '$short')";
			$result=mysql_query($sql);
			if($result){
				echo "It appears that I have succeded in making a short link.<br>You'll find it here: <a href=\"http://unps.us/?l=$short\" target=\"$short\">http://unps.us/?l=$short</a> ";
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
