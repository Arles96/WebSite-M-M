-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2018 a las 21:47:02
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_CLIENTE` (`NUMERO_CLIENTE2` INT, `ADMIN` VARCHAR(80))  BEGIN
	DELETE FROM cliente WHERE NUMERO_CLIENTE=NUMERO_CLIENTE2;
    INSERT INTO ediciones(CORREO, NUMERO_CLIENTE) VALUES (ADMIN, NUMERO_CLIENTE2);
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se ha eliminado el cliente: ', NUMERO_CLIENTE), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PUBLICIDAD` (`CODIGO2` INT, `ADMIN` VARCHAR(80))  BEGIN 
	DELETE FROM publicidad WHERE CODIGO=CODIGO2;
    INSERT INTO crud(CODIGOPUBLICIDAD, CORREO) VALUES (CODIGO2, ADMIN);
    INSERT INTO bitacora(CORRE_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se elimino la publicidad', CODIGO2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_CLIENTE` (`NOMBRE2` VARCHAR(100), `MENSAJE2` TEXT, `CORREO2` VARCHAR(100), `TELEFONO2` VARCHAR(18))  INSERT INTO cliente(FECHA, NOMBRE, MENSAJE, CORREO, TELEFONO) VALUES (NOW(), NOMBRE2, MENSAJE2, CORREO2, TELEFONO2)$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_ADMINISTRADOR` (`CORREO2` VARCHAR(80), `CORREO3` VARCHAR(80), `CONTRASENIA2` VARCHAR(70), `ADMIN` VARCHAR(80))  BEGIN 
	UPDATE administrador SET CORREO=CORREO3, CONTRASENIA=AES_ENCRYPT(CONTRASENIA2,'CONTRASENIA') WHERE CORREO=CORREO3;
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Ha actualizado los datos del administrador: ', CORREO2), NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_CLIENTE` (`NUMERO_CLIENTE2` INT, `NOMBRE2` VARCHAR(100), `MENSAJE` TEXT, `CORREO2` VARCHAR(100), `TELEFONO2` VARCHAR(18), `ADMIN` VARCHAR(80))  BEGIN 
	UPDATE cliente SET NOMBRE=NOMBRE2, MENSAJE=MENSAJE2, CORREO=CORREO2, TELEFONO=TELEFONO2 WHERE NUMERO_CLIENTE=NUMERO_CLIENTE2;
    INSERT INTO ediciones(CORREO, NUMERO_CLIENTE) VALUES (ADMIN, NUMERO_CLIENTE);
    INSERT INTO bitacora(CORREO_ADM, DESCRIPCION, FECHA) VALUES (ADMIN, CONCAT('Se realizo un edicion en el cliente: ', NUMERO_CLIENTE), NOW());
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
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `num_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `numero_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crud`
--
ALTER TABLE `crud`
  MODIFY `num_crud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  MODIFY `num_ediciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`correo_adm`) REFERENCES `administrador` (`correo`);

--
-- Filtros para la tabla `crud`
--
ALTER TABLE `crud`
  ADD CONSTRAINT `crud_ibfk_1` FOREIGN KEY (`codigoPublicidad`) REFERENCES `publicidad` (`codigo`),
  ADD CONSTRAINT `crud_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `administrador` (`correo`);

--
-- Filtros para la tabla `ediciones`
--
ALTER TABLE `ediciones`
  ADD CONSTRAINT `ediciones_ibfk_1` FOREIGN KEY (`numero_cliente`) REFERENCES `cliente` (`numero_cliente`),
  ADD CONSTRAINT `ediciones_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `administrador` (`correo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
