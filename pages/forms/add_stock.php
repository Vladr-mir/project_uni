<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <!-- <link rel="stylesheet" href="form-style.css"> -->
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
      <article class="bright">
        <div class="card-holder">
          <?php
            $connection = connectDB();

            $query = "SELECT `idProducto`, `nombre`, `stock`, `isActive` FROM `productos`";
            $result = mysqli_query($connection, $query);
            mysqli_close($connection);

            while ($row_prod = mysqli_fetch_assoc($result)) {
              $producto[] = $row_prod;
            }

            foreach($producto as $row) {
              // echo "<option value=\"".$row['idProveedor']."\">".$row['nombre']."</option>";
              echo("<div class=\"card white\">");
              echo("<h1>".$row['nombre']."</h1>");
              echo("<p>El stock actual es de: ".$row['stock']." Unidades</p>");
              echo("<form action=\"../scripts/stockhandler.php\" method=\"POST\">");
              // $_POST['id'] = $row['idProducto'];
              echo("<input type=\"text\" name=\"id\" value=\"".$row['idProducto']."\" style=\"display: none;\">");
              echo("<input type=\"number\" name=\"stock\" value=\"".$row['stock']."\">");
              echo ("</br>");
              echo ("</br>");
              echo("Habilitado: ");
              if ($row['isActive']) {
                echo("<input type=\"checkbox\" name=\"isActive\" checked>");
              } else {
                echo("<input type=\"checkbox\" name=\"isActive\">");
              }
              echo ("</br>");
              echo ("</br>");
              echo("<input type=\"submit\" value=\"Actualizar\">");
              echo ("</form>");
              echo("</div>");
            }
          ?>
        </div>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>