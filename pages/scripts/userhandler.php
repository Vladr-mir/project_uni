<?php
// require('connect.php');
require('../user/manager.php');
session_start();

$id = getUserID($_SESSION['email']);
$password = $_POST['password'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$query = "UPDATE `usuarios`
SET `nombre` = '$name', `apellido` = '$lastname', `password` = '$password', `telefono` = '$phone'
WHERE `idUsuario` = '$id';";

$connection = connectDB();
$response = mysqli_query($connection, $query);

if ($response) {
  $_SESSION['nombre'] = $name;
}
mysqli_close($connection);

header('Location: ../user/userhomepage.php');
die();
?>