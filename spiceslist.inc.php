	<title>503 - Temporarily Closed For Maintenance</title>
	<?php
	include("includes/globals.inc.php");
	?>
	<div id="main_a">
	<div class="main_a_sub1">
	<?php 
		$queryProducts = "Select * from recipes"; //Starts the query
		if(isset($_GET['filter'])) {
			$queryProducts = $queryProducts . " where category_recid = '" . $_GET['filter'] . "'"; // Appends to the query the filter;
		}
		$queryProducts = $queryProducts . " order by recid desc limit 0,16"; //Adds the order by the limit
		$resultProducts = mysql_query($queryProducts);
		
		if(mysql_num_rows($resultProducts) > 0) 
			{     /////////Starts spitting code of the result
	?>
		<table cellpadding="2" cellspacing="20" border="0" width="100%">
		<tr align="center">
			<?php 
			$rand = rand(1,1000);
			$rowmax = 4;
			$curCount = 1;
				while($row = mysql_fetch_array($resultProducts, MYSQL_ASSOC))
					{
						//This if statment Checks to see if a new row needs to be started
						if($curCount > $rowmax) {
							echo "</tr><tr>";
							$curCount = 1;
						}  //End if statment
						echo "<td width=\"25%\">";
						echo "<a href=\"index.php?content=recipedetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br>";
							if(file_exists($defaultRecipeImageFolder . $row['recid']. "_1_sm.jpg"))
								{
									echo "<img src = \"" . $defaultRecipeImageFolder . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
								}
						echo "<br>";
						echo "<img src=\"" . $defaultImageFolder . $row['rating'] . ".png\">";
						echo "</a>";
						echo "</td>";
						$curCount += 1;   //Increments the counter by 1
					}
			?>
		</tr>
		</table>
		
		<?php
			}
		else
			{  ////Show the code if there are no recipes
				if(isset($_GET['filter']))
					{
						//If the filter is set, then the error message should state that no recipes were found for this filter.
						echo "<center><h3>There are currently no recipes in this section at this time. Please check back later.</h3></center>";
					}
				else
					{
						//If this is hit, it means that there are no reviews in the database....at all...
						echo "<center><h3>There are currently no recipes. Please check back soon. Thank you.</h3></center>";
					}
			
			}
		?>
    </div>	
   </div>








