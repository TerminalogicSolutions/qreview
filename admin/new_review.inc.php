<form method="post" action="post_new_review.php" enctype="multipart/form-data">
<?php 
//Create empty array
$stringEntries = "";
$entries = array();

//Query the categories for use in the dropdown selection box
$queryCategories = "Select `recid`, `primary`, `sub` from categories where isReviewable = '1'";
$resultCategories = mysql_query($queryCategories);

//Build the stringArray with entries that will be used for the ddl (DropDownList)
while($row=mysql_fetch_array($resultCategories, MYSQL_ASSOC))
{	
if($row['sub'] == '' or $row['sub'] == "NULL")
{
$stringEntries = $stringEntries . $row['recid'] . "~~" . $row['primary'] . "||";
}
else
{
$stringEntries = $stringEntries . $row['recid'] . "~~" . $row['primary'] . ">>" . $row['sub'] . "||";
}
}
//Breaks the string into a usable array	
$entries = explode("||", $stringEntries);

?>
Review Category: <select name="categoryid">
<?php
foreach ($entries as $i => $value) {
$value = trim($value);
$value = explode("~~", $value );
if($value[0] <> ""){echo "<option value=\"" . $value[0] . "\">" . $value[1]. "</option>";}
}
?>
</select>
<br><br>

Review Title: <input type="text" name="title"><br><br>
Rating: <select name="rating">
			<option value="">Choose Rating</option>
			<option value="0.0">0.0</option>
			<option value="0.5">0.5</option>
			<option value="1.0">1.0</option>
			<option value="1.5">1.5</option>
			<option value="2.0">2.0</option>
			<option value="2.5">2.5</option>
			<option value="3.0">3.0</option>
			<option value="3.5">3.5</option>
			<option value="4.0">4.0</option>
			<option value="4.5">4.5</option>
			<option value="5.0">5.0</option>
		</select>
<br><br>

<textarea cols="90" rows="50" name="review_text" id="review_text"></textarea>

<br><br>

Link to facebook: <input type="text" name="fblink"><br><br>

<table cellpadding="5">
	<tr>
		<td colspan="2"><center>Primary Product Image:<input name="image1" type="file" /></center></td>
	</tr>
	<tr>
		<td>Product Image #2:<input name="image2" type="file" /></td>
		<td>Product Image #3:<input name="image3" type="file" /></td>
	</tr>
		<tr>
		<td>Product Image #4:<input name="image4" type="file" /></td>
		<td>Product Image #5:<input name="image5" type="file" /></td>
	</tr>

</table>
<br>

<input type="submit" value="Post Review">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Clear Form">

</form>

<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "exact",
        width: "650px",
        height: "500px",
        elements: "review_text",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,link,unlink,image",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,insertdate,inserttime,|,forecolor,backcolor"
    });
</script>
