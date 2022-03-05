<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'login_sample_db';
 
  $mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );


  if(!$con = mysqli_connect($db_host,$db_user,$db_password,$db_db))
  {
  
    die("failed to connect!");
    exit();
  }
  $mysqli->close();



?>