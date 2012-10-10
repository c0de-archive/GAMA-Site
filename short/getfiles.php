<?php
if ($handle = opendir('.')) {
   while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != ".." && $file != "index.php" && $file != "getfiles.php" && $file != "config.php" && $file != "url" && $file != "log")
	  {
		$last_modified = filemtime($file); 
		//print(date("m/j/y h:i:s a", $last_modified)); 
          	$thelist .= '<a href="http://ugama.tk/short/'.$file.'">'.$file.'</a> Created on: <font align="right" color="green">'. date("h:i a - m/j/y", $last_modified) .'</font><br />';
          }
       }
  closedir($handle);
  }
?>
