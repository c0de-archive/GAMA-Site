<?php
	
	/*------------------------------------------
	 * Helper.Clean.php - Holds the functions for cleaning input and output
	 * 
	 * Copyright (c) 2013 David Todd(c0de) of http://www.unps-gama.info and http://unps.us 
	 * for use with the image host (http://img.unps-gama.info)
	 *------------------------------------------
	 */
	
	function sanitize($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		include('dbsettings.php');
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = $db->real_escape_string($output);
		$output = strtolower($output);
		return $output;
	}
	
	function comment($input){
		if ($input == null) die("Sanatize() - No Input Provided, Aborting\r\n<br>");
		include('dbsettings.php');
		$output = strip_tags($input);
		$output = stripslashes($output);
		$output = $db->real_escape_string($output);
		return $output;
	}
	
	function cln_file_name($string) {
		$cln_filename_find=array("/\.[^\.]+$/", "/[^\d\w\s-]/", "/\s\s+/", "/[-]+/", "/[_]+/");
		$cln_filename_repl=array("", "", " ", "-", "_");
		$string=preg_replace($cln_filename_find, $cln_filename_repl, $string);
		return trim($string);
	}

?>