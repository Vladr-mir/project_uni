<?php

require('connect.php');

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$connection = $connectDB();
$query = "INSERT INTO `delivery` (`nombres`, `apellidos`) 
VALUES ('$nombres', '$apellidos')";

$result = mysqli_query($connection, $query);
mysqli_close($connection);

if ($result) {
  header('Location: ../forms/add_delivery.php');
  die();
} else {
  header('Location: ../error.html');
  die();
}
?>