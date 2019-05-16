<?php 
	include("includes/globals.inc.php");
	$recid = @$_GET['id'];
	$query = "Select * from recipes where recid = " . $recid;
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
		{
		$row = mysql_fetch_array($result);
	?>
			<div id="recipe">
			
				<div class="recipe_title"> <?php echo $row['title']; ?>
			    
			    </div>
			    	   				
			
			    <div class="recipe_thumb">
			    <?php
			    	if(file_exists($defaultRecipeImageFolder . $row['recid']. "_1_sm.jpg"))
						{
							echo "<center><img src = \"" . $defaultRecipeImageFolder . $row['recid'] . "_1_sm.jpg?" . $rand . "\"></center>";
						}
				?>
				</div>
			    
			    
			    
			    <div class="recipe_text"><?php echo nl2br($row['recipe_text']); ?>			    </div>	
			    
			    <div class="recipe_social">
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