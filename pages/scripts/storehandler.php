<?php
  require('connect.php');
  session_start();

  $products = json_decode(htmlspecialchars_decode($_POST['productsid']));
  $connection = $connectDB();
  $total = 0;

  $sucursal = $_POST['sucursal'];
  $modoPago = $_POST['modoPago'];
  $userId = $_POST['userId'];
  $direction = $_POST['direccion'];
  $sucursal = $_POST['sucursal'];
  $date = date('d-m-y');
  $hour = date('H:i');

  $query = "INSERT INTO `ordenes` (`fecha`, `hora`, `formaDePago`, `idUsuario`, `direccion`, `idSucursal`) VALUES ('$date', '$hour', '$modoPago', '$userId', '$direction', '$sucursal')";
  $result = mysqli_query($connection, $query);
  $idOrden = mysqli_insert_id($connection);

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

    $dtorden = "INSERT INTO `detalleordenes` (`idProducto`, `cantidad`, `precio`, `idOrden`) VALUES ('$id_product', '$cuantity', '$price', '$idOrden')";
    $result1 = mysqli_query($connection, $dtorden);
  }
  
  $orden = "UPDATE `ordenes` SET `total`='$total' WHERE `idOrden`='$idOrden';";
  $result = mysqli_query($connection, $orden);

  // $detalle = "INSERT INTO `detalleFacturas` (`IdSucursal`, `idModo`) VALUES ($sucursal, '$modoPago');";
  // $result2 = mysqli_query($connection, $detalle);
  // $detalleId = mysqli_insert_id($connection);

  // $factura = "INSERT INTO `facturas` (`fecha`, `precio`, `idDetalleFactura`, `idUsuario`, `idOrden`) VALUES ('$date', '$total', '$detalleId', '$userId', '$idOrden');";
  // $result3 = mysqli_query($connection, $factura);
  mysqli_close($connection);

  header("Location: ../user/showOrder.php?orderid=$idOrden");
  die();
?>