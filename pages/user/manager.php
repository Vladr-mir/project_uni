<?php
require('../scripts/connect.php');

function isConnected() {
  return $_SESSION['nombre'] != null;
}

function executeQuery($query){
  $connection = connectDB();
  $response = mysqli_fetch_array(mysqli_query($connection, $query));
  mysqli_close($connection);
  return $response;
}

function getUserID($email) {
  $query = "SELECT `idUsuario` FROM `usuarios` WHERE `email` = '$email';";
  return executeQuery($query)['idUsuario']; 
}

function getAllUserData($id){
  $query = "SELECT `nombre`, `apellido`, `password`, `telefono`, `email` FROM `usuarios` WHERE `idUsuario` = '$id';";
  return executeQuery($query);
}

function isAdmin($id) {
  $query = "SELECT `isAdmin` FROM `usuarios` where `idUsuario` = $id;";
  return executeQuery($query)['isAdmin'];
}

?>