<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <script src="main.js" defer></script>
    <title>Perfil</title>
  </head>
  <body>
    <!-- Titulo principal de la pagina -->
    <header class="bright">
      <p>EL PROGRESO</p>
      <form action="./userhomepage.php"><input type="submit" value="Volver"></form>
      <!-- <button onclick="location.href='about:blank'">Cerrar sesion</button> -->
  </header>
  
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

    <!-- En esta seccion se encuentra el contenido de la pagina -->
    <section>
      <article class="bright">
        <?php
          require('manager.php');
          session_start();

          if (!isConnected()) {
            header('Location: ../forms/login.html');
            die();
          }

          if(!isAdmin(getUserID($_SESSION['email']))) {
            header('Location: userhomepage.php');
            die();
          }

          $username = $_SESSION['nombre'];
          echo ("<h1>Pagina de administrador de: $username</h1>");
        ?>
        
        <!-- Carta para acceder a la pagina de compra  -->
        <div class="card-holder">
          <div class="card white">
            <h1>Añadir categoria</h1>
            <p>En esta seccion podrá añadir categorías</p>
            <form action="../forms/categoria.php"><input type="submit" value="Añadir"></form>
         </div>

          <!-- Carta para ir al formulario de edicion de usuario -->
          <div class="card white">
            <h1>Añadir Proveedores</h1>
            <p>Aqui puedes editar los datos de tu usuario</p>
            <form action="edituser.php"><input type="submit" value="Editar"></form>
          </div>
        </div>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>