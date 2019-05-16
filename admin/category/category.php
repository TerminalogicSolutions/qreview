<head>
<style type="text/css">
<!--
#categorydiv1 {
	background-color: #333;
	border-radius: 15px;
	margin-bottom: 10px;
}
#categorydiv2 {
	width: 400px;
	padding: 5px;
	margin: auto;
}
#categorydiv3 {
	margin: auto;
	padding: 5px;
	width: 600px;
}
#categorydiv4 {
	padding: 5px;
	margin: auto;
	text-align: center;
	font-size: 20px;
	color: #FFF;
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
label.category {
	font-size: 18px;
	color: #FFF;
}
input.category {
	width: 385px;
	font-size: 16px;
	padding: 6px;
}
input.categorysubmit {
	width: 100px;
	height: 30px;
	boarder-radius: 30px;
}
.categoryselect{
	color: #000;
	font-size: 16px;
	width: 400px;
	padding: 6px;
	margin-bottom: 10px;
	background-color: #FFF;
}
.category,a {
	font-size: 20px;
	color: #FFF;
	font-weight: bold;
	list-style-type: square;
}
-->
</style>
</head>


<?php
$task = $_GET['task'];
$id = $_GET['id'];

/*Start category list function */
  function hasChild($parent)
  {
    $sql = "SELECT COUNT(*) as count FROM category WHERE parent = '" . $parent . "'";
    $qry = mysql_query($sql);
    $rs = mysql_fetch_array($qry);
    return $rs['count'];
  }
  
  function CategoryTree($list,$parent,$append)
  {
    $list = '<li class="category"><a href="index.php?page=category/category.php&task=edit&id='.$parent['id'].'">'.$parent['name'].'</a></li>';
    
    if (hasChild($parent['id'])) // check if the id has a child
    {
      $append++;
      $list .= "<ul class='child child".$append."'>";
      $sql = "SELECT * FROM category WHERE parent = '" . $parent['id'] . "'";
      $qry = mysql_query($sql);
      $child = mysql_fetch_array($qry);
      do{
        $list .= CategoryTree($list,$child,$append);
      }while($child = mysql_fetch_array($qry));
      $list .= "</ul>";
    }
    return $list;
  }
  function CategoryList()
  {
    $list = "";
    
    $sql = "SELECT * FROM category WHERE (parent = 0 OR parent IS NULL)";
    $qry = mysql_query($sql);
    $parent = mysql_fetch_array($qry);
    $mainlist = "<ul class='parent'>";
    do{
      $mainlist .= CategoryTree($list,$parent,$append = 0);
    }while($parent = mysql_fetch_array($qry));
    $list .= "</ul>";
    return $mainlist;
  }

/*End category list function*/

/*Start add category */
if($task == "new"){
	?>
	<div id="categorydiv1">
		<div id="categorydiv2">
			<form id="categoryform" name="categoryform" method="post">
				<label class="category">Category Name</label><br />
				<input type="text" class="category" name="name"><br /><br />
				<label class="category">Parent Category</label><br />
				<select class="categoryselect" name="parent">
					<option value="" selected="selected"></option>
					<?php
					$sql = "SELECT * from category order by name asc";
					$result = mysql_query($sql) or die (mysql_error());
					while ($row = mysql_fetch_assoc($result)) {
						$id = $row['id'];
						$name = $row['name'];
						?>
				  <option value="<?php echo $id ?>"><?php echo $name ?></option>
						<?php
					}
					?>
				</select><br /><br />
				<input type="submit" name="addsubmit" id="addsubmit" value="Submit" />
			</form>
		</div>        
	</div>
    <?php
}
/*End add category */

/*Start insert new category */
if(isset($_POST['addsubmit'])){
	$name = $_POST['name'];
	$parent = $_POST['parent'];
	if($name != ""){
		$sql = "insert into category (name, parent) values ('$name', '$parent')";
		$insert = mysql_query($sql) or die (mysql_error());
		$id = mysql_insert_id();
		?>
		<script language="Javascript">
			window.location = "index.php?page=category/category.php&task=new";
		</script>
    	<?php
	} else {
		?>
		<script language="Javascript">
			window.location = "index.php?page=category/category.php&task=new";
		</script>
		<?php
	}
}
/*End insert new category */

/*Start edit category */
if($task == "edit"){
	$sql = "SELECT * from category where id = '$id'";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		$id = $row['id'];
		$name = $row['name'];
		$parent = $row['parent'];
	?>
    <div id="categorydiv1">
		<div id="categorydiv2">
   	    <div id="categorydiv4">Edit Spelling Only!</div><br /><br />
			<form id="categoryform" name="categoryform" method="post">
           		<input type="hidden" class="category" name="id" value="<?php echo $id ?>" />
				<label class="category">Category Name</label><br />
				<input type="text" class="category" name="name" value="<?php echo $name ?>" /><br /><br />
				<input type="submit" name="editsubmit" id="editsubmit" value="Submit" />
			</form>
		</div>        
	</div>
	<?php
	}
}
/*End edit category*/

/*Start update new category */
if(isset($_POST['editsubmit'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	if($name != ""){
		$sql = "update category set name = '$name' where id = '$id'";
		$update = mysql_query($sql) or die (mysql_error());
		?>
		<script language="Javascript">
			window.location = "index.php?page=category/category.php&task=new";
		</script>
    	<?php
	} else {
		?>
		<script language="Javascript">
			window.location = "index.php?page=category/category.php&task=new";
		</script>
		<?php
	}
}
/*End insert new category */
?>

<div id="categorydiv1">
	<div id="categorydiv3">
		<?php echo CategoryList(); ?>
	</div>
</div>