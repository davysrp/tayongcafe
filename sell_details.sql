-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2025 at 02:08 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `sell_details`
--

DROP TABLE IF EXISTS `sell_details`;
CREATE TABLE IF NOT EXISTS `sell_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sell_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell_details`
--

INSERT INTO `sell_details` (`id`, `sell_id`, `product_id`, `product_variant_id`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(6, 105, 11, NULL, 17, '3434.00', '58378', '2025-01-27 09:03:22', '2025-01-28 08:29:13'),
(8, 105, 1, 17, 11, '2.00', '22', '2025-01-27 09:13:19', '2025-01-28 08:36:37'),
(9, 105, 1, 16, 6, '1.50', '9', '2025-01-27 09:16:29', '2025-01-28 01:17:11'),
(10, 105, 4, NULL, 2, '0.01', '0.02', '2025-01-27 09:17:25', '2025-01-27 09:19:05'),
(11, 105, 5, NULL, 1, '0.01', '0.01', '2025-01-27 09:51:55', '2025-01-27 09:51:55'),
(12, 106, 1, 17, 1, NULL, '0', '2025-01-28 08:18:28', '2025-01-28 08:18:28'),
(13, 106, 7, NULL, 4, '3.00', '12', '2025-01-28 08:20:19', '2025-01-29 02:10:01'),
(14, 106, 8, NULL, 4, '5.00', '20', '2025-01-28 08:20:21', '2025-01-29 02:16:19'),
(16, 107, 2, 19, 1, '2.00', '2', '2025-01-29 02:11:20', '2025-01-29 02:11:20'),
(17, 107, 8, NULL, 2, '5.00', '10', '2025-01-29 02:17:24', '2025-01-29 02:17:47'),
(18, 107, 7, NULL, 1, '3.00', '3', '2025-01-29 02:17:56', '2025-01-29 02:17:56'),
(20, 107, 1, 16, 1, '1.50', '1.5', '2025-01-29 02:19:29', '2025-01-29 02:19:29'),
(23, 108, 1, 17, 1, '2.00', '2', '2025-01-29 04:11:02', '2025-01-29 04:11:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
