<?php

require('connect.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$connection = connectDB();
$query = "INSERT INTO `categorias` (`nombre`, `descripcion`)
VALUES ('$nombre', '$descripcion');";

$result = mysqli_query($connection, $query);

if ($result) {
  header('Location: ../forms/categoria.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>