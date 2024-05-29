<?php

require('connect.php');
session_start();

$delivery = $_POST['delivery'];
$orderid = $_POST['orderid'];

$connection = $connectDB();
$query = "UPDATE ordenes SET isCompleted=b'1', idDelivery='$delivery' where idOrden='$orderid';";
$result = mysqli_query($connection, $query);

// $query = "SELECT * FROM `ordenes` WHERE idOrden='$orderid';";
// $data = mysqli_fetch_array(mysqli_query($connection, $query));

// $query = "INSERT INTO `facturas` (`fecha`, `total`, `direccion`, `idUsuario`, `idOrden`, `idModoPago`) 
// VALUES ('".$data['fecha']."', '".$data['total']."', ".$data['direccion']."', '".$data['idUsuario']."', '$orderid' , '".$data['idModoPago']."')";
// $result = mysqli_query($connection, $query);

mysqli_close($connection);

if ($result) {
  header("Location: ../user/editOrder.php?orderid=$orderid");
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>