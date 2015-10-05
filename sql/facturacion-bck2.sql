-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-09-2015 a las 18:58:39
-- Versión del servidor: 5.1.36-community-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `razonsocial`, `rfc`, `direccion`, `email`, `telefono`, `celular`) VALUES
(6, 'Saupurein Marcos', '20315524661', NULL, '', '', NULL),
(7, 'El pueblito S.A', '468198654', NULL, '', '', NULL),
(8, 'Capability S.A', '2342355', NULL, '', '', NULL),
(9, 'Ventura & Cía', '54555', NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbempresas`
--

CREATE TABLE IF NOT EXISTS `dbempresas` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `objetoempresa` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbempresas`
--

INSERT INTO `dbempresas` (`idempresa`, `razonsocial`, `rfc`, `direccion`, `email`, `telefono`, `celular`, `objetoempresa`) VALUES
(1, 'Marcos', '16516894', 'asdamsdomo', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbfacturas`
--

CREATE TABLE IF NOT EXISTS `dbfacturas` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `nrofactura` varchar(5) NOT NULL,
  `fecha` date NOT NULL,
  `refcliente` int(11) NOT NULL,
  `importebruto` decimal(18,2) NOT NULL,
  `iva` decimal(8,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `refempresa` int(11) NOT NULL,
  `concepto` varchar(1000) NOT NULL,
  PRIMARY KEY (`idfactura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `dbfacturas`
--

INSERT INTO `dbfacturas` (`idfactura`, `nrofactura`, `fecha`, `refcliente`, `importebruto`, `iva`, `total`, `refempresa`, `concepto`) VALUES
(7, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(8, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(9, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(10, 'MR035', '2015-09-24', 7, '9500.00', '1520.00', '11020.00', 1, '12 cajones de Heineken'),
(11, 'MR045', '2015-09-30', 9, '65000.00', '10400.00', '75400.00', 1, 'asdqwqwd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpagos`
--

CREATE TABLE IF NOT EXISTS `dbpagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `fechapago` date NOT NULL,
  `montoapagar` decimal(18,2) NOT NULL DEFAULT '0.00',
  `referencia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentarios` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpagosfacturas`
--

CREATE TABLE IF NOT EXISTS `dbpagosfacturas` (
  `idpagofactura` int(11) NOT NULL AUTO_INCREMENT,
  `refpago` int(11) NOT NULL,
  `reffactura` int(11) NOT NULL,
  `refestatu` smallint(6) NOT NULL,
  PRIMARY KEY (`idpagofactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `refroll` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombrecompleto` varchar(70) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'm', 1, 'msredhotero@msn.com', 'Saupurein Marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuariosempresas`
--

CREATE TABLE IF NOT EXISTS `dbusuariosempresas` (
  `idusuarioempresa` int(11) NOT NULL AUTO_INCREMENT,
  `refusuario` int(11) NOT NULL,
  `refempresa` int(11) NOT NULL,
  PRIMARY KEY (`idusuarioempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador, Capturista, Supervisor'),
(13, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Capturista, Supervisor'),
(16, '../clientes/', 'icoclientes', 'Clientes', 2, NULL, 'Administrador, Capturista, Supervisor'),
(17, '../empresas/', 'icoinmubles', 'Empresas', 3, NULL, 'Administrador, Capturista, Supervisor'),
(18, '../facturas/', 'icoalquileres', 'Facturas', 4, NULL, 'Administrador, Capturista, Supervisor'),
(19, '../pagos/', 'icopagos', 'Pagos', 5, NULL, 'Administrador, Capturista, Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestatus`
--

CREATE TABLE IF NOT EXISTS `tbestatus` (
  `idestatu` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestatu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Capturista', b'1'),
(3, 'Supervisor', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
