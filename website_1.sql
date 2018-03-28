-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2018 a las 21:07:34
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `website`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualiza`
--

CREATE TABLE `actualiza` (
  `num_act` int(11) NOT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `num_info` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `correo` varchar(80) NOT NULL,
  `contrasenia` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `num_bitacora` int(11) NOT NULL,
  `correo_adm` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `numero_cliente` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `mensaje` text,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crud`
--

CREATE TABLE `crud` (
  `num_crud` int(11) NOT NULL,
  `codigoPublicidad` int(11) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ediciones`
--

CREATE TABLE `ediciones` (
  `num_ediciones` int(11) NOT NULL,
  `numero_cliente` int(11) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `numero_info` int(11) NOT NULL,
  `nosotros` text NOT NULL,
  `contacto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `descripcion` text,
  `precio` float DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_actualiza`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_actualiza` (
`num_act` int(11)
,`correo` varchar(80)
,`num_info` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_administrador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_administrador` (
`correo` varchar(80)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_bitacora`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_bitacora` (
`num_bitacora` int(11)
,`correo_adm` varchar(100)
,`descripcion` text
,`fecha` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_cliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_cliente` (
`numero_cliente` int(11)
,`fecha` date
,`nombre` varchar(100)
,`mensaje` text
,`correo` varchar(100)
,`telefono` varchar(18)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_crud`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_crud` (
`num_crud` int(11)
,`codigoPublicidad` int(11)
,`correo` varchar(80)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_ediciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_ediciones` (
`num_ediciones` int(11)
,`numero_cliente` int(11)
,`correo` varchar(80)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_informacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_informacion` (
`numero_info` int(11)
,`nosotros` text
,`contacto` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_publicidad`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_publicidad` (
`codigo` int(11)
,`nombre` varchar(80)
,`tipo` varchar(40)
,`descripcion` text
,`precio` float
,`imagen` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_actualiza`
--
DROP TABLE IF EXISTS `vw_actualiza`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_actualiza`  AS  select `actualiza`.`num_act` AS `num_act`,`actualiza`.`correo` AS `correo`,`actualiza`.`num_info` AS `num_info` from `actualiza` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_administrador`
--
DROP TABLE IF EXISTS `vw_administrador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_administrador`  AS  select `administrador`.`correo` AS `correo` from `administrador` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_bitacora`
--
DROP TABLE IF EXISTS `vw_bitacora`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_bitacora`  AS  select `bitacora`.`num_bitacora` AS `num_bitacora`,`bitacora`.`correo_adm` AS `correo_adm`,`bitacora`.`descripcion` AS `descripcion`,`bitacora`.`fecha` AS `fecha` from `bitacora` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_cliente`
--
DROP TABLE IF EXISTS `vw_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cliente`  AS  select `cliente`.`numero_cliente` AS `numero_cliente`,`cliente`.`fecha` AS `fecha`,`cliente`.`nombre` AS `nombre`,`cliente`.`mensaje` AS `mensaje`,`cliente`.`correo` AS `correo`,`cliente`.`telefono` AS `telefono` from `cliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_crud`
--
DROP TABLE IF EXISTS `vw_crud`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_crud`  AS  select `crud`.`num_crud` AS `num_crud`,`crud`.`codigoPublicidad` AS `codigoPublicidad`,`crud`.`correo` AS `correo` from `crud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_ediciones`
--
DROP TABLE IF EXISTS `vw_ediciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ediciones`  AS  select `ediciones`.`num_ediciones` AS `num_ediciones`,`ediciones`.`numero_cliente` AS `numero_cliente`,`ediciones`.`correo` AS `correo` from `ediciones` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_informacion`
--
DROP TABLE IF EXISTS `vw_informacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_informacion`  AS  select `informacion`.`numero_info` AS `numero_info`,`informacion`.`nosotros` AS `nosotros`,`informacion`.`contacto` AS `contacto` from `informacion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_publicidad`
--
DROP TABLE IF EXISTS `vw_publicidad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_publicidad`  AS  select `publicidad`.`codigo` AS `codigo`,`publicidad`.`nombre` AS `nombre`,`publicidad`.`tipo` AS `tipo`,`publicidad`.`descripcion` AS `descripcion`,`publicidad`.`precio` AS `precio`,`publicidad`.`imagen` AS `imagen` from `publicidad` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
