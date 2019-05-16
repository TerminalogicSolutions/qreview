<?php
session_start();

if(isset($_SESSION['authenticated_user']))
		{
			include("admin.php");
		}
else
		{
			include("../login.php");
		}