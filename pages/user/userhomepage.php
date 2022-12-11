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
      <form action="../forms/scripts/close_session.php"><input type="submit" value="Cerrar session"></form>
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
      <article>
        <?php
          session_start();

          if ($_SESSION['nombre'] == null) {
            header('Location: ../forms/login.html');
          }

          $username = $_SESSION['nombre'];
          echo ("<h1>Bienvenido: $username</h1>");
        ?>
        
        <!-- Carta para acceder a la pagina de compra  -->
        <div class="card-holder">
          <div class="card white">
            <h1>Ir a la tienda</h1>
            <p>La tienda donde puedes comprar carnes y embutidos</p>
            <form action="store.php"><input type="submit" value="Comprar"></form>
         </div>

          <!-- Carta para ir al formulario de edicion de usuario -->
          <div class="card white">
            <h1>Editar usuario</h1>
            <p>Aqui puedes editar tu usuario</p>
            <form action="store.php"><input type="submit" value="Comprar"></form>
          </div>
        </div>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>