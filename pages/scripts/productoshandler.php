<?php
require('connect.php');

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

$idCategoria = $_POST['categoria'];
$idProveedor = $_POST['proveedor'];

$connection = connectDB();
$query = "INSERT INTO `productos` (`nombre`, `precio`, `stock`, `idCategoria`, `idProveedor`)
VALUES ('$nombre', '$precio', '$stock', '$idCategoria', '$idProveedor');";

$result = mysqli_query($connection, $query);

if ($result) {
  header('Location: ../forms/productos.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}
?>