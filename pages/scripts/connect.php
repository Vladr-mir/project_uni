<?php
$port = "";
$hostname = "localhost:{$port}";
$username = "root";
$password = "";
$database = "bdelprogreso";

function connectDB() {
  // ! edit this file when the project is not in development stage
    return mysqli_connect($hostname, $username, $password, $database);
  }

function createDB() {
  $connection = mysqli_connect($hostname, $username, $password);
  $query = "CREATE DATABASE IF NOT EXISTS $database;";
  return mysqli_query($connection, $query);
}
?>