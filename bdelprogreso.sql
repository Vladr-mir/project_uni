-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 20:03:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbdev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `isActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `descripcion`, `isActive`) VALUES
(1, 'Embutidos', 'son embutidos', b'1'),
(2, 'Carnes', 'Cortes de carne', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombres`, `apellidos`, `direccion`, `telefono`) VALUES
(1, 'root', NULL, NULL, '8888888');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

CREATE TABLE `delivery` (
  `idDelivery` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `delivery`
--

INSERT INTO `delivery` (`idDelivery`, `nombres`, `apellidos`) VALUES
(1, 'Nombre', 'jalkfjlka');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleordenes`
--

CREATE TABLE `detalleordenes` (
  `idNumeroDeOrden` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `idOrden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleordenes`
--

INSERT INTO `detalleordenes` (`idNumeroDeOrden`, `idProducto`, `cantidad`, `precio`, `idOrden`) VALUES
(1, 1, 7, 3.75, 1),
(2, 2, 1, 3.00, 1),
(3, 2, 1, 3.00, 2),
(4, 3, 2, 2.50, 2),
(5, 2, 6, 3.00, 3),
(6, 3, 1, 2.50, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `numFactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idOrden` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `idModoPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`numFactura`, `fecha`, `total`, `direccion`, `idUsuario`, `idOrden`, `idSucursal`, `idModoPago`) VALUES
(2, '2029-05-24', 29.25, 'San miguel', 1, 1, 1, 1),
(3, '2029-05-24', 8.00, 'jalkdjalk', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modopagos`
--

CREATE TABLE `modopagos` (
  `idModo` int(11) NOT NULL,
  `tipoPago` varchar(25) NOT NULL,
  `isActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modopagos`
--

INSERT INTO `modopagos` (`idModo`, `tipoPago`, `isActive`) VALUES
(1, 'Pago en físico', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `idOrden` int(11) NOT NULL,
  `total` double(10,2) DEFAULT NULL,
  `formaDePago` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Hora` datetime NOT NULL,
  `idDelivery` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `isConfirmed` bit(1) DEFAULT b'0',
  `isCompleted` bit(1) DEFAULT b'0',
  `isCancelled` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`idOrden`, `total`, `formaDePago`, `fecha`, `Hora`, `idDelivery`, `idUsuario`, `idSucursal`, `direccion`, `isConfirmed`, `isCompleted`, `isCancelled`) VALUES
(1, 29.25, 1, '2029-05-24', '0000-00-00 00:00:00', 1, 1, 1, 'San miguel', b'0', b'1', b'0'),
(2, 8.00, 1, '2029-05-24', '0000-00-00 00:00:00', 1, 1, 1, 'jalkdjalk', b'0', b'1', b'0'),
(3, 20.50, 1, '2029-05-24', '0000-00-00 00:00:00', NULL, 1, 1, 'jljlk', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `isActive` bit(1) DEFAULT b'1',
  `idCategoria` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idUnidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `precio`, `stock`, `isActive`, `idCategoria`, `idProveedor`, `idUnidad`) VALUES
(1, 'Lomo', 3.75, 0, b'1', 2, 1, 1),
(2, 'Salchicha', 3.00, 6, b'1', 1, 1, 1),
(3, 'Chorizo', 2.50, 8, b'1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `telefono`, `email`, `isActive`) VALUES
(1, 'Salchicheria', '11111111', 'cualquier@mail.com', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `idSucursal` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `isActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`idSucursal`, `nombre`, `telefono`, `direccion`, `email`, `isActive`) VALUES
(1, 'San Miguel', '123213', 'San miguel', 'cualquier@mail.com', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `idUnidad` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`idUnidad`, `Nombre`, `Descripcion`) VALUES
(1, 'Libras', 'libras'),
(2, 'Libras', 'libras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` bit(1) DEFAULT b'1',
  `isAdmin` bit(1) DEFAULT b'0',
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `isActive`, `isAdmin`, `idCliente`) VALUES
(1, 'root@mail.com', '123', b'1', b'1', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`idDelivery`);

--
-- Indices de la tabla `detalleordenes`
--
ALTER TABLE `detalleordenes`
  ADD PRIMARY KEY (`idNumeroDeOrden`),
  ADD KEY `detalleOrdenes_ibfk1` (`idProducto`),
  ADD KEY `detalleOrdenes_ibfk2` (`idOrden`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`numFactura`),
  ADD KEY `factura_ibfk_2` (`idUsuario`),
  ADD KEY `factura_ibfk_3` (`idOrden`),
  ADD KEY `factura_ibfk_4` (`idSucursal`),
  ADD KEY `factura_ibfk_5` (`idModoPago`);

--
-- Indices de la tabla `modopagos`
--
ALTER TABLE `modopagos`
  ADD PRIMARY KEY (`idModo`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`idOrden`),
  ADD KEY `orden_ibfk_1` (`formaDePago`),
  ADD KEY `orden_ibfk_2` (`idDelivery`),
  ADD KEY `orden_ibfk_3` (`idSucursal`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `producto_ibfk_1` (`idCategoria`),
  ADD KEY `producto_ibfk_2` (`idProveedor`),
  ADD KEY `producto_ibfk_3` (`idUnidad`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`idSucursal`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`idUnidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `usuarios_fk1` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `delivery`
--
ALTER TABLE `delivery`
  MODIFY `idDelivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleordenes`
--
ALTER TABLE `detalleordenes`
  MODIFY `idNumeroDeOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `numFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modopagos`
--
ALTER TABLE `modopagos`
  MODIFY `idModo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `idUnidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleordenes`
--
ALTER TABLE `detalleordenes`
  ADD CONSTRAINT `detalleOrdenes_ibfk1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `detalleOrdenes_ibfk2` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`idOrden`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`idOrden`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`idSucursal`) REFERENCES `sucursales` (`idSucursal`),
  ADD CONSTRAINT `factura_ibfk_5` FOREIGN KEY (`idModoPago`) REFERENCES `modopagos` (`idModo`);

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`formaDePago`) REFERENCES `modopagos` (`idModo`),
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`idDelivery`) REFERENCES `delivery` (`idDelivery`),
  ADD CONSTRAINT `orden_ibfk_3` FOREIGN KEY (`idSucursal`) REFERENCES `sucursales` (`idSucursal`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idUnidad`) REFERENCES `unidades` (`idUnidad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_fk1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
