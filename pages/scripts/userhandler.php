<?php
// Este archivo realiza cambios al usuario.
require('../user/manager.php');
session_start();

$id = getUserID($_SESSION['email']);
$password = $_POST['password'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$direction = $_POST['direction'];
$idCliente = getClientID($id);

$connection = $connectDB();

$query = "UPDATE `usuarios`
SET `password` = '$password' WHERE `idUsuario` = '$id';";
$response = mysqli_query($connection, $query);

$query = "UPDATE `clientes` SET `nombres` = '$name', `apellidos` = '$lastname', `direccion` = '$direction', `telefono` = '$phone' WHERE `clientes`.`idCliente` = $idCliente;";
$response = mysqli_query($connection, $query);

if ($response) {
  $_SESSION['nombre'] = $name;
}
mysqli_close($connection);

header('Location: ../user/edituser.php');
die();
?>