<?php

require('connect.php');

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];

$connection = connectDB();
$query = "INSERT INTO `usuarios` (`email`, `nombre`, `apellido`, `password`)
VALUES ('$email', '$nombre', '$apellido', $password);";

$result = mysqli_query($connection, $query);

if ($result) {
  header('Location: ../forms/proveedores.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>