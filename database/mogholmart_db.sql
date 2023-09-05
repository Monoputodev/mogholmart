-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2023 at 04:17 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mogholmart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `title`, `slug`, `description`, `image_link`, `type`, `short_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'ddfdfgcbcccbcbc', 'test.png', '1', 0, 'cancel', '1', '1', '2023-05-13 03:11:23', '2023-05-13 03:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_column` varchar(32) DEFAULT NULL,
  `type` enum('text','textarea','checkbox') DEFAULT NULL,
  `type_is_required` varchar(16) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `backend_title` varchar(32) DEFAULT NULL,
  `frontend_title` varchar(32) DEFAULT NULL,
  `default_value` varchar(16) DEFAULT NULL,
  `use_in_quick_search` varchar(16) DEFAULT NULL,
  `use_in_advance_search` varchar(16) DEFAULT NULL,
  `use_in_filter` varchar(16) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `code_column`, `type`, `type_is_required`, `order`, `backend_title`, `frontend_title`, `default_value`, `use_in_quick_search`, `use_in_advance_search`, `use_in_filter`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'sft', 'text', 'no', 4, NULL, 'Sft.', 'no', 'no', 'no', 'no', 'active', '1', '1', '2023-02-23 07:10:16', '2023-08-29 02:43:24'),
(2, 'pcs', 'text', 'no', 4, NULL, 'Pcs.', 'no', 'no', 'no', 'no', 'active', '1', '1', '2023-08-29 02:35:11', '2023-08-29 02:38:06'),
(3, 'units', 'text', 'no', 4, NULL, 'Units', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:35:39', '2023-08-29 02:35:39'),
(4, 'ltr', 'text', 'no', 4, NULL, 'Ltr.', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:35:53', '2023-08-29 02:35:53'),
(5, 'metre', 'text', 'no', 4, NULL, 'Metre', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:36:44', '2023-08-29 02:36:44'),
(6, 'kg', 'text', 'no', 4, NULL, 'Kg.', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:37:03', '2023-08-29 02:37:03'),
(7, 'amp', 'text', 'no', 4, NULL, 'Amp.', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:37:41', '2023-08-29 02:37:41'),
(8, 'millimetres', 'text', 'no', 4, NULL, 'Millimetres', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:41:50', '2023-08-29 02:41:50'),
(9, 'centimeter', 'text', 'no', 4, NULL, 'Centimeter', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:43:12', '2023-08-29 02:43:12'),
(10, 'km', 'text', 'no', 4, NULL, 'Km.', 'no', 'no', 'no', 'no', 'active', '1', NULL, '2023-08-29 02:44:16', '2023-08-29 02:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED DEFAULT NULL,
  `frontend_title` varchar(32) DEFAULT NULL,
  `backend_title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_set`
--

CREATE TABLE `attribute_set` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_set`
--

INSERT INTO `attribute_set` (`id`, `title`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'mogholmart', 'mogholmart', 'active', '1', NULL, '2023-02-23 06:55:58', '2023-02-23 06:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_set_items`
--

CREATE TABLE `attribute_set_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED DEFAULT NULL,
  `attribute_set_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_set_items`
--

INSERT INTO `attribute_set_items` (`id`, `attribute_id`, `attribute_set_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '1', NULL, '2023-08-29 02:45:38', '2023-08-29 02:45:38'),
(2, 9, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(3, 6, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(4, 10, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(5, 4, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(6, 5, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(7, 8, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(8, 2, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(9, 1, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14'),
(10, 3, 1, '1', NULL, '2023-08-29 02:46:14', '2023-08-29 02:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `manufacturer_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `is_top_brand` varchar(32) DEFAULT NULL,
  `meta_title` varchar(32) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image_link` varchar(128) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `manufacturer_id`, `title`, `slug`, `image_link`, `is_top_brand`, `meta_title`, `meta_description`, `meta_image_link`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samsung', 'samsung', 'Samsung.png', 'yes', NULL, NULL, NULL, 'active', '1', NULL, '2023-08-25 10:08:53', '2023-08-25 10:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `banner_link` varchar(128) DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `meta_title` varchar(32) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(128) DEFAULT NULL,
  `meta_image_link` varchar(128) DEFAULT NULL,
  `show_in_main_menu` varchar(16) DEFAULT NULL,
  `show_in_left_navigation_menu` varchar(16) DEFAULT NULL,
  `show_in_right_navigation_menu` varchar(16) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `slug`, `description`, `image_link`, `banner_link`, `short_order`, `meta_title`, `meta_description`, `meta_keywords`, `meta_image_link`, `show_in_main_menu`, `show_in_left_navigation_menu`, `show_in_right_navigation_menu`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(30, 'Whitening Skin cream', 'whitening-skin-cream', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'cancel', '1', '1', '2023-06-17 03:06:23', '2023-08-16 23:58:02'),
(31, 'Night Cream', 'night-cream', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'cancel', '1', '1', '2023-07-10 04:53:03', '2023-08-16 23:58:04'),
(32, 'Turky Girl', 'turky-girl', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'cancel', '1', '1', '2023-07-10 05:03:32', '2023-08-16 23:58:06'),
(33, 'Electronics & Home Appliances', 'electronics--home-appliances', NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', '1', '2023-08-18 04:23:19', '2023-09-05 03:54:18'),
(34, 'Automotive & Motorbike', 'automotive--motorbike', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:36:09', '2023-08-18 04:36:09'),
(35, 'Men\'s & Boy\'s Fashion', 'mens--boys-fashion', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', '1', '2023-08-18 04:36:50', '2023-08-18 04:37:40'),
(36, 'Women & Girl\'s Wear', 'women--girls-wear', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:37:25', '2023-08-18 04:37:25'),
(37, 'Sports & Outdoors', 'sports--outdoors', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:38:14', '2023-08-18 04:38:14'),
(38, 'Clothes', 'clothes-', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:38:42', '2023-08-18 04:38:42'),
(39, 'Groceries', 'groceries', NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:39:07', '2023-08-18 04:39:07'),
(40, 'Trees', 'trees', NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'active', '1', NULL, '2023-08-18 04:39:25', '2023-08-18 04:39:25'),
(41, 'Tools', 'tools', NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'inactive', '1', '1', '2023-08-18 04:39:42', '2023-09-01 21:00:10'),
(42, 'Mobil & Elektronik', 'mobil--elektronik', NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'cancel', '1', '1', '2023-08-25 10:27:59', '2023-08-26 08:32:19'),
(43, 'Tools 2', 'tools-2', NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, 'yes', 'yes', 'yes', 'inactive', '1', '1', '2023-09-05 03:47:24', '2023-09-05 03:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `category_self_relation`
--

CREATE TABLE `category_self_relation` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_category_id` int(10) UNSIGNED DEFAULT NULL,
  `child_category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_self_relation`
--

INSERT INTO `category_self_relation` (`id`, `parent_category_id`, `child_category_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(30, NULL, 30, '1', NULL, '2023-06-17 03:06:23', '2023-06-17 03:06:23'),
(31, NULL, 31, '1', NULL, '2023-07-10 04:53:03', '2023-07-10 04:53:03'),
(32, NULL, 32, '1', NULL, '2023-07-10 05:03:32', '2023-07-10 05:03:32'),
(33, NULL, 33, '1', NULL, '2023-08-18 04:23:19', '2023-08-18 04:23:19'),
(34, NULL, 34, '1', NULL, '2023-08-18 04:36:09', '2023-08-18 04:36:09'),
(35, NULL, 35, '1', NULL, '2023-08-18 04:36:50', '2023-08-18 04:36:50'),
(36, NULL, 36, '1', NULL, '2023-08-18 04:37:25', '2023-08-18 04:37:25'),
(37, NULL, 37, '1', NULL, '2023-08-18 04:38:14', '2023-08-18 04:38:14'),
(38, NULL, 38, '1', NULL, '2023-08-18 04:38:42', '2023-08-18 04:38:42'),
(39, NULL, 39, '1', NULL, '2023-08-18 04:39:07', '2023-08-18 04:39:07'),
(40, NULL, 40, '1', NULL, '2023-08-18 04:39:25', '2023-08-18 04:39:25'),
(41, NULL, 41, '1', NULL, '2023-08-18 04:39:42', '2023-08-18 04:39:42'),
(42, NULL, 42, '1', NULL, '2023-08-25 10:27:59', '2023-08-25 10:27:59'),
(43, NULL, 43, '1', NULL, '2023-09-05 03:47:24', '2023-09-05 03:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `comissions_setting`
--

CREATE TABLE `comissions_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchant_id` int(10) UNSIGNED DEFAULT NULL,
  `comission_rate` double(5,2) DEFAULT NULL,
  `comission_type` enum('default','merchantwise','brandwise','productwise') DEFAULT NULL,
  `from_date` varchar(32) DEFAULT NULL,
  `to_date` varchar(32) DEFAULT NULL,
  `items` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_us`
--

CREATE TABLE `complain_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `complain` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(256) DEFAULT NULL,
  `display_title` varchar(256) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `key`, `display_title`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'site.name', NULL, 'Moghol Mart', 'text', '2023-02-23 06:51:49', '2023-06-17 00:51:09'),
(2, 'office.time', NULL, '09:00:00-18:30:00', 'text', '2023-02-23 06:52:20', '2023-02-23 06:52:20'),
(3, 'short.cut.icon', NULL, 'short.cut.icon.png', 'file', '2023-02-23 06:52:53', '2023-02-23 06:52:53'),
(4, 'logo', NULL, 'logo.png', 'file', '2023-02-23 06:53:18', '2023-02-23 06:53:18'),
(5, 'product.image.size', NULL, '300', 'text', '2023-02-23 06:54:37', '2023-08-16 23:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_name` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coupon_code` varchar(32) DEFAULT NULL,
  `coupon_type` varchar(32) DEFAULT NULL,
  `user_per_customer` int(11) DEFAULT NULL,
  `user_per_coupon` int(11) DEFAULT NULL,
  `valid_from` varchar(32) DEFAULT NULL,
  `valid_to` varchar(32) DEFAULT NULL,
  `amount` decimal(10,4) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_condition`
--

CREATE TABLE `coupon_condition` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `coupon_condition` varchar(32) DEFAULT NULL,
  `coupon_value` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_per_item_relation`
--

CREATE TABLE `coupon_per_item_relation` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `column_list` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emi`
--

CREATE TABLE `emi` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(128) DEFAULT NULL,
  `emi_month` varchar(32) DEFAULT NULL,
  `emi_rate` decimal(10,4) DEFAULT NULL,
  `emi_interest_rate` decimal(10,4) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_pages`
--

CREATE TABLE `general_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `meta_title` varchar(32) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image_link` varchar(128) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_pages`
--

INSERT INTO `general_pages` (`id`, `title`, `slug`, `short_description`, `description`, `image_link`, `meta_title`, `meta_description`, `meta_image_link`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', 'Moghol Mart is focused on providing an excellent customer experience, ease of purchase, comprehensive customer care, and hassle-free shopping in a single platform.', '<p class=\"MsoNormal\" style=\"text-align: justify; margin-bottom: 7.5pt; line-height: normal;\"><span style=\"font-size: 10.5pt;\">This site launched in 2023,&nbsp;</span><b style=\"font-size: 10.5pt;\">Moghol Mart&nbsp;</b><span style=\"font-size: 10.5pt;\">is\r\na Bangladeshi online shopping marketplace.&nbsp;</span><b style=\"font-size: 10.5pt;\">Moghol Mart</b><span style=\"font-size: 10.5pt;\">&nbsp;offers\r\na diverse collection in categories ranging from consumer Electronics to\r\nHousehold goods, Beauty, Fashion, Sports Equipment, Automotive, clothes, trees,\r\nTools, Shitol Pati, Madur Crafts, Groceries &amp; many more.</span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">Moghol Mart</span></b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">&nbsp;is focused on providing an excellent\r\ncustomer experience, ease of purchase, comprehensive customer care, and\r\nhassle-free shopping in a single platform.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-bottom: 7.5pt; line-height: normal;\"><b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">Moghol Mart</span></b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">&nbsp;gives you exclusive locally manufactured and imported brands\r\nwith high-quality products, which will make you confident in shopping.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">We always believe in\r\ncustomer satisfaction. So, our goal is to give the best product and that is why\r\nwe work with some selective brand\'s original products. We want to see our\r\ncustomers are always happy by using our products.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">All products from <b>Moghol\r\nMart</b>&nbsp;are sourced from Bangladeshi manufacturers and some trusted\r\ncountries such as Sweden, Canada, Poland, Australia, and the USA.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">So, you will get Country\r\nand foreign flavors at affordable prices from&nbsp;<b>Moghol Mart</b>&nbsp;and\r\nthere is no chance for our customers to get duplicate products from us.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">We believe you will get\r\n100% satisfaction in shopping through the&nbsp;<b>Moghol Mart&nbsp;</b>marketplace\r\nwith Moghol Flavors.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">Moghol Mart</span></b><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">&nbsp;always believe in customer satisfaction.\r\nSo, our goal is to give the best product and that is why we work with some\r\nselective brand\'s original product. We want to see our customers are always\r\nhappy by using our products.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">All products are sourced\r\nfrom Bangladeshi manufacturers and some trusted countries such as Sweden,\r\nCanada, Poland, Australia, and the USA.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">So, you will get Country\r\nand foreign flavors at affordable prices from&nbsp;<b>Moghol Mart</b>&nbsp;and\r\nthere is no chance for our customers to get duplicate products from us.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom: 7.5pt;\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt;text-align:justify;line-height:\r\nnormal\"><span style=\"font-size: 10.5pt; font-family: Arial, \" sans-serif\";\"=\"\">We believe you will get\r\n100% satisfaction in shopping through the&nbsp;<b>Moghol Mart&nbsp;</b>marketplace\r\nwith <b>Moghol Flavors.</b><o:p></o:p></span></p>', '', NULL, NULL, NULL, 'active', '1', '1', '2023-08-25 10:44:40', '2023-09-01 20:53:49');
INSERT INTO `general_pages` (`id`, `title`, `slug`, `short_description`, `description`, `image_link`, `meta_title`, `meta_description`, `meta_image_link`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Privacy Policy', 'privacy-policy', 'This site launched in 2023, Moghol Mart is a Bangladeshi online shopping marketplace. Moghol Mart offers a diverse collection in categories ranging from consumer Electronics to Household goods, Beauty, Fashion, Sports Equipment, Automotive, clothes, trees, Tools, Shitol Pati, Madur Crafts, Groceries & many more.', '<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin: 0in 0in 0.1in 65px; text-align: justify; text-indent: -13.5pt; line-height: normal;\"><br></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 8pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Welcome to the</span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#2e74b5;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#2e74b5;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">mogholmart.com </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#333333;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">website (the \"site\") operated by </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#2e74b5;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Moghol Mart Bangladesh Limited. </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#333333;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We respect your privacy and want to protect your personal information. To learn more, please read this Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">This Privacy Policy explains how we collect, use and (under certain conditions) disclose your personal information. This Privacy Policy also explains the steps we have taken to secure your personal information.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Finally, this Privacy Policy explains your options regarding the collection, use and disclosure of your personal information. By visiting the site directly or through another site, you accept the practices described in this Policy.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Data protection is a matter of trust and your privacy is important to us. We shall therefore only use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with you.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">4.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will only keep your information for as long as we are either required to by law or as is relevant for the purposes for which it was collected.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">5.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will cease to retain your personal data, or remove the means by which the data can be associated with you, as soon as it is reasonable to assume that such retention no longer serves the purposes for which the personal data was collected, and is no longer necessary for any legal or business purpose.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">6.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">You can visit the site and browse without having to provide personal details. During your visit to the site you remain anonymous and at no time can we identify you unless you have an account on the site and log on with your user name and password.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -22pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Data that we collect:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.1.We may collect various pieces of information if you seek to place an order for a product with us on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.2.We collect, store and process your data for processing your purchase on the site and any possible later claims, and to provide you with our services.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.3.We may collect personal information including, but not limited to, your title, name, gender, date of birth, email address, postal address, delivery address (if different), telephone number, mobile number, fax number, payment details, payment card details or bank account details.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.Moghol Mart shall collect the following information where you are a buyer:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.1</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Identity data, such as your name, gender, profile picture, and date of birth. Contact data, such as billing address, delivery address/location, email address and phone numbers. Biometric data, such as voice files and face recognition when you use our voice search function, and your facial features of when you use the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.2</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Billing account information: bank account details, credit card account and payment information (such account data may also be collected directly by our affiliates and/or third party payment service providers).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.3</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Transaction records/data, such as details about orders and payments, user clicks, and other details of products and services related to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.4</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Technical data, such as Internet protocol (IP) address, your login data, browser type and version, time zone setting and location, device information on, browser plug-in types and versions, operating system and platform, international mobile equipment identity, device identifier, IMEI, MAC address, cookies (where applicable) and other information and technology on the devices you use to access the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.5</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Profile data, such as your username and password, account settings, orders related to you, user research, your interests, preferences, and feedback and survey responses.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.6</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Usage data, such as information on how you use the site, products and services or view any content on the site, including the time spent on the site, items and data searched for on the site, access times and dates, as well as websites you were visiting before you came to the site and other similar statistics.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.7</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Location data, such as when you capture and share your location with us in the form of photographs or videos and upload such content to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.8</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and communications data, such as your preferences in receiving marketing from us and our third parties, your communication preferences and your chat, email or call history on the site or with third party customer service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.9</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Additional information we may request you to submit for due diligence checks or required by relevant authorities as required for identity verification (such as copies of government issued identification, e.g. passport, ID cards, etc.) or if we believe you are violating our Privacy Policy or our customer Terms and conditions.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Moghol Mart shall collect the following information where you are a seller:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -58pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 58pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.1.Identity and contact data, such as your name, date of birth or incorporation, company name, address, email address, phone number and other business-related information (e.g. company registration number, business license, tax information, shareholder and director information, etc.).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.2.Account data, such as bank account details, bank statements, credit card details and payment details (such account data may also be collected directly by our affiliates and/or third party payment service providers).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.3.Transaction data, such as details about orders and payments, and other details of products and Services related to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.4.Technical data, such as Internet protocol (IP) address, your login data, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, international mobile equipment identity, device identifier, IMEI, MAC address, cookies (where applicable) and other information and technology on the devices you use to access the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.5.Profile data, such as your username and password, orders related to you, your interests, preferences, and feedback and survey responses.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.6.Usage data, such as information on how you use the site, products and services or view any content on the site, including the time spent on the site, items and data searched for on the site, access times and dates, as well as websites you were visiting before you came to the site and other similar statistics.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.7.Location data, such as when you capture and share your location with us in the form of photographs or videos and upload such content to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.8.Marketing and communications data, such as your preferences in receiving marketing from us and our third parties and your communication preferences and your chat, email or call history on the site or with our third party seller service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.9.Additional information we may request you to submit for authentication (such as copies of government issued identification, e.g. passport, ID cards, etc.) or if we believe you are violating our Privacy Policy or our Terms of Use.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">8.We will use the information you provide to enable us to process your orders and to provide you with the services and information offered through our website and which you request in the following ways:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If you are a buyer:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Processing your orders for products.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Process orders you submit through the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Deliver the products you have purchased through the site for which we may pass your personal information on to a third party (e.g. our logistics partner) in order to make delivery of the product to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Update you on the delivery of the products.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Provide customer support for your orders.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Verify and carry out payment transactions (including any credit card payments, bank transfers, offline payments, remittances, or e-wallet transactions) in relation to payments related to you and/or services used by you. In order to verify and carry out such payment transactions, payment information, which may include personal data, will be transferred to third parties such as our payment service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Providing services</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Facilitate your use of the services or access to the site</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Administer your account with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Display your name, username or profile on the site (including on any reviews you may post).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Respond to your queries, feedback, claims or disputes, whether directly or through our third party service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Display on scoreboards on the site in relation to campaigns, mobile games or any other activity.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;&nbsp;Provide you with information we think you may find useful or which you have requested from us (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Send you marketing or promotional information about \\ products and services on the site from time to time (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Help us conduct marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">d.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Legal and operational purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ascertain your identity in connection with fraud detection purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Compare information, and verify with third parties in order to ensure that the information is accurate.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Process any complaints, feedback, enforcement action you may have lodged with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Produce statistics and research for internal and statutory reporting and/or record-keeping requirements.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Store, host, back up your personal data.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Investigate any actual or suspected violations of our Terms of Use, Privacy Policy, fraud, unlawful activity, omission or misconduct, whether relating to your use of site or any other matter arising from your relationship with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.Perform due diligence checks.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Comply with legal and regulatory requirements (including, where applicable, the display of your name, contact details and company details), including any law enforcement requests, in connection with any legal proceedings, or otherwise deemed necessary by us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Where necessary to prevent a threat to life, health or safety.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">e.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Analytics, research, business and development.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Understand your user experience on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Improve the layout or content of the pages of the site and customize them for users</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Identify visitors on the site. Conduct surveys, including carrying out research on our users’ demographics and behavior.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Derive further attributes relating to you based on personal data provided by you (whether to us or third parties), in order to provide you with more targeted and/or relevant information.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conduct data analysis, testing and research, monitoring and analyzing usage and activity trends.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">f.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Others:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;Any other purpose to which your consent has been obtained.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">j.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conduct automated decision-making processes in accordance with any of the above purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">g.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If you are a seller:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 47px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Providing Services</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 47px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate your use of the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To ship or deliver the products you have listed or sold through the site. We may pass your personal information on to a third party (e.g. our logistics partners) or relevant regulatory authority (e.g. customs) in order to carry out shipping or delivery of the products listed or sold by you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To respond to your queries, feedback, claims or disputes, whether directly or through our third party service agents.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To verify your documentation submitted to us facilitate your onboarding with us as a seller on the site, including the testing of technologies to enable faster and more efficient onboarding.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To administer your account (if any) with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To display your name, username or profile on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To verify and carry out financial transactions (including any credit card payments, bank transfers, offline payments, remittances, or e-wallet transactions) in relation to payments related to you and/or Services used by you. In order to verify and carry out such payment transactions, payment information, which may include personal data, will be transferred to third parties such as our payment service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To assess your application for loan facilities and/or to perform credit risk assessments in relation to your application for seller financing (where applicable).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">x.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To provide you with ancillary logistics services to protect against risks of failed deliveries or customer returns.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">xi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate the return of products to you (which may be through our logistics partner).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">h.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and advertising:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 71px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To send you marketing or promotional materials about our or third-party sellers’ products and services on our site from time to time (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 71px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii. To help us conduct marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Legal and operational purposes</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i..To produce statistics and research for internal and statutory reporting and/or record-keeping requirements.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 95px; text-indent: -40pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 40pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To store, host, back up your personal data.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To prevent or investigate any actual or suspected violations of our Terms of Use, Privacy Policy, fraud, unlawful activity, omission or misconduct, whether relating to your use of our Services or any other matter arising from your relationship with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To comply with legal and regulatory requirements (including, where applicable, the display of your name, contact details and company details), including any law enforcement requests, in connection with any legal proceedings or otherwise deemed necessary by us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Where necessary to prevent a threat to life, health or safety.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To process any complaints, feedback, enforcement action and take-down requests in relation to any content you have uploaded to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.To compare information, and verify with third parties in order to ensure that the information is accurate.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To ascertain your identity in connection with fraud detection purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate the takedown of prohibited and controlled items from our site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 17px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">j.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Analytics, research, business and development</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To audit the downloading of data from the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To understand the user experience with the services and the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To improve the layout or content of the pages of the site and customize them for users.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To conduct surveys, including carrying out research on our users’ demographics and behavior to improve our current technology (e.g. voice recognition tech, etc) via machine learning or other means.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To derive further attributes relating to you based on personal data provided by you (whether to us or third parties), in order to provide you with more targeted and/or relevant information.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To conduct data analysis, testing and research, monitoring and analyzing usage and activity trends.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To further develop our products and services.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To know our sellers better.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">k.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Others:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Any other purpose to which your consent has been obtained.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To conduct automated decision-making processes in accordance with any of these purposes.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -13pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">9.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Further, we will use the information you provide to administer your account with us; verify and carry out financial transactions in relation to payments you make; audit the downloading of data from our website; improve the layout and/or content of the pages of our website and customize them for users; identify visitors on our website; carry out research on our users\' demographics; send you information we think you may find useful or which you have requested from us, including information about our products and services, provided you have indicated that you have not objected to being contacted for these purposes.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -13pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">10.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Subject to obtaining your consent we may contact you by email with details of other products and services. You may unsubscribe from receiving marketing information at any time in our mobile application settings or by using the unsubscribe function within the electronic marketing material. We may use your contact information to send newsletters from us and from our related companies. If you prefer not to receive any marketing communications from us, you can opt out at any time.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -13pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">11.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may pass your name and address on to a third party in order to make delivery of the product to you (for example to our courier or supplier). You must only submit to us the site information which is accurate and not misleading and you must keep it up to date and are responsible for informing us of changes to your personal data, or in the event you believe that the personal data we have about you is inaccurate, incomplete, misleading or out of date. Inform us of changes. You can update your personal data anytime by accessing your account on the site.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -13pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">12.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Your actual order details may be stored with us but for security reasons cannot be retrieved directly by us. However, you may access this information by logging into your account on the site. Here you can view the details of your orders that have been completed, those which are open and those which are shortly to be dispatched and administer your address details, bank details ( for refund purposes) and any newsletter to which you may have subscribed. You undertake to treat the personal access data confidentially and not make it available to unauthorized third parties. We cannot assume any liability for misuse of passwords unless this misuse is our fault.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -4pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 4pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">13.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Other uses of your Personal Information:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We may use your personal information for opinion and market research. Your details are anonymous and will only be used for statistical purposes. You can choose to opt out of this at any time. Any answers to surveys or opinion polls we may ask you to complete will not be forwarded on to third parties. Disclosing your email address is only necessary if you would like to take part in competitions. We save the answers to our surveys separately from your email address.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.We may also send you other information about us, the site, our other websites, our products, sales promotions, our newsletters, anything relating to other companies in our group or our business partners. If you would prefer not to receive any of this additional information as detailed in this paragraph (or any part of it) please click the \'unsubscribe\' link in any email that we send to you. Within 7 working days (days which are neither (i) a Sunday, nor (ii) a public holiday anywhere in Bangladesh) of receipt of your instruction we will cease to send you information as requested. If your instruction is unclear we will contact you for clarification.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may further anonymize data about users of the site generally and use it for various purposes, including ascertaining the general location of the users and usage of certain aspects of the site or a link contained in an email to those registered to receive them, and supplying that anonymized data to third parties such as publishers. However, that anonymized data will not be capable of identifying you personally.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">14.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Competitions:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.For any competition we use the data to notify winners and advertise our offers. You can find more details where applicable in our participation terms for the respective competition.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">15.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Third Parties and Links:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We may pass your details to other companies in our group. We may also pass your details to our agents and subcontractors to help us with any of our uses of your data set out in our Privacy Policy. For example, we may use third parties to assist us with delivering products to you, to help us to collect payments from you, to analyze data and to provide us with marketing or customer service assistance. We may also exchange information with third parties for the purposes of fraud protection and credit risk reduction.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.We may share (or permit the sharing of) your personal data with and/or transfer your personal data to third parties and/or our affiliates for the above-mentioned purposes. These third parties and affiliates, which may be located inside or outside your jurisdiction, include but are not limited to.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Service providers (such as agents, vendors, contractors and partners) in areas such as payment services, logistics and shipping, marketing, data analytics, market or consumer research, survey, social media, customer service, installation services, information technology and website hosting.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">d.Their service providers and related companies.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">16.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Other users of the site:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We may transfer our databases containing your personal information if we sell our business or part of it, provided that we satisfy the requirements of applicable data protection law when disclosing your personal data. Other than as set out in this Privacy Policy, we shall NOT sell or disclose your personal data to third parties without obtaining your prior consent unless this is necessary for the purposes set out in this Privacy Policy or unless we are required to do so by law. The site may contain advertising of third parties and links to other sites or frames of other sites. Please be aware that we are not responsible for the privacy practices or content of those third parties or other sites, nor for any third party to whom we transfer your data in accordance with our Privacy Policy. You are advised to check on the applicable privacy policies of those websites to determine how they will handle any information they collect from you.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.In disclosing your personal data to third parties, we endeavor to ensure that the third parties and our affiliates keep your personal data secure from unauthorized access, collection, use, disclosure, processing or similar risks and retain your personal data only for as long as your personal data helps with any of the uses of your data as set out in our Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may transfer or permit the transfer of your personal data outside of Bangladesh for any of the purposes set out in this Privacy Policy. However, we will not transfer or permit any of your personal data to be transferred outside of Bangladesh unless the transfer is in compliance with applicable laws and this Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">d.We may share your personal data with our third party service providers or affiliates (e.g. payment service providers) in order for them to offer services to you other than those related to your use of the site. Your acceptance and use of the third party service providers or our affiliate’s services shall be subject to terms and conditions as may be agreed between you and the third party service provider or our affiliate. Upon your acceptance of the third party service provider’s or our affiliate’s service offering, the collection, use, disclosure, storage, transfer and processing of your data (including your personal data and any data disclosed by us to such third party service provider or affiliate) shall be subject to the applicable privacy policy of the third party service provider or our affiliate, which shall be the data controller of such data. You agree that any queries or complaints relating to your acceptance or use of the third party service providers or our affiliate’s services shall be directed to the party named in the applicable privacy policy.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">17.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Cookies:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We or our authorized service providers may use cookies, web beacons, and other similar technologies in connection with your use of the site.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.The acceptance of cookies is not a requirement for visiting the site. However, we would like to point out that the use of the \'basket\' functionality on the site and ordering is only possible with the activation of cookies. Cookies are small text files (typically made up of letters and numbers) placed in the memory of your browser or device when you visit a website or view a message. They allow us to recognize a particular device or browser. Web beacons are small graphic images that may be included on the site. They allow us to count users who have viewed these pages so that we can better understand your preference and interests. Cookies are tiny text files which identify your computer to our server as a unique user when you visit certain pages on the site and they are stored by your Internet browser on your computer\'s hard drive. Cookies can be used to recognize your Internet Protocol address, saving you time while you are on, or want to enter, the site. We only use cookies for your convenience in using the site (for example to remember who you are when you want to amend your shopping cart without having to re-enter your email address) and not for obtaining or using any other information about you (for example targeted advertising). However, certain cookies are required to enable core functionality (such as adding items to your shopping basket), so please note that changing and deleting cookies may affect the functionality available on the Sit. Your browser can be set to not accept cookies, but this would restrict your use of the site. Please accept our assurance that our use of cookies does not contain any personal or private details and are free from viruses. This website uses Google Analytics, a web analytics service provided by Google, Inc. (\"Google\"). Google Analytics uses cookies, which are text files placed on your computer, to help the website analyze how users use the site. The information generated by the cookie about your use of the website (including your IP address) will be transmitted to and stored by Google on servers in the United States. Google will use this information for the purpose of evaluating your use of the website, compiling reports on website activity for website operators and providing other services relating to website activity and internet usage. Google may also transfer this information to third parties where required to do so by law, or where such third parties process the information on Google\'s behalf. Google will not associate your IP address with any other data held by Google. You may refuse the use of cookies by selecting the appropriate settings on your browser, however please note that if you do this you may not be able to use the full functionality of this website. By using this website, you consent to the processing of data about you by Google in the manner and for the purposes set out above.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">18.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Security:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We have in place appropriate technical and security measures to prevent unauthorized or unlawful access to or accidental loss of or destruction or damage to your information. When we collect data through the site, we collect your personal details on a secure server. We use firewalls on our servers. Our security procedures mean that we may occasionally request proof of identity before we disclose personal information to you. You are responsible for protecting against unauthorized access to your password and to your computer.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.You should be aware, however, that no method of transmission over the Internet or method of electronic storage is completely secure. While security cannot be guaranteed, we strive to protect the security of your information and are constantly reviewing and enhancing our information security measures.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">19.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Your rights:</span></p><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:8pt;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-family: Arial, sans-serif; font-size: 10.5pt; white-space-collapse: preserve;\">If you are concerned about your data, you have the right to request access to the personal data which we may hold or process about you. You have the right to require us to correct any inaccuracies in your data free of charge. At any stage you also have the right to ask us to stop using your personal data for direct marketing purposes.</span></div><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">Where permitted by applicable data protection laws, we reserve the right to charge a reasonable administrative fee for retrieving your personal data records. If so, we will inform you of the fee before processing your request.</span></div></span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">You may communicate the withdrawal of your consent to the continued use, disclosure, storing and/or processing of your personal data by contacting our customer services, subject to the conditions and/or limitations imposed by applicable laws or regulations. Please note that if you communicate your withdrawal of your consent to our use, disclosure, storing or processing of your personal data for the purposes and in the manner as stated above or exercise your other rights as available under applicable local laws, we may not be in a position to continue to provide the Services to you or perform any contract we have with you, and we will not be liable in the event that we do not continue to provide the Services to, or perform our contract with you. Our legal rights and remedies are expressly reserved in such an event.</span></div></span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline;\"><div style=\"text-align: justify;\"><font face=\"Arial, sans-serif\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div></span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">Furthermore, you also have the right to ask us to delete your data. If you would like to have your data deleted, then email your request to support@mogholmart.com. Once your request is received, we follow an internal deletion process to make sure that your data is safely removed in the next fifteen (15) working days.</span></div></span></p><p dir=\"ltr\" style=\"text-align: justify; line-height: 1.38; margin-top: 0pt; margin-bottom: 8pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:8pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -13pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">20.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Minors:</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We do not sell products to minors, i.e. individuals below the age of 18, on the site and we do not knowingly collect any personal data relating to minors. You hereby confirm and warrant that you are above the age of 18 and are capable of understanding and accepting the terms of this Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.If you allow a minor to access the site and buy products from the site by using your account, you hereby consent to the processing of the minor’s personal data and accept and agree to be bound by this Privacy Policy and take responsibility for his or her actions.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will not be responsible for any unauthorized use of your account on the site by yourself, users who act on your behalf or any unauthorized users. It is your responsibility to make your own informed decisions about the use of the site and take necessary steps to prevent any misuse of the site.</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:7pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:8pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:8pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:8pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.38;text-indent: -9pt;text-align: justify;margin-top:0pt;margin-bottom:8pt;padding:0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"text-align: justify; line-height: 1.38; margin-top: 0pt; margin-bottom: 8pt;\"><span style=\"font-size:16pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Privacy and confidentiality</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 8pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"text-align: justify; line-height: 1.38; margin-top: 0pt; margin-bottom: 8pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Welcome to the </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">mogholmart.com </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">website (the \"site\") operated by </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Moghol Mart Bangladesh Limited. </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We respect your privacy and want to protect your personal information. To learn more, please read this Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">This Privacy Policy explains how we collect, use and (under certain conditions) disclose your personal information. This Privacy Policy also describes the steps we have taken to secure your personal information.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Finally, this Privacy Policy explains your options regarding the collection, use, and disclosure of your personal information. By visiting the site directly or through another site, you accept the practices described in this Policy.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Data protection is a matter of trust and your privacy is important to us. We shall therefore only use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">4.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will only keep your information for as long as we are either required to by law or as is relevant for the purposes for which it was collected.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">5.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will cease to retain your personal data or remove the means by which the data can be associated with you, as soon as it is reasonable to assume that such retention no longer serves the purposes for which the personal data was collected, and is no longer necessary for any legal or business purpose.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">6.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">You can visit the site and browse without having to provide personal details. During your visit to the site you remain anonymous and at no time can we identify you unless you have an account on the site and log on with your username and password.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Data that we collect:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 17px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.1.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may collect various pieces of information if you seek to place an order for a product with us on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 17px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.2.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We collect, store, and process your data for processing your purchase on the site and any possible later claims, and to provide you with our services.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 17px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.3.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may collect personal information including, but not limited to, your title, name, gender, date of birth, email address, postal address, delivery address (if different), telephone number, mobile number, fax number, payment details, payment card details or bank account details.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -4pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 4pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Moghol Mart shall collect the following information where you are a buyer:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.1</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Identity data, such as your name, gender, profile picture, and date of birth. Contact data, such as billing address, delivery address/location, email address, and phone numbers. Biometric data, such as voice files and face recognition when you use our voice search function, and your facial features when you use the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.2</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Billing account information: bank account details, credit card account, and payment information (such account data may also be collected directly by our affiliates and/or third-party payment service providers).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.3</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Transaction records/data, such as details about orders and payments, user clicks, and other pieces of products and services related to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.4</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Technical data, such as Internet protocol (IP) address, your login data, browser type and version, time zone setting, and location, device information, browser plug-in types and versions, operating system and platform, international mobile equipment identity, device identifier, IMEI, MAC address, cookies (where applicable) and other information and technology on the devices you use to access the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.5</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Profile data, such as your username and password, account settings, orders related to you, user research, your interests, preferences, and feedback and survey responses.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.6</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Usage data, such as information on how you use the site, products, and services or view any content on the site, including the time spent on the site, items and data searched for on the site, access times and dates, as well as websites you were visiting before you came to the site and other similar statistics.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.7</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Location data, such as when you capture and share your location with us in the form of photographs or videos and upload such content to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.8</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and communications data, such as your preferences in receiving marketing from us and our third parties, your communication preferences, and your chat, email or call history on the site or with third-party customer service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.4.9</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Additional information we may request you to submit for due diligence checks or required by relevant authorities as required for identity verification (such as copies of government-issued identification, e.g. passport, ID cards, etc.) or if we believe you are violating our Privacy Policy or our customer Terms and conditions.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Moghol Mart shall collect the following information where you are a seller:-</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -58pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 58pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.1.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Identity and contact data, such as your name, date of birth or incorporation, company name, address, email address, phone number, and other business-related information (e.g. company registration number, business license, tax information, shareholder and director information, etc.).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.2.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Account data, such as bank account details, bank statements, credit card details, and payment details (such account data may also be collected directly by our affiliates and/or third-party payment service providers).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.3.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Transaction data, such as details about orders and payments, and other elements of products and Services related to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.4.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Technical data, such as Internet protocol (IP) address, your login data, browser type and version, time zone setting, and location, browser plug-in types and versions, operating system and platform, international mobile equipment identity, device identifier, IMEI, MAC address, cookies (where applicable) and other information and technology on the devices you use to access the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.5.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Profile data, such as your username and password, orders related to you, your interests, preferences, and feedback and survey responses.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.6.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Usage data, such as information on how you use the site, products, and services or view any content on the site, including the time spent on the site, items and data searched for on the site, access times and dates, as well as websites you were visiting before you came to the site and other similar statistics.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.7.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Location data, such as when you capture and share your location with us in the form of photographs or videos and upload such content to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.8.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and communications data, such as your preferences in receiving marketing from us and our third parties and your communication preferences and your chat, email, or call history on the site or with our third-party seller service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -27pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 27pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.5.9.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Additional information we may request you to submit for authentication (such as copies of government-issued identification, e.g. passport, ID cards, etc.) or if we believe you are violating our Privacy Policy or our Terms of Use.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">8.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will use the information you provide to enable us to process your orders and to provide you with the services and information offered through our website and which you request in the following ways:</span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If you are a buyer:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Processing your orders for products.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Process orders you submit through the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Deliver the products you have purchased through the site for which we may pass your personal information on to a third party (e.g. our logistics partner) in order to make delivery of the product to you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Update you on the delivery of the products.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Provide customer support for your orders.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Verify and carry out payment transactions (including any credit card payments, bank transfers, offline payments, remittances, or e-wallet transactions) in relation to payments related to you and/or services used by you. In order to verify and carry out such payment transactions, payment information, which may include personal data, will be transferred to third parties such as our payment service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Providing services</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Facilitate your use of the services or access to the site</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Administer your account with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Display your name, username, or profile on the site (including on any reviews you may post).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Respond to your queries, feedback, claims, or disputes, whether directly or through our third-party service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Display on scoreboards on the site in relation to campaigns, mobile games, or any other activity.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;&nbsp;Provide you with information we think you may find useful or which you have requested from us (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Send you marketing or promotional information about \\ products and services on the site from time to time (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Help us conduct marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">d.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Legal and operational purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ascertain your identity in connection with fraud detection purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Compare information, and verify with third parties in order to ensure that the information is accurate.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Process any complaints, feedback, or enforcement action you may have lodged with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Produce statistics and research for internal and statutory reporting and/or record-keeping requirements.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Store, host, and back up your personal data.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Investigate any actual or suspected violations of our Terms of Use, Privacy Policy, fraud, unlawful activity, omission, or misconduct, whether relating to your use of the site or any other matter arising from your relationship with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Perform due diligence checks.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Comply with legal and regulatory requirements (including, where applicable, the display of your name, contact details, and company details), including any law enforcement requests, in connection with any legal proceedings, or otherwise deemed necessary by us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Where necessary to prevent a threat to life, health, or safety.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">e.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Analytics, research, business and development.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Understand your user experience on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Improve the layout or content of the pages of the site and customize them for users</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Identify visitors on the site. Conduct surveys, including carrying out research on our users’ demographics and behavior.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Derive further attributes relating to you based on personal data provided by you (whether to us or third parties), in order to provide you with more targeted and/or relevant information.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conduct data analysis, testing, and research, monitoring and analyzing usage and activity trends.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">f.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Others:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;Any other purpose for which your consent has been obtained.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">j.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conduct automated decision-making processes in accordance with any of the above purposes.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">g.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If you are a seller:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 47px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Providing Services</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 47px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate your use of the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To ship or deliver the products you have listed or sold through the site. We may pass your personal information on to a third party (e.g. our logistics partners) or relevant regulatory authority (e.g. customs) in order to carry out shipping or delivery of the products listed or sold by you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To respond to your queries, feedback, claims, or disputes, whether directly or through our third-party service agents.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To verify your documentation submitted to us facilitate your onboarding with us as a seller on the site, including the testing of technologies to enable faster and more efficient onboarding.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To administer your account (if any) with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To display your name, username, or profile on the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To verify and carry out financial transactions (including any credit card payments, bank transfers, offline payments, remittances, or e-wallet transactions) in relation to payments related to you and/or Services used by you. In order to verify and carry out such payment transactions, payment information, which may include personal data, will be transferred to third parties such as our payment service providers.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To assess your application for loan facilities and/or to perform credit risk assessments in relation to your application for seller financing (where applicable).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">x.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To provide you with ancillary logistics services to protect against risks of failed deliveries or customer returns.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 77px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">xi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate the return of products to you (which may be through our logistics partner).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">h.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Marketing and advertising:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 71px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To send you marketing or promotional materials about our or third-party sellers’ products and services on our site from time to time (provided you have opted to receive such information).</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 71px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii. To help us conduct marketing and advertising.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Legal and operational purposes</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 59px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i..To produce statistics and research for internal and statutory reporting and/or record-keeping requirements.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 95px; text-indent: -40pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 40pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To store, host, and back up your personal data.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To prevent or investigate any actual or suspected violations of our Terms of Use, Privacy Policy, fraud, unlawful activity, omission, or misconduct, whether relating to your use of our Services or any other matter arising from your relationship with us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To comply with legal and regulatory requirements (including, where applicable, the display of your name, contact details, and company details), including any law enforcement requests, in connection with any legal proceedings or otherwise deemed necessary by us.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Where necessary to prevent a threat to life, health, or safety.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To process any complaints, feedback, enforcement action, and take-down requests in relation to any content you have uploaded to the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To compare information, and verify with third parties in order to ensure that the information is accurate.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To ascertain your identity in connection with fraud detection purposes.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ix.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To facilitate the takedown of prohibited and controlled items from our site.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 17px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 0pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">j.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Analytics, research, business and development</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">i.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To audit the downloading of data from the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">ii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To understand the user experience with the services and the site.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To improve the layout or content of the pages of the site and customize them for users.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">iv.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To conduct surveys, including carrying out research on our users’ demographics and behavior to improve our current technology (e.g. voice recognition tech, etc.) via machine learning or other means.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">v.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To derive further attributes relating to you based on personal data provided by you (whether to us or third parties), in order to provide you with more targeted and/or relevant information.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vi.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To conduct data analysis, testing and research, monitoring and analyzing usage and activity trends.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To further develop our products and services.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 65px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">viii.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">To know our sellers better.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">k.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Others:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;&nbsp;&nbsp;a. You can choose to opt out of this at any time. Any answers to surveys or opinion polls we may ask you to complete will not be forwarded on to third parties. Disclosing your email address is only necessary if you would like to take part in competitions. We save the answers to our surveys separately from your email address.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.We may also send you other information about us, the site, our other websites, our products, sales promotions, our newsletters, and anything relating to other companies in our group or our business partners. If you would prefer not to receive any of this additional information as detailed in this paragraph (or any part of it) please click the \'unsubscribe\' link in any email that we send to you. Within 7 working days (days which are neither (i) a Sunday, nor (ii) a public holiday anywhere in Bangladesh) of receipt of your instruction we will cease to send you information as requested. If your instruction is unclear we will contact you for clarification.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may further anonymize data about users of the site generally and use it for various purposes, including ascertaining the general location of the users and usage of certain aspects of the site or a link contained in an email to those registered to receive them and supplying that anonymized data to third parties such as publishers. However, that anonymized data will not be capable of identifying you personally.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-indent: -22pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 22pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">14.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Competitions:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 41px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.For any competition we use the data to notify winners and advertise our offers. You can find more details where applicable in our participation terms for the respective competition.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 35px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">15.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Third Parties and Links:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We may pass your details to other companies in our group. We may also pass your details to our agents and subcontractors to help us with any of our uses of your data set out in our Privacy Policy. For example, we may use third parties to assist us with delivering products to you, to help us collect payments from you, to analyze data, and to provide us with marketing or customer service assistance. We may also exchange information with third parties for the purposes of fraud protection and credit risk reduction.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.We may share (or permit the sharing of) your personal data with and/or transfer your personal data to third parties and/or our affiliates for the above-mentioned purposes. These third parties and affiliates, which may be located inside or outside your jurisdiction, include but are not limited to.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Service providers (such as agents, vendors, contractors, and partners) in areas such as payment services, logistics and shipping, marketing, data analytics, market or consumer research, survey, social media, customer service, installation services, information technology, and website hosting.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">d.Their service providers and related companies.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">16.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Other users of the site:&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We may transfer our databases containing your personal information if we sell our business or part of it, provided that we satisfy the requirements of applicable data protection law when disclosing your personal data. Other than as set out in this Privacy Policy, we shall NOT sell or disclose your personal data to third parties without obtaining your prior consent unless this is necessary for the purposes set out in this Privacy Policy or unless we are required to do so by law. The site may contain advertising of third parties and links to other sites or frames of other sites. Please be aware that we are not responsible for the privacy practices or content of those third parties or other sites, nor for any third party to whom we transfer your data in accordance with our Privacy Policy. You are advised to check on the applicable privacy policies of those websites to determine how they will handle any information they collect from you.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 29px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.In disclosing your personal data to third parties, we endeavor to ensure that the third parties and our affiliates keep your personal data secure from unauthorized access, collection, use, disclosure, processing, or similar risks and retain your personal data only for as long as your personal data helps with any of the uses of your data as set out in our Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We may transfer or permit the transfer of your personal data outside of Bangladesh for any of the purposes set out in this Privacy Policy. However, we will not transfer or permit any of your personal data to be transferred outside of Bangladesh unless the transfer is in compliance with applicable laws and this Privacy Policy.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We have in place appropriate technical and security measures to prevent unauthorized or unlawful access to or accidental loss of or destruction or damage to your information. When we collect data through the site, we collect your personal details on a secure server. We use firewalls on our servers. Our security procedures mean that we may occasionally request proof of identity before we disclose personal information to you. You are responsible for protecting against unauthorized access to your password and to your computer.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.You should be aware, however, that no method of transmission over the Internet or method of electronic storage is completely secure. While security cannot be guaranteed, we strive to protect the security of your information and are constantly reviewing and enhancing our information security measures.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-align: justify; margin-top: 0pt; margin-bottom: 7pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">19.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> &nbsp; </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Your rights:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; margin-top: 0pt; margin-bottom: 8pt;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-family: Arial, sans-serif; font-size: 10.5pt; white-space-collapse: preserve;\">If you are concerned about your data, you have the right to request access to the personal data that we may hold or process about you. You have the right to require us to correct any inaccuracies in your data free of charge. At any stage, you also have the right to ask us to stop using your personal data for direct marketing purposes.</span></div><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">Where permitted by applicable data protection laws, we reserve the right to charge a reasonable administrative fee for retrieving your personal data records. If so, we will inform you of the cost before processing your request.</span></div></span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">You may communicate the withdrawal of your consent to the continued use, disclosure, storage, and/or processing of your personal data by contacting our customer services, subject to the conditions and/or limitations imposed by applicable laws or regulations. Please note that if you communicate the withdrawal of your consent to our use, disclosure, storing, or processing of your personal data for the purposes and in the manner as stated above or exercise your other rights as available under applicable local laws, we may not be in a position to continue to provide the Services to you or perform any contract we have with you, and we will not be liable in the event that we do not continue to provide the Services to, or perform our contract with you. Our legal rights and remedies are expressly reserved in such an event.</span></div></span><span style=\"background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline;\"><div style=\"text-align: justify;\"><font face=\"Arial, sans-serif\"><span style=\"white-space-collapse: preserve;\"><br></span></font></div></span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><div style=\"text-align: justify;\"><span style=\"background-color: transparent; font-size: 10.5pt;\">Furthermore, you also have the right to ask us to delete your data. If you would like to have your data deleted, then email your request to support@mogholmart.com. Once your request is received, we follow an internal deletion process to make sure that your data is safely removed in the next fifteen (15) working days.&nbsp;</span></div></span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -13pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 13pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">20. Minors:</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">a.We do not sell products to minors, i.e. individuals below the age of 18, on the site and we do not knowingly collect any personal data relating to minors. You hereby confirm and warrant that you are above the age of 18 and are capable of understanding and accepting the terms of this Privacy Policy.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">b.If you allow a minor to access the site and buy products from the site by using your account, you hereby consent to the processing of the minor’s personal data and accept and agree to be bound by this Privacy Policy and take responsibility for his or her actions.</span></p><p dir=\"ltr\" style=\"line-height: 1.38; margin-left: 23px; text-indent: -9pt; text-align: justify; margin-top: 0pt; margin-bottom: 7pt; padding: 0pt 0pt 0pt 9pt;\"><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">c.</span><span style=\"font-size:6.999999999999999pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> </span><span style=\"font-size:10.5pt;font-family:Arial,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">We will not be responsible for any unauthorized use of your account on the site by yourself, users who act on your behalf, or any unauthorized users. It is your responsibility to make your own informed decisions about the use of the site and take necessary steps to prevent any misuse of the site.</span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin: 0in 0in 0.1in 65px; text-align: justify; text-indent: -13.5pt; line-height: normal;\"><span id=\"docs-internal-guid-2b7f92d0-7fff-e56e-ac54-38fee9230d31\"><br><br></span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.1in; text-align: justify; text-indent: -22.5pt; line-height: normal;\"></p>', '', 'Moghol Mart', 'Moghol Mart, Online Shopping,', NULL, 'active', '1', '1', '2023-08-25 10:49:07', '2023-09-05 04:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `title`, `slug`, `description`, `image_link`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Electra International', 'electra-international', NULL, '', 'active', '1', NULL, '2023-08-25 10:07:19', '2023-08-25 10:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `slug` varchar(64) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `position` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_profiles`
--

CREATE TABLE `merchant_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `shop_name` varchar(128) DEFAULT NULL,
  `fathers_name` varchar(128) DEFAULT NULL,
  `age` varchar(32) DEFAULT NULL,
  `nid` varchar(32) DEFAULT NULL,
  `tin_no` varchar(64) DEFAULT NULL,
  `shop_address` text DEFAULT NULL,
  `shop_description` text DEFAULT NULL,
  `shop_agreement` text DEFAULT NULL,
  `agreement_date` date DEFAULT NULL,
  `agreement_details` text DEFAULT NULL,
  `first_contact_person_details` text DEFAULT NULL,
  `second_contact_person_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_profiles`
--

INSERT INTO `merchant_profiles` (`id`, `users_id`, `shop_name`, `fathers_name`, `age`, `nid`, `tin_no`, `shop_address`, `shop_description`, `shop_agreement`, `agreement_date`, `agreement_details`, `first_contact_person_details`, `second_contact_person_details`, `created_at`, `updated_at`) VALUES
(3, 0, 'Moghol Mart', 'sdcdsc', '50', '6546465', '646464', 'vdsv', 'svdv', '<p>vsdv</p>', '2023-06-17', '<p>sdvsd</p>', '65431', '461', '2023-06-17 03:22:12', '2023-06-17 03:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_head_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_merchant_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,4) DEFAULT NULL,
  `size` text DEFAULT NULL,
  `total_price` decimal(10,4) DEFAULT NULL,
  `comission_price` decimal(10,4) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `cash_back` decimal(10,4) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_head_id`, `product_id`, `product_merchant_id`, `quantity`, `price`, `size`, `total_price`, `comission_price`, `color`, `cash_back`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 6, 64, 0, 1, 1600.0000, '', 1600.0000, NULL, '', 0.0000, 'active', NULL, NULL, '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(7, 7, 65, 0, 1, 350.0000, '', 350.0000, NULL, '', 0.0000, 'active', '1', NULL, '2023-08-25 10:40:09', '2023-08-25 10:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `order_number` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vat_rate` int(11) DEFAULT NULL,
  `vat_amount` decimal(10,4) DEFAULT NULL,
  `coupon_code` varchar(32) DEFAULT NULL,
  `coupon_code_rate` int(11) DEFAULT NULL,
  `coupon_code_value` decimal(10,4) DEFAULT NULL,
  `shipping_value` decimal(10,4) DEFAULT NULL,
  `shipping_method` varchar(191) DEFAULT NULL,
  `sub_total_price` decimal(10,4) DEFAULT NULL,
  `total_price` decimal(10,4) DEFAULT NULL,
  `payment_type` varchar(16) DEFAULT NULL,
  `courier_name` varchar(64) DEFAULT NULL,
  `courier_package` varchar(64) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('pending','confirmed','processing','on_transit','delivered','delivery_failed','returned','failed','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`id`, `users_id`, `order_number`, `date`, `vat_rate`, `vat_amount`, `coupon_code`, `coupon_code_rate`, `coupon_code_value`, `shipping_value`, `shipping_method`, `sub_total_price`, `total_price`, `payment_type`, `courier_name`, `courier_package`, `note`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, 9, 'mogholmart-20230820-000006', '2023-08-20', NULL, NULL, '', NULL, 0.0000, 60.0000, 'Self', 1600.0000, 1600.0000, 'cod', NULL, '', NULL, 'pending', NULL, NULL, '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(7, NULL, 'mogholmart-20230825-000007', '2023-08-25', NULL, NULL, '', NULL, 0.0000, 60.0000, 'Self', 350.0000, 350.0000, 'cod', NULL, '', NULL, 'processing', '1', '1', '2023-08-25 10:40:09', '2023-08-25 10:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping`
--

CREATE TABLE `order_shipping` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_head_id` int(10) UNSIGNED NOT NULL,
  `special_instruction` text DEFAULT NULL,
  `type` enum('billing','shipping') DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `compnay_name` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contry` int(11) DEFAULT NULL,
  `city` varchar(16) DEFAULT NULL,
  `area` varchar(64) DEFAULT NULL,
  `post_code` text NOT NULL,
  `zip` varchar(16) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_shipping`
--

INSERT INTO `order_shipping` (`id`, `order_head_id`, `special_instruction`, `type`, `first_name`, `last_name`, `compnay_name`, `email`, `address`, `contry`, `city`, `area`, `post_code`, `zip`, `phone`, `fax`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'billing', 'Kawser', 'Ahamed', NULL, 'shop@afseen.com', '31 House,1 number Len ,Purbachol road ,North Badda', NULL, 'Dhaka', NULL, '1212', NULL, '01971122012', NULL, 'active', '1', NULL, '2023-02-24 09:53:57', '2023-02-24 09:53:57'),
(2, 1, NULL, 'shipping', 'Kawser', 'Ahamed', NULL, 'shop@afseen.com', '31 House,1 number Len ,Purbachol road ,North Badda', NULL, 'Dhaka', NULL, '1212', NULL, '01971122012', NULL, 'active', '1', NULL, '2023-02-24 09:53:57', '2023-02-24 09:53:57'),
(3, 2, NULL, 'billing', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', NULL, NULL, '2023-05-03 03:34:48', '2023-05-03 03:34:48'),
(4, 2, NULL, 'shipping', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', NULL, NULL, '2023-05-03 03:34:48', '2023-05-03 03:34:48'),
(5, 3, NULL, 'billing', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 12:30:14', '2023-08-19 12:30:14'),
(6, 3, NULL, 'shipping', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 12:30:14', '2023-08-19 12:30:14'),
(7, 4, NULL, 'billing', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 21:28:50', '2023-08-19 21:28:50'),
(8, 4, NULL, 'shipping', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 21:28:50', '2023-08-19 21:28:50'),
(9, 5, NULL, 'billing', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 21:39:33', '2023-08-19 21:39:33'),
(10, 5, NULL, 'shipping', 'Md', 'Hadiuzzaman', NULL, 'palak.mining@yahoo.com', '7D, Confidence Tower\r\nShahjadpur', NULL, 'Dhaka', NULL, '1212', NULL, '01717134606', NULL, 'active', '9', NULL, '2023-08-19 21:39:33', '2023-08-19 21:39:33'),
(11, 6, NULL, 'billing', 'anik', 'rifat', NULL, 'reafatul@gmail.com', 'ewewewewetw', NULL, 'chittagong', 'bayezid', '4220', NULL, '01643675060', NULL, 'active', NULL, NULL, '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(12, 6, NULL, 'shipping', 'anik', 'rifat', NULL, 'reafatul@gmail.com', 'ewewewewetw', NULL, 'chittagong', 'bayezid', '4220', NULL, '01643675060', NULL, 'active', NULL, NULL, '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(13, 7, NULL, 'billing', 'Md. Aminul Hasan', 'Sagar', NULL, 'aminul.office21@gmail.com', 'Savar,', NULL, 'Dhaka', 'Savar', '1340', NULL, '01732941403', NULL, 'active', '1', NULL, '2023-08-25 10:40:09', '2023-08-25 10:40:09'),
(14, 7, NULL, 'shipping', 'Md. Aminul Hasan', 'Sagar', NULL, 'aminul.office21@gmail.com', 'Savar,', NULL, 'Dhaka', 'Savar', '1340', NULL, '01732941403', NULL, 'active', '1', NULL, '2023-08-25 10:40:09', '2023-08-25 10:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_transaction`
--

CREATE TABLE `order_transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_head_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_number` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,4) DEFAULT NULL,
  `ssl_id` varchar(32) DEFAULT NULL,
  `hash_key` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(32) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `route` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_update`
--

CREATE TABLE `price_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `actual_price` decimal(10,4) DEFAULT NULL,
  `update_price` decimal(10,4) DEFAULT NULL,
  `actual_list_price` decimal(10,4) DEFAULT NULL,
  `list_update_price` decimal(10,4) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('simple-product','configurable-product','group-product') DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `item_no` varchar(64) DEFAULT NULL,
  `sell_price` decimal(10,4) DEFAULT NULL,
  `list_price` decimal(10,4) DEFAULT NULL,
  `offer_price` decimal(10,4) DEFAULT NULL,
  `weight` decimal(10,4) DEFAULT NULL,
  `attribute_set_id` int(10) UNSIGNED DEFAULT NULL,
  `manufacturer_id` int(10) UNSIGNED DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `is_emi` enum('yes','no') DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `merchant_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `type`, `unit`, `title`, `slug`, `item_no`, `sell_price`, `list_price`, `offer_price`, `weight`, `attribute_set_id`, `manufacturer_id`, `short_description`, `description`, `specification`, `is_emi`, `status`, `merchant_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(65, 'simple-product', 'gram', 'Screw Driver Set-901', 'screw-driver-set01', 'MM-901-00065', 350.0000, 315.0000, 400.0000, 300.0000, 1, NULL, 'Product Name: Screw Driver Set-901. <br> \nProduct Weight: 300&nbsp;g', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2a0e.pdp.0.i1.1d825d99tuBbln\" style=\"margin: 0px; padding: 0px 24px; font-weight: 500; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of 55PCS SCREWDRIVER BITS SET - INGCO HKSDB0558</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.1d825d99tuBbln\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; margin-block-start: 1em; font-size: 14px; overflow: hidden; columns: 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Include： 21Pcs Screwdriver Bits</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">20Pcs Precision</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Screwdriver Bits 1Pcs</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Bits Adaptor 9Pcs</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1/4\" Sockets 1Pcs</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">4X60mm Bits</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Holder 1Pcs</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">6.35X50mm Bits Holder 1Pcs</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Ratchet Handle 1Pcs Unique handle</li></ul></div></div></div>', NULL, NULL, 'inactive', 0, NULL, '1', NULL, '2023-08-26 08:25:50'),
(66, 'simple-product', 'gram', 'Samsung', 'samsung', 'MM-101-00066', 25000.0000, 22500.0000, NULL, NULL, 1, 1, 'Product Name: Samsung. <br> \nProduct Weight: 0&nbsp;g', '<p><span style=\"color: rgb(255, 255, 255); font-family: SamsungOne, arial, sans-serif; font-size: 16px; text-align: center; background-color: rgb(0, 0, 0);\">A different level of UHD with advanced phosphor technology. Immerse yourself in the picture with one billion shades of color. Dynamic Crystal Color delivers lifelike variations so you can see every subtlety.</span></p>', NULL, NULL, 'inactive', 0, NULL, '1', NULL, '2023-08-26 08:24:26'),
(67, 'simple-product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 'active', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `attribute_code` varchar(20) DEFAULT NULL,
  `attribute_data` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `product_id`, `brand_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 66, 1, NULL, '1', NULL, '2023-08-25 10:10:18', '2023-08-25 10:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, '1', NULL, '2023-02-23 07:06:35', '2023-02-23 07:06:35'),
(2, 9, 1, NULL, '1', NULL, '2023-02-23 07:07:07', '2023-02-23 07:07:07'),
(3, 10, 1, NULL, '1', NULL, '2023-02-23 07:07:31', '2023-02-23 07:07:31'),
(0, 65, 41, NULL, '1', NULL, '2023-08-25 10:04:01', '2023-08-25 10:04:01'),
(0, 66, 33, NULL, '1', NULL, '2023-08-25 10:12:52', '2023-08-25 10:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_category_discount`
--

CREATE TABLE `product_category_discount` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` varchar(256) DEFAULT NULL,
  `sub_category_list` varchar(256) DEFAULT NULL,
  `disc_percentage` decimal(10,4) DEFAULT NULL,
  `start_date` varchar(32) DEFAULT NULL,
  `end_date` varchar(32) DEFAULT NULL,
  `type` enum('include','exclude','exclude-cashback') DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_link`, `image`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(22, 65, '/uploads/product/65', 'screw-driver-set01-1692979297-1.jpeg', '1', NULL, '2023-08-24 22:01:37', NULL),
(23, 66, '/uploads/product/66', 'samsung-1692979932-1.webp', '1', NULL, '2023-08-24 22:12:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `warehouse` varchar(32) DEFAULT NULL,
  `item_number` varchar(32) DEFAULT NULL,
  `quantity` varchar(8) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_related_item`
--

CREATE TABLE `product_related_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_product_id` int(10) UNSIGNED DEFAULT NULL,
  `child_product_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `rating_value_score` double(10,4) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_seo`
--

CREATE TABLE `product_seo` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(32) DEFAULT NULL,
  `meta_keywords` varchar(128) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image_link` varchar(128) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_shipping`
--

CREATE TABLE `product_shipping` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `division_id` int(10) UNSIGNED DEFAULT NULL,
  `district_id` int(10) UNSIGNED DEFAULT NULL,
  `thana_id` int(10) UNSIGNED DEFAULT NULL,
  `deliver_day` varchar(32) DEFAULT NULL,
  `deliver_cost` decimal(10,4) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `titleslug` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `session_id` varchar(191) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip` varchar(191) NOT NULL,
  `agent` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `product_id`, `titleslug`, `url`, `session_id`, `user_id`, `ip`, `agent`, `created_at`, `updated_at`) VALUES
(122, 65, 'screw-driver-set01', 'https://mogholmart.com/product/screw-driver-set01', '9s5u8yzd6mb2sSXC960KqASOSpeKarg1F7T0sPlc', 1, '103.161.71.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '2023-08-25 10:04:27', '2023-08-25 10:04:27'),
(123, 66, 'samsung', 'https://mogholmart.com/product/samsung', '9s5u8yzd6mb2sSXC960KqASOSpeKarg1F7T0sPlc', 1, '103.161.71.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '2023-08-25 10:13:03', '2023-08-25 10:13:03'),
(124, 65, 'screw-driver-set01', 'https://mogholmart.com/product/screw-driver-set01', '9s5u8yzd6mb2sSXC960KqASOSpeKarg1F7T0sPlc', 1, '103.161.71.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '2023-08-25 10:36:16', '2023-08-25 10:36:16'),
(125, 66, 'samsung', 'https://mogholmart.com/product/samsung', 'lc80O4cBSbfIGnHnCeciJ2MPVVwbKuEfGpqyTX8c', NULL, '103.127.46.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '2023-08-26 03:37:24', '2023-08-26 03:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sent_status` varchar(16) DEFAULT NULL,
  `total_customer` varchar(16) DEFAULT NULL,
  `total_sent` varchar(16) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'active', '1', '1', '2023-02-18 08:38:24', '2023-02-18 08:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permission`
--

CREATE TABLE `roles_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `roles_id` int(10) UNSIGNED DEFAULT NULL,
  `permission_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permission`
--

INSERT INTO `roles_permission` (`id`, `roles_id`, `permission_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(2, 1, 2, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(3, 1, 3, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(4, 1, 4, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(5, 1, 5, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(6, 1, 6, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(7, 1, 7, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(8, 1, 8, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(9, 1, 9, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(10, 1, 10, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(11, 1, 11, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(12, 1, 12, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(13, 1, 13, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(14, 1, 14, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(15, 1, 15, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(16, 1, 16, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(17, 1, 17, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(18, 1, 18, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(19, 1, 19, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(20, 1, 20, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(21, 1, 21, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(22, 1, 22, 'active', NULL, NULL, '2023-02-18 08:38:38', '2023-02-18 08:38:38'),
(23, 1, 23, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(24, 1, 24, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(25, 1, 25, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(26, 1, 26, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(27, 1, 27, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(28, 1, 28, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(29, 1, 29, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(30, 1, 30, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(31, 1, 31, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(32, 1, 32, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(33, 1, 33, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(34, 1, 34, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(35, 1, 35, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(36, 1, 36, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(37, 1, 37, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(38, 1, 38, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(39, 1, 39, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(40, 1, 40, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(41, 1, 41, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(42, 1, 42, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(43, 1, 43, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(44, 1, 44, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(45, 1, 45, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(46, 1, 46, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(47, 1, 47, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(48, 1, 48, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(49, 1, 49, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(50, 1, 50, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(51, 1, 51, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(52, 1, 52, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(53, 1, 53, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(54, 1, 54, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(55, 1, 55, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(56, 1, 56, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(57, 1, 57, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(58, 1, 58, 'active', NULL, NULL, '2023-02-18 08:38:39', '2023-02-18 08:38:39'),
(59, 1, 59, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(60, 1, 60, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(61, 1, 61, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(62, 1, 62, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(63, 1, 63, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(64, 1, 64, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(65, 1, 65, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(66, 1, 66, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(67, 1, 67, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(68, 1, 68, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(69, 1, 69, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(70, 1, 70, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(71, 1, 71, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(72, 1, 72, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(73, 1, 73, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(74, 1, 74, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(75, 1, 75, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(76, 1, 76, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(77, 1, 77, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(78, 1, 78, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(79, 1, 79, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(80, 1, 80, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(81, 1, 81, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(82, 1, 82, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(83, 1, 83, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(84, 1, 84, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(85, 1, 85, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(86, 1, 86, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(87, 1, 87, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(88, 1, 88, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(89, 1, 89, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(90, 1, 90, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(91, 1, 91, 'active', NULL, NULL, '2023-02-18 08:38:40', '2023-02-18 08:38:40'),
(92, 1, 92, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(93, 1, 93, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(94, 1, 94, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(95, 1, 95, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(96, 1, 96, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(97, 1, 97, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(98, 1, 98, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(99, 1, 99, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(100, 1, 100, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(101, 1, 101, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(102, 1, 102, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(103, 1, 103, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(104, 1, 104, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(105, 1, 105, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(106, 1, 106, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(107, 1, 107, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(108, 1, 108, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(109, 1, 109, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(110, 1, 110, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(111, 1, 111, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(112, 1, 112, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(113, 1, 113, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(114, 1, 114, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(115, 1, 115, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(116, 1, 116, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(117, 1, 117, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(118, 1, 118, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(119, 1, 119, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(120, 1, 120, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(121, 1, 121, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(122, 1, 122, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(123, 1, 123, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(124, 1, 124, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(125, 1, 125, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(126, 1, 126, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(127, 1, 127, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(128, 1, 128, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(129, 1, 129, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(130, 1, 130, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(131, 1, 131, 'active', NULL, NULL, '2023-02-18 08:38:41', '2023-02-18 08:38:41'),
(132, 1, 132, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(133, 1, 133, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(134, 1, 134, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(135, 1, 135, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(136, 1, 136, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(137, 1, 137, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(138, 1, 138, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(139, 1, 139, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(140, 1, 140, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(141, 1, 141, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(142, 1, 142, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(143, 1, 143, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(144, 1, 144, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(145, 1, 145, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(146, 1, 146, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(147, 1, 147, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(148, 1, 148, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(149, 1, 149, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(150, 1, 150, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(151, 1, 151, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(152, 1, 152, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(153, 1, 153, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(154, 1, 154, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(155, 1, 155, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(156, 1, 156, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(157, 1, 157, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(158, 1, 158, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(159, 1, 159, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(160, 1, 160, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(161, 1, 161, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(162, 1, 162, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(163, 1, 163, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(164, 1, 164, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(165, 1, 165, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(166, 1, 166, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(167, 1, 167, 'active', NULL, NULL, '2023-02-18 08:38:42', '2023-02-18 08:38:42'),
(168, 1, 168, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(169, 1, 169, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(170, 1, 170, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(171, 1, 171, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(172, 1, 172, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(173, 1, 173, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(174, 1, 174, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(175, 1, 175, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(176, 1, 176, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(177, 1, 177, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(178, 1, 178, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(179, 1, 179, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(180, 1, 180, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(181, 1, 181, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(182, 1, 182, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(183, 1, 183, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(184, 1, 184, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(185, 1, 185, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(186, 1, 186, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(187, 1, 187, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(188, 1, 188, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(189, 1, 189, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(190, 1, 190, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(191, 1, 191, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(192, 1, 192, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(193, 1, 193, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(194, 1, 194, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(195, 1, 195, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(196, 1, 196, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(197, 1, 197, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(198, 1, 198, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(199, 1, 199, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(200, 1, 200, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(201, 1, 201, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(202, 1, 202, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(203, 1, 203, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(204, 1, 204, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(205, 1, 205, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(206, 1, 206, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(207, 1, 207, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(208, 1, 208, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(209, 1, 209, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(210, 1, 210, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(211, 1, 211, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(212, 1, 212, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(213, 1, 213, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(214, 1, 214, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(215, 1, 215, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(216, 1, 216, 'active', NULL, NULL, '2023-02-18 08:38:43', '2023-02-18 08:38:43'),
(217, 1, 217, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(218, 1, 218, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(219, 1, 219, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(220, 1, 220, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(221, 1, 221, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(222, 1, 222, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(223, 1, 223, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(224, 1, 224, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(225, 1, 225, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(226, 1, 226, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(227, 1, 227, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(228, 1, 228, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(229, 1, 229, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(230, 1, 230, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(231, 1, 231, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(232, 1, 232, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(233, 1, 233, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(234, 1, 234, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(235, 1, 235, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(236, 1, 236, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(237, 1, 237, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(238, 1, 238, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(239, 1, 239, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(240, 1, 240, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(241, 1, 241, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(242, 1, 242, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(243, 1, 243, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(244, 1, 244, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(245, 1, 245, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(246, 1, 246, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(247, 1, 247, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(248, 1, 248, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(249, 1, 249, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(250, 1, 250, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(251, 1, 251, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(252, 1, 252, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(253, 1, 253, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(254, 1, 254, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(255, 1, 255, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(256, 1, 256, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(257, 1, 257, 'active', NULL, NULL, '2023-02-18 08:38:44', '2023-02-18 08:38:44'),
(258, 1, 258, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(259, 1, 259, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(260, 1, 260, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(261, 1, 261, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(262, 1, 262, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(263, 1, 263, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(264, 1, 264, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(265, 1, 265, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(266, 1, 266, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(267, 1, 267, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(268, 1, 268, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(269, 1, 269, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(270, 1, 270, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(271, 1, 271, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(272, 1, 272, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(273, 1, 273, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(274, 1, 274, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(275, 1, 275, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(276, 1, 276, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(277, 1, 277, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(278, 1, 278, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(279, 1, 279, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(280, 1, 280, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(281, 1, 281, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(282, 1, 282, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(283, 1, 283, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(284, 1, 284, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(285, 1, 285, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(286, 1, 286, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(287, 1, 287, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(288, 1, 288, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(289, 1, 289, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(290, 1, 290, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(291, 1, 291, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(292, 1, 292, 'active', NULL, NULL, '2023-02-18 08:38:45', '2023-02-18 08:38:45'),
(293, 1, 293, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(294, 1, 294, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(295, 1, 295, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(296, 1, 296, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(297, 1, 297, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(298, 1, 298, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(299, 1, 299, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(300, 1, 300, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(301, 1, 301, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(302, 1, 302, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(303, 1, 303, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(304, 1, 304, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(305, 1, 305, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(306, 1, 306, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(307, 1, 307, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(308, 1, 308, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(309, 1, 309, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(310, 1, 310, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(311, 1, 311, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(312, 1, 312, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(313, 1, 313, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(314, 1, 314, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(315, 1, 315, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(316, 1, 316, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(317, 1, 317, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(318, 1, 318, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(319, 1, 319, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(320, 1, 320, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(321, 1, 321, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(322, 1, 322, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(323, 1, 323, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(324, 1, 324, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(325, 1, 325, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(326, 1, 326, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(327, 1, 327, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(328, 1, 328, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(329, 1, 329, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(330, 1, 330, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(331, 1, 331, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(332, 1, 332, 'active', NULL, NULL, '2023-02-18 08:38:46', '2023-02-18 08:38:46'),
(333, 1, 333, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(334, 1, 334, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(335, 1, 335, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(336, 1, 336, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(337, 1, 337, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(338, 1, 338, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(339, 1, 339, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(340, 1, 340, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(341, 1, 341, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(342, 1, 342, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(343, 1, 343, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(344, 1, 344, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(345, 1, 345, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(346, 1, 346, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(347, 1, 347, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(348, 1, 348, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(349, 1, 349, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(350, 1, 350, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(351, 1, 351, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(352, 1, 352, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(353, 1, 353, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(354, 1, 354, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(355, 1, 355, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(356, 1, 356, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(357, 1, 357, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(358, 1, 358, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(359, 1, 359, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(360, 1, 360, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(361, 1, 361, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(362, 1, 362, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(363, 1, 363, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(364, 1, 364, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(365, 1, 365, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(366, 1, 366, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(367, 1, 367, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(368, 1, 368, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(369, 1, 369, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(370, 1, 370, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(371, 1, 371, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(372, 1, 372, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(373, 1, 373, 'active', NULL, NULL, '2023-02-18 08:38:47', '2023-02-18 08:38:47'),
(374, 1, 374, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(375, 1, 375, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(376, 1, 376, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(377, 1, 377, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(378, 1, 378, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(379, 1, 379, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(380, 1, 380, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(381, 1, 381, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(382, 1, 382, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(383, 1, 383, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(384, 1, 384, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(385, 1, 385, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(386, 1, 386, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(387, 1, 387, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(388, 1, 388, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(389, 1, 389, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(390, 1, 390, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(391, 1, 391, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(392, 1, 392, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(393, 1, 393, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(394, 1, 394, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(395, 1, 395, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(396, 1, 396, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(397, 1, 397, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(398, 1, 398, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(399, 1, 399, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(400, 1, 400, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(401, 1, 401, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(402, 1, 402, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(403, 1, 403, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(404, 1, 404, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(405, 1, 405, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(406, 1, 406, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(407, 1, 407, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(408, 1, 408, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(409, 1, 409, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(410, 1, 410, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(411, 1, 411, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(412, 1, 412, 'active', NULL, NULL, '2023-02-18 08:38:48', '2023-02-18 08:38:48'),
(413, 1, 413, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(414, 1, 414, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(415, 1, 415, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(416, 1, 416, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(417, 1, 417, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(418, 1, 418, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(419, 1, 419, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(420, 1, 420, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(421, 1, 421, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(422, 1, 422, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(423, 1, 423, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(424, 1, 424, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(425, 1, 425, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(426, 1, 426, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(427, 1, 427, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(428, 1, 428, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(429, 1, 429, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(430, 1, 430, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(431, 1, 431, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(432, 1, 432, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(433, 1, 433, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(434, 1, 434, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(435, 1, 435, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49'),
(436, 1, 436, 'active', NULL, NULL, '2023-02-18 08:38:49', '2023-02-18 08:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles_user`
--

CREATE TABLE `roles_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `roles_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_calculation_setting`
--

CREATE TABLE `shipping_calculation_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipping_type` varchar(32) DEFAULT NULL,
  `condition` varchar(32) DEFAULT NULL,
  `method` varchar(32) DEFAULT NULL,
  `main_value` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `image_link` varchar(128) DEFAULT NULL,
  `type` enum('home') DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `slug`, `caption`, `route`, `short_order`, `image_link`, `type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Slider 1', 'slider-1', 'Slider 1', NULL, 1, 'slider-1.jpeg', 'home', 'active', '1', NULL, '2023-08-25 11:07:18', '2023-08-25 11:07:18'),
(3, 'Slider 2', 'slider-2', 'Slider 2', NULL, 2, 'slider-2.png', 'home', 'inactive', '1', '1', '2023-08-25 11:07:55', '2023-08-29 02:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`, `created_at`, `updated_at`) VALUES
(0, 'reafatul@gmail.com', '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(1, 'palak.mining@yahoo.com', '2023-05-03 03:34:48', '2023-05-03 03:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `post_code` text DEFAULT NULL,
  `nid` varchar(64) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `roles_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('admin','customer','seller') DEFAULT NULL,
  `merchant_agreement` enum('no','yes') DEFAULT NULL,
  `cash_back` decimal(10,4) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `otp_password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile_no`, `post_code`, `nid`, `image`, `roles_id`, `type`, `merchant_agreement`, `cash_back`, `status`, `otp`, `otp_password`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(0, 'merchant@mogholmart.com', '$2y$10$dj.q5fAZSpTyYs/HWl4wlOnlN5GRnYNfBgX.nh0j.yfyzcINTDlni', 'dcsdc', 'sdcc', '01717134606', NULL, '6546465', '', NULL, 'seller', 'yes', NULL, 'cancel', NULL, NULL, NULL, '1', '1', '2023-06-17 03:22:12', '2023-06-17 03:37:49'),
(1, 'info@mogholmart.com', '$2y$10$fW7RISZzNM8uY6grVLBBMe4A7wi8gbA/q/rIfvqsjab22VSDIG1f2', 'Super', 'Admin', '372.771.4196 x8', NULL, '916397686', NULL, 1, 'admin', NULL, NULL, 'active', NULL, NULL, '3WD9z1iPdHVdtn1UOxrtKFCP0N8Racz155gqVoP6oboAsSUSV0au9LHwRWZJ', '1', '1', '2023-02-18 08:38:24', '2023-02-18 08:38:24'),
(9, 'reafatul@gmail.com', '$2y$10$ic3OohEl9vaCLnRgczYituPWfBIZr/N0qBDaydgVDbRMK9.Smg0cC', 'anik', 'rifat', '01643675060', '4220', NULL, NULL, NULL, 'customer', NULL, NULL, 'active', NULL, NULL, 'be0d39d94045b479f874e66db896339b', NULL, NULL, '2023-08-19 21:50:00', '2023-08-19 21:50:00'),
(10, 'aminul.sagar@yahoo.com', '$2y$10$VKC2sQYK8ojql1Pa.LaQ.ugVsJie4QRG55P.wNwSTozFf8kROLyZ6', 'Md. Aminul Hasan', 'Sagar', '01732941403', '', NULL, NULL, NULL, 'customer', NULL, NULL, 'inactive', NULL, NULL, '040a17e0fd23ad6dec1074b283349aeb', NULL, NULL, '2023-08-24 03:23:23', '2023-08-24 03:23:23'),
(11, 'aminul.office21@gmail.com', '$2y$10$7Qua4D/DywxJEWCvRsZYk.Tu7nTc.huQsL4HvdCITgcvqFhok7tjS', 'Md. Aminul Hasan', 'Sagar', '01709644775', '', NULL, NULL, NULL, 'customer', NULL, NULL, 'inactive', NULL, NULL, '7de077dffc2da454e879309a970ef87c', NULL, NULL, '2023-08-25 11:17:27', '2023-08-25 11:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `users_activities`
--

CREATE TABLE `users_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `actionname` varchar(32) DEFAULT NULL,
  `action_url` varchar(32) DEFAULT NULL,
  `action_table` varchar(32) DEFAULT NULL,
  `action_details` text DEFAULT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_billing_shipping`
--

CREATE TABLE `users_billing_shipping` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('billing','shipping') DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `company` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` varchar(16) DEFAULT NULL,
  `area` varchar(64) DEFAULT NULL,
  `zip` varchar(16) DEFAULT NULL,
  `post_code` text DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `special_instruction` text DEFAULT NULL,
  `alternative_phone` varchar(32) DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_billing_shipping`
--

INSERT INTO `users_billing_shipping` (`id`, `users_id`, `type`, `first_name`, `last_name`, `company`, `email`, `address`, `country`, `city`, `area`, `zip`, `post_code`, `phone`, `fax`, `special_instruction`, `alternative_phone`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(0, 10, 'billing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(1, 1, 'billing', 'Md. Aminul Hasan', 'Sagar', NULL, 'aminul.office21@gmail.com', 'Savar,', NULL, 'Dhaka', 'Savar', NULL, '1340', '01732941403', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(2, 1, 'shipping', 'Md. Aminul Hasan', 'Sagar', NULL, 'aminul.office21@gmail.com', 'Savar,', NULL, 'Dhaka', 'Savar', NULL, '1340', '01732941403', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(3, NULL, 'billing', 'anik', 'rifat', NULL, 'reafatul@gmail.com', 'ewewewewetw', NULL, 'chittagong', 'bayezid', NULL, '4220', '01643675060', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(4, 9, 'billing', 'anik', 'rifat', NULL, 'reafatul@gmail.com', 'ewewewewetw', NULL, 'chittagong', 'bayezid', NULL, '4220', '01643675060', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL),
(5, 9, 'shipping', 'anik', 'rifat', NULL, 'reafatul@gmail.com', 'ewewewewetw', NULL, 'chittagong', 'bayezid', NULL, '4220', '01643675060', NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_login_history`
--

CREATE TABLE `users_login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `login_time` varchar(32) DEFAULT NULL,
  `logout_time` varchar(32) DEFAULT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('active','inactive','cancel') DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_admin_product_search`
-- (See below for the actual view)
--
CREATE TABLE `vw_admin_product_search` (
`product_id` int(10) unsigned
,`product_title` varchar(128)
,`product_merchant_id` int(10) unsigned
,`weight` decimal(10,4)
,`status` enum('active','inactive','cancel')
,`product_slug` varchar(128)
,`manufacturer` varchar(32)
,`attribute_title` varchar(32)
,`brand` mediumtext
,`category_id` mediumtext
,`category_title` mediumtext
,`cat_meta_keywords` mediumtext
,`item_no` varchar(64)
,`sell_price` decimal(10,4)
,`list_price` decimal(10,4)
,`offer_price` decimal(10,4)
,`meta_title` varchar(32)
,`meta_keywords` varchar(128)
,`meta_description` mediumtext
,`quantity` varchar(8)
,`total_review` bigint(21)
,`image` varchar(128)
,`average_review` double(14,8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_product`
-- (See below for the actual view)
--
CREATE TABLE `vw_product` (
`product_id` int(10) unsigned
,`product_title` varchar(128)
,`product_merchant_id` int(10) unsigned
,`product_slug` varchar(128)
,`short_description` text
,`specification` text
,`description` text
,`manufacturer` varchar(32)
,`brand` mediumtext
,`category_id` mediumtext
,`category_title` mediumtext
,`item_no` varchar(64)
,`weight` decimal(10,4)
,`sell_price` decimal(10,4)
,`list_price` decimal(10,4)
,`offer_price` decimal(10,4)
,`image` varchar(128)
,`meta_title` varchar(32)
,`meta_keywords` varchar(128)
,`meta_description` mediumtext
,`quantity` varchar(8)
,`total_review` bigint(21)
,`average_review` double(14,8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_product_category`
-- (See below for the actual view)
--
CREATE TABLE `vw_product_category` (
`category_id` int(10) unsigned
,`category_title` varchar(32)
,`category_slug` varchar(32)
,`image_link` varchar(128)
,`banner_link` varchar(128)
,`category_meta_title` varchar(32)
,`category_meta_keywords` varchar(128)
,`category_meta_description` text
,`parent_category_id` int(10) unsigned
,`product_id` mediumtext
);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `vw_admin_product_search`
--
DROP TABLE IF EXISTS `vw_admin_product_search`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_admin_product_search`  AS SELECT `p`.`id` AS `product_id`, `p`.`title` AS `product_title`, `p`.`merchant_id` AS `product_merchant_id`, `p`.`weight` AS `weight`, `p`.`status` AS `status`, `p`.`slug` AS `product_slug`, (select `m`.`title` from `manufacturer` `m` where `p`.`manufacturer_id` = `m`.`id`) AS `manufacturer`, (select `attribute`.`title` from `attribute_set` `attribute` where `p`.`attribute_set_id` = `attribute`.`id`) AS `attribute_title`, (select group_concat(`b`.`title` separator ',') from (`brand` `b` join `product_brand` `p_b` on(`b`.`id` = `p_b`.`brand_id`)) where `p_b`.`product_id` = `p`.`id`) AS `brand`, (select group_concat(`c`.`id` separator ',') from (`category` `c` join `product_category` `p_c` on(`c`.`id` = `p_c`.`category_id`)) where `p_c`.`product_id` = `p`.`id`) AS `category_id`, (select group_concat(`c`.`title` separator ',') from (`category` `c` join `product_category` `p_c` on(`c`.`id` = `p_c`.`category_id`)) where `p_c`.`product_id` = `p`.`id`) AS `category_title`, (select group_concat(`c`.`meta_keywords` separator ',') from (`category` `c` join `product_category` `p_c` on(`c`.`id` = `p_c`.`category_id`)) where `p_c`.`product_id` = `p`.`id`) AS `cat_meta_keywords`, `p`.`item_no` AS `item_no`, `p`.`sell_price` AS `sell_price`, `p`.`list_price` AS `list_price`, `p`.`offer_price` AS `offer_price`, (select `p_s`.`meta_title` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_title`, (select `p_s`.`meta_keywords` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_keywords`, (select `p_s`.`meta_description` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_description`, (select `p_in`.`quantity` from `product_inventory` `p_in` where `p`.`id` = `p_in`.`product_id`) AS `quantity`, (select count(`p_review`.`id`) from `product_review` `p_review` where `p`.`id` = `p_review`.`product_id` and `p_review`.`status` = 'active') AS `total_review`, (select `p_i`.`image` from `product_image` `p_i` where `p`.`id` = `p_i`.`product_id` limit 1) AS `image`, (select avg(`p_review`.`rating_value_score`) from `product_review` `p_review` where `p`.`id` = `p_review`.`product_id` and `p_review`.`status` = 'active') AS `average_review` FROM `product` AS `p` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_product`
--
DROP TABLE IF EXISTS `vw_product`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_product`  AS SELECT `p`.`id` AS `product_id`, `p`.`title` AS `product_title`, `p`.`merchant_id` AS `product_merchant_id`, `p`.`slug` AS `product_slug`, `p`.`short_description` AS `short_description`, `p`.`specification` AS `specification`, `p`.`description` AS `description`, (select `m`.`title` from `manufacturer` `m` where `p`.`manufacturer_id` = `m`.`id`) AS `manufacturer`, (select group_concat(`b`.`title` separator ',') from (`brand` `b` join `product_brand` `p_b` on(`b`.`id` = `p_b`.`brand_id`)) where `p_b`.`product_id` = `p`.`id`) AS `brand`, (select group_concat(`c`.`id` separator ',') from (`category` `c` join `product_category` `p_c` on(`c`.`id` = `p_c`.`category_id`)) where `p_c`.`product_id` = `p`.`id`) AS `category_id`, (select group_concat(`c`.`title` separator ',') from (`category` `c` join `product_category` `p_c` on(`c`.`id` = `p_c`.`category_id`)) where `p_c`.`product_id` = `p`.`id`) AS `category_title`, `p`.`item_no` AS `item_no`, `p`.`weight` AS `weight`, `p`.`sell_price` AS `sell_price`, `p`.`list_price` AS `list_price`, `p`.`offer_price` AS `offer_price`, (select `p_i`.`image` from `product_image` `p_i` where `p`.`id` = `p_i`.`product_id` limit 1) AS `image`, (select `p_s`.`meta_title` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_title`, (select `p_s`.`meta_keywords` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_keywords`, (select `p_s`.`meta_description` from `product_seo` `p_s` where `p`.`id` = `p_s`.`product_id`) AS `meta_description`, (select `p_in`.`quantity` from `product_inventory` `p_in` where `p`.`id` = `p_in`.`product_id`) AS `quantity`, (select count(`p_review`.`id`) from `product_review` `p_review` where `p`.`id` = `p_review`.`product_id` and `p_review`.`status` = 'active') AS `total_review`, (select avg(`p_review`.`rating_value_score`) from `product_review` `p_review` where `p`.`id` = `p_review`.`product_id` and `p_review`.`status` = 'active') AS `average_review` FROM `product` AS `p` WHERE `p`.`status` = 'active' AND `p`.`title` <> '\'\'\'\'\'\'\'' ;

-- --------------------------------------------------------

--
-- Structure for view `vw_product_category`
--
DROP TABLE IF EXISTS `vw_product_category`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_product_category`  AS SELECT `c`.`id` AS `category_id`, `c`.`title` AS `category_title`, `c`.`slug` AS `category_slug`, `c`.`image_link` AS `image_link`, `c`.`banner_link` AS `banner_link`, `c`.`meta_title` AS `category_meta_title`, `c`.`meta_keywords` AS `category_meta_keywords`, `c`.`meta_description` AS `category_meta_description`, (select `c_s_r`.`parent_category_id` from `category_self_relation` `c_s_r` where `c`.`id` = `c_s_r`.`child_category_id`) AS `parent_category_id`, (select group_concat(`p_c`.`product_id` separator ',') from `product_category` `p_c` where `c`.`id` = `p_c`.`category_id`) AS `product_id` FROM `category` AS `c` WHERE `c`.`status` = 'active' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_code_column_unique` (`code_column`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_option_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_set`
--
ALTER TABLE `attribute_set`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_set_slug_unique` (`slug`);

--
-- Indexes for table `attribute_set_items`
--
ALTER TABLE `attribute_set_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_set_items_attribute_id_foreign` (`attribute_id`),
  ADD KEY `attribute_set_items_attribute_set_id_foreign` (`attribute_set_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_slug_unique` (`slug`),
  ADD KEY `brand_manufacturer_id_foreign` (`manufacturer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_slug_unique` (`slug`);

--
-- Indexes for table `category_self_relation`
--
ALTER TABLE `category_self_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_self_relation_parent_category_id_foreign` (`parent_category_id`),
  ADD KEY `category_self_relation_child_category_id_foreign` (`child_category_id`);

--
-- Indexes for table `comissions_setting`
--
ALTER TABLE `comissions_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comissions_setting_merchant_id_unique` (`merchant_id`);

--
-- Indexes for table `complain_us`
--
ALTER TABLE `complain_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_display_title_unique` (`display_title`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_condition`
--
ALTER TABLE `coupon_condition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_condition_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `coupon_per_item_relation`
--
ALTER TABLE `coupon_per_item_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_per_item_relation_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `emi`
--
ALTER TABLE `emi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_pages`
--
ALTER TABLE `general_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manufacturer_slug_unique` (`slug`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_profiles`
--
ALTER TABLE `merchant_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_profiles_users_id_foreign` (`users_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_head_id_foreign` (`order_head_id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shipping`
--
ALTER TABLE `order_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_shipping_order_head_id_foreign` (`order_head_id`);

--
-- Indexes for table `order_transaction`
--
ALTER TABLE `order_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_transaction_order_head_id_foreign` (`order_head_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_update`
--
ALTER TABLE `price_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_slug_unique` (`slug`),
  ADD UNIQUE KEY `product_item_no_unique` (`item_no`),
  ADD KEY `product_attribute_set_id_foreign` (`attribute_set_id`),
  ADD KEY `product_manufacturer_id_foreign` (`manufacturer_id`),
  ADD KEY `product_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brand_product_id_foreign` (`product_id`),
  ADD KEY `product_brand_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_category_discount`
--
ALTER TABLE `product_category_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_inventory_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_related_item`
--
ALTER TABLE `product_related_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_related_item_parent_product_id_foreign` (`parent_product_id`),
  ADD KEY `product_related_item_child_product_id_foreign` (`child_product_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_seo`
--
ALTER TABLE `product_seo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_seo_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_shipping`
--
ALTER TABLE `product_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_shipping_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotions_template_id_foreign` (`template_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `roles_permission`
--
ALTER TABLE `roles_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_permission_roles_id_foreign` (`roles_id`),
  ADD KEY `roles_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles_user`
--
ALTER TABLE `roles_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_roles_id_foreign` (`roles_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `shipping_calculation_setting`
--
ALTER TABLE `shipping_calculation_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_activities`
--
ALTER TABLE `users_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_activities_users_id_foreign` (`users_id`);

--
-- Indexes for table `users_billing_shipping`
--
ALTER TABLE `users_billing_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_billing_shipping_users_id_foreign` (`users_id`);

--
-- Indexes for table `users_login_history`
--
ALTER TABLE `users_login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_login_history_users_id_foreign` (`users_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_users_id_foreign` (`users_id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_set`
--
ALTER TABLE `attribute_set`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute_set_items`
--
ALTER TABLE `attribute_set_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category_self_relation`
--
ALTER TABLE `category_self_relation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `comissions_setting`
--
ALTER TABLE `comissions_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complain_us`
--
ALTER TABLE `complain_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_condition`
--
ALTER TABLE `coupon_condition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_per_item_relation`
--
ALTER TABLE `coupon_per_item_relation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emi`
--
ALTER TABLE `emi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_pages`
--
ALTER TABLE `general_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant_profiles`
--
ALTER TABLE `merchant_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_shipping`
--
ALTER TABLE `order_shipping`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_transaction`
--
ALTER TABLE `order_transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_update`
--
ALTER TABLE `price_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_category_discount`
--
ALTER TABLE `product_category_discount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
