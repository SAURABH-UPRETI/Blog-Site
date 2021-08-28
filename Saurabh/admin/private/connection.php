<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "saurabh";
  $error = "An error occured";

  $con = @mysqli_connect($host, $user, $pass, $db) or die ($error);
?>