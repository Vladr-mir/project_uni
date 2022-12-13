<?php

require('connect.php');

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$connection = connectDB();
$query = "INSERT INTO `proveedores` (`nombre`, `telefono`, `email`)
VALUES ('$nombre', '$telefono', '$email');";

$result = mysqli_query($connection, $query);

if ($result) {
  header('Location: ../forms/proveedores.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>