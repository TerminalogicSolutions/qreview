<?php
session_start();
$last_recid = ""; //Instantiates the last recid

if(isset($_SESSION['authenticated_user']))
	{
		include("includes/config.php");
		include("includes/globals.inc.php");
		include("includes/imgLib.php");
		
		$category_recid = $_POST['categoryid'];
		$title = mysql_real_escape_string($_POST['title']);
		$rating = $_POST['rating'];
		$review_text = mysql_real_escape_string($_POST['review_text']);
		$fblink = mysql_real_escape_string($_POST['fblink']);
		$date = date("Ymd");
		
		$query = "Insert into reviews (title, rating, review_text, fblink, category_recid, date_posted) VALUES ('$title', '$rating', '$review_text', '$fblink', '$category_recid', '$date')";
		$result = mysql_query($query );
		
		if ($result)
					{
						//Pull the last insert recid to be associated with the included images 		
						$querylast = "Select Last_Insert_ID() as recid from reviews";
						$querylast_result = mysql_query($querylast);
						$rowlastinsert = mysql_fetch_array($querylast_result);
						$last_recid = $rowlastinsert['recid'];
											
						$dst = "../images/reviews/";						
						
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
								postImage($image, $last_recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '1_sm', $dst);
								postImage($image, $last_recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '1_md', $dst);
								postImage($image, $last_recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '1_lg', $dst);
							}
						//Handles IMage2
						if($_FILES['image2']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '2_sm.jpg'))
						  	       {unlink($dst . $recid . '2_sm.jpg');}
						  	       if(file_exists($dst . $recid . '2_md.jpg'))
						  	       {unlink($dst . $recid . '2_md.jpg');}
						  	       if(file_exists($dst . $recid . '2_lg.jpg'))
						  	       {unlink($dst . $recid . '2_lg.jpg');}
	
						  	    $image = $_FILES['image2']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $last_recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '2_sm', $dst);
								postImage($image, $last_recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '2_md', $dst);
								postImage($image, $last_recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '2_lg', $dst);
							}
							
							//Handles IMage3
						if($_FILES['image3']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '3_sm.jpg'))
						  	       {unlink($dst . $recid . '3_sm.jpg');}
						  	       if(file_exists($dst . $recid . '3_md.jpg'))
						  	       {unlink($dst . $recid . '3_md.jpg');}
						  	       if(file_exists($dst . $recid . '3_lg.jpg'))
						  	       {unlink($dst . $recid . '3_lg.jpg');}
	
						  	    $image = $_FILES['image3']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $last_recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '3_sm', $dst);
								postImage($image, $last_recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '3_md', $dst);
								postImage($image, $last_recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '3_lg', $dst);
							}
							
						//Handles IMage4
						if($_FILES['image4']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '4_sm.jpg'))
						  	       {unlink($dst . $recid . '4_sm.jpg');}
						  	       if(file_exists($dst . $recid . '4_md.jpg'))
						  	       {unlink($dst . $recid . '4_md.jpg');}
						  	       if(file_exists($dst . $recid . '4_lg.jpg'))
						  	       {unlink($dst . $recid . '4_lg.jpg');}
	
						  	    $image = $_FILES['image4']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $last_recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '4_sm', $dst);
								postImage($image, $last_recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '4_md', $dst);
								postImage($image, $last_recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '4_lg', $dst);
							}

						//Handles IMage5
						if($_FILES['image5']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '5_sm.jpg'))
						  	       {unlink($dst . $recid . '5_sm.jpg');}
						  	       if(file_exists($dst . $recid . '5_md.jpg'))
						  	       {unlink($dst . $recid . '5_md.jpg');}
						  	       if(file_exists($dst . $recid . '5_lg.jpg'))
						  	       {unlink($dst . $recid . '5_lg.jpg');}
	
						  	    $image = $_FILES['image5']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $last_recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '5_sm', $dst);
								postImage($image, $last_recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '5_md', $dst);
								postImage($image, $last_recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '5_lg', $dst);
							}
						
						//Return to the categories page		
						header("Location: index.php?content=reviewdetail&id=$last_recid"); 
					}
				else
					{
						echo "Nope, didn't work<br><br>$query";
					}
		
	}
else
	{
		header("Location: http://$loginpage ");
	}


?>