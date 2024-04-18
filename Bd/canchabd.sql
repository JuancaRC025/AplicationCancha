-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2023 a las 03:44:28
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `canchabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cancha`
--

CREATE TABLE `detalle_cancha` (
  `Id_Detalle_Cancha` int(11) NOT NULL,
  `Id_Empresa` int(11) NOT NULL,
  `Tamaño` varchar(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `detalle_cancha`
--

INSERT INTO `detalle_cancha` (`Id_Detalle_Cancha`, `Id_Empresa`, `Tamaño`, `Nombre`, `Precio`) VALUES
(1, 1, 'futbol 5', 'cancha 01', 40000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reserva`
--

CREATE TABLE `detalle_reserva` (
  `Id_Detalle_Reserva` int(11) NOT NULL,
  `Id_Reserva` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Detalle_Cancha` int(11) NOT NULL,
  `Id_Empresa` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Hora` time NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `Id_Empresa` int(11) NOT NULL,
  `Nit` varchar(10) NOT NULL,
  `Razon_Social` varchar(50) NOT NULL,
  `Direccion` varchar(15) NOT NULL,
  `Representante_Legal` varchar(30) NOT NULL,
  `Telefono` varchar(11) NOT NULL,
  `Correo_Electronico` varchar(50) NOT NULL,
  `Contraseña` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`Id_Empresa`, `Nit`, `Razon_Social`, `Direccion`, `Representante_Legal`, `Telefono`, `Correo_Electronico`, `Contraseña`) VALUES
(1, '1122334455', 'La Pasion del Futbol', 'Cra. 5 #13-54, ', 'Hernan Perez', '3124567653', 'LaPasionFut@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `Id_Reserva` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Detalle_Cancha` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`Id_Reserva`, `Id_Usuario`, `Id_Detalle_Cancha`, `Fecha`, `Hora`) VALUES
(2, 2, 1, '2023-11-23', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombres` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Correo_Electronico` varchar(50) NOT NULL,
  `Telefono` varchar(11) NOT NULL,
  `Contraseña` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Nombres`, `Apellidos`, `Correo_Electronico`, `Telefono`, `Contraseña`) VALUES
(1, 'Juan', 'Cordoba', '2.juanca73@gmail.com', '3145494538', '123456'),
(2, 'Andres', 'Vallejo', 'andres123@gmail.com', '3114536712', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_cancha`
--
ALTER TABLE `detalle_cancha`
  ADD PRIMARY KEY (`Id_Detalle_Cancha`),
  ADD KEY `emprse_Id_Empresa_detalle_cancha` (`Id_Empresa`);

--
-- Indices de la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD PRIMARY KEY (`Id_Detalle_Reserva`),
  ADD KEY `reserva_Id_Reserva_Detalle_Reserva` (`Id_Reserva`),
  ADD KEY `usuario_Id_Usuario_Detalle_Reserva` (`Id_Usuario`),
  ADD KEY `detalle_cacha_Id_Detalle_Cancha_Detalle_Reserva` (`Id_Detalle_Cancha`),
  ADD KEY `empresa_Id_Empresa_Detalle_Reserva` (`Id_Empresa`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`Id_Empresa`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`Id_Reserva`),
  ADD KEY `usuario_Id_Usuario_reserva` (`Id_Usuario`),
  ADD KEY `detalle_cancha_Id_Detalle_Cancha_reserva` (`Id_Detalle_Cancha`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_cancha`
--
ALTER TABLE `detalle_cancha`
  MODIFY `Id_Detalle_Cancha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  MODIFY `Id_Detalle_Reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `Id_Empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `Id_Reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_cancha`
--
ALTER TABLE `detalle_cancha`
  ADD CONSTRAINT `emprse_Id_Empresa_detalle_cancha` FOREIGN KEY (`Id_Empresa`) REFERENCES `empresa` (`Id_Empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD CONSTRAINT `detalle_cacha_Id_Detalle_Cancha_Detalle_Reserva` FOREIGN KEY (`Id_Detalle_Cancha`) REFERENCES `detalle_cancha` (`Id_Detalle_Cancha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresa_Id_Empresa_Detalle_Reserva` FOREIGN KEY (`Id_Empresa`) REFERENCES `empresa` (`Id_Empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_Id_Reserva_Detalle_Reserva` FOREIGN KEY (`Id_Reserva`) REFERENCES `reserva` (`Id_Reserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_Id_Usuario_Detalle_Reserva` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `detalle_cancha_Id_Detalle_Cancha_reserva` FOREIGN KEY (`Id_Detalle_Cancha`) REFERENCES `detalle_cancha` (`Id_Detalle_Cancha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_Id_Usuario_reserva` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
