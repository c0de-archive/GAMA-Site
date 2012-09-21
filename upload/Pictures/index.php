<HTML> 
<HEAD> 
<TITLE> 
index of UnPS-GAMA uploads 
</TITLE> 

</HEAD> 

<BODY bgcolor="black" text="EEEEEE"> 
<center> 
<style type="text/css"> 
A:active {COLOR: #FFFFFF; TEXT-DECORATION: none} 
A:hover {    COLOR: #FFFFFF;  TEXT-DECORATION: underline} 
A:link {COLOR:#DDDDDD; TEXT-DECORATION: none} 
A:visited {COLOR: #C0C0C0; TEXT-DECORATION: none} 

.trone { 
background-color: #595959; 
font-size: 9pt; 
text-indent: 20px; 
} 

.trtwo{ 
background-color: #000000; 
font-size: 9pt; 
text-indent: 20px; 
} 

BODY { TEXT-DECORATION: none; 
    font-family:verdana; 
    font-size: 9pt; 
    text-indent: 20px; 
} 
</style> 

<br><br> 
<img src="http://unps-gama.tk/upload/Pictures/header.png">
<table border=0> 
<tr class="trtwo"> 
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

// reading the content and... 
$mydir = dir("./"); 
while ($file=$mydir->read()){ 
    $kind = filetype($file); 
    // if ($kind != "php"){ // ATTENTION! if you want this file to show subdirectories, remove this query 
    // if ($kind != '.' && $kind != '..' && $kind != 'index.php'){
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
    echo "<td width=300><a href=\"$file\">".$file."</a></td>"; 
    //...filesize... 
    echo "<td width=100>".size($file)." </td>"; 
    //... last change... 
    $change = filemtime($file); 
    echo "<td width=200>".date("j. - M. - Y;    H:i:s",$change)."</td>"; 
    } 
//} 
$mydir->close(); 
?> 
</tr> 
</table> 
<br><br> 
</center> 
</BODY> 
</HTML>

