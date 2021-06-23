ET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `costamovil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cedula`, `nombre`, `telefono`, `direccion`, `correo`) VALUES
(40235681, 'Tosty Josue', '12458645', 'Mercedes Norte, Heredia', 'tostyjos@gmail.com'),
(504228866, 'Pedro Meneito', '76894323', 'Liberia, Guanacaste', 'pedromenei@hotmail.com'),
(603214587, 'Miguel Torres', '88566321', 'Bataan,Limon', 'myketowers@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `idDetalle` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `precioUnit` double NOT NULL,
  `descuento` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`idDetalle`, `factura_id`, `producto_id`, `cantidad`, `subtotal`, `precioUnit`, `descuento`) VALUES
(1, 1, 1, 1, 160000, 160000, 0.25),
(2, 2, 4, 2, 600000, 300000, 0.75),
(3, 3, 4, 2, 400000, 300000, 0.25),
(4, 3, 3, 1, 320000, 320000, 0.15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `cedula`, `nombre`, `direccion`, `telefono`, `correo`) VALUES
(1, 40235681, 'Josue del Valle', 'Escazu, Costa Rica', '88547456', 'delvallejos@gmail.com'),
(2, 705665489, 'Maria Del Carmen', 'Desamparados, San Jose', '77542365', 'mariadcarmen@hotmail.com'),
(3, 406987632, 'Del Pierre Pirla', 'Tibas, San Jose', '88256341', 'pirlaitalia@hotmail.com'),
(4, 406987632, 'Del Pierre Pirla', 'Tibas, San Jose', '88256341', 'pirlaitalia@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones`
--

CREATE TABLE `especificaciones` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `pantalla` varchar(256) NOT NULL,
  `almacenamiento` varchar(256) NOT NULL,
  `procesador` varchar(256) NOT NULL,
  `bateria` varchar(256) NOT NULL,
  `camara` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especificaciones`
--

INSERT INTO `especificaciones` (`id`, `producto_id`, `pantalla`, `almacenamiento`, `procesador`, `bateria`, `camara`) VALUES
(1, 1, 'OLED de 6.53\" ', '256 GB', 'Qualcomm Snapdragon 720g', '5000 mAh', 'Quad Camera 64 Mpx, 8 mpx, 5 mpx y 2 mpx'),
(2, 2, 'SuperAmoled de 6.99\"', '512GB ', 'Samsung Exynos 8960', '6500 mAh', 'Triple Camara 108 Mpx, 64 Mpx 100x optical-zoom, 24 Mpx gran angular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `numeroFactura` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` double NOT NULL,
  `descuento` double NOT NULL,
  `impuesto` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`numeroFactura`, `empleado_id`, `cliente`, `fecha`, `subtotal`, `descuento`, `impuesto`, `total`) VALUES
(1, 3, 40235681, '2021-06-15', 160000, 0, 13000, 173000),
(2, 2, 603214587, '2021-06-15', 600000, 0, 13000, 613000),
(3, 2, 40235681, '2021-06-15', 920000, 0, 28000, 948000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `numero_serie` varchar(45) NOT NULL,
  `precioCompra` double NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `precioVenta` double DEFAULT NULL,
  `Proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `numero_serie`, `precioCompra`, `tipo`, `precioVenta`, `Proveedor`) VALUES
(1, 'Xiaomi Redmi Note 10', '81818845415481', 100000, 'Celular', 160000, 1),
(2, 'Samsung Galaxy Note 20 Ultra', '191988618181', 320000, 'Celular', 490000, 3),
(3, 'Apple iPhone 12 Pro Max', '987198115165', 320000, 'Celular', 750000, 2),
(4, 'Apple iPhone 12 Mini', '85468165981', 300000, 'Celular', 490000, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `correo`, `direccion`, `marca`, `telefono`) VALUES
(1, 'XiaomiCR', 'xiaomiCR@china.com', 'Zhenzeng', 'Xiaomi', '12345678'),
(2, 'iCon', 'icon@apple.com', 'Mall San Pedro', 'Apple', '87654321'),
(3, 'CoreaPhone', 'coreaphone@corea.com', 'Liberia, Guanacaste', 'Samsung', '54784321'),
(4, 'JaponCell', 'japoncell@japon.com', 'Desamparados, San Jose', 'Hyundai', '87654321');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `FK_DetalleFactura_Celular_idx` (`producto_id`),
  ADD KEY `FK_DetalleFactura_Factura_idx` (`factura_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Especificaciones_Producto_idx` (`producto_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`numeroFactura`),
  ADD KEY `FK_Factura_Usuario_idx` (`empleado_id`),
  ADD KEY `FK_Factura_Cliente_idx` (`cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `FK_Producto_Proveedor_idx` (`Proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `FK_DetalleFactura_Factura` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`numeroFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleFactura_Producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD CONSTRAINT `FK_Especificaciones_Producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `FK_Factura_Cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Factura_Empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_Producto_Proveedor` FOREIGN KEY (`Proveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;