-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-12-2015 a las 20:17:09
-- Versión del servidor: 5.5.24-log
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `razonsocial`, `rfc`, `direccion`, `email`, `telefono`, `celular`) VALUES
(6, 'Saupurein Marcos', '20315524661', NULL, '', '', NULL),
(7, 'El pueblito S.A', '468198654', NULL, '', '', NULL),
(8, 'Capability S.A', '2342355', NULL, '', '', NULL),
(9, 'Ventura & Cía', '54555', NULL, '', '', NULL),
(10, 'daniela', '8398398', 'iqweuoqd', 'iajoiwjd', 'aoidjowi', '098098'),
(11, 'daniela', '8398398', 'iqweuoqd', 'iajoiwjd', 'aoidjowi', '098098'),
(12, 'elora', '23423487', 'oijoij', 'oijoi', '8798', '9879'),
(13, 'rooster', '9678687', 'jgyg', 'uyguyg', '76876', '8768'),
(14, 'cenizas', '354787', 'jhgj', 'uyguy', 'uyg', 'uyg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbempresaclientes`
--

CREATE TABLE IF NOT EXISTS `dbempresaclientes` (
  `idempresacliente` int(11) NOT NULL AUTO_INCREMENT,
  `refempresa` int(11) NOT NULL,
  `refcliente` int(11) NOT NULL,
  PRIMARY KEY (`idempresacliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbempresaclientes`
--

INSERT INTO `dbempresaclientes` (`idempresacliente`, `refempresa`, `refcliente`) VALUES
(1, 2, 11),
(2, 1, 12),
(3, 1, 13),
(4, 1, 14);

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
  `notaria` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `notario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `socia_a` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `socio_b` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comisario` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apoderado` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rpp` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `plataforma` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasenia` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `giro` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `objetoempresa` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `administrador` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbempresas`
--

INSERT INTO `dbempresas` (`idempresa`, `razonsocial`, `rfc`, `direccion`, `email`, `telefono`, `celular`, `notaria`, `notario`, `socia_a`, `socio_b`, `comisario`, `apoderado`, `rpp`, `plataforma`, `usuario`, `contrasenia`, `giro`, `objetoempresa`, `administrador`) VALUES
(1, 'Marcos', '16516894', 'asdamsdomo', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(2, 'uuuuuuuuuu', 'iiiii', 'uiui', 'etjej', '565y56', 'y56y56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5656yg56h', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbempresasbancos`
--

CREATE TABLE IF NOT EXISTS `dbempresasbancos` (
  `idempresabanco` int(11) NOT NULL AUTO_INCREMENT,
  `refempresa` int(11) NOT NULL,
  `banco` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sucursal` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuenta` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idempresabanco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `dbfacturas`
--

INSERT INTO `dbfacturas` (`idfactura`, `nrofactura`, `fecha`, `refcliente`, `importebruto`, `iva`, `total`, `refempresa`, `concepto`) VALUES
(7, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(8, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(9, '', '0000-00-00', 0, '0.00', '0.00', '0.00', 0, ''),
(10, 'MR035', '2015-09-24', 7, '9500.00', '1520.00', '11020.00', 1, '12 cajones de Heineken'),
(11, 'MR045', '2015-09-30', 9, '65000.00', '10400.00', '75400.00', 1, 'asdqwqwd'),
(14, 'h5hyt', '2015-10-13', 6, '1587521.00', '254003.36', '1841524.36', 2, 'rthyth56h'),
(15, 'tt55', '2015-10-21', 11, '1050587.00', '168093.92', '1218680.92', 2, 'reg43g4'),
(16, 'rr566', '2015-10-24', 11, '56789.00', '9086.24', '65875.24', 2, 'dgeargaerg'),
(17, 'wieru', '2015-11-05', 12, '458000.00', '73280.00', '531280.00', 1, 'wefwe'),
(18, 'wer23', '2015-10-15', 12, '5679000.00', '908640.00', '6587640.00', 1, 'sdfsdf'),
(19, 'wefw3', '2015-10-09', 12, '2300000.00', '368000.00', '2668000.00', 1, 'asdasdwqw'),
(20, 'grtry', '2015-11-03', 13, '405444.00', '64871.04', '470315.04', 1, 'sasdasdas'),
(21, 'asdas', '2015-11-04', 14, '34534636.00', '999999.99', '40060177.76', 1, 'efwefwef'),
(22, 'ee44', '2015-11-01', 13, '899000.00', '143840.00', '1042840.00', 1, 'sdfsdf'),
(23, 'sdfsd', '2015-11-06', 12, '234.00', '37.44', '271.44', 1, 'sdf'),
(24, 'asdas', '2015-11-12', 12, '565.00', '90.40', '655.40', 1, 'asdas23'),
(25, 'asdq3', '2015-11-11', 12, '345.00', '55.20', '400.20', 1, 'sdfsewef'),
(26, 'uikui', '2015-11-26', 12, '888.00', '142.08', '1030.08', 1, 'dfgdr'),
(27, 'qqqq2', '2015-11-12', 12, '555555.00', '88888.80', '644443.80', 1, 'asdawqw2323'),
(28, 'sdfr5', '2015-11-19', 12, '456456.00', '73032.96', '529488.96', 1, 'sdfsdf'),
(29, '4r34r', '2015-11-23', 12, '677867.00', '108458.72', '786325.72', 1, 'sdfsdf'),
(30, 'sdf43', '2015-11-12', 12, '56456.00', '9032.96', '65488.96', 1, 'sdfsd'),
(31, 'fewew', '2015-11-12', 12, '323423.00', '51747.68', '375170.68', 1, 'asdasd'),
(32, 'asdaw', '2015-11-15', 12, '345345.00', '55255.20', '400600.20', 1, 'asdasd'),
(33, 'wefwe', '2015-10-28', 13, '67567.00', '10810.72', '78377.72', 1, 'asdasd34'),
(34, 'rtrrr', '2015-09-17', 12, '5465645.00', '874503.20', '6340148.20', 1, 'adasd'),
(35, 'asdqw', '2015-12-17', 12, '345767.00', '55322.72', '401089.72', 1, 'fsdfsdf'),
(36, 'sdfwe', '2015-11-12', 12, '456456.00', '73032.96', '529488.96', 1, 'sdfsdf'),
(37, 'ervrf', '2015-11-05', 12, '546456.00', '87432.96', '633888.96', 1, 'fsdf'),
(38, 'yrujy', '2015-11-11', 14, '456456.00', '73032.96', '529488.96', 1, 'sdfsdf'),
(39, 'sdfsd', '2015-11-18', 12, '678678.00', '108588.48', '787266.48', 1, 'sdfsdf'),
(40, 'jyujy', '2015-11-28', 14, '777777343.00', '999999.99', '902221717.88', 1, 'asdasgrweg4534534'),
(41, 'wefwe', '2015-11-12', 14, '456456.00', '73032.96', '529488.96', 1, 'sdasdasd'),
(42, 'grtew', '2015-11-26', 12, '657567.00', '105210.72', '762777.72', 1, 'dsfwewf'),
(43, 'iwjef', '2015-11-13', 12, '58784548.00', '999999.99', '68190075.68', 1, 'hrthrthrth'),
(44, 'ggggg', '2015-11-30', 13, '34534636.00', '999999.99', '40060177.76', 1, 'rgererg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `dbpagos`
--

INSERT INTO `dbpagos` (`idpago`, `fechapago`, `montoapagar`, `referencia`, `comentarios`) VALUES
(2, '2015-10-13', '1000000.00', '74477', 'fffff'),
(3, '2015-10-21', '500000.00', '5t45t', 'ffffffffffff'),
(4, '2015-10-29', '65000.00', 'tytttttt', 'vvvdvdfvdfv'),
(5, '2015-11-05', '2668000.00', 'asdasd342', 'dasd34234'),
(6, '2015-11-05', '500000.00', '34r3', 'asd'),
(7, '2015-11-04', '1042840.00', 'rgergegr', '34t34t34t34t'),
(8, '2015-11-04', '470315.04', 'rgergegr', '34t34t34t34t'),
(14, '0000-00-00', '100.00', 'sdfsdf', 'sdfsdf'),
(15, '2015-11-29', '100.00', 'sdfsdf', 'sdfsdf'),
(16, '2015-11-29', '200.00', 'dsdf', 'sdfsdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `dbpagosfacturas`
--

INSERT INTO `dbpagosfacturas` (`idpagofactura`, `refpago`, `reffactura`, `refestatu`) VALUES
(1, 1, 11, 3),
(2, 2, 14, 2),
(3, 3, 15, 2),
(4, 4, 16, 2),
(5, 5, 19, 3),
(6, 6, 17, 2),
(7, 7, 22, 3),
(8, 8, 20, 3),
(9, 9, 34, 2),
(10, 10, 25, 2),
(11, 11, 25, 2),
(12, 12, 25, 2),
(13, 13, 25, 2),
(14, 16, 25, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'm', 1, 'msredhotero@msn.com', 'Saupurein Marcos'),
(2, '', 'luis', 2, 'luis@msn.com', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador, Capturista, Supervisor'),
(13, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Capturista, Supervisor'),
(16, '../clientes/', 'icoclientes', 'Clientes', 2, NULL, 'Administrador, Capturista, Supervisor'),
(17, '../empresas/', 'icoinmubles', 'Empresas', 3, NULL, 'Administrador, Capturista, Supervisor'),
(18, '../facturas/', 'icoalquileres', 'Facturas', 4, NULL, 'Administrador, Capturista, Supervisor'),
(19, '../pagos/', 'icopagos', 'Pagos', 5, NULL, 'Administrador, Capturista, Supervisor'),
(20, '../usuarios/', 'icousuarios', 'Usuarios', 6, NULL, 'Administrador, Capturista'),
(21, '../reportes/', 'icoreportes', 'Reportes', 10, NULL, 'Administrador, Capturista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestatus`
--

CREATE TABLE IF NOT EXISTS `tbestatus` (
  `idestatu` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestatu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbestatus`
--

INSERT INTO `tbestatus` (`idestatu`, `estatus`) VALUES
(1, 'No Pagado'),
(2, 'Parcial'),
(3, 'Pagado');

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
