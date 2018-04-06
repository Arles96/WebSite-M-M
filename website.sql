-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2018 a las 20:02:06
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_ADMIN` (`CORREO2` VARCHAR(80), `CONTRASENIA2` VARCHAR(70))  INSERT INTO administrador(CORREO, CONTRASENIA) VALUES (CORREO2, AES_ENCRYPT(CONTRASENIA2,'CONTRASENIA'))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_ADMINISTRADOR` (`CORREO2` VARCHAR(80), `ADMIN` VARCHAR(80))  BEGIN 
	DECLARE NUMERO INT;
    SET NUMERO = (SELECT COUNT(*) FROM administrador);
    IF (NUMERO>0) THEN 
        DELETE FROM administrador WHERE CORREO=CORREO2;
        INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se ha eliminado el administrador: ', CORREO2), now());
        SELECT TRUE;
    ELSE 
    	SELECT FALSE;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_CLIENTE` (IN `NUMERO_CLIENTE2` INT, IN `ADMIN` VARCHAR(80))  BEGIN
	DELETE FROM cliente WHERE NUMERO_CLIENTE=NUMERO_CLIENTE2;
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se ha eliminado el cliente: ', NUMERO_CLIENTE2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_INFORMACION` (`NUMERO_INFO2` INT, `ADMIN` VARCHAR(80))  BEGIN 
	DELETE FROM informacion WHERE NUMERO_INFO=NUMERO_INFO2;
    INSERT INTO actualiza(CORREO, NUM_INFO) VALUES (ADMIN, NUMERO_INFO2);
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, 'Se ha realizado una accion en la tabla informacion', NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PUBLICIDAD` (`CODIGO2` INT, `ADMIN` VARCHAR(80))  BEGIN 
	DELETE FROM publicidad WHERE CODIGO=CODIGO2;
    INSERT INTO crud(CODIGOPUBLICIDAD, CORREO) VALUES (CODIGO2, ADMIN);
    INSERT INTO bitacora(CORRE_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se elimino la publicidad', CODIGO2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_CLIENTE` (`NOMBRE2` VARCHAR(100), `MENSAJE2` TEXT, `CORREO2` VARCHAR(100), `TELEFONO2` VARCHAR(18))  INSERT INTO cliente(FECHA, NOMBRE, MENSAJE, CORREO, TELEFONO) VALUES (NOW(), NOMBRE2, MENSAJE2, CORREO2, TELEFONO2)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_INFORMATION` (`NOSOTROS2` TEXT, `CONTACTO2` TEXT, `ADMIN` VARCHAR(80))  BEGIN 
	DECLARE NUM INT;
    DECLARE INFO INT;
    SET NUM = (SELECT COUNT(*) FROM informacion);
    IF (NUM=0) THEN 
    	INSERT INTO informacion(NOSOTROS, CONTACTO) VALUES (NOSOTROS2, CONTACTO2);
        SET INFO = (SELECT NUMERO_INFO FROM informacion);
        INSERT INTO actualiza(CORREO, NUM_ACT) VALUES (ADMIN, INFO);
        INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, 'Se ha relizado una accion en la tabla informacion', NOW());
      	SELECT TRUE;
    ELSE 
    	SELECT FALSE;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PUBLICIDAD` (`CODIGO2` INT, `NOMBRE2` VARCHAR(80), `TIPO2` VARCHAR(40), `DESCRIPCION2` TEXT, `PRECIO2` FLOAT, `IMAGEN2` VARCHAR(255), `ADMIN` VARCHAR(80))  BEGIN 
	IF (PRECIO2>=0) THEN 
    	INSERT INTO publicidad(CODIGO, NOMBRE, TIPO, DESCRIPCION, PRECIO, IMAGEN) VALUES (CODIGO2, NOMBRE2, TIPO2, DESCRIPCION2, PRECIO2, IMAGEN2);
        INSERT INTO crud(CODIGOPUBLICIDAD, CORREO) VALUES (CODIGO2, ADMIN);
        INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se ha agregado la publicidad: ', CODIGO2), NOW());
        SELECT TRUE;
	ELSE
		SELECT FALSE;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LOGIN` (IN `CORREO2` VARCHAR(80), IN `CONTRASENIA2` VARCHAR(70))  SELECT CORREO FROM administrador WHERE CORREO=CORREO2 AND AES_DECRYPT(contrasenia, 'CONTRASENIA')=CONTRASENIA2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_ADMINISTRADOR` (IN `CORREO2` VARCHAR(80), IN `CORREO3` VARCHAR(80), IN `CONTRASENIA2` VARCHAR(70), IN `ADMIN` VARCHAR(80))  BEGIN 
	UPDATE administrador SET CORREO=CORREO3, CONTRASENIA=AES_ENCRYPT(CONTRASENIA2,'CONTRASENIA') WHERE CORREO=CORREO2;
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Ha actualizado los datos del administrador: ', CORREO2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_CLIENTE` (IN `NUMERO_CLIENTE2` INT, IN `NOMBRE2` VARCHAR(100), IN `MENSAJE2` TEXT, IN `CORREO2` VARCHAR(100), IN `TELEFONO2` VARCHAR(18), IN `ADMIN` VARCHAR(80))  BEGIN 
	UPDATE cliente SET NOMBRE=NOMBRE2, MENSAJE=MENSAJE2, CORREO=CORREO2, TELEFONO=TELEFONO2 WHERE NUMERO_CLIENTE=NUMERO_CLIENTE2;
    INSERT INTO ediciones(CORREO, NUMERO_CLIENTE) VALUES (ADMIN, NUMERO_CLIENTE2);
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se realizo un edicion en el cliente: ', NUMERO_CLIENTE2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_INFORMACION` (IN `NUMERO_INFO2` INT, IN `NOSOTROS2` TEXT, IN `CONTACTO2` TEXT, IN `ADMIN` VARCHAR(80))  BEGIN 
	UPDATE informacion SET NOSOTROS=NOSOTROS2, CONTACTO=CONTACTO2 WHERE NUMERO_INFO=NUMERO_INFO2;
    INSERT INTO actualiza(CORREO, NUM_INFO) VALUES (ADMIN, NUMERO_INFO2);
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, 'Se ha realizado una acción en la tabla informacion', NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PUBLICIDAD` (`CODIGO2` INT, `NOMBRE2` VARCHAR(80), `TIPO2` VARCHAR(40), `DESCRIPCION2` TEXT, `PRECIO2` FLOAT, `IMAGEN2` VARCHAR(255), `ADMIN` VARCHAR(80))  BEGIN 
	IF (PRECIO2>=0) THEN 
    	UPDATE publicidad SET NOMBRE=NOMBRE2, TIPO=TIPO2, DESCRIPCION=DESCRIPCION2, PRECIO2=PRECIO, IMAGEN=IMAGEN2 WHERE CODIGO=CODIGO2;
        INSERT INTO crud(CODIGOPUBLICIDAD, CORREO) VALUES (CODIGO2, ADMIN);
        INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se ha actualizado el producto', CODIGO2), NOW());
        SELECT TRUE;
    ELSE
    	SELECT FALSE;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualiza`
--

CREATE TABLE `actualiza` (
  `num_act` int(11) NOT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `num_info` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actualiza`
--

INSERT INTO `actualiza` (`num_act`, `correo`, `num_info`) VALUES
(1, 'aulio.cerrato@gmail.com', 1),
(2, 'aulio.cerrato@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `correo` varchar(80) NOT NULL,
  `contrasenia` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`correo`, `contrasenia`) VALUES
('aulio.cerrato@gmail.com', 'ÀáJAû0ùKp\"{Ù');

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

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`num_bitacora`, `correo_adm`, `descripcion`, `fecha`) VALUES
(1, 'aulio.cerrato@gmail.com', 'Hola', '2018-03-01'),
(2, 'aulio.cerrato@gmail.com', 'Se ha eliminado el administrador: arles.cerrato@gmail.com', '2018-03-31'),
(3, 'aulio.cerrato@gmail.com', 'Se ha eliminado el administrador: jorge.alvarez@gmail.com', '2018-03-31'),
(4, 'aulio.cerrato@gmail.com', 'Se realizo un edicion en el cliente: 1', '2018-03-31'),
(5, 'aulio.cerrato@gmail.com', 'Se ha eliminado el cliente: 5', '2018-04-01'),
(6, 'aulio.cerrato@gmail.com', 'Se ha eliminado el cliente: 6', '2018-04-01'),
(7, 'aulio.cerrato@gmail.com', 'Se ha realizado una acción en la tabla informacion', '2018-04-02'),
(8, 'aulio.cerrato@gmail.com', 'Se ha eliminado el administrador: arles.cerrato@gmail.com', '2018-04-02'),
(9, 'aulio.cerrato@gmail.com', 'Se ha eliminado el cliente: 7', '2018-04-05'),
(10, 'aulio.cerrato@gmail.com', 'Se realizo un edicion en el cliente: 1', '2018-04-05'),
(11, 'aulio.cerrato@gmail.com', 'Se ha realizado una acción en la tabla informacion', '2018-04-05');

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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`numero_cliente`, `fecha`, `nombre`, `mensaje`, `correo`, `telefono`) VALUES
(1, '2018-03-02', 'Aulio', 'Hola soy Goku', 'arles.cerrato@gmail.com', '9583587589'),
(8, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(10, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(11, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(12, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(13, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(14, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(15, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(16, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(17, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(18, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(19, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(20, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(21, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(22, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(23, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(24, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423'),
(25, '2018-03-09', 'fdjshfsj', 'nfdsjfnsjdnfsdjhfdjhdsj', 'fdhjfdshj', '42432423');

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

--
-- Volcado de datos para la tabla `ediciones`
--

INSERT INTO `ediciones` (`num_ediciones`, `numero_cliente`, `correo`) VALUES
(5, NULL, 'aulio.cerrato@gmail.com'),
(6, NULL, 'aulio.cerrato@gmail.com'),
(7, NULL, 'aulio.cerrato@gmail.com'),
(8, NULL, 'aulio.cerrato@gmail.com'),
(9, 1, 'aulio.cerrato@gmail.com'),
(10, 1, 'aulio.cerrato@gmail.com'),
(11, 1, 'aulio.cerrato@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `numero_info` int(11) NOT NULL,
  `nosotros` text NOT NULL,
  `contacto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`numero_info`, `nosotros`, `contacto`) VALUES
(1, 'Hola de nuevo', 'Hola');

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

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`codigo`, `nombre`, `tipo`, `descripcion`, `precio`, `imagen`) VALUES
(1221, 'Chocolates', 'Golosina', 'fhdasjfhdsjafhasdjfhsjadkhfdsjka', 21, 'chocolate.jpg');

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualiza`
--
ALTER TABLE `actualiza`
  ADD PRIMARY KEY (`num_act`),
  ADD KEY `correo` (`correo`),
  ADD KEY `num_info` (`num_info`);

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`num_bitacora`),
  ADD KEY `correo_adm` (`correo_adm`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`numero_cliente`);

--
-- Indices de la tabla `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`num_crud`),
  ADD KEY `codigoPublicidad` (`codigoPublicidad`),
  ADD KEY `correo` (`correo`);

--
-- Indices de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  ADD PRIMARY KEY (`num_ediciones`),
  ADD KEY `numero_cliente` (`numero_cliente`),
  ADD KEY `correo` (`correo`);

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`numero_info`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualiza`
--
ALTER TABLE `actualiza`
  MODIFY `num_act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `num_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `numero_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `crud`
--
ALTER TABLE `crud`
  MODIFY `num_crud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  MODIFY `num_ediciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `numero_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actualiza`
--
ALTER TABLE `actualiza`
  ADD CONSTRAINT `actualiza_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `administrador` (`correo`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `actualiza_ibfk_2` FOREIGN KEY (`num_info`) REFERENCES `informacion` (`numero_info`) ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`correo_adm`) REFERENCES `administrador` (`correo`) ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Filtros para la tabla `crud`
--
ALTER TABLE `crud`
  ADD CONSTRAINT `crud_ibfk_1` FOREIGN KEY (`codigoPublicidad`) REFERENCES `publicidad` (`codigo`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `crud_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `administrador` (`correo`) ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Filtros para la tabla `ediciones`
--
ALTER TABLE `ediciones`
  ADD CONSTRAINT `ediciones_ibfk_1` FOREIGN KEY (`numero_cliente`) REFERENCES `cliente` (`numero_cliente`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `ediciones_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `administrador` (`correo`) ON UPDATE CASCADE ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
