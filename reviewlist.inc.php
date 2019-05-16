	<title>503 - Temporarily Closed For Maintenance</title>
	<?php
	include("includes/globals.inc.php");
	?>
	<div id="main_a">
	<div class="main_a_sub1">
	<?php 
		$queryProducts = "Select * from reviews"; //Starts the query
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
						echo "<br><a href=\"index.php?content=reviewdetail&id=" . $row['recid'] . "\">";
						echo "<strong>" . stripslashes($row['title']) . "</strong><br>";
							if(file_exists($defaultReviewImageFolder . $row['recid']. "_1_sm.jpg"))
								{
									echo "<br><br><img src = \"" . $defaultReviewImageFolder . $row['recid'] . "_1_sm.jpg?" . $rand . "\">";
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
			{  ////Show the code if there are no reviews
				if(isset($_GET['filter']))
					{
						//If the filter is set, then the error message should state that no reviews were found for this filter.
						echo "<center><h3>There are currently no reviews in this section at this time. Please check back later.</h3></center>";
					}
				else
					{
						//If this is hit, it means that there are no reviews in the database....at all...
						echo "<center><h3>There are currently no reviews. Please check back soon. Thank you.</h3></center>";
					}
			
			}
		?>
    </div>	
   </div>








