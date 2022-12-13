<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="form-style.css">
  <script src="../../main.js" defer></script>
  <title>Añadir Sucursales</title>
</head>
<body>
  <!-- Titulo principal de la pagina -->
  <header class="bright">
    <p>EL PROGRESO</p>
    <button onclick="location.href='../user/admin.php'">Volver</button>
  </header>

  <?php
    require('../user/manager.php');
    session_start();

    if (!isConnected()) {
      header('Location: login.html');
      die();
    }

    if(!isAdmin(getUserID($_SESSION['email']))) {
      header('Location: ../userhomepage.php');
      die();
    }
  ?>

  <!-- Añadir vendedores y editarlos -->

  <div class="page">
    <!-- Barra de navegación izquierda -->
    <nav>
      <a href="../../home.html">Home</a>
      <a href="../static/products.html">Productos</a>
      <a href="../static/services.html">Servicios</a>
      <a href="../static/about.html">Sobre nosotros</a>
      <a href="../static/oferts.html">Ofertas</a>
      <a href="../static/tipos_de_cocina.html">Tipos de cocina</a>
      <a href="../static/contact.html">Contactanos</a>
    </nav>

    <!-- En esta seccion se encuentra el contenido de la pagina -->
    <section>
      <!-- Formulario -->
      <form action="../scripts/sucursalhandler.php" method="POST">
        <h1>Añadir sucursales</h1>
        <table>
          <!-- row:1 -->
          <tr>
            <td>Nombre de la sucursal:</td>
            <td><input type="text" name="nombre" placeholder="Nombre"></td>
          </tr>

          <tr>
            <td>Telefono:</td>
            <td><input type="tel" name="telefono" placeholder="telefono"></td>
          </tr>

          <tr>
            <td>Direccion:</td>
            <td><input type="text" name="direccion" placeholder="Direccion"></td>
          </tr>

          <tr>
            <td>Email:</td>
            <td><input type="text" name="email" placeholder="example@email.com"></td>
          </tr>

          <!-- row:6 -->
          <tr>
            <td colspan="2">
              <input type="submit" value="Añadir">
              <input type="reset" value="Empezar de nuevo">
            </td>
          </tr>
        </table>
      </form>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>