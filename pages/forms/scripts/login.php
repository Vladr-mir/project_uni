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
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT COUNT(*) as count, nombre FROM usuarios WHERE email = '$email' AND password = '$password';";

    $response = mysqli_fetch_array(mysqli_query($connection, $query));
    if ($response['count'] > 0) {
      $_SESSION['email'] = $email;
      $_SESSION['nombre'] = $response['nombre'];
      header("Location: ../../user/userhomepage.php");
      die();
    } else {
      echo ('Datos incorrectos');
    }
  ?>
</body>
</html>