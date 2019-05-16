<center>
<?php
  //Must CHMOD to 666
  $filename = "recheck.txt";
  $text = $_POST['time'];
  $fp = fopen($filename, "w");
  if ($fp) {
      fwrite($fp, $text);
      fclose($fp);

     echo "<script language='javascript'>
alert('Time set for $text seconds')
</script>";


  } else {
      echo("Time was not set");
  }





  echo "<script>window.location='index.php'</script>";
?>
</center>