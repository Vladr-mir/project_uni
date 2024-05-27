<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <?php
    require('connect.php');
    echo "<script>console.log('Hola mundo');</script>";
    session_start();

    if($_SESSION['email'] != null) {
      header('Location: ../user/userhomepage.php');
    } else {
      header('Location: ../forms/login.html');
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // $query = "SELECT COUNT(*) as count, idUsuario  FROM usuarios WHERE email = '$email' AND password = '$password';";
    $query = "SELECT COUNT(*) as count, clientes.nombres FROM usuarios INNER JOIN clientes ON usuarios.idCliente=clientes.idCliente WHERE usuarios.email='$email' AND usuarios.password='$password';";
    $connection = $connectDB();
    $response = mysqli_fetch_array(mysqli_query($connection, $query));
    mysqli_close($connection);
    if ($response['count'] > 0) {
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $response['nombres'];
      header("Location: ../user/userhomepage.php");
      die();
    } else {
      echo ('Datos incorrectos');
    }
  ?>
</body>
</html>