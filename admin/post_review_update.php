<?php
session_start();
$recid = ""; //Instantiates the last recid

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
		$recid = $_POST['id'];
		
		//$sqlInsert = "Insert into reviews (title, rating, review_text, fblink, category_recid, date_posted) VALUES ('$title', '$rating', '$review_text', '$fblink', '$category_recid', '$date')";
		$query = "Update reviews SET title = '$title', rating = '$rating', review_text = '$review_text', fblink = '$fblink', category_recid = '$category_recid', date_posted = '" . date("Ymd") . "' where recid = $recid";
		$result = mysql_query($query);
		
		if ($result)
					{
						$dst = $defaultReviewImageFolderAdmin;						
						
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
								postImage($image, $recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '1_sm', $dst);
								postImage($image, $recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '1_md', $dst);
								postImage($image, $recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '1_lg', $dst);
							}
						//Handles IMage2
						if($_FILES['image2']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '_2_sm.jpg'))
						  	       {unlink($dst . $recid . '_2_sm.jpg');}
						  	       if(file_exists($dst . $recid . '_2_md.jpg'))
						  	       {unlink($dst . $recid . '_2_md.jpg');}
						  	       if(file_exists($dst . $recid . '_2_lg.jpg'))
						  	       {unlink($dst . $recid . '_2_lg.jpg');}
	
						  	    $image = $_FILES['image2']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '2_sm', $dst);
								postImage($image, $recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '2_md', $dst);
								postImage($image, $recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '2_lg', $dst);
							}
							
							//Handles IMage3
						if($_FILES['image3']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '_3_sm.jpg'))
						  	       {unlink($dst . $recid . '_3_sm.jpg');}
						  	       if(file_exists($dst . $recid . '_3_md.jpg'))
						  	       {unlink($dst . $recid . '_3_md.jpg');}
						  	       if(file_exists($dst . $recid . '_3_lg.jpg'))
						  	       {unlink($dst . $recid . '_3_lg.jpg');}
	
						  	    $image = $_FILES['image3']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '3_sm', $dst);
								postImage($image, $recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '3_md', $dst);
								postImage($image, $recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '3_lg', $dst);
							}
							
						//Handles IMage4
						if($_FILES['image4']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '_4_sm.jpg'))
						  	       {unlink($dst . $recid . '_4_sm.jpg');}
						  	       if(file_exists($dst . $recid . '_4_md.jpg'))
						  	       {unlink($dst . $recid . '_4_md.jpg');}
						  	       if(file_exists($dst . $recid . '_4_lg.jpg'))
						  	       {unlink($dst . $recid . '_4_lg.jpg');}
	
						  	    $image = $_FILES['image4']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '4_sm', $dst);
								postImage($image, $recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '4_md', $dst);
								postImage($image, $recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '4_lg', $dst);
							}

						//Handles IMage5
						if($_FILES['image5']['tmp_name'])
							{
								//echo "Image 1 IF hit";
								if(file_exists($dst . $recid . '_5_sm.jpg'))
						  	       {unlink($dst . $recid . '_5_sm.jpg');}
						  	       if(file_exists($dst . $recid . '_5_md.jpg'))
						  	       {unlink($dst . $recid . '_5_md.jpg');}
						  	       if(file_exists($dst . $recid . '_5_lg.jpg'))
						  	       {unlink($dst . $recid . '_5_lg.jpg');}
	
						  	    $image = $_FILES['image5']['tmp_name'];
						  	    //echo $_FILES['image1']['tmp_name'];
								postImage($image, $recid, $ReviewImageSmallWidth, $ReviewImageSmallHeight , '5_sm', $dst);
								postImage($image, $recid, $ReviewImageMediumWidth, $ReviewImageMediumHeight , '5_md', $dst);
								postImage($image, $recid, $ReviewImageLargeWidth, $ReviewImageLargeHeight , '5_lg', $dst);
							}
						
						//Return to the categories page		
						header("Location: index.php?content=reviewdetail&id=$recid"); 
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