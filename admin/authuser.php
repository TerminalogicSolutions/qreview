<?php 
session_start();
include('includes/config.php');

$username = $_POST['username'];
$password = $_POST['password'];
				   
$query = "SELECT recid, username, password from sys_users where username = '$username' and password = '$password'";
$result = mysql_query($query);
if($result)
	{
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$recid = $row['recid'];

		if (mysql_num_rows($result) == 0)
			{
			   echo "<h2>Sorry, your user account was not validated.</h2><br>\n";
			   echo "<a href=index.php>Try again</a><br>\n";
			   //echo "<a href=http://RoofingSurplus.com/>Return to the Roofing Surplus Home Page</a>\n\n\n$query";
			} 
		else
			{
				$date = date('Ymd');
				$query = "UPDATE sys_users SET last_login_date = '" . $date . "' where username = '$username' and password = '$password'";
				mysql_query($query);
				
				$_SESSION['authenticated_user'] = $recid;
							header("Location: index.php");
				//echo $_SESSION['authenticated_user'];
			}
	}
else
	{
		echo mysql_errno();	
	}
?>



