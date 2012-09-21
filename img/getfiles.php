<?php
if ($handle = opendir('.')) {
   while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != ".." && $file != "index.php" && $file != "getfiles.php" && $file != "imgup.php")
	  {
		$last_modified = filemtime($file); 
		//print(date("m/j/y h:i:s a", $last_modified)); 
          	$thelist .= '<a href="http://unps-gama.tk/img/?img='.$file.'">'.$file.'</a> Last Modified: <font align="right" color="green">'. date("m/j/y h:i:s a", $last_modified) .'</font><br />';
          }
       }
  closedir($handle);
  }
?>