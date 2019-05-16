<?php
Session_Start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Q Review</title>

<link rel="stylesheet" type="text/css" href="css/main.css"/>
<link rel="stylesheet" type="text/css" href="css/review.css"/>
<link rel="stylesheet" type="text/css" href="css/recipe.css"/>
<link rel="stylesheet" type="text/css" href="css/restaurant.css"/>


<!--Menu-->
<link rel="stylesheet" type="text/css" href="css/menu.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/menu.js"></script>

<!--PrettyPhoto-->
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>


</head>
	<body>
		<div id="container">
            
            <div id="header">
            	<?php include('adverts/topbanner.php'); ?>
                <?php include('menu.php'); ?>
			</div><!--end header div-->
			
          	<div id="content">	
            
            <div id="sidebar">
                <?php include('sidebar.php'); ?>
           	</div><!--end sidebar div-->
                    
            <div id="main">
               <?php	
	                 if (!isset($_REQUEST['content']))
		                include("main.inc.php");
		             else
		             {
		                $content = $_REQUEST['content'];
		                $nextpage = $content . ".inc.php";
		                include($nextpage);
		             }
               	?>
            </div><!--end main div-->
                
            <div id="bottom"></div>
                
           	</div><!--end content div-->
		
			<div id="footer">
				<?php include('footer.php'); ?>
        	</div><!--end footer div-->    
		
    	</div> <!--end container div-->
	</body>
</html>