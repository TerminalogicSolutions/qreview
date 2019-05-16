<div id="menu">
    <ul class="menu">
               <li><a href="index.php" class="parent"><span>Reviews</span></a>
            <div>
            	<?php
            	$queryPrimary = "Select * from categories where isReview = '1' order by `recid` asc";
            	$PrimaryResult = mysql_query($queryPrimary);
            	
            	if(mysql_num_rows($PrimaryResult) > 0)
            		{
            			echo "<ul>";
            			while($row = mysql_fetch_array($PrimaryResult))	
            				{
            					if($row['primary'] == 'Archives'
            					    or $row['primary'] == 'Info')
            						{
            							continue;
            						}
            					else
            						{
		            				  	echo "<li>";
		            				  	echo "<a href=\"" . $row['link'] . "\" class=\"parent\"><span>" . $row['primary'] . "</span></a>";
		
		            					$querySub = "Select * from categories where `primary` = '" . $row['primary'] . "' and sub IS NOT NULL order by sub asc";
		            					$ResultSub = mysql_query($querySub);
		            					
		            					if(mysql_num_rows($ResultSub) > 0)
		            						{
		            							Echo "<div><ul>";
		            							
		            							while($rowSub = mysql_fetch_array($ResultSub))
		            								{
		            									echo "<li><a href=\"" . $rowSub['link'] . "\"><span>" . $rowSub['sub'] . "</span></a></li>";
		            								}
		            							echo "</ul></div>";
											}
		            					echo "</li>";
		            				}
            				}    		
            		}
            	?>
		                    
			</div>
        </li>
        
        
        <li><a href="index.php?content=recipelist" class="parent"><span>Recipes</span></a>
                    </li>

        <li><a href="#" class="parent"><span>Events</span></a>
                   </li>
        
          <li><a href="#" class="parent"><span>Giveaways</span></a>
                    </li>


  <li><a href="#" class="parent"><span>Contact</span></a>
                   </li>
     




   <?php
		if(isset($_SESSION['authenticated_user']))
		{
		?>	
       <li><a href="#" class="parent"><span>Admin  CP</span></a>
            <div>
            	<?php
            	$queryPrimary = "Select * from categories where isAdmin = '1' order by `recid` asc";
            	$PrimaryResult = mysql_query($queryPrimary);
            	
            	if(mysql_num_rows($PrimaryResult) > 0)
            		{
            			echo "<ul>";
            			while($row = mysql_fetch_array($PrimaryResult))	
            				{
            						echo "<li>";
		            				  	echo "<a href=\"" . $row['link'] . "\" class=\"parent\"><span>" . $row['primary'] . "</span></a>";
		
		            					$querySub = "Select * from categories where `primary` = '" . $row['primary'] . "' and sub IS NOT NULL order by sub asc";
		            					$ResultSub = mysql_query($querySub);
		            					
		            					if(mysql_num_rows($ResultSub) > 0)
		            						{
		            							Echo "<div><ul>";
		            							
		            							while($rowSub = mysql_fetch_array($ResultSub))
		            								{
		            									echo "<li><a href=\"" . $rowSub['link'] . "\"><span>" . $rowSub['sub'] . "</span></a></li>";
		            								}
		            							echo "</ul></div>";
											}
		            					echo "</li>";
		            				}
            				}    		
            		}
            	?>
		                    
			</div>
        </li>
		<?php
		
		?>
    </ul>
</div>
