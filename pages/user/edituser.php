<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="../forms/form_style.css">
  <link rel="stylesheet" href="form-style.css">
  <script src="../../main.js" defer></script>
  <title>Clientes</title>
</head>
<body>
  <!-- Titulo principal de la pagina -->
  <header class="bright">
    <p>EL PROGRESO</p>
    <button onclick="location.href='userhomepage.php'">Volver</button>
  </header>

  <!-- Crear usuarios -->

  <div class="page">
    <!-- Barra de navegación izquierda -->
    <nav>
      <a href="../../home.html">Home</a>
      <a href="../static/products.html">Productos</a>
      <a href="../static/services">Servicios</a>
      <a href="../static/about.html">Sobre nosotros</a>
      <a href="../static/oferts">Ofertas</a>
      <a href="../static/tipos_de_cocina.html">Tipos de cocina</a>
      <a href="../static/contact">Contactanos</a>
    </nav>

    <?php
      require('manager.php');
      session_start();

      if (!isConnected()) {header('Location: ../forms/login.html');}

      $id = getUserID($_SESSION['email']);
      $userData = getAllUserData($id);
      $email = $userData['email'];
      $name = $userData['nombre'];
      $lastname = $userData['apellido'];
      $password = $userData['password'];
      $phone = $userData['telefono'];
    ?>
    <!-- En esta seccion se encuentra el contenido de la pagina -->
    <section>
      <!-- Formulario -->
      <article class="bright">
        <h1>Editar usuarios</h1>
        <div class="paper-holder">
          <form action="../scripts/userhandler.php" method="post" class="paper white">
            <table>
              <!-- row:1 -->
              <tr>
                <td>Email:</td>
                <td><input name="email" type="email" value="<?php echo("$email") ?>" disabled></td>
              </tr>
  
              <!-- row:2 -->
              <tr>
                <td>Contraseña:</td>
                <td><input name="password" type="text" value="<?php echo("$password") ?>"></td>
              </tr>
  
              <!-- row:3 -->
              <tr>
                <td>Nombre:</td>
                <td><input name="name" type="text" value="<?php echo("$name") ?>"></td>
              </tr>
  
              <!-- row:4 -->
              <tr>
                <td>Apellido:</td>
                <td><input name="lastname" type="text" value="<?php echo("$lastname") ?>"></td>
              </tr>
  
              <!-- row:5 -->
              <tr>
                <td>Telefono:</td>
                <td><input name="phone" type="tel" value="<?php echo("$phone") ?>"></td>
              </tr>
  
              <!-- row:6 -->
              <tr>
                <td colspan="2">
                  <input type="submit" value="Enviar">
                  <input type="reset" value="Empezar de nuevo">
              </td>
            </tr>
          </table>
        </form>
        </div>
      </article>
    </section>
  </div>
  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>