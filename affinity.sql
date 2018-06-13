-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 07:22 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affinity`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nigeria',
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lagos',
  `state` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `admin_id`, `admin_type`, `address`, `phone`, `email`, `created_at`, `updated_at`, `country`, `city`, `state`, `avatar`) VALUES
(1, 'Superadmin', 'AD-000MA1', 'Superadmin', 'Afinitty Club', '08179112973', 'superadmin@afinittyclub.com', '2017-10-05 12:32:30', '2017-11-03 10:18:50', 'Nigeria', 'Lagos', 'Lagos', NULL),
(18, 'Yinka Adeniran', 'AD1526659836', 'Admin', '2 East Union Street, Los Angeles, CA 90034', '08189862968', 'yinkaadeniran@gmail.com', '2018-05-18 16:10:36', '2018-05-18 16:10:36', 'Nigeria', 'Lagos', 'Lagos', 'images/1526659836.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `airport_concierges`
--

CREATE TABLE `airport_concierges` (
  `id` int(11) NOT NULL,
  `service` varchar(200) DEFAULT NULL,
  `airport` varchar(200) DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `no_of_passengers` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `time` varchar(200) DEFAULT NULL,
  `additional_service` varchar(10000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_concierges`
--

INSERT INTO `airport_concierges` (`id`, `service`, `airport`, `class`, `no_of_passengers`, `date`, `time`, `additional_service`, `created_at`, `in_charge`, `status`, `updated_at`) VALUES
(1, 'Arrival', 'Murital Int Airport', 'First Class2', '200', '2018/10/08', '12:00 AM', 'Nothing', '2018-05-20 16:48:51', 'Yinka Adeniran', 'In Progress', '2018-05-20 17:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `bespoke_products`
--

CREATE TABLE `bespoke_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bespoke_product_category_id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bespoke_products`
--

INSERT INTO `bespoke_products` (`id`, `name`, `price`, `supplier_name`, `created_at`, `updated_at`, `bespoke_product_category_id`, `avatar`) VALUES
(1, 'Mercedies E350', '12000000', 'Carsmudi', '2018-05-22 05:35:57', '2018-05-22 05:57:44', 1, 'images/1526970957.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bespoke_product_categories`
--

CREATE TABLE `bespoke_product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bespoke_product_categories`
--

INSERT INTO `bespoke_product_categories` (`id`, `name`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Cars', 'images/1526921508.jpeg', '2018-05-21 15:51:48', '2018-05-21 16:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `bespoke_product_gallery`
--

CREATE TABLE `bespoke_product_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `bespoke_product_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bespoke_product_gallery`
--

INSERT INTO `bespoke_product_gallery` (`id`, `avatar`, `bespoke_product_id`, `created_at`) VALUES
(1, 'images/1526972935.jpeg', 1, '2018-05-22 07:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `bespoke_product_requests`
--

CREATE TABLE `bespoke_product_requests` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bespoke_product_id` int(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bespoke_product_requests`
--

INSERT INTO `bespoke_product_requests` (`id`, `created_at`, `updated_at`, `bespoke_product_id`, `customer_id`, `in_charge`, `status`) VALUES
(1, '2018-05-22 09:41:49', '2018-05-22 08:51:01', 1, 'EDR-0009', 'Superadmin', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `bespoke_travels`
--

CREATE TABLE `bespoke_travels` (
  `id` int(11) NOT NULL,
  `occassion` varchar(300) DEFAULT NULL,
  `duration` varchar(300) DEFAULT NULL,
  `group_size` varchar(20) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(80) DEFAULT NULL,
  `destination` varchar(300) DEFAULT NULL,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bespoke_travels`
--

INSERT INTO `bespoke_travels` (`id`, `occassion`, `duration`, `group_size`, `date`, `time`, `destination`, `in_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Honey Moon', '2 weeks', '2', '2018/07/10', '12:12 AM', 'Miami', 'Superadmin', 'Closed', '2018-05-20 17:22:37', '2018-05-20 17:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `customer_id`, `address`, `phone`, `email`, `status`, `created_at`, `updated_at`, `country`, `state`, `city`, `lastname`, `dob`, `avatar`, `membership`, `sex`) VALUES
(1, 'Yinka', 'YIN-0001', '34 Prince alaba oniru street', '08066557654', 'yinka@gmail.com', 'Active', '2017-11-08 07:47:42', '2017-11-08 07:47:42', 'Nigeria', 'Lagos', 'Lagos', 'Adeniran', '1991-11-06', 'images/1510130840.jpeg', 'Affinity Essence', 'Male'),
(7, 'Femi', 'FEM-0007', '4, Umudi street, Ajah. Lagos', '09099989888', 'femi_brhyms@gmail.com', 'Active', '2017-11-09 11:05:27', '2017-11-09 11:05:27', 'Nigeria', 'Lagos', 'Lagos', 'Brhyms', '11/15/2017', 'images/CS_1510229127.jpeg', 'Affinity Essence', 'Male'),
(8, 'Kelvin', 'KEL-0008', '4, Umudi street, Ajah. Lagos', '08012345432', 'kelvin@gmail.com', 'Active', '2017-11-09 16:44:35', '2017-11-14 19:16:01', 'Nigeria', 'Lagos', NULL, 'Hart', '1987-11-11', 'images/1510249464.jpeg', 'Affinity Prive', 'Male'),
(9, 'Edris', 'EDR-0009', '4, Umudi street, Ajah. Lagos', '08098789878', 'edris@gmail.com', 'Active', '2017-11-09 16:59:14', '2018-05-09 08:06:47', 'Nigeria', 'Lagos', NULL, 'Elba', '1977-11-11', 'images/1517231197159.jpg', 'Affinity Essence', 'Male'),
(10, 'Beyonce', 'BEY-0010', '4, Umudi street, Ajah. Lagos', '08078765435', 'beyonce@gmail.com', 'Active', '2017-11-09 17:14:38', '2017-12-04 10:17:53', 'Nigeria', 'Lagos', NULL, 'Knowles', '1979-11-10', 'images/1510251264.jpeg', 'Affinity Luxe', 'Female'),
(11, 'Nicki', 'NIC-0011', '4, Umudi street, Ajah. Lagos', '08098789654', 'nicki@gmail.com', 'Active', '2017-11-09 17:16:48', '2017-11-09 17:16:48', 'Nigeria', 'Lagos', NULL, 'Minaj', '1969-07-16', 'images/1511366531618.jpg', 'Affinity Prive', 'Female'),
(12, 'George', 'GEO0012', '11 Klem street', '09098761234', 'george@gmail.com', 'Active', '2017-11-15 08:28:33', '2017-11-24 12:41:48', 'Nigeria', 'Lagos', 'Lagos', 'Whiteman', '1977-06-15', 'images/1511261508394.jpg', 'Affinity Luxe', 'Male'),
(13, 'Jamiu', 'JAM0013', '11, Ogunrunbi Estate, Idimu. Lagos', '0809876789', 'j.shobajo@gmail.com', 'Active', '2017-11-15 10:07:37', '2017-12-04 12:06:33', 'Nigeria', 'Lagos', NULL, 'Shobajo', '1968-03-23', 'images/1510744045.jpeg', 'Affinity Luxe', 'Male'),
(14, 'Adebanjo', 'ADE0014', 'Address', '08123432123', 'adeniyijts@gmail.com', 'Active', '2017-11-20 10:49:10', '2017-11-20 10:49:10', 'Nigeria', 'Ogun', NULL, 'Adeniyi', '1977-09-06', 'images/1511178537.jpeg', NULL, 'Male'),
(20, 'Black', 'BLA0020', '4, Umudi street, Ajah. Lagos', '09087678545', 'blackchyna@gmail.com', 'Active', '2017-11-20 15:17:08', '2017-12-04 11:49:41', 'Nigeria', 'Lagos', NULL, 'Chyna', '1977-11-15', 'images/1511194619.jpeg', 'Affinity Luxe', 'Female'),
(21, 'Mary', 'MAR0021', '4 umudi street', '08077756544', 'maryobi@gmail.com', 'Active', '2017-11-20 15:22:11', '2017-12-04 12:27:13', 'Nigeria', 'Lagos', 'Lagos', 'Obi', '1991-11-28', 'images/1511271761813.jpg', 'Affinity Essence', 'Female'),
(22, 'Antoinette', 'ANT0022', 'Stillwaters garden', '08177777012', 'antoinette@theaffinityclub.com', 'Active', '2017-11-24 08:21:57', '2017-11-24 08:21:57', 'Nigeria', 'Lagos', 'Lekki', 'Anasoh', '1989-06-22', 'images/1511522792090.jpg', 'Affinity Prive', 'Female'),
(23, 'ydebimpe@gmail.com', 'YDE0023', '7, Bailey street  Yaba Lagos', '08136232321', 'ydebimpe@gmail.com', 'Active', '2017-12-01 12:34:31', '2017-12-01 12:34:31', 'Nigeria', 'Lagos', 'Lagos', 'Adebimpe', '2017-09-19', NULL, NULL, 'Female'),
(24, 'Noibi', 'NOI0024', 'Lag', '08080764159', 'noibilism@gmail.com', 'Active', '2017-12-01 22:22:54', '2017-12-01 22:22:54', 'Nigeria', 'Abuja', 'Lag', 'Kay', '2017-05-08', NULL, NULL, 'Male'),
(25, 'Emmanuel', 'EMM0025', '15 Marita may street', '08172009515', 'lets_haveachat@yahoo.com', 'Active', '2018-01-05 09:38:08', '2018-01-05 09:38:08', 'Nigeria', 'Abuja', 'Kubwa', 'Akaiso', '2014-04-02', NULL, NULL, 'Male'),
(26, 'Antoinete', 'ANT0026', '2 klem street', '0805556698', 'ant@gmail.com', 'Active', '2018-01-05 10:09:20', '2018-01-05 10:09:20', 'Nigeria', 'Abuja', 'Abuja', 'Anaso', '2018-01-31', NULL, NULL, 'Female'),
(30, 'Damilola', 'DAM0030', '4, Madiba street, Ikate', '0912345678', 'damilola@gmail.com', 'Active', '2018-02-05 10:03:46', '2018-02-05 10:03:46', 'Nigeria', 'Lagos', 'Lagos', 'Adeniran', '1995-10-17', NULL, NULL, 'Male'),
(29, 'Anthony', 'ANT0029', '10 Prince Alaba Oniru street', '0819876789', 'anthony@gmail.com', 'Active', '2018-02-05 09:56:23', '2018-02-05 09:56:23', 'Nigeria', 'Lagos', 'Lagos', 'Keshington', '1995-10-10', NULL, NULL, 'Male'),
(31, 'Eloho', 'ELO0031', '10, Mighty way. Vi', '09198765432', 'eloho@gmail.com', 'Active', '2018-02-05 11:03:28', '2018-02-05 11:03:28', 'Nigeria', 'Lagos', 'Lagos', 'Charles', '1997-10-10', NULL, NULL, 'Male'),
(32, 'Ola', 'OLA0032', '2 Magik avenue', '08062881893', 'olakola@gmail.com', 'Active', '2018-02-09 12:43:11', '2018-02-23 13:35:29', 'Nigeria', 'Lagos', 'Magodo', 'Kola', '1993-02-09', NULL, 'Affinity Premium', 'Male'),
(33, 'Nogosa', 'NOG0033', 'A30A Carlton Gate Estate Chevron Drive lekki lagos', '07069619020', 'nogosaomoruyi80@gmail.com', 'Active', '2018-02-23 11:04:58', '2018-02-23 11:21:04', 'Nigeria', 'Lagos', 'Lagos', 'Omoruyi', '1980-05-13', NULL, 'Affinity Luxe', 'Female'),
(34, 'Adrian', 'ADR0034', 'Lagos', '08096722541', 'iamadrianagbi@gmail.com', 'Active', '2018-03-08 14:39:31', '2018-03-08 14:39:31', 'Nigeria', 'Lagos', 'Lagos', 'Agbi', '1994-05-01', NULL, NULL, 'Female'),
(35, 'Chinyere', 'CHI0035', '', '09091178880', 'nelokwaz@gmail.com', 'Active', '2018-05-03 07:42:55', '2018-05-03 07:42:55', '', '', NULL, 'Kalu', '', NULL, NULL, ''),
(36, 'chinelo', 'CHI0036', '31 opebi', '09091873787', 'nellyhr02@gmail.com', 'Active', '2018-05-04 18:07:02', '2018-05-04 18:07:02', 'Nigeria', 'Lagos', NULL, 'kate', '2018-05-16', 'images/1525460815.png', NULL, 'Male'),
(37, 'Try', 'TRY0037', 'try', '08060307850', 'test@yahoo.com', 'Active', '2018-05-07 08:02:05', '2018-05-07 08:02:05', 'Nigeria', 'Lagos', NULL, 'Tyr', '2018-05-01', 'images/1525683721.png', NULL, 'Male'),
(38, 'ANTOINETTE', 'ANT0038', 'Lekki', '32488625609', 'lekki@gmaill.com', 'Active', '2018-05-07 08:16:18', '2018-05-07 08:16:18', 'Nigeria', 'Lagos', NULL, 'ANASOH', '1978-04-13', NULL, NULL, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `customer_event`
--

CREATE TABLE `customer_event` (
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_event`
--

INSERT INTO `customer_event` (`customer_id`, `event_id`, `created_at`, `updated_at`) VALUES
('NIC-0011', 1, '2017-11-23 14:12:32', '2017-11-23 14:12:32'),
('ANT0022', 3, '2017-11-24 19:44:19', '2017-11-24 19:44:19'),
('GEO0012', 1, '2017-12-12 12:22:42', '2017-12-12 12:22:42'),
('EDR-0009', 8, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 2017, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 2017, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 2017, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 0, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 21, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 2017, '2018-01-05 11:25:10', '2018-01-05 11:25:10'),
('EDR-0009', 1, '2018-03-12 07:47:07', '2018-03-12 07:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_experiences`
--

CREATE TABLE `customer_experiences` (
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_experiences`
--

INSERT INTO `customer_experiences` (`customer_id`, `experience_id`, `created_at`, `updated_at`, `id`) VALUES
('NIC-0011', 1, '2017-12-04 12:47:59', NULL, 7),
('MAR0021', 2, '2017-12-04 12:47:59', '2017-12-04 12:47:59', 8),
('MAR0021', 2, '2017-12-04 13:26:34', '2017-12-04 13:26:34', 9);

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`customer_id`, `group_id`, `created_at`, `updated_at`) VALUES
('ANT0022', 3, '2017-11-24 19:44:05', '2017-11-24 19:44:05'),
('ANT0022', 1, '2017-11-26 14:28:17', '2017-11-26 14:28:17'),
('ANT0022', 2, '2017-12-01 14:59:01', '2017-12-01 14:59:01'),
('GEO0012', 1, '2017-12-12 12:35:21', '2017-12-12 12:35:21'),
('GEO0012', 1, '2017-12-12 12:35:26', '2017-12-12 12:35:26'),
('GEO0012', 1, '2017-12-12 12:55:02', '2017-12-12 12:55:02'),
('GEO0012', 6, '2017-12-13 11:20:46', '2017-12-13 11:20:46'),
('EDR-0009', 1, '2018-05-09 10:50:19', '2018-05-09 10:50:19'),
('EDR-0009', 4, '2018-03-20 11:01:07', '2018-03-20 11:01:07'),
('EDR-0009', 3, '2018-02-28 10:31:05', '2018-02-28 10:31:05'),
('EDR-0009', 19, '2018-05-07 16:19:36', '2018-05-07 16:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer_interest`
--

CREATE TABLE `customer_interest` (
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_interest`
--

INSERT INTO `customer_interest` (`customer_id`, `interest_id`, `created_at`, `updated_at`) VALUES
('CS-000MA1', 1, '2017-10-05 08:52:47', '2017-10-05 08:52:47'),
('CS-000CP2', 1, '2017-10-06 13:34:28', '2017-10-06 13:34:28'),
('CS-000MA1', 1, '2017-10-06 15:10:33', '2017-10-06 15:10:33'),
('CS-000CP2', 1, '2017-10-06 15:34:12', '2017-10-06 15:34:12'),
('CS-000NB3', 1, '2017-10-06 16:00:59', '2017-10-06 16:00:59'),
('CS-000MA1', 1, '2017-10-06 16:41:19', '2017-10-06 16:41:19'),
('CS-000AM4', 1, '2017-10-06 17:49:59', '2017-10-06 17:49:59'),
('CS-000010', 1, '2017-11-01 08:52:44', '2017-11-01 08:52:44'),
('CS-00MA11', 1, '2017-11-01 10:54:03', '2017-11-01 10:54:03'),
('CS-00CP12-SEL', 1, '2017-11-06 10:02:04', '2017-11-06 10:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_members` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `group_id`, `name`, `description`, `location`, `capacity`, `target_members`, `date`, `created_at`, `updated_at`, `avatar`, `created_by`, `updated_by`, `time`, `end_date`, `event_type`) VALUES
(1, 8, 'Champion\'s League Life', 'Watch the champion\'s league final life in europe', 'Spain', NULL, NULL, '2017-11-24', '2017-11-07 16:03:42', '2017-11-28 13:42:47', 'images/1510074221.jpeg', 'Superadmin', 'Superadmin', '21:10:00', '2017-11-25', NULL),
(2, 2, '5days On Mount-Everest', '5 days of unforgettable experience On Mount-Everest!', 'Mount-Everest', NULL, NULL, '2017-11-07', '2017-11-07 16:34:57', '2017-11-20 12:41:44', 'images/1510076096.jpeg', 'Superadmin', 'Superadmin', '0-20', '2018-11-06', NULL),
(3, 3, 'Empower Her Conference 2.0', 'With more than 16 Million girls within the age bracket of 15 to 19 years becoming mothers (WHO) and many more being discriminated, stereotyped and denied qualitative education, it is no longer a speculation that females face lots of barriers to unleashing their power. It is in this light that Empower Her Conference 2017 was initiated.\n\nThe Empower Her Conference is the second phase of the Empower Her Project where Girls, Girl Child advocates, mentors, advocates and concerned individuals converge to discuss a thematic painstaking challenge or issue affecting the Girl Child, proffering practical & action oriented solutions to these problems and allowing the girls to speak out and express themselves freely.', 'Onikan Youth Center, Obalende, Lagos', NULL, NULL, '2017-12-02', '2017-11-20 12:45:25', '2017-11-20 12:47:14', 'images/1511185630.png', 'Superadmin', 'Superadmin', '9-0', '2017-12-02', NULL),
(4, 1, 'Champions league life', 'Champions league life', 'England', NULL, NULL, '2017-11-23', '2017-11-21 10:41:46', '2017-11-21 10:41:46', 'images/1511264505.jpeg', 'Superadmin', NULL, '1-1', '2017-11-24', NULL),
(5, 1, 'Test1', 'Test', 'Victoria Island', '200', NULL, '07/11/2018 12:00 AM ', '2018-05-20 11:08:16', '2018-05-20 11:29:40', 'images/1526818096.jpeg', NULL, NULL, NULL, ' 07/11/2018 12:00 AM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_gallery`
--

CREATE TABLE `event_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `event_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_gallery`
--

INSERT INTO `event_gallery` (`id`, `avatar`, `event_id`, `created_at`) VALUES
(1, 'images/1526820094.jpeg', 5, '2018-05-20 12:41:34'),
(2, 'images/1526820175.jpeg', 5, '2018-05-20 12:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `experience_id` int(10) UNSIGNED NOT NULL,
  `experience_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overview` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ntk` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `venue` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`experience_id`, `experience_name`, `price`, `overview`, `details`, `ntk`, `country`, `state`, `avatar`, `experience_start_date`, `experience_end_date`, `created_at`, `updated_at`, `venue`) VALUES
(1, 'Pamper me', '20000', 'Now offering Relaxing facials, and full body waxing. Young living essential oils, the world leader in essential oils are included in a abundance of ways during your visit.\nHairstylist and Color expert. Offering Men\'s haircuts, Women\'s Haircuts and children\'s haircuts.Featuring Redken, Kenra, and Olaplex Products.', 'Your relaxing Pampering experience begins with us. Our goal is to meet your individual and relaxing  pampered needs, in a peaceful and personal environment.  Offering natural nail manicures and pedicures. Featuring CND Shellac power polish and Vinylux weekly polish.', 'Specializing in a variety  of massages to include but not limited to Swedish massage, Deep Tissue massage, and tuning forks.', 'Nigeria', 'Lagos', 'images/1510075443.png', '2017-11-22', '2017-11-27', '2017-11-07 16:24:39', '2017-11-07 16:24:39', 'Sheraton'),
(2, 'Wine Tasting', '5000', 'The Affinity Club presents members and non-members with access to unique and exclusive experiences from dining, to drinks and tastings, getaways, tours and so many more.\nExplore our experiences, see something you like, pay for it and have your package delivered to your doorstep or to the doorstep of a loved one.', 'The Affinity Club presents members and non-members with access to unique and exclusive experiences from dining, to drinks and tastings, getaways, tours and so many more.\nExplore our experiences, see something you like, pay for it and have your package delivered to your doorstep or to the doorstep of a loved one.', 'The Affinity Club presents members and non-members with access to unique and exclusive experiences from dining, to drinks and tastings, getaways, tours and so many more.\nExplore our experiences, see something you like, pay for it and have your package delivered to your doorstep or to the doorstep of a loved one.', 'Nigeria', 'Lagos', 'images/1511184860.png', '2017-11-22', '2017-12-01', '2017-11-20 12:37:02', '2017-11-20 12:37:02', 'Just Drinks'),
(3, 'Test Experience', '2000', 'Test', 'Test', 'Test', 'Nigeria', 'Lagos', 'images/1526823267.jpeg', '01/01/2018 12:00 AM ', ' 01/01/2018 12:00 AM', '2018-05-20 12:34:27', '2018-05-20 12:56:04', 'Sheraton');

-- --------------------------------------------------------

--
-- Table structure for table `experience_gallery`
--

CREATE TABLE `experience_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `experience_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience_gallery`
--

INSERT INTO `experience_gallery` (`id`, `avatar`, `experience_id`, `created_at`) VALUES
(1, 'images/1526824682.jpeg', 3, '2018-05-20 13:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_head_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updator_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `creator_id`, `details`, `group_head_id`, `avatar`, `created_at`, `updated_at`, `updator_id`) VALUES
(1, 'FOOTBALL FANS', 'Superadmin', 'Football is a popular sport with a huge fan base and in this group we acknowledge and appreciate that. Come join us, meet up with fans who also have the same passion for soccer as you. Get the chance to watch your favourite teams live and interact with the players after matches.To top it up, you will get the chance to travel the world and witness the biggest football tournaments like the World Cup, AFCON, EPL, UEFA Champions league,etc', 'AD-000MA1', 'images/1515175722.jpeg', '2017-11-07 16:01:34', '2018-05-19 08:06:12', 'Superadmin'),
(3, 'DANCE', 'Superadmin', 'Dance is a performing art form consisting of purposefully selected sequences of human movement. This movement has aesthetic and symbolic value and is acknowledged as Dance by performers and observers within a particular culture. If you’d love to learn how to salsa, quickstep, waltz, break dance, ballet or you have a preference for the local trending steps like shoki, shaku shaku, etc we’ve got you covered.', 'AD-000MA1', 'images/1515691411.jpeg', '2017-11-13 13:16:58', '2018-01-11 16:23:34', 'Superadmin'),
(4, 'FOODIES', 'Superadmin', 'Food lovers get ready to experience a burst of flavours, explore diverse menus and recipes, and discover various traditional and continental delicacies across the globe. Brace yourselves for the cook-offs, improve your cooking skills, and learn how to prepare dishes you never thought you could. Also, learn how to make your meals look mouth watering by garnishing and serving meals to a world-class standard. What are you waiting for? Come join us!', 'AD-000MA1', 'images/1516003957.jpeg', '2017-11-28 09:43:16', '2018-01-30 12:31:19', 'Superadmin'),
(5, 'SPORTS', 'Superadmin', 'Calling on my sports stars! Are you ready to exhibit your skills and your love for sports? You don’t want to miss out on the various games we’ve got lined up for you like basketball, volleyball, golf, soccer, table and lawn tennis, squash, swimming, etc. It’s not a problem if you do not know how to play as our professional coaches will be on hand to teach you so you can improve your skills and someday you too can shine among the sports stars in the world. There will be competitions and also opportunities to meet and greet sportswomen and men who have made it in the sports industry.', 'AD-000MA1', 'images/1511866072.jpeg', '2017-11-28 09:47:55', '2018-01-17 11:56:02', 'Superadmin'),
(6, 'COUPLES', 'Superadmin', 'Are you married or in a relationship? Prepare to be entertained and have new fun experiences with your partner. Get ready to meet and mingle with other couples, have a wow experience travelling with other couples, learn your partner\'s strengths and weaknesses through the mental and physical games that we’ve got lined up. Also, different marriage counsellors will be on board to advise couples on how to spice up their relationships and rekindle the romance.', 'AD-000MA1', 'images/1516613068.jpeg', '2017-11-28 09:56:42', '2018-01-22 08:24:32', 'Superadmin'),
(7, 'TRAVEL AND ADVENTURE', 'Superadmin', 'Fill your life with adventure and new experiences locally and internationally. Get ready to travel the world with an amazing group of people, go hiking and camping, climb the tallest mountains, visit zoos and game resorts, learn new facts about animals that you never knew, go bungee jumping, the list is endless. Join us so we can see the world together!', 'AD-000MA1', 'images/1515778783.jpeg', '2017-11-28 10:01:45', '2018-01-12 16:39:46', 'Superadmin'),
(8, 'FASHION AND STYLE', 'Superadmin', 'Hello fashionistas, come let\'s have fun and meet up with top local and international fashion moguls, learn about trending fashion styles and haute couture,  get styled by renowned stylists and attend exclusive fashion events. Who knows? You could just catch the ‘fashion fever’ and become the next big name in the fashion world.', 'AD-000MA1', 'images/1516279161.jpeg', '2017-11-28 10:07:30', '2018-01-18 11:39:28', 'Superadmin'),
(9, 'MOTHERHOOD', 'Superadmin', 'Motherhood is a thing of joy so whether you are a mom or a mom-to-be, we’ve got something for you.  Come join us as we create amazing experiences for you on this beautiful journey. Connect with other moms and moms-to-be and share stories about your journey, learn healthy eating habits and tips as well as fun exercises from our team of professional medical and health instructors. We want to make this an educative and fun-filled journey as we prepare you for the delivery of your bundle of joy. You will also learn more about children and the best way to nurture them so they can grow up strong and healthy!', 'AD-000MA1', 'images/1516640912.jpeg', '2017-11-28 10:12:14', '2018-01-22 16:08:37', 'Superadmin'),
(10, 'NIGHT OWL', 'Superadmin', 'Shout out to all my party people, this is where you belong! Are you looking for trending hangouts, exclusive clubs, bars and lounges? Perhaps you don\'t have friends to go out and enjoy the nightlife with or you just want to party with a new crowd? Look no further as we’ve got you covered. Get in here and gain access to the rave-of-the-moment clubs, bars, lounges and mingle with other party lovers who are ready to turn up and give you a time of your life. Need I say more? Your nightlife is about to get super lit!', 'AD-000MA1', 'images/1516639417.jpeg', '2017-11-28 10:17:42', '2018-01-22 15:43:39', 'Superadmin'),
(11, 'FIT FIRST', 'Superadmin', 'Health they say is wealth and your health matters to us, that is why we have lined up series of exciting and fun-filled fitness events and activities for you to keep fit while socialising. Do you want to burn those extra calories so you can fit into that bikini or dinner gown? Are you looking to reduce that pot belly or possibly get a six-pack? Or maybe you are in need of advice on healthy eating habits so you can stay trim and maintain an even muscle tone. We’ve got a team of world-class fitness instructors and dietitians who will not only shape you up through physical exercise and aerobics but also through dieting. What’s more? Every month we will be using different locations.', 'AD-000MA1', 'images/1516612554.jpeg', '2017-11-28 10:23:17', '2018-01-22 08:15:57', 'Superadmin'),
(15, 'MUSIC HEADS', 'Superadmin', 'Get in here music lovers, we have everything for everyone! Check out different genres of music ranging from the old to the new school, pop, RnB, classics, hip-hop, rock, afrobeat and every other genre you can imagine. We will take you on a musical journey through time like you have never been on before. That’s not all, you can also learn to play any musical instruments of your choice like the cello, piano, guitar, trumpet, drums etc as well as participate in voice training sessions. Who knows? You could get inspired to become the next Beyonce with our team of world-class vocal trainers and instrumentalists at your service. We will even throw in music recording and production tips so you can start out on your journey of becoming the next big music producer in the music industry.', 'ANT0022', 'images/1516641885.jpeg', '2017-11-28 13:23:04', '2018-01-22 16:24:48', 'Superadmin'),
(13, 'CULTURE AND LANGUAGES', 'Superadmin', 'Real communication of any kind requires cultural fluency and learning another language as an expression of that culture’s symbols and its understanding of the world. Learn about different cultures and languages of your choice and be able to communicate wherever you find yourself in any part of the world.  Have lots of fun learning about the different aspects of different cultures from languages to customs and traditions, arts and recreation, values and beliefs, food and traditional attires, etc.', 'AD-000MA1', 'images/1515170681.jpeg', '2017-11-28 11:17:59', '2018-01-11 09:06:07', 'Superadmin'),
(14, 'CHARITIES AND VOLUNTEERING', 'Superadmin', 'Humanity is all about giving back and we are here for people like you who want to make a difference in the world. Join like-minded individuals who have a passion for compassion and community service to visit the orphanages, old people\'s homes, cancer centres and hospitals, organise fundraisers, donate food items and encourage the less privileged so that they feel loved. There are great rewards and tremendous power that comes with volunteering and charitable acts of kindness.', 'ANT0022', 'images/1513167493.jpeg', '2017-11-28 11:25:10', '2018-01-04 15:34:09', 'Superadmin'),
(16, 'TECHIES', 'Superadmin', 'Are you computer and technology savvy? Well, this is the perfect place for you! Today, technology has become an essential part of our lives and very few can imagine living without it. As technology changes at a fast pace, we need to learn new skills at a much faster pace in order to stay up-to-date. Come and learn about the latest technologies on the horizon, software, devices and gadgets and exchange ideas with people who share the same interests as you. Technology just got interesting!', 'AD-000MA1', 'images/1513157377.jpeg', '2017-12-13 08:29:38', '2018-01-11 09:07:57', 'Superadmin'),
(17, 'ENTREPRENEURSHIP', 'Superadmin', 'To all my independent hustlers, let’s shine like we’re supposed to. If you know that you’re a boss or you aspire to become your own boss someday, then this is where you should hang out and meet people who will inspire you to think outside the box. Rub minds with other pacesetters in various industries and get motivated through the sharing of ideas and experiences, learn tips on how to go about starting your own business and how to avoid common pitfalls in business. Information is power only when action is applied. Join us now and begin your journey to greatness. The sky is not your limit!', 'AD-000MA1', 'images/1513172379.jpeg', '2017-12-13 08:51:45', '2018-01-11 09:07:30', 'Superadmin'),
(18, 'READY TO MINGLE', 'Superadmin', 'Tired of the single life and ready to mingle? Well, its time to get excited because you are one step closer to ditching this single life. Get connected with other interesting singles such as yourself and have great conversations, a good laugh and loads of fun with amazing people. Who knows? You could just find your soulmate! Don’t miss out on this wonderful opportunity.', 'AD-000MA1', 'images/1515171721.jpeg', '2017-12-13 09:03:46', '2018-01-11 09:08:23', 'Superadmin'),
(19, 'ARTS AND CRAFT', 'Superadmin', 'To all my artistic minds what are you waiting for come lets paint nice,pictures of each other mould cups and sculpture,etc.Even if you can\'t you can learn from the best well known artist ,moulders,etc.Did i mention you get to go to all their exhibitions and even exhibit your own stuff oh and to the moulding and crafting factory were the pieces are put together to create amazing pieces.', 'AD-000MA1', 'images/1516009378.jpeg', '2017-12-13 09:35:18', '2018-01-15 08:43:02', 'Superadmin'),
(20, 'FUN AND GAMES', 'Superadmin', 'Game lovers we have got you covered.  Come and have the best time of your life playing interesting games with fun people.  There’s a game for everyone from guessing games, card games, board games, video games, group games, outdoor games, etc. Let loose, come and be a part of the amazing experiences we have to offer.', 'AD-000MA1', 'images/1515168005.jpeg', '2017-12-14 07:52:53', '2018-01-11 09:09:13', 'Superadmin'),
(21, 'MOVIES AND THEATRE', 'Superadmin', 'This is for all movie lovers who enjoy experiencing the thrill of action, suspense, horror, sci-fi, drama and the realisation of the day to day human struggles brought to life through moving, inspirational and powerful stage interpretations. If you have a flair for the cinematic, this is also for you. Let\'s mingle, share and enjoy the classics and the thrill of the latest and trending movies, experience the various relaxing and unique ambiences (indoors and outdoors) while enjoying exclusive themed and customised bites.', 'AD-000MA1', 'images/1515669268.jpeg', '2017-12-14 07:56:52', '2018-01-11 10:14:31', 'Superadmin'),
(22, 'HEALTH', 'Superadmin', 'Health is wealth as the popular philosophy goes, there is no doubt that our number one priority should be living a healthy and well-balanced lifestyle. This group is all about broadening your understanding of how to maintain a healthy and sanitary lifestyle thereby improving immensely the quality of your living standards. Join us and exchange health tips, share ideas and interact with professionals in the field.', 'AD-000MA1', 'images/1516005897.jpeg', '2017-12-14 08:01:46', '2018-01-15 07:44:59', 'Superadmin'),
(23, 'PHOTOGRAPHY', 'Superadmin', 'Photography is one of the arts that are thriving in the digital marketplace, with opportunities for employment both online and offline. So if you have a passion for photography, this is the right place for you. Learn the A-Z about photography and become the pro you aspire to be.', 'AD-000MA1', 'images/1516638386.jpeg', '2017-12-14 08:04:48', '2018-01-22 15:26:29', 'Superadmin'),
(24, 'BOOKWORMS', 'Superadmin', 'Reading is a way of relaxing, building imagination, staying updated and knowledgeable about a lot of different experiences, cultures, countries and the world around you. Come and be a part of this intellectual and interesting group.  We offer a wide range of books to pick from. Get to meet amazing authors and learn how they get inspired to write best selling books.', 'AD-000MA1', 'images/1516628432.jpeg', '2017-12-14 08:19:45', '2018-01-22 12:40:35', 'Superadmin'),
(25, 'THE AFFINITY FAM', 'Superadmin', 'Whats your affinity because we know ours this is where we get to meet with our clients and partners and indulging them in different topics ideas on how to improve the brand.We will get to hang out play games watch movies and do some dancing while we try to enjoy ourselves and have fun.', 'AD-000MA1', 'images/1516628719.png', '2017-12-15 09:46:28', '2018-01-22 12:45:21', 'Superadmin'),
(26, 'BEACH LOVERS', 'Superadmin', 'Who else likes to chill out on the beach and get away from the hustle and bustle of city life? Well, if you are like me then what are you waiting for? Come, let’s mingle with other beach lovers and enjoy the beautiful sceneries mother nature has to offer, play games like beach soccer, volleyball, ride horses and enjoy mouthwatering barbeque at different beach locations across the country.', 'AD-000MA1', 'images/1515074526.jpeg', '2018-01-04 07:59:58', '2018-01-11 09:58:44', 'Superadmin'),
(27, 'BEAUTY AND WELLBEING', 'Superadmin', 'Beauty goes beyond the physical and is about being the best possible version of yourself on the inside as well as the outside while wellbeing is a state of comfort, health and happiness. Join us and get all the info, tips and tricks from our beauty and wellness experts on the latest skincare and beauty news, treatments and therapies, nutrition, makeup and many more.', 'AD-000MA1', 'images/1516042170.jpeg', '2018-01-15 10:44:20', '2018-01-16 14:25:42', 'Superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `group_gallery`
--

CREATE TABLE `group_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `group_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_gallery`
--

INSERT INTO `group_gallery` (`id`, `avatar`, `group_id`, `created_at`) VALUES
(1, 'images/1526739212.jpeg', 1, '2018-05-19 14:13:32'),
(2, 'images/1526739848.jpeg', 1, '2018-05-19 14:24:08'),
(3, 'images/1526842015.jpeg', 27, '2018-05-20 18:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `group_posts`
--

CREATE TABLE `group_posts` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `post` varchar(3000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_posts`
--

INSERT INTO `group_posts` (`id`, `group_id`, `title`, `post`, `created_at`, `updated_at`, `avatar`) VALUES
(1, 27, 'Post Test', 'Test', '2018-05-20 19:02:40', '2018-05-20 19:02:40', 'images/1526846560.jpeg'),
(2, 27, 'Test2', 'Test2', '2018-05-20 19:03:47', '2018-05-20 19:03:47', 'images/1526846627.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `interest_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country`, `state`) VALUES
(1, 'Country', 'State'),
(2, 'Algeria', 'Mila'),
(3, 'Algeria', 'Oran'),
(4, 'Algeria', 'Adrar'),
(5, 'Algeria', 'Batna'),
(6, 'Algeria', 'Blida'),
(7, 'Algeria', 'Chlef'),
(8, 'Algeria', 'Jijel'),
(9, 'Algeria', 'Na'),
(10, 'Algeria', 'Annaba'),
(11, 'Algeria', 'Biskra'),
(12, 'Algeria', 'Bouira'),
(13, 'Algeria', 'Illizi'),
(14, 'Algeria', 'M'),
(15, 'Algeria', 'Sa'),
(16, 'Algeria', 'S'),
(17, 'Algeria', 'Skikda'),
(18, 'Algeria', 'Tiaret'),
(19, 'Algeria', 'Tipaza'),
(20, 'Algeria', 'B'),
(21, 'Algeria', 'B'),
(22, 'Algeria', 'Djelfa'),
(23, 'Algeria', 'El Oued'),
(24, 'Algeria', 'Guelma'),
(25, 'Algeria', 'M\'Sila'),
(26, 'Algeria', 'Tindouf'),
(27, 'Algeria', 'Tlemcen'),
(28, 'Algeria', 'Algiers'),
(29, 'Algeria', 'Gharda'),
(30, 'Algeria', 'Laghouat'),
(31, 'Algeria', 'Mascara'),
(32, 'Algeria', 'Ouargla'),
(33, 'Algeria', 'Relizane'),
(34, 'Algeria', 'T'),
(35, 'Algeria', 'A'),
(36, 'Algeria', 'Boumerd'),
(37, 'Algeria', 'El Bayadh'),
(38, 'Algeria', 'El Taref'),
(39, 'Algeria', 'Khenchela'),
(40, 'Algeria', 'Mostaganem'),
(41, 'Algeria', 'Souk Ahras'),
(42, 'Algeria', 'Tissemsilt'),
(43, 'Algeria', 'Tamanrasset'),
(44, 'Algeria', 'Tizi Ouzou'),
(45, 'Algeria', 'Constantine'),
(46, 'Algeria', 'A'),
(47, 'Algeria', 'Oum El Bouaghi'),
(48, 'Algeria', 'Sidi Bel Abbes'),
(49, 'Algeria', 'Bordj Bou Arr'),
(50, 'Benin', 'Zou'),
(51, 'Benin', 'Mono'),
(52, 'Benin', 'Donga'),
(53, 'Benin', 'Ou'),
(54, 'Benin', 'Borgou'),
(55, 'Benin', 'Kouffo'),
(56, 'Benin', 'Alibori'),
(57, 'Benin', 'Atakora'),
(58, 'Benin', 'Plateau'),
(59, 'Benin', 'Collines'),
(60, 'Benin', 'Littoral'),
(61, 'Benin', 'Atlantique'),
(62, 'Ethiopia', 'Afar'),
(63, 'Ethiopia', 'Amhara'),
(64, 'Ethiopia', 'Harari'),
(65, 'Ethiopia', 'Somali'),
(66, 'Ethiopia', 'Tigray'),
(67, 'Ethiopia', 'Gambela'),
(68, 'Ethiopia', 'Oromiya'),
(69, 'Ethiopia', 'Dire Dawa'),
(70, 'Ethiopia', 'Addis Ababa'),
(71, 'Ethiopia', 'Southern Nations'),
(72, 'Ethiopia', 'Benishangul-Gumuz'),
(73, 'Ghana', 'Volta'),
(74, 'Ghana', 'Ashanti'),
(75, 'Ghana', 'Central'),
(76, 'Ghana', 'Eastern'),
(77, 'Ghana', 'Western'),
(78, 'Ghana', 'Northern'),
(79, 'Ghana', 'Upper East'),
(80, 'Ghana', 'Upper West'),
(81, 'Ghana', 'Brong-Ahafo'),
(82, 'Ghana', 'Greater Accra'),
(83, 'Lesotho', 'Berea'),
(84, 'Lesotho', 'Leribe'),
(85, 'Lesotho', 'Maseru'),
(86, 'Lesotho', 'Quthing'),
(87, 'Lesotho', 'Mafeteng'),
(88, 'Lesotho', 'Mokhotlong'),
(89, 'Lesotho', 'Butha-Buthe'),
(90, 'Lesotho', 'Qacha\'s Nek'),
(91, 'Lesotho', 'Thaba-Tseka'),
(92, 'Lesotho', 'Mohale\'s Hoek'),
(93, 'Liberia', 'Bomi'),
(94, 'Liberia', 'Bong'),
(95, 'Liberia', 'Lofa'),
(96, 'Liberia', 'Nimba'),
(97, 'Liberia', 'Sinoe'),
(98, 'Liberia', 'Margibi'),
(99, 'Liberia', 'Gbarpolu'),
(100, 'Liberia', 'Maryland'),
(101, 'Liberia', 'Grand Kru'),
(102, 'Liberia', 'River Gee'),
(103, 'Liberia', 'River Cess'),
(104, 'Liberia', 'Grand Bassa'),
(105, 'Liberia', 'Grand Gedeh'),
(106, 'Liberia', 'Montserrado'),
(107, 'Liberia', 'Grand Cape Mount'),
(108, 'Libya', 'Ghat'),
(109, 'Libya', 'Surt'),
(110, 'Libya', 'Nalut'),
(111, 'Libya', 'Sabha'),
(112, 'Libya', 'Darnah'),
(113, 'Libya', 'Murzuq'),
(114, 'Libya', 'Al Marj'),
(115, 'Libya', 'Al Jfara'),
(116, 'Libya', 'Al Wahat'),
(117, 'Libya', 'Benghazi'),
(118, 'Libya', 'Misratah'),
(119, 'Libya', 'Al Butnan'),
(120, 'Libya', 'Al Jufrah'),
(121, 'Libya', 'Al Kufrah'),
(122, 'Libya', 'Al Murgub'),
(123, 'Libya', 'Tarabulus'),
(124, 'Libya', 'Az Zawiyah'),
(125, 'Libya', 'Wadi Al Hayaa'),
(126, 'Libya', 'Wadi Al Shatii'),
(127, 'Libya', 'An Nuqat al Khams'),
(128, 'Libya', 'Al Jabal al Akhdar'),
(129, 'Libya', 'Al Jabal al Gharbi'),
(130, 'Madagascar', 'Toliara'),
(131, 'Madagascar', 'Mahajanga'),
(132, 'Madagascar', 'Toamasina'),
(133, 'Madagascar', 'Antsiranana'),
(134, 'Madagascar', 'Antananarivo'),
(135, 'Madagascar', 'Fianarantsoa'),
(136, 'Malawi', 'Dowa'),
(137, 'Malawi', 'Neno'),
(138, 'Malawi', 'Dedza'),
(139, 'Malawi', 'Zomba'),
(140, 'Malawi', 'Balaka'),
(141, 'Malawi', 'Likoma'),
(142, 'Malawi', 'Mwanza'),
(143, 'Malawi', 'Mzimba'),
(144, 'Malawi', 'Nsanje'),
(145, 'Malawi', 'Ntcheu'),
(146, 'Malawi', 'Rumphi'),
(147, 'Malawi', 'Salima'),
(148, 'Malawi', 'Thyolo'),
(149, 'Malawi', 'Chitipa'),
(150, 'Malawi', 'Karonga'),
(151, 'Malawi', 'Kasungu'),
(152, 'Malawi', 'Mchinji'),
(153, 'Malawi', 'Mulanje'),
(154, 'Malawi', 'Ntchisi'),
(155, 'Malawi', 'Blantyre'),
(156, 'Malawi', 'Chikwawa'),
(157, 'Malawi', 'Lilongwe'),
(158, 'Malawi', 'Machinga'),
(159, 'Malawi', 'Mangochi'),
(160, 'Malawi', 'Phalombe'),
(161, 'Malawi', 'Chiradzulu'),
(162, 'Malawi', 'Nkhata Bay'),
(163, 'Malawi', 'Nkhotakota'),
(164, 'Namibia', 'Karas'),
(165, 'Namibia', 'Erongo'),
(166, 'Namibia', 'Hardap'),
(167, 'Namibia', 'Khomas'),
(168, 'Namibia', 'Kunene'),
(169, 'Namibia', 'Oshana'),
(170, 'Namibia', 'Caprivi'),
(171, 'Namibia', 'Kavango'),
(172, 'Namibia', 'Omaheke'),
(173, 'Namibia', 'Omusati'),
(174, 'Namibia', 'Oshikoto'),
(175, 'Namibia', 'Ohangwena'),
(176, 'Namibia', 'Otjozondjupa'),
(177, 'Nigeria', 'Edo'),
(178, 'Nigeria', 'Imo'),
(179, 'Nigeria', 'Oyo'),
(180, 'Nigeria', 'Abia'),
(181, 'Nigeria', 'Kano'),
(182, 'Nigeria', 'Kogi'),
(183, 'Nigeria', 'Ogun'),
(184, 'Nigeria', 'Ondo'),
(185, 'Nigeria', 'Osun'),
(186, 'Nigeria', 'Yobe'),
(187, 'Nigeria', 'Abuja'),
(188, 'Nigeria', 'Benue'),
(189, 'Nigeria', 'Borno'),
(190, 'Nigeria', 'Delta'),
(191, 'Nigeria', 'Ekiti'),
(192, 'Nigeria', 'Enugu'),
(193, 'Nigeria', 'Gombe'),
(194, 'Nigeria', 'Kebbi'),
(195, 'Nigeria', 'Kwara'),
(196, 'Nigeria', 'Lagos'),
(197, 'Nigeria', 'Niger'),
(198, 'Nigeria', 'Bauchi'),
(199, 'Nigeria', 'Ebonyi'),
(200, 'Nigeria', 'Jigawa'),
(201, 'Nigeria', 'Kaduna'),
(202, 'Nigeria', 'Rivers'),
(203, 'Nigeria', 'Sokoto'),
(204, 'Nigeria', 'Taraba'),
(205, 'Nigeria', 'Adamawa'),
(206, 'Nigeria', 'Anambra'),
(207, 'Nigeria', 'Bayelsa'),
(208, 'Nigeria', 'Katsina'),
(209, 'Nigeria', 'Plateau'),
(210, 'Nigeria', 'Zamfara'),
(211, 'Nigeria', 'Nasarawa'),
(212, 'Nigeria', 'Akwa Ibom'),
(213, 'Nigeria', 'Cross River'),
(214, 'Senegal ', 'Dakar'),
(215, 'Senegal ', 'Kolda'),
(216, 'Senegal ', 'Louga'),
(217, 'Senegal ', 'Matam'),
(218, 'Senegal ', 'Thi'),
(219, 'Senegal ', 'Fatick'),
(220, 'Senegal ', 'Kaolack'),
(221, 'Senegal ', 'S'),
(222, 'Senegal ', 'Diourbel'),
(223, 'Senegal ', 'Kaffrine'),
(224, 'Senegal ', 'K'),
(225, 'Senegal ', 'Ziguinchor'),
(226, 'Senegal ', 'Saint-Louis'),
(227, 'Senegal ', 'Tambacounda'),
(228, 'Seychelles ', 'Au Cap'),
(229, 'Seychelles ', 'Glacis'),
(230, 'Seychelles ', 'Bel Air'),
(231, 'Seychelles ', 'Cascade'),
(232, 'Seychelles ', 'La Digue'),
(233, 'Seychelles ', 'Takamaka'),
(234, 'Seychelles ', 'Bel Ombre'),
(235, 'Seychelles ', 'Plaisance'),
(236, 'Seychelles ', 'Port Glaud'),
(237, 'Seychelles ', 'Anse Etoile'),
(238, 'Seychelles ', 'Anse Royale'),
(239, 'Seychelles ', 'Baie Lazare'),
(240, 'Seychelles ', 'Beau Vallon'),
(241, 'Seychelles ', 'Mont Buxton'),
(242, 'Seychelles ', 'Mont Fleuri'),
(243, 'Seychelles ', 'Saint Louis'),
(244, 'Seychelles ', 'Anse Boileau'),
(245, 'Seychelles ', 'Les Mamelles'),
(246, 'Seychelles ', 'Roche Caiman'),
(247, 'Seychelles ', 'Anse aux Pins'),
(248, 'Seychelles ', 'Pointe La Rue'),
(249, 'Seychelles ', 'GrandAnse Mahe'),
(250, 'Seychelles ', 'Baie Sainte Anne'),
(251, 'Seychelles ', 'GrandAnse Praslin'),
(252, 'Seychelles ', 'La Riviere Anglaise'),
(253, 'Sierra Leone ', 'Bo'),
(254, 'Sierra Leone ', 'Kono'),
(255, 'Sierra Leone ', 'Bonthe'),
(256, 'Sierra Leone ', 'Kambia'),
(257, 'Sierra Leone ', 'Kenema'),
(258, 'Sierra Leone ', 'Bombali'),
(259, 'Sierra Leone ', 'Moyamba'),
(260, 'Sierra Leone ', 'Pujehun'),
(261, 'Sierra Leone ', 'Kailahun'),
(262, 'Sierra Leone ', 'Koinadugu'),
(263, 'Sierra Leone ', 'Port Loko'),
(264, 'Sierra Leone ', 'Tonkolili'),
(265, 'Sierra Leone ', 'Western Area Rural'),
(266, 'Sierra Leone ', 'Western Area Urban'),
(267, 'Somalia ', 'Bay'),
(268, 'Somalia ', 'Bari'),
(269, 'Somalia ', 'Gedo'),
(270, 'Somalia ', 'Sool'),
(271, 'Somalia ', 'Awdal'),
(272, 'Somalia ', 'Mudug'),
(273, 'Somalia ', 'Bakool'),
(274, 'Somalia ', 'Nugaal'),
(275, 'Somalia ', 'Sanaag'),
(276, 'Somalia ', 'Hiiraan'),
(277, 'Somalia ', 'Banaadir'),
(278, 'Somalia ', 'Togdheer'),
(279, 'Somalia ', 'Galguduud'),
(280, 'Somalia ', 'Lower Juba'),
(281, 'Somalia ', 'Middle Juba'),
(282, 'Somalia ', 'Lower Shabele'),
(283, 'Somalia ', 'Middle Shabele'),
(284, 'Somalia ', 'Woqooyi Galbeed'),
(285, 'South Africa ', 'Gauteng'),
(286, 'South Africa ', 'Limpopo'),
(287, 'South Africa ', 'Free State'),
(288, 'South Africa ', 'Mpumalanga'),
(289, 'South Africa ', 'North West'),
(290, 'South Africa ', 'Eastern Cape'),
(291, 'South Africa ', 'Western Cape'),
(292, 'South Africa ', 'KwaZulu-Natal'),
(293, 'South Africa ', 'Northern Cape'),
(294, 'Sudan ', 'Lakes'),
(295, 'Sudan ', 'Unity'),
(296, 'Sudan ', 'Warab'),
(297, 'Sudan ', 'Sennar'),
(298, 'Sudan ', 'Jonglei'),
(299, 'Sudan ', 'Kassala'),
(300, 'Sudan ', 'Red Sea'),
(301, 'Sudan ', 'Khartoum'),
(302, 'Sudan ', 'Northern'),
(303, 'Sudan ', 'Blue Nile'),
(304, 'Sudan ', 'Al Jazirah'),
(305, 'Sudan ', 'Al Qadarif'),
(306, 'Sudan ', 'River Nile'),
(307, 'Sudan ', 'Upper Nile'),
(308, 'Sudan ', 'White Nile'),
(309, 'Sudan ', 'West Darfur'),
(310, 'Sudan ', 'North Darfur'),
(311, 'Sudan ', 'South Darfur'),
(312, 'Sudan ', 'East Equatoria'),
(313, 'Sudan ', 'North Kurdufan'),
(314, 'Sudan ', 'South Kurdufan'),
(315, 'Sudan ', 'West Equatoria'),
(316, 'Sudan ', 'Central Equatoria'),
(317, 'Sudan ', 'West Bahr al Ghazal'),
(318, 'Sudan ', 'North Bahr al Ghazal'),
(319, 'Swaziland ', 'Hhohho'),
(320, 'Swaziland ', 'Lubombo'),
(321, 'Swaziland ', 'Manzini'),
(322, 'Swaziland ', 'Shiselweni'),
(323, 'Togo ', 'Vo');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchant_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_pin` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(9000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ntk` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `merchant_id`, `category_id`, `name`, `rating`, `address`, `latitude`, `longitude`, `contact`, `email`, `verification_pin`, `avatar`, `created_at`, `updated_at`, `country`, `state`, `city`, `website`, `details`, `bio`, `ntk`) VALUES
(231, 'KD0231', 'Beauty, Health and Wellbeing', 'K-Dove Gym', '0', '166A Bisi Obadina Street', '6.637909', '3.365468', '08023683722', 'kdoveinter@yahoo.co.uk', '0326', 'images/1515150851.png', '2018-01-05 10:18:35', '2018-02-09 18:13:17', 'Nigeria', 'Lagos', 'Omole Phase 1', NULL, NULL, NULL, NULL),
(215, 'WAS215', 'Services', 'Wasche Point Laundry & Dry Cleaning', '100', 'Plot 12, Emmanuel Abimbola Street, Off Fola Osibo Street', '6.447506', '3.473407', '09060000843', 'info@waschepoint.com', '9399', 'images/1518793922.jpeg', '2017-12-18 09:34:20', '2018-03-27 13:36:31', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(207, 'SIL207', 'Hotels And Resorts', 'Silver Grandeur Hotel', '0', '4 Agbor Street', '6.546660', '3.33347', '08064965450', 'info@silvergrandeurhotel.com', '6762', 'images/1517587991.jpeg', '2017-12-15 14:18:53', '2018-02-23 07:11:48', 'Nigeria', 'Lagos', 'Ajao Estate', NULL, NULL, NULL, NULL),
(212, 'PAD212', 'Services', 'PADDIES FNB CATERING SERVICES & EVENTS', '0', '11 Ayodele Okeowo Street', '6.556007', '3.388093', '07013000768', 'pat_akan2006@yahoo.com', '7720', 'images/1518793751.jpeg', '2017-12-15 15:27:58', '2018-02-16 14:09:29', 'Nigeria', 'Lagos', 'Gbagada', NULL, NULL, NULL, NULL),
(213, 'DAV213', 'Fashion', 'David Wej - Ikeja', '0', '44 Opebi Rd, Opebi', '6.590238', '3.360413', '07055773661', 'sales@davidwej.com', '4032', 'images/1517587679.jpeg', '2017-12-15 15:31:40', '2018-02-09 18:29:34', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(209, 'FRE209', 'Restaurants', 'Freshly Ground Coffee Co', '0', '17B, Awolowo Road', '6.443596', '3.411808', '07045434822', 'thefreshlygroundcoffee@gmail.com', '8619', 'images/1524138557.jpeg', '2017-12-15 14:58:56', '2018-04-19 10:49:25', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(210, 'DAV210', 'Fashion', 'David Wej - Victoria Island', '0', '27B, Idowu Martins Street, Off Adeola Odeku Street', '6.590238', '3.360413', '08072882097', 'sales@davidwej.com', '0417', 'images/1517587752.png', '2017-12-15 15:19:18', '2018-02-09 18:28:49', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(206, 'ORI206', 'Hotels And Resorts', 'Oriental Hotel', '0', '3 Lekki - Epe Express Way, Eti-Osa', '6.435959', '3.443893', '012806600', 'info@lagosoriental.com', '4665', 'images/1517935024.jpeg', '2017-12-15 13:48:10', '2018-02-09 18:26:34', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(22, 'EAR0022', 'Beauty, Health and Wellbeing', 'Earth Blend Juice Lab', '0', 'Rade Mall, 21B, Fola Osibo Street', '6.443145', '3.46802', '08175983862', 'Lagos', '0914', 'images/1523622304.jpeg', '2017-11-15 14:34:41', '2018-04-13 11:25:05', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(19, 'LA0019', 'Restaurants', 'La Veranda', '0', '17, Oju Olobun Street', '6.426412', '3.417212', '08121111222', 'reservation@laveranda.com.ng', '3137', 'images/1523619063.jpeg', '2017-11-15 12:01:47', '2018-04-13 10:31:06', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(20, 'IZA0020', 'Restaurants', 'Izanagi', '0', '19B, Idejo Street', '6.426449', '3.414466', '07062222222', 'reservation@izanagirestaurant.com', '2971', 'images/1523622529.jpeg', '2017-11-15 13:29:59', '2018-04-13 11:28:51', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(21, 'DJ 0021', 'Arts,Entertainment And Recreation', 'DJ Poppaey', '0', '19B, Prince Bode Adebowale Street', '6.441317', '3.477727', '08107593664', 'poppaey@gmail.com', '0976', 'images/1523622924.jpeg', '2017-11-15 13:52:12', '2018-04-13 11:35:25', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(24, 'PUR0024', 'Restaurants', 'Purple Restaurant', '0', '17, Oju Olobun Street', '6.426412', '3.417212', '07066333333', 'frontdesk@theblowfishhotel.com', '4936', 'images/1523625230.jpeg', '2017-11-16 11:13:52', '2018-04-13 12:13:52', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(23, 'MOA0023', 'Fashion', 'Moashy Studio', '0', '2, Victoria Ariobeke Street', '6.447111', '3.472356', '09090005271', 'info.moashystylingstudio@gmail.com', '6078', 'images/1523623717.png', '2017-11-16 10:47:40', '2018-04-13 11:48:39', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(25, 'MAG0025', 'Fashion', 'Magnum Stitches', '0', '3, Ilupeju Bye Pass', '6.54527', '3.35811', '08064866280', 'info@magnum-stitches.com', '6461', 'images/1523626225.png', '2017-11-16 11:30:50', '2018-04-13 14:08:18', 'Nigeria', 'Lagos', 'Ilupeju', NULL, NULL, NULL, NULL),
(26, 'COL0026', 'Beauty, Health and Wellbeing', 'Colors By RL Spa', '0', '21B, Fola Osibo Street', '6.442725', '3.466859', '08052560974', 'coloursbyrl@gmail.com', '5372', 'images/1523626533.jpeg', '2017-11-16 12:18:21', '2018-04-13 12:35:36', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(27, 'INS0027', 'Restaurants', 'Inspiro Galleria', '0', '1, Joseph Nahman Close, off Karimu Kotun', '6.425599', '3.426033', '08069072963', 'inspirogalleria@gmail.com', '6614', 'images/1523627772.png', '2017-11-16 12:31:44', '2018-04-13 12:56:14', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(28, 'TEA0028', 'Restaurants', 'Exquisite Tearoom Limited', '0', '1, Chief Collins Uchidiuno', '6.439868', '3.475725', '08028025333', 'a.okunowo@xquisitegroup.com', '7307', 'images/1510839471.jpeg', '2017-11-16 12:41:10', '2018-03-19 15:29:47', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(29, 'NIK0029', 'Beauty, Health and Wellbeing', 'Niki O Salon And Spa', '0', '31, Victoria Arobieke Street', '6.443116', '3.472559', '08090456777', 'nikiosalon@yahoo.com', '4572', 'images/1523630820.png', '2017-11-16 13:39:25', '2018-04-13 13:47:02', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(30, 'BHI0030', 'Restaurants', 'BHive Restaurant and Bar', '0', '31, Victoria Arobieke Street, Off Fola Osibo Street', '6.443116', '3.472559', '08109398950', 'gwinpmg@gmail.com', '1173', 'images/1523630516.png', '2017-11-16 13:44:09', '2018-04-13 13:41:59', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(31, 'MIC0031', 'Restaurants', 'Micos House Of Chicken And Waffles', '0', 'Samit Mall, 69 Admiralty Way', '6.448045', '3.47459', '09092159056', 'infomicoscw@gmail.com', '5194', 'images/1523631461.png', '2017-11-16 13:54:09', '2018-04-13 13:57:43', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(32, 'TBF0032', 'Hotels And Resorts', 'The Blow Fish Hotel', '0', '17, Oju Olobun Street off Bishop Oluwole Street', '6.426588', '3.416079', '08122223222', 'georges.boulos@theblowfishhotel.com', '8470', 'images/1523631962.jpeg', '2017-11-16 14:01:50', '2018-04-13 14:06:06', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(33, 'SAH0033', 'Restaurants', 'Saheeto Small Chops', '0', '119 Lewis Street, Obalende, Lagos Island', '6.449445', '3.407438', '012121539', 'info@saheetosmallchops.com', '1010', 'images/1523633539.jpeg', '2017-11-16 14:11:04', '2018-04-13 14:32:32', 'Nigeria', 'Lagos', 'Obalende', NULL, NULL, NULL, NULL),
(34, 'PRE0034', 'Fashion', 'Preston And Porter', '0', '27, Fola Osibo Street', '6.44274', '3.467536', '07035703268', 'prestonandporter@gmail.com', '6066', 'images/1523633045.png', '2017-11-16 14:18:27', '2018-04-13 14:24:11', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(35, 'GIF366', 'Services', '366 Gifts and Hampers', '0', 'D4B, Mayor\'s Court, 2-4 Grace Anjous Drive', '6.444827', '3.467993', '08184874026', '366hampers@gmail.com', '8483', 'images/1523633283.png', '2017-11-16 14:29:40', '2018-04-13 14:28:10', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(36, 'ASH0036', 'Fashion', 'Ashabi Tailoring', '0', '6, Admiralty Way, Lekki Phase 1', '6.457468', '3.47192', '07062374105', 'ashabitailoringservice@gmail.com', '3220', 'images/1524039113.jpeg', '2017-11-16 14:38:47', '2018-04-18 07:12:03', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(37, 'KIM0037', 'Fashion', 'Kimono Kollection', '0', '18B, Fola Osibo Street', '6.442528', '3.467988', '012934146', 'info@kimonokollection.com', '3121', 'images/1523634602.jpeg', '2017-11-16 14:55:14', '2018-04-13 14:50:05', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(38, 'EKO0038', 'Beauty, Health and Wellbeing', 'Eko Gym & Spa', '0', '9A, Akarigbere Close, Off Idejo Street', '6.42486', '3.413552', '08034481311', 'ekogymandspa@gmail.com', '8920', 'images/1510848002.jpeg', '2017-11-16 15:06:13', '2017-12-20 12:03:24', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(39, 'VIC0039', 'Hotels And Resorts', 'Victoria Crown Plaza Hotel', '0', '292B, Ajose Adeogun Street', '6.430518', '3.441164', '012719800', 'reservations@vcphotels.com', '4511', 'images/1523972737.jpeg', '2017-11-17 08:30:29', '2018-04-17 12:55:09', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(40, 'BAR0040', 'Restaurants', 'Barangular', '0', '1, Ogbunike Street, off Avalon House', '6.447501', '3.457484', '08188884440', 'info@anglevilla.com', '7474', 'images/1523956893.jpeg', '2017-11-17 08:37:47', '2018-04-17 08:24:21', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(41, 'GOO0041', 'Beauty, Health and Wellbeing', 'Good Hair Ltd', '0', 'Plot 26, Admiralty Way', '6.447768', '3.481259', '08092858323', 'info@goodhairltd.com', '6737', 'images/1523978267.jpeg', '2017-11-17 08:45:37', '2018-04-17 14:17:54', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(42, 'DAP0042', 'Fashion', 'DAP MOD', '0', '19A, Fola Osibo Street', '6.444161', '3.468297', '08094164050', 'dapmodwear@yahoo.com', '5782', 'images/1523973819.jpeg', '2017-11-17 08:54:58', '2018-04-17 13:03:46', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(44, 'WIN0044', 'Bars And Nightlife', 'Wind Lounge', '90', 'GistMe Building, KM 13, Lekki-Epe Expressway', '6.431224', '3.431224', '09090216447', 'obidinmaodinakachukwu@yahoo.com', '1848', 'images/1524066551.jpeg', '2017-11-17 09:11:56', '2018-04-18 14:49:19', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(45, 'AI0045', 'Services', 'A&I Laundry & Drycleaning Ltd', '0', '228, Herbert Macaulay Street, Alagomeji', '6.498927', '3.378961', '08098889925', 'louisaolaloku@yahoo.com', '8109', 'images/1519817017.jpeg', '2017-11-17 09:26:57', '2018-02-28 10:23:40', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(46, 'CHA0046', 'Beauty, Health and Wellbeing', 'Charisma Cosmetic', '0', '15B, Oduduwa Way, GRA', '6.573654', '3.359706', '08033335876', 'charismacosmetics@yahoo.com', '6812', 'images/1523975610.png', '2017-11-17 09:40:04', '2018-04-17 13:33:32', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(47, 'PAM0047', 'Arts,Entertainment And Recreation', 'Pamper Me Lush Events', '0', '15, Alara Street, Onike', '6.507407', '3.3383859', '08160002662', 'wogunde@gmail.com', '4985', 'images/1523976144.bin', '2017-11-17 10:00:10', '2018-04-17 13:42:35', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(48, 'TWH0048', 'Hotels And Resorts', 'The \'W\' Hotel', '0', '1, Oduduwa Way, GRA', '6.574623', '3.357896', '016323386', 'debocollins1@gmail.com', '3342', 'images/1523976707.jpeg', '2017-11-18 14:57:42', '2018-04-17 13:51:54', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(49, 'NAI0049', 'Beauty, Health and Wellbeing', 'Nail Plus Ventures', '0', '5, Davies street, off UNILAG road, Abule-Oja B/Stop, Akoka', '6.482972', '3.34453', '08093333353', 'nailplus2013@gmail.com', '8056', 'images/1523977145.jpeg', '2017-11-19 13:59:35', '2018-04-17 13:59:14', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(50, 'EAG0050', 'Beauty, Health and Wellbeing', 'Eagle Fit Gym (Eagle Club)', '0', '96-100, Adeniran Ogunsanya Street', '6.4914489', '3.356507', '08035181069', 'monimawokoma@yahoo.com', '1160', 'images/1523977439.jpeg', '2017-11-19 14:09:24', '2018-04-17 14:04:05', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(51, 'ANG0051', 'Hotels And Resorts', 'Angle Villa Ltd', '80', '1, Ogbunike street, off Avalon House', '6.447501', '3.457484', '08180001131', 'gm@anglevilla.com', '9889', 'images/1511177890.jpeg', '2017-11-20 10:40:28', '2018-04-09 14:38:28', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(52, 'ABE0052', 'Beauty, Health and Wellbeing', 'Abefe-Make Me Beautiful', '0', '4, Davies street, off UNILAG road, Akoka', '6.51767', '3.382458', '08028647034', 'abefebeauti@gmail.com', '5768', 'images/1523977760.jpeg', '2017-11-20 11:18:05', '2018-04-17 14:09:30', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(53, 'HAI0053', 'Beauty, Health and Wellbeing', 'Hair by Bees Roots', '0', '3/5, Adeyemo Alakija Street, Off Sanusi Fafunwa', '6.431546', '3.424856', '08093000098', 'bimbofasoranti@gmail.com', '6564', 'images/1523978087.jpeg', '2017-11-20 11:40:12', '2018-04-18 13:15:41', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(54, 'BON0054', 'Hotels And Resorts', 'Bon Voyage hotel', '0', '57A, A.J. Marinho Drive, Off Tony Anegbode Street', '6.426354', '3.434255', '08090235988', 'Lagos', '7036', 'images/1523978716.jpeg', '2017-11-20 12:17:22', '2018-04-17 14:25:18', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(55, 'OAS0055', 'Beauty, Health and Wellbeing', 'Oasis Medspa', '0', '21, Cameron Road', '6.457677', '3.431932', '08180822222', 'info@oasismedspang.com', '1774', 'images/1523980223.jpeg', '2017-11-20 13:54:28', '2018-04-17 14:50:31', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(56, 'BOD0056', 'Beauty, Health and Wellbeing', 'Bodyline Fitness & Gym', '0', '6, Bank Road', '6.449516', '3.410371', '08098275353', 'bodyline@bodylineng.com', '4724', 'images/1524059477.jpeg', '2017-11-20 14:08:21', '2018-04-18 12:51:21', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(57, 'LAM0057', 'Arts,Entertainment And Recreation', 'Lamborghini Inc Ltd', '0', 'Plot 11, Block 113, Lekki Epe Expressway', '6.43699', '3.509558', '08022436798', 'lamboecars@yahoo.com', '5277', 'images/1511190773.jpeg', '2017-11-20 14:22:36', '2017-12-20 11:22:54', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(58, 'JOH0058', 'Beauty, Health and Wellbeing', 'Johnny Salon & Spa', '0', 'F4-1, Mega Plaza, 14, Idowu Martins Street', '6.433337', '3.420474', '08080808805', 'styling-jhonny@hotmail.com', '2039', 'images/1511192036.jpeg', '2017-11-20 14:39:21', '2017-12-20 11:21:55', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(61, 'HOD0061', 'Services', 'Hodge Auto Centre', '0', 'Plot 11/27, Ocean Bay Road (opposite Dream World Africana)', '6.429702', '3.554818', '07040555511', 'b.adebanjo@hodgeautocentre.com', '2617', 'images/1519817688.png', '2017-11-22 09:22:52', '2018-04-11 16:37:10', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(62, 'THE0062', 'Arts,Entertainment And Recreation', 'The Red Carpet Hall', '0', '9, Yesufu Abiodun road, Oniru', '6.425663', '3.448555', '07042146910', 'pnjoku@redcarpethall.com', '6122', 'images/1511347349.jpeg', '2017-11-22 09:45:58', '2017-12-20 11:17:56', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(63, 'SHO0063', 'Beauty, Health and Wellbeing', 'Shomya Cosmetics Ltd', '0', '12E Plot B, Admiralty Way', '6.446739', '3.463381', '08182512087', 'info@shomya.com', '2202', 'images/1524060823.jpeg', '2017-11-22 10:54:02', '2018-04-18 13:13:46', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(64, 'TBA0064', 'Beauty, Health and Wellbeing', 'The Beauty Atelier', '0', 'Shop 5, 3rd floor, Centro Mall, Admiralty Way', '6.447457', '3.476535', '08099475555', 'thebeautyatelier@gmail.com', '5568', 'images/1524057480.jpeg', '2017-11-22 11:04:41', '2018-04-18 12:18:03', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(65, 'DOR0065', 'Beauty, Health and Wellbeing', 'Doranne Beauty - Lekki', '0', '6D, Shaffi Sule street, off Admiralty Way', '6.446831', '3.456974', '08033189884', 'info@dorannebeauty.com', '6750', 'images/1521478187.jpeg', '2017-11-22 11:11:51', '2018-03-19 15:49:59', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(66, 'CAI0066', 'Restaurants', 'CaiShen Chinese Restaurant', '0', '84, Opebi Road', '6.586458', '3.363238', '09080177777', 'csy_nigeria@163.com', '9484', 'images/1511353050.gif', '2017-11-22 11:29:26', '2018-02-09 14:38:29', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(67, 'REN0067', 'Hotels And Resorts', 'Renaissance Hotel', '0', '38/40, Isaac John Street,GRA', '6.581951', '3.358584', '09087805547', 'adedamola.mogaji@marriott.com', '0137', 'images/1517573679.jpeg', '2017-11-22 11:54:24', '2018-02-02 11:14:42', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(68, 'BLI0068', 'Beauty, Health and Wellbeing', 'Blissfield Dental Clinic', '0', '319, Borno Way, Alagomeji', '6.496898', '3.377803', '08023134407', 'blissfielddental@gmail.com', '8296', 'images/1519729773.jpeg', '2017-11-22 12:00:46', '2018-02-27 10:11:47', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(69, 'FRE0069', 'Beauty, Health and Wellbeing', 'Freshlook Spa Centre', '0', '41A, Joel Ogunnaike Street, GRA', '6.584662', '3.351383', '08033657595', 'freshlookspa2@gmail.com', '3739', 'images/1511356119.jpeg', '2017-11-22 12:11:47', '2018-02-09 14:45:43', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(70, 'BRU0070', 'Beauty, Health and Wellbeing', 'Bruno\'s Place', '0', 'Shop U07, Ikeja City Mall, Alausa', '6.614423', '3.358191', '08033044370', 'sas_kingdomnews@yahoo.co.uk', '6659', 'images/1511361573.jpeg', '2017-11-22 13:40:20', '2018-04-18 11:58:16', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(71, 'IND0071', 'Fashion', 'Indigo Boutique', '60', '19, Fola Osibo Street', '6.442818', '3.466792', '08022038075', 'jibby001@gmail.com', '1751', 'images/1511361881.jpeg', '2017-11-22 13:45:47', '2018-04-16 12:12:36', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(72, 'HOU0072', 'Fashion', 'House of Dorothy Bridals', '0', '254B, Ikorodu Crescent, Dolphin Estate', '6.457286', '3.357587', '08087882486', 'houseofdorothy@gmail.com', '6100', 'images/1511362340.jpeg', '2017-11-22 13:56:24', '2017-12-20 11:00:31', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(73, 'TRL0073', 'Hotels And Resorts', 'The Regent Luxury Suites', '0', '25, Joel Ogunnaike Street, GRA', '6.585173', '3.351379', '08023878269', 'reservation@theregentlagos.com', '5536', 'images/1519733894.jpeg', '2017-11-22 14:06:30', '2018-02-27 11:18:19', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(74, 'ZEN0074', 'Restaurants', 'Zenith Water Margin', '0', '28, Adeniran Ogunsanya Street', '6.497069', '3.357587', '08033393184', 'zenithwatermargin@gmail.com', '9860', 'images/1524135799.jpeg', '2017-11-22 14:12:05', '2018-04-19 10:03:23', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(75, 'TRU0075', 'Restaurants', 'Truffles Restaurant & Bar', '80', '45A, Sobo Arobiodun Street, GRA', '6.577218', '3.355661', '08132775699', 'manager@truffles.com', '2354', 'images/1511363793.png', '2017-11-22 14:17:53', '2018-02-09 14:53:08', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(76, 'NEG0076', 'Arts,Entertainment And Recreation', 'Negro Arts Ltd', '70', '77, Adeniran Ogunsanya Street', '6.491959', '3.356832', '07025812396', 'ogbogufunmilayo@yahoo.com', '1531', 'images/1524055633.png', '2017-11-22 14:27:32', '2018-05-09 07:51:05', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(77, 'ARA0077', 'Restaurants', 'Arabesque Restaurant', '0', '225B Etim Iyan Crescent', '6.433070', '3.439482', '07069665555', 'info@arabesquerestaurant.com', '4379', 'images/1511960885.jpeg', '2017-11-29 12:11:16', '2018-01-24 13:49:52', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(78, 'EXT0078', 'Bars And Nightlife', 'Extreme Lounge And Club', '0', 'Novare Lekki Mall', '6.470238', '3.639686', '08099528000', 'extremeloungeandclub@gmail.com', '1673', 'images/1519732703.jpeg', '2017-11-29 12:18:29', '2018-02-27 10:58:27', 'Nigeria', 'Lagos', 'Sangotedo', NULL, NULL, NULL, NULL),
(79, 'MOH0079', 'Beauty, Health and Wellbeing', 'Moha Salon @Intercontinental Hotel Lagos', '0', 'Intercontinental Hotel, 5th Floor, Plot 52A, Kofo Abayomi Street', '6.434829', '3.423015', '07015177777', 'mohaasalon@gmail.com', '4565', 'images/1511962838.png', '2017-11-29 12:43:21', '2018-02-09 15:00:24', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(80, 'GLE0080', 'Hotels And Resorts', 'Glee Hotel', '100', '287B, Akin Olugbade Street', '6.430831', '3.422108', '09037124689', 'booking@hotelglee.com', '7748', 'images/1511963474.png', '2017-11-29 13:01:57', '2018-03-21 11:27:49', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(81, 'HOM0081', 'Hotels And Resorts', 'Homegate Resort', '0', '6, Babafemi Osoba Crescent, Off Admiralty Way', '6.457797', '3.422108', '08076591648', 'info@homegate-ng.com', '6757', 'images/1511964739.jpeg', '2017-11-29 13:15:38', '2018-02-27 09:53:36', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(82, 'IMA0082', 'Retail', 'Imagia Italian Furniture Limited', '0', '37 Bode Thomas Street', '6.470238', '3.639686', '08057656280', 'info@imagiafurniture.com', '6763', 'images/1512029611.jpeg', '2017-11-30 07:15:29', '2018-02-09 15:11:55', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(83, 'CHR0083', 'Kids', 'Christabels Kids', '0', '146 Bode Thomas Street', '6.488396', '3.360409', '08023161347', 'christabelskids@gmail.com', '5775', 'images/1512030647.jpeg', '2017-11-30 07:31:36', '2018-02-09 15:12:52', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(84, 'DEE0084', 'Beauty, Health and Wellbeing', 'Deevian Day Spa', '0', '1, Abebe Village Road,Off Eric Moore Road', '6.481425', '3.361493', '07061555060', 'ifeomaokeke54@yahoo.com', '5721', 'images/1512031707.jpeg', '2017-11-30 07:51:31', '2018-02-09 15:15:30', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(85, 'SHA0085', 'Beauty, Health and Wellbeing', 'Shades Of Beauty And Spa', '0', '6, Ibezim Obiamjulu Street', '6.499636', '3.350547', '09098810369', 'shadesofbeauty123@yahoo.com', '4661', 'images/1512032268.png', '2017-11-30 08:00:05', '2018-02-09 15:22:05', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(86, 'BEA0086', 'Beauty, Health and Wellbeing', 'Beauty Beseech Spa And Salon', '0', '90, Adeniran Ogunsanya Street', '6.491327', '3.356532', '07037825858', 'info@beautybeseech.com', '7682', 'images/1512034698.gif', '2017-11-30 09:04:32', '2018-02-16 13:52:23', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(87, 'BIL0087', 'Services', 'Bilan Cleaning Services', '70', '24, Ilelogo Street', '6.501525', '3.352345', '08038034971', 'info@bilancleaningservices.com', '4805', 'images/1524060760.jpeg', '2017-11-30 09:15:09', '2018-04-18 13:12:47', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(88, 'SLI0088', 'Bars And Nightlife', 'Sliquors by Arzeh', '0', '234B, Adeola Odeku Street', '6.430356', '3.415596', '08093383333', 'gbubemi@sliquorsng.com', '9412', 'images/1512037498.jpeg', '2017-11-30 09:28:24', '2018-02-09 15:27:38', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(100, 'TAS0100', 'Hotels And Resorts', 'The Avenue Suites', '0', '1390 Tiamiyu Savage Street', '6.423697', '3.42644', '08143172521', 'reservation@theavenuesuites.com', '9612', 'images/1512461298.jpeg', '2017-12-05 07:17:41', '2018-02-09 15:29:18', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(345, 'SKI0345', 'Beauty, Health and Wellbeing', 'Skin Glamour', '0', 'Suite 2, Jesan House Km, 29/30, Lekki/ Epe Express Way by Leawood Hotel', '6.437062', '3.509546', '07038876281', 'skinglamour14@gmail.com', '7735', 'images/1524049624.jpeg', '2018-04-16 11:41:49', '2018-04-18 10:39:33', 'Nigeria', 'Lagos', 'Sangotedo', NULL, NULL, NULL, NULL),
(102, 'SAM0102', 'Restaurants', 'Samantha\'s Bistro & Grill', '0', '2, Olawale Daodu Road', '6.448923', '3.3430779', '08171116842', 'info@samanthasbistro.com', '0829', 'images/1512466280.jpeg', '2017-12-05 08:40:24', '2018-02-09 15:36:50', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(242, 'YBC0242', 'Beauty, Health and Wellbeing', 'YB Cocoon Day Spa', '100', '30B, Fola Osibo Street', '6.442619', '3.469051', '08099991526', 'ybcocoonigltd@gmail.com', '7799', 'images/1517587639.jpeg', '2018-02-02 15:10:19', '2018-04-17 10:57:05', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(232, 'SAR0232', 'Beauty, Health and Wellbeing', 'Sari Signature - Wuse 2', '0', 'The Ruby Centre,No 762 Amino Kanu Crescent', '9.085814', '7.471894', '08027970777', 'sariajay@hotmail.com', '9360', 'images/1517587034.jpeg', '2018-01-05 11:07:33', '2018-02-09 18:13:55', 'Nigeria', 'Abuja', 'Wuse 2', NULL, NULL, NULL, NULL),
(216, 'CAS216', 'Restaurants', 'Casa Lydia Restaurant', '0', '19 Glover Road', '6.455311', '3.428828', '08172001143', 'info@casalydia.com', '1066', 'images/1518794021.jpeg', '2017-12-19 07:37:05', '2018-02-16 14:13:54', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(104, 'HOU0104', 'Beauty, Health and Wellbeing', 'House Of Phreedah', '0', '22, Adeniran Ogunsanya Street', '6.497648', '3.359041', '08037018772', 'ceo@houseofphreedah.com', '9768', 'images/1512470327.jpeg', '2017-12-05 09:39:31', '2018-02-16 13:51:59', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(105, 'CEL0105', 'Beauty, Health and Wellbeing', 'Celon Dental Clinic', '0', '2, Olayemi Street', '6.499063', '3.346539', '07041751816', 'info@celondentalclinic.com', '7094', 'images/1512472580.png', '2017-12-05 10:17:46', '2018-02-09 15:41:11', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(106, 'BLE0106', 'Hotels And Resorts', 'Bleu Ivy Hotel And Suites', '0', '64, Oduduwa Way, GRA', '6.570476', '3.351249', '08159909090', 'bbleuivylimited@yahoo.com', '8526', 'images/1512474161.jpeg', '2017-12-05 10:44:48', '2018-02-09 15:43:03', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(107, 'EKO0107', 'Hotels And Resorts', 'Eko Hotels And Suites', '0', '1415, Adetokunbo Ademola Street', '6.426553', '3.429966', '+23412772700', 'reservation@ekohotels.com', '2568', 'images/1512478839.jpeg', '2017-12-05 12:03:05', '2018-02-09 16:52:48', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(108, 'DAN0108', 'Travel', 'Dana Air', '0', '51, Allen Avenue', '6.601640', '3.35194', '012809992', 'contact@flydanaair.com', '4605', 'images/1512483903.png', '2017-12-05 13:28:34', '2018-02-09 16:52:16', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(109, 'AIR0109', 'Travel', 'Air Peace', '0', '25, Sobo Arobiodu Street, GRA', '6.575694', '3.352901', '08140409808', 'info@flyairpeace.com', '4176', 'images/1512484644.png', '2017-12-05 13:39:52', '2018-02-09 16:53:54', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(110, 'FIL0110', 'Arts,Entertainment And Recreation', 'Filmhouse - Lekki', '0', 'The Rock Drive', '6.439112', '3.471274', '09024997900', 'lekki@filmhouseng.com', '4102', 'images/1512485673.png', '2017-12-05 13:56:57', '2018-02-27 09:55:06', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(111, 'EKO0111', 'Hotels And Resorts', 'Eko Signature', '0', '1415, Adetokunbo Ademola Street', '6.426553', '3.429966', '01460610', 'reservation@ekohotels.com', '9735', 'images/1512486370.jpeg', '2017-12-05 14:08:50', '2018-02-14 09:59:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(273, 'FAR0273', 'Services', 'Farm Direct', '0', 'Lagos Country Club, GRA', '6.587685', '3.356171', '08145253810', 'ejebernco@gmail.com', '3505', 'images/1521798631.png', '2018-02-15 08:40:06', '2018-03-23 08:50:32', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(112, 'SKY0112', 'Bars And Nightlife', 'Sky Lounge', '0', '1415 Adetokunbo Ademola Street', '6.426553', '6.426553', '01460610', 'salesdepartment@ekohotels.com', '2427', 'images/1512487088.jpeg', '2017-12-05 14:19:44', '2018-03-09 14:34:27', 'Nigeria', 'Lagos', 'Victoria island', NULL, NULL, NULL, NULL),
(113, 'CRO0113', 'Restaurants', 'Crossroad Tex-Mex Restaurant @ Eko Hotel', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '012772700', 'salesdepartment@ekohotels.com', '1579', 'images/1512549484.jpeg', '2017-12-06 07:51:15', '2017-12-06 07:51:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(114, 'TGS0114', 'Restaurants', 'The Grill (Steak House)', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '01460610', 'salesdepartment@ekohotels.com', '9161', 'images/1512550703.jpeg', '2017-12-06 07:59:49', '2018-02-16 13:46:37', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(115, 'LAG0115', 'Restaurants', 'Lagoon Breeze', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '012772700', 'salesdepartment@ekohotels.com', '3629', 'images/1512551124.jpeg', '2017-12-06 08:05:53', '2017-12-06 08:05:53', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(116, 'KUR0116', 'Restaurants', 'Kuramo Sports Cafe', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '01460610', 'salesdepartment@ekohotels.com', '4374', 'images/1512551417.jpeg', '2017-12-06 08:10:58', '2017-12-06 08:10:58', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(117, 'CAL0117', 'Restaurants', 'Calabash Bar', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '012772700', 'salesdepartment@ekohotels.com', '9670', 'images/1512551644.jpeg', '2017-12-06 08:14:31', '2017-12-06 08:14:31', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(118, 'IT1415', 'Restaurants', '1415 Italian Restaurant', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3,429966', '012772700', 'restaurantreservation@ekohotel.com', '8400', 'images/1512551922.jpeg', '2017-12-06 08:19:16', '2018-01-23 14:47:42', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(119, 'RED0119', 'Restaurants', 'Red Chinese Restaurant And Lounge', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '012772700', 'restaurantreservation@ekohotels.com', '5096', 'images/1512552182.jpeg', '2017-12-06 08:23:32', '2018-01-24 06:48:53', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(120, 'EKO0120', 'Beauty, Health and Wellbeing', 'Eko Spa', '0', 'Plot 1415 Adetokunbo Ademola Street', '6.426553', '3.429966', '012772700', 'salesdepartment@ekohotels.com', '1381', 'images/1512552599.jpeg', '2017-12-06 08:30:48', '2018-01-24 13:35:38', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(121, 'FIL121', 'Arts,Entertainment And Recreation', 'Film House - Surulere', '0', 'Leisure Mall, Adeniran Ogunsanya Street', '6.490235', '3.357183', '09024973018', 'odezi@filmhouseng.com', '5418', 'images/1512568766.jpeg', '2017-12-06 13:04:24', '2018-02-16 13:48:01', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(122, 'SIL122', 'Arts,Entertainment And Recreation', 'Silverbird Cinemas - VI', '0', '133, Ahmadu Bello Way', '6.428669', '3.410931', '07012655677', 'info@silverbirdcinemas.com', '2544', 'images/1512569569.png', '2017-12-06 13:16:45', '2018-02-14 10:15:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(123, 'SIL123', 'Arts,Entertainment And Recreation', 'Silverbird Cinemas - Ikeja', '0', '9 Obafemi Awolowo Way,', '6.596239', '3.337166', '08028348929', 'info@silverbirdcinemas.com', '1628', 'images/1512570548.png', '2017-12-06 13:31:28', '2018-02-14 10:17:00', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(124, 'SIL124', 'Arts,Entertainment And Recreation', 'Silverbird Cinemas - Festac', '0', 'Festival Mall. Janet Faje Street', '6.465692', '3.304337', '08028348929', 'info@silverbirdcinemas.com', '1577', 'images/1512571142.png', '2017-12-06 13:48:49', '2018-02-14 10:17:57', 'Nigeria', 'Lagos', 'Festac', NULL, NULL, NULL, NULL),
(187, 'LA187', 'Restaurants', 'La Brioche', '0', '22b Musa Yar\'Adua Street', '6.432390', '3.416775', '012951299', 'info@labriocheng.com', '3239', 'images/1518795511.jpeg', '2017-12-12 09:45:59', '2018-02-16 14:38:35', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(126, 'RED126', 'Beauty, Health and Wellbeing', 'Reddington Hospital - Ikeja', '0', '39 Isaac John Street, Ikeja GRA', '6.583558', '3.357400', '09068777218', 'enquiries@reddingtonhospital.com', '0035', 'images/1512573793.png', '2017-12-06 14:24:53', '2018-02-14 10:14:06', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(127, 'COC127', 'Restaurants', 'Cocoon Restaurant', '0', '190 Awolowo Road', '6.444307', '3.423847', '09063799286', 'cocoonlagos@gmail.com', '7749', 'images/1512574369.jpeg', '2017-12-06 14:35:30', '2018-02-14 10:19:10', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(128, 'CLU57', 'Bars And Nightlife', 'Club 57', '0', '57 Awolowo Road', '6.444249', '3.423379', '09091001000', 'info@club57.com', '7188', 'images/1512575039.png', '2017-12-06 14:46:24', '2018-02-14 10:21:00', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(129, 'FLO129', 'Fashion', 'Florence-H Luxury Boutique', '0', '32 Musa Yaradua', '6.431730', '3.418877', '08091111283', 'sales@florencehboutique.com', '3480', 'images/1512634967.jpeg', '2017-12-07 07:27:03', '2017-12-07 07:27:03', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(130, 'TIN130', 'Household Essentials', 'Tino Electronics - Falomo', '0', '136 Awolowo Road', '6.974421', '3.419417', '08039215321', 'tinoelectronicsltd@yahoo.ca', '0501', 'images/1519814290.jpeg', '2017-12-07 07:51:46', '2018-02-28 09:38:14', 'Nigeria', 'Lagos', 'Falomo', NULL, NULL, NULL, NULL),
(131, 'TIN131', 'Household Essentials', 'Tino Electronics - Lekki', '0', 'Lekki Estate Phase 1, Ibeju Lekki 3rd Round About', '6.437239', '3.481569', '08039215321', 'tinoelectronicsltd@yahoo.ca', '2882', 'images/1519814260.jpeg', '2017-12-07 08:10:34', '2018-02-28 09:37:43', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(132, 'YUD132', 'Household Essentials', 'Yudala - Gbagada', '0', '1A Redemption Circles', '6.552685', '3.379746', '08129851298', 'yudala.gbagada@yudala.com', '7512', 'images/1512638696.jpeg', '2017-12-07 08:28:39', '2018-02-28 09:33:32', 'Nigeria', 'Lagos', 'Gbagada', NULL, NULL, NULL, NULL),
(133, 'YUD133', 'Household Essentials', 'Yudala - Ikeja', '0', '10 Medical Road', '6.593922', '3.338460', '08090236180', 'yudala.ikeja@yudala.com', '6686', 'images/1512639075.jpeg', '2017-12-07 08:40:48', '2018-02-28 09:32:42', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(134, 'YUD134', 'Household Essentials', 'Yudala - VI', '0', '27b Idowu Martins Street', '6.432772', '3.419898', '08129851266', 'yudala.vi@yudala.com', '1439', 'images/1512639854.jpeg', '2017-12-07 08:53:04', '2018-02-28 09:32:24', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(135, 'YUD135', 'Household Essentials', 'Yudala - Lekki', '0', '1st Floor, The Palms Shopping Mall', '6.435838', '3.451459', '08090236185', 'yudala.lekki@yudala.com', '1388', 'images/1512640606.jpeg', '2017-12-07 09:01:59', '2018-02-28 09:31:56', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(136, 'SAK136', 'Restaurants', 'Sakura Restaurant', '0', '2A Saka Ojo Street. | Off Idejo Street', '6.427509', '3.412201', '09090409363', 'booking@sakuracuisine.co.nz', '9523', 'images/1512642259.jpeg', '2017-12-07 09:21:24', '2018-02-14 09:54:48', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(137, 'STR137', 'Hotels And Resorts', 'Strathaven', '0', '1 Mayaki Usman Street', '6.444327', '3.457034', '08179502541', 'reservations@strathevenhotels.com', '0711', 'images/1512643420.jpeg', '2017-12-07 09:47:28', '2018-02-27 09:56:59', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(138, 'TLC138', 'Arts,Entertainment And Recreation', 'The Landmark Center', '0', 'Plot 2&3, Water Corporation Road, Victoria Island Annex, Eti-Osa', '6.423043', '3.445086', '07007777777', 'info@LandmarkLagos.com', '2696', 'images/1512645560.jpeg', '2017-12-07 10:21:18', '2018-02-14 09:58:03', 'Nigeria', 'Lagos', 'Oniru', NULL, NULL, NULL, NULL),
(139, 'HAR139', 'Bars And Nightlife', 'Hardrock Cafe', '0', 'Plot No 3 & 4, Block XVI, Oniru Estate, Near Landmark Centre', '6.422996', '3.444322', '09081988888', 'hardrockcafe@yahoo.com', '4414', 'images/1512647238.jpeg', '2017-12-07 10:51:15', '2018-02-14 09:16:50', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(140, 'LO1089', 'Bars And Nightlife', '1089 Lounge And Club', '0', '1089 Adeola Odeku Street', '6.429659', '3.418348', '08179417917', 'Lagos', '6765', 'images/1512648994.jpeg', '2017-12-07 11:23:42', '2018-02-14 09:21:06', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(141, 'CAS141', 'Restaurants', 'Casper & Gambini\'s - VI', '0', '3 Agoro Odiyan Street', '6.429723', '3.418609', '07002277377', 'n.bejjany@casperandgambinis.com', '3600', 'images/1512650440.jpeg', '2017-12-07 11:44:01', '2018-02-14 09:22:44', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(142, 'CAS142', 'Restaurants', 'Casper & Gambini\'s - Ikeja', '0', 'Ikeja City Mall, Obafemi Awolowo Way, Alausa', '6.614208', '3.358078', '08170011228', 'bejjany@casperandgambinis.com', '9208', 'images/1512651123.jpeg', '2017-12-07 11:55:03', '2018-02-14 09:29:22', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(143, 'MAS143', 'Restaurants', 'Mashawis Lebanese Grill', '0', '19b Idejo Street,Off Adeola Odeku Street', '6.429996,', '3.411201', '08025452276', 'info@mashawisgrill.com', '1890', 'images/1512651963.jpeg', '2017-12-07 12:09:18', '2018-02-14 09:31:43', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(144, 'TER144', 'Arts,Entertainment And Recreation', 'Terra Kulture', '0', '1376 Tiamiyu Savage Street,', '6.425051', '3.426865', '012700588', 'info@terrakulture.com', '8901', 'images/1512652674.jpeg', '2017-12-07 12:21:55', '2018-02-14 09:36:14', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(145, 'VEL145', 'Bars And Nightlife', 'Vellvett Lounge', '0', '19B Idejo Street', '6.426492', '3.414091', '07066333333', 'reservation@vellvett.com.ng', '5538', 'images/1517913544.jpeg', '2017-12-07 13:01:03', '2018-02-23 09:48:57', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(146, 'RES355', 'Restaurants', '355 Restaurant', '0', '9A Oko Awo Street', '6.428461', '3.427850', '08094656494', 'info@355restaurant.com', '1278', 'images/1512655731.jpeg', '2017-12-07 13:18:43', '2018-02-14 09:39:03', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(147, 'WES147', 'Hotels And Resorts', 'Westwood Hotel', '0', '22 Awolowo Road', '6.443280', '3.408801', '09032821732', 'reservations@westwoodikoyi.com', '3779', 'images/1518793348.jpeg', '2017-12-07 13:36:08', '2018-02-16 14:02:32', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(148, 'SCR148', 'Beauty, Health and Wellbeing', 'Scratch And Social', '0', '26b Adetokunbo Ademola Street', '6.435403', '3.430361', '08098510066', 'info@srcatchandsocial.com', '4346', 'images/1512662475.jpeg', '2017-12-07 15:03:37', '2018-02-14 07:46:44', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(149, 'IAM149', 'Fashion', 'IamIsigo', '0', '16 Karimu Kotun Street, Eti-Osa', '6.430838', '6.430838', '07080136261', 'us@iamisigoonline.com', '5057', 'images/1512721039.jpeg', '2017-12-08 07:21:43', '2018-02-14 07:47:59', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(150, 'NOU150', 'Fashion', 'Nouva Couture', '0', 'Fashion House, 2 Babafemi Osoba Street', NULL, NULL, '08177921990', 'NouvacoutureLagos@gmail.com', '1325', 'images/1518793556.jpeg', '2017-12-08 07:43:19', '2018-02-27 10:09:35', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(151, 'BICS151', 'Arts,Entertainment And Recreation', 'Bics Gardens And Boats', '0', 'B20, Wole Olateju Crescent', '6.448389', '3.45388', '08052310518', 'bicsgarden@gmail.com', '9852', 'images/1519127755.bin', '2017-12-08 08:08:15', '2018-02-27 10:11:16', 'Nigeria', 'Lagos', 'Lekki  Phase 1', NULL, NULL, NULL, NULL),
(152, 'WIN152', 'Restaurants', 'Wingsville', '0', '20 Admiralty Way', '6.445155', '3.457592', '08159727488', 'wingsvilleng@gmail.com', '3098', 'images/1512726386.jpeg', '2017-12-08 08:47:31', '2018-02-14 07:51:31', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(153, 'GRA153', 'Services', 'The Grand Cobbler - Lekki', '0', 'Posh Plaza, 31, Admiralty Way', '6.448032', '3.476907', '08092345000', 'info@grandcobbler.com', '2922', 'images/1512727659.jpeg', '2017-12-08 09:08:41', '2018-02-14 07:54:43', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(154, 'GRA154', 'Services', 'The Grand Cobbler - Chevron', '0', 'Chevy View Estate Main Gate Chevron Drive', '6.444838', '3.528784', '08170335544', 'info@grandcobbler.com', '7072', 'images/1512728906.jpeg', '2017-12-08 09:27:31', '2018-02-02 12:46:51', 'Nigeria', 'Lagos', 'Chevron', NULL, NULL, NULL, NULL),
(155, 'ILB155', 'Household Essentials', 'IL Bagno', '0', '1A Goshen Estate Rd  Lekki-Epe Expressway P.O. Box 75660', '6.430955', '3.474810', '08062981979', 'michael@ilbagnonigeria.com', '1825', 'images/1512729506.jpeg', '2017-12-08 09:40:47', '2018-02-28 09:29:46', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(156, 'ACC156', 'Arts,Entertainment And Recreation', 'Access Card Ng', '0', '49, Olowu Street', '6.594234', '3.344366', '08128452645', 'info@accesscardsng.com', '4534', 'images/1512730369.jpeg', '2017-12-08 09:55:18', '2018-02-14 07:57:29', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(157, 'SSH157', 'Fashion', 'Sshhh Lingerie Boutique', '0', '12E Admiralty Way', '6.447916', '3.476769', '08098977444', 'info@sshhhboutique.com', '0251', 'images/1512733476.jpeg', '2017-12-08 10:45:35', '2018-02-27 10:12:54', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(158, 'BUN158', 'Fashion', 'Bunnie Bees Fabrics', '0', '24 Admiralty Road', '6.452285', '3.470228', '08138160201', 'bunniebeefabrics@gmail.com', '7439', 'images/1512734624.jpeg', '2017-12-08 11:04:55', '2018-02-27 10:14:50', 'Nigeria', 'Lagos', 'Lekki  Phase 1', NULL, NULL, NULL, NULL),
(159, 'BEL159', 'Beauty, Health and Wellbeing', 'Bel Fiore Medical', '0', '12, 75 Utomi Aire Avenue', '6.442992', '3.476666', '07031951642', 'info@belfioreng.com', '2444', 'images/1519736156.jpeg', '2017-12-08 11:24:01', '2018-02-27 11:55:58', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(160, 'SEV160', 'Restaurants', 'Seven Eagles Spur - Ikeja Mall', '0', 'Actis Ikeja Mall, Obafemi Awolowo Way, Oregun', '6.614029', '3.358093', '012917158', 'Accountdeptatspur@yahoo.com', '3909', 'images/1519117359.jpeg', '2017-12-08 11:43:22', '2018-02-20 08:12:13', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(161, 'GOL161', 'Restaurants', 'Golden Eagle Spur - Ikeja', '0', '53 Isaac John Street', '6.584430', '3.357573', '014531270', 'customer-care@spurcorp.nl', '6170', 'images/1519118023.jpeg', '2017-12-08 11:51:14', '2018-02-20 08:13:52', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(162, 'CAF162', 'Restaurants', 'Cafe Neo - Yaba', '0', 'E-Centre, 1-11 Commercial Avenue, Sabo', '6.506222', '3.374204', '09060054011', 'Iinfo@mycafeneo.com', '7553', 'images/1512738055.jpeg', '2017-12-08 12:02:34', '2018-02-14 07:42:05', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(163, 'CAF163', 'Restaurants', 'Cafe Neo - VI', '0', 'Fourteen36 Mall, 1436 Sanusi Fafunwa Street', '6.431339', '3.426404', '09085094726', 'info@mycafeneo.com', '9692', 'images/1512738507.jpeg', '2017-12-08 12:10:15', '2018-02-14 07:43:02', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(164, 'CAF164', 'Restaurants', 'Cafe Neo - VII', '0', '6 Agoro Odiyan Street', '6.428162', '3.418953', '09085094722', 'info@mycafeneo.com', '3214', 'images/1512738968.jpeg', '2017-12-08 12:17:46', '2018-02-14 07:44:06', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(165, 'CAF165', 'Restaurants', 'Cafe Neo - Lekki', '0', '12e Admiralty Way', '6.447072', '3.461919', '09060056655', 'info@mycafeneo.com', '3060', 'images/1512739605.jpeg', '2017-12-08 12:34:04', '2018-02-27 10:23:02', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(166, 'RSV166', 'Restaurants', 'RSVP Lounge', '0', 'Eletu Ogabi Street', '6.428382', '3.421455', '08186166666', 'info@rsvprestaurant.com', '9829', 'images/1512980924.jpeg', '2017-12-11 07:32:45', '2018-02-09 15:08:59', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(167, 'BAC167', 'Restaurants', 'Backyard Grill', '0', '4b Musa Yar\' Adua Street', '6.434296', '3.416269', '09077002000', 'info@crustandcream.com', '1146', 'images/1519118397.jpeg', '2017-12-11 07:46:08', '2018-02-20 08:19:59', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(168, 'SPI168', 'Restaurants', 'Spice Route', '0', '36 Adeola Odeku Street', '6.429407', '3.419811', '08080208080', 'info@spiceroute.com', '4848', 'images/1512989003.jpeg', '2017-12-11 09:45:54', '2018-02-09 18:43:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(169, 'INF169', 'Services', 'Infinity Tyres - VI', '0', '43 Adeola Odeku Street', '6.430515', '3.418239', '08055092036', 'customercare@infinitytyres.com', '9726', 'images/1512993150.jpeg', '2017-12-11 10:57:34', '2018-02-14 07:26:18', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(170, 'INF170', 'Services', 'Infinity Tyres - Apapa', '0', '15, Commercial Road', '6.438381', '3.372568', '08055092014', 'customercare@infinitytyres.com', '2906', 'images/1512993996.jpeg', '2017-12-11 11:11:57', '2018-02-14 07:27:25', 'Nigeria', 'Lagos', 'Apapa', NULL, NULL, NULL, NULL),
(171, 'INF171', 'Services', 'Infinity Tyres - Ikeja', '0', '95, Adeniyi Jones Avenue', '6.616316', '3.345918', '08055092019', 'customercare@infinitytyres.com', '2737', 'images/1512994912.jpeg', '2017-12-11 11:36:25', '2018-02-14 07:28:24', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(172, 'TGH172', 'Hotels And Resorts', 'The George Hotel', '0', '30 Lugard Avenue', '6.454757', '3.436634', '014663660', 'reservations@thegeorgelagos.com', '2466', 'images/1512997128.jpeg', '2017-12-11 12:09:36', '2018-02-14 07:29:40', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(176, 'TWL176', 'Hotels And Resorts', 'The Wheatbaker Lagos', '0', '4 Lawrence Road', '6.453476', '3.445851', '012773560', 'wheatbaker@legacyhotels.com', '2293', 'images/1517915918.jpeg', '2017-12-11 13:14:12', '2018-02-14 07:31:54', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(174, 'SOU174', 'Hotels And Resorts', 'Southern Sun Ikoyi', '0', '47 Alfred Rewande Road, Eti Osa, Government Area', '6.454257', '3.430196', '012800630', 'ssikoyi.Reservations@tsogosun.com', '2936', 'images/1513000889.jpeg', '2017-12-11 13:03:47', '2018-02-14 07:30:44', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(178, 'RAD178', 'Hotels And Resorts', 'Radisson Blu Anchorage Hotel', '0', '1A, Ozumba Mbadiwe Avenue', '6.436930', '3.420073', '07080610000', 'info.lagos@radissonblu.com', '6910', 'images/1519997384.jpeg', '2017-12-11 13:36:00', '2018-03-02 12:29:47', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(177, 'FED177', 'Hotels And Resorts', 'Federal Palace Hotel', '0', '6-8 Ahmadu Bello Way', '6.430635', '3.407290', '012779000', 'crobook@suninternational.com', '2686', 'images/1513001727.jpeg', '2017-12-11 13:18:15', '2018-02-14 07:33:53', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(179, 'INT179', 'Hotels And Resorts', 'InterContinental Hotels & Resorts', '0', 'Plot 52, Kofo Abayomi Street', '6.434829,', '3.423015', '012366666', 'enquires@intercontinenta.com', '0349', 'images/1513003511.jpeg', '2017-12-11 13:47:17', '2018-02-14 07:36:39', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(180, 'BAR180', 'Beauty, Health and Wellbeing', 'Barazahi Spa & Fitness Center', '0', '16, Fola Osibo Street', '6.442317', '3.467054', '08137895911', 'info@barazahi.com', '5587', 'images/1518796004.jpeg', '2017-12-11 14:14:40', '2018-02-27 10:25:26', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(181, 'TIR181', 'Beauty, Health and Wellbeing', 'Tirta Ayu Spa - Lagos', '0', '33a Wole Ariyo Street, off Admiralty Way', '6.441805', '3.458785', '08023026626', 'cs@tirtaayuspa.com.ng', '4450', 'images/1518794714.jpeg', '2017-12-11 14:31:28', '2018-02-27 10:26:25', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(182, 'CLE182', 'Beauty, Health and Wellbeing', 'Clear Essence Spa', '0', '13 Alexander Avenue', '6.450387', '3.448753', '08085867565', 'reservations@clearessencecalifoniaspa.com', '1821', 'images/1518794975.jpeg', '2017-12-11 14:43:06', '2018-02-16 14:29:38', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(183, 'MAI183', 'Hotels And Resorts', 'Maison Fahrenheit Hotel', '0', '80 Adetokunbo Ademola Street', '6.426022', '3.428521', '019054800', 'info@maisonfahrenheit.com', '9005', 'images/1518795216.jpeg', '2017-12-11 15:05:48', '2018-02-16 14:33:37', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(184, 'SVE184', 'Household Essentials', 'Svengali Designs Ltd', '0', '9, Agoro Odiyan Street', '6.428311', '3.41833', '016213302', 'info@svengalidesigns.com', '3103', 'images/1513074502.jpeg', '2017-12-12 08:21:07', '2018-02-28 09:31:35', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(185, 'LAF185', 'Restaurants', 'L\'afric Restaurant & Bar', '0', '1 Adeola Hopewell Street', '6.431361', '3.429048', '08130053886', 'l\'africrestaurant@yahoo.com', '0705', 'images/1513071471.jpeg', '2017-12-12 08:41:49', '2018-02-09 18:39:00', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(186, 'MOR186', 'Hotels And Resorts', 'Morningside Suites', '0', '11B Taslim Elias Close, Off Ahmadu Bello Way', '6.4273884', '3.410659', '012772046', 'info2@morningsidesuites.com', '6939', 'images/1518795771.jpeg', '2017-12-12 08:48:26', '2018-02-16 14:43:54', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL);
INSERT INTO `merchants` (`id`, `merchant_id`, `category_id`, `name`, `rating`, `address`, `latitude`, `longitude`, `contact`, `email`, `verification_pin`, `avatar`, `created_at`, `updated_at`, `country`, `state`, `city`, `website`, `details`, `bio`, `ntk`) VALUES
(188, 'JBR188', 'Beauty, Health and Wellbeing', 'Jbronze Hair', '100', '69B, Admiralty Way', '6.447833', '3.470105', '08133718888', 'jbronzeboutique@yahoo.com', '3077', 'images/1518796235.jpeg', '2017-12-12 10:15:43', '2018-03-27 12:25:41', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(189, 'SAR189', 'Beauty, Health and Wellbeing', 'Sari Signature - Victoria island', '0', '24 Idejo Street, Opposite Lagoon Hospital', '6.426099', '3.412770', '08066660002', 'sariajaj@hotmail.com', '5379', 'images/1517587170.jpeg', '2017-12-12 10:42:40', '2018-02-09 18:41:39', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(190, 'MON190', 'Beauty, Health and Wellbeing', 'Montaigne Place Spa', '0', '226B Muri Okunola Street', '6.432704', '3.438708', '012705596', 'info@montaigneplace.com', '2621', 'images/1513078351.jpeg', '2017-12-12 10:44:36', '2018-02-09 18:30:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(192, 'GEN192', 'Arts,Entertainment And Recreation', 'Genesis Cinemas - Maryland Mall', '0', 'Maryland Mall, Ikorodu Road, Anthony', '6.567429', '3.367267', '09098634784', 'info@genesiscinemas.com', '9415', 'images/1518794495.png', '2017-12-13 07:36:24', '2018-02-16 14:21:46', 'Nigeria', 'Lagos', 'Maryland', NULL, NULL, NULL, NULL),
(193, 'GEN193', 'Arts,Entertainment And Recreation', 'Genesis Cinemas - The Palms', '0', 'The Palms Shopping Mall, Maroko', '6.435676', '3.450919', '08095738937', 'info@genesiscinemas.com', '2456', 'images/1518794454.png', '2017-12-13 07:43:41', '2018-02-16 14:20:58', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(194, 'GEN194', 'Arts,Entertainment And Recreation', 'Genesis Cinemas - Novare Mall', '0', 'Novare Mall, Lekki - Epe Express way, Eti-Osa', '6.468181', '3.639138', '0806 056 6111', 'info@genesiscinema.com', '5634', 'images/1513155274.jpeg', '2017-12-13 07:56:30', '2017-12-18 15:52:56', 'Nigeria', 'Lagos', 'Ajah', NULL, NULL, NULL, NULL),
(195, 'JUS195', 'Fashion', 'Justgerry Boutique', '0', 'Plot 64/3B Emmanuel Abimbola Cole Street', '6.442588', '3.473540', '08077787751', 'justgerrystylen@gmail.com', '1834', 'images/1518796797.jpeg', '2017-12-14 08:52:23', '2018-02-27 10:29:18', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(196, 'LOH196', 'Household Essentials', 'Lohn Lagos', '0', '18 Cooper Road', '6.445620', '3.450013', '08128530294', 'sales@lohnlagos.com', '5723', 'images/1513245657.jpeg', '2017-12-14 09:02:49', '2018-02-28 09:28:56', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(197, 'WEA197', 'Fashion', 'Wear It All Men’s Luxury', '100', '38B Fola Osibo Street', '6.442326', '3.469965', '08077259999', 'info@wearitallng.com', '8821', 'images/1519043203.jpeg', '2017-12-14 12:28:29', '2018-03-27 13:26:09', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(198, 'IDE198', 'Services', 'Ideas.ng', '100', '7th floor,plot 1684, C&C tower, Sanusi Fafunwa street', '6.450394', '3.476607', '08111313133', 'khaldova.h53@gmail.com', '1453', 'images/1521195046.png', '2017-12-14 14:33:21', '2018-03-28 13:23:33', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(199, 'ZAR199', 'Fashion', 'Zara And Zoe Investment Limited', '0', 'Park Mall, 33 Admiralty Way', '6.448097', '3.477404', '08032848550', 'zandzlimited@yahoo.com', '3021', 'images/1519115357.jpeg', '2017-12-14 15:01:01', '2018-02-27 10:32:15', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(200, 'KD0200', 'Beauty, Health and Wellbeing', 'K-Dove Unisex Salon', '0', '166A Bisi Obadina Street', '6.637909', '3.365468', '08023683722', 'kdoveinter@yahoo.com', '0862', 'images/1513268728.png', '2017-12-14 15:33:19', '2018-02-19 11:45:16', 'Nigeria', 'Lagos', 'Omole Phase 1', NULL, NULL, NULL, NULL),
(201, 'TRO201', 'Fashion', 'Troy Shoe Factory', '0', 'Block 80 Flat 1, Ijaiye Housing Estate, Pen-Cinema', '6.629845', '3.326089', '08161164861', 'olateju.olalekan@gmail.com', '1418', 'images/1513330386.png', '2017-12-15 08:35:57', '2017-12-18 15:51:14', 'Nigeria', 'Lagos', 'Agege', NULL, NULL, NULL, NULL),
(202, 'NEX202', 'Beauty, Health and Wellbeing', 'Next Barbing and Salon - Lekki', '100', '38B Fola Osibo Street', '6.442336', '3.470009', '07055773661', 'info@nextsalon.com', '5139', 'images/1513331871.png', '2017-12-15 09:03:14', '2018-03-27 12:44:55', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(214, 'BAR214', 'Beauty, Health and Wellbeing', 'Bare To Beauty', '0', 'Del\'s Place, 18A Emma Abimbola Cole Street', '6.442928', '3.474362', '09058322606', 'bare2beauty@gmail.com', '8829', 'images/1513591598.png', '2017-12-18 09:10:35', '2018-02-27 10:46:39', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(203, 'NEX203', 'Beauty, Health and Wellbeing', 'Next Barbing and Salon - Anthony', '0', '32 Olorunlogbon Street', '6.561176', '3.370224', '08033294940', 'info@nextsalon.com', '8248', 'images/1513333232.png', '2017-12-15 09:21:35', '2018-01-24 14:32:10', 'Nigeria', 'Lagos', 'Anthony Village', NULL, NULL, NULL, NULL),
(204, 'NEX204', 'Beauty, Health and Wellbeing', 'Next Barbing and Salon - Ojuelegba', '0', '54 Cleggs street', '6.508842', '3.364651', '08021104003', 'info@nextsalon.com', '8959', 'images/1513333470.png', '2017-12-15 09:25:54', '2018-01-24 14:31:53', 'Nigeria', 'Lagos', 'Ojuelegba', NULL, NULL, NULL, NULL),
(205, 'FOO205', 'Restaurants', 'Food Arena', '0', '102 Adewunmi Adebimpe Street', '6.435539', '3.468861', '08187952258', 'foodarenang@gmail.com', '1113', 'images/1519043993.jpeg', '2017-12-15 09:42:37', '2018-02-27 10:44:26', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(217, 'SMO217', 'Restaurants', 'Smokey Bones Restaurant', '0', '8B Fabac Close, Off Ligali Ayorinde (Behind Mobil House)', '6.434236', '3.438838', '08026095962', 'info@smokeybones.com.ng', '4033', 'images/1517934273.jpeg', '2017-12-19 07:54:21', '2018-02-06 15:24:49', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(219, 'CAF219', 'Restaurants', 'Cafe Vergnano', '0', 'The Palms Mall', '6.435838', '3.451459', '07037374747', 'baronslimited@yahoo.com', '0824', 'images/1517587537.jpeg', '2017-12-19 08:36:04', '2018-02-09 18:22:02', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(220, 'RES044', 'Restaurants', '44 Restaurant', '0', '2A Saka Jojo, off Idejo Street', '6.427533', '3.412366', '09090409363', 'baronslimited@yahoo.com', '6703', 'images/1518794277.jpeg', '2017-12-19 08:45:10', '2018-02-16 14:18:00', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(221, 'MAS221', 'Beauty, Health and Wellbeing', 'Mastercutz-E Unisex Salon', '100', '13 Akin Liegh Crescent, Road 10', '6.445858', '3.455689', '08023325958', 'sherrybabe03@gmail.com', '4763', 'images/1513681195.png', '2017-12-19 10:01:48', '2018-03-28 11:23:46', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(222, 'GAT222', 'Beauty, Health and Wellbeing', 'Gategold Nigeria Limited - Surulere', '0', '94 Ogunlana Drive', '6.505799', '3.352317', '08033293090', 'gategoldfitness@yahoo.com', '4296', 'images/1513683885.jpeg', '2017-12-19 10:48:03', '2018-02-09 18:23:36', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(223, 'GAT223', 'Beauty, Health and Wellbeing', 'Gategold Nigeria Limited - Jabi District', '0', 'Rukayyat Plaza, Suite A1,Plot 93,Obafemi Awolowo Way,Jabi', '9.066056', '7.433832', '08148413444', 'gategolfitnessabjsup@yahoo.com', '4107', 'images/1513685292.jpeg', '2017-12-19 11:14:29', '2018-02-09 18:24:27', 'Nigeria', 'Abuja', 'Jabi District', NULL, NULL, NULL, NULL),
(224, 'GAT224', 'Beauty, Health and Wellbeing', 'Gategold Nigeria Limited - Wuse 2', '0', 'Shop GC 7, Old Banex Plaza', '9.083881', '7.468915', '08137754884', 'gategoldfitnessabuja@yahoo.com', '1496', 'images/1513685838.jpeg', '2017-12-19 11:19:50', '2018-02-09 18:25:10', 'Nigeria', 'Abuja', 'Wuse 2', NULL, NULL, NULL, NULL),
(225, 'GAT225', 'Beauty, Health and Wellbeing', 'Gategold Nigeria Limited - Onitsha', '0', '107 Upper New Market Road', '6.151764', '6.783487', '08036319882', 'gategoldfitnessonitsha@yahoo.com', '4121', 'images/1513686307.jpeg', '2017-12-19 11:27:58', '2018-02-09 18:12:36', 'Nigeria', 'Anambra', 'Onitsha', NULL, NULL, NULL, NULL),
(233, 'MAN0233', 'Restaurants', 'Mango Room Restaurant', '0', 'Suite 12 Aaron\'s Mall,Off Admiralty Way', '6.445768', '3.471422', '08031930744', 'JOSEPHAKU@GMAIL.COM', '0615', 'images/1517586494.png', '2018-01-08 08:18:42', '2018-02-09 18:14:40', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(234, 'ADE0234', 'Fashion', 'Adetorch Clothing', '0', 'Plot 5 Block 100,Ladipo Omotesho Cole Street', '6.433567', '3.465233', '08026492477', 'info@adetorch.com', '8192', 'images/1517586116.jpeg', '2018-01-08 08:29:48', '2018-04-24 14:04:27', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(236, 'ADU0236', 'Beauty, Health and Wellbeing', 'Adunni Organics', '0', '4 Makinde Street, Alausa', '6.609085', '3.35625', '08171075466', 'info@adunniorganics.com', '3971', 'images/1519045474.jpeg', '2018-01-17 11:33:09', '2018-02-20 12:20:53', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(237, 'QUO0237', 'Hotels And Resorts', 'Quo Abuja', '0', '4 Tarkwa Crescent Off Monrovia Street', '9.079228', '7.500465', '08131096966', 'info@quoabuja.com', '6470', 'images/1522076460.png', '2018-01-17 11:46:45', '2018-03-26 14:01:10', 'Nigeria', 'Abuja', 'Wuse 2', NULL, NULL, NULL, NULL),
(238, 'GRI0238', 'Restaurants', 'Grill Lounge And Restaurant', '0', '57 Awolowo', '6.442079', '3.417241', '09090009000', 'krysefe@gmail.com', '2273', 'images/1516612246.png', '2018-01-22 08:14:14', '2018-02-09 18:18:17', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(239, 'JAS0239', 'Fashion', 'Jason Porshe Bespoke', '0', '69 Admiralty Brasses Mall', '6.447512', '3.471814', '08020639403', 'jason_porshe@yahoo.com', '8586', 'images/1517934723.jpeg', '2018-01-22 08:27:48', '2018-02-09 18:19:04', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(241, 'LEK0241', 'Hotels And Resorts', 'Lekki Suites', '70', '1, Kayode Otitoju Street, Off Admiralty Road', '6.450221', '3.472736', '08034728090', 'ola_olusegun@yahoo.com', '5175', 'images/1517934641.jpeg', '2018-02-02 14:35:03', '2018-04-18 07:26:00', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(243, 'MAR0243', 'Restaurants', 'Maroccaine Restaurant And Bar', '60', '317b Akin Ogunlewe Street,Off Ligali Ayorinde', '6.426005', '3.440333', '09022220220', 'maroccainerestaurant01@gmail.com', '5327', 'images/1523963833.png', '2018-02-05 12:20:58', '2018-04-17 10:17:30', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(244, 'DOU0244', 'Hotels And Resorts', 'Double A Suite & Hideout Lounge', '80', '3, Gabby Adeosun Street (Opposite FarmCity, behind the white house)', '6.441816', '3.455103', '09052756245', 'hello@doubleasuites.com', '7670', 'images/1517837998.jpeg', '2018-02-05 12:42:09', '2018-04-18 07:28:01', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(245, 'TAL0245', 'Bars And Nightlife', 'The Artisan Lounge & Bar', '0', '14, Anifowoshe Street, Off Adeola Odeku Street', '6.431675', '3.415153', '08024245773', 'ola@theartisanloungebar.com', '6575', 'images/1523965382.jpeg', '2018-02-05 12:54:39', '2018-04-17 10:43:11', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(246, 'IFC0246', 'Beauty, Health and Wellbeing', 'i-Fitness Center - Agungi', '100', 'Club House, Friends Colony Estate, off Agungi Road', '6.449394', '3.514536', '09082913442', 'info@ifitness.com.ng', '5888', 'images/1517840397.jpeg', '2018-02-05 13:33:37', '2018-04-04 12:21:19', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(247, 'JAM0247', 'Restaurants', 'Jamrock Caribbean Cuisine', '60', 'Sixty-9 Mall, 69B Admiralty Way, next to Coldstone', '6.447668', '3.473133', '08120000055', 'orders@jamrockng.com', '5017', 'images/1517841672.jpeg', '2018-02-05 13:42:49', '2018-04-13 12:02:26', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(248, 'GRA0248', 'Hotels And Resorts', 'Grand Emperor Hotel', '40', '129, Akinyemi Avenue', '6.430008', '3.470375', '08037244984', 'grandemperorhotel@hotmail.com', '7845', 'images/1517842456.jpeg', '2018-02-05 13:54:57', '2018-04-11 14:08:15', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(249, 'IRO0249', 'Beauty, Health and Wellbeing', 'Iron Bar Fitness Center', '60', '137 QMB Builder\'s Mart Road, off Elf Bus Stop, between 2nd & 3rd round about', '6.431086', '3.477454', '09091601455', 'info@ironbarfitness.com.ng', '5770', 'images/1519223512.jpeg', '2018-02-05 14:08:09', '2018-05-03 13:37:08', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(250, 'FLA0250', 'Fashion', 'Flash Factor Fashions', '100', '4 Idowu Martins Street', '6.430208', '3.419545', '08024400830', 'flashfactor12@gmail.com', '6237', 'images/1521804988.png', '2018-02-05 14:28:18', '2018-03-28 14:13:25', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(251, 'NAT0251', 'Restaurants', 'Natives Restaurant', '60', '5B, Oju Olobun Close', '6.428257', '3.415155', '08035781977', 'info@nativesrestaurant.org', '8018', 'images/1523958953.png', '2018-02-05 14:37:23', '2018-04-17 08:56:01', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(252, 'HOL0252', 'Retail', 'Holo Crunch (Gourmet Nibbles)', '0', '12B Oko Awo Street, off Adetokunbo Ademola Street', '6.428467', '3.429074', '09099999453', 'info@holocrunchng.com', '0824', 'images/1517845754.bin', '2018-02-05 14:52:53', '2018-02-21 13:44:07', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(253, 'MRC0253', 'Restaurants', 'Mr Chang Chinese Cuisine Ltd', '0', '126 Awolowo Road', '6.441990', '3.419127', '08080566666', 'lagoschang@gmail.com', '4037', 'images/1521802822.png', '2018-02-05 15:21:29', '2018-03-23 10:00:27', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(254, 'IFC0254', 'Beauty, Health and Wellbeing', 'i-Fitness Center - Lekki', '0', '10, Gabby Ade Street, Off Admiralty Way', '6.441306', '3.454777', '08170391844', 'info@ifitness.com.ng', '9739', 'images/1517848486.jpeg', '2018-02-05 15:35:40', '2018-02-27 09:32:03', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(272, 'DHP0272', 'Beauty, Health and Wellbeing', 'D Hub Pharmacy', '0', '21 Joel Ogunnaike Street,GRA', '6.586143', '3.354111', '08023104521', 'dhubpharmacy@yahoo.com', '3703', 'images/1518599800.jpeg', '2018-02-14 08:18:20', '2018-02-14 08:18:20', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(255, 'TRH0255', 'Beauty, Health and Wellbeing', 'Reddington Hospital', '0', '12 Idowu Martins Street, off Adeola Odeku Street', '6.432794', '3.420436', '012715340', 'info@reddingtonhospital.com', '2786', 'images/1517907965.jpeg', '2018-02-06 08:06:55', '2018-02-21 13:53:32', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(256, 'TRB0256', 'Beauty, Health and Wellbeing', 'Reddington Breast And Gynaecological Centre', '0', '276A Kofo Abayomi Street, near Intercontinental Hotel', '6.432238', '3.421871', '08021193912', 'info@breastandgynae.com', '2653', 'images/1519225449.jpeg', '2018-02-06 08:20:49', '2018-02-21 14:04:13', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(257, 'TGC0257', 'Beauty, Health and Wellbeing', 'The Grays Cardiology Centre - Victoria Island', '0', '12 Idowu Martins Street', '6.432794', '3.420436', '08091564777', 'info@grayscardiology.com', '6910', 'images/1517909357.jpeg', '2018-02-06 08:31:11', '2018-02-21 14:09:11', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(258, 'TGC0258', 'Beauty, Health and Wellbeing', 'The Grays Cardiology Centre - Ikeja', '0', '6 Oladipo Bateye Street, off Adekunle Fajuyi Street, GRA', '6.572943', '3.346655', '08091564888', 'info@grayscardiology.com', '8386', 'images/1517911223.jpeg', '2018-02-06 09:01:13', '2018-02-21 14:44:12', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(259, 'MAX0259', 'Beauty, Health and Wellbeing', 'Maxy Super Specialist Centre', '0', '14 Akin Olugbade Street', '6.431006', '3.421122', '09079035108', 'info@maxycentre.com', '5506', 'images/1517913343.jpeg', '2018-02-06 09:11:58', '2018-02-21 15:07:28', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(260, 'TRM0260', 'Beauty, Health and Wellbeing', 'The Reddington Medical Check-Up Centre', '0', '6th Floor,12 Idowu Martins Street', '6.432794', '3.420436', '09095555507', 'lifescan@reddingtonwellnesscentre.com', '2148', 'images/1517913245.jpeg', '2018-02-06 09:35:16', '2018-02-21 15:08:52', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(261, 'PHO0261', 'Services', 'Phoebe\'s Cakes', '0', '62A Opebi Road', '6.588599', '3.361965', '08026487151', 'suzan1210@yahoo.co.uk', '3209', 'images/1521802246.png', '2018-02-08 07:44:03', '2018-03-23 09:50:48', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(262, 'UNI0262', 'Beauty, Health and Wellbeing', 'Unique Nails Salon And Beauty Spa', '0', '62A Opebi Road', '6.588599', '3.361965', '08026487151', 'suzan1210@yahoo.com', '1688', 'images/1518161920.jpeg', '2018-02-08 07:56:48', '2018-02-09 17:55:24', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(263, 'BEN0263', 'Hotels And Resorts', 'Beni Apartments Hotel', '100', '37 Ahmed Onibudo Street', '6.437402', '3.428647', '08022014987', 'sales@beniapartments.com', '7949', 'images/1521800102.jpeg', '2018-02-08 08:05:42', '2018-03-23 09:15:04', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(264, 'ALB0264', 'Bars And Nightlife', 'Alba Lounge', '80', '1, Anifowoshe Street, Off Adeola Odeku Street', '6.434580', '3.415148', '09060008031', 'albaloungelive@gmail.com', '3995', 'images/1518081082.bin', '2018-02-08 08:12:13', '2018-03-23 07:21:04', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(265, 'BUN0265', 'Restaurants', 'Bungalow Restaurant - Victoria Island', '0', '1296 Akin Adesola Street', '6.429089', '3.424599', '09090551095', 'info@bungalowrestaurant.com', '4486', 'images/1519124335.jpeg', '2018-02-09 07:03:32', '2018-02-21 15:18:53', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(266, 'BUN0266', 'Restaurants', 'Bungalow Restaurant - Ikeja', '0', '9 Adekunle Fajuyi Way', '6.572822', '3.358870', '09080000257', 'omkaram@bungalowrestaurant.com', '8917', 'images/1519125494.jpeg', '2018-02-09 07:09:24', '2018-02-20 10:18:21', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(304, 'CPR0304', 'Services', 'CPR Cell Phone Repair - Lekki Phase 1', '0', 'Ground Floor, Brasas\'r Place, 69 Admiralty Way', '6.447833', '3.470105', '08170001538', 'info@cellphonerepair.com', '5753', 'images/1523549020.jpeg', '2018-02-23 13:17:37', '2018-04-12 15:04:01', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(268, 'LAV0268', 'Fashion', 'Laviva Bridals Concepts', '0', '30B Opebi Road', '6.592702', '3.358217', '08023276770', 'orders@lavivabridals.com', '2639', 'images/1518165350.png', '2018-02-09 07:36:49', '2018-02-09 17:50:37', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(269, 'HOT0269', 'Fashion', 'Hotstyles9ja', '0', '30B Opebi Road', '6.592702', '3.358217', '08057777528', 'bisolabayo@gmail.com', '3998', 'images/1518165763.jpeg', '2018-02-09 07:43:23', '2018-02-20 14:11:02', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(270, 'CAR0270', 'Services', 'Carrierbags.ng', '0', '11 Omotayo Ojo Street, off Allen Avenue', '6.598798', '3.351359', '08088388877', 'elvis.nwune@carrierbags.ng', '1549', 'images/1518166607.jpeg', '2018-02-09 07:55:37', '2018-02-20 13:31:54', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(271, 'JOH0271', 'Beauty, Health and Wellbeing', 'Johncollins Hair Studio', '0', '2 Amusa Oloyede Off Toyin Street', '6.597994', '3.353659', '08032323068', 'johncollinshairstudio888@gmail', '9663', 'images/1521799139.png', '2018-02-09 08:09:52', '2018-03-23 08:59:00', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(325, 'MOT0325', 'Fashion', 'Mother\'s Pride - Ogba 2', '0', 'Suite 34, Ogba Shopping Arcade', '6.631426', '3.340510', '08023060095', 'motherspride2002@yahoo.com', '6297', 'images/1521196505.png', '2018-02-27 10:06:14', '2018-03-16 09:35:07', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(274, 'ANG0274', 'Hotels And Resorts', 'Angel Hospitality Service Limited', '0', 'Plot 836 Adetokunbo Ademola Street,Opposite Sweet Sensation', '6.426396', '3.429300', '08113030330', 'bvpdasilva@gmail.com', '1778', 'images/1518688026.jpeg', '2018-02-15 08:48:04', '2018-02-15 08:48:04', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(275, 'AMA0275', 'Beauty, Health and Wellbeing', 'Amazonplus Pharmaceuticals', '0', '37 Joel Ogunnaike Street', '6.585008', '3.351970', '08023104521', 'amazonpluspharmacy@yahoo.com', '1926', 'images/1518688306.jpeg', '2018-02-15 08:53:32', '2018-02-15 08:53:32', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(276, 'PRI0276', 'Restaurants', 'Prime Chinese Restaurant', '0', 'Plot 860 Bishop Aboyade Cole Street', '6.434500', '3.431468', '08033065107', 'primechineserestaurants@gmail.com', '9731', 'images/1518688956.jpeg', '2018-02-15 09:05:10', '2018-03-07 11:42:17', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(277, 'CHE0277', 'Hotels And Resorts', 'Chesney Hotel', '0', '37 Saka Tinubu Street', '6.427570', '3.423588', '09096851900', 'reservation@chesneyhotels', '1465', 'images/1518689281.jpeg', '2018-02-15 09:09:47', '2018-02-15 09:09:47', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(278, 'SIO0278', 'Fashion', 'Siod Handcrafted Leather Limited', '0', '15B Oduduwa Way, GRA', '6.573421', '3.358610', '07033124884', 'info@siodleather.com', '1985', 'images/1518689589.jpeg', '2018-02-15 09:15:10', '2018-02-21 15:31:53', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(279, 'TLR0279', 'Restaurants', 'The Londoner Restaurant', '0', '24 Oduduwa Way,GRA', '6.573761', '3.356448', '08091122488', 'austinegeorge@gmail.com', '9551', 'images/1521795295.png', '2018-02-15 09:43:22', '2018-03-23 07:54:56', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(280, 'RUT0280', 'Fashion', 'Ruthie Bloom (Bloomkids)', '0', '60 Ijaiye Road,Ogba', '6.633053', '3.341512', '08180692640', 'sales@bloomkids.ng', '7666', 'images/1521733761.png', '2018-02-15 13:09:25', '2018-03-22 14:49:26', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(281, 'GHA0281', 'Beauty, Health and Wellbeing', 'Gharnet\'s Place', '0', 'Suite 27,Caroline Plaza 3rd Avenue,Gowon Estate', '6.603808', '3.283701', '09060774937', 'jfamilua@gmail.com', '7025', 'images/1518704117.png', '2018-02-15 13:17:57', '2018-03-29 10:21:10', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(282, 'RUB0282', 'Bars And Nightlife', 'Rubies Lounge', '0', '62 Akowonjo Road, Miccom B/Stop, Opposite Access Bank', '6.600532', '3.297017', '08133248800', 'downtex_dammy2000@yahoo.com', '2768', 'images/1518704553.png', '2018-02-15 13:24:24', '2018-02-23 07:48:58', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(283, 'CAL0283', 'Beauty, Health and Wellbeing', 'Callidora Studios', '0', '38 Odusami Street, behind Excellence Hotel', '6.633413', '3.345551', '08028629746', 'callidorastudios@gmail.com', '7832', 'images/1518705513.png', '2018-02-15 13:40:10', '2018-02-22 08:39:04', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(284, 'OGE0284', 'Beauty, Health and Wellbeing', 'Oge\'s Signature', '0', '119 Egbeda-Idimi Road, Orelope Bustop', '6.603512', '3.293541', '08060240324', 'ogepa77123@yahoo.com', '5766', 'images/1518706010.png', '2018-02-15 13:47:44', '2018-02-21 15:39:25', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(285, 'HAV0285', 'Hotels And Resorts', 'Havannah Hotel And Conference Center', '0', 'Centre 105-109 F Close, Gowon Estate', '6.604551', '3.281548', '08165112231', 'havannahsite@yahoo.com', '8690', 'images/1519301582.jpeg', '2018-02-15 13:56:13', '2018-02-23 07:40:21', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(286, 'CLE0286', 'Beauty, Health and Wellbeing', 'Clems Makeup And Spa', '0', '89, Akowonjo Road, Vulcanizer Bus Stop, Akowonjo', '6.600261', '3.300214', '08036403748', 'clemsmakeup@gmail.com', '3031', 'images/1518707039.png', '2018-02-15 14:05:33', '2018-02-21 15:51:49', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(287, 'FAC0287', 'Beauty, Health and Wellbeing', 'Facedeal House Of Beauty Nigeria Limited', '0', '33 Adeyemi Odukomaya Street,Off Association Avenue,Shangisha', '6.614147', '3.373207', '08091139201', 'facedealbeauty33@gmail.com', '6042', 'images/1521733005.png', '2018-02-15 14:17:27', '2018-03-22 14:36:47', 'Nigeria', 'Lagos', 'Magodo', NULL, NULL, NULL, NULL),
(288, 'NAO0288', 'Fashion', 'Naomi Collections Ventures', '100', 'Ground Floor, 46, Kayode Street, Ogba', '6.632852', '3.338849', '08033044817', 'princeifeanyidike@gmail.com', '3923', 'images/1521732339.jpeg', '2018-02-15 14:54:11', '2018-03-31 09:18:43', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(289, 'PUR0289', 'Fashion', 'Purple Wardrobe', '0', '29 Osolo Way, Opposite Skye Bank', '6.546889', '3.332718', '08132906885', 'purpletegatom06@yahoo.com', '6089', 'images/1518777120.png', '2018-02-16 09:32:51', '2018-04-13 08:57:12', 'Nigeria', 'Lagos', 'Ajao Estate', NULL, NULL, NULL, NULL),
(290, 'BLE0290', 'Household Essentials', 'Blessed Ify Stores', '0', '1 E Close, 31 Road By Car Wash, Gowon Estate', '6.601530', '3.28033', '09050907309', 'blessedifyoffice1@yahoo.com', '7249', 'images/1521729999.png', '2018-02-16 09:38:49', '2018-03-22 13:46:41', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(291, 'GOR0291', 'Beauty, Health and Wellbeing', 'Gorggies Makeovaz And Accessories', '0', '24 Ago Palace Way, Joico Plaza, Opposite Balogun Bus Stop', '6.510345', '3.313841', '08069541747', 'gorggiesmakeovazaccessories@gmail.com', '4111', 'images/1521728206.png', '2018-02-16 09:49:10', '2018-03-22 13:16:48', 'Nigeria', 'Lagos', 'Okota', NULL, NULL, NULL, NULL),
(292, 'VIL0292', 'Hotels And Resorts', 'Villa Sofia Courts', '0', 'Plot 406 Titilayo Adedoyin', '6.632109', '3.361577', '07030961419', 'reservation@villasofiacourts.com', '0090', 'images/1521727718.png', '2018-02-16 10:15:07', '2018-03-22 13:08:50', 'Nigeria', 'Lagos', 'Omole Phase 1', NULL, NULL, NULL, NULL),
(293, 'OLC0293', 'Fashion', 'O\'Lam Creations', '0', '27 Kayode Street, Beside TFC, Ogba', '6.633624', '3.338092', '08022019000', 'olamcreations.bj@gmail.com', '4526', 'images/1521726794.jpeg', '2018-02-16 10:22:06', '2018-03-22 12:53:17', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(294, 'RYD0294', 'Beauty, Health and Wellbeing', 'Ryder Lounge Studio', '0', 'Cinnamon Garden Shopping Complex,15 Victoria Arobieke Street', '6.446734', '3.47205', '08082455725', 'rome@ryderlounge.com', '1941', 'images/1519140310.jpeg', '2018-02-16 10:29:23', '2018-02-27 09:29:41', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(295, 'SMO0295', 'Beauty, Health and Wellbeing', 'Smoothit Fresh', '0', 'F69 Ikota Shopping Complex, Victoria Garden City, Lekki', '6.464271', '3.555478', '08079607881', 'smoothitfresh@gmail.com', '9887', 'images/1521725352.png', '2018-02-16 12:34:15', '2018-03-22 12:29:15', 'Nigeria', 'Lagos', 'Ajah', NULL, NULL, NULL, NULL),
(296, 'OLA0296', 'Fashion', 'Olatoks Kiddies Wears', '0', '31 Road, Gowon Estate', '6.599397', '3.279516', '08066443000', 'ashiru.abibat@yahoo.com', '0663', 'images/1521724938.jpeg', '2018-02-16 12:42:36', '2018-03-22 12:22:20', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(297, 'ZAL0297', 'Household Essentials', 'Zalimas Interiors', '0', 'Shop 14/15, Mosan Bus Stop, Ipaja Road', '6.603721', '3.271796', '08023695409', 'sulaimonayobola@ymail.com', '2521', 'images/1518791835.png', '2018-02-16 13:38:06', '2018-02-20 10:37:12', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(298, 'PAR0298', 'Beauty, Health and Wellbeing', 'Parach Hub Makeup & Beauty Supplies', '0', 'Shop 10, New Market By Mosan Bus Stop, Ipaja Road', '6.603721', '3.271796', '08084436113', 'parachhub@gmail.com', '8191', 'images/1518792463.jpeg', '2018-02-16 13:48:25', '2018-02-20 10:46:23', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(299, 'BRA0299', 'Restaurants', 'Brass & Copper', '0', '1 Olubunmi Owa Street', '6.447628', '3.471306', '08131096966', 'ybcocoonigltd@gmail.com', '7240', 'images/1519133969.jpeg', '2018-02-16 13:58:42', '2018-04-13 08:42:03', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(300, 'IFC0300', 'Beauty, Health and Wellbeing', 'i-Fitness Center - Sangotedo', '0', 'Emperor Mall, Beside Novare Mall, Sangotedo, Lekki-Epe Express way', '6.467417', '3.638798', '09029070143', 'info@ifitness.com.ng', '7146', 'images/1519047384.jpeg', '2018-02-19 12:36:31', '2018-04-13 08:41:00', 'Nigeria', 'Lagos', 'Sangotedo', NULL, NULL, NULL, NULL),
(301, 'IFC0301', 'Beauty, Health and Wellbeing', 'i-Fitness Center - VGC', '0', 'Block 7, Eleganza Complex, Opposite VGC', '6.461627', '3.557382', '09091086941', 'info@ifitness.com.ng', '1349', 'images/1519048158.jpeg', '2018-02-19 12:49:29', '2018-04-13 08:34:27', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(302, 'SSD0302', 'Beauty, Health and Wellbeing', 'SS Dental Clinic Limited', '100', '4B Wole Olateju Crescent, off Admiralty Way', '6.446914', '3.459319', '012705473', 'infolek@ssdentalclinicltd.com', '5285', 'images/1519200058.png', '2018-02-21 07:03:33', '2018-04-13 08:38:39', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(303, 'SS0303', 'Hotels And Resorts', 'S&S Hotels And Suites', '0', '239 Muri Okunola Street', '6.432033', '3.436356', '012772952', 'reservations@sshotelsandsuites.com', '3562', 'images/1519204017.jpeg', '2018-02-21 07:15:54', '2018-02-21 09:14:11', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(305, 'CPR0305', 'Services', 'CPR Cell Phone Repair - Ikeja', '0', 'Entrance 1, Ikeja City Mall, Alausa', '6.614183', '3.358299', '08170001539', 'ikeja@cellphonerepair.ng', '3052', 'images/1523548836.jpeg', '2018-02-23 13:23:16', '2018-04-12 15:00:47', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(306, 'CPR0306', 'Services', 'CPR Cell Phone Repair - Maryland', '0', 'Main Entrance Maryland Mall, 350-360 Ikorodu Road, Anthony Village', '6.567266', '3.367255', '08170001597', 'maryland@cellphonerepair.ng', '4302', 'images/1523548723.jpeg', '2018-02-23 13:29:08', '2018-04-12 14:58:46', 'Nigeria', 'Lagos', 'Maryland', NULL, NULL, NULL, NULL),
(307, 'CPR0307', 'Services', 'CPR Cell Phone Repair - The Palms', '0', 'The Palms Shopping Complex, 1 BIS Way, Maroko', '6.435838', '3.451459', '08170003267', 'info@cellphonerepair.com', '6871', 'images/1523548668.jpeg', '2018-02-23 13:34:05', '2018-04-12 14:57:49', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(308, 'ANG0308', 'Restaurants', 'Angelos Town Cafe', '0', 'Prince Ebeano Compound, 9 Northern Business District Crescent, Admiralty Way', '6.447468', '3.470184', '09098626068', 'edwinm@afsg.com.ng', '2821', 'images/1519397103.jpeg', '2018-02-23 13:41:58', '2018-04-13 08:27:42', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(309, 'ANG0309', 'Restaurants', 'Angelos Metro Cafe - Elephant House', '0', 'Ground Floor,  214 Broad Street, Marina', '6.457577', '3.381514', '08060012678', 'edwinm@afsg.com.ng', '8993', 'images/1519398801.jpeg', '2018-02-23 14:18:46', '2018-02-27 08:42:25', 'Nigeria', 'Lagos', 'Lagos Island', NULL, NULL, NULL, NULL),
(310, 'PEL0310', 'Services', 'Pelssy Wines & International Limited', '0', '1, Victoria Arubieke Street, by Raw Material Bus Stop, Admiralty Way', '6.447690', '3.472475', '09060000124', 'peterbabatunde.nwoko@yahoo.com', '7950', 'images/1521207705.png', '2018-02-26 07:34:00', '2018-04-13 08:28:38', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(311, 'KON0311', 'Fashion', 'Konibbles Contemporary Wears Limited', '0', 'Brasas\'r Place, 69 Admiralty Way', '6.447465', '3.471870', '08020788655', 'konibblesyemmy@yahoo.com', '5298', 'images/1521208669.png', '2018-02-26 08:00:26', '2018-03-16 12:58:06', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(312, 'HOU0312', 'Fashion', 'House Of Jojo', '0', '8 University Road, off Herbert Macaulay Road', '6.517199', '3.382332', '08170184814', 'lamide.martins@gmail.com', '8647', 'images/1521206461.png', '2018-02-26 08:10:20', '2018-04-13 08:26:19', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(313, 'SOU0313', 'Restaurants', 'South Town Place', '70', 'Chisco Bus Stop Elegushi (Conoil Filling Station)', '6.434622', '3.490595', '08151000600', 'southtownplace@gmail.com', '5262', 'images/1521205487.png', '2018-02-26 12:25:22', '2018-04-12 15:02:11', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(314, 'JUL0314', 'Fashion', 'Julix Juicy Fashion World', '0', '32 Road, 3rd Avenue, House 19 (Glo Office)', '6.464774', '3.292693', '09033709517', 'julianchigo3@gmail.com', '0165', 'images/1521202742.png', '2018-02-26 12:43:25', '2018-03-16 11:19:04', 'Nigeria', 'Lagos', 'Festac', NULL, NULL, NULL, NULL),
(315, 'MOT0315', 'Fashion', 'Mother\'s Pride - Ogba 1', '0', '34, College Road, Haruna', '6.640026', '3.332135', '08023060095', 'motherspride2002@yahoo.com', '0785', 'images/1521196561.jpeg', '2018-02-26 12:59:15', '2018-03-16 09:36:04', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(316, 'CRA0316', 'Restaurants', 'Crave By Sharon', '0', '26A Shittu Animashaun Street, Gbagada Phase 2 Estate', '6.544379', '3.386519', '08094505529', 'cravebysharon@gmail.com', '6037', 'images/1519654736.png', '2018-02-26 13:24:27', '2018-02-26 13:24:27', 'Nigeria', 'Lagos', 'Gbagada', NULL, NULL, NULL, NULL),
(317, 'TKB0317', 'Bars And Nightlife', 'The Kabaal', '0', '37 Awolowo Road', '6.442010', '3.415490', '08127224501', 'rsvp@ptrlifestyle.com', '7762', 'images/1519656009.jpeg', '2018-02-26 13:42:36', '2018-02-26 13:42:36', 'Nigeria', 'Lagos', 'Ikoyi', NULL, NULL, NULL, NULL),
(318, 'DBS0318', 'Beauty, Health and Wellbeing', 'De Beauty Studio', '0', 'Shop 53, Enilobo Abdulahi Plaza, Mosan Bus stop', '6.603721', '3.271796', '09058274929', 'tbeautystudio16@gmail.com', '0083', 'images/1521200605.jpeg', '2018-02-26 14:49:06', '2018-03-16 10:43:28', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(319, 'ARS0319', 'Services', 'Arshable Cakes And More', '0', '73, After Mosan Bus stop, Along Ipaja Road', '6.603721', '3.271796', '07036790784', 'arshable808@gmail.com', '4307', 'images/1521199912.png', '2018-02-26 15:05:12', '2018-03-16 10:31:53', 'Nigeria', 'Lagos', 'Ipaja', NULL, NULL, NULL, NULL),
(320, 'BLU0320', 'Services', 'Blue Dream Dry Cleaning Services - Surulere 1', '0', '76, Adeniran Ogunsanya Street', '6.492701', '3.356748', '08033518005', 'bdventureltd@gmail.com', '0819', 'images/1519718699.jpeg', '2018-02-27 07:13:51', '2018-02-27 10:20:44', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(321, 'BOL0321', 'Beauty, Health and Wellbeing', 'Bolarfaj Makeovers', '0', 'Shop 4D Rachael Place, Opposite WAEC Office', '6.634663', '3.342690', '08026772797', 'omobolanlefaj@gmail.com', '8222', 'images/1521199212.png', '2018-02-27 07:54:43', '2018-03-16 10:20:16', 'Nigeria', 'Lagos', 'Ogba', NULL, NULL, NULL, NULL),
(322, 'LIF0322', 'Services', 'Life Images Fotography', '0', 'Suite 22 & 23, Caroline Plaza, Gowon Estate', '6.603808', '3.283701', '08033756738', 'delifeimage@gmail.com', '4162', 'images/1521198831.png', '2018-02-27 08:32:08', '2018-03-16 10:14:43', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(323, 'BLU0323', 'Services', 'Blue Dream Dry Cleaning Services - Surulere 2', '0', '110, Clegg Street', '6.507672', '3.361753', '08033518005', 'bdventureltd@gmail.com', '5245', 'images/1519725505.jpeg', '2018-02-27 09:03:11', '2018-02-27 10:26:39', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(324, 'BLU0324', 'Services', 'Blue Dream Dry Cleaning Services - Surulere 3', '0', '21, Ishaga Road', '6.512831', '3.358615', '08033518005', 'bdventureltd@gmail.com', '5776', 'images/1519726454.jpeg', '2018-02-27 09:15:22', '2018-02-27 10:25:55', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(326, 'TJB0326', 'Beauty, Health and Wellbeing', 'TeJuvee Beauty Studio & Consultant', '0', '46 Okunola Street', '6.644701', '3.283771', '08024121735', 'topget2001@yahoo.com', '0136', 'images/1521194144.jpeg', '2018-02-27 11:55:56', '2018-03-16 08:55:47', 'Nigeria', 'Lagos', 'Egbeda', NULL, NULL, NULL, NULL),
(327, 'STU0327', 'Beauty, Health and Wellbeing', 'Studio Stylist Salon And Spa', '100', '2nd Floor, 49 Adeola Odeku Street', '6.431205', '3.416066', '09075750754', 'studiostylish.mkting@hotmail.com', '2591', 'images/1519742270.png', '2018-02-27 13:38:26', '2018-03-21 10:56:19', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(328, 'BOD0328', 'Beauty, Health and Wellbeing', 'BodyPro Fitness', '60', 'GistMe Building, KM 13, Lekki-Epe Expressway', '6.431224', '3.431224', '09099372777', 'aminai.i@residency.com.ng', '1740', 'images/1521194605.png', '2018-02-28 11:36:36', '2018-04-17 14:06:08', 'Nigeria', 'Lagos', 'Lekki', NULL, NULL, NULL, NULL),
(329, 'DOR0329', 'Beauty, Health and Wellbeing', 'Doranne Beauty - Ikeja', '0', 'Goodnews Plaza, 4 Agbaoku Street Off Opebi Road', '6.595292', '3.358188', '08189390564', 'dorannebeauty@gmail.com', '0057', 'images/1520932699.jpeg', '2018-02-28 12:17:12', '2018-04-12 12:44:58', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(330, 'WBS0330', 'Services', 'W\'s Bake Shop', '0', '41 Iwaya Road', '6.506309', '3.38765', '08020896925', 'bakeshopofficial@gmail.com', '3470', 'images/1521189200.png', '2018-02-28 13:27:53', '2018-03-16 07:33:22', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(331, 'CRO0331', 'Beauty, Health and Wellbeing', 'Crossfit Lagos Gym', '0', '32 Bode Thomas Street', '6.488796', '3.351686', '07059969059', 'amadiisaac644@gmail.com', '9353', 'images/1519829810.jpeg', '2018-02-28 13:54:41', '2018-02-28 13:56:51', 'Nigeria', 'Lagos', 'Surulere', NULL, NULL, NULL, NULL),
(332, 'WOO0332', 'Household Essentials', 'Wooddesignes International Company', '0', '41 Iyawa Road', '6.507064', '3.387836', '08175813661', 'hello@wooddesignes.com', '0481', 'images/1521192667.jpeg', '2018-03-01 07:46:31', '2018-03-16 08:31:09', 'Nigeria', 'Lagos', 'Yaba', NULL, NULL, NULL, NULL),
(333, 'KID0333', 'Fashion', 'Kidz Domain', '0', 'Shop 11/12 Ijiaye Road, Ogba, Opposite UBA', '6.628384', '3.337592', '08038698199', 'angyadash@gmail.com', '3314', 'images/1521192430.png', '2018-03-16 08:22:01', '2018-03-16 08:27:12', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(334, 'NUE0334', 'Fashion', 'Nuels Place', '0', '2A Ogunusi Road, Omole, Isheri/ Ojodu', '6.634863', '3.353554', '08035754934', 'adebisi.hamilton@gmail.com', '5734', 'images/1521212541.jpeg', '2018-03-16 13:12:27', '2018-03-16 14:02:25', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(335, 'CCL0335', 'Household Essentials', 'C - Ceramica Limited', '0', '642F Akin Adesola Street', '6.433574', '3.424249', '014604707', 'inquiry@c-ceramica.com', '6588', 'images/1521209879.jpeg', '2018-03-16 13:21:19', '2018-03-20 14:18:57', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(336, 'CEL0336', 'Beauty, Health and Wellbeing', 'Celon Dental Clinic - Ibeju', '0', 'Shop E 201 - 203 Akord Mall Km 34, Lekki - Epe Expressway, Bogije', '6.476295', '3.756903', '08100571816', 'info@celondentalclinic.com', '0683', 'images/1521555598.png', '2018-03-20 13:28:48', '2018-04-12 11:52:11', 'Nigeria', 'Lagos', 'Ibeju Lekki', NULL, NULL, NULL, NULL),
(337, 'THE0337', 'Arts,Entertainment And Recreation', 'The Lekki Coliseum', '0', '14 Providence Street, Off Admiralty Road', '6.431549', '3.464162', '08099666736', 'info@thelekkicoliseum.com.ng', '7104', 'images/1521622673.png', '2018-03-21 08:00:22', '2018-04-12 13:31:05', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(338, 'FLA0338', 'Fashion', 'Flash Factor Fashions - Port Harcourt', '0', '12 Onne Road G.R.A Phase 2', '4.814785', '7.001235', '08033000765', 'flashfactor12@gmail.com', '4397', 'images/1521805542.png', '2018-03-23 10:48:33', '2018-04-12 09:56:21', 'Nigeria', 'Rivers', 'Port Harcourt', NULL, NULL, NULL, NULL),
(339, 'ULT0339', 'Beauty, Health and Wellbeing', 'Ultident Dental Clinic - Sangotedo', '0', '1 Adenuga Street, Opposite Safeway Hospital, Ajah Lekki Epe Expressway', '6.471718', '3.628569', '07037852845', 'info@ultidentdentalclinic.com.ng', '4643', 'images/1523547527.png', '2018-03-28 07:33:37', '2018-04-12 14:38:55', 'Nigeria', 'Lagos', 'Sangotedo', NULL, NULL, NULL, NULL),
(340, 'ULT0340', 'Beauty, Health and Wellbeing', 'Ultident Dental Clinic - Ajah', '0', 'Suite 9 & 10A Ajah Shopping Mall By Ilaje Bus Stop Beside Wema Bank', '6.468478', '3.561417', '07037852845', 'info@ultidentdentalclinic.com.ng', '6601', 'images/1523547456.png', '2018-03-28 07:43:41', '2018-04-12 14:37:52', 'Nigeria', 'Lagos', 'Ajah', NULL, NULL, NULL, NULL),
(341, 'WEA0341', 'Household Essentials', 'Wealthstones Int\'l Development Ltd', '0', '35 Freedom Way', '6.436370', '3.481471', '08025018557', 'andyudo@alnodo.com', '7448', 'images/1522245175.png', '2018-03-28 08:11:40', '2018-04-12 12:49:32', 'Nigeria', 'Lagos', 'Lekki Phase 1', NULL, NULL, NULL, NULL),
(344, 'WES0101', 'Fashion', 'Wessy Creation - Ikeja', '0', '29, Isaac John, Ten Ways Galleria, GRA', '6.583518', '3.362950', '08096756917', 'info@wessycreations.com', '8855', 'images/1524050336.jpeg', '2018-04-12 13:58:23', '2018-04-18 10:19:02', 'Nigeria', 'Lagos', 'Ikeja', NULL, NULL, NULL, NULL),
(342, 'WES0342', 'Fashion', 'Wessy Creations - Abeokuta', '0', 'Continental Suites, Presidential Boulevard, Ibara', '7.139906', '3.340136', '08033312324', 'wessyjay@yahoo.com', '2764', 'images/1522325160.jpeg', '2018-03-29 11:08:40', '2018-04-12 09:15:36', 'Nigeria', 'Ogun', 'Abeokuta', NULL, NULL, NULL, NULL),
(343, 'PUR0343', 'Beauty, Health and Wellbeing', 'Purple Ray Diagnostics', '0', '12 Idowu Martins Street', '6.430719', '3.419422', '08082370600', 'purple.ray@reddingtonhospital.com', '9470', 'images/1522327473.jpeg', '2018-03-29 11:46:41', '2018-04-12 09:14:15', 'Nigeria', 'Lagos', 'Victoria Island', NULL, NULL, NULL, NULL),
(346, 'HIS0346', 'Beauty, Health and Wellbeing', 'Histouch Diagnostic Clinic', '0', 'KM30 Farm Bus Stop Oko - Ado, Lekke - Epe Express Way', '6.465894', '3.561445', '07061886307', 'histouchdiagnosticclinic@gmail.com', '1352', 'images/1523971073.jpeg', '2018-04-17 12:20:44', '2018-05-27 18:10:43', 'Nigeria', 'Lagos', 'Sangotedo', 'Test', 'Angelina was planning to take her six kids (Maddox, 16, Pax, 15, Shiloh, Vivienne and Knox) to London as she filmed Maleficent 2 but was reportedly told she cant take the children across to the UK until she and Brad have sorted their divorce.  An insider told the New York Posts Six Page column: They are figuring out how it would work, but she is not happy. She wants to take the kids to London with her while shes shooting and shes frustrated with the process.', 'Angelina was planning to take her six kids (Maddox, 16, Pax, 15, Shiloh, Vivienne and Knox) to London as she filmed Maleficent 2 but was reportedly told she cant take the children across to the UK until she and Brad have sorted their divorce.\r\n\r\nAn insider told the New York Posts Six Page column: They are figuring out how it would work, but she is not happy. She wants to take the kids to London with her while shes shooting and shes frustrated with the process.', 'Angelina was planning to take her six kids (Maddox, 16, Pax, 15, Shiloh, Vivienne and Knox) to London as she filmed Maleficent 2 but was reportedly told she cant take the children across to the UK until she and Brad have sorted their divorce.\r\n\r\nAn insider told the New York Posts Six Page column: They are figuring out how it would work, but she is not happy. She wants to take the kids to London with her while shes shooting and shes frustrated with the process.');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_categories`
--

CREATE TABLE `merchant_categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_categories`
--

INSERT INTO `merchant_categories` (`category_id`, `name`, `remarks`, `created_at`, `updated_at`) VALUES
(9, 'Household Essentials', 'Supermarkets,Eletronic  Applainces,Interior Decorating,Furniture,Gym Equipment,', '2017-11-06 11:11:24', '2017-11-06 11:11:24'),
(6, 'Beauty, Health and Wellbeing', 'Cosmetics,Make Up,Salons,Spas,Gym,Meal Preps,Yoga,Clinics,Labs', '2017-11-06 09:40:06', '2017-11-06 11:04:48'),
(8, 'Bars And Nightlife', 'Bars,Lounges And Nightclubs', '2017-11-06 11:06:45', '2017-11-06 11:06:45'),
(7, 'Restaurants', 'Restaurants', '2017-11-06 10:57:05', '2017-11-06 10:59:03'),
(10, 'Arts,Entertainment And Recreation', 'Cinemas,Horse Riding,Cinemas,Comedy House,Game Parks', '2017-11-06 11:15:07', '2017-11-06 11:15:07'),
(11, 'Travel', 'Airline,Car Rentals,Luxury Villa Rentals,Luxury Yacht,Airport Protocol,Activity', '2017-11-06 11:21:17', '2017-11-06 11:21:17'),
(12, 'Hotels And Resorts', 'Hotel,Guest Houses,Resort', '2017-11-06 11:23:31', '2017-11-06 11:23:31'),
(13, 'Services', 'Dry Cleaners,Cleaning Companies,Car Repair Shops,Carwashes,', '2017-11-06 11:26:17', '2017-11-06 11:26:17'),
(14, 'Fashion', 'Boutique,Couture,Fashion Designers,Tailors,Fabric Shops,Stylists,', '2017-11-06 11:34:55', '2017-11-06 11:34:55'),
(15, 'Kids', 'Children Wear,Playing Areas,School Iterms,Toys,Baby Shops', '2017-11-06 11:37:46', '2017-11-06 11:37:46'),
(16, 'Retail', 'Art,Gift Shops,Bookshops', '2017-11-06 11:40:58', '2017-11-06 11:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_gallery`
--

CREATE TABLE `merchant_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `merchant_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_gallery`
--

INSERT INTO `merchant_gallery` (`id`, `avatar`, `merchant_id`, `created_at`) VALUES
(1, 'images/1526749815.jpeg', 346, '2018-05-19 17:10:15'),
(2, 'images/1526749823.jpeg', 346, '2018-05-19 17:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_offers`
--

CREATE TABLE `merchant_offers` (
  `offer_id` int(10) UNSIGNED NOT NULL,
  `merchant_id` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_members` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_type` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_offers`
--

INSERT INTO `merchant_offers` (`offer_id`, `merchant_id`, `details`, `tagline`, `avatar`, `period`, `created_at`, `updated_at`, `start_date`, `end_date`, `offer_name`, `target_members`, `offer_type`) VALUES
(6, 'HOU0072', '10% on new arrivals, 20% on other dresses', '10% on new arrivals, 20% on other dresses', 'images/1511516782.jpeg', NULL, '2017-11-24 08:51:27', '2017-11-24 09:01:17', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(7, 'IND0071', '10% off shoes, 5% off all items in the store minus accessories', '10% Off Shoes, 5% Off Everything minus accessories', NULL, NULL, '2017-11-24 09:00:31', '2018-04-18 10:52:55', '2018-04-13', '2019-04-13', '-10', 'Affinity Essence', NULL),
(102, 'GAT225', '1.100 - 100k - 5% Discount + Gift Bag\n2.100k - 500k -10% Discount + Gift Bag\n3. 500k And Above 15% Discount + Gift Bag', '15% Discount', 'images/1515074948.jpeg', NULL, '2018-01-04 13:14:22', '2018-03-01 07:50:58', '2017-10-23', '2018-10-23', '15', 'Affinity Premium', NULL),
(9, 'FRE0069', '20% off major services such as massage, facials, body treatments.15% off pedicure, manicure and nail fixing.', '20% off major services such as massage, facials, body treatments', 'images/1511518987.jpeg', NULL, '2017-11-24 09:24:13', '2018-01-04 14:09:29', '2017-06-08', '2018-06-08', '20', 'Affinity Premium', NULL),
(10, 'BLI0068', '20% Discount On All Dental Procedures Except Advanced  Dental Work Like Crowns/Bridges/Implant & Ortho.', '20% Discount', 'images/1511519316.jpeg', NULL, '2017-11-24 09:29:28', '2018-02-26 08:36:17', '2018-02-22', '2019-02-22', '20', 'Affinity Essence', NULL),
(11, 'LA0019', '10% Discount', '10% Discount', 'images/1511520115.jpeg', NULL, '2017-11-24 09:43:17', '2018-04-18 10:22:08', '2017-06-09', '2018-06-09', '10', 'Affinity Essence', NULL),
(12, 'DJ 0021', '10% Discount', '10% Discount', 'images/1511521540.jpeg', NULL, '2017-11-24 10:06:03', '2018-04-18 10:23:40', '2017-06-09', '2018-06-09', '10', 'Affinity Essence', NULL),
(13, 'MOA0023', '10% Discount', '10% Discount', 'images/1511521722.jpeg', NULL, '2017-11-24 10:09:57', '2018-04-18 10:24:39', '2017-06-09', '2018-06-09', '10', 'Affinity Premium', NULL),
(14, 'MAG0025', '20% Discount', '20% Discount', 'images/1511521971.png', NULL, '2017-11-24 10:13:37', '2018-04-18 10:25:39', '2017-06-09', '2018-06-09', '20', 'Affinity Premium', NULL),
(15, 'EAR0022', '10% Discount', '10% Discount', 'images/1511522316.png', NULL, '2017-11-24 10:19:45', '2018-04-18 10:26:46', '2017-06-09', '2018-06-09', '10', 'Affinity Essence', NULL),
(16, 'COL0026', '10% Discount', '10% Discount', 'images/1511522527.jpeg', NULL, '2017-11-24 10:22:57', '2018-04-18 10:31:50', '2017-06-09', '2018-06-09', '10', 'Affinity Premium', NULL),
(17, 'INS0027', '10% Discount', '10% Discount', 'images/1511522742.jpeg', NULL, '2017-11-24 10:26:50', '2018-04-18 10:32:43', '2017-06-09', '2018-06-09', '10', 'Affinity Premium', NULL),
(18, 'TEA0028', '5% Discount', '5% Discount', 'images/1511522969.jpeg', NULL, '2017-11-24 10:30:18', '2018-04-18 10:33:36', '2017-06-09', '2018-06-09', '5', 'Affinity Essence', NULL),
(19, 'NIK0029', '10% Discount', '10% Discount', 'images/1511523231.jpeg', NULL, '2017-11-24 10:34:44', '2018-04-18 10:34:31', '2017-06-09', '2018-06-09', '10', 'Affinity Essence', NULL),
(20, 'MIC0031', '5% Discount', '5% Discount', 'images/1511523757.jpeg', NULL, '2017-11-24 10:43:38', '2018-04-18 10:36:10', '2017-06-08', '2018-06-08', '5', 'Affinity Essence', NULL),
(21, 'TBF0032', '20% Discount', '20% Discount', 'images/1511524057.jpeg', NULL, '2017-11-24 10:48:35', '2018-04-18 10:37:08', '2017-06-08', '2018-06-08', '20', 'Affinity Essence', NULL),
(22, 'SAH0033', '10% Discount', '10% Discount Off Purchases From 5,000 And Above', 'images/1511524543.jpeg', NULL, '2017-11-24 10:56:50', '2018-04-18 10:57:15', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(23, 'PRE0034', '15% Discount', '15% Discount', 'images/1511525010.jpeg', NULL, '2017-11-24 11:04:42', '2018-04-18 10:39:01', '2017-06-08', '2018-06-08', '15', 'Affinity Essence', NULL),
(24, 'GIF366', '10% Discount', '10% Discount', 'images/1511525302.jpeg', NULL, '2017-11-24 11:08:52', '2018-04-18 10:41:44', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(25, 'ASH0036', '10% Discount', '10% Discount', NULL, NULL, '2017-11-24 11:12:53', '2018-04-18 10:43:09', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(26, 'KIM0037', '10% Discount', '10% Discount', 'images/1511525813.jpeg', NULL, '2017-11-24 11:16:57', '2018-04-18 10:44:31', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(27, 'BHI0030', '10% Discount', '10% Discount', NULL, NULL, '2017-11-24 11:19:59', '2018-04-18 10:45:42', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(28, 'EKO0038', '15% Discount', '15% Discount', NULL, NULL, '2017-11-24 11:25:02', '2018-04-18 10:47:32', '2017-06-08', '2018-06-08', '15', 'Affinity Premium', NULL),
(29, 'BAR0040', '10% Discount Off Beverage, 5% Off Food', '10% Discount', NULL, NULL, '2017-11-24 11:35:56', '2018-04-17 08:29:37', '2018-04-13', '2019-04-13', '10', 'Affinity Premium', NULL),
(30, 'GOO0041', '10% Discount', '10% Discount', NULL, NULL, '2017-11-24 11:38:35', '2018-04-18 10:46:40', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(31, 'DAP0042', '15% Discount', '15% Discount', NULL, NULL, '2017-11-24 11:42:42', '2018-04-18 10:48:21', '2017-06-08', '2018-06-08', '15', 'Affinity Essence', NULL),
(33, 'WIN0044', '5% Discount On Food And Drinks Minimum Of N10,000 And Above.', '5% Discount', NULL, NULL, '2017-11-24 11:52:04', '2018-04-18 07:38:28', '2018-04-12', '2019-06-12', '10', 'Affinity Essence', NULL),
(34, 'CHA0046', '15% discount on spa treatments only', '15% discount on spa treatments only', NULL, NULL, '2017-11-24 11:56:11', '2018-01-04 13:58:40', '2017-06-08', '2018-06-08', '15', 'Affinity Premium', NULL),
(35, 'PAM0047', '30% discount on wedding packages, bridal showers and children\'s party packages for planning and venue decoration.', '30% discount on wedding packages, bridal showers and children\'s', NULL, NULL, '2017-11-24 12:00:31', '2018-01-04 13:59:21', '2017-06-08', '2018-06-08', '30', 'Affinity Premium', NULL),
(36, 'REN0067', '10% discount in CUT for a 3 course menu.Buy one coffee and get one home made cookie in chocolate. Get second drink for free at R Bar & Lounge. Get welcome drink at Iyeru Okin', '10% discount in CUT for a 3 course menu', NULL, NULL, '2017-11-24 12:06:16', '2018-01-04 14:00:00', '2017-06-08', '2018-06-08', '15', 'Affinity Premium', NULL),
(37, 'TWH0048', '20% discount on rooms only', '20% discount on rooms only', NULL, NULL, '2017-11-24 12:10:44', '2017-11-24 12:10:44', '2017-06-08', '2018-06-08', '20', 'Affinity Essence', NULL),
(39, 'EAG0050', 'N5,000 off singles for 1 year.N10,000 off couples for 1 year,N20,000 off Family of 4 for 1 year', 'N5,000 off singles for 1 year', NULL, NULL, '2017-11-24 12:48:48', '2017-11-24 12:48:48', '2017-06-08', '2018-06-08', 'N5,000 off singles for 1 year', 'Affinity Essence', NULL),
(40, 'ANG0051', '20% discount on accommodation.', '20% discount on accomodation', NULL, NULL, '2017-11-24 12:54:12', '2018-04-17 10:22:52', '2018-04-13', '2019-04-13', '20', 'Affinity Premium', NULL),
(41, 'ABE0052', '20% off facials and body treatments', '20% off facials and body treatments', NULL, NULL, '2017-11-24 12:57:02', '2018-01-05 08:38:37', '2017-06-08', '2018-06-08', '20', 'Affinity Essence', NULL),
(42, 'HAI0053', '10% discount on hair and wigs', '10% discount on hair and wigs', 'images/1511776462.jpeg', NULL, '2017-11-27 08:55:20', '2017-11-27 08:55:20', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(103, 'GAT224', '1. N100 - N100k - 5% Discount + Gift Bag\n2. N100k - N500k - 10% Discount + Gift Bag\n3. N500k  And Above - 15% Discount + Gift Bag', '15% Discount', 'images/1515078637.jpeg', NULL, '2018-01-04 14:14:07', '2018-03-01 07:51:30', '2017-10-23', '2018-10-23', '15', 'Affinity Premium', NULL),
(44, 'BON0054', '10% off rack rates', '10% off rack rates', NULL, NULL, '2017-11-27 09:10:16', '2018-01-05 08:38:16', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(45, 'JOH0058', '20% discount on salon services', '20% discount on salon services', NULL, NULL, '2017-11-27 09:36:17', '2018-01-05 08:37:46', '2017-06-08', '2018-06-08', '20', 'Affinity Essence', NULL),
(46, 'OAS0055', '10% discount on massages, pedi and mani. Free glass of Champagne/ cup of tea', '10% discount on massages, pedi and mani. Free glass of', NULL, NULL, '2017-11-27 09:41:53', '2018-01-04 13:51:31', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(47, 'BOD0056', '25% discount on 1 year gym membership, 6 months gym membership and 1 month gym membership, plus Free wi-fi', '25% discount on 1 year gym membership', NULL, NULL, '2017-11-27 09:58:26', '2018-01-05 08:37:29', '2017-06-08', '2018-06-08', '25', 'Affinity Essence', NULL),
(49, 'LAM0057', '10% discount on repairs and maintenance of vehicle and robot center. Free computer detailing and car wash', '10% discount on repairs and maintenance of vehicle and robot', NULL, NULL, '2017-11-27 10:42:03', '2018-01-05 08:37:11', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(50, 'HOD0061', '5% Discount For All Card Holders. 10% Discount For All Who Call 24hrs Ahead. 10% Discount For Companies That HAC As Sole Repairs Option', '10% discount when you book 24 hours ahead', NULL, NULL, '2017-11-27 10:52:12', '2018-03-29 09:13:55', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(51, 'THE0062', '10% discount', '10% discount', NULL, NULL, '2017-11-27 11:06:07', '2018-04-11 09:23:56', '2018-04-09', '2019-06-09', '10', 'Affinity Premium', NULL),
(104, 'GAT223', 'N100 - N100k - 5% Discount + Gift Bag.   N100k - N500k - 10% Discount + Gift Bag .  N500k And Above 15%', '15% Discount', 'images/1515078997.jpeg', NULL, '2018-01-04 14:20:48', '2018-03-29 12:03:58', '2017-10-23', '2018-10-23', '15', 'Affinity Premium', NULL),
(53, 'SHO0063', '10% discount on services only, not products', '10% discount on services only, not products', NULL, NULL, '2017-11-27 11:14:29', '2018-02-21 13:02:59', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(54, 'TBA0064', '10% discount on all brow, lashes and waxing treatments', '10% discount on all brow, lashes and waxing treatments', NULL, NULL, '2017-11-27 11:19:50', '2018-01-04 13:49:03', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(55, 'DOR0065', '20% Discount On Makeup Services Done Only At Any Of Our Studios', '20% Discount', NULL, NULL, '2017-11-27 11:23:16', '2018-02-28 12:40:47', '2017-06-08', '2018-06-08', '20', 'Affinity Premium', NULL),
(56, 'CAI0066', '5% discount', '5% discount', NULL, NULL, '2017-11-27 11:27:21', '2017-11-27 11:27:21', '2017-06-08', '2018-06-08', '5', 'Affinity Essence', NULL),
(57, 'BLI0068', '20% off all dental procedures', '20% off all dental procedures', NULL, NULL, '2017-11-27 11:40:38', '2018-03-29 08:30:41', '2017-06-08', '2018-06-08', '15', 'Affinity Essence', NULL),
(58, 'FRE0069', '20% off major services such as massage, facials, body treatments.', '20% off major services such as massage, facials, body treatments.', NULL, NULL, '2017-11-27 11:44:40', '2017-11-27 11:44:40', '2017-06-08', '2018-06-08', '20', 'Affinity Luxe', NULL),
(59, 'BRU0070', '10% off total bill (Monday - Wednesday)', '10% off total bill (Monday - Wednesday)', NULL, NULL, '2017-11-27 11:56:16', '2017-11-27 11:56:16', '2017-06-08', '2018-06-08', '10', 'Affinity Essence', NULL),
(91, 'SAM0102', '10% off all menus.\n15% off orders above #15,000', '15%', 'images/1513261943.jpeg', NULL, '2017-12-14 13:32:26', '2017-12-14 13:32:26', '2017-11-27', '2018-11-27', '15', 'Affinity Essence', NULL),
(61, 'DEE0084', '20% Discount On all spa services', '20% Discount', 'images/1512032801.jpeg', NULL, '2017-11-30 08:07:31', '2018-02-26 09:36:10', '2017-10-11', '2018-10-11', '40', 'Affinity Premium', NULL),
(62, 'CHR0083', '5% Discount off the total purchase of goods', '5% Discount', 'images/1512032915.jpeg', NULL, '2017-11-30 08:10:10', '2017-11-30 08:18:04', '2017-10-30', '2018-10-30', '5', 'Affinity Essence', NULL),
(63, 'IMA0082', 'Low volume attracts 2% discount\nHigh volume attracts 5% discount', '2-5% Discount', 'images/1512033093.jpeg', NULL, '2017-11-30 08:13:24', '2018-01-04 13:47:01', '2017-10-23', '2018-10-23', '5', 'Affinity Premium', NULL),
(64, 'HOM0081', '10% Discount on Rooms', '10% Discount', 'images/1512033264.jpeg', NULL, '2017-11-30 08:15:21', '2017-11-30 08:15:21', '2017-10-12', '2018-10-12', '10', 'Affinity Essence', NULL),
(106, 'MAS221', '20% Discount On Total Bill', '20% Discount', 'images/1515080015.png', NULL, '2018-01-04 14:36:09', '2018-03-29 10:48:08', '2016-10-18', '2018-10-18', '30', 'Affinity Essence', NULL),
(66, 'MOH0079', '15% on all service', '15% Discount', 'images/1512033617.png', NULL, '2017-11-30 08:21:07', '2018-02-26 09:06:21', '2017-10-06', '2018-10-06', '20', 'Affinity Premium', NULL),
(90, 'TAS0100', '30% OFF : SUITES, DELUXE EXECUTIVE, ROYAL SUITE.\n40% OFF ; STANDARD, DELUXE, EXECUTIVE.', '40% Discount', 'images/1513261514.jpeg', NULL, '2017-12-14 13:28:00', '2018-01-04 13:41:55', '2017-12-04', '2018-12-04', '40', 'Affinity Premium', NULL),
(68, 'ARA0077', '15% Discount', '15% Discount', 'images/1512033891.jpeg', NULL, '2017-11-30 08:25:31', '2018-02-26 09:05:09', '2017-10-10', '2018-10-10', '20', 'Affinity Premium', NULL),
(69, 'BEA0086', '15% Discount on body massages and body treatments. N900 On Purchases From N6000.Have A Full Body Massage Plus Full Body Scrub For N10200 Instead N12000.', '15% Discount', 'images/1512036338.gif', NULL, '2017-11-30 09:06:59', '2018-03-29 09:44:06', '2017-10-14', '2018-10-14', '20', 'Affinity Essence', NULL),
(70, 'BIL0087', '15% discount on all cleaning bookings made on www.bilancleaningservices.com', '15% Discount', 'images/1512037001.png', NULL, '2017-11-30 09:18:32', '2017-11-30 09:18:32', '2017-06-08', '2018-06-08', '15', 'Affinity Essence', NULL),
(105, 'GAT222', 'N100 - N100k - 5% Discount + Gift Bag.   N100k - N500k - 10% Discount + Gift Bag.  N500 And Above 15% + Gift Bag', '15% Discount', 'images/1515079487.jpeg', NULL, '2018-01-04 14:32:01', '2018-03-29 12:03:21', '2017-10-23', '2018-10-23', '15', 'Affinity Premium', NULL),
(75, 'JUS195', '15% off Clothing', '15% Discount', 'images/1513246412.jpeg', NULL, '2017-12-14 09:15:01', '2018-01-04 13:44:11', '2017-12-09', '2018-12-09', '15', 'Affinity Premium', NULL),
(74, 'LOH196', '15% off all products', '15% Discount', 'images/1513246326.jpeg', NULL, '2017-12-14 09:08:44', '2018-01-04 13:44:39', '2017-12-13', '2018-12-13', '15', 'Affinity Premium', NULL),
(76, 'BLE0106', '15% discount applies to all room rates', '15% Discount', NULL, NULL, '2017-12-14 09:23:10', '2017-12-14 09:23:10', '2017-11-09', '2018-11-09', '15', 'Affinity Essence', NULL),
(101, 'HOD0061', 'Flat Rate 10% Discount On Extensive Repairs. 5% Discount From Refferral Bills. N15,000.00 diagnosis charge subject to cancellation depending on repair.', '10 Discount', 'images/1523883197.png', NULL, '2018-01-04 12:25:57', '2018-04-17 11:01:06', '2018-04-13', '2019-04-13', '10', 'Affinity Essence', NULL),
(78, 'JBR188', '10% off on hair purchases including frontals and closures. \n15% off on wig purchases.', '15% Discount', 'images/1513251427.jpeg', NULL, '2017-12-14 10:39:15', '2018-01-05 08:36:52', '2017-12-11', '2018-12-11', '15', 'Affinity Essence', NULL),
(88, 'WEA197', '20% off Shirts and  T-shirts.\n15% off Blazers and Shoes\n10% off Jeans, Pants, Shorts.', '20% Discount', 'images/1513260153.jpeg', NULL, '2017-12-14 13:05:22', '2018-01-04 13:43:06', '2017-11-24', '2018-10-24', '20', 'Affinity Premium', NULL),
(89, 'WES0101', '10% Discount on all items on display at our retail stores except caps.N10 000 Off For Purchases N50 000 And Above', '10% Discount', 'images/1522325742.jpeg', NULL, '2017-12-14 13:21:58', '2018-03-29 11:15:44', '2017-12-04', '2018-12-04', '10', 'Affinity Essence', NULL),
(82, 'GLE0080', '15% Discount off Rooms only', '15% Discount', 'images/1513252868.png', NULL, '2017-12-14 11:02:15', '2017-12-14 11:02:15', '2017-10-04', '2018-10-04', '15', 'Affinity Essence', NULL),
(83, 'HOM0081', '10% Discount on Rooms', '10% Discount', 'images/1513253287.jpeg', NULL, '2017-12-14 11:09:00', '2017-12-14 11:09:00', '2017-10-12', '2018-10-12', '10', 'Affinity Essence', NULL),
(84, 'IMA0082', '2.5% - 5% Discount on all types of furniture for sale', '5% Discount', 'images/1513253516.jpeg', NULL, '2017-12-14 11:13:36', '2017-12-14 11:13:36', '2017-10-23', '2018-10-23', '5', 'Affinity Prive', NULL),
(85, 'CHR0083', '5% off the total purchase of goods', '5% Discount', 'images/1513253697.jpeg', NULL, '2017-12-14 11:15:58', '2017-12-14 11:15:58', '2017-10-30', '2018-10-30', '5', 'Affinity Essence', NULL),
(86, 'DEE0084', '20% off all spa services', '20%', 'images/1513253876.jpeg', NULL, '2017-12-14 11:18:40', '2017-12-14 11:18:40', '2017-10-11', '2018-10-11', '20', 'Affinity Essence', NULL),
(87, 'SHA0085', '30% off services which include: Facials, Body steam, Body Massage, and Pedicure', '30%', 'images/1513254377.png', NULL, '2017-12-14 11:28:54', '2017-12-14 11:28:54', '2017-10-30', '2018-10-30', '30', 'Affinity Essence', NULL),
(92, 'HOU0104', '#1000 off any Spa treatment.', 'Amount off', 'images/1513263227.jpeg', NULL, '2017-12-14 13:54:38', '2017-12-14 13:54:38', '2017-11-09', '2018-11-09', 'Amount off', 'Affinity Essence', NULL),
(93, 'IDE198', '20% Discount off Photography services', '20% Discount', 'images/1513265655.jpeg', NULL, '2017-12-14 14:35:24', '2018-01-05 08:31:57', '2017-11-25', '2018-11-25', '20', 'Affinity Essence', NULL),
(94, 'ZAR199', '15% off Handbags and Travel sets, Briefcases, Laptop bags, and Toiletries.', '15% Discount', 'images/1513267440.png', NULL, '2017-12-14 15:02:46', '2018-01-04 13:41:24', '2017-11-17', '2018-11-17', '15', 'Affinity Premium', NULL),
(95, 'TRO201', '10% off Every item.\nBuy 1 shoe, Get 1 for #20,000 and a pair of palm slippers.', '10% Discount', 'images/1513330707.png', NULL, '2017-12-15 08:40:58', '2018-01-04 13:41:04', '2017-11-22', '2018-11-22', '10', 'Affinity Premium', NULL),
(96, 'NEX202', '20% off all services', '20% Discount', 'images/1513332390.png', NULL, '2017-12-15 09:07:48', '2017-12-15 09:07:48', '2017-11-24', '2018-11-24', '20', 'Affinity Essence', NULL),
(98, 'NEX202', '20% off all services', '20% Discount', 'images/1513333900.png', NULL, '2017-12-15 09:32:19', '2017-12-15 09:32:19', '2017-11-24', '2018-11-24', '20', 'Affinity Essence', NULL),
(99, 'FOO205', '10% off all purchases above #1500', '10% Discount', 'images/1513334778.jpeg', NULL, '2017-12-15 09:47:23', '2018-01-05 08:31:30', '2017-11-06', '2018-11-06', '10', 'Affinity Essence', NULL),
(100, 'PAD212', '10% Discount off all events', '10% Discount', 'images/1513355359.png', NULL, '2017-12-15 15:30:23', '2017-12-15 15:30:23', '2017-10-16', '2018-10-16', '10', 'Affinity Essence', NULL),
(107, 'RES044', '10% Discount on bills excluding VAT and TAX', '10% Discount', 'images/1515145900.jpeg', NULL, '2018-01-05 08:55:20', '2018-01-05 08:55:20', '2017-10-10', '2018-10-10', '10', 'Affinity Premium', NULL),
(108, 'CAF219', '10% Discount on bills excluding VAT and TAX', '10% Discount', 'images/1515146351.png', NULL, '2018-01-05 09:01:43', '2018-01-05 09:01:43', '2017-10-10', '2018-10-10', '10', 'Affinity Premium', NULL),
(109, 'CEL0105', '15% Discount for procedures with prosthesis and appliances / 20% Discount for other procedures(without prosthesis/appliances).Patients self help kit for orthodontic cases only', '20% Discount', 'images/1515149201.png', NULL, '2018-01-05 09:55:04', '2018-03-23 07:33:35', '2017-11-01', '2018-11-01', '20', 'Affinity Essence', NULL),
(110, 'KD0200', '10% Discount on hair and nails', '10%', 'images/1515149858.png', NULL, '2018-01-05 10:05:12', '2018-01-05 10:05:12', '2017-11-15', '2018-11-15', '10', 'Affinity Essence', NULL),
(111, 'KD0231', '10% Discount off monthly subscriptions', '10% Discount', 'images/1515151424.png', NULL, '2018-01-05 10:24:57', '2018-03-01 07:50:35', '2017-11-15', '2018-11-15', '10', 'Affinity Essence', NULL),
(112, 'WAS215', '20% Discount but it does not apply to laundromat services.Free pick-up and delivery within Lekki,VI,Ikoyi.Laundromat offers one free wash after the 5th wash exclusive to members only', '20% Discount', 'images/1515151723.jpeg', NULL, '2018-01-05 10:36:24', '2018-01-05 10:36:24', '2017-12-05', '2018-12-15', '20', 'Affinity Premium', NULL),
(113, 'BAR214', '20% Discount on all services rendered at Bare to Beauty Company.', '20% Discount', 'images/1515152278.png', NULL, '2018-01-05 10:39:42', '2018-01-05 10:39:42', '2017-12-15', '2018-12-15', '20', 'Affinity Premium', NULL),
(114, 'NEX204', '20% Discount on all services', '20% Discount', 'images/1515152768.jpeg', NULL, '2018-01-05 10:48:56', '2018-01-05 10:48:56', '2017-11-24', '2018-11-24', '20', 'Affinity Essence', NULL),
(115, 'NEX203', '20% Discount On All Services', '20% Discount On All Services', 'images/1515153010.jpeg', NULL, '2018-01-05 10:51:05', '2018-04-18 11:19:13', '2017-11-24', '2018-11-24', '20', 'Affinity Essence', NULL),
(116, 'SAR0232', '10% Discount applies to services below N20k . 15% Discount applies to services above N20k', '20% Discount', 'images/1515154280.jpeg', NULL, '2018-01-05 11:16:27', '2018-01-05 11:16:27', '2017-11-11', '2018-11-11', '20', 'Affinity Premium', NULL),
(117, 'MAN0233', '10% Discount on food', '10%', 'images/1515404038.jpeg', NULL, '2018-01-08 08:35:12', '2018-01-08 08:35:12', '2018-01-05', '2019-01-05', '10', 'Affinity Premium', NULL),
(118, 'ADE0234', '10% Discount on every iterm', '10% Discount', 'images/1515404284.jpeg', NULL, '2018-01-08 08:39:00', '2018-01-08 08:39:00', '2018-01-04', '2019-01-04', '10', 'Affinity Premium', NULL),
(119, 'STR137', '15% Discount', '15% Discount', 'images/1516191668.jpeg', NULL, '2018-01-17 11:22:11', '2018-03-29 11:51:29', '2018-01-17', '2019-01-17', '15', 'Affinity Premium', NULL),
(120, 'COC127', '15% Discount', '15% Discount', 'images/1516191912.jpeg', NULL, '2018-01-17 11:25:49', '2018-03-29 11:50:53', '2018-01-17', '2019-01-17', '15', 'Affinity Premium', NULL),
(121, 'QUO0237', '15% Discount', '15%', 'images/1516193272.jpeg', NULL, '2018-01-17 11:48:49', '2018-01-17 11:48:49', '2018-01-17', '2019-01-17', '15', 'Affinity Essence', NULL),
(122, 'GRI0238', '20% Off Food', '20%', 'images/1516616280.png', NULL, '2018-01-22 09:21:16', '2018-01-22 09:21:16', '2018-01-16', '2019-01-16', '20', 'Affinity Premium', NULL),
(123, 'CLU57', '10% 0ff purchases above N250k in the club', '10%', NULL, NULL, '2018-01-22 09:36:57', '2018-03-29 10:55:20', '2018-01-16', '2019-01-16', '10', 'Affinity Premium', NULL),
(124, 'JAS0239', '15% On Ready To Wear Purchases', '15%', 'images/1516617500.png', NULL, '2018-01-22 09:39:16', '2018-01-22 09:39:16', '2018-01-08', '2019-01-08', '15', 'Affinity Premium', NULL),
(125, 'ADU0236', '10% Discount off purchases above N4,000', '10%', 'images/1516617609.png', NULL, '2018-01-22 09:40:54', '2018-02-20 12:21:43', '2018-01-15', '2019-01-15', '10', 'Affinity Premium', NULL),
(126, 'LEK0241', '20% off all rooms available plus a complimentary breakfast', '20%', NULL, NULL, '2018-02-02 14:39:59', '2018-02-02 14:44:07', '2018-02-01', '2019-02-01', '20', 'Affinity Essence', NULL),
(127, 'MAI183', '15% off Rooms, Food, Beverages and every services offer in Masion Fahrenheit', '15%', NULL, NULL, '2018-02-02 14:53:33', '2018-02-02 14:53:33', '2018-01-31', '2019-01-31', '15', 'Affinity Premium', NULL),
(128, 'YBC0242', '10% Discount applies on all services', '10% Discount', NULL, NULL, '2018-02-02 15:13:59', '2018-03-29 11:58:15', '2018-01-30', '2019-01-30', '10', 'Affinity Essence', NULL),
(129, 'IFC0254', '15% Discount on Bi-Annual Subscriptions And Above', '15% Discount', 'images/1517850533.jpeg', NULL, '2018-02-05 16:10:35', '2018-02-19 12:42:05', '2018-01-23', '2019-01-23', '15', 'Affinity Essence', NULL),
(130, 'MRC0253', '5% Discount Purchases Above N10,000', '5% Discount', 'images/1517850739.jpeg', NULL, '2018-02-05 16:13:37', '2018-02-05 16:13:37', '2018-02-05', '2019-02-05', '5', 'Affinity Premium', NULL),
(131, 'HOL0252', '10% Discount On Purchases Over N10,000,Seasonal Gifts', '10% Discount', 'images/1517851888.bin', NULL, '2018-02-05 16:35:46', '2018-02-05 16:35:46', '2018-01-23', '2019-02-22', '10', 'Affinity Essence', NULL),
(132, 'NAT0251', '10% Discount On Orders Above N6000. Get 10% Discount Off Our Signature Dish Noah\'s Ark.', '10% Discount On Orders Above N6000.', 'images/1517852300.gif', NULL, '2018-02-05 16:41:00', '2018-05-09 13:34:23', '2018-04-13', '2019-04-13', '10% Discount On Orders Above N6000.', 'Affinity Essence', NULL),
(133, 'RED126', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517852571.png', NULL, '2018-02-05 16:44:36', '2018-03-01 07:49:27', '2018-01-30', '2019-01-01', '10', 'Affinity Premium', NULL),
(134, 'GRA0248', '15% Discount Applies To Superior & Deluxe Rooms\n25% Discount Applies To Executive Rooms And Grand Emperor Suites', '25% Discount', 'images/1517853272.jpeg', NULL, '2018-02-05 16:57:06', '2018-02-05 16:57:06', '2018-01-24', '2019-01-24', '25', 'Affinity Essence', NULL),
(135, 'JAM0247', '20% Discount On All Meals.Free Drink Of Your Choice', '20% Discount', 'images/1517853545.jpeg', NULL, '2018-02-05 17:00:26', '2018-04-17 07:45:33', '2018-04-13', '2019-04-13', '25', 'Affinity Premium', NULL),
(136, 'TRM0260', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517913438.jpeg', NULL, '2018-02-06 09:39:11', '2018-02-06 09:42:43', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(137, 'MAX0259', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517913624.jpeg', NULL, '2018-02-06 09:41:57', '2018-02-06 09:45:55', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(138, 'TGC0258', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517913839.jpeg', NULL, '2018-02-06 09:45:23', '2018-02-06 09:45:23', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(139, 'TGC0257', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10%', 'images/1517914036.jpeg', NULL, '2018-02-06 09:48:49', '2018-02-06 09:48:49', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(140, 'TRB0256', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517914193.jpeg', NULL, '2018-02-06 09:51:32', '2018-02-06 09:51:32', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(141, 'TRH0255', '10% Discount On All Services And Health Screenings,Except Specialist Consultations', '10% Discount', 'images/1517914385.jpeg', NULL, '2018-02-06 09:54:31', '2018-02-06 09:54:31', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(142, 'IFC0246', '15% Discount On Bi-Annual Subscriptions And Above', '15% Discount', 'images/1519047552.jpeg', NULL, '2018-02-06 09:59:10', '2018-02-19 12:41:34', '2018-01-23', '2019-01-23', '15', 'Affinity Essence', NULL),
(143, 'FLA0250', '20% Discount On All Pre-Orders Clothings (Made To Measure)', '20% Discount', 'images/1517914937.jpeg', NULL, '2018-02-06 10:03:49', '2018-02-26 09:17:54', '2018-01-17', '2019-01-17', '25', 'Affinity Essence', NULL),
(144, 'IRO0249', '10% Discount Applies To 6 Months Membership.\n15% Discount Applies To 1 Year Membership', '15% Discount', 'images/1517915147.jpeg', NULL, '2018-02-06 10:08:21', '2018-05-04 10:49:53', '2018-01-24', '2019-01-24', '15', 'Affinity Premium', NULL),
(145, 'TAL0245', '10% Discount On Orders From N100,000 And Above', '10% Discount On Orders From N100,000 And Above', 'images/1517915598.jpeg', NULL, '2018-02-06 10:14:35', '2018-04-17 10:49:24', '2018-04-13', '2019-04-13', '10', 'Affinity Premium', NULL),
(146, 'DOU0244', '10% Discount Applies To All Services', '10% Discount', 'images/1517915932.jpeg', NULL, '2018-02-06 10:21:52', '2018-02-06 10:21:52', '2018-01-26', '2019-01-26', '10', 'Affinity Essence', NULL),
(147, 'MAR0243', '10% Discount On Purchases From N25,000 And Above', '10%', 'images/1517916387.jpeg', NULL, '2018-02-06 10:27:41', '2018-04-17 10:19:34', '2018-04-13', '2019-04-13', '10', 'Affinity Premium', NULL),
(148, 'ALB0264', '15% Discount On orders From N25,000', '15% Discount', 'images/1518081235.bin', NULL, '2018-02-08 08:15:33', '2018-02-22 13:44:29', '2018-02-06', '2019-02-06', '15', 'Affinity Essence', NULL),
(149, 'BEN0263', '40% On All Room Rates', '40% Discount', 'images/1518081653.jpeg', NULL, '2018-02-08 08:21:41', '2018-02-20 12:17:59', '2018-02-06', '2019-02-06', '40', 'Affinity Premium', NULL),
(150, 'UNI0262', '15% Discount On All Services', '15% Discount', 'images/1518081760.jpeg', NULL, '2018-02-08 08:23:23', '2018-02-08 08:23:23', '2018-02-07', '2019-02-07', '15', 'Affinity Premium', NULL),
(151, 'PHO0261', '15% Discount On Orders From N8,000 And Above', '15% Discount', 'images/1518081848.jpeg', NULL, '2018-02-08 08:24:55', '2018-02-20 12:29:56', '2018-02-07', '2019-02-07', '15', 'Affinity Essence', NULL),
(152, 'JOH0271', '20% Discount On Fixing,Wig Making And Braiding.\n10% Discount On Nail Services', '20%', 'images/1518167515.jpeg', NULL, '2018-02-09 08:13:50', '2018-02-09 08:13:50', '2018-02-08', '2019-02-08', '20', 'Affinity Essence', NULL),
(153, 'CAR0270', '20% Discount On General Print And Branding Services.', '20% Discount', 'images/1518167710.jpeg', NULL, '2018-02-09 08:16:21', '2018-03-28 14:14:00', '2018-02-08', '2019-02-08', '20', 'Affinity Premium', NULL),
(154, 'HOT0269', '15% Discount On All Iterms', '15% Discount', 'images/1518167848.jpeg', NULL, '2018-02-09 08:18:18', '2018-02-09 08:18:18', '2018-02-08', '2019-02-08', '15', 'Affinity Premium', NULL),
(155, 'LAV0268', '10% Discount On Purchases Only.\nPair Of Earrings With Every Wedding Dress', '10% Discount', 'images/1518167973.png', NULL, '2018-02-09 08:22:03', '2018-02-09 08:22:03', '2018-02-08', '2019-02-08', '10', 'Affinity Premium', NULL),
(156, 'S &0267', '35% Discount On All Room Categories.\nFree Room Upgrade On Weekends(Upon Availability)', '35% Discount', 'images/1518168218.jpeg', NULL, '2018-02-09 08:25:29', '2018-02-09 08:25:29', '2018-02-08', '2019-02-08', '35', 'Affinity Premium', NULL),
(157, 'BUN0266', '5% Discount Off Overall Bill', '5% Discount', 'images/1518168408.jpeg', NULL, '2018-02-09 08:27:39', '2018-02-09 08:27:39', '2018-02-08', '2019-02-08', '5', 'Affinity Premium', NULL),
(158, 'BUN0265', '5% Discount Off Overall Bill', '5% Discount', 'images/1518168662.jpeg', NULL, '2018-02-09 08:31:56', '2018-02-09 08:31:56', '2018-02-08', '2019-02-08', '5', 'Affinity Premium', NULL),
(159, 'TLR0279', '10% Discount  Off Purchases From N5000 Upward', '10% Discount', 'images/1518691489.jpeg', NULL, '2018-02-15 09:47:41', '2018-02-15 09:47:41', '2018-02-12', '2019-02-12', '10', 'Affinity Essence', NULL),
(160, 'SIO0278', '10% Discount Off Purchases From N500.000-1m\n15% Discount Off Purchases From N1.5m-5m', '15% Discount', 'images/1518691727.jpeg', NULL, '2018-02-15 09:52:36', '2018-02-15 09:52:36', '2018-02-12', '2019-02-12', '15', 'Affinity Premium', NULL),
(161, 'CHE0277', '25% Discount On All Room Types Exclusive Of Drinks And Food', '25% Discount', 'images/1518692024.jpeg', NULL, '2018-02-15 09:55:10', '2018-02-15 09:55:10', '2018-02-12', '2019-02-12', '25', 'Affinity Premium', NULL),
(162, 'PRI0276', '10% Discount On The Total Bill', '10% Discount', 'images/1518692170.jpeg', NULL, '2018-02-15 09:57:09', '2018-02-15 09:57:09', '2018-02-12', '2019-02-12', '10', 'Affinity Premium', NULL),
(163, 'DHP0272', '10% Discount Off Pharmaceuticals And 5% Discount On Others', '10% Discount', 'images/1518692294.jpeg', NULL, '2018-02-15 10:03:18', '2018-02-15 10:03:18', '2018-02-13', '2019-02-13', '10', 'Affinity Essence', NULL),
(164, 'AMA0275', '10% Discount On Pharmaceuticals And 5% On Others', '10% Discount', 'images/1518692659.jpeg', NULL, '2018-02-15 10:05:23', '2018-02-15 10:05:23', '2018-02-13', '2019-02-13', '10', 'Affinity Essence', NULL),
(165, 'ANG0274', '30% Discount  Off All Room Rates', '30% Discount', 'images/1518692816.jpeg', NULL, '2018-02-15 10:09:53', '2018-02-15 10:09:53', '2018-02-09', '2019-02-09', '30', 'Affinity Premium', NULL),
(166, 'FAC0287', '30% Discount Off Services From N10,000 And Above.5% Discount Off Product Purchases Above N50,000', '30% Discount', 'images/1518707996.png', NULL, '2018-02-15 14:21:41', '2018-02-15 14:25:02', '2018-02-08', '2019-02-08', '30', 'Affinity Premium', NULL),
(167, 'CLE0286', '15% Discount Off Massage,Facials,Body Scrub,Steam Bath,Sauna,Pedicure & Manicure And Complete Spa Treatment.15% Discount Off Bridal Makeup Training And Spa Training', '15%', 'images/1518708384.png', NULL, '2018-02-15 14:29:41', '2018-02-15 14:29:41', '2018-02-05', '2019-02-05', '15', 'Affinity Premium', NULL),
(168, 'HAV0285', '10% Discount Off All Rooms And Hall Charge.Free Swimming Gym And Continental Breakfast For One.', '10% Discount', 'images/1518708666.png', NULL, '2018-02-15 14:33:42', '2018-02-15 14:33:42', '2018-02-06', '2019-02-06', '10', 'Affinity Premium', NULL),
(169, 'OGE0284', '15% Discount Off Makeover', '15% Discount', 'images/1518708899.png', NULL, '2018-02-15 14:35:46', '2018-02-15 14:35:46', '2018-02-09', '2019-02-09', '15', 'Affinity Premium', NULL),
(170, 'CAL0283', '10% Discount From The Total Bill', '10% Discount', 'images/1518709009.png', NULL, '2018-02-15 14:37:55', '2018-02-15 14:37:55', '2018-02-08', '2019-02-08', '10', 'Affinity Premium', NULL),
(171, 'RUB0282', '10% Discount On Drinks Above N100,000', '10% Discount', 'images/1518709130.png', NULL, '2018-02-15 14:39:53', '2018-02-15 14:39:53', '2018-02-06', '2019-02-06', '10', 'Affinity Premium', NULL),
(172, 'GHA0281', '10% Discount On Makeup And Skincare (Spa & Body Treatment', '10% Discount', 'images/1518709261.png', NULL, '2018-02-15 14:42:14', '2018-02-15 14:42:14', '2018-02-06', '2019-02-06', '10', 'Affinity Essence', NULL),
(173, 'RUT0280', '15% Discount', '15% Discount', 'images/1518709446.jpeg', NULL, '2018-02-15 14:44:50', '2018-02-26 08:35:52', '2018-02-08', '2019-02-08', '15', 'Affinity Essence', NULL),
(174, 'NAO0288', '15% Discount On Girls Dresses', '15% Discount', 'images/1518710117.png', NULL, '2018-02-15 14:56:33', '2018-02-22 08:29:46', '2018-02-12', '2019-02-12', '15', 'Affinity Essence', NULL),
(175, 'RYD0294', '20% Discount On Monthly,Yearly And Quarterly Plans', '20% Discount', 'images/1518780997.jpeg', NULL, '2018-02-16 10:38:11', '2018-02-22 08:06:20', '2018-02-15', '2019-02-15', '25', 'Affinity Premium', NULL),
(176, 'OLC0293', '25% Discount On Dressmaking & Tailoring Training.\n30% Discount On 6 Months Basic-Advance And 4 Months Basics-Intermediate.\nN50,000 off purchase of N150,000 and above.', '25% Discount', 'images/1518781148.png', NULL, '2018-02-16 10:47:42', '2018-02-20 15:18:21', '2018-02-11', '2019-02-11', '25', 'Affinity Premium', NULL),
(177, 'VIL0292', '15% Discount on all rooms which include breakfast and Internet', '15% Discount', 'images/1518781755.png', NULL, '2018-02-16 10:55:19', '2018-02-20 12:13:29', '2018-02-14', '2019-02-14', '15', 'Affinity Essence', NULL),
(178, 'GOR0291', '20% Discount On Bridal Makeup(Traditional And White Wedding) From N100,000 And Above.15% Discount On Everyday (Walk In) And Accessories Above N5000', '20%', 'images/1518782306.jpeg', NULL, '2018-02-16 11:02:06', '2018-02-16 11:02:06', '2018-02-12', '2019-02-12', '20', 'Affinity Essence', NULL),
(179, 'PUR0289', '10% Discount On All Iterm In Store', '10% Discount', 'images/1518783654.png', NULL, '2018-02-16 11:22:51', '2018-02-16 11:22:51', '2018-02-12', '2019-02-12', '10', 'Affinity Premium', NULL),
(180, 'BLE0290', '20% Discount On The Total Bill', '20% Discount', 'images/1518783850.png', NULL, '2018-02-16 11:25:19', '2018-02-16 11:25:19', '2018-02-09', '2019-02-09', '20', 'Affinity Essence', NULL),
(181, 'OLA0296', '5% Discount On Baby Clothes,Wardrop,Bicycle,Baby Bath,Baby Cream,Walker,Baby Mat And Hangers', '5%', 'images/1518788659.png', NULL, '2018-02-16 12:47:46', '2018-02-16 12:47:46', '2018-02-09', '2019-02-09', '5', 'Affinity Essence', NULL),
(182, 'SMO0295', '10% Discount On Smoothies And Fresh Juices.\n15% Discount On Chicken Sauce And Ripe Plantain, Smoky Shrimps Pasta Salad.', '15% Discount', 'images/1518788936.png', NULL, '2018-02-16 12:52:41', '2018-02-20 13:27:42', '2017-12-11', '2018-12-11', '15', 'Affinity Essence', NULL),
(183, 'BRA0299', '15% Discount On The Total Bill', '15% Discount', 'images/1518793228.jpeg', NULL, '2018-02-16 14:03:45', '2018-02-16 14:03:45', '2018-01-17', '2019-01-17', '15', 'Affinity Premium', NULL),
(184, 'ZAL0297', '15% Discount On Every Iterm', '15% Discount', 'images/1518793474.png', NULL, '2018-02-16 14:05:18', '2018-02-16 14:05:18', '2018-02-06', '2019-02-06', '15', 'Affinity Premium', NULL),
(185, 'PAR0298', '10% Discount On All Products', '10% Discount', 'images/1518793576.jpeg', NULL, '2018-02-16 14:07:15', '2018-02-16 14:07:15', '2018-02-06', '2019-02-06', '10', 'Affinity Essence', NULL),
(186, 'IFC0300', '15% Discount On Bi-Annual Subscriptions And Above', '15% Discount', 'images/1519047764.jpeg', NULL, '2018-02-19 12:43:30', '2018-02-19 12:43:30', '2018-01-23', '2019-01-23', '15', 'Affinity Essence', NULL),
(187, 'IFC0301', '15% Discount On Bi-Annual Subscriptions And Above', '15% Discount', 'images/1519048250.jpeg', NULL, '2018-02-19 12:51:14', '2018-02-19 12:51:14', '2018-01-23', '2019-01-23', '15', 'Affinity Essence', NULL),
(188, 'SS0303', '35% Discount On All Room Categories. Free Room Upgrades On Weekends (Upon Availability)', '35% Discount', 'images/1519206860.jpeg', NULL, '2018-02-21 08:54:59', '2018-02-21 08:54:59', '2018-02-08', '2019-02-08', '35', 'Affinity Premium', NULL),
(189, 'SSD0302', '10% Discount On Dental Procedures', '10% Discount', 'images/1519297861.png', NULL, '2018-02-21 09:06:51', '2018-02-22 10:11:03', '2018-02-18', '2019-02-18', '10', 'Affinity Premium', NULL),
(190, 'CPR0304', '10% Discount On Repairs And Accessories', '10% Discount', 'images/1519400254.png', NULL, '2018-02-23 14:37:43', '2018-02-23 14:37:43', '2018-02-20', '2019-02-20', '10', 'Affinity Essence', NULL),
(191, 'CPR0305', '10% Discount On Repairs And Accessories', '10% Discount', 'images/1519400678.png', NULL, '2018-02-23 14:44:23', '2018-02-23 14:44:56', '2018-02-20', '2019-02-20', '10', 'Affinity Essence', NULL),
(192, 'CPR0306', '10% Discount On Repairs And Accessories', '10% Discount', 'images/1519400751.png', NULL, '2018-02-23 14:46:01', '2018-02-23 14:46:01', '2018-02-20', '2019-02-20', '10', 'Affinity Essence', NULL),
(193, 'CPR0307', '10% Discount On Repairs And Accessories', '10% Discount', 'images/1519401614.png', NULL, '2018-02-23 15:00:29', '2018-02-23 15:00:29', '2018-02-20', '2019-02-20', '10', 'Affinity Essence', NULL),
(194, 'ANG0309', '15% Discount On Orders Above N5,000', '15% Discount', 'images/1519401779.jpeg', NULL, '2018-02-23 15:04:21', '2018-02-23 15:04:21', '2018-02-19', '2019-02-19', '15', 'Affinity Essence', NULL),
(195, 'ANG0308', '15% Discount On Orders Above N5,000', '15% Discount', 'images/1519401925.jpeg', NULL, '2018-02-23 15:06:13', '2018-02-23 15:06:13', '2018-02-19', '2019-02-19', '15', 'Affinity Essence', NULL),
(196, 'PEL0310', '5% Discount Off All Items Purchased', '5% Discount', 'images/1519634159.jpeg', NULL, '2018-02-26 07:37:12', '2018-02-26 07:37:12', '2018-02-22', '2019-02-22', '5', 'Affinity Premium', NULL),
(197, 'HOU0312', '10% Discount On Everything', '10% Discount', 'images/1519636318.jpeg', NULL, '2018-02-26 08:12:56', '2018-02-26 08:12:56', '2018-02-21', '2019-02-21', '10', 'Affinity Essence', NULL),
(198, 'TRL0073', '15% Discount On Rooms And Halls', '15% Discount', 'images/1519638108.jpeg', NULL, '2018-02-26 08:42:43', '2018-02-26 08:42:43', '2018-02-15', '2019-02-15', '15', 'Affinity Premium', NULL),
(199, 'RED0119', '10% Discount Only On Food', '10% Discount', 'images/1519638660.jpeg', NULL, '2018-02-26 09:01:45', '2018-04-12 09:53:09', '2018-02-22', '2019-02-22', '10', 'Affinity Premium', NULL),
(200, 'IT1415', '10% Only On Food', '10%', 'images/1519639492.jpeg', NULL, '2018-02-26 09:05:36', '2018-02-26 09:05:36', '2018-01-11', '2019-01-11', '10', 'Affinity Premium', NULL),
(201, 'SOU0313', '10% Discount Of All Food Purchases', '10% Discount', 'images/1519651600.png', NULL, '2018-02-26 12:29:06', '2018-02-26 12:30:05', '2018-02-04', '2019-02-04', '10', 'Affinity Essence', NULL),
(202, 'JUL0314', '10% Discount On School Training', '10% Discount', 'images/1519652703.png', NULL, '2018-02-26 12:47:26', '2018-02-27 09:57:14', '2018-02-13', '2019-02-13', '10', 'Affinity Essence', NULL),
(203, 'MOT0315', '5% - 10% Discount On All Items', '5% Discount', 'images/1519653719.png', NULL, '2018-02-26 13:03:20', '2018-02-27 09:57:53', '2018-02-07', '2019-02-07', '5', 'Affinity Essence', NULL),
(204, 'FAR0273', '50% Discount On Fruits, Veggies, Smoothies And Juices.15% Discount On Livestock.', '50% Discount', 'images/1519654055.png', NULL, '2018-02-26 13:10:07', '2018-02-26 13:10:07', '2018-02-13', '2019-02-13', '50', 'Affinity Premium', NULL),
(205, 'CRA0316', '15% Discount On Orders Above N30,000. 20% Discount On Orders Above N50,000. Get Free Side Dishes When You Order Pots Of Soups And Stews.', '15% Discount', 'images/1519655226.png', NULL, '2018-02-26 13:30:27', '2018-02-27 10:14:31', '2018-02-06', '2019-02-06', '15', 'Affinity Essence', NULL),
(206, 'TKB0317', '15% Discount On N500K Purchases And Above. 20% Discount On N1m Purchases And Above', '15% Discount', 'images/1519656297.jpeg', NULL, '2018-02-26 13:46:33', '2018-02-27 09:50:06', '2017-12-06', '2018-12-06', '15', 'Affinity Essence', NULL),
(207, 'EXT0078', '25% Off Food And Drinks', '25% Discount', 'images/1519657012.jpeg', NULL, '2018-02-26 13:58:16', '2018-02-26 13:58:16', '2017-10-04', '2018-10-04', '25', 'Affinity Essence', NULL),
(208, 'DBS0318', '20% Discount On Makeup Services', '20% Discount', 'images/1519660254.png', NULL, '2018-02-26 14:52:14', '2018-02-26 14:52:14', '2018-02-06', '2019-02-06', '20', 'Affinity Essence', NULL),
(209, 'ARS0319', '15% Discount On Cakes, Desserts, Small Chops, etc', '15% Discount', 'images/1519661194.png', NULL, '2018-02-26 15:07:56', '2018-02-27 09:55:48', '2018-02-06', '2019-02-06', '15', 'Affinity Essence', NULL),
(210, 'BLU0320', '5% Discount On 10 Suits. 5% Discount On 20 Shirts. 5% Discount On 10 Trousers. 7% Discount On 10 Igbo Kaftan. N450 Off Purchases Of N9,000 Or Higher.', '5% Discount', 'images/1519719310.jpeg', NULL, '2018-02-27 07:20:55', '2018-02-27 10:28:55', '2017-10-17', '2018-10-17', '5', 'Affinity Essence', NULL),
(211, 'BOL0321', '10% Discount On Makeover And Gele', '10% Discount', 'images/1519722569.png', NULL, '2018-02-27 08:12:46', '2018-02-27 08:12:46', '2017-11-22', '2018-11-22', '10', 'Affinity Essence', NULL),
(212, 'LIF0322', '15% Discount On General Events, Photoshoot, Photobook And Videography.', '15% Discount', 'images/1519724772.png', NULL, '2018-02-27 08:48:16', '2018-02-27 08:48:16', '2018-02-06', '2019-02-06', '15', 'Affinity Essence', NULL),
(213, 'BLU0323', '5% Discount On 10 Suits. 5% Discount On 20 Shirts. 5% Discount On 10 Trousers. 7% Discount On 10 Igbo Kaftan. N450 Off Purchases Of N9,000 Or Higher.', '5% Discount', 'images/1519726126.jpeg', NULL, '2018-02-27 09:10:00', '2018-02-27 10:29:16', '2017-11-17', '2018-11-17', '5', 'Affinity Essence', NULL),
(214, 'BLU0324', '5% Discount On 10 Suits. 5% Discount On 20 Shirts. 5% Discount On 10 Trousers. 7% Discount On 10 Igbo Kaftan. N450 Off Purchases Of N9,000 Or Higher.', '5% Discount', 'images/1519726586.jpeg', NULL, '2018-02-27 09:17:50', '2018-02-27 10:29:40', '2017-11-17', '2018-11-17', '5', 'Affinity Essence', NULL),
(215, 'KON0311', '10% Discount On Every Item In Store', '10% Discount', 'images/1519727393.png', NULL, '2018-02-27 09:30:50', '2018-02-27 09:30:50', '2018-02-22', '2019-02-22', '10', 'Affinity Premium', NULL),
(216, 'MOT0325', '5% - 10% Discount Applies To All Items.', '5% Discount', 'images/1519729646.png', NULL, '2018-02-27 10:08:36', '2018-02-27 10:08:36', '2018-02-07', '2019-02-07', '5', 'Affinity Essence', NULL),
(217, 'TJB0326', '20% Discount On Spa And Products', '20% Discount', 'images/1519736312.png', NULL, '2018-02-27 11:59:57', '2018-02-27 11:59:57', '2018-02-05', '2019-02-05', '20', 'Affinity Essence', NULL),
(218, 'STU0327', '15% Discount Off On Each Visit', '15% Discount', 'images/1519742505.png', NULL, '2018-02-27 13:43:03', '2018-02-27 13:43:03', '2018-01-30', '2019-01-30', '15', 'Affinity Premium', NULL),
(219, 'BOD0328', '10% Discount on Gym Membership.', '10% Discount', 'images/1519821485.jpeg', NULL, '2018-02-28 11:40:01', '2018-04-18 07:39:09', '2018-04-12', '2019-04-12', '10', 'Affinity Essence', NULL),
(220, 'DOR0329', '20% Discount On Makeup Services Done Only At Any Of Our Studios', '20% Discount', 'images/1519824010.jpeg', NULL, '2018-02-28 12:42:35', '2018-02-28 12:42:35', '2017-06-08', '2018-06-08', '10', 'Affinity Premium', NULL),
(221, 'FRE209', '10% Discount On Total Bill When You Dine', '10% Discount', 'images/1519826532.jpeg', NULL, '2018-02-28 13:04:04', '2018-03-01 14:49:31', '2018-03-01', '2019-03-01', '10', 'Affinity Premium', NULL),
(222, 'WBS0330', 'N500 Off Every Purchase Worth N5000', '-N500 Off Every Purchase Worth N5000', NULL, NULL, '2018-02-28 13:33:34', '2018-03-16 14:40:53', '2018-02-28', '2019-02-28', 'Money Off', 'Affinity Essence', NULL),
(223, 'VIC0039', '25% Discount On Accommodation Food And Beverage', '25% Discount', 'images/1523971596.jpeg', NULL, '2018-02-28 13:38:32', '2018-04-17 12:26:37', '2018-03-01', '2019-03-01', '25', 'Affinity Premium', NULL),
(224, 'CRO0331', '20% Discount', '20% Discount', 'images/1519829992.jpeg', NULL, '2018-02-28 14:01:17', '2018-02-28 14:01:17', '2017-05-17', '2018-05-17', '20', 'Affinity Premium', NULL),
(225, 'SIL207', '50% Discount With Breakfast And Weekends A Bottle Of Wine. N10,000 Is When You Book All In Advance.', '50% Discount', 'images/1519831111.jpeg', NULL, '2018-02-28 14:21:23', '2018-04-12 13:16:34', '2018-02-28', '2019-02-28', '50', 'Affinity Premium', NULL),
(226, 'TER144', '10% Discount', '10% Discount', 'images/1519831626.jpeg', NULL, '2018-02-28 14:28:01', '2018-03-01 14:53:22', '2018-03-01', '2019-03-01', '10', 'Affinity Premium', NULL),
(227, 'DAV210', '10% Discount On All Purchases', '10% Discount', 'images/1519832084.png', NULL, '2018-02-28 14:35:47', '2018-04-12 13:41:15', '2018-03-01', '2019-03-01', '10', 'Affinity Premium', NULL),
(228, 'DAV213', '10% Discount On All Purchases', '10% Discount', 'images/1519832257.jpeg', NULL, '2018-02-28 14:38:17', '2018-04-12 13:45:22', '2018-03-01', '2019-03-01', '10', 'Affinity Premium', NULL),
(229, 'ZEN0074', '10% Discount On Bills Above N10,000', '10% Discount On Bills Above N10,000', 'images/1519892441.jpeg', NULL, '2018-03-01 07:22:01', '2018-04-18 11:22:53', '2018-03-01', '2019-03-01', '10', 'Affinity Essence', NULL),
(230, 'WOO0332', '10% Discount On Every Item', '10% Discount', 'images/1519894046.jpeg', NULL, '2018-03-01 07:48:20', '2018-03-16 14:54:39', '2018-03-01', '2019-03-01', '10', 'Affinity Essence', NULL),
(236, 'THE0337', 'FOR THE BAR-Spend N10k -  N20k  Get 1.5% Discount . Spend  N20k - N50k  Get  2.5% Discount.Spend  N50k - N100k Get 5% Discount. Spend N100k - 200k Get 5.5% Discount . Spend N1m Bill 10% Discount Except On Specials. \nFOR HALL - Imperial Hall N3m Discount is N500k. Sky View Hall N2.5m Discount is N500k. Conference Hall N1.5m Discount N500k', '10% Discount', 'images/1521730226.png', NULL, '2018-03-22 14:07:14', '2018-03-22 14:07:14', '2018-03-13', '2019-03-13', '10', 'Affinity Premium', NULL),
(232, 'SLI0088', '10% Discount On All Syrups, Liqueurs, Sauces And Purees', '10% Discount', 'images/1519918841.jpeg', NULL, '2018-03-01 14:46:15', '2018-04-12 14:23:13', '2018-03-01', '2019-03-01', '10', 'Affinity Essence', NULL),
(233, 'KID0333', '10% Off Baby Gadgets And Clothing, Free Water Bottle On Complete Back To School Goods(Bag, Socks,Lunch Bag, Singlets, Pants,ect). Special Back To School Promo End Of Year Promo.', '10% Discount', 'images/1521213217.png', NULL, '2018-03-16 14:12:25', '2018-03-16 14:13:39', '2018-02-14', '2019-02-14', '10', 'Affinity Essence', NULL),
(234, 'NUE0334', '10% Discount On Every Item Purchased', '10%', 'images/1521213341.jpeg', NULL, '2018-03-16 14:16:40', '2018-03-16 14:16:40', '2018-03-03', '2019-03-03', '10', 'Affinity Essence', NULL),
(235, 'CCL0335', '10% Discount On Vitra Sanitary From N1.5 Million And Above. 5% Discount On Creavit Sanitary From N1.5 Million And Above.', '10% Discount', 'images/1521213523.jpeg', NULL, '2018-03-16 14:24:26', '2018-03-16 15:00:17', '2018-03-05', '2019-03-05', '10', 'Affinity Premium', NULL),
(237, 'CEL0336', '15% Discount for procedures with prosthesis and appliances / 20% Discount for other procedures(without prosthesis/appliances).Patients self help kit for orthodontic cases only it includes toothbrush, interdental brush, floss, dental waxes, timer', '20% Discount', 'images/1521793874.png', NULL, '2018-03-23 07:33:08', '2018-04-12 10:04:30', '2017-11-01', '2018-12-01', '20', 'Affinity Essence', NULL),
(238, 'FLA0250', '20% Discount On Pre - Orders On Clothings ( Made To Measure)', '20% Discount', 'images/1521804762.png', NULL, '2018-03-23 10:34:30', '2018-03-23 10:34:30', '2018-01-17', '2019-01-17', '20', 'Affinity Essence', NULL),
(239, 'FLA0338', '20% Discount  Pre - Orders On Clothings (Made To Measure)', '20% Discount', 'images/1521805777.png', NULL, '2018-03-23 10:51:28', '2018-03-23 10:51:28', '2018-01-17', '2019-01-17', '20', 'Affinity Essence', NULL),
(240, 'ULT0340', '15% Discount For Any Dental Procedure', '15% Discount', 'images/1522226684.jpeg', NULL, '2018-03-28 07:45:46', '2018-03-28 07:45:46', '2018-03-27', '2019-03-21', '15', 'Affinity Essence', NULL),
(241, 'ULT0339', '15% Discount For Any Dental Procedure', '15% Discount', 'images/1522226873.jpeg', NULL, '2018-03-28 07:48:43', '2018-03-28 07:48:43', '2018-03-27', '2019-03-27', '15', 'Affinity Essence', NULL);
INSERT INTO `merchant_offers` (`offer_id`, `merchant_id`, `details`, `tagline`, `avatar`, `period`, `created_at`, `updated_at`, `start_date`, `end_date`, `offer_name`, `target_members`, `offer_type`) VALUES
(242, 'WEA0341', '5% Discount On Minimun Purchase Of Goods Worth N150,000.00', '5% Discount', 'images/1522228412.png', NULL, '2018-03-28 08:16:06', '2018-04-12 09:41:26', '2018-03-27', '2019-03-27', '5', 'Affinity Premium', NULL),
(243, 'WES0342', '10% Discount On All Items On Display At Our Retail Stores Except Caps. N10,000.00 Off For Purchases N50,000.00 And Above', '10% Discount', 'images/1522325414.jpeg', NULL, '2018-03-29 11:14:30', '2018-04-12 09:41:01', '2017-11-16', '2018-11-16', '10', 'Affinity Essence', NULL),
(244, 'PUR0343', '10% Discount On All Services And Health Screenings Except Specialist Consultations', '10% Discount', 'images/1522327658.jpeg', NULL, '2018-03-29 11:48:31', '2018-04-12 09:42:43', '2018-01-30', '2019-01-30', '10', 'Affinity Premium', NULL),
(245, 'WES0344', '10% Discount On All Items On Display At Our Retail Stores Except Caps. N10,000.00 Off For Purchases N50,000.00 And Above', '10% Discount', 'images/1523605936.jpeg', NULL, '2018-04-13 06:54:26', '2018-04-13 06:54:26', '2017-11-16', '2018-11-16', '10', 'Affinity Premium', NULL),
(246, 'SKI0345', '15% Discount On Any Beauty Personal Care Products. Introduce 2 New Clients To Us And Get 30% Discount Off Your Next Purchase.', '15% Discount', 'images/1523953561.jpeg', NULL, '2018-04-17 07:31:02', '2018-04-17 07:31:02', '2018-03-18', '2019-03-18', '15', 'Affinity Essence', NULL),
(247, 'HIS0346', '10% Discount On All Our Services, Out Patient Diagnostic(Ultrasounds And Laboratory Services)', '10% Discount', 'images/1524039896.jpeg', NULL, '2018-04-18 07:29:57', '2018-05-20 14:15:36', '05/20/2018 12:00 AM ', ' 05/20/2018 11:59 PM', '10', 'Essence Premium Luxe', NULL),
(248, 'NEG0076', '5% Discount On Items On Sale Or Returns. 8% On Negro Gallery Art Work', '8% Discount On Negro Art Work', NULL, NULL, '2018-04-18 11:51:35', '2018-04-18 11:51:35', '2018-03-01', '2019-04-01', '8', 'Affinity Premium', NULL),
(249, 'IRO0249', 'yay!', '10% off everything', 'images/1525958095.jpeg', NULL, '2018-05-10 12:15:03', '2018-05-20 08:32:57', '05/20/2018 12:00 AM ', ' 05/21/2018 12:00 AM', '10', 'Premium Business X Luxe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_04_16_000000_create_users_table', 1),
(3, '2017_04_16_140231_create_groups_table', 1),
(4, '2017_04_16_140256_create_reviews_table', 1),
(5, '2017_04_16_140346_create_events_table', 1),
(6, '2017_04_16_140420_create_transactions_table', 1),
(7, '2017_04_16_140450_create_merchant_offers_table', 1),
(8, '2017_04_16_140533_create_merchants_table', 1),
(9, '2017_04_16_140555_create_customers_table', 1),
(10, '2017_04_16_140827_create_merchant_categories_table', 1),
(11, '2017_04_16_141515_create_interests_table', 1),
(12, '2017_04_16_143632_create_user_groups', 1),
(13, '2017_04_16_150209_create_customer_interest_table', 1),
(14, '2017_04_16_151147_create_customer_group_table', 1),
(15, '2017_04_16_154931_create_customer_event_table', 1),
(16, '2017_10_05_110533_admins', 2),
(17, '2017_10_05_131156_create_admins_table', 3),
(18, '2017_10_05_145301_add_city_to_admins', 4),
(19, '2017_10_06_100404_locations', 5),
(20, '2017_10_06_100544_create_locations_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_shoppings`
--

CREATE TABLE `personal_shoppings` (
  `id` int(11) NOT NULL,
  `product` varchar(300) DEFAULT NULL,
  `budget` varchar(100) DEFAULT NULL,
  `expected_expiry_date` varchar(100) DEFAULT NULL,
  `details` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_shoppings`
--

INSERT INTO `personal_shoppings` (`id`, `product`, `budget`, `expected_expiry_date`, `details`, `created_at`, `updated_at`, `in_charge`, `status`, `phone`) VALUES
(1, 'Gucci Red Stilettos', '180000', NULL, 'Very high and shinny', '2018-05-20 18:51:00', '2018-05-20 17:51:49', 'Superadmin', 'In Progress', '08189888899');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL,
  `period` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `membership` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `period`, `amount`, `membership`) VALUES
(1, 'Monthly', '2000', 'Affinity Essence'),
(2, 'Yearly', '20000', 'Affinity Essence'),
(3, 'Yearly', '50000', 'Affinity Premium'),
(4, 'Monthly', '5000', 'Affinity Premium'),
(11, 'Monthly', '10000', 'Affinity Luxe'),
(12, 'Yearly', '100000', 'Affinity Luxe');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rating_id` int(10) UNSIGNED NOT NULL,
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `merchant_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rating_id`, `customer_id`, `rating`, `merchant_id`, `created_at`, `updated_at`) VALUES
(1, 'YIN-0001', 100, 'MR-000010', '2017-11-08 11:06:55', '2017-11-08 11:06:55'),
(2, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-08 11:38:29', '2017-11-08 11:38:29'),
(3, 'YIN-0001', 60, 'MR-00MX15-Ori', '2017-11-08 11:39:19', '2017-11-08 11:39:19'),
(4, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-08 11:44:39', '2017-11-08 11:44:39'),
(5, 'YIN-0001', 60, 'MR-00MX15-Ori', '2017-11-08 11:45:42', '2017-11-08 11:45:42'),
(6, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-08 11:47:20', '2017-11-08 11:47:20'),
(7, 'YIN-0001', 60, 'MR-00MX15-Ori', '2017-11-08 11:49:11', '2017-11-08 11:49:11'),
(8, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-08 11:49:44', '2017-11-08 11:49:44'),
(9, 'YIN-0001', 60, 'MR-00MX15-Ori', '2017-11-08 11:51:35', '2017-11-08 11:51:35'),
(10, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-16 11:51:43', '2017-11-16 11:51:43'),
(11, 'YIN-0001', 40, 'MR-00MX15-Ori', '2017-11-16 11:52:45', '2017-11-16 11:52:45'),
(12, 'YIN-0001', 80, 'MR-00MX15-Ori', '2017-11-16 12:03:15', '2017-11-16 12:03:15'),
(13, 'MAR0021', 80, 'MR-00MX15-Ori', '2017-11-21 12:28:31', '2017-11-21 12:28:31'),
(14, 'NIC-0011', 80, 'O', '2017-11-22 10:39:43', '2017-11-22 10:39:43'),
(15, 'NIC-0011', 60, 'MR-00MX15-Ori', '2017-11-22 13:44:06', '2017-11-22 13:44:06'),
(16, 'NIC-0011', 60, 'MR-00MX15-Ori', '2017-11-22 13:53:26', '2017-11-22 13:53:26'),
(17, 'ANT0022', 80, 'MR-00MX15-Ori', '2017-11-24 11:21:31', '2017-11-24 11:21:31'),
(18, 'ANT0022', 80, 'MR-00MX15-Ori', '2017-11-27 13:37:01', '2017-11-27 13:37:01'),
(19, 'ANT0022', 80, 'MR-00MX15-Ori', '2017-11-27 13:38:19', '2017-11-27 13:38:19'),
(20, 'ANT0022', 80, 'MR-00MX15-Ori', '2017-12-04 16:37:57', '2017-12-04 16:37:57'),
(21, 'ANT0022', 100, 'MR-00MX15-Ori', '2017-12-04 16:37:58', '2017-12-04 16:37:58'),
(42, 'GEO0012', 60, 'MR-00MX15-Ori', '2017-12-10 20:41:49', '2017-12-10 20:41:49'),
(41, 'ANT0022', 60, 'LA 0019', '2017-12-05 14:52:39', '2017-12-05 14:52:39'),
(40, 'WBG-5382', 100, 'ZEN0074', '2017-12-04 18:05:35', '2017-12-04 18:05:35'),
(39, 'WBG-6733', 80, 'TRU0075', '2017-12-04 18:01:29', '2017-12-04 18:01:29'),
(55, 'EDR-0009', 80, 'ANG0051', '2018-01-30 19:31:38', '2018-01-30 19:31:38'),
(54, 'EDR-0009', 100, 'ANG0051', '2018-01-25 15:15:29', '2018-01-25 15:15:29'),
(53, 'EDR-0009', 80, 'ANG0051', '2018-01-17 11:51:17', '2018-01-17 11:51:17'),
(52, 'EDR-0009', 80, 'BIL0087', '2018-01-15 09:45:10', '2018-01-15 09:45:10'),
(51, 'EDR-0009', 60, 'BIL0087', '2018-01-12 17:33:11', '2018-01-12 17:33:11'),
(50, 'EDR-0009', 80, 'BIL0087', '2018-01-12 13:22:25', '2018-01-12 13:22:25'),
(49, 'EDR-0009', 80, 'BIL0087', '2018-01-06 21:52:28', '2018-01-06 21:52:28'),
(48, 'ANT0022', 80, 'ANG0051', '2017-12-12 08:26:03', '2017-12-12 08:26:03'),
(47, 'ANT0022', 80, 'BIL0087', '2017-12-11 11:13:34', '2017-12-11 11:13:34'),
(46, 'ANT0022', 80, 'BIL0087', '2017-12-11 11:12:11', '2017-12-11 11:12:11'),
(45, 'WBG-6756', 80, '1512655263', '2017-12-11 07:18:50', '2017-12-11 07:18:50'),
(44, 'GEO0012', 60, 'MR-00MX15-Ori', '2017-12-10 20:44:40', '2017-12-10 20:44:40'),
(43, 'GEO0012', 60, 'MR-00MX15-Ori', '2017-12-10 20:43:08', '2017-12-10 20:43:08'),
(56, 'EDR-0009', 80, 'ANG0051', '2018-02-07 12:14:14', '2018-02-07 12:14:14'),
(57, 'EDR-0009', 100, 'ANG0051', '2018-02-09 08:43:50', '2018-02-09 08:43:50'),
(58, 'EDR-0009', 60, 'BIL0087', '2018-02-23 11:16:22', '2018-02-23 11:16:22'),
(59, 'NOG0033', 60, 'BIL0087', '2018-02-23 11:32:01', '2018-02-23 11:32:01'),
(60, '', 100, 'LA0019', '2018-02-26 13:29:46', '2018-02-26 13:29:46'),
(61, 'WBG-8362', 100, 'DJ 0021', '2018-02-26 13:31:06', '2018-02-26 13:31:06'),
(62, 'EDR-0009', 80, 'ANG0051', '2018-02-27 12:44:48', '2018-02-27 12:44:48'),
(63, 'EDR-0009', 80, 'ANG0051', '2018-02-27 12:44:48', '2018-02-27 12:44:48'),
(64, 'EDR-0009', 80, 'BIL0087', '2018-03-09 09:00:14', '2018-03-09 09:00:14'),
(65, 'EDR-0009', 40, 'ALB0264', '2018-03-19 07:51:54', '2018-03-19 07:51:54'),
(66, 'EDR-0009', 100, 'STU0327', '2018-03-21 10:56:19', '2018-03-21 10:56:19'),
(67, 'EDR-0009', 100, 'GLE0080', '2018-03-21 11:27:49', '2018-03-21 11:27:49'),
(68, 'EDR-0009', 100, 'ALB0264', '2018-03-21 11:51:18', '2018-03-21 11:51:18'),
(69, 'EDR-0009', 100, 'ALB0264', '2018-03-21 11:51:18', '2018-03-21 11:51:18'),
(70, 'EDR-0009', 100, 'BEN0263', '2018-03-21 12:27:37', '2018-03-21 12:27:37'),
(71, 'EDR-0009', 40, 'BIL0087', '2018-03-24 11:19:47', '2018-03-24 11:19:47'),
(72, 'EDR-0009', 100, 'JBR188', '2018-03-27 12:25:41', '2018-03-27 12:25:41'),
(73, 'EDR-0009', 100, 'NEX202', '2018-03-27 12:44:55', '2018-03-27 12:44:55'),
(74, 'EDR-0009', 100, 'WEA197', '2018-03-27 13:12:58', '2018-03-27 13:12:58'),
(75, 'EDR-0009', 100, 'WAS215', '2018-03-27 13:36:31', '2018-03-27 13:36:31'),
(76, 'EDR-0009', 100, 'MAS221', '2018-03-28 11:23:46', '2018-03-28 11:23:46'),
(77, 'EDR-0009', 100, 'SSD0302', '2018-03-28 12:27:33', '2018-03-28 12:27:33'),
(78, 'EDR-0009', 100, 'IDE198', '2018-03-28 13:23:33', '2018-03-28 13:23:33'),
(79, 'EDR-0009', 100, 'IDE198', '2018-03-28 13:23:34', '2018-03-28 13:23:34'),
(80, 'EDR-0009', 100, 'FLA0250', '2018-03-28 14:13:25', '2018-03-28 14:13:25'),
(81, 'EDR-0009', 40, 'SOU0313', '2018-03-29 13:05:19', '2018-03-29 13:05:19'),
(82, 'EDR-0009', 100, 'NAO0288', '2018-03-31 09:18:43', '2018-03-31 09:18:43'),
(83, 'EDR-0009', 100, 'NAO0288', '2018-03-31 09:18:43', '2018-03-31 09:18:43'),
(84, 'EDR-0009', 100, 'IFC0246', '2018-04-04 12:21:19', '2018-04-04 12:21:19'),
(85, 'EDR-0009', 100, 'SOU0313', '2018-04-06 08:42:17', '2018-04-06 08:42:17'),
(86, 'EDR-0009', 60, 'ANG0051', '2018-04-09 14:38:28', '2018-04-09 14:38:28'),
(87, 'EDR-0009', 40, 'GRA0248', '2018-04-11 14:08:15', '2018-04-11 14:08:15'),
(88, 'EDR-0009', 60, 'JAM0247', '2018-04-13 12:02:26', '2018-04-13 12:02:26'),
(89, 'EDR-0009', 60, 'JAM0247', '2018-04-13 12:04:01', '2018-04-13 12:04:01'),
(90, 'EDR-0009', 60, 'NAT0251', '2018-04-13 13:43:18', '2018-04-13 13:43:18'),
(91, 'EDR-0009', 60, 'NAT0251', '2018-04-13 13:44:32', '2018-04-13 13:44:32'),
(92, 'EDR-0009', 60, 'MAR0243', '2018-04-13 15:04:40', '2018-04-13 15:04:40'),
(93, 'EDR-0009', 60, 'MAR0243', '2018-04-13 15:05:48', '2018-04-13 15:05:48'),
(94, 'EDR-0009', 60, 'IND0071', '2018-04-16 12:12:36', '2018-04-16 12:12:36'),
(95, 'EDR-0009', 60, 'NAT0251', '2018-04-16 13:38:15', '2018-04-16 13:38:15'),
(96, 'EDR-0009', 80, 'LEK0241', '2018-04-17 09:25:19', '2018-04-17 09:25:19'),
(97, 'EDR-0009', 100, 'LEK0241', '2018-04-17 09:26:15', '2018-04-17 09:26:15'),
(98, 'EDR-0009', 20, 'LEK0241', '2018-04-17 09:40:03', '2018-04-17 09:40:03'),
(99, 'EDR-0009', 80, 'LEK0241', '2018-04-17 09:41:23', '2018-04-17 09:41:23'),
(100, 'EDR-0009', 100, 'YBC0242', '2018-04-17 10:57:05', '2018-04-17 10:57:05'),
(101, 'EDR-0009', 80, 'DOU0244', '2018-04-17 11:58:33', '2018-04-17 11:58:33'),
(102, 'EDR-0009', 80, 'DOU0244', '2018-04-17 11:59:19', '2018-04-17 11:59:19'),
(103, 'EDR-0009', 60, 'BOD0328', '2018-04-17 14:06:08', '2018-04-17 14:06:08'),
(104, 'EDR-0009', 60, 'BOD0328', '2018-04-17 14:08:14', '2018-04-17 14:08:14'),
(105, 'EDR-0009', 60, 'BOD0328', '2018-04-17 14:15:11', '2018-04-17 14:15:11'),
(106, 'EDR-0009', 60, 'BOD0328', '2018-04-17 14:15:57', '2018-04-17 14:15:57'),
(107, 'EDR-0009', 60, 'WIN0044', '2018-04-17 15:28:06', '2018-04-17 15:28:06'),
(108, 'EDR-0009', 80, 'WIN0044', '2018-04-17 15:28:57', '2018-04-17 15:28:57'),
(109, 'EDR-0009', 100, 'WIN0044', '2018-04-17 15:56:03', '2018-04-17 15:56:03'),
(110, 'EDR-0009', 100, 'WIN0044', '2018-04-17 16:06:21', '2018-04-17 16:06:21'),
(111, 'EDR-0009', 100, 'IRO0249', '2018-05-03 13:35:03', '2018-05-03 13:35:03'),
(112, 'EDR-0009', 20, 'IRO0249', '2018-05-03 13:37:08', '2018-05-03 13:37:08'),
(113, 'EDR-0009', 60, 'NEG0076', '2018-05-04 14:51:32', '2018-05-04 14:51:32'),
(114, 'EDR-0009', 80, 'NEG0076', '2018-05-09 07:51:05', '2018-05-09 07:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `customer_id` varchar(30) DEFAULT NULL,
  `start_date` varchar(30) DEFAULT NULL,
  `end_date` varchar(30) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `membership` varchar(30) DEFAULT NULL,
  `payment_by` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Period` varchar(30) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `customer_id`, `start_date`, `end_date`, `amount`, `membership`, `payment_by`, `created_at`, `Period`, `updated_at`) VALUES
(1, 'NIC-0011', '2017-12-11', '2018-12-10', '20000', 'Affinity Prive', NULL, '2017-12-04 14:12:43', NULL, '2018-05-22 10:40:48'),
(2, 'ANT0022', '2017-11-11', '2018-11-10', '20000', 'Affinity Prive', 'Self', '2017-11-28 15:36:48', NULL, '2018-05-22 10:40:48'),
(3, 'AD-000MA1', '2017-11-24', NULL, '10000', 'Affinity Luxe', 'self', '2017-11-24 12:38:51', 'Monthly', '2018-05-22 10:40:48'),
(4, 'GEO0012', '2017-11-24', '2018-11-24', '10000', 'Affinity Luxe', NULL, '2017-12-10 21:39:22', 'Monthly', '2018-05-22 10:40:48'),
(5, 'BEY-0010', '2017-12-04', '2018-01-03', '1000000', 'Affinity Luxe', 'self', '2017-12-04 10:17:53', NULL, '2018-05-22 10:40:48'),
(6, 'BLA0020', NULL, NULL, '10000', 'Affinity Luxe', 'AD-000MA1', '2017-12-04 11:49:41', 'Monthly', '2018-05-22 10:40:48'),
(7, 'JAM0013', '2018-12-04', NULL, '100000', 'Affinity Luxe', 'AD-000MA1', '2017-12-04 12:06:33', 'Yearly', '2018-05-22 10:40:48'),
(8, 'MAR0021', '2017-12-04', '2018-01-03', '200000', 'Affinity Essence', 'self', '2017-12-04 12:27:13', 'Monthly', '2018-05-22 10:40:48'),
(9, 'EDR-0009', '2017-11-11', '2018-11-10', '20000', 'Affinity Prive', 'Self', '2017-12-15 13:42:37', 'Monthly', '2018-05-22 10:40:48'),
(10, 'EDR-0009', '2018-02-23', '2019-02-23', '10000000', 'Affinity Luxe', 'self', '2018-02-23 11:11:29', 'Yearly', '2018-05-22 10:40:48'),
(11, 'NOG0033', '2018-02-23', '2019-02-23', '10000000', 'Affinity Luxe', 'self', '2018-02-23 11:21:04', 'Yearly', '2018-05-22 10:40:48'),
(12, 'OLA0032', '2018-02-23', '2018-03-25', '500000', 'Affinity Premium', 'self', '2018-02-23 13:35:29', 'Monthly', '2018-05-22 10:40:48'),
(13, 'EDR-0009', '2018-05-09', '2018-06-08', '200000', 'Affinity Essence', 'self', '2018-05-09 08:06:47', 'Monthly', '2018-05-22 10:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `customer_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden` int(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `customer_id`, `merchant_id`, `amount`, `remarks`, `created_at`, `updated_at`, `transaction_type`, `offer`, `offer_id`, `hidden`) VALUES
(1, 'YIN-0001', 'MR-00MX15-Ori', '2000', NULL, '2017-11-08 11:34:27', '2017-11-08 11:34:27', '1', NULL, '1', NULL),
(2, 'YIN-0001', 'MR-00MX15-Ori', '2000', NULL, '2017-11-08 11:35:38', '2017-11-08 11:35:38', '1', NULL, '1', NULL),
(3, 'YIN-0001', 'MR-00MX15-Ori', '80000', 'Very good', '2017-11-08 11:37:19', '2017-11-08 11:37:19', '1', NULL, '1', NULL),
(4, 'YIN-0001', 'MR-00MX15-Ori', '120000', 'Thumb up to u guys', '2017-11-08 11:38:19', '2017-11-08 11:38:19', '1', NULL, '1', NULL),
(5, 'YIN-0001', 'MR-00MX15-Ori', '120000', NULL, '2017-11-08 11:49:40', '2017-11-08 11:49:40', '1', NULL, '1', NULL),
(6, 'YIN-0001', 'MR-00MX15-Ori', '20000', NULL, '2017-11-16 11:50:53', '2017-11-16 11:50:53', '1', NULL, '1', NULL),
(7, 'YIN-0001', 'MR-00MX15-Ori', '20000', NULL, '2017-11-16 11:52:03', '2017-11-16 11:52:03', '1', NULL, '1', NULL),
(8, 'YIN-0001', 'MR-00MX15-Ori', '20000', 'Cool', '2017-11-16 11:52:42', '2017-11-16 11:52:42', '1', '', '1', NULL),
(9, 'YIN-0001', 'MR-00MX15-Ori', '50000', 'Nice one', '2017-11-16 12:02:59', '2017-11-16 12:02:59', '10% Discount on every room', '10', '1', NULL),
(10, 'NIC-0011', 'O', '5000', NULL, '2017-11-22 10:39:03', '2017-11-22 10:39:03', '10% Discount on every room', '10', '1', NULL),
(11, 'NIC-0011', 'MR-00MX15-Ori', '50000', NULL, '2017-11-22 13:44:03', '2017-11-22 13:44:03', '10% Discount on every room', '10', '1', NULL),
(12, 'NIC-0011', 'MR-00MX15-Ori', '80000', NULL, '2017-11-22 13:53:21', '2017-11-22 13:53:21', '10% Discount on every room', '10', '1', NULL),
(13, 'ANT0022', 'MR-00MX15-Ori', '60000', NULL, '2017-11-24 11:21:22', '2017-11-24 11:21:22', '10% Discount on every room', '10', '1', NULL),
(14, 'ANT0022', 'MR-00MX15-Ori', '50000', NULL, '2017-11-27 13:29:47', '2017-11-27 13:29:47', '10% Discount on every room', '10', '1', NULL),
(15, 'ANT0022', 'MR-00MX15-Ori', '70000', NULL, '2017-11-27 13:36:40', '2017-11-27 13:36:40', '10% Discount on every room', '10', '1', NULL),
(16, 'ANT0022', 'MR-00MX15-Ori', '50000', NULL, '2017-11-27 13:38:13', '2017-11-27 13:38:13', '10% Discount on every room', '10', '1', NULL),
(17, 'ANT0022', 'LA 0019', '80000', NULL, '2017-12-05 14:52:27', '2017-12-05 14:52:27', '10 percent', '10', '11', NULL),
(26, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-16 09:45:17', '2017-12-27 20:13:58', '15% Discount', '15', '70', 1),
(19, 'ANT0022', 'BIL0087', '60000', NULL, '2017-12-11 11:12:05', '2017-12-11 11:12:05', '15% Discount', '15', '70', NULL),
(20, 'ANT0022', 'BIL0087', '50000', NULL, '2017-12-11 11:13:29', '2017-12-11 11:13:29', '15% Discount', '15', '70', NULL),
(21, 'ANT0022', 'ANG0051', '50000', NULL, '2017-12-11 14:34:27', '2017-12-11 14:34:27', '20% discount on accomodation', '15', '40', NULL),
(22, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-12 06:35:23', '2018-01-05 20:58:42', '15% Discount', '15', '70', 1),
(23, 'ANT0022', 'ANG0051', '60000', NULL, '2017-12-12 08:25:46', '2017-12-12 08:25:46', '20% discount on accomodation', '20', '40', NULL),
(24, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-12 10:45:12', '2017-12-19 13:54:08', '15% Discount', '15', '70', 1),
(25, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-15 13:17:47', '2017-12-18 15:11:13', '15% Discount', '15', '70', 1),
(27, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-17 19:07:50', '2017-12-18 15:10:59', '15% Discount', '15', '70', 1),
(28, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-18 15:11:56', '2018-01-16 18:59:53', '15% Discount', '15', '70', 1),
(29, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-19 13:32:30', '2018-01-30 20:13:03', '15% Discount', '15', '70', 1),
(30, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-20 14:49:58', '2018-01-31 15:35:31', '15% Discount', '15', '70', 1),
(31, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-20 15:44:43', '2018-01-12 17:31:40', '15% Discount', '15', '70', 1),
(32, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-26 06:05:10', '2017-12-27 20:13:34', '15% Discount', '15', '70', 1),
(33, 'EDR-0009', 'BIL0087', '10000', NULL, '2017-12-29 16:35:44', '2017-12-29 16:36:33', '15% Discount', '15', '70', 1),
(34, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-01-04 08:11:40', '2018-01-12 17:31:33', '15% Discount', '15', '70', 1),
(35, 'EDR-0009', 'BIL0087', '10000', 'Good', '2018-01-06 21:52:19', '2018-01-12 17:31:23', '15% Discount', '15', '70', 1),
(36, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-01-12 13:22:16', '2018-01-12 17:29:59', '70', NULL, '70', 1),
(37, 'EDR-0009', 'BIL0087', '1000', 'Went well', '2018-01-12 17:32:45', '2018-01-30 20:14:16', '15% Discount', '15', '70', 1),
(38, 'EDR-0009', 'BIL0087', '2000', NULL, '2018-01-12 17:34:39', '2018-01-30 20:14:08', '15% Discount', '15', '70', 1),
(39, 'EDR-0009', 'BIL0087', '2000', NULL, '2018-01-12 17:34:40', '2018-02-07 12:13:14', '15% Discount', '15', '70', 1),
(40, 'EDR-0009', 'BIL0087', '20000', NULL, '2018-01-15 08:13:42', '2018-02-05 17:45:33', '70', NULL, '70', 1),
(41, 'EDR-0009', 'BIL0087', '30000', NULL, '2018-01-15 09:08:23', '2018-02-05 17:45:50', NULL, NULL, '70', 1),
(42, 'EDR-0009', 'BIL0087', '30000', NULL, '2018-01-15 09:19:57', '2018-02-05 17:45:57', NULL, NULL, '70', 1),
(43, 'EDR-0009', 'BIL0087', '30000', NULL, '2018-01-15 09:21:39', '2018-02-05 17:46:04', NULL, NULL, '70', 1),
(44, 'EDR-0009', 'BIL0087', '30000', NULL, '2018-01-15 09:24:30', '2018-02-05 17:46:08', '15% Discount', NULL, '70', 1),
(45, 'EDR-0009', 'BIL0087', '30000', NULL, '2018-01-15 09:42:13', '2018-02-05 16:10:55', '15% Discount', '15', '70', 1),
(46, 'EDR-0009', 'BIL0087', '40000', 'Not bad', '2018-01-15 09:45:00', '2018-01-28 08:41:00', '15% Discount', '15', '70', 1),
(47, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-01-15 13:06:42', '2018-02-05 16:11:18', '15% Discount', '15', '70', 1),
(48, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-01-15 13:06:42', '2018-01-28 08:40:59', '15% Discount', '15', '70', 1),
(49, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-01-15 13:08:17', '2018-03-09 11:31:31', '15% Discount', '15', '70', 1),
(50, 'EDR-0009', 'BIL0087', '5000', NULL, '2018-01-16 13:36:34', '2018-05-09 08:50:27', '15% Discount', '15', '70', 1),
(51, 'EDR-0009', 'BIL0087', '5000', NULL, '2018-01-16 15:21:59', '2018-03-12 07:57:29', '15% Discount', '15', '70', 1),
(52, 'EDR-0009', 'BIL0087', '4000', NULL, '2018-01-16 15:25:40', '2018-01-28 08:40:27', '15% Discount', '15', '70', 1),
(53, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-01-17 11:50:57', '2018-01-17 11:53:31', '20% discount on accomodation', '20', '40', 1),
(54, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-01-22 12:21:26', '2018-05-09 09:07:50', '15% Discount', '15', '70', 1),
(55, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-01-22 12:25:47', '2018-01-28 08:40:11', '15% Discount', '15', '70', 1),
(56, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-01-25 12:58:57', '2018-01-26 01:33:16', '20% discount on accomodation', '20', '40', 1),
(57, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-01-25 12:59:53', '2018-05-09 09:08:18', '20% discount on accomodation', '20', '40', 1),
(58, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-01-25 15:15:06', '2018-01-26 01:33:38', '20% discount on accomodation', '20', '40', 1),
(59, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-01-27 14:47:17', '2018-01-28 08:39:56', '20% discount on accomodation', '20', '40', 1),
(60, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-01-27 14:47:42', '2018-01-27 14:53:03', '20% discount on accomodation', '20', '40', 1),
(61, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-01-29 10:54:15', '2018-01-30 09:45:03', '15% Discount', '15', '70', 1),
(62, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-01-30 19:31:31', '2018-01-30 20:14:31', '20% discount on accomodation', '20', '40', 1),
(63, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-02-07 12:14:08', '2018-02-07 12:14:08', '20% discount on accomodation', '20', '40', NULL),
(64, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-02-08 08:38:14', '2018-02-08 08:38:14', '15% Discount', '15', '70', NULL),
(65, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-02-09 08:43:44', '2018-02-09 08:43:44', '20% discount on accomodation', '20', '40', NULL),
(66, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-02-12 15:52:48', '2018-02-12 15:52:48', '15% Discount', '15', '70', NULL),
(67, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-02-12 15:53:00', '2018-02-12 15:53:00', '15% Discount', '15', '70', NULL),
(68, 'EDR-0009', 'BIL0087', '1000', NULL, '2018-02-12 15:53:13', '2018-02-12 15:53:13', '15% Discount', '15', '70', NULL),
(69, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-02-15 12:27:36', '2018-02-15 12:27:36', '15% Discount', '15', '70', NULL),
(70, 'EDR-0009', 'BIL0087', '10000', 'Test', '2018-02-23 11:16:10', '2018-02-23 11:17:11', '15% Discount', '15', '70', 1),
(71, 'NOG0033', 'BIL0087', '2000', 'E dey try', '2018-02-23 11:31:44', '2018-02-23 11:32:15', '15% Discount', '15', '70', 1),
(72, 'NOG0033', 'IFC0301', '8000', NULL, '2018-02-23 11:36:39', '2018-02-23 11:38:53', '15% Discount', '15', '187', 1),
(73, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-02-27 12:44:39', '2018-02-27 12:44:39', '20% discount on accomodation', '20', '40', NULL),
(74, 'EDR-0009', 'ANG0051', '50000', NULL, '2018-02-27 12:45:18', '2018-02-27 12:45:18', '20% discount on accomodation', '20', '40', NULL),
(75, 'EDR-0009', 'IFC0254', '10000', NULL, '2018-03-06 11:43:24', '2018-03-06 11:43:24', '15% Discount', '15', '129', NULL),
(76, 'EDR-0009', 'WBS0330', '10000', NULL, '2018-03-07 11:55:19', '2018-03-07 11:55:19', NULL, NULL, '222', NULL),
(77, 'EDR-0009', 'TLR0279', '10000', NULL, '2018-03-07 12:00:46', '2018-03-07 12:00:46', '10% Discount', '10', '159', NULL),
(78, 'EDR-0009', 'TER144', '10000', NULL, '2018-03-09 08:40:05', '2018-03-09 08:40:05', '10% Discount', '10', '226', NULL),
(79, 'EDR-0009', 'TER144', '10000', NULL, '2018-03-09 08:40:35', '2018-03-09 08:40:35', '10% Discount', '10', '226', NULL),
(80, 'EDR-0009', 'BIL0087', '7000', 'good', '2018-03-09 08:56:02', '2018-03-09 09:00:14', '15% Discount', '15', '70', NULL),
(81, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-03-09 11:31:12', '2018-03-09 11:31:12', '15% Discount', '15', '70', NULL),
(82, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-03-12 07:54:02', '2018-03-12 07:54:02', '15% Discount', '15', '70', NULL),
(83, 'EDR-0009', 'ALB0264', '10000', 'Test', '2018-03-19 07:51:29', '2018-03-19 07:51:54', '15% Discount', '15', '148', NULL),
(84, 'EDR-0009', 'ALB0264', '10000', NULL, '2018-03-19 07:52:57', '2018-03-19 07:52:57', '15% Discount', '15', '148', NULL),
(85, 'EDR-0009', 'COC127', '50000', NULL, '2018-03-19 10:55:11', '2018-03-19 10:55:11', '15%', '15', '120', NULL),
(86, 'EDR-0009', 'MAN0233', '5000', NULL, '2018-03-20 10:28:46', '2018-03-20 10:28:46', '10%', '10', '117', NULL),
(87, 'EDR-0009', 'MAN0233', '5000', NULL, '2018-03-20 10:30:52', '2018-03-20 10:30:52', '10%', '10', '117', NULL),
(88, 'EDR-0009', 'MOH0079', '10000', NULL, '2018-03-20 10:54:42', '2018-03-20 10:54:42', '10 percent', '10', '13', NULL),
(89, 'EDR-0009', 'ADE0234', '10000', NULL, '2018-03-20 11:12:03', '2018-03-20 11:12:03', '10% Discount', '10', '118', NULL),
(90, 'EDR-0009', 'ADE0234', '10000', NULL, '2018-03-20 11:17:32', '2018-03-20 11:17:32', '10% Discount', '10', '118', NULL),
(91, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-03-20 12:02:15', '2018-03-20 12:02:15', '15% Discount', '15', '70', NULL),
(92, 'EDR-0009', 'CHE0277', '50000', NULL, '2018-03-20 12:35:28', '2018-03-20 12:35:28', '25% Discount', '25', '161', NULL),
(93, 'EDR-0009', 'CPR0304', '8000', NULL, '2018-03-20 12:56:16', '2018-03-20 12:56:16', '10% Discount', '10', '190', NULL),
(94, 'EDR-0009', 'CPR0304', '8000', NULL, '2018-03-20 12:56:16', '2018-03-20 12:56:16', '10% Discount', '10', '190', NULL),
(95, 'EDR-0009', 'STU0327', '10000', NULL, '2018-03-21 10:56:10', '2018-03-21 10:56:10', '15% Discount', '15', '218', NULL),
(96, 'EDR-0009', 'GLE0080', '60000', NULL, '2018-03-21 11:24:36', '2018-03-21 11:24:36', '15% Discount', '15', '82', NULL),
(97, 'EDR-0009', 'ALB0264', '25000', NULL, '2018-03-21 11:51:02', '2018-03-21 11:51:02', '15% Discount', '15', '148', NULL),
(98, 'EDR-0009', 'BEN0263', '50000', NULL, '2018-03-21 12:27:29', '2018-03-21 12:27:29', '40% Discount', '40', '149', NULL),
(99, 'EDR-0009', 'CRO0331', '10000', NULL, '2018-03-23 10:25:14', '2018-03-23 10:25:14', '20% Discount', '20', '224', NULL),
(100, 'EDR-0009', 'CRO0331', '10000', NULL, '2018-03-23 10:25:15', '2018-03-23 10:25:15', '20% Discount', '20', '224', NULL),
(101, 'EDR-0009', 'CRO0331', '10000', NULL, '2018-03-23 10:25:15', '2018-03-23 10:25:15', '20% Discount', '20', '224', NULL),
(102, 'EDR-0009', 'CRO0331', '10000', NULL, '2018-03-23 10:25:15', '2018-03-23 10:25:15', '20% Discount', '20', '224', NULL),
(103, 'EDR-0009', 'SHA0085', '5000', NULL, '2018-03-23 11:26:06', '2018-03-23 11:26:06', '30%', '30', '87', NULL),
(104, 'EDR-0009', 'BLI0068', '10000', NULL, '2018-03-23 12:21:28', '2018-03-23 12:21:28', '15% off all dental procedures', '15', '57', NULL),
(105, 'EDR-0009', 'BLI0068', '10000', NULL, '2018-03-23 12:21:29', '2018-03-23 12:21:29', '15% off all dental procedures', '15', '57', NULL),
(106, 'EDR-0009', 'BLI0068', '10000', NULL, '2018-03-23 12:21:29', '2018-03-23 12:21:29', '15% off all dental procedures', '15', '57', NULL),
(107, 'EDR-0009', 'BLE0106', '10000', NULL, '2018-03-23 13:57:06', '2018-03-23 13:57:06', '15% Discount', '15', '76', NULL),
(108, 'EDR-0009', 'BLE0106', '10000', NULL, '2018-03-23 13:59:04', '2018-03-23 13:59:04', '15% Discount', '15', '76', NULL),
(109, 'EDR-0009', 'PHO0261', '5000', NULL, '2018-03-23 14:45:56', '2018-03-23 14:45:56', '15% Discount', '15', '151', NULL),
(110, 'EDR-0009', 'PHO0261', '5000', NULL, '2018-03-23 14:45:57', '2018-03-23 14:45:57', '15% Discount', '15', '151', NULL),
(111, 'EDR-0009', 'PHO0261', '5000', NULL, '2018-03-23 14:45:58', '2018-03-23 14:45:58', '15% Discount', '15', '151', NULL),
(112, 'EDR-0009', 'BIL0087', '4000', 'Testing', '2018-03-24 11:18:18', '2018-03-24 11:19:47', '15% Discount', '15', '70', NULL),
(113, 'EDR-0009', 'BLU0320', '5000', NULL, '2018-03-26 11:15:47', '2018-03-26 11:15:47', '5% Discount', '5', '210', NULL),
(114, 'EDR-0009', 'BLU0320', '5000', NULL, '2018-03-26 11:22:31', '2018-03-26 11:22:31', '5% Discount', '5', '210', NULL),
(115, 'EDR-0009', 'DEE0084', '10000', NULL, '2018-03-26 11:47:09', '2018-03-26 11:47:09', '20% Discount', '40', '61', NULL),
(116, 'EDR-0009', 'DEE0084', '10000', NULL, '2018-03-26 11:47:10', '2018-03-26 11:47:10', '20% Discount', '40', '61', NULL),
(117, 'EDR-0009', 'DHP0272', '10000', NULL, '2018-03-26 12:54:46', '2018-03-26 12:54:46', '10% Discount', '10', '163', NULL),
(118, 'EDR-0009', 'DHP0272', '10000', NULL, '2018-03-26 12:54:46', '2018-03-26 12:54:46', '10% Discount', '10', '163', NULL),
(119, 'EDR-0009', 'JBR188', '70000', NULL, '2018-03-27 12:25:35', '2018-03-27 12:25:35', '15% Discount', '15', '78', NULL),
(120, 'EDR-0009', 'NEX202', '6000', NULL, '2018-03-27 12:44:35', '2018-03-27 12:44:35', '20% Discount', '20', '96', NULL),
(121, 'EDR-0009', 'WEA197', '200000', NULL, '2018-03-27 13:12:34', '2018-03-27 13:12:34', '20% Discount', '20', '88', NULL),
(122, 'EDR-0009', 'WAS215', '10000', NULL, '2018-03-27 13:36:23', '2018-03-27 13:36:23', '20% Discount', '20', '112', NULL),
(123, 'EDR-0009', 'WAS215', '10000', NULL, '2018-03-27 13:38:55', '2018-03-27 13:38:55', '20% Discount', '20', '112', NULL),
(124, 'EDR-0009', 'JAS0239', '70000', NULL, '2018-03-27 14:20:00', '2018-03-27 14:20:00', '15%', '15', '124', NULL),
(125, 'EDR-0009', 'ZAL0297', '10000', NULL, '2018-03-28 08:34:55', '2018-03-28 08:34:55', '15% Discount', '15', '184', NULL),
(126, 'EDR-0009', 'ZAL0297', '10000', NULL, '2018-03-28 08:34:56', '2018-03-28 08:34:56', '15% Discount', '15', '184', NULL),
(127, 'EDR-0009', 'LIF0322', '100000', NULL, '2018-03-28 08:37:04', '2018-03-28 08:37:04', '15% Discount', '15', '212', NULL),
(128, 'EDR-0009', 'LIF0322', '100000', NULL, '2018-03-28 08:51:06', '2018-03-28 08:51:06', '15% Discount', '15', '212', NULL),
(129, 'EDR-0009', 'GHA0281', '10000', NULL, '2018-03-28 09:08:55', '2018-03-28 09:08:55', '10% Discount', '10', '172', NULL),
(130, 'EDR-0009', 'HAV0285', '15000', NULL, '2018-03-28 09:36:52', '2018-03-28 09:36:52', '10% Discount', '10', '168', NULL),
(131, 'EDR-0009', 'OLA0296', '10000', NULL, '2018-03-28 09:51:23', '2018-03-28 09:51:23', '5%', '5', '181', NULL),
(132, 'EDR-0009', 'ZAL0297', '10000', NULL, '2018-03-28 10:37:14', '2018-03-28 10:37:14', '15% Discount', '15', '184', NULL),
(133, 'EDR-0009', 'RUB0282', '200000', NULL, '2018-03-28 11:20:56', '2018-03-28 11:20:56', '10% Discount', '10', '171', NULL),
(134, 'EDR-0009', 'MAS221', '3000', NULL, '2018-03-28 11:23:42', '2018-03-28 11:23:42', '20% Discount', '30', '106', NULL),
(135, 'EDR-0009', 'MAS221', '5000', NULL, '2018-03-28 11:34:28', '2018-03-28 11:34:28', '20% Discount', '30', '106', NULL),
(136, 'EDR-0009', 'SSD0302', '30000', NULL, '2018-03-28 12:23:34', '2018-03-28 12:23:34', '10% Discount', '10', '189', NULL),
(137, 'EDR-0009', 'GOR0291', '100000', NULL, '2018-03-28 13:00:10', '2018-03-28 13:00:10', '20%', '20', '178', NULL),
(138, 'EDR-0009', 'GOR0291', '100000', NULL, '2018-03-28 13:01:10', '2018-03-28 13:01:10', '20%', '20', '178', NULL),
(139, 'EDR-0009', 'IDE198', '100000', NULL, '2018-03-28 13:23:25', '2018-03-28 13:23:25', '20% Discount', '20', '93', NULL),
(140, 'EDR-0009', 'CAR0270', '10000', NULL, '2018-03-28 13:59:58', '2018-03-28 13:59:58', '20% Discount', '20', '153', NULL),
(141, 'EDR-0009', 'CAR0270', '10000', NULL, '2018-03-28 14:00:43', '2018-03-28 14:00:43', '20% Discount', '20', '153', NULL),
(142, 'EDR-0009', 'FLA0250', '60000', NULL, '2018-03-28 14:13:18', '2018-03-28 14:13:18', '20% Discount', '20', '238', NULL),
(143, 'EDR-0009', 'SIO0278', '10000', NULL, '2018-03-28 15:39:14', '2018-03-28 15:39:14', '15% Discount', '15', '160', NULL),
(144, 'EDR-0009', 'GHA0281', '10000', NULL, '2018-03-29 10:23:42', '2018-03-29 10:23:42', '10% Discount', '10', '172', NULL),
(145, 'EDR-0009', 'SOU0313', '5000', NULL, '2018-03-29 13:00:37', '2018-03-29 13:00:37', '10% Discount', '10', '201', NULL),
(146, 'EDR-0009', 'SOU0313', '5000', 'Test', '2018-03-29 13:04:56', '2018-03-29 13:05:19', '10% Discount', '10', '201', NULL),
(147, 'EDR-0009', 'CAL0283', '10000', NULL, '2018-03-31 08:22:51', '2018-03-31 08:22:51', '10% Discount', '10', '170', NULL),
(148, 'EDR-0009', 'NAO0288', '10000', NULL, '2018-03-31 09:17:07', '2018-03-31 09:17:07', '15% Discount', '15', '174', NULL),
(149, 'EDR-0009', 'NAO0288', '10000', NULL, '2018-03-31 09:18:21', '2018-03-31 09:18:21', '15% Discount', '15', '174', NULL),
(150, 'EDR-0009', 'NAO0288', '10000', NULL, '2018-03-31 09:18:25', '2018-03-31 09:18:25', '15% Discount', '15', '174', NULL),
(151, 'EDR-0009', 'NAO0288', '10000', NULL, '2018-03-31 09:31:09', '2018-03-31 09:31:09', '15% Discount', '15', '174', NULL),
(152, 'EDR-0009', 'NAO0288', '10000', NULL, '2018-03-31 09:39:10', '2018-03-31 09:39:10', '15% Discount', '15', '174', NULL),
(153, 'EDR-0009', 'NAO0288', '20000', NULL, '2018-03-31 09:45:58', '2018-03-31 09:45:58', '15% Discount', '15', '174', NULL),
(154, 'EDR-0009', 'NAO0288', '20000', NULL, '2018-03-31 09:45:59', '2018-03-31 09:45:59', '15% Discount', '15', '174', NULL),
(155, 'EDR-0009', 'IFC0246', '40000', NULL, '2018-04-04 12:18:20', '2018-04-04 12:18:20', '15% Discount', '15', '142', NULL),
(156, 'EDR-0009', 'IFC0246', '40000', NULL, '2018-04-04 12:18:20', '2018-04-04 12:18:20', '15% Discount', '15', '142', NULL),
(157, 'EDR-0009', 'SOU0313', '1000', 'Good', '2018-04-06 08:41:57', '2018-04-06 08:42:17', '10% Discount', '10', '201', NULL),
(158, 'EDR-0009', 'BIL0087', '5000', NULL, '2018-04-06 10:22:33', '2018-04-06 10:22:33', '15% Discount', '15', '70', NULL),
(159, 'EDR-0009', 'BIL0087', '5000', NULL, '2018-04-06 10:23:06', '2018-04-06 10:23:06', '15% Discount', '15', '70', NULL),
(160, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-04-09 14:32:37', '2018-04-09 14:32:37', '20% discount on accomodation', '20', '40', NULL),
(161, 'EDR-0009', 'ANG0051', '10000', NULL, '2018-04-09 14:33:20', '2018-04-09 14:33:20', '20% discount on accomodation', '20', '40', NULL),
(162, 'EDR-0009', 'ANG0051', '15000', 'Very good', '2018-04-09 14:38:14', '2018-04-09 14:38:28', '20% discount on accomodation', '20', '40', NULL),
(163, 'EDR-0009', 'VIC0039', '10000', NULL, '2018-04-10 12:36:27', '2018-04-10 12:36:27', '25% Discount', '25', '223', NULL),
(164, 'EDR-0009', 'VIC0039', '10000', NULL, '2018-04-10 12:36:27', '2018-04-10 12:36:27', '25% Discount', '25', '223', NULL),
(165, 'EDR-0009', 'TAL0245', '50000', NULL, '2018-04-10 14:15:37', '2018-04-10 14:15:37', '10% Discount', '10', '145', NULL),
(166, 'EDR-0009', 'THE0062', '1000000', NULL, '2018-04-10 15:09:26', '2018-04-10 15:09:26', '10% discount', '10', '51', NULL),
(167, 'EDR-0009', 'HOD0061', '100000', NULL, '2018-04-11 12:46:17', '2018-04-11 12:46:17', '10 Discount', '10', '101', NULL),
(168, 'EDR-0009', 'GRA0248', '100000', 'Test', '2018-04-11 14:07:45', '2018-04-11 14:08:15', '25% Discount', '25', '134', NULL),
(169, 'EDR-0009', 'GRA0248', '20000', NULL, '2018-04-11 14:09:11', '2018-04-11 14:09:11', '25% Discount', '25', '134', NULL),
(170, 'EDR-0009', 'BIL0087', '10000', NULL, '2018-04-13 10:28:42', '2018-04-13 10:28:42', '15% Discount', '15', '70', NULL),
(171, 'EDR-0009', 'JAM0247', '10000', 'Training', '2018-04-13 12:01:58', '2018-04-13 12:02:26', '20% Discount', '25', '135', NULL),
(172, 'EDR-0009', 'JAM0247', '5000', 'Training 2', '2018-04-13 12:03:48', '2018-04-13 12:04:01', '20% Discount', '25', '135', NULL),
(173, 'EDR-0009', 'NAT0251', '10000', 'Training 1', '2018-04-13 13:42:51', '2018-04-13 13:43:18', '10% Discount', '10', '132', NULL),
(174, 'EDR-0009', 'NAT0251', '5000', 'Training 2', '2018-04-13 13:44:00', '2018-04-13 13:44:32', '10% Discount', '10', '132', NULL),
(175, 'EDR-0009', 'MAR0243', '100000', 'Training 1', '2018-04-13 15:04:13', '2018-04-13 15:04:40', '10%', '10', '147', NULL),
(176, 'EDR-0009', 'MAR0243', '20000', 'Training 2', '2018-04-13 15:05:32', '2018-04-13 15:05:48', '10%', '10', '147', NULL),
(177, 'EDR-0009', 'IND0071', '10000', 'Training', '2018-04-16 12:12:16', '2018-04-16 12:12:36', '10% off shoes, 5% off all items in the store minus accessories', '-10', '7', NULL),
(178, 'EDR-0009', 'NAT0251', '10000', 'Training 3', '2018-04-16 13:37:56', '2018-04-16 13:38:15', '10% Discount', '10', '132', NULL),
(179, 'EDR-0009', 'LEK0241', '20000', 'Training 1', '2018-04-17 09:24:53', '2018-04-17 09:25:19', '20%', '20', '126', NULL),
(180, 'EDR-0009', 'LEK0241', '30000', 'Training 2', '2018-04-17 09:26:03', '2018-04-17 09:26:15', '20%', '20', '126', NULL),
(181, 'EDR-0009', 'LEK0241', '20000', 'Training 3', '2018-04-17 09:39:38', '2018-04-17 09:40:03', '20%', '20', '126', NULL),
(182, 'EDR-0009', 'LEK0241', '30000', 'Training 4', '2018-04-17 09:41:12', '2018-04-17 09:41:23', '20%', '20', '126', NULL),
(183, 'EDR-0009', 'YBC0242', '20000', 'Training 1', '2018-04-17 10:56:17', '2018-04-17 10:57:05', '10% Discount', '10', '128', NULL),
(184, 'EDR-0009', 'DOU0244', '20000', 'Training 1', '2018-04-17 11:58:09', '2018-04-17 11:58:33', '10% Discount', '10', '146', NULL),
(185, 'EDR-0009', 'DOU0244', '30000', 'Training 2', '2018-04-17 11:59:07', '2018-04-17 11:59:19', '10% Discount', '10', '146', NULL),
(186, 'EDR-0009', 'BOD0328', '20000', 'Training 1', '2018-04-17 14:05:38', '2018-04-17 14:06:08', '10% Discount', '10', '219', NULL),
(187, 'EDR-0009', 'BOD0328', '30000', 'Training 2', '2018-04-17 14:07:56', '2018-04-17 14:08:15', '10% Discount', '10', '219', NULL),
(188, 'EDR-0009', 'BOD0328', '20000', 'Training 3', '2018-04-17 14:14:37', '2018-04-17 14:15:11', '10% Discount', '10', '219', NULL),
(189, 'EDR-0009', 'BOD0328', '40000', 'Training 4', '2018-04-17 14:15:46', '2018-04-17 14:15:57', '10% Discount', '10', '219', NULL),
(190, 'EDR-0009', 'WIN0044', '10000', 'Training 1', '2018-04-17 15:27:35', '2018-04-17 15:28:06', '10 percent', '10', '33', NULL),
(191, 'EDR-0009', 'WIN0044', '30000', 'Training 2', '2018-04-17 15:28:44', '2018-04-17 15:28:57', '10 percent', '10', '33', NULL),
(192, 'EDR-0009', 'WIN0044', '10000', 'Training 7', '2018-04-17 15:55:24', '2018-04-17 15:56:03', '10 percent', '10', '33', NULL),
(193, 'EDR-0009', 'WIN0044', '50000', 'Training 8', '2018-04-17 16:05:28', '2018-04-17 16:06:21', '10 percent', '10', '33', NULL),
(194, 'EDR-0009', 'SS0303', '38500', NULL, '2018-04-25 11:33:07', '2018-04-25 11:33:07', '35% Discount', '35', '188', NULL),
(195, 'EDR-0009', 'IRO0249', '20000', 'Training 1', '2018-05-03 13:34:22', '2018-05-03 13:35:03', '15% Discount', '15', '144', NULL),
(196, 'EDR-0009', 'IRO0249', '12500', NULL, '2018-05-03 13:36:32', '2018-05-03 13:36:32', '15% Discount', '15', '144', NULL),
(197, 'EDR-0009', 'IRO0249', '12500', 'Training 2', '2018-05-03 13:36:52', '2018-05-03 13:37:08', '15% Discount', '15', '144', NULL),
(198, 'EDR-0009', 'NEG0076', '20000', 'Cool', '2018-05-04 14:51:19', '2018-05-04 14:51:32', '8% Discount On Negro Art Work', '8', '248', NULL),
(199, 'EDR-0009', 'NEG0076', '5000', 'Good place to be', '2018-05-09 07:50:44', '2018-05-09 07:51:05', '8% Discount On Negro Art Work', '8', '248', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `details_id` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group_id`, `details_id`, `user_type`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(4, 'superadmin', '$2y$10$ai3Fc53hTxRbpNAL5F0H4uNclKWy44mPwaid0hWznbOrOUe9jswlG', 3, 'AD-000MA1', 'superadmin', NULL, '2017-10-05 12:32:31', '2017-11-03 10:18:50', 1),
(260, 'MasterC', '$2y$10$Cu4oYKAEMfjsRFKQZIKtTuZvRX/F1aV2VsVlR8/0iRHku5Sfpmx52', 2, 'MAS221', 'merchant', NULL, '2017-12-19 10:01:48', '2017-12-21 09:39:31', 0),
(258, 'CafeVergnano', '$2y$10$2N50iUOWliwWpsR.EjsVtecfexx/8tmiyYtwVQk16qgtsUc7Mbl5O', 2, 'CAF219', 'merchant', NULL, '2017-12-19 08:36:04', '2017-12-21 12:24:56', 0),
(255, 'WaschePointLaundry', '$2y$10$IMCPdZZn6SdQfkp5hbrgreue2QS8VusjY/xwz/7hnV5tObV337ENe', 2, 'WAS215', 'merchant', NULL, '2017-12-18 09:34:20', '2017-12-21 12:23:23', 0),
(259, '44Restaurant', '$2y$10$RV7GMXgQqsP5f7Vusy8FjejP35F77s5b9IuY1hMoWEWQeYqk.c2XO', 2, 'RES044', 'merchant', NULL, '2017-12-19 08:45:10', '2017-12-21 12:25:40', 0),
(254, 'Bare2Beauty', '$2y$10$1dassxF9f..S7h4RkmqYU.0uZ4SwfbChxF1G6hSZorzK4.RGnPjOW', 2, 'BAR214', 'merchant', NULL, '2017-12-18 09:10:35', '2017-12-21 12:22:43', 0),
(252, 'PaddiesCatering', '$2y$10$jMVl2tdJs2q2SvslmiRGRuVJqJhaaPs9Gl2kLfe8e8iGJEQfNM63G', 2, 'PAD212', 'merchant', NULL, '2017-12-15 15:27:58', '2017-12-21 12:20:35', 0),
(32, 'tony@gmail.com', '$2y$10$FCD/.9C9NzQi8f2cY5h0xOQrDx7wJRvD307M4Wie2XA.SOqBr0WfC', 1, 'CS-000010', 'merchant', NULL, '2017-11-01 08:52:44', '2017-11-01 08:52:44', 0),
(250, 'FreshlyGroundCoffee', '$2y$10$8ls.TdmBmych9paZXQfYD.BXe/x2i9MTeZkiTZrpa7/IVlRZz23MS', 2, 'FRE209', 'merchant', NULL, '2017-12-15 14:58:56', '2017-12-21 12:17:32', 0),
(253, 'DavidWejIkeja', '$2y$10$t0B.FGKjMfFrJ2.5JJV.1e65TxH7wVaXoes4yfQTkU9om4vbM3XAK', 2, 'DAV213', 'merchant', NULL, '2017-12-15 15:31:40', '2017-12-21 12:21:47', 0),
(248, 'Oriental', '$2y$10$v9nNCIy8QKzkWLE60.HVZufz1tYmkW1x3X9H62gL.NJqVe1LvU7va', 2, 'ORI206', 'merchant', NULL, '2017-12-15 13:48:10', '2017-12-15 13:48:10', 0),
(39, 'yinka@gmail.com', '$2y$10$pF.WzqJ/mETLhqHFvmhuQeCQdolZo7SliBGOQizHv1Ky7i6bRdcXW', 1, 'YIN-0001', 'customer', NULL, '2017-11-08 07:47:42', '2017-11-20 13:56:02', 0),
(45, 'femi_brhyms@gmail.com', '$2y$10$OtULVUru8PLP8seWm5yZfeOZuW7rk8UVVvzX4PY8dx4Pm0pVEboZK', 1, 'FEM-0007', 'customer', NULL, '2017-11-09 11:05:27', '2017-11-09 11:05:27', 0),
(55, 'LaVeranda', '$2y$10$wqo2l0VOmJAj7ecEr7vhiOTBAHIsmai4xNuG9ADOrFLzB8NxkbEGO', 2, 'LA0019', 'merchant', NULL, '2017-11-15 12:01:48', '2017-11-15 12:01:48', 0),
(47, 'kelvin@gmail.com', '$2y$10$IyD/Xmavh.qZEfFq6zloJOA3w0lpZd7X4j7pMWbWWYe5oLGiO6mGS', 1, 'KEL-0008', 'customer', NULL, '2017-11-09 16:44:35', '2017-11-09 16:44:35', 0),
(48, 'edris@gmail.com', '$2y$10$MhkNhg3FZ.hdFzJ3tOoAsOvvgQNPPonKvZ2nO.eyU9ULy3jLxIkAq', 1, 'EDR-0009', 'customer', NULL, '2017-11-09 16:59:15', '2017-11-09 16:59:15', 0),
(49, 'beyonce@gmail.com', '$2y$10$FHayNCNznTC422HvucW12.zqzuMLGlSddmK8QzKEu.0L2VPRNKvvW', 1, 'BEY-0010', 'customer', NULL, '2017-11-09 17:14:38', '2017-11-09 17:14:38', 0),
(50, 'nicki@gmail.com', '$2y$10$tAwL1kngrlLjPgMQ3DN25etL.WsFS7W1JhoTNuG2WBvF/6YXUBp3C', 1, 'NIC-0011', 'customer', NULL, '2017-11-09 17:16:48', '2017-11-24 10:45:47', 0),
(57, 'DjPoppaey', '$2y$10$t8x/3/NSmmxdeDqHAaCyreGFu2nbcNNRmexBqi3FsqxfKMpYeR0tu', 2, 'DJ 0021', 'merchant', NULL, '2017-11-15 13:52:12', '2017-11-15 13:52:12', 0),
(56, 'Izanagi', '$2y$10$VuzllUgI21GX7/aecwr1XOyHZUZyylCLFRyG/UQpvDyNjsnBggtp.', 2, 'IZA0020', 'merchant', NULL, '2017-11-15 13:29:59', '2017-11-15 13:29:59', 0),
(53, 'george@gmail.com', '$2y$10$akmlMW54lVLnCGowpTRkh.O7Zgv1q2SKP8VvrSZcCq0GsMsVvd5n6', 1, 'GEO0012', 'customer', NULL, '2017-11-15 08:28:33', '2017-12-13 14:04:42', 0),
(54, 'j.shobajo@gmail.com', '$2y$10$3s/iAjyI0DHOOaZ1X7qJBOct/TMSzultn2y3pOCuqUTgfKuR5Iv3O', 1, 'JAM0013', 'customer', NULL, '2017-11-15 10:07:37', '2017-11-15 10:07:37', 0),
(58, 'EarthBlendJuiceLab', '$2y$10$KBFlOLdAvFif6bp8eLlziuUfixqxtrXSf8SG9zz/qktKWPOZDhNZ2', 2, 'EAR0022', 'merchant', NULL, '2017-11-15 14:34:41', '2017-11-15 14:34:41', 0),
(59, 'MoashyStudio', '$2y$10$566vF6MFMVAEEegLoWkJT..sAMBV37cJv3tFYjWHpHedMwnER/8Pi', 2, 'MOA0023', 'merchant', NULL, '2017-11-16 10:47:40', '2017-11-16 10:47:40', 0),
(60, 'PurpleRestaurant', '$2y$10$RJU.0tbAqfwaW2aO8hu7uOUjwqkqZPtG1gxZ0WC38MVfIaFWoaOTq', 2, 'PUR0024', 'merchant', NULL, '2017-11-16 11:13:52', '2017-11-16 11:13:52', 0),
(61, 'ColorsByRLSpa', '$2y$10$ZeuuQhZ5/nH4LypCxmxv8OBsFnKl.wuSdypTVhFoVftOr1sZ2Ivl6', 2, 'COL0026', 'merchant', NULL, '2017-11-16 12:18:21', '2018-02-28 10:06:01', 0),
(62, 'InspiroGalleria', '$2y$10$irB3qcoI226PZGne9JcOd.aH5r7TCHF.sPk0y//YvPIMOFv6Y0Byq', 2, 'INS0027', 'merchant', NULL, '2017-11-16 12:31:44', '2017-11-16 12:31:44', 0),
(63, 'ExquisiteTearoomLimited', '$2y$10$MP7bvXk9jQXYLN72KeQN9OmVyf2E5mFn/4ORv.pOPFRSYYPxZEbdS', 2, 'TEA0028', 'merchant', NULL, '2017-11-16 12:41:11', '2018-03-19 15:29:47', 0),
(64, 'NikiOSalon', '$2y$10$dUz3R/1daH3iJRCHsw.R/ONcVA2TRFn2SH2kjrPRQv9Mx4ItCWKYa', 2, 'NIK0029', 'merchant', NULL, '2017-11-16 13:39:26', '2017-11-16 13:39:26', 0),
(65, 'BHiveRestaurant', '$2y$10$PZXt9aCWIksBKAbjemLd.uPvYcb0aXCnJZ2jQnSf3EZcbvDmOfCny', 2, 'BHI0030', 'merchant', NULL, '2017-11-16 13:44:09', '2017-11-16 13:44:09', 0),
(66, 'MicosHouse', '$2y$10$5E.kGmA3IqdQjHoj5FsiyOpSYb77FiFnlnnmVPVtalRgsbP8oc77e', 2, 'MIC0031', 'merchant', NULL, '2017-11-16 13:54:09', '2018-02-23 06:44:33', 0),
(67, 'TheBlowFish', '$2y$10$xojRK77E5uGw0oUhIx9l4OmSsAIX45/JrL/lz9LnOh4z5qSeC/zku', 2, 'TBF0032', 'merchant', NULL, '2017-11-16 14:01:50', '2017-11-16 14:01:50', 0),
(68, 'SaheetoSmallchops', '$2y$10$iG6csvLIIy/OsbW5DghjEOpOvM403N3BBUWsjonD4X0D.5os8.Jre', 2, 'SAH0033', 'merchant', NULL, '2017-11-16 14:11:04', '2017-11-16 14:11:04', 0),
(69, 'PrestonAndPorter', '$2y$10$16sXtxUUCliPUi97Dxt8j.mIDxf3WpH8AvhfVu7pUuTPVARkVuVQm', 2, 'PRE0034', 'merchant', NULL, '2017-11-16 14:18:27', '2017-11-16 14:18:27', 0),
(70, '366Gifts', '$2y$10$o7eYmoGAhmENPFJgMuBkpubsJ/3c7cftSEK7hyr3vC0NdkA3VWNsi', 2, 'GIF366', 'merchant', NULL, '2017-11-16 14:29:40', '2017-11-16 14:29:40', 0),
(71, 'AshabiTailoring', '$2y$10$eAQObyAQfyJdGQZ7BGi3RuFSUun1MvA3qOYH62SipSZWVxmk/A8Ye', 2, 'ASH0036', 'merchant', NULL, '2017-11-16 14:38:47', '2017-11-16 14:38:47', 0),
(72, 'KimonoKollection', '$2y$10$Fsbxs7bF5fJ7LSffLV.ZfuiaPheGGKx1NA47wt3DEoQsgoBweKcbq', 2, 'KIM0037', 'merchant', NULL, '2017-11-16 14:55:14', '2017-11-16 14:55:14', 0),
(73, 'EkoGymSpa', '$2y$10$njAz7wsrxTo4IVGj8lab9uEHV7OX.b0WlDfED8tZF57oAbBiMwuIO', 2, 'EKO0038', 'merchant', NULL, '2017-11-16 15:06:13', '2017-11-16 15:06:13', 0),
(74, 'VictoriaCrown', '$2y$10$9Epd42d/s15WVRDNztcpBu4OcGLzI9s9FsWeiQpHP1MPy4nicfgqK', 2, 'VIC0039', 'merchant', NULL, '2017-11-17 08:30:29', '2017-11-17 08:30:29', 0),
(75, 'Barangular', '$2y$10$/CV384MCnRh8FSceb2YsnOcA5LBvZqVHpkSFLF/xjKumtYh7jbYqG', 2, 'BAR0040', 'merchant', NULL, '2017-11-17 08:37:47', '2017-11-17 08:37:47', 0),
(76, 'GoodHairLtd', '$2y$10$jJ65yPJIDRaa4O//Jci2pu48fCamAUX52wOzp0zkG2qnO.ca/tF1C', 2, 'GOO0041', 'merchant', NULL, '2017-11-17 08:45:37', '2017-11-17 08:45:37', 0),
(77, 'Dapmod', '$2y$10$0dlDKL/pT6.NUDqDzhFv3eHtbC0.0U6QskwO2zKxvu3uP/nIYyG86', 2, 'DAP0042', 'merchant', NULL, '2017-11-17 08:54:58', '2017-11-17 08:54:58', 0),
(289, 'YBCocoon', '$2y$10$8SuYrDEe5CPeB.yR7ViPHedQRtFk2kRjQikOaO.w8BQhU0MCOOxy2', 2, 'YBC0242', 'merchant', NULL, '2018-02-02 15:10:19', '2018-02-19 12:18:12', 0),
(79, 'WindLounge', '$2y$10$1K8D.fzwKiXwXVaN1lZbNubCPajGBGLrWD/Wp9syn.9K5py3R1JAa', 2, 'WIN0044', 'merchant', NULL, '2017-11-17 09:11:56', '2017-11-17 09:11:56', 0),
(80, 'A&I', '$2y$10$nZnsyGbV3Sna.rdKvbdLM.TsLjxexDIswcJdAu7eMuXSc4TyLZHYG', 2, 'AI0045', 'merchant', NULL, '2017-11-17 09:26:58', '2017-11-17 09:26:58', 0),
(81, 'CharismaCo', '$2y$10$jpGw0Ck.B7Mif7w7RN4wCeqZ/T0CRoj/Vmds6e9ZoAS6kjlltHWp2', 2, 'CHA0046', 'merchant', NULL, '2017-11-17 09:40:04', '2017-11-17 09:40:04', 0),
(82, 'PamperMeLush', '$2y$10$XA4plHt/jI.NCWiI2J//yuPqz5A9yBPtsFnInAfpyHbtSBRkH6cHq', 2, 'PAM0047', 'merchant', NULL, '2017-11-17 10:00:10', '2017-11-17 10:00:10', 0),
(83, 'TheWHotel', '$2y$10$FodtdmQBui.M2ew/aBQ19.MJ0f3P1pjg88wXuyYyGKgYuh/FhSe0W', 2, 'TWH0048', 'merchant', NULL, '2017-11-18 14:57:43', '2017-11-18 14:57:43', 0),
(84, 'NailPlusVentures', '$2y$10$wyMHPEv5AXwTWp3EwsmbxOJrhKssQKweK9iEAPCbmGJrgc7D.uRSK', 2, 'NAI0049', 'merchant', NULL, '2017-11-19 13:59:36', '2017-11-19 13:59:36', 0),
(85, 'EagleFitGym', '$2y$10$pgkCEGIAnAfbvmy6vNwG1ewIX8gsm4u7o9wOm5/eR3DvzpTcru2ae', 2, 'EAG0050', 'merchant', NULL, '2017-11-19 14:09:24', '2017-11-19 14:09:24', 0),
(86, 'AngleVillaLtd', '$2y$10$4AuT7CTxm8rZg8s/3JjOluc1vhf6fmrymNq89Tn/mILqLu2BsqfTO', 2, 'ANG0051', 'merchant', NULL, '2017-11-20 10:40:28', '2017-11-20 10:40:28', 0),
(87, 'adeniyijts@gmail.com', '$2y$10$Ddm4nSE6hnCTsX5zHFGshuxEkfGQ0POCSly69NvTKxNJCkh0x8qFi', 1, 'ADE0014', 'customer', NULL, '2017-11-20 10:49:10', '2017-11-20 13:45:08', 0),
(88, 'AbefeMakeMe', '$2y$10$b.Is0qBOaEgApJMM3fH9BecOaIyPcq2cPTy2cAqE1j1P3sRpyxdGu', 2, 'ABE0052', 'merchant', NULL, '2017-11-20 11:18:05', '2018-03-19 15:58:56', 0),
(89, 'HairbyBees', '$2y$10$Vanu1P/WKD5wypXSajL7l.IADXT5sLyf6T/UfgaP8mPBaIpg3rwru', 2, 'HAI0053', 'merchant', NULL, '2017-11-20 11:40:12', '2017-11-20 11:40:12', 0),
(90, 'BonVoyagehotel', '$2y$10$ZU2HJeNTUsm9LCLNWr82WuFl407UJFtZG/p7AJfpLqmbmbQMZr6Du', 2, 'BON0054', 'merchant', NULL, '2017-11-20 12:17:22', '2017-11-20 12:17:22', 0),
(91, 'OasisMed', '$2y$10$fnOWk2JMaEfPRymAU4TlE.A4IIlUpk0kQS0zpYuqhGx3H5Rmqv2Gu', 2, 'OAS0055', 'merchant', NULL, '2017-11-20 13:54:28', '2017-11-20 13:54:28', 0),
(94, 'Lamborghini', '$2y$10$9JHN6MT5Fu.Q1dkxh8TsDOb4N.0WoJvj2a45E2vobzKz.uOnuMdIS', 2, 'LAM0057', 'merchant', NULL, '2017-11-20 14:22:36', '2017-11-20 14:22:36', 0),
(93, 'Bodyline', '$2y$10$BFJu2M0WOEmTQ6UPqWZYl.1B0sf2mixvvfNbHi8AqjOdNnC6u/raG', 2, 'BOD0056', 'merchant', NULL, '2017-11-20 14:08:21', '2017-11-20 14:08:21', 0),
(100, 'blackchyna@gmail.com', '$2y$10$YU/SJCipGfklrdmWEBuG.ORF8jtCvIaaJ6OnEoLG8mor.vTBulQmm', 1, 'BLA0020', 'customer', NULL, '2017-11-20 15:17:08', '2017-11-20 15:17:08', 0),
(101, 'maryobi@gmail.com', '$2y$10$o8fboxayhkE/XLM3AOe4n.NaKj5a5vZyw17DcxuemVEObD9WEFAi2', 1, 'MAR0021', 'customer', NULL, '2017-11-20 15:22:11', '2017-11-20 15:22:11', 0),
(98, 'JohnnySalon', '$2y$10$zMUw3eHaIbgAB8p8vO2gNu4l7.9FsAnGgqZHkbgPQlvhPUihP3b7K', 2, 'JOH0058', 'merchant', NULL, '2017-11-20 14:39:21', '2017-11-20 14:39:21', 0),
(104, 'HodgeAuto', '$2y$10$N/mrkbgFa0pTALXpD4jF1u/9mjJc3HxWzKes3.X.k.PGyJNdLYFXi', 2, 'HOD0061', 'merchant', NULL, '2017-11-22 09:22:52', '2017-11-22 09:22:52', 0),
(105, 'TheRed', '$2y$10$U3lBybYwUtE2hmQ7VqgAXeiVNzCFuEflcn05dYfLt7HHIWroISITa', 2, 'THE0062', 'merchant', NULL, '2017-11-22 09:45:58', '2017-11-22 09:45:58', 0),
(106, 'ShomyaCosmetics', '$2y$10$1KmkkUX0OB.rd0pCuOsoueZGUKLvsQcejNa8.uiAuV9Hys77K0l4e', 2, 'SHO0063', 'merchant', NULL, '2017-11-22 10:54:02', '2018-03-19 08:25:16', 0),
(107, 'TheBeautyAtelier', '$2y$10$Fj5QkEdliV/LezOcQFIK8e1BK0fnMAa0NS6ajCkwMGT3LrtRRw5s2', 2, 'TBA0064', 'merchant', NULL, '2017-11-22 11:04:41', '2017-11-22 11:04:41', 0),
(108, 'DoranneBeautyLekki', '$2y$10$n93fdw2vd56YG27f3/5hpemdrFRwm4ybP.YjKCTFiTtZz/7K0u8ES', 2, 'DOR0065', 'merchant', NULL, '2017-11-22 11:11:51', '2018-03-19 15:49:59', 0),
(109, 'CaiShenChinese', '$2y$10$Kxl3keTrBfAUfJsg7r0mlODe5.BVdHT0MKv5OmvwY23wVmogn.03O', 2, 'CAI0066', 'merchant', NULL, '2017-11-22 11:29:26', '2017-11-22 11:29:26', 0),
(110, 'RenaissanceHotel', '$2y$10$QKh/QLpPZG2T1wOvuhUAT.OGzapO9x899FeQuOR/uIwDybx4pF41e', 2, 'REN0067', 'merchant', NULL, '2017-11-22 11:54:24', '2017-11-22 11:54:24', 0),
(111, 'BlissfieldDental', '$2y$10$TSttjsyGPG7q4LOmWPOBfOe0JpH/.SYs6lA4z1WGOTcMDlLuLjgMe', 2, 'BLI0068', 'merchant', NULL, '2017-11-22 12:00:46', '2018-02-27 10:11:47', 0),
(112, 'FreshlookSpaCentre', '$2y$10$tRp3xeb8RiriG8Kz/LmmkuTuGtXe7gC6Oz4YEqhh6TLxu.t47bSh.', 2, 'FRE0069', 'merchant', NULL, '2017-11-22 12:11:47', '2017-11-22 12:11:47', 0),
(113, 'IndigoBoutique', '$2y$10$fy7KCN4F8WxOMBAFM/M4nOliCYJcYXfnL73iohiBX1WnK2QhLW.pW', 2, 'IND0071', 'merchant', NULL, '2017-11-22 13:45:47', '2017-11-22 13:45:47', 0),
(114, 'HouseofDorothy', '$2y$10$69ZwLn9ONumzvN764GJCxOH4glkto9kNVpagM7TDYPDBD33GZOfUK', 2, 'HOU0072', 'merchant', NULL, '2017-11-22 13:56:24', '2017-11-22 13:56:24', 0),
(115, 'TheRegentLuxury', '$2y$10$V6GCA7N3xXTMMbhbTNkDr.Qgs3YCMqImbL/3hcdAD.46tp9JC2512', 2, 'TRL0073', 'merchant', NULL, '2017-11-22 14:06:30', '2017-11-22 14:06:30', 0),
(116, 'ZenithWaterMargin', '$2y$10$/s0zCCyByB6S2g18vvyW6Ol8yDPmNnZkJBEihY0NBO3qwztLTif8i', 2, 'ZEN0074', 'merchant', NULL, '2017-11-22 14:12:05', '2017-11-22 14:12:05', 0),
(117, 'TrufflesRestaurant', '$2y$10$hoPFipYOMwICFjWfjigz2ObK9IpE87WqDk9gm1FwpBwH7TrbeTwqy', 2, 'TRU0075', 'merchant', NULL, '2017-11-22 14:17:53', '2017-11-22 14:17:53', 0),
(118, 'NegroArtsLtd', '$2y$10$3o6ocnL2zAHAtrzZLNcBqOOPt0/bQKPuxk6Y4E2LkQ8QwTeRHuWjO', 2, 'NEG0076', 'merchant', NULL, '2017-11-22 14:27:32', '2017-11-22 14:27:32', 0),
(119, 'antoinette@theaffinityclub.com', '$2y$10$0v9Wfw1ks/eyT/ljjjXd3uDxBPWsGORda.pSwANM6fH5UgIc/tbH6', 1, 'ANT0022', 'customer', NULL, '2017-11-24 08:21:57', '2017-11-27 12:46:38', 0),
(120, 'ArabesqueRestaurant', '$2y$10$DgBYWdhtcWYG1/sA96GbNeygQcnI6rgedkhBkIBwen7hvWFQKZaya', 2, 'ARA0077', 'merchant', NULL, '2017-11-29 12:11:16', '2017-11-29 12:11:16', 0),
(121, 'ExtremeLounge', '$2y$10$jzjkyErDw/mwI1AEN3g5hud5rP99rqRO.OFSGGWmJr4F1L1PMqm0G', 2, 'EXT0078', 'merchant', NULL, '2017-11-29 12:18:29', '2017-11-29 12:18:29', 0),
(122, 'MohaSalon', '$2y$10$TQRT98yb5YjXUIDIhOD.Ke55fsXDkucXzCxLXzbdI/IBUslc/bdLm', 2, 'MOH0079', 'merchant', NULL, '2017-11-29 12:43:21', '2017-11-29 12:43:21', 0),
(123, 'GleeHotel', '$2y$10$zfBeE.LysAmKNSMK3huDFuNQzsVaKdWiYvxNLXQ/QnGNdIgBd.i2O', 2, 'GLE0080', 'merchant', NULL, '2017-11-29 13:01:57', '2017-11-29 13:01:57', 0),
(124, 'HomegateResort', '$2y$10$NzeRDuXsMAvSzydCWvG/Pur89Z0nWjTNNJA1QLFTy0igMBP2FPvT2', 2, 'HOM0081', 'merchant', NULL, '2017-11-29 13:15:38', '2017-11-29 13:15:38', 0),
(125, 'ImagiaItalian', '$2y$10$3MlqF0hVSLR/ZhnXg/I49OydlaDWVN3kJq9TRbNwEgUnDXzku2JO.', 2, 'IMA0082', 'merchant', NULL, '2017-11-30 07:15:29', '2018-03-22 14:30:13', 0),
(126, 'ChristabelsKids', '$2y$10$5uW7SNMPyj1kShxegdJmNOwY.JMuyJGW70n9blqoxsEdWFi2/q7nG', 2, 'CHR0083', 'merchant', NULL, '2017-11-30 07:31:36', '2017-11-30 07:31:36', 0),
(127, 'DeevianDay', '$2y$10$ZxdwT6Ekhaq0LmFNCqjNvu1XVN/hYZWXMHB0irawy4FZ3fIKzpyqO', 2, 'DEE0084', 'merchant', NULL, '2017-11-30 07:51:31', '2017-11-30 07:51:31', 0),
(128, 'ShadesOfBeauty', '$2y$10$NYFEOlO6bLAyDbk/VrfaTu6fnfHqSSdLZ/FmQCfjFnSnI0vMVjm3a', 2, 'SHA0085', 'merchant', NULL, '2017-11-30 08:00:05', '2017-11-30 08:00:05', 0),
(129, 'BeautyBesech', '$2y$10$Vh3RTKoTzKe4r1XPZNC7uuGyCEdzeqWumgYfjDq5EuJS/ddEi8kgG', 2, 'BEA0086', 'merchant', NULL, '2017-11-30 09:04:32', '2017-11-30 09:04:32', 0),
(130, 'Bilan', '$2y$10$3snr1hsVy6zUwq4LlbXCNOwSTZQIdaA44o4hyQlD4roJ4hAPffI0O', 2, 'BIL0087', 'merchant', NULL, '2017-11-30 09:15:09', '2017-11-30 09:15:09', 0),
(131, 'Sliquors', '$2y$10$LNauFErj51gG0E/bwoirgeziSZu9.B10cgQNiom.pd2PvFB/Jt7si', 2, 'SLI0088', 'merchant', NULL, '2017-11-30 09:28:24', '2017-11-30 09:28:24', 0),
(145, 'TheAvenueSuites', '$2y$10$xq6WXPVG9ic/T12fVz67neJY/tjzOKS9xLu24hlBGn6eUIcGKHmmS', 2, 'TAS0100', 'merchant', NULL, '2017-12-05 07:17:42', '2017-12-05 07:17:42', 0),
(398, 'SkinGlamour', '$2y$10$mUs5CoMh/wgwWJruVb2Q4.u2ZJuvpwbj.n.6UkDkBBK.gh8XJEEAO', 2, 'SKI0345', 'merchant', NULL, '2018-04-16 11:41:49', '2018-04-16 11:41:49', 0),
(147, 'Samantha', '$2y$10$UFxh/KGRT97jkdZcXN.GBOfOLcOd57NcGBQEaG7WNv65EEOgFKgmW', 2, 'SAM0102', 'merchant', NULL, '2017-12-05 08:40:24', '2017-12-05 08:40:24', 0),
(256, 'CasaLydiaRestaurant', '$2y$10$YpfOZwpLdBwW9XZVyfzSBO7AEr/Z8.5mSOSkjS3.amsxbNMhhMnaO', 2, 'CAS216', 'merchant', NULL, '2017-12-19 07:37:05', '2017-12-21 12:24:09', 0),
(149, 'HouseOfPhreedah', '$2y$10$OA5fsIsyK7AltHP1toAoeePPZq.k.ob.Xer/N4A9Lp6Eg.LuQ5XhK', 2, 'HOU0104', 'merchant', NULL, '2017-12-05 09:39:31', '2017-12-21 10:14:28', 0),
(150, 'CelonDentalClinic', '$2y$10$IDC/I1FjnCPkz/a5BkFDceR7WhIWNrqvN4nvsOHzls0Od73TGB5JW', 2, 'CEL0105', 'merchant', NULL, '2017-12-05 10:17:46', '2017-12-21 10:16:46', 0),
(151, 'BleuIvyHotelAndSuites', '$2y$10$8kfbmqTqxyZ/oQeqxpbAvuR9VLj3ZZwsI4nZ541j865ijH3xLqr9G', 2, 'BLE0106', 'merchant', NULL, '2017-12-05 10:44:48', '2017-12-21 10:18:00', 0),
(152, 'EkoHotelAndSuites', '$2y$10$nLYYfa4E9U6ZxMTt0DSPX.9uXueFm8i/BPck4xNiILexKteXq0SIC', 2, 'EKO0107', 'merchant', NULL, '2017-12-05 12:03:05', '2017-12-21 10:18:47', 0),
(153, 'DanaAir', '$2y$10$Re3IkoUSIEdOTPp31JLfs.dlHfb2C8cQbOnnhLQGaro4KCdMuTjzi', 2, 'DAN0108', 'merchant', NULL, '2017-12-05 13:28:35', '2017-12-21 10:19:22', 0),
(154, 'AirPeace', '$2y$10$X2xK3telQxlQotLxcgmaD.8ffT9Ry/sX7sLmLg5VKT0wlNOC5jKIi', 2, 'AIR0109', 'merchant', NULL, '2017-12-05 13:39:52', '2017-12-21 10:19:59', 0),
(143, 'ydebimpe@gmail.com', '$2y$10$nU1y7it.znFBQLC1TbOY6ucEjeDyEmhB/nljih0XXSU/3krnzIQMC', 1, 'YDE0023', 'customer', NULL, '2017-12-01 12:34:32', '2017-12-01 12:34:32', 0),
(144, 'noibilism@gmail.com', '$2y$10$zMfWmeaUPY.NXIn5Ostjke686BFka4Z831ldvTcQxGl1YbTGy41WO', 1, 'NOI0024', 'customer', NULL, '2017-12-01 22:22:54', '2017-12-01 22:22:54', 0),
(155, 'FilmhouseLekki', '$2y$10$j0E2x5tuVknGt3/Dr9unses7XNCGVpbPfrSp.5i1b6744Z6xFnTW2', 2, 'FIL0110', 'merchant', NULL, '2017-12-05 13:56:57', '2017-12-21 10:20:35', 0),
(156, 'EkoSignature', '$2y$10$J/zARAXkE.UvVhpMWw9Gi.C3Lc6zFHwOtRLh43iX3D2dq5epsmHyC', 2, 'EKO0111', 'merchant', NULL, '2017-12-05 14:08:50', '2017-12-21 10:21:19', 0),
(157, 'SkyLounge', '$2y$10$9TaLFgeEcp0RdI5bS.QtIO.LOe2OCUbAHcofUJMjIiuehWVDh2fj.', 2, 'SKY0112', 'merchant', NULL, '2017-12-05 14:19:44', '2017-12-21 10:23:18', 0),
(158, 'Crossroad', '$2y$10$.y22tkWbHQdhlljwSRWq../qUVzLdFixv.r/wwJ9B5GIWH5TgTfdG', 2, 'CRO0113', 'merchant', NULL, '2017-12-06 07:51:15', '2017-12-06 07:51:15', 0),
(159, 'TheGrill', '$2y$10$bBziP93b7Bgwz/gh6KgiWulCdCWgfVXgvyNg3RMyS/i8kc6Cjhulq', 2, 'TGS0114', 'merchant', NULL, '2017-12-06 07:59:49', '2017-12-06 07:59:49', 0),
(160, 'LagoonBreeze', '$2y$10$ZbiM4n6DsJEvjW4zqww1IeqHkJk5KPOs0VBePlf5OH7ohrw.iUr0S', 2, 'LAG0115', 'merchant', NULL, '2017-12-06 08:05:53', '2017-12-21 10:24:31', 0),
(161, 'KuramoSportCafe', '$2y$10$RayWvV.pS/W316HNwdYjpe6lY9j5TU/DlP4ItmhRfHWSHwYIp7oym', 2, 'KUR0116', 'merchant', NULL, '2017-12-06 08:10:58', '2017-12-21 10:26:10', 0),
(162, 'CalabashBar', '$2y$10$pHMaI8bw1yFOqb3VFt7Ot.UmA9XUxXXA2c7W/veMhN1Naxk9WQpBG', 2, 'CAL0117', 'merchant', NULL, '2017-12-06 08:14:31', '2017-12-21 10:27:00', 0),
(163, '1415ItalianRestaurant', '$2y$10$4YvUyTH7hxxpy7AK3LFESehVtUq6HenJcLKud2ONexHBwjF6gbVUO', 2, 'IT1415', 'merchant', NULL, '2017-12-06 08:19:16', '2017-12-21 10:28:22', 0),
(164, 'RedChineseRestaurant', '$2y$10$50DQbzt0MqfFQJydmm/XhOyCIXUjAmmIw/YB8NScFuSMMV8CthIWK', 2, 'RED0119', 'merchant', NULL, '2017-12-06 08:23:32', '2017-12-21 10:29:25', 0),
(165, 'EkoSpa', '$2y$10$VoIJAgnfphmEkDN0yATJ2OYMjRuCYmMh52t/JEkeVQip7m/1K6S8m', 2, 'EKO0120', 'merchant', NULL, '2017-12-06 08:30:48', '2017-12-21 10:30:00', 0),
(166, 'FilmhouseSurulere', '$2y$10$932PaH.Eme2shGq/WbS4cejHrsLAIO0vSsDKFi7N.7/RvSif27tWG', 2, 'FIL121', 'merchant', NULL, '2017-12-06 13:04:24', '2017-12-21 10:30:58', 0),
(167, 'SilverbirdAhmaduBello', '$2y$10$WiHHJc1R5bHNO8L4tL/ReupB8DCjI0rd.ykWeJiuwYC5NmhRvaQgC', 2, 'SIL122', 'merchant', NULL, '2017-12-06 13:16:45', '2017-12-21 10:31:54', 0),
(168, 'SilverbirdCinemaIkeja', '$2y$10$1oaOhadNJVYTotyARosCdurFLizuuJ.6SjoazZsCDD3KBMFKxrTWq', 2, 'SIL123', 'merchant', NULL, '2017-12-06 13:31:29', '2017-12-21 10:32:51', 0),
(169, 'SilverbirdCinemasFestac', '$2y$10$YqsIvPnfrmF.kerVSynl..BrRwdEBSflY.DgzL.gRr7LM3Fs7ntdq', 2, 'SIL124', 'merchant', NULL, '2017-12-06 13:48:49', '2018-02-02 13:11:37', 0),
(229, 'LaBrioche', '$2y$10$VQIrT8kuHy5.3T9Os3vNueMSCoAV4.6YYD1vnweWG.wZL2oGx07X2', 2, 'LA187', 'merchant', NULL, '2017-12-12 09:45:59', '2017-12-12 09:45:59', 0),
(171, 'ReddingtonHospitalIkeja', '$2y$10$84HqUBb8HdcvoCh18Eud7OfPtRM3adSQJ1.KWkTCLwS29sraZPhiC', 2, 'RED126', 'merchant', NULL, '2017-12-06 14:24:53', '2017-12-21 10:35:47', 0),
(172, 'CocoonRestaurant', '$2y$10$8MhulsuYWv/M3PbyCl94Se7SaPuh1jMTDg1lvcrDv7KVYwM9HCIWy', 2, 'COC127', 'merchant', NULL, '2017-12-06 14:35:30', '2017-12-21 10:37:29', 0),
(173, 'Club57', '$2y$10$cLvrhjeaQmfz3qE4jO5VWOgmqCgIjm/v0JSvZmmyQWzUAkDyGi1Te', 2, 'CLU57', 'merchant', NULL, '2017-12-06 14:46:25', '2017-12-21 10:38:17', 0),
(174, 'FlorenceHLuxuryBoutique', '$2y$10$MbRxyjELc8GkwWN/qRxI2uo01HVzhRZyL4AzhpZVTom19HLQD6iYG', 2, 'FLO129', 'merchant', NULL, '2017-12-07 07:27:03', '2017-12-21 10:39:15', 0),
(175, 'TinoElectronicsFalamo', '$2y$10$XVOYnPzaOKLYs9YmSUorouIpbDxG5CWfCWK9PF1pPYFJ4jvsDJc4O', 2, 'TIN130', 'merchant', NULL, '2017-12-07 07:51:46', '2017-12-21 10:40:12', 0),
(176, 'TinoElectronicsLekki', '$2y$10$5moPhfzL0cXzsT/wWBOJ/ON6qN1V12hh42YftKCP7fPAU3REj24h2', 2, 'TIN131', 'merchant', NULL, '2017-12-07 08:10:34', '2017-12-21 10:41:14', 0),
(177, 'YudalaGbagada', '$2y$10$mA/TO7s5BlspfCKSxI1pweuNLWOMvrIDQ9927ZFFdHNA.nR40eSOi', 2, 'YUD132', 'merchant', NULL, '2017-12-07 08:28:39', '2017-12-21 10:42:06', 0),
(178, 'YudalaIkeja', '$2y$10$rT2OtGbk6NlrSoTVatcDuenYHwFeZimJeQns8D3QIsWhbV4hY8VRO', 2, 'YUD133', 'merchant', NULL, '2017-12-07 08:40:48', '2017-12-21 10:43:08', 0),
(179, 'YudalaVI', '$2y$10$HnMqqeO06UxddduxFyRQhuE9RyeShSca7u.M4DqVzn0a3dXQwOury', 2, 'YUD134', 'merchant', NULL, '2017-12-07 08:53:04', '2017-12-21 10:44:10', 0),
(180, 'YudalaLekki', '$2y$10$R8JupZfFXoWFSQfSSkueKuWNceZPdQBZipC/sFaWXmjLubQK04GNO', 2, 'YUD135', 'merchant', NULL, '2017-12-07 09:02:00', '2017-12-21 10:45:11', 0),
(181, 'SakuraR', '$2y$10$a4TBDHAaA6ogDAJ7VcbfvO1nLcppzxzpVBp5BTo7YbzUaJ00dRY.S', 2, 'SAK136', 'merchant', NULL, '2017-12-07 09:21:24', '2017-12-21 10:45:59', 0),
(182, 'Strathaven', '$2y$10$Sq0odFvEi/UeVk8C3Q6rF.3OMAhHN7q6N4sk1MpC7TBON2WJQgxHm', 2, 'STR137', 'merchant', NULL, '2017-12-07 09:47:28', '2017-12-21 10:47:49', 0),
(183, 'TheLandmarkCentre', '$2y$10$NVmMGe6RWxXIV6/.fPjaeugz2qmzu3vEf5OyWTHZ.9Ej.ZaEIJwNq', 2, 'TLC138', 'merchant', NULL, '2017-12-07 10:21:18', '2017-12-21 10:53:22', 0),
(184, 'HardrockCafe', '$2y$10$dRGVYdI8ze2dYrsDcPugvudVNqtvVtfZ1vDZxt700xgLSA9D7WUp6', 2, 'HAR139', 'merchant', NULL, '2017-12-07 10:51:15', '2017-12-21 10:55:44', 0),
(185, '1089LoungeAndClub', '$2y$10$YU0NKHzek1mm3RovSrLY2.F5/kiWFwnfBjSeL7883f7o4saCiSeae', 2, 'LO1089', 'merchant', NULL, '2017-12-07 11:23:42', '2017-12-21 10:57:02', 0),
(186, 'Casper&GambiniVi', '$2y$10$DPYNwddarTqZ3FARXnuTtujnxhoIYVmxBpkZM0WMZKJOdlF13xPS.', 2, 'CAS141', 'merchant', NULL, '2017-12-07 11:44:01', '2017-12-21 10:59:50', 0),
(187, 'Casper&GambiniIkeja', '$2y$10$RcfB1hLwru3nweu4t7e3ouIA3uYVoXmqd2rh9TuKKqfMgcbTHOdzy', 2, 'CAS142', 'merchant', NULL, '2017-12-07 11:55:03', '2017-12-21 11:05:49', 0),
(188, 'Mashawis', '$2y$10$qX3oBWnbJYarrVww7dyaP.C5c3eOzuUwK8Jv2Bb/IG9TyPs7PuCLG', 2, 'MAS143', 'merchant', NULL, '2017-12-07 12:09:19', '2017-12-07 12:09:19', 0),
(189, 'TerraKulture', '$2y$10$qxJbkJLFG7qdVHOi9kgOiOfwokT7.06cYk03OUpwgch9uxvyJH6t6', 2, 'TER144', 'merchant', NULL, '2017-12-07 12:21:55', '2017-12-21 11:09:21', 0),
(190, 'Vellvett', '$2y$10$XTde.sr7BKqBgY7AQWoh7uTrQKmpwosQZTbrtuEL8uc0WdLM6JOP6', 2, 'VEL145', 'merchant', NULL, '2017-12-07 13:01:03', '2017-12-07 13:01:03', 0),
(191, '355Restaurant', '$2y$10$mYzH87AdHgdyqt.lJuxRbudmtBr34srjMrs9LSq.uWFdKggHShkiy', 2, 'RES355', 'merchant', NULL, '2017-12-07 13:18:43', '2017-12-21 11:11:11', 0),
(192, 'Westwood', '$2y$10$AAFax6bFluKmn.zge7SdNug8YA/CCtB7mJAvsA02EURi2Jj2l4nOC', 2, 'WES147', 'merchant', NULL, '2017-12-07 13:36:08', '2017-12-07 13:36:08', 0),
(193, 'ScratchAndSocial', '$2y$10$WC/F0B.UFsNHF7BWOWEhguiBaAnU0CiZwDr0hmE..jia5q75BwJFO', 2, 'SCR148', 'merchant', NULL, '2017-12-07 15:03:37', '2017-12-21 11:12:10', 0),
(194, 'IamIsigo', '$2y$10$J5UC7oHq/.mAEF/bd8ySJeqyH6E3yhB.LqKCZ29RioWhM1BttGCXC', 2, 'IAM149', 'merchant', NULL, '2017-12-08 07:21:43', '2017-12-21 11:13:03', 0),
(195, 'NouvaCouture', '$2y$10$HkFPkUbBWqM08YHaQQj88Ol2lmsTskveJUGQ1/Q92LKzG9FJbmtfq', 2, 'NOU150', 'merchant', NULL, '2017-12-08 07:43:19', '2017-12-21 11:15:03', 0),
(196, 'BicsGardens', '$2y$10$kNA..v.g0XvbSIpL..A68utbffmQG60cfwQ061L588/vX04vmpb56', 2, 'BICS151', 'merchant', NULL, '2017-12-08 08:08:15', '2017-12-21 11:17:12', 0),
(197, 'Wingsville', '$2y$10$tyxayBHliTAAHSH/pPCwUulqn14/2kxXP5i3s6auP28MCguqLZWum', 2, 'WIN152', 'merchant', NULL, '2017-12-08 08:47:31', '2017-12-21 11:20:02', 0),
(198, 'GrandCobblerLekki', '$2y$10$vdlpoXvwg0oUcTDYkNcpIuZfqF3UoXnIQKhOPurUXIs6A1a1A8baW', 2, 'GRA153', 'merchant', NULL, '2017-12-08 09:08:41', '2017-12-21 11:21:33', 0),
(199, 'GrandCobblerChevron', '$2y$10$3Bt4D/oA9K.SLh1fXeghU.3ifn57vk2fJqj7zC0NjI10wRD9v3BG6', 2, 'GRA154', 'merchant', NULL, '2017-12-08 09:27:31', '2017-12-21 11:22:36', 0),
(200, 'ILBagno', '$2y$10$UKa3S6I2JErL8O9s2pL/C.dP04/v5bceOPqkuRsdMNjrWZAbk3AhC', 2, 'ILB155', 'merchant', NULL, '2017-12-08 09:40:47', '2017-12-21 11:23:21', 0),
(201, 'AccessCardNg', '$2y$10$CINW998OxpWgG13nrR0GNuTnOaQ28P7msHgqxZwltaiVUafxaj916', 2, 'ACC156', 'merchant', NULL, '2017-12-08 09:55:18', '2017-12-21 11:24:22', 0),
(202, 'SshhhLingerie', '$2y$10$X02E2420kHr71HwrqsrQKO16vLOTP8kGRQ8mLnvGYatpl3tTretfq', 2, 'SSH157', 'merchant', NULL, '2017-12-08 10:45:35', '2017-12-21 11:25:13', 0),
(203, 'BunnieBeesFabrics', '$2y$10$OWel2lFykOI9x45.akLAM.RKv6xQNZV9qVOUMRCOAdi7ByB6ey222', 2, 'BUN158', 'merchant', NULL, '2017-12-08 11:04:55', '2017-12-21 11:25:50', 0),
(204, 'BelFioreMedical', '$2y$10$2qxMrv4uQQWEIA1FWogshOt/cwA7iK5rPZCE2jQgggpuuGWE/QY22', 2, 'BEL159', 'merchant', NULL, '2017-12-08 11:24:01', '2017-12-21 11:27:30', 0),
(205, 'SevenEaglesSpur', '$2y$10$yY28vy2X1eAKUjsLsQzCcu4QTg9xzIqnhG.GKF8MsU7Tc/JAzWZJi', 2, 'SEV160', 'merchant', NULL, '2017-12-08 11:43:22', '2017-12-21 11:28:38', 0),
(206, 'GoldenEagleSpur', '$2y$10$0aNZCz1XbfSwoxKjQFw0wOQfmKq2nfbBCtlIOr.uzItnQ4cjrKGei', 2, 'GOL161', 'merchant', NULL, '2017-12-08 11:51:14', '2017-12-21 11:29:34', 0),
(207, 'CafeNeoYaba', '$2y$10$59tWPq/BGZqE14oy/5nMiuWc16WoWNchYJyks.kzPZZw6W6895Ru2', 2, 'CAF162', 'merchant', NULL, '2017-12-08 12:02:34', '2017-12-21 11:30:11', 0),
(208, 'CafeNeoVI', '$2y$10$1BIpNClh8HMixEwQ9BnGXeOhTsCR39j5Dgu9MunnQ9bavkjRmPi9a', 2, 'CAF163', 'merchant', NULL, '2017-12-08 12:10:15', '2017-12-21 11:32:21', 0),
(209, 'CafeNeoVII', '$2y$10$ho9v0ehiiep72zHGsZU1w.w/2iS4E1AkitR3FvfyBKQoJjccm8Dk.', 2, 'CAF164', 'merchant', NULL, '2017-12-08 12:17:46', '2018-02-23 09:10:00', 0),
(210, 'CafeNeoLekki', '$2y$10$x/VMhAjtfCbg4u5uNEfjHOSbbdB0j7X01EQgHdDbtJxKxlYveSrz6', 2, 'CAF165', 'merchant', NULL, '2017-12-08 12:34:04', '2017-12-21 11:36:05', 0),
(211, 'RSVP', '$2y$10$oHXV2wfGYwf4n7y6WToDZubunZX8zZ/PkmYL93EwUm/ClEuqr2rxy', 2, 'RSV166', 'merchant', NULL, '2017-12-11 07:32:45', '2017-12-11 07:32:45', 0),
(212, 'BackyardGrill', '$2y$10$jVjbdzWJBRwY.E60fCPuzu8aEiwc.MX/.raZScNnqjTRAqEPL9ree', 2, 'BAC167', 'merchant', NULL, '2017-12-11 07:46:08', '2017-12-21 11:38:20', 0),
(213, 'Spice', '$2y$10$fbCzRPbIjWVjfEUMTf6RlOtT3QHKgbtyIcFpWViE5AzPBw/HwJQnm', 2, 'SPI168', 'merchant', NULL, '2017-12-11 09:45:54', '2017-12-11 09:45:54', 0),
(214, 'InfinityTyresVI', '$2y$10$KJEF/MjRyKWiYxzL6VAgqOLqAcnci9Xe1NUdBBSymjguoBcgLPZZ.', 2, 'INF169', 'merchant', NULL, '2017-12-11 10:57:34', '2017-12-21 11:40:25', 0),
(215, 'InfinityTyresApapa', '$2y$10$ztO4GICtRJwe/NN.hhSZ5u45pt7ubU0CmIUvIau2NCncmIPIo6MrS', 2, 'INF170', 'merchant', NULL, '2017-12-11 11:11:57', '2017-12-21 11:41:47', 0),
(216, 'InfinityTyresIkeja', '$2y$10$DO9GLNZuiLSdQCcYQkrLI.4ySutzqxPYjAsTtKE/uGZEYNOUr3nEu', 2, 'INF171', 'merchant', NULL, '2017-12-11 11:36:25', '2017-12-21 11:42:54', 0),
(217, 'TheGeorgeHotel', '$2y$10$FyjU8SDoy9LwD6Qdz.Yk7OqRFLaQ1RTAxAB3WqowCvlKXytMPuZZW', 2, 'TGH172', 'merchant', NULL, '2017-12-11 12:09:36', '2017-12-21 11:43:33', 0),
(218, 'TheWheatbakerLagos', '$2y$10$5NsKKpNd7td.K1Ac5qq8A.kgR5cCF8qpmMlv14UkYW7l2wqKZf/ui', 2, 'TWL176', 'merchant', NULL, '2017-12-11 13:14:12', '2017-12-21 11:44:30', 0),
(219, 'FederalPalaceHotel', '$2y$10$xZH3W4JQYNYdfOdhlj.Hjev.ZVym8sarE.BiKGopgs/5I7muS8N/C', 2, 'FED177', 'merchant', NULL, '2017-12-11 13:18:15', '2017-12-21 11:45:47', 0),
(220, 'RaddissonBlu', '$2y$10$D1PM92f8FvnqpZ8X/OsRee0Y/zr67VA73UU5cpJ3m1TYV3N7jZalS', 2, 'RAD178', 'merchant', NULL, '2017-12-11 13:36:00', '2018-01-30 16:49:53', 0),
(221, 'InterContinentalLagos', '$2y$10$BLbOGE2DZKsaahPJvYzBZ.ceV7L21ZwcQbu1Y74AZxudpG5aeJwH2', 2, 'INT179', 'merchant', NULL, '2017-12-11 13:47:17', '2017-12-21 11:49:46', 0),
(222, 'BarazahiSpa', '$2y$10$Oo8eXfDNIr5b3iRwc9Eyw..fJ43MIYaOHK7j5HAP2bA9WrsPMaeda', 2, 'BAR180', 'merchant', NULL, '2017-12-11 14:14:40', '2017-12-21 11:51:30', 0),
(223, 'TirtaAyuSpa', '$2y$10$I1oktHU8lYrJUCx5Q4s5K.Ad2leTEeoPTQK3z4TuDNooyBWEc4R3i', 2, 'TIR181', 'merchant', NULL, '2017-12-11 14:31:28', '2017-12-21 11:53:00', 0),
(224, 'ClearEssenceSpa', '$2y$10$6gmf5QU3BLlplB4W0en68Or/Q2bgwrOW929Tg.B6UpCuKpRkJ7SJq', 2, 'CLE182', 'merchant', NULL, '2017-12-11 14:43:06', '2017-12-21 11:53:43', 0),
(225, 'MaisonFahrenheitHotel', '$2y$10$54kKU/Fx.kMyeAgCKm4LFOCxz1Ci6v6iyxITvmfP9.zll5n3VcwYy', 2, 'MAI183', 'merchant', NULL, '2017-12-11 15:05:49', '2017-12-21 11:54:50', 0),
(226, 'SvengaliDesignsLtd', '$2y$10$Hq78QEf.6OFXbqu9gnbUE.5vNOF7riF82IZqFFsvTdA49f5ojJqSa', 2, 'SVE184', 'merchant', NULL, '2017-12-12 08:21:07', '2017-12-21 11:56:33', 0),
(227, 'LafricRestaurant', '$2y$10$Rj1IfxeJyFiRf9dHGWYUYur51HIgDo9rg8dfQqb1193sMLnXlhJOS', 2, 'LAF185', 'merchant', NULL, '2017-12-12 08:41:49', '2017-12-21 11:57:09', 0),
(228, 'MorningsideSuitesLtd', '$2y$10$rd/xHWQrxZn2TatN88WTaudr6wi6gYZYs.gw7Cw1ATWYQmXkHD376', 2, 'MOR186', 'merchant', NULL, '2017-12-12 08:48:26', '2017-12-21 11:58:53', 0),
(230, 'Jbronze', '$2y$10$aOETrTA9gwZC0VOp0fE7WufZyuBKuZo73Jja154fPSBL4zfCKbetu', 2, 'JBR188', 'merchant', NULL, '2017-12-12 10:15:43', '2017-12-12 10:15:43', 0),
(231, 'SarisignatureVI', '$2y$10$A0.yaJJvVkbi7ClZjBt4du/T.x6/C/UsEIRd6XapfH8G3IZPKFT22', 2, 'SAR189', 'merchant', NULL, '2017-12-12 10:42:40', '2018-02-02 14:57:48', 0),
(232, 'MontaignePlaceSpa', '$2y$10$qxkmpglJ4eLmR9uCI.tsd.ft4b61zgdoBzGRH3kSo1nxBAMGJByVm', 2, 'MON190', 'merchant', NULL, '2017-12-12 10:44:36', '2017-12-21 12:01:31', 0),
(234, 'GenesisCinemasMaryland', '$2y$10$KEZ0t6FxDZ97Lzq72ul4zuIpBUEqy1j8tvTyn9C4nAWpPEqysodG2', 2, 'GEN192', 'merchant', NULL, '2017-12-13 07:36:24', '2018-03-19 08:26:33', 0),
(235, 'GenesisCinemasThePalms', '$2y$10$i7zRcYt2qZL/M/6b5hOeo.qicw6YB2WhsSJxrRPOQ3PZqgxye5ite', 2, 'GEN193', 'merchant', NULL, '2017-12-13 07:43:41', '2017-12-21 12:04:04', 0),
(236, 'GenesisCinemasNovareMall', '$2y$10$tne/pP8ck3NtkCM466UoPeNylWpgFYnzrXO/2K8by9dBAuQVcGojq', 2, 'GEN195', 'merchant', NULL, '2017-12-13 07:56:30', '2017-12-21 12:04:56', 0),
(237, 'JustgerryBoutique', '$2y$10$MYGUCFG.ERYHYlwcrl5KCeDTEap96Sa5z.nktVB959ZIu24RsBSp6', 2, 'JUS195', 'merchant', NULL, '2017-12-14 08:52:23', '2017-12-21 12:05:56', 0),
(238, 'LohnLagos', '$2y$10$vXRp6Zm6qsrH.J2bX45avO36ZiVW/DgjVAUuMG.RLkSCY9fWWqbki', 2, 'LOH196', 'merchant', NULL, '2017-12-14 09:02:49', '2017-12-21 12:06:53', 0),
(239, 'WearItAll', '$2y$10$BpkQoq6NKrz15pYN66JPUOGg04KG47H86CTzbTZMt/cIkIMPsO/sa', 2, 'WEA197', 'merchant', NULL, '2017-12-14 12:28:30', '2017-12-21 12:07:54', 0),
(240, 'Ideas.ng', '$2y$10$CfTOQM4CWROFTwZ9J6aZp.kKM4N6FfABq8ceslmUx9KpcSXhPCFS.', 2, 'IDE198', 'merchant', NULL, '2017-12-14 14:33:21', '2018-02-23 10:10:26', 0),
(241, 'ZaraAndZoe', '$2y$10$Bd.KLeCSoVIv8MGrEicvE.dx4dBQsxOWnnDgsSSiQEf5pfsJ7/YxO', 2, 'ZAR199', 'merchant', NULL, '2017-12-14 15:01:02', '2017-12-21 12:10:23', 0),
(242, 'kdovesalon', '$2y$10$CxnY1ygPhPUrEwde9/VwHOCkNkcx2f.OAVHaA0MWDhAxds07j/Lpy', 2, 'KD0200', 'merchant', NULL, '2017-12-14 15:33:19', '2018-01-30 16:33:54', 0),
(243, 'TroyShoeFactory', '$2y$10$wCsdBa3MY.0G1tG836BtZ.Ipd4MpXSZ2unpyYvLCkbNpA26ZpPx1a', 2, 'TRO201', 'merchant', NULL, '2017-12-15 08:35:57', '2017-12-21 12:12:06', 0),
(244, 'NextLekki', '$2y$10$wm4Sv8DgHpmXGO5z4cNtwumV8Dycxy9bF.SmyaeTtqlIZ/69JgYsO', 2, 'NEX202', 'merchant', NULL, '2017-12-15 09:03:14', '2017-12-21 12:12:53', 0),
(245, 'NextAnthony', '$2y$10$eN8cxhrv56ZaTTAMQg4GQ.1KJsApZdyYqrCdtb3YUJ547rJy9my06', 2, 'NEX203', 'merchant', NULL, '2017-12-15 09:21:35', '2017-12-21 12:13:41', 0),
(246, 'NextOjuelegba', '$2y$10$EmGXd0/987B./6AhTBC08eYA81V9cIPHAhpxMcM/yq6eAjvrkHmDa', 2, 'NEX204', 'merchant', NULL, '2017-12-15 09:25:54', '2017-12-21 12:14:30', 0),
(247, 'FoodArena', '$2y$10$BGIpS6bX0JI2TJPUL2pAkeaezWUVcG2fCoGSMaxxoga279EcAJsoO', 2, 'FOO205', 'merchant', NULL, '2017-12-15 09:42:37', '2017-12-21 12:16:07', 0),
(261, 'Gategoldsurulere', '$2y$10$b2J1C3s9J0G857NSKMfKz.F.fFHCnhyxywBj0k5lPGZhJ0EVkOzJS', 2, 'GAT222', 'merchant', NULL, '2017-12-19 10:48:03', '2017-12-21 09:36:34', 0),
(262, 'GategoldJabi', '$2y$10$8Ee7pFsvXCf/kHR9LdEe2elyLPbBZj50UxNS.BOvxKo5eQRtzBddS', 2, 'GAT223', 'merchant', NULL, '2017-12-19 11:14:29', '2017-12-21 09:38:19', 0),
(263, 'GategoldWuse2', '$2y$10$q9qCclzsCTnOJ4i89YtZZOgbi5ifVozLNZehYXsGkcv3dMQQfFY9e', 2, 'GAT224', 'merchant', NULL, '2017-12-19 11:19:50', '2018-01-30 16:53:00', 0),
(264, 'GategoldOnitsha', '$2y$10$L8K7hsp8oxv3.gTxn8HqD.11zEmOSJWbkVHsRzAToFyftin34FeVu', 2, 'GAT225', 'merchant', NULL, '2017-12-19 11:27:58', '2017-12-21 09:35:38', 0),
(278, 'MangoRoom', '$2y$10$T/mFTXa7Vd0kONv9pR4jIOjeBsimYzFtF1LzsWRPnlm.1SZSHSB7C', 2, 'MAN0233', 'merchant', NULL, '2018-01-08 08:18:43', '2018-01-08 08:18:43', 0),
(268, 'SilverGrandeur', '$2y$10$u6A6LCXAXIFnCQhijY1hVuO9tcIjblu15oWi98QS5AOsLv6B7CBG2', 2, 'SIL207', 'merchant', NULL, '2018-01-04 07:16:18', '2018-02-23 07:11:48', 0),
(269, 'Brunos', '$2y$10$5Wf1Z2pybcs2nNuHO7MoOuXazu3iEr0wD/yAjT3zGkTlfB2iZnnEW', 2, 'BRU0070', 'merchant', NULL, '2018-01-04 07:16:18', '2018-01-04 07:16:18', 0),
(270, 'Southernsun', '$2y$10$ty3dsG6kT6Jij0zSWCe42.lPDJwfUYUKFKxeCQzW3ilOmn2gF/GLO', 2, 'SOU174', 'merchant', NULL, '2018-01-04 07:16:18', '2018-01-04 07:16:18', 0),
(271, 'smokeybones', '$2y$10$z8kYQGiE7tVSVwknrTEVDuMREJPFC9J54VlNNedQHug4YhIj5wcOe', 2, 'SMO217', 'merchant', NULL, '2018-01-04 07:16:18', '2018-02-06 15:24:49', 0),
(272, 'MagnumStitches', '$2y$10$K.U77rHupP8knV0jD1q/L.fqoB26kdivB4C999tMW3aN6JF0AJ.Vm', 2, 'MAG0025', 'merchant', NULL, '2018-01-04 07:16:18', '2018-02-28 09:57:46', 0),
(273, 'davidWej-vi', '$2y$10$7CELWKP.CzsVwojuIfUPjub79/JalMYBAc7LmU4MGrpGSY632Ggyy', 2, 'DAV210', 'merchant', NULL, '2017-12-15 15:31:40', '2017-12-21 12:21:47', 0),
(274, 'lets_haveachat@yahoo.com', '$2y$10$2eNAJIweUg2baa72lLGjlepTlAPhVucW2z/ccFBZ4gUpYs5UJE90u', 1, 'EMM0025', 'customer', NULL, '2018-01-05 09:38:08', '2018-01-05 09:38:08', 0),
(275, 'ant@gmail.com', '$2y$10$82TsT7FG66S7khuyd.6EYejB6aKJK0UWVnD.fgxcPu3vemoMvNL7a', 1, 'ANT0026', 'customer', NULL, '2018-01-05 10:09:20', '2018-01-05 10:09:20', 0),
(276, 'kdovegym', '$2y$10$.1riw7wdoyYBR4wQemmI0uVaDF.kKUnwueuApiuVwaSIhuOVVOAoS', 2, 'KD0231', 'merchant', NULL, '2018-01-05 10:18:35', '2018-01-30 16:37:47', 0),
(277, 'SarisignatureWuse2', '$2y$10$pXoNJKaZwby074GDqDl.xuaISnx1Ok1DYkm/aSwgpWWBOj5HgyiXW', 2, 'SAR0232', 'merchant', NULL, '2018-01-05 11:07:34', '2018-02-02 14:58:13', 0),
(279, 'Adetorch', '$2y$10$DvzINdh9aNRlJebFcP6s0uoYFQUtWYoWZVmR/DtjoBrJbmpn8LFtK', 2, 'ADE0234', 'merchant', NULL, '2018-01-08 08:29:48', '2018-01-08 08:29:48', 0),
(288, 'LekkiSuites', '$2y$10$VfwvuXu72x1ykMTNo8qTKO3eiei1EmaCkJIFid4qFn8aflt50ruIe', 2, 'LEK0241', 'merchant', NULL, '2018-02-02 14:35:04', '2018-04-18 07:22:41', 0),
(283, 'AdunniOrganics', '$2y$10$6YUNQuAVMw0IGMWndM.RSeuNjDBVWLzHZEGlgAG5fPBbbFmc/vCta', 2, 'ADU0236', 'merchant', NULL, '2018-01-17 11:33:09', '2018-01-17 11:33:09', 0),
(284, 'QuoAbuja', '$2y$10$1FJuC.6Qrakel28ASdZOQOqEU9NKbsdxuvyq.wB1eZk/0sXuqixJa', 2, 'QUO0237', 'merchant', NULL, '2018-01-17 11:46:45', '2018-01-17 11:46:45', 0),
(285, 'GrillLounge', '$2y$10$gpvkFFrj12PDOHmmTWLW3.nz1E2b9SG0jyjnduqzFFejW6NyaPDxK', 2, 'GRI0238', 'merchant', NULL, '2018-01-22 08:14:14', '2018-02-23 10:57:48', 0),
(286, 'JasonPorshe', '$2y$10$DUJemnyD5v.mD2qYUEiioOXiYwZflJ5yNrR/nY9lMD4BhGkGv5ldm', 2, 'JAS0239', 'merchant', NULL, '2018-01-22 08:27:48', '2018-01-22 08:27:48', 0),
(290, 'anthony@gmail.com', '$2y$10$Esz25uaS.BVONiQodAnOy.cafxAmU.b5zAtujUN2s7Wx.FDqN3G.2', 1, 'ANT0029', 'customer', NULL, '2018-02-05 09:56:23', '2018-02-05 09:56:23', 0),
(291, 'damilola@gmail.com', '$2y$10$TJGtdAWQBJc4NFOR1yWFl.sLDiAQnMu4S5Cxv8ZeKGdhnVVq3POAu', 1, 'DAM0030', 'customer', NULL, '2018-02-05 10:03:46', '2018-02-05 10:03:46', 0),
(292, 'eloho@gmail.com', '$2y$10$OmtHOm/erS8dr9RK3AjpHuuaEl8V2QHFbykkr77iEO0eM9mHv2h9e', 1, 'ELO0031', 'customer', NULL, '2018-02-05 11:03:28', '2018-02-05 11:03:28', 0),
(293, 'Maroccaine', '$2y$10$PKI.XEQ9tfAq/ln5QKeND.T7LlRKeDxnz9xXLHpWWh9kMfEY/7Npi', 2, 'MAR0243', 'merchant', NULL, '2018-02-05 12:20:58', '2018-02-05 12:20:58', 0),
(294, 'DoubleASuites', '$2y$10$2abd67xLf2KCPxt.RbT10ucs/dId0f8FB2s/3diM2f5lBxM.n.37G', 2, 'DOU0244', 'merchant', NULL, '2018-02-05 12:42:09', '2018-04-18 07:39:21', 0),
(295, 'TheArtisanLounge&Bar', '$2y$10$W6f6ucnIlfBvInLwKmfGQOog1hcVXbAR94KD9.S0dZJqMJ8DbtdfW', 2, 'TAL0245', 'merchant', NULL, '2018-02-05 12:54:39', '2018-02-19 12:23:02', 0),
(296, 'i-FitnessAgungi', '$2y$10$k/zYtVedp64yHOpJ6rX13u0G8Zz7s9gxtXt6kQxlIbt5YRfBe/fYq', 2, 'IFC0246', 'merchant', NULL, '2018-02-05 13:33:37', '2018-02-19 12:27:33', 0),
(297, 'Jamrock', '$2y$10$H4dcZTwVcLU8Xrow7Zb5zebeRQjdn.uD6h6kJxOomnRonzl30FnM6', 2, 'JAM0247', 'merchant', NULL, '2018-02-05 13:42:50', '2018-02-05 13:42:50', 0),
(298, 'GrandEmperorHotel', '$2y$10$At3ZI7MUCU5m2R/nWiWcCeiL9LFcdn9xqiHIBXe21GZGsXiI6FtDy', 2, 'GRA0248', 'merchant', NULL, '2018-02-05 13:54:57', '2018-02-23 06:45:27', 0),
(299, 'IronBarFitness', '$2y$10$S2qn0QS0vYPkhuKmdhIL/e.uxv0.tz/QuUvwpDsPx0R6CYZvqV9XW', 2, 'IRO0249', 'merchant', NULL, '2018-02-05 14:08:09', '2018-02-21 13:26:15', 0),
(300, 'FlashFactor', '$2y$10$ZxJSHBpke7p8cEqqLJApZOYIwWeVBgfUtvTV7GiwlEgU6Znngt3w2', 2, 'FLA0250', 'merchant', NULL, '2018-02-05 14:28:18', '2018-02-21 13:38:13', 0),
(301, 'NativesRestaurant', '$2y$10$UnNg7TAz0MSQPR/k0O0pR.fBUDiyjoS5Kn1HyBtQEKzY9186gc0TS', 2, 'NAT0251', 'merchant', NULL, '2018-02-05 14:37:23', '2018-02-21 13:42:03', 0),
(302, 'HoloCrunch', '$2y$10$KAw87Esm3EMBAkg1N.ZXnOl2V6pQu7dpCP9xUDTsmFGg/e8Ch1fmy', 2, 'HOL0252', 'merchant', NULL, '2018-02-05 14:52:53', '2018-02-21 13:44:07', 0),
(303, 'MrChangChinese', '$2y$10$fEFvLQHXAM8ADaKzOv.HqOe5RVok30BH4ZmM9gJb4AMpuIadcZbGa', 2, 'MRC0253', 'merchant', NULL, '2018-02-05 15:21:29', '2018-02-22 15:10:23', 0),
(304, 'i-FitnessLekki', '$2y$10$mzH8L6dwNBd2swx8yNDqju1IhJZeg17K3gm10Fzq9/GUsAhfgSVQS', 2, 'IFC0254', 'merchant', NULL, '2018-02-05 15:35:40', '2018-02-19 12:30:21', 0),
(305, 'ReddingtonVI', '$2y$10$kKwLF2tLo2RR/vXu22VSce2XcxxNRfFiBNtxVCRJMMwdc4v6XnwLy', 2, 'TRH0255', 'merchant', NULL, '2018-02-06 08:06:55', '2018-02-21 13:53:32', 0),
(306, 'ReddingtonBreast', '$2y$10$Eg34F3hpACCCzsaFHJqCYOjei4Dcl2isxo8uzl1Xef700Xo7YkK1W', 2, 'TRB0256', 'merchant', NULL, '2018-02-06 08:20:49', '2018-02-21 14:04:13', 0),
(307, 'TheGraysVI', '$2y$10$YOsB.PPQIDF.l8dPCIG.ieTZwxDc9answt6OZuEc4otCq/2W/0uGe', 2, 'TGC0257', 'merchant', NULL, '2018-02-06 08:31:11', '2018-02-06 08:31:11', 0),
(308, 'TheGraysIkeja', '$2y$10$a1nCdO1lOAUpJiERifKPFuq1E9kQ/0hJggUrdPbTuNrTbgaXuVTzW', 2, 'TGC0258', 'merchant', NULL, '2018-02-06 09:01:13', '2018-02-21 15:05:14', 0),
(309, 'MaxySuper', '$2y$10$rSA0wbETz9QNRJNL1DM4Le00qH3QnZs4PM1cKFzXFibbTb7kLCHe6', 2, 'MAX0259', 'merchant', NULL, '2018-02-06 09:11:58', '2018-02-21 15:07:28', 0),
(310, 'ReddingtonMedical', '$2y$10$lYEdhdWfDC.f72dYn441.u.CHZuiTZ0QXtXOuCFg30vu6/cHajOi2', 2, 'TRM0260', 'merchant', NULL, '2018-02-06 09:35:16', '2018-02-21 15:08:52', 0),
(311, 'PhoebesCakes', '$2y$10$w2TJ9wVBJQEhkBAgHOJ/cuIsFchc43BgTZN/T.Crx3Wpf6mKTZ2mq', 2, 'PHO0261', 'merchant', NULL, '2018-02-08 07:44:03', '2018-02-21 15:14:09', 0),
(312, 'UniqueNails', '$2y$10$oNEU99pimU0mxc0UZmxz8ejvpWLsBAbFCFgTk71hewFbDvLl4/21S', 2, 'UNI0262', 'merchant', NULL, '2018-02-08 07:56:48', '2018-02-08 07:56:48', 0),
(313, 'BeniApartments', '$2y$10$9QYuJwNpTEmYq5nTqKQ5L.itEH2NE4dHfO21n73BtJzRur15HaYaO', 2, 'BEN0263', 'merchant', NULL, '2018-02-08 08:05:42', '2018-02-08 08:05:42', 0),
(314, 'AlbaLounge', '$2y$10$Dc6dDhWAT6kHixtw2MSPD.pVgeX1PrfEnjosoW3DWEAl.yJZO4kUq', 2, 'ALB0264', 'merchant', NULL, '2018-02-08 08:12:13', '2018-02-08 08:12:13', 0),
(315, 'BungalowVI', '$2y$10$KpqLZtK0vii.FVgICt3i9.24MXnktrYTCr9dVn0.yHMfKjVRg7pMC', 2, 'BUN0265', 'merchant', NULL, '2018-02-09 07:03:32', '2018-02-09 07:03:32', 0),
(316, 'BungalowIkeja', '$2y$10$61faIcezWnGPFA0hOgQocufjARWU491Ex75Se4GIGnOhx9JYfpkBa', 2, 'BUN0266', 'merchant', NULL, '2018-02-09 07:09:24', '2018-02-09 07:09:24', 0),
(355, 'nogosaomoruyi80@gmail.com', '$2y$10$mkwcSc35GRIrK7oGoZZ9IeZfL3OSkanIhyUFl6moFG76si/QwW7Xu', 1, 'NOG0033', 'customer', NULL, '2018-02-23 11:04:58', '2018-02-23 11:04:58', 0),
(318, 'LavivaBridal', '$2y$10$hpwMTtEg9d03ENGyjrLbKuBF7yMzOjn1nNYrzVyxuywptiUD4/UU2', 2, 'LAV0268', 'merchant', NULL, '2018-02-09 07:36:49', '2018-02-09 07:36:49', 0),
(319, 'Hotstyles9ja', '$2y$10$2bIMNcO7FeRKRcm9YoKMeeBplYWRzLu7lJcL3cDLnsZTaLxuTPFnu', 2, 'HOT0269', 'merchant', NULL, '2018-02-09 07:43:23', '2018-02-09 07:43:23', 0),
(320, 'Carrierbags', '$2y$10$XjmhwyBfL5Fe8Gr9pcfTIeufAz4L4V3IYshz78Gy0FKza4VTupO2G', 2, 'CAR0270', 'merchant', NULL, '2018-02-09 07:55:37', '2018-02-20 13:31:54', 0),
(321, 'Johncollins', '$2y$10$Rh4YAIDPJM6EXK2bLxu7EuP7u8YehOXUzb5jxUFZf/UbgbcdPtteq', 2, 'JOH0271', 'merchant', NULL, '2018-02-09 08:09:52', '2018-02-09 08:09:52', 0),
(322, 'olakola@gmail.com', '$2y$10$Lw4KC82QSOZvDRTVtDBwNegxyuvrwNq.ASIy4tQdBFMGYKFJ7Z8D.', 1, 'OLA0032', 'customer', NULL, '2018-02-09 12:43:11', '2018-02-09 12:43:11', 0),
(323, 'DHubPharmacy', '$2y$10$onfcwv7jgLyjFJYNluBK9.u4lOpIeoi848cW8TqT10FJn0E0qCfn2', 2, 'DHP0272', 'merchant', NULL, '2018-02-14 08:18:20', '2018-02-14 08:18:20', 0),
(324, 'FarmDirect', '$2y$10$ZkxJJYDkaXaz3/L3g6pp5uBIsRsf5eNcFbURMpfkz9lmL0bowjCqC', 2, 'FAR0273', 'merchant', NULL, '2018-02-15 08:40:06', '2018-02-15 08:40:06', 0),
(325, 'AngelHospitality', '$2y$10$uTqgP6OGnCN6OideRA.Ad.0OX4daIKhJ58QOboRBao4LMFeIRgDxu', 2, 'ANG0274', 'merchant', NULL, '2018-02-15 08:48:04', '2018-02-15 08:48:04', 0),
(326, 'Amazonplus', '$2y$10$ZcMnh0XtBvLwRAbslB6f7.0kwDW6YuofAZg4plsFk6OI2A0AA6ttC', 2, 'AMA0275', 'merchant', NULL, '2018-02-15 08:53:32', '2018-02-15 08:53:32', 0),
(327, 'PrimeChinese', '$2y$10$hIxxQE1RIbwOJxeT/0T0r.wUDwWxY6CReVU5y.BZchi8hHDTppt4C', 2, 'PRI0276', 'merchant', NULL, '2018-02-15 09:05:10', '2018-02-15 09:05:10', 0),
(328, 'ChesneyHotel', '$2y$10$7RhhKHNZvt73a2Jdbdfrie2n20q7J.ph.rQwIK1e9qR3xOvQxOgqi', 2, 'CHE0277', 'merchant', NULL, '2018-02-15 09:09:47', '2018-02-15 09:09:47', 0),
(329, 'SiodHandcrafted', '$2y$10$9vNoHOHMLXr71yoNrCld3.GTDFWcSKhD4nkGpha2BEVTyPPt1BlIy', 2, 'SIO0278', 'merchant', NULL, '2018-02-15 09:15:11', '2018-02-15 09:15:11', 0),
(330, 'TheLondoner', '$2y$10$b887wdukma9JM4q5q8AEHOTEzwx/6qQdBkpi5WHYsBjGwsHG1KcoK', 2, 'TLR0279', 'merchant', NULL, '2018-02-15 09:43:22', '2018-02-15 09:43:22', 0),
(331, 'Bloomkids', '$2y$10$T6PS0T/Dugo92St2qmP5yOCf2n3vvZL69uS8AxYFLA.r9k5F.mY7S', 2, 'RUT0280', 'merchant', NULL, '2018-02-15 13:09:25', '2018-02-15 13:09:25', 0),
(332, 'Gharnets', '$2y$10$eXA/fMkflThNkvn7.AI0S.zOLlcOsHMwZa7rZ/o4pA.6eqCim4UTe', 2, 'GHA0281', 'merchant', NULL, '2018-02-15 13:17:57', '2018-03-29 10:21:10', 0),
(333, 'RubiesLounge', '$2y$10$JoXGX43Kato0HrcYK40O3eRDBBIQopEKAc0Hn7lt91OTBy5g48lPG', 2, 'RUB0282', 'merchant', NULL, '2018-02-15 13:24:24', '2018-02-22 13:03:45', 0),
(334, 'CallidoraStudios', '$2y$10$7Ack0mkUQhKt7QgYNo6WNODG8kkSsQ7xXyiAd5qoc.uPMjqzgdWei', 2, 'CAL0283', 'merchant', NULL, '2018-02-15 13:40:10', '2018-02-15 13:40:10', 0),
(335, 'OgeSignature', '$2y$10$bN9iYdeS/GyqM8C8zpzodeBRHGwzXPX/7FMp4inLwlFeOAKP.RbnO', 2, 'OGE0284', 'merchant', NULL, '2018-02-15 13:47:44', '2018-02-22 11:17:26', 0),
(336, 'HavannahHotel', '$2y$10$r6SLslCy0YGhNwSuxUpad.qsIGxMb8sXYTgn.ESk/ky/tqw64cZ.q', 2, 'HAV0285', 'merchant', NULL, '2018-02-15 13:56:13', '2018-02-15 13:56:13', 0),
(337, 'ClemsMakeup', '$2y$10$kFz.vJHcJwN4X6Uc3RfX9.v2MHoQ743mfat0almycytNPivnjOqUa', 2, 'CLE0286', 'merchant', NULL, '2018-02-15 14:05:33', '2018-02-15 14:05:33', 0),
(338, 'FacedealHouse', '$2y$10$45cx5QPQ7koW8U2kRdyb/.Osdgj9SxMzWRpwLaeWk.tqTwKQ7LpSu', 2, 'FAC0287', 'merchant', NULL, '2018-02-15 14:17:28', '2018-02-15 14:17:28', 0),
(339, 'NaomiCollections', '$2y$10$oSUDv5/Utat4ek5ct5cgFOSiXdxk8AsVTwHOvAmxLXq6awddhOQ2y', 2, 'NAO0288', 'merchant', NULL, '2018-02-15 14:54:12', '2018-02-15 14:54:12', 0),
(340, 'PurpleWardrobe', '$2y$10$Rc6MWyjg3vm/ibmHmewGz.Vla9IW25vPFRnEV116I9AyyPNz13wNu', 2, 'PUR0289', 'merchant', NULL, '2018-02-16 09:32:51', '2018-02-20 11:05:13', 0),
(341, 'BlessedIfy', '$2y$10$QOdeGkzrT9Rwhw8qZPn0MO.9bTSvJxZxFMyg5S2IvjtF5A.b51CKm', 2, 'BLE0290', 'merchant', NULL, '2018-02-16 09:38:49', '2018-02-16 09:38:49', 0),
(342, 'GorggiesMakeovaz', '$2y$10$TVFMBQ7ovx30E/Ih9ZGDiu9CQ5qkE9DxuUAHhhhcm8/dEzMRGapuG', 2, 'GOR0291', 'merchant', NULL, '2018-02-16 09:49:10', '2018-02-16 09:49:10', 0),
(343, 'VillaSofia', '$2y$10$UzMaw9scPFKK5FrUIbFPYO8pZ4onYEVhKxdoqmfmT/LuUWh4UIiOK', 2, 'VIL0292', 'merchant', NULL, '2018-02-16 10:15:07', '2018-02-16 10:15:07', 0),
(344, 'Olam\'Creations', '$2y$10$aXTrpgkGDCbawvBe7AnfgORCQZkSS.mINAOthGVI2OQcoufG/m3q.', 2, 'OLC0293', 'merchant', NULL, '2018-02-16 10:22:06', '2018-03-05 09:47:32', 0),
(345, 'RyderLounge', '$2y$10$da5zK5hCRrxEv9ghe.TbW.8Jg9QxY5YGbcJDLt8GVfMtoTY9Hyeba', 2, 'RYD0294', 'merchant', NULL, '2018-02-16 10:29:24', '2018-02-16 10:29:24', 0),
(346, 'SmoothitFresh', '$2y$10$nP.cssgWy9c8L6wa.MkJ3.N.s4.OxjCwBQFYkJm8vTGuNZ7V4WLJi', 2, 'SMO0295', 'merchant', NULL, '2018-02-16 12:34:16', '2018-02-16 12:34:16', 0),
(347, 'OlatoksKiddies', '$2y$10$e4TIXZwwEjQlM9grXsRk5ez3x4VauKMShryF/e0MMg44XaaDEat8q', 2, 'OLA0296', 'merchant', NULL, '2018-02-16 12:42:36', '2018-02-16 12:42:36', 0),
(348, 'ZalimasInteriors', '$2y$10$gT5GsNBAehmZKUU/YWBiA.M6Hm1WwprC.IVL9beVm1WQAmvO3J5ta', 2, 'ZAL0297', 'merchant', NULL, '2018-02-16 13:38:06', '2018-02-16 13:38:06', 0),
(349, 'ParachHub', '$2y$10$aDkrhtTQJUrXcMVOTYX5leHRp4f/L1Sd/Vg02qPE7gd5uGs756WOm', 2, 'PAR0298', 'merchant', NULL, '2018-02-16 13:48:25', '2018-02-16 13:48:25', 0),
(350, 'Brass&Copper', '$2y$10$bK6nPN/O.qiKq8DI7aR/xuOceBjp3gVx2b2LoNTm/GS.Eygs/Ib8S', 2, 'BRA0299', 'merchant', NULL, '2018-02-16 13:58:43', '2018-02-16 13:58:43', 0),
(351, 'i-FitnessSangotedo', '$2y$10$2frNQj/IleUvaCNUkSQmceEo9/rNrG6Wtf0skV7trdy87RHOGHOQS', 2, 'IFC0300', 'merchant', NULL, '2018-02-19 12:36:31', '2018-03-05 09:48:21', 0),
(352, 'i-FitnessVGC', '$2y$10$Li4yes2Js6wmHdb9dbo5TOzX1lGizfUohwn/vgfWQ1cw/9ThxCnqW', 2, 'IFC0301', 'merchant', NULL, '2018-02-19 12:49:29', '2018-03-05 09:49:17', 0),
(353, 'SSDental', '$2y$10$GmYJtZlmZxo06Kde99nqw.cFfmkd9PwFuPCspmVcHMeFfHKMSjcqy', 2, 'SSD0302', 'merchant', NULL, '2018-02-21 07:03:33', '2018-02-21 09:04:26', 0),
(354, 'S&SHotels', '$2y$10$JDH181MkGEvaIBmUd7IlAOM4UNczDqQbvXnXu6PKKj1wE1YN4Ylqi', 2, 'SS0303', 'merchant', NULL, '2018-02-21 07:15:54', '2018-02-21 08:07:23', 0),
(356, 'CprLekki', '$2y$10$96G8cwu9FCWRavfGRHCr9uv3O9YljNzKRPYBL2h2YJUfOn8mFWOm6', 2, 'CPR0304', 'merchant', NULL, '2018-02-23 13:17:37', '2018-02-23 14:22:55', 0),
(357, 'CprIkeja', '$2y$10$FeqwmpdbmsT8pZnBnqan1OOCMBC6VL/x/lrsE27jwka49mpgcYfWa', 2, 'CPR0305', 'merchant', NULL, '2018-02-23 13:23:16', '2018-02-23 14:12:11', 0),
(358, 'CprMaryland', '$2y$10$2/sM.5sOADee1fRaBWJ4D.Oxv.TCPFLVcVcwawmmh3FQ8Ph4yH50K', 2, 'CPR0306', 'merchant', NULL, '2018-02-23 13:29:08', '2018-02-23 13:29:08', 0),
(359, 'CprPalms', '$2y$10$8JmNU3kf2c8KPLzNPELYje.mUu8DvFeszjf9V6b.YtbuggTbf8wUG', 2, 'CPR0307', 'merchant', NULL, '2018-02-23 13:34:05', '2018-02-23 14:12:40', 0),
(360, 'AngelosTown', '$2y$10$KQ6fuBczLxiAvpbRCHA/HOyuHhfrOfT4KZ0N9TCYOsWlObOVMhwnG', 2, 'ANG0308', 'merchant', NULL, '2018-02-23 13:41:58', '2018-02-23 13:41:58', 0),
(361, 'AngelosMetro', '$2y$10$VIb4qddP7swLsUzUT0ipYeKypLNjbdNVVBUNF/h287wiI1kfhNUte', 2, 'ANG0309', 'merchant', NULL, '2018-02-23 14:18:46', '2018-02-23 14:18:46', 0),
(362, 'PelssyWines', '$2y$10$RRDS1BkpeRRd6egsWEv4HupiUkUfi/Bl8inJ9NUFiAAkEH8CaRrVy', 2, 'PEL0310', 'merchant', NULL, '2018-02-26 07:34:00', '2018-02-26 07:34:00', 0),
(363, 'KonibblesContemporary', '$2y$10$AZLU5A3MF8.ZslH2IlecRudSKYyoZTXRG/L1rCOFq.8Q/f8zdHUiW', 2, 'KON0311', 'merchant', NULL, '2018-02-26 08:00:26', '2018-02-26 08:00:26', 0),
(364, 'HouseOfJojo', '$2y$10$YraH7dzi17G9nclvQLmnfe3iJ3VdnFMsg9A5U57eLNOk7kN4lo49O', 2, 'HOU0312', 'merchant', NULL, '2018-02-26 08:10:20', '2018-02-26 08:10:20', 0),
(365, 'SouthTown', '$2y$10$nmcFYTIFT6trNHhMWJXP.uRs9fJ3Aeg2tfEIxEh53mykddrWmITgm', 2, 'SOU0313', 'merchant', NULL, '2018-02-26 12:25:22', '2018-02-26 12:25:22', 0),
(366, 'Julixjuicy', '$2y$10$5q3uf5gQUwrJqgUtTA9rZ.Px.ZFvsFug5UupsWRAf/TuWzLHegq0.', 2, 'JUL0314', 'merchant', NULL, '2018-02-26 12:43:26', '2018-02-26 12:43:26', 0),
(367, 'MothersPride1', '$2y$10$0WF0bnfb/3q9shidx8zeGuhSqSoji5FkOucquIf1UtCfqduPp3wTm', 2, 'MOT0315', 'merchant', NULL, '2018-02-26 12:59:15', '2018-02-27 10:39:43', 0),
(368, 'CraveBySharon', '$2y$10$z8WfvGgnPBmRc1RoNFIWH.t1sMDQlYXFbTs3WidnuSK.vLly0Turm', 2, 'CRA0316', 'merchant', NULL, '2018-02-26 13:24:27', '2018-02-26 13:24:27', 0),
(369, 'TheKabaal', '$2y$10$waDmGYCkYaSNSF5vBECPl.pD6Tqkz0Y6rCd/Hg9GyfFjGYSnKozG.', 2, 'TKB0317', 'merchant', NULL, '2018-02-26 13:42:36', '2018-02-26 13:42:36', 0),
(370, 'Debeauty', '$2y$10$Li6bAjiMDPiTCkcAE2q8xOqlxiXyCJmaXHkQeksroubxEDLbukoYe', 2, 'DBS0318', 'merchant', NULL, '2018-02-26 14:49:06', '2018-02-26 14:49:06', 0),
(371, 'Arshablecakes', '$2y$10$b85Q3pk.sYTrh.bqbNwege19Chn8PGa7q210n4VCuDY1K9Jw8PWGe', 2, 'ARS0319', 'merchant', NULL, '2018-02-26 15:05:13', '2018-02-26 15:05:13', 0),
(372, 'BlueDreamOgunsanya', '$2y$10$kSqfmaDnEJUGU0jpev.arOHJtF9EV1tGATrNhRR9daqgKLbeHxPfi', 2, 'BLU0320', 'merchant', NULL, '2018-02-27 07:13:51', '2018-02-27 10:20:44', 0),
(373, 'Bolarfaj', '$2y$10$7PDH6C7pd4KLWRIyL0kkF.48Vk3TG.pIr8RuVv6eWCKFVf52bZC8q', 2, 'BOL0321', 'merchant', NULL, '2018-02-27 07:54:43', '2018-02-27 07:54:43', 0),
(374, 'LifeImages', '$2y$10$PiJSgs3yjgTsRTsVMUHKc.kiogp5rqzN5o8LDkKBcnbRRyejjfMMC', 2, 'LIF0322', 'merchant', NULL, '2018-02-27 08:32:08', '2018-02-27 10:33:44', 0),
(375, 'BlueDreamClegg', '$2y$10$L5dVb8J7pAcqjkyhTWZPlOwI5UXJ8Q2BJg7iYwHYj1m6BuhgcRN0a', 2, 'BLU0323', 'merchant', NULL, '2018-02-27 09:03:11', '2018-02-27 11:09:13', 0),
(376, 'BlueDreamIshaga', '$2y$10$n4E/LLEh9hGYsj4eQ6uv0u5sLRtQxfNC2TYN9SUIzbLC/SFE5NvpG', 2, 'BLU0324', 'merchant', NULL, '2018-02-27 09:15:22', '2018-02-27 11:10:01', 0);
INSERT INTO `users` (`id`, `username`, `password`, `group_id`, `details_id`, `user_type`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(377, 'Mother\'sPride2', '$2y$10$Q596CZvQBdF5oXXV1CA5a.La8uog5f3BI9k48ih6iXphYPun5HKNy', 2, 'MOT0325', 'merchant', NULL, '2018-02-27 10:06:14', '2018-03-05 09:50:41', 0),
(378, 'TejuveeBeauty', '$2y$10$smBquaF2GNBuUJVZ8UG7W.SrDu8WDPrwsA8Zt2n6hnNS9ezgzCDTK', 2, 'TJB0326', 'merchant', NULL, '2018-02-27 11:55:56', '2018-02-27 11:55:56', 0),
(379, 'StudioStylist', '$2y$10$3tqNSxN7LJcyQQSnr.NQBu0JtI36YtcLPVjXNj63e.ymGGyqp9zP6', 2, 'STU0327', 'merchant', NULL, '2018-02-27 13:38:26', '2018-02-27 13:38:26', 0),
(380, 'BodyProFitness', '$2y$10$SNFzT3Ij/eRNral6GAzrA.dvtW2yaA3j2/6osvNdjWlkJdvkbASDO', 2, 'BOD0328', 'merchant', NULL, '2018-02-28 11:36:37', '2018-02-28 11:36:37', 0),
(381, 'DoranneBeautyIkeja', '$2y$10$sj0dCsf.o4tODThKmL9w5OR0eC6T6LAsidN/5FySaBhsRN51Fi6om', 2, 'DOR0329', 'merchant', NULL, '2018-02-28 12:17:12', '2018-02-28 12:17:12', 0),
(382, 'WsBakeShop', '$2y$10$qfloEfl9QMYQtdAyWLLg1OXE0EFBY7QrDxzwBuo7iDoJStqNp1Y/i', 2, 'WBS0330', 'merchant', NULL, '2018-02-28 13:27:53', '2018-02-28 13:27:53', 0),
(383, 'CrossfitLagosGym', '$2y$10$/CFaT6GZOuPyGA88vjoDMOHpucDr2ghRFVdAq1BwuE6ucVQQP.s0.', 2, 'CRO0331', 'merchant', NULL, '2018-02-28 13:54:41', '2018-02-28 13:54:41', 0),
(384, 'Wooddesignes', '$2y$10$olw8ZYKLeuLCqv8Z0JTwoOptRHCMdfR/FW12e8YWIyzh7/xKhFIO2', 2, 'WOO0332', 'merchant', NULL, '2018-03-01 07:46:31', '2018-03-01 07:46:31', 0),
(385, 'iamadrianagbi@gmail.com', '$2y$10$p6AicvknB.TcEVe1uMSEq.DuaFZjxqOAdXWQV04dVYHthiq06gvi6', 1, 'ADR0034', 'customer', NULL, '2018-03-08 14:39:31', '2018-03-08 14:39:31', 0),
(386, 'KidzDomain', '$2y$10$bi1j5mI.fX4gXn0WE32F6u2lr7XJTNn/oUSMMzS6b1vzoj70wm2Wu', 2, 'KID0333', 'merchant', NULL, '2018-03-16 08:22:01', '2018-03-16 08:22:01', 0),
(387, 'NuelsPlace', '$2y$10$M/6nz6bwl1Ec/8xotd9nJuW07xi/wC1tN6Gmf772KQsIlb0ttDHIO', 2, 'NUE0334', 'merchant', NULL, '2018-03-16 13:12:27', '2018-03-16 13:12:27', 0),
(388, 'Cceramica', '$2y$10$Hqg1z/hCvsEpIg8YrCqDYuo6ohveFUb.Y8fdD0zydrY71KhueWmGS', 2, 'CCL0335', 'merchant', NULL, '2018-03-16 13:21:19', '2018-03-16 13:21:19', 0),
(389, 'CelonDentalIbeju', '$2y$10$61pITHQJXYCtfR6vwi1BO.0HNxtkhviMwjxvX3J.z3N0pn0UVzBQu', 2, 'CEL0336', 'merchant', NULL, '2018-03-20 13:28:48', '2018-03-20 13:28:48', 0),
(390, 'TheLekkiColiseum', '$2y$10$JtBNgUdoUHh.8KgpXY6SiOC.oKh23HK2Y3iTM9h/gy/E4vyYjv.M2', 2, 'THE0337', 'merchant', NULL, '2018-03-21 08:00:22', '2018-03-21 08:00:22', 0),
(391, 'FlashFactorPH', '$2y$10$wbNp56JH9Gbfh7kPuSnCGuMK19Fs51buuv3SGR7bgpDJc3x8gIF0S', 2, 'FLA0338', 'merchant', NULL, '2018-03-23 10:48:33', '2018-03-23 10:48:33', 0),
(392, 'UltidentDentalSangotedo', '$2y$10$fTu5lLHL80417OK2UJJ96uceGD.PI4kngFt1ElmWeuMo4Ri2Vru3a', 2, 'ULT0339', 'merchant', NULL, '2018-03-28 07:33:37', '2018-03-28 07:33:37', 0),
(393, 'UltidentDentalAjah', '$2y$10$rw6hGSbTG03M9CTptMw2PuX/gq9N3NM1eC6u3rWqacuLDuNf7U3HW', 2, 'ULT0340', 'merchant', NULL, '2018-03-28 07:43:41', '2018-03-28 07:43:41', 0),
(394, 'Wealthstones', '$2y$10$JBdVR3epOY90WaWnE/7GwOgEzCfWG387OMpTyiU8jivovJ463Zkny', 2, 'WEA0341', 'merchant', NULL, '2018-03-28 08:11:40', '2018-03-28 08:11:40', 0),
(395, 'WessyCreationsAbeokuta', '$2y$10$EKBR3Jy/rQN3PKsxXOFYzuAWt7vaPn14kLi7k57px38XQmuJzPrae', 2, 'WES0342', 'merchant', NULL, '2018-03-29 11:08:41', '2018-03-29 11:08:41', 0),
(396, 'PurpleRay', '$2y$10$TPlMa6MrdQAViWgMfgT92OaozP5j.5rc5uyiLGUPRIUdRmxm.wqIm', 2, 'PUR0343', 'merchant', NULL, '2018-03-29 11:46:42', '2018-03-29 11:46:42', 0),
(397, 'WessyCreationIkeja', '$2y$10$HZZtQHdWwZL9c8yQwAXGK.Ig7fOGcquuAgo0evk66uBBDVMjVCqJa', 2, 'WES0101', 'merchant', NULL, '2018-04-12 13:58:23', '2018-04-13 06:59:11', 0),
(399, 'HistouchDiagnostic', '$2y$10$WNX18912YaLqRNmg517Qk.eSukierU7K9Yje2u3mM1QernUpiF4hK', 2, 'HIS0346', 'merchant', NULL, '2018-04-17 12:20:44', '2018-04-17 12:20:44', 0),
(400, 'nelokwaz@gmail.com', '$2y$10$rs7qFjq6yMh4mpf6NIDuJuIqCiyw1Y74liNSZ2lX4MjPzgZ79vc2W', 1, 'CHI0035', 'customer', NULL, '2018-05-03 07:42:55', '2018-05-03 07:42:55', 0),
(401, 'nellyhr02@gmail.com', '$2y$10$e77APKFmHAXyhxYofujinev4nvcQJZG3Wlc3kAWCQARE4td.baqQi', 1, 'CHI0036', 'customer', NULL, '2018-05-04 18:07:02', '2018-05-04 18:07:02', 0),
(402, 'test@yahoo.com', '$2y$10$s2jiyqJ5tdixg39UX.W/1eQQ4S4Avj8qOl1mPfKDviWFRHAi0FVMS', 1, 'TRY0037', 'customer', NULL, '2018-05-07 08:02:05', '2018-05-07 08:02:05', 0),
(403, 'lekki@gmaill.com', '$2y$10$SLUjfrlY1NDJ4Z02B5779e179P0IVkJ1aIN.S4NcLhsGRil9rBW4m', 1, 'ANT0038', 'customer', NULL, '2018-05-07 08:16:18', '2018-05-07 08:16:18', 0),
(409, 'yinkaadeniran@gmail.com', '$2y$10$pHVgiOYHABmkY/D3g/Xv3.3h6MAATa4S3iBALnKS2LLr8IBILb2Li', 3, 'AD1526659836', 'admin', NULL, '2018-05-18 16:10:36', '2018-05-18 16:10:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vpas`
--

CREATE TABLE `vpas` (
  `id` int(11) NOT NULL,
  `service` text NOT NULL,
  `description` text NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `contact_means` varchar(255) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(200) NOT NULL DEFAULT 'Pending',
  `in_charge` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vpas`
--

INSERT INTO `vpas` (`id`, `service`, `description`, `delivery_date`, `delivery_time`, `phone`, `contact_means`, `customer_id`, `created_at`, `updated_at`, `status`, `in_charge`) VALUES
(1, 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'EDR-0009', '2018-05-14 10:39:50', '2018-05-20 16:50:16', 'Pending', 'Yinka Adeniran'),
(2, 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'EDR-0009', '2018-05-14 12:27:32', '2018-05-20 16:50:01', 'In Progress', 'Superadmin'),
(3, 'Shopping – Groceries, Gift items, Home items, office supplies', 'Get items for my sons birthday', '2018-05-14', '02:10', '30193092390239', 'Phone Call', 'EDR-0009', '2018-05-14 13:09:57', '2018-05-20 16:51:15', 'In Progress', 'Superadmin'),
(4, 'Shopping – Groceries, Gift items, Home items, office supplies', 'Shop for my sons birthday', '2018-05-17', '02:11', '49834983838', 'Phone Call', 'EDR-0009', '2018-05-14 13:11:40', '2018-05-22 17:52:28', 'Closed', 'Superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `waitlisted_products`
--

CREATE TABLE `waitlisted_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waitlisted_product_category_id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waitlisted_products`
--

INSERT INTO `waitlisted_products` (`id`, `name`, `price`, `supplier_name`, `created_at`, `updated_at`, `waitlisted_product_category_id`, `avatar`) VALUES
(1, 'Gucci Leather Casual Shoe', '42000', 'Gucci Store New York', '2018-05-22 08:04:09', '2018-05-22 08:04:09', 1, 'images/1526979849.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `waitlisted_product_categories`
--

CREATE TABLE `waitlisted_product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waitlisted_product_categories`
--

INSERT INTO `waitlisted_product_categories` (`id`, `name`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Shoes', 'images/1526979520.jpeg', '2018-05-22 07:58:40', '2018-05-22 08:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `waitlisted_product_gallery`
--

CREATE TABLE `waitlisted_product_gallery` (
  `id` int(11) NOT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `waitlisted_product_id` int(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waitlisted_product_gallery`
--

INSERT INTO `waitlisted_product_gallery` (`id`, `avatar`, `waitlisted_product_id`, `created_at`) VALUES
(1, 'images/1526980025.jpeg', 1, '2018-05-22 09:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `waitlisted_product_requests`
--

CREATE TABLE `waitlisted_product_requests` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waitlisted_product_id` varchar(11) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waitlisted_product_requests`
--

INSERT INTO `waitlisted_product_requests` (`id`, `created_at`, `updated_at`, `waitlisted_product_id`, `customer_id`, `in_charge`, `status`) VALUES
(1, '2018-05-22 10:04:23', '2018-05-22 09:05:24', '1', 'EDR-0009', 'Superadmin', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `wardrobe_stylings`
--

CREATE TABLE `wardrobe_stylings` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(300) NOT NULL,
  `personal_style` varchar(2000) DEFAULT NULL,
  `feel` varchar(2000) DEFAULT NULL,
  `sense_of_style` varchar(2000) DEFAULT NULL,
  `preffered_store` varchar(200) DEFAULT NULL,
  `frequent_event` varchar(200) DEFAULT NULL,
  `reason` varchar(2000) DEFAULT NULL,
  `budget` varchar(80) DEFAULT NULL,
  `in_charge` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_admin_id_unique` (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `airport_concierges`
--
ALTER TABLE `airport_concierges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bespoke_products`
--
ALTER TABLE `bespoke_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bespoke_product_category_id` (`bespoke_product_category_id`);

--
-- Indexes for table `bespoke_product_categories`
--
ALTER TABLE `bespoke_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bespoke_product_gallery`
--
ALTER TABLE `bespoke_product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`bespoke_product_id`);

--
-- Indexes for table `bespoke_product_requests`
--
ALTER TABLE `bespoke_product_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bespoke_product_id` (`bespoke_product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `bespoke_travels`
--
ALTER TABLE `bespoke_travels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_id_unique` (`customer_id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_event`
--
ALTER TABLE `customer_event`
  ADD KEY `customer_event_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_event_event_id_foreign` (`event_id`);

--
-- Indexes for table `customer_experiences`
--
ALTER TABLE `customer_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_experiences_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_experiences_experience_id_foreign` (`experience_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD KEY `customer_group_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_group_group_id_foreign` (`group_id`);

--
-- Indexes for table `customer_interest`
--
ALTER TABLE `customer_interest`
  ADD KEY `customer_interest_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_interest_interest_id_foreign` (`interest_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_group_id_foreign` (`group_id`);

--
-- Indexes for table `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`event_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`experience_id`),
  ADD UNIQUE KEY `experiences_experience_name_unique` (`experience_name`);

--
-- Indexes for table `experience_gallery`
--
ALTER TABLE `experience_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`experience_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_gallery`
--
ALTER TABLE `group_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interest_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_merchant_id_unique` (`merchant_id`),
  ADD KEY `merchants_category_id_foreign` (`category_id`);

--
-- Indexes for table `merchant_categories`
--
ALTER TABLE `merchant_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `merchant_gallery`
--
ALTER TABLE `merchant_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`merchant_id`);

--
-- Indexes for table `merchant_offers`
--
ALTER TABLE `merchant_offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `merchant_offers_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_shoppings`
--
ALTER TABLE `personal_shoppings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `reviews_customer_id_foreign` (`customer_id`),
  ADD KEY `reviews_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_customer_id_foreign` (`customer_id`),
  ADD KEY `transactions_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_group_id_index` (`group_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `vpas`
--
ALTER TABLE `vpas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waitlisted_products`
--
ALTER TABLE `waitlisted_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waitlisted_product_category_id` (`waitlisted_product_category_id`);

--
-- Indexes for table `waitlisted_product_categories`
--
ALTER TABLE `waitlisted_product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waitlisted_product_gallery`
--
ALTER TABLE `waitlisted_product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`waitlisted_product_id`);

--
-- Indexes for table `waitlisted_product_requests`
--
ALTER TABLE `waitlisted_product_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bespoke_product_id` (`waitlisted_product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `wardrobe_stylings`
--
ALTER TABLE `wardrobe_stylings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `airport_concierges`
--
ALTER TABLE `airport_concierges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bespoke_products`
--
ALTER TABLE `bespoke_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bespoke_product_categories`
--
ALTER TABLE `bespoke_product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bespoke_product_gallery`
--
ALTER TABLE `bespoke_product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bespoke_product_requests`
--
ALTER TABLE `bespoke_product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bespoke_travels`
--
ALTER TABLE `bespoke_travels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `customer_experiences`
--
ALTER TABLE `customer_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `event_gallery`
--
ALTER TABLE `event_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `experience_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `experience_gallery`
--
ALTER TABLE `experience_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `group_gallery`
--
ALTER TABLE `group_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `group_posts`
--
ALTER TABLE `group_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `interest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT for table `merchant_categories`
--
ALTER TABLE `merchant_categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `merchant_gallery`
--
ALTER TABLE `merchant_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `merchant_offers`
--
ALTER TABLE `merchant_offers`
  MODIFY `offer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `personal_shoppings`
--
ALTER TABLE `personal_shoppings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rating_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vpas`
--
ALTER TABLE `vpas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `waitlisted_products`
--
ALTER TABLE `waitlisted_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `waitlisted_product_categories`
--
ALTER TABLE `waitlisted_product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `waitlisted_product_gallery`
--
ALTER TABLE `waitlisted_product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `waitlisted_product_requests`
--
ALTER TABLE `waitlisted_product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wardrobe_stylings`
--
ALTER TABLE `wardrobe_stylings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
