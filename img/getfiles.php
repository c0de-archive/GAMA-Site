<?php
if ($handle = opendir('Pictures')) {
   while (false !== ($file = readdir($handle)))
      {
          if ($file != "." && $file != ".." && $file != "index.php" && $file != "getfiles.php" && $file != "imgup.php" && $file != ".htaccess")
	  {
		$last_modified = filemtime($file); 
		//print(date("m/j/y h:i:s a", $last_modified)); 
          	$thelist .= '<a href="http://img.unps-gama.info/?img='.$file.'">'.$file.'</a> Last Modified: <font align="right" color="green">'.'Not Availiable at the moment...'/*date("m/j/y h:i:s a", $last_modified) */.'</font><br />';
          }
       }
  closedir($handle);
  }
?>
