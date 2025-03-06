-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 02:49 PM
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
(6, 'អាហារ', 1, '2025-01-26 05:47:03', '2025-02-16 05:02:20', NULL, NULL);

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
(13, 'Apple', 'Apple', 10.00, 4.00, 100, 1, '2025-01-30', '2025-03-01', 'active', '2025-01-30 03:00:01', '2025-01-30 03:00:01', NULL),
(14, 'Coffee25', 'Coffee25', 5.00, 3.00, 1000, 1, '2025-01-30', '2025-04-30', 'active', '2025-01-30 06:32:14', '2025-01-30 06:32:14', NULL);

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
(16, 'Sophath', 'CT', 'sophathct999@gmail.com', '099330099', '2025-01-30 03:38:33', '2025-01-30 03:38:33', NULL),
(17, 'Davy', 'CG', 'davyscg999@gmail.com', '099330122', '2025-01-30 03:40:37', '2025-01-30 03:40:37', NULL);

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
(21, '2025_01_30_111755_add_shipping_method_to_sells_table', 15),
(22, '2025_01_30_120518_create_permission_roles_table', 16),
(23, '2025_02_02_144115_create_webpages_table', 16),
(24, '2025_02_15_112945_create_product_variants_table', 17);

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
('Cash', 6, '2025-01-29 14:34:42', '2025-01-29 14:34:42', NULL, NULL, 'f', NULL, 'active');

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
(5, 49);

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `names` varchar(191) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `detail` text DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `day_warranty` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `product_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `names`, `category_id`, `price`, `discount`, `detail`, `photo`, `day_warranty`, `status`, `seller_id`, `created_at`, `updated_at`, `deleted_at`, `sku`, `product_number`) VALUES
(1, 'ទឹកសឺង', 4, 0.25, 0.00, NULL, '35170420250216105008.jpg.jpg', NULL, 1, NULL, '2025-02-16 03:50:08', '2025-02-16 04:58:52', NULL, 'cjUbu7hMwmfWXd4rYlHp', 0),
(2, 'ទឹកវិតាល', 4, 0.25, 0.00, NULL, '80327020250216114343.jpg.jpg', NULL, 1, NULL, '2025-02-16 04:43:43', '2025-02-16 04:58:31', NULL, 'ktIYBlFgchiZN9LEKGyQ', 0),
(3, 'ទឹកតាន់យ៉ុង', 4, 0.25, 0.00, NULL, '98457420250216114441.jpg.jpg', NULL, 1, NULL, '2025-02-16 04:44:41', '2025-02-16 04:58:16', NULL, 'etTIR8BJ0d27kyONj6lW', 0),
(4, 'ទឹកគីវី', 5, 1.00, 0.00, NULL, '11156520250216115623.jpg.jpg', NULL, 1, NULL, '2025-02-16 04:56:24', '2025-02-16 05:01:54', NULL, 'h4rme5fyNwnTLH8jFI9R', 0),
(5, 'ទឹកគូលែន', 5, 1.00, 0.00, NULL, '57127220250216120133.jpg', NULL, 1, NULL, '2025-02-16 04:57:36', '2025-02-16 05:01:49', NULL, '0kHWYuGKN1lgZ7v3MPEQ', 0),
(6, 'ទឹកស្តូបឺរី', 5, 1.00, 0.00, NULL, '88110620250216120046.jpg.jpg', NULL, 1, NULL, '2025-02-16 05:00:47', '2025-02-16 05:00:47', NULL, 'ZMb9TtfhKdvx4kulqmgo', 0),
(7, 'បាយឆាយ', 6, 1.25, 0.00, NULL, '86786720250216120345.jpg.jpg', NULL, 1, NULL, '2025-02-16 05:03:46', '2025-02-16 05:03:46', NULL, 'CebZTtKyxYFqJAw36irz', 0),
(8, 'មីឆា', 6, 1.25, 0.00, NULL, '88574620250216120428.jpg.jpg', NULL, 1, NULL, '2025-02-16 05:04:28', '2025-02-16 05:04:28', NULL, '6ZJDFCrHauefmtdK4UQL', 0),
(9, 'លោតឆា', 6, 1.25, 0.00, NULL, '35530720250216120503.jpg.jpg', NULL, 1, NULL, '2025-02-16 05:05:04', '2025-02-16 05:05:04', NULL, '2Ga0edToZALvV8WJlmwP', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_code` varchar(191) NOT NULL,
  `variant_name` varchar(191) NOT NULL,
  `variant_price` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `variant_size` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_code`, `variant_name`, `variant_price`, `status`, `variant_size`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'ទឹកសឺង', 0.25, 1, '750ML', '2025-03-04 13:49:29', '2025-03-04 13:49:29'),
(2, 1, '2', 'ទឹកសឺង', 0.50, 1, '1.5L', '2025-03-04 13:49:29', '2025-03-04 13:49:29'),
(3, 2, '1', 'ទឹកវិតាល', 0.25, 1, '750ML', '2025-03-04 13:51:24', '2025-03-04 13:51:24'),
(4, 2, '2', 'ទឹកវិតាល', 0.50, 1, '1.5L', '2025-03-04 13:51:24', '2025-03-04 13:51:24'),
(5, 3, '1', 'ទឹកតាន់យ៉ុង', 0.25, 1, '750ML', '2025-03-04 13:51:48', '2025-03-04 13:51:48'),
(6, 3, '2', 'ទឹកតាន់យ៉ុង', 0.50, 1, '1.5L', '2025-03-04 13:51:48', '2025-03-04 13:51:48'),
(7, 4, '1', 'ទឹកគីវី', 1.00, 1, 'S', '2025-03-04 13:52:43', '2025-03-04 13:52:43'),
(8, 4, '2', 'ទឹកគីវី', 1.25, 1, 'M', '2025-03-04 13:52:43', '2025-03-04 13:52:43'),
(9, 4, '3', 'ទឹកគីវី', 1.50, 1, 'L', '2025-03-04 13:52:43', '2025-03-04 13:52:43'),
(10, 5, '1', 'ទឹកគូលែន', 1.00, 1, 'S', '2025-03-04 13:53:12', '2025-03-04 13:53:12'),
(11, 5, '2', 'ទឹកគូលែន', 1.25, 1, 'M', '2025-03-04 13:53:12', '2025-03-04 13:53:12'),
(12, 5, '3', 'ទឹកគូលែន', 1.50, 1, 'L', '2025-03-04 13:53:12', '2025-03-04 13:53:12'),
(13, 6, '1', 'ទឹកស្តូបឺរី', 1.00, 1, 'S', '2025-03-04 13:53:56', '2025-03-04 13:53:56'),
(14, 6, '2', 'ទឹកស្តូបឺរី', 1.25, 1, 'M', '2025-03-04 13:53:56', '2025-03-04 13:53:56'),
(15, 6, '3', 'ទឹកស្តូបឺរី', 1.50, 1, 'L', '2025-03-04 13:53:56', '2025-03-04 13:53:56'),
(16, 7, '1', 'បាយឆាយ', 1.50, 1, 'S', '2025-03-04 13:55:18', '2025-03-04 13:55:18'),
(17, 7, '2', 'បាយឆាយ', 2.00, 1, 'L', '2025-03-04 13:55:18', '2025-03-04 13:55:18'),
(18, 8, '1', 'មីឆា', 1.50, 1, 'S', '2025-03-04 13:55:39', '2025-03-04 13:55:39'),
(19, 8, '2', 'មីឆា', 2.00, 1, 'L', '2025-03-04 13:55:39', '2025-03-04 13:55:39'),
(20, 9, '1', 'លោតឆា', 1.50, 1, 'S', '2025-03-04 13:56:03', '2025-03-04 13:56:03'),
(21, 9, '2', 'លោតឆា', 2.00, 1, 'L', '2025-03-04 13:56:03', '2025-03-04 13:56:03');

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
(5, 'superadmin', '2025-01-30 05:58:39', '2025-01-30 05:58:39');

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
(148, 0.25, NULL, NULL, 0.25, 'paid', '2025-01-30 18:12:49', '2025-01-30 18:14:09', NULL, NULL, NULL, NULL, 6, '782F-1FE6', 1, NULL),
(149, 19.5, NULL, NULL, 19.5, 'paid', '2025-02-16 03:20:22', '2025-02-16 03:20:38', NULL, NULL, NULL, NULL, 6, '71AA-9AEA', 1, NULL),
(150, 8000, NULL, NULL, 8000, 'paid', '2025-02-16 04:45:13', '2025-02-22 08:15:46', NULL, NULL, NULL, NULL, 6, '6863-4944', 1, NULL);

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
(103, 149, 12, 20, 3, 1.50, '4.5', '2025-02-16 03:20:22', '2025-02-16 03:20:31'),
(104, 149, 29, 45, 1, 15.00, '15', '2025-02-16 03:20:28', '2025-02-16 03:20:28'),
(105, 150, 1, 2, 4, 2000.00, '8000', '2025-02-16 04:45:13', '2025-02-22 08:15:36');

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
(3, 'Table 3', 8, '2025-01-28 17:06:57', '2025-01-28 17:06:57'),
(4, 'Table 4', NULL, NULL, NULL);

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
(6, 'Beauty & Health', 'davysrp@gmail.com', 'customer', '$2y$12$GYtA8godCnjt/c2mNlkUuuZaIkCMHroNtbI6qiho.LfIQqvGMqkQq', NULL, '2024-12-13 07:36:46', '2024-12-13 07:36:46', NULL, NULL),
(7, 'Beauty & Health', 'davysrpdddd@gmail.com', 'buyer', '$2y$12$2hFKjwaZ8BTTp8Ctha/8w.LiMOI8ZynHzYiDI0LICw/OoguOKfj3.', NULL, '2024-12-13 07:37:43', '2024-12-13 07:38:24', '2024-12-13 07:38:24', NULL),
(8, 'sophth', 'sophath@gmail.com', 'sellers', '$2y$12$ArT6zcLX3/Hgm.RwdCQUWe2m3lolnDKCfMZM/8V9FbBxKoFEzZp/u', NULL, '2025-01-25 09:26:24', '2025-01-25 09:26:24', NULL, NULL),
(9, 'sarothkh', 'sarothkh@gmail.com', 'buyer', '$2y$12$YA45LUjl3vzMQIPvj7KjJeHDv2x3r739Y7xjuwAgUPHCl1lab5deG', NULL, '2025-01-25 09:57:26', '2025-01-30 02:05:55', NULL, NULL),
(10, 'Lenghai', 'lenghai@gmaail.com', 'sellers', '$2y$12$nGhNlVHtOJtgVIBU6gJ0vu1uARXmmOWPVXnD4kBji4KLUBSOO6XEq', NULL, '2025-01-28 10:08:38', '2025-01-28 10:08:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE `webpages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `names` varchar(191) NOT NULL,
  `detail` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `names`, `detail`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'សូមស្វាគមន៍មកកាន់', 'ឆាតាន់យ៉ុង ក្រុងសិរីសោភ័ណ', 'webpages/t9VTzT12Zt61M3e0KwJUpousyRuXl351N53CCurO.jpg', 1, '2025-02-16 03:24:31', '2025-02-16 03:24:31', NULL),
(2, 'រស់ជាតិពិសេស', 'កាន់តែឆ្ងាញ់', 'webpages/4KeLEz3WTUs7hNyOlW41EbELFjNzG0QlF2hFWYwB.jpg', 1, '2025-02-16 03:33:09', '2025-02-16 03:34:08', NULL),
(3, 'រស់ជាតិថ្មី', 'និងឆ្ងាញ់ជាងមុនថ្វេដង', 'webpages/6zHVXGrV6fMTXHTbGyAkFtClqzLZ5q2mtUaylGAV.jpg', 1, '2025-02-16 03:48:15', '2025-02-16 03:48:15', NULL);

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
-- Indexes for table `permission_roles`
--
ALTER TABLE `permission_roles`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `permission_roles`
--
ALTER TABLE `permission_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sellerss`
--
ALTER TABLE `sellerss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `sell_details`
--
ALTER TABLE `sell_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

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
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_shipping_method_id_foreign` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_methods` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
