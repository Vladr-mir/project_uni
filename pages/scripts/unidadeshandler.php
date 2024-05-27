<?php

require('connect.php');

$unidad = $_POST['unidad'];
$descripcion = $_POST['descripcion'];

$connection = $connectDB();
$query = "INSERT INTO `unidades` (`Nombre`, `Descripcion`) 
VALUES ('$unidad', '$descripcion')";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/tipo_unidades.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>