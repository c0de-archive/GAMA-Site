<?php
$max_file_size="4096";
$file_uploads="1";
$websitename="UnPS-GAMA IMGShare Uploader";
$allow_types=array("jpg","gif","png","bmp","JPEG","JPG","GIF","PNG");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" type="image/ico" href="http://unps-gama.info/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="http://unps-gama.info/favicon.ico" />
<style type="text/css">
	body{
		background-image:url('https://si0.twimg.com/profile_background_images/468495900/bg.gif');
		font-family: Verdana, Arial, sans-serif;
		font-size: 12pt;
		color: #000000;
	}
	
	.message {
		font-family: Verdana, Arial, sans-serif;
		font-size: 11pt;
		color: #000000;
		background-color:#EBEBEB;
	}

	a:link, a:visited {
		text-decoration:none;
		color: #999999;
	}
	
	a:hover {
		text-decoration:none;
		color: #999999;
	}

	.table {
		border-collapse:collapse;
		border:1px solid #000000;
		width:450px;
	}
	
	.table_header {
		border:1px solid #000000;
		background-color:#111111;
		font-family: Verdana, Arial, sans-serif;
		font-size: 11pt;
		font-weight:bold;
		color: #FFFFFF;
		text-align:center;
		padding:2px;
	}
	
	.upload_info {
		border:1px solid #000000;
		background-color:#EBEBEB;
		font-family: Verdana, Arial, sans-serif;
		font-size: 8pt;
		color: #000000;
		text-align:center;
		padding:4px;
	}

	.table_body {
		border:1px solid #000000;
		background-color:#999999;
		font-family: Verdana, Arial, sans-serif;
		font-size: 10pt;
		color: #000000;
		padding:2px;
	}

	.table_footer {
		border:1px solid #000000;
		background-color:#111111;
		text-align:center;
		padding:2px;
	}

	input,select,textarea {
		font-family: Verdana, Arial, sans-serif;
		font-size: 10pt;
		color: #000000;
		background-color:#AFAEAE;
		border:1px solid #000000;
	}
	
	.copyright {
		border:0px;
		font-family: Verdana, Arial, sans-serif;
		font-size: 9pt;
		color: #999999;
		text-align:right;
	}
	
	form {
		padding:0px;
		margin:0px;
	}
</style>
<title><?php echo $websitename; ?></title>
<body>
<div align="center"><a href="http://unps-gama.info/img/"><img src="http://unps-gama.info/upload/Pictures/header.png"></a></div><br />
<form action="upload.php" method="post" enctype="multipart/form-data" name="upload">
<table align="center" class="table">
	<tr>
		<td class="table_header" colspan="2"><b><?php echo $websitename; ?></b> </td>
	</tr>
	<tr>
		<td colspan="2" class="upload_info">
			<b>Allowed Types:</b> <?php echo implode($allow_types, ", "); ?><br />
			<b>Max size per file:</b> <?php echo $max_file_size ?>kb.
		</td>
	</tr>
	<?php For($i=0;$i <= $file_uploads-1;$i++) { ?>
		<tr>
			<td class="table_body" width="20%"><b>Select File:</b> </td>
			<td class="table_body" width="80%"><input type="file" name="file" id="file" size="50" /></td>
		</tr>
		<tr>
			<td class="table_body" width="20%"><b>Comment: </b></td>
			<td class="table_body" width="80%"><input type="text" name="comment" id="comment" size="50" /></td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="2" align="center" class="table_footer">
			<input type="hidden" name="submit" value="true" />
			<input type="submit" value=" Upload File(s) " /> &nbsp;
			<input type="reset" name="reset" value=" Reset Form " onclick="window.location.reload(true);" />
		</td>
	</tr>
</table>
</form>
<table class="table" style="border:0px;" align="center">
	<tr>
		<td><div class="copyright"><a href="index.php">UnPS-GAMA IMGShare</a></div></td>
	</tr>
</table>
</body>
</html>
