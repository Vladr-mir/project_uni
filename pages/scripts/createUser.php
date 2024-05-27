<?php
require('connect.php');

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];

$connection = connectDB();
$query = "INSERT INTO `clientes` (`nombres`, `apellidos`, `direccion`, `telefono`);
VALUES ('$nombre', '$apellido', '$direccion', '$password');";
$result = mysqli_query($connection, $query);

$query = "INSERT INTO `usuarios` (`email`, `password`);
VALUES ('$email', '$password');";
$result = mysqli_query($connection, $query);

mysqli_close($connection);

if ($result) {
  header('Location: ../forms/proveedores.php');
} else {
  header('Location: ../error.html');
}

die();
?>