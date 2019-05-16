<?php
include('includes/config.php');

$count = 1;
$sql = "select * from bigad where active = 'Y' and top != 'Y' order by id";
$result = mysql_query($sql) or die (mysql_error());
$num_rows = mysql_num_rows($result);
?>

<script type="text/javascript">
var imgsbotblock = new Array(
<?php
While($count <= $num_rows):
	$row = mysql_fetch_assoc($result);
	$block = $row['image'];
	if($count < $num_rows){
	?>
    "adverts/images/bigad/<?php echo $block ?>",
	<?php
	} else {
	?>
    "adverts/images/bigad/<?php echo $block ?>"
	<?php
	}
	$count++;
endwhile;
?>
	);
	var lnksbotblock = new Array(
<?php
$count = 1;
$sql2 = "select * from bigad where active = 'Y' and top != 'Y' order by id";
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
	var altbotblock = new Array();
	var currentAdbotblock = 0;
	var imgCtbotblock = 
	<?php
	$sql3 = "select * from bigad where active = 'Y' and top != 'Y' order by id";
	$result3 = mysql_query($sql3) or die (mysql_error());
	$num_rows3 = mysql_num_rows($result3);
	echo ''.$num_rows3.'';
	?>
	;
	function cyclebotblock() {
	  if (currentAdbotblock == imgCtbotblock) {
		currentAdbotblock = 0;
	  }
	var bannerbotblock = document.getElementById('adBannerbotblock');
	var linkbotblock = document.getElementById('adLinkbotblock');
	  bannerbotblock.src=imgsbotblock[currentAdbotblock]
	  bannerbotblock.alt=altbotblock[currentAdbotblock]
	  document.getElementById('adLinkbotblock').href=lnksbotblock[currentAdbotblock]
	  currentAdbotblock++;
	}
	  window.setInterval("cyclebotblock()",
<?php
$sql4 = "select * from bigad limit 1";
$result4 = mysql_query($sql4) or die (mysql_error());
$row4 = mysql_fetch_assoc($result4);
$rotation = $row4['rotation'] * 1000;
	echo ''.$rotation.'';
	?>
	);
</script>
<?php
$sql5 = "select * from bigad where first = 'Y' and top != 'Y' limit 1";
$result5 = mysql_query($sql5) or die (mysql_error());
if(mysql_num_rows($result5) > 0){
	$row5 = mysql_fetch_assoc($result5);
	$image5 = $row5['image'];
	$website5 = $row5['website'];
	$dir = 'adverts/images/bigad/';
	$firstblock = $dir.$image5;
	$nofirst = 'noblock.png';
	$nofirstblock = $dir.$nofirst;
	if(file_exists ($firstblock)){
		?>
        <div><a href="<?php echo $website5 ?>" id="adLinkbotblock" target="_new"><img src="<?php echo $firstblock ?>" id="adBannerbotblock" border="0" width="254" height="254"></a></div>
     <?php
	}
}
?>
