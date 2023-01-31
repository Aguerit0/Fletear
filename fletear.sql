-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2023 a las 01:20:30
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fletear`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(50) NOT NULL,
  `apellidoCliente` varchar(50) NOT NULL,
  `correoCliente` varchar(50) NOT NULL,
  `dniCliente` varchar(50) NOT NULL,
  `domicilioCliente` varchar(50) NOT NULL,
  `telefonoCliente` varchar(50) NOT NULL,
  `fechaNacCliente` varchar(50) NOT NULL,
  `sexoCliente` int(11) NOT NULL,
  `fechaRegCliente` varchar(50) NOT NULL,
  `eliminadoCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombreCliente`, `apellidoCliente`, `correoCliente`, `dniCliente`, `domicilioCliente`, `telefonoCliente`, `fechaNacCliente`, `sexoCliente`, `fechaRegCliente`, `eliminadoCliente`) VALUES
(12, 'Augusto', 'Bustos', 'Augusto123@gmail.com', '1', '1', '3834001122', '0001-11-11', 0, '2023-01-10 12:17:56', 0),
(13, 'Esteban', 'Agüero', 'eaguero@institutosanmartin.edu.ar', '43192391', 'XX', '3834688699', '2001-02-25', 0, '2023-01-10 13:35:54', 0),
(14, 'Usuario', 'SinApellido', 'usu@gmail.com', '988', 'usu', '3834991199', '0098-08-09', 0, '2023-01-13 16:06:50', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fletero`
--

CREATE TABLE `fletero` (
  `idFletero` int(11) NOT NULL,
  `imagenFletero` longblob NOT NULL,
  `descripcionFletero` varchar(50) NOT NULL,
  `carnetFletero` longblob NOT NULL,
  `cedulaFletero` longblob NOT NULL,
  `cantidadVehiculosFletero` int(11) NOT NULL,
  `cantidadViajesFletero` int(11) NOT NULL,
  `puntajeFletero` int(11) NOT NULL,
  `actividadFletero` int(11) NOT NULL,
  `fechaRegFletero` int(11) NOT NULL,
  `eliminadoFletero` int(11) NOT NULL DEFAULT 0,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fletero`
--

INSERT INTO `fletero` (`idFletero`, `imagenFletero`, `descripcionFletero`, `carnetFletero`, `cedulaFletero`, `cantidadVehiculosFletero`, `cantidadViajesFletero`, `puntajeFletero`, `actividadFletero`, `fechaRegFletero`, `eliminadoFletero`, `idCliente`) VALUES
(26, 0x2e2e2f696d6167656e6573466c657465726f2f696d6167656e466c657465726f2f436170747572612064652070616e74616c6c6120323032332d30312d3034203137333132362e706e67, 'SOY UN CONDUCTOR', 0x2e2e2f696d6167656e6573466c657465726f2f6361726e6574466c657465726f2f656469666963696f732d64652d616c6d6163656e616d69656e746f2d69736f6d65747269636f2d63616d696f6e65732d64652d63617267612d792d74726162616a61646f7265732d64652d616c6d6163656e65732d65717569706f2d64652d616c6d6163656e2d696e647573747269616c2d636f6e6a756e746f2d64652d696c757374726163696f6e2d64652d766563746f7265732d64652d736572766963696f2d64652d656e74726567612d6c6f676973746963612d326830303538652e6a7067, 0x2e2e2f696d6167656e6573466c657465726f2f636564756c61466c657465726f2f656e766961722d6c6f676973746963612d656d70726573612d7472616e73706f727461646f72612d62616e6e65722d343030783136372e6a7067, 3, 0, 0, 0, 2147483647, 0, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `precioServicio` double NOT NULL,
  `metodoPagoServicio` int(11) NOT NULL,
  `fechaSalidaServicio` varchar(50) NOT NULL,
  `fechaLlegadaServicio` varchar(50) NOT NULL,
  `estadoServicio` int(11) NOT NULL DEFAULT 0,
  `latitudSalidaServicio` varchar(50) NOT NULL,
  `longitudSalidaServicio` varchar(50) NOT NULL,
  `latitudLlegadaServicio` varchar(50) NOT NULL,
  `longitudLlegadaServicio` varchar(50) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idFletero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `contraseña`, `rol`, `eliminado`, `idCliente`) VALUES
(12, 'usu', 'usu', 1, 0, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL,
  `vehiculoVehiculo` longblob NOT NULL,
  `seguroVehiculo` longblob NOT NULL,
  `tituloVehiculo` longblob NOT NULL,
  `tipoVehiculo` varchar(50) NOT NULL,
  `colorVehiculo` varchar(50) NOT NULL,
  `descripcionVehiculo` varchar(50) NOT NULL,
  `fechaRegVehiculo` varchar(50) NOT NULL,
  `solicitudVehiculo` int(11) NOT NULL DEFAULT 0,
  `eliminadoVehiculo` int(11) NOT NULL DEFAULT 0,
  `idFletero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idVehiculo`, `vehiculoVehiculo`, `seguroVehiculo`, `tituloVehiculo`, `tipoVehiculo`, `colorVehiculo`, `descripcionVehiculo`, `fechaRegVehiculo`, `solicitudVehiculo`, `eliminadoVehiculo`, `idFletero`) VALUES
(4, 0x2e2e2f696d6167656e6573466c657465726f2f7665686963756c6f5665686963756c6f2f696d67342e6a7067, 0x2e2e2f696d6167656e6573466c657465726f2f73656775726f5665686963756c6f2f696d67312e6a7067, 0x2e2e2f696d6167656e6573466c657465726f2f746974756c6f5665686963756c6f2f696d6167656e756e6574652e6a7067, '0', 'ROJO', 'ALTO Y BAJO', '2023-01-26 00:27:29', 0, 0, 26),
(5, 0x2e2e2f696d6167656e6573466c657465726f2f7665686963756c6f5665686963756c6f2f70726573656e74616369c3b36e2d312e706e67, 0x2e2e2f696d6167656e6573466c657465726f2f73656775726f5665686963756c6f2f70726573656e74616369c3b36e2d332e706e67, 0x2e2e2f696d6167656e6573466c657465726f2f746974756c6f5665686963756c6f2f50726573656e74616369c3b36e2d322e706e67, '0', 'VERDE', 'X', '2023-01-30 21:04:05', 0, 0, 26),
(6, 0x2e2e2f696d6167656e6573466c657465726f2f7665686963756c6f5665686963756c6f2f70726573656e74616369c3b36e2d312e706e67, 0x2e2e2f696d6167656e6573466c657465726f2f73656775726f5665686963756c6f2f50726573656e74616369c3b36e2d322e706e67, 0x2e2e2f696d6167656e6573466c657465726f2f746974756c6f5665686963756c6f2f70726573656e74616369c3b36e2d312e706e67, '5', 'AZUL', 'F', '2023-01-30 21:13:35', 0, 0, 26);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `fletero`
--
ALTER TABLE `fletero`
  ADD PRIMARY KEY (`idFletero`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idFletero` (`idFletero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD KEY `idFletero` (`idFletero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `fletero`
--
ALTER TABLE `fletero`
  MODIFY `idFletero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fletero`
--
ALTER TABLE `fletero`
  ADD CONSTRAINT `fletero_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`idFletero`) REFERENCES `fletero` (`idFletero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`idFletero`) REFERENCES `fletero` (`idFletero`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
