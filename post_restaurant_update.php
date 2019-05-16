<?php
session_start();
$recid = ""; //Instantiates the last recid

if(isset($_SESSION['authenticated_user']))
	{
		include("includes/config.php");
		include("includes/globals.inc.php");
		include("includes/imgLib.php");
		

		$title = mysql_real_escape_string($_POST['title']);
		$review_text = mysql_real_escape_string($_POST['restaurant_text']);
		$fblink = mysql_real_escape_string($_POST['fblink']);
		$date = date("Ymd");
		$recid = $_POST['id'];
		
		//$sqlInsert = "Insert into restaurant (title, rating, restaurante_text, fblink, category_recid, date_posted) VALUES ('$title', '$rating', '$restaurant_text', '$fblink', '$category_recid', '$date')";
		$query = "Update restaurant SET title = '$title', rating = '$rating', restaurant_text = '$restaurant_text', fblink = '$fblink', category_recid = '$category_recid', date_posted = '" . date("Ymd") . "' where recid = $recid";
		$result = mysql_query($query);
		
		if ($result)
					{
						$dst = $defaultRestaurantImageFolderAdmin;						
						
						//Handles the main image
						if($_FILES['image1']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '_1_sm.jpg'))
						  	       {unlink($dst . $recid . '_1_sm.jpg');}
						  	       if(file_exists($dst . $recid . '_1_md.jpg'))
						  	       {unlink($dst . $recid . '_1_md.jpg');}
						  	       if(file_exists($dst . $recid . '_1_lg.jpg'))
						  	       {unlink($dst . $recid . '_1_lg.jpg');}
	
						  	    $image = $_FILES['image1']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $recid, $restaurantImageSmallWidth, $restaurantImageSmallHeight , '1_sm', $dst);
								postImage($image, $recid, $restaurantImageMediumWidth, $restaurantImageMediumHeight , '1_md', $dst);
								postImage($image, $recid, $restaurantImageLargeWidth, $restaurantImageLargeHeight , '1_lg', $dst);
							}
												
						//Return to the categories page		
						header("Location: index.php?content=restaurantdetail&id=$recid"); 
					}
				else
					{
						if (mysql_errno()) 
							{
								echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
							}

						echo "<br><br>Nope, didn't work<br><br>$query";
					}
		
	}
else
	{
		header("Location: http://$loginpage ");
	}


?>