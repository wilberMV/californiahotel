-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2018 a las 18:24:48
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE `abono` (
  `id` int(11) NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nota` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `id_contable` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura`
--

CREATE TABLE `apertura` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fechai` date NOT NULL,
  `fechaf` date NOT NULL,
  `horai` time NOT NULL,
  `horaf` time NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `metodopago` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `salario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`, `salario`) VALUES
(4, 'Usuario', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_permiso`
--

CREATE TABLE `cargo_permiso` (
  `id` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo_permiso`
--

INSERT INTO `cargo_permiso` (`id`, `cargo`, `modulo`, `permiso`, `estado`) VALUES
(1, '1', 'Clientes', '1', 'n'),
(2, '1', 'Habitaciones', '1', 'n'),
(3, '1', 'Habitaciones', '2', 'n'),
(4, '1', 'Habitaciones', '3', 'n'),
(5, '1', 'Informe', '1', 'n'),
(6, '1', 'Informe', '2', 'n'),
(7, '1', 'Informe', '3', 'n'),
(8, '1', 'Usuarios', '1', 'n'),
(9, '1', 'Usuarios', '2', 'n'),
(10, '1', 'Sucursales', '1', 'n'),
(11, '1', 'Sucursales', '2', 'n'),
(12, '1', 'Recepci?n', '1', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nit` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL,
  `lcredito` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `nitt` varchar(25) NOT NULL,
  `giro` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nit`, `nom`, `dir`, `tel`, `cel`, `descuento`, `lcredito`, `sucursal`, `estado`, `nitt`, `giro`, `email`) VALUES
(2, '831318399', 'MANUEL PARADA', 'COL LAS MALGARITAS', '4739-2749', '7943-2984', '', '', '1', 's', '7879-797979-779-8', '', ''),
(3, '11223344', 'JORGE PINEDA BOLA&Ntilde;OZ', 'Santiago de Maria. col. las primaveras', '3173-9172', '7979-7492', '', '', '1', 's', '', '', ''),
(4, '1122334445', 'JOSE LUIS PARADA', 'col. las colinas csa.12 pje 4', '4723-9479', '7394-7927', '', '', '1', 's', '', '', ''),
(5, '112233444112233444', 'ANA GUADALUPE PEREZ', 'San Miguel. col las malgaritas', '3173-9172', '4234-2424', '', '', '1', 's', '', '', ''),
(6, '112233444567', 'MARIA LOPEZ ARAUJO', 'San Salvador casa #12', '3173-9172', '4242-4242', '', '', '1', 's', '', '', ''),
(7, '112233444567654', 'CARLA LOZANO UMANZOR', 'col. las cascadas', '7937-9173', '3193-7917', '', '', '1', 's', '', '', ''),
(8, '112233444', 'SOFIA LOPEZ', 'col. las praderas chinameca', '7932-4792', '7947-9274', '', '', '1', 's', '', '', ''),
(9, '11223344456789', 'JHONY JOEL MELENDEZ', 'SAN MIGUEL', '2222-2222', '7777-7777', '', '', '1', 's', '', '', ''),
(10, '44546563', 'NESTOR HERNANDEZ', 'SAN MIGUEL', '2677-7777', '7899-9999', '', '', '1', 's', '9998-898989-898-9', 'cliente', 'f@gmail.com'),
(11, '47297492', 'JUAN PEREZ', 'COL. LAS PRUEBAS', '4732-6478', '6378-2647', '', '', '1', 's', 'PRUEBAJDSKJDKAJK', 'shkahd', 'dhkahdkahdka'),
(12, 'WUEOQUO', 'UWEOUEOU', 'NDASDADHKJh', '7942-3749', '3429-7492', '', '', '1', 's', 'dhsjakdhaskdsasada', '', ''),
(13, '4732992', 'XXXXXXXXXXXXX', 'PRUEBA DE DTAOS', '7328-9347', '7432-7492', '', '', '1', 's', '7328-974982-739-4', 'PRUEBA DE LOS DATOSx', 'EMAILDE PRUEBASxx'),
(14, '112233444554321', 'MARIO PERLA', 'SAN MIGUEL', '1111-1111', '6666-6666', '', '', '1', 's', '3333-333333-333-3', 'prueba de giro', 'perla@gmail.com'),
(15, '4738274297', 'JUAN PARARADA', 'COL LAS COLINITAS DE SAN MIGUEL', '4374-9832', '7493-7942', '', '', '1', 's', '4737-492879-472-9', 'col las colinas', 'delmarlopez2006@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE `comandas` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `mesa` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `formapago` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `id` int(11) NOT NULL,
  `compra` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_tmp`
--

CREATE TABLE `compra_tmp` (
  `id` int(11) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confi`
--

CREATE TABLE `confi` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tabla` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `confi`
--

INSERT INTO `confi` (`id`, `nombre`, `tabla`) VALUES
(1, 'FAMILIAR', 'categoria'),
(2, 'PERSONAL', 'categoria'),
(3, 'OTROS', 'categoria'),
(4, 'SERVICIO', 'categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contable`
--

CREATE TABLE `contable` (
  `id` int(11) NOT NULL,
  `concepto1` varchar(255) NOT NULL,
  `concepto2` longtext NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usu` varchar(255) NOT NULL,
  `consultorio` varchar(255) NOT NULL,
  `clase` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nit` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nom_iva` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `anno` varchar(255) NOT NULL,
  `vmoneda` varchar(255) NOT NULL,
  `dnom1` varchar(255) NOT NULL,
  `dnom2` varchar(255) NOT NULL,
  `lista` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `nit`, `direccion`, `tel`, `fax`, `pais`, `ciudad`, `correo`, `nom_iva`, `iva`, `anno`, `vmoneda`, `dnom1`, `dnom2`, `lista`) VALUES
(1, 'Prueba Bares', '112233444567899876', 'TECAMAC', '00', '11', 'MEXICO', 'ESTADO DE MEXICO', 'www.prueba.com', 'IVA PRUEBA', '16', '2015', '16.96', 'MXN', 'USD', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `cod_cliente` varchar(255) NOT NULL,
  `nom_cliente` varchar(255) NOT NULL,
  `nom_impuesto` varchar(255) NOT NULL,
  `pagocon` varchar(255) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `impuesto` varchar(255) NOT NULL,
  `neto` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `metodopago` varchar(255) NOT NULL,
  `pago` varchar(12) NOT NULL,
  `habitacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `cod_cliente`, `nom_cliente`, `nom_impuesto`, `pagocon`, `subtotal`, `impuesto`, `neto`, `fecha`, `hora`, `usuario`, `sucursal`, `metodopago`, `pago`, `habitacion`) VALUES
(1, '8', 'SOFIA LOPEZ', 'IVA', '0', '41', '5.33', '41', '2017-03-13', '09:16:51', '11223344', '1', '', '', ''),
(2, '14', 'MARIO PERLA', 'IVA', '0', '47', '6.11', '47', '2017-03-13', '09:21:43', '11223344', '1', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `inv` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `sucursal` int(11) NOT NULL,
  `descto` varchar(11) NOT NULL,
  `flete` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_detalle`
--

INSERT INTO `factura_detalle` (`id`, `factura`, `cod`, `nom`, `cat`, `inv`, `cant`, `iva`, `val`, `fecha`, `hora`, `sucursal`, `descto`, `flete`) VALUES
(1, '1', '4', 'HABITACI&Oacute;N 2', '', '', '1', '4.55', '35', '2017-03-13', '09:16:51', 1, '0', '0'),
(2, '1', '3', 'PERSONA', '', '', '1', '0.78', '6', '2017-03-13', '09:16:51', 1, '0', '0'),
(3, '2', '5', 'HABITACI&Oacute;N 3', '', '', '1', '4.55', '35', '2017-03-13', '09:21:43', 1, '0', '0'),
(4, '2', '3', 'PERSONA', '', '', '2', '1.56', '6', '2017-03-13', '09:21:43', 1, '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pago`
--

CREATE TABLE `factura_pago` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `metodopago` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_pago`
--

INSERT INTO `factura_pago` (`id`, `factura`, `metodopago`, `tipo`, `valor`, `fecha`, `sucursal`) VALUES
(1, '1', '1', 'Contado', '41', '2017-03-13', 1),
(2, '2', '1', 'Contado', '47', '2017-03-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` varchar(255) NOT NULL,
  `hospedaje` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `medida` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL,
  `proveedor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo_contenido`
--

CREATE TABLE `insumo_contenido` (
  `id` int(11) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `insumo` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `contenido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `impuesto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `persona` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `nota` text NOT NULL,
  `atencion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_detalle`
--

CREATE TABLE `mesa_detalle` (
  `id` int(11) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL,
  `mesa` varchar(255) NOT NULL,
  `atendido` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopago`
--

CREATE TABLE `metodopago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metodopago`
--

INSERT INTO `metodopago` (`id`, `nombre`, `tipo`) VALUES
(1, 'Efectivo', 'Contado'),
(2, 'Credito', 'Credito'),
(3, 'Tarjeta Mastercard', 'Credito'),
(4, 'Tarjeta Visa', 'Credito'),
(5, 'Bonos', 'Credito'),
(6, 'Promociones', 'Contado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `cod`, `nom`, `dir`, `tel`, `cel`) VALUES
(1, '11223344', 'ADMIN-ROOT', 'SAN MIGUEL', '7906-4556', 'cell');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `inv` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `nchasis` varchar(25) NOT NULL,
  `nplaca` varchar(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `control` varchar(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `cliente_tmp` varchar(100) NOT NULL,
  `fech_entrega` date NOT NULL,
  `fecha_in` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `categoria`, `inv`, `estado`, `iva`, `nchasis`, `nplaca`, `valor`, `prov`, `control`, `status`, `cliente_tmp`, `fech_entrega`, `fecha_in`, `hora`) VALUES
(1, 'HB0101', 'HABITACI&Oacute;N 1', '2', '', 's', '', '', '', '35', '', 's', '', '', '0000-00-00', '0000-00-00', '00:00:00'),
(2, 'SRV001', 'LABANDERIA', '4', '', 's', '', '', '', '12', '', 's', '', '', '0000-00-00', '0000-00-00', '00:00:00'),
(3, 'PER001', 'PERSONA', '2', '', 's', '', '', '', '6', '', 'c', 'OCUPADA', 'MARIO PERLA', '0000-00-00', '0000-00-00', '00:00:00'),
(4, 'HB0102', 'HABITACI&Oacute;N 2', '2', '', 's', '', '', '', '35', '', 's', '', '', '0000-00-00', '0000-00-00', '00:00:00'),
(5, 'HB0103', 'HABITACI&Oacute;N 3', '2', '', 's', '', '', '', '35', '', 's', '', '', '0000-00-00', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prod_insumo`
--

CREATE TABLE `prod_insumo` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `insumo` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `medida` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_nom`
--

CREATE TABLE `seg_nom` (
  `id` int(11) NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_nom`
--

INSERT INTO `seg_nom` (`id`, `grupo`, `cod`, `nombre`, `estado`) VALUES
(1, 'Clientes', '1', 'Administrar Clientes', 's'),
(2, 'Servicios', '1', 'Administrar Servicios', 's'),
(3, 'Servicios', '2', 'Control de Equipos', 's'),
(4, 'Servicios', '3', 'Administrar Categorias', 's'),
(5, 'Informe', '1', 'Consultar Facturas', 's'),
(6, 'Informe', '2', 'Reporte Financiero', 's'),
(7, 'Informe', '3', 'Reporte de Kardex de Clientes', 's'),
(8, 'Usuarios', '1', 'Registro, Actualizar y Consultar Usuarios', 's'),
(9, 'Usuarios', '2', 'Actualizar Contraseña', 's'),
(10, 'Sucursales', '1', 'Administrar Sucursales', 's'),
(11, 'Sucursales', '2', 'Imagen de Presentacion', 's'),
(12, 'Venta', '1', 'Facturar', 's'),
(13, 'Informe', '4', 'Reporte de Servicios', 's'),
(14, 'Informe', '5', 'Reporte de Tipo de Pago', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_per`
--

CREATE TABLE `seg_per` (
  `id` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seg_per`
--

INSERT INTO `seg_per` (`id`, `usu`, `modulo`, `permiso`, `estado`) VALUES
(1, '11223344', 'Clientes', '1', 's'),
(2, '11223344', 'Habitaciones', '1', 's'),
(3, '11223344', 'Habitaciones', '2', 's'),
(4, '11223344', 'Habitaciones', '3', 's'),
(5, '11223344', 'Informe', '1', 's'),
(6, '11223344', 'Informe', '2', 's'),
(7, '11223344', 'Informe', '3', 's'),
(8, '11223344', 'Usuarios', '1', 's'),
(9, '11223344', 'Usuarios', '2', 's'),
(10, '11223344', 'Sucursales', '1', 's'),
(11, '11223344', 'Sucursales', '2', 's'),
(12, '11223344', 'Recepci?n', '1', 's'),
(25, '11223344', 'Productos', '4', 'n'),
(26, '11223344', 'Sistema', '3', 'n'),
(27, '11223344', 'Admin', '1', 'n'),
(28, '11223344', 'Recepción', '1', 's'),
(29, '11223344', 'Servicios', '1', 's'),
(30, '11223344', 'Servicios', '2', 's'),
(31, '11223344', 'Servicios', '3', 's'),
(32, '11223344', 'Informe', '4', 's'),
(33, '11223344', 'Venta', '1', 's'),
(34, '11223344', 'Facturar', '1', 'n'),
(35, '11223344', 'Informe', '5', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `nit` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `dpto` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `nom_imp` varchar(255) NOT NULL,
  `val_imp` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `tama` varchar(255) NOT NULL,
  `letra` varchar(255) NOT NULL,
  `nrc` varchar(25) NOT NULL,
  `giro` varchar(255) NOT NULL,
  `nitt` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nit`, `nom`, `municipio`, `dpto`, `ciudad`, `dir`, `tel`, `correo`, `web`, `pais`, `nom_imp`, `val_imp`, `cp`, `tama`, `letra`, `nrc`, `giro`, `nitt`) VALUES
(1, 'SC0002', 'HOSPEDAJE HOLIMPO', 'LA UNION', 'MIRAFLORES', 'LIMA', 'CALLE LAS FLORES 245', '4283-0280', 'correo', 'web', 'pais', 'IGV', '18', 'codigopostal', '340', '12', '6786-866868-686-6', 'SERVICIO DE HOSPEDAJE', '567575-7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `username`
--

CREATE TABLE `username` (
  `id` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `caja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `username`
--

INSERT INTO `username` (`id`, `usu`, `con`, `tipo`, `cargo`, `sucursal`, `estado`, `caja`) VALUES
(1, '11223344', '4b506535c0d3ee5682631f631575504588640f53', 'a', 'Administrador', '1', 's', 'ADMIN ROOT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_caja_tmp`
--

CREATE TABLE `venta_caja_tmp` (
  `id` int(11) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `mesa` varchar(255) NOT NULL,
  `fecha_in` date NOT NULL,
  `fech_entrega` date NOT NULL,
  `control` varchar(11) NOT NULL,
  `descto` varchar(11) NOT NULL,
  `flete` varchar(11) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_info_tmp`
--

CREATE TABLE `venta_info_tmp` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mesa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_info_tmp`
--

INSERT INTO `venta_info_tmp` (`id`, `cliente`, `usu`, `nombre`, `mesa`) VALUES
(2, '8', '11223344', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pago_tmp`
--

CREATE TABLE `venta_pago_tmp` (
  `id` int(11) NOT NULL,
  `metodopago` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono`
--
ALTER TABLE `abono`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apertura`
--
ALTER TABLE `apertura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo_permiso`
--
ALTER TABLE `cargo_permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_tmp`
--
ALTER TABLE `compra_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `confi`
--
ALTER TABLE `confi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contable`
--
ALTER TABLE `contable`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura_pago`
--
ALTER TABLE `factura_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumo_contenido`
--
ALTER TABLE `insumo_contenido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa_detalle`
--
ALTER TABLE `mesa_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prod_insumo`
--
ALTER TABLE `prod_insumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seg_nom`
--
ALTER TABLE `seg_nom`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seg_per`
--
ALTER TABLE `seg_per`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_caja_tmp`
--
ALTER TABLE `venta_caja_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_info_tmp`
--
ALTER TABLE `venta_info_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_pago_tmp`
--
ALTER TABLE `venta_pago_tmp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE `abono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `apertura`
--
ALTER TABLE `apertura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cargo_permiso`
--
ALTER TABLE `cargo_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `comandas`
--
ALTER TABLE `comandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra_tmp`
--
ALTER TABLE `compra_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `confi`
--
ALTER TABLE `confi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `contable`
--
ALTER TABLE `contable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `factura_pago`
--
ALTER TABLE `factura_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `insumo_contenido`
--
ALTER TABLE `insumo_contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mesa_detalle`
--
ALTER TABLE `mesa_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `prod_insumo`
--
ALTER TABLE `prod_insumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `seg_nom`
--
ALTER TABLE `seg_nom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `seg_per`
--
ALTER TABLE `seg_per`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `username`
--
ALTER TABLE `username`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `venta_caja_tmp`
--
ALTER TABLE `venta_caja_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `venta_info_tmp`
--
ALTER TABLE `venta_info_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `venta_pago_tmp`
--
ALTER TABLE `venta_pago_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
