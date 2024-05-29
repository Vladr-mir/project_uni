<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <script src="../../main.js" defer></script>
  <title>Orden</title>
</head>
<body>
  <!-- Titulo principal de la pagina -->
  <header class="bright">
    <p>EL PROGRESO</p>
    <button onclick="location.href='userhomepage.php'">Volver</button>
  </header>

  <?php
    require('manager.php');
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
          <div class="paper-holder">
            <div class="paper white">
              <h1>Datos de la compra</h1>
              <?php
                $connection = $connectDB();

                $query = "SELECT ordenes.total, ordenes.formaDePago, ordenes.fecha, ordenes.Hora, ordenes.isCompleted, detalleordenes.idOrden, detalleordenes.idProducto, productos.nombre, detalleordenes.cantidad, detalleordenes.precio, unidades.Nombre as unidades, modoPagos.tipoPago
                FROM ((((ordenes 
                INNER JOIN detalleordenes ON ordenes.idOrden=detalleordenes.idOrden ) 
                INNER JOIN productos ON productos.idProducto=detalleordenes.idProducto) 
                INNER JOIN unidades ON unidades.idUnidad=productos.idUnidad) 
                INNER JOIN modoPagos ON modoPagos.idModo=ordenes.formaDePago)
                WHERE ordenes.idOrden=".$_GET['orderid'].";";

                $data = mysqli_query($connection, $query);
                mysqli_close($connection);

                while ($row = mysqli_fetch_assoc($data)) {
                    $prod[] = $row;
                }

                echo("<p>Total: ".$prod[0]['total']." $</p>");
                echo("<p>Fecha: ".$prod[0]['fecha']."</p>");
                echo("<p>Forma de pago: ".$prod[0]['tipoPago']."</p>");
                $msg = '<p>Estado de la orden: ';
                if ($prod[0]['isCompleted'] == '1') {
                  $msg .= 'Completada <input checked="checked" type="checkbox" onclick="return false;"/>';
                } else {
                  $msg .= 'Sin completar <input type="checkbox" onclick="return false;" style="align-self: flex-start;"/>';
                }
                echo($msg.'</p>');
              ?>
              <br>
              <br>
              <!-- <input type="submit" value="Volver"> -->
              <button onclick="location.href='listOrders.php'">Volver al listado de ordenes</button>
            </div>
          </div>
          
          <div class="paper-holder">
            <?php
              foreach($prod as $row) {
                echo("<div class=\"paper white\">");
                echo("<h1>".$row['nombre']."</h1>");
                echo("<p>Precio: ".$row['precio']."</p>");
                echo("<p>Cantidad: ".$row['cantidad']." ".$row['unidades']."</p>");
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