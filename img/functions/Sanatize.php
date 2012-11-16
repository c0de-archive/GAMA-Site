<?php
/* Sanatize() function to sanitize untrusted input before processing
 * Takes $input and returns $output
 * Use this before sending anything to database. 
 * All form inputs should run through this first
 */
 
function sanatize($input){
	if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>"); // Append error into common error string for parsing later
	// To protect MySQL injection (more detail about MySQL injection)
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
	$name = substr(strrchr($name, "."), 1);
	return $name;
}
?>
