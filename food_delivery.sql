-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 09:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `names` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `names`, `status`, `created_at`, `updated_at`, `deleted_at`, `icon`) VALUES
(4, 'ទឹកបរិសុទ្ធ', 1, '2024-12-14 02:21:46', '2025-01-29 16:38:06', NULL, '38719320250129233806.jpg'),
(5, 'ភេសជ្ជៈ', 1, '2025-01-25 09:39:18', '2025-01-29 16:40:28', NULL, '83420920250129234028.jpg'),
(6, 'បាយ', 1, '2025-01-26 05:47:03', '2025-01-26 05:47:03', NULL, NULL),
(8, 'Saroth', 1, '2025-02-02 03:29:45', '2025-02-02 03:29:45', NULL, '46166620250202102945.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(191) NOT NULL,
  `coupon_code` varchar(191) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `discount_cap` decimal(10,2) DEFAULT NULL,
  `max_use` int(11) DEFAULT NULL,
  `use_per_customer` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `coupon_name`, `coupon_code`, `percentage`, `discount_cap`, `max_use`, `use_per_customer`, `start_date`, `expired_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'Omtuk', 'Omtuktanyong', 10.00, 0.20, 100, 1, '2025-02-02', '2025-02-28', 'active', '2025-02-02 03:21:38', '2025-02-02 03:22:54', NULL),
(16, 'Saroth', 'Saroth', 5.00, 1.00, 1, 1, '2025-02-02', '2025-02-07', 'active', '2025-02-02 03:24:24', '2025-02-02 03:24:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Sophath', 'CT', 'sophathct999@gmail.com', '099330099', '2025-01-30 03:38:33', '2025-02-02 03:16:58', '2025-02-02 03:16:58'),
(17, 'Davy', 'CG', 'davyscg999@gmail.com', '099330122', '2025-01-30 03:40:37', '2025-02-02 03:16:55', '2025-02-02 03:16:55'),
(18, 'General', 'Cusomter', 'generalcustomer@gmail.com', '098768999', '2025-02-02 03:18:14', '2025-02-02 03:18:14', NULL),
(19, 'Phanssssssss', 'Phathssq', 'phansophat21122@gmail.com', '0765121ddfdf', '2025-02-03 01:47:08', '2025-02-03 01:49:11', '2025-02-03 01:49:11'),
(20, 'Phan', 'Phath', 'phansopkkkkkkkkkkkkk@gmail.com', 'kkkkkkkkkkkk', '2025-02-03 01:49:24', '2025-02-03 01:49:35', '2025-02-03 01:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_02_23_154841_create_permission_tables', 1),
(5, '2025_01_24_193703_add_role_to_users_table', 1),
(6, '2025_01_24_205230_create_sellerss_table', 2),
(7, '2025_01_28_101612_create_customers_table', 3),
(8, '2025_01_28_150146_create_coupon_codes_table', 4),
(9, '2025_01_28_150527_create_coupon_code_table', 5),
(10, '2025_01_28_151606_create_coupon_codes_table', 6),
(11, '2025_01_28_220212_create_account_requests_table', 7),
(12, '2025_01_28_220712_create_account_requests_table', 1),
(13, '2025_01_28_221052_modify_users_id_column', 8),
(14, '2025_01_28_235958_create_tables_table', 9),
(15, '2025_01_30_003109_create_customers_table', 10),
(16, '2025_01_30_005518_create_customers_table', 11),
(17, '2025_01_30_010611_create_customers_table', 12),
(18, '2025_01_30_083801_create_customers_table', 13),
(19, '2025_01_30_084402_create_customers_table', 14),
(20, '2025_01_30_111647_create_shipping_methods_table', 15),
(21, '2025_01_30_111755_add_shipping_method_to_sells_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `names` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `small_line` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expired` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`names`, `id`, `created_at`, `updated_at`, `icon`, `small_line`, `token`, `token_expired`, `status`) VALUES
('KHQR', 1, '2024-05-05 14:49:44', '2025-01-29 14:36:25', 'ic_KHQR.png', 'Scan to pay with member bank app', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiNGFmMTQ2ZGUwYWZiNDE2OSJ9LCJpYXQiOjE3MzgxNjE0ODAsImV4cCI6MTc0NTkzNzQ4MH0.V70EFTHaTy7Zhmze_GtLEDICfCKRv8Hknt2l4gBlQP8', '2024-05-25 10:46:55', 'active'),
('Cash', 6, '2025-01-29 14:34:42', '2025-01-29 14:34:42', NULL, NULL, 'f', NULL, 'active'),
('ABA', 7, '2025-02-06 08:19:41', '2025-02-06 08:19:41', NULL, NULL, 'aba', NULL, 'active'),
('ACLEDA', 9, '2025-02-06 08:24:04', '2025-02-06 08:24:04', NULL, NULL, 'ACLEDA', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `access_name` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 18),
(1, 5),
(1, 2),
(1, 6),
(1, 9),
(2, 31),
(2, 1),
(2, 2),
(4, 1),
(4, 4),
(4, 7),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(5, 36),
(5, 37),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 49),
(6, 1),
(6, 4),
(6, 7),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `names` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT 0,
  `detail` text DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `day_warranty` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `seller_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `product_number` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `names`, `category_id`, `price`, `discount`, `detail`, `photo`, `day_warranty`, `status`, `seller_id`, `created_at`, `updated_at`, `deleted_at`, `sku`, `product_number`) VALUES
(12, 'ទឹកសឹង្ហ', 4, 0.1, 0, NULL, '43032420250125170213.jpg', NULL, 1, NULL, '2025-01-24 08:21:56', '2025-01-25 10:02:13', NULL, 'pGFDEsWkNB3eK0VLXuUA', 0),
(13, 'ទឹកសុទ្ធតាន់យ៉ុង', 4, 0.1, 0, NULL, '31711220250125163341.jpg', NULL, 1, NULL, '2025-01-25 09:33:42', '2025-01-25 09:33:42', NULL, 'A7eSwpdturCgVJ3mbU1E', 0),
(14, 'តែបៃតង', 5, 4.25, 0, NULL, '24636120250125165144.jpg', NULL, 1, NULL, '2025-01-25 09:51:45', '2025-01-25 09:51:45', NULL, 'GlE2MRut53DKONUxTdkn', 0),
(15, 'ទឹកសឹង្ហ', 4, 0.25, 0, NULL, '73098620250125170409.jpg', NULL, 1, NULL, '2025-01-25 10:04:09', '2025-01-25 10:04:09', NULL, 'JYNd4y9haFinjElMeGqm', 0),
(16, 'វីតាល់', 4, 0.25, 0, NULL, '96236220250125170514.jpg', NULL, 1, NULL, '2025-01-25 10:05:15', '2025-01-25 10:05:15', NULL, 'MXz3veuVfn6PNkJ9mTZ5', 0),
(17, 'តែតៃវ៉ាន់ទឹកដោះគោ - Taiwan', 5, 4.25, 0, NULL, '28620220250125170738.jpg', NULL, 1, NULL, '2025-01-25 10:07:39', '2025-01-25 10:07:39', NULL, '13ufEKyJCUNpTZtGDScO', 0),
(29, 'បាយឆារ', 6, 10, 0, NULL, '45028720250129234353.jpg', NULL, 1, NULL, '2025-01-29 16:09:55', '2025-01-29 16:43:53', NULL, 'MqBxaZFJl8gmIRds34tL', 0),
(32, 'Saroth', 8, 0.1, 0, NULL, '13476020250202102916.jpg', NULL, 1, NULL, '2025-02-02 03:29:17', '2025-02-02 03:30:52', NULL, '10XLVSxiH9hOGd7MUwcQ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `variant_code` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `variant_price` decimal(10,2) DEFAULT NULL,
  `variant_size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `status`, `variant_code`, `created_at`, `updated_at`, `deleted_at`, `variant_name`, `variant_price`, `variant_size`) VALUES
(16, 1, 1, '001', '2024-12-14 11:37:34', '2024-12-14 11:46:29', NULL, 'ឆាបាយ (ក្រឡុក) 001', 1.50, '1'),
(17, 1, 1, '002', '2024-12-14 11:37:34', '2024-12-14 11:37:34', NULL, 'ឆាបាយ (ក្រឡុក) 002', 2.00, '1'),
(18, 2, 0, NULL, '2024-12-14 11:53:57', '2024-12-14 11:54:42', NULL, 'គ្រឿងសមុទ្រ (Fried Noodle with Seafood)', NULL, NULL),
(19, 2, 0, NULL, '2024-12-14 11:54:07', '2024-12-14 11:54:45', NULL, 'ពងសុទ្ធបន្លែ (Fried Noodle With Egg,Vergetable)', NULL, NULL),
(20, 12, 1, '001', '2025-01-24 15:21:56', '2025-01-24 15:21:56', NULL, '600 ម.ល', 1.50, '1'),
(21, 13, 1, '001', '2025-01-25 16:33:42', '2025-01-25 16:33:42', NULL, '600 ម.ល', 0.25, '1'),
(22, 14, 1, '001', '2025-01-25 16:51:45', '2025-01-25 16:51:45', NULL, 'ជប៉ុនទឹកដោះគោ', 4.25, '1'),
(23, 15, 1, '001', '2025-01-25 17:04:09', '2025-01-25 17:04:09', NULL, '1.5 លីត្រ', 0.25, '1'),
(24, 16, 1, '002', '2025-01-25 17:05:15', '2025-01-25 17:05:15', NULL, '500 ម.ល', NULL, '1'),
(25, 19, 1, '11', '2025-01-25 22:23:59', '2025-01-25 22:23:59', NULL, '22', 1.50, '1'),
(26, 20, 1, '001', '2025-01-25 22:24:45', '2025-01-25 22:24:45', NULL, 'rrrr', 1.50, '1'),
(27, 21, 1, '001', '2025-01-25 22:29:27', '2025-01-25 22:29:27', NULL, '600 ម.ល', 1.50, '1'),
(28, 22, 1, '001', '2025-01-25 22:30:54', '2025-01-25 22:30:54', NULL, 'Iphone 5s', 1.50, '1'),
(29, 23, 1, '001', '2025-01-25 22:36:14', '2025-01-25 22:36:14', NULL, '600 ម.ល', 1.50, '1'),
(30, 23, 1, '001', '2025-01-25 22:36:14', '2025-01-25 22:36:14', NULL, '600 ម.ល', 1.50, '1'),
(31, 23, 1, '11', '2025-01-25 22:37:10', '2025-01-25 22:37:10', NULL, '600 ម.ល', 1.50, '1'),
(32, 24, 1, '001', '2025-01-25 22:37:58', '2025-01-25 22:37:58', NULL, '600 ម.ល', 1.50, '1'),
(33, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(34, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(35, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(36, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(37, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(38, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(39, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(40, 24, 1, NULL, '2025-01-25 22:38:54', '2025-01-25 22:38:54', NULL, NULL, NULL, NULL),
(41, 17, 1, NULL, '2025-01-25 23:30:19', '2025-01-25 23:30:19', NULL, NULL, NULL, NULL),
(42, 27, 1, '003', '2025-01-25 23:31:03', '2025-01-26 13:23:04', NULL, '600 ម.ល', 2.99, '1'),
(43, 27, 1, '004', '2025-01-26 13:23:35', '2025-01-26 13:23:35', NULL, '5600 ម.ល', 2.99, 's'),
(44, 29, 1, '001', '2025-01-29 23:09:55', '2025-01-29 23:09:55', NULL, 'សាច់គោ', 12.00, 'Regular'),
(45, 29, 1, '002', '2025-01-29 23:09:55', '2025-01-29 23:09:55', NULL, 'គ្រឿងសមុទ្រ', 15.00, 'Regular'),
(46, 30, 1, '001', '2025-02-01 14:11:17', '2025-02-01 14:12:18', NULL, '600 ម.ល', 1.50, '1'),
(47, 32, 1, '001', '2025-02-02 10:30:52', '2025-02-02 10:32:27', NULL, 'M', 0.10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-01-02 13:10:32', '2025-01-02 13:57:21'),
(2, 'Account VISA', '2025-01-02 13:10:34', '2025-01-02 13:10:41'),
(3, 'Admin WP', '2025-01-02 13:10:36', '2025-01-02 13:10:43'),
(4, 'sophathssss', '2025-01-30 05:16:23', '2025-01-30 05:16:30'),
(5, 'superadmin', '2025-01-30 05:58:39', '2025-01-30 05:58:39'),
(6, 'Hai', '2025-02-01 12:30:41', '2025-02-01 12:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `sellerss`
--

CREATE TABLE `sellerss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `promo_code` varchar(100) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `grand_total` float DEFAULT NULL,
  `status` varchar(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `coupon_code_id` varchar(100) DEFAULT NULL,
  `shipping_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `total`, `promo_code`, `discount`, `grand_total`, `status`, `created_at`, `updated_at`, `deleted_at`, `coupon_code_id`, `shipping_method_id`, `remark`, `payment_method_id`, `invoice_no`, `table_id`, `customer_id`) VALUES
(1, 24, NULL, 0, 0, 'paid', '2025-02-02 05:51:14', '2025-02-02 16:52:51', NULL, '15', NULL, NULL, 6, '3559-6E9F', 1, NULL),
(2, 13.5, NULL, NULL, 13.5, 'paid', '2025-02-02 05:52:59', '2025-02-02 05:53:16', NULL, NULL, NULL, NULL, 6, '2877-1BB1', 1, NULL),
(3, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 05:54:25', '2025-02-02 05:54:34', NULL, NULL, NULL, NULL, 6, 'E476-1DC8', 1, NULL),
(4, 7.5, NULL, NULL, 7.5, 'paid', '2025-02-03 05:55:39', '2025-02-03 05:55:53', NULL, NULL, NULL, NULL, 6, 'A123-9DEF', 1, NULL),
(5, 50, NULL, 0.2, 2.8, 'paid', '2025-02-04 03:20:30', '2025-02-06 08:24:31', NULL, '15', NULL, NULL, 6, 'B987-3XYZ', 2, NULL),
(6, 33.75, NULL, 0, 0, 'paid', '2025-02-05 02:15:45', '2025-02-03 05:03:50', NULL, '15', NULL, NULL, 6, 'C456-7UVW', 3, NULL),
(7, 12, NULL, NULL, 12, 'canceled', '2025-02-06 07:30:55', '2025-02-06 07:31:10', NULL, NULL, NULL, NULL, 6, 'D789-1QRS', 4, NULL),
(8, 90.99, NULL, NULL, 90.99, 'paid', '2025-02-07 09:45:33', '2025-02-07 09:46:00', NULL, NULL, NULL, NULL, 6, 'E654-2TUV', 5, NULL),
(9, 5.99, NULL, NULL, 5.99, 'pending', '2025-02-08 04:10:20', '2025-02-08 04:11:00', NULL, NULL, NULL, NULL, 6, 'F123-8KLM', 6, NULL),
(10, 75.3, NULL, NULL, 75.3, 'paid', '2025-02-09 06:25:45', '2025-02-09 06:26:12', NULL, NULL, NULL, NULL, 6, 'G987-5ABC', 7, NULL),
(11, 22.4, NULL, NULL, 22.4, 'paid', '2025-02-10 01:55:30', '2025-02-10 01:56:10', NULL, NULL, NULL, NULL, 6, 'H654-3DEF', 8, NULL),
(12, 48.5, NULL, NULL, 48.5, 'canceled', '2025-02-11 08:00:55', '2025-02-11 08:01:22', NULL, NULL, NULL, NULL, 6, 'I123-9XYZ', 9, NULL),
(13, 6.75, NULL, NULL, 6.75, 'paid', '2025-02-12 05:40:25', '2025-02-12 05:41:00', NULL, NULL, NULL, NULL, 6, 'J789-6PQR', 10, NULL),
(14, 99.99, NULL, NULL, 99.99, 'paid', '2025-02-13 07:50:10', '2025-02-13 07:51:22', NULL, NULL, NULL, NULL, 6, 'K456-2LMN', 11, NULL),
(15, 18.99, NULL, NULL, 18.99, 'pending', '2025-02-14 03:30:45', '2025-02-14 03:31:30', NULL, NULL, NULL, NULL, 6, 'L321-7STU', 12, NULL),
(16, 31.75, NULL, NULL, 31.75, 'paid', '2025-02-15 10:15:55', '2025-02-15 10:16:40', NULL, NULL, NULL, NULL, 6, 'M789-1VWX', 13, NULL),
(17, 24.5, NULL, NULL, 24.5, 'paid', '2025-02-16 04:20:33', '2025-02-16 04:21:10', NULL, NULL, NULL, NULL, 6, 'N654-8ABC', 14, NULL),
(18, 52.25, NULL, NULL, 52.25, 'paid', '2025-02-17 07:45:50', '2025-02-17 07:46:40', NULL, NULL, NULL, NULL, 6, 'O321-6DEF', 15, NULL),
(19, 77.8, NULL, NULL, 77.8, 'pending', '2025-02-18 02:35:20', '2025-02-18 02:36:10', NULL, NULL, NULL, NULL, 6, 'P123-2XYZ', 16, NULL),
(20, 8.99, NULL, NULL, 8.99, 'paid', '2025-02-19 09:55:25', '2025-02-19 09:56:12', NULL, NULL, NULL, NULL, 6, 'Q789-4PQR', 17, NULL),
(21, 68.4, NULL, NULL, 68.4, 'paid', '2025-02-20 06:00:10', '2025-02-20 06:01:00', NULL, NULL, NULL, NULL, 6, 'R456-1LMN', 18, NULL),
(22, 40, NULL, NULL, 40, 'paid', '2025-02-21 03:20:33', '2025-02-21 03:21:20', NULL, NULL, NULL, NULL, 6, 'S321-7STU', 19, NULL),
(23, 29.99, NULL, NULL, 29.99, 'canceled', '2025-02-22 08:40:45', '2025-02-22 08:41:30', NULL, NULL, NULL, NULL, 6, 'T987-3VWX', 20, NULL),
(24, 14.99, NULL, NULL, 14.99, 'pending', '2025-02-23 05:10:50', '2025-02-23 05:11:40', NULL, NULL, NULL, NULL, 6, 'U654-9ABC', 21, NULL),
(25, 80, NULL, NULL, 80, 'paid', '2025-02-24 01:25:20', '2025-02-24 01:26:10', NULL, NULL, NULL, NULL, 6, 'V321-5DEF', 22, NULL),
(200, 24, NULL, NULL, 24, 'paid', '2025-02-02 05:51:14', '2025-02-02 05:51:27', NULL, NULL, NULL, NULL, 6, '3559-6E9F', 1, NULL),
(201, 13.5, NULL, NULL, 13.5, 'paid', '2025-02-02 05:52:59', '2025-02-02 05:53:16', NULL, NULL, NULL, NULL, 6, '2877-1BB1', 1, NULL),
(202, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 05:54:25', '2025-02-02 05:54:34', NULL, NULL, NULL, NULL, 6, 'E476-1DC8', 1, NULL),
(203, 7.5, NULL, NULL, 7.5, 'paid', '2025-02-03 05:55:39', '2025-02-03 05:55:53', NULL, NULL, NULL, NULL, 6, 'DDC4-12B2', 1, NULL),
(204, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 16:48:46', '2025-02-02 16:48:54', NULL, NULL, NULL, NULL, 6, 'DC0D-B643', 1, NULL),
(205, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 16:49:46', '2025-02-02 16:49:58', NULL, NULL, NULL, NULL, 6, 'AD78-31BD', 1, NULL),
(206, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-02 16:50:46', '2025-02-02 16:50:55', NULL, NULL, NULL, NULL, 6, '18AC-A2BD', 1, NULL),
(207, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-02 16:51:32', '2025-02-02 16:51:43', NULL, NULL, NULL, NULL, 6, 'CC35-72DC', 1, NULL),
(208, 3, NULL, NULL, 3, 'paid', '2025-02-02 16:52:55', '2025-02-02 16:53:05', NULL, NULL, NULL, NULL, 6, '3C1E-5919', 1, NULL),
(209, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 16:53:59', '2025-02-02 16:54:08', NULL, NULL, NULL, NULL, 6, 'FD0B-5C57', 1, NULL),
(210, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 16:55:31', '2025-02-02 16:55:40', NULL, NULL, NULL, NULL, 6, 'F936-E818', 1, NULL),
(211, 3, NULL, NULL, 3, 'paid', '2025-02-02 16:56:26', '2025-02-02 16:56:35', NULL, NULL, NULL, NULL, 6, '99E5-05C6', 1, NULL),
(212, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-02 17:05:06', '2025-02-02 17:05:53', NULL, NULL, NULL, NULL, 6, '94E0-9200', 1, NULL),
(213, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 17:06:45', '2025-02-02 17:13:45', NULL, NULL, NULL, NULL, 6, '9976-22E2', 1, NULL),
(214, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 17:15:39', '2025-02-02 17:15:41', NULL, NULL, NULL, NULL, 6, 'E433-E614', 1, NULL),
(215, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 17:19:29', '2025-02-02 17:19:38', NULL, NULL, NULL, NULL, 6, '2C4B-6BF4', 1, NULL),
(216, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-02 17:24:35', '2025-02-02 17:36:45', NULL, NULL, NULL, NULL, 6, '21FD-45B0', 1, NULL),
(217, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-02 17:40:20', '2025-02-02 17:41:42', NULL, NULL, NULL, NULL, 6, 'C195-8E7E', 1, NULL),
(218, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 01:30:27', '2025-02-03 01:31:01', NULL, NULL, NULL, NULL, 6, '829A-5FEA', 1, NULL),
(219, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-03 01:32:39', '2025-02-03 01:35:04', NULL, NULL, NULL, NULL, 6, '80FB-E619', 1, NULL),
(220, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 01:38:34', '2025-02-03 01:38:34', NULL, NULL, NULL, NULL, 6, 'BDA9-B1C5', 1, NULL),
(221, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 01:38:43', '2025-02-03 01:38:44', NULL, NULL, NULL, NULL, 6, 'A1A2-7368', 1, NULL),
(222, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 03:15:05', '2025-02-03 03:15:17', NULL, NULL, NULL, NULL, 6, '183D-9369', 1, NULL),
(223, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 03:24:52', '2025-02-03 03:25:04', NULL, NULL, NULL, NULL, 6, 'B38F-7485', 1, NULL),
(224, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 03:31:23', '2025-02-03 03:31:38', NULL, NULL, NULL, NULL, 6, '5D70-78F9', 1, NULL),
(225, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 03:32:07', '2025-02-03 03:32:17', NULL, NULL, NULL, NULL, 6, 'D8AF-A18D', 1, NULL),
(226, 3, NULL, NULL, 3, 'paid', '2025-02-03 03:34:42', '2025-02-03 03:34:55', NULL, NULL, NULL, NULL, 6, '3952-DADD', 1, NULL),
(227, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:25:17', '2025-02-03 04:25:26', NULL, NULL, NULL, NULL, 6, '3757-6C54', 1, NULL),
(228, 3, NULL, NULL, 3, 'paid', '2025-02-03 04:25:56', '2025-02-03 04:26:05', NULL, NULL, NULL, NULL, 6, 'AB00-30F3', 1, NULL),
(229, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-03 04:26:17', '2025-02-03 04:26:27', NULL, NULL, NULL, NULL, 6, '4586-482E', 1, NULL),
(230, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:28:18', '2025-02-03 04:28:26', NULL, NULL, NULL, NULL, 6, '7F0A-EE1C', 1, NULL),
(231, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:30:24', '2025-02-03 04:30:32', NULL, NULL, NULL, NULL, 6, '96F5-6D42', 1, NULL),
(232, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:34:19', '2025-02-03 04:34:32', NULL, NULL, NULL, NULL, 6, 'C39F-41EE', 1, NULL),
(233, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:35:18', '2025-02-03 04:35:31', NULL, NULL, NULL, NULL, 6, 'FEDE-9AD8', 1, NULL),
(234, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:36:11', '2025-02-03 04:36:24', NULL, NULL, NULL, NULL, 6, '8060-0F56', 1, NULL),
(235, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:37:04', '2025-02-03 04:37:12', NULL, NULL, NULL, NULL, 6, '35A1-78A5', 1, NULL),
(236, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:37:29', '2025-02-03 04:37:42', NULL, NULL, NULL, NULL, 6, '07F4-7AE3', 1, NULL),
(237, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:38:13', '2025-02-03 04:38:23', NULL, NULL, NULL, NULL, 6, 'CFBD-F3FC', 1, NULL),
(238, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:38:58', '2025-02-03 04:39:06', NULL, NULL, NULL, NULL, 6, '20D0-8DFC', 1, NULL),
(239, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:39:43', '2025-02-03 04:39:48', NULL, NULL, NULL, NULL, 6, '94B7-5891', 1, NULL),
(240, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:40:20', '2025-02-03 04:40:25', NULL, NULL, NULL, NULL, 6, '6397-0BAD', 1, NULL),
(241, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:44:55', '2025-02-03 04:45:03', NULL, NULL, NULL, NULL, 6, '729F-D3F6', 1, NULL),
(242, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:50:27', '2025-02-03 04:50:33', NULL, NULL, NULL, NULL, 6, '4771-484A', 1, NULL),
(243, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 04:53:40', '2025-02-03 04:53:50', NULL, NULL, NULL, NULL, 6, '267D-1ABA', 1, NULL),
(244, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 05:00:22', '2025-02-03 05:00:28', NULL, NULL, NULL, NULL, 6, '2463-3153', 1, NULL),
(245, 3, NULL, NULL, 3, 'paid', '2025-02-03 05:01:14', '2025-02-03 05:01:22', NULL, NULL, NULL, NULL, 6, '214D-965F', 2, NULL),
(246, 7.5, NULL, NULL, 7.5, 'paid', '2025-02-03 05:01:50', '2025-02-03 05:02:18', NULL, NULL, NULL, NULL, 6, 'C875-1B52', 2, NULL),
(247, 24, NULL, NULL, 24, 'paid', '2025-02-03 05:02:47', '2025-02-03 05:03:01', NULL, NULL, NULL, NULL, 6, '5E6D-7975', 2, NULL),
(248, 0.1, NULL, NULL, 0.1, 'paid', '2025-02-03 05:03:13', '2025-02-03 05:03:20', NULL, NULL, NULL, NULL, 6, '2A5B-46FE', 2, NULL),
(249, 30, NULL, NULL, 30, 'paid', '2025-02-03 05:03:44', '2025-02-03 05:03:56', NULL, NULL, NULL, NULL, 6, 'E9C3-3F6D', 3, NULL),
(250, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-03 05:04:10', '2025-02-03 05:04:15', NULL, NULL, NULL, NULL, 6, '0362-930A', 1, NULL),
(251, 3, NULL, NULL, 3, 'paid', '2025-02-03 05:04:28', '2025-02-03 05:04:36', NULL, NULL, NULL, NULL, 6, '65FD-6CA8', 1, NULL),
(252, 0.1, NULL, NULL, 0.1, 'paid', '2025-02-03 05:05:34', '2025-02-03 05:05:39', NULL, NULL, NULL, NULL, 6, '5CD7-52E5', 1, NULL),
(253, 0.2, NULL, NULL, 0.2, 'paid', '2025-02-03 05:06:50', '2025-02-03 05:07:02', NULL, NULL, NULL, NULL, 6, '310B-B9CF', 2, NULL),
(254, 24, NULL, NULL, 24, 'paid', '2025-02-03 05:07:30', '2025-02-03 05:07:41', NULL, NULL, NULL, NULL, 6, 'FBF5-6470', 2, NULL),
(255, 27, NULL, NULL, 27, 'paid', '2025-02-03 05:10:32', '2025-02-03 05:10:53', NULL, NULL, NULL, NULL, 6, 'EC9B-6145', 3, NULL),
(256, 0.25, NULL, NULL, 0.25, 'paid', '2025-02-03 05:11:13', '2025-02-03 05:11:19', NULL, NULL, NULL, NULL, 6, '15F7-1748', 3, NULL),
(257, 6, NULL, NULL, 6, 'paid', '2025-02-03 05:11:43', '2025-02-03 05:11:53', NULL, NULL, NULL, NULL, 6, 'F1FF-0DC6', 1, NULL),
(258, 3, NULL, NULL, 3, 'paid', '2025-02-03 05:14:29', '2025-02-03 05:14:41', NULL, NULL, NULL, NULL, 6, '11C5-E5CF', 1, NULL),
(259, 1.5, NULL, NULL, 1.5, 'paid', '2025-02-04 07:23:06', '2025-02-04 07:23:15', NULL, NULL, NULL, NULL, 6, '5EE1-247F', 1, NULL),
(260, 9, NULL, NULL, 9, 'paid', '2025-02-06 08:18:26', '2025-02-06 08:18:42', NULL, NULL, NULL, NULL, 6, '56EF-2064', 1, NULL),
(261, 3, NULL, NULL, 3, 'paid', '2025-02-06 08:24:35', '2025-02-06 08:24:41', NULL, NULL, NULL, NULL, 7, 'D9FA-0CD6', 2, NULL),
(262, 0.25, NULL, NULL, 0.25, 'paid', '2025-02-06 08:26:12', '2025-02-06 08:26:19', NULL, NULL, NULL, NULL, 6, '41D3-5621', 2, NULL),
(263, 4.25, NULL, NULL, 4.25, 'paid', '2025-02-06 08:26:35', '2025-02-06 08:26:41', NULL, NULL, NULL, NULL, 9, 'C91F-0E5C', 2, NULL),
(264, 0.1, NULL, NULL, 0.1, 'paid', '2025-02-06 08:27:06', '2025-02-06 08:27:12', NULL, NULL, NULL, NULL, 9, '0EB5-F4B5', 2, NULL),
(265, 0.1, NULL, NULL, 0.1, 'paid', '2025-02-06 08:27:23', '2025-02-06 08:27:29', NULL, NULL, NULL, NULL, 7, '40E7-D56E', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sell_details`
--

CREATE TABLE `sell_details` (
  `id` int(11) NOT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell_details`
--

INSERT INTO `sell_details` (`id`, `sell_id`, `product_id`, `product_variant_id`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(6, 105, 11, NULL, 17, 3434.00, '58378', '2025-01-27 09:03:22', '2025-01-28 08:29:13'),
(8, 105, 1, 17, 11, 2.00, '22', '2025-01-27 09:13:19', '2025-01-28 08:36:37'),
(9, 105, 1, 16, 6, 1.50, '9', '2025-01-27 09:16:29', '2025-01-28 01:17:11'),
(10, 105, 4, NULL, 2, 0.01, '0.02', '2025-01-27 09:17:25', '2025-01-27 09:19:05'),
(11, 105, 5, NULL, 1, 0.01, '0.01', '2025-01-27 09:51:55', '2025-01-27 09:51:55'),
(12, 106, 1, 17, 1, NULL, '0', '2025-01-28 08:18:28', '2025-01-28 08:18:28'),
(13, 106, 7, NULL, 4, 3.00, '12', '2025-01-28 08:20:19', '2025-01-29 02:10:01'),
(14, 106, 8, NULL, 4, 5.00, '20', '2025-01-28 08:20:21', '2025-01-29 02:16:19'),
(16, 107, 2, 19, 1, 2.00, '2', '2025-01-29 02:11:20', '2025-01-29 02:11:20'),
(17, 107, 8, NULL, 2, 5.00, '10', '2025-01-29 02:17:24', '2025-01-29 02:17:47'),
(18, 107, 7, NULL, 1, 3.00, '3', '2025-01-29 02:17:56', '2025-01-29 02:17:56'),
(20, 107, 1, 16, 1, 1.50, '1.5', '2025-01-29 02:19:29', '2025-01-29 02:19:29'),
(23, 108, 1, 17, 1, 2.00, '2', '2025-01-29 04:11:02', '2025-01-29 04:11:02'),
(24, 109, 14, 22, 1, 1.00, '1', '2025-01-29 14:31:53', '2025-01-29 14:31:53'),
(25, 109, 16, 24, 1, 1.00, '1', '2025-01-29 14:32:12', '2025-01-29 14:32:12'),
(45, 111, 12, 20, 1, 1.50, '1.5', '2025-01-30 07:25:54', '2025-01-30 07:25:54'),
(30, 110, 14, 22, 1, 4.25, '4.25', '2025-01-30 03:40:54', '2025-01-30 03:40:54'),
(31, 112, 17, 41, 1, NULL, '0', '2025-01-30 03:41:23', '2025-01-30 03:41:23'),
(32, 113, 14, 22, 1, NULL, '0', '2025-01-30 04:29:24', '2025-01-30 04:29:24'),
(35, 114, 14, 22, 1, 4.25, '4.25', '2025-01-30 04:58:19', '2025-01-30 04:58:19'),
(37, 115, 12, 20, 1, 1.50, '1.5', '2025-01-30 06:50:06', '2025-01-30 06:50:06'),
(38, 116, 12, 20, 1, NULL, '0', '2025-01-30 07:08:32', '2025-01-30 07:08:32'),
(40, 117, 13, 21, 1, 0.25, '0.25', '2025-01-30 07:17:42', '2025-01-30 07:17:42'),
(42, 118, 14, 22, 1, 4.25, '4.25', '2025-01-30 07:22:51', '2025-01-30 07:22:51'),
(44, 119, 13, 21, 1, 0.25, '0.25', '2025-01-30 07:23:31', '2025-01-30 07:23:31'),
(47, 120, 13, 21, 1, 0.25, '0.25', '2025-01-30 07:27:02', '2025-01-30 07:27:02'),
(48, 121, 12, 20, 1, NULL, '0', '2025-01-30 07:28:29', '2025-01-30 07:28:29'),
(49, 122, 12, 20, 1, NULL, '0', '2025-01-30 07:30:16', '2025-01-30 07:30:16'),
(51, 123, 13, 21, 1, 0.25, '0.25', '2025-01-30 07:42:00', '2025-01-30 07:42:00'),
(53, 124, 13, 21, 1, 0.25, '0.25', '2025-01-30 07:44:25', '2025-01-30 07:44:25'),
(57, 128, 15, 23, 1, NULL, '0', '2025-01-30 07:53:19', '2025-01-30 07:53:19'),
(59, 130, 13, 21, 1, NULL, '0', '2025-01-30 08:01:13', '2025-01-30 08:01:13'),
(66, 131, 13, 21, 1, 0.25, '0.25', '2025-01-30 08:14:11', '2025-01-30 08:14:11'),
(68, 132, 13, 21, 1, 0.25, '0.25', '2025-01-30 13:01:38', '2025-01-30 13:01:38'),
(70, 133, 13, 21, 1, 0.25, '0.25', '2025-01-30 13:18:02', '2025-01-30 13:18:02'),
(73, 135, 15, 23, 1, 0.25, '0.25', '2025-01-30 14:23:31', '2025-01-30 14:23:31'),
(75, 136, 13, 21, 1, 0.25, '0.25', '2025-01-30 14:24:15', '2025-01-30 14:24:15'),
(77, 137, 12, 20, 1, 1.50, '1.5', '2025-01-30 14:42:37', '2025-01-30 14:42:37'),
(79, 138, 12, 20, 1, 1.50, '1.5', '2025-01-30 15:01:15', '2025-01-30 15:01:15'),
(80, 138, 13, 21, 1, 0.25, '0.25', '2025-01-30 15:01:20', '2025-01-30 15:01:20'),
(82, 139, 13, 21, 1, 0.25, '0.25', '2025-01-30 17:03:57', '2025-01-30 17:03:57'),
(84, 140, 12, 20, 1, 1.50, '1.5', '2025-01-30 17:11:53', '2025-01-30 17:11:53'),
(86, 141, 12, 20, 1, 1.50, '1.5', '2025-01-30 17:19:21', '2025-01-30 17:19:21'),
(89, 142, 14, 22, 1, 4.25, '4.25', '2025-01-30 17:26:02', '2025-01-30 17:26:02'),
(93, 144, 13, 21, 1, 0.25, '0.25', '2025-01-30 17:43:43', '2025-01-30 17:43:43'),
(95, 145, 12, 20, 1, 1.50, '1.5', '2025-01-30 17:48:11', '2025-01-30 17:48:11'),
(97, 146, 13, 21, 1, 0.25, '0.25', '2025-01-30 17:52:01', '2025-01-30 17:52:01'),
(102, 148, 13, 21, 1, 0.25, '0.25', '2025-01-30 18:12:59', '2025-01-30 18:12:59'),
(100, 147, 13, 21, 1, 0.25, '0.25', '2025-01-30 17:53:57', '2025-01-30 17:53:57'),
(109, 153, 15, 23, 1, 0.25, '0.25', '2025-01-31 14:06:07', '2025-01-31 14:06:07'),
(111, 154, 12, 20, 1, 1.50, '1.5', '2025-01-31 14:10:12', '2025-01-31 14:10:12'),
(113, 155, 12, 20, 1, 1.50, '1.5', '2025-01-31 14:19:35', '2025-01-31 14:19:35'),
(115, 156, 15, 23, 1, 0.25, '0.25', '2025-01-31 14:24:18', '2025-01-31 14:24:18'),
(116, 157, 12, 20, 1, 1.50, '1.5', '2025-01-31 16:13:11', '2025-01-31 16:13:11'),
(118, 159, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:26:31', '2025-01-31 16:26:31'),
(119, 160, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:33:47', '2025-01-31 16:33:47'),
(120, 161, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:42:18', '2025-01-31 16:42:18'),
(121, 162, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:48:46', '2025-01-31 16:48:46'),
(122, 163, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:49:18', '2025-01-31 16:49:18'),
(123, 164, 12, 20, 1, 1.50, '1.5', '2025-01-31 16:53:13', '2025-01-31 16:53:13'),
(125, 166, 13, 21, 1, 0.25, '0.25', '2025-01-31 16:58:02', '2025-01-31 16:58:02'),
(126, 167, 12, 20, 1, 1.50, '1.5', '2025-01-31 16:59:17', '2025-01-31 16:59:17'),
(127, 168, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:04:56', '2025-01-31 17:04:56'),
(128, 169, 13, 21, 1, 0.25, '0.25', '2025-01-31 17:05:01', '2025-01-31 17:05:01'),
(129, 170, 15, 23, 1, 0.25, '0.25', '2025-01-31 17:05:03', '2025-01-31 17:05:03'),
(130, 171, 15, 23, 1, 0.25, '0.25', '2025-01-31 17:05:04', '2025-01-31 17:05:04'),
(131, 172, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:12', '2025-01-31 17:05:12'),
(132, 173, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:13', '2025-01-31 17:05:13'),
(133, 174, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:13', '2025-01-31 17:05:13'),
(134, 175, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:14', '2025-01-31 17:05:14'),
(135, 176, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:15', '2025-01-31 17:05:15'),
(136, 177, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:16', '2025-01-31 17:05:16'),
(137, 178, 13, 21, 1, 0.25, '0.25', '2025-01-31 17:05:18', '2025-01-31 17:05:18'),
(138, 179, 13, 21, 1, 0.25, '0.25', '2025-01-31 17:05:18', '2025-01-31 17:05:18'),
(139, 180, 13, 21, 1, 0.25, '0.25', '2025-01-31 17:05:18', '2025-01-31 17:05:18'),
(140, 181, 13, 21, 1, 0.25, '0.25', '2025-01-31 17:05:18', '2025-01-31 17:05:18'),
(141, 182, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:05:54', '2025-01-31 17:05:54'),
(142, 183, 12, 20, 2, 1.50, '3', '2025-01-31 17:13:40', '2025-01-31 17:13:42'),
(143, 184, 12, 20, 2, 1.50, '3', '2025-01-31 17:16:37', '2025-01-31 17:16:37'),
(144, 185, 12, 20, 1, 1.50, '1.5', '2025-01-31 17:19:00', '2025-01-31 17:19:00'),
(145, 186, 12, 20, 5, 1.50, '7.5', '2025-01-31 17:20:16', '2025-01-31 17:20:18'),
(146, 187, 12, 20, 4, 1.50, '6', '2025-01-31 17:26:00', '2025-01-31 17:26:06'),
(147, 188, 12, 20, 7, 1.50, '10.5', '2025-01-31 17:32:03', '2025-01-31 17:32:44'),
(148, 189, 14, 22, 1, 4.25, '4.25', '2025-01-31 17:32:51', '2025-01-31 17:32:51'),
(149, 190, 12, 20, 1, 1.50, '1.5', '2025-02-01 04:07:25', '2025-02-01 04:07:25'),
(150, 191, 12, 20, 1, 1.50, '1.5', '2025-02-01 04:17:14', '2025-02-01 04:17:14'),
(151, 192, 31, NULL, 1, 122.00, '122', '2025-02-01 11:58:35', '2025-02-01 11:58:35'),
(152, 193, 13, 21, 1, 0.25, '0.25', '2025-02-02 02:42:17', '2025-02-02 02:42:17'),
(153, 194, 12, 20, 1, 1.50, '1.5', '2025-02-02 03:01:37', '2025-02-02 03:01:37'),
(154, 195, 13, 21, 1, 0.25, '0.25', '2025-02-02 03:14:12', '2025-02-02 03:14:12'),
(156, 196, 12, 20, 6, 1.50, '9', '2025-02-02 03:25:00', '2025-02-02 03:25:29'),
(157, 197, 12, 20, 6, 1.50, '9', '2025-02-02 03:26:21', '2025-02-02 03:27:27'),
(158, 198, 12, 20, 4, 1.50, '6', '2025-02-02 03:27:35', '2025-02-02 03:27:40'),
(161, 199, 32, 47, 1, 0.10, '0.1', '2025-02-02 03:32:44', '2025-02-02 03:32:44'),
(162, 200, 12, 20, 16, 1.50, '24', '2025-02-02 05:51:14', '2025-02-02 05:51:18'),
(163, 201, 12, 20, 9, 1.50, '13.5', '2025-02-02 05:52:59', '2025-02-02 05:53:04'),
(164, 202, 12, 20, 1, 1.50, '1.5', '2025-02-02 05:54:25', '2025-02-02 05:54:25'),
(165, 203, 12, 20, 5, 1.50, '7.5', '2025-02-03 05:55:39', '2025-02-03 05:55:45'),
(166, 204, 12, 20, 1, 1.50, '1.5', '2025-02-02 16:48:46', '2025-02-02 16:48:46'),
(167, 205, 12, 20, 1, 1.50, '1.5', '2025-02-02 16:49:46', '2025-02-02 16:49:46'),
(168, 206, 14, 22, 1, 4.25, '4.25', '2025-02-02 16:50:46', '2025-02-02 16:50:46'),
(169, 207, 14, 22, 1, 4.25, '4.25', '2025-02-02 16:51:32', '2025-02-02 16:51:32'),
(170, 208, 12, 20, 2, 1.50, '3', '2025-02-02 16:52:55', '2025-02-02 16:52:56'),
(171, 209, 12, 20, 1, 1.50, '1.5', '2025-02-02 16:53:59', '2025-02-02 16:53:59'),
(172, 210, 12, 20, 1, 1.50, '1.5', '2025-02-02 16:55:31', '2025-02-02 16:55:31'),
(173, 211, 12, 20, 2, 1.50, '3', '2025-02-02 16:56:26', '2025-02-02 16:56:28'),
(174, 212, 14, 22, 1, 4.25, '4.25', '2025-02-02 17:05:06', '2025-02-02 17:05:06'),
(175, 213, 12, 20, 1, 1.50, '1.5', '2025-02-02 17:06:45', '2025-02-02 17:06:45'),
(176, 214, 12, 20, 1, 1.50, '1.5', '2025-02-02 17:15:39', '2025-02-02 17:15:39'),
(177, 215, 12, 20, 1, 1.50, '1.5', '2025-02-02 17:19:29', '2025-02-02 17:19:29'),
(179, 216, 14, 22, 1, 4.25, '4.25', '2025-02-02 17:29:06', '2025-02-02 17:29:06'),
(180, 217, 12, 20, 1, 1.50, '1.5', '2025-02-02 17:40:20', '2025-02-02 17:40:20'),
(181, 218, 12, 20, 1, 1.50, '1.5', '2025-02-03 01:30:27', '2025-02-03 01:30:27'),
(184, 220, 12, 20, 1, 1.50, '1.5', '2025-02-03 01:38:34', '2025-02-03 01:38:34'),
(185, 221, 12, 20, 1, 1.50, '1.5', '2025-02-03 01:38:43', '2025-02-03 01:38:43'),
(186, 222, 12, 20, 1, 1.50, '1.5', '2025-02-03 03:15:05', '2025-02-03 03:15:05'),
(187, 223, 12, 20, 1, 1.50, '1.5', '2025-02-03 03:24:52', '2025-02-03 03:24:52'),
(188, 224, 12, 20, 2, 1.50, '3', '2025-02-03 03:31:23', '2025-02-03 03:32:05'),
(189, 225, 12, 20, 1, 1.50, '1.5', '2025-02-03 03:32:07', '2025-02-03 03:32:07'),
(190, 226, 12, 20, 2, 1.50, '3', '2025-02-03 03:34:42', '2025-02-03 03:34:44'),
(191, 227, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:25:17', '2025-02-03 04:25:17'),
(192, 228, 12, 20, 3, 1.50, '4.5', '2025-02-03 04:25:56', '2025-02-03 04:26:14'),
(193, 229, 14, 22, 1, 4.25, '4.25', '2025-02-03 04:26:17', '2025-02-03 04:26:17'),
(194, 230, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:28:18', '2025-02-03 04:28:18'),
(195, 231, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:30:24', '2025-02-03 04:30:24'),
(196, 232, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:34:19', '2025-02-03 04:34:19'),
(197, 233, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:35:18', '2025-02-03 04:35:18'),
(198, 234, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:36:11', '2025-02-03 04:36:11'),
(200, 236, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:37:29', '2025-02-03 04:37:29'),
(201, 237, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:38:13', '2025-02-03 04:38:13'),
(202, 238, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:38:58', '2025-02-03 04:38:58'),
(203, 239, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:39:43', '2025-02-03 04:39:43'),
(204, 240, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:40:20', '2025-02-03 04:40:20'),
(205, 241, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:44:55', '2025-02-03 04:44:55'),
(206, 242, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:50:27', '2025-02-03 04:50:27'),
(207, 243, 12, 20, 1, 1.50, '1.5', '2025-02-03 04:53:40', '2025-02-03 04:53:40'),
(208, 244, 12, 20, 1, 1.50, '1.5', '2025-02-03 05:00:22', '2025-02-03 05:00:22'),
(209, 5, 12, 20, 2, 1.50, '3', '2025-02-03 05:00:42', '2025-02-03 05:01:11'),
(210, 245, 12, 20, 2, 1.50, '3', '2025-02-03 05:01:14', '2025-02-03 05:01:16'),
(211, 246, 12, 20, 5, 1.50, '7.5', '2025-02-03 05:01:50', '2025-02-03 05:02:01'),
(212, 247, 29, 44, 2, 12.00, '24', '2025-02-03 05:02:47', '2025-02-03 05:02:50'),
(213, 248, 32, 47, 1, 0.10, '0.1', '2025-02-03 05:03:13', '2025-02-03 05:03:13'),
(214, 249, 29, 45, 2, 15.00, '30', '2025-02-03 05:03:44', '2025-02-03 05:03:47'),
(215, 250, 12, 20, 1, 1.50, '1.5', '2025-02-03 05:04:10', '2025-02-03 05:04:10'),
(216, 251, 12, 20, 2, 1.50, '3', '2025-02-03 05:04:28', '2025-02-03 05:04:30'),
(217, 252, 32, 47, 1, 0.10, '0.1', '2025-02-03 05:05:34', '2025-02-03 05:05:34'),
(218, 253, 32, 47, 2, 0.10, '0.2', '2025-02-03 05:06:50', '2025-02-03 05:06:54'),
(219, 254, 29, 44, 2, 12.00, '24', '2025-02-03 05:07:30', '2025-02-03 05:07:31'),
(220, 255, 29, 44, 2, 12.00, '24', '2025-02-03 05:10:32', '2025-02-03 05:11:08'),
(221, 255, 29, 45, 1, 15.00, '15', '2025-02-03 05:10:33', '2025-02-03 05:10:33'),
(222, 256, 13, 21, 1, 0.25, '0.25', '2025-02-03 05:11:13', '2025-02-03 05:11:13'),
(223, 257, 12, 20, 4, 1.50, '6', '2025-02-03 05:11:43', '2025-02-03 05:11:46'),
(224, 258, 12, 20, 2, 1.50, '3', '2025-02-03 05:14:29', '2025-02-03 05:14:31'),
(226, 260, 12, 20, 6, 1.50, '9', '2025-02-06 08:18:26', '2025-02-06 08:18:30'),
(227, 261, 12, 20, 1, 1.50, '1.5', '2025-02-06 08:24:35', '2025-02-06 08:26:10'),
(228, 262, 13, 21, 1, 0.25, '0.25', '2025-02-06 08:26:12', '2025-02-06 08:26:12'),
(229, 263, 14, 22, 1, 4.25, '4.25', '2025-02-06 08:26:35', '2025-02-06 08:26:35'),
(230, 264, 32, 47, 1, 0.10, '0.1', '2025-02-06 08:27:06', '2025-02-06 08:27:06'),
(231, 265, 32, 47, 1, 0.10, '0.1', '2025-02-06 08:27:23', '2025-02-06 08:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `commission`, `created_at`, `updated_at`) VALUES
(1, '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pickup from store', 'active', '2025-01-30 04:54:29', '2025-01-30 04:54:29'),
(2, 'Get it delivered to you', 'active', '2025-01-30 04:54:47', '2025-01-30 04:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `background` text NOT NULL,
  `description_upper` varchar(255) NOT NULL,
  `description_middle` varchar(255) NOT NULL,
  `description_lower` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `background`, `description_upper`, `description_middle`, `description_lower`, `created_at`, `updated_at`) VALUES
(1, '20241212160613.jpg', 'សូមស្វាគមន៍មកកាន់', 'ឆាតាន់យ៉ុងក្រុងសិរីសោភ័ណ', '123', '2024-12-12 07:12:59', '2024-12-12 09:06:13'),
(2, '20241212155339.jpg', 'រស់ជាតិថ្មី', 'So Special', '123', '2024-12-12 07:13:13', '2024-12-12 08:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `names` varchar(191) NOT NULL,
  `seats` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `names`, `seats`, `created_at`, `updated_at`) VALUES
(1, 'Table 1', 4, '2025-01-28 17:06:57', '2025-01-28 17:06:57'),
(2, 'Table 2', 6, '2025-01-28 17:06:57', '2025-01-28 17:06:57'),
(3, 'Table 3', 8, '2025-01-28 17:06:57', '2025-01-28 17:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'sellers',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `role_id`) VALUES
(5, 'mradmin', 'mradmin@dd.com', 'seller', '$2y$12$.42c.Yq3mgxuKqXKhrf01ufsAWmabZidJf8SKlfeN5cCHpQmWzKaa', NULL, '2024-04-04 23:14:06', '2024-04-04 23:14:06', NULL, NULL),
(6, 'Beauty & Health', 'davysrp@gmail.com', 'customer', '$2y$12$GYtA8godCnjt/c2mNlkUuuZaIkCMHroNtbI6qiho.LfIQqvGMqkQq', NULL, '2024-12-13 07:36:46', '2025-02-02 05:29:11', '2025-02-02 05:29:11', NULL),
(7, 'Beauty & Health', 'davysrpdddd@gmail.com', 'buyer', '$2y$12$2hFKjwaZ8BTTp8Ctha/8w.LiMOI8ZynHzYiDI0LICw/OoguOKfj3.', NULL, '2024-12-13 07:37:43', '2024-12-13 07:38:24', '2024-12-13 07:38:24', NULL),
(8, 'sophth', 'sophath@gmail.com', 'sellers', '$2y$12$ArT6zcLX3/Hgm.RwdCQUWe2m3lolnDKCfMZM/8V9FbBxKoFEzZp/u', NULL, '2025-01-25 09:26:24', '2025-01-25 09:26:24', NULL, NULL),
(9, 'sarothkh', 'sarothkh@gmail.com', 'buyer', '$2y$12$YA45LUjl3vzMQIPvj7KjJeHDv2x3r739Y7xjuwAgUPHCl1lab5deG', NULL, '2025-01-25 09:57:26', '2025-01-30 02:05:55', NULL, NULL),
(10, 'Lenghai', 'lenghai@gmaail.com', 'sellers', '$2y$12$nGhNlVHtOJtgVIBU6gJ0vu1uARXmmOWPVXnD4kBji4KLUBSOO6XEq', NULL, '2025-01-28 10:08:38', '2025-01-28 10:08:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL,
  `names` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `names`, `detail`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Home', 'ភូមិសាមគ្គីមានជ័យ ឃុំប៉ោយប៉ែត សង្កាត់ប៉ោយប៉ែត (បុរីដួងច័ន្ទ II) Poipet, Cambodia 010901', NULL, '2025-01-25 09:28:57', NULL),
(2, 'Term & Condition', 'Page Term & Condition', NULL, NULL, NULL),
(3, 'Privacy ggg', 'Page Privacy', NULL, '2024-12-13 07:25:34', NULL),
(5, 'Top Up', '', NULL, '2024-12-13 07:24:56', '2024-12-13 07:24:56'),
(6, 'regdfg', 'dfgdfg', '2024-12-13 07:25:42', '2024-12-13 07:25:48', '2024-12-13 07:25:48'),
(7, 'Windows 10 Pro', 'l', '2025-01-30 01:14:01', '2025-01-30 01:14:42', '2025-01-30 01:14:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_codes_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`category_id`),
  ADD KEY `id_owner` (`seller_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerss`
--
ALTER TABLE `sellerss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellerss_email_unique` (`email`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sells_shipping_method_id_foreign` (`shipping_method_id`);

--
-- Indexes for table `sell_details`
--
ALTER TABLE `sell_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webpages`
--
ALTER TABLE `webpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sellerss`
--
ALTER TABLE `sellerss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `sell_details`
--
ALTER TABLE `sell_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_shipping_method_id_foreign` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_methods` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
