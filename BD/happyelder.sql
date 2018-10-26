-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-10-2018 a las 21:45:07
-- Versión del servidor: 5.6.37
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `happyelder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiarios`
--

CREATE TABLE IF NOT EXISTS `beneficiarios` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `status` enum('libre','asignado') NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fechaVisita` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beneficiarios`
--

INSERT INTO `beneficiarios` (`id`, `fullName`, `status`, `firstName`, `lastName`, `telephone`, `dni`, `location_id`, `user_id`, `fechaVisita`) VALUES
(1, 'Nico Quispe', 'libre', 'Nico', 'Quispe', '123456', '42342342', 2, 0, '0000-00-00'),
(2, 'Nico ', 'asignado', 'nico 22', 'asdasasd', '234234234', '23423423', 3, 17, '2018-09-07'),
(3, 'Yamil Quiñones', 'asignado', 'asdasdas', 'dasdasdas', '98523641', 'asdasd', 3, 17, '2018-09-07'),
(4, 'Roberto Casapia', 'libre', 'Roberto', 'Casapia', '940254337', '74560923', 3, 0, '0000-00-00'),
(5, 'Rosa Ortega', 'libre', 'Rosa', 'Ortega', '987863415', '09825785', 3, 0, '0000-00-00'),
(6, 'Andres Jauregui', 'libre', 'Andres', 'Jauregui', '987089065', '78903456', 4, 0, '0000-00-00'),
(7, 'Gloria Pacheco', 'libre', 'Gloria', 'Pacheco', '970234566', '02367894', 9, 0, '0000-00-00'),
(8, 'Talia Fernandez', 'libre', 'Talia', 'Fernandez', '754318907', '08956743', 9, 0, '0000-00-00'),
(9, 'Maria Gomez', 'libre', 'Maria', 'Gomez', '93450124', '74503267', 9, 0, '0000-00-00'),
(10, 'Juan Santamaria', 'asignado', 'Juan', 'Santamaria', '923456012', '0568932', 10, 24, '2018-09-07'),
(11, 'Karen Berru', 'libre', 'Karen', 'Berru', '974243406', '95643207', 10, 0, '0000-00-00'),
(12, 'Jhon Chacaltana', 'libre', 'Jhon', 'Chacaltana', '904567934', '85634502', 10, 0, '0000-00-00'),
(13, 'Edwin Vasquez', 'libre', 'Edwin', 'Vasquez', '975326789', '05439845', 4, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('qo6ve13puap1m8hc48pl20pcp1f5q2bv', '127.0.0.1', 1539906148, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930363133383b69647c733a323a223136223b757365724e616d657c733a32313a22646361726c6f73406861707079656c6465722e7065223b70617373776f72647c733a34303a2235653439313261373433313136366632393061303533353937376266393536333936326539393430223b66756c6c4e616d657c733a32313a22446965676f204361726c6f732043617374696c6c6f223b726f6c7c733a313a2233223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a22446965676f223b6c6173744e616d657c733a31353a224361726c6f732043617374696c6c6f223b74656c6570686f6e657c733a393a22393933373931363739223b70686f746f7c733a33363a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f4932352e6a7067223b686173687c733a363a22313233343536223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('ff4129u7rclg038o3tohhe5kefjnp20v', '127.0.0.1', 1539907021, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930363938363b69647c733a313a2231223b757365724e616d657c733a31393a2261646d696e406861707079656c6465722e7065223b70617373776f72647c733a34303a2262373464373963633738363439343332663937316239366130376236663537666263326230303066223b66756c6c4e616d657c733a31363a2241646d696e204861707079456c646572223b726f6c7c733a313a2231223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a2241646d696e223b6c6173744e616d657c733a31303a224861707079456c646572223b74656c6570686f6e657c733a393a22393833333639313636223b70686f746f7c733a33383a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f61646d696e2e6a7067223b686173687c733a303a22223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('9dci3sdmci73d0qao63nc3nf6blu93gc', '127.0.0.1', 1539907761, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930373531323b69647c733a313a2231223b757365724e616d657c733a31393a2261646d696e406861707079656c6465722e7065223b70617373776f72647c733a34303a2262373464373963633738363439343332663937316239366130376236663537666263326230303066223b66756c6c4e616d657c733a31363a2241646d696e204861707079456c646572223b726f6c7c733a313a2231223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a2241646d696e223b6c6173744e616d657c733a31303a224861707079456c646572223b74656c6570686f6e657c733a393a22393833333639313636223b70686f746f7c733a33383a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f61646d696e2e6a7067223b686173687c733a303a22223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('am2mlr5j4m4la320pv3b3it52aa379oo', '127.0.0.1', 1539908351, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930383237393b69647c733a313a2231223b757365724e616d657c733a31393a2261646d696e406861707079656c6465722e7065223b70617373776f72647c733a34303a2262373464373963633738363439343332663937316239366130376236663537666263326230303066223b66756c6c4e616d657c733a31363a2241646d696e204861707079456c646572223b726f6c7c733a313a2231223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a2241646d696e223b6c6173744e616d657c733a31303a224861707079456c646572223b74656c6570686f6e657c733a393a22393833333639313636223b70686f746f7c733a33383a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f61646d696e2e6a7067223b686173687c733a303a22223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('m5djckvu12rcel0tvk4d2bfmtn6e99l2', '127.0.0.1', 1539908910, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930383733323b69647c733a313a2231223b757365724e616d657c733a31393a2261646d696e406861707079656c6465722e7065223b70617373776f72647c733a34303a2262373464373963633738363439343332663937316239366130376236663537666263326230303066223b66756c6c4e616d657c733a31363a2241646d696e204861707079456c646572223b726f6c7c733a313a2231223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a2241646d696e223b6c6173744e616d657c733a31303a224861707079456c646572223b74656c6570686f6e657c733a393a22393833333639313636223b70686f746f7c733a33383a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f61646d696e2e6a7067223b686173687c733a303a22223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('g64qir0r7uu164fmt63graqspc4ulvl4', '127.0.0.1', 1539909914, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393930393632303b69647c733a323a223136223b757365724e616d657c733a32313a22646361726c6f73406861707079656c6465722e7065223b70617373776f72647c733a34303a2235653439313261373433313136366632393061303533353937376266393536333936326539393430223b66756c6c4e616d657c733a32313a22446965676f204361726c6f732043617374696c6c6f223b726f6c7c733a313a2233223b7374617475737c733a383a22617070726f766564223b66697273744e616d657c733a353a22446965676f223b6c6173744e616d657c733a31353a224361726c6f732043617374696c6c6f223b74656c6570686f6e657c733a393a22393933373931363739223b70686f746f7c733a33363a22687474703a2f2f6861707079656c6465722e70652f75706c6f6164732f4932352e6a7067223b686173687c733a363a22313233343536223b727074317c733a303a22223b727074327c733a303a22223b727074337c733a303a22223b727074347c733a303a22223b727074357c733a303a22223b727074367c733a303a22223b),
('gtnmente4fb5n0pbunj2ufu5q3cjbppi', '127.0.0.1', 1539911969, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533393931313936393b),
('jhj2as703fgec0k7i1h9b5j9gm6ta9c8', '127.0.0.1', 1540334054, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303333343035313b),
('76tbvt8f4imokv0n2rm7jptdtfi9pmhr', '127.0.0.1', 1540337463, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303333373436313b),
('73hicmn4nq57jna576p6mqjs4idmg5iu', '127.0.0.1', 1540475578, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437353536383b),
('5osuqs3437ghpsmi63j11s0528d8s5ma', '127.0.0.1', 1540477650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437373434343b),
('jv0ta8m1o8kop5l3svplcsf7s25to3op', '127.0.0.1', 1540478035, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437373736303b),
('bh8b8bqhmqlg7levlgcpshv791tftva6', '127.0.0.1', 1540478418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437383431373b),
('5lulrkjcdcc9b3fct4jsgocmrs5ng8g4', '127.0.0.1', 1540479034, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437383739333b),
('33ujhi32frh9vtrmsvnulju45f7kvtol', '127.0.0.1', 1540479232, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534303437393233323b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'user',
  `val` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(600) NOT NULL,
  `video` varchar(400) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'publish'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment`, `date_added`, `type`, `val`, `photo`, `video`, `status`) VALUES
(1, 1, 14, 'Buen servicio!', '2018-10-15 01:13:47', 'product', 0, '', '', 'publish'),
(2, 1, 15, 'Buen servicio!', '2018-10-15 01:14:02', 'product', 0, '', '', 'publish'),
(3, 1, 15, 'wweqweqwe', '2018-10-15 01:14:09', 'product', 0, '', '', 'trash'),
(4, 1, 15, 'Servicio de calidad!', '2018-10-15 01:54:17', 'product', 0, '', '', 'publish'),
(5, 1, 15, 'sdsdsd', '2018-10-15 01:54:52', 'product', 0, '', '', 'trash'),
(6, 1, 15, 'sdsdsdsdas', '2018-10-15 01:55:10', 'product', 0, '', '', 'trash'),
(7, 1, 15, 'sdasas', '2018-10-15 01:55:15', 'product', 0, '', '', 'trash'),
(8, 1, 15, 'por mas personas como tu', '2018-10-15 01:58:24', 'product', 0, '', '', 'publish'),
(9, 1, 15, 'asdas', '2018-10-15 01:58:27', 'product', 0, '', '', 'trash'),
(10, 1, 13, 'servicio de calidad!', '2018-10-15 02:01:08', 'product', 0, '', '', 'publish'),
(11, 1, 13, 'asdasd', '2018-10-15 04:47:02', 'user', 0, '', '', 'trash'),
(12, 1, 13, 'asdasd', '2018-10-15 04:47:05', 'user', 0, '', '', 'trash'),
(13, 1, 13, 'asd', '2018-10-15 04:47:39', 'user', 3, '', '', 'trash'),
(14, 1, 13, 'asd', '2018-10-15 04:47:44', 'user', 5, '', '', 'trash'),
(15, 40, 16, 'asdasd', '2018-10-16 07:06:45', 'user', 0, 'http://happyelder.pe/uploads/Screenshot_1534359102.png', '', 'trash'),
(16, 40, 16, 'asdasd', '2018-10-16 07:06:56', 'user', 0, 'http://happyelder.pe/uploads/Screenshot_1534359102.png', '', 'trash'),
(17, 40, 16, 'asdasd', '2018-10-16 07:07:09', 'user', 0, 'http://happyelder.pe/uploads/logo_ebp.png', '', 'trash'),
(18, 1, 13, 'asdasdasd', '2018-10-16 15:07:50', 'user', 0, '', '', 'trash'),
(19, 1, 13, '2222', '2018-10-16 15:07:54', 'user', 0, '', '', 'trash'),
(20, 1, 13, 'asdasd', '2018-10-16 15:08:01', 'user', 0, '', '', 'trash'),
(21, 1, 13, 'das dasd', '2018-10-16 15:08:11', 'user', 0, '', '', 'trash'),
(22, 1, 13, 'asdas dasd', '2018-10-16 15:08:36', 'user', 0, '', '', 'trash'),
(23, 1, 13, 'sssss', '2018-10-16 15:08:43', 'user', 0, '', '', 'trash'),
(24, 1, 13, 'adsads', '2018-10-16 15:09:52', 'user', 0, '', '', 'trash'),
(25, 1, 13, 'asdasd', '2018-10-16 15:10:44', 'user', 0, 'http://happyelder.pe/uploads/Screenshot_1.png', '', 'trash'),
(26, 1, 13, 'as dasd asd', '2018-10-16 15:10:48', 'user', 0, '', '', 'trash'),
(27, 1, 13, 'hjhjjhhj', '2018-10-17 02:48:41', 'user', 0, 'http://happyelder.pe/uploads/Screenshot_1534359102.png', '', 'trash'),
(28, 1, 13, 'asdasd', '2018-10-17 03:01:29', 'user', 2, 'http://happyelder.pe/uploads/Screenshot_1.png', 'http://happyelder.pe/uploads/Screenshot_1.png', 'trash'),
(29, 1, 13, 'asdasd', '2018-10-17 03:01:52', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ig.jpg', 'trash'),
(30, 1, 13, 'asdasd', '2018-10-17 03:02:22', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(31, 1, 13, 'asdasd', '2018-10-17 03:02:43', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(32, 1, 13, 'asdasd', '2018-10-17 03:02:45', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(33, 1, 13, 'asdasd', '2018-10-17 03:02:59', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(34, 1, 13, 'asdasd', '2018-10-17 03:03:04', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(35, 1, 13, 'asdasd', '2018-10-17 03:03:05', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(36, 1, 13, 'asdasd', '2018-10-17 03:03:05', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(37, 1, 13, 'asdasd', '2018-10-17 03:05:40', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(38, 1, 13, 'asdasd', '2018-10-17 03:05:41', 'user', 0, 'http://happyelder.pe/uploads/ig.jpg', 'http://happyelder.pe/uploads/ico_face.png', 'trash'),
(39, 1, 13, 'fsdfsd', '2018-10-17 03:10:25', 'user', 0, '', 'http://happyelder.pe/uploads/Regina_por_que_no_eres_una_actriz_normal_SubeteAlBarco_de_Eugenio_Derbez.mp4', 'trash'),
(40, 32, 19, 'Me gusta los servicios que ofreces', '2018-10-18 21:09:50', 'user', 5, '', '', 'publish'),
(41, 32, 19, 'Publico con foto', '2018-10-18 21:10:07', 'user', 0, 'http://happyelder.pe/uploads/C2.jpg', '', 'publish'),
(42, 32, 19, 'v', '2018-10-18 21:13:39', 'user', 0, '', 'http://happyelder.pe/uploads/VID-20180831-WA0002.mp4', 'trash'),
(43, 32, 19, 'Ahora con video', '2018-10-18 21:14:45', 'user', 0, '', 'http://happyelder.pe/uploads/VID-20180831-WA0002.mp4', 'publish'),
(44, 32, 19, 'Ahora con foto , video y puntuacion', '2018-10-18 21:15:07', 'user', 0, 'http://happyelder.pe/uploads/IMG-20180901-WA0015.jpg', 'http://happyelder.pe/uploads/VID-20180831-WA0002.mp4', 'trash'),
(45, 32, 19, 'ahora con foto, video ', '2018-10-18 21:15:34', 'user', 0, 'http://happyelder.pe/uploads/IMG-20180901-WA0001.jpg', 'http://happyelder.pe/uploads/VID-20180831-WA0002.mp4', 'trash'),
(46, 16, 16, 'Ofrezco servicios', '2018-10-19 00:40:59', 'user', 5, '', '', 'publish'),
(47, 16, 16, 'd', '2018-10-19 00:44:34', 'user', 0, '', '', 'trash');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'publish',
  `user_id` int(11) NOT NULL,
  `organizer` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `dateEvent` date NOT NULL,
  `slug` varchar(200) NOT NULL,
  `donaciones` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `name`, `description`, `photo`, `status`, `user_id`, `organizer`, `location`, `dateEvent`, `slug`, `donaciones`) VALUES
(1, 'EL CLUB DE LA COMEDIA', 'Se organizará fiestas a sus residentes en Halloween, Navidad, el último sábado de cada mes y en cumpleaños. Lo que hacemos es ir allí y montarles fiestas con música, gymkanas con juegos, actuaciones de cumpleaños o cualquier otra cosa que se nos ocurre dependiendo del momento y la satisfacción para nosotros es tan grande que no sólo nos está aportando beneficios este nuevo servicio sino que también nos está trayendo beneficios personales. Ver la cara de los ancianos riendo y jugando es todo un orgullo para nosotros.', 'http://happyelder.pe/uploads/I5.jpg', 'publish', 13, 'Nico Quispe', 'Lima', '2018-09-15', 'el-club-de-la-comedia', 1),
(2, 'VENTAS PARA GANADORES - SEMINARIO INTERNACIONAL', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\r\n\r\nVive la experiencia a través del Diseño, Marketing y Fotografía\r\n\r\nAsiste a nuestros talleres gratuitos en:\r\n\r\n- Foto: Fotografía de producto\r\n- Diseño: La imagen comunica\r\n- Interiores: Accesorios y complementos decorativos\r\n\r\n\r\nHora: 6:30 pm\r\nFecha: 22 de agosto\r\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)', 'https://s3-us-west-2.amazonaws.com/joinnus.com/user/21289/act5b560534b8fbf.jpg', 'trash', 1, 'asdasd', 'asdasdasd', '0000-00-00', 'ventas-para-ganadores-seminario-internacional', 0),
(8, 'Eres Más - Lima Sur', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)', 'https://s3-us-west-2.amazonaws.com/joinnus.com/user/21289/act5b560534b8fbf.jpg', 'trash', 1, '', '', '0000-00-00', 'event-3', 0),
(9, 'Evento Gratuito: NETWORKING CREATIVO', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)', 'https://s3-us-west-2.amazonaws.com/joinnus.com/user/21289/act5b560534b8fbf.jpg', 'trash', 1, '', '', '0000-00-00', 'event-4', 0),
(13, 'DADDY YANKEE | TOUR DURA', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)', 'https://s3-us-west-2.amazonaws.com/joinnus.com/user/21289/act5b560534b8fbf.jpg', 'trash', 1, '', '', '0000-00-00', 'event-5', 0),
(14, 'dfg', 'dfgdfgd', 'http://happyelder.pe/uploads/unnamed_2.png', 'trash', 13, 'fgdfg', 'fdgdfgdf', '2018-02-05', 'dfg', 0),
(15, 'Talleres de Verano para Adultos Mayores', 'En el transcurso de cada jornada participarán de talleres de música, tango, plástica, yoga, caminatas, gimnasia de bajo impacto (Acqua Gym), y  actividades especiales ( intergeneracionales, almuerzos recreativos, fiestas de disfraces y temáticas, entre otras).', 'http://happyelder.pe/uploads/I6.JPG', 'publish', 16, 'Diego Carlos', 'Lima', '2018-10-15', 'talleres-de-verano-para-adultos-mayores', 2),
(16, 'Festejo de cumpleanhos', 'El día 20 de Septiembre celebramos los cumpleaños de todos los residentes que han cumplido años en el ultimo mes. Felicidades a todos!!', 'http://happyelder.pe/uploads/I7.jpg', 'publish', 1, 'Yesenia Olivares', 'Lima', '2018-09-20', 'festejo-de-cumpleanhos', 0),
(17, 'Integrador 222', 'Integrador 2', 'http://happyelder.pe/uploads/1.jpg', 'trash', 1, 'Yamil', 'Lima', '2018-10-02', 'integrador-222', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`role_id`, `name`) VALUES
(1, 'Aministrador'),
(2, 'Visitante'),
(3, 'Voluntario'),
(4, 'Enfermera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'publish',
  `schedule` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `visitante_id` int(11) NOT NULL,
  `visitanteFecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `name`, `description`, `photo`, `status`, `schedule`, `price`, `user_id`, `slug`, `visitante_id`, `visitanteFecha`) VALUES
(1, 'Cuidador responsable de ancianos a domicilio', 'Hola soy auxiliar de. Enfermería nacionalidad colombiana experiencia en salud ; hospitales , clinicas ; cuidado de niños y adultos mayores ! hace aproximadamente 8 años. Tengo 28 años de edad tengo buena actitud para desempeñarme soy una amable; respetuosa y muy ...', 'https://www.cronoshare.com/assets/avatar-pro/elderly/9-d599bf44f437fdb45a85e4c598f5cebb.jpg', 'trash', '', 0, 13, 'service--1', 0, '0000-00-00'),
(2, 'Cuidador profesional de ancianos a domicilio', 'Cuidado de personas mayores, 10 años de experiencia con referencia, actualmente estoy estudiando curso de geriatria', 'http://happyelder.pe/uploads/I3.jpg', 'reservado', '7:00 am a 5:00 pm', 70, 13, 'cuidador-profesional-de-ancianos-a-domicilio', 12, '2018-09-21'),
(3, 'Cuidador puntual de ancianos a domicilio', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)Camarero en 100 montaditos 2 años, ayudante de camarero hotel don sancho, cafeteria restaurante tertulia.', 'https://www.cronoshare.com/assets/avatar-pro/elderly/10-874dcca5c55bcc183381c1b4ee2a4780.jpg', 'trash', '', 0, 1, 'service--3', 0, '0000-00-00'),
(4, 'Cuidador por horas de ancianos a domicilio', 'Hola soy victoria tengo papeles experiencias referencias en el cuidado de mayores para fines de semanas y festivos llama al disponibilidad de inmediata', 'http://happyelder.pe/uploads/I2.jpg', 'publish', '4:00 pm a 8:00 pm', 50, 13, 'cuidador-por-horas-de-ancianos-a-domicilio', 12, '2018-09-29'),
(6, 'Cuidador para ancianos a domicilio', 'He trabajado aqui en madrid como profesora de ingles desde 2007. Trabajo en empresas con grupos o individuales y tambien con clases telefonicas y con una plataforma de internet. Tengo alumnos del infantil hasta pensionistas. Alumno mas pequeno es 1,5 anos y mas major... ', 'https://www.cronoshare.com/assets/avatar-pro/elderly/6-2fb244d6bb4154691527cc32e78b946e.jpg', 'trash', '', 0, 1, 'service--5', 0, '0000-00-00'),
(7, 'Cuidador por horas de ancianos a domicilio', 'En geriátrico, limpieza de a citaciones, y zonas comunes, y trabaje en lavandería , y en comedor, estuve también de camarera ,', 'https://www.cronoshare.com/assets/avatar-pro/elderly/7-2526aeed7b969e39f6a0fde626b2ff1f.jpg', 'trash', '', 0, 1, 'service--6', 0, '0000-00-00'),
(8, 'Cuidador responsable de ancianos a domicilio', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)Buenos dias, soy bulgara con 15 años de experiencia en la cocina española, cocino muy bien, tambien tengo titulo de auxiliar de gueriatria. Me interesa esta oferta de empleo grasias!', 'https://www.cronoshare.com/assets/avatar-pro/elderly/2-25436b8d331745e67bce21f1886ee6e5.jpg', 'trash', '', 0, 1, 'service--7', 0, '0000-00-00'),
(10, 'Ofrezco atención por horas para personas  mayores', 'Para ayudarles en su movilidad, como acompañamiento, como apoyo al aseo personal, a vestir y desvestir, administración de medicamentos, limpieza del domicilio, preparación de comidas puedes contar con las cuidadoras profesionales por horas de Interdomicilio.', 'http://happyelder.pe/uploads/I4.jpg', 'publish', '10:00 am a 6:00 pm', 89, 1, 'ofrezco-atencion-por-horas-para-personas-mayores', 28, '2018-09-25'),
(11, 'asdasda sdas asd asdasdasdas dasd', 'sda sdas dasda', '', 'trash', 'asda asd asd as', 2323222, 1, 'asdasda-sdas-asd-asdasdasdas-dasd', 0, '0000-00-00'),
(12, 'asda sdas dasd a', 'sd asda sdasd', 'http://happyelder.pe/uploads/unnamed.png', 'trash', 'asdqe qwd asdas', 323, 13, 'asda-sdas-dasd-a', 0, '0000-00-00'),
(13, 'Ama de Casa', 'Enfocado para mayores de edad de 60 años que tengan necesidad de asistencia con por lo menos 2 actividades de la vida cotidiana', 'http://happyelder.pe/uploads/I1.jpg', 'publish', '8:00 am a 8:00 pm', 100, 15, 'ama-de-casa', 12, '2018-09-23'),
(14, 'Prestaciones medicas para ancianos', 'Se ofrece un seguro a largo plazo', 'http://happyelder.pe/uploads/I8.jpg', 'publish', '4:00 pm a 7:00 pm', 40, 16, 'prestaciones-medicas-para-ancianos', 12, '2018-09-12'),
(16, 'Cuidadora interna entre semana', 'Con el servicio Interna Entre Semana, dispondrás de una cuidadora interna dedicada exclusivamente a la atención de tu mayor, que se adaptará perfectamente a su personalidad y costumbres diarias.\r\n\r\nTu ser querido podrá seguir en su casa con la máxima atención, seguridad, tranquilidad y confort, sin que tú pierdas ninguna información sobre la evolución de su salud.', 'http://happyelder.pe/uploads/I13.jpg', 'publish', '9:00 am a 10:00 pm', 80, 27, 'cuidadora-interna-entre-semana', 0, '0000-00-00'),
(17, 'Cuidadora interna en medio de semana', 'Con el servicio Interna Entre Semana, dispondrás de una cuidadora interna dedicada exclusivamente a la atención de tu mayor, que se adaptará perfectamente a su personalidad y costumbres diarias.\r\n\r\nTu ser querido podrá seguir en su casa con la máxima atención, seguridad, tranquilidad y confort, sin que tú pierdas ninguna información sobre la evolución de su salud.', '', 'trash', '9:00 am a 10:00 pm', 80, 27, 'cuidadora-interna-en-medio-de-semana', 0, '0000-00-00'),
(22, 'Servicios para fin de semana', 'Se ofrece acompañamiento durante todo el fin de semana, para que la persona mayor se sienta acompañada y con total seguridad.\r\n\r\nLa solución perfecta para que puedas disponer de todos los sábados y domingos sin ninguna preocupación, mientras tu mayor está atendido y cuidado con la máxima dedicación y profesionalidad por uno de nuestros mejores cuidadores.', 'http://happyelder.pe/uploads/I13.jpg', 'publish', '8:00 am a 6:00 pm', 100, 25, 'servicios-para-fin-de-semana', 28, '2018-09-28'),
(23, 'Servicios de todo un fin de semana', 'Una cuidadora interna es una profesional del cuidado de mayores con referencias válidas, además de experiencia y formación previa.', 'http://happyelder.pe/uploads/I14.jpg', 'publish', '6:00 am a 7:00 pm', 75, 27, 'servicios-de-todo-un-fin-de-semana', 28, '2018-09-13'),
(24, 'ejemplo1', 'ddf', '', 'trash', '8:00 am a 8:00 pm', 490, 16, 'ejemplo1', 28, '2018-09-18'),
(25, 'prueba2', 'prueba', '', 'trash', '7:00 am a 5:00 pm', 34, 16, 'prueba2', 28, '2018-09-20'),
(26, 'prueba3', '3', '', 'trash', '8:00 am a 8:00 pm', 34, 16, 'prueba3', 28, '2018-09-15'),
(27, 'prueba4', 'f', '', 'trash', '8:00 am a 8:00 pm', 56, 16, 'prueba4', 0, '0000-00-00'),
(28, 'prueba5', 'g', '', 'trash', '7:00 am a 5:00 pm', 46, 15, 'prueba5', 28, '2018-09-25'),
(29, 'Cuidados básicos', 'El aseo e higiene personal ayuda a las personas a relajarse y prevenir enfermedades, por lo que te prestaremos el apoyo necesario para el día a día.', 'http://happyelder.pe/uploads/I15.jpg', 'publish', '7:00 am a 6:00 pm', 90, 15, 'cuidados-basicos', 0, '0000-00-00'),
(30, 'Servicios de carácter rehabilitador', 'Prestado por personal cualificado, para facilitar, mantener o devolver el mayor grado de capacidad funcional e independencia posible, en personas con el riesgo de desarrollar una discapacidad.', 'http://happyelder.pe/uploads/I16.jpg', 'publish', '6:00 am a 4:00 pm', 110, 15, 'servicios-de-caracter-rehabilitador', 28, '2018-09-27'),
(31, 'Navidad', '...', 'http://happyelder.pe/uploads/1.jpg', 'trash', '8:00 am a 8:00 pm', 100, 34, 'navidad', 18, '2018-10-08'),
(32, '3443', '4334', '', 'trash', '34dfg', 0, 24, '3443', 0, '0000-00-00'),
(33, 'Servicios para liberación de estrés', 'Se brinda dinámicas con el fin de liberar el estrés acumulado,dichas dinámicas consta de realizar actividades o juegos', 'http://happyelder.pe/uploads/C1.jpg', 'publish', '8:00 am a 1:00 pm', 65, 15, 'servicios-para-liberacion-de-estres', 0, '0000-00-00'),
(34, 'Servicios terapeuticos', 'Se ofrece servicios terapéuticos para eliminar dolores musculares, se realiza estiramientos ,masajes .Sabemos que el ejercicio es un hábito bastante saludable independientemente dela edad que se tenga, y es especialmente beneficioso para las personas de la tercera edad.', 'http://happyelder.pe/uploads/C2.jpg', 'publish', '7:00 am a 2:00 pm', 72, 17, 'servicios-terapeuticos', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'publish',
  `address` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `name`, `description`, `photo`, `status`, `address`, `slug`) VALUES
(1, 'Cuidador responsable de ancianos a domicilio', 'Hola soy auxiliar de. Enfermería nacionalidad colombiana experiencia en salud ; hospitales , clinicas ; cuidado de niños y adultos mayores ! hace aproximadamente 8 años. Tengo 28 años de edad tengo buena actitud para desempeñarme soy una amable; respetuosa y muy ...', 'https://www.cronoshare.com/assets/avatar-pro/elderly/9-d599bf44f437fdb45a85e4c598f5cebb.jpg', 'trash', '', 'location-1'),
(2, 'Cuidador profesional de ancianos a domicilio', 'Cuidado de personas mayores, 10 años de experiencia con referencia, actualmente estoy estudiando curso de geriatria', 'https://www.cronoshare.com/assets/avatar-pro/elderly/3-8898fc8df5f1ec7a18b89f543f002541.jpg', 'trash', '', 'location-2'),
(3, 'Residencia geriatrica', 'Descripción:Casa de Reposo el Roble, somos una institución comprometida con la atención y el cuidado del Adulto Mayor, conformada por un sólido equipo de profesionales: preparados para brindarles a nuestros residentes la atención y el cariño que sólo pueden esperar de sus seres queridos.', 'http://happyelder.pe/uploads/I9.jpg', 'publish', 'Calle Las Cascadas del Sol 240  Urb. El Sol de la Molina', 'residencia-geriatrica'),
(4, 'Casa de reposo y rehabilitacion', 'El Centro de Reposo y Rehabilitación La Molina, cuenta con 28 años de experiencia en el sector.\r\nDispone de instalaciones especialmente construidas para la atención del Adulto Mayor (área de recreación, área de visitas y área de oración).', 'http://happyelder.pe/uploads/I10.jpg', 'publish', 'Avenida Viña del Mar 135  Urb. Sol de La Molina - 1º Etapa', 'casa-de-reposo-y-rehabilitacion'),
(6, 'Cuidador para ancianos a domicilio', 'He trabajado aqui en madrid como profesora de ingles desde 2007. Trabajo en empresas con grupos o individuales y tambien con clases telefonicas y con una plataforma de internet. Tengo alumnos del infantil hasta pensionistas. Alumno mas pequeno es 1,5 anos y mas major... ', 'https://www.cronoshare.com/assets/avatar-pro/elderly/6-2fb244d6bb4154691527cc32e78b946e.jpg', 'trash', '', 'location-5'),
(7, 'Cuidador por horas de ancianos a domicilio', 'En geriátrico, limpieza de a citaciones, y zonas comunes, y trabaje en lavandería , y en comedor, estuve también de camarera ,', 'https://www.cronoshare.com/assets/avatar-pro/elderly/7-2526aeed7b969e39f6a0fde626b2ff1f.jpg', 'trash', '', 'location-6'),
(8, 'Cuidador responsable de ancianos a domicilio', 'Vive la experiencia a través del Diseño, Interiores y Fotografía.\n\nVive la experiencia a través del Diseño, Marketing y Fotografía\n\nAsiste a nuestros talleres gratuitos en:\n\n- Foto: Fotografía de producto\n- Diseño: La imagen comunica\n- Interiores: Accesorios y complementos decorativos\n\n\nHora: 6:30 pm\nFecha: 22 de agosto\nLugar: Sede Lima Sur, en el C.C Plaza Lima Sur (frente a la granjita)Buenos dias, soy bulgara con 15 años de experiencia en la cocina española, cocino muy bien, tambien tengo titulo de auxiliar de gueriatria. Me interesa esta oferta de empleo grasias!', 'https://www.cronoshare.com/assets/avatar-pro/elderly/2-25436b8d331745e67bce21f1886ee6e5.jpg', 'trash', '', 'location-7'),
(9, 'Centro geriatrico señor de los milagros', 'El Centro Geriátrico “Señor de los Milagros” se encuentra en CHOSICA, un lugar bendecido por su excelente clima.\r\nEl Centro Geriátrico se caracteriza por su alta calidad humana y profesionalismo.', 'http://happyelder.pe/uploads/I11.jpg', 'publish', 'Calle Micaela Bastidas 123  Urb. San Carlos - Alto Chosica', 'centro-geriatrico-senor-de-los-milagros'),
(10, 'Enfermeras Gloria', 'Somos CEG Gloria E.I.R.L., un reconocido centro de enfermería geriátrica que cuenta con especialistas en el cuidado y la atención integral del adulto mayor.\r\nEstamos ubicados en Cercado de Lima, contáctenos para asesorarlo en lo que necesite.', 'http://happyelder.pe/uploads/I12.jpg', 'publish', 'Avenida Alejandro Tirado 624  Urb. Santa Beatriz', 'enfermeras-gloria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT '2',
  `status` set('pending','approved','trash','canceled') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `hash` varchar(200) NOT NULL,
  `rpt1` varchar(200) NOT NULL,
  `rpt2` varchar(200) NOT NULL,
  `rpt3` varchar(200) NOT NULL,
  `rpt4` varchar(200) NOT NULL,
  `rpt5` varchar(200) NOT NULL,
  `rpt6` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `userName`, `password`, `fullName`, `rol`, `status`, `firstName`, `lastName`, `telephone`, `photo`, `hash`, `rpt1`, `rpt2`, `rpt3`, `rpt4`, `rpt5`, `rpt6`) VALUES
(1, 'admin@happyelder.pe', 'b74d79cc78649432f971b96a07b6f57fbc2b000f', 'Admin HappyElder', 1, 'approved', 'Admin', 'HappyElder', '983369166', 'http://happyelder.pe/uploads/admin.jpg', '', '', '', '', '', '', ''),
(13, 'nico2@ebp.pe', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Nico Quispe', 3, 'approved', 'Nico', 'Quispe', '765432098', 'http://happyelder.pe/uploads/I26.jpg', 'c0ad0a6ccad77c2d5021fdf43005c8e0d23e5b97', '', '', '', '', '', ''),
(15, 'luuceroo01@gmail.com', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Lucero Olivares Villena', 4, 'approved', 'Lucero', 'Olivares Villena', '99999999999999999999', 'http://happyelder.pe/uploads/I22.jpg', '2c07b9675d27a3b87e5eb450f179bceb775717d0', '', '', '', '', '', ''),
(16, 'dcarlos@happyelder.pe', '5e4912a7431166f290a0535977bf9563962e9940', 'Diego Carlos Castillo', 3, 'approved', 'Diego', 'Carlos Castillo', '993791679', 'http://happyelder.pe/uploads/I25.jpg', '123456', '', '', '', '', '', ''),
(17, 'yolivares@happyelder.pe', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Yesenia Olivares Villena', 4, 'approved', 'Yesenia', 'Olivares Villena', '987863415', 'http://happyelder.pe/uploads/I23.jpg', '1234567', '', '', '', '', '', ''),
(18, 'aargume@happyelder.pe', '648cdb0c5d168ab7976dd14fe28312a3d5f0cc78', 'Ana Argume Sandoval', 2, 'approved', 'Ana', 'Argume Sandoval', '985643267', '', '12345678', '', '', '', '', '', ''),
(19, 'rsoria@happyelder.pe', '033208583e39c33ab378543dc2884d4da3577eae', 'Ricardo Soria Lopez', 3, 'approved', 'Ricardo', 'Soria Lopez', '907345987', 'http://happyelder.pe/uploads/I27.jpg', '123456789', '', '', '', '', '', ''),
(20, 'lortega@happyelder.pe', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Luz Ortega', 1, 'trash', 'Luz', 'Ortega', '987650915', '', '67a74306b06d0c01624fe0d0249a570f4d093747', '', '', '', '', '', ''),
(21, 'ccasapia@happyelder.pe', '64dbbcf8cdcd602a5324583148b5f4222b429a30', 'Carlos Casapia', 1, 'approved', 'Carlos', 'Casapia', '987456315', 'http://happyelder.pe/uploads/I28.jpg', '1234', '', '', '', '', '', ''),
(22, 'apacheco@happyelder.pe', '0ffcc4bff38f365113be45ea5b3836dad7243b4f', 'Adriana Pacheco', 1, 'approved', 'Adriana', 'Pacheco', '908923654', '', '123', '', '', '', '', '', ''),
(23, 'aangulo@happyelder.pe', '98abbc762d6736a010802d52baf13cdff97c5cff', 'Alejandra Angulo', 2, 'approved', 'Alejandra', 'Angulo', '980543178', '', '15926', '', '', '', '', '', ''),
(24, 'hchirinos@happyelder.pe', '4523944312bd832d4391522e864490cc26092432', 'Hector Chirinos', 3, 'approved', 'Hector', 'Chirinos', '976543210', 'http://happyelder.pe/uploads/I29.jpg', '147852', '', '', '', '', '', ''),
(25, 'janahue@happyelder.pe', '46bdc5c7cac628d8b3e9de84daf46b2bc08191a3', '', 4, 'trash', 'Joel', 'Anahue', '908345182', '', '67a74306b06d0c01624fe0d0249a570f4d093747', '', '', '', '', '', ''),
(26, 'd_pena@happyelder.pe', '33794aa2a3986a0267edcd803863609fe6d0e992', 'Diego Peña', 3, 'approved', 'Diego', 'Peña', '567890234', 'http://happyelder.pe/uploads/I30.jpg', '123654', '', '', '', '', '', ''),
(27, 'c_castillo@happyelder.pe', '9a8a8c3cf180fda8d5840159b6e300dbc64f9572', 'Cristina Castillo', 4, 'approved', 'Cristina', 'Castillo', '345098712', 'http://happyelder.pe/uploads/I24.jpg', '1452369', '', '', '', '', '', ''),
(28, 'lolivaresv13@gmail.com', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Lucero Olivar Valencia', 2, 'trash', 'Lucero', 'Olivar Valencia', '987089042', '', '', '', '', '', '', '', ''),
(29, 'lucero@happyelder.pe', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Ñ Ñ', 3, 'trash', 'Lucero', 'Hernandez Soto', '951357486', '', '', '', '', '', '', '', ''),
(30, 'lortegav@happyelder.pe', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Luz Villena Ortega', 1, 'approved', 'Luz', 'Villena Ortega', '951236478', '', '12698547', '', '', '', '', '', ''),
(31, 'lucero@happy.com', '1308732d2911ddf7d5e8678c17ce9967c77aae42', 'f f  dffd', 1, 'trash', 'f', 'f  dffd', '99999999', '', '67a74306b06d0c01624fe0d0249a570f4d093747', '', '', '', '', '', ''),
(32, 'diestone29@gmail.com', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Diego Castillo', 4, 'approved', 'Diego', 'Castillo', '993791679', 'http://happyelder.pe/uploads/I31.jpg', 'e7854f7ec8028b1854c0fa523edf41c45c488610', '', '', '', '', '', ''),
(33, 'yquinones@happyelder.pe', '12d2d7f7625ff0e7a58eb623c00a6303d675d3d5', 'Yamil Quiñoñes', 3, 'trash', 'Yamil', 'Quiñoñes', '888888888', '', 'd2c0729727ea92563d7f16c2bef1be89c306269e', '', '', '', '', '', ''),
(34, 'c14095@utp.edu.pe', '2a97294d29a46e9119d40a6ee2eb278023cb7c98', 'Yamil Quiñones', 3, 'approved', 'Yamil', 'Quiñones', '999999999', 'http://happyelder.pe/uploads/I33.jpg', '66a95b9ea4ba0862b3eb53d039fa8c4581eae482', '', '', '', '', '', ''),
(39, 'nico@ebp.pe', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'NICO QUISPE', 2, 'pending', 'NICO', 'QUISPE', '234234224', 'http://happyelder.pe/uploads/Screenshot_1534359102.png', '5fa652037af60ad9e7e8e2fb4323f6668e08dea2', '', '', '', '', '', ''),
(40, 'nico3@ebp.pe', '7f06c04d59bd83605193621e8d0d693bd30cdc9e', 'Nico Quispe', 2, 'approved', 'Nico', 'Quispe', '23423423', 'http://happyelder.pe/uploads/I32.png', '38e43c1da7398cff21a525d4c39f5b8a1a661f3d', '', '', '', '', '', ''),
(41, 'olivareslucero85@gmail.com', '299ddc01e5b878ee01ee7415c1dddee2d57982d8', 'Lucia Mendez Figueroa', 4, 'approved', 'Lucia', 'Mendez Figueroa', '962111447', 'http://happyelder.pe/uploads/C1.jpg', '2e1cb7e3db3f1be3fccb96aff3bd768dfb34990d', 'Sí', 'Sí', 'Hostilmente', 'Me gusta ayudar a quienes lo necesitan', 'No', 'Sí');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `location_id` (`location_id`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `visitante_id` (`visitante_id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD CONSTRAINT `beneficiarios_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
