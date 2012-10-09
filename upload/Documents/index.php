<HTML> 
<HEAD> 
<TITLE> 
index of UnPS-GAMA uploads 
</TITLE> 

</HEAD> 

<BODY background="https://si0.twimg.com/profile_background_images/468495900/bg.gif" text="EEEEEE"> 
<center> 
<style type="text/css"> 
A:link {COLOR:#DDDDDD; TEXT-DECORATION: none} 
A:active {COLOR: #FFFFFF; TEXT-DECORATION: none} 
A:hover {    COLOR: #FFFFFF;  TEXT-DECORATION: underline} 
A:visited {COLOR: #C0C0C0; TEXT-DECORATION: none} 

.trone { 
font-size: 11pt; 
} 

.trtwo{ 
font-size: 11pt;  
} 

.trto{ 
background-color: #000000; 
font-size: 11pt;  
} 

BODY { TEXT-DECORATION: none; 
    font-family:verdana; 
    font-size: 11pt; 
} 
</style> 

<br><br> 
<img src="http://unps-gama.tk/upload/Pictures/header.png"><br>
<table border=0> 
<tr class="trto"> 
<td><center><b>file</b></center></td> 
<td><center><b>size</b></center></td> 
<td><center><b>last modified</b></center></td> 
</tr> 
<? 
// shows the correct size & size-label 

function size($file) { 
    $size_label    =    array("Byte", "KB", "MB", "GB", "TB"); 

    $size=filesize($file); 
    for ($c=0;$size>1024; $c++) { 
        $size/=1024; 
    } 
     
    $size=round($size,1); 
    return("$size ".$size_label[$c]); 
} 


$trbg = "1"; // which <TR> - background 

echo "<div class='trone'>
	<td width=300><div align='center'><a href='../'>Up One Directory</a></a></div></td>
	<td width=100><div align='center'>DIR</div></td>
	<td width=300><div align='center'></div></td></div>";

// reading the content and... 
$mydir = dir("./"); 
while ($file=$mydir->read()){ 
    $kind = filetype($file); 
    if ($kind != "php"){ // ATTENTION! if you want this file to show subdirectories, remove this query 
		if ($file != '.' && $file != '..' && $file != 'index.php' && $file != '.htaccess'){
			//... showing the content: 
			//<tr> - backgroundcolor 
			echo "<tr>"; 
			if ($trbg=="1"){ 
				echo "<tr class=\"trone\">"; 
				$trbg = "2"; 
			} 
			else if ($trbg=="2"){ 
				echo "<tr class = \"trtwo\">"; 
				$trbg = "1"; 
			}
			//<td> and filename... 
			echo "<td width=300><div align='center'><a href=\"$file\">".$file."</a></div></td>"; 
			//...filesize...
			if(is_dir($file)){
				echo "<td width=100><div align='center'>DIR</div></td>";
			}else{
				echo "<td width=100><div align='center'>".size($file)."</div></td>"; 
			}
			//... last change... 
			$change = filemtime($file); 
			echo "<td width=300><div align='center'>".date("H:i:s - j M, Y",$change)."</div></td>"; 
		} 
	}
} 
$mydir->close(); 
?> 
</tr> 
</table> 
<br><br> 
</center> 
</BODY> 
</HTML>

