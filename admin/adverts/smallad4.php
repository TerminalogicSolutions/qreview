<?php
include('includes/config.php');

$sql = "select * from smallad where active = 'Y' and position = 'Bottom Right' limit 1";
$result = mysql_query($sql) or die (mysql_error());
if(mysql_num_rows($result) > 0){
	$row = mysql_fetch_assoc($result);
	$image = $row['image'];
	$website = $row['website'];
	$dir = 'adverts/images/smallad/';
	$ad = $dir.$image;
	if(file_exists ($ad)){
		?>
        <div><a href="<?php echo $website ?>" target="_new"><img src="<?php echo $ad ?>" border="0" width="125" height="125"></a></div>
     <?php
	}
}
?>