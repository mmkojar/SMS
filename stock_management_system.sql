-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 06:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(20, '183.87.80.104', 'jameel@hne.com', '2022-06-15 06:06:40'),
(22, '103.44.50.129', 'test@admin.com', '2022-06-15 08:06:16'),
(23, '::1', 'test@gmail.com', '2022-06-16 10:06:50'),
(24, '::1', 'test@gmail.com', '2022-06-16 10:06:35'),
(25, '::1', 'test@gmail.com	', '2022-07-06 07:07:17'),
(26, '::1', 'test@gmail.com', '2022-07-06 07:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `sms_available`
--

CREATE TABLE `sms_available` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_available`
--

INSERT INTO `sms_available` (`id`, `item_id`, `unit`, `qty`, `rate`, `date`, `created_at`, `updated_at`) VALUES
(2, 2, 'KG', 116, '58.69', '2022-06-16', '2022-06-16 09:59:41', '2022-11-05 10:52:55'),
(3, 107, 'KG', 49, '659.67', '2022-06-23', '2022-06-23 04:02:10', '2022-07-20 03:23:53'),
(4, 8, 'KG', 36, '270', '2022-07-05', '2022-07-05 08:33:49', '2022-09-23 10:43:21'),
(5, 5, 'KG', 19, '46', '2022-07-05', '2022-07-05 08:34:05', '2022-07-20 03:01:27'),
(6, 3, 'KG', 50, '112', '2022-09-14', '2022-09-14 12:13:58', '2022-09-14 12:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `nz_department`
--

CREATE TABLE `nz_department` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nz_department`
--

INSERT INTO `nz_department` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'MASALA', '2022-03-17 07:27:56', '2022-06-13 09:53:03'),
(3, 'CHICKEN', '2022-03-20 12:29:53', '2022-06-13 09:53:19'),
(4, 'MUTTON', '2022-06-13 09:55:51', NULL),
(5, 'AATA//MAIDA//SUGAR', '2022-06-13 09:56:01', '2022-06-13 09:56:20'),
(6, 'MILK', '2022-06-13 09:56:45', NULL),
(7, 'VEGETABLES', '2022-06-13 09:56:57', NULL),
(8, 'OIL//GHEE', '2022-06-13 09:57:23', NULL),
(9, 'COLD DRINK//MINERAL WATER', '2022-06-13 09:58:05', NULL),
(10, 'CONTAINERS//CARRY BAGS', '2022-06-13 09:58:13', '2022-06-14 07:02:41'),
(12, 'CHINESE', '2022-06-14 06:49:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nz_items`
--

CREATE TABLE `nz_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `min_qty` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nz_items`
--

INSERT INTO `nz_items` (`id`, `name`, `min_qty`, `created_at`, `updated_at`) VALUES
(2, 'RED MIRCHI POWDER', 70, '2022-03-22 04:03:10', '2022-06-30 10:36:08'),
(3, 'DANIYA POWDER', 10, '2022-03-22 07:23:03', '2022-06-14 08:19:18'),
(4, 'JEERA AKKHA', 10, '2022-03-22 07:23:14', '2022-06-14 08:19:28'),
(5, 'HALDI POWDER', 75, '2022-06-11 04:41:00', '2022-06-14 11:32:07'),
(7, 'MINI CHICKEN', 200, '2022-06-11 05:31:23', '2022-06-14 06:38:26'),
(8, 'BONELESS CHICKEN', 50, '2022-06-11 05:31:42', '2022-06-14 08:19:50'),
(11, 'CHAPATI AATA', 200, '2022-06-14 05:11:56', NULL),
(15, 'MUSTARD OIL', 5, '2022-06-14 05:13:47', NULL),
(16, 'GHEE', 5, '2022-06-14 05:14:02', NULL),
(17, 'TANDOORI ATTA', 200, '2022-06-14 05:14:19', NULL),
(19, 'MAIDA', 100, '2022-06-14 05:15:13', NULL),
(20, 'SUGAR', 100, '2022-06-14 05:15:26', NULL),
(21, 'MIX DAL', 100, '2022-06-14 05:15:40', NULL),
(22, 'BIRYANI RICE', 500, '2022-06-14 05:16:12', NULL),
(23, 'CHINESE RICE', 500, '2022-06-14 05:16:25', NULL),
(24, 'STAFF RICE', 200, '2022-06-14 05:16:40', NULL),
(25, 'BESAN', 10, '2022-06-14 05:16:54', NULL),
(26, 'ARAROT POWDER', 100, '2022-06-14 05:17:14', NULL),
(27, 'AKKHA NAMAK', 50, '2022-06-14 05:17:30', NULL),
(28, 'NAMAK BARIK TATA', 50, '2022-06-14 05:17:47', NULL),
(29, 'BLACK SALT', 10, '2022-06-14 05:18:50', NULL),
(30, 'GREEN PEAS', 25, '2022-06-14 05:19:13', NULL),
(31, 'KABULI CHANA', 10, '2022-06-14 05:19:39', NULL),
(32, 'TEA PATTI', 20, '2022-06-14 05:24:18', NULL),
(33, 'ONION', 300, '2022-06-14 05:24:34', NULL),
(34, 'BIRISTA', 50, '2022-06-14 05:24:50', NULL),
(35, 'POTATO', 20, '2022-06-14 05:25:11', NULL),
(36, 'KOYLA', 50, '2022-06-14 05:25:29', NULL),
(37, 'BAKING POWDER', 5, '2022-06-14 05:25:51', NULL),
(38, 'JEERA POWDER', 5, '2022-06-14 05:26:08', NULL),
(39, 'CHAT MASALA', 5, '2022-06-14 05:26:47', NULL),
(40, 'CHANA MASALA', 5, '2022-06-14 05:27:03', NULL),
(41, 'WHITE PEPPER POWDER', 10, '2022-06-14 05:27:15', NULL),
(42, 'KALIMIRI POWDER', 5, '2022-06-14 05:27:41', NULL),
(43, 'KHANEKA SODA', 5, '2022-06-14 05:34:43', NULL),
(44, 'KICTHEN KING MASALA', 10, '2022-06-14 05:34:55', NULL),
(45, 'TANDOORI MASALA', 50, '2022-06-14 05:35:12', NULL),
(46, 'KACHRI POWDER', 10, '2022-06-14 05:35:22', NULL),
(47, 'KASOORI METHI POWDER', 10, '2022-06-14 05:36:10', NULL),
(48, 'KAJU KANI', 100, '2022-06-14 05:36:28', NULL),
(49, 'SHAHI JEERA', 2, '2022-06-14 05:36:46', NULL),
(50, 'LAVING', 2, '2022-06-14 05:37:03', NULL),
(51, 'GREEN ELAICHI', 2, '2022-06-14 05:37:36', NULL),
(52, 'BIG ELAICHI', 5, '2022-06-14 05:37:55', NULL),
(53, 'KALAMARI AKKHA', 5, '2022-06-14 05:42:43', NULL),
(54, 'JAIFAL', 1, '2022-06-14 05:42:56', NULL),
(55, 'TAJ', 2, '2022-06-14 05:43:24', NULL),
(56, 'TEJ PATTA', 2, '2022-06-14 06:25:04', NULL),
(57, 'BADIYAN STAR FOOL', 1, '2022-06-14 06:25:15', NULL),
(58, 'JAWANTRI', 2, '2022-06-14 06:25:25', NULL),
(59, 'JARDALOO', 1, '2022-06-14 06:25:40', NULL),
(60, 'RAJWADI MASALA', 5, '2022-06-14 06:26:02', NULL),
(61, 'N.R.K. MASALA', 5, '2022-06-14 06:26:12', NULL),
(62, 'DHANIYA AKKHA', 2, '2022-06-14 06:26:23', NULL),
(63, 'BADAM', 2, '2022-06-14 06:26:35', NULL),
(64, 'KAJU FADYA', 5, '2022-06-14 06:26:47', NULL),
(65, 'KAJU TUKDA', 5, '2022-06-14 06:26:58', NULL),
(66, 'KHAMAN COCUNUT POWDER', 3, '2022-06-14 06:27:13', NULL),
(67, 'KALA TILL', 3, '2022-06-14 06:27:27', NULL),
(68, 'WHITE TILL', 3, '2022-06-14 06:27:37', NULL),
(69, 'CAREMAL CUSTARD', 288, '2022-06-14 06:27:52', '2022-06-14 06:28:12'),
(70, 'SABJA', 5, '2022-06-14 06:28:25', NULL),
(71, 'GULAB PAANI', 5, '2022-06-14 06:28:35', NULL),
(72, 'KEWRA PAANI', 5, '2022-06-14 06:28:45', NULL),
(73, 'BEDKI MIRCHI AKKHI', 10, '2022-06-14 06:29:00', NULL),
(74, 'KASHMIRI MIRCHI AKKHI', 20, '2022-06-14 06:29:12', NULL),
(75, 'MADRAS CURRY POWDER', 5, '2022-06-14 06:29:34', NULL),
(76, 'PAPAD', 20, '2022-06-14 06:29:45', NULL),
(77, 'ORANGE RED COLOUR', 50, '2022-06-14 06:30:22', NULL),
(78, 'LEMON YELLOW COLOUR', 10, '2022-06-14 06:30:31', NULL),
(79, 'GREEN APPLE COLOUR', 10, '2022-06-14 06:31:05', NULL),
(80, 'KESAR  COLOUR', 10, '2022-06-14 06:31:17', NULL),
(81, 'CHINA GRASS', 10, '2022-06-14 06:31:28', NULL),
(82, 'SOYA PATTI', 500, '2022-06-14 06:31:38', NULL),
(83, 'TOMATO PATTI', 500, '2022-06-14 06:31:48', NULL),
(84, 'CHILLY PATTI', 500, '2022-06-14 06:31:59', NULL),
(85, 'ACHAAR PATTI', 500, '2022-06-14 06:32:14', NULL),
(86, 'CHILLY FLAKES', 10, '2022-06-14 06:32:27', NULL),
(87, 'SOYA DRUM 5 LTR', 5, '2022-06-14 06:32:41', NULL),
(88, 'RED CHILLY DRUM 20LTR', 5, '2022-06-14 06:32:53', NULL),
(89, 'GREENCHILLY DRUM 5LTR', 5, '2022-06-14 06:33:04', NULL),
(90, 'TOMATO DRUM 5 LTR', 10, '2022-06-14 06:33:30', NULL),
(91, 'WHITE VENIGER', 10, '2022-06-14 06:33:51', NULL),
(92, '8 TO 9', 25, '2022-06-14 06:34:07', NULL),
(93, 'SWEET CORN', 20, '2022-06-14 06:34:21', NULL),
(94, 'MASHROOM (INDIAN)', 10, '2022-06-14 06:34:42', NULL),
(95, 'BAMBOO SHOOTS', 10, '2022-06-14 06:34:52', NULL),
(96, 'OYSTER SAUCE (2.2 kg)', 5, '2022-06-14 06:35:06', NULL),
(97, 'BROTH POWDER (500GM)', 48, '2022-06-14 06:35:18', NULL),
(98, 'AL BAIK CRUM', 20, '2022-06-14 06:35:33', NULL),
(99, 'BREAD CRUM', 10, '2022-06-14 06:35:43', NULL),
(100, 'BABY CORN', 10, '2022-06-14 06:35:53', NULL),
(101, 'TERYAKI SAUCE', 10, '2022-06-14 06:36:01', NULL),
(102, 'MAGGI SEASONING', 5, '2022-06-14 06:36:11', NULL),
(103, 'BLACK PEPPER SAUCE', 5, '2022-06-14 06:36:20', NULL),
(104, 'NOODLES', 100, '2022-06-14 06:36:32', NULL),
(105, 'VEG OYSTER SAUCE', 5, '2022-06-14 06:36:46', NULL),
(106, 'SESSAME OIL', 2, '2022-06-14 06:36:57', NULL),
(107, 'MUTTON WITH BONE', 20, '2022-06-14 06:37:17', '2022-06-23 06:20:54'),
(108, 'MUTTON BONELESS', 10, '2022-06-14 06:37:26', NULL),
(109, 'BRAIN', 20, '2022-06-14 06:37:38', NULL),
(110, 'CHICKEN BROILER', 20, '2022-06-14 06:37:51', NULL),
(111, 'ENGLISH CHICKEN', 20, '2022-06-14 06:39:43', NULL),
(112, 'CHICKEN BOTI', 50, '2022-06-14 06:40:52', '2022-06-14 06:41:06'),
(113, 'CHICKEN LOLLY POP', 50, '2022-06-14 06:42:07', NULL),
(114, 'FISH BONELESS', 10, '2022-06-14 06:42:34', NULL),
(115, 'PRAWNS', 10, '2022-06-14 06:43:07', NULL),
(116, 'PROMFRET', 20, '2022-06-14 06:43:19', NULL),
(117, 'SURMAI', 20, '2022-06-14 06:43:29', NULL),
(118, 'EGG', 600, '2022-06-14 06:43:53', NULL),
(119, 'MAWA', 5, '2022-06-14 06:44:02', NULL),
(120, 'PANEER', 10, '2022-06-14 06:44:12', NULL),
(121, 'GARLIC LASUN', 50, '2022-06-14 06:44:35', NULL),
(122, 'SWEET SAUF', 50, '2022-06-14 06:44:45', NULL),
(123, 'FUEL', 40, '2022-06-14 06:44:59', NULL),
(124, 'RED THAI CURRY', 2, '2022-06-14 06:45:23', NULL),
(125, 'COOKING SAUCE', 10, '2022-06-14 06:45:37', NULL),
(126, 'AMCHUR POWDER', 5, '2022-06-14 06:45:47', NULL),
(127, 'ELAICHI POWDER', 5, '2022-06-14 06:46:02', NULL),
(128, 'AKKHA MOONG', 5, '2022-06-14 06:46:12', NULL),
(129, 'AKKHA MASOOR', 5, '2022-06-14 06:46:21', NULL),
(130, 'TAND MASHROOM 800GMS', 10, '2022-06-14 06:46:32', NULL),
(131, 'DESI CHANA', 5, '2022-06-14 06:46:44', NULL),
(132, '10*14  NO 1 HANDLE BAG', 50, '2022-06-14 06:48:06', '2022-06-14 07:58:26'),
(133, '13*16  NO 2 HANDLE BAG', 50, '2022-06-14 07:48:36', '2022-06-14 07:59:07'),
(134, '16*20  NO 3 HANDLE BAG', 50, '2022-06-14 07:48:47', '2022-06-14 07:58:48'),
(135, 'ALLUMINIUM BAG  7*9', 10, '2022-06-14 07:49:01', NULL),
(136, 'ALLUMINIUM BAG  8*10', 10, '2022-06-14 07:49:10', NULL),
(137, 'ALLUMINIUM BAG  10*12', 10, '2022-06-14 07:49:19', NULL),
(138, 'ALLUMINIUM FOIL', 15, '2022-06-14 07:49:30', NULL),
(139, 'RAAN CONTAINER', 50, '2022-06-14 07:49:44', NULL),
(140, 'FULL KEPSA (3200ML)', 50, '2022-06-14 07:50:38', NULL),
(141, 'HALF KEPSA  2000ml PLAST', 50, '2022-06-14 07:50:47', NULL),
(142, 'FULL M.MUSALLAM  1250ml', 100, '2022-06-14 07:50:59', NULL),
(143, 'TRIPPLE RICE 1250ml', 500, '2022-06-14 07:51:09', NULL),
(144, 'CRISPY  1000ml', 500, '2022-06-14 07:51:19', NULL),
(145, 'HALF M.MUSALLAM 750ml', 500, '2022-06-14 07:51:31', NULL),
(146, 'CHI BIRYANI  650ml', 500, '2022-06-14 07:51:42', NULL),
(147, 'CHI KADAI  600ml', 500, '2022-06-14 07:51:52', NULL),
(148, 'DRY ITEM  500ml', 500, '2022-06-14 07:52:01', NULL),
(149, 'ROUND 500ml', 500, '2022-06-14 07:52:13', NULL),
(150, 'ROUND 400ml', 500, '2022-06-14 07:52:25', NULL),
(151, 'ROUND 300ml', 500, '2022-06-14 07:52:35', NULL),
(152, 'ROUND 250ml', 500, '2022-06-14 07:52:46', NULL),
(153, 'ROUND 100ml', 1000, '2022-06-14 07:52:57', NULL),
(154, 'CHATNI DABBI', 1000, '2022-06-14 07:53:09', NULL),
(155, 'ALLUMINIUM 450ml S.RICE', 500, '2022-06-14 07:53:21', NULL),
(156, 'ALLUMINIUM 250ml SALAD', 500, '2022-06-14 07:53:50', NULL),
(157, 'PAPER PLATE', 500, '2022-06-14 07:54:05', NULL),
(158, 'PLASTIC SPOON', 500, '2022-06-14 07:54:14', NULL),
(159, 'BROWN PAPER BAG', 100, '2022-06-14 07:54:32', NULL),
(160, 'GARBAGE BAG', 50, '2022-06-14 07:54:42', NULL),
(161, 'TISSUE PAPER', 10, '2022-06-14 07:55:34', NULL),
(162, 'LIQUID MORI', 100, '2022-06-14 07:57:02', NULL),
(163, 'PHENYLE', 10, '2022-06-14 07:57:13', NULL),
(164, 'TOOTH PICK (BOX)', 10, '2022-06-14 07:57:34', NULL),
(165, 'PLASTIC BAG 6*9', 25, '2022-06-14 07:59:35', NULL),
(166, 'GILITING ROLL', 5, '2022-06-14 07:59:45', NULL),
(167, 'PLASTIC JUICE GLASS', 500, '2022-06-14 07:59:56', '2022-06-15 04:40:23'),
(168, 'PAPER STRAW', 50, '2022-06-14 08:00:13', NULL),
(169, 'BILL ROLL', 100, '2022-06-14 08:00:26', NULL),
(170, 'LOLLY POP BOX', 500, '2022-06-14 08:00:36', NULL),
(171, 'ORANGE JELLY', 10, '2022-06-14 08:01:12', NULL),
(172, 'PINEAPPLE JELLY', 10, '2022-06-14 08:01:21', NULL),
(173, 'STRAWBERRY JELLY', 10, '2022-06-14 08:01:53', NULL),
(174, 'AMUL BUTTER', 10, '2022-06-14 08:02:04', NULL),
(175, 'AMUL CHESSE BLOCK', 10, '2022-06-14 08:02:59', NULL),
(176, 'CHESSE SLICE', 20, '2022-06-14 08:03:14', NULL),
(177, 'RICH CREAM', 48, '2022-06-14 08:03:28', NULL),
(178, 'JEERA MASALA 250ML', 5, '2022-06-14 08:05:00', NULL),
(179, 'BISLERI 1 LTR', 50, '2022-06-14 08:05:15', NULL),
(180, 'BISLERI 500ML', 50, '2022-06-14 08:05:39', NULL),
(181, 'SODA  250ML', 5, '2022-06-14 08:08:30', NULL),
(182, 'MAAZA 250ML', 5, '2022-06-14 08:08:39', NULL),
(183, 'COLD DRINKS 2.25 LTR', 10, '2022-06-14 08:09:21', NULL),
(184, 'COLD DRINKS 1.25 LTR', 10, '2022-06-14 08:09:30', NULL),
(185, 'COLD DRINKS 750ML', 10, '2022-06-14 08:09:39', NULL),
(186, 'COLD DRINKS 250ML', 10, '2022-06-14 08:09:47', NULL),
(187, 'MIX FRUIT JAM', 2, '2022-06-14 08:14:05', NULL),
(188, 'YELLOW MIRCHI POWDER', 5, '2022-06-14 08:16:16', NULL),
(189, 'ACETIC ACID WATER', 5, '2022-06-14 08:17:04', NULL),
(190, 'MANGO PULP', 10, '2022-06-15 04:27:40', '2022-06-15 04:38:37'),
(191, 'DAHI', 30, '2022-06-15 04:28:49', NULL),
(192, 'REAL ORANGE', 5, '2022-06-15 04:35:54', NULL),
(193, 'REAL PINEAPPLE', 5, '2022-06-15 04:36:04', NULL),
(194, 'MINT MOJITO SYRUP 5L', 2, '2022-06-15 04:36:37', NULL),
(195, 'CHERRY', 2, '2022-06-15 04:39:00', NULL),
(196, 'CHOCOLATE SAUCE', 5, '2022-06-15 04:40:47', NULL),
(197, 'BLUE CURACO SYRUP 5L', 2, '2022-06-15 04:41:29', NULL),
(198, 'BLUE BERRY SYRUP', 2, '2022-06-15 04:41:54', NULL),
(199, 'SYMEGA  MAYO SAUCE', 12, '2022-06-15 04:43:54', NULL),
(200, 'GULAB GULKHAND SYRUP', 2, '2022-06-15 04:44:18', NULL),
(201, 'OIL', 50, '2022-06-15 04:51:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nz_purchase`
--

CREATE TABLE `nz_purchase` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `sub_item_id` int(11) DEFAULT '0',
  `item_id` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_sell` enum('1','0') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nz_purchase`
--

INSERT INTO `nz_purchase` (`id`, `vendor_id`, `sub_item_id`, `item_id`, `unit`, `qty`, `rate`, `total_amount`, `date`, `is_sell`, `created_at`, `updated_at`) VALUES
(2, 25, 2, 2, 'KG', 50, '40', '2000', '2022-07-16', '0', '2022-06-16 09:59:41', '2022-09-14 12:13:35'),
(3, 27, 2, 2, 'KG', 50, '42', '2100', '2022-06-16', '0', '2022-06-16 10:04:49', NULL),
(4, 27, 4, 107, 'KG', 80, '670', '53600', '2022-06-23', '0', '2022-06-23 04:02:10', '2022-06-29 10:24:28'),
(5, 29, 2, 2, 'KG', 50, '42', '2100', '2022-06-29', '0', '2022-06-29 10:19:17', NULL),
(6, 27, 4, 107, 'KG', 40, '639', '25560', '2022-06-29', '0', '2022-06-29 10:22:46', NULL),
(7, 27, 3, 8, 'KG', 50, '270', '13500', '2022-07-05', '0', '2022-07-05 08:33:49', NULL),
(8, 25, 2, 5, 'KG', 70, '46', '3220', '2022-07-05', '0', '2022-07-05 08:34:05', NULL),
(9, 25, 2, 2, 'KG', 40, '47', '1880', '2022-07-05', '0', '2022-07-05 08:34:34', NULL),
(10, 25, 2, 2, 'KG', 80, '40', '3200', '2022-09-13', '0', '2022-09-13 11:47:41', NULL),
(11, 25, 2, 3, 'KG', 50, '112', '5600', '2022-09-14', '0', '2022-09-14 12:13:58', NULL),
(12, 25, 2, 2, 'PCS', 50, '150', '7500', '2022-11-05', '0', '2022-11-05 10:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nz_selling`
--

CREATE TABLE `nz_selling` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `sub_item_id` int(11) DEFAULT '0',
  `unit` varchar(50) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `outlet` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nz_selling`
--

INSERT INTO `nz_selling` (`id`, `item_id`, `sub_item_id`, `unit`, `qty`, `rate`, `total_amount`, `outlet`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'KG', 14, '40', '560', 'Metro', '2022-06-16', '2022-06-16 10:00:51', '2022-06-23 02:44:44'),
(2, 107, 4, 'KG', 6, '670', '4020', 'Parel', '2022-06-23', '2022-06-23 04:03:18', NULL),
(3, 107, 4, 'KG', 8, '670', '5360', 'Naaz Executive', '2022-06-23', '2022-06-23 04:03:33', NULL),
(4, 2, 2, 'KG', 47, '41', '1927', 'Parel', '2022-06-29', '2022-06-29 09:00:45', NULL),
(5, 2, 2, 'KG', 29, '41', '1189', 'Metro', '2022-06-29', '2022-06-29 09:01:02', NULL),
(6, 107, 4, 'KG', 46, '670', '30820', 'Naaz Kamani', '2022-06-29', '2022-06-29 09:01:19', NULL),
(7, 5, 2, 'KG', 24, '46', '1104', 'Naaz Kamani', '2022-07-05', '2022-07-05 11:28:04', NULL),
(8, 5, 2, 'KG', 13, '45', '585', 'Naaz Jarimari', '2022-07-05', '2022-07-05 11:28:19', NULL),
(9, 2, 2, 'KG', 64, '43', '2752', 'Other', '2022-07-05', '2022-07-05 11:29:37', NULL),
(10, 2, 2, 'KG', 36, '43', '1548', 'Parel', '2022-07-06', '2022-07-06 11:09:58', NULL),
(11, 5, 2, 'KG', 14, '46', '644', 'Patel', '2022-07-20', '2022-07-20 03:01:27', NULL),
(12, 107, 4, 'KG', 11, '659', '7249', NULL, '2022-07-20', '2022-07-20 03:23:53', NULL),
(15, 8, 2, 'KG', 14, '270', '3780', NULL, '2022-09-23', '2022-09-23 10:43:21', NULL),
(16, 2, 2, 'KG', 14, '58', '812', NULL, '2022-11-05', '2022-11-05 10:52:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nz_vendors`
--

CREATE TABLE `nz_vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nz_vendors`
--

INSERT INTO `nz_vendors` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(25, 'ABAAD MASALA', '022 23460049', 'NULL BAZAR', '2022-03-17 07:28:04', '2022-06-13 10:41:36'),
(27, 'AL-MOMIN JKM', '9324007076', 'KURLA', '2022-06-11 05:25:08', '2022-06-13 10:01:32'),
(28, 'N0UMAN PATEL MILK SUPPLIER', '', 'AAREY COLONY', '2022-06-13 10:00:59', NULL),
(29, 'NARAYAN SALES CORPORATION', '9892633487', 'ANDHERI EAST', '2022-06-14 08:42:45', '2022-06-14 08:43:54'),
(30, 'ACE AIM ENTERPRISES', '9870634700', 'GHATKOPAR', '2022-06-15 08:54:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$Rg.mjuH4KwGXryhj8hwHbuTH2123Z5Y4eLv5wRsKeM33tJ893CLCW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 2022, 1, 'Super', 'Admin', 'Zainab', '9769337909'),
(2, '::1', 'test_', '$2y$12$Rg.mjuH4KwGXryhj8hwHbuTH2123Z5Y4eLv5wRsKeM3...', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-12 22:58:33', 2022, 1, 'General', 'User', NULL, '9797979797');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `years_list`
--

CREATE TABLE `years_list` (
  `id` int(11) NOT NULL,
  `name` bigint(10) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_available`
--
ALTER TABLE `sms_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nz_department`
--
ALTER TABLE `nz_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nz_items`
--
ALTER TABLE `nz_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nz_purchase`
--
ALTER TABLE `nz_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `sub_item_id` (`sub_item_id`);

--
-- Indexes for table `nz_selling`
--
ALTER TABLE `nz_selling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_item_id` (`sub_item_id`);

--
-- Indexes for table `nz_vendors`
--
ALTER TABLE `nz_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `years_list`
--
ALTER TABLE `years_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sms_available`
--
ALTER TABLE `sms_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nz_department`
--
ALTER TABLE `nz_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nz_items`
--
ALTER TABLE `nz_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `nz_purchase`
--
ALTER TABLE `nz_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nz_selling`
--
ALTER TABLE `nz_selling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nz_vendors`
--
ALTER TABLE `nz_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `years_list`
--
ALTER TABLE `years_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nz_purchase`
--
ALTER TABLE `nz_purchase`
  ADD CONSTRAINT `nz_purchase_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `nz_vendors` (`id`),
  ADD CONSTRAINT `nz_purchase_ibfk_2` FOREIGN KEY (`sub_item_id`) REFERENCES `nz_department` (`id`);

--
-- Constraints for table `nz_selling`
--
ALTER TABLE `nz_selling`
  ADD CONSTRAINT `nz_selling_ibfk_2` FOREIGN KEY (`sub_item_id`) REFERENCES `nz_department` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
