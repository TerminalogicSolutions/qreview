<?php
date_default_timezone_set('America/New_York');

$users = array(
	"pfwebhosting" => "a87fefb3f7d2b1f2db115a600fc352fc",  //username=admin password=password
	"another" => "5f4dcc3b5aa765d61d8327deb882cf99" //username=another password=password
);
// this takes the month, hashes it then cuts it down to 8 characters
$salt = substr(md5(date("F")), 8);
?>