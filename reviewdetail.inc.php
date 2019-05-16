<?php 
	include("includes/globals.inc.php");
	$recid = @$_GET['id'];
	$query = "Select * from reviews where recid = " . $recid;
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
		{
		$row = mysql_fetch_array($result);
	?>
			<div id="review">
			
				<div class="review_title"> <?php echo $row['title']; ?>
			    
			    </div>
			    

			    <div class="review_thumb">
			    <?php
			    	if(file_exists($defaultReviewImageFolder . $row['recid']. "_1_sm.jpg"))
						{
							echo "<center><img src = \"" . $defaultReviewImageFolder . $row['recid'] . "_1_sm.jpg?" . $rand . "\"></center>";
						}
				?>
				</div>
			    
				<div class="review_rate">
			     	<?php 
			     		echo "<center><img src=\"" . $defaultImageFolder . $row['rating'] . ".png\">";
						echo $row['rating'] . "</center>"; 
			     	?>
			    </div>	  
			    
			    
			    <div class="review_text"><?php echo nl2br($row['review_text']); ?>			    </div>	
			    
			    <div class="review_social">
			    	<?php
			    		if($row['fblink'] != "")
			    			{
			    				echo "<a href=\"" . $row['fblink'] . "\">";
			    				echo "<center><img src=\"" . $defaultImageFolder . "fbicon.png\" style=\"border-radius: 10px;\">";
			    				echo "</a>";
			    			}
			    	?>
			    </div>   
			    
			</div>

<?php
		}
	else
		{
			echo mysql_errno();
		}