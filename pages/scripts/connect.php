<?php
function connectDB() {
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "bdelprogreso";
    
    return mysqli_connect($hostname, $username, $password, $database);
  }
?>