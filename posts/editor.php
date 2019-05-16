<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<style type="text/css">
<!--
#posttext {
	width: 690px;
}
-->
</style>
</head>

<body>
	<form method="post">
		<p>
			My Editor:<br />
			<textarea id="editor1" name="editor1"></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1',
                {
});
			</script>
		</p>
		<p>
			<input type="submit" />
		</p>
	</form>
    
    <?php
	$editor_data = $_POST[ 'editor1' ];
	echo"$editor_data";
	?>

</body>
</html>
