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

    if(!isAdmin(getUserID($_SESSION['email']))) {
      header('Location: userhomepage.php');
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
          <?php
            $connection = $connectDB();

            $query = "SELECT idOrden, total, formaDePago, fecha, direccion, isCompleted FROM ordenes ORDER BY fecha ASC;";

            $data = mysqli_query($connection, $query);
            mysqli_close($connection);

            while ($row = mysqli_fetch_assoc($data)) {
              $prod[] = $row;
            }
          ?>

          <?php
            if(mysqli_num_rows($data) == 0) {
              echo('<div class="paper-holder">');
              echo('<div class="paper white">');
              echo('<h1>No haz realizado ordenes aún</h1>');
            } else {
              foreach($prod as $row) {
                echo('<div class="paper-holder">');
                echo('<div class="paper white">');
                echo('<h1>Fecha: '.$row['fecha'].'</h1>');
                echo('<p>Total: '.$row['total'].'<p>');
                $msg = '<p>Estado de la orden: ';
                if ($row['isCompleted'] == '1') {
                  $msg .= 'Completada <input type="checkbox" checked="checked" onclick="return false;"/>';
                } else {
                  $msg .= 'Sin completar <input type="checkbox" onclick="return false;" style="align-self: flex-start;"/>';
                }
                echo($msg.'</p>');
                echo('<button onclick="location.href=\'editOrder.php?orderid='.$row['idOrden'].'\'">Ver orden</button>');
                echo('</div>');
                echo('</div>');
              }
            }
          ?>
      </article>
    </section>
  </div>

  <footer class="dark">Copyright © Universidad Tecnológica</footer>
</body>
</html>