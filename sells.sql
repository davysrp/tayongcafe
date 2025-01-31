-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2025 at 02:07 PM
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
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` float DEFAULT NULL,
  `promo_code` varchar(100) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `grand_total` float DEFAULT NULL,
  `status` varchar(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `coupon_code_id` varchar(100) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `total`, `promo_code`, `discount`, `grand_total`, `status`, `created_at`, `updated_at`, `deleted_at`, `coupon_code_id`, `payment_method_id`, `invoice_no`, `table_id`, `customer_id`) VALUES
(105, NULL, NULL, 3, 58406, 'paid', '2025-01-27 09:03:22', '2025-01-29 03:10:01', NULL, '4', NULL, '93AC-3D27', 2, NULL),
(106, 32, NULL, NULL, 32, 'paid', '2025-01-28 08:18:28', '2025-01-29 04:05:44', NULL, NULL, 1, 'D99C-193B', 4, NULL),
(107, NULL, NULL, NULL, NULL, '6', '2025-01-29 02:07:11', '2025-01-29 03:58:01', NULL, NULL, 6, '3ECE-9C7D', 2, NULL),
(108, 2, NULL, NULL, 2, 'paid', '2025-01-29 04:06:18', '2025-01-29 04:16:37', NULL, NULL, 6, 'B55B-ED2A', 2, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
