<?php
// edit this file if you want to change the configurations
include ('config.php');

$config = $config['database']['default'];

$connectDB = function() use ($config) {
  return mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);
};

$createDB = function() use ($config) {
  $connection = mysqli_connect($config['host'], $config['user'], $config['pass']);
  $query = "CREATE DATABASE IF NOT EXISTS {$config['name']};";
  $result = mysqli_query($connection, $query);
  mysqli_close($connection);
  return $result;
};
?>