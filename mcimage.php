<?php
include('testserver.php');
$my_img = ''; // name of image
$status = ''; // server status returned by testserver.php
$ip = 'mc.unps-gama.tk';
$port = '36565';

//pick image online or offline
$status = GetServerStatus($ip, $port);
if ($status=="ONLINE"){
	$my_img = imagecreatefrompng("mcbanner-online.png");
}else{
	if ($status=="OFFLINE"){ 
		$my_img = imagecreatefrompng("mcbanner-offline.png");
	}else{
		echo "Something really strange happened... Can't explain it.\r\nTry reloading this page";
	}
}

//show image
header("Content-type: image/png");
imagepng($my_img);
imagedestroy($my_img);
?>
