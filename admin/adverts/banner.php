<head>
<style type="text/css">
<!--
#bannerform1 {
	background-color: #333;
	border-radius: 15px;
	margin-bottom: 10px;
}
#bannerform2 {
	width: 400px;
	padding: 5px;
	margin: auto;
}
#bannerform3 {
	margin: auto;
	padding: 5px;
	width: 400px;
}
#bannerform4 {
	width: 468px;
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
label.banner {
	font-size: 18px;
	color: #FFF;
}
input.banner {
	width: 385px;
	font-size: 16px;
	padding: 6px;
}
input.bannersubmit {
	width: 100px;
	height: 30px;
	boarder-radius: 30px;
}
#bannerlist {
	margin: auto;
	width: 468px;
	padding: 10px;
}
#bannerlist2 {
	margin: auto;
	width: 468px;
	padding: 10px;
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
	// Grab filed values and send to banners.php, You can do whatever you want with them in the banners.php file
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
			uploader : '/jquery.uploadify-v3.0.0/banner.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : '/theqreview/adverts/images/banners',
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
				//window.location = "index.php?page=adverts/addbanner.php&edit&id="
			}
		});
	}
});
</script>

</head>

<body>

<?php
/***** Start Database Insert For New Banner *****/
if(isset($_POST['addsubmit'])){
	$image = $_POST['image'];
	$website = $_POST['website'];
	$rotation = $_POST['rotation'];
	
	if($image != ""){ //&& $website != "" && $rotation != ""){
	$insert = "insert into banners (image, website) values ('$image', '$website')";
	mysql_query($insert) or die (mysql_error());
	$id = mysql_insert_id();
	$update = "update banners set rotation = '$rotation'"; 
	mysql_query($update) or die (mysql_error());
?>
	<script language="Javascript">
		window.location = "index.php?page=adverts/banner.php&task=edit&id=<?php echo $id; ?>";
	</script>
    <?php
	} else {
		?>
		<script language="Javascript">
			window.location = "index.php?page=adverts/banner.php&task=new&error=y";
		</script>
		<?php
	}
}

/***** Start Database Update For New Banner *****/
if(isset($_POST['editsubmit'])){
	$id = $_POST['id'];
	$image = $_POST['image'];
	$website = $_POST['website'];
	$rotation = $_POST['rotation'];
	if($rotation < 7){ $rotation = 7; }
	$active = $_POST['active'];
	$first = $_POST['first'];
	
	if($image != ""){ //&& $website != "" && $rotation != ""){
		$update = "update banners set rotation = '$rotation'";
		mysql_query($update) or die (mysql_error());
		
		if($first == "Y"){
		$update2 = "update banners set first = '' where id != $id";
		mysql_query($update2) or die (mysql_error());
		}
		$update3 = "update banners set image = '$image', website = '$website', active = '$active', first = '$first' where id = '$id'";
		mysql_query($update3) or die (mysql_error());
	
		?>
		<script language="Javascript">
			window.location = "index.php?page=adverts/banner.php&task=edit&id=<?php echo $id; ?>";
		</script>
    	<?php
	}
}

/***** Start Delete Banner Entry and Image*****/
if (isset($_GET["deleteid"])){
	$id = $_GET["deleteid"];
	$image = $_GET['image'];
	$dir = 'adverts/images/banners/';
	$banner = $dir.$image;

	if(file_exists ($banner)){
		unlink("$banner");
	}
	$sql = "delete from banners where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "http://thepfwebhosting.com/";
	</script>
<?php
}

/***** Start Delete Banner Image *****/
if (isset($_GET["deleteimage"])){
	$deleteimage = $_GET["deleteimage"];
	$id = $_GET["id"];
	unlink("$deleteimage");
	$sql = "update banners set active = '' where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "index.php?page=adverts/banner.php&task=edit&id=<?php echo $id; ?>";
	</script>
<?php
}


/***** Start New Banner Form *****/
if($task == "new"){
	?>
	<div id="bannerform1">
		<div id="bannerform2">
		<form name="addbanner" id="addbanner" method="post" action="index.php?page=adverts/banner.php">
            <?php
			if($error == "y"){
			?>
			<label class="banner">You must fill out all fields before submitting!</label> <br /><br /><br />
            <?php
            }
			?>	
			<label class="banner">Banner Name</label> <br />
			<input class="banner" type="text" name="image" id="image" /> <br /><br />
			<label class="banner">Website</label> <br />
			<input class="banner" type="text" name="website" id="website" /> <br /><br />
			<input type="submit" name="addsubmit" id="addsubmit" value="Submit" />
		</form>
		</div>
	</div>
    <?php
}

/***** Start List Banners *****/
if($task == "list"){
	?>
    <div id="bannerform1">
    <?php
	$sql = "select * from banners order by first desc";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
			$id = $row['id'];
			$image = $row['image'];
			$first = $row['first'];
			$dir = 'adverts/images/banners/';
			$banner = $dir.$image;
			$noimage = "nobanner.gif";
			$nobanner = $dir.$noimage;
			if(file_exists ($banner)){
			?>
               <div id="bannerlist">
               		<a href="index.php?page=adverts/banner.php&task=edit&id=<?php echo $id ?>"><img src="<?php echo $banner ?>" WIDTH="468" HEIGHT="60"></a>
               </div>     
            <?php
            } else {
				?>
               <div id="bannerlist">
					<a href="index.php?page=adverts/banner.php&task=edit&id=<?php echo $id ?>"><img src="<?php echo $nobanner ?>" WIDTH="468" HEIGHT="60"></a>	
               </div>
			 <?php
			} 
        }
    }
?>
</div>
<?php
}        


/***** Start Edit Banner Form *****/
if($task == "edit"){
	$sql = "select * from banners where id = '$id' limit 1";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
	?>
	<div id="bannerform1">
		<div id="bannerform2">
		<form name="myForm" id="myForm" method="post">
        	<label class="banner">Record ID</label> <br />
        	<input class="banner" type="text" name="id" id="id" value="<?php echo $row['id'] ?>" readonly="readonly" /> <br /><br />
			<label class="banner">Banner Name</label> <br />
			<input class="banner" type="text" name="image" id="image" value="<?php echo $row['image'] ?>" /> <br /><br />
			<label class="banner">Website</label> <br />
			<input class="banner" type="text" name="website" id="website" value="<?php echo $row['website'] ?>" /> <br /><br />
			<label class="banner">Rotation Time (in minutes)</label> <br />
			<input class="banner" type="text" name="rotation" id="rotation" value="<?php echo $row['rotation'] ?>" /> <br /><br />
            <?php
			$image = $row['image'];
			$dir = 'adverts/images/banners/';
			$deletebanner = $dir.$image;
			if(file_exists ($deletebanner)){
			?>
              <label class="banner"><input class="bannercheckbox" type="checkbox" name="active" <?php if ($row['active'] == "Y"){ echo'checked'; } ?> value="Y">&nbsp;&nbsp;Active</label> <br />
              <label class="banner"><input class="bannercheckbox" type="checkbox" name="first" <?php if ($row['first'] == "Y"){ echo'checked'; } ?> value="Y">&nbsp;&nbsp;First Banner</label> <br />
              <?php    
              }
              ?>
			<input class="" type="submit" name="editsubmit" id="editsubmit" value="Submit" /> <br />
            <a href="index.php?page=adverts/banner.php&deleteid=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>"><img src="../images/delete_16.png"></a>
		</form>
		</div>
	</div>
    
     <!--Start New Banner Form--> 
	<div id="bannerform1">
		<div id="bannerform2">
		
			<div id="gallery">You've got a problem with your JavaScript</div>
			<div id="imageheader"><label class="banner">Images</label> <a href="#" onClick="jQuery('#gallery').uploadifyCancel('*'); return false;">(Clear Images List)</a></div>
			<div id="fileQueue"></div>
			<br /><br />
			<div id="doformsubmit"><button type="button" name="btSubmit" id="btSubmit" onClick="doFormSubmit()">Upload and Submit</button></div>
		</div>
	</div>
    
    <div id="bannerform1">
		<div id="bannerform4">
			<?php
			$image = $row['image'];
			$dir = 'adverts/images/banners/';
			$deletebanner = $dir.$image;
			if(file_exists ($deletebanner)){
			?>
			<img src="http://thepfwebhosting.com/<?php echo $deletebanner ?>" WIDTH="468" HEIGHT="60"><a href="index.php?page=adverts/banner.php&deleteimage=<?php echo $deletebanner ?>&id=<?php echo $row['id'] ?>"><img src="/images/delete_16.png"></a>
            <?php
            }
			?>
		</div>
	</div>
    <?php
		}
	}
}
?>
</body>
	</html>   