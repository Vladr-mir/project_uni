<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <script src="main.js" defer></script>
  <title>Template</title>
</head>
<body>
  <!-- Titulo principal de la pagina -->
  <header class="bright">
    <p>EL PROGRESO</p>
    <button onclick="location.href='about:blank'">Cerrar sesion</button>
  </header>

  <div class="page">
    <!-- Barra de navegación izquierda -->
    <nav>
      <a href="">Home</a>
      <a href="">Productos</a>
      <a href="">Servicios</a>
      <a href="">Sobre nosotros</a>
      <a href="">Ofertas</a>
      <a href="">Tipos de cocina</a>
      <a href="">Contactanos</a>
      <a href="">Menu oculto</a>
    </nav>

    <!-- En esta seccion se encuentra el contenido de la pagina -->
    <section>
      <article>
        <?php
          session_start();
          $username = $_SESSION['nombre'];
          echo ("<h1>Bienvenido: $username</h1>");
        ?>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>