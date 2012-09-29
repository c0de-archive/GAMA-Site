<title>UnPS MC Checker</title>
<body background="https://si0.twimg.com/profile_background_images/468495900/bg.gif" text="white">
<div align="center">
<img src="http://unps-gama.tk/upload/Pictures/header.png"><br>
<table align="center">
<tr><td>If you want to parse this information for yourself, just give the script an $ip and $port (default assumed)</td></tr>
<tr><td>then pull an arraylist for $srvinfo from 0-2 to get motd, players online, and max players. </td></tr>
<tr><td>Server and port are just echoed $ip and $port. To check online status, use testserver.php. </td></tr>
<tr><td>Call testserver.php and use the GetServerStatus($ip, $port); function - echo that and done :3</td></tr>
<tr><td>Example: (remove spaces in color) <pre>
include('http://unps-gama.tk/mcping.php?ip=$ip&port=$port')
	echo "Server:<font colo r='red'> " . $ip . "</font> on port:<font colo r='yellow'> " . $port . " </font> is: ";
	include('http://unps-gama.tk/testserver.php');
		$status = GetServerStatus($ip, $port);
			if ($status=="ONLINE") echo "<font colo r='green'>" . $status . "</font>\n";
			if ($status=="OFFLINE") echo "<font colo r='red'>" . $status . "</font>\n";
		echo "motd: " . $srvinfo[0] . "\n";
		echo "players online: " . $srvinfo[1] . "\n";
		echo "max players: " . $srvinfo[2] . "\n";</pre></td></tr>
</table><br><hr><br><table align="center">
<?php
$ip = $_GET["ip"];
$port = $_GET["port"];
if ($port==null){$port = 25565;}
$fp = fsockopen($ip, $port, $errno, $errstr, 5); // Socket for connecting to server

if (!$fp) { 
    echo "<font color='red'>Error</font>";
} else {
    $out = "\xFE"; // Hex needed for server info

    fwrite($fp, $out);
    while (!feof($fp)) {
        $result .= fgets($fp, 128);
    }
    fclose($fp);
    
    // Remove extra spaces between characters
    $result = str_replace("\x00", "", $result); 
    $result = str_replace("\x1A", "", $result); 
    $result = str_replace("\xFF", "", $result);
    
    $srvinfo = explode("\xA7",$result); 
    
    echo "<tr><td>\n";
    echo "Server:<font color='red'> " . $ip . "</font> on port:<font color='yellow'> " . $port . " </font> is: ";
    include('testserver.php');
    $status = GetServerStatus($ip, $port);
    if ($status=="ONLINE") echo "<font color='green'>" . $status . "</font></td></tr>\n";
    if ($status=="OFFLINE") echo "<font color='red'>" . $status . "</font></td></tr>\n";
    //echo $status . "<br>";
    echo "<tr><td>motd: " . $srvinfo[0] . "</td></tr>\n";
    echo "<tr><td>players online: " . $srvinfo[1] . "</td></tr>\n";
    echo "<tr><td>max players: " . $srvinfo[2] . "</td></tr>\n";
}
?>
</table>
</div>
