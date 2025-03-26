-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 09:48 AM
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
(14, 'Coffee25', 'Coffee25', 5.00, 1.00, 1000, 100, '2025-01-30', '2025-04-30', 'active', '2025-01-30 06:32:14', '2025-03-26 07:06:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `userphoto` varchar(255) DEFAULT 'customer_pictures/customerdefaultprofile.png',
  `is_general` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`, `remember_token`, `userphoto`, `is_general`) VALUES
(13, 'Sophath', '', '0987654321', NULL, '$2y$12$EttiAA9JW7yM.R42YhV9QOW8TYvE4sAJJiYHp9wgpXOFZFO9nglSO', '2025-03-23 06:26:05', '2025-03-23 06:26:05', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0),
(14, 'Sanday', '', '098765444333', NULL, '$2y$12$g5lNBqKQCAcayB6dnEfKT.hetObhYcrJAAAuA.8wu1bNnHPeLz9Aq', '2025-03-23 08:03:13', '2025-03-23 08:03:13', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0),
(15, 'davyksk', '', '087723423324', NULL, '$2y$12$cvdgSU4ZIEJOtn1yw6W3hu/6sf3o2tcjtxorMGDknpHjUM3vevVZ2', '2025-03-23 14:11:50', '2025-03-23 14:11:50', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0),
(16, 'Saroth KSK', '', '0987655432', NULL, '$2y$12$4l0Bv0MhocGRQ7sT2nYvl.rRkzfG4Q6hyxPjVd/IS/AS4TEq96Sg.', '2025-03-23 17:22:26', '2025-03-23 17:22:26', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0),
(17, 'Sophath', '', '0987623434324', NULL, '$2y$12$Asf/i9UIpCuROO8S8t8N7.Ax2YJ6gyIBZux.QaIgAtJBYm5C9tYR.', '2025-03-24 18:38:08', '2025-03-24 18:38:08', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0),
(18, 'general', 'customer', '+85599330923', 'sophath_hhh@gmail.com', NULL, '2025-03-26 07:21:56', '2025-03-26 07:26:42', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 1),
(42, 'ksk', '', '098766443', NULL, '$2y$12$R9kmTn5GvM7IDptlCkGojutaJdm/WltyrUr/Oz.TjJfPF1fXUVpxG', '2025-03-26 08:18:50', '2025-03-26 08:18:50', NULL, NULL, 'customer_pictures/customerdefaultprofile.png', 0);

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
(8, '2025_01_28_150146_create_coupon_codes_table', 4),
(9, '2025_01_28_150527_create_coupon_code_table', 5),
(11, '2025_01_28_220212_create_account_requests_table', 7),
(12, '2025_01_28_220712_create_account_requests_table', 1),
(13, '2025_01_28_221052_modify_users_id_column', 8),
(15, '2025_01_30_003109_create_customers_table', 10),
(16, '2025_01_30_005518_create_customers_table', 11),
(17, '2025_01_30_010611_create_customers_table', 12),
(18, '2025_01_30_083801_create_customers_table', 13),
(28, '2025_03_22_005502_add_password_to_customers_table', 19),
(30, '2025_01_24_193703_add_role_to_users_table', 20),
(31, '2025_01_24_205230_create_sellerss_table', 20),
(32, '2025_01_28_101612_create_customers_table', 20),
(33, '2025_01_28_151606_create_coupon_codes_table', 20),
(34, '2025_01_28_235958_create_tables_table', 20),
(35, '2025_01_30_084402_create_customers_table', 21),
(36, '2025_01_30_111647_create_shipping_methods_table', 21),
(37, '2025_01_30_111755_add_shipping_method_to_sells_table', 21),
(38, '2025_01_30_120518_create_permission_roles_table', 21),
(39, '2025_02_02_144115_create_webpages_table', 21),
(40, '2025_02_15_112945_create_product_variants_table', 21),
(41, '2025_03_02_220107_create_orders_table', 21),
(42, '2025_03_02_220108_create_order_items_table', 21),
(43, '2025_03_21_210119_add_google_id_to_customers_table', 21),
(44, '2025_03_22_015719_add_remember_token_to_customers_table', 22),
(45, '2025_03_22_020222_create_customers_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `shipping_address` varchar(191) NOT NULL,
  `payment_method` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `variant_name` varchar(191) DEFAULT NULL,
  `variant_size` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, 'លោតឆា', 6, 1.25, 0.00, NULL, '36187220250315103134.jpg', NULL, 1, NULL, '2025-02-16 05:05:04', '2025-03-15 03:31:34', NULL, '2Ga0edToZALvV8WJlmwP', 0);

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
  `customer_id` int(11) DEFAULT NULL,
  `q_number` int(10) DEFAULT NULL,
  `shipping_addr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `total`, `promo_code`, `discount`, `grand_total`, `status`, `created_at`, `updated_at`, `deleted_at`, `coupon_code_id`, `shipping_method_id`, `remark`, `payment_method_id`, `invoice_no`, `table_id`, `customer_id`, `q_number`, `shipping_addr`) VALUES
(151, 0.5, NULL, 0, 0, 'paid', '2025-03-11 13:12:30', '2025-03-26 06:47:29', NULL, '14', NULL, NULL, 6, '34C1-5426', 1, NULL, NULL, NULL),
(154, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-11 14:24:07', '2025-03-11 14:24:13', NULL, NULL, NULL, NULL, 6, '7DAA-183D', 1, NULL, NULL, NULL),
(155, 1.25, NULL, NULL, 1.25, 'paid', '2025-03-11 14:24:49', '2025-03-11 14:24:52', NULL, NULL, NULL, NULL, 6, '6001-3DCF', 1, NULL, NULL, NULL),
(156, 1.5, NULL, NULL, 1.5, 'paid', '2025-03-11 14:25:20', '2025-03-11 14:25:24', NULL, NULL, NULL, NULL, 6, '473D-F57C', 1, NULL, NULL, NULL),
(157, 1.5, NULL, NULL, 1.5, 'paid', '2025-03-11 14:25:36', '2025-03-11 14:25:42', NULL, NULL, NULL, NULL, 6, 'BBE5-B244', 1, NULL, NULL, NULL),
(158, 0.25, NULL, NULL, 0.25, 'paid', '2025-03-14 02:47:33', '2025-03-14 02:48:24', NULL, NULL, NULL, NULL, 6, '9894-DD98', 1, NULL, NULL, NULL),
(159, 1.75, NULL, NULL, 1.75, 'paid', '2025-03-14 02:50:30', '2025-03-14 02:50:54', NULL, NULL, NULL, NULL, 12, '8317-3FE2', 1, NULL, NULL, NULL),
(160, 3, NULL, NULL, 3, 'paid', '2025-03-14 02:51:38', '2025-03-14 02:51:56', NULL, NULL, NULL, NULL, 12, '7EEB-33CA', 1, NULL, NULL, NULL),
(161, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-14 02:53:04', '2025-03-15 02:51:51', NULL, NULL, NULL, NULL, 12, '7B09-7617', 1, NULL, NULL, NULL),
(162, 1.5, NULL, NULL, 1.5, 'paid', '2025-03-15 02:53:29', '2025-03-15 02:53:44', NULL, NULL, NULL, NULL, 6, '821E-6FC1', 1, NULL, NULL, NULL),
(163, 0.25, NULL, NULL, 0.25, 'paid', '2025-03-16 02:24:35', '2025-03-16 02:24:42', NULL, NULL, NULL, NULL, 13, '6505-F225', 1, NULL, NULL, NULL),
(164, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-16 02:26:31', '2025-03-16 02:44:13', NULL, NULL, NULL, NULL, 6, '4F67-A79E', 1, NULL, NULL, NULL),
(165, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-16 02:56:30', '2025-03-16 02:56:36', NULL, NULL, NULL, NULL, 6, '7CC3-D074', 1, NULL, NULL, NULL),
(166, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-16 08:29:32', '2025-03-19 03:40:26', NULL, NULL, NULL, NULL, 6, '6515-C299', 1, NULL, NULL, NULL),
(167, 0.25, NULL, NULL, 0.25, 'paid', '2025-03-19 03:40:52', '2025-03-23 15:15:52', NULL, NULL, NULL, NULL, 6, 'A0EA-AA9F', 1, NULL, NULL, NULL),
(168, 2.5, NULL, NULL, 2.5, 'paid', '2025-03-23 15:16:29', '2025-03-26 05:14:36', NULL, NULL, NULL, NULL, 6, 'C22A-ED9D', 1, NULL, NULL, NULL),
(169, NULL, NULL, NULL, NULL, 'pending', '2025-03-23 15:51:11', '2025-03-23 15:51:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, NULL, NULL, NULL, NULL, 'pending', '2025-03-23 15:51:12', '2025-03-23 15:51:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, NULL, NULL, NULL, NULL, 'pending', '2025-03-23 15:52:50', '2025-03-23 15:52:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, NULL, NULL, NULL, NULL, 'pending', '2025-03-23 15:56:34', '2025-03-23 15:56:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, NULL, NULL, NULL, NULL, 'pending', '2025-03-23 17:23:42', '2025-03-23 17:23:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, NULL, NULL, NULL, NULL, 'pending', '2025-03-24 18:38:39', '2025-03-24 18:38:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 03:47:59', '2025-03-26 03:47:59', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(176, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 03:52:07', '2025-03-26 03:52:07', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(177, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 03:58:30', '2025-03-26 03:58:30', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(178, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 04:00:44', '2025-03-26 04:00:44', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(179, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 04:06:29', '2025-03-26 04:06:29', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(180, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 04:41:28', '2025-03-26 04:41:28', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(181, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 04:42:23', '2025-03-26 04:42:23', NULL, NULL, NULL, NULL, 6, NULL, NULL, 17, NULL, NULL),
(182, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 04:54:00', '2025-03-26 04:54:00', NULL, NULL, NULL, NULL, 1, NULL, NULL, 17, NULL, NULL),
(183, 1.5, NULL, NULL, 1.5, 'paid', '2025-03-26 05:34:41', '2025-03-26 05:34:49', NULL, NULL, NULL, NULL, 6, 'B1EF-79E2', 1, NULL, NULL, NULL),
(184, 2, NULL, NULL, 2, 'paid', '2025-03-26 05:35:14', '2025-03-26 05:35:18', NULL, NULL, NULL, NULL, 6, 'E5CC-1DD8', 1, NULL, NULL, NULL),
(185, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-26 05:36:02', '2025-03-26 05:36:07', NULL, NULL, NULL, NULL, 6, '6B32-1F0E', 1, NULL, NULL, NULL),
(186, 2, NULL, NULL, 2, 'paid', '2025-03-26 05:37:26', '2025-03-26 05:37:31', NULL, NULL, NULL, NULL, 6, '4192-385B', 1, NULL, NULL, NULL),
(187, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-26 06:43:01', '2025-03-26 07:01:54', NULL, NULL, NULL, NULL, 6, '05DC-ED66', 1, NULL, 13, NULL),
(188, 0.5, NULL, NULL, 0.5, 'paid', '2025-03-26 07:01:48', '2025-03-26 07:01:52', NULL, NULL, NULL, NULL, 6, '925D-85E5', 1, NULL, NULL, NULL),
(189, NULL, NULL, 0.175, 3.325, 'pending', '2025-03-26 07:05:08', '2025-03-26 07:09:54', NULL, '14', NULL, NULL, NULL, '52C3-2E66', 1, NULL, NULL, NULL),
(190, NULL, NULL, NULL, NULL, 'pending', '2025-03-26 08:19:14', '2025-03-26 08:19:14', NULL, NULL, NULL, NULL, 1, NULL, NULL, 42, NULL, NULL);

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
(108, 153, 1, 2, 1, 0.50, '0.5', '2025-03-11 13:22:07', '2025-03-11 13:22:07'),
(107, 152, 1, 1, 1, 0.25, '0.25', '2025-03-11 13:14:43', '2025-03-11 13:14:43'),
(104, 149, 29, 45, 1, 15.00, '15', '2025-02-16 03:20:28', '2025-02-16 03:20:28'),
(105, 150, 1, 2, 4, 2000.00, '8000', '2025-02-16 04:45:13', '2025-02-22 08:15:36'),
(109, 154, 1, 2, 1, 0.50, '0.5', '2025-03-11 14:24:07', '2025-03-11 14:24:07'),
(111, 156, 8, 18, 1, 1.50, '1.5', '2025-03-11 14:25:20', '2025-03-11 14:25:20'),
(112, 157, 7, 16, 1, 1.50, '1.5', '2025-03-11 14:25:36', '2025-03-11 14:25:36'),
(115, 159, 2, 4, 3, 0.50, '1.5', '2025-03-14 02:50:30', '2025-03-14 02:50:43'),
(116, 159, 2, 3, 1, 0.25, '0.25', '2025-03-14 02:50:44', '2025-03-14 02:50:44'),
(117, 160, 1, 1, 4, 0.25, '1', '2025-03-14 02:51:38', '2025-03-14 02:51:43'),
(121, 161, 1, 2, 1, 0.50, '0.5', '2025-03-15 02:51:41', '2025-03-15 02:51:41'),
(122, 162, 8, 18, 1, 1.50, '1.5', '2025-03-15 02:53:29', '2025-03-15 02:53:29'),
(123, 163, 1, 1, 1, 0.25, '0.25', '2025-03-16 02:24:35', '2025-03-16 02:24:35'),
(125, 164, 1, 2, 1, 0.50, '0.5', '2025-03-16 02:44:08', '2025-03-16 02:44:08'),
(126, 165, 1, 2, 1, 0.50, '0.5', '2025-03-16 02:56:30', '2025-03-16 02:56:30'),
(144, 175, 2, 4, 1, 0.50, '0.5', '2025-03-26 03:47:59', '2025-03-26 03:47:59'),
(133, 169, 8, 0, 1, 1.25, '1.25', '2025-03-23 15:51:11', '2025-03-23 15:51:11'),
(134, 169, 5, 0, 2, 1.00, '2', '2025-03-23 15:51:11', '2025-03-23 15:51:11'),
(135, 169, 4, 0, 1, 1.00, '1', '2025-03-23 15:51:11', '2025-03-23 15:51:11'),
(136, 172, 2, 0, 1, 0.25, '0.25', '2025-03-23 15:56:34', '2025-03-23 15:56:34'),
(137, 172, 3, 0, 1, 0.25, '0.25', '2025-03-23 15:56:34', '2025-03-23 15:56:34'),
(138, 172, 1, 0, 1, 0.25, '0.25', '2025-03-23 15:56:34', '2025-03-23 15:56:34'),
(139, 173, 2, 0, 1, 0.25, '0.25', '2025-03-23 17:23:42', '2025-03-23 17:23:42'),
(140, 173, 3, 0, 1, 0.25, '0.25', '2025-03-23 17:23:42', '2025-03-23 17:23:42'),
(141, 173, 4, 0, 1, 1.00, '1', '2025-03-23 17:23:42', '2025-03-23 17:23:42'),
(142, 174, 6, 15, 1, 1.50, '1.5', '2025-03-24 18:38:39', '2025-03-24 18:38:39'),
(143, 174, 4, 8, 1, 1.25, '1.25', '2025-03-24 18:38:39', '2025-03-24 18:38:39'),
(145, 175, 7, 17, 1, 2.00, '2', '2025-03-26 03:47:59', '2025-03-26 03:47:59'),
(146, 175, 4, 9, 1, 1.50, '1.5', '2025-03-26 03:47:59', '2025-03-26 03:47:59'),
(147, 175, 5, 11, 1, 1.25, '1.25', '2025-03-26 03:47:59', '2025-03-26 03:47:59'),
(148, 176, 1, 2, 1, 0.50, '0.5', '2025-03-26 03:52:07', '2025-03-26 03:52:07'),
(149, 176, 2, 3, 1, 0.25, '0.25', '2025-03-26 03:52:07', '2025-03-26 03:52:07'),
(150, 176, 5, 10, 1, 1.00, '1', '2025-03-26 03:52:07', '2025-03-26 03:52:07'),
(151, 177, 5, 12, 1, 1.50, '1.5', '2025-03-26 03:58:30', '2025-03-26 03:58:30'),
(152, 177, 7, 16, 1, 1.50, '1.5', '2025-03-26 03:58:30', '2025-03-26 03:58:30'),
(153, 178, 1, 2, 1, 0.50, '0.5', '2025-03-26 04:00:44', '2025-03-26 04:00:44'),
(154, 178, 3, 5, 1, 0.25, '0.25', '2025-03-26 04:00:44', '2025-03-26 04:00:44'),
(155, 179, 5, 12, 1, 1.50, '1.5', '2025-03-26 04:06:29', '2025-03-26 04:06:29'),
(156, 180, 5, 12, 1, 1.50, '1.5', '2025-03-26 04:41:28', '2025-03-26 04:41:28'),
(157, 181, 5, 11, 1, 1.25, '1.25', '2025-03-26 04:42:23', '2025-03-26 04:42:23'),
(158, 181, 1, 2, 1, 0.50, '0.5', '2025-03-26 04:42:23', '2025-03-26 04:42:23'),
(159, 182, 6, 15, 1, 1.50, '1.5', '2025-03-26 04:54:00', '2025-03-26 04:54:00'),
(162, 168, 5, 11, 2, 1.25, '2.5', '2025-03-26 05:14:03', '2025-03-26 05:14:03'),
(165, 185, 2, 4, 2, 0.50, '1', '2025-03-26 05:36:02', '2025-03-26 05:37:02'),
(166, 186, 8, 19, 1, 2.00, '2', '2025-03-26 05:37:26', '2025-03-26 05:37:26'),
(169, 187, 1, 2, 1, 0.50, '0.5', '2025-03-26 06:50:33', '2025-03-26 06:50:33'),
(170, 188, 2, 4, 1, 0.50, '0.5', '2025-03-26 07:01:48', '2025-03-26 07:01:48'),
(171, 189, 9, 21, 1, 2.00, '2', '2025-03-26 07:05:08', '2025-03-26 07:05:08'),
(172, 189, 9, 20, 1, 1.50, '1.5', '2025-03-26 07:05:10', '2025-03-26 07:05:10'),
(173, 190, 8, 19, 1, 2.00, '2', '2025-03-26 08:19:14', '2025-03-26 08:19:14');

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
(1, 'Pickup from store', 'active', NULL, NULL),
(2, 'Get it delivered', 'active', NULL, NULL);

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
  `role` varchar(191) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'defaultprofile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `role_id`, `photo`) VALUES
(5, 'mradmin', 'mradmin@dd.com', 'user', '$2y$12$.42c.Yq3mgxuKqXKhrf01ufsAWmabZidJf8SKlfeN5cCHpQmWzKaa', NULL, '2024-04-04 23:14:06', '2025-03-15 04:10:48', '2025-03-15 04:10:48', NULL, NULL),
(7, 'Beauty & Health', 'davysrpdddd@gmail.com', 'user', '$2y$12$2hFKjwaZ8BTTp8Ctha/8w.LiMOI8ZynHzYiDI0LICw/OoguOKfj3.', NULL, '2024-12-13 07:37:43', '2024-12-13 07:38:24', '2024-12-13 07:38:24', NULL, NULL),
(8, 'sophth', 'sophath@gmail.com', 'user', '$2y$12$ArT6zcLX3/Hgm.RwdCQUWe2m3lolnDKCfMZM/8V9FbBxKoFEzZp/u', NULL, '2025-01-25 09:26:24', '2025-01-25 09:26:24', NULL, NULL, 'defaultprofile.png'),
(9, 'sarothkh', 'sarothkh@gmail.com', 'user', '$2y$12$YA45LUjl3vzMQIPvj7KjJeHDv2x3r739Y7xjuwAgUPHCl1lab5deG', NULL, '2025-01-25 09:57:26', '2025-01-30 02:05:55', NULL, NULL, 'Saroth.jpg'),
(10, 'Lenghai', 'lenghai@gmaail.com', 'user', '$2y$12$nGhNlVHtOJtgVIBU6gJ0vu1uARXmmOWPVXnD4kBji4KLUBSOO6XEq', NULL, '2025-01-28 10:08:38', '2025-03-15 04:10:41', '2025-03-15 04:10:41', NULL, NULL),
(11, 'dara', 'dara@gmail.com', 'user', '$2y$12$2GeSX2oiHRvtSW6tZEBnY.GMe/lla/cSN8uaYIH1x/mwxT.Fe/wIO', NULL, '2025-03-12 07:09:08', '2025-03-15 04:10:36', '2025-03-15 04:10:36', NULL, NULL),
(12, '0jh', 'dara@gmail.com', 'user', '$2y$12$9LFWB/ZoJ1DvIsOmoSRNke9xv4Zx1xXz0gvjYKmkV/5APeTj6AJ7O', NULL, '2025-03-12 07:09:50', '2025-03-12 07:10:46', '2025-03-12 07:10:46', NULL, NULL),
(13, 'dara', 'dara@gmail.com', 'user', '$2y$12$HQ2ly5SR7xXtyVraPVGLCeRU82DvH/LlSpC.YRi.8dqFKKLIy0bji', NULL, '2025-03-12 07:11:04', '2025-03-15 04:10:33', '2025-03-15 04:10:33', NULL, NULL),
(14, 'dara', 'dara@gmail.com', 'user', '$2y$12$uY1JF//3lNpgt.ubwXI6Se4Xguej66v9l4FU0WgQbdmOy.iEY4nFC', NULL, '2025-03-12 07:11:19', '2025-03-15 04:10:27', '2025-03-15 04:10:27', NULL, NULL),
(15, 'LoveYou', 'loveyou@gmail.com', 'user', '$2y$12$cO6o0vjHAXUlaaMtUgR0Uup97UbL6rwoBq4R3D7GmA.PhwEUpQnji', NULL, '2025-03-15 04:11:14', '2025-03-15 04:11:14', NULL, NULL, 'defaultprofile.png'),
(16, 'sarika', 'sarika@gmail.com', 'user', '$2y$12$3QymH9DEXpC44IHea6UnGuZtEJiSph.Cl5xP9MsnMWmF9T6/OVCfe', NULL, '2025-03-15 04:14:13', '2025-03-15 04:14:13', NULL, NULL, 'defaultprofile.png'),
(17, 'KaKiss', 'kaki@gmail.com', 'user', '$2y$12$S9Y59mv8C.8fzPlpyczZ3.LdvdupqNs0hkcD/UemvGpVSZbUMozAm', NULL, '2025-03-15 04:17:36', '2025-03-15 05:31:15', NULL, NULL, 'defaultprofile.png'),
(18, 'KSK', 'loveyou2@gmail.com', 'user', '$2y$12$7vpTGDTM5rzsdzYeKZ5yaelP4c41KMkPSQij/Sc9.VqbOGKMg1PiG', NULL, '2025-03-16 02:29:19', '2025-03-23 07:58:35', '2025-03-23 07:58:35', NULL, 'defaultprofile.png'),
(19, 'POPO', 'popo@gmail.com', 'user', '$2y$12$nFulYH9pfpBAyPVTkfbdDuy7Q8ORTm4YBMR19.ttNaJAtiAM0IByG', NULL, '2025-03-20 13:31:25', '2025-03-20 13:31:25', NULL, NULL, 'defaultprofile.png'),
(20, 'loveksks', 'loveksks@gmail.com', 'user', '$2y$12$Ysd7gYKspBUvwan9G5mgkuEszKFFWXttgSe/gB2XEzmCTzvW3ygYm', NULL, '2025-03-21 07:27:53', '2025-03-21 07:27:53', NULL, NULL, 'defaultprofile.png');

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
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`),
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sells_shipping_method_id_foreign` (`shipping_method_id`);

--
-- Indexes for table `sell_details`
--
ALTER TABLE `sell_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sell_details_sell` (`sell_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `sell_details`
--
ALTER TABLE `sell_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

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
