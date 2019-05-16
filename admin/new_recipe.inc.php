<title>The Q Review</title>
<form method="post" action="post_new_recipe.php" enctype="multipart/form-data">

<br><br>
Recipe Title: <input type="text" name="title"><br><br>
<br><br>

<textarea cols="50" rows="15" name="recipe_text" id="recipe_text"></textarea>
<br><br>

Link to facebook: <input type="text" name="fblink"><br><br>

<table cellpadding="5">
	<tr>
		<td colspan="2"><center>Primary Product Image:<input name="image1" type="file" /></center></td>
	</tr>
	
</table>
<br>

<input type="submit" value="Post Recipe">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Clear Form">

</form>

<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "exact",
        width: "650px",
        height: "500px",    
        elements: "recipe_text",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,link,unlink,image",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,insertdate,inserttime,|,forecolor,backcolor"
    });
</script>