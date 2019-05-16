<?php
include('includes/config.php');

$count = 1;
$sql = "select * from banners where active = 'Y' order by id";
$result = mysql_query($sql) or die (mysql_error());
$num_rows = mysql_num_rows($result);
?>

<script type="text/javascript">
var imgs1 = new Array(
<?php
While($count <= $num_rows):
	$row = mysql_fetch_assoc($result);
	$banner = $row['image'];
	if($count < $num_rows)
		{
			?>
		    "adverts/images/banners/<?php echo $banner ?>",
			<?php
		} 
	else 
		{
			?>
		    "adverts/images/banners/<?php echo $banner ?>"
			<?php
		}
	$count++;
endwhile;
?>
	);
	var lnks1 = new Array(
<?php
$count = 1;
$sql2 = "select * from banners where active = 'Y' order by id";
$result2 = mysql_query($sql2) or die (mysql_error());
$num_rows2 = mysql_num_rows($result2);
While($count <= $num_rows2):
	$row2 = mysql_fetch_assoc($result2);
	$website = $row2['website'];
	if($count < $num_rows2){
	?>
    "<?php echo $website ?>",
	<?php
	} else {
	?>
    "<?php echo $website ?>"
	<?php
	}
	$count++;
endwhile;
?>	
	);
	var alt1 = new Array();
	var currentAd1 = 0;
	var imgCt1 = 
	<?php
	$sql3 = "select * from banners where active = 'Y' order by id";
	$result3 = mysql_query($sql3) or die (mysql_error());
	$num_rows3 = mysql_num_rows($result3);
	echo ''.$num_rows3.'';
	?>
	;
	function cycle1() {
	  if (currentAd1 == imgCt1) {
		currentAd1 = 0;
	  }
	var banner1 = document.getElementById('adBanner1');
	var link1 = document.getElementById('adLink1');
	  banner1.src=imgs1[currentAd1]
	  banner1.alt=alt1[currentAd1]
	  document.getElementById('adLink1').href=lnks1[currentAd1]
	  currentAd1++;
	}
	  window.setInterval("cycle1()",
<?php
$sql4 = "select * from banners limit 1";
$result4 = mysql_query($sql4) or die (mysql_error());
$row4 = mysql_fetch_assoc($result4);
$rotation = $row4['rotation'] * 1000;
	echo ''.$rotation.'';
	?>
	);
</script>
<?php
$sql5 = "select * from banners where first = 'Y' limit 1";
$result5 = mysql_query($sql5) or die (mysql_error());
if(mysql_num_rows($result5) > 0){
	$row5 = mysql_fetch_assoc($result5);
	$image5 = $row5['image'];
	$website5 = $row5['website'];
	$dir = 'adverts/images/banners/';
	$firstbanner = $dir.$image5;
	if(file_exists ($firstbanner)){
		?>
        <div align="right"><a href="<?php echo $website5 ?>" id="adLink1" target="_new"><img src="<?php echo $firstbanner ?>" id="adBanner1" border="0" width="468" height="60"></a></div>
                   	<?php
	}
}
			
?>
