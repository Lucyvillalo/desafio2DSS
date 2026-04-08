SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `ev02` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `ev02`;

DROP TABLE IF EXISTS `apuntes`;
CREATE TABLE `apuntes` (
  `id` int NOT NULL,
  `titulo` varchar(75) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora` (
  `FECHA_HORA` varchar(255) DEFAULT NULL COMMENT 'para registrar el momento en que ocurre',
  `PAGINA` varchar(255) DEFAULT NULL COMMENT 'quien lo hizo',
  `TABLA` varchar(255) DEFAULT NULL COMMENT 'rutina donde lo efectuo',
  `TIPO_CONSULTA` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `generales`;
CREATE TABLE `generales` (
  `id` int NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `carnet` varchar(100) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `cum` varchar(12) DEFAULT NULL,
  `imagen` blob,
  `fechacreacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `id_notas` int NOT NULL,
  `carnet` varchar(32) DEFAULT NULL,
  `materia` varchar(60) DEFAULT NULL,
  `nota1` decimal(10,2) DEFAULT NULL,
  `nota2` decimal(10,2) DEFAULT NULL,
  `nota3` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `usuario` text,
  `contrasena` text,
  `email` text,
  `nombres` text,
  `apellidos` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;


ALTER TABLE `apuntes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `generales`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_notas`);


ALTER TABLE `apuntes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `generales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `notas`
  MODIFY `id_notas` int NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
