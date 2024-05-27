<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="form-style.css">
  <script src="../../main.js" defer></script>
  <title>productos</title>
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

  <!-- Añadir productos -->

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
      <form action="../scripts/productoshandler.php" method="POST">
        <h1>Productos</h1>
        <table>
          <!-- row:1 -->
          <tr>
            <td>Nombre del producto:</td>
            <td><input name="nombre" type="text" placeholder="Producto"></td>
          </tr>

          <!-- row:2 -->
          <tr>
            <td>Precio:</td>
            <td><input name="precio" type="text" placeholder="Precio"></td>
          </tr>

          <!-- row:3 -->
          <tr>
            <td>Stock:</td>
            <td><input name="stock" type="number" placeholder="1"></td>
          </tr>

          <!-- row:4 -->
          <tr>
            <td>Categoria:</td>
            <td>
              <select name="categoria">
                <?php
                  $connection = $connectDB();

                  $query = "SELECT `idCategoria`, `nombre` FROM `categorias`";
                  $result = mysqli_query($connection, $query);
                  mysqli_close($connection);

                  while ($row_cat = mysqli_fetch_assoc($result)) {
                    $category[] = $row_cat;
                  }

                  foreach($category as $row) {
                    echo "<option value=\"".$row['idCategoria']."\">".$row['nombre']."</option>";
                  }
                ?>
              </select>
            </td>
          </tr>

          <!-- row:5 -->
          <tr>
            <td>Proveedor:</td>
            <td>
              <select name="proveedor">
                <?php
                  $connection = $connectDB();

                  $query = "SELECT `idProveedor`, `nombre` FROM `proveedores`";
                  $result = mysqli_query($connection, $query);
                  mysqli_close($connection);

                  while ($row_prov = mysqli_fetch_assoc($result)) {
                    $proveedor[] = $row_prov;
                  }

                  foreach($proveedor as $row) {
                    echo "<option value=\"".$row['idProveedor']."\">".$row['nombre']."</option>";
                  }
                ?>
              </select>
            </td>
          </tr>

          <tr>
            <td>Medida:</td>
            <td>
              <select name="unidad">
                <?php
                  $connection = $connectDB();

                  $query = "SELECT `idUnidad`, `nombre` FROM `unidades`";
                  $result = mysqli_query($connection, $query);
                  mysqli_close($connection);

                  while ($row_unid = mysqli_fetch_assoc($result)) {
                    $unidad[] = $row_unid;
                  }

                  foreach($unidad as $row) {
                    echo "<option value=\"".$row['idUnidad']."\">".$row['nombre']."</option>";
                  }
                ?>
              </select>
            </td>
          </tr>


          <!-- row:6 -->
          <tr>
            <td colspan="2">
              <input type="submit" value="Agregar">
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
