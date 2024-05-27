<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <script src="../../main.js" defer></script>
  <title>Tienda</title>
</head>
<body>
  <!-- Titulo principal de la pagina -->
  <header class="bright">
    <p>EL PROGRESO</p>
    <button onclick="location.href='userhomepage.php'">Volver</button>
  </header>

  <?php
    require('../user/manager.php');
    session_start();

    if (!isConnected()) {
      header('Location: ../forms/login.html');
      die();
    }

    $userId = getUserID($_SESSION['email']);
  ?>

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
        <form action="../scripts/storehandler.php" method="post">
          <div class="card-holder">
            <div class="card" style="background-color: #d0f19a;">
              <h1>Datos de la compra</h1>
              Elegir sucursal:
              <select name="sucursal">
                <?php
                  $connection = $connectDB();

                  $query = "SELECT `idSucursal`, `nombre` FROM `sucursales`";
                  $result = mysqli_query($connection, $query);
                  mysqli_close($connection);

                  while ($row_suc = mysqli_fetch_assoc($result)) {
                    $sucursal[] = $row_suc;
                  }

                  foreach($sucursal as $row) {
                    echo "<option value=\"".$row['idSucursal']."\">".$row['nombre']."</option>";
                  }
                ?>
              </select>

              Elegir metodo de pago:
              <select name="modoPago">
                <?php
                  $connection = $connectDB();

                  $query = "SELECT `idModo`, `tipoPago` FROM `modoPagos`";
                  $result = mysqli_query($connection, $query);
                  mysqli_close($connection);

                  while ($row_pago = mysqli_fetch_assoc($result)) {
                    $pago[] = $row_pago;
                  }

                  foreach($pago as $row) {
                    echo "<option value=\"".$row['idModo']."\">".$row['tipoPago']."</option>";
                  }
                ?>
              </select>
              <br>
              <br>
              <br>
              <input type="submit" value="Comprar">
            </div>

            <?php
              $connection = $connectDB();
              $data = [];
  
              $query = "SELECT productos.idProducto, productos.nombre, productos.stock, productos.isActive, productos.precio, unidades.Nombre as medida 
              FROM productos INNER JOIN unidades 
              ON productos.idUnidad=unidades.idUnidad WHERE isActive=1;";

              $result = mysqli_query($connection, $query);
              mysqli_close($connection);
  
              while ($row_prod = mysqli_fetch_assoc($result)) {
                $producto[] = $row_prod;
              }
  
              foreach($producto as $row) {
                array_push($data, $row['idProducto']);
                echo("<div class=\"card white\">");
                echo("<h1>".$row['nombre']."</h1>");
                echo("<p>Disponibles: ".$row['stock']." ".$row['medida']."</p>");
                echo("<p>Precio: ".$row['precio']."$</p>");
                echo("<input type=\"hidden\" name=\"id".$row['idProducto']."\" value=\"".$row['idProducto']."\">");
                echo("<input type=\"hidden\" name=\"price".$row['idProducto']."\" value=\"".$row['precio']."\">");
                echo("<input type=\"hidden\" name=\"stock".$row['idProducto']."\" value=\"".$row['stock']."\">");
                echo("<input type=\"number\" name=\"cuantity".$row['idProducto']."\" value=\"0\" min=\"0\" max=\"".$row['stock']."\">");
                echo("</div>");
              }

              echo '<input type="hidden" name="productsid" value="'.htmlspecialchars(json_encode($data)).'">';
              echo '<input type="hidden" name="userId" value="'.$userId.'">';
            ?>
          </div>
        </form>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>