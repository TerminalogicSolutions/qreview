<head>
<style type="text/css">
<!--
#adform1 {
	background-color: #333;
	border-radius: 15px;
	margin-bottom: 10px;
}
#adform2 {
	width: 400px;
	padding: 5px;
	margin: auto;
}
#adform3 {
	margin: auto;
	padding: 5px;
	width: 400px;
}
#adform4 {
	width: 125px;
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
#adsubmit {
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
label.ad {
	font-size: 18px;
	color: #FFF;
}
input.ad {
	width: 385px;
	font-size: 16px;
	padding: 6px;
}
input.adsubmit {
	width: 100px;
	height: 30px;
	boarder-radius: 30px;
}
#adlist {
	margin: auto;
	width: 125px;
	padding: 10px;
}
#adlist2 {
	margin: auto;
	width: 125px;
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
			uploader : '/jquery.uploadify-v3.0.0/smallad.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : '/theqreview/adverts/images/smallad',
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
/***** Start Database Insert For New Small Ad *****/
if(isset($_POST['adsubmit'])){
	$image = $_POST['image'];
	$website = $_POST['website'];
	
	if($image != ""){ 
	$insert = "insert into smallad (image, website) values ('$image', '$website')";
	mysql_query($insert) or die (mysql_error());
	$id = mysql_insert_id();
?>
	<script language="Javascript">
		window.location = "index.php?page=adverts/smallad.php&task=edit&id=<?php echo $id; ?>";
	</script>
    <?php
	} else {
		?>
		<script language="Javascript">
			window.location = "index.php?page=adverts/smallad.php&task=new&error=y";
		</script>
		<?php
	}
}

/***** Start Database Update For New Small Ad *****/
if(isset($_POST['editsubmit'])){
	$id = $_POST['id'];
	$image = $_POST['image'];
	$website = $_POST['website'];
	$active = $_POST['active'];
	$position = $_POST['position'];
	
	if($image != ""){ 
		$update = "update smallad set image = '$image', website = '$website', active = '$active', position = '$position' where id = '$id'";
		mysql_query($update) or die (mysql_error());
	
		?>
		<script language="Javascript">
			window.location = "index.php?page=adverts/smallad.php&task=edit&id=<?php echo $id; ?>";
		</script>
    	<?php
	}
}

/***** Start Delete Small Ad Entry and Image*****/
if (isset($_GET["deleteid"])){
	$id = $_GET["deleteid"];
	$image = $_GET['image'];
	$dir = 'adverts/images/smallad/';
	$ad = $dir.$image;

	if(file_exists ($ad)){
		unlink("$ad");
	}
	$sql = "delete from smallad where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "http://thepfwebhosting.com/";
	</script>
<?php
}

/***** Start Delete Ad Image *****/
if (isset($_GET["deleteimage"])){
	$deleteimage = $_GET["deleteimage"];
	$id = $_GET["id"];
	unlink("$deleteimage");
	$sql = "update smallad set active = '' where id = $id";
	mysql_query($sql) or die ( mysql_error() );
	?>
	<script language="Javascript">
		window.location = "index.php?page=adverts/smallad.php&task=edit&id=<?php echo $id; ?>";
	</script>
<?php
}


/***** Start New Small Ad Form *****/
if($task == "new"){
	?>
	<div id="adform1">
		<div id="adform2">
		<form name="addad" id="addad" method="post" action="index.php?page=adverts/smallad.php">
            <?php
			if($error == "y"){
			?>
			<label class="block">You must fill out all fields before submitting!</label> <br /><br /><br />
            <?php
            }
			?>	
			<label class="ad">Ad Name</label> <br />
			<input class="ad" type="text" name="image" id="image" /> <br /><br />
			<label class="ad">Website</label> <br />
			<input class="ad" type="text" name="website" id="website" /> <br /><br />
			<input type="submit" name="adsubmit" id="adsubmit" value="Submit" />
		</form>
		</div>
	</div>
    <?php
}

/***** Start List blocks *****/
if($task == "list"){
	?>
    <div id="adform1">
    <?php
	$sql = "select * from smallad";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
			$id = $row['id'];
			$image = $row['image'];
			$dir = 'adverts/images/smallad/';
			$ad = $dir.$image;
			$noimage = "noad.gif";
			$noad = $dir.$noimage;
			if(file_exists ($ad)){
			?>
               <div id="adlist">
               		<a href="index.php?page=adverts/smallad.php&task=edit&id=<?php echo $id ?>"><img src="<?php echo $ad ?>" WIDTH="125" HEIGHT="125"></a>
               </div>     
            <?php
            } else {
				?>
               <div id="adlist">
					<a href="index.php?page=adverts/smallad.php&task=edit&id=<?php echo $id ?>"><img src="<?php echo $noad ?>" WIDTH="125" HEIGHT="125"></a>	
               </div>
			 <?php
			} 
        }
    }
?>
</div>
<?php
}        


/***** Start Edit Ad Form *****/
if($task == "edit"){
	$sql = "select * from smallad where id = '$id' limit 1";
	$result = mysql_query($sql) or die (mysql_error());
	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_assoc($result)){
	?>
	<div id="adform1">
		<div id="adform2">
		<form name="myForm" id="myForm" method="post">
        	<label class="ad">Record ID</label> <br />
        	<input class="ad" type="text" name="id" id="id" value="<?php echo $row['id'] ?>" readonly="readonly" /> <br /><br />
			<label class="ad">Ad Name</label> <br />
			<input class="ad" type="text" name="image" id="image" value="<?php echo $row['image'] ?>" /> <br /><br />
			<label class="ad">Website</label> <br />
			<input class="ad" type="text" name="website" id="website" value="<?php echo $row['website'] ?>" /> <br /><br />
            <?php
			$image = $row['image'];
			$dir = 'adverts/images/smallad/';
			$block = $dir.$image;
			if(file_exists ($block)){
			?>
              <label class="ad">Position</label>
              		<select name="position" class="ad">
                    	<option value="<?php echo $row['position'] ?>" selected="selected"><?php echo $row['position'] ?></option>
                        <option value="Top Left">Top Left</option>
                        <option value="Top Right">Top Right</option>
             	        <option value="Bottom Left">Bottom Left</option>
                   		<option value="Bottom Right">Bottom Right</option>
                    </select><br />
              <label class="ad"><input class="adcheckbox" type="checkbox" name="active" <?php if ($row['active'] == "Y"){ echo'checked'; } ?> value="Y">&nbsp;&nbsp;Active</label> <br />      
              <?php    
              }
              ?>
			<input class="" type="submit" name="editsubmit" id="editsubmit" value="Submit" /> <br />
            <a href="index.php?page=adverts/smallad.php&deleteid=<?php echo $row['id'] ?>&image=<?php echo $row['image'] ?>"><img src="../images/delete_16.png"></a>
		</form>
		</div>
	</div>
    
     <!--Start New block Form--> 
	<div id="adform1">
		<div id="adform2">
		
			<div id="gallery">You've got a problem with your JavaScript</div>
			<div id="imageheader"><label class="ad">Images</label> <a href="#" onClick="jQuery('#gallery').uploadifyCancel('*'); return false;">(Clear Images List)</a></div>
			<div id="fileQueue"></div>
			<br /><br />
			<div id="doformsubmit"><button type="button" name="btSubmit" id="btSubmit" onClick="doFormSubmit()">Upload and Submit</button></div>
		</div>
	</div>
    
    <div id="adform1">
		<div id="adform4">
			<?php
			$image = $row['image'];
			$dir = 'adverts/images/smallad/';
			$ad = $dir.$image;
			if(file_exists ($ad)){
			?>
			<img src="http://thepfwebhosting.com/<?php echo $ad ?>" WIDTH="125" HEIGHT="125"><a href="index.php?page=adverts/snallad.php&deleteimage=<?php echo $ad ?>&id=<?php echo $row['id'] ?>"><img src="/images/delete_16.png"></a>
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