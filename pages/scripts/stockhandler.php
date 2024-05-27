<?php
require('connect.php');

$id = $_POST['id'];
$stock = $_POST['stock'];
$is_active = $_POST['isActive'];

$connection = $connectDB();
$query = "UPDATE `productos`
SET `stock` = '$stock', `isActive` = '$is_active'
WHERE `idProducto` = '$id';";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/add_stock.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>