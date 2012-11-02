<?php 
function getDirectory( $path = '.', $level = 0 ){ 
    $ignore = array( 'cgi-bin', '.', '..', '.htaccess', 'index.php' ); 
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin. 
    $dh = @opendir( $path ); 
    // Open the directory to the handle $dh 
    while( false !== ( $file = readdir( $dh ) ) ){ 
    // Loop through the directory 
        if( !in_array( $file, $ignore ) ){ 
        // Check that this file is not to be ignored 
            $spaces = str_repeat( '&nbsp;', ( $level * 4 ) ); 
            // Just to add spacing to the list, to better 
            // show the directory tree. 
            if( is_dir( "$path/$file" ) ){ 
            // Its a directory, so we need to keep reading down... 
                echo "<strong>$spaces └ <a href='$path/$file'>$file</a></strong><br />"; 
                getDirectory( "$path/$file", ($level+1) ); 
                // Re-call this same function but on a new directory. 
                // this is what makes function recursive. 
            } else { 
                echo "$spaces └ <a href='$path/$file'>$file</a><br />"; 
                // Just print out the filename 
            } 
        }  
    } 
    closedir( $dh ); 
    // Close the directory handle 
} 
?>
