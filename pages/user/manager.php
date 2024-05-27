<?php
require('../scripts/connect.php');

function isConnected() {
  // session_start();
  return $_SESSION['email'] != null;
}

function executeQuery($query){
  $connection = $GLOBALS['connectDB']();
  $response = mysqli_fetch_array(mysqli_query($connection, $query));
  mysqli_close($connection);
  return $response;
}

function getUserID($email) {
  $query = "SELECT `idUsuario` FROM `usuarios` WHERE `email` = '$email';";
  return executeQuery($query)['idUsuario']; 
}

function getClientID($idUsuario) {
  $query = "SELECT `idCliente` FROM `usuarios` WHERE `idUsuario`=$idUsuario;";
  return executeQuery($query)['idCliente']; 
}

function getAllUserData($id){
  // $query = "SELECT `nombre`, `apellido`, `password`, `telefono`, `email` FROM `usuarios` WHERE `idUsuario` = '$id';";
  $query = "SELECT clientes.nombres, clientes.apellidos, usuarios.password, clientes.telefono, usuarios.email, clientes.direccion, usuarios.idCliente 
  FROM usuarios INNER JOIN clientes ON usuarios.idUsuario=clientes.idCliente 
  WHERE usuarios.idUsuario=$id;";
  return executeQuery($query);
}

function isAdmin($id) {
  $query = "SELECT `isAdmin` FROM `usuarios` where `idUsuario` = $id;";
  return executeQuery($query)['isAdmin'];
}

?>