-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24 أغسطس 2025 الساعة 10:59
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sedqydb`
--

-- --------------------------------------------------------

--
-- بنية الجدول `all_files`
--

CREATE TABLE `all_files` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `all_files`
--

INSERT INTO `all_files` (`id`, `title`, `object_id`, `object_name`, `created_at`, `updated_at`, `url`) VALUES
(1, '4545456456456', 1, 'maincenters', '2025-08-21 08:36:48', '2025-08-21 08:36:48', 'uploads/0d0df31c-12f1-4aff-b0bd-e618db41544b.png'),
(2, '98729740672498798', 1, 'maincenters', '2025-08-21 08:36:48', '2025-08-21 08:36:48', 'uploads/03073c87-4a2d-48cb-b648-183f0de6d94d.png'),
(3, '56456456465456456456465', 1, 'maincenters', '2025-08-21 08:48:01', '2025-08-21 08:48:01', 'uploads/40f0847d-3e3a-4996-ab4b-1c2d89861af2.png'),
(4, '456498/45415649/74561285', 1, 'maincenters', '2025-08-21 08:52:48', '2025-08-21 08:52:48', 'uploads/36a52ed9-1d96-44dc-a29b-fd61ef7e8bba.xlsx');

-- --------------------------------------------------------

--
-- بنية الجدول `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `position` int(11) NOT NULL,
  `display` int(1) NOT NULL,
  `icon` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `apps`
--

INSERT INTO `apps` (`id`, `parent_id`, `name`, `route`, `action`, `position`, `display`, `icon`, `created_by`, `created_at`) VALUES
(1, 0, 'centers', 'route.page', 'action function', 1, 1, 1, 1, '2025-07-11 17:49:20');

-- --------------------------------------------------------

--
-- بنية الجدول `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin@gmail.comad|127.0.0.1', 'i:1;', 1752777418),
('laravel_cache_admin@gmail.comad|127.0.0.1:timer', 'i:1752777418;', 1752777418);

-- --------------------------------------------------------

--
-- بنية الجدول `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `maincenter_id` int(11) NOT NULL,
  `center_name` text NOT NULL,
  `center_location` int(11) NOT NULL,
  `woter_no` varchar(100) DEFAULT NULL,
  `electric_no` text DEFAULT NULL,
  `left_electric_no` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `gps` text DEFAULT NULL,
  `hainame` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `Building_no` int(11) DEFAULT NULL,
  `sak_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `centers`
--

INSERT INTO `centers` (`id`, `maincenter_id`, `center_name`, `center_location`, `woter_no`, `electric_no`, `left_electric_no`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `notes`, `gps`, `hainame`, `street`, `Building_no`, `sak_no`) VALUES
(1, 1, 'خلف باوراث للملابس الجاهزة', 1, '4898611111', '30048659551', NULL, '2025-07-18 04:15:56', '2025-07-18 04:15:56', 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'عبدالله خياط', 1, '0529611111', '30048665020', '30048600455', '2025-07-18 11:06:06', '2025-07-18 12:50:47', 1, NULL, '', 'ملاحظات اخرى', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'الزاهر', 1, '4898611111', '30048659551', NULL, '2025-07-18 04:15:56', '2025-07-18 04:15:56', 1, NULL, 'uploads/6953c571-7ae6-4b01-b2cc-1540f307cd8b.png', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'عمارة الخنساء', 1, '98486465465456465', '654654654564564', '65465456456', '2025-08-18 16:15:57', '2025-08-18 16:15:57', 1, NULL, 'uploads/389be4a9-4f20-4314-9afb-bf4ee25d7992.png', 'test', 'https://maps.app.goo.gl/5mD6k5b9Ac6hLYrBA', 'الخنساء', 'الخنساء', 10, 2123123123);

-- --------------------------------------------------------

--
-- بنية الجدول `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `start_dateh` text NOT NULL,
  `end_dateh` text NOT NULL,
  `no_of_payments` int(11) NOT NULL,
  `year_amount` int(11) DEFAULT NULL,
  `services_amount` int(11) DEFAULT 0,
  `insurance_amount` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `renter_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `maincenter_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contracts`
--

INSERT INTO `contracts` (`id`, `start_date`, `end_date`, `start_dateh`, `end_dateh`, `no_of_payments`, `year_amount`, `services_amount`, `insurance_amount`, `center_id`, `unit_id`, `renter_id`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_active`, `maincenter_id`) VALUES
(40, '2025/07/27', '2026/07/30', '1447/02/01', '1448/02/15', 3, 21000, 0, 5000, 1, 1, 1, NULL, '2025-07-29 20:21:32', '2025-07-29 20:21:32', 1, NULL, NULL, 1, 1),
(41, '2025/07/27', '2026/07/30', '1447/02/01', '1448/02/15', 3, 21000, 0, 5000, 1, 1, 1, NULL, '2025-07-29 20:24:54', '2025-07-29 20:24:54', 1, NULL, NULL, 1, 1),
(42, '2025/08/06', '2026/08/06', '1447/02/11', '1448/02/22', 4, 24000, 0, 5000, 1, 1, 2, NULL, '2025-07-30 04:34:59', '2025-07-30 04:34:59', 1, NULL, NULL, 1, 1),
(43, '2022/07/30', '2023/07/19', '1444/01/01', '1444/12/30', 3, 18000, 0, 650, 1, 2, 1, NULL, '2025-07-30 16:11:13', '2025-07-30 16:11:13', 1, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_no` text NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `iban` varchar(20) NOT NULL,
  `job` varchar(200) NOT NULL,
  `center_id` int(11) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `birthday` varchar(10) DEFAULT NULL,
  `birthdayh` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `employees`
--

INSERT INTO `employees` (`id`, `name`, `id_no`, `nationality`, `mobile_no`, `iban`, `job`, `center_id`, `salary`, `birthday`, `birthdayh`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`) VALUES
(1, 'شاهد خان معدل', '56565656565', 'هندي', '0568954712', 'sa12365478965412', 'حارس عقار', 1, 2000, '25/10/2000', '13/01/1426', 'لا يوجد', '2025-07-19 08:16:50', '2025-07-19 08:27:38', 1, 1, 'uploads/4f4b9f46-9761-4ab9-b53b-e96fd87cbe07.png'),
(2, 'محمد علي سليمان', '2225556634', 'سعودي', '0569854135', 'sa12365478965412', 'محاسب', 1, 3000, '25/10/2000', '13/01/1426', 'لا يوجد', '2025-07-19 08:16:50', '2025-07-19 08:27:38', 1, 1, 'uploads/4f4b9f46-9761-4ab9-b53b-e96fd87cbe07.png');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `id_types`
--

CREATE TABLE `id_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `id_types`
--

INSERT INTO `id_types` (`id`, `name`, `description`) VALUES
(1, 'هوية وطنية', NULL),
(2, 'هوية مقيم', NULL),
(3, 'جواز سفر', NULL),
(4, 'سجل تجاري', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `filesize` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `images`
--

INSERT INTO `images` (`id`, `name`, `filesize`, `path`, `created_at`, `updated_at`) VALUES
(1, '1751106658_685fc462ef8ff.jpeg', '98220', 'http://127.0.0.1:8000/images/1751106658_685fc462ef8ff.jpeg', '2025-06-28 07:30:58', '2025-06-28 07:30:58'),
(2, '1751106658_685fc462f0763.jpeg', '23313', 'http://127.0.0.1:8000/images/1751106658_685fc462f0763.jpeg', '2025-06-28 07:30:59', '2025-06-28 07:30:59'),
(3, '1751106712_685fc49883c3d.jpg', '714607', 'http://127.0.0.1:8000/images/1751106712_685fc49883c3d.jpg', '2025-06-28 07:31:52', '2025-06-28 07:31:52'),
(4, '1751106712_685fc49884f98.jpeg', '63826', 'http://127.0.0.1:8000/images/1751106712_685fc49884f98.jpeg', '2025-06-28 07:31:52', '2025-06-28 07:31:52');

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'مكة المكرمة'),
(2, 'جدة');

-- --------------------------------------------------------

--
-- بنية الجدول `maincenters`
--

CREATE TABLE `maincenters` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `maincenters`
--

INSERT INTO `maincenters` (`id`, `name`, `iban`, `emp_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `notes`) VALUES
(1, 'وصية ابراهيم صدقي', 'SA1234567891236547896578', 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', 1, NULL, NULL, NULL),
(2, 'وقف ابراهيم صدقي حارة الباب', NULL, 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', NULL, NULL, NULL, NULL),
(3, 'وقف ابراهيم صدقي الرباط', NULL, 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', NULL, NULL, NULL, NULL),
(4, 'وقف ابراهيم صدقي جدة', NULL, 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', NULL, NULL, NULL, NULL),
(5, 'وقف محمد بن غسان', NULL, 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', NULL, NULL, NULL, NULL),
(6, 'وقف السليمانية', NULL, 1, '2025-08-13 08:33:28', '2025-08-13 08:33:28', NULL, NULL, NULL, NULL),
(7, 'وقف جديد معدل 2', 'SA1234567891233217896541', 2, '2025-08-16 15:15:55', '2025-08-21 04:08:44', 1, 1, '', 'تم تعديل البيانات');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_28_091923_create_permission_tables', 1),
(5, '2025_06_28_093248_create_products_table', 2),
(6, '2025_06_28_102223_create_images_table', 3);

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `message`, `is_to_admin`, `created_at`, `updated_at`, `title`) VALUES
(1, 1, '<h6>محرر النصوص46545456</h6>', 0, '2025-08-04 08:44:39', '2025-08-04 08:44:39', '5645456'),
(2, 1, '<h6>بسم الله الرحمن الرحيم <span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></h6><p><span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></p><p><span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></p>', 1, '2025-08-04 16:05:10', '2025-08-04 16:05:10', 'عنوان ملاحظة جديدة'),
(3, 1, '<h6>بسم الله الرحمن الرحيم <span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></h6><p><span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></p><p><span style=\"color: rgb(93, 89, 108);\">بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم بسم الله الرحمن الرحيم </span></p>', 1, '2025-08-04 16:05:42', '2025-08-04 16:05:42', 'عنوان ملاحظة جديدة'),
(4, 1, '<h6>عقود عمارة الزاهر اي كلام <span style=\"color: rgb(93, 89, 108);\">عقود عمارة الزاهر اي كلام عقود عمارة الزاهر اي كلام عقود عمارة الزاهر اي كلام عقود عمارة الزاهر اي كلام عقود عمارة الزاهر اي كلام عقود عمارة الزاهر اي كلام </span></h6>', 1, '2025-08-09 17:20:30', '2025-08-09 17:20:30', 'عقود 1445');

-- --------------------------------------------------------

--
-- بنية الجدول `notes_files`
--

CREATE TABLE `notes_files` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notes_files`
--

INSERT INTO `notes_files` (`id`, `note_id`, `created_at`, `updated_at`, `url`) VALUES
(1, 3, '2025-08-04 16:05:42', '2025-08-04 16:05:42', 'uploads/150d28c6-ab4c-4437-aa67-140e3b2bfaa6.png'),
(2, 3, '2025-08-04 16:05:42', '2025-08-04 16:05:42', 'uploads/614f16b9-f2a9-407c-8dda-fbdbf91fe823.png'),
(3, 3, '2025-08-04 16:05:42', '2025-08-04 16:05:42', 'uploads/a2d7b048-f1d4-4153-a69c-8907f8518188.png'),
(4, 4, '2025-08-09 17:20:31', '2025-08-09 17:20:31', 'uploads/bb75f216-caf2-4015-9b48-67ccbc35b8ed.html'),
(5, 4, '2025-08-09 17:20:31', '2025-08-09 17:20:31', 'uploads/008855fe-8e30-430e-b2c6-e94a65bdce7a.html'),
(6, 4, '2025-08-09 17:20:31', '2025-08-09 17:20:31', 'uploads/5332d090-41a0-4eea-98e8-e242151de34b.html');

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` text DEFAULT NULL,
  `element_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`, `updated_at`, `url`, `element_id`) VALUES
(1, 1, 'تم اضافة موظف جديد  ', 1, '2025-07-30 04:34:59', '2025-08-05 05:01:18', 'employees.show', 1),
(2, 5, 'تم اضافة موظف جديد  ', 0, '2025-07-30 04:34:59', '2025-07-30 04:34:59', 'employees.show', 2),
(3, 1, 'تم اضافة موظف جديد  ', 1, '2025-07-30 16:11:13', '2025-08-05 05:04:55', 'employees.show', 1),
(4, 5, 'تم اضافة موظف جديد  ', 0, '2025-07-30 16:11:13', '2025-07-30 16:11:13', 'employees.show', 2),
(5, 1, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:52:25', '2025-08-06 05:52:25', 'payments.show', 12),
(6, 5, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:52:25', '2025-08-06 05:52:25', 'payments.show', 12),
(7, 1, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:55:17', '2025-08-06 05:55:17', 'payments.show', 12),
(8, 5, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:55:17', '2025-08-06 05:55:17', 'payments.show', 12),
(9, 1, 'تم استلام مبلغ نقدي', 1, '2025-08-06 05:56:46', '2025-08-06 08:39:12', 'payments.show', 12),
(10, 5, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:56:46', '2025-08-06 05:56:46', 'payments.show', 12),
(11, 1, 'تم استلام مبلغ نقدي', 1, '2025-08-06 05:57:04', '2025-08-06 06:58:03', 'payments.show', 12),
(12, 5, 'تم استلام مبلغ نقدي', 0, '2025-08-06 05:57:04', '2025-08-06 05:57:04', 'payments.show', 12),
(13, 1, 'تم صرف مبلغ : 580', 0, '2025-08-08 14:38:15', '2025-08-08 14:38:15', 'sarfs.show', 8),
(14, 5, 'تم صرف مبلغ : 580', 0, '2025-08-08 14:38:15', '2025-08-08 14:38:15', 'sarfs.show', 8),
(15, 1, 'تم تسجيل أجازة للموظف شاهد خان معدل', 1, '2025-08-09 05:22:41', '2025-08-09 05:25:16', 'employees.show', 1),
(16, 5, 'تم تسجيل أجازة للموظف شاهد خان معدل', 0, '2025-08-09 05:22:41', '2025-08-09 05:22:41', 'employees.show', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas`
--

CREATE TABLE `ohdas` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `raseed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ohdas`
--

INSERT INTO `ohdas` (`id`, `emp_id`, `purpose`, `raseed`, `created_at`, `updated_at`, `center_id`, `maincenter_id`) VALUES
(1, 1, 'المصاريف العامة من رواتب وخدمات', 14000, '2025-08-07 11:17:36', '2025-08-08 08:50:48', NULL, NULL),
(2, 2, 'مصاريف الخدمات', 19000, '2025-08-07 11:17:36', '2025-08-08 08:50:48', NULL, NULL),
(3, 2, 'عهدة جديدة للمشتريات', 10000, '2025-08-09 04:12:13', '2025-08-09 04:12:13', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `ohdas_operations`
--

CREATE TABLE `ohdas_operations` (
  `id` int(11) NOT NULL,
  `ohda_id` int(11) NOT NULL,
  `op_type` varchar(1) NOT NULL,
  `sarf_id` int(11) DEFAULT NULL,
  `amount` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ohdas_operations`
--

INSERT INTO `ohdas_operations` (`id`, `ohda_id`, `op_type`, `sarf_id`, `amount`, `created_at`, `updated_at`, `last_amount`) VALUES
(1, 1, '-', 2, 2000, '2025-08-08 08:45:25', '2025-08-08 08:45:25', NULL),
(2, 1, '-', 3, 2000, '2025-08-08 08:49:22', '2025-08-08 08:49:22', NULL),
(3, 2, '+', 3, 2000, '2025-08-08 08:49:22', '2025-08-08 08:49:22', NULL),
(4, 1, '-', 4, 2000, '2025-08-08 08:50:48', '2025-08-08 08:50:48', NULL),
(5, 2, '+', 4, 2000, '2025-08-08 08:50:48', '2025-08-08 08:50:48', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fathylogic@hotmail.com', '$2y$12$ToaNK7h5wixjxlrsUQSrqO0e4sg7O65rMFYRFyfOgDSIUuFV4ffl2', '2025-06-28 07:10:45');

-- --------------------------------------------------------

--
-- بنية الجدول `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `p_date` varchar(10) NOT NULL,
  `p_dateh` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_txt` text DEFAULT NULL,
  `payment_no` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `year_m` varchar(4) DEFAULT NULL,
  `year_h` varchar(4) DEFAULT NULL,
  `sereal` int(11) DEFAULT NULL,
  `actual_date` varchar(10) DEFAULT NULL,
  `actual_dateh` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `is_for_sale_product` tinyint(1) DEFAULT 0,
  `product_desc` text DEFAULT NULL,
  `maincenter_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payments`
--

INSERT INTO `payments` (`id`, `contract_id`, `p_date`, `p_dateh`, `amount`, `amount_txt`, `payment_no`, `emp_id`, `payment_type`, `status`, `year_m`, `year_h`, `sereal`, `actual_date`, `actual_dateh`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `is_for_sale_product`, `product_desc`, `maincenter_id`, `center_id`, `unit_id`) VALUES
(4, 40, '2025/07/27', '1447/02/02', 5000, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 20:21:32', '2025-07-29 20:21:32', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 40, '2025/07/27', '1447/02/02', 7000, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 20:21:32', '2025-07-29 20:21:32', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 40, '2025/11/26', '1447/06/05', 7000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 20:21:32', '2025-07-29 20:21:32', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(7, 40, '2026/03/28', '1447/10/09', 7000, NULL, 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 20:21:32', '2025-07-29 20:21:32', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(8, 41, '2025/07/27', '1447/02/02', 5000, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'مبلغ التأمين', '2025-07-29 20:24:54', '2025-07-29 20:24:54', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(9, 41, '2025/07/27', '1447/02/02', 7000, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-29 20:24:54', '2025-07-29 20:24:54', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(10, 41, '2025/11/26', '1447/06/05', 7000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-29 20:24:54', '2025-07-29 20:24:54', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(11, 41, '2026/03/28', '1447/10/09', 7000, NULL, 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-29 20:24:54', '2025-07-29 20:24:54', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(12, 42, '2025/08/06', '1447/02/12', 5000, 'فقط خمسة آلاف ريال لاغير', 0, 1, 1, 1, '25', '47', 1, '2025/08/14', '1447/02/19', 'مبلغ التأمين', '2025-07-30 04:34:59', '2025-08-06 05:57:04', 1, 1, NULL, 0, NULL, NULL, NULL, NULL),
(13, 42, '2025/08/06', '1447/02/12', 6000, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 04:34:59', '2025-07-30 04:34:59', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(14, 42, '2025/11/05', '1447/05/14', 6000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 04:34:59', '2025-07-30 04:34:59', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(15, 42, '2026/02/04', '1447/08/16', 6000, NULL, 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 04:34:59', '2025-07-30 04:34:59', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(16, 42, '2026/05/06', '1447/11/19', 6000, NULL, 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 04:34:59', '2025-07-30 04:34:59', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(17, 43, '2022/07/30', '1444/01/01', 650, 'فقط ستمائة وخمسون ريالاً لاغير', 0, 2, 3, 1, '25', '47', 2, '2025/07/27', '1447/02/07', 'مبلغ التأمين', '2025-07-30 16:11:13', '2025-08-02 15:01:50', 1, 1, NULL, 0, NULL, NULL, NULL, NULL),
(18, 43, '2022/07/30', '1444/01/01', 6000, 'فقط ستة آلاف ريال لاغير', 1, 2, 1, 1, '25', '47', 3, '2025/07/27', '1447/02/05', NULL, '2025-07-30 16:11:13', '2025-08-02 15:08:27', 1, 1, NULL, 0, NULL, NULL, NULL, NULL),
(19, 43, '2022/11/25', '1444/05/01', 6000, NULL, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 16:11:13', '2025-07-30 16:11:13', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(20, 43, '2023/03/23', '1444/09/01', 6000, NULL, 3, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', '2025-07-30 16:11:13', '2025-07-30 16:11:13', 1, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `description`) VALUES
(1, 'كاش', NULL),
(2, 'تحويل بنكي', NULL),
(3, 'شيك', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `salary_year_month` varchar(7) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `other_allowance` int(11) DEFAULT 0,
  `deductions` int(11) DEFAULT 0,
  `other_allowance_purpose` text DEFAULT NULL,
  `deductions_purpose` text DEFAULT NULL,
  `net_salary` int(11) DEFAULT NULL,
  `net_salary_txt` varchar(200) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0,
  `p_date` varchar(10) DEFAULT NULL,
  `p_dateh` varchar(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `payrolls`
--

INSERT INTO `payrolls` (`id`, `emp_id`, `salary_year_month`, `basic_salary`, `other_allowance`, `deductions`, `other_allowance_purpose`, `deductions_purpose`, `net_salary`, `net_salary_txt`, `payment_type`, `payment_status`, `p_date`, `p_dateh`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, '2025/07', 3000, 0, 0, NULL, NULL, 3000, 'فقط ثلاثة آلاف ريال لاغير', 1, 1, '2025/08/07', '1447/02/12', NULL, '2025-08-08 06:01:31', '2025-08-08 09:00:11'),
(2, 1, '2025/07', 2000, 0, 0, NULL, NULL, 2000, 'فقط خمسمائة ريال لاغير', 1, 1, '2025/08/14', '1447/02/19', NULL, '2025-08-08 06:01:31', '2025-08-08 09:02:44');

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(2, 'role-create', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(3, 'role-edit', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(4, 'role-delete', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(5, 'product-list', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(6, 'product-create', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(7, 'product-edit', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39'),
(8, 'product-delete', 'web', '2025-06-28 06:46:39', '2025-06-28 06:46:39');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'تجربة', 'test test', '2025-06-28 06:58:50', '2025-06-28 06:58:50');

-- --------------------------------------------------------

--
-- بنية الجدول `recipients`
--

CREATE TABLE `recipients` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `r_type` text NOT NULL,
  `r_address` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `iban` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `recipients`
--

INSERT INTO `recipients` (`id`, `name`, `r_type`, `r_address`, `mobile_no`, `iban`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`) VALUES
(1, 'جمعية البر', 'جمعية خيرية', 'مكة المكرمة - العوالي', '0568974563', 'sa56984001236541', 'ملاحظات', '2025-07-19 09:31:12', '2025-07-19 09:31:53', 1, 1, 'uploads/92775d74-78c0-4fc5-9fe8-372399f342c2.png');

-- --------------------------------------------------------

--
-- بنية الجدول `renters`
--

CREATE TABLE `renters` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_no` text NOT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text NOT NULL,
  `Employer` text DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `other_no` varchar(20) DEFAULT NULL,
  `work_no` varchar(20) DEFAULT NULL,
  `work_letter` varchar(100) DEFAULT NULL,
  `contract_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `renters`
--

INSERT INTO `renters` (`id`, `name`, `id_no`, `nationality`, `mobile_no`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `Employer`, `id_type`, `other_no`, `work_no`, `work_letter`, `contract_file`) VALUES
(1, 'محمد حسين حيـاتي', '2017588860', 'سوري', '0563880000', 'لا يوجد ملاحظات', '2025-07-18 14:33:12', '2025-07-30 16:03:39', 1, 1, 'uploads/399a1800-0d85-4ce0-9dfc-1fe9d9cb7b71.png', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'شركة مجموعة خدمات المطاعم', '4030050359', 'سعودية', '0563880000', NULL, '2025-07-18 16:01:32', '2025-07-25 01:59:25', 1, 1, 'uploads/fc4bdcd4-6d04-48b0-9cad-67a35f1a1c99.png', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'احمد علي امين عبدالله', '2414189296', 'مصري', '0541896396', NULL, '2025-07-30 16:05:24', '2025-07-30 16:05:24', 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-28 06:48:51', '2025-06-28 06:48:51'),
(2, 'enterduser', 'web', '2025-06-28 06:53:52', '2025-06-28 06:53:52');

-- --------------------------------------------------------

--
-- بنية الجدول `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `sarfs`
--

CREATE TABLE `sarfs` (
  `id` int(11) NOT NULL,
  `source_type_id` int(11) NOT NULL COMMENT 'نوع مصدر الصرف',
  `p_date` varchar(10) NOT NULL,
  `p_dateh` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_txt` text DEFAULT NULL,
  `sarf_type_id` int(11) NOT NULL COMMENT 'نوع اوجه الصرف',
  `pay_role_id` int(11) DEFAULT NULL COMMENT 'رقم كشف الراتب',
  `payment_type` int(11) DEFAULT NULL,
  `year_m` varchar(4) DEFAULT NULL,
  `year_h` varchar(4) DEFAULT NULL,
  `sereal` int(11) DEFAULT NULL,
  `recipient_id` int(10) DEFAULT NULL COMMENT 'رقم المستفيد',
  `from_ohda_id` int(10) DEFAULT NULL COMMENT 'رقم العهدة اذا كان المدر عهدة',
  `to_ohda_id` int(11) DEFAULT NULL,
  `s_desc` text DEFAULT NULL COMMENT 'الغرض من الصرف ',
  `service_type_id` int(11) DEFAULT NULL COMMENT 'نوع الخدمة ',
  `maincenter_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `receved_by` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sarfs`
--

INSERT INTO `sarfs` (`id`, `source_type_id`, `p_date`, `p_dateh`, `amount`, `amount_txt`, `sarf_type_id`, `pay_role_id`, `payment_type`, `year_m`, `year_h`, `sereal`, `recipient_id`, `from_ohda_id`, `to_ohda_id`, `s_desc`, `service_type_id`, `maincenter_id`, `center_id`, `unit_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`, `receved_by`) VALUES
(1, 2, '2025/08/14', '1447/02/19', 2000, 'فقط ألفان ريال لاغير', 1, NULL, 2, '25', '47', 1, NULL, 1, 2, 'اي حاجة', NULL, NULL, NULL, NULL, '2025-08-08 08:32:55', '2025-08-08 08:32:55', 1, NULL, NULL, 'فريد شوقي'),
(2, 2, '2025/08/14', '1447/02/19', 2000, 'فقط ألفان ريال لاغير', 1, NULL, 2, '25', '47', 2, NULL, 1, 2, 'اي حاجة', NULL, NULL, NULL, NULL, '2025-08-08 08:45:25', '2025-08-08 08:45:25', 1, NULL, NULL, NULL),
(3, 2, '2025/08/14', '1447/02/19', 2000, 'فقط ألفان ريال لاغير', 1, NULL, 2, '25', '47', 3, NULL, 1, 2, 'اي حاجة', NULL, NULL, NULL, NULL, '2025-08-08 08:49:22', '2025-08-08 08:49:22', 1, NULL, NULL, NULL),
(4, 2, '2025/08/14', '1447/02/19', 2000, 'فقط ألفان ريال لاغير', 1, NULL, 2, '25', '47', 4, NULL, 1, 2, 'اي حاجة', NULL, NULL, NULL, NULL, '2025-08-08 08:50:48', '2025-08-08 08:50:48', 1, NULL, NULL, NULL),
(5, 1, '2025/08/07', '1447/02/12', 3000, 'فقط ثلاثة آلاف ريال لاغير', 3, 2, 1, '25', '47', 5, NULL, NULL, NULL, 'راتب شهر 2025/07', NULL, NULL, NULL, NULL, '2025-08-08 09:00:11', '2025-08-08 09:00:11', 1, NULL, NULL, NULL),
(6, 1, '2025/08/14', '1447/02/19', 500, 'فقط خمسمائة ريال لاغير', 4, NULL, 1, '25', '47', 6, NULL, NULL, NULL, 'صيانة', 3, NULL, 1, 2, '2025-08-08 09:02:44', '2025-08-08 09:02:44', 1, NULL, NULL, NULL),
(7, 1, '2025/08/14', '1447/02/19', 1500, 'فقط ألف وخمسمائة ريال لاغير', 2, NULL, 1, '25', '47', 7, 1, NULL, NULL, 'تبرع', NULL, NULL, NULL, NULL, '2025-08-08 09:22:59', '2025-08-08 09:22:59', 1, NULL, NULL, NULL),
(8, 1, '2025/08/08', '1447/02/13', 580, 'فقط خمسمائة وثمانون ريالاً لاغير', 4, NULL, 2, '25', '47', 8, NULL, NULL, NULL, 'صيانة عداد', 5, NULL, 1, 1, '2025-08-08 14:38:15', '2025-08-08 14:38:15', 1, NULL, NULL, 'محمد حسنين هيكل');

-- --------------------------------------------------------

--
-- بنية الجدول `sarf_types`
--

CREATE TABLE `sarf_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sarf_types`
--

INSERT INTO `sarf_types` (`id`, `name`) VALUES
(1, 'عهدة مالية'),
(2, 'المستفيدين'),
(3, 'رواتب موظفين'),
(4, 'خدمات');

-- --------------------------------------------------------

--
-- بنية الجدول `service_types`
--

CREATE TABLE `service_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `service_types`
--

INSERT INTO `service_types` (`id`, `name`) VALUES
(1, 'مشتريات'),
(2, 'صيانة عامة'),
(3, 'صيانة كهربائية'),
(4, 'صيانة سباكة'),
(5, 'فاتورة كهرباء'),
(6, 'فاتورة مياه'),
(7, 'صيانة مصعد'),
(8, 'أخرى');

-- --------------------------------------------------------

--
-- بنية الجدول `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8znGgxtKZtGS3yfu0SMTfewIjntibP4KWAhqMLPC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXBOVW5UYkpNcjlTVVhyMXYyWnd6STFrQlNSWFlhc053TEYxeU93ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1755691939),
('arMvPen2NY45BTTccK18dGbTI0HYpXtSBWd3g6gk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoienprNFl5bWdPMU5kZVBzN1psNm8yclcya3dxaUlmWlNxZlRXalo3RSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzU1NTQwNjQ4O319', 1755545101),
('b0yLCRlfOAKKMh66g3M9ZiGGzCTZnd5LQNN7DO99', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYXM4aHVJZjc1dDJ2Nm1TRDVTRTdMRGxSTmdQZGlESjA0ZkE4Zk5qOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2VudGVycy9zaG93LzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1NjAxNzU5ODt9fQ==', 1756025568),
('osq9nb7whm3reby73gv3pEnBqY9OHUyfxT5UqWkg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoib0V3dW9KZUNUakc3R2ZDRVJrWFZFWldrVHh3ckRraVBmY0hmdlVtbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbWFpbmNlbnRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1NTc3MzA0Mjt9fQ==', 1755778971),
('yfSIXkPj7D4dTrEGbe6xcuyZ69OokStb59djtB9S', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNll5emJYTDY0Rmk3VzUyOHF6QVhBeU41STdOSGdmdXdjTGVaQzFydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYWluY2VudGVycy9zaG93LzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1NTc1NjgwNDt9fQ==', 1755760260);

-- --------------------------------------------------------

--
-- بنية الجدول `source_types`
--

CREATE TABLE `source_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `source_types`
--

INSERT INTO `source_types` (`id`, `name`) VALUES
(1, 'الايرادات'),
(2, 'العهد المالية'),
(3, 'مبيعات');

-- --------------------------------------------------------

--
-- بنية الجدول `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_type` int(11) NOT NULL,
  `unit_description` text NOT NULL,
  `center_id` int(11) NOT NULL,
  `woter_no` text DEFAULT NULL,
  `electric_no` text DEFAULT NULL,
  `current_renter_id` int(11) DEFAULT NULL,
  `floor_no` int(11) DEFAULT NULL,
  `unit_no` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `units`
--

INSERT INTO `units` (`id`, `unit_type`, `unit_description`, `center_id`, `woter_no`, `electric_no`, `current_renter_id`, `floor_no`, `unit_no`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`, `img`) VALUES
(1, 5, '100 متر', 1, NULL, '10066620731', 2, 0, 1, NULL, '2025-07-19 14:39:20', '2025-07-25 02:00:30', 1, 1, 'uploads/a7bc496a-86bc-4e8e-b355-665b41568af3.png'),
(2, 2, 'اربع غرف', 1, NULL, '10066622163', 1, 1, 2, NULL, '2025-07-30 16:07:27', '2025-07-30 16:07:27', 1, NULL, '');

-- --------------------------------------------------------

--
-- بنية الجدول `unit_types`
--

CREATE TABLE `unit_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`, `description`) VALUES
(1, 'عمارة', NULL),
(2, 'شقة سكنية', NULL),
(3, 'محل تجاري', NULL),
(4, 'ملحق سكني', NULL),
(5, 'مكتب تجاري', NULL),
(6, 'مخزن', NULL),
(7, 'دور', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `mobile_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `mobile_no`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$R.Y5nWIBK/wGmmWdICae1eRyF7ZYyQ4IbiiURLSQhhUqwJ860i3Hu', NULL, '2025-06-28 06:48:51', '2025-06-28 06:48:51', 1, ''),
(2, 'fathy', 'fathylogic@hotmail.com', NULL, '$2y$12$uDJ3NOxvzmFeIKJmCJJMwOYuTefFr6wPtiz5vJoGQNB2Uj9RgWLHi', NULL, '2025-06-28 06:52:36', '2025-06-28 06:52:36', 0, ''),
(5, '‪Fathy Soliman‬', 'fsoliman@gmail.com', NULL, '$2y$12$6anF57zCiNCHwUubmBA3PulA72tezH8Bfr57J/VIvfleszZqHCYF6', NULL, '2025-07-25 14:50:43', '2025-07-25 14:50:43', 1, '0567842143');

-- --------------------------------------------------------

--
-- بنية الجدول `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `is_add` int(1) NOT NULL,
  `is_edit` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `is_show` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `app_id`, `is_add`, `is_edit`, `is_delete`, `is_show`, `created_by`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2025-07-11 20:10:38');

-- --------------------------------------------------------

--
-- بنية الجدول `vacations`
--

CREATE TABLE `vacations` (
  `id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `start_dateh` text NOT NULL,
  `end_dateh` text NOT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `vacations`
--

INSERT INTO `vacations` (`id`, `start_date`, `end_date`, `start_dateh`, `end_dateh`, `no_of_days`, `emp_id`, `notes`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '2025/07/27', '2025/08/18', '1447/02/01', '1447/02/23', 22, 1, 'تجربة اجازة', '2025-08-09 05:22:41', '2025-08-09 05:22:41', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_files`
--
ALTER TABLE `all_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `id_types`
--
ALTER TABLE `id_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maincenters`
--
ALTER TABLE `maincenters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes_files`
--
ALTER TABLE `notes_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ohdas`
--
ALTER TABLE `ohdas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ohdas_operations`
--
ALTER TABLE `ohdas_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sarfs`
--
ALTER TABLE `sarfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarf_types`
--
ALTER TABLE `sarf_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `source_types`
--
ALTER TABLE `source_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_files`
--
ALTER TABLE `all_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_types`
--
ALTER TABLE `id_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maincenters`
--
ALTER TABLE `maincenters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes_files`
--
ALTER TABLE `notes_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ohdas`
--
ALTER TABLE `ohdas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ohdas_operations`
--
ALTER TABLE `ohdas_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sarfs`
--
ALTER TABLE `sarfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sarf_types`
--
ALTER TABLE `sarf_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `source_types`
--
ALTER TABLE `source_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
