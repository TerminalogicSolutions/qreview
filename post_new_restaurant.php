<?php
session_start();
$last_recid = ""; //Instantiates the last recid

if(isset($_SESSION['authenticated_user']))
	{
		include("includes/config.php");
		include("includes/globals.inc.php");
		include("includes/imgLib.php");
		
		
		$title = mysql_real_escape_string($_POST['title']);
		$recipe_text = mysql_real_escape_string($_POST['restaurant_text']);
		$fblink = mysql_real_escape_string($_POST['fblink']);
		$date = date("Ymd");
		
		$query = "Insert into restaurant (title, restaurant_text, fblink, date_posted) VALUES ('$title', '$restaurant_text', '$fblink', '$date')";
		$result = mysql_query($query );
		
		if ($result)
					{
						//Pull the last insert recid to be associated with the included images 		
						$querylast = "Select Last_Insert_ID() as recid from restaurant";
						$querylast_result = mysql_query($querylast);
						$rowlastinsert = mysql_fetch_array($querylast_result);
						$last_recid = $rowlastinsert['recid'];
											
						$dst = "../images/restaurants/";						
						
						//Handles the main image
						if($_FILES['image1']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '1_sm.jpg'))
						  	       {unlink($dst . $recid . '1_sm.jpg');}
						  	       if(file_exists($dst . $recid . '1_md.jpg'))
						  	       {unlink($dst . $recid . '1_md.jpg');}
						  	       if(file_exists($dst . $recid . '1_lg.jpg'))
						  	       {unlink($dst . $recid . '1_lg.jpg');}
	
						  	    $image = $_FILES['image1']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $last_recid, $RestaurantImageSmallWidth, $RestaurantImageSmallHeight , '1_sm', $dst);
								postImage($image, $last_recid, $RestaurantImageMediumWidth, $RestaurantImageMediumHeight , '1_md', $dst);
								postImage($image, $last_recid, $RestaurantImageLargeWidth, $RestaurantImageLargeHeight , '1_lg', $dst);
							}
												//Return to the categories page		
						header("Location: index.php?content=restaurantdetail&id=$last_recid"); 
					}
				else
					{
						echo "Nope, didn't work<br><br>MySQL error " . mysql_errno() . ": " . mysql_error() . "<br><br>$query";
					}
		
	}
else
	{
		header("Location: http://$loginpage ");
	}


?>