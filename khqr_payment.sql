-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 17, 2026 at 04:07 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khqr_payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `button_text` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Learn More',
  `button_link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `background_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#7c3aed',
  `text_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ffffff',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int NOT NULL DEFAULT '1',
  `size` enum('big','small') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'big',
  `deal_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_width` int DEFAULT '600',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `description`, `image_url`, `button_text`, `button_link`, `background_color`, `text_color`, `is_active`, `display_order`, `size`, `deal_ends_at`, `created_at`, `updated_at`, `image_width`) VALUES
(1, 'iPhone 15 Pro Max', 'Titanium. So strong. So light. So Pro.', 'The most advanced iPhone ever with A17 Pro chip, titanium design, and Action Button. Experience the power of Pro.', 'https://images.unsplash.com/photo-1592286927505-2fd0c6b1d3b8?w=800&q=80', 'Shop Now', '#products', '#1e3a8a', '#ffffff', 1, 1, 'big', '2026-02-23 18:58:37', '2026-02-16 18:58:37', '2026-02-16 18:58:37', 600),
(2, 'Samsung Galaxy S24 Ultra', 'Galaxy AI is here', 'Meet Galaxy S24 Ultra, the ultimate creative companion. With the new S Pen, capture, edit and share like never before.', 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=800&q=80', 'Discover', '#products', '#7c3aed', '#ffffff', 1, 2, 'big', '2026-02-21 18:58:37', '2026-02-16 18:58:37', '2026-02-16 18:58:37', 600),
(3, 'AirPods Pro', '50% OFF Today Only!', 'Premium sound quality with active noise cancellation. Limited time offer - don\'t miss out!', 'https://images.unsplash.com/photo-1606841837239-c5a1a4a07af7?w=800&q=80', 'Grab Deal', '#products', '#059669', '#ffffff', 1, 1, 'small', NULL, '2026-02-16 18:58:37', '2026-02-16 18:58:37', 600),
(4, 'MacBook Air M3', 'Free Shipping + Gift', 'Get the latest MacBook Air with M3 chip. Free wireless mouse included with every purchase!', 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&q=80', 'Order Now', '#products', '#dc2626', '#ffffff', 1, 2, 'small', NULL, '2026-02-16 18:58:37', '2026-02-16 18:58:37', 600),
(5, 'Apple Watch S9', 'Health Tracking Pro', 'Monitor your health 24/7 with advanced sensors. Special bundle with extra sport bands!', 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=800&q=80', 'Get Bundle', '#products', '#7c2d12', '#ffffff', 1, 3, 'small', NULL, '2026-02-16 18:58:37', '2026-02-16 18:58:37', 600);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Electronics​ (គ្រឿងភ្លើង អ/នី)', 'Electronic devices and accessories', 1, '2026-02-09 22:30:07', '2026-02-10 23:05:35'),
(2, 'ខោទឹកនោមទារក', 'all thing of baby \r\nhttps://babycare-cambodia.com/?p=product_detail&pid=234&cid=7&pname=Drypers%20Wee%20Wee%20Dry%20XL50#here', 1, '2026-02-09 22:30:07', '2026-02-10 23:07:34'),
(3, 'អាហារទូទៅ', 'Food and drink products', 1, '2026-02-09 22:30:07', '2026-02-10 23:06:31'),
(4, 'សម្ភារះ_ប្រើប្រាស់', 'design or prepare and recovery home.\r\n', 1, '2026-02-09 22:30:07', '2026-02-10 23:06:04'),
(5, 'សម្ភារះ_ផ្ទះបាយ', 'Chef supplies', 1, '2026-02-09 22:30:07', '2026-02-10 23:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_spent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_points` int NOT NULL DEFAULT '0',
  `available_points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_phone_unique` (`phone`),
  KEY `customers_phone_index` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `phone`, `name`, `address`, `total_spent`, `total_points`, `available_points`, `created_at`, `updated_at`) VALUES
(1, '068656263', 'Peak Deth', '34B/35', 499.14, 104, 4, '2026-02-10 22:02:14', '2026-02-12 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_points`
--

DROP TABLE IF EXISTS `customer_points`;
CREATE TABLE IF NOT EXISTS `customer_points` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('earned','redeemed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL,
  `amount_spent` decimal(10,2) DEFAULT NULL,
  `amount_redeemed` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_points_sale_id_foreign` (`sale_id`),
  KEY `customer_points_customer_id_created_at_index` (`customer_id`,`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_points`
--

INSERT INTO `customer_points` (`id`, `customer_id`, `sale_id`, `type`, `points`, `amount_spent`, `amount_redeemed`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'earned', 100, NULL, NULL, 'Admin adjustment: i am Admin', '2026-02-10 22:10:14', '2026-02-10 22:10:14'),
(2, 1, NULL, 'redeemed', -45, NULL, 45.00, 'Redeemed 45 points for $45', '2026-02-10 22:11:57', '2026-02-10 22:11:57'),
(3, 1, NULL, 'redeemed', -1, NULL, 1.00, 'Redeemed 1 points for $1', '2026-02-10 22:21:14', '2026-02-10 22:21:14'),
(4, 1, NULL, 'redeemed', -1, NULL, 1.00, 'Redeemed 1 points for $1', '2026-02-10 22:21:30', '2026-02-10 22:21:30'),
(5, 1, NULL, 'redeemed', -1, NULL, 1.00, 'Redeemed 1 points for $1', '2026-02-10 22:25:12', '2026-02-10 22:25:12'),
(6, 1, NULL, 'redeemed', -1, NULL, 1.00, 'Redeemed 1 points for $1', '2026-02-10 22:25:44', '2026-02-10 22:25:44'),
(7, 1, NULL, 'redeemed', -1, NULL, 1.00, 'Redeemed 1 points for $1', '2026-02-10 22:42:45', '2026-02-10 22:42:45'),
(8, 1, NULL, 'redeemed', -50, NULL, 50.00, 'Redeemed 50 points for $50', '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(9, 1, 39, 'earned', 3, 319.77, NULL, 'Earned 3 points from purchase', '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(10, 1, 42, 'earned', 1, 179.37, NULL, 'Earned 1 points from purchase', '2026-02-12 04:12:04', '2026-02-12 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_posts`
--

DROP TABLE IF EXISTS `facebook_posts`;
CREATE TABLE IF NOT EXISTS `facebook_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `video_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int NOT NULL DEFAULT '1',
  `likes_count` int NOT NULL DEFAULT '0',
  `views_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facebook_posts_post_date_index` (`post_date`),
  KEY `facebook_posts_is_active_index` (`is_active`),
  KEY `facebook_posts_display_order_index` (`display_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_02_04_032402_create_payments_table', 1),
(2, '2026_02_10_000001_create_categories_table', 1),
(3, '2026_02_10_000002_create_products_table', 1),
(4, '2026_02_10_000003_create_sales_table', 1),
(5, '2026_02_10_000004_create_sale_items_table', 1),
(6, '2026_02_10_000005_create_users_table', 1),
(7, '2026_02_10_100000_update_payment_method_to_khqr_only', 2),
(9, '2026_02_10_120000_add_discount_to_products_table', 3),
(10, '2026_02_10_150000_add_google_oauth_to_users_table', 3),
(11, '2026_02_11_000001_create_customers_table', 4),
(12, '2026_02_11_000002_create_customer_points_table', 4),
(13, '2026_02_11_000003_add_customer_fields_to_sales_table', 4),
(15, '2026_02_11_000004_make_qr_code_nullable_in_payments_table', 5),
(16, '2026_02_05_085443_create_orders_table', 6),
(17, '2026_02_05_085443_create_products_table', 6),
(18, '2026_02_05_085444_create_banners_table', 6),
(19, '2026_02_05_085444_create_facebook_posts_table', 6),
(20, '2026_02_05_085444_create_order_items_table', 6),
(21, '2026_02_05_093057_add_discount_to_products_table', 6),
(22, '2026_02_05_100101_add_extra_images_to_products_table', 6),
(23, '2026_02_05_100657_add_detailed_specs_to_products_table', 7),
(24, '2026_02_05_101216_add_promotion_to_products_table', 8),
(25, '2026_02_05_114656_add_size_to_banners_table', 8),
(26, '2026_02_05_120000_add_iphone_air_banner', 8),
(27, '2026_02_06_000000_add_deal_ends_at_to_products_table', 8),
(28, '2026_02_06_092027_add_deal_ends_at_to_banners_table', 8),
(29, '2026_02_06_103737_add_image_width_to_banners_table', 8),
(30, '2026_02_06_105134_create_settings_table', 8),
(31, '2026_02_08_091444_create_brands_table', 8),
(32, '2026_02_08_091525_add_brand_id_to_products_table', 9),
(33, '2026_02_08_134508_add_sketchfab_model_id_to_products_table', 9),
(34, '2026_02_08_150000_add_extra_promo_images_to_products_table', 9),
(35, '2026_02_09_000000_add_condition_to_products_table', 9),
(36, '2026_02_09_100000_add_color_options_to_products_table', 9),
(37, '2026_02_09_110000_add_storage_options_to_products_table', 9),
(38, '2026_02_09_120000_change_discount_to_money_amount', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Paid','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `md5_hash` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deeplink` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `md5` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_code` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `bill_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terminal_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','SUCCESS','FAILED','EXPIRED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `bakong_response` json DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` timestamp NOT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `telegram_sent` tinyint(1) NOT NULL DEFAULT '0',
  `check_attempts` int NOT NULL DEFAULT '0',
  `last_checked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_md5_unique` (`md5`),
  KEY `payments_status_expires_at_index` (`status`,`expires_at`),
  KEY `payments_status_last_checked_at_index` (`status`,`last_checked_at`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `md5`, `qr_code`, `amount`, `currency`, `bill_number`, `mobile_number`, `store_label`, `terminal_label`, `merchant_name`, `status`, `bakong_response`, `transaction_id`, `expires_at`, `paid_at`, `telegram_sent`, `check_attempts`, `last_checked_at`, `created_at`, `updated_at`) VALUES
(1, '31cdf97d2c5422a9f73ad5c3da65b16b', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00050316PuDeth Smart-PAY0705POS-299170013177070255620563045A71', 0.02, 'USD', 'INV-20260210-0005', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-09 23:19:16', NULL, 0, 6, '2026-02-09 22:49:38', '2026-02-09 22:49:16', '2026-02-09 22:49:38'),
(2, 'd76c94c69e3faf896640089c6298e6d4', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00080316PuDeth Smart-PAY0705POS-299170013177070306708763048B95', 0.02, 'USD', 'INV-20260210-0008', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'SUCCESS', '{\"data\": {\"hash\": \"a39eb77b3285089b049eed51e62dd93616d640537cc9995d81dbdf6f6213eee1\", \"amount\": 0.02, \"currency\": \"USD\", \"description\": null, \"externalRef\": \"100FT36774348398\", \"toAccountId\": \"deth_peak3@aclb\", \"receiverBank\": null, \"createdDateMs\": 1770703085000, \"fromAccountId\": \"abaakhppxxx@abaa\", \"instructionRef\": null, \"trackingStatus\": null, \"acknowledgedDateMs\": 1770703087000, \"receiverBankAccount\": null}, \"errorCode\": null, \"responseCode\": 0, \"responseMessage\": \"Success\"}', 'a39eb77b3285089b049eed51e62dd93616d640537cc9995d81dbdf6f6213eee1', '2026-02-09 23:27:47', '2026-02-09 22:58:08', 1, 5, '2026-02-09 22:58:08', '2026-02-09 22:57:47', '2026-02-09 22:58:09'),
(3, '4cc00e46dd166f418a8a50b95bd6a3f9', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00090316PuDeth Smart-PAY0705POS-29917001317707059819856304E6A9', 0.02, 'USD', 'INV-20260210-0009', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 00:16:21', NULL, 0, 1, '2026-02-09 23:46:27', '2026-02-09 23:46:21', '2026-02-09 23:46:27'),
(4, '879e865bdc42a6dbd68e2b36637d7b5a', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00100316PuDeth Smart-PAY0705POS-29917001317707059854146304BC06', 0.02, 'USD', 'INV-20260210-0010', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 00:16:25', NULL, 0, 3, '2026-02-09 23:46:32', '2026-02-09 23:46:25', '2026-02-09 23:46:32'),
(5, '20c700bd32e172ecb87c68cbbd4077ca', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00110316PuDeth Smart-PAY0705POS-2991700131770706002354630435C5', 0.02, 'USD', 'INV-20260210-0011', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'SUCCESS', '{\"data\": {\"hash\": \"817f1ef04037b9ebcb8fb710b8c4420a10744f5fa2c9cd3572f73f066294d150\", \"amount\": 0.02, \"currency\": \"USD\", \"description\": null, \"externalRef\": \"100FT36774854789\", \"toAccountId\": \"deth_peak3@aclb\", \"receiverBank\": null, \"createdDateMs\": 1770706013000, \"fromAccountId\": \"abaakhppxxx@abaa\", \"instructionRef\": null, \"trackingStatus\": null, \"acknowledgedDateMs\": 1770706015000, \"receiverBankAccount\": null}, \"errorCode\": null, \"responseCode\": 0, \"responseMessage\": \"Success\"}', '817f1ef04037b9ebcb8fb710b8c4420a10744f5fa2c9cd3572f73f066294d150', '2026-02-10 00:16:42', '2026-02-09 23:46:58', 1, 4, '2026-02-09 23:46:58', '2026-02-09 23:46:42', '2026-02-09 23:47:00'),
(6, '699bc211e25ea03cb749253762ec7258', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00120316PuDeth Smart-PAY0705POS-29917001317707069180146304DBE8', 0.02, 'USD', 'INV-20260210-0012', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 00:31:58', NULL, 0, 1, '2026-02-10 00:01:59', '2026-02-10 00:01:58', '2026-02-10 00:01:59'),
(7, 'f2c2c53257e3a23810a95367a4c2bd51', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00130316PuDeth Smart-PAY0705POS-29917001317707092618466304F2E7', 0.02, 'USD', 'INV-20260210-0013', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:11:01', NULL, 0, 1, '2026-02-10 00:41:04', '2026-02-10 00:41:01', '2026-02-10 00:41:04'),
(8, 'e5f8315a3e714dc8196598e89e4db95c', '00020101021229190015deth_peak3@aclb520459995303840540518.995802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00140316PuDeth Smart-PAY0705POS-29917001317707099133296304C9F3', 18.99, 'USD', 'INV-20260210-0014', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:21:53', NULL, 0, 2, '2026-02-10 00:52:00', '2026-02-10 00:51:53', '2026-02-10 00:52:00'),
(9, '2cc52480780aa9788c43b933ef57d104', '00020101021229190015deth_peak3@aclb520459995303840540549.995802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00150316PuDeth Smart-PAY0705POS-29917001317707100645996304803B', 49.99, 'USD', 'INV-20260210-0015', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:24:24', NULL, 0, 4, '2026-02-10 00:54:36', '2026-02-10 00:54:24', '2026-02-10 00:54:36'),
(10, 'e8760c119e2409b00d7c8c1c002f6502', '00020101021229190015deth_peak3@aclb5204599953038405406129.955802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00160316PuDeth Smart-PAY0705POS-299170013177071008762763045BAB', 129.95, 'USD', 'INV-20260210-0016', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:24:47', NULL, 0, 4, '2026-02-10 00:55:04', '2026-02-10 00:54:47', '2026-02-10 00:55:04'),
(11, 'c32494537939248fd371f0b89abc20c2', '00020101021229190015deth_peak3@aclb52045999530384054071228.605802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00170316PuDeth Smart-PAY0705POS-299170013177071012256163040732', 1228.60, 'USD', 'INV-20260210-0017', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:25:22', NULL, 0, 1, '2026-02-10 00:55:24', '2026-02-10 00:55:22', '2026-02-10 00:55:24'),
(12, '2d915b7929f7e62e74cbbc71f1d51f06', '00020101021229190015deth_peak3@aclb520459995303840540579.995802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00180316PuDeth Smart-PAY0705POS-29917001317707113793256304C26F', 79.99, 'USD', 'INV-20260210-0018', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:46:19', NULL, 0, 2, '2026-02-10 01:16:26', '2026-02-10 01:16:19', '2026-02-10 01:16:26'),
(13, 'b7a1abaf6cb8a614e3d7f821122abda0', '00020101021229190015deth_peak3@aclb520459995303840540510.015802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00190316PuDeth Smart-PAY0705POS-29917001317707121622646304F5D5', 10.01, 'USD', 'INV-20260210-0019', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 01:59:22', NULL, 0, 5, '2026-02-10 01:29:39', '2026-02-10 01:29:22', '2026-02-10 01:29:39'),
(14, '9ac462b5b9b7ae3a43b8ba519eac4235', '00020101021229190015deth_peak3@aclb5204599953038405406100.045802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00200316PuDeth Smart-PAY0705POS-29917001317707140075336304235D', 100.04, 'USD', 'INV-20260210-0020', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 02:30:07', NULL, 0, 2, '2026-02-10 02:00:14', '2026-02-10 02:00:07', '2026-02-10 02:00:14'),
(15, 'e479a8d0d99fe6fdce16bfc5b35e6441', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00210316PuDeth Smart-PAY0705POS-299170013177071464144463042F8B', 0.02, 'USD', 'INV-20260210-0021', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 02:40:41', NULL, 0, 1, '2026-02-10 02:10:43', '2026-02-10 02:10:41', '2026-02-10 02:10:43'),
(16, '9b807628d7789a3cd526d6eb3fcea5f2', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00220316PuDeth Smart-PAY0705POS-29917001317707205390496304EA0E', 0.02, 'USD', 'INV-20260210-0022', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 04:18:59', NULL, 0, 7, '2026-02-10 03:49:30', '2026-02-10 03:48:59', '2026-02-10 03:49:30'),
(17, '15ef6a9f3abeffe6b77dc89216165874', '00020101021229190015deth_peak3@aclb520459995303840540560.005802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00230316PuDeth Smart-PAY0705POS-29917001317707236053926304A357', 60.00, 'USD', 'INV-20260210-0023', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 05:10:05', NULL, 0, 12, '2026-02-10 04:41:01', '2026-02-10 04:40:05', '2026-02-10 04:41:01'),
(18, '15f42c664eb9282135a8142295906286', '00020101021229190015deth_peak3@aclb52045999530384054071440.005802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00240316PuDeth Smart-PAY0705POS-29917001317707240330596304BA04', 1440.00, 'USD', 'INV-20260210-0024', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 05:17:13', NULL, 0, 1, '2026-02-10 04:47:23', '2026-02-10 04:47:13', '2026-02-10 04:47:23'),
(19, 'b0c90181888ff3c8ff3e0a67253314ac', '00020101021229190015deth_peak3@aclb52045999530384054071440.005802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00250316PuDeth Smart-PAY0705POS-299170013177072404322163048415', 1440.00, 'USD', 'INV-20260210-0025', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 05:17:23', NULL, 0, 0, NULL, '2026-02-10 04:47:23', '2026-02-10 04:47:23'),
(20, 'de624b6ed006b1e0ee19e00a5627b529', '00020101021229190015deth_peak3@aclb520459995303840540533.005802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00260316PuDeth Smart-PAY0705POS-29917001317707253465316304C366', 33.00, 'USD', 'INV-20260210-0026', '', 'PuDeth Smart-PAY', 'POS-2', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 05:39:06', NULL, 0, 28, '2026-02-10 05:11:23', '2026-02-10 05:09:06', '2026-02-10 05:11:23'),
(21, '3f8099b1f964e526d6ba14e6c8748c8c', '00020101021229190015deth_peak3@aclb520459995303840540560.005802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260210-00270316PuDeth Smart-PAY0705POS-199170013177073029140463045429', 60.00, 'USD', 'INV-20260210-0027', '', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 07:01:31', NULL, 0, 2, '2026-02-10 06:31:53', '2026-02-10 06:31:31', '2026-02-10 06:31:53'),
(22, 'ec5fd3a9045bef2b1dd0beafab3a282f', '00020101021229190015deth_peak3@aclb520459995303840540569.995802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260211-00010316PuDeth Smart-PAY0705POS-39917001317707823250956304C789', 69.99, 'USD', 'INV-20260211-0001', '', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 21:28:45', NULL, 0, 1, '2026-02-10 20:58:47', '2026-02-10 20:58:45', '2026-02-10 20:58:47'),
(23, 'da6e2b1565edf7896587652a691bd0b2', '00020101021229190015deth_peak3@aclb520459995303840540558.495802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260211-00020316PuDeth Smart-PAY0705POS-499170013177078267268263047444', 58.49, 'USD', 'INV-20260211-0002', '', 'PuDeth Smart-PAY', 'POS-4', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 21:34:32', NULL, 0, 1, '2026-02-10 21:04:35', '2026-02-10 21:04:32', '2026-02-10 21:04:35'),
(24, '1a21acdc1479a609547a2d05a325de14', '00020101021229190015deth_peak3@aclb520459995303840540549.495802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260211-00030316PuDeth Smart-PAY0705POS-399170013177078286511663049632', 49.49, 'USD', 'INV-20260211-0003', '', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 21:37:45', NULL, 0, 7, '2026-02-10 21:08:18', '2026-02-10 21:07:45', '2026-02-10 21:08:18'),
(25, 'b8e1178997a6291981cfd51c8b618ad9', '00020101021229190015deth_peak3@aclb52045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260211-00040316PuDeth Smart-PAY0705POS-199170013177078355301363044310', 0.02, 'USD', 'INV-20260211-0004', '', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'SUCCESS', '{\"data\": {\"hash\": \"64c04288995cdffdbfbe794e82ba28253fad13408aa4f630b11d9d246d18cb5f\", \"amount\": 0.02, \"currency\": \"USD\", \"description\": null, \"externalRef\": \"100FT36784600879\", \"toAccountId\": \"deth_peak3@aclb\", \"receiverBank\": null, \"createdDateMs\": 1770783577000, \"fromAccountId\": \"abaakhppxxx@abaa\", \"instructionRef\": null, \"trackingStatus\": null, \"acknowledgedDateMs\": 1770783580000, \"receiverBankAccount\": null}, \"errorCode\": null, \"responseCode\": 0, \"responseMessage\": \"Success\"}', '64c04288995cdffdbfbe794e82ba28253fad13408aa4f630b11d9d246d18cb5f', '2026-02-10 21:49:13', '2026-02-10 21:19:41', 1, 6, '2026-02-10 21:19:41', '2026-02-10 21:19:13', '2026-02-10 21:19:42'),
(26, '3fd901bf5cd02e3c4a2e3c828afd36a1', '00020101021229190015deth_peak3@aclb52045999530384054040.045802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260211-00010316PuDeth Smart-PAY0705POS-1991700131770784174948630411D5', 0.04, 'USD', 'INV-20260211-0001', '', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'SUCCESS', '{\"data\": {\"hash\": \"4873895defc81d696647d3a4aa3bfb064cfb9b9469ef32feca90ffbb3c591a21\", \"amount\": 0.04, \"currency\": \"USD\", \"description\": null, \"externalRef\": \"100FT36784723141\", \"toAccountId\": \"deth_peak3@aclb\", \"receiverBank\": null, \"createdDateMs\": 1770784193000, \"fromAccountId\": \"abaakhppxxx@abaa\", \"instructionRef\": null, \"trackingStatus\": null, \"acknowledgedDateMs\": 1770784195000, \"receiverBankAccount\": null}, \"errorCode\": null, \"responseCode\": 0, \"responseMessage\": \"Success\"}', '4873895defc81d696647d3a4aa3bfb064cfb9b9469ef32feca90ffbb3c591a21', '2026-02-10 21:59:34', '2026-02-10 21:29:56', 1, 5, '2026-02-10 21:29:56', '2026-02-10 21:29:34', '2026-02-10 21:30:00'),
(27, '32a88a7491d55558abd933244da132b4', '00020101021229320015deth_peak3@aclb010906865626352045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62630117INV-20260211-000202090686562630316PuDeth Smart-PAY0705POS-39917001317707861341216304C62A', 0.02, 'USD', 'INV-20260211-0002', '068656263', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'SUCCESS', '{\"data\": {\"hash\": \"2cede96fdad84c4e8f6f7556066cf6e60844a3e3ab2d1dae3ad9530fb24d10d1\", \"amount\": 0.02, \"currency\": \"USD\", \"description\": null, \"externalRef\": \"100FT36785125131\", \"toAccountId\": \"deth_peak3@aclb\", \"receiverBank\": null, \"createdDateMs\": 1770786150000, \"fromAccountId\": \"abaakhppxxx@abaa\", \"instructionRef\": null, \"trackingStatus\": null, \"acknowledgedDateMs\": 1770786152000, \"receiverBankAccount\": null}, \"errorCode\": null, \"responseCode\": 0, \"responseMessage\": \"Success\"}', '2cede96fdad84c4e8f6f7556066cf6e60844a3e3ab2d1dae3ad9530fb24d10d1', '2026-02-10 22:32:14', '2026-02-10 22:02:35', 1, 5, '2026-02-10 22:02:35', '2026-02-10 22:02:14', '2026-02-10 22:02:36'),
(28, '782229a319e76a1ad89440bb06a07fd5', '00020101021229320015deth_peak3@aclb01090686562635204599953038405802KH5916PuDeth Smart-PAY6010PHNOM PENH62630117INV-20260211-000302090686562630316PuDeth Smart-PAY0705POS-19917001317707867172456304F72A', 0.00, 'USD', 'INV-20260211-0003', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 22:41:57', NULL, 0, 6, '2026-02-10 22:12:24', '2026-02-10 22:11:57', '2026-02-10 22:12:24'),
(29, 'POINTS-698c12b8e3d9c', '', 0.00, 'USD', 'INV-20260211-0004', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'SUCCESS', NULL, NULL, '2026-02-10 22:55:12', '2026-02-10 22:25:12', 0, 0, NULL, '2026-02-10 22:25:12', '2026-02-10 22:25:12'),
(30, 'POINTS-698c12d8f22dd', '', 0.00, 'USD', 'INV-20260211-0005', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'SUCCESS', NULL, NULL, '2026-02-10 22:55:44', '2026-02-10 22:25:44', 0, 0, NULL, '2026-02-10 22:25:44', '2026-02-10 22:25:44'),
(31, '6cdebfc1d5b43a8f4da65194d191ea5f', '00020101021229320015deth_peak3@aclb010906865626352045999530384054040.025802KH5916PuDeth Smart-PAY6010PHNOM PENH62630117INV-20260211-000602090686562630316PuDeth Smart-PAY0705POS-199170013177078757747463045D02', 0.02, 'USD', 'INV-20260211-0006', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-10 22:56:17', NULL, 0, 1, '2026-02-10 22:26:19', '2026-02-10 22:26:17', '2026-02-10 22:26:19'),
(32, 'POINTS-698c16d52e702', '', 0.00, 'USD', 'INV-20260211-0007', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'SUCCESS', NULL, NULL, '2026-02-10 23:12:45', '2026-02-10 22:42:45', 0, 0, NULL, '2026-02-10 22:42:45', '2026-02-10 22:42:45'),
(33, '961a7b24b5aa9ad9ef1e16015d1a0412', '00020101021229320015deth_peak3@aclb01090686562635204599953038405406269.775802KH5916PuDeth Smart-PAY6010PHNOM PENH62630117INV-20260211-000802090686562630316PuDeth Smart-PAY0705POS-1991700131770792525125630400A7', 269.77, 'USD', 'INV-20260211-0008', '068656263', 'PuDeth Smart-PAY', 'POS-1', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-11 00:18:45', NULL, 0, 2, '2026-02-10 23:48:53', '2026-02-10 23:48:45', '2026-02-10 23:48:53'),
(34, '6b48ad2884e05e52a969c727228420a0', '00020101021229190015deth_peak3@aclb520459995303840540545.585802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260212-00010316PuDeth Smart-PAY0705POS-39917001317708798038746304A737', 45.58, 'USD', 'INV-20260212-0001', '', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-12 00:33:23', NULL, 0, 1, '2026-02-12 00:03:25', '2026-02-12 00:03:23', '2026-02-12 00:03:25'),
(35, 'b1796ec2a3a8459f65c8d50919ad6371', '00020101021229190015deth_peak3@aclb520459995303840540545.585802KH5916PuDeth Smart-PAY6010PHNOM PENH62500117INV-20260212-00020316PuDeth Smart-PAY0705POS-3991700131770880121566630426AA', 45.58, 'USD', 'INV-20260212-0002', '', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-12 00:38:41', NULL, 0, 1, '2026-02-12 00:08:43', '2026-02-12 00:08:41', '2026-02-12 00:08:43'),
(36, 'b8b67212c30b0d6de25edadb6d57c3f0', '00020101021229320015deth_peak3@aclb01090686562635204599953038405406179.375802KH5916PuDeth Smart-PAY6010PHNOM PENH62630117INV-20260212-000302090686562630316PuDeth Smart-PAY0705POS-399170013177089472453363045004', 179.37, 'USD', 'INV-20260212-0003', '068656263', 'PuDeth Smart-PAY', 'POS-3', 'PuDeth Smart-PAY', 'PENDING', NULL, NULL, '2026-02-12 04:42:04', NULL, 0, 9, '2026-02-12 04:12:46', '2026-02-12 04:12:04', '2026-02-12 04:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `screen_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `camera_main` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `camera_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `battery_capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_description` text COLLATE utf8mb4_unicode_ci,
  `promo_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_promo_images` text COLLATE utf8mb4_unicode_ci,
  `color_options` json DEFAULT NULL,
  `storage_options` json DEFAULT NULL,
  `has_promotion` tinyint(1) NOT NULL DEFAULT '0',
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New',
  `deal_ends_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_no_promo_usd` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `min_stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_4` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sketchfab_model_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sku_index` (`sku`),
  KEY `products_brand_id_foreign` (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `sku`, `description`, `screen_size`, `resolution`, `camera_main`, `camera_video`, `ram_size`, `processor`, `battery_capacity`, `promo_description`, `promo_image`, `extra_promo_images`, `color_options`, `storage_options`, `has_promotion`, `condition`, `deal_ends_at`, `price`, `price_no_promo_usd`, `discount`, `cost`, `stock`, `min_stock`, `image`, `image_2`, `image_3`, `image_4`, `sketchfab_model_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Wireless Mouse', 'ELEC-001', 'រីករាយ បុណ្យចូលឆ្នាំចិន', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 45.00, NULL, 12.00, 15.00, 87, 10, 'https://m.media-amazon.com/images/I/61YQeAUIboL._AC_SX466_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(2, 1, NULL, 'USB Cable', 'ELEC-002', 'រីករាយ បុណ្យចូលឆ្នាំចិន\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 9.99, NULL, 25.00, 5.00, 90, 20, 'https://tse2.mm.bing.net/th/id/OIP.aDhgGgTrMXZqEP5IIfPmwwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(3, 1, NULL, 'Bluetooth Speaker', 'ELEC-003', 'រីករាយបុណ្យ ចូលឆ្នាំចិន', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 49.99, NULL, 15.00, 30.00, 47, 5, 'https://m.media-amazon.com/images/I/81p9DPknjLL._AC_UL480_FMwebp_QL65_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(4, 1, NULL, 'Phone Charger', 'ELEC-004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 19.99, NULL, 0.00, 10.00, 61, 15, 'https://media.istockphoto.com/id/1701948335/photo/devices-charger-with-usb-type-c-output-socket-and-cable.jpg?s=612x612&w=0&k=20&c=rnQBIaZNAtWvr4ud1gbV5EGWteXxD87xpDv69DszY6I=', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(5, 2, NULL, ' Merries Japan NB90', 'CLO-001', 'Baby Diapers (ខោទឹកនោមទារក)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 17.90, NULL, 0.00, 8.00, 59, 10, 'https://babycare-cambodia.com/images/product/4901301230782.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(6, 2, NULL, ' Drypers Wee Wee Dry XL50', 'CLO-002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 11.70, NULL, 0.00, 20.00, 37, 8, 'https://babycare-cambodia.com/images/product/9557327011031.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(7, 2, NULL, 'Merries Pants Japan M58', 'CLO-003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 16.90, NULL, 0.00, 6.00, 41, 10, 'https://babycare-cambodia.com/images/product/4901301230591.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(8, 3, NULL, 'Coffee', 'FOOD-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 8.99, NULL, 0.00, 4.00, 79, 20, 'https://i.pinimg.com/originals/d9/a1/0d/d9a10df8698b06968ffe71ee9d9d7794.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(9, 3, NULL, 'Energy Drink', 'FOOD-002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 2.99, NULL, 0.00, 1.50, 119, 30, 'https://mir-s3-cdn-cf.behance.net/projects/404/7e7a43179577087.Y3JvcCwyNzYxLDIxNjAsMjM5LDA.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(10, 3, NULL, 'Snack Bar', 'FOOD-003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 1.99, NULL, 0.00, 0.80, 147, 40, 'https://th.bing.com/th/id/R.bb06f9435f57bc2bd5554b74a124b6f7?rik=rp49AL%2fHd0zK2g&riu=http%3a%2f%2funblast.com%2fwp-content%2fuploads%2f2022%2f11%2fMatte-Snack-Bar-Mockup-1.jpg&ehk=6zBnqrGXVgdkaJg%2fSQ%2bWJda57EqREnR47oBrKGclrIs%3d&risl=&pid=ImgRaw&r=0', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(11, 4, NULL, 'ស្រោមដៃ ផ្លាស្ទឹច', 'BOOK-001', 'GLOVEWORKS Black Disposable Nitrile Industrial Gloves 5 Mil, Latex/Powder-Free, Food-Safe, Textured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 14.99, NULL, 0.00, 8.00, 31, 5, 'https://m.media-amazon.com/images/I/71DyH8aj-dL._AC_SX569_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-12 04:12:04'),
(12, 4, NULL, 'សម្ភារះដាក់ស្លាបព្រា', 'BOOK-002', 'Extra Large Expandable Silverware Organizer, BPA-Free Food-Safe Cutlery Flatware Organizer, Kitchen Utensil Drawer Organizer, Adjustable Silverware Holder for Spoons Forks Knives, Black', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 5.99, NULL, 0.00, 3.00, 49, 10, 'https://m.media-amazon.com/images/I/711fUeua6GL._AC_SX679_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(13, 5, NULL, 'ស្រោមដៃ ការពាររលៀកដៃ', 'HOME-001', 'GORILLA GRIP BPA-Free Soft Silicone Oven Mitts, Heat Resistant and Waterproof Cooking Safety Gloves, Thick Cotton Lining, Flexible Gripping, Kitchen Potholders Set, for Grilling, BBQ, 12.5x8.3, Black', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 12.99, NULL, 0.00, 6.00, 39, 8, 'https://m.media-amazon.com/images/I/510bLa7wMTL._AC_SX679_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(14, 5, NULL, 'ថង់សំរាម', 'HOME-002', 'Amazon Basics Flextra Tall Kitchen Drawstring Trash Bags, 13 Gallon, 120 Count', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 7.99, NULL, 0.00, 3.50, 59, 12, 'https://m.media-amazon.com/images/I/61MCnisGfwL._AC_SY300_SX300_QL70_FMwebp_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45'),
(15, 5, NULL, 'ឆុត ឆ្នាំ និងខ្ទះ', 'HOME-003', 'CAROTE 21pcs Pots and Pans Set, Nonstick Cookware Set Detachable Handle, Induction Kitchen Cookware Sets Non Stick with Removable Handle, RV Cookware Set, Gold and Purple', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'New', NULL, 18.99, NULL, 0.00, 10.00, 39, 5, 'https://m.media-amazon.com/images/I/71RZusyF-qL._AC_SX679_.jpg', NULL, NULL, NULL, NULL, 1, '2026-02-09 22:30:07', '2026-02-10 23:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `change_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method` enum('KHQR') COLLATE utf8mb4_unicode_ci DEFAULT 'KHQR',
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points_earned` int NOT NULL DEFAULT '0',
  `points_used` int NOT NULL DEFAULT '0',
  `points_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_payment_id_foreign` (`payment_id`),
  KEY `sales_invoice_number_index` (`invoice_number`),
  KEY `sales_created_at_index` (`created_at`),
  KEY `sales_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_number`, `user_id`, `subtotal`, `tax`, `discount`, `total`, `paid_amount`, `change_amount`, `payment_method`, `payment_id`, `customer_id`, `customer_name`, `customer_phone`, `customer_address`, `points_earned`, `points_used`, `points_discount`, `notes`, `created_at`, `updated_at`) VALUES
(32, 'INV-20260211-0001', 1, 0.04, 0.00, 0.00, 0.04, 0.04, 0.00, 'KHQR', 26, NULL, NULL, NULL, NULL, 0, 0, 0.00, NULL, '2026-02-10 21:29:34', '2026-02-10 21:29:34'),
(33, 'INV-20260211-0002', 3, 0.02, 0.00, 0.00, 0.02, 0.02, 0.00, 'KHQR', 27, 1, 'Peak Deth', '068656263', '34B/35', 0, 0, 0.00, NULL, '2026-02-10 22:02:14', '2026-02-10 22:02:14'),
(34, 'INV-20260211-0003', 1, 42.51, 0.00, 0.00, 42.51, 0.00, 0.00, 'KHQR', 28, 1, 'Peak Deth', '068656263', '34B/35', 0, 45, 45.00, NULL, '2026-02-10 22:11:57', '2026-02-10 22:11:57'),
(35, 'INV-20260211-0004', 1, 0.02, 0.00, 0.00, 0.02, 0.00, 0.00, 'KHQR', 29, 1, 'Peak Deth', '068656263', '34B/35', 0, 1, 1.00, NULL, '2026-02-10 22:25:12', '2026-02-10 22:25:12'),
(36, 'INV-20260211-0005', 1, 0.02, 0.00, 0.00, 0.02, 0.00, 0.00, 'KHQR', 30, 1, 'Peak Deth', '068656263', '34B/35', 0, 1, 1.00, NULL, '2026-02-10 22:25:44', '2026-02-10 22:25:44'),
(37, 'INV-20260211-0006', 1, 0.02, 0.00, 0.00, 0.02, 0.02, 0.00, 'KHQR', 31, 1, 'Peak Deth', '068656263', '34B/35', 0, 0, 0.00, NULL, '2026-02-10 22:26:17', '2026-02-10 22:26:17'),
(38, 'INV-20260211-0007', 1, 0.14, 0.00, 0.00, 0.14, 0.00, 0.00, 'KHQR', 32, 1, 'Peak Deth', '068656263', '34B/35', 0, 1, 1.00, NULL, '2026-02-10 22:42:45', '2026-02-10 22:42:45'),
(39, 'INV-20260211-0008', 1, 319.77, 0.00, 0.00, 319.77, 269.77, 0.00, 'KHQR', 33, 1, 'Peak Deth', '068656263', '34B/35', 3, 50, 50.00, NULL, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(40, 'INV-20260212-0001', 3, 45.58, 0.00, 0.00, 45.58, 45.58, 0.00, 'KHQR', 34, NULL, NULL, NULL, NULL, 0, 0, 0.00, NULL, '2026-02-12 00:03:23', '2026-02-12 00:03:23'),
(41, 'INV-20260212-0002', 3, 45.58, 0.00, 0.00, 45.58, 45.58, 0.00, 'KHQR', 35, NULL, NULL, NULL, NULL, 0, 0, 0.00, NULL, '2026-02-12 00:08:41', '2026-02-12 00:08:41'),
(42, 'INV-20260212-0003', 3, 179.37, 0.00, 179.35, 179.37, 0.02, -179.35, 'KHQR', 36, 1, 'Peak Deth', '068656263', '34B/35', 1, 0, 0.00, NULL, '2026-02-12 04:12:04', '2026-02-12 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_items_sale_id_foreign` (`sale_id`),
  KEY `sale_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(74, 42, 7, 'Merries Pants Japan M58', 16.90, 1, 16.90, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(73, 41, 10, 'Snack Bar', 1.99, 1, 1.99, '2026-02-12 00:08:41', '2026-02-12 00:08:41'),
(72, 41, 11, 'ស្រោមដៃ ផ្លាស្ទឹច', 14.99, 1, 14.99, '2026-02-12 00:08:41', '2026-02-12 00:08:41'),
(71, 41, 6, ' Drypers Wee Wee Dry XL50', 11.70, 1, 11.70, '2026-02-12 00:08:41', '2026-02-12 00:08:41'),
(70, 41, 7, 'Merries Pants Japan M58', 16.90, 1, 16.90, '2026-02-12 00:08:41', '2026-02-12 00:08:41'),
(69, 40, 10, 'Snack Bar', 1.99, 1, 1.99, '2026-02-12 00:03:23', '2026-02-12 00:03:23'),
(68, 40, 11, 'ស្រោមដៃ ផ្លាស្ទឹច', 14.99, 1, 14.99, '2026-02-12 00:03:23', '2026-02-12 00:03:23'),
(67, 40, 6, ' Drypers Wee Wee Dry XL50', 11.70, 1, 11.70, '2026-02-12 00:03:23', '2026-02-12 00:03:23'),
(66, 40, 7, 'Merries Pants Japan M58', 16.90, 1, 16.90, '2026-02-12 00:03:23', '2026-02-12 00:03:23'),
(65, 39, 15, 'ឆុត ឆ្នាំ និងខ្ទះ', 18.99, 1, 18.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(64, 39, 14, 'ថង់សំរាម', 7.99, 1, 7.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(63, 39, 13, 'ស្រោមដៃ ការពាររលៀកដៃ', 12.99, 1, 12.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(62, 39, 9, 'Energy Drink', 2.99, 1, 2.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(61, 39, 11, 'ស្រោមដៃ ផ្លាស្ទឹច', 14.99, 1, 14.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(60, 39, 12, 'សម្ភារះដាក់ស្លាបព្រា', 5.99, 1, 5.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(59, 39, 8, 'Coffee', 8.99, 1, 8.99, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(58, 39, 7, 'Merries Pants Japan M58', 16.90, 1, 16.90, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(57, 39, 5, ' Merries Japan NB90', 17.90, 1, 17.90, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(56, 39, 1, 'Wireless Mouse', 39.60, 1, 39.60, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(55, 39, 2, 'USB Cable', 7.49, 1, 7.49, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(54, 39, 3, 'Bluetooth Speaker', 42.49, 2, 84.98, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(53, 39, 4, 'Phone Charger', 19.99, 4, 79.96, '2026-02-10 23:48:45', '2026-02-10 23:48:45'),
(52, 38, 1, 'Wireless Mouse', 0.02, 7, 0.14, '2026-02-10 22:42:45', '2026-02-10 22:42:45'),
(51, 37, 1, 'Wireless Mouse', 0.02, 1, 0.02, '2026-02-10 22:26:17', '2026-02-10 22:26:17'),
(50, 36, 1, 'Wireless Mouse', 0.02, 1, 0.02, '2026-02-10 22:25:44', '2026-02-10 22:25:44'),
(49, 35, 1, 'Wireless Mouse', 0.02, 1, 0.02, '2026-02-10 22:25:12', '2026-02-10 22:25:12'),
(48, 34, 3, 'Bluetooth Speaker', 42.49, 1, 42.49, '2026-02-10 22:11:57', '2026-02-10 22:11:57'),
(47, 34, 1, 'Wireless Mouse', 0.02, 1, 0.02, '2026-02-10 22:11:57', '2026-02-10 22:11:57'),
(46, 33, 1, 'Wireless Mouse', 0.02, 1, 0.02, '2026-02-10 22:02:14', '2026-02-10 22:02:14'),
(45, 32, 1, 'Wireless Mouse', 0.02, 2, 0.04, '2026-02-10 21:29:34', '2026-02-10 21:29:34'),
(75, 42, 6, ' Drypers Wee Wee Dry XL50', 11.70, 1, 11.70, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(76, 42, 11, 'ស្រោមដៃ ផ្លាស្ទឹច', 14.99, 1, 14.99, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(77, 42, 10, 'Snack Bar', 1.99, 1, 1.99, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(78, 42, 1, 'Wireless Mouse', 39.60, 3, 118.80, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(79, 42, 2, 'USB Cable', 7.49, 2, 14.99, '2026-02-12 04:12:04', '2026-02-12 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Phone Shop', 'general', '2026-02-16 18:56:02', '2026-02-16 18:58:49'),
(2, 'site_logo', 'https://via.placeholder.com/200x200?text=Logo', 'general', '2026-02-16 18:56:02', '2026-02-16 18:58:49'),
(3, 'telegram_account', '@soklyadmin', 'social', '2026-02-16 18:56:02', '2026-02-16 18:56:02'),
(4, 'bakong_account', 'sokly@bakong', 'payment', '2026-02-16 18:56:02', '2026-02-16 18:56:02'),
(5, 'contact_phone_1', '023 216 725/6', 'contact', '2026-02-16 18:56:02', '2026-02-16 18:56:02'),
(6, 'contact_phone_2', '078 311 111', 'contact', '2026-02-16 18:56:02', '2026-02-16 18:56:02'),
(7, 'contact_phone_3', '092 111 168', 'contact', '2026-02-16 18:56:02', '2026-02-16 18:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `store_settings`
--

DROP TABLE IF EXISTS `store_settings`;
CREATE TABLE IF NOT EXISTS `store_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_settings`
--

INSERT INTO `store_settings` (`id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'store_name', 'SABBY MARTS', 'string', 'branding', '2026-02-10 23:59:46', '2026-02-12 04:21:48'),
(2, 'store_logo', 'logos/jyghp4MIKejvKajmSUSkdQd4qUBPXS51RdrvccyI.jpg', 'image', 'branding', '2026-02-10 23:59:46', '2026-02-12 04:21:48'),
(3, 'store_tagline', 'KHQR PAYMENT SYSTEM', 'string', 'branding', '2026-02-10 23:59:46', '2026-02-10 23:59:46'),
(4, 'store_address', '', 'text', 'general', '2026-02-10 23:59:46', '2026-02-10 23:59:46'),
(5, 'store_phone', '', 'string', 'general', '2026-02-10 23:59:46', '2026-02-10 23:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','cashier') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cashier',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `avatar`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@pos.com', NULL, NULL, '$2y$12$YYruFc.4B0UKREwqzIUCdODBgJdIhXHFZAN3bhSfr71qUOs8eanqS', 'admin', 1, NULL, '2026-02-09 22:30:07', '2026-02-09 22:30:07'),
(2, 'Cashier', 'cashier@pos.com', NULL, NULL, '$2y$12$KRF2eI6dFoJ52U/fpvhMLulhHKk5gwmmIQkgYTjR2sCT1mYz1F/Su', 'cashier', 1, NULL, '2026-02-09 22:30:07', '2026-02-09 22:30:07'),
(3, 'Pu Deth', 'peakmao007@gmail.com', '112423087747336149672', 'https://lh3.googleusercontent.com/a/ACg8ocIVMiMdbU54OaWU5rEiY6CslS1n8WpGH1o1IRyE_sR0AFVOWBMY=s96-c', NULL, '', 1, 'AntQSsuXQnyAM8J8kebw8cLZNUwmqBThbMOQ3eeiBOcqKFHZLAicIfgzyDQD', '2026-02-10 20:57:34', '2026-02-10 20:57:34'),
(4, 'Pu Deth', 'dethpu5@gmail.com', '106027070749294954787', 'https://lh3.googleusercontent.com/a/ACg8ocIjujZABZGtbbT_6UqsYVrdqfFcCkK1ICKBQMAReRN68PdkDzE=s96-c', NULL, '', 1, 'afY9u3IRywEIg6p4WNtRdZhCSq27jftfZF084GXvHObfwFDzOn5lt0Gqzcqh', '2026-02-10 21:00:44', '2026-02-10 21:00:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
