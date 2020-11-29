-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2020 at 04:35 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninefrmc_veterinaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `id_carro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_carro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
CREATE TABLE IF NOT EXISTS `cita` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `id_tienda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `id_veterinario` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `fecha_consulta` datetime NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  `receta` varchar(300) NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_tienda` (`id_tienda`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_mascota` (`id_mascota`),
  KEY `fecha_consulta` (`fecha_consulta`),
  KEY `id_veterinario` (`id_veterinario`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `historial_clinico`
--

DROP TABLE IF EXISTS `historial_clinico`;
CREATE TABLE IF NOT EXISTS `historial_clinico` (
  `historial_clinico_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `mascota_id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `cita` date NOT NULL,
  `pago` varchar(20) NOT NULL,
  `total` float NOT NULL,
  `receta` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`historial_clinico_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mascota`
--

DROP TABLE IF EXISTS `mascota`;
CREATE TABLE IF NOT EXISTS `mascota` (
  `id_mascota` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `id_cliente` int(11) DEFAULT NULL,
  `nombre` varchar(128) NOT NULL COMMENT 'Nombre de la mascota.',
  `fecha_nac` date NOT NULL,
  `fecha_vac` date NOT NULL,
  `categoria` varchar(128) NOT NULL,
  `raza` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `peso` float UNSIGNED NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_mascota`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `nombre` varchar(128) NOT NULL COMMENT 'Nombre del producto.',
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  `costo` float NOT NULL,
  `imagen` varchar(128) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `activo` varchar(1) NOT NULL DEFAULT '1',
  `vendidos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `nombre` varchar(128) NOT NULL COMMENT 'Nombre del servicio.',
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  `costo` float NOT NULL,
  `imagen` varchar(128) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `vendidos` int(11) NOT NULL DEFAULT '0',
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tienda`
--

DROP TABLE IF EXISTS `tienda`;
CREATE TABLE IF NOT EXISTS `tienda` (
  `id_tienda` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `id_administrador` int(11) NOT NULL,
  `id_cajero` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL COMMENT 'Nombre de la tienda.',
  `telefono` varchar(10) NOT NULL,
  `calle` varchar(128) NOT NULL,
  `numero_domicilio` int(10) UNSIGNED NOT NULL,
  `colonia` varchar(128) NOT NULL,
  `codigo_postal` int(5) UNSIGNED NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tienda`),
  KEY `id_administrador` (`id_administrador`),
  KEY `id_cajero` (`id_cajero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `nombre` varchar(128) NOT NULL COMMENT 'Nombre del cliente.',
  `apellido_p` varchar(128) NOT NULL,
  `apellido_m` varchar(128) NOT NULL,
  `fecha_nac` date NOT NULL,
  `correo_electronico` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `numero_de_telefono` varchar(10) NOT NULL,
  `calle` varchar(64) NOT NULL,
  `numero_domicilio` int(10) UNSIGNED NOT NULL,
  `colonia` varchar(64) NOT NULL,
  `codigo_postal` int(5) UNSIGNED NOT NULL,
  `metodo_de_pago` varchar(27) NOT NULL,
  `medico_cabecera` int(11) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  `tipo` varchar(18) NOT NULL DEFAULT 'Cliente',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Número único de identificación.',
  `id_cliente` int(11) NOT NULL,
  `id_producto` varchar(200) NOT NULL,
  `costo` float NOT NULL,
  `numero_de_telefono` varchar(11) NOT NULL,
  `calle` varchar(128) NOT NULL,
  `numero_domicilio` varchar(10) NOT NULL,
  `colonia` varchar(30) NOT NULL,
  `codigo_postal` varchar(6) NOT NULL,
  `metodo_de_pago` varchar(24) NOT NULL,
  `guia_de_envio` varchar(12) NOT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_venta`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producto`
--
ALTER TABLE `producto` ADD FULLTEXT KEY `nombre` (`nombre`,`descripcion`,`codigo`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio` ADD FULLTEXT KEY `nombre` (`nombre`,`descripcion`,`codigo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_veterinario`) REFERENCES `ninefrmx_veterinaria`.`veterinario` (`id_veterinario`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `users` (`USER_ID`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Constraints for table `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `users` (`USER_ID`);

--
-- Constraints for table `tienda`
--
ALTER TABLE `tienda`
  ADD CONSTRAINT `tienda_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `cita` (`id_tienda`),
  ADD CONSTRAINT `tienda_ibfk_2` FOREIGN KEY (`id_cajero`) REFERENCES `ninefrmx_veterinaria`.`cajero` (`id_cajero`),
  ADD CONSTRAINT `tienda_ibfk_3` FOREIGN KEY (`id_administrador`) REFERENCES `ninefrmx_veterinaria`.`administrador` (`id_administrador`);

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `users` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
