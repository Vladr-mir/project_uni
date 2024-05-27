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
    // TODO: Finish the primary keys and fk constraints
    // $database = "bdelprogreso";
    $connection;
    $tables = 0;
    $relationships = 0;

    require('./pages/scripts/connect.php');
    $response = $createDB();
    $connection = $connectDB();

    // Create database
    // $query = "CREATE DATABASE IF NOT EXISTS $database;";
    // $response = mysqli_query($connection, $query);
    // mysqli_select_db($connection, $database);

    // Create tables
    $query = "CREATE TABLE `categorias` (
      `idCategoria` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombre` varchar(50) NOT NULL,
      `descripcion` varchar(100) NOT NULL,
      `isActive` bit(1) DEFAULT b'1'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `clientes` (
      `idCliente` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombres` varchar(60) NOT NULL,
      `apellidos` varchar(60),
      `direccion` varchar(300),
      `telefono` varchar(8) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `delivery` (
      `idDelivery` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombres` varchar(60) NOT NULL,
      `apellidos` varchar(60) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `detalleordenes` (
      `idNumeroDeOrden` int(11) AUTO_INCREMENT PRIMARY KEY,
      `idProducto` int(11) NOT NULL,
      `cantidad` int(11) NOT NULL,
      `precio` double(10,2) NOT NULL,
      `idOrden` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    // categories are for products
   $query = "CREATE TABLE `facturas` (
      `numFactura` int(11) AUTO_INCREMENT PRIMARY KEY,
      `fecha` date NOT NULL,
      `total` decimal(10,2) NOT NULL,
      `direccion` varchar(300) NOT NULL,
      `idUsuario` int(11) NOT NULL,
      `idOrden` int(11) NOT NULL,
      `idSucursal` int(11) NOT NULL,
      `idModoPago` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

   $query = "CREATE TABLE `modopagos` (
      `idModo` int(11) AUTO_INCREMENT PRIMARY KEY,
      `tipoPago` varchar(25) NOT NULL,
      `isActive` bit(1) DEFAULT b'1'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `ordenes` (
      `idOrden` int(11) AUTO_INCREMENT PRIMARY KEY,
      `total` double(10,2),
      `formaDePago` int(11) NOT NULL,
      `fecha` date NOT NULL,
      `Hora` datetime NOT NULL,
      `idDelivery` int(11),
      `isConfirmed` bit(1) DEFAULT b'0',
      `isCompleted` bit(1) DEFAULT b'1',
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `productos` (
      `idProducto` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombre` varchar(200) NOT NULL,
      `precio` decimal(10,2) NOT NULL,
      `stock` int(11) NOT NULL,
      `isActive` bit(1) DEFAULT b'1',
      `idCategoria` int(11) NOT NULL,
      `idProveedor` int(11) NOT NULL,
      `idUnidad` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `proveedores` (
      `idProveedor` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombre` varchar(200) NOT NULL,
      `telefono` varchar(8) NOT NULL,
      `email` varchar(100) NOT NULL,
      `isActive` bit(1) DEFAULT b'1'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);
    

    $query = "CREATE TABLE `sucursales` (
      `idSucursal` int(11) AUTO_INCREMENT PRIMARY KEY,
      `nombre` varchar(70) NOT NULL,
      `telefono` varchar(8) NOT NULL,
      `direccion` varchar(100) NOT NULL,
      `email` varchar(100) DEFAULT NULL,
      `isActive` bit(1) DEFAULT b'1'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `unidades` (
      `idUnidad` int(11) AUTO_INCREMENT PRIMARY KEY,
      `Nombre` varchar(30) NOT NULL,
      `Descripcion` varchar(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    $query = "CREATE TABLE `usuarios` (
      `idUsuario` int(11) AUTO_INCREMENT PRIMARY KEY,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `isActive` bit(1) DEFAULT b'1',
      `isAdmin` bit(1) DEFAULT b'0',
      `idCliente` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tables += mysqli_query($connection, $query);

    // Create the relations between tables
    $query = "ALTER TABLE `detalleordenes`
      ADD CONSTRAINT `detalleOrdenes_ibfk1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
      ADD CONSTRAINT `detalleOrdenes_ibfk2` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`idOrden`)";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `facturas`
      ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
      ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`idOrden`),
      ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`idSucursal`) REFERENCES `sucursales` (`idSucursal`),
      ADD CONSTRAINT `factura_ibfk_5` FOREIGN KEY (`idModoPago`) REFERENCES `modopagos` (`idModo`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `ordenes`
      ADD CONSTRAINT `orden_ibfk3` FOREIGN KEY (`formaDePago`) REFERENCES `modopagos` (`idModo`),
      ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`idDelivery`) REFERENCES `delivery` (`idDelivery`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `productos`
      ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
      ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
      ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idUnidad`) REFERENCES `unidades` (`idUnidad`);";
    $relationships += mysqli_query($connection, $query);

    $query = "ALTER TABLE `usuarios`
      ADD CONSTRAINT `usuarios_fk1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);";
    $relationships += mysqli_query($connection, $query);

    $query = "INSERT INTO `clientes` (`idCliente`, `nombres`, `apellidos`, `direccion`, `telefono`)
    VALUES (NULL, 'root', NULL, NULL, '8888888');";
    mysqli_query($connection, $query);

    $query = "INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `isActive`, `isAdmin`, `idCliente`)
    VALUES (NULL, 'root@mail.com', '123', b'1', b'1', '1');";
    mysqli_query($connection, $query);

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
          if($tables == 12) {
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
          if($relationships == 5) {
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