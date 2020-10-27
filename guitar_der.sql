-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2020 a las 08:33:43
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guitar_der`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`` PROCEDURE `dataDashboard` ()  BEGIN
    
    	DECLARE usuarios int;
        DECLARE cliente int;
        DECLARE producto int;
        DECLARE ventas int;
        
        SELECT COUNT(*) INTO usuarios FROM empleados WHERE status != 10;
         SELECT COUNT(*) INTO cliente FROM clientes WHERE status != 10;
           SELECT COUNT(*) INTO producto FROM productos WHERE status != 10;
            SELECT COUNT(*) INTO ventas FROM factura WHERE status = 'Pendiente';
            
            SELECT usuarios,cliente,producto,ventas;
            
            
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `fecha_reg` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `cedula`, `nombres`, `apellidos`, `correo`, `clave`, `telefono`, `celular`, `direccion`, `genero`, `fecha_reg`, `status`) VALUES
(1, '1007522311', 'Jhon', 'Rodriguez', 'jhonerom0711@gmail.com', '96e79218965eb72c92a549dd5a330112', '3812572', '3215345757', 'mi casa', 'Masculino', '2020-09-23 15:15:26', 1),
(3, '1007522302', 'Hallison Fernanda', 'Rodriguez Montealegre', 'hallfer0711@gmail.com', '96e79218965eb72c92a549dd5a330112', '', '3146353339', 'mi casa', 'Femenino', '2020-09-24 22:46:00', 1),
(4, '212121', 'ewewewe', 'ewewe', 'ewewew@gmail.com\r\n', '212121', '212121', '212121', 'wewe323', 'Masculino', '2020-09-24 23:27:22', 1),
(5, '22222', 'eeeee', 'eeeeee', 'wqwwq@gmail.com', 'b71c9af2d2e51b0033e831169713f8d9', '323232', '323232', '654554', 'Masculino', '2020-10-01 13:02:10', 1),
(6, '1111111111', 'ana', 'rodriguez', 'ana@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '45612312', '123456784', 'su casa', 'Femenino', '2020-10-01 15:06:32', 0),
(7, '121212', 'wqwqwqwq', 'sasasasa', 'dsds@gmail.com', '138bf2cb71c788b3608e0f416635d4ea', '3235454656', '7645454', 'mi casa', 'Femenino', '2020-10-01 15:08:13', 0),
(8, '1004522365', 'Michael', 'Millan Montealegre', 'studyttwork@gmail.com', '96e79218965eb72c92a549dd5a330112', '', '2315647891', 'su casa', 'Masculino', '2020-10-07 17:59:13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` int(11) NOT NULL,
  `noFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(12,2) NOT NULL,
  `descargado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`correlativo`, `noFactura`, `idProducto`, `cantidad`, `precioUnitario`, `descargado`) VALUES
(1, 10, 67, 1, '200000.00', 0),
(2, 10, 68, 1, '180000.00', 0),
(3, 11, 67, 1, '200000.00', 0),
(4, 11, 68, 1, '180000.00', 0),
(5, 12, 67, 1, '200000.00', 0),
(6, 12, 68, 1, '180000.00', 0),
(7, 13, 67, 1, '200000.00', 0),
(8, 13, 68, 1, '180000.00', 0),
(9, 14, 67, 1, '200000.00', 0),
(10, 14, 68, 1, '180000.00', 0),
(18, 15, 66, 1, '200000.00', 0),
(19, 15, 67, 1, '200000.00', 0),
(20, 15, 68, 1, '180000.00', 0),
(21, 15, 69, 1, '250000.00', 0),
(22, 15, 70, 1, '180000.00', 0),
(23, 15, 74, 1, '800000.00', 0),
(24, 16, 66, 1, '200000.00', 0),
(25, 16, 67, 1, '200000.00', 0),
(26, 16, 68, 1, '180000.00', 0),
(27, 16, 69, 1, '250000.00', 0),
(28, 16, 70, 1, '180000.00', 0),
(29, 16, 74, 1, '800000.00', 0),
(30, 17, 66, 1, '200000.00', 0),
(31, 17, 67, 1, '200000.00', 0),
(32, 17, 68, 1, '180000.00', 0),
(33, 17, 69, 1, '250000.00', 0),
(34, 17, 70, 1, '180000.00', 0),
(35, 17, 74, 1, '800000.00', 0),
(36, 18, 66, 1, '200000.00', 0),
(37, 18, 67, 1, '200000.00', 0),
(38, 18, 68, 1, '180000.00', 0),
(39, 18, 69, 1, '250000.00', 0),
(40, 18, 70, 1, '180000.00', 0),
(41, 18, 74, 1, '800000.00', 0),
(42, 19, 66, 1, '200000.00', 0),
(43, 19, 70, 1, '180000.00', 0),
(44, 19, 67, 1, '200000.00', 0),
(45, 20, 66, 1, '200000.00', 0),
(46, 20, 70, 1, '180000.00', 0),
(47, 20, 67, 1, '200000.00', 0),
(48, 21, 66, 1, '200000.00', 0),
(49, 21, 70, 1, '180000.00', 0),
(50, 21, 67, 1, '200000.00', 0),
(51, 22, 66, 1, '200000.00', 0),
(52, 22, 70, 1, '180000.00', 0),
(53, 22, 67, 1, '200000.00', 0),
(54, 23, 66, 1, '200000.00', 0),
(55, 23, 70, 1, '180000.00', 0),
(56, 23, 67, 1, '200000.00', 0),
(57, 24, 66, 1, '200000.00', 0),
(58, 24, 70, 1, '180000.00', 0),
(59, 24, 67, 1, '200000.00', 0),
(60, 25, 66, 1, '200000.00', 0),
(61, 25, 70, 1, '180000.00', 0),
(62, 25, 67, 1, '200000.00', 0),
(63, 26, 66, 1, '200000.00', 0),
(64, 26, 70, 1, '180000.00', 0),
(65, 26, 67, 1, '200000.00', 0),
(66, 27, 66, 1, '200000.00', 0),
(67, 27, 70, 1, '180000.00', 0),
(68, 27, 67, 1, '200000.00', 0),
(69, 28, 66, 1, '200000.00', 0),
(70, 28, 70, 1, '180000.00', 0),
(71, 28, 67, 1, '200000.00', 0),
(72, 29, 66, 1, '200000.00', 0),
(73, 29, 70, 1, '180000.00', 0),
(74, 29, 67, 1, '200000.00', 0),
(75, 30, 66, 1, '200000.00', 0),
(76, 30, 70, 1, '180000.00', 0),
(77, 30, 67, 1, '200000.00', 0),
(78, 31, 66, 1, '200000.00', 0),
(79, 31, 70, 1, '180000.00', 0),
(80, 31, 67, 1, '200000.00', 0),
(81, 32, 66, 1, '200000.00', 0),
(82, 32, 70, 1, '180000.00', 0),
(83, 32, 67, 1, '200000.00', 0),
(84, 33, 66, 1, '200000.00', 0),
(85, 33, 70, 1, '180000.00', 0),
(86, 33, 67, 1, '200000.00', 0),
(87, 34, 66, 1, '200000.00', 0),
(88, 34, 70, 1, '180000.00', 0),
(89, 34, 67, 1, '200000.00', 0),
(90, 35, 66, 1, '200000.00', 0),
(91, 35, 70, 1, '180000.00', 0),
(92, 35, 67, 1, '200000.00', 0),
(93, 36, 66, 1, '200000.00', 0),
(94, 36, 70, 1, '180000.00', 0),
(95, 36, 67, 1, '200000.00', 0),
(96, 37, 66, 1, '200000.00', 0),
(97, 37, 70, 1, '180000.00', 0),
(98, 37, 67, 1, '200000.00', 0),
(99, 38, 66, 1, '200000.00', 0),
(100, 38, 70, 1, '180000.00', 0),
(101, 38, 67, 1, '200000.00', 0),
(102, 39, 66, 1, '200000.00', 0),
(103, 39, 70, 1, '180000.00', 0),
(104, 39, 67, 1, '200000.00', 0),
(105, 40, 66, 1, '200000.00', 0),
(106, 40, 70, 1, '180000.00', 0),
(107, 40, 67, 1, '200000.00', 0),
(108, 41, 66, 1, '200000.00', 0),
(109, 41, 70, 1, '180000.00', 0),
(110, 41, 67, 1, '200000.00', 0),
(111, 42, 66, 1, '200000.00', 0),
(112, 42, 70, 1, '180000.00', 0),
(113, 42, 67, 1, '200000.00', 0),
(114, 43, 66, 1, '200000.00', 0),
(115, 43, 70, 1, '180000.00', 0),
(116, 43, 67, 1, '200000.00', 0),
(117, 44, 66, 1, '200000.00', 0),
(118, 44, 70, 1, '180000.00', 0),
(119, 44, 67, 1, '200000.00', 0),
(120, 45, 66, 1, '200000.00', 0),
(121, 45, 70, 1, '180000.00', 0),
(122, 45, 67, 1, '200000.00', 0),
(123, 46, 66, 1, '200000.00', 0),
(124, 46, 70, 1, '180000.00', 0),
(125, 46, 67, 1, '200000.00', 0),
(126, 47, 66, 1, '200000.00', 0),
(127, 47, 70, 1, '180000.00', 0),
(128, 47, 67, 1, '200000.00', 0),
(129, 48, 66, 1, '200000.00', 0),
(130, 48, 70, 1, '180000.00', 0),
(131, 48, 67, 1, '200000.00', 0),
(132, 49, 66, 1, '200000.00', 0),
(133, 49, 70, 1, '180000.00', 0),
(134, 49, 67, 1, '200000.00', 0),
(135, 50, 66, 1, '200000.00', 0),
(136, 50, 70, 1, '180000.00', 0),
(137, 50, 67, 1, '200000.00', 0),
(138, 51, 66, 1, '200000.00', 0),
(139, 51, 70, 1, '180000.00', 0),
(140, 51, 67, 1, '200000.00', 0),
(141, 52, 68, 1, '180000.00', 0),
(142, 53, 68, 1, '180000.00', 0),
(143, 54, 66, 1, '200000.00', 0),
(144, 54, 67, 1, '200000.00', 0),
(145, 55, 70, 1, '180000.00', 0),
(146, 55, 77, 1, '1200000.00', 0),
(147, 56, 77, 1, '1200000.00', 0),
(148, 56, 82, 1, '1500000.00', 0),
(149, 56, 84, 1, '9999999999.99', 0),
(150, 57, 84, 1, '2000000.00', 0),
(151, 57, 77, 1, '1200000.00', 0),
(152, 57, 82, 1, '1500000.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idUsuario` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idUsuario`, `cedula`, `nombres`, `apellidos`, `clave`, `rol`, `correo`, `telefono`, `genero`, `status`) VALUES
(1, '1007522311', 'Jhon Eider', 'Rodriguez Montealegre', 'e10adc3949ba59abbe56e057f20f883e', 1, 'jerodriguez113@misena.edu.co', '2315345757', 'Masculino', 1),
(4, '1007522302', 'Hallison Fernanda', 'Rodriguez Montealegre', 'e10adc3949ba59abbe56e057f20f883e', 2, 'hallfer0711@gmail.com', '3146943432', 'Femenino', 0),
(6, '1109191627', 'Sergio ', 'Gomez', 'e10adc3949ba59abbe56e057f20f883e', 3, 'sergio@gmail.com', '2310154875', 'Masculino', 0),
(7, '212121', 'sasasa', 'sasasasa', '93279e3308bdbbeed946fc965017f67a', 2, 'hallfere0711@gmail.com', '2121', 'Masculino', 0),
(8, '1007522365', 'marta', 'ramirez', 'e10adc3949ba59abbe56e057f20f883e', 3, 'marta@gmail.com', '7894561', 'Femenino', 0),
(9, '76767676', 'fdsdrfdf', 'fdfdfdf', '07faa34fdb6abd3c75c2d810fbf88266', 1, 'vcvcvcvc@gmail.com', '22323232', 'Masculino', 0),
(10, '989090', 'ewewdsccd', 'ewewew', '4768fc31e6c740901e817aab74ff86a5', 3, 'alana@gmail.com', '43434343', 'Femenino', 0),
(11, '878787', 'uuyuyuy', 'ghjjhjhjh', '65b20e102f369c75c169aef14d2fb9f6', 3, 'jhon@gmail.com', '54545454', 'Masculino', 0),
(12, '2121121212', 'Fernanda', 'montealegre', 'e10adc3949ba59abbe56e057f20f883e', 2, 'fernanda@gmail.com', '1323223', 'Femenino', 1),
(13, '1222244231', 'Eider', 'Montealegre', 'e10adc3949ba59abbe56e057f20f883e', 3, 'eider@gmail.com', '342323232', 'Masculino', 1),
(14, '1234567890', 'Edwan Mateo', ' Rozo Paez', 'e10adc3949ba59abbe56e057f20f883e', 2, 'mateo@gmail.com', '2316548970', 'Masculino', 1),
(15, '3123123', 'kjkjk', 'kjkjk', 'c3070855901a7c087c9c06aa155a732b', 1, 'lfdffd@gmail.com', '32323232', 'Masculino', 0),
(16, '43434', 'Hallison', 'ewewew', 'e10adc3949ba59abbe56e057f20f883e', 1, 'jjhdd@gmail.com', '32145', 'Masculino', 1),
(17, '123', 'Pedro', 'Ramos', 'e10adc3949ba59abbe56e057f20f883e', 2, 'pedro@gmail.com', '321', 'Masculino', 1),
(18, '00000', 'alguien', 'alguien', 'd546d0c01a6ae1ec95a90d12e74cd9e3', 3, 'elguien@gmail.com', '00000', 'Masculino', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `idProductos`, `fecha`, `cantidad`, `precio`) VALUES
(44, 56, '2020-09-20', 40, '120000.00'),
(47, 59, '2020-09-22', 5454, '454545.00'),
(48, 60, '2020-09-22', 43, '200000.00'),
(51, 63, '2020-09-24', 56, '200000.00'),
(52, 64, '2020-09-25', 111, '200000.00'),
(53, 65, '2020-09-27', 21212, '32323.00'),
(54, 66, '2020-09-27', 100, '200000.00'),
(55, 67, '2020-09-27', 100, '200000.00'),
(56, 68, '2020-09-27', 100, '180000.00'),
(57, 69, '2020-09-27', 100, '250000.00'),
(58, 70, '2020-09-27', 100, '180000.00'),
(59, 71, '2020-09-27', 25, '750000.00'),
(60, 72, '2020-09-28', 25, '560000.00'),
(61, 73, '2020-09-28', 25, '600000.00'),
(62, 74, '2020-09-28', 25, '800000.00'),
(63, 75, '2020-09-28', 25, '680000.00'),
(64, 76, '2020-10-01', 2222, '200000.00'),
(65, 77, '2020-10-03', 100, '1200000.00'),
(66, 78, '2020-10-03', 100, '1300000.00'),
(67, 79, '2020-10-03', 100, '1000000.00'),
(68, 80, '2020-10-03', 100, '320000.00'),
(69, 81, '2020-10-03', 100, '800000.00'),
(70, 82, '2020-10-03', 100, '1500000.00'),
(71, 83, '2020-10-04', 100, '1800000.00'),
(72, 84, '2020-10-04', 100, '1500000.00'),
(73, 85, '2020-10-07', 100, '2150000.00'),
(74, 86, '2020-10-07', 100, '1900000.00'),
(75, 87, '2020-10-07', 3, '800000.00'),
(76, 88, '2020-10-07', 1, '350000.00'),
(77, 89, '2020-10-07', 2, '1000000.00'),
(78, 90, '2020-10-07', 100, '2100000.00'),
(79, 91, '2020-10-07', 100, '150000.00'),
(80, 92, '2020-10-07', 100, '150000.00'),
(81, 93, '2020-10-07', 100, '150000.00'),
(82, 94, '2020-10-07', 100, '400000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `noFactura` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `usuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `claveTransaccion` varchar(250) NOT NULL,
  `correoCliente` varchar(400) NOT NULL,
  `metodoPago` varchar(100) NOT NULL,
  `totalFactura` decimal(12,2) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`noFactura`, `fecha`, `usuario`, `idCliente`, `claveTransaccion`, `correoCliente`, `metodoPago`, `totalFactura`, `status`) VALUES
(1, '0000-00-00', 1, 1, '12345678910', 'jhonerom0711@gmail.com', 'Visa', '700000.00', 'Pendiente'),
(2, '0000-00-00', 1, 1, '12345678910', 'jhonerom0711@gmail.com', 'Visa', '700000.00', 'Pendiente'),
(3, '2020-10-07', 1, 3, 'uu0elq4bajo5kf86i0r3vooim8', 'hallfer0711@gmail.com', 'Amazon Pay', '200000.00', 'Pendiente'),
(6, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PAYPAL', '200000.00', 'Pendiente'),
(7, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'pppppp', '200000.00', 'Pendiente'),
(8, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '200000.00', 'Pendiente'),
(9, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(10, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '380000.00', 'Pendiente'),
(11, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '380000.00', 'Pendiente'),
(12, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '380000.00', 'Pendiente'),
(13, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '380000.00', 'Pendiente'),
(14, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '380000.00', 'Pendiente'),
(15, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '1810000.00', 'Pendiente'),
(16, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '1810000.00', 'Pendiente'),
(17, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '1810000.00', 'Pendiente'),
(18, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '1810000.00', 'Pendiente'),
(19, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(20, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(21, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(22, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(23, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(24, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(25, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(26, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(27, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(28, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(29, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(30, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(31, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(32, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(33, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(34, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(35, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(36, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(37, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(38, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(39, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(40, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(41, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(42, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(43, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(44, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(45, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(46, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(47, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(48, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(49, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(50, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Pendiente'),
(51, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '580000.00', 'Entregado'),
(52, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '180000.00', 'Entregado'),
(53, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '180000.00', 'Pendiente'),
(54, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '400000.00', 'Pendiente'),
(55, '2020-10-07', 1, 1, 'uu0elq4bajo5kf86i0r3vooim8', 'jhonerom0711@gmail.com', 'PayPal', '1380000.00', 'Pendiente'),
(56, '2020-10-07', 1, 3, 'uu0elq4bajo5kf86i0r3vooim8', 'hallfer0711@gmail.com', 'PayPal', '9999999999.99', 'Entregado'),
(57, '2020-10-07', 1, 8, 'uu0elq4bajo5kf86i0r3vooim8', 'studyttwork@gmail.com', 'PayPal', '4700000.00', 'Anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `imagen` text NOT NULL,
  `fecha_reg` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `nombre`, `descripcion`, `precio`, `existencia`, `categoria`, `tipo`, `modelo`, `imagen`, `fecha_reg`, `status`) VALUES
(56, 'Chaqueta de cuero negra', 'chaqueta-old-school-de-cuero-negra', '160000.00', 0, 'Abrigos', 'Guitarras electricas', '', '21_09_2020 - 05_09_47 - _chaqueta.jpg', '2020-09-20 22:44:47', 0),
(59, 'Monitor', '545454', '454545.00', 5454, '4545454', 'Lisas', '', '22_09_2020 - 18_09_42 - _WhatsApp Image 2020-09-14 at 10.18.04.jpeg', '2020-09-22 11:00:42', 0),
(60, 'ewewew', 'dfdfdf', '200000.00', 43, 'dsdsdsd', 'Piel', '', '22_09_2020 - 23_09_57 - _WhatsApp Image 2020-09-14 at 10.18.04.jpeg', '2020-09-22 16:07:57', 0),
(63, 'jhjhjhttttttttttttt', 'ttttttttt', '200000.00', 56, 'Cazadoras hombres', 'Vaqueras', '', '24_09_2020 - 16_09_59 - _abrigo.jpg', '2020-09-24 09:10:59', 0),
(64, 'llllll', 'llklklklk', '200000.00', 111, 'Pantalones hombres', 'Bombber', '', '25_09_2020 - 14_09_53 - _abrigo.jpg', '2020-09-25 07:15:53', 0),
(65, 'ewewewee', 'we23wedw', '32323.00', 21212, 'Guitarras', 'Accesorios para bajo', '046539', '28_09_2020 - 03_09_02 - _la-patrie-guitars-motif-qit-guitarra-acustica-premium.jpg', '2020-09-27 20:53:02', 0),
(66, 'LA PATRIE GUITARS MOTIF QIT GUITARRA ACUSTICA PREM', 'La guitarra Motif de La Patrie, toma sus dimensiones compactas de las guitarras de Estudio de princi', '200000.00', 100, 'Guitarras', 'Guitarras acusticas', ' 046539', '28_09_2020 - 03_09_16 - _la-patrie-guitars-motif-qit-guitarra-acustica-premium.jpg', '2020-09-27 20:58:16', 1),
(67, 'EPIPHONE DR-100 EBONY', 'Guitarra con estilo, sonido y calidad que es buscada tanto por principiantes como por los profeciona', '200000.00', 100, 'Guitarras', 'Guitarras acusticas', 'EA10EBCH1', '28_09_2020 - 06_09_23 - _epiphone-dr-100-ebony.jpg', '2020-09-27 23:44:23', 1),
(68, 'EPIPHONE AJ-220S NATURAL', 'Sonido fuerte y características profesionales te trae Epiphone con esta guitarra', '180000.00', 100, 'Guitarras', 'Guitarras acusticas', 'EA22NANH1', '28_09_2020 - 06_09_02 - _epiphone-aj-220s-natural.jpg', '2020-09-27 23:46:02', 1),
(69, 'GUITARRA ACUSTICA CLASICA 30\" COLOR VINO ', 'Fotografía ilustrativa, el producto puede variar.', '250000.00', 100, 'Guitarras', 'Guitarras acusticas', 'INFANTE-WR', '28_09_2020 - 06_09_52 - _guitarra-acustica-clasica-30-color-vino-.jpg', '2020-09-27 23:52:52', 1),
(70, 'EPIPHONE AJ-220S VINTAGE SUNBURST', 'Sonido fuerte y características profesionales te trae Epiphone con esta guitarra', '180000.00', 100, 'Guitarras', 'Guitarras acusticas', ' EA22VSNH3', '28_09_2020 - 06_09_47 - _epiphone-aj-220s-vintage-sunburst.jpg', '2020-09-27 23:54:47', 1),
(71, 'PRS SE KORINA ONE ACABADO VINTAGE AMBER', 'La guitarra más ligera y versátil del mercado. Auténtico cuerpo totalmente de Korina, y diseño exclu', '750000.00', 25, 'Guitarras', 'Guitarras electricas', 'SE1KVA', '28_09_2020 - 06_09_18 - _prs-se-korina-one-acabado-vintage-amber.jpg', '2020-09-27 23:57:18', 1),
(72, 'EPIPHONE GUITARRA ELÉCTRICA EMILY THE STRANGE G310', 'El personaje de internet Emily the Strange creado por la empresa Cosmic Debris, se ha convertido en ', '560000.00', 25, 'Guitarras', 'Guitarras electricas', 'EGG1ESCH1', '28_09_2020 - 07_09_04 - _guitarra-emily-the-strange-g310with-gigbag-strap.jpg', '2020-09-28 00:04:04', 1),
(73, 'EPIPHONE G-400 PRO PARA ZURDO ACABADO CHERRY', 'Experimenta el legendario sonido SG a un precio fantástico. Un modelo zurdo de alta calidad diseñado', '600000.00', 25, 'Guitarras', 'Guitarras electricas', 'EGGPLCHNH1', '28_09_2020 - 07_09_07 - _epiphone-g-400-pro-para-zurdo-acabado-cherry.jpg', '2020-09-28 00:06:07', 1),
(74, 'EPIPHONE LES PAUL STUDIO EBONY', 'Tal como su nombre lo dice, ideal para utilizar en el estudio, modelo clásico y ligero.', '800000.00', 25, 'Guitarras', 'Guitarras electricas', 'ENL1EBCH1', '28_09_2020 - 07_09_54 - _epiphone-les-paul-studio.jpg', '2020-09-28 00:07:54', 1),
(75, 'EPIPHONE ENS-PECH1 GUITARRA LES PAUL STANDARD PELH', 'Fotografía ilustrativa, el producto puede variar.', '680000.00', 25, 'Guitarras', 'Guitarras electricas', ' ENS-PECH1', '28_09_2020 - 07_09_38 - _epiphone-ens-pech1-guitarra-les-paul-standard-pelham-blue-nickel.jpg', '2020-09-28 00:09:38', 1),
(76, 'Monitor', 'wwwww', '200000.00', 2222, 'Bajos', 'Accesorios para guitarra', 'EA10EBCH1', '01_10_2020 - 18_10_56 - _WhatsApp Image 2020-09-14 at 09.19.16.jpeg', '2020-10-01 11:58:56', 0),
(77, 'EPIPHONE EB-3 BASS EBONY', 'El bajo atractivo y distintivo, el SG \r\nque definio el rock.', '1200000.00', 100, 'Bajos', 'Bajos electricos', ' EBG3EBCH1', '04_10_2020 - 02_10_52 - _epiphone-eb-3-bass-ebony.jpg', '2020-10-03 19:49:52', 1),
(78, 'EPIPHONE TOBY DELUXE IV BASS', 'Cuerpo ergonómico, grandes \r\ncaracterísticas y luce impresionante.', '1300000.00', 100, 'Bajos', 'Bajos electricos', 'EBD4TASBH1', '04_10_2020 - 02_10_49 - _epiphone-toby-deluxe-iv-bass.jpg', '2020-10-03 19:55:49', 1),
(79, 'EPIPHONE EB-3 SG ACABADO CHERRY', 'Con un ligero cuerpo de caoba, estilo \r\ncutaway, un sólido brazo de gran \r\nescala y exclusivas pasti', '1000000.00', 100, 'Bajos', 'Bajos electricos', 'EBG3CHCH1', '04_10_2020 - 03_10_23 - _epiphone-eb-3-bajo-sg-color-cherry-hardware-cromado.jpg', '2020-10-03 20:01:23', 1),
(80, 'PEDAL PARA BAJO ELCTRICO HARTKE BASS ATTCAK 2 HPBA', '-Caja directa con preamplificador a \r\nbordo\r\n-Circuito de sobremarcha de emulación \r\nde tubos\r\n-Sali', '320000.00', 100, 'Bajos', 'Pedales para bajo', 'HPBA2', '04_10_2020 - 03_10_26 - _bass-attack-2-preampcaja-directa-con-overdrive.jpg', '2020-10-03 20:04:26', 1),
(81, 'AMPLIFICADOR PEAVEY BANDIT 112', 'El Peavey Bandit 112 tiene salida \r\ndirecta de altavoz simulado, selector \r\nde nivel de potencia de ', '800000.00', 100, 'Guitarras', 'Amplificadores para guitarra', ' BANDIT 112', '04_10_2020 - 03_10_29 - _peavey-bandit-112-amplificador-de-guitarra.jpg', '2020-10-03 20:09:29', 1),
(82, 'MARSHALL MG50CFX COMBO 1X12\" DE 50 WATTS', 'Practico combo para guitarra de 4 \r\ncanales con la calidad insuperable \r\nMarshall, sinónimo de calid', '1500000.00', 100, 'Guitarras', 'Amplificadores para guitarra', 'MG50CFX', '04_10_2020 - 03_10_10 - _marshall-combo-1x12-de-50-watts.jpg', '2020-10-03 20:23:10', 1),
(83, 'AMPEG BA-108V2 1X8 AMPLIFICADOR PARA BAJO', 'El Ampeg BA-108 8\" Bass Combo ofrece \r\nun tono clásico Ampeg perfecto para \r\nla práctica. Su diseño ', '1800000.00', 100, 'Bajos', 'Amplificadiores para bajo', ' BA-108V2', '05_10_2020 - 05_10_16 - _ampeg-ba-108v2-1x8-amplificador-para-bajo.jpg', '2020-10-04 22:37:16', 1),
(84, 'ROLAND RC-300-ROL LOOP STATIONrrrrrr', 'The Triple-Stereo Mega Looper!rrrrrr', '2000000.00', 6, 'Guitarras', 'Pedales para guitarra', 'RC-300-ROLrrrr', '05_10_2020 - 05_10_56 - _roland-rc-300-rol-loop-station.jpg', '2020-10-04 22:40:56', 1),
(85, 'FENDER 2370500000 RUMBLE 200 V3', 'El combo Fender Rumble 200 es un \r\namplificador de bajo grande pero \r\nliviano con un sonido grande y', '2150000.00', 100, 'Guitarras', 'Amplificadores para guitarra', '2370500000', '08_10_2020 - 05_10_46 - _fender-2370500000-rumble-200-v3.jpg', '2020-10-07 22:12:46', 1),
(86, 'MARSHALL MG15CFXMS MICRO STACK', 'El MG15CFXMS Micro-stack consiste en \r\nuna cabina de fondo recto con cabina \r\nsuperior angulada, Marshall añade un \r\ncabezal en la parte superior, además \r\nel MG15CFX tiene combo con cuatro \r\ncanales: Clean, Crunch, OD1 y OD2 y \r\nEQ, Reverb, Chorus, Phaser, Flanger, \r\nDelay (tap-tempo) y Octave ), FX \r\ndigital y función de memoria.', '1900000.00', 100, 'Guitarras', 'Amplificadores para guitarra', 'MG15CFXMS', '08_10_2020 - 05_10_08 - _marshall-mg15cfxms-micro-stack.jpg', '2020-10-07 22:19:08', 1),
(87, 'IBANEZ TMB100-BK BAJO ELECTRICO', 'Precio exclusivo de Tienda En Línea \r\n(no valido en sucursales).\r\nLos precios pueden variar sin previo \r\naviso.\r\nArticulo sujeto a disponibilidad.\r\nFotografía ilustrativa, el producto \r\npuede variar.', '800000.00', 3, 'Bajos', 'Bajos electricos', 'TMB100-BK', '08_10_2020 - 05_10_04 - _ibanez-tmb100-bk-bajo-electrico.jpg', '2020-10-07 22:22:04', 1),
(88, 'PEAVEY HEADLINER CABEZAL AMPLIFICADOR DE 600 WATTS', 'Ligero cabezal amplificador para bajo \r\ncon estructura resistente, e ingeniería \r\nde punta que le dará a tu bajo \r\nverdadera potencia sonora.', '350000.00', 1, 'Bajos', 'Amplificadiores para bajo', 'HEADLINER BASS HEAD', '08_10_2020 - 05_10_16 - _peavey-headliner-bass-head-amplificador-para-bajo-de-600-watts.jpg', '2020-10-07 22:24:16', 1),
(89, 'AMPEG BA-115V2 1X15 AMPLIFICADOR PARA BAJO', 'El amplificador combo bajo Ampeg BA-\r\n115 ha sido rediseñado. Apreciaras el \r\nmonitoreo más enfocado gracias a la \r\nnueva cuña de 60 grados, que obtiene \r\nel BA-115 en su posición monitor de \r\nsuelo. Los controles se han \r\ntrasladado a la parte delantera para \r\nun fácil acceso. Para más opciones de \r\ntonales Ampeg ha incluido Ultra \r\nconformación tono Hi/Lo y HF Silencio \r\npara ayudarle a alcanzar su tono.', '1000000.00', 2, 'Bajos', 'Amplificadiores para bajo', 'BA-115V2', '08_10_2020 - 05_10_56 - _ampeg-ba-115v2-1x15-amplificador-para-bajo.jpg', '2020-10-07 22:25:56', 1),
(90, 'AMPEG PF-210HE AMPLIFICADOR DE BAJO', 'Precio exclusivo de Tienda En Línea \r\n(no valido en sucursales).\r\nLos precios pueden variar sin previo \r\naviso.\r\nArticulo sujeto a disponibilidad.\r\nFotografía ilustrativa, el producto \r\npuede variar.', '2100000.00', 100, 'Bajos', 'Amplificadiores para bajo', ' PF-210HE', '08_10_2020 - 05_10_56 - _ampeg-pf-210he-amplificador-de-bajo-.jpg', '2020-10-07 22:28:56', 1),
(91, 'DIGITECH RP55 PROCESADOR MULTIEFECTOS PARA GUITARR', 'El pedal RP55 de Digitech es un pedal \r\nmultiefectos para guitarra, equipado \r\ncon 11 modelos de amplificador y 20 \r\nefectos de calidad de estudio. Pueden \r\nutilizarse hasta 8 efectos a la vez \r\npara crear distintas opciones \r\ntonales. Simplemente marca tu opción \r\nde amplificador y ajusta los efectos \r\npredefinidos.', '150000.00', 100, 'Guitarras', 'Pedales para guitarra', 'RP-55', 'img_producto.jpg', '2020-10-07 22:53:48', 0),
(92, 'DIGITECH RP55 PROCESADOR MULTIEFECTOS PARA GUITARR', 'El pedal RP55 de Digitech es un pedal \r\nmultiefectos para guitarra, equipado \r\ncon 11 modelos de amplificador y 20 \r\nefectos de calidad de estudio. Pueden \r\nutilizarse hasta 8 efectos a la vez \r\npara crear distintas opciones \r\ntonales. Simplemente marca tu opción \r\nde amplificador y ajusta los efectos \r\npredefinidos.', '150000.00', 100, 'Guitarras', 'Pedales para guitarra', 'RP-55', 'img_producto.jpg', '2020-10-07 22:54:11', 0),
(93, 'DIGITECH RP55 PROCESADOR MULTIEFECTOS PARA GUITARR', 'El pedal RP55 de Digitech es un pedal \r\nmultiefectos para guitarra, equipado \r\ncon 11 modelos de amplificador y 20 \r\nefectos de calidad de estudio. Pueden \r\nutilizarse hasta 8 efectos a la vez \r\npara crear distintas opciones \r\ntonales. Simplemente marca tu opción \r\nde amplificador y ajusta los efectos \r\npredefinidos.', '150000.00', 100, 'Guitarras', 'Pedales para guitarra', 'RP-55', 'img_producto.jpg', '2020-10-07 22:56:12', 0),
(94, 'DIGITECH ELEMENT PEDAL MULTI-EFECTOS', 'Es un procesador potente y compacto \r\nmulti-efecto. Con un diseño de estilo \r\npedalera simple y editor, se puede \r\najustar rápidamente la configuración \r\npara adaptarse a tu estilo.', '420000.00', 100, 'Guitarras', 'Pedales para guitarra', 'ELMT', '08_10_2020 - 06_10_29 - _epiphone-dr-100-ebony.jpg', '2020-10-07 23:02:47', 0);

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `productos` FOR EACH ROW BEGIN
INSERT INTO entradas(idProductos, cantidad, precio)
VALUES(new.idProductos, new.existencia, new.precio);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `noFactura` (`noFactura`,`idProducto`) USING BTREE,
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `rol` (`rol`) USING BTREE;

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `idProductos` (`idProductos`) USING BTREE;

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`noFactura`),
  ADD KEY `usuario` (`usuario`) USING BTREE,
  ADD KEY `idCliente` (`idCliente`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `noFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRoles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`noFactura`) REFERENCES `factura` (`noFactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProductos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`idRoles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
