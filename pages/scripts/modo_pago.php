<?php

require('connect.php');

$tipo = $_POST['modo'];

$connection = connectDB();
$query = "INSERT INTO `modoPagos` (`tipoPago`) VALUES ('$tipo');";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/modo_pago.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}

?>