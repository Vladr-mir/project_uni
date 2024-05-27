<?php
  require('connect.php');
  session_start();

  $products = json_decode(htmlspecialchars_decode($_POST['productsid']));
  $connection = $connectDB();
  $total = 0;

  $sucursal = $_POST['sucursal'];
  $modoPago = $_POST['modoPago'];
  $userId = $_POST['userId'];
  $date = date('d-m-y');
  $hour = date('H:i');

  $query = "INSERT INTO `ordenes` (`fecha`, `hora`, `formaDePago`) VALUES ('$date', '$hour', '$modoPago')";
  $result = mysqli_query($connection, $query);
  $idOrden = mysqli_insert_id($connection);

  // $query = "SELECT `NumeroDocumento` FROM `detalleOrdenes` WHERE `NumeroDocumento`=(SELECT MAX(`NumeroDocumento`) FROM `detalleOrdenes`";

  // $query = "SELECT `idNumeroDeOrden` FROM `detalleOrdenes` ORDER BY `idOrden` DESC LIMIT 1;";
  // $idOrden = mysqli_fetch_array(mysqli_query($connection, $query));
  // if ($idOrden == null) {
  //   $idOrden = 1;
  // } else {
  //   $idOrden = reset($idOrden) + 1;
  // }

  foreach($products as $id) {
    $id_product = $_POST["id$id"];
    $price = $_POST["price$id"];
    $cuantity = $_POST["cuantity$id"];
    $stock = $_POST["stock$id"];

    if ($cuantity < 1) {
      continue;
    }

    if ($cuantity > $stock) {
      $cuantity = $stock;
    }

    $total += round(($price * $cuantity), 2);
    $stock -= $cuantity;

    $newStock = "UPDATE `productos`
    SET `stock` = $stock
    WHERE `idProducto` = '$id_product';";
    $newStockResult = mysqli_query($connection, $newStock);

    // $orden = "INSERT INTO `ordenes` (`idOrden`, `numeroProducto`, `idProducto`, `cuantity`) VALUES ($idOrden, '$id', '$id', $cuantity);";
    $dtorden = "INSERT INTO `detalleordenes` (`idProducto`, `cantidad`, `precio`, `numeroDocumento`) VALUES ('$id_product', '$cuantity', '$price', '$id_product')";
    $result1 = mysqli_query($connection, $orden);
  }

  $detalle = "INSERT INTO `detalleFacturas` (`IdSucursal`, `idModo`) VALUES ($sucursal, '$modoPago');";
  $result2 = mysqli_query($connection, $detalle);
  $detalleId = mysqli_insert_id($connection);

  $factura = "INSERT INTO `facturas` (`fecha`, `precio`, `idDetalleFactura`, `idUsuario`, `idOrden`) VALUES ('$date', '$total', '$detalleId', '$userId', '$idOrden');";
  $result3 = mysqli_query($connection, $factura);
  mysqli_close($connection);

  header('Location: ../user/thanks.php');
  die();
?>