		<?php
	include("includes/globals.inc.php");
	?>
	<div id="main_a">
	<div class="main_a_sub1">
	<?php 
		$queryProducts = "Select * from reviews order by recid desc limit 0,4";
		$resultProducts = mysql_query($queryProducts);
	?>
		<table cellpadding="2" cellspacing="20" border="0" width="100%">
		<tr align="center">
			<?php 
			$rand = rand(1,1000);
				while($row = mysql_fetch_array($resultProducts, MYSQL_ASSOC))
					{
						echo "<td width=\"25%\">";
						echo "<a href=\"index.php?content=reviewdetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br>";
							if(file_exists($defaultReviewImageFolderAdmin  . $row['recid']. "_1_sm.jpg"))
								{
									echo "<img src = \"" . $defaultReviewImageFolderAdmin . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
								}
						echo "<br>";
						echo "<img src=\"" . $defaultImageFolderAdmin . $row['rating'] . ".png\">";
						echo "</a>";
						echo "</td>";
					}
			?>
		</tr>
		</table>
	
    </div>	
     <div class="main_a_sub2">
     <?php 
		$queryProducts = "Select * from restaurants order by recid desc limit 0,4";
		$resultProducts = mysql_query($queryProducts);
	?>
	<table cellpadding="2" cellspacing="1" border="0" width="100%">
		<tr align="center">
			<?php 
			$rand = rand(1,1000);
				while($row = mysql_fetch_array($resultProducts, MYSQL_ASSOC))
					{
						echo "<td width=\"25%\">";
						echo "<a href=\"index.php?content=restaurantdetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br><br>";
							if(file_exists($defaultRestaurantImageFolderAdmin  . $row['recid']. "_1_sm.jpg"))
								{
								echo "<img src = \"" . $defaultRestaurantImageFolderAdmin . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
								}
						echo "<br>";
					//	echo "<img src=\"" . $defaultImageFolderAdmin . $row['rating'] . ".png\">";
					//	echo "</a>";
						echo "</td>";
					}
			?>
		</tr>
		</table>
	</div>
    <div class="main_a_sub3">
    <?php 
		$queryProducts = "Select * from recipes order by recid desc limit 0,4";
		$resultProducts = mysql_query($queryProducts);
	?>
	<table cellpadding="2" cellspacing="1" border="0" width="100%">
		<tr align="center">
			<?php 
			$rand = rand(1,1000);
				while($row = mysql_fetch_array($resultProducts, MYSQL_ASSOC))
					{
						echo "<td width=\"25%\">";
						echo "<a href=\"index.php?content=recipedetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br><br>";
							if(file_exists($defaultRecipeImageFolderAdmin  . $row['recid']. "_1_sm.jpg"))
								{
								echo "<img src = \"" . $defaultRecipeImageFolderAdmin . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
								}
						echo "<br>";
					//	echo "<img src=\"" . $defaultImageFolderAdmin . $row['rating'] . ".png\">";
					//	echo "</a>";
						echo "</td>";
					}
			?>
		</tr>
		</table>

    </div>	
    </div>







