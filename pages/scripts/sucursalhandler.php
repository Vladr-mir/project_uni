<?php

require('connect.php');

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];

$connection = connectDB();
$query = "INSERT INTO `sucursales` (`nombre`, `telefono`, `direccion`, `email`) VALUES ('$nombre', '$telefono', '$direccion', '$email');";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/sucursal.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>