<?php
include('../includes/config.php');

$id = $_POST['id'];
$image = $_POST['image'];
$website = $_POST['website'];
$rotation = $_POST['rotation'];

$info = pathinfo($image);
$base =  basename($image,'.'.$info['extension']);

// Start - Email test results
$to      = 'bullitt4106@gmail.com';
$subject = 'Test';
$message = 'base variable = '.$base.'';
$headers = 'From: Godaddy';
//mail($to, $subject, $message, $headers);

$targetFolder = $_REQUEST['folder'];
if (!isset($targetFolder)) {
	$targetFolder = '/theqreview/adverts/images/bigad'; // Relative to the root
}

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/';

	$createFolder = $_REQUEST['createFolder'];
	if (($createFolder == 'true') && (!file_exists($targetPath))) {
		@mkdir($targetPath, 0777, true);
		@chmod($targetPath, 0777);
	}

	$returnFile = $_FILES['Filedata']['name'];
	$file = $_FILES['Filedata']['name'];
	$file = utf8_decode($file);
	$file = preg_replace("/[^a-zA-Z0-9_.\-\[\]]/i", "", strtr($file, "()����������������������������������������������% ", "[]aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC__"));
	$file = strtolower($file);
	
	/***** Change file name to match entered image name on form *****/
	$name = reset(explode(".",$_FILES['Filedata']['name']));
	$ext = end(explode(".",$_FILES['Filedata']['name']));
	$ext = strtolower($ext);
	//$name = $image;
	$filename = $base.".".$ext;
	$file = strtolower($filename);
	
	$sql = "update bigad set image = '$file' where id = '$id'";
	mysql_query($sql) or die (mysql_error());
	/* end */

	$fileTypeExts = $_REQUEST['fileTypeExts'];
	if (isset($fileTypeExts)) {
		$fileTypes = str_replace('*.','',$fileTypeExts);
		$fileTypes = str_replace(';','|',$fileTypes);
		$typesArray = split('\|',$fileTypes);
		$fileParts = pathinfo($file);
		if (!in_array($fileParts['extension'],$typesArray)) { die('File type not allowed!'); }
	}

	$aux_targetFile = str_replace('//','/',$targetPath);
	$targetFile = str_replace('//','/',$targetPath) . $file;

	$checkExisting = $_REQUEST['checkExisting'];
	if (!isset($checkExisting) && file_exists($targetFile)) {
		while ($ok != true) {
			if(file_exists($targetFile)) {
				$ok = false;
				$rand = rand(1000, 9999);
				$targetFile = $aux_targetFile . $rand . '_' . $file;
			} else {
				$ok = true;
				$file = $rand . '_' . $file;
			}
		}
	}
	
	move_uploaded_file($tempFile,$targetFile);
	//echo "$file";
}
?>