<form method="post" action="post_new_giveaways.php" enctype="multipart/form-data">

<br><br>
giveaways Title: <input type="text" name="title"><br><br>
<br><br>

<textarea cols="50" rows="15" name="giveaways_text" id="giveaways_text"></textarea>
<br><br>

Link to facebook: <input type="text" name="fblink"><br><br>

<table cellpadding="5">
	<tr>
		<td colspan="2"><center>Primary Product Image:<input name="image1" type="file" /></center></td>
	</tr>
	
</table>
<br>

<input type="submit" value="Post giveaways">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Clear Form">

</form>

<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "exact",
        elements: "giveaways_text",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,insertdate,inserttime,|,forecolor,backcolor"
    });
</script>