<?php
  //Must CHMOD to 666
  $filename = "email.txt";
  $text = $_POST['email'];
  $fp = fopen($filename, "w");
  if ($fp) {
      fwrite($fp, $text);
      fclose($fp);
  }
  echo "<script>window.location='index.php'</script>";
?>

