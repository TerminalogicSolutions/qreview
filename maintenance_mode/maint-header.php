<? $hfile = "maintenance_mode/recheck.txt"; 
$fh = fopen($hfile, 'r'); 
$theData = fread($fh, filesize($hfile)); 
$time = $theData;
fclose($fh);
header('HTTP/1.1 503 Service Temporarily Unavailable',true,503); 
header('Status: 503 Service Temporarily Unavailable'); 
header( "Retry-After: $time" );//Number of seconds before search engines should retry 
?>