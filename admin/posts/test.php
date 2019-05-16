<?php
include('../includes/config.php');

$sql = "select * from posts";
$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
			$id = $row['id'];
			$post_date = $row['post_date'];
			$post_content = $row['post_content'];
			$post_title = $row['post_title'];
			$post_status = $row['post_status'];
			$post_modified = $row['post_modified'];
			$post_guid = $row['post_guid'];
			$comment_count = $row['comment_count'];
			$post_category = $row['post_category'];
			$post_website = $row['post_website'];
			
            echo'
            <p>id = '.$id.'</p>
            <p>post_date =  '.$post_date.'</p>
			<p>post_content =  '.$post_content.'</p>
            <p>post_title =  '.$post_title.'</p>
       		<p>post_status =  '.$post_status.'</p>     
            <p>post_modified =  '.$post_modified.'</p>
            <p>post_guid =  '.$post_guid.'</p>
            <p>comment_count =  '.$comment_count.'</p>
			<p>post_category =  '.$post_category.'</p>
			<p>post_website =  '.$post_website.'</p>
			<hr>
            ';
		}
	}
	?>