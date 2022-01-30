-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2021 a las 21:52:53
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `venta1.1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (IN `n_cantidad` INT, IN `n_precio` DECIMAL(10,2), IN `codigo` INT)  BEGIN
DECLARE nueva_existencia int;
DECLARE nuevo_total decimal(10,2);
DECLARE nuevo_precio decimal(10,2);

DECLARE cant_actual int;
DECLARE pre_actual decimal(10,2);

DECLARE actual_existencia int;
DECLARE actual_precio decimal(10,2);

SELECT precio, existencia INTO actual_precio, actual_existencia FROM producto WHERE codproducto = codigo;

SET nueva_existencia = actual_existencia + n_cantidad;
SET nuevo_total = (actual_existencia * actual_precio) + (n_cantidad * n_precio);
SET nuevo_precio = nuevo_total / nueva_existencia;

UPDATE producto SET existencia = nueva_existencia, precio = nuevo_precio WHERE codproducto = codigo;

SELECT nueva_existencia, nuevo_precio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp` (IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))  BEGIN
    DECLARE
        precio_actual DECIMAL(6,2);
    SELECT
        precio
    INTO precio_actual
FROM
    producto
WHERE
    codproducto = codigo ;
INSERT INTO detalle_temp(
    token_user,
    codproducto,
    cantidad,
    precio_venta
)
VALUES(
    token_user,
    codigo,
    cantidad,
    precio_actual
) ;
SELECT
    tmp.correlativo,
    tmp.codproducto,
    p.descripcion,
    tmp.cantidad,
    tmp.precio_venta
FROM
    detalle_temp tmp
INNER JOIN producto p ON
    tmp.codproducto = p.codproducto
WHERE
    tmp.token_user = token_user ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura` (`no_factura` INT)  BEGIN
    	DECLARE existe_factura int;
        DECLARE registros int;
        DECLARE a int;
        
        DECLARE cod_producto int;
        DECLARE cant_producto int;
        DECLARE existencia_actual int;
        DECLARE nueva_existencia int;
        
        SET existe_factura = (SELECT COUNT(*) FROM factura WHERE nofactura = no_factura and estatus = 1);
        IF existe_factura > 0 THEN 
        	CREATE TEMPORARY TABLE tbl_tmp (
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                cod_prod BIGINT,
                cant_prod int);
                
                SET a = 1;
                SET registros = (SELECT COUNT(*) FROM detallefactura WHERE nofactura = no_factura);
                IF registros > 0 THEN
                	INSERT INTO tbl_tmp(cod_prod,cant_prod) SELECT codproducto,cantidad FROM detallefactura WHERE nofactura = no_factura;
                 
                WHILE a <= registros DO
                	SELECT cod_prod,cant_prod INTO cod_producto,cant_producto FROM tbl_tmp WHERE id = a;
                    SELECT existencia INTO existencia_actual FROM producto WHERE codproducto = cod_producto;
                    SET nueva_existencia = existencia_actual + cant_producto;
                    UPDATE producto SET existencia = nueva_existencia WHERE codproducto = cod_producto;
                    SET a=a+1;     
                END WHILE;
                
                UPDATE factura SET estatus = 2 WHERE nofactura = no_factura;
                DROP TABLE tbl_tmp;
                SELECT * FROM factura WHERE nofactura = no_factura;
                
                END IF;                
        ELSE 
        	SELECT 0 factura;
        END IF;
        
     END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `data` ()  BEGIN
DECLARE usuarios int;
DECLARE clientes int;
DECLARE proveedores int;
DECLARE productos int;
DECLARE ventas int;
SELECT COUNT(*) INTO usuarios FROM usuario WHERE estatus = 1;
SELECT COUNT(*) INTO clientes FROM cliente WHERE estatus = 1;
SELECT COUNT(*) INTO proveedores FROM proveedor WHERE estatus= 1;
SELECT COUNT(*) INTO productos FROM producto WHERE estatus= 1;
SELECT COUNT(*) INTO ventas FROM factura WHERE fecha > CURDATE();

SELECT usuarios, clientes, proveedores, productos, ventas;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` VARCHAR(50))  BEGIN
DELETE FROM detalle_temp WHERE correlativo = id_detalle;
SELECT tmp.correlativo, tmp.codproducto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp INNER JOIN producto p ON tmp.codproducto = p.codproducto WHERE tmp.token_user = token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `descuento_producto` (IN `n_precio` INT, IN `codigo` INT)  BEGIN  
DECLARE nuevo_total decimal(6,2);
DECLARE nuevo_precio decimal(6,2);
DECLARE pre_actual decimal(6,2);
DECLARE actual_precio decimal(6,2);
DECLARE descuento int;

SELECT precio, descuento INTO actual_precio,descuento FROM producto WHERE codproducto = codigo;

SET nuevo_total = actual_precio * n_precio / 100;
SET nuevo_precio = actual_precio - nuevo_total ;
SET descuento = 1;
 
UPDATE producto SET precio = nuevo_precio, descuento = descuento WHERE codproducto = codigo;

SELECT nuevo_precio, descuento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
    DECLARE
        factura INT ; DECLARE registros INT ; DECLARE total DECIMAL(10, 2) ; DECLARE nueva_existencia INT ; DECLARE existencia_actual INT ; DECLARE tmp_cod_producto INT ; DECLARE tmp_cant_producto INT ; DECLARE a INT ;
    SET
        a = 1 ;
    CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        cod_prod BIGINT,
        cant_prod INT
    ) ; SET
        registros =(
        SELECT
            COUNT(*)
        FROM
            detalle_temp
        WHERE
            token_user = token
    ) ; IF registros > 0 THEN
INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod)
SELECT
    codproducto,
    cantidad
FROM
    detalle_temp
WHERE
    token_user = token ;
INSERT INTO factura(usuario, codcliente)
VALUES(cod_usuario, cod_cliente) ;
SET
    factura = LAST_INSERT_ID() ;
INSERT INTO detallefactura(
    nofactura,
    codproducto,
    cantidad,
    precio_venta
)
SELECT
    (factura) AS nofactura,
    codproducto,
    cantidad,
    precio_venta
FROM
    detalle_temp
WHERE
    token_user = token ; WHILE a <= registros
DO
SELECT
    cod_prod,
    cant_prod
INTO tmp_cod_producto, tmp_cant_producto
FROM
    tbl_tmp_tokenuser
WHERE
    id = a ;
SELECT
    existencia
INTO existencia_actual
FROM
    producto
WHERE
    codproducto = tmp_cod_producto ;
SET
    nueva_existencia = existencia_actual - tmp_cant_producto ;
UPDATE
    producto
SET
    existencia = nueva_existencia
WHERE
    codproducto = tmp_cod_producto ;
SET
    a = a +1 ;
    END WHILE ;
SET
    total =(
    SELECT
        SUM(cantidad * precio_venta)
    FROM
        detalle_temp
    WHERE
        token_user = token
) ;
UPDATE
    factura
SET
    totalfactura = total
WHERE
    nofactura = factura ;
DELETE
FROM
    detalle_temp
WHERE
    token_user = token ;
TRUNCATE TABLE
    tbl_tmp_tokenuser ;
SELECT
    *
FROM
    factura
WHERE
    nofactura = factura ; ELSE
SELECT
    0 ;
END IF ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte` ()  BEGIN
                DECLARE venta_dia double;
                DECLARE venta_mensual double;
                DECLARE venta_anual double;
                DECLARE venta_total int;
             	
                SELECT SUM(totalfactura) INTO venta_dia FROM factura WHERE date(fecha) = date(curdate());
                SELECT SUM(totalfactura) INTO venta_mensual FROM factura WHERE year(fecha) = year(curdate()) AND month(fecha) = month(curdate());
                SELECT SUM(totalfactura) INTO venta_anual FROM factura WHERE year(fecha) = year(curdate());
                SELECT COUNT(*) INTO venta_total FROM factura WHERE fecha;
                
                SELECT venta_dia, venta_mensual, venta_anual, venta_total;
                
                END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nit` varchar(10) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nit`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(1, '9999999999', 'CF', '999999999', 'Trinipuerto', '2021-01-03 11:54:44', 1, 1),
(2, '0984823848', 'Franklin', '0937483824', 'Trinipuerto', '2021-01-03 11:55:16', 1, 1),
(3, '0981797174', 'Lucia', '0938979321', 'Trinipuerto', '2021-01-03 12:01:03', 1, 1),
(4, '0989178234', 'Rosa', '0997990866', 'Trinipuerto', '2021-01-03 12:31:35', 1, 1),
(5, '0984852394', 'Denisse', '0974836850', 'Trinipuerto', '2021-01-03 12:32:26', 2, 1),
(6, '0958702763', 'Carlos ', '0981797630', 'Trinipuerto', '2021-02-21 12:16:51', 3, 1),
(7, '0934857973', 'Julio', '0981767336', 'Trinipuerto', '2021-02-23 11:43:58', 1, 1),
(8, '0976755723', 'Luis', '0986734252', 'Trinipuerto', '2021-03-07 15:40:31', 1, 1),
(9, '0958702534', 'Valeria', '0943873848', 'Trinipuerto', '2021-03-08 22:08:32', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nit` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nit`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `iva`) VALUES
(1, '0987647412001', 'Farmacia Alejandra', 'Medicina y Más', '0980778074', 'lissettejimenez70@gmail.com', 'Coop Monseñor leonidas Proaño Mz9 Sl 14', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` bigint(11) DEFAULT NULL,
  `codproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_venta` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`correlativo`, `nofactura`, `codproducto`, `cantidad`, `precio_venta`) VALUES
(1, 1, 1, 32, '0.15'),
(2, 2, 1, 13, '0.15'),
(3, 3, 2, 5, '0.15'),
(4, 4, 1, 2, '0.15'),
(5, 4, 2, 5, '0.15'),
(7, 5, 1, 5, '0.15'),
(8, 6, 2, 5, '0.15'),
(9, 7, 3, 5, '0.10'),
(10, 7, 2, 5, '0.15'),
(11, 7, 1, 9, '0.15'),
(12, 8, 3, 5, '0.10'),
(13, 8, 2, 10, '0.15'),
(15, 9, 2, 35, '0.15'),
(16, 10, 18, 2, '0.60'),
(17, 10, 15, 3, '0.50'),
(18, 10, 12, 5, '0.10'),
(19, 10, 6, 1, '7.20'),
(23, 11, 11, 5, '0.60'),
(24, 11, 14, 5, '0.25'),
(25, 12, 7, 3, '0.25'),
(26, 12, 4, 5, '0.15'),
(28, 13, 10, 5, '0.15'),
(29, 13, 14, 5, '0.25'),
(30, 13, 5, 5, '0.15'),
(31, 14, 11, 5, '0.60'),
(32, 14, 18, 3, '0.60'),
(33, 14, 9, 1, '1.00'),
(34, 14, 6, 1, '7.20'),
(35, 14, 7, 2, '0.25'),
(38, 15, 15, 1, '0.50'),
(39, 16, 2, 5, '0.15'),
(40, 16, 10, 5, '0.15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL,
  `token_user` varchar(50) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(1, 19, '2021-03-09 15:21:13', 120, '0.00', 1),
(2, 20, '2021-03-09 19:07:34', 150, '0.25', 1),
(3, 21, '2021-03-09 23:49:19', 120, '0.10', 1),
(4, 6, '2021-03-10 11:06:56', 0, '10.00', 1),
(5, 8, '2021-03-10 11:21:46', 0, '10.00', 1),
(6, 9, '2021-03-10 11:26:09', 0, '10.00', 1),
(7, 6, '2021-03-10 11:49:26', 0, '10.00', 1),
(8, 9, '2021-03-10 11:51:38', 0, '10.00', 1),
(9, 6, '2021-03-10 11:56:15', 0, '10.00', 1),
(10, 6, '2021-03-10 11:59:21', 0, '10.00', 1),
(11, 2, '2021-03-10 12:00:42', 0, '10.00', 1),
(12, 21, '2021-03-10 12:09:11', 0, '10.00', 1),
(13, 6, '2021-03-10 12:09:26', 0, '10.00', 1),
(14, 6, '2021-03-10 12:10:13', 0, '10.00', 1),
(15, 6, '2021-03-10 12:14:04', 0, '10.00', 1),
(16, 6, '2021-03-10 12:14:15', 0, '7.00', 1),
(17, 21, '2021-03-10 12:14:53', 0, '5.00', 1),
(18, 16, '2021-03-10 12:19:47', 0, '15.00', 1),
(19, 6, '2021-03-10 13:24:01', 0, '10.00', 1),
(20, 1, '2021-03-10 13:33:35', 0, '10.00', 1),
(21, 6, '2021-03-10 13:41:13', 0, '10.00', 1),
(22, 6, '2021-03-10 13:42:25', 0, '15.00', 1),
(23, 6, '2021-03-10 13:42:35', 0, '50.00', 1),
(24, 6, '2021-03-10 14:05:27', 0, '15.00', 1),
(25, 7, '2021-03-10 14:39:13', 0, '10.00', 1),
(26, 6, '2021-03-10 15:07:43', 0, '15.00', 1),
(27, 2, '2021-03-10 16:02:49', 0, '15.00', 1),
(28, 6, '2021-03-10 16:03:12', 0, '10.00', 1),
(29, 1, '2021-03-10 16:23:49', 0, '10.00', 1),
(30, 2, '2021-03-10 16:29:32', 0, '10.00', 1),
(31, 5, '2021-03-10 16:30:53', 0, '5.00', 1),
(32, 1, '2021-03-10 16:41:34', 0, '10.00', 1),
(33, 1, '2021-03-10 16:43:36', 0, '10.00', 1),
(34, 4, '2021-03-10 16:45:26', 0, '10.00', 1),
(35, 3, '2021-03-10 16:46:59', 0, '10.00', 1),
(36, 17, '2021-03-10 16:50:11', 0, '15.00', 1),
(37, 2, '2021-03-10 17:32:09', 0, '5.00', 1),
(38, 6, '2021-03-10 17:34:25', 0, '15.00', 1),
(39, 6, '2021-03-10 18:06:12', 0, '10.00', 1),
(40, 1, '2021-03-10 18:19:11', 0, '10.00', 1),
(41, 2, '2021-03-20 15:32:32', 0, '15.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario` int(11) DEFAULT NULL,
  `codcliente` int(11) DEFAULT NULL,
  `totalfactura` decimal(6,2) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nofactura`, `fecha`, `usuario`, `codcliente`, `totalfactura`, `estatus`) VALUES
(1, '2021-01-03 11:59:55', 1, 1, '4.80', 1),
(2, '2021-01-03 12:01:25', 1, 3, '1.95', 1),
(3, '2021-01-03 12:28:23', 1, 1, '0.75', 1),
(4, '2021-01-03 12:48:58', 1, 1, '1.05', 1),
(5, '2021-01-03 12:51:40', 1, 5, '0.75', 1),
(6, '2021-01-03 12:53:02', 1, 5, '0.75', 1),
(7, '2021-01-03 20:29:21', 1, 4, '2.60', 2),
(8, '2021-02-21 12:05:18', 1, 3, '2.00', 1),
(9, '2021-02-21 12:14:10', 1, 2, '5.25', 1),
(10, '2021-02-23 11:34:44', 1, 1, '10.40', 1),
(11, '2021-02-23 11:44:46', 1, 7, '4.25', 1),
(12, '2021-03-08 22:08:56', 1, 9, '1.50', 1),
(13, '2021-03-08 22:10:54', 3, 1, '2.75', 1),
(14, '2021-03-09 14:25:18', 1, 1, '13.50', 1),
(15, '2021-03-09 14:26:32', 1, 1, '0.50', 2),
(16, '2021-03-09 19:15:36', 1, 1, '1.50', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `informacion` varchar(200) NOT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `descuento` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `informacion`, `proveedor`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`, `descuento`) VALUES
(1, 'Loratidina', '10 mg', 2, '0.15', 130, '2021-01-03 11:53:49', 1, 1, 0),
(2, 'Umbral', '500 mg', 1, '0.13', 110, '2021-01-03 12:03:29', 1, 1, 1),
(3, 'Paracetamol', '500 mg', 2, '0.12', 65, '2021-01-03 20:27:42', 1, 1, 1),
(4, 'Analgan', '500 mg', 1, '0.13', 195, '2021-02-23 10:48:57', 1, 1, 0),
(5, 'Alarcet', '10 mg', 2, '0.14', 195, '2021-02-23 10:50:11', 1, 1, 0),
(6, 'Bisolvon', '120 ml', 1, '6.75', 150, '2021-02-23 10:51:01', 1, 1, 1),
(7, 'Aspirina', '100 mg', 1, '0.20', 145, '2021-02-23 10:51:54', 1, 1, 0),
(8, 'Alopurinol', '300 mg', 1, '0.75', 150, '2021-02-23 10:57:41', 1, 1, 0),
(9, 'Colgate', '150 ml', 1, '0.90', 199, '2021-02-23 11:01:03', 1, 1, 0),
(10, 'Amoxicilina ', '500 mg', 1, '0.15', 195, '2021-02-23 11:05:10', 1, 1, 0),
(11, 'Berifen', '100 mg', 1, '0.60', 190, '2021-02-23 11:07:14', 1, 1, 0),
(12, 'Diclofenaco', '50 mg', 1, '0.10', 195, '2021-02-23 11:08:28', 1, 1, 0),
(13, 'Losartan', '50 mg', 2, '0.60', 200, '2021-02-23 11:15:05', 1, 1, 0),
(14, 'Apronax', '275 mg', 2, '0.25', 190, '2021-02-23 11:16:59', 1, 1, 0),
(15, 'Termofin Forte', '500 mg', 1, '0.45', 198, '2021-02-23 11:18:59', 1, 1, 0),
(16, 'Linimento Olimpico', '115 ml', 2, '4.50', 150, '2021-02-23 11:22:13', 1, 1, 0),
(17, 'Voltaren otc Emulgel', '30 gr', 1, '8.80', 150, '2021-02-23 11:27:23', 1, 1, 1),
(18, 'Lemonflu Sobre', '10 gr', 3, '0.60', 145, '2021-02-23 11:30:01', 1, 1, 0),
(19, 'Caramelos', 'Sabor fresa', 3, '0.15', 120, '2021-03-09 15:21:13', 1, 1, 0),
(20, 'Helado', 'Pinguino', 14, '0.30', 150, '2021-03-09 19:07:34', 1, 1, 0),
(21, 'Curitas', 'Sana Sana', 3, '0.14', 120, '2021-03-09 23:49:19', 1, 1, 0);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN 
	INSERT INTO entradas(codproducto, cantidad, precio, usuario_id)
    VALUES (new.codproducto, new.existencia, new.precio, new.usuario_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codproveedor` int(11) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL DEFAULT 1,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codproveedor`, `proveedor`, `contacto`, `telefono`, `direccion`, `date_add`, `usuario_id`, `estatus`) VALUES
(1, 'Disfarmur', 'Claudia Sanchez', '2309940', 'Alejo Lascano, Guayaquil 090312', '2021-01-03 11:18:14', 0, 1),
(2, 'Punto Verde Premium', 'Jorge Rodriguez', '2399683', 'Av. Machala & Padre Solano, Guayaquil', '2021-01-03 11:18:14', 0, 1),
(3, ' Disfor S.A', 'Julio Estrada', '2566973', ' Ximena 316 E/ Manuel Galecio Y Alejo Lascano ', '2021-01-03 11:18:14', 0, 1),
(4, 'Dell Compani', 'Roberto Estrada', '2147483647', 'Guatemala, Guatemala', '2021-01-03 11:18:14', 0, 0),
(5, 'Olimpia S.A', 'Elena Franco Morales', '564535676', '5ta. Avenida ', '2021-01-03 11:18:14', 0, 0),
(6, 'Oster', 'Fernando Guerra', '78987678', 'Calzada La Paz', '2021-01-03 11:18:14', 0, 0),
(7, 'ACELTECSA S.A', 'Ruben Perez', '789879889', 'Colonia las Victorias', '2021-01-03 11:18:14', 0, 0),
(8, 'Sony', 'Julieta Contreras', '89476787', 'Antigua Guatemala', '2021-01-03 11:18:14', 0, 0),
(9, 'VAIO', 'Felix Arnoldo Rojas', '476378276', 'Zona 13', '2021-01-03 11:18:14', 0, 0),
(10, 'SUMAR', 'Oscar Maldonado', '788376787', 'Colonia San Jose', '2021-01-03 11:18:14', 0, 0),
(11, 'HP', 'Angel Cardona', '2147483647', '5ta. calle zona 4 Guatemala', '2021-01-03 11:18:14', 0, 0),
(12, 'Farmacia', 'Bart ', '987878768', 'Florida blq 3', '2021-02-23 10:46:58', 1, 0),
(13, 'Farmacia', 'Elena Franco Mora', '0981767336', 'flor de bastion', '2021-03-07 20:27:46', 1, 0),
(14, 'Drogueria', 'Elena Franco Mora', '987878768', 'Florida blq 3', '2021-03-09 19:06:19', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '91f5167c34c400758115c2a6826ec2e3', 1, 1),
(2, 'Luis', 'luis@gmail.com', 'Vendedor', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
(3, 'Lissette', 'lissette@gmail.com', 'Lissette', 'b48b23e130edf1e7f192a45da9b87c3e', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `nofactura` (`nofactura`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codcliente` (`codcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
