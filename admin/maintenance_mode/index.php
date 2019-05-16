<?php
  // Updated Fri, 10 Dec 2010 10:15:34 GMT
  //  Check user is logged in if not take them to login page
  require('check.php');
  //  Path to Root Directory e.g. (/home/xxxxxxx/public_html + /)    
  $root = getenv("DOCUMENT_ROOT") . "/theqreview/";
  //  Name of maintenance file
  $mafilen = "maintenance.php";
  //  Name of .htaccess file
  $htfilen = ".htaccess";
  //  Extension to add to end of above two files when needed
  $ext = ".bak";
  //  Path + maintenance file e.g. (/home/xxxxxxx/public_html/maintenance.php)  
  $mafilep = $root . $mafilen;
  //  Path + maintenance file + extension e.g. (/home/xxxxxxx/public_html/maintenance.php.bak)
  $mafilebp = $root . $mafilen . $ext;
  //  Path + .htaccess file e.g. (/home/xxxxxxx/public_html/.htaccess)  
  $htfilep = $root . $htfilen;
  //  Path + .htaccess file + extension e.g. (/home/xxxxxxx/public_html/.htaccess.bak)
  $htfilebp = $root . $htfilen . $ext;
  //  Message to show when enabled  
  $enablem = "Maintenance mode is ON!";
  //  Message to show when disabled
  $disablem = "Maintenance mode is OFF!";
  $testm = "Test mode is ON!";
  $test = "test.php";
  $enable = "enable.php";
  $disable = "disable.php";
  $htfilebt = $root . $htfilen . ".test";
  //  Name of lock file
  $Alock = "lock.txt";
  
  
  if (!file_exists($mafilep) && !file_exists($mafilebp))
    {
      //  If maintenance.php does not exist and maintenance.php.bak does not exist stop the script dead and show error message
      die(" Neither " . $mafilen . " or " . $mafilen . $ext . " were found in " . $root . " One of them must exist for Maintenance Mode to work Please correct this issue and try again. ");
      //  The . is used to join strings together
    }
  if (!file_exists($htfilep))
    {
      //  If .htaccess does not exist create it
      $File = $htfilep;
      $Handle = fopen($File, 'w');
      $Data = "";
      fclose($Handle);
    }
switch($_GET['cmd']) {

 // switch ($cmd)	{

      case 'Enable':
          $File = $enable;
          $Handle = fopen($File, 'w');
          $Data = "Test Mode";
          fwrite($Handle, $Data);
          fclose($Handle);
          if (file_exists($enable))
            {
              //print("Enable created");
            }
          if (file_exists($disable))
            {
              unlink($disable);
            }
          if (file_exists($test))
            {
              (unlink($test));
              (unlink($htfilep));
              //print("<br />");
              //print("Test deleted");
            }
          if (file_exists($mafilebp) && file_exists($htfilep))
            {
              rename("$mafilebp", "$mafilep");
              rename("$htfilep", "$htfilebp");
              //print("Job Done");
            }
          $ip = getenv("REMOTE_ADDR");
          $File = $htfilep;
          $Handle = fopen($File, 'w');
          $Data = "ErrorDocument 503 /maintenance.php\n";
          fwrite($Handle, $Data);
          $Data = "RewriteEngine On\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REMOTE_ADDR} !" . $ip . "\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REQUEST_URI} !^/maintenance_mode/\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REQUEST_URI} !^/maintenance\.php$\n";
          fwrite($Handle, $Data);
          $Data = "RewriteRule ^(.*)$ /maintenance.php [L,R=503]\n";
          fwrite($Handle, $Data);
          fclose($Handle);
          break;
      case 'Disable':
          $File = $disable;
          $Handle = fopen($File, 'w');
          $Data = "Test Mode";
          fwrite($Handle, $Data);
          fclose($Handle);
          if (file_exists($test))
            {
              unlink($test);
              rename("$htfilebp", "$htfilep");
              //print("Test created");
            }
          if (file_exists($mafilep))
            {
              rename("$mafilep", "$mafilebp");
            }
          if (file_exists($enable))
            {
              unlink($enable);
              rename("$htfilebp", "$htfilep");
            }
          break;
      case 'Test':
          if (file_exists($enable))
            {
              unlink($enable);
              unlink($htfilep);
              copy($htfilebp, $htfilep);
            }
          if (file_exists($disable))
            {
              unlink($disable);
              rename("$mafilebp", "$mafilep");
              copy($htfilep, $htfilebp);
            }
          $File = $test;
          $Handle = fopen($File, 'w');
          $Data = "Test Mode";
          fwrite($Handle, $Data);
          fclose($Handle);
          $ip = getenv("REMOTE_ADDR");
          $File = $htfilep;
          $Handle = fopen($File, 'a');
          $Data = "ErrorDocument 503 /maintenance.php\n";
          fwrite($Handle, $Data);
          $Data = "RewriteEngine On\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REMOTE_ADDR} " . $ip . "\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REQUEST_URI} !^/maintenance_mode/\n";
          fwrite($Handle, $Data);
          $Data = "RewriteCond %{REQUEST_URI} !^/maintenance\.php$\n";
          fwrite($Handle, $Data);
          $Data = "RewriteRule ^(.*)$ /maintenance.php [L,R=503]\n";
          fwrite($Handle, $Data);
          fclose($Handle);
          break;
      case 'AlockOn':
          if (!file_exists($Alock))
            {
              //  If lock.txt does not exist create it
              $File = $Alock;
              $Handle = fopen($File, 'w');
              $Data = "";
              fclose($Handle);
            }
          break;
      case 'AlockOff':
          if (file_exists($Alock))
            {
              //  If lock.txt exists delete it
              unlink($Alock);
            }
          break;
    }
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=iso-8859-1' />
<title>Maintenance Mode</title>
<style type='text/css'>
/*<![CDATA[*/
/* CSSTidy 1.3: Fri, 31 Dec 2010 06:38:11 -0700 */
body {
	font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	background-image: url(/images/login_div_background.png);
}
p,h1,form,button {
	border:0 none;
	margin:0;
	padding:0;
}
.spacer {
	clear:both;
	height:1px;
}
.myform{
	width:450px;
	margin:0 auto;
	padding:14px;
	
	
}
#maintenance_login{
	position:absolute;
	left:50%;
	top:50%;
	margin-top: -175px;
	margin-right: 0;
	margin-bottom: 0;
	margin-left: -250px;
	background-color: #666666;
}
#maintenance_login h1{
	font-size:14px;
	font-weight:700;
	margin-bottom:8px;
	text-align:center;
}
#maintenance_login p#loginmsg{
	font-size:11px;
	color:#666;
	margin-bottom:20px;
	border-bottom:solid 1px #b7ddf2;
	padding-bottom:10px;
	text-align:center;
}
#maintenance_login label{
	display:block;
	font-weight:700;
	text-align:right;
	width:140px;
	float:left;
	padding:4px;
}
#maintenance_login inpu{
	float:left;
	font-size:12px;
	border:solid 1px #aacfe4;
	width:200px;
	margin:2px 0 20px 10px;
	padding:4px 2px;
}
#maintenance_login button{
	clear:both;
	margin-left:150px;
	width:125px;
	height:31px;
	background:#666 url(img/button.png) no-repeat;
	text-align:center;
	line-height:31px;
	color:#FFF;
	cursor:pointer;
	font-size:11px;
	font-weight:700;
}
#maintenance_login .error{
	color:red;
}
#maintenance_login .file{
	float:left;
	padding-left:100px;
}
#maintenance_login .exists{
	float:right;
	padding-right:100px;
}
#formCont{
	width:140px;
	border:none;
	text-align:center;
	margin:auto;
}
.left{
	float:left;
}
.right{
	text-align:right;
}
.center{
	text-align:center;
}
#helpF,#maintF,#timeF,#emailF,#Md5,#buttons{
	display:none;
}
#layer2{
	background:#fff;
	height:300px;
	width:375px;
	overflow:auto;
	text-align:center;
	display:none;
	white-space:nowrap;
	border:solid 1px #adadad;
	margin:auto;
}
.edit{
	height:300px;
	width:375px;
	overflow:auto;
	white-space:nowrap;
}
#helpt{
	border:solid 1px #adadad;
	text-align:center;
}
/*]]>*/
</style>
</head>
<body>
<div id='maintenance_login' class='myform'>
<h1>Maintenance Mode Panel</h1>
<fieldset>
<div id="formCont">
<!--<p class="left">-->
<!--Test:-->
<!--</p>-->
<!--<p class="right">-->
<a href="index.php?cmd=Test">
<input type="button" name="notify2" value="Test Maintenance On" <?php if (file_exists($test)) {echo 'checked="checked"';}?> />
</a>
<br /><br />
<!--</p>-->
<!--<p class="left">-->
<!--Enable:-->
<!--</p> -->
<!--<p class="right"> -->
<a href="index.php?cmd=Enable">
<input type="button" name="notify" value="Turn Maintenance On" <?php if (file_exists($enable)) {echo 'checked="checked"';}?> />
</a>
<br /><br />
<!--</p> -->
<!--<p class="left"> -->
<!--Disable:-->
<!--</p> -->
<!--<p class="right"> -->
<a href="index.php?cmd=Disable">
<input type="button" name="notify" value="Turn Maintenance Off" <?php if (file_exists($disable)) {echo 'checked="checked"';}?> />
</a>
<br />
<!--</p> -->
</div>
<p class="center">
<input type="text" name="site_title" maxlength="100" size="50"  style="text-align:center;<?php if (file_exists($enable) OR file_exists($test)) echo "color: red;"; else echo "color: green;";?>" value="
<?php
  if (file_exists($enable)) {
      echo $enablem;
  } elseif (file_exists($test))
      echo $testm;
  else {
      if (file_exists($disable))
          echo $disablem;
  }
?>
" readonly="readonly" />
<br />
<br />
</p>
<div id="controlP">
<p class="center">
<input type="button" onClick="toggleItem('buttons',this.id);" value="Show Control Panel" id="bt1" />
</p>
<div id="buttons">
<div class="center">
<input type="button" value="Maintenance.php" onClick="maintB()" />
<input type="button" value="Set Time" onClick="timeB()" />
<input type="button" value="Security" onClick="emailB()" />
<input type="button" value="Md5" onClick="Md5()" />
<input type="button" value="Help" onClick="HelpBf()" />
</div>
</div>
<div id="cont">
</div>
<div id="timeF">
<div class="center">

<script type="text/javascript">
//<![CDATA[
function convertText() {
  document.getElementById("time").value = document.getElementById("pu").value;
}
function validate() {
  timeB = document.getElementById("time");
  if (timeB.value == "") {
    alert("You must select or enter a time!")
    return false
  } else
  return true
}
//]]>
</script>

<form id="timeC" method="post" action="time.php" onSubmit="return validate()">
<p><br />
Number in seconds robots should wait before trying site again: <br /><select onChange="convertText()" id="pu">
<option value="" selected="selected">Please Select...</option>
<option value="300">5 mins</option>
<option value="600">10 mins</option>
<option value="900">15 mins</option>
<option value="1200">20 mins</option>
<option value="1500">25 mins</option>
<option value="1800">30 mins</option>
<option value="2100">35 mins</option>
<option value="2400">40 mins</option>
<option value="2700">45 mins</option>
<option value="3000">50 mins</option>
<option value="3300">55 mins</option>
<option value="3600">1 Hour</option>
<option value="5400">1.5 Hours</option>
<option value="7200">2 Hours</option>
<option value="9000">2.5 Hours</option>
<option value="10800">3 Hours</option>
<option value="12600">3.5 Hours</option>
<option value="14400">4 Hours</option>
<option value="16200">4.5 Hours</option>
<option value="18000">5 Hours</option>
<option value="19800">5.5 Hours</option>
<option value="21600">6 Hours</option>
<option value="23400">6.5 Hours</option>
<option value="25200">7 Hours</option>
<option value="27000">7.5 Hours</option>
<option value="28800">8 Hours</option>
<option value="30600">8.5 Hours</option>
<option value="32400">9 Hours</option>
<option value="34200">9.5 Hours</option>
<option value="36000">10 Hours</option>
<option value="37800">10.5 Hours</option>
<option value="39600">11 Hours</option>
<option value="41400">11.5 Hours</option>
<option value="43200">12 Hours</option>
<option value="45000">12.5 Hours</option>
<option value="46800">13 Hours</option>
<option value="48600">13.5 Hours</option>
<option value="50400">14 Hours</option>
<option value="52200">14.5 Hours</option>
<option value="54000">15 Hours</option>
<option value="55800">15.5 Hours</option>
<option value="57600">16 Hours</option>
<option value="59400">16.5 Hours</option>
<option value="61200">17 Hours</option>
<option value="63000">17.5 Hours</option>
<option value="64800">18 Hours</option>
<option value="66600">18.5 Hours</option>
<option value="68400">19 Hours</option>
<option value="70200">19.5 Hours</option>
<option value="72000">20 Hours</option>
<option value="73800">20.5 Hours</option>
<option value="75600">21 Hours</option>
<option value="77400">21.5 Hours</option>
<option value="79200">22 Hours</option>
<option value="81000">22.5 Hours</option>
<option value="82800">23 Hours</option>
<option value="84600">23.5 Hours</option>
<option value="86400">1 Day</option>
<option value="172800">2 Days</option>
<option value="259200">3 Days</option>
<option value="345600">4 Days</option>
<option value="432000">5 Days</option>
<option value="518400">6 Days</option>
<option value="604800">1 Week</option>
</select>
<input name="time" id="time" value="<?php include("recheck.txt"); ?>" size="7" type="text" /><input value="Set Time" type="submit" /></p></form>
</div>
</div>
<div id="emailF">
<div class="center">
<script type="text/javascript">
//<![CDATA[
function validateE() {
  emailB = document.getElementById("email");
  if (emailB.value == "") {
    alert("You did not enter an email address so no Alerts will be sent!")
    return false
  } else
  alert('Alerts will be sent too ' + emailB.value + '');
  return true
}
//]]>
</script>
<br /><p>Auto lock the login screen after 3 invalid Attempts</p>Yes
<a href="index.php?cmd=AlockOn">
<input type="radio" name="notifyL" value="1" style="border:none" <?php if (file_exists($Alock)) {echo 'checked="checked"';}?> />
</a>
No
<a href="index.php?cmd=AlockOff">
<input type="radio" name="notifyL" value="1" style="border:none" <?php if (!file_exists($Alock)) {echo 'checked="checked"';}?> />
</a>
<form method="post" action="email.php" onSubmit="return validateE()">
<p><br />
Enter your email to be alerted of failed login attempts:
<br />
<input name="email" id="email" type="text" value="<?php include("email.txt"); ?>" size="20" />
<input type="submit" value="Set Email" />
</p>
</form>
</div>
</div>
<div id="maintF">
<script type="text/javascript">
//<![CDATA[
function swapLayers() {
  if (document.getElementById("layer1").style.display == "none") {
    document.getElementById("layer1").style.display = "block";
    document.getElementById("layer2").style.display = "none";
    document.getElementById("bt2").innerHTML = "Preview";
  } else {
    document.getElementById("layer1").style.display = "none";
    document.getElementById("layer2").style.display = "block";
    document.getElementById("bt2").innerHTML = "&lt; View Source &gt;";
  }
}
//]]>
</script>
<br />
<button type="button" onClick="swapLayers();" id="bt2">Preview</button>
<br /><br />
<div class="center">
<div id="layer1">
<form method="post" action="index.php?action=edit">
<p>
<textarea cols="40" rows="20" name="edit" class="edit">
<?php
  if (file_exists($mafilep)) {
      $file = $mafilep;
  } elseif (file_exists($mafilebp))
      $file = $mafilebp;
  $fh = fopen($file, 'r');
  $theData = fread($fh, filesize($file));
  echo $theData;
  fclose($fh);
?>
</textarea>
<br />
<br />
<input type="submit" value="Update file" />
</p>
</form>
<?php
  if ($_GET['action'] == 'edit') {
      $fh = fopen($file, 'w') or die("can't open file");
      $stringData = $_POST['edit'];
      fwrite($fh, stripslashes($stringData));
      fclose($fh);
      echo "<script>window.location='index.php'</script>";
  }
?>
</div>
<div id="layer2">
<?php
  if (file_exists($mafilep)) {
      $file = $mafilep;
  } elseif (file_exists($mafilebp))
      $file = $mafilebp;
  $fh = fopen($file, 'r');
  $theData = fread($fh, filesize($file));
  echo $theData;
  fclose($fh);
?>
</div>
</div>
</div>

<div id="Md5">
<div class="center">
<?php
  import_request_variables('P');
  if ($pw) {
      $md = strtoupper(md5($pw));
      echo "<script type='text/javascript'>prompt('The encrypted version of  \'$pw\'  is:',  '$md')</script>";
  }
?>
<br />
<form id="pw" method="post" action="#"><p>
Enter a password to encrypt:<br />
<input type="text" name="pw" />
<br />
<input type="submit" value="Submit" /></p>
</form>
</div>
</div>
<div id="helpF">

<br />
<div id="helpt">
<p class="center">
<?php
  $hfile = "help.txt";
  $fh = fopen($hfile, 'r');
  $theData = fread($fh, filesize($hfile));
  echo $theData;
  fclose($fh);
?>
</p>
</div>

<!-- Subscribe Start --><br />
<div id="subscribe" class="center">
<form method="post" action="http://ymlp.com/subscribe.php?id=geyquemgmgj" target="_blank">
<fieldset id="fieldset2"><legend class="center">Subscribe to our
updates</legend>
<p class="center">Fill out your e-mail address to subscribe to our
updates</p>
<p class="center">E-mail address:<input name="YMP0" size="20" type="text" /><br />
<input name="action" value="subscribe" checked="checked" type="radio" />Subscribe
<input name="action" value="unsubscribe" type="radio" />Unsubscribe</p>
<p class="center"><input value="Submit" type="submit" /></p>
</fieldset>
</form>
</div>
<!-- Subscribe End -->

</div>
</div>
</fieldset>
<p class="center">
<br />
<a href="logout.php">Logout</a>
| <a href="http://thepfwebhosting.com/index.php">Site</a>
| <a href="http://thepfwebhosting.com/login.php">Site Login</a>
<br />
</p>
</div>

<script type="text/javascript">
//<![CDATA[
function HelpBf(){
var help=document.getElementById("helpF")
var cont=document.getElementById("cont")
cont.innerHTML=help.innerHTML}
function maintB(){
var maint=document.getElementById("maintF")
var cont=document.getElementById("cont")
cont.innerHTML=maint.innerHTML}
function timeB(){
var cont=document.getElementById("cont")
var time=document.getElementById("timeF")
cont.innerHTML=time.innerHTML}
function emailB(){
var cont=document.getElementById("cont")
var email=document.getElementById("emailF")
cont.innerHTML=email.innerHTML}
function Md5(){
var cont=document.getElementById("cont")
var Md5=document.getElementById("Md5")
cont.innerHTML=Md5.innerHTML}
function toggleItem(a,b){
itm=document.getElementById(a)
itm1=document.getElementById(b)
var cont=document.getElementById("cont")
if(!itm){
return false}
if(itm.style.display=="block"){
itm.style.display="none"
cont.style.display="none"
itm1.value="Show Control Panel"}
else{
itm.style.display="block"
cont.style.display="block"
itm1.value="Hide Control Panel"}
return false}
//]]>
</script>
</body>
</html>
