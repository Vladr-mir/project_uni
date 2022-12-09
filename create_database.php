<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
 <?php
    // Connect to database
    $hostname = "localhost";
    $username = "root";
    $database = "bdelprogreso";
    $tables = 0;
    $relationships = 0;

    $connection = mysqli_connect($hostname, $username, "");

    // Create database
    $query = "CREATE DATABASE IF NOT EXISTS $database;";
    $response = mysqli_query($connection, $query);
    mysqli_select_db($connection, $database);

    // Create tables
    $query = "CREATE TABLE `usuarios` (
      `idUsuario` INT AUTO_INCREMENT PRIMARY KEY,
      `username` VARCHAR(70) NOT NULL,
      `email` VARCHAR(100) NOT NULL,
      `password` VARCHAR(255) NOT NULL,
      `nombre` VARCHAR(70) NOT NULL,
      `apellido` VARCHAR(100) NOT NULL,
      `telefono` VARCHAR(8) NOT NULL,
      `isActive` BIT default 1,
      `isAdmin` BIT default 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `proveedores` (
     `idProveedor` INT AUTO_INCREMENT PRIMARY KEY,
      `nombre` VARCHAR(200) NOT NULL,
      `telefono` VARCHAR(8) NOT NULL,
      `email` VARCHAR(100) NOT NULL,
      `isActive` BIT default 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `vendedores` (
      `idVendedor` INT AUTO_INCREMENT PRIMARY KEY,
      `nombre` VARCHAR(70) NOT NULL,
      `apellido` VARCHAR(100) NOT NULL,
      `telefono` VARCHAR(8) NOT NULL,
      `email` VARCHAR(100) NOT NULL,
      `isActive` BIT default 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `modoPagos`(
      `idModo` INT AUTO_INCREMENT PRIMARY KEY,
      `tipoPago` VARCHAR(25) NOT NULL,
      `isActive` BIT default 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

   $query = "CREATE TABLE `categorias`(
      `idCategoria` INT AUTO_INCREMENT PRIMARY KEY,
      `nombre` VARCHAR(200) NOT NULL,
      `descripcion` VARCHAR(200) NOT NULL,
      `isActive` BIT default 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

   $query = "CREATE TABLE `productos`(
      `idProducto` INT AUTO_INCREMENT PRIMARY KEY,
      `nombre` VARCHAR(200) NOT NULL,
      `precio` DECIMAL(10,2) NOT NULL,
      `stock` INT NOT NULL,
      `isActive` BIT default 1,

      `idCategoria` INT NOT NULL,
      `idProveedor` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `ordenes`(
      `idOrden` INT NOT NULL,
      `numeroProducto` INT NOT NULL,

      `idProducto` INT NOT NULL,
      PRIMARY KEY(idOrden, numeroProducto)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `detalleFacturas`(
      `idDetalleFactura` INT PRIMARY KEY,

      `idVendedor` INT NOT NULL,
      `idModo` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `facturas` (
      `numFactura` INT AUTO_INCREMENT PRIMARY KEY,
      `fecha` DATE NOT NULL,
      `precio` DECIMAL(10, 2) NOT NULL,

      `idDetalleFactura` INT NOT NULL,
      `idUsuario` INT NOT NULL,
      `idOrden` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $tables += mysqli_query($connection, $query);

    // Add double primary keys to orden
    // $query = "ALTER TABLE `ordenes`
    //   ADD PRIMARY KEY (`idOrdenes`),
    //   ADD KEY(`numeroProducto`)";
    // $response = mysqli_query($connection, $query);

    // Create the relations between tables
    $query = "ALTER TABLE `productos` 
      ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias`(`idCategoria`),
      ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores`(`idProveedor`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `ordenes` 
      ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos`(`idProducto`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `detalleFacturas` 
      ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`idVendedor`) REFERENCES `vendedores`(`idVendedor`),
      ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`idModo`) REFERENCES `modoPagos`(`idModo`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `facturas` 
      ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idDetalleFactura`) REFERENCES `detalleFacturas`(`idDetalleFactura`),
      ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios`(`idUsuario`),
      ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idOrden`) REFERENCES `ordenes`(`idOrden`);";
    $relationships += mysqli_query($connection, $query);
    mysqli_close($connection);
  ?> 

  <table style="border: 2px solid black;">
    <tr>
      <td>Base de datos:</td>
      <td>
        <?php
          if($response) {
            echo ("Creada");
          } else {
            echo ("Algo salio mal, vuelva a cargar el script");
          }
        ?>
      </td>
    </tr>

    <tr>
      <td>Tablas creadas:</td>
      <td>
        <?php
          if($tables == 9) {
            echo ("$tables");
          } else {
            echo ("Error, no se han generado todas las tablas");
          }
        ?>
      </td>
    </tr>

    <tr>
      <td>Relaciones:</td>
      <td>
        <?php
          if($relationships == 4) {
            echo ("$relationships");
          } else {
            echo ("Error no se han creado todas las relaciones");
          }
        ?>
      </td>
    </tr>
  </table>

  <p>En caso de error elimine la base de datos y vuelva a intentarlo</p>
  <a href="index.php">Volver</a>
</body>
</html>