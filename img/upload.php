<?php
	session_start(); // used later when login system is implemented
	require('dbsettings.php'); // database of course 
	
	function sanatize($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = mysql_real_escape_string($output);
		$output = strtolower($output);
		return $output;
	}

	function cln_file_name($string) {
		$cln_filename_find=array("/\.[^\.]+$/", "/[^\d\w\s-]/", "/\s\s+/", "/[-]+/", "/[_]+/");
		$cln_filename_repl=array("", ""," ", "-", "_");
		$string=preg_replace($cln_filename_find, $cln_filename_repl, $string);
		return trim($string);
	}

	function get_ext($name) { 
		$name = substr(strrchr($key, "."), 1);
		return $name;
	}
	
	$location = 'Pictures'; // set upload location - static directory
	$extensions = array('png', 'gif', 'jpg', 'jpeg', 'bmp'); // allowed extensions
	
	echo '
		<html>
			<link rel="shortcut icon" type="image/ico" href="http://unps-gama.info/favicon.ico" />
			<link rel="shortcut icon" type="image/x-icon" href="http://unps-gama.info/favicon.ico" />
			<body background="https://si0.twimg.com/profile_background_images/468495900/bg.gif" text="greem" link="red" vlink="purple">
				<div align="center">
					<a href="http://unps-gama.info/img/">
						<img src="http://unps-gama.info/upload/Pictures/header.png" alt="To UnPS-GAMA" title="To Home" />
					</a><br>';

	if(!isset($_POST['submit'])) die("You didn't upload anything"); // check if submit has been posted if not then we know no upload is coming
	if(!isset($_POST['comment'])){ // check to see if there was a comment, if not print no comment
		$comment = "No Comment";
	}else{
		$comment = $_POST['comment']; 
	}
	if(!isset($_SESSION['myusername'])){ // used later when login system is implemented allow anonymous uploads
		$username = 'Anonymous Coward'; // a little joke that stems from /.
	}else{
		$username = $_SESSION['myusername']; // username is username
	}
	
	$name = $_FILES["file"]["name"]; // shorten these array parts to variables
	$type = $_FILES["file"]["type"];
	$size = ($_FILES["file"]["size"] / 1024); // get size of file in Kb
	$time = date("d/j/y - g:i:s a"); // current date - time
		
	$name = cln_file_name($name);
	$type = sanatize($type); // people can spoof their mime types to have bad stuff in them - it's a stretch but better safe than sorry
	$size = sanatize($size); // just in case the size is not mysql safe clean it anyways
	$comment = sanatize($comment); // clean comment as it's user entered data
	
	$size = round($size, 2)." Kb"; // shorten size to #.## instead of longer
	
	$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	if(!in_array($file_ext, $extensions))die("Wrong or no file extension"); // stop the upload if it's wrong
	$name = rand().".".$file_ext;

	if (($_FILES["file"]["size"] < 400000000)){
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}else{
			if (file_exists("Pictures/" . $name)){
				echo $name." already exists. ";
			}else{
				if(preg_match('/php/i', $name) || preg_match('/phtml/i', $name) || preg_match('/htaccess/i', $name)){
					echo $name." is not allowed, sorry about that...";
				}else{
					$sql="INSERT INTO $tbl_name (name, location, type, size, time, comment, username) VALUES ('$name', '$location', '$type', '$size', '$time', '$comment', '$username')";
					$result=mysql_query($sql);
					if($result){
						move_uploaded_file($_FILES["file"]["tmp_name"], "Pictures/" . $name);
						echo "Stored at: <a href='http://img.unps-gama.info/?img=$name' target='_$name'>". $name."</a>";
					}else {
						echo "There was a problem trying to upload your file - Could be a database error";
					}
				}
			}
		}
	}else{
		die("File too big!");
	}
	echo '
				</div>
			</body>
		</html>
	';
?>
