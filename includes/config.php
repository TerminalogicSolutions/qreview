<?php
//Database login information
$dbhost = "mysql1110.ixwebhosting.com";
$dbuname = "C336891_dhall";
$dbpass = "Do0msday";
$dbname = "C336891_qreview";

//$dbhost = "localhost";
//$dbuname = "test";
//$dbpass = "test";
//$dbname = "qreview";


mysql_connect($dbhost, $dbuname, $dbpass) or die(mysql_error()); 
mysql_select_db($dbname) or die(mysql_error());  

//define('ROOT', $_SERVER['DOCUMENT_ROOT']);

//date_default_timezone_set('America/New_York');



?>