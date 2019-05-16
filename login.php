<!DOCTYPE html>

<html>
<head>
	<title> administrator login </title>
		<!--[if lt IE 9 ]> 
		
		<script src="html5shiv.js"></script> 
		
		<![endif]-->
	
<link rel="stylesheet" type="text/css" href="css/login.css"/>

</head>

<bodyonLoad="document.forms.login_form.username.focus()">

<div class="loginWrap">
<div class="loginLogo"><br><br><br><br><br><br><br><br><br><br><br><strong>Attention!!  The-Q-Review administrator login only!!!</strong></div>
	<div class="loginForm">
			 <div class="login">
						  <h1>Login to The Q Review</h1>
						  <form method="post" name="login_form" action="authuser.php">
							<p><input type="text" name="username" placeholder="Username or Email"></p>
							<p><input type="password" name="password" value="" placeholder="Password"></p>
							<p class="remember_me">
							  <label>
								<input type="checkbox" name="remember_me" id="remember_me">
								Remember me on this computer
							  </label>
							</p>
							<p class="submit"><input type="submit" name="submit" value="LOGIN" class="submit"></p>
						  </form>
						</div>
						</div>

</div>

<section id="websiteUpdates">
	<article> 
		<ul><strong><h2>Most Recent Updates </h2></strong>
			<li>New Login Page for website.| 5-18-13</li>
			
		</ul>
	</article>
</section>




</body>



</html>