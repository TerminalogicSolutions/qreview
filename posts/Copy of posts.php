<head>
<style type="text/css">
<!--
#postform1 {
	background-color: #333;
	border-radius: 15px;
	margin-bottom: 10px;
}
#postform2 {
	width: 400px;
	padding: 5px;
	margin: auto;
}
#postform3 {
	margin: auto;
	padding: 5px;
	width: 400px;
}
#postform4 {
	width: 254px;
	padding: 5px;
	margin: auto;
}
#imageheader {
	margin: auto;
	width: 175px;
}	
#gallery {
	margin-left: 125px;
	boarder-radius: 30px;
	margin-top: 20px;
	margin-bottom: 20px;
}
#fileQueue {
	margin-left: 15px;
}
#btSubmit {
	height: 30px;
	width: 150px;
}
#doformsubmit {
	margin-left: 125px;
	boarder-radius: 30px;
	margin-top: 20px;
	margin-bottom: 20px;
	height: 30px;
	width: 150px;
}
#addsubmit {
	margin-left: 130px;
	boarder-radius: 30px;
	margin-top: 20px;
	margin-bottom: 20px;
	height: 30px;
	width: 150px;
}
#editsubmit {
	margin-left: 125px;
	boarder-radius: 30px;
	margin-top: 20px;
	margin-bottom: 20px;
	height: 30px;
	width: 150px;
}
label.post {
	font-size: 18px;
	color: #FFF;
}
input.post {
	width: 385px;
	font-size: 16px;
	padding: 6px;
}
input.postsubmit {
	width: 100px;
	height: 30px;
	boarder-radius: 30px;
}
#postlist {
	margin: auto;
	width: 254px;
	padding: 10px;
}
#postlist2 {
	margin: auto;
	width: 254px;
	padding: 10px;
}
.postselect{
	color: #000;
	font-size: 16px;
	width: 400px;
	padding: 6px;
	margin-bottom: 10px;
	background-color: #FFF;
}
-->
</style>

<!-- Uploadify -->
<script type="text/javascript" src="/jquery.uploadify-v3.0.0/jquery.1.6.2.min.js"></script>
<link type="text/css" rel="stylesheet" href="/jquery.uploadify-v3.0.0/uploadify.css" />
<script type="text/javascript" src="/jquery.uploadify-v3.0.0/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/jquery.uploadify-v3.0.0/flash_detect.1.0.4.min.js"></script>

<script type="text/javascript">
function doFormSubmit() {
	// Grab filed values and send to block.php, You can do whatever you want with them in the block.php file
	var myObjVars = {};
	$("form[id$=myForm] input").each(function () {
		switch ($(this)[0].type) {
			case "text":
				myObjVars[$(this)[0].id] = $(this).val();
			break;
		}
	});
	$('#gallery').uploadifySettings('postData', myObjVars);

	// UPLOAD IMAGES
	$('#gallery').uploadifyUpload();
}

$(document).ready(function() {
	// Verify if Flash Player is Installed and if Flash Player version is 9 or higher
	if (!FlashDetect.versionAtLeast(9)) {
		// You can have an invisible DIV that contains an alternative form input box to upload files without uploadify, when Flash Detect Fails, you set it to visible and handle things the way you want, you can use this error control to do whatever you want if user has no Flash Player Inslalled.
		$("#gallery").html('You do not have Flash Player installed or your Flash Player is too old!<br>Please install Flash Player 9 or higher.');
	} else {
		$("#gallery").uploadify({
			// Required Settings
			langFile : '/jquery.uploadify-v3.0.0/uploadifyLang_en.js',
			swf : '/jquery.uploadify-v3.0.0/uploadify.swf',
			uploader : '/jquery.uploadify-v3.0.0/posts.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : '/theqreview/posts/images/posts',
			'createFolder'    : false,
			'debug'           : false, // DON'T SET THIS TO TRUE UNLESS YOU NEED TO SEE IF THERE IS ANY ERROR IN YOUR SCRIPT. IN YOUR SITE, JUST DON'T USE THIS OPTION AT ALL
			'auto'            : false,
			'buttonText'      : 'Select Images',
			'width'           : 150,
			'height'          : 30,
			'cancelImage'     : '/jquery.uploadify-v3.0.0/uploadify-cancel.png',
			'checkExisting'   : '/jquery.uploadify-v3.0.0/uploadify-check-exists.php',
			'fileSizeLimit'   : 1*1024, // 1MB
			'fileTypeDesc'    : 'Image Files',
			'fileTypeExts'    : '*.gif;*.jpg;*.png',
			'method'          : 'post',
			'multi'           : false,
			'queueID'         : 'fileQueue',
			'queueSizeLimit'  : 999,
			'removeCompleted' : true,
			'postData'        : {},
			'progressData'    : 'all',

			onSelect : function(file) {
				$("#formFields").append("<tr id='table_"+file.id+"'><td align='right'>Tile for image <b>"+file.name+"</b>:</td><td align='left'><input type='text' id='img_"+file.id+"_title' name='img_"+file.id+"_title' value='' /></td></tr>");
			},

			onUploadSuccess : function(file,data,response) {
				$("#myForm").append("<input type='text' id='img_"+file.id+"_fileName' name='img_"+file.id+"_fileName' value='"+data+"' />"); // INSERT IMAGE FILENAME IN A HIDDEN FORM FIELD
			},

			onQueueComplete: function (stats) {
				$('#myForm').submit(); // THIS IS AN EXAMPLE, YOU CAN SUBMIT YOUR INFOS WITH AJAX IF YOU WANT
			}
		});
	}
});
</script>

</head>

<body>

<?php
date_default_timezone_set('America/New_York');
$today = date("F j, Y g:i a");

/***** Start List blocks *****/
if($task == "list"){
	?>
    <div id="blockform1">
    <?php
	$sql = "select * from posts order by post_date asc";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
			$post_id = $row['id'];

			?>
               <div id="blocklist">
               		<a href="index.php?page=posts/posts.php&task=edit&id=<?php echo $post_id ?>"><?php echo $post_id ?></a>
               </div>     
            <?php
        }
    }
?>
</div>
<?php
}   
/***** End List blocks *****/

/***** Start New Post Form *****/
if($task == "new"){
	?>
	<div id="postform1">
		<div id="postform2">
		<form name="addpost" id="addpost" method="post" action="index.php?page=posts/posts.php">
            <label class="post">Post Title</label> <br />
			<input class="post" type="text" name="post_title" id="post_title" /> <br /><br />
            <input class="post" type="text" name="post_date" id="post_date" value="<?php echo $today ?>" readonly="readonly" /> <br /><br />
			<input type="submit" name="addsubmit" id="addsubmit" value="Submit" />
		</form>
		</div>
	</div>
    <?php
}
/***** End New Post Form *****/

/***** Start Database Insert For New Post *****/
if(isset($_POST['addsubmit'])){
	$post_title = $_POST['post_title'];
	$post_date = $_POST['post_date'];
	
	if($post_title != ""){ 
	$insert = "insert into posts (post_title, post_date) values ('$post_title','$post_date')";
	mysql_query($insert) or die (mysql_error());
	$post_id = mysql_insert_id();
?>
	<script language="Javascript">
		window.location = "index.php?page=posts/posts.php&task=edit&id=<?php echo $post_id; ?>";
	</script>
    <?php
	} else {
		?>
		<script language="Javascript">
			window.location = "index.php?page=posts/posts.php&task=new";
		</script>
		<?php
	}
}
/***** End Database Insert For New Post *****/

/***** Start Edit Post Form *****/
if($task == "edit"){
	$sql = "select * from posts where id = '$id' limit 1";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
			$post_id = $row['id'];
			$post_date = $row['post_date'];
			$post_title = $row['post_title'];
			$post_content = $row['post_content'];
			$post_status = $row['post_status'];
			$post_website = $row['post_website'];
			$post_category = $row['post_category'];
			$post_image = $row['post_image'];
	?>
	<div id="postform1">
		<div id="postform2">
		<form name="myForm" id="myForm" method="post">
        	<label class="post">Record ID</label> <br />
        	<input class="post" type="text" name="post_id" value="<?php echo $post_id ?>" readonly="readonly" /> <br /><br />
            <label class="post">Date Posted</label> <br />
        	<input class="post" type="text" name="post_date" value="<?php echo $post_date ?>" readonly="readonly" /> <br /><br />
			<label class="post">Post Title</label> <br />
			<input class="post" type="text" name="post_title" value="<?php echo $post_title ?>" /> <br /><br />
			<label class="post">Website</label> <br />
			<input class="post" type="text" name="post_website" id="post_website" value="<?php echo $post_website ?>" /> <br /><br />
            <label class="post">Category</label> <br />
			<select name="post_category" class="postselect">
            	<option value="" selected="selected"></option>
                <?php
				$sql2 = "SELECT * from category order by name asc";
				$result2 = mysql_query($sql2) or die (mysql_error());
                while ($row2 = mysql_fetch_assoc($result2)) {
					$category_id = $row2['id'];
					$category_name = $row2['name'];
					?>
              <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                    <?php
				}
				?>
            </select><br /><br />
            <label class="post"><input class="postcheckbox" type="checkbox" name="status" <?php if ($row['post_status'] == "Y"){ echo'checked'; } ?> value="Y">&nbsp;&nbsp;Publish</label> <br />
			<input class="" type="submit" name="editsubmit" id="editsubmit" value="Submit" /> <br />
            <a href="index.php?page=posts/posts.php&deleteid=<?php echo $row['id'] ?>"><img src="../images/delete_16.png"></a>
		</form>
		</div>
	</div>
    
     <!--Start New block Form--> 
	<div id="postform1">
		<div id="postform2">
		
			<div id="gallery">You've got a problem with your JavaScript</div>
			<div id="imageheader"><label class="post">Images</label> <a href="#" onClick="jQuery('#gallery').uploadifyCancel('*'); return false;">(Clear Images List)</a></div>
			<div id="fileQueue"></div>
			<br /><br />
			<div id="doformsubmit"><button type="button" name="btSubmit" id="btSubmit" onClick="doFormSubmit()">Upload and Submit</button></div>
		</div>
	</div>
    
    <div id="postform1">
		<div id="postform4">
        	<?php
			$dir = "/posts/images/$id";
			if(is_dir($dir)){
				if ($handle = opendir("$dir")) {
					while (false !== ($file = readdir($handle))){
    					if($file != '.' && $file != '..') {
							if (preg_match("/$id/i", "$file")) {
								//echo''.$dir.'/'.$file.'';
								$deleteimage = $id."/".$file;
							}
							?>
                            <a href="http://thepfwebhosting.com/posts/images/<?php echo $id ?>/<?php echo $file ?>" rel="prettyPhoto[gallery1]" title=""><img src="http://thepfwebhosting.com/posts/images/<?php echo $id ?>/<?php echo $file ?>" WIDTH="80" HEIGHT="80"></a><a href="index.php?page=posts/posts.php?deleteimage=<?php echo $deleteimage ?>&entryid=<?php echo $id ?>"><img src="/images/delete_16.png"></a><img src="/images/spacer.gif" width="10">
                            <?php
                        }
                    }
                closedir($handle);
                }
			}
            ?>
		</div>
	</div>
    <?php
		}
	}
}
/***** End Edit Post Form *****/

/***** Start Database Update Post Form*****/
if(isset($_POST['editsubmit'])){
	$post_id = $row['id'];
	$post_date = $row['post_date'];
	$post_title = $row['post_title'];
	$post_content = $row['post_content'];
	$post_status = $row['post_status'];
	$post_website = $row['post_website'];
	$post_category = $row['post_category'];
	$post_image = $row['post_image'];

	$update = "update posts set post_title = '$post_title', post_content = '$post_content', post_status = '$post_status', post_website = '$post_website', post_category = '$post_category', post_image = '$post_image'";
	mysql_query($update) or die (mysql_error());
		
		?>
		<script language="Javascript">
			window.location = "index.php?page=adverts/bigad.php&task=edit&id=<?php echo $id; ?>";
		</script>
    	<?php
}
/***** End Database Update Post Form *****/

/***** Start Delete block Entry and Image*****/
if (isset($_GET["deleteid"])){
	$id = $_GET["deleteid"];
	$image = $_GET['image'];
	$dir = 'adverts/images/bigad/';
	$block = $dir.$image;

	if(file_exists ($block)){
		unlink("$block");
	}
	$sql = "delete from bigad where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "http://thepfwebhosting.com/";
	</script>
<?php
}

/***** Start Delete Block Image *****/
if (isset($_GET["deleteimage"])){
	$deleteimage = $_GET["deleteimage"];
	$id = $_GET["id"];
	unlink("$deleteimage");
	$sql = "update bigad set active = '' where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "index.php?page=adverts/bigad.php&task=edit&id=<?php echo $id; ?>";
	</script>
<?php
}
?>

</body>
	</html>   