<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (!ereg("^[A-Za-z0-9]", $_POST['username']))
          $error = "ILD";
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      require('users.php');
      if (array_key_exists($username, $users)) {
          // at this point we know the username exists
          // let's compare the submitted password to value of the array key (the right password)
          if ($password == $users[$username]) {
              // password is correct
              session_start();
              $_SESSION['loggedin'] = md5($username . $password . $salt);
              header("Location: index.php");
              exit;
          } else {
              $error = "ILD";
              //exit("<p>Invalid password.</p>");
          }
      } else {
          $error = "ILD";
      }
  }
 $myFile = "email.txt";
  $fh = fopen($myFile, 'r');
  $theData = fgets($fh);
  fclose($fh);

$Alock = "lock.txt";
  $attempts = ("attempts.txt");
  if (!file_exists($attempts)) {
      //  If attempts.txt does not exist create it
      $Handle = fopen($attempts, 'w+');
      $Data = "";
      fclose($Handle);
  }
  $ihits = file($attempts);
  if ($ihits[0] == 3) {
      include("locked.php");
      exit();
  }

  if (file_exists($Alock) && isset($_POST['username']) && $_POST['username'] !== '') {
      $ihits[0]++;
      $fh = fopen($attempts, "w+");
      fputs($fh, "$ihits[0]");
      fclose($fh);
     // echo $ihits[0];
   
     // echo "<div class='center red'>Invalid attempt $ihits[0] </div>";
      //include("locked.php");
  } else {
      // echo 'Username Not Entered<br />';
      //include("login.php");
  }
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=iso-8859-1' />
<title>Maintenance Login</title>
<style type='text/css'>
	/* CSSTidy 1.3: Fri, 06 Aug 2010 15:26:06 -0600 */body{font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:12px;}p,h1,form,button{border:0 none;margin:0;padding:0;}.spacer{clear:both;height:1px;}.myform{width:400px;margin:0 auto;padding:14px;}#maintenance_login{border:solid 2px #b7ddf2;background:#ebf4fb;}#maintenance_login h1{font-size:14px;font-weight:700;margin-bottom:8px;text-align:center;}#maintenance_login p#loginmsg{font-size:11px;color:#666;margin-bottom:20px;border-bottom:solid 1px #b7ddf2;padding-bottom:10px;text-align:center;}#maintenance_login label{display:block;font-weight:700;text-align:right;width:140px;float:left;padding:4px;}#maintenance_login input{float:left;font-size:12px;border:solid 1px #aacfe4;width:200px;margin:2px 0 20px 10px;padding:4px 2px;}#maintenance_login button{clear:both;margin-left:150px;width:125px;height:31px;background:#666 url(img/button.png) no-repeat;text-align:center;line-height:31px;color:#FFF;cursor:pointer;font-size:11px;font-weight:700;}#maintenance_login .error{color:red;}.center{text-align:center;}
</style>
</head>
<body>
<p><br/><br/><br/></p>
<div id="maintenance_login" class="myform">
<form id="form1" action="login.php" method="post">
<?php
  $formtitle = "Maintenance Mode Login";
  if ($error)
      $formtitle = "<span class=\"error\">Incorrect Login Attempt $ihits[0]</span>";
  if ($error)
      $to = $theData;
  $subject = "Invalid Login Attempt";
  $ip = getenv("REMOTE_ADDR");
  $message = "Hello! \nSomeone from $ip Just made an Invalid Login Attempt at the 'Maintenance Mode Login' page";
  $from = "noreply@daydreamingonline.com";
  $headers = "From: $from";
  mail($to, $subject, $message, $headers);
?>
<h1><?php echo $formtitle;  ?>
</h1>
<p id="loginmsg">
All invalid login attempts are emailed to the site administrator
</p>
<p id="form">
<label>Username</label>
<input type="text" name="username" id="username" size="20" />
<label>Password</label>
<input type="password" name="password" id="password" size="20" />
<button type="submit" name="login" value=" login ">Login</button>
</p>
<div class="spacer">
</div>
</form>
</div>
</body>
</html>