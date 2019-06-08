-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2015 a las 19:25:28
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alojado`
--

CREATE TABLE IF NOT EXISTS `alojado` (
  `codigo_cliente` int(15) NOT NULL DEFAULT '0',
  `numero_hab` int(3) NOT NULL DEFAULT '0',
  `f_entrada` date NOT NULL,
  `f_salida` date DEFAULT NULL,
  `num_personas` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alojado`
--

INSERT INTO `alojado` (`codigo_cliente`, `numero_hab`, `f_entrada`, `f_salida`, `num_personas`) VALUES
(1, 3, '2014-05-20', '2014-05-22', 2),
(2, 2, '2014-07-01', '2014-06-04', 3),
(3, 3, '2014-06-16', '2014-06-16', 1),
(4, 4, '2014-06-18', '2014-06-20', 2),
(5, 5, '2014-07-16', '2014-06-19', 3),
(6, 6, '2014-06-23', '2014-06-30', 2),
(7, 7, '2014-06-04', '2014-06-06', 2),
(8, 8, '2014-06-28', '2014-06-30', 4),
(9, 9, '2014-06-24', '2014-06-26', 2),
(10, 10, '2014-06-19', '2014-06-21', 2),
(11, 1, '2014-06-17', '2014-06-20', 2),
(12, 5, '2014-06-11', '2014-06-24', 10),
(14, 1, '2015-04-01', '2015-04-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `cod_cita` int(6) NOT NULL DEFAULT '0',
  `cod_tarifa` int(3) NOT NULL DEFAULT '0',
  `cod_cliente` int(15) NOT NULL DEFAULT '0',
  `dni_masajista` varchar(9) NOT NULL DEFAULT '',
  `hora` time DEFAULT NULL,
  `dia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cod_cita`, `cod_tarifa`, `cod_cliente`, `dni_masajista`, `hora`, `dia`) VALUES
(1, 3, 2, '55671126V', '15:30:00', '2014-06-02'),
(2, 5, 1, '55671126V', '15:30:00', '2014-06-01'),
(3, 6, 3, '55671126V', '15:30:00', '2014-07-11'),
(4, 10, 5, '55671126V', '15:30:00', '2014-07-21'),
(5, 8, 7, '55671126V', '15:30:00', '2014-05-30'),
(6, 1, 10, '55671126V', '15:30:00', '2014-05-22'),
(7, 3, 8, '55671126V', '15:30:00', '2014-05-20'),
(8, 2, 9, '55671126V', '15:30:00', '2014-01-21'),
(9, 4, 4, '55671126V', '15:30:00', '2014-03-21'),
(10, 7, 6, '55671126V', '15:30:00', '2014-04-21'),
(11, 2, 14, '26855108D', '13:40:00', '2015-04-03'),
(12, 1, 14, '26855108D', '20:30:00', '2015-04-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cliente` int(15) NOT NULL,
  `dni` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `tlf` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `dni`, `apellidos`, `nombre`, `tlf`) VALUES
(1, '36134079K', 'Castillo Zambrano', 'Catalina', 675314313),
(2, '78438846Z', 'Solórzano Malave', 'Nahuel', 956725865),
(3, '06305007V', 'Lucero Nava', 'Berenguer', 664699886),
(4, '84512574V', 'Garza Luna', 'Basileo', 630718744),
(5, '59839614P', 'Roldán Corral', 'Baldomero', 828933304),
(6, 'Z2376757B', 'Kaurismäki', 'Petri', 968068814),
(7, 'Z0957850C', 'Mannerheim', 'Raakel', 877133208),
(8, 'Y2383225W', 'Bayer', 'Lena', 871936413),
(9, 'X1857553G', 'Traugott', 'Ulrich', 712416863),
(10, 'Z8782909L', 'Peña Nieto', 'Esteban', 945157923),
(11, '10872833C', 'Carmona Herrera', 'Ivan', 941157923),
(12, '46931403H', 'Rodrigez Acosta', 'Maria', 911157923),
(13, '68812932Z', 'Birkin', 'Sherry', 641157923),
(14, '11111111K', 'Palotes', 'Perico', 632154851);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `come`
--

CREATE TABLE IF NOT EXISTS `come` (
  `codigo_cli` int(15) NOT NULL DEFAULT '0',
  `codigo_plato` int(3) NOT NULL DEFAULT '0',
  `hora` time DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE IF NOT EXISTS `comida` (
  `codigo` int(3) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` double(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`codigo`, `nombre`, `precio`) VALUES
(1, 'xaaaa', 999.99),
(2, 'Crujiente de Cigala y albahaca', 15.00),
(3, 'Triquini de jamón dulce y queso', 10.00),
(4, 'Muslo de codorniz agridulce', 28.00),
(5, 'Mini burger de foie y Parmesano', 9.00),
(6, 'Rodaballo con vinagreta de mariscos y setas', 20.00),
(7, 'Dorada asada sobre arroz con jugo de marisco', 16.00),
(8, 'Macarrones con tomate', 5.00),
(9, 'Costillas de cordero', 13.00),
(10, 'Croquetas de jamón', 7.00),
(11, 'Boquerones al limón con ensalada verde', 6.00),
(12, 'Bocados de lomo y jamón', 8.00),
(13, 'Montaditos de cerdo con salsa agridulce', 10.00),
(14, 'Arroz integral al wok', 12.00),
(15, 'Pasta con pesto de menta y albahaca', 7.50),
(16, 'Raviolis de queso con cecina y salsa de coliflor', 9.00),
(17, 'Fideuà vegetariana', 13.00),
(18, 'Arroz con chorizo y judías verdes', 14.00),
(19, 'Colitas de bacalao con patatas y fritada', 10.00),
(20, 'Muslos de pavo en salsa', 15.00),
(21, 'Tarta de queso en dos texturas', 5.60),
(22, 'Crêpes', 3.90),
(23, 'Tiramisú', 4.90),
(24, 'Helado', 3.50),
(25, 'Trufas caseras con nata', 1.50),
(26, 'Epsilon', 999.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `numero` int(3) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `precio` double(6,2) DEFAULT NULL,
  `disponibilidad` varchar(14) DEFAULT NULL,
  `ocupada` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`numero`, `tipo`, `precio`, `disponibilidad`, `ocupada`) VALUES
(1, 'individual', 60.00, 'preparada', 'ocupada'),
(2, 'individual', 60.00, 'preparada', 'libre'),
(3, 'individual', 60.00, 'preparada', 'libre'),
(4, 'doble', 85.00, 'preparada', 'libre'),
(5, 'doble', 85.00, 'preparada', 'libre'),
(6, 'doble', 85.00, 'preparada', 'libre'),
(7, 'deluxe_suite', 150.00, 'preparada', 'libre'),
(8, 'deluxe_suite', 150.00, 'preparada', 'libre'),
(9, 'royal_suite', 300.00, 'preparada', 'libre'),
(10, 'royal_suite', 300.00, 'preparada', 'libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limpia`
--

CREATE TABLE IF NOT EXISTS `limpia` (
  `dni_trab` varchar(9) NOT NULL DEFAULT '',
  `numero_hab` int(3) NOT NULL DEFAULT '0',
  `hora` time NOT NULL DEFAULT '00:00:00',
  `dia` date NOT NULL DEFAULT '0000-00-00',
  `desperfectos` varchar(7999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `limpia`
--

INSERT INTO `limpia` (`dni_trab`, `numero_hab`, `hora`, `dia`, `desperfectos`) VALUES
('03629479X', 1, '17:53:39', '2014-05-24', ''),
('03629479X', 1, '20:22:06', '2015-04-01', ''),
('03629479X', 1, '21:11:24', '2015-04-01', ''),
('03629479X', 3, '18:46:51', '2014-05-24', ''),
('03629479X', 4, '16:23:00', '2014-05-23', ''),
('03629479X', 5, '17:31:10', '2014-05-24', ''),
('03629479X', 6, '17:36:48', '2014-05-24', ''),
('03629479X', 9, '16:20:16', '2014-05-23', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limpiadora`
--

CREATE TABLE IF NOT EXISTS `limpiadora` (
  `dni` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `limpiadora`
--

INSERT INTO `limpiadora` (`dni`) VALUES
('03629479X'),
('29452422W'),
('41446712E'),
('61161061J'),
('69522498F'),
('96359077W');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masajista`
--

CREATE TABLE IF NOT EXISTS `masajista` (
  `dni` varchar(9) NOT NULL,
  `especialidad` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `masajista`
--

INSERT INTO `masajista` (`dni`, `especialidad`) VALUES
('26855108D', 'sueco'),
('55671126V', 'reiki'),
('84212611C', 'facial'),
('90752372F', 'acupuntura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE IF NOT EXISTS `tarifa` (
  `cod_tarifa` int(3) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` double(5,2) DEFAULT NULL,
  `descripcion` varchar(7999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`cod_tarifa`, `nombre`, `precio`, `descripcion`) VALUES
(1, 'masaje Balinés Tradicional', 50.00, 'El masaje balinés tradicional es una ancestral terapia para la sanación propia de la isla de Bali (Indonesia) y que junto con los conocimientos de medicina y herboristerí­a tradicional, ayudaba a sus habitantes a sentirse más bellos y saludables interior y exteriormente. Esto es lo que se conoce como Jamu (sistema médico propio de Indonesia). El tradicional masaje balinés consiste en una combinación de técnicas, incluyendo masaje, acupresión, reflexología, estiramientos y aromaterapia en la misma sesión.'),
(2, 'Acupuntura', 40.00, 'La acupuntura es una terapia natural que utiliza finísimas agujas que se insertan en ciertos puntos del cuerpo, siguiendo los meridianos energéticos a través de los cuales circula la energía vital o Qi.'),
(3, 'masajes con piedras volcanicas', 60.00, 'Un masaje con piedras calientes volcánicas es la experiencia más ancestral, básica y natural del universo mineral. Mientras el hombre se cobijaba en cuevas excavadas en las rocas de las montañas tiró la primera piedra para cazar. Después los minerales de su entorno pasaron a formar parte de su primera terapia manual para calmar el dolor por frotación y presión con las mismas.'),
(4, 'sesion de Reiki', 45.00, 'Tratamiento milenario para aliviar dolores de cualquier índole. Al practicarlo hara que su energia vital se renueve y se sienta mucho mejor.'),
(5, 'Masaje facial', 45.00, 'Un masaje pensado para aumentar la salud y armonía facial. Basado en técnicas de masaje de rejuvenecimiento provenientes de la digito-puntura china (Tuina) y masaje reflexológico facial . A través de suaves presiones con los dedos, suaves golpeteos, amasamientos, presiones circulares, etc., que son aplicados por todo el rostro, el cuello y el cráneo se consigue activar la energía estancada en la parte alta del cuerpo, tensión originada por un exceso de actividad mental o por un desequilibrio energético.'),
(6, 'Piedras calientes Lomi Lomi', 100.00, 'En la sabia combinación del masaje Lomi Lomi Nui con las piedras calientes de origen volcánico (hot stones) se obtiene el beneficio más profundo de las posibilidades de sanación, crecimiento y transformación que las enseñanzas hawaianas ofrecen.'),
(7, 'masaje Tailandes', 50.00, 'El masaje Tailandés se conoce en Tailandia como nuad bo rarn, nuad boran o nuat phaen boran, literalmente, masaje a la antigua usanza o tradicional. "Nuat boran" es el nombre tailandés para éste tipo de trabajo corporal nativo de Tailandia (nuat= presión, tocar con el propósito de curar boran o boRarn= antiguo). Es el gran masaje del reino de Siam.'),
(8, 'masaje Express', 30.00, 'Masaje basado en la acupresión, digitopresión o digitopuntura y maniobras descontracturantes. Este masaje se realiza en silla ergonómica de masaje, o bien en camilla, según necesidad y deseo del cliente.'),
(9, 'Lodo del congo', 1.00, 'qwewqe'),
(10, 'Masaje para embarazadas', 50.00, 'Durante el embarazo, la mujer puede sentir diversas molestias a nivel musculo-esquelético y en su sistema circulatorio, producto de los cambios hormonales, el aumento de volumen y la ganancia de peso. Estas molestias son comunes e inherentes al proceso de embarazo y por lo tanto provocan que la futura madre se sienta incómoda, dolorida y cansada. El masaje para embarazadas es una técnica corporal que procura aliviar dichas molestias, al dirigirse directamente a las necesidades que la embarazada puede presentar.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE IF NOT EXISTS `trabajador` (
  `dni` varchar(9) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `especialidad` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `sueldo` double(6,2) DEFAULT NULL,
  `horario` varchar(1) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`dni`, `apellidos`, `nombre`, `especialidad`, `sueldo`, `horario`) VALUES
('03629479X', 'Tórrez Tovar', 'Ascensión', 'limpieza', 2000.00, 'n'),
('06390828W', 'Terrazas Segura', 'Naomi', 'administrativo', 2500.00, 't'),
('14700188Z', 'Peña Ramos', 'Sara', 'restaurante', 2900.00, 'n'),
('26452030Y', 'Rocha Azevedo', 'Diego', 'administrativo', 3000.00, 'n'),
('26855108D', 'Pizarro Mojica', 'Araceli', 'masajista', 2000.00, 't'),
('27264256X', 'Torrero Fernandez', 'Lucia', 'administrativo', 2500.00, 'm'),
('29406414V', 'Vazquez Lujan', 'Cristina', 'administrativo', 2500.00, 't'),
('29452422W', 'Cabán Almonte', 'Luis', 'limpieza', 1500.00, 't'),
('36538269D', 'Sanchez Lisboa', 'Marcos', 'restaurante', 2900.00, 'n'),
('41446712E', 'Salgado Chacón', 'Blanca', 'limpieza', 1500.00, 'm'),
('43820998H', 'Jimenez Ramirez', 'Jose', 'restaurante', 2700.00, 'm'),
('44024940L', 'Estevez Guerrero', 'Maria', 'administrativo', 3000.00, 'n'),
('49980296P', 'Alvarez Ortuño', 'Alex', 'restaurante', 2700.00, 'm'),
('55671126V', 'Bueno Delgado', 'Roberto', 'masajista', 2000.00, 'm'),
('61161061J', 'Palomo Villalobos', 'Juan', 'limpieza', 1500.00, 'm'),
('69522498F', 'Crespo Caldera', 'Noelia', 'limpieza', 1500.00, 't'),
('79156602D', 'Ribera Sastre', 'Oriol', 'restaurante', 2700.00, 'm'),
('83218246Z', 'Blanco Montilla', 'Esteban', 'administrativo', 2500.00, 'm'),
('84212611C', 'Blanco Jimenez', 'Sara', 'masajista', 2000.00, 't'),
('90752372F', 'Najera Alcaraz', 'Julia', 'masajista', 2000.00, 'm'),
('93410359E', 'Marquez Soto', 'Penelope', 'restaurante', 2900.00, 'n'),
('94294310Z', 'Cruz Taboada', 'Amanda', 'restaurante', 2700.00, 'm'),
('95234367S', 'Bravo Ávila', 'Eva', 'restaurante', 2900.00, 'n'),
('96359077W', 'Cisneros Santillan', 'Francisco', 'limpieza', 2000.00, 'n');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alojado`
--
ALTER TABLE `alojado`
 ADD PRIMARY KEY (`codigo_cliente`,`numero_hab`,`f_entrada`), ADD KEY `fk_aloj_n_hab` (`numero_hab`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
 ADD PRIMARY KEY (`cod_cita`,`cod_tarifa`,`cod_cliente`,`dni_masajista`), ADD KEY `fk_cod_cliente` (`cod_cliente`), ADD KEY `fk_dni_masaj` (`dni_masajista`), ADD KEY `fk_cod_tarifa` (`cod_tarifa`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `come`
--
ALTER TABLE `come`
 ADD PRIMARY KEY (`codigo_plato`,`codigo_cli`,`fecha`), ADD KEY `fk_platos_cod_cliente` (`codigo_cli`);

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
 ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `limpia`
--
ALTER TABLE `limpia`
 ADD PRIMARY KEY (`dni_trab`,`numero_hab`,`hora`,`dia`), ADD KEY `fk_n_habitacion` (`numero_hab`);

--
-- Indices de la tabla `limpiadora`
--
ALTER TABLE `limpiadora`
 ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `masajista`
--
ALTER TABLE `masajista`
 ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
 ADD PRIMARY KEY (`cod_tarifa`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
 ADD PRIMARY KEY (`dni`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alojado`
--
ALTER TABLE `alojado`
ADD CONSTRAINT `fk_aloj_cod_cliente` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`cod_cliente`),
ADD CONSTRAINT `fk_aloj_n_hab` FOREIGN KEY (`numero_hab`) REFERENCES `habitacion` (`numero`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`),
ADD CONSTRAINT `fk_cod_tarifa` FOREIGN KEY (`cod_tarifa`) REFERENCES `tarifa` (`cod_tarifa`),
ADD CONSTRAINT `fk_dni_masaj` FOREIGN KEY (`dni_masajista`) REFERENCES `masajista` (`dni`);

--
-- Filtros para la tabla `come`
--
ALTER TABLE `come`
ADD CONSTRAINT `fk_codigo_plato` FOREIGN KEY (`codigo_plato`) REFERENCES `comida` (`codigo`),
ADD CONSTRAINT `fk_platos_cod_cliente` FOREIGN KEY (`codigo_cli`) REFERENCES `cliente` (`cod_cliente`);

--
-- Filtros para la tabla `limpia`
--
ALTER TABLE `limpia`
ADD CONSTRAINT `fk_dni_trab_limpieza` FOREIGN KEY (`dni_trab`) REFERENCES `limpiadora` (`dni`),
ADD CONSTRAINT `fk_n_habitacion` FOREIGN KEY (`numero_hab`) REFERENCES `habitacion` (`numero`);

--
-- Filtros para la tabla `limpiadora`
--
ALTER TABLE `limpiadora`
ADD CONSTRAINT `fk_lim` FOREIGN KEY (`dni`) REFERENCES `trabajador` (`dni`);

--
-- Filtros para la tabla `masajista`
--
ALTER TABLE `masajista`
ADD CONSTRAINT `fk_mas` FOREIGN KEY (`dni`) REFERENCES `trabajador` (`dni`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
