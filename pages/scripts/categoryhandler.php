<?php

require('connect.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$connection = connectDB();
$query = "INSERT INTO `categorias` (`idCategoria`, `nombre`, `descripcion`, `isActive`) VALUES (NULL, '$nombre', '$descripcion', b'1');";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/categoria.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>