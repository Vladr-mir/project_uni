<?php
require('connect.php');

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];

$connection = $connectDB();
$query = "INSERT INTO `clientes` (`nombres`, `apellidos`, `direccion`, `telefono`)
VALUES ('$nombre', '$apellido', '$direccion', '$telefono');";
$result = mysqli_query($connection, $query);

$last_id = mysqli_insert_id($connection);

$query = "INSERT INTO `usuarios` (`email`, `password`, `idCliente`)
VALUES ('$email', '$password', '$last_id');";
$result = mysqli_query($connection, $query);

mysqli_close($connection);

if ($result) {
  header('Location: ../forms/login.html');
} else {
  header('Location: ../error.html');
}

die();
?>