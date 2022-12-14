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
      <form action="userhomepage.php"><input type="submit" value="Volver"></form>
      <!-- <button onclick="location.href='about:blank'">Cerrar sesion</button> -->
  </header>
  
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
      <article class="bright">
        <?php
          require('manager.php');
          session_start();

          if (!isConnected()) {
            header('Location: ../forms/login.html');
            die();
          }
        ?>

        <div class="paper-holder">
          <div class="paper white">
            <h1>Gracias por su compra <?php echo($_SESSION['nombre']) ?></h1>
            <p>Se le enviara un correo con los detalles de su compra</p>
          </div>
        </div>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>