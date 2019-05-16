<?php 
	include("includes/globals.inc.php");
	$recid = @$_GET['id'];
	$query = "Select * from events_insights where recid = " . $recid;
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);
			$dst = "../images/events_insights/";
			$rand = rand(1,1000);
			if(isset($_GET['mode']))
				{
					$update = true;
				}
			else
				{
					$update = false;
				}
			
			if($update == false)
				
			{        ////////////////////VIEW ONLY/////////////////////
				?>
						<div id="events_insights">
						<div id="update" style="float: right; top: 10px; right:10px; height: 20px; padding: 5px; background-color: #FF6600; color:white; border-radius: 5px;"><a href="index.php?content=events_insightsdetail&mode=update&id=<?php echo $recid; ?>">Update</a></div>
							<div class="events_insights_title"> <?php echo $row['title']; ?>
						    </div>
						    <div class="events_insights_thumb">
						    <?php
						    	if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_1_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_1_sm.jpg?" . $rand . "\"></center>";
									}
							?>
						    </div>
						    <div class="events_insights_text"><?php echo stripslashes($row['events_insights_text']); ?>			    </div>	
						    <div class="events_insights_social">
						    </div>   
						</div>
<?php		}

		else
			{  
								///////////////////////UPDATE/////////////////////
			?>
					<form method="post" action="post_events_insights_update.php" enctype="multipart/form-data">
						<?php 
						//Query the categories for use in the dropdown selection box
						$queryCategories = "Select recid, CONCAT(`primary`, '>>', `sub`) as category from categories where sub IS NOT NULL and isReviewable = '1'";
						$resultCategories = mysql_query($queryCategories);
						?>
						Review Category: <select name="categoryid">
							<?php
								while($rowCat=mysql_fetch_array($resultCategories, MYSQL_ASSOC))
									{
										echo "<option value=\"" . $rowCat['recid'] . "\">" . $rowCat['category'] . "</option>";
									}
							?>
						</select>
						<br><br>
						events_insights Title: <input type="text" name="title" value="<?php echo $row['title'];?>"><br><br>
						<br><br>
						
						<script type="text/javascript">
                            tinyMCE.init({
                            theme : "advanced",
                            mode : "exact",
                            elements: "events_insights_text",
                            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,insertdate,inserttime,|,forecolor,backcolor"
                            });
                        </script>
                        						
						<textarea cols="75 " rows="15" name="events_insights_text" id="events_insights_text"><?php echo stripslashes(nl2br($row['events_insights_text']));?></textarea>
						<br><br>
						
						Link to facebook: <input type="text" name="fblink" value="<?php echo $row['fblink'];?>"><br><br>
						
						<table cellpadding="5">
							<tr>
								<td colspan="2">
								<center>
								<?php if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_1_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_1_sm.jpg?" . $rand . "\"></center>";
									}?><input name="image1" type="file" />
								</center></td>
							</tr>
							<tr>
								<td>
								<?php if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_2_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_2_sm.jpg?" . $rand . "\"></center>";
									}?>
								<input name="image2" type="file" /></td>
								<td>
								<?php if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_3_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_3_sm.jpg?" . $rand . "\"></center>";
									}?>
								<input name="image3" type="file" /></td>
							</tr>
								<tr>
								<td>
								<?php if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_4_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_4_sm.jpg?" . $rand . "\"></center>";
									}?>
								<input name="image4" type="file" /></td>
								<td>
								<?php if(file_exists($defaultevents_insightsImageFolderAdmin . $recid . "_5_sm.jpg"))
									{
										echo "<center><img src = \"" . $defaultevents_insightsImageFolderAdmin . $recid . "_5_sm.jpg?" . $rand . "\"></center>";
									}?>
								<input name="image5" type="file" /></td>
							</tr>
						
						</table>
						<br>
						<input type="hidden" name="id" value="<?php echo $recid;?>">
						<input type="submit" value="Updateevents_insights">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset Form">
						
						</form>

<?php		}
		}
	else
		{
			echo mysql_errno();
		}