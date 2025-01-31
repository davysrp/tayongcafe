-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2025 at 03:11 PM
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
-- Database: `db_grandresort`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `access_name` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `access_name`, `created_at`, `updated_at`) VALUES
(1, 'Employee List', 'employee-list', NULL, NULL),
(2, 'Create Employee', 'create-employee', NULL, NULL),
(3, 'Update Employee', 'update-employee', NULL, NULL),
(4, 'Delete Employee', 'delete-employee', NULL, NULL),
(5, 'Service Type List', 'service-type-list', NULL, NULL),
(6, 'Create Service Type', 'create-service-type', NULL, NULL),
(7, 'Update Service Type', 'update-service-type', NULL, NULL),
(8, 'Delete Service Type', 'delete-service-type', NULL, NULL),
(9, 'Service Visa List', 'service-visa-list', NULL, NULL),
(10, 'Create Service Visa', 'create-service-visa', NULL, NULL),
(11, 'Update Service Visa', 'update-service-visa', NULL, NULL),
(12, 'Delete Service Visa', 'delete-service-visa', NULL, NULL),
(13, 'View Invoice Service Visa', 'view-service-visa-invoice', NULL, NULL),
(14, 'Service WP List', 'service-wp-list', NULL, NULL),
(15, 'Create Service WP', 'create-service-wp', NULL, NULL),
(16, 'Update Service WP', 'update-service-wp', NULL, NULL),
(17, 'Delete Service WP', 'delete-service-wp', NULL, NULL),
(18, 'View Invoice Service WP', 'view-service-wp-invoice', NULL, NULL),
(19, 'MIS Visa Service ', 'mis-visa-service-list', NULL, NULL),
(20, 'Create MIS Visa Service ', 'create-mis-visa-service', NULL, NULL),
(21, 'Update MIS Visa Service ', 'update-mis-visa-service', NULL, NULL),
(22, 'Delete MIS Visa Service ', 'delete-mis-visa-service', NULL, NULL),
(23, 'MIS WP Service ', 'mis-wp-service-list', NULL, NULL),
(24, 'Create MIS WPService ', 'create-mis-wp-service', NULL, NULL),
(25, 'Update MIS WP Service ', 'update-mis-wp-service', NULL, NULL),
(26, 'Delete MIS WP Service ', 'delete-mis-wp-service', NULL, NULL),
(27, 'User List', 'user-list', NULL, NULL),
(28, 'Created User', 'create-user', NULL, NULL),
(29, 'Update User', 'update-user', NULL, NULL),
(30, 'Delete User', 'delete-user', NULL, NULL),
(31, 'View Employee Detail', 'view-employee-detail', NULL, NULL),
(32, 'View Service Visa', 'view-service-visa', NULL, NULL),
(33, 'View Service WP', 'view-service-wp', NULL, NULL),
(34, 'View MIS Service Visa', 'view-mis-service-visa', NULL, NULL),
(35, 'View MIS Service WP', 'view-mis-service-wp', NULL, NULL),
(36, 'Role List', 'role-list', NULL, NULL),
(37, 'Create Role', 'create-role', NULL, NULL),
(38, 'Update Role', 'update-role', NULL, NULL),
(39, 'Delete Role', 'delete-role', NULL, NULL),
(40, 'Receive Service List', 'receive-service-list-visa', NULL, NULL),
(41, 'Create Receive Service', 'create-receive-service', NULL, NULL),
(42, 'Update Receive Service', 'update-receive-service', NULL, NULL),
(43, 'Delete Receive Service', 'delete-receive-service', NULL, NULL),
(44, 'View Receive Sevice', 'view-receive-service', NULL, NULL),
(45, 'Confirm Payment Visa', 'confirm-payment-wp', NULL, NULL),
(46, 'Confirm Payment WP', 'confirm-payment-visa', NULL, NULL),
(47, 'Import Employee', 'import-employee', NULL, NULL),
(48, 'Summery Report', 'summery-report', NULL, NULL),
(49, 'IMM Report', 'imm-report', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
