	<?php
	include("includes/globals.inc.php");
	?>
	<div id="main_a">
	<div class="main_a_sub1">
	<?php 
		$queryProducts = "Select * from events_insights order by recid desc limit 0,4";
		$resultProducts = mysql_query($queryProducts);
	?>
		<table cellpadding="2" cellspacing="20" border="0" width="100%">
		<tr align="center">
			<?php 
			$rand = rand(1,1000);
				while($row = mysql_fetch_array($resultProducts, MYSQL_ASSOC))
					{
						echo "<td width=\"25%\">";
						echo "<a href=\"index.php?content=events_insightsdetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br>";
							if(file_exists($defaultevents_insightsImageFolder . $row['recid']. "_1_sm.jpg"))
								{
									echo "<img src = \"" . $defaultevents_insightsImageFolder . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
								}
						echo "<br>";
						echo "<img src=\"" . $defaultImageFolder . $row['rating'] . ".png\">";
						echo "</a>";
						echo "</td>";
					}
			?>
		</tr>
		</table>
	
    </div>	
   </div>








