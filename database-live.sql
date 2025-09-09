-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2025 at 10:07 AM
-- Server version: 10.6.22-MariaDB-cll-lve-log
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bublee_bublee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'info@bublee.me', '2021-12-22 11:31:46', '$2y$10$dGdEk4fp/Tk0WgheMIV1H.2g8/ebsxv4bWGUL7O4gNTj.s4cvVvFK', 'ejSBFwygaQ', NULL, '202509081146Heart Beat Wallpaper 1680x1050 Heart Beat.jpg', '2021-12-22 11:31:46', '2025-09-08 09:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'Services', 'services', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Country', 'country', 'Contory', NULL, NULL, NULL, NULL, NULL),
(4, 'India', 'india', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `feed_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `feeds`
--

CREATE TABLE `feeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `text` text DEFAULT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `media_type` enum('image','video') DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `likeable_type` varchar(255) NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(8, '2016_06_01_000004_create_oauth_clients_table', 1),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2021_06_01_072313_create_sessions_table', 1),
(13, '2021_12_14_182250_create_templates_table', 1),
(14, '2021_12_14_183454_create_categories_table', 1),
(15, '2021_12_14_183500_create_pages_table', 1),
(16, '2021_12_16_165355_create_images_table', 1),
(17, '2021_12_21_182929_create_partners_table', 1),
(18, '2021_12_21_183208_create_testimonials_table', 1),
(19, '2021_12_21_183226_create_teams_table', 1),
(20, '2021_12_21_183253_create_sliders_table', 1),
(21, '2021_12_21_185136_create_post_categories_table', 1),
(22, '2021_12_21_185145_create_posts_table', 1),
(24, '2025_04_09_173538_create_otp_codes_table', 2),
(25, '2025_04_29_064813_add_nick_name_to_users_table', 3),
(28, '2025_05_01_184436_create_user_kyc_infos_table', 5),
(29, '2025_05_01_185115_create_user_profiles_table', 6),
(30, '2025_05_24_172049_create_user_likes_table', 7),
(31, '2025_05_24_172757_create_user_blocks_table', 7),
(32, '2025_05_24_173429_create_user_comments_table', 7),
(33, '2025_05_24_182857_create_user_actions_table', 8),
(34, '2025_05_30_173711_create_stories_table', 9),
(35, '2025_05_30_174008_create_story_views_table', 9),
(36, '2025_05_30_175459_create_feeds_table', 9),
(37, '2025_05_30_175554_create_comments_table', 9),
(38, '2025_05_30_175711_create_likes_table', 9),
(39, '2025_07_03_193301_create_contact_messages_table', 10),
(40, '2025_07_03_194030_add_user_id_to_contact_messages_table', 11),
(41, '2025_07_03_194638_create_user_data_table', 11),
(42, '2025_07_04_175613_add_freeze_account_to_users_table', 12),
(43, '2025_07_29_174806_add_reply_to_contact_messages_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_codes`
--

CREATE TABLE `otp_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_codes`
--

INSERT INTO `otp_codes` (`id`, `mobile`, `email`, `otp`, `expires_at`, `created_at`, `updated_at`) VALUES
(12, NULL, 'sugejupruzu-6982@yopmail.com', '2319', '2025-08-25 15:44:39', '2025-08-25 15:39:40', '2025-08-25 15:39:40'),
(13, NULL, 'sugejupruzu-6982@yopmail.com', '8044', '2025-08-25 15:48:50', '2025-08-25 15:43:51', '2025-08-25 15:43:51'),
(14, NULL, 'sugejupruzu-6982@yopmail.com', '3347', '2025-08-25 15:48:57', '2025-08-25 15:43:58', '2025-08-25 15:43:58'),
(15, NULL, 'sugejupruzu-6982@yopmail.com', '7631', '2025-08-25 15:49:04', '2025-08-25 15:44:06', '2025-08-25 15:44:06'),
(16, NULL, 'sugejupruzu-6982@yopmail.com', '3759', '2025-08-25 15:49:05', '2025-08-25 15:44:07', '2025-08-25 15:44:07'),
(17, NULL, 'sugejupruzu-6982@yopmail.com', '4616', '2025-08-25 15:49:17', '2025-08-25 15:44:19', '2025-08-25 15:44:19'),
(18, NULL, 'frussakommoigri-2922@yopmail.com', '1173', '2025-08-25 15:50:54', '2025-08-25 15:45:55', '2025-08-25 15:45:55'),
(19, NULL, 'frussakommoigri-2922@yopmail.com', '6770', '2025-08-25 15:50:54', '2025-08-25 15:45:55', '2025-08-25 15:45:55'),
(20, NULL, 'xeicracequaha-8868@yopmail.com', '4327', '2025-08-25 15:51:42', '2025-08-25 15:46:43', '2025-08-25 15:46:43'),
(21, NULL, 'xeicracequaha-8868@yopmail.com', '2334', '2025-08-25 15:51:42', '2025-08-25 15:46:43', '2025-08-25 15:46:43'),
(22, NULL, 'xeicracequaha-8868@yopmail.com', '8690', '2025-08-25 15:53:27', '2025-08-25 15:48:29', '2025-08-25 15:48:29'),
(23, NULL, 'bruruquogrevi-8168@yopmail.com', '7810', '2025-08-25 15:54:43', '2025-08-25 15:49:44', '2025-08-25 15:49:44'),
(24, NULL, 'pauttellayecri-4907@yopmail.com', '5948', '2025-08-25 15:58:26', '2025-08-25 15:53:27', '2025-08-25 15:53:27'),
(25, NULL, 'vuffixaunnesa-9141@yopmail.com', '5861', '2025-08-25 16:00:24', '2025-08-25 15:55:25', '2025-08-25 15:55:25'),
(26, NULL, 'vuffixaunnesa-9141@yopmail.com', '3461', '2025-08-25 16:00:24', '2025-08-25 15:55:26', '2025-08-25 15:55:26'),
(27, NULL, 'doigepribuprou-9841@yopmail.com', '1414', '2025-08-25 16:05:35', '2025-08-25 16:00:36', '2025-08-25 16:00:36'),
(28, NULL, 'doigepribuprou-9841@yopmail.com', '3713', '2025-08-25 16:14:11', '2025-08-25 16:09:12', '2025-08-25 16:09:12'),
(29, NULL, 'doigepribuprou-9841@yopmail.com', '2504', '2025-08-25 16:14:11', '2025-08-25 16:09:12', '2025-08-25 16:09:12'),
(30, NULL, 'bifrepecogrei-7014@yopmail.com', '4908', '2025-08-25 16:22:48', '2025-08-25 16:17:49', '2025-08-25 16:17:49'),
(31, NULL, 'bifrepecogrei-7014@yopmail.com', '9528', '2025-08-25 16:22:48', '2025-08-25 16:17:50', '2025-08-25 16:17:50'),
(32, NULL, 'frobaffillezoi-7645@yopmail.com', '9895', '2025-08-25 16:28:29', '2025-08-25 16:23:30', '2025-08-25 16:23:30'),
(33, NULL, 'frobaffillezoi-7645@yopmail.com', '4380', '2025-08-25 16:33:20', '2025-08-25 16:28:21', '2025-08-25 16:28:21'),
(34, NULL, 'gikoipreucrifrau-8247@yopmail.com', '9386', '2025-08-25 16:34:05', '2025-08-25 16:29:06', '2025-08-25 16:29:06'),
(35, NULL, 'gikoipreucrifrau-8247@yopmail.com', '6261', '2025-08-25 16:35:10', '2025-08-25 16:30:11', '2025-08-25 16:30:11'),
(36, NULL, 'gikoipreucrifrau-8247@yopmail.com', '1488', '2025-08-25 16:37:40', '2025-08-25 16:32:41', '2025-08-25 16:32:41'),
(37, NULL, 'copan56671@chaublog.com', '6488', '2025-08-27 15:25:18', '2025-08-27 15:20:20', '2025-08-27 15:20:20'),
(38, NULL, 'copan56671@chaublog.com', '9556', '2025-08-27 15:28:03', '2025-08-27 15:23:04', '2025-08-27 15:23:04'),
(39, NULL, 'neuttauproutrapu-2160@yopmail.com', '5465', '2025-08-27 15:29:29', '2025-08-27 15:24:30', '2025-08-27 15:24:30'),
(40, NULL, 'neuttauproutrapu-2160@yopmail.com', '6472', '2025-08-27 15:29:54', '2025-08-27 15:24:55', '2025-08-27 15:24:55'),
(41, NULL, 'liyibrabreide-8640@yopmail.com', '6123', '2025-08-27 15:59:14', '2025-08-27 15:54:15', '2025-08-27 15:54:15'),
(42, NULL, 'atulvesu@gmail.com', '8346', '2025-08-27 16:54:24', '2025-08-27 16:49:25', '2025-08-27 16:49:25'),
(43, NULL, 'atulvesu@gmail.com', '8406', '2025-08-27 16:54:38', '2025-08-27 16:49:39', '2025-08-27 16:49:39'),
(44, NULL, 'atulvesu@gmail.com', '6425', '2025-08-27 17:06:12', '2025-08-27 17:01:14', '2025-08-27 17:01:14'),
(45, NULL, 'atulvesu@gmail.com', '3536', '2025-08-27 17:09:38', '2025-08-27 17:04:39', '2025-08-27 17:04:39'),
(46, NULL, 'atulvesu@gmail.com', '5715', '2025-08-27 17:09:56', '2025-08-27 17:04:57', '2025-08-27 17:04:57'),
(47, NULL, 'atulvesu@gmail.com', '1293', '2025-08-27 17:14:47', '2025-08-27 17:09:49', '2025-08-27 17:09:49'),
(48, NULL, 'liyibrabreide-8640@yopmail.com', '8621', '2025-08-27 17:16:01', '2025-08-27 17:11:02', '2025-08-27 17:11:02'),
(49, NULL, 'liyibrabreide-8640@yopmail.com', '3209', '2025-08-27 17:25:09', '2025-08-27 17:20:11', '2025-08-27 17:20:11'),
(50, NULL, 'liyibrabreide-8640@yopmail.com', '6731', '2025-08-27 17:28:05', '2025-08-27 17:23:07', '2025-08-27 17:23:07'),
(51, NULL, 'copan56671@chaublog.com', '2271', '2025-08-27 17:28:46', '2025-08-27 17:23:47', '2025-08-27 17:23:47'),
(52, NULL, 'rajix64115@cavoyar.com', '4461', '2025-08-29 18:35:45', '2025-08-29 18:30:47', '2025-08-29 18:30:47'),
(53, NULL, 'rajix64115@cavoyar.com', '9060', '2025-08-29 19:01:39', '2025-08-29 18:56:40', '2025-08-29 18:56:40'),
(54, NULL, 'zeitrubaubragra-4995@yopmail.com', '5485', '2025-08-29 19:36:11', '2025-08-29 19:31:12', '2025-08-29 19:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vivekbcagcg@gmail.com', '1111', '2025-04-28 23:58:29'),
('admin@admin.com', '1111', '2025-05-01 03:51:33'),
('kalu@gmail.com', '4767', '2025-05-02 04:35:42'),
('tiwari1998r@gmail.com', '8756', '2025-07-22 11:06:37'),
('user@bublee.me', '1461', '2025-09-09 04:04:31'),
('atulvesu@gmail.com', '9966', '2025-08-27 16:49:20'),
('geupautrobrupou-1316@yopmail.com', '6347', '2025-08-27 17:33:14'),
('lanoudejade-3270@yopmail.com', '3315', '2025-08-30 13:13:22'),
('copan56671@chaublog.com', '4523', '2025-08-30 11:53:00'),
('xubreppopeidi-7096@yopmail.com', '7991', '2025-08-30 12:24:02'),
('cokah22985@lespedia.com', '3865', '2025-08-30 12:20:37'),
('cifidor739@mogash.com', '1268', '2025-08-30 12:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(3, 'App\\Models\\User', 1, 'auth_token', '9fa59b736746013a1da397fea39ab4f7b8a01dbf24f2158e1a31d9da4d908994', '[\"*\"]', NULL, '2025-04-07 20:58:15', '2025-04-07 20:58:15', NULL),
(4, 'App\\Models\\User', 1, 'auth_token', '1467ebec900c2bd5409fa482ac013f737df90497d6f866d5a83448828c1f01da', '[\"*\"]', NULL, '2025-04-10 00:14:44', '2025-04-10 00:14:44', NULL),
(5, 'App\\Models\\User', 1, 'auth_token', 'f144b770eeb50032cf6ca3872ab851979e5b04fe95d2783d7dda4ecf2ced3cdc', '[\"*\"]', NULL, '2025-04-22 13:06:06', '2025-04-22 13:06:06', NULL),
(6, 'App\\Models\\User', 1, 'auth_token', '755b57fbbaea4a8d805736c6d0ae07953cde66cec7896f3a1cf010224cbf8057', '[\"*\"]', NULL, '2025-04-24 06:44:41', '2025-04-24 06:44:41', NULL),
(7, 'App\\Models\\User', 2, 'auth_token', 'ab0f07aec02895bfbd3c9e0be944ac53ef8750064d6a0a3c087ddd107041d7c2', '[\"*\"]', NULL, '2025-04-24 07:02:52', '2025-04-24 07:02:52', NULL),
(8, 'App\\Models\\User', 2, 'auth_token', '35d3cd6477a45dc1b385f2191b880a3819f0a8ae41b518adbbf5a292f3ae9ded', '[\"*\"]', NULL, '2025-04-24 07:03:29', '2025-04-24 07:03:29', NULL),
(9, 'App\\Models\\User', 2, 'auth_token', 'd4d61919807b07197ab6659d7518eeccbf93fef04ed66df4cfd4c7be4882702d', '[\"*\"]', NULL, '2025-04-24 07:03:52', '2025-04-24 07:03:52', NULL),
(10, 'App\\Models\\User', 2, 'auth_token', '39d754c41ca1739c8a6efdf3db2df83b8d20c26a5685abb8b2af9109514f240f', '[\"*\"]', NULL, '2025-04-24 07:04:54', '2025-04-24 07:04:54', NULL),
(11, 'App\\Models\\User', 2, 'auth_token', 'f72ddc8688e708039cab2b2d3b70b3e0ff6738c1d9c6599fb7773d98bf6abc2f', '[\"*\"]', NULL, '2025-04-24 07:07:14', '2025-04-24 07:07:14', NULL),
(12, 'App\\Models\\User', 2, 'auth_token', '1d686785c6a3327dc09eda83f57c1eff91797965137c1f919a9ecb06ca92afb8', '[\"*\"]', NULL, '2025-04-24 07:08:33', '2025-04-24 07:08:33', NULL),
(13, 'App\\Models\\User', 2, 'auth_token', '61a98bc593c277aaa7148fdcd89afc0943ebb9190e26cf3b5fcbe1497c7b85e1', '[\"*\"]', NULL, '2025-04-24 07:16:02', '2025-04-24 07:16:02', NULL),
(14, 'App\\Models\\User', 1, 'auth_token', 'f83a929bb591d514559c02b40df37e9d5195ff7ea3574d783297446c1aaee9e6', '[\"*\"]', NULL, '2025-04-28 13:02:27', '2025-04-28 13:02:27', NULL),
(15, 'App\\Models\\User', 3, 'auth_token', 'f4590cf481b42c43ad1330f2284a2e68384fa582bf7813bf8ae7582d894fa4f0', '[\"*\"]', NULL, '2025-04-28 13:47:37', '2025-04-28 13:47:37', NULL),
(16, 'App\\Models\\User', 1, 'auth_token', '24ad11cadd126b81853490795a4e4ce317c86e79eab47f830fb379762d8db7a1', '[\"*\"]', NULL, '2025-04-28 23:28:07', '2025-04-28 23:28:07', NULL),
(17, 'App\\Models\\User', 4, 'auth_token', '0cae160ed744fe11bb775a520c3d7786533d68db4b2b3de34ca691d85c9e6ae2', '[\"*\"]', NULL, '2025-04-29 01:21:49', '2025-04-29 01:21:49', NULL),
(18, 'App\\Models\\User', 5, 'auth_token', '8d32022c6a771cdcab99a987c4d0d5d2aa722041790687c5ea77052a9068902f', '[\"*\"]', NULL, '2025-04-29 01:23:27', '2025-04-29 01:23:27', NULL),
(19, 'App\\Models\\User', 6, 'auth_token', '50a9dc9af8961d9cbb979706169ab4988ee1cf26560c6d3239db74f34932f601', '[\"*\"]', NULL, '2025-05-01 12:40:54', '2025-05-01 12:40:54', NULL),
(20, 'App\\Models\\User', 6, 'auth_token', 'eb2effd90af755492f16b063da57b80da9f44e9f33c64bf8c5b29b40f525493b', '[\"*\"]', NULL, '2025-05-01 12:41:27', '2025-05-01 12:41:27', NULL),
(21, 'App\\Models\\User', 7, 'auth_token', '73a64fd3b97d127896635f21f0ee3175ff415be888a05f1812dbedd877c53159', '[\"*\"]', NULL, '2025-05-01 15:03:24', '2025-05-01 15:03:24', NULL),
(23, 'App\\Models\\User', 1, 'auth_token', 'd992625e0fbb6f9ec2153cded597f3c59df1ea3767169c162b6717a416089ee5', '[\"*\"]', NULL, '2025-05-02 00:04:50', '2025-05-02 00:04:50', NULL),
(24, 'App\\Models\\User', 1, 'auth_token', '0dac28ba1d19838fa2f9f3a548b847c4a609e8c9b9dd710a23fe267d956abfa0', '[\"*\"]', NULL, '2025-05-02 00:04:57', '2025-05-02 00:04:57', NULL),
(25, 'App\\Models\\User', 1, 'auth_token', '722d92d66ead869d854e57675f1c6fb8afc1d89e381abaab95a181e3cf358b7c', '[\"*\"]', NULL, '2025-05-02 00:05:23', '2025-05-02 00:05:23', NULL),
(35, 'App\\Models\\User', 9, 'auth_token', '8c22d4f1780c564ea43825aeb58ec049702914f861d0fe7640b7da34c49afde3', '[\"*\"]', NULL, '2025-05-02 03:19:34', '2025-05-02 03:19:34', NULL),
(36, 'App\\Models\\User', 9, 'auth_token', 'e4fa93b3b78cb033d85e752bf2d83c0bc704e884584533890c75524ad1dcd4ea', '[\"*\"]', NULL, '2025-05-02 03:22:02', '2025-05-02 03:22:02', NULL),
(42, 'App\\Models\\User', 10, 'auth_token', '08ba57fb00b295b196d26eb8927b25e9ce65a2ae0e52e6021296ebfcea47ba37', '[\"*\"]', NULL, '2025-05-02 03:57:14', '2025-05-02 03:57:14', NULL),
(43, 'App\\Models\\User', 10, 'auth_token', '7f6ea126884718cfe67de68134e953f427415c4dae0ee1848d9fc8cb6d1590fc', '[\"*\"]', NULL, '2025-05-02 03:57:49', '2025-05-02 03:57:49', NULL),
(44, 'App\\Models\\User', 10, 'auth_token', '9bf957b72f84a89c4998249cb99ca927f3ba8f246dc6d22b1043b1be9f6c5108', '[\"*\"]', NULL, '2025-05-02 04:01:47', '2025-05-02 04:01:47', NULL),
(45, 'App\\Models\\User', 11, 'auth_token', '1949f24035f182df92e9e3aec7384030564995560947088e97a303c679a5ece9', '[\"*\"]', NULL, '2025-05-02 04:04:14', '2025-05-02 04:04:14', NULL),
(46, 'App\\Models\\User', 12, 'auth_token', '2004ba837249945a22cb0cfca4e7ad5486e4bc942ffd7252c7055ef788dc9273', '[\"*\"]', NULL, '2025-05-02 04:07:15', '2025-05-02 04:07:15', NULL),
(47, 'App\\Models\\User', 12, 'auth_token', '72e85c80601a847dc78b7c1a7e52f0cdbfd8298403fc0cc6e2c89b7438f94a2d', '[\"*\"]', NULL, '2025-05-02 04:07:56', '2025-05-02 04:07:56', NULL),
(48, 'App\\Models\\User', 12, 'auth_token', 'f147a83ba939624a46cb9da413698b2b39cade4f492af8e5eb0bcdae16751b02', '[\"*\"]', NULL, '2025-05-02 04:09:06', '2025-05-02 04:09:06', NULL),
(50, 'App\\Models\\User', 12, 'auth_token', '03fed8fbb4812b4151a711baff0e0412275eb51d0c91b686e905614a1578d7b6', '[\"*\"]', NULL, '2025-05-02 04:21:35', '2025-05-02 04:21:35', NULL),
(51, 'App\\Models\\User', 13, 'auth_token', 'bebc7c846c72bfc8fd2eac09819053df83f371e47c0a8f2821778907f8706861', '[\"*\"]', NULL, '2025-05-02 04:22:10', '2025-05-02 04:22:10', NULL),
(52, 'App\\Models\\User', 13, 'auth_token', '32e99706ea63f624cd4ac3b5b11fa82667ded05cf219d5e7bdc721ba2adf5dea', '[\"*\"]', NULL, '2025-05-02 04:22:56', '2025-05-02 04:22:56', NULL),
(53, 'App\\Models\\User', 13, 'auth_token', '88828589576d5045fb4af4c6671ea352643df10d2d00cb36951be196a3301a2f', '[\"*\"]', NULL, '2025-05-02 04:23:58', '2025-05-02 04:23:58', NULL),
(54, 'App\\Models\\User', 2, 'auth_token', '460f6c0440e9f5bbeb0b3df841e9f9fdce94832566e26b31c2556cb6ec888241', '[\"*\"]', NULL, '2025-05-03 06:11:13', '2025-05-03 06:11:13', NULL),
(55, 'App\\Models\\User', 9, 'auth_token', '5b0ae940b83bdeee7043c85d7379450612c078192e635f1ae65beadb1f4913a4', '[\"*\"]', NULL, '2025-05-03 06:31:41', '2025-05-03 06:31:41', NULL),
(56, 'App\\Models\\User', 9, 'auth_token', '803572b6d626c434a5e5f59c6f7b81f9def2bcee956020703b366a6846297000', '[\"*\"]', NULL, '2025-05-03 06:33:12', '2025-05-03 06:33:12', NULL),
(57, 'App\\Models\\User', 9, 'auth_token', '9805372122e2609abc8dc24cc999f37b4886d604eb1a432ee0e1598f46638f2b', '[\"*\"]', NULL, '2025-05-03 06:41:54', '2025-05-03 06:41:54', NULL),
(58, 'App\\Models\\User', 14, 'auth_token', '754db57f4e310981fd307faa6e7b4a9712a65812aff9731424ed5261eec5345c', '[\"*\"]', NULL, '2025-05-03 06:43:48', '2025-05-03 06:43:48', NULL),
(59, 'App\\Models\\User', 2, 'auth_token', '8d6beec7a267c6c595f49b594d2b8bd3522c91ddb490af24910b5def2da4ae46', '[\"*\"]', NULL, '2025-05-03 06:48:50', '2025-05-03 06:48:50', NULL),
(60, 'App\\Models\\User', 14, 'auth_token', '6c444e0a033967e9735442d1f01a46ccdafd075f75a40ada72d40d1d25cdf3fc', '[\"*\"]', NULL, '2025-05-03 06:57:00', '2025-05-03 06:57:00', NULL),
(61, 'App\\Models\\User', 14, 'auth_token', '2863688b7921dc63087ed8c46b262bcd428e9d161cef101bbbe8e075609d7f05', '[\"*\"]', NULL, '2025-05-03 07:20:54', '2025-05-03 07:20:54', NULL),
(62, 'App\\Models\\User', 14, 'auth_token', '4085487ca7cc1dbbec16ad36f1ffe4ab9539985d1eb7b016c0401d5e4814a2cf', '[\"*\"]', NULL, '2025-05-03 07:23:03', '2025-05-03 07:23:03', NULL),
(63, 'App\\Models\\User', 14, 'auth_token', '728201a4e7276029ac5deb040062b05701e179602a181b85b1b92bfe6207993b', '[\"*\"]', NULL, '2025-05-03 07:24:37', '2025-05-03 07:24:37', NULL),
(64, 'App\\Models\\User', 14, 'auth_token', '80b096c775008e1d35c0e8ad38eae3bf3e59c69dfb6253437c1f648dd1b449a6', '[\"*\"]', NULL, '2025-05-03 07:26:35', '2025-05-03 07:26:35', NULL),
(75, 'App\\Models\\User', 18, 'auth_token', '02f1598dc8ddac197024abf456ee7e918b10661eba489db05b19b9b3a0d53965', '[\"*\"]', NULL, '2025-05-03 13:59:15', '2025-05-03 13:59:15', NULL),
(76, 'App\\Models\\User', 18, 'auth_token', '718907ec3ca11a0a9ed6c8bb7edaaf066b8e58608321d5c547e33396defc29d2', '[\"*\"]', NULL, '2025-05-03 14:02:12', '2025-05-03 14:02:12', NULL),
(77, 'App\\Models\\User', 18, 'auth_token', 'e1bd4b98e6401dfe835534298238cde989c339a93336e9271141d779994986e3', '[\"*\"]', NULL, '2025-05-03 14:03:15', '2025-05-03 14:03:15', NULL),
(78, 'App\\Models\\User', 18, 'auth_token', 'c936a97d80057ce7ddec0b624c3ec9d08fcba278652af5a69455464ddae927ca', '[\"*\"]', NULL, '2025-05-05 01:03:24', '2025-05-05 01:03:24', NULL),
(79, 'App\\Models\\User', 19, 'auth_token', '005d6c827b73e6dd38d3c2e3cac4a161ee1b7ea62e88bfbcd6d64de3fb1fc0d9', '[\"*\"]', NULL, '2025-05-05 01:08:38', '2025-05-05 01:08:38', NULL),
(80, 'App\\Models\\User', 2, 'auth_token', '3c0d0fc4c383313e68efdf3d496b7d85e77105fa0c83895c5369f2b9229a023e', '[\"*\"]', NULL, '2025-05-05 01:14:02', '2025-05-05 01:14:02', NULL),
(81, 'App\\Models\\User', 19, 'auth_token', 'd8ca350554188d1723918fda0108732af167756c4edb47b0f2a5fe8626d3dbfd', '[\"*\"]', NULL, '2025-05-05 01:16:22', '2025-05-05 01:16:22', NULL),
(82, 'App\\Models\\User', 19, 'auth_token', 'ce5af1604cc1125981be4723e2c04bbe06c9175d7ce2935abdefbd271b6b5fd9', '[\"*\"]', NULL, '2025-05-05 01:21:36', '2025-05-05 01:21:36', NULL),
(83, 'App\\Models\\User', 19, 'auth_token', '3e5a1c49cdd870323d7858a911d62f64617a273f32f8df953d46f4d147eccf68', '[\"*\"]', NULL, '2025-05-05 01:24:05', '2025-05-05 01:24:05', NULL),
(84, 'App\\Models\\User', 19, 'auth_token', '06c5af0c13bab88eafee8ea274864ec3117c843350833ee97ff35dca12d0c171', '[\"*\"]', NULL, '2025-05-05 03:19:03', '2025-05-05 03:19:03', NULL),
(85, 'App\\Models\\User', 19, 'auth_token', '500461c31ddda531dcc6ce5cc197d38e1e29bc3e33a5c07156059312d3875fbc', '[\"*\"]', NULL, '2025-05-05 03:25:26', '2025-05-05 03:25:26', NULL),
(86, 'App\\Models\\User', 20, 'auth_token', 'c1589b0ace3fd3a7c8d20702961ebad3c70e1e523bb98516a0ef46d619135c41', '[\"*\"]', NULL, '2025-05-05 21:09:05', '2025-05-05 21:09:05', NULL),
(87, 'App\\Models\\User', 21, 'auth_token', '19ac6915e8d1d54042d6b4559573b132f40ab487b0cb1b41463e000e1ba240fa', '[\"*\"]', NULL, '2025-05-20 16:47:16', '2025-05-20 16:47:16', NULL),
(88, 'App\\Models\\User', 22, 'auth_token', '1d2267c6c85110f1e3f5a3c20ada1928e7482ddaa373700c18c12656abe9175b', '[\"*\"]', NULL, '2025-05-20 16:50:20', '2025-05-20 16:50:20', NULL),
(89, 'App\\Models\\User', 23, 'auth_token', '984f517ec1a60eb797379ab55082b502c6498489cc60e5922b3beb56b5abcbad', '[\"*\"]', '2025-05-24 07:19:46', '2025-05-22 22:16:31', '2025-05-24 07:19:46', NULL),
(90, 'App\\Models\\User', 18, 'auth_token', '5f3b5036434166aca42892d1aa671a11c3296850d17c0e72219344a316bd8020', '[\"*\"]', NULL, '2025-05-23 03:14:35', '2025-05-23 03:14:35', NULL),
(91, 'App\\Models\\User', 18, 'auth_token', '9a64e385634b74f49a3dc51cfd04cbfa9dd4e73d69ed91ba22dfce967f2bbd6b', '[\"*\"]', '2025-05-24 07:01:12', '2025-05-23 03:24:35', '2025-05-24 07:01:12', NULL),
(92, 'App\\Models\\User', 18, 'auth_token', '910e1194ea1c2c0b2ea0ecf6fa000ec5b9a803c0e479e24b1d4fd38d12b68519', '[\"*\"]', NULL, '2025-05-23 14:35:32', '2025-05-23 14:35:32', NULL),
(93, 'App\\Models\\User', 24, 'auth_token', '1f305bccdc2f4a8730ba4033298b2e67b2e65374850c056bda616e8bc9a97145', '[\"*\"]', NULL, '2025-05-23 14:36:19', '2025-05-23 14:36:19', NULL),
(94, 'App\\Models\\User', 24, 'auth_token', '2adb229051ce021e207fabe4c13cea9c5134d0a24821eee337f6618b68bf88b1', '[\"*\"]', NULL, '2025-05-23 14:42:45', '2025-05-23 14:42:45', NULL),
(95, 'App\\Models\\User', 24, 'auth_token', '2221af5eb3e0f170e3178a9bcb0fd9b19253701b12ff184277e8bf3c8e53efc6', '[\"*\"]', NULL, '2025-05-23 15:03:10', '2025-05-23 15:03:10', NULL),
(96, 'App\\Models\\User', 18, 'auth_token', '0bbf19f6c1d0c5fdda86e930f95e260286820f5145d2074efd199d5026d5b730', '[\"*\"]', '2025-05-23 16:17:39', '2025-05-23 15:51:15', '2025-05-23 16:17:39', NULL),
(97, 'App\\Models\\User', 18, 'auth_token', 'd9ace9e78e380ed9fbd32959db3a5554cdfb3ab08e282780657b2c14b724473a', '[\"*\"]', '2025-05-24 09:58:33', '2025-05-24 05:07:06', '2025-05-24 09:58:33', NULL),
(98, 'App\\Models\\User', 25, 'auth_token', '08423136530dfa5522d0540f73310eb7c2c00f49aae86ca0228eb3359bf20d0e', '[\"*\"]', NULL, '2025-05-24 10:09:04', '2025-05-24 10:09:04', NULL),
(99, 'App\\Models\\User', 25, 'auth_token', 'e8441cf6a33a25999cfb2b912c78ecc3c83f748066c70f5d01c7fdba3913e90f', '[\"*\"]', '2025-05-24 10:18:00', '2025-05-24 10:11:59', '2025-05-24 10:18:00', NULL),
(100, 'App\\Models\\User', 25, 'auth_token', '69010a2e3010d336d84b62e2f90ef3ae979cb30de748d8f93af4884b28f4849d', '[\"*\"]', '2025-05-24 10:30:58', '2025-05-24 10:30:49', '2025-05-24 10:30:58', NULL),
(101, 'App\\Models\\User', 26, 'auth_token', 'bc75ae5f76c052dcb3381b545880b104f2bd1d42789abf4a2442b033d2579b9a', '[\"*\"]', NULL, '2025-05-24 10:32:45', '2025-05-24 10:32:45', NULL),
(102, 'App\\Models\\User', 25, 'auth_token', 'ceae6f890b38b411eb6f68954a7643116a00d04f8e45fea6fd32031c5a877d12', '[\"*\"]', '2025-05-24 15:49:37', '2025-05-24 10:33:17', '2025-05-24 15:49:37', NULL),
(103, 'App\\Models\\User', 26, 'auth_token', '40fc27ed202b324bab70e9fc2707998c9d8de89327c78623a31887aeb6a69629', '[\"*\"]', '2025-05-24 16:15:29', '2025-05-24 10:36:42', '2025-05-24 16:15:29', NULL),
(104, 'App\\Models\\User', 25, 'auth_token', '8ac7dd0ccdb777189215c5a3f3d3794648c3587729c2c2347783d44bf1461a6b', '[\"*\"]', '2025-05-24 11:04:14', '2025-05-24 10:57:43', '2025-05-24 11:04:14', NULL),
(105, 'App\\Models\\User', 25, 'auth_token', 'e232c019ee51db2c5dc5391336fdf59805af3c46e5404acaf5a69eca1cb8eded', '[\"*\"]', '2025-05-31 13:47:21', '2025-05-24 10:59:46', '2025-05-31 13:47:21', NULL),
(106, 'App\\Models\\User', 25, 'auth_token', '59fb9d45fa9eb412814822555e594a445a5d2d32f99ec71d92d3265ce649913a', '[\"*\"]', '2025-05-24 11:49:57', '2025-05-24 11:28:07', '2025-05-24 11:49:57', NULL),
(107, 'App\\Models\\User', 25, 'auth_token', 'b9afe6b8fa43309eaf03fec62f53c04f707207f9680a18e26e249899a08021ee', '[\"*\"]', '2025-05-24 16:33:12', '2025-05-24 15:11:01', '2025-05-24 16:33:12', NULL),
(108, 'App\\Models\\User', 25, 'auth_token', '0e7d99117f65d66ef2674ce616d18c88d54f6c4d44bb1da7f95f4d30b91fb9b8', '[\"*\"]', '2025-05-24 15:47:51', '2025-05-24 15:18:00', '2025-05-24 15:47:51', NULL),
(109, 'App\\Models\\User', 37, 'auth_token', '8a7bdcf0e9f5db64772e09515058921a75957f2ce9f69f04379e38bcdd429979', '[\"*\"]', NULL, '2025-05-24 16:06:51', '2025-05-24 16:06:51', NULL),
(110, 'App\\Models\\User', 37, 'auth_token', 'c926fe9cb21db088406c2cd36eb20a2d8dad8742920240bb4b1ea2fe4329186a', '[\"*\"]', '2025-05-24 16:12:40', '2025-05-24 16:12:32', '2025-05-24 16:12:40', NULL),
(111, 'App\\Models\\User', 25, 'auth_token', '45332a25f5cf7c7304f7686e9e9a0c474830e08b5b34f1168d5e6b33cb486390', '[\"*\"]', '2025-05-27 14:58:14', '2025-05-24 16:13:55', '2025-05-27 14:58:14', NULL),
(112, 'App\\Models\\User', 57, 'auth_token', 'c89239c3af3187fed903d8e195ea0b4b9fd60eb6a12981cabd61db9d16d642fa', '[\"*\"]', NULL, '2025-05-27 10:58:20', '2025-05-27 10:58:20', NULL),
(113, 'App\\Models\\User', 58, 'auth_token', '72346258b60c253227e1bd59a21b7e0dcedcd0f9ca6d3bb200d4318af4425b74', '[\"*\"]', NULL, '2025-05-27 11:03:47', '2025-05-27 11:03:47', NULL),
(114, 'App\\Models\\User', 60, 'auth_token', 'da5aa807ea36563bbc66a422f052189a5c92583c753f21c4004d2339934f9b4e', '[\"*\"]', NULL, '2025-05-27 11:06:06', '2025-05-27 11:06:06', NULL),
(115, 'App\\Models\\User', 61, 'auth_token', '96aca0cc9f57ea5a75e27d42e84d74cf80c6ebed1271b51bc720fdc836c00198', '[\"*\"]', NULL, '2025-05-27 11:07:10', '2025-05-27 11:07:10', NULL),
(116, 'App\\Models\\User', 62, 'auth_token', '9576047ac2e9e0ed4830e94ed7b6b2917a1da5b79b8805a7c95d6b3cb1b5bad2', '[\"*\"]', NULL, '2025-05-27 11:14:25', '2025-05-27 11:14:25', NULL),
(117, 'App\\Models\\User', 62, 'auth_token', 'e4db8e19d1e54228236b5446eb2c7b965f71ab3e61a52a745947fa7078704ad8', '[\"*\"]', NULL, '2025-05-27 11:23:22', '2025-05-27 11:23:22', NULL),
(118, 'App\\Models\\User', 25, 'auth_token', '3a971ea563cd8de434e94bdde512df1e800d583d4dd0a7239557e09a042f66ea', '[\"*\"]', '2025-05-27 15:56:43', '2025-05-27 15:08:24', '2025-05-27 15:56:43', NULL),
(119, 'App\\Models\\User', 25, 'auth_token', 'ce6f7e6deebdcbddf2fe1090a2dc46c56c082141883e5e67895cec339a303c1a', '[\"*\"]', '2025-05-28 14:45:26', '2025-05-28 14:45:06', '2025-05-28 14:45:26', NULL),
(120, 'App\\Models\\User', 25, 'auth_token', 'e1f19e51a86f41fdc4a6fc1f2619a063cd7c957b6405be1dfee7276c2164f32b', '[\"*\"]', '2025-05-28 14:52:13', '2025-05-28 14:46:15', '2025-05-28 14:52:13', NULL),
(121, 'App\\Models\\User', 25, 'auth_token', '570bfcbd12209978b4b9d6b6161a8c29c8ede9fceca8a8f3fea22520ce3df5e9', '[\"*\"]', '2025-05-29 08:12:22', '2025-05-29 08:11:18', '2025-05-29 08:12:22', NULL),
(122, 'App\\Models\\User', 25, 'auth_token', '53e638eb7a8002ecdf011bed7ed72af475ba0309c08cff861edfa5d60bcdc089', '[\"*\"]', '2025-05-29 14:53:42', '2025-05-29 12:38:11', '2025-05-29 14:53:42', NULL),
(123, 'App\\Models\\User', 25, 'auth_token', 'a8def1c5b8634cddc89c92761cb894e23afd7996697a1256a94cc28f1fd3172d', '[\"*\"]', '2025-05-29 15:16:00', '2025-05-29 15:11:52', '2025-05-29 15:16:00', NULL),
(124, 'App\\Models\\User', 25, 'auth_token', '57d110dfecfe91fd438ce8953f0039fe55d4841c938b006ba42d8bcf77d8660c', '[\"*\"]', NULL, '2025-05-29 15:15:18', '2025-05-29 15:15:18', NULL),
(125, 'App\\Models\\User', 25, 'auth_token', '4037b2ff01c13ebddf99fb2c55d92dba893b9d21fd818dd2f85e2c996bf42565', '[\"*\"]', '2025-05-29 17:01:08', '2025-05-29 16:10:46', '2025-05-29 17:01:08', NULL),
(126, 'App\\Models\\User', 25, 'auth_token', 'a4ee39b89c379b638be95034cf7dbc35a6eaa466eadc656ec56c244a1bc7dc04', '[\"*\"]', '2025-05-29 17:31:14', '2025-05-29 16:26:21', '2025-05-29 17:31:14', NULL),
(127, 'App\\Models\\User', 63, 'auth_token', 'e63e86bbb880cb518250a02f1534bddbd56af620ec8ee50565d9c6de93da7ddc', '[\"*\"]', '2025-05-29 17:14:20', '2025-05-29 17:14:17', '2025-05-29 17:14:20', NULL),
(128, 'App\\Models\\User', 63, 'auth_token', '4f781fca43948c4e97248ffd99896dc6eb91336a2ff095cae1767d1c251bab74', '[\"*\"]', NULL, '2025-05-29 17:14:37', '2025-05-29 17:14:37', NULL),
(129, 'App\\Models\\User', 63, 'auth_token', '0a9368efe961a15d32bf624564c90f8df31199266f45ea50e7b053a5b0d63132', '[\"*\"]', NULL, '2025-05-29 17:15:11', '2025-05-29 17:15:11', NULL),
(130, 'App\\Models\\User', 63, 'auth_token', '81b0d9c741f17943fe0decc5d6cf9538822e4c47a864d77b6d9add503f6b150b', '[\"*\"]', '2025-05-29 17:18:06', '2025-05-29 17:17:52', '2025-05-29 17:18:06', NULL),
(131, 'App\\Models\\User', 25, 'auth_token', '7a07a41fb12d2396bdd0123cad0ae68e9e5b24b543d4ef8dbca84e9e08fd4005', '[\"*\"]', '2025-05-29 17:18:57', '2025-05-29 17:18:38', '2025-05-29 17:18:57', NULL),
(132, 'App\\Models\\User', 63, 'auth_token', '175b204a12b07afa35784fbf1185acf30046cfd137649bba05bbcc48509dc0f0', '[\"*\"]', '2025-05-29 17:21:03', '2025-05-29 17:21:01', '2025-05-29 17:21:03', NULL),
(133, 'App\\Models\\User', 63, 'auth_token', 'de416c1dd36e8ef11ec3eef13e63fda14ddae5dd7231ded13cffef17a7da5da3', '[\"*\"]', '2025-05-29 17:22:29', '2025-05-29 17:22:27', '2025-05-29 17:22:29', NULL),
(134, 'App\\Models\\User', 63, 'auth_token', '6fade0347f0e108ee99b22ae99590a1ac9aa47a2422c082a1310dd3391cbbc90', '[\"*\"]', '2025-05-29 17:25:24', '2025-05-29 17:25:22', '2025-05-29 17:25:24', NULL),
(135, 'App\\Models\\User', 63, 'auth_token', '03952f176d04cfdad0b6a1256593bc36189f16bf862a1b4e3aa3efc968e3149c', '[\"*\"]', '2025-05-29 17:36:14', '2025-05-29 17:35:42', '2025-05-29 17:36:14', NULL),
(136, 'App\\Models\\User', 63, 'auth_token', 'b30847dfed9a2fd37cb5ef4e3bef6410f23daebdd32c6dfa6bf3dc178f99f80b', '[\"*\"]', '2025-05-29 17:47:45', '2025-05-29 17:47:43', '2025-05-29 17:47:45', NULL),
(137, 'App\\Models\\User', 25, 'auth_token', '547e3d57e4b95a2dfe1a17f13a13576520e3005c283e633dc7f0eaded11f2758', '[\"*\"]', '2025-05-29 17:50:13', '2025-05-29 17:50:11', '2025-05-29 17:50:13', NULL),
(138, 'App\\Models\\User', 63, 'auth_token', '419ca3cbf20526c9723e3f02fe9005dcaf0d25f763deab374eea728ed1fea390', '[\"*\"]', '2025-05-29 17:50:26', '2025-05-29 17:50:24', '2025-05-29 17:50:26', NULL),
(139, 'App\\Models\\User', 25, 'auth_token', '7f9349e3a7b0472694c6c2425f4f64731bb797ce6ad84c6c5b26d8816c5eaf36', '[\"*\"]', '2025-05-29 17:50:54', '2025-05-29 17:50:52', '2025-05-29 17:50:54', NULL),
(140, 'App\\Models\\User', 63, 'auth_token', '09ed18edc88e0ad285acfd7980b1a3dd3d7cedc7f625c1f0cc3d96b4bcf7ef50', '[\"*\"]', '2025-05-29 17:51:09', '2025-05-29 17:51:08', '2025-05-29 17:51:09', NULL),
(141, 'App\\Models\\User', 25, 'auth_token', '56ce0e8f25998143ed71a86248f6c7bb415d6dbaca3485a5d8e2c0b4502a50c1', '[\"*\"]', '2025-05-29 17:51:34', '2025-05-29 17:51:32', '2025-05-29 17:51:34', NULL),
(142, 'App\\Models\\User', 25, 'auth_token', 'cf83c13a57bc7f22c62fa27305c04a9c2c889e1f9aca8d36105933f13424586d', '[\"*\"]', '2025-05-29 17:53:03', '2025-05-29 17:53:01', '2025-05-29 17:53:03', NULL),
(143, 'App\\Models\\User', 25, 'auth_token', '6337855e14f542ae71b0711f7d2662c45d1a08d985064b59013d3793091cd0e7', '[\"*\"]', '2025-05-29 17:53:28', '2025-05-29 17:53:26', '2025-05-29 17:53:28', NULL),
(144, 'App\\Models\\User', 25, 'auth_token', '80c4207b1759e42140fb07ac8f9d198c496af2388afcfba5e25792a35230e0a9', '[\"*\"]', '2025-05-29 18:15:54', '2025-05-29 17:55:20', '2025-05-29 18:15:54', NULL),
(145, 'App\\Models\\User', 63, 'auth_token', '5f5a77e627185569902f310b43ca1c95dc1a0739d6f2ddeb0bd1ed8984d7229c', '[\"*\"]', '2025-05-29 18:42:49', '2025-05-29 18:16:15', '2025-05-29 18:42:49', NULL),
(146, 'App\\Models\\User', 26, 'auth_token', 'a342dfd9d508c8fd497adaedb1327546c203d8da34a922fc25e5fe59c023cc15', '[\"*\"]', '2025-05-29 18:19:35', '2025-05-29 18:18:18', '2025-05-29 18:19:35', NULL),
(147, 'App\\Models\\User', 64, 'auth_token', '1d8480cdfcf2346f54ee97cc08dd7944566739dafcf09ef493bf1340fe3936e3', '[\"*\"]', NULL, '2025-05-30 04:59:35', '2025-05-30 04:59:35', NULL),
(148, 'App\\Models\\User', 64, 'auth_token', '5d5fb8577fc4278492e41f98c527e1d4cb8583e93c7dfacbbd73ae11bb3c6097', '[\"*\"]', '2025-05-30 05:06:38', '2025-05-30 05:04:10', '2025-05-30 05:06:38', NULL),
(149, 'App\\Models\\User', 25, 'auth_token', 'de8ce6eda1209553938daa0bd7c78f29519f13bf99f8346dd4f81ccbc687414c', '[\"*\"]', '2025-05-31 16:25:35', '2025-05-30 16:10:27', '2025-05-31 16:25:35', NULL),
(150, 'App\\Models\\User', 25, 'auth_token', 'b1b5172ce428a6857ed1821d3e0ddfe425ff489bcb21d006c390b36d262d3dbb', '[\"*\"]', '2025-05-31 05:02:51', '2025-05-31 05:02:28', '2025-05-31 05:02:51', NULL),
(151, 'App\\Models\\User', 25, 'auth_token', 'e84412ea11873e37d920b6d23ca22f10a90d60a7c447f4cb5fa8674b7c0b1785', '[\"*\"]', '2025-05-31 05:25:13', '2025-05-31 05:21:27', '2025-05-31 05:25:13', NULL),
(152, 'App\\Models\\User', 63, 'auth_token', 'a9ae0aeba608b1b257d27d8728c1d7470117148f7660ef9b0a85052b2346eed4', '[\"*\"]', '2025-05-31 09:24:57', '2025-05-31 05:25:26', '2025-05-31 09:24:57', NULL),
(153, 'App\\Models\\User', 25, 'auth_token', '920e61b5699e45af41719ca51b910cbd564198243d693451a341d78ad17ce216', '[\"*\"]', '2025-05-31 06:14:02', '2025-05-31 05:31:18', '2025-05-31 06:14:02', NULL),
(154, 'App\\Models\\User', 25, 'auth_token', 'f4558e4486f01339763534d2bd4b462d81fb0a3ff9c9db3a5261abe03f75f618', '[\"*\"]', '2025-05-31 13:45:19', '2025-05-31 09:20:00', '2025-05-31 13:45:19', NULL),
(155, 'App\\Models\\User', 25, 'auth_token', 'b1f4ea3368e59a40da92924f1df947dd8a6e9704e2aaf43ba96b475ef325e86e', '[\"*\"]', '2025-05-31 09:27:53', '2025-05-31 09:27:51', '2025-05-31 09:27:53', NULL),
(156, 'App\\Models\\User', 25, 'auth_token', '065c8037f20917c02225354a07b070203b6808cca233cfd34b84ea9df4c9b22e', '[\"*\"]', '2025-05-31 13:03:06', '2025-05-31 09:28:23', '2025-05-31 13:03:06', NULL),
(157, 'App\\Models\\User', 25, 'auth_token', 'e0bd6bc80b88408d5e8fdffe61fa2e8cde2b723b790223b149cc5d9204ec91aa', '[\"*\"]', '2025-05-31 13:45:51', '2025-05-31 13:03:52', '2025-05-31 13:45:51', NULL),
(158, 'App\\Models\\User', 25, 'auth_token', 'a580cbceb645ba6ab806c0a1a718e85dc882f3363deef42ff6bb62d14e404cd7', '[\"*\"]', '2025-05-31 15:04:26', '2025-05-31 13:03:53', '2025-05-31 15:04:26', NULL),
(159, 'App\\Models\\User', 25, 'auth_token', 'a59b290d129c671311da9dbd1dfde3f82f81ff62b74758ad5aefbf5b5dd27af3', '[\"*\"]', NULL, '2025-05-31 14:13:30', '2025-05-31 14:13:30', NULL),
(160, 'App\\Models\\User', 25, 'auth_token', '678d981fb28b637e4822ce47f3e1a332dda4aeee8306f66ea0c17b7ac0272f65', '[\"*\"]', '2025-05-31 15:16:51', '2025-05-31 14:16:39', '2025-05-31 15:16:51', NULL),
(161, 'App\\Models\\User', 25, 'auth_token', 'b82cc9b8d8ba5d09f3ea5aea0f5e2719d1384547e387bc135efdc5177abf2612', '[\"*\"]', '2025-05-31 15:01:39', '2025-05-31 14:25:06', '2025-05-31 15:01:39', NULL),
(162, 'App\\Models\\User', 25, 'auth_token', '8e1581fb973e2c4d67d911d663b29380bf6d161266004633149e98074df8f909', '[\"*\"]', '2025-05-31 15:24:18', '2025-05-31 15:24:12', '2025-05-31 15:24:18', NULL),
(163, 'App\\Models\\User', 25, 'auth_token', 'b7fd23b1ec10a99f58d67208e0d1fac65e9521b91bf4a066c7d0f9fb21cf04bc', '[\"*\"]', '2025-05-31 16:09:31', '2025-05-31 15:25:58', '2025-05-31 16:09:31', NULL),
(164, 'App\\Models\\User', 26, 'auth_token', 'fda10e09b46e5c15fe36110d9ae8df3e7a6f815b2d589e899abd4e6678bb2a5e', '[\"*\"]', '2025-05-31 16:10:25', '2025-05-31 15:29:41', '2025-05-31 16:10:25', NULL),
(165, 'App\\Models\\User', 25, 'auth_token', '41fce777c4d207c7307776ac20903078b6ffb8e67b5a9980b8250d56b6561d5c', '[\"*\"]', '2025-05-31 15:37:54', '2025-05-31 15:35:40', '2025-05-31 15:37:54', NULL),
(166, 'App\\Models\\User', 63, 'auth_token', '1f5a123b6f296d47bc56d3c39a76ae2b550eaeface6e61b7519f2c0a01d566be', '[\"*\"]', NULL, '2025-05-31 16:53:01', '2025-05-31 16:53:01', NULL),
(167, 'App\\Models\\User', 26, 'auth_token', '2ea188c5f4c40004161b0cee9e520b4fd18ad8bd494bed4c4506de14e34ac8ee', '[\"*\"]', '2025-05-31 16:58:58', '2025-05-31 16:58:56', '2025-05-31 16:58:58', NULL),
(168, 'App\\Models\\User', 26, 'auth_token', '22310f0bf5e9b650c5b6c538149e9932999cda0d87b1f1fc7d14d2439f419f66', '[\"*\"]', '2025-05-31 17:54:36', '2025-05-31 16:59:39', '2025-05-31 17:54:36', NULL),
(169, 'App\\Models\\User', 25, 'auth_token', '61663b9976767cb0958f6b4874e55f7e2d049882e268b7424008a3adf6f91188', '[\"*\"]', '2025-05-31 17:38:13', '2025-05-31 17:01:36', '2025-05-31 17:38:13', NULL),
(170, 'App\\Models\\User', 25, 'auth_token', '8aa6755f5a8d4e5feb5c1ec2d2748e07282fb2e0c4e5b1bd08d4e236c4c5407f', '[\"*\"]', '2025-05-31 17:42:44', '2025-05-31 17:42:41', '2025-05-31 17:42:44', NULL),
(171, 'App\\Models\\User', 25, 'auth_token', 'b7a051aa35ffc7cfc847d70594271968e754f9f8d8a83ba021b87bbe3e648bc2', '[\"*\"]', '2025-05-31 17:54:04', '2025-05-31 17:43:04', '2025-05-31 17:54:04', NULL),
(172, 'App\\Models\\User', 26, 'auth_token', '2ee5467f29f2ad15a9add5b11b360f45af67d506919a76804f4faadb50077097', '[\"*\"]', '2025-05-31 17:55:44', '2025-05-31 17:55:42', '2025-05-31 17:55:44', NULL),
(173, 'App\\Models\\User', 25, 'auth_token', '572a2278d91857d252242c7df1fb0ed1c99a6001565f389a1aea7dd99a570d94', '[\"*\"]', '2025-06-01 02:51:05', '2025-05-31 18:01:13', '2025-06-01 02:51:05', NULL),
(174, 'App\\Models\\User', 25, 'auth_token', '3f4aca20f8b47d85937d5cbcd4ba0130db71d900528d45f38b9ca672e4df1a88', '[\"*\"]', '2025-06-01 02:52:47', '2025-06-01 02:52:45', '2025-06-01 02:52:47', NULL),
(175, 'App\\Models\\User', 25, 'auth_token', '82ef61f95ea8e99573b206d02241656936beb11b5f35fdfda5a8f33eb79009b3', '[\"*\"]', '2025-06-01 02:53:03', '2025-06-01 02:52:59', '2025-06-01 02:53:03', NULL),
(176, 'App\\Models\\User', 25, 'auth_token', '11d0feb5f377d8dc3ea5e5b0c0695ef8c0d5edbea53db9ff18e8193579b7aea4', '[\"*\"]', '2025-06-01 03:04:13', '2025-06-01 02:59:18', '2025-06-01 03:04:13', NULL),
(177, 'App\\Models\\User', 25, 'auth_token', '59a6d88da7e5580cbab6c0ab565fed42936a73e4d42ebe6ccb10970b0351a02f', '[\"*\"]', '2025-06-01 03:05:27', '2025-06-01 03:04:25', '2025-06-01 03:05:27', NULL),
(178, 'App\\Models\\User', 63, 'auth_token', '5e5056bb1db9c02f93c196c5c38489871c0577450455d385ff548e2788076154', '[\"*\"]', '2025-06-01 03:16:18', '2025-06-01 03:05:52', '2025-06-01 03:16:18', NULL),
(179, 'App\\Models\\User', 63, 'auth_token', 'bc659c5a45998cc4fa7608ab292faaed3de8a38d4a1b251b5e6ae2612ece1cc9', '[\"*\"]', '2025-06-01 06:59:40', '2025-06-01 06:59:38', '2025-06-01 06:59:40', NULL),
(181, 'App\\Models\\User', 26, 'auth_token', '20c321e2463aa78365a4a155ebf330d364ec22b1bf5c8b3d65d222d9b6887e5c', '[\"*\"]', '2025-06-01 08:27:39', '2025-06-01 08:26:16', '2025-06-01 08:27:39', NULL),
(182, 'App\\Models\\User', 37, 'auth_token', 'c074d35a37622fdff935d76813aca1db92881d0d885fb650626657e84d44b642', '[\"*\"]', '2025-06-01 08:32:05', '2025-06-01 08:30:41', '2025-06-01 08:32:05', NULL),
(183, 'App\\Models\\User', 37, 'auth_token', '0a13c223166325a429db4a8807e5b4eefc492425f7cdcda52d97c7ec015901bb', '[\"*\"]', '2025-06-01 11:04:44', '2025-06-01 08:31:07', '2025-06-01 11:04:44', NULL),
(187, 'App\\Models\\User', 37, 'auth_token', '0a8b2840600d2f77bacf8f302d834392ad133a890c8957adb2937601491369ef', '[\"*\"]', '2025-06-01 08:57:06', '2025-06-01 08:57:04', '2025-06-01 08:57:06', NULL),
(189, 'App\\Models\\User', 37, 'auth_token', '7107e8de96f9ae7a9aeca31c57c5159996e99ae26e9d3c34c32e3715108a1874', '[\"*\"]', '2025-06-01 09:01:12', '2025-06-01 09:01:10', '2025-06-01 09:01:12', NULL),
(191, 'App\\Models\\User', 63, 'auth_token', '38abe311f02402c1c40c76bc9acd4d14b622fba50bf7cf79e778aa9196b8f4c6', '[\"*\"]', '2025-06-01 09:03:06', '2025-06-01 09:03:04', '2025-06-01 09:03:06', NULL),
(195, 'App\\Models\\User', 37, 'auth_token', '97aaaff91a337d63af5a3192cf352bc6d36d37cb6ead93d86b1e1399c2fe89e3', '[\"*\"]', '2025-06-01 11:03:49', '2025-06-01 11:03:47', '2025-06-01 11:03:49', NULL),
(198, 'App\\Models\\User', 37, 'auth_token', '472d05fc27807b8b9197d727151a4cc16ee117a0ad5075d23cfbd0d4eb0e544f', '[\"*\"]', '2025-06-01 11:05:53', '2025-06-01 11:05:51', '2025-06-01 11:05:53', NULL),
(200, 'App\\Models\\User', 37, 'auth_token', '13660cce433d902ffdc244d2c3fbbedeb551e7dad893d0b4f9a52b56ebe09d6c', '[\"*\"]', '2025-06-01 11:07:52', '2025-06-01 11:07:49', '2025-06-01 11:07:52', NULL),
(202, 'App\\Models\\User', 37, 'auth_token', '6ea168da407aab67843a5afa380edc1f6a615711e9bdf4dcdf25cec8e0d94e24', '[\"*\"]', '2025-06-01 11:18:21', '2025-06-01 11:11:40', '2025-06-01 11:18:21', NULL),
(204, 'App\\Models\\User', 26, 'auth_token', '996bfdaa5182bef39d1971a74419477f94043a68dd40c1bdd52ccb769ba1cb0f', '[\"*\"]', '2025-06-01 11:20:32', '2025-06-01 11:20:27', '2025-06-01 11:20:32', NULL),
(206, 'App\\Models\\User', 67, 'auth_token', 'd159bc2ebaa20548cc1c1106e140f43012a82e782e205b9e6cde75c745e318e7', '[\"*\"]', '2025-06-07 09:46:47', '2025-06-03 04:10:21', '2025-06-07 09:46:47', NULL),
(207, 'App\\Models\\User', 63, 'auth_token', 'f1282c18e96e9e381b449c4a47ed4a9bb7a33103c26b8182d614894a1a5c5963', '[\"*\"]', '2025-06-06 17:52:01', '2025-06-06 14:49:34', '2025-06-06 17:52:01', NULL),
(208, 'App\\Models\\User', 63, 'auth_token', '5d06c6b5d562531435a315c2e6adb40d27b5ad0a20a52e2c70f7af728ee877e4', '[\"*\"]', '2025-06-06 17:56:55', '2025-06-06 17:56:53', '2025-06-06 17:56:55', NULL),
(209, 'App\\Models\\User', 63, 'auth_token', 'ddab398afaaf5ede3c5548a3294a1a8f6af0298292ead906cb927be9d944362c', '[\"*\"]', '2025-06-07 09:31:08', '2025-06-06 17:59:08', '2025-06-07 09:31:08', NULL),
(210, 'App\\Models\\User', 67, 'auth_token', 'd3f845c0fa3f02a978557b2793b8bbf93727cde704c8eab5e1fbe1492048e484', '[\"*\"]', NULL, '2025-06-07 07:01:57', '2025-06-07 07:01:57', NULL),
(211, 'App\\Models\\User', 63, 'auth_token', 'fdf508d27ef5c812990dccd26068de52ac3f60c7dcdc379a7c38e0c2e055864c', '[\"*\"]', '2025-06-07 17:17:37', '2025-06-07 15:55:49', '2025-06-07 17:17:37', NULL),
(212, 'App\\Models\\User', 63, 'auth_token', 'ddcfe7b7d6783d7ebbcc44492ee0cff55852b0abe9d3531c2c14ba0da170d1bb', '[\"*\"]', '2025-06-08 14:00:44', '2025-06-07 18:00:21', '2025-06-08 14:00:44', NULL),
(213, 'App\\Models\\User', 63, 'auth_token', '771b7462b9a8b974f14386b6721e7690925d4d9ecfeb8eec5ce12356eb8db10b', '[\"*\"]', '2025-06-08 14:13:43', '2025-06-08 14:10:30', '2025-06-08 14:13:43', NULL),
(215, 'App\\Models\\User', 63, 'auth_token', 'f53b33339f76a1e082d512b9b6ec45cec26c4015404ebd7f0d3d12ffc9008ae0', '[\"*\"]', '2025-06-11 15:04:59', '2025-06-10 15:32:56', '2025-06-11 15:04:59', NULL),
(216, 'App\\Models\\User', 68, 'auth_token', 'bd7bc23f3ca165b01cdae41b90c9fe557d42a911224f66288a55a3937c6f66c1', '[\"*\"]', '2025-06-11 13:43:06', '2025-06-11 13:42:05', '2025-06-11 13:43:06', NULL),
(217, 'App\\Models\\User', 69, 'auth_token', '0dfee587be9d92634d5f27fa1031e9b18d7ac090ee42111f65360da3c9397f44', '[\"*\"]', NULL, '2025-06-12 03:31:08', '2025-06-12 03:31:08', NULL),
(218, 'App\\Models\\User', 69, 'auth_token', 'ff0e3a9325e5f0fb7e0f842c90fb5258f2c26a7cf334bb03967daf76d165c8d6', '[\"*\"]', NULL, '2025-06-12 03:32:01', '2025-06-12 03:32:01', NULL),
(227, 'App\\Models\\User', 70, 'auth_token', 'd4d6177fa947042ec2135e2fac43efc0394aab4238d19bd23deb43217043f9f4', '[\"*\"]', NULL, '2025-06-12 16:56:35', '2025-06-12 16:56:35', NULL),
(229, 'App\\Models\\User', 73, 'auth_token', '3efb219626be836a4a38bbd43b89914ca224084f378cc513daad9856826b3905', '[\"*\"]', NULL, '2025-06-13 16:10:25', '2025-06-13 16:10:25', NULL),
(230, 'App\\Models\\User', 73, 'auth_token', '15c4ca67f13e5d42d7cfc0f5be99cc91bbc9f653dee3e0a0d4795dabb967fd02', '[\"*\"]', '2025-06-13 16:11:58', '2025-06-13 16:11:55', '2025-06-13 16:11:58', NULL),
(233, 'App\\Models\\User', 68, 'auth_token', '1ad7a5459fa272690956a7fe80e2c69e8695dbc8983cba6b3252dfef8bde989d', '[\"*\"]', NULL, '2025-06-14 01:50:47', '2025-06-14 01:50:47', NULL),
(234, 'App\\Models\\User', 68, 'auth_token', 'b1da8babdd4e1232e9258bb3860d4388b2f7b0b687213ed8c9e494f90c49adea', '[\"*\"]', NULL, '2025-06-14 01:55:50', '2025-06-14 01:55:50', NULL),
(240, 'App\\Models\\User', 63, 'auth_token', 'd1c777658e392f44f39a99402fd1317f68a8b427020ad94534101d10893b9242', '[\"*\"]', '2025-06-15 18:24:40', '2025-06-15 01:46:14', '2025-06-15 18:24:40', NULL),
(241, 'App\\Models\\User', 74, 'auth_token', 'bfcef97539f43389b7e9983d37351adbe61d9b2af1d3eba7bf132d411775cd14', '[\"*\"]', NULL, '2025-06-15 07:22:19', '2025-06-15 07:22:19', NULL),
(242, 'App\\Models\\User', 74, 'auth_token', '76a753b14acbbd3ee537ee3bd8ae33dd8a7dcb35432868669c2fd4d5dc357380', '[\"*\"]', '2025-06-15 07:27:51', '2025-06-15 07:27:45', '2025-06-15 07:27:51', NULL),
(249, 'App\\Models\\User', 37, 'auth_token', '0ac31208c477ae3661ea526f2571f7c5ea2570fb9d264c8627e240cd47e418ec', '[\"*\"]', '2025-06-29 02:46:58', '2025-06-15 11:36:52', '2025-06-29 02:46:58', NULL),
(264, 'App\\Models\\User', 37, 'auth_token', '8e3b8e7d5c62956eea01dfa8f1ebb432edd8248d8ade7e88b6bc759e44a5f0a1', '[\"*\"]', '2025-06-16 15:21:39', '2025-06-16 14:31:16', '2025-06-16 15:21:39', NULL),
(265, 'App\\Models\\User', 37, 'auth_token', '3450f73fd4d1c15c8d5ddc0cb024d400eba8407f60d545502012e903c58ac5e1', '[\"*\"]', '2025-06-16 14:45:14', '2025-06-16 14:45:12', '2025-06-16 14:45:14', NULL),
(269, 'App\\Models\\User', 37, 'auth_token', '72f78fa7ef88c0adf5eca6ae7874d4a7ad226333d4e97e03fb96a3e31967e12b', '[\"*\"]', '2025-06-16 15:22:02', '2025-06-16 15:22:01', '2025-06-16 15:22:02', NULL),
(271, 'App\\Models\\User', 37, 'auth_token', 'da2c707585d87e29bc97894cb2e66ffde0230750f3f052cd349c790202367790', '[\"*\"]', '2025-06-16 15:59:19', '2025-06-16 15:55:09', '2025-06-16 15:59:19', NULL),
(272, 'App\\Models\\User', 63, 'auth_token', 'e433915ffce6baf8fa242522ed705b46c933eeda460f5858d7c904b8a8f5cf1a', '[\"*\"]', '2025-06-17 02:04:13', '2025-06-16 16:00:04', '2025-06-17 02:04:13', NULL),
(278, 'App\\Models\\User', 37, 'auth_token', '311f8bf5ea887f86ab517c37c2bd024691314a3e35a562ea58e23b8a088c77ed', '[\"*\"]', '2025-06-17 14:39:46', '2025-06-17 14:39:44', '2025-06-17 14:39:46', NULL),
(280, 'App\\Models\\User', 37, 'auth_token', 'eb869f40a888f56032ed2e325009a6f89808c98b9f809d30610bd46f0311b811', '[\"*\"]', '2025-06-17 15:02:35', '2025-06-17 15:02:33', '2025-06-17 15:02:35', NULL),
(282, 'App\\Models\\User', 63, 'auth_token', 'ca11bd261234ce3c638a7106e394b749182637c503dd136828238316aef6f64e', '[\"*\"]', '2025-06-17 15:03:26', '2025-06-17 15:03:25', '2025-06-17 15:03:26', NULL),
(283, 'App\\Models\\User', 68, 'auth_token', '3dbae0c6d192e584fb4fda1540b9467d992019449d195c199c4e7655c8fe063e', '[\"*\"]', '2025-06-17 15:17:28', '2025-06-17 15:16:39', '2025-06-17 15:17:28', NULL),
(285, 'App\\Models\\User', 75, 'auth_token', '6695f25f28d33ef2aac75ea12a11616ce7b1da70e7a80cea28ce63bcdc102a1f', '[\"*\"]', '2025-06-18 06:16:58', '2025-06-18 06:16:53', '2025-06-18 06:16:58', NULL),
(316, 'App\\Models\\User', 63, 'auth_token', '565daa287459083befa3c35d741b40d186526925f79c96081d8c2dfa68f849e6', '[\"*\"]', NULL, '2025-06-21 14:48:59', '2025-06-21 14:48:59', NULL),
(317, 'App\\Models\\User', 77, 'auth_token', '34c98ffcdd54b16f4700af9f1ac257d25c4f2e20071179a21d3d76887f131b52', '[\"*\"]', NULL, '2025-06-22 13:11:43', '2025-06-22 13:11:43', NULL),
(318, 'App\\Models\\User', 77, 'auth_token', 'b70cd657ee47138fa1ef40b2426979d71018cf1dc17e95c1f83029a767f5efda', '[\"*\"]', '2025-06-22 13:45:29', '2025-06-22 13:18:52', '2025-06-22 13:45:29', NULL),
(319, 'App\\Models\\User', 77, 'auth_token', '7612b41f95c9a1517e70250553caba4ccb38f5f27ad4902a976840606a9530a3', '[\"*\"]', NULL, '2025-06-22 13:22:38', '2025-06-22 13:22:38', NULL),
(320, 'App\\Models\\User', 77, 'auth_token', '8f5f991675d45b74978aa59d0350902555c5595038ecce77bd7b94a6d74ec1d8', '[\"*\"]', NULL, '2025-06-22 13:23:29', '2025-06-22 13:23:29', NULL),
(321, 'App\\Models\\User', 77, 'auth_token', '18bbf9ffd7dca18f3fc579efda8e1453533fba4a999771e2588dc6a02d34025f', '[\"*\"]', NULL, '2025-06-22 13:23:36', '2025-06-22 13:23:36', NULL),
(322, 'App\\Models\\User', 77, 'auth_token', 'a3b638f1050195c7ad3bf473776a969ecac4845bce9380913c523453fab32d6a', '[\"*\"]', '2025-06-25 04:58:47', '2025-06-23 14:42:58', '2025-06-25 04:58:47', NULL),
(323, 'App\\Models\\User', 77, 'auth_token', '45a92e0ce1491704760c7a1860ca7bf86fe1741dc417ccee0616ea915640cb58', '[\"*\"]', NULL, '2025-06-23 14:51:46', '2025-06-23 14:51:46', NULL),
(324, 'App\\Models\\User', 77, 'auth_token', '7e2cc9ef1d6f7f1effb52003e5c9fdb4c99331161c8fa70a8a729acd3a4d1e34', '[\"*\"]', '2025-06-25 05:13:46', '2025-06-25 05:05:20', '2025-06-25 05:13:46', NULL),
(374, 'App\\Models\\User', 82, 'auth_token', '396ac97d9a1678b793a4ffdec3886cbdbbcbb0bd94b2415728057cd9b77d3c8b', '[\"*\"]', NULL, '2025-07-05 09:14:59', '2025-07-05 09:14:59', NULL),
(375, 'App\\Models\\User', 82, 'auth_token', 'dce3e2c8e278b7ff810ab1994ed6bbb8edd9b503b681a4911450ea2a0314b8ed', '[\"*\"]', '2025-07-05 09:17:13', '2025-07-05 09:17:10', '2025-07-05 09:17:13', NULL),
(376, 'App\\Models\\User', 82, 'auth_token', 'cf93339d84578a903b5f68c40c2b41fced9aa67fb4e1aa4bad03c314a57a5d55', '[\"*\"]', '2025-07-05 09:20:04', '2025-07-05 09:20:00', '2025-07-05 09:20:04', NULL),
(392, 'App\\Models\\User', 82, 'auth_token', 'e75c1f8bc56894ee53b9e4593ea5681f2ba47f73af61902a7c1a74168178fed1', '[\"*\"]', '2025-07-05 10:16:15', '2025-07-05 10:14:40', '2025-07-05 10:16:15', NULL),
(399, 'App\\Models\\User', 82, 'auth_token', 'cb1090ced9368a26984ca9bc8c7bbb0352682b11b80ebd117566777bbc692e23', '[\"*\"]', '2025-07-05 10:37:54', '2025-07-05 10:37:51', '2025-07-05 10:37:54', NULL),
(403, 'App\\Models\\User', 82, 'auth_token', '1f0911a26076bfe6d47bddabb7aa29ec4a93279b16eb480cce2d0a879db61435', '[\"*\"]', '2025-07-05 13:23:13', '2025-07-05 13:22:45', '2025-07-05 13:23:13', NULL),
(413, 'App\\Models\\User', 82, 'auth_token', '362d5c165c1f6b049b254bcbd8edafa7110c8f6dbec6ddbf990e007787a7ded1', '[\"*\"]', '2025-07-12 19:17:12', '2025-07-05 14:54:10', '2025-07-12 19:17:12', NULL),
(418, 'App\\Models\\User', 82, 'auth_token', '2cb8423990b74611307d532972cbed68c0ae46ddc71e00429400e1e59f701311', '[\"*\"]', '2025-07-05 17:22:31', '2025-07-05 17:22:27', '2025-07-05 17:22:31', NULL),
(421, 'App\\Models\\User', 70, 'auth_token', 'c2ac41203ac3a046074c0e4a44000c388fad70fc2b9982e42d364ee75d331b9a', '[\"*\"]', NULL, '2025-07-06 00:17:40', '2025-07-06 00:17:40', NULL),
(422, 'App\\Models\\User', 70, 'auth_token', 'ae95ea4aee09e84cbaabb006ad46fdf557a313ff4e697037a998126b2cc5015f', '[\"*\"]', NULL, '2025-07-06 00:33:48', '2025-07-06 00:33:48', NULL),
(423, 'App\\Models\\User', 84, 'auth_token', 'ef122770890fee6b81ccbd5ad70a62958fa00564ea782b0bca408c2287d50464', '[\"*\"]', '2025-07-06 04:56:37', '2025-07-06 04:55:21', '2025-07-06 04:56:37', NULL),
(427, 'App\\Models\\User', 86, 'auth_token', '937a22fa54658b4dc15c652a9eb11e16987295a452836230a70f0bf1904d83b4', '[\"*\"]', NULL, '2025-07-07 14:40:32', '2025-07-07 14:40:32', NULL),
(428, 'App\\Models\\User', 86, 'auth_token', '814016a5f846876c59b625a3f8ac3b9318e3e526fa8ba5495712dfcc392200f0', '[\"*\"]', '2025-07-09 13:32:28', '2025-07-07 14:44:50', '2025-07-09 13:32:28', NULL),
(429, 'App\\Models\\User', 77, 'auth_token', '4ecb82221eeb2fdc1dd992f9870adcdeb7bf2f5d69e47be292d8404637963a5e', '[\"*\"]', '2025-07-08 08:25:53', '2025-07-08 08:21:35', '2025-07-08 08:25:53', NULL),
(434, 'App\\Models\\User', 68, 'auth_token', 'f3e1d90c991b0b78c69737c3bccee2c5563906692f3fcf067d5646608602f118', '[\"*\"]', NULL, '2025-07-10 16:00:26', '2025-07-10 16:00:26', NULL),
(436, 'App\\Models\\User', 82, 'auth_token', '1e5ce09883e25d8c8cbcfba5f65c3fe0646582dac80656a996a626565d866485', '[\"*\"]', '2025-07-10 16:35:26', '2025-07-10 16:21:07', '2025-07-10 16:35:26', NULL),
(440, 'App\\Models\\User', 82, 'auth_token', '7eb811dd5999a9e0b25853fae5982fdf8099c18a28bce6ce221bb1a4079d9000', '[\"*\"]', '2025-07-12 10:51:42', '2025-07-10 16:37:00', '2025-07-12 10:51:42', NULL),
(441, 'App\\Models\\User', 90, 'auth_token', 'f045238543fcbfd5468fff64826de3e233c5d127b12b8d8f839a6947b90471db', '[\"*\"]', '2025-07-12 01:55:50', '2025-07-11 15:40:55', '2025-07-12 01:55:50', NULL),
(442, 'App\\Models\\User', 91, 'auth_token', 'b880693920090c21f87013bd4afc30c517b417cb25af5e80ac7b37d9efb6a5ad', '[\"*\"]', '2025-07-11 18:47:38', '2025-07-11 17:58:06', '2025-07-11 18:47:38', NULL),
(443, 'App\\Models\\User', 82, 'auth_token', '368a9a5be595641e6ff574023cb64e3f872d89456a0efbfa4f25231fdfdea505', '[\"*\"]', '2025-07-13 07:23:05', '2025-07-12 11:04:35', '2025-07-13 07:23:05', NULL),
(444, 'App\\Models\\User', 82, 'auth_token', 'f14559ef9e2b900fdfee0e309b66576268dff0b5e554854213f0d7ad5d125bd3', '[\"*\"]', '2025-07-12 11:55:33', '2025-07-12 11:04:44', '2025-07-12 11:55:33', NULL),
(449, 'App\\Models\\User', 82, 'auth_token', '2cb29b439ec59ae4d171d042d043d5c765a6f712431a4e4e24f5880d42ccedd1', '[\"*\"]', '2025-07-12 12:06:23', '2025-07-12 12:03:20', '2025-07-12 12:06:23', NULL),
(450, 'App\\Models\\User', 82, 'auth_token', '1c50d601e883386e23df6d7480eb09cbafea66d6912e924d6646a5359a1bf0ed', '[\"*\"]', '2025-07-12 12:05:47', '2025-07-12 12:05:26', '2025-07-12 12:05:47', NULL),
(451, 'App\\Models\\User', 82, 'auth_token', 'c8fff273b6a189320cdf973756ceea86c253aea41dd5062513d3f5c9b16cb750', '[\"*\"]', '2025-07-12 12:12:25', '2025-07-12 12:12:13', '2025-07-12 12:12:25', NULL),
(452, 'App\\Models\\User', 92, 'auth_token', 'caa2c334f54e52c8fa7fdbb1c52de07b495bccdac68b8ea4ed34b93582b5f471', '[\"*\"]', '2025-07-12 19:10:57', '2025-07-12 12:27:15', '2025-07-12 19:10:57', NULL),
(453, 'App\\Models\\User', 82, 'auth_token', '05c5731b053273201b70098b12c8ade8997dcc516e07d591d49bf568865deaed', '[\"*\"]', '2025-07-12 19:19:03', '2025-07-12 19:11:14', '2025-07-12 19:19:03', NULL),
(454, 'App\\Models\\User', 92, 'auth_token', 'cf83b2c5a1f54ba9fa952d2d794d8670461d6933b4789e416445930208e9eaf0', '[\"*\"]', '2025-07-12 19:19:25', '2025-07-12 19:19:21', '2025-07-12 19:19:25', NULL),
(455, 'App\\Models\\User', 82, 'auth_token', '24a711b70b4e9607218c9b65bd5f92996c42dab66ca056348721d5fe6823d90c', '[\"*\"]', '2025-07-12 19:22:01', '2025-07-12 19:21:34', '2025-07-12 19:22:01', NULL),
(456, 'App\\Models\\User', 92, 'auth_token', 'e398a5a89dbd81e2bca24af589995fc29debd4417fef8a3025a4c5757d5c7c24', '[\"*\"]', '2025-07-12 19:22:32', '2025-07-12 19:22:29', '2025-07-12 19:22:32', NULL),
(457, 'App\\Models\\User', 82, 'auth_token', '10dd29c3cc7427a85373954d155b5ecf12f83ee6640f34e93cf9088ac5bc9466', '[\"*\"]', '2025-07-13 02:49:03', '2025-07-13 02:48:37', '2025-07-13 02:49:03', NULL),
(458, 'App\\Models\\User', 92, 'auth_token', '4eca06abe38080294d169a1e7520d6247c565aa41b61d69c1a274eebb9053a62', '[\"*\"]', '2025-07-13 06:11:23', '2025-07-13 06:11:19', '2025-07-13 06:11:23', NULL),
(459, 'App\\Models\\User', 82, 'auth_token', '54e9bcade3f42d5d736611e567bc1dbcf9801db9e33e5fd8e9d5c4fc3d158cd9', '[\"*\"]', '2025-07-13 06:14:34', '2025-07-13 06:13:58', '2025-07-13 06:14:34', NULL),
(460, 'App\\Models\\User', 92, 'auth_token', '39d2541a9bb220792b527539da6a0c23e600f1e8e3bcc9db008a89e9456e8dae', '[\"*\"]', '2025-07-13 06:41:36', '2025-07-13 06:21:53', '2025-07-13 06:41:36', NULL),
(461, 'App\\Models\\User', 82, 'auth_token', 'ef556472bdfefbbfe7e586df41db8c16e971c2ac1276cf22deb937924b55cdae', '[\"*\"]', '2025-07-13 06:56:54', '2025-07-13 06:56:40', '2025-07-13 06:56:54', NULL),
(462, 'App\\Models\\User', 92, 'auth_token', '5b7b3aafae549dd6c85a2c7c42868f44c52737460e54567bdb053079c7315028', '[\"*\"]', '2025-07-13 06:57:06', '2025-07-13 06:57:03', '2025-07-13 06:57:06', NULL),
(463, 'App\\Models\\User', 92, 'auth_token', '6009f6675384b3012b5a8736bf7a429822bd153bbb2267093ee56a8f11f692d3', '[\"*\"]', '2025-07-13 07:07:22', '2025-07-13 06:59:05', '2025-07-13 07:07:22', NULL),
(464, 'App\\Models\\User', 92, 'auth_token', '1f45f96fb83e99c8d07b298f711377e78ee0f08c60d646d7dfb8899fd02e4438', '[\"*\"]', NULL, '2025-07-13 07:01:06', '2025-07-13 07:01:06', NULL),
(465, 'App\\Models\\User', 82, 'auth_token', '57eba881b5b1e2d1c535dcfb59c006dd993825c3cbe5c092d6c488758a227c4d', '[\"*\"]', '2025-07-13 07:08:03', '2025-07-13 07:07:52', '2025-07-13 07:08:03', NULL),
(466, 'App\\Models\\User', 92, 'auth_token', 'e5c1701ab136675d7761816c6e600fee08543b95ca730d02d16f26de974ee41c', '[\"*\"]', '2025-07-13 07:09:45', '2025-07-13 07:08:14', '2025-07-13 07:09:45', NULL),
(467, 'App\\Models\\User', 92, 'auth_token', '81cb97b49bc3b56fb22c13a654895456efa16a0e650f159d1535d7213aaa70cf', '[\"*\"]', '2025-07-13 07:24:44', '2025-07-13 07:23:52', '2025-07-13 07:24:44', NULL),
(468, 'App\\Models\\User', 92, 'auth_token', '11225378cf6133ce1610427d1ea43e9f61a6a7983978eca3d76ee43da50c3cda', '[\"*\"]', '2025-07-13 07:38:45', '2025-07-13 07:25:07', '2025-07-13 07:38:45', NULL),
(469, 'App\\Models\\User', 82, 'auth_token', 'abbb020f41d07d2bad7bf2d28addd902042fb6f080deb5e2c309e02e9c8abd3e', '[\"*\"]', '2025-07-13 07:25:54', '2025-07-13 07:25:44', '2025-07-13 07:25:54', NULL),
(470, 'App\\Models\\User', 92, 'auth_token', '5d37b2a6905b4e9c075f9f3ff6741f8325a85122842dae8bdcbb53b894722fbe', '[\"*\"]', '2025-07-13 07:26:14', '2025-07-13 07:26:06', '2025-07-13 07:26:14', NULL),
(471, 'App\\Models\\User', 82, 'auth_token', 'b45d5ede10b480941979f4e521bd3895f9861d2a178bdea721214087fd7c0861', '[\"*\"]', '2025-07-13 07:47:10', '2025-07-13 07:29:05', '2025-07-13 07:47:10', NULL),
(472, 'App\\Models\\User', 82, 'auth_token', '0fa9fdff4eece4855a5aa1b6dd287c9d38facd1251db4ebcd1bc590e62d96429', '[\"*\"]', '2025-07-13 07:38:51', '2025-07-13 07:30:06', '2025-07-13 07:38:51', NULL),
(473, 'App\\Models\\User', 92, 'auth_token', 'f3138d4c650ed721866750187dd4883118334c308c800b43851b49b12f7d22ff', '[\"*\"]', NULL, '2025-07-13 07:35:09', '2025-07-13 07:35:09', NULL),
(474, 'App\\Models\\User', 82, 'auth_token', '4d3473ec05a346c645ec5d183ddb0d50cbe6305e45760004243253f9b65ab9a8', '[\"*\"]', '2025-07-13 07:45:15', '2025-07-13 07:40:32', '2025-07-13 07:45:15', NULL),
(484, 'App\\Models\\User', 96, 'auth_token', '5445fcf58631066f5b2c14686162ebcf29674253f08f9e9be30edbc03d44ac81', '[\"*\"]', NULL, '2025-07-14 06:46:03', '2025-07-14 06:46:03', NULL),
(485, 'App\\Models\\User', 96, 'auth_token', '11db877fed5cd196bdb396237a37b6793eb413858006612bc17880b61895d82f', '[\"*\"]', '2025-07-14 07:04:42', '2025-07-14 06:54:07', '2025-07-14 07:04:42', NULL),
(487, 'App\\Models\\User', 94, 'auth_token', '55a4439684ac01f97c207c46320346b265464313ac1b74f4c2b2265c34bf7b51', '[\"*\"]', NULL, '2025-07-14 07:45:22', '2025-07-14 07:45:22', NULL),
(488, 'App\\Models\\User', 94, 'auth_token', 'b46ed4b93816b792e81828ce32eddb11324af2ad3edbbbd5c6ba43c776b8c0d9', '[\"*\"]', NULL, '2025-07-14 07:45:40', '2025-07-14 07:45:40', NULL),
(489, 'App\\Models\\User', 94, 'auth_token', '07884dba81a86c8d8fad2bbb29209b271a91a97c201ac470d3d4a6e3a0af1d87', '[\"*\"]', NULL, '2025-07-14 07:47:21', '2025-07-14 07:47:21', NULL),
(496, 'App\\Models\\User', 94, 'auth_token', 'bf56dd4520840f8c6a5468184469939a7cd33115e7e6199e87aa298e63ddb81f', '[\"*\"]', NULL, '2025-07-15 06:43:55', '2025-07-15 06:43:55', NULL),
(513, 'App\\Models\\User', 101, 'auth_token', 'f6f267a32c85637b56719fe168e2283f7edcb0d5671330f2912bbe00356d46a1', '[\"*\"]', '2025-07-19 11:27:37', '2025-07-18 00:44:18', '2025-07-19 11:27:37', NULL),
(514, 'App\\Models\\User', 101, 'auth_token', '66f0697a833b45070ea7b2b41bf72ca13735e3df6b1cc986beedff866e9d2326', '[\"*\"]', '2025-08-07 16:57:55', '2025-07-18 00:45:02', '2025-08-07 16:57:55', NULL),
(527, 'App\\Models\\User', 107, 'auth_token', 'c2d1ac75695afa33b8c65940ba182b613f02917841c693877ac622db45d48919', '[\"*\"]', NULL, '2025-07-19 05:10:22', '2025-07-19 05:10:22', NULL),
(528, 'App\\Models\\User', 107, 'auth_token', '7e066fc9517e45fa601bfc321811e6af2e0771c39e5c0db14abef69fe8387760', '[\"*\"]', NULL, '2025-07-19 05:12:46', '2025-07-19 05:12:46', NULL),
(529, 'App\\Models\\User', 107, 'auth_token', '4096bd4017a6f5456dbf73ec5dcf5961b5f0e2396d51c63e31a5ffa92280f960', '[\"*\"]', NULL, '2025-07-19 05:14:11', '2025-07-19 05:14:11', NULL),
(530, 'App\\Models\\User', 107, 'auth_token', 'c26bc4eb65917cfa4a68cefa4bf861398cfdb1d0a5a232069985397bdc7ccf82', '[\"*\"]', NULL, '2025-07-19 05:23:20', '2025-07-19 05:23:20', NULL);
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(531, 'App\\Models\\User', 107, 'auth_token', '85b5ea4d2ca144ead435f79ce43173948cdf7b73f953799eab33e13d210136e3', '[\"*\"]', NULL, '2025-07-19 05:53:05', '2025-07-19 05:53:05', NULL),
(532, 'App\\Models\\User', 107, 'auth_token', '790bc61e7b96a0b4209fa18e96576474288e20513adf0a2a796378d0da70c5df', '[\"*\"]', NULL, '2025-07-19 05:55:10', '2025-07-19 05:55:10', NULL),
(533, 'App\\Models\\User', 107, 'auth_token', 'a10740184f433104f3f2a9e5a6515578c960b54b36b09585b66fe67c79f53e52', '[\"*\"]', NULL, '2025-07-19 06:14:40', '2025-07-19 06:14:40', NULL),
(534, 'App\\Models\\User', 107, 'auth_token', '621c0c21de69b4662cb93cce488aea1157643141980096f33500f9b8807fc781', '[\"*\"]', NULL, '2025-07-19 06:27:38', '2025-07-19 06:27:38', NULL),
(535, 'App\\Models\\User', 107, 'auth_token', '6922d980a26f8f37f5da2537b06c095d1c09c33fafb264ea3dd4fa0af8813fa6', '[\"*\"]', NULL, '2025-07-19 06:29:19', '2025-07-19 06:29:19', NULL),
(536, 'App\\Models\\User', 107, 'auth_token', 'bb30e0b1fb7716ea7de456296cf199ef388b7d99d258b6c0895038f00b746ca2', '[\"*\"]', NULL, '2025-07-19 06:36:11', '2025-07-19 06:36:11', NULL),
(537, 'App\\Models\\User', 107, 'auth_token', 'f58f0d72d7c685f83d4081f810c467dc1b1940e67a01340128968051586b0219', '[\"*\"]', NULL, '2025-07-19 07:16:57', '2025-07-19 07:16:57', NULL),
(538, 'App\\Models\\User', 107, 'auth_token', '2eac6882fdf9dbf84ef5a6a55a30067d50e9ca4c031fcbe745dc7de35c18606b', '[\"*\"]', NULL, '2025-07-19 07:53:10', '2025-07-19 07:53:10', NULL),
(539, 'App\\Models\\User', 107, 'auth_token', '66c5b95013ec3ebe8c20ba0689b3d4fcd8a4301505cce938055885c3f2fd9de9', '[\"*\"]', NULL, '2025-07-19 07:53:47', '2025-07-19 07:53:47', NULL),
(540, 'App\\Models\\User', 107, 'auth_token', '50f590c127539f854f6ead7555b5b754b97d607f72edbf0ba61d44d12d162509', '[\"*\"]', NULL, '2025-07-19 07:54:58', '2025-07-19 07:54:58', NULL),
(541, 'App\\Models\\User', 107, 'auth_token', '459814a78c220581988bed8a07bb986ce3d936114e6e5b8c6a8a477075e5d50d', '[\"*\"]', NULL, '2025-07-19 08:04:37', '2025-07-19 08:04:37', NULL),
(542, 'App\\Models\\User', 107, 'auth_token', '3d6d2f5c0572087b57e6b525e64cce1950e1e1e6b7046a9f610b148651c26c01', '[\"*\"]', NULL, '2025-07-19 08:06:00', '2025-07-19 08:06:00', NULL),
(543, 'App\\Models\\User', 107, 'auth_token', '17ec594fd6807d91412eac551408bc21ef0b9e415b393adf750c4d1d73bab1dc', '[\"*\"]', NULL, '2025-07-19 08:19:41', '2025-07-19 08:19:41', NULL),
(544, 'App\\Models\\User', 107, 'auth_token', '50ac53eaf3a237c6a98194f23d25a13db7765dbcfb86d43bbd820908c7903473', '[\"*\"]', NULL, '2025-07-19 08:20:32', '2025-07-19 08:20:32', NULL),
(545, 'App\\Models\\User', 101, 'auth_token', '099472001154b43c2ebb89319f14a14c61ddf78763189280b3de449e40f46d5c', '[\"*\"]', NULL, '2025-07-19 08:39:49', '2025-07-19 08:39:49', NULL),
(546, 'App\\Models\\User', 107, 'auth_token', 'cce69bfe52c8e1cf58b2e8c51d5c3171b61d69e3336fc6d0d976d9e53e95eef1', '[\"*\"]', NULL, '2025-07-19 08:46:09', '2025-07-19 08:46:09', NULL),
(547, 'App\\Models\\User', 101, 'auth_token', 'a1a4616b46335e56c33ba012a9134917936b9bbfd25d9d8575617ae520b68351', '[\"*\"]', '2025-08-06 16:33:58', '2025-07-19 09:01:53', '2025-08-06 16:33:58', NULL),
(548, 'App\\Models\\User', 107, 'auth_token', 'ad07c41cea1a73165fd3414143bf2a565542052048dc5207b9b5770786c842a0', '[\"*\"]', NULL, '2025-07-19 09:03:22', '2025-07-19 09:03:22', NULL),
(551, 'App\\Models\\User', 107, 'auth_token', 'f7f223d7a9416b0eafab99e7ed2d5341507ea9deb8fb90f32488e31b293a043e', '[\"*\"]', NULL, '2025-07-19 09:36:08', '2025-07-19 09:36:08', NULL),
(552, 'App\\Models\\User', 109, 'auth_token', '53797c31db52eee13ae60decc69fdb635efe1f73b4b49f14505abbb1fddd4f82', '[\"*\"]', '2025-07-19 10:40:31', '2025-07-19 10:39:41', '2025-07-19 10:40:31', NULL),
(557, 'App\\Models\\User', 101, 'auth_token', '08fe525ea59042279b3f459ca52e0d9212d668618066cf65f7fc247205429373', '[\"*\"]', '2025-07-19 14:53:31', '2025-07-19 11:35:20', '2025-07-19 14:53:31', NULL),
(558, 'App\\Models\\User', 101, 'auth_token', '3ce5a7b68af50fa116f92f8a9ee6e16b97f9cd6218b1236265281301dd8ee6ff', '[\"*\"]', NULL, '2025-07-19 11:35:56', '2025-07-19 11:35:56', NULL),
(559, 'App\\Models\\User', 101, 'auth_token', '63d93a79ab9e68b7c0bcfed9b581949883da5cd8d4792fd95eb5a2e42c828db1', '[\"*\"]', NULL, '2025-07-19 11:36:02', '2025-07-19 11:36:02', NULL),
(561, 'App\\Models\\User', 101, 'auth_token', '2202faa45710a08673bc8bef348ff216c7ca30a565390aca8ee47a7bde3b7a9b', '[\"*\"]', NULL, '2025-07-19 11:36:33', '2025-07-19 11:36:33', NULL),
(562, 'App\\Models\\User', 101, 'auth_token', 'cc186967cbba835b84ec3cede31c2971e6cce1091d3e73616d6efee6a512d822', '[\"*\"]', NULL, '2025-07-19 11:36:39', '2025-07-19 11:36:39', NULL),
(563, 'App\\Models\\User', 101, 'auth_token', 'e7431bc8e01558425f3c411bdc78e93a36f5b019a328d66413e880423a7d7c89', '[\"*\"]', '2025-07-19 11:37:20', '2025-07-19 11:37:17', '2025-07-19 11:37:20', NULL),
(564, 'App\\Models\\User', 101, 'auth_token', '3d68e636234d5fac96c63d8219b9dbe5359991ba453c2e987d3def3d815d6d4a', '[\"*\"]', NULL, '2025-07-19 11:37:31', '2025-07-19 11:37:31', NULL),
(565, 'App\\Models\\User', 101, 'auth_token', '6b71c1b8c3b9d6cf86c054a8f595bfec74ac5634a66c06e9c0fdc5042902ff03', '[\"*\"]', NULL, '2025-07-19 11:39:09', '2025-07-19 11:39:09', NULL),
(566, 'App\\Models\\User', 101, 'auth_token', 'c8a7900b697aa72b53783bd02fde7f3652bde84b347f83133b987b1474af002e', '[\"*\"]', NULL, '2025-07-19 11:40:29', '2025-07-19 11:40:29', NULL),
(567, 'App\\Models\\User', 101, 'auth_token', '20df992cb6e3d6f41e388b56b5db7cf199db217a7841248336667ed40036b182', '[\"*\"]', NULL, '2025-07-19 11:40:58', '2025-07-19 11:40:58', NULL),
(570, 'App\\Models\\User', 110, 'auth_token', 'f6ee3c5e584378b87cef90152e41c2b6979529fcb13eabfb055a4faf95b508fe', '[\"*\"]', NULL, '2025-07-19 14:59:29', '2025-07-19 14:59:29', NULL),
(571, 'App\\Models\\User', 111, 'auth_token', '113b18bbafa07bfdb447bbbac3690f08e421f58b6d5588ebef9ea7691039ae11', '[\"*\"]', NULL, '2025-07-19 15:02:50', '2025-07-19 15:02:50', NULL),
(572, 'App\\Models\\User', 101, 'auth_token', 'b6e06dc7fe19cced5e85d05b2a119d45cd24cd34837523dd089d1fbe4ceafc5e', '[\"*\"]', '2025-07-19 15:29:12', '2025-07-19 15:04:04', '2025-07-19 15:29:12', NULL),
(573, 'App\\Models\\User', 111, 'auth_token', '3803028dadd1931e6d4e5ba5a7e78e7f28617a5e485061012b0a070d8a571ded', '[\"*\"]', '2025-07-19 15:51:21', '2025-07-19 15:12:03', '2025-07-19 15:51:21', NULL),
(575, 'App\\Models\\User', 101, 'auth_token', 'f6767bedffa5c29cf363b349d6bbb45aa02ab3e0e85e7b5e2103f5c30cda70f2', '[\"*\"]', NULL, '2025-07-19 15:29:11', '2025-07-19 15:29:11', NULL),
(576, 'App\\Models\\User', 101, 'auth_token', 'd9b0a5fc28ac8cb39cf6be0f25a6394f8820115bf6f1b69b90dc43685108ee28', '[\"*\"]', '2025-07-25 15:16:18', '2025-07-19 15:32:34', '2025-07-25 15:16:18', NULL),
(577, 'App\\Models\\User', 112, 'auth_token', '5177d286ffdbfe274d8fc15022070ace62388c77246d19afa9757ce99ee8c388', '[\"*\"]', NULL, '2025-07-19 15:54:01', '2025-07-19 15:54:01', NULL),
(579, 'App\\Models\\User', 112, 'auth_token', '71aa54da87b50a626ae11c1a6f30272159629717f607203bdb62ec19c171dfa8', '[\"*\"]', '2025-07-19 16:22:35', '2025-07-19 16:07:58', '2025-07-19 16:22:35', NULL),
(580, 'App\\Models\\User', 111, 'auth_token', 'a59f136b822d8820be8e9ba3602f71eade56f03bb86e1b0890e84eafaf024034', '[\"*\"]', '2025-07-20 05:59:46', '2025-07-19 16:23:48', '2025-07-20 05:59:46', NULL),
(581, 'App\\Models\\User', 111, 'auth_token', '91940a2f741bb3a9b8936a05d303e1a387580b56919fe41224f8dd21142d0c96', '[\"*\"]', NULL, '2025-07-19 16:25:11', '2025-07-19 16:25:11', NULL),
(582, 'App\\Models\\User', 111, 'auth_token', 'ee1515beb9cbf2576ae727f105700a77762329f4661c889d2929b6eb0bc1f108', '[\"*\"]', NULL, '2025-07-19 16:26:25', '2025-07-19 16:26:25', NULL),
(583, 'App\\Models\\User', 111, 'auth_token', '27351ef2b9f766af263a1d770e22880a637c55d07768258ea5b780cb010cad09', '[\"*\"]', '2025-07-20 17:16:08', '2025-07-20 06:30:28', '2025-07-20 17:16:08', NULL),
(586, 'App\\Models\\User', 96, 'auth_token', 'bca628e261a5df27caf5640f1a443177f0b9839b36fc1e59d0b72149af7cdfaa', '[\"*\"]', '2025-07-20 16:31:56', '2025-07-20 16:29:02', '2025-07-20 16:31:56', NULL),
(587, 'App\\Models\\User', 96, 'auth_token', '6a5eeda030192632d84b0c8d175ec8cb0480a230dedf305e414315334b0478c4', '[\"*\"]', '2025-07-20 16:35:14', '2025-07-20 16:34:14', '2025-07-20 16:35:14', NULL),
(588, 'App\\Models\\User', 96, 'auth_token', 'eb977f0190bfcfca21d5fee4d15b6930a877e0fc25c9c6d8f399841deb86dccf', '[\"*\"]', NULL, '2025-07-20 16:35:08', '2025-07-20 16:35:08', NULL),
(589, 'App\\Models\\User', 96, 'auth_token', 'e13d8bdb4f3ad1eac212395f0c61ecfa9ba3a9f4a937980ff7f5a84681d80222', '[\"*\"]', NULL, '2025-07-20 16:35:14', '2025-07-20 16:35:14', NULL),
(591, 'App\\Models\\User', 111, 'auth_token', 'ec79a1c703906ed5bf33547010d2988d55e3d46ac65919e7a29cc60ac36483ba', '[\"*\"]', '2025-07-20 17:21:57', '2025-07-20 17:21:53', '2025-07-20 17:21:57', NULL),
(592, 'App\\Models\\User', 112, 'auth_token', 'b6a2f440dde1908dacfd068dab9d6e56fad3f37fa2488f3fb5b18852329bf53d', '[\"*\"]', '2025-07-20 17:41:16', '2025-07-20 17:22:56', '2025-07-20 17:41:16', NULL),
(594, 'App\\Models\\User', 112, 'auth_token', '706c03e387225ce4e9bfc43f62e4e4c29ab0bc806146915372c0fb659754df0c', '[\"*\"]', '2025-07-21 15:41:26', '2025-07-21 10:42:22', '2025-07-21 15:41:26', NULL),
(595, 'App\\Models\\User', 96, 'auth_token', 'e15c3545533f2a1f18795ea47e15510ea2eaeff081b02af447c1f7a1997294b4', '[\"*\"]', '2025-07-22 08:56:12', '2025-07-22 08:44:36', '2025-07-22 08:56:12', NULL),
(596, 'App\\Models\\User', 112, 'auth_token', '74308cfd748094fb62b7531dda7d85019bd443753dd90daa5b9259640a01e63f', '[\"*\"]', '2025-07-22 10:18:56', '2025-07-22 10:18:53', '2025-07-22 10:18:56', NULL),
(597, 'App\\Models\\User', 111, 'auth_token', 'fb7a585ef4d25446756e6fe707e34f826162c39055229cfcaa3b683ea5088827', '[\"*\"]', '2025-07-22 10:29:27', '2025-07-22 10:20:27', '2025-07-22 10:29:27', NULL),
(598, 'App\\Models\\User', 111, 'auth_token', '137fab63a775fa1c0a17ab030283951f30b9fff94d49c5a9039de9254e3b30ca', '[\"*\"]', '2025-07-22 11:15:44', '2025-07-22 11:15:43', '2025-07-22 11:15:44', NULL),
(599, 'App\\Models\\User', 111, 'auth_token', 'e45968fac4d63fd95962e1422a09eae4b55f7860c5460c156cfdcd9105570e9b', '[\"*\"]', '2025-07-22 11:33:07', '2025-07-22 11:33:06', '2025-07-22 11:33:07', NULL),
(600, 'App\\Models\\User', 122, 'auth_token', '43980383dc691360a9d0f69c328097c531a2cecc6bed6fe121420515670e8a97', '[\"*\"]', NULL, '2025-07-22 11:35:54', '2025-07-22 11:35:54', NULL),
(601, 'App\\Models\\User', 122, 'auth_token', '7246decf53ce7914dbeb4a881ad84c3077acecb868eaeefd82517dd4ca7407c9', '[\"*\"]', NULL, '2025-07-22 11:44:44', '2025-07-22 11:44:44', NULL),
(602, 'App\\Models\\User', 122, 'auth_token', '7db568490605c6d20e5d1d1dc7362f3c89999343428377fe52a88e590d402cb9', '[\"*\"]', '2025-07-22 13:05:36', '2025-07-22 11:48:27', '2025-07-22 13:05:36', NULL),
(605, 'App\\Models\\User', 122, 'auth_token', 'd8fa8840f5bf0607cea076978d09f8a2b0094b00757b62890db404ea97bdfffa', '[\"*\"]', '2025-07-22 14:26:13', '2025-07-22 14:22:06', '2025-07-22 14:26:13', NULL),
(606, 'App\\Models\\User', 112, 'auth_token', '51555628a41ce59a64c6f137cbbf90eea8cd0585752ddfeb7f1a3806d446261a', '[\"*\"]', '2025-07-22 14:46:09', '2025-07-22 14:46:05', '2025-07-22 14:46:09', NULL),
(607, 'App\\Models\\User', 112, 'auth_token', '02031167c040dab0c3e1d4dd72e7af7bcc8525b057c4ae3040f7e776e80ddab8', '[\"*\"]', '2025-07-23 00:49:24', '2025-07-22 14:52:01', '2025-07-23 00:49:24', NULL),
(608, 'App\\Models\\User', 101, 'auth_token', '69107de2908e7f597ab251d779b7ca12bbc25f0eb6a3f59007bbb27c83bc0c9f', '[\"*\"]', NULL, '2025-07-22 23:14:24', '2025-07-22 23:14:24', NULL),
(612, 'App\\Models\\User', 112, 'auth_token', '13aff65454c72647f2a14ebc4e3ab9234f50ed202fba7cb0852f896aec299e31', '[\"*\"]', NULL, '2025-07-23 00:48:08', '2025-07-23 00:48:08', NULL),
(613, 'App\\Models\\User', 101, 'auth_token', '8d867ba69efc4af4094236552ea37bacaf97839b762624cbeec9f369d4652d2d', '[\"*\"]', NULL, '2025-07-23 05:52:48', '2025-07-23 05:52:48', NULL),
(614, 'App\\Models\\User', 101, 'auth_token', 'b90525ace8d0910667fdbd8a17cc938672d3dba57588891c485a4c3f6abcb9c2', '[\"*\"]', NULL, '2025-07-23 05:53:50', '2025-07-23 05:53:50', NULL),
(615, 'App\\Models\\User', 101, 'auth_token', 'c75d063ab016364dc585dbe40c3c60670d0697b35930460277d8ca25635d3ce9', '[\"*\"]', NULL, '2025-07-23 05:54:25', '2025-07-23 05:54:25', NULL),
(616, 'App\\Models\\User', 101, 'auth_token', '80b480d7db29d28aeabbec2971cdfcf9323778d9204f776f4f6ac134b9fb0697', '[\"*\"]', NULL, '2025-07-23 05:57:39', '2025-07-23 05:57:39', NULL),
(618, 'App\\Models\\User', 112, 'auth_token', 'ef8d2819599dc5e43df0560660331e2a1c1b5f818797c5fc9d3bf99484ab8a01', '[\"*\"]', '2025-07-23 07:17:05', '2025-07-23 07:16:34', '2025-07-23 07:17:05', NULL),
(619, 'App\\Models\\User', 123, 'auth_token', '98263b529394969b2a9815df4cadd89c247cf9facd873f0400873b5f8f57951d', '[\"*\"]', '2025-07-27 08:32:38', '2025-07-23 07:23:04', '2025-07-27 08:32:38', NULL),
(620, 'App\\Models\\User', 123, 'auth_token', '3db2b124592826ac23b1b31586f27d66c677dc46b45b1bcbda95518b807f6fac', '[\"*\"]', NULL, '2025-07-23 07:24:33', '2025-07-23 07:24:33', NULL),
(635, 'App\\Models\\User', 101, 'auth_token', 'ff7c54ba48e3e8d0ae5677912fb5a74c3843f9b6cb26bd8c470582d3c9f76236', '[\"*\"]', NULL, '2025-07-25 15:15:28', '2025-07-25 15:15:28', NULL),
(640, 'App\\Models\\User', 124, 'auth_token', '5cffe637d5265fdb92e0d0e5e65b381fb8f57a79de5f8e29eeea9d03103790b2', '[\"*\"]', '2025-08-05 13:06:25', '2025-07-27 08:11:44', '2025-08-05 13:06:25', NULL),
(642, 'App\\Models\\User', 112, 'auth_token', '72d69d8c5a8a9af8032d9e1d06557936c7dca0d3fa0e4d5501ab01ac5edbb9cc', '[\"*\"]', '2025-07-28 13:57:17', '2025-07-27 08:34:03', '2025-07-28 13:57:17', NULL),
(643, 'App\\Models\\User', 112, 'auth_token', 'cce7fd8c2ae09b7fbcdf9c28b2db2d3291a8450fda9525113186d1dd2e9aaa38', '[\"*\"]', NULL, '2025-07-28 13:57:35', '2025-07-28 13:57:35', NULL),
(644, 'App\\Models\\User', 112, 'auth_token', 'e70e9145afac51de47ecca4648287c0ca41f34a5bc51df0ad9e62962d3d72450', '[\"*\"]', '2025-07-28 15:26:31', '2025-07-28 14:58:03', '2025-07-28 15:26:31', NULL),
(647, 'App\\Models\\User', 112, 'auth_token', '8bbc2681ac3717ec99f66ddbaf7017ba2dd3942293646875ac54c507309a651a', '[\"*\"]', NULL, '2025-07-28 15:23:34', '2025-07-28 15:23:34', NULL),
(648, 'App\\Models\\User', 112, 'auth_token', 'c501fabad065bfc094f7d532c698d5b0f4d9c66bad9a879281a27f4684deb68c', '[\"*\"]', NULL, '2025-07-28 15:26:30', '2025-07-28 15:26:30', NULL),
(649, 'App\\Models\\User', 112, 'auth_token', '512381d2cbb00ac37250e7bf3649525d98b9285c404dfe0cf2e38c9c7be40ace', '[\"*\"]', NULL, '2025-07-28 15:26:45', '2025-07-28 15:26:45', NULL),
(650, 'App\\Models\\User', 112, 'auth_token', '9e925c4a9472a8083eac70244c3177e6e0bf5ccb52152460ec464cb1dc714fed', '[\"*\"]', '2025-07-28 15:51:05', '2025-07-28 15:51:01', '2025-07-28 15:51:05', NULL),
(655, 'App\\Models\\User', 101, 'auth_token', 'd9e4425b4719c459b9e2fb839012470e0f68b97e51c5e70d0a4a5e59bb553c0e', '[\"*\"]', NULL, '2025-07-28 16:06:29', '2025-07-28 16:06:29', NULL),
(658, 'App\\Models\\User', 112, 'auth_token', 'dfa4f2d76be83e817510b6dd2809ba8644c8fd648868362e2007b161a988d7d2', '[\"*\"]', '2025-07-28 16:11:20', '2025-07-28 16:11:06', '2025-07-28 16:11:20', NULL),
(659, 'App\\Models\\User', 112, 'auth_token', '9b1eba321e0ed1b00828dc8b3398ce6f2c55fb9d6cb43c225de81932f9e317d7', '[\"*\"]', NULL, '2025-07-28 16:14:30', '2025-07-28 16:14:30', NULL),
(661, 'App\\Models\\User', 112, 'auth_token', '0bf3bc597d5e6d04d7cfab873f7b3c762e2c84fb20c972cf0a10b05c2781aaa8', '[\"*\"]', '2025-07-28 16:29:06', '2025-07-28 16:22:14', '2025-07-28 16:29:06', NULL),
(663, 'App\\Models\\User', 112, 'auth_token', '2ad40a23fad899eac0f23b9ff1a7b5caa7c0f430a5c9b25b000d176582973a36', '[\"*\"]', NULL, '2025-07-28 16:25:53', '2025-07-28 16:25:53', NULL),
(664, 'App\\Models\\User', 112, 'auth_token', 'af7c16c26b41ac541513b378779ac746a37613cea0f5c87a244049d588ee9dbf', '[\"*\"]', NULL, '2025-07-28 16:28:32', '2025-07-28 16:28:32', NULL),
(665, 'App\\Models\\User', 112, 'auth_token', 'dea898701b8aab6ed500b2869c77fdaf882b4cbd83942c54e8a6b8855bcf2c1e', '[\"*\"]', '2025-08-05 15:12:22', '2025-07-28 16:34:18', '2025-08-05 15:12:22', NULL),
(666, 'App\\Models\\User', 112, 'auth_token', 'e9c8b18a2092bf69a38d95af2533fafffdd95bfbc10af994b4b15eaea0121a36', '[\"*\"]', '2025-07-29 12:34:08', '2025-07-29 12:31:37', '2025-07-29 12:34:08', NULL),
(674, 'App\\Models\\User', 112, 'auth_token', '174a2ad315412818c4fddcd2c88ec33f9ed84769af0f6840efb0979f4a18c242', '[\"*\"]', '2025-08-05 16:07:59', '2025-07-29 14:29:23', '2025-08-05 16:07:59', NULL),
(677, 'App\\Models\\User', 112, 'auth_token', '1ea80838487198d50af225995bc2a8dd500284ed642143d930d423c802157faf', '[\"*\"]', NULL, '2025-07-29 14:33:45', '2025-07-29 14:33:45', NULL),
(680, 'App\\Models\\User', 96, 'auth_token', '38a5d82e0af835e0da027c69ecff46ab2f6359abf739c247b8e4e0fabb0cd8c6', '[\"*\"]', '2025-08-05 10:28:09', '2025-08-05 06:58:14', '2025-08-05 10:28:09', NULL),
(681, 'App\\Models\\User', 96, 'auth_token', '3eee8fee8479b78f72a20a713f4660313b94b698944dc6fa68628a78c1a3237f', '[\"*\"]', NULL, '2025-08-05 06:58:35', '2025-08-05 06:58:35', NULL),
(682, 'App\\Models\\User', 96, 'auth_token', '4d7f8d3fb6bbfd9ac989721f9b6e0ac57d3b7c9385aef209265fb50db8746be7', '[\"*\"]', NULL, '2025-08-05 06:59:24', '2025-08-05 06:59:24', NULL),
(683, 'App\\Models\\User', 96, 'auth_token', '907ddb594b137e9c3e2ec327ae322667578318f6930fee5a7a483ac051e778bc', '[\"*\"]', NULL, '2025-08-05 07:03:14', '2025-08-05 07:03:14', NULL),
(684, 'App\\Models\\User', 96, 'auth_token', '11d80fba41beef5bab8c2224e538fd6e7cbad6d894e2b23e66c9698b53040add', '[\"*\"]', NULL, '2025-08-05 09:34:53', '2025-08-05 09:34:53', NULL),
(686, 'App\\Models\\User', 96, 'auth_token', '24821fe7659a5664dbc836172a5eacde3bfdbb9cf55a89483a4419d4f5894f06', '[\"*\"]', '2025-08-05 15:10:49', '2025-08-05 10:46:10', '2025-08-05 15:10:49', NULL),
(687, 'App\\Models\\User', 124, 'auth_token', '935dfb01b4b3abdfc2bf9b5c01dc62391117ffe6e5cd1b832fc5e4daa876fbec', '[\"*\"]', '2025-08-05 13:11:01', '2025-08-05 13:07:17', '2025-08-05 13:11:01', NULL),
(689, 'App\\Models\\User', 126, 'auth_token', 'f47a23d6c1498e976d6fe5231675d669fc303751a944494036b260b58c256c12', '[\"*\"]', NULL, '2025-08-05 15:20:24', '2025-08-05 15:20:24', NULL),
(690, 'App\\Models\\User', 112, 'auth_token', '87be3fcdbe4194a58052c06a53347ba23a564fb1244c78bf25f5b55c017ba8fd', '[\"*\"]', NULL, '2025-08-05 15:50:36', '2025-08-05 15:50:36', NULL),
(691, 'App\\Models\\User', 126, 'auth_token', '9ac0554683b886d16548a88a2c3bb9930d71e2096ad679e356641e42c798ed93', '[\"*\"]', '2025-08-05 16:14:21', '2025-08-05 16:00:15', '2025-08-05 16:14:21', NULL),
(692, 'App\\Models\\User', 126, 'auth_token', '2fafe8830788043c09c925b886ca3411c3ae4211833d10345222c0a43f62465c', '[\"*\"]', NULL, '2025-08-05 16:08:58', '2025-08-05 16:08:58', NULL),
(693, 'App\\Models\\User', 126, 'auth_token', '88ad0516046ac0cb7577de1a461ffd8e49ff1ddc2d13a2c46d9fb91d07605514', '[\"*\"]', NULL, '2025-08-05 16:09:39', '2025-08-05 16:09:39', NULL),
(694, 'App\\Models\\User', 126, 'auth_token', '6f09a4e5cc9be739c19d8f04b2d35268acbe0ec6f923a6e106f6f41f38d60957', '[\"*\"]', NULL, '2025-08-05 16:10:06', '2025-08-05 16:10:06', NULL),
(695, 'App\\Models\\User', 96, 'auth_token', 'ea41bd1be377993b06ba2f09cddb07631fd7f87d54a374e561d584cfee92934e', '[\"*\"]', '2025-08-12 09:14:51', '2025-08-05 16:15:20', '2025-08-12 09:14:51', NULL),
(700, 'App\\Models\\User', 127, 'auth_token', '0438eb968b9e0d08913a44e9d9f33d69d8d31ebd7ce67686b9b65a9e9b1983a8', '[\"*\"]', '2025-08-07 16:18:22', '2025-08-07 16:18:14', '2025-08-07 16:18:22', NULL),
(701, 'App\\Models\\User', 101, 'auth_token', 'fff0c44e7f1714ab1a5077672576c60654c4bc5e0c7c6b5a69d77a3fe8a7903b', '[\"*\"]', NULL, '2025-08-07 16:57:15', '2025-08-07 16:57:15', NULL),
(702, 'App\\Models\\User', 127, 'auth_token', 'd22e26e91e02443b0969527e731d3000228308e7b8c9bfe67a74a646e6c645cf', '[\"*\"]', '2025-08-27 16:05:14', '2025-08-07 17:04:05', '2025-08-27 16:05:14', NULL),
(703, 'App\\Models\\User', 126, 'auth_token', '40351c2d59b14f601ef08f4f62829bd07b04f43cfd29bc58ce032f59e76c5565', '[\"*\"]', '2025-08-12 10:44:28', '2025-08-12 10:44:10', '2025-08-12 10:44:28', NULL),
(704, 'App\\Models\\User', 112, 'auth_token', 'ec91f07fc031ef6b9f7292c495ccfbe33411ceb93948b769150d740aa08e758c', '[\"*\"]', '2025-08-13 10:14:26', '2025-08-13 10:14:23', '2025-08-13 10:14:26', NULL),
(705, 'App\\Models\\User', 128, 'auth_token', '7c6b7474272fb9b5d17b3a0a65f28af6bfda15907e1f95423c3d7ecb8143db66', '[\"*\"]', NULL, '2025-08-13 11:35:06', '2025-08-13 11:35:06', NULL),
(706, 'App\\Models\\User', 129, 'auth_token', 'f056f24738b4b1b40004162f02b1f4ccc0df0b66c394971706d3c2f87298d24d', '[\"*\"]', NULL, '2025-08-13 11:37:18', '2025-08-13 11:37:18', NULL),
(707, 'App\\Models\\User', 130, 'auth_token', '8ccc20ce0441cb86539b2fc2c7cd73cb21b502368ac5bb9104f3b6371c8f72b6', '[\"*\"]', '2025-08-13 12:23:22', '2025-08-13 12:10:38', '2025-08-13 12:23:22', NULL),
(710, 'App\\Models\\User', 96, 'auth_token', 'bbb3dbe90c2d628aae3a3c047b3c00d6efdc076aeb25ceb8db42aefb60b5caa4', '[\"*\"]', '2025-08-18 08:20:08', '2025-08-18 08:20:04', '2025-08-18 08:20:08', NULL),
(716, 'App\\Models\\User', 132, 'auth_token', 'a1331ffe05f945abf59045732088ff2c845ee1fd83cd282c05c209477b5fea8b', '[\"*\"]', NULL, '2025-08-21 07:47:40', '2025-08-21 07:47:40', NULL),
(717, 'App\\Models\\User', 132, 'auth_token', 'a2ee1cc85bb8fec9d90a4049ade5b2d02cf0fa86b3e9ceec072c8eaac6c63a77', '[\"*\"]', NULL, '2025-08-21 08:14:42', '2025-08-21 08:14:42', NULL),
(719, 'App\\Models\\User', 132, 'auth_token', '5193824edc3966cbf504b5961ab901d8f7649cb4436001f68e9ba3d758a23a09', '[\"*\"]', NULL, '2025-08-22 08:45:32', '2025-08-22 08:45:32', NULL),
(720, 'App\\Models\\User', 132, 'auth_token', '361e684df3bf4a07c44e7b18563a7460c443a93f8eea8c07c400bae3694cd7bd', '[\"*\"]', NULL, '2025-08-22 08:54:56', '2025-08-22 08:54:56', NULL),
(721, 'App\\Models\\User', 132, 'auth_token', 'ca0247ed068dbb0d59da60629e9571245a31a42387fb6cdcda7c1668afd8b72c', '[\"*\"]', NULL, '2025-08-22 08:57:56', '2025-08-22 08:57:56', NULL),
(722, 'App\\Models\\User', 132, 'auth_token', '2668afe5db91925ef0c2b8ac93e4b71521a7427af2c879a966b7120995e15893', '[\"*\"]', NULL, '2025-08-22 09:06:15', '2025-08-22 09:06:15', NULL),
(723, 'App\\Models\\User', 132, 'auth_token', '0c3669b48e72e2d3b382cf13b60fe6aa138aa7427550788b63b76eddbf9d652b', '[\"*\"]', NULL, '2025-08-22 09:07:10', '2025-08-22 09:07:10', NULL),
(724, 'App\\Models\\User', 132, 'auth_token', 'f8ace56f6c90a7ae94361043f48bcb1907749768d86676e517030e55ea53fc60', '[\"*\"]', NULL, '2025-08-22 09:29:46', '2025-08-22 09:29:46', NULL),
(725, 'App\\Models\\User', 132, 'auth_token', 'db0abbcdd6dbfdd1ad4f89d02188f0f912e0ec787be2c01eb4dc0485914e8529', '[\"*\"]', NULL, '2025-08-22 09:52:38', '2025-08-22 09:52:38', NULL),
(731, 'App\\Models\\User', 132, 'auth_token', '4357b839875551960fee3d7b069fbd32121ed246251602b0121c83dc5c28c0a9', '[\"*\"]', NULL, '2025-08-22 10:12:03', '2025-08-22 10:12:03', NULL),
(732, 'App\\Models\\User', 132, 'auth_token', 'bb3f4307bb5fc261925cd91909e40f424a784f6328dc8ac62bf78750e5c8e020', '[\"*\"]', NULL, '2025-08-22 10:20:57', '2025-08-22 10:20:57', NULL),
(733, 'App\\Models\\User', 132, 'auth_token', 'b822318f80cbe00784acb1e5375270336364ab22ac9d03ad99ecd6cfd052f6c3', '[\"*\"]', NULL, '2025-08-22 10:33:24', '2025-08-22 10:33:24', NULL),
(734, 'App\\Models\\User', 132, 'auth_token', 'c836df7367968f0083df8d1c5941a2aa0006d5b39dea0b65a55a2a577ca898c1', '[\"*\"]', NULL, '2025-08-22 10:40:00', '2025-08-22 10:40:00', NULL),
(735, 'App\\Models\\User', 132, 'auth_token', '5b0e69fa5066d13f4d69aed90551ef6407c50f99305d89625491ea017552e80a', '[\"*\"]', NULL, '2025-08-22 13:57:06', '2025-08-22 13:57:06', NULL),
(736, 'App\\Models\\User', 132, 'auth_token', 'cf6a5946a7aa5dc0f8208a75bba053a69a56bf82c4f3b14267963abbb1ff63b7', '[\"*\"]', NULL, '2025-08-22 14:06:31', '2025-08-22 14:06:31', NULL),
(737, 'App\\Models\\User', 132, 'auth_token', 'a037eec67db94eab434277d2e92bcd919c6798a8149b24b12859f28169bb3903', '[\"*\"]', NULL, '2025-08-22 14:15:58', '2025-08-22 14:15:58', NULL),
(738, 'App\\Models\\User', 132, 'auth_token', '87e4414c12c6c99aa4476c5c3f36c768c98a181b5f68955205c96de1ff33b869', '[\"*\"]', NULL, '2025-08-22 14:22:18', '2025-08-22 14:22:18', NULL),
(739, 'App\\Models\\User', 132, 'auth_token', 'b87b59ea511f7a3bd76fcd6b51d111cce2e1f489bfd760fae6501272b0de544f', '[\"*\"]', NULL, '2025-08-22 14:24:34', '2025-08-22 14:24:34', NULL),
(740, 'App\\Models\\User', 132, 'auth_token', '20c238dfad38d1e2bc68adea186e97a8f2f26947780500435eef9e3f33d1014e', '[\"*\"]', NULL, '2025-08-22 14:28:04', '2025-08-22 14:28:04', NULL),
(741, 'App\\Models\\User', 132, 'auth_token', '6640e151623c984415d688052c893da81e3f4fa59b5c3a5f23a56d156d6cae0e', '[\"*\"]', NULL, '2025-08-22 14:32:04', '2025-08-22 14:32:04', NULL),
(742, 'App\\Models\\User', 132, 'auth_token', '82c9cafb01f898ff73ce04975ca0e9a9fb49e539d2baabb10cd0491adb6e8f20', '[\"*\"]', NULL, '2025-08-23 08:46:34', '2025-08-23 08:46:34', NULL),
(743, 'App\\Models\\User', 132, 'auth_token', '60521c658756d41ba41910c70dd21ad7791836104efbadff6028301ece1c08b5', '[\"*\"]', NULL, '2025-08-23 09:26:10', '2025-08-23 09:26:10', NULL),
(744, 'App\\Models\\User', 132, 'auth_token', '299a87dd5cad69e2d0c7af4d9c2186daceb2c6ae3563a6e3f97dc17f0a9df722', '[\"*\"]', NULL, '2025-08-23 09:38:35', '2025-08-23 09:38:35', NULL),
(745, 'App\\Models\\User', 132, 'auth_token', '90fd1920b4b357231cc12c796e4d7d06b423df95f3cacd3864a82a5fb949f6a0', '[\"*\"]', NULL, '2025-08-23 09:40:49', '2025-08-23 09:40:49', NULL),
(746, 'App\\Models\\User', 132, 'auth_token', 'ab09175a50f6d84191128a1d6f2fcd8c8bef3948f5ac40df184b53bcb0f1a26c', '[\"*\"]', NULL, '2025-08-23 09:45:57', '2025-08-23 09:45:57', NULL),
(747, 'App\\Models\\User', 133, 'auth_token', '42b76f5f42c04525ccfae3ae92c9d5dfd1cd336f69933a1f6bbbb2073f69f32a', '[\"*\"]', NULL, '2025-08-23 10:00:59', '2025-08-23 10:00:59', NULL),
(748, 'App\\Models\\User', 133, 'auth_token', 'cd575f9ba43e110e3198e7874334c1e2ff9b616edebcd8dfd8c1f77fdf3f60f5', '[\"*\"]', NULL, '2025-08-23 10:02:57', '2025-08-23 10:02:57', NULL),
(749, 'App\\Models\\User', 133, 'auth_token', '8bdf687a192fc805b650a7a818abe19fbda8194cf174625f1ec1e3b7edcb28f3', '[\"*\"]', NULL, '2025-08-23 10:03:56', '2025-08-23 10:03:56', NULL),
(750, 'App\\Models\\User', 133, 'auth_token', '4b3d4f3b045d7f9f5db25335a8707962bab9562516d2399c62c144eb799fe9d2', '[\"*\"]', NULL, '2025-08-23 10:39:47', '2025-08-23 10:39:47', NULL),
(770, 'App\\Models\\User', 133, 'auth_token', 'e999e7aff907c01e8693fb8b79a57dbbcf117b2494086df9940f2a22fd13e2da', '[\"*\"]', NULL, '2025-08-24 02:53:31', '2025-08-24 02:53:31', NULL),
(771, 'App\\Models\\User', 133, 'auth_token', '3a0d0f3baf00195410b6cfd89b36d300fbc4a8041141fd1b7f0d51265c9b67a8', '[\"*\"]', NULL, '2025-08-24 03:19:50', '2025-08-24 03:19:50', NULL),
(772, 'App\\Models\\User', 133, 'auth_token', '48eb06aa7eb803d0cb55602d5f03af11bfdd8c479e198421639d910f012cf3dc', '[\"*\"]', NULL, '2025-08-24 03:32:18', '2025-08-24 03:32:18', NULL),
(773, 'App\\Models\\User', 133, 'auth_token', '4a3160fa993eb67dccb1a677f24c010f12a2bd04a0b0a3705f232f31bb1103cb', '[\"*\"]', NULL, '2025-08-24 03:46:54', '2025-08-24 03:46:54', NULL),
(774, 'App\\Models\\User', 133, 'auth_token', '224a6680166409c78b6402841788eec850dd0dcf8d6d44af995d67b119cb0ec7', '[\"*\"]', NULL, '2025-08-24 04:18:53', '2025-08-24 04:18:53', NULL),
(775, 'App\\Models\\User', 134, 'auth_token', '2f38428d204719a76db70c21271257d71d8c8239aee89d788ac0f02b89d37167', '[\"*\"]', NULL, '2025-08-24 04:20:26', '2025-08-24 04:20:26', NULL),
(776, 'App\\Models\\User', 134, 'auth_token', '93cbd1b424a6e4d414c9d3c0dcb9cee08ceb073cd6675644832259d64d9dd62e', '[\"*\"]', NULL, '2025-08-24 04:45:05', '2025-08-24 04:45:05', NULL),
(777, 'App\\Models\\User', 134, 'auth_token', '0dffec0722c500cf83c5e319dd03f52c2cf1f084ffd9f41bdf2abfa6a134b826', '[\"*\"]', NULL, '2025-08-24 05:00:10', '2025-08-24 05:00:10', NULL),
(791, 'App\\Models\\User', 134, 'auth_token', '1f3307c02643797c3daa96dd3867752612779fc81843cbb77c613f30e8322e72', '[\"*\"]', NULL, '2025-08-24 08:52:09', '2025-08-24 08:52:09', NULL),
(795, 'App\\Models\\User', 134, 'auth_token', '50d91465c6cbc0c3e5fa1c651b8c1c618715dcfa7d1190cd45f929e8cd6431dd', '[\"*\"]', NULL, '2025-08-24 09:04:49', '2025-08-24 09:04:49', NULL),
(799, 'App\\Models\\User', 134, 'auth_token', 'fea85140d51e554452949fd68bcd401719b247d576c9c5553f217d930d29dfd1', '[\"*\"]', NULL, '2025-08-24 09:21:17', '2025-08-24 09:21:17', NULL),
(800, 'App\\Models\\User', 134, 'auth_token', '2f42c2f78b26fd545f15df4e0e5023fdc16f3f5fcc339f714d483556d8949c61', '[\"*\"]', NULL, '2025-08-24 09:31:01', '2025-08-24 09:31:01', NULL),
(801, 'App\\Models\\User', 134, 'auth_token', '67f23e387ed06b1864dca46f87d93593dd8fb59d688b47544039fa34d0f17693', '[\"*\"]', NULL, '2025-08-24 09:31:57', '2025-08-24 09:31:57', NULL),
(810, 'App\\Models\\User', 134, 'auth_token', '38e403188d71503472efde1eb03f926f8a1ebc4d29866eff2da7e98ad7a5101a', '[\"*\"]', NULL, '2025-08-24 10:03:38', '2025-08-24 10:03:38', NULL),
(811, 'App\\Models\\User', 134, 'auth_token', '35eaca63b7b539d49b2eabe65ff44c4d038236d8c69aa264152161b75eeb7b7f', '[\"*\"]', NULL, '2025-08-24 10:04:49', '2025-08-24 10:04:49', NULL),
(812, 'App\\Models\\User', 134, 'auth_token', 'd1fb2ea8e2dc62aefaa1f7b977f7e6d50bac1c20359ef410029e66ed1829bc18', '[\"*\"]', NULL, '2025-08-24 10:06:41', '2025-08-24 10:06:41', NULL),
(813, 'App\\Models\\User', 134, 'auth_token', '141db5b0d9d64ad138402e0b2b3d7d5dcc76812511139aaf185f25e0a7cd8802', '[\"*\"]', NULL, '2025-08-24 10:12:51', '2025-08-24 10:12:51', NULL),
(814, 'App\\Models\\User', 134, 'auth_token', '924dc9f1c018540d1fc11daaa980c5de5f0b46c1d47e4057051181776df0c7d5', '[\"*\"]', NULL, '2025-08-24 10:18:01', '2025-08-24 10:18:01', NULL),
(815, 'App\\Models\\User', 134, 'auth_token', '514857cded61f176607c47811b37f37adf79fece443c5e6266119c192029f903', '[\"*\"]', NULL, '2025-08-24 10:35:44', '2025-08-24 10:35:44', NULL),
(816, 'App\\Models\\User', 134, 'auth_token', '64f3f45c788fed296133f8a0ed0f151dbdc04ae5e38118ce5d819435b1fcbb4c', '[\"*\"]', NULL, '2025-08-24 10:37:01', '2025-08-24 10:37:01', NULL),
(817, 'App\\Models\\User', 134, 'auth_token', 'bd37f37c6957ec8dbfa978dfd4dfd088cebc8aecdff4fe709a4cb87bf329deec', '[\"*\"]', NULL, '2025-08-24 10:40:12', '2025-08-24 10:40:12', NULL),
(818, 'App\\Models\\User', 134, 'auth_token', '4763dcdca0ee0c08265b3cda22906af3cc71197fec30c43508afff888ffef753', '[\"*\"]', NULL, '2025-08-24 10:50:30', '2025-08-24 10:50:30', NULL),
(819, 'App\\Models\\User', 134, 'auth_token', 'd80ef66118cc73e98a8d5cd1d53ce5fbb00380c86e2c60f17407d7f6b26c1241', '[\"*\"]', NULL, '2025-08-24 10:55:01', '2025-08-24 10:55:01', NULL),
(820, 'App\\Models\\User', 134, 'auth_token', 'f74dcc0a3f122b5995a63fb041e95ccffbaf2378750f362f219cb43d28a6115f', '[\"*\"]', NULL, '2025-08-24 11:39:08', '2025-08-24 11:39:08', NULL),
(821, 'App\\Models\\User', 134, 'auth_token', '462cc09e1bcbd4926ec35732cd29460693aeff54b166e50a74e6ed6405b0b7ae', '[\"*\"]', NULL, '2025-08-24 11:50:43', '2025-08-24 11:50:43', NULL),
(822, 'App\\Models\\User', 134, 'auth_token', '6356524189aaaf60073d81f4968119b8da78d2bc4fe334a692a2f7688095c666', '[\"*\"]', NULL, '2025-08-24 12:25:08', '2025-08-24 12:25:08', NULL),
(823, 'App\\Models\\User', 134, 'auth_token', '388ef524d0c03e6f5af397acd16fa889411bad3d224181a4e6befd39030455f5', '[\"*\"]', NULL, '2025-08-24 13:25:51', '2025-08-24 13:25:51', NULL),
(824, 'App\\Models\\User', 134, 'auth_token', 'efba3fb12aeea32d0f3232d59d26f6fb8b771c6864587c43774329047a1d69e5', '[\"*\"]', NULL, '2025-08-24 13:33:09', '2025-08-24 13:33:09', NULL),
(826, 'App\\Models\\User', 134, 'auth_token', '6f5fb9d30201cffd4f39dfec80cece1599d52f0402fc3bfa2f6b4346ffd8100e', '[\"*\"]', NULL, '2025-08-24 13:45:49', '2025-08-24 13:45:49', NULL),
(827, 'App\\Models\\User', 134, 'auth_token', 'd2e2b4c8c317e818198e8374c8c81c4f8561402b8a472a712a454a457f989f1e', '[\"*\"]', NULL, '2025-08-24 13:52:18', '2025-08-24 13:52:18', NULL),
(829, 'App\\Models\\User', 134, 'auth_token', '00c70e04325824d19e9bf2432a8c3322c74ad332f9a0e2865bcc789affdcf03c', '[\"*\"]', NULL, '2025-08-24 14:01:40', '2025-08-24 14:01:40', NULL),
(830, 'App\\Models\\User', 134, 'auth_token', '9863d86afcffd9d95d7be40db96e036148c33953a78998075eca0751f2eda481', '[\"*\"]', NULL, '2025-08-24 14:02:03', '2025-08-24 14:02:03', NULL),
(835, 'App\\Models\\User', 135, 'auth_token', 'ea79581f3353ff9b11459a18b96fce02934beb8bca534a6c2f14574958e8b82e', '[\"*\"]', NULL, '2025-08-24 15:46:41', '2025-08-24 15:46:41', NULL),
(836, 'App\\Models\\User', 136, 'auth_token', '60d30a6d56aeb7ee0ed848a7a938600f149a778a637745c653be93e8eec7dba3', '[\"*\"]', NULL, '2025-08-25 15:29:46', '2025-08-25 15:29:46', NULL),
(837, 'App\\Models\\User', 134, 'auth_token', '36ef4aab77bba18dc1371e48a30979965c8d31c7c915c0ab3b766001a76a728e', '[\"*\"]', NULL, '2025-08-25 15:41:43', '2025-08-25 15:41:43', NULL),
(840, 'App\\Models\\User', 96, 'auth_token', 'dbd05c215de724e3a44d7ac351e4f195c3568c59515bf4fbf714c3fda17830f1', '[\"*\"]', '2025-08-26 05:53:32', '2025-08-26 05:49:54', '2025-08-26 05:53:32', NULL),
(841, 'App\\Models\\User', 96, 'auth_token', '81698a2fc1744220f71bdb7a0786ea8d447ba2f1745c68101f393aa73291245e', '[\"*\"]', NULL, '2025-08-26 05:53:32', '2025-08-26 05:53:32', NULL),
(842, 'App\\Models\\User', 137, 'auth_token', '614c79bd86f2bf729fd27757cd97244f615c8a0d41f69ea1d71aa5390b115e26', '[\"*\"]', NULL, '2025-08-27 15:12:08', '2025-08-27 15:12:08', NULL),
(843, 'App\\Models\\User', 137, 'auth_token', '6760eca8c4c28a4db3f330b0e86cd04836a09e48c5fa129da474598469ae18fe', '[\"*\"]', NULL, '2025-08-27 15:12:54', '2025-08-27 15:12:54', NULL),
(844, 'App\\Models\\User', 137, 'auth_token', 'ea5aa3f16fb6c91ef56590e4bcdd121a52da3d59e2ddcd9edbba1203e18e3085', '[\"*\"]', NULL, '2025-08-27 15:15:45', '2025-08-27 15:15:45', NULL),
(845, 'App\\Models\\User', 127, 'auth_token', 'e1dc57a043eb93a9136ebd007123f95411a2e0034237adc58a50c2ce54f33307', '[\"*\"]', '2025-08-27 16:05:32', '2025-08-27 16:05:26', '2025-08-27 16:05:32', NULL),
(912, 'App\\Models\\User', 148, 'auth_token', '26b5af9f90ba9ef1707c6be29c9f4b3d9e53b26eae154a33816084087ff1085a', '[\"*\"]', NULL, '2025-08-29 19:26:12', '2025-08-29 19:26:12', NULL),
(913, 'App\\Models\\User', 148, 'auth_token', '3b3aef7e2744afebdfe3a175359b02a12f8e31e7ff5edeb8745283777fc21fe7', '[\"*\"]', NULL, '2025-08-29 19:27:56', '2025-08-29 19:27:56', NULL),
(940, 'App\\Models\\User', 151, 'auth_token', 'df822f2c192eb0b3b771ad061f13ac0b752348e03af5c0ad65513303f7333bbd', '[\"*\"]', NULL, '2025-08-29 22:14:28', '2025-08-29 22:14:28', NULL),
(950, 'App\\Models\\User', 153, 'auth_token', 'bf58f65d6a936502e7db84fa64559e902a23afb96e64bd2aac1c70ca0a761695', '[\"*\"]', NULL, '2025-08-30 07:46:35', '2025-08-30 07:46:35', NULL),
(951, 'App\\Models\\User', 154, 'auth_token', 'bddb2a6633edce186738faab2a22af10e6989c64d70a45eff40d077a8723a943', '[\"*\"]', NULL, '2025-08-30 07:56:56', '2025-08-30 07:56:56', NULL),
(952, 'App\\Models\\User', 154, 'auth_token', '343f9a3112af5c6c3e28224311f93c5895ee0ac2d43e662e63339f7ec4ba846b', '[\"*\"]', NULL, '2025-08-30 08:12:06', '2025-08-30 08:12:06', NULL),
(959, 'App\\Models\\User', 134, 'auth_token', 'e51e6620c783395e9ddaba8661648a61198ea40f3763413e69f64cb9325549ab', '[\"*\"]', NULL, '2025-08-30 08:47:29', '2025-08-30 08:47:29', NULL),
(961, 'App\\Models\\User', 156, 'auth_token', 'fc4437c5467ecbe2b7a27fe80fe7549153a0b6c3decaa0d334444bbb09b063e9', '[\"*\"]', NULL, '2025-08-30 12:02:00', '2025-08-30 12:02:00', NULL),
(962, 'App\\Models\\User', 157, 'auth_token', '78898685ecce27e4e719a6566c48cd16c348748943eb350c3b3ac75f498c953b', '[\"*\"]', NULL, '2025-08-30 12:05:52', '2025-08-30 12:05:52', NULL),
(982, 'App\\Models\\User', 131, 'auth_token', '046a39202c0d145ddb554907902c70155406afe1fea0f75c51d625bea3c7c7b7', '[\"*\"]', NULL, '2025-08-30 14:46:41', '2025-08-30 14:46:41', NULL),
(983, 'App\\Models\\User', 134, 'auth_token', '4fff823204b84c1b7c1ae38a4ea467fdb5aa64f789cfb3cbd3ba419868a5092c', '[\"*\"]', NULL, '2025-08-31 02:29:48', '2025-08-31 02:29:48', NULL),
(984, 'App\\Models\\User', 134, 'auth_token', 'a06cb4c9084fddec230258ed74fec86890f9239367854c34723fdeda4ed27a5a', '[\"*\"]', NULL, '2025-08-31 02:45:19', '2025-08-31 02:45:19', NULL),
(985, 'App\\Models\\User', 134, 'auth_token', 'f6fc391c1c48e9e1f63d6417962c08c8672a6762c02633653d7b1fae4545d0ff', '[\"*\"]', NULL, '2025-08-31 03:05:06', '2025-08-31 03:05:06', NULL),
(986, 'App\\Models\\User', 134, 'auth_token', 'a0144ecd502cbe3cdb1d0045f60a06bcd759a3f3150b439e6ebdc54c170d5a92', '[\"*\"]', NULL, '2025-08-31 03:06:24', '2025-08-31 03:06:24', NULL),
(987, 'App\\Models\\User', 134, 'auth_token', '66c1d6c00d09de26c5f82474f88f282687f2605e1212a522ea88da9b7f47aec7', '[\"*\"]', NULL, '2025-08-31 03:22:14', '2025-08-31 03:22:14', NULL),
(988, 'App\\Models\\User', 134, 'auth_token', '751d2f85542298e8bc66ed0eb6fde9b341cadbe9af209698198bf7ce19a526f9', '[\"*\"]', NULL, '2025-08-31 05:00:54', '2025-08-31 05:00:54', NULL),
(989, 'App\\Models\\User', 134, 'auth_token', '5b857451815d88bddd614da52c2002ccd964871912701d51f1e6a8de55c89026', '[\"*\"]', NULL, '2025-08-31 08:12:14', '2025-08-31 08:12:14', NULL),
(990, 'App\\Models\\User', 134, 'auth_token', 'f0b3dd297e45d98915eaae324877232bf67b14bc113f0910fdc6b3c89be0f2c2', '[\"*\"]', NULL, '2025-08-31 08:24:39', '2025-08-31 08:24:39', NULL),
(991, 'App\\Models\\User', 134, 'auth_token', '6507dfd87c262f0500def008c4398af8db4fd800f0e072c5fc3d690a1fd69a3a', '[\"*\"]', NULL, '2025-08-31 08:42:05', '2025-08-31 08:42:05', NULL),
(992, 'App\\Models\\User', 134, 'auth_token', 'bc9d98ee6c7d401e75d1189ac07484d191a35bcc3538c79ff92b4db6dd1521a2', '[\"*\"]', NULL, '2025-08-31 08:43:44', '2025-08-31 08:43:44', NULL),
(993, 'App\\Models\\User', 134, 'auth_token', 'ddd02324748bbd65019acd371edacc05d1b29c692d6383b55944f9c74298e409', '[\"*\"]', NULL, '2025-08-31 09:28:09', '2025-08-31 09:28:09', NULL),
(994, 'App\\Models\\User', 134, 'auth_token', '95fa877206d49f4597178bdfd0b16ac52e7dd0bc982a77ca4203d064711c5861', '[\"*\"]', NULL, '2025-08-31 09:42:44', '2025-08-31 09:42:44', NULL),
(995, 'App\\Models\\User', 134, 'auth_token', '08f1c529c3463cf4bae973652549b8def1c1dd400f7c2a1cf2a02ecb8c18b8d5', '[\"*\"]', NULL, '2025-08-31 09:49:38', '2025-08-31 09:49:38', NULL),
(996, 'App\\Models\\User', 134, 'auth_token', '0671e3195857e04a5fb8121a4b4910b5a863b56b3e73eca8230bd3541c5988b9', '[\"*\"]', NULL, '2025-08-31 09:57:19', '2025-08-31 09:57:19', NULL),
(997, 'App\\Models\\User', 134, 'auth_token', 'd6c58382a48c5166ff564652f92c6e359f7e829a4e2a507363056047a0546c60', '[\"*\"]', '2025-09-06 04:13:45', '2025-08-31 10:28:55', '2025-09-06 04:13:45', NULL),
(998, 'App\\Models\\User', 134, 'auth_token', '5bb7933e070d0146a59b9fec99f9d8a5299acbcce651029aa6725a57d08f17db', '[\"*\"]', NULL, '2025-08-31 12:40:36', '2025-08-31 12:40:36', NULL),
(999, 'App\\Models\\User', 134, 'auth_token', 'c8fe819ca55a13f38cd3a57159829a7ce52fd87143cd750f11c49da4072c9238', '[\"*\"]', NULL, '2025-08-31 12:40:46', '2025-08-31 12:40:46', NULL),
(1000, 'App\\Models\\User', 131, 'auth_token', '86fa83f7758539d0af94b9577cdc84c1120f4e06e03f853dea0baf5966aa4611', '[\"*\"]', '2025-08-31 15:31:23', '2025-08-31 15:29:45', '2025-08-31 15:31:23', NULL),
(1001, 'App\\Models\\User', 131, 'auth_token', 'da79ae2ac5010a0a203b2e50be795f8d7a9f9f889db4323ed11099f76b7332e3', '[\"*\"]', NULL, '2025-08-31 15:31:17', '2025-08-31 15:31:17', NULL),
(1002, 'App\\Models\\User', 96, 'auth_token', '156efff1ea49280999000d2068846b25a43db387d1dc59d2c19fbdd063653f76', '[\"*\"]', '2025-08-31 15:33:02', '2025-08-31 15:32:33', '2025-08-31 15:33:02', NULL),
(1003, 'App\\Models\\User', 131, 'auth_token', '5fdafa689adc416c6137a301d611e9aa1cc918393fe15a9c753109bec0939872', '[\"*\"]', '2025-09-01 02:34:18', '2025-09-01 02:31:30', '2025-09-01 02:34:18', NULL),
(1010, 'App\\Models\\User', 159, 'auth_token', 'be7a090bb7b807fee3b0a6c40d2d21c3edf5d1a47be3535b0d8fde6d764e8218', '[\"*\"]', NULL, '2025-09-01 14:15:59', '2025-09-01 14:15:59', NULL),
(1011, 'App\\Models\\User', 159, 'auth_token', 'e8b8860765f1abc17a37e41cfd04d490b2a65ed46a7a6eba990a1fc6ba98a2d5', '[\"*\"]', '2025-09-02 15:12:52', '2025-09-01 14:19:07', '2025-09-02 15:12:52', NULL),
(1016, 'App\\Models\\User', 161, 'auth_token', 'b3d6329d4a2479d1d5779926424d95a87b4e4cf4de571edd2e31d3b7d6821bbd', '[\"*\"]', NULL, '2025-09-01 15:39:54', '2025-09-01 15:39:54', NULL),
(1017, 'App\\Models\\User', 161, 'auth_token', 'b01e38b3118da091497f69970cd6a2fe494c747ae1b6cd3f3a9545639df4fdad', '[\"*\"]', NULL, '2025-09-01 15:45:11', '2025-09-01 15:45:11', NULL),
(1025, 'App\\Models\\User', 127, 'auth_token', '52d419091daeb1aa953e5548a622dc0c7f48a1010dc8f0586b644def05139308', '[\"*\"]', '2025-09-02 14:56:59', '2025-09-02 14:11:23', '2025-09-02 14:56:59', NULL),
(1026, 'App\\Models\\User', 127, 'auth_token', 'df6e8b8f13cd7eef2e5c10933de68ec74bc4cb501a0799950dd07b1153a42d3d', '[\"*\"]', NULL, '2025-09-02 14:11:43', '2025-09-02 14:11:43', NULL),
(1029, 'App\\Models\\User', 163, 'auth_token', '86edd184649a12e12168171879b08c75b32ae967bdccfe49b45059d85cd6ce98', '[\"*\"]', NULL, '2025-09-02 14:22:34', '2025-09-02 14:22:34', NULL),
(1030, 'App\\Models\\User', 101, 'auth_token', '066ef94b5c5c1d7eadb07035f116ea5f291c84538cba0abac59e2f0cf076da9c', '[\"*\"]', '2025-09-02 14:52:57', '2025-09-02 14:39:38', '2025-09-02 14:52:57', NULL),
(1031, 'App\\Models\\User', 127, 'auth_token', '0f385d873a7b9896a272b078979bae6e4f4b8c8ecc7bd60657f91224f151a0d9', '[\"*\"]', NULL, '2025-09-02 14:40:12', '2025-09-02 14:40:12', NULL),
(1032, 'App\\Models\\User', 127, 'auth_token', 'a6af71d00b6cb263a4ec6da697d6a6d800d586f7a0340a7498c99154099187c3', '[\"*\"]', NULL, '2025-09-02 14:40:18', '2025-09-02 14:40:18', NULL),
(1033, 'App\\Models\\User', 163, 'auth_token', '23977179df5ee4f8ecd02b7a518938244509eabdc5bf32f9ee520924392eceb5', '[\"*\"]', NULL, '2025-09-02 14:47:07', '2025-09-02 14:47:07', NULL),
(1035, 'App\\Models\\User', 164, 'auth_token', 'edc6b56b4fcd20212db90ee0a707990b3e22cff93f4ee1f25b141697ac6e1960', '[\"*\"]', NULL, '2025-09-02 14:58:54', '2025-09-02 14:58:54', NULL),
(1036, 'App\\Models\\User', 164, 'auth_token', 'e44ac1874f3edaae39383e6f902b7cab0c30cef964a9fe90c76e5409e46dcd27', '[\"*\"]', NULL, '2025-09-02 14:59:33', '2025-09-02 14:59:33', NULL),
(1038, 'App\\Models\\User', 164, 'auth_token', 'a9eca7ccee8718a42cd872239447db1367977f0b802e906dde0cf6aa5f10e638', '[\"*\"]', NULL, '2025-09-02 15:19:23', '2025-09-02 15:19:23', NULL),
(1039, 'App\\Models\\User', 164, 'auth_token', 'c53cc61fbe53ddeddd888137973736cee47c3007f97cf4cb761be757d29a9205', '[\"*\"]', NULL, '2025-09-02 15:23:01', '2025-09-02 15:23:01', NULL),
(1040, 'App\\Models\\User', 164, 'auth_token', '1db1e8830b960eaef6b5b1b8032d943c879bcaefdb8a7d99d009fa457d07597f', '[\"*\"]', NULL, '2025-09-02 15:31:53', '2025-09-02 15:31:53', NULL),
(1042, 'App\\Models\\User', 165, 'auth_token', '3d09ebaa7c0baf73b2dd1dcf5a53ce23b6028c296b08a810f81f33cab40010f1', '[\"*\"]', NULL, '2025-09-02 15:33:57', '2025-09-02 15:33:57', NULL),
(1043, 'App\\Models\\User', 165, 'auth_token', '79ffe8f560ccb4517452358441e6b53b6425a9c59f968d6156a8ece7eebee417', '[\"*\"]', NULL, '2025-09-02 15:39:01', '2025-09-02 15:39:01', NULL),
(1044, 'App\\Models\\User', 165, 'auth_token', '070a020cb152fa6d7890b6fae108566be34e112e9506d5285113ab930b392f49', '[\"*\"]', NULL, '2025-09-02 15:39:56', '2025-09-02 15:39:56', NULL),
(1046, 'App\\Models\\User', 166, 'auth_token', '6caf71a7d4d5fc42f4b408000dc3e7673dac76e0e6f049ba06c3e28598d44358', '[\"*\"]', NULL, '2025-09-02 15:46:48', '2025-09-02 15:46:48', NULL),
(1047, 'App\\Models\\User', 166, 'auth_token', '9204bb999624b433ab5e330ca69734f15dc9035f29062764ce57ab824c6fb8cb', '[\"*\"]', NULL, '2025-09-02 15:49:17', '2025-09-02 15:49:17', NULL),
(1049, 'App\\Models\\User', 167, 'auth_token', '4fd7443d86ef05e516b88439a0f50030b03f8fa7b8c7834b7a84756f928758b8', '[\"*\"]', NULL, '2025-09-02 16:15:36', '2025-09-02 16:15:36', NULL),
(1050, 'App\\Models\\User', 167, 'auth_token', '5780d73be31c533a53b7807b327f9d853fb44f8ec3c8353112bb91997d06fd49', '[\"*\"]', NULL, '2025-09-02 16:16:47', '2025-09-02 16:16:47', NULL),
(1054, 'App\\Models\\User', 173, 'auth_token', '9a01058241ab5cba9a6792af16d1d8ba445a88530c666c046ac791065db2d0e8', '[\"*\"]', NULL, '2025-09-02 16:36:10', '2025-09-02 16:36:10', NULL),
(1057, 'App\\Models\\User', 178, 'auth_token', 'ea98d5cf4dadbc4978932a7f76bbf0df537de7d8a86dba8535a135d1e4d4b74a', '[\"*\"]', NULL, '2025-09-03 14:24:55', '2025-09-03 14:24:55', NULL),
(1058, 'App\\Models\\User', 178, 'auth_token', '9dd20a71cab65e376a4a064021dd0f95f005fa36586136d8ae649c3047214691', '[\"*\"]', NULL, '2025-09-03 14:26:14', '2025-09-03 14:26:14', NULL),
(1059, 'App\\Models\\User', 178, 'auth_token', 'c550e355c3cc0ec6fc34e63d570d5b01451c5bb733d2921f16071e5239f97c7d', '[\"*\"]', NULL, '2025-09-03 14:30:20', '2025-09-03 14:30:20', NULL),
(1060, 'App\\Models\\User', 179, 'auth_token', 'af9c8be4d8becc06bbfff74f1e3fe464a7b5026f5d2912ae8c08a314cb046df2', '[\"*\"]', NULL, '2025-09-03 14:39:04', '2025-09-03 14:39:04', NULL),
(1061, 'App\\Models\\User', 179, 'auth_token', '4a08937e311e67739327b855bbccaff19974d5e7aa09186e928510897351d41f', '[\"*\"]', NULL, '2025-09-03 14:43:05', '2025-09-03 14:43:05', NULL),
(1065, 'App\\Models\\User', 181, 'auth_token', 'ec99900cd8b4e9c07733b07d00fd728daeff6d8acf0ee9d432113c85de1ad37a', '[\"*\"]', NULL, '2025-09-03 15:26:49', '2025-09-03 15:26:49', NULL),
(1066, 'App\\Models\\User', 181, 'auth_token', '356047e747a72d614473ffd2927be6536cb0107e34abc6f50ab7f004953c7b55', '[\"*\"]', NULL, '2025-09-03 15:30:59', '2025-09-03 15:30:59', NULL),
(1067, 'App\\Models\\User', 182, 'auth_token', '5810075ea4d0b9cc79a870fe1f1334069f3c5b6eba30712cd06aecb8f406c112', '[\"*\"]', NULL, '2025-09-03 15:38:40', '2025-09-03 15:38:40', NULL),
(1068, 'App\\Models\\User', 182, 'auth_token', 'de6c6869dbafdd14122c84216a8b4f42404fcab2e9792e73edbf97ea17e3c80f', '[\"*\"]', NULL, '2025-09-03 15:42:25', '2025-09-03 15:42:25', NULL),
(1071, 'App\\Models\\User', 183, 'auth_token', '874fba4e170dd103b754c86d6978ed5dd83589094e904c0eedf9c8d42bc7c919', '[\"*\"]', NULL, '2025-09-05 16:10:28', '2025-09-05 16:10:28', NULL),
(1072, 'App\\Models\\User', 183, 'auth_token', '5f2c22f15047fdd5255da98b4c4be6e3205ddcce60dcecca0c01e58840399ea8', '[\"*\"]', NULL, '2025-09-05 16:13:52', '2025-09-05 16:13:52', NULL),
(1073, 'App\\Models\\User', 184, 'auth_token', '6e95b7b7dd84b33100dad372f7bb11c21776b06b3279625602605cc40db2ea0f', '[\"*\"]', NULL, '2025-09-05 16:23:57', '2025-09-05 16:23:57', NULL),
(1074, 'App\\Models\\User', 184, 'auth_token', '15206d3b26a929333ad8de053b4c9c5a4ced1d3c5ef341e4edb37990d89c43ba', '[\"*\"]', NULL, '2025-09-05 16:33:15', '2025-09-05 16:33:15', NULL),
(1075, 'App\\Models\\User', 185, 'auth_token', '4346da3bd4f6d32622f716930a5e9aee3127279230654faa736964b592eeb736', '[\"*\"]', NULL, '2025-09-05 17:03:20', '2025-09-05 17:03:20', NULL),
(1076, 'App\\Models\\User', 185, 'auth_token', '845d434c0154882a92f0382a4195e66f7f816916878362eb8508c2ad9889542d', '[\"*\"]', NULL, '2025-09-05 17:06:09', '2025-09-05 17:06:09', NULL),
(1077, 'App\\Models\\User', 186, 'auth_token', 'fc499260cdc1062c4028216b49718b4e5a88969126068cff3fc89817a67e1a24', '[\"*\"]', NULL, '2025-09-05 17:32:36', '2025-09-05 17:32:36', NULL),
(1078, 'App\\Models\\User', 186, 'auth_token', '8292aafe6dec2eff0fb050e8d971a4e3b248ab10727292d674f1204f92966b7e', '[\"*\"]', NULL, '2025-09-05 17:35:46', '2025-09-05 17:35:46', NULL),
(1081, 'App\\Models\\User', 188, 'auth_token', '1ef103109e774928e42c0c9115bfd2230ac8606cad247ce2e706e7d3096915f9', '[\"*\"]', NULL, '2025-09-05 18:20:35', '2025-09-05 18:20:35', NULL),
(1082, 'App\\Models\\User', 188, 'auth_token', '9f0269bda5e05d763287c1b5c988b03a1e2614d3a1a35ec913a2475ce420496f', '[\"*\"]', NULL, '2025-09-05 18:43:43', '2025-09-05 18:43:43', NULL),
(1083, 'App\\Models\\User', 189, 'auth_token', 'cf3b9153ffc95810f2fed7497b4835ec785208c87685689d8ae517e7146b6920', '[\"*\"]', NULL, '2025-09-06 04:37:31', '2025-09-06 04:37:31', NULL),
(1084, 'App\\Models\\User', 189, 'auth_token', 'bcd74c83143e350440cb3ab0cfb06e37947a91feee2e2a3bd18575a2ff857582', '[\"*\"]', NULL, '2025-09-06 04:43:25', '2025-09-06 04:43:25', NULL),
(1085, 'App\\Models\\User', 189, 'auth_token', '259914724bf5ef5d449da0b1b2271594a801cf3d261bb8054fe5f647befd59cc', '[\"*\"]', NULL, '2025-09-06 04:48:35', '2025-09-06 04:48:35', NULL),
(1086, 'App\\Models\\User', 189, 'auth_token', '170f9b4736a12e43db010f871aec1d74ab050b5e719c40269a7726830209b138', '[\"*\"]', NULL, '2025-09-06 04:52:41', '2025-09-06 04:52:41', NULL),
(1087, 'App\\Models\\User', 189, 'auth_token', '23919a84e513152a82d34e2aba39605096127c363faae32becb73daa69d02ce4', '[\"*\"]', NULL, '2025-09-06 04:57:36', '2025-09-06 04:57:36', NULL),
(1088, 'App\\Models\\User', 189, 'auth_token', '9e15b3ae7c4cd744b2e812e5aad022b09ed5044f836a689bec2b699e23f7711b', '[\"*\"]', NULL, '2025-09-06 05:02:02', '2025-09-06 05:02:02', NULL),
(1089, 'App\\Models\\User', 189, 'auth_token', '67da2342aeb5df63360da74caf33637abf8a1415338d6b34d888ec5286781258', '[\"*\"]', NULL, '2025-09-06 05:05:36', '2025-09-06 05:05:36', NULL),
(1091, 'App\\Models\\User', 189, 'auth_token', '446b9ed94a39a2b76503e9fd4b4bc318993e493b8f5546253bec62e71faed26d', '[\"*\"]', NULL, '2025-09-06 05:37:23', '2025-09-06 05:37:23', NULL),
(1094, 'App\\Models\\User', 189, 'auth_token', 'b95c24dfc7014f1fb941e4068528a1ee237ad4d3a0566cfb147c930db27fe2f6', '[\"*\"]', NULL, '2025-09-06 05:51:09', '2025-09-06 05:51:09', NULL),
(1095, 'App\\Models\\User', 189, 'auth_token', 'ee43fe00b7e13cf1afb4e7fcbe869fa43624e2e7f7480e45318bc2e2edff9ac2', '[\"*\"]', NULL, '2025-09-06 09:01:56', '2025-09-06 09:01:56', NULL),
(1096, 'App\\Models\\User', 189, 'auth_token', '0370e724be3dce81ddd50a18fad04cd594790ccf2969ad57dfd7a5e2b2414e5d', '[\"*\"]', NULL, '2025-09-06 09:08:57', '2025-09-06 09:08:57', NULL),
(1097, 'App\\Models\\User', 189, 'auth_token', 'cb4111cae8141e326a2735476b65fdafb4c75e7979a7fd13f10c262a0191fbbf', '[\"*\"]', NULL, '2025-09-06 09:11:04', '2025-09-06 09:11:04', NULL),
(1098, 'App\\Models\\User', 189, 'auth_token', '7995ff144c97d45160a45071aa2eb58bb957a22f21044383a7961128a21da1bb', '[\"*\"]', '2025-09-07 09:10:13', '2025-09-06 09:18:21', '2025-09-07 09:10:13', NULL);
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(1107, 'App\\Models\\User', 138, 'auth_token', 'b80e2dfb3f4f734c3ef3295c1ed5df085e8fcf421146f42b5ff55ef3facbff43', '[\"*\"]', '2025-09-08 15:02:03', '2025-09-07 05:24:58', '2025-09-08 15:02:03', NULL),
(1108, 'App\\Models\\User', 138, 'auth_token', 'bde1df1b9eb05b51009ad8cdc129e632212c919b3db9c00af57e9850e4bf47d9', '[\"*\"]', '2025-09-07 15:03:15', '2025-09-07 06:25:48', '2025-09-07 15:03:15', NULL),
(1110, 'App\\Models\\User', 189, 'auth_token', '7810c08ec28a66529bd733b65175a13a55c23cf27d96b61bc0295c8252af8492', '[\"*\"]', '2025-09-08 08:46:15', '2025-09-07 09:13:51', '2025-09-08 08:46:15', NULL),
(1115, 'App\\Models\\User', 138, 'auth_token', '2e2891f66dd6081a3e956f5a492168633887ed23560fa2ae64302679390fef18', '[\"*\"]', '2025-09-08 17:03:35', '2025-09-07 15:47:51', '2025-09-08 17:03:35', NULL),
(1116, 'App\\Models\\User', 191, 'auth_token', '147d6510f092297fc9954c5dcf8578ed5b5de35163702a463f85ce40a9a6ee7f', '[\"*\"]', NULL, '2025-09-08 03:17:48', '2025-09-08 03:17:48', NULL),
(1117, 'App\\Models\\User', 189, 'auth_token', '197d549618ac193b995cda654d8c403add179121d2ab8c495af92cbd49a37c46', '[\"*\"]', '2025-09-08 08:47:26', '2025-09-08 08:47:23', '2025-09-08 08:47:26', NULL),
(1118, 'App\\Models\\User', 189, 'auth_token', '6524d0a6027aae3358fcae23b2afa5677de9b23b999326e10f93b5a51c7b4e50', '[\"*\"]', '2025-09-08 09:04:28', '2025-09-08 08:49:25', '2025-09-08 09:04:28', NULL),
(1119, 'App\\Models\\User', 189, 'auth_token', 'ab1ddfa26c2c3ade920da89ee29c60e86f4c8667753458b64a8e4f69cc3b6197', '[\"*\"]', NULL, '2025-09-08 08:50:30', '2025-09-08 08:50:30', NULL),
(1120, 'App\\Models\\User', 189, 'auth_token', '08324f1e7d04f6482b12174de9af95a36d0c4c37ae4db54f5cc2bd323f01bdd9', '[\"*\"]', NULL, '2025-09-08 08:54:32', '2025-09-08 08:54:32', NULL),
(1121, 'App\\Models\\User', 189, 'auth_token', '893af9f07ec6158920a945d71912d017b4130f794aa974803010f8111356418d', '[\"*\"]', '2025-09-08 09:05:55', '2025-09-08 09:04:48', '2025-09-08 09:05:55', NULL),
(1122, 'App\\Models\\User', 189, 'auth_token', '2d2aeb148a40ca8c416ffd300b8f575f0fc4d06bcd5bc4a80da22c0c064e5b7c', '[\"*\"]', '2025-09-08 09:07:43', '2025-09-08 09:06:12', '2025-09-08 09:07:43', NULL),
(1123, 'App\\Models\\User', 189, 'auth_token', '1092e111977296c744d569300434719a790f1cd7eb9f097e3b2dc2e0f350c0b2', '[\"*\"]', '2025-09-08 09:10:04', '2025-09-08 09:08:03', '2025-09-08 09:10:04', NULL),
(1124, 'App\\Models\\User', 189, 'auth_token', '698c56a3c58de179c01146a00e3164b6d4726ca23389aea6e01399ea43436f84', '[\"*\"]', '2025-09-08 09:11:32', '2025-09-08 09:10:20', '2025-09-08 09:11:32', NULL),
(1125, 'App\\Models\\User', 189, 'auth_token', '7e5a1472f3a9e9e7c9e8f9f02636dfd8eefbcc9161b83476a97c1c0dc472c932', '[\"*\"]', '2025-09-08 09:13:04', '2025-09-08 09:11:50', '2025-09-08 09:13:04', NULL),
(1126, 'App\\Models\\User', 189, 'auth_token', '7ff08760716a554e81eab6a6f5217a38431ec8f7456e774aad27cf148e7389ce', '[\"*\"]', '2025-09-08 10:08:50', '2025-09-08 09:13:20', '2025-09-08 10:08:50', NULL),
(1127, 'App\\Models\\User', 189, 'auth_token', '1d2cd54030b3b2e0b3b87985a36516fe74eee7436a0cbec5b7bb990a901bdba0', '[\"*\"]', '2025-09-09 03:59:13', '2025-09-08 10:09:29', '2025-09-09 03:59:14', NULL),
(1128, 'App\\Models\\User', 189, 'auth_token', '970e832bc18e60a2e9737941d903abc642f71cc8b50415f617c4957c7db4cc6a', '[\"*\"]', NULL, '2025-09-08 10:47:00', '2025-09-08 10:47:00', NULL),
(1133, 'App\\Models\\User', 158, 'auth_token', '57d4bd0902026e275b71ff6d7637590f15b3667ebcd3a0f2819f1cf39c2d3122', '[\"*\"]', '2025-09-09 04:30:26', '2025-09-09 04:27:48', '2025-09-09 04:30:26', NULL),
(1135, 'App\\Models\\User', 194, 'auth_token', 'e56fcfc739aa2a6f08f9b9c5f99417e3ff0c34aa4026e5c1b3c0b20fd5088601', '[\"*\"]', NULL, '2025-09-09 06:00:42', '2025-09-09 06:00:42', NULL),
(1136, 'App\\Models\\User', 194, 'auth_token', '7c60cfc2b531bebb4b545c96fa3645deacb69c20b0d98248ab774bdf7d0a4014', '[\"*\"]', NULL, '2025-09-09 06:05:22', '2025-09-09 06:05:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4KqomN3Zh4X4uQXqARbzsV134lWK1ReLESDTAH56', NULL, '188.197.163.176', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/123.0.6312.52 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHBPcUZIZUZmMW5aVGdWQjNmQUFOSG5sQVRkWmxMTkdxNXRVakpqMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvdXNlci92aWV3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1757339443),
('8IqtXv5g4pXqduT1XclcQHAqRwJltudP877QUgj4', NULL, '172.253.7.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDVCMFlWcUlDRjZrU3ZKQ2ZDQWVqbkNLVU5tbHlEQWJGV3YwU2dYSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757342285),
('9bn69m4k7xNw2IsILSF9B8FJEOxhb8fmRJYRqaSB', NULL, '152.59.20.27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUdRNnU1Q1FZenJ3TGlheWFKakV0Q1dHcHR4WU1idUFCbHhCaGNEVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvdXNlci9hZGQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757346501),
('iPSyqn9HOFWUDQ3QAFdgtvTmhyYXdTzuu5h0nVSO', NULL, '213.229.218.155', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaU40WUtNa1BtSWg5TGV0Z1FHNkRUb01BVkVkMzRmZ3k2cWxsTmU1ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwczovL21hc3Rlci1hcHAuYnVibGVlLm1lL3VzZXIvdmlldyI7fX0=', 1757404743),
('JazmafsxZr7nwyLBUCILYRZ8gdMPeP5F56HADq4A', NULL, '122.182.200.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkxya0xhNkY0YldJTlV2bkNDNGRBOExEckhndkpad09YVWZiY2NVciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757400519),
('jBZlk4mjPTEpdLj5RccSQjzTOPctM0fp3aFUbB2Y', NULL, '194.152.16.24', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/123.0.6312.52 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibXZGVzJ4YjlYY05NN3JIeXdseGcxWHhCTE5wVXYzN2dHdzhjbjcwRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvdXNlci9hZGQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757349942),
('qpqNuu7VgqLWhqwPW6CwsAuv0ICX5jOMohJRXy2X', NULL, '67.61.40.4', 'Mozilla/5.0 (Linux; Android 15; SM-S901U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXNuNWlWUTdmeGRoVlJMMzlSbUFWUHhvcGV4cWI5RVNVV0pqZjI5NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757339206),
('R9hJSOcyASAjMbDbzz6YcxAPfiCbn716wB3logSp', NULL, '49.36.70.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2c0cjBRNGtVQlE2WDRMbWlFVTBvQjM0N3dhVWM1NTNrUDVkOHN0dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757350754),
('rvIm5FeNf8f3XR8WYkgXmmvrVLRGa99EG05jGTJ9', NULL, '122.182.200.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0l3Nk5GRUNTQjljaHhvSHR0ckxMTlZDSHJZOFRYZ3BBN1JDbm1mYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757361419),
('sz1yp7WnHBZctYkfzNV2DyKkEnbYiHLkrAb5OS3m', NULL, '49.36.70.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGZMOE1zSXZvVnpwOEh4SXFqT0dMQ1lScG1RU1hEcklIZ1pYcDhjaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwczovL21hc3Rlci1hcHAuYnVibGVlLm1lL3VzZXIvYWRkIjt9fQ==', 1757341947),
('wG3NXV00GfWNJ9aw8QqtG38wBAzObUASM1oz9C1t', NULL, '213.229.218.155', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2FoTTVqVWVQRUhpTHBxSXV2bHZSSnBDcW9sdlphZWt3S3FyZkhvRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwczovL21hc3Rlci1hcHAuYnVibGVlLm1lL3VzZXIvdmlldyI7fX0=', 1757360156),
('x2i7FlSbWfesmpZpbRPtuqjt3mlikcWZLwp7s9a9', NULL, '122.182.200.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmg5ejE3ck02cjFicGlCRUJDcTd0MFJ1ZG1pM0JjdXFXdHhYZmxIaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWFzdGVyLWFwcC5idWJsZWUubWUvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1757342483);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `media_type` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  `likes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `media_url`, `media_type`, `text`, `likes`, `created_at`, `updated_at`, `expires_at`) VALUES
(26, 112, '/storage/stories/7eoUk7neX4SKRQicqpKnmDd0jyL0XRPlGovqPvmT.jpg', 'image', NULL, 0, '2025-07-20 17:41:15', '2025-07-20 17:41:15', '2025-07-21 17:41:15'),
(30, 130, '/storage/stories/avo0dmDfmVWn1cvuiDjJHh97G2yqVuv2TpVZ6IsB.jpg', 'image', 'good morning', 0, '2025-08-13 12:22:05', '2025-08-13 12:22:05', '2025-08-14 12:22:05'),
(33, 138, '/storage/stories/osQWB5eZBI6YnORmqeyOC9JvmDtTu5L29Rz5tyaI.jpg', 'image', 'happy birthday', 0, '2025-09-07 05:25:36', '2025-09-07 05:25:36', '2025-09-08 05:25:36'),
(34, 125, '/storage/stories/Bd39XSkFyuyQKBUeNsO1gfXZUg5pgNKWvPuydE6c.jpg', 'image', 'test', 0, '2025-09-07 06:31:07', '2025-09-07 06:31:07', '2025-09-08 06:31:07'),
(35, 125, '/storage/stories/59w3vjqJmZstIqZZWyW7ptH9kKCQohXCMJRrPix3.jpg', 'image', 'test', 0, '2025-09-08 15:41:37', '2025-09-08 15:41:37', '2025-09-09 15:41:37'),
(36, 138, '/storage/stories/KtByEPWtjovGaHsSO5XCvczGdswPw4L1VoLZw3RT.png', 'image', 'New Story', 0, '2025-09-08 15:45:29', '2025-09-08 15:45:29', '2025-09-09 15:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `story_views`
--

CREATE TABLE `story_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `freeze_account` tinyint(1) NOT NULL DEFAULT 0,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_verify` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nick_name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `freeze_account`, `current_team_id`, `profile_photo_path`, `google_id`, `fcm_token`, `status`, `user_verify`, `created_at`, `updated_at`, `expires_at`) VALUES
(94, 'SUNIT GUPTA', 'SUNIT GUPTA', 'sunit2003@gmail.com', NULL, '$2y$10$8cm2wvrEB8Wkes2HfCFyUu1voIZnByYbpdQCLarzH6vW9FwhWPSw2', NULL, NULL, NULL, 0, NULL, 'profile_photos/vN21DwgQdYWdyGMVrAw5bFDMYPaSVblQlVlVVhNp.jpg', NULL, 'csLsi-9eRAmEPzldr38lZQ:APA91bEeR06O36RtC3MDpzIngNHHIFl0c6gXvNFKPWprbIdbA0kZJQE_xoysqXf4RB-OFjSpww3iHUjcQkT389Fd0A-q0FBIbS-FTxmbhLEykZpm0hdZDrM', 2, 0, NULL, '2025-07-14 07:45:22', NULL),
(95, 'SUNIT GUPTA', 'SUNIT GUPTA', '200123sunit@gmail.com', NULL, '$2y$10$HAhXIWCn7Ut4D89wgVfbJOsSKkA38gVqTyxOM6.LeH34wXy7mNWa.', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'csLsi-9eRAmEPzldr38lZQ:APA91bEeR06O36RtC3MDpzIngNHHIFl0c6gXvNFKPWprbIdbA0kZJQE_xoysqXf4RB-OFjSpww3iHUjcQkT389Fd0A-q0FBIbS-FTxmbhLEykZpm0hdZDrM', 2, 0, '2025-07-14 06:23:43', '2025-07-14 06:23:43', NULL),
(97, 'Rahul Modi', 'Rahul Modi', 'modirahul886@gmail.com', NULL, '$2y$10$96pwPTWfX27S31ephDii4udEKkaHxNxMVDJMnV2qMnl8s8.2Ix/ka', NULL, NULL, NULL, 0, NULL, 'profile_photos/MO8phbJ1Ca3PisIycAvt6jKwboBX5X4ZUBJsKzhu.jpg', NULL, 'dueHBRDaRj-qgPGXP8W96S:APA91bHvzoVN9uNgxeSqzyrrGJaAeTI5XXUKyNieVVqDU1_hnEkwqXh9mJnNh0Lle4SS_jQgV0UMupq5MLDXfn_QRcLuH9r33fL-CjvQRh-G_tp5vpfVk4o', 1, 0, '2025-07-14 07:39:01', '2025-08-30 11:45:00', NULL),
(98, 'vivek', 'vivek', 'vivek2@gmail.com', NULL, '$2y$10$tXWgNI9hVZ6MO.yR5ZSZw.U./biF.iqWjmXAj43166n/gMXmQ6th.', NULL, NULL, NULL, 0, NULL, 'profile_photos/AhttL4q3mzp63Sj0RoQNNcno3FLrMYDeAecXarxk.jpg', NULL, NULL, 2, 0, NULL, NULL, NULL),
(100, 'Atul Kumar', 'Atul Kumar', 'atulroyals30@gmail.com', NULL, '$2y$10$wbwAKRsPZdNnOGAPBNiaquwDMA9CwQ25XNLpQPywmqiD74nPQT5hO', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'fUEImgKzSeiOv8FAl_n-hS:APA91bGLcq6bhRzqLMXQ4482WfcyIvRfaBeOz72FKhSHTwo03OBP0sMaWebb53UF9dbyZzW59csQdrsoMm24NotvxUNzh7E69fnIp3HEfgl_WztprjNAZrI', 1, 0, '2025-07-15 10:17:01', '2025-07-21 16:44:54', NULL),
(109, 'Vikas Nagar', 'Vikas Nagar', 'mukulrocks.nagar@gmail.com', NULL, '$2y$10$.KFd.3E2K/bPWnGLVt5L0uvGrondrlLWxFJ3dF7PgqUVnp2cWm7jm', NULL, NULL, NULL, 0, NULL, 'profile_photos/4HHOTsAM63bjnZJGTWTeevC0a5gtds5zR3J0Z8Nm.jpg', NULL, 'dIMleRIZTV6m0XApuWRstt:APA91bG34Swz_dUh3RRyuzYLdtKXuDqR5bAaHNmXAu-eDoBeNKDZh6cMi9qQJlf2LFFXRIIn-kSu5a07MVnaqfej2YI4VkgdbNdtROsT-QpDI9ZPwN39sNY', 1, 0, '2025-07-19 10:33:05', '2025-07-19 10:39:41', NULL),
(112, 'tester', 'test', 'ravit5631@gmail.com', NULL, '$2y$10$/Ac3JLVA9Rd3I6d1EbYZ1Oo9zdplM1gbAeHY7lW/f5CGm6ih4joca', NULL, NULL, NULL, 0, NULL, 'profile_photos/mnJuydFTGRTUO327C4b6tlLGJBmu8OLp9Q3DJys9.jpg', NULL, 'dVGhe6ucQV-zeBGb30QRZu:APA91bG2veLH4CLVa7K4AFVm-pAaRgIZOC6Qqo4Do0OF-ykUF8FdawLQby6Tk18LL-2ZkOlVraUeRa1gCpfJi-JIU4lNLCwK8uuqOfo_9eBuKqzyZM1jXQE', 1, 0, '2025-07-19 15:54:01', '2025-08-13 10:14:22', NULL),
(114, 'vivek test', 'vivek test', 'dev12@infoiconsoftware.com', NULL, '$2y$10$t7THzDioamwbzdD0jjPpxuFjPy/N/rJaSF.ELIeS3Y90q4sHPlK.y', NULL, NULL, NULL, 0, NULL, 'profile_photos/3MpSFIyuEACgcwLLDLVB5sVJ54DuVWbnONxJxgOE.jpg', NULL, NULL, 2, 0, NULL, NULL, NULL),
(115, 'Test', 'Test', 'admin@test.com', NULL, '$2y$10$83zK67h7lhF8yfd/ooY4muBN2PflgBXg/NzHjstlkDvcBZ/vU1hXy', NULL, NULL, NULL, 0, NULL, 'profile_photos/2IAf6wG1jdTB1uHRElnDMuhAHPHfgqYcrtPkbODd.jpg', NULL, NULL, 2, 0, NULL, NULL, NULL),
(118, 'Test', 'Test', 'admin@test2.com', NULL, '$2y$10$cJ.ptattdbu.x0XiN0CWq.jfRFi.VJYMNLP3gddttrzxmTv7jeik.', NULL, NULL, NULL, 0, NULL, 'profile_photos/rnBd7SDGmA53D1UXGogk8FL2sRegddd32Gi8vIVA.jpg', NULL, NULL, 2, 0, NULL, NULL, NULL),
(120, 'Test1', 'Test', 'test@test.com', NULL, '$2y$10$I1CveHuBjbsT7ijewYx7WOCd.wAbG0vziDmYJlQ5.dGmU7zKRxKHu', NULL, NULL, NULL, 0, NULL, 'profile_photos/y1fW7t6nhatcBkm2rsKpwapqriINaL1z94lEnasz.jpg', NULL, NULL, 2, 0, '2025-07-21 16:03:15', '2025-07-21 16:03:15', NULL),
(121, 'Test2', 'test', 'test2@test.com', NULL, '$2y$10$b20ZptxVY7Y6.maYp6kLM.PgoikTc4oq/zx4z343gQKF42WoF/TEi', NULL, NULL, NULL, 0, NULL, 'profile_photos/qqwj8w1lfDqx7K6in1pfqUrRcnZjMmUtjirRm4hf.jpg', NULL, NULL, 2, 0, '2025-07-21 16:48:52', '2025-07-21 16:48:52', NULL),
(123, 'Ravi Tiwari', 'Ravi Tiwari', 'tiwari1998r@gmail.com', NULL, '$2y$10$r0RVQZVskdYNs5Feq61AbeE9BoeGbQ1PbUxg2ptBToN3MjYylbCS2', NULL, NULL, NULL, 0, NULL, 'profile_photos/0FebfnX6eLMAUnIJ66VH2tu3mcKslOwlrPz5Vk4N.jpg', NULL, NULL, 1, 0, '2025-07-22 14:30:05', '2025-07-23 07:24:33', NULL),
(124, 'Vikas Nagar', 'Vikas Nagar', 'vikas.nagar.1904@gmail.com', NULL, '$2y$10$Ep4qK8z4RmCeQRNl17.AteoE6hN3iHelImbdQ0gGM7XTBw/GdQ8BK', NULL, NULL, NULL, 0, NULL, 'profile_photos/O8qLmVXRtJSB1TXLiuGHbiqUR5eWttyw2ugyEunt.jpg', NULL, 'dLfG4XyGTu2iC3Lx0beB4b:APA91bG3ITcsS_-t2JVM9xMHflMUueTcm9a_3vfZGwd9NMUMsyXyNvyUvboyoPojWKOgoAZ81cmMmkqe_uauTSlsE3zVXp72vsJWn-ogLFluN5IDajfwRAQ', 1, 0, '2025-07-27 08:03:14', '2025-07-27 08:11:44', NULL),
(125, 'user@bublee.me', 'BoldOtter', 'user@bublee.me', NULL, '$2y$10$.byeZTUlHwgaOdeuTgd6TOD0UojIdPhiio7MFJoJd.b1i4ilc6J7.', NULL, NULL, NULL, 0, NULL, '', NULL, 'eNTrwuhfQryIstWTkHljCA:APA91bGRy8oGbAnLKJEx5wDSaJwXfEDyPcbdTsSTmHIXkTqhyue9Ez7brsl4QruEuZn4txbcJxcYEF9U_IDe6o0yjtsCHA9mU2mKD3KyBz6kf4c9f7plu0k', 1, 1, NULL, '2025-09-06 05:17:01', NULL),
(127, 'Atul Kumar', 'Atul Kumar', 'atulvesu@gmail.com', NULL, '$2y$10$OghZt10TdwPg5SI1ZHq3HOGLNAYp7Tf7aWJtWNvKXNlzrmnVILxiq', NULL, NULL, NULL, 0, NULL, 'profile_photos/ulByOwME2LWzUAJXkAY2LX2tXqILVqXref7wdZBi.jpg', NULL, NULL, 1, 0, '2025-08-06 16:38:46', '2025-09-02 14:11:43', NULL),
(129, 'test', 'tester', 'ravit5557@gmail.com', NULL, '$2y$10$shgVTH0/j7rbA9iQsSR8Qe6rTwmgAoeNBISVk9qhzCBN9i75RBAji', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-13 11:37:18', '2025-08-13 11:37:18', NULL),
(130, 'InviSofts IT Dev', 'InviSofts IT Dev', 'invisoftsitdev@gmail.com', NULL, '$2y$10$Y5qUrs.vaG0.UC9xkU9GseIVmp11tbgSN14L07liOdtaizAJ.Byvu', NULL, NULL, NULL, 0, NULL, 'profile_photos/ZJreGVyn4fpdR3cU7pXdK1GRqw7YMWLqPxvt6FVy.jpg', NULL, 'eSgIpYAUTV61GOtIrSpcq3:APA91bEKscJDFWIeAeMQEfY6C8lZwVxB2F_QM7QgdyOeut47wM71qIayO1XV4sdSVHo3EwcTAAmhm0__vF1Meo2EznM5whXo8S4NQjmffhWeJTqxWcVH7tA', 1, 0, '2025-08-13 12:07:17', '2025-08-13 12:10:38', NULL),
(135, 'test', 'test', 'hodabik277@amcret.com', NULL, '$2y$10$kaFv.tDGGlJ9UN/y93bx8uG/035DkQ82zhn.XDFVgeBllSejzp2Bq', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 3, 0, '2025-08-24 15:46:41', '2025-08-24 15:49:07', NULL),
(136, 'John deo', 'jony', 'xq4aqtljfd@vwhins.com', NULL, '$2y$10$TXlgle5Zp2l9ZyYtZh/atOR4OZ6Vk5TbpmSLxCVSZ8nXQILVZeIbS', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-25 15:29:46', '2025-08-25 15:29:46', NULL),
(137, 'dicako', 'dicako', 'dicako6112@amcret.com', NULL, '$2y$10$jDgo0Zru37NqwlAQr2aHj.X8vVNPNS.CeZPuXE2VW77/xW4Icrpp2', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'f88mBiMcR6uLgAYKRt6Ows:APA91bGWB60z_IljuL-r7STG-1esW13MmLY77iADD0iOruLyZnt8lUXtrYgugcS8pArYhMCgTVm_C_Tb996zXitRllog6kKTPnvXZDnjAIPT8ekXCYEbWi0', 3, 0, '2025-08-27 15:12:08', '2025-08-27 15:14:36', NULL),
(138, 'copan', 'copan', 'copan56671@chaublog.com', NULL, '$2y$10$cF9V3dF3NfZ1sHfTSSvP4ewEtrLIiZo/JJ4SuXhvbE0lOSMU2AUCS', NULL, NULL, NULL, 0, NULL, 'profile_photos/Qv7pfmo8aPoNEqjKkAh3R0eBFnWrGVH9q7Ha3lXr.jpg', NULL, 'f88mBiMcR6uLgAYKRt6Ows:APA91bGWB60z_IljuL-r7STG-1esW13MmLY77iADD0iOruLyZnt8lUXtrYgugcS8pArYhMCgTVm_C_Tb996zXitRllog6kKTPnvXZDnjAIPT8ekXCYEbWi0', 1, 0, '2025-08-27 17:26:13', '2025-08-27 17:43:29', NULL),
(139, 'geupautrobrupou', 'geupautrobrupou', 'geupautrobrupou-1316@yopmail.com', NULL, '$2y$10$lnOU5mTQTec1U1zV0DPNcu72pXPdSwZzjvA5hcRu.xQs0PYIOZLvO', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-27 17:30:58', '2025-08-27 17:30:58', NULL),
(140, 'zewezegemme', 'zewezegemme', 't0vn8s6p9m@qzueos.com', NULL, '$2y$10$xKIwP1rulXyO1pVUQr6Oi.EHMQq8q7O7/eMuGfhNLYosE4aFwsl.S', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-08-27 17:52:12', '2025-08-29 18:54:58', NULL),
(141, 'xubreppopeidi', 'xubreppopeidi', 'xubreppopeidi-7096@yopmail.com', NULL, '$2y$10$RCNT2NzDE9qNpe8ex0grKeSHjp9A7OkDhTy4AG1hdiQ.8yiqPQgC2', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-08-27 17:57:05', '2025-08-30 07:43:57', NULL),
(142, 'woucoutedete', 'woucoutedete', 'woucoutedete-8969@yopmail.com', NULL, '$2y$10$Nb0c2/rBecc24b37LRf5OO90.ev0SPtqw2XVSL3X.eeBjoD7xArrS', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-28 15:16:42', '2025-08-28 15:16:42', NULL),
(143, 'cipeigeuloifru', 'cipeigeuloifru', 'cipeigeuloifru-7498@yopmail.com', NULL, '$2y$10$lyTjg7S.pM2.w1xYtWRCT.qPMcdeOmZF5DEndPW8HSyTuG0lnPQ6.', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 3, 0, '2025-08-28 16:56:24', '2025-08-28 16:58:05', NULL),
(144, 'pruloutenida', 'pruloutenida', 'pruloutenida-7964@yopmail.com', NULL, '$2y$10$VxXl4Ck6mGG3uEApeRexkOMcKCkXPZPVOWMzGgt0Uhbob4X/Drgdm', NULL, NULL, NULL, 0, NULL, 'profile_photos/gezpmcZKYzZv7EehZii6ZsDynyVjpiLJpD53fsY9.svg', NULL, NULL, 2, 0, NULL, NULL, NULL),
(146, 'Sylvester Beasley', 'Glenna Cabrera', 'vomoti2027@besaies.com', NULL, '$2y$10$Irv5am8W83.KlPWJ7ebCaOvg4HM3Z9j7cIeWEdF4widvFZCozqn6W', NULL, NULL, NULL, 0, NULL, 'profile_photos/WLKW0fl83mLoMOAlLSxJnnw6RM9nyA2InYE1NurL.png', NULL, 'f88mBiMcR6uLgAYKRt6Ows:APA91bGWB60z_IljuL-r7STG-1esW13MmLY77iADD0iOruLyZnt8lUXtrYgugcS8pArYhMCgTVm_C_Tb996zXitRllog6kKTPnvXZDnjAIPT8ekXCYEbWi0', 0, 0, NULL, '2025-09-02 14:38:02', NULL),
(148, 'kupujaprafa', 'kupujaprafa', 'kupujaprafa-9813@yopmail.com', NULL, '$2y$10$hJ0iBBT3Eq3f2OKmtxrS0ODsHOkns4dpImM4g.99k0UKn3iS43r36', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-08-29 19:22:03', '2025-08-29 19:27:56', NULL),
(149, 'zeitrubaubragra', 'zeitrubaubragra', 'zeitrubaubragra-4995@yopmail.com', NULL, '$2y$10$I.zSrzOXLtvwy6rECekzf.LDrYbpnIJpYCtoSZ8K/dgfM7.wt/nK6', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-08-29 19:31:46', '2025-08-29 19:35:52', NULL),
(152, 'crukeiprehummi', 'crukeiprehummi', 'crukeiprehummi-5804@yopmail.com', NULL, '$2y$10$d.hHWyEmnHxa7/W7WBf/6OYO0itECQYFPD7mO8OnAAkr/8EBDQw8m', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-29 22:17:04', '2025-08-29 22:17:04', NULL),
(155, 'lanoudejade', 'lanoudejade', 'lanoudejade-3270@yopmail.com', NULL, '$2y$10$qBb1vJQnZ4OASBzfAtYRKuMxj34XBXhoim0oLr7G1JraQsjPakMDa', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 08:18:04', '2025-08-30 08:21:52', NULL),
(156, 'Honorato Whitaker', 'Amethyst Buckley', 'cifidor739@mogash.com', NULL, '$2y$10$cUCwphttK9oVGKYxDPZom.V34d6HVgT2GH/WympF59JZHGferWJQi', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 2, 0, '2025-08-30 12:02:00', '2025-08-30 12:02:00', NULL),
(157, 'Hiram Short', 'Jameson Boyer', 'cokah22985@lespedia.com', NULL, '$2y$10$YM0mb4XpT2K7BlGGmsr.6.9koMP7OeuMlPZxhQdL4hM27OYSl1Amu', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 3, 0, '2025-08-30 12:05:52', '2025-08-30 12:07:21', NULL),
(159, 'jeny', 'deo', 'fahav92115@futurejs.com', NULL, '$2y$10$do0a4zwQDwS9edROdWyHnuzLRyy26DOG0meD/D66LXTs4zP1K/Wsy', NULL, NULL, NULL, 0, NULL, 'profile_photos/tFe1bZKzhk7j7GrLdkkHarBDDdGOwVup4xBVdqlF.jpg', NULL, 'f88mBiMcR6uLgAYKRt6Ows:APA91bGWB60z_IljuL-r7STG-1esW13MmLY77iADD0iOruLyZnt8lUXtrYgugcS8pArYhMCgTVm_C_Tb996zXitRllog6kKTPnvXZDnjAIPT8ekXCYEbWi0', 1, 0, '2025-09-01 14:15:59', '2025-09-01 14:19:07', NULL),
(160, 'brisaffaumayo', 'brisaffaumayo', 'brisaffaumayo-2938@yopmail.com', NULL, '$2y$10$n4dWUeGp3ofBBWRNsh2KuuWXBt.cSqwKh80gHFSPNyql/oQ63HX1u', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-09-01 14:22:05', '2025-09-01 14:26:08', NULL),
(162, 'yauttawauwaufro', 'yauttawauwaufro', 'yauttawauwaufro-3684@yopmail.com', NULL, '$2y$10$Zo.ul/XGCiYc7iQf8KlCYufky6LFbsN4BgaUsBhSusEewXBiEGGn.', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, '2025-09-01 17:10:28', '2025-09-01 18:01:05', NULL),
(169, 'polauhaweivu', 'polauhaweivu', 'polauhaweivu-1060@yopmail.com', NULL, '$2y$10$bSmX0.9uJ7.123YNqkzcRugf7hF74Rl3nCQ0YV9C.WHAqYYG3Y9o6', NULL, NULL, NULL, 0, NULL, 'profile_photos/W5t47IW2ej61xGeO2NTaGa3kBM9ou3WjMA1j8DaO.png', NULL, NULL, 2, 0, NULL, NULL, NULL),
(174, 'vazageiyegrau', 'vazageiyegrau', 'vazageiyegrau-3596@yopmail.com', NULL, '$2y$10$l0RluvxYxSEjBCkU3aJhke6766rCan1ergUoyZUB/InxZyGmLWj4m', NULL, NULL, NULL, 0, NULL, 'profile_photos/C1XfpCHjrOq0JWZb1HbXTwPRjY043xCPl4rjMdJ0.png', NULL, NULL, 2, 0, NULL, NULL, NULL),
(175, 'Test', 'Stazing', 'test@stazing.com', NULL, '$2y$10$0EswtIRcq6mCyQYtng7uH.PVG68f6BwCN91wRZJZ8ANGli0ZGItUC', NULL, NULL, NULL, 0, NULL, 'profile_photos/jOGRCFUaSSjqTB5InJMNGxp52aHZXC7Cf94p3547.jpg', NULL, NULL, 2, 0, '2025-09-03 09:24:27', '2025-09-03 09:24:27', NULL),
(176, 'Test1', 'stazing1', 'test1@stazing.com', NULL, '$2y$10$9P0d5zq/kZFDre6pYi1y5uctLpilpRIonmXNYYYNo93AmCq5IS5I.', NULL, NULL, NULL, 0, NULL, 'profile_photos/bubXHvTGkPcniDVdmQiKHDBr6rhjFTmJEGn1Sd6Z.jpg', NULL, NULL, 2, 0, '2025-09-03 09:37:09', '2025-09-03 09:37:09', NULL),
(177, 'nippunnudenu', 'nippunnudenu', 'nippunnudenu-9887@yopmail.com', NULL, '$2y$10$mmSwVMTrXliRx1OPL2qwouIwC/jtfxB0HvqzGyVj5g7xlw/s7C.ta', NULL, NULL, NULL, 0, NULL, 'profile_photos/MUJiyUDaudSOelmf5GVljKcp7mfATiARRLwtxSw4.png', NULL, NULL, 2, 0, '2025-09-03 14:18:52', '2025-09-03 14:18:52', NULL),
(180, 'bossazoukouprou', 'bossazoukouprou', 'bossazoukouprou-7112@yopmail.com', NULL, '$2y$10$chaVjB0u0iV31VlUNIY7..3t/nI7Hy5zLOd7tHgo92t1jPvPZkLz.', NULL, NULL, NULL, 0, NULL, 'profile_photos/ny2FwBYjP0JGOVRGt673zLSxGqLcQNKVAODyIvmA.png', NULL, NULL, 1, 0, '2025-09-03 14:45:55', '2025-09-03 14:57:27', NULL),
(181, 'brijummacotto', 'brijummacotto', 'brijummacotto-2051@yopmail.com', NULL, '$2y$10$WSkmFL.mN78oZt6WOrscRudijgfE4z5yLK51Ybsb5pGkEjtGBY.UK', NULL, NULL, NULL, 0, NULL, 'profile_photos/GxvRSDZ51Pzg3PylhTNsu6I60jModD9qDuYUQKfU.png', NULL, NULL, 1, 0, '2025-09-03 15:26:49', '2025-09-03 15:30:59', NULL),
(182, 'gilliddopreigra', 'gilliddopreigra', 'gilliddopreigra-5728@yopmail.com', NULL, '$2y$10$R54gOZxtyiPjwdbrRW/e/.ibMYUqk.oZ5ig2OgWHiyCSi3m9THxky', NULL, NULL, NULL, 0, NULL, 'profile_photos/Ly8MFQ2XN2SBohwdhm4WR4tKqB58Vwng5xiGOA41.png', NULL, NULL, 1, 0, '2025-09-03 15:38:40', '2025-09-03 15:42:25', NULL),
(189, 'Yadav Mayur', 'yadavmayur', 'mayurby@gmail.com', NULL, '$2y$10$XbTKRafgkw5fCNR4HS8oKuyiQ9qVI/6DoehsM3Zcj7PZEPfobDZ26', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'cdUOi3ZwTb-95S8MRhYnYk:APA91bEFrJGondBzeKqTsz-CSayfQhmQiwj5A07wUGzH_Jp_NnzXTAwlVmXsa1UVVPeE8SeilU15C8rJKiTdoEUSb-QN_ZTOAbkXivQTobr-uWGiFNqG6M8', 1, 0, '2025-09-06 04:37:31', '2025-09-08 09:04:48', NULL),
(190, 'Tanya Alford', 'Mia Nash', 'sepahaj385@certve.com', NULL, '$2y$10$Zwas.29YSy5jIvv/gqqDNu87RECpMZD1QDegoB73dihsFa1Mn8IuO', NULL, NULL, NULL, 0, NULL, 'profile_photos/ijGCIofePdbHSCDxgHko60zvRhMivuz6AkDyr0XK.png', NULL, NULL, 1, 0, '2025-09-06 05:39:25', '2025-09-06 05:42:20', NULL),
(191, 'Rampaige', 'ramp', 'lovewashisonlydastination@gmail.com', NULL, '$2y$10$WXUdAIJtn1Gv3cuCNRLHvOCErZxUiqaL0/jDjHWRxVDD7IK5cpUia', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 3, 0, '2025-09-08 03:17:48', '2025-09-08 03:21:12', NULL),
(192, 'test3', 'stazing', 'test3@stazing.com', NULL, '$2y$10$1g/ECeKJS4Nh6yZbZ9PCb.hujyJvs2KmsLKSFRiwz3ylxV3q.lmQ.', NULL, NULL, NULL, 0, NULL, 'profile_photos/lBJdrz7stHgoiDxhLPaPct9e3M7SALUIa62N5bFC.jpg', NULL, NULL, 2, 0, '2025-09-08 09:54:50', '2025-09-08 09:54:50', NULL),
(193, 'Kaushik Valiya', 'Kaushik Valiya', 'kaushikvaliya520@gmail.com', NULL, '$2y$10$Lc6Ca97k51tkE6w71isAJ.YNuD2k1YGzOoI2b2/1JSlYOKVKlCBaG', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'eNTrwuhfQryIstWTkHljCA:APA91bGRy8oGbAnLKJEx5wDSaJwXfEDyPcbdTsSTmHIXkTqhyue9Ez7brsl4QruEuZn4txbcJxcYEF9U_IDe6o0yjtsCHA9mU2mKD3KyBz6kf4c9f7plu0k', 2, 0, '2025-09-08 17:45:42', '2025-09-08 17:45:42', NULL),
(194, 'Tomaz', 'tommy-4/_', 'tomaz.ornik@gmail.com', NULL, '$2y$10$8GgJq9tykY.kGRG4vofWA.SECd8P95MSj1Ij9Jo2hO0bP14J5DWHG', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'fC9wm64LQjiHioJ8FsG5zD:APA91bG9vsXOODcnuDXqVMNvyqmf9BPReylzmlJuDVj2hc3Ox3PvUaXCPKM5HmSKOqM7zrrwn6BTYNoqW0uKrwu-zJcpdJRwi-cJ29NhlAIyczE0zGxnQzs', 3, 0, '2025-09-09 06:00:42', '2025-09-09 06:05:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `target_user_id` bigint(20) UNSIGNED NOT NULL,
  `liked` tinyint(1) DEFAULT NULL,
  `superliked` tinyint(1) DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT NULL,
  `dateAdminers` tinyint(1) DEFAULT NULL,
  `save` tinyint(1) DEFAULT NULL,
  `dateinvite` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_actions`
--

INSERT INTO `user_actions` (`id`, `user_id`, `target_user_id`, `liked`, `superliked`, `blocked`, `dateAdminers`, `save`, `dateinvite`, `created_at`, `updated_at`) VALUES
(147, 127, 123, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-02 14:56:46', '2025-09-02 14:56:46'),
(148, 158, 112, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-02 15:13:36', '2025-09-02 15:13:36'),
(149, 134, 112, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-04 03:31:09', '2025-09-04 03:31:09'),
(150, 189, 112, NULL, 1, NULL, NULL, NULL, NULL, '2025-09-07 09:10:09', '2025-09-07 09:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_blocks`
--

CREATE TABLE `user_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blocked_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `target_user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_kyc_infos`
--

CREATE TABLE `user_kyc_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) DEFAULT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_kyc_infos`
--

INSERT INTO `user_kyc_infos` (`id`, `user_id`, `country`, `id_type`, `id_document`, `user_photo`, `created_at`, `updated_at`) VALUES
(28, 94, 'India', 'National ID card', 'id_documents/P5kA5O68rWf2EWoSYx3ke4ANKjLIUC8ztqwnGi0o.jpg', NULL, '2025-07-13 16:43:42', '2025-07-13 16:43:42'),
(30, 97, 'India', 'National ID card', 'id_documents/Bsw9jAA3JbgJJZHfSXdRQtcustwtdLylBWrOlgkg.jpg', 'user_photos/t3yarU4z8TYfOmfXEEQ9WU1ieS3EErqoYEfrdWEZ.jpg', '2025-07-14 07:39:46', '2025-07-14 07:39:46'),
(32, 100, 'India', 'National ID card', 'id_documents/jP3TSXeHlWPQmHGnFWdJzDE3CtW4CkzRVeUvOu6T.jpg', 'user_photos/Y13ByT9SVLcuytYjqkrm9NHAMbmFxXnxUtFwq7MA.jpg', '2025-07-15 10:17:29', '2025-07-15 10:17:29'),
(35, 109, 'India', 'National ID card', 'id_documents/q3D6xoF7ibG0ogZ3wCokHCexZaQkuhfqtYt4T3X1.jpg', 'user_photos/MbkmilvEFw6TRFfKHRNqlnBUsnKxsua3PJNnOE25.jpg', '2025-07-19 10:35:07', '2025-07-19 10:35:07'),
(39, 112, 'India', NULL, 'id_documents/l52QXQ3pcNwdwgJPwLsHqxBFhM5vbPCsRMeAZPO5.jpg', 'user_photos/EI5iods7k7QspfHwCw9fxRfqv6ypVQC6z4GB1tzK.jpg', '2025-07-19 15:54:54', '2025-09-06 05:36:17'),
(40, 114, 'India', 'National ID card', 'id_documents/uOHd5cJQPusYKpu2rlUB6RQhAMjIiUlOjYmR2Ply.jpg', NULL, '2025-07-21 09:29:52', '2025-07-21 09:29:52'),
(41, 118, 'India', 'Government-issued Driver\'s License', 'id_documents/6JQyNcVnw3FaqV5d18j1xTZoDeFt3SxQGBtxDGD7.png', NULL, '2025-07-21 15:51:30', '2025-07-21 15:51:30'),
(42, 120, NULL, NULL, 'id_documents/3jeGADGLmetGP9uPs1JFYTzo47ZMuORasLEdSuxb.png', NULL, '2025-07-21 16:10:10', '2025-07-21 16:10:10'),
(44, 123, 'India', 'National ID card', 'id_documents/fqXRFoyDQAyKUqCf4LYGQ9tiBKJzzTXCM8VB2zKh.jpg', 'user_photos/glTeHAVXvhU8S8CWg2mu1UltZSh1sBVR0talfjt1.jpg', '2025-07-22 14:43:20', '2025-07-22 14:43:20'),
(45, 124, 'India', 'National ID card', 'id_documents/4Uc94OEUIpJZ3YzRs6xGfYA9IsbXKf22fG4KSuWY.jpg', 'user_photos/F2rGNlLCtbk7mKWgrdmVH2z1Ovdkm4jK53ficxGq.jpg', '2025-07-27 08:07:17', '2025-07-27 08:07:17'),
(46, 125, NULL, NULL, NULL, NULL, '2025-08-05 09:36:12', '2025-08-05 09:36:12'),
(48, 127, 'India', 'National ID card', 'id_documents/nttWEYtfKiW7dGyiVvAgy4RwL78P5Je6gAvcG0jb.jpg', 'user_photos/jp5E3VNZSFynPGX8pHkg1W24YPASp4W4T7ZbxLJW.jpg', '2025-08-06 16:39:15', '2025-08-06 16:39:15'),
(50, 130, 'India', 'National ID card', 'id_documents/ahARFp1gEezY2JhDJZMVyGAZHNlSCrNxwZSvkzTO.jpg', 'user_photos/Pff5iQnAMKdK6TAzM6rzePXs0BXe7kwQFFwh1uZX.jpg', '2025-08-13 12:09:06', '2025-08-13 12:09:06'),
(55, 135, 'India', 'National ID card', 'id_documents/oJ728wKnY3XliMNdR3oBSVF3cSmhvwZcHzO3kw0z.jpg', 'user_photos/YCBjyLFhtyhvij1XLv32oew1aRNlQtOCm02jRGdm.jpg', '2025-08-24 15:49:07', '2025-08-24 15:49:07'),
(56, 137, 'India', 'National ID card', 'id_documents/4wXrd3UN6nBFUX2FqYE9r8mfYHF7GXsdVnUT7Hpk.jpg', 'user_photos/mtEBQdWqxwdM3Nc7m3LxJao2mqcjqJb2m2d9zmyF.jpg', '2025-08-27 15:14:36', '2025-08-27 15:14:36'),
(57, 138, 'India', 'National ID card', 'id_documents/IVbv3rr0tT2qRtP2i8kj0z3xZ701P7AMRlt1niVu.jpg', 'user_photos/u0RlZbjFqBLOhpMMNYScNdZEY72aolvfhdlKSNIq.jpg', '2025-08-27 17:40:00', '2025-08-27 17:40:00'),
(58, 140, 'India', 'National ID card', 'id_documents/ligMyKCoCIie8BF5swrBVN2OlTrlu6k9bQdd8PyO.jpg', 'user_photos/ryAkrhF1b3qCPOCft6m3e4JtNoWAMtdgXGAJSqDw.jpg', '2025-08-27 17:54:56', '2025-08-27 17:54:56'),
(59, 141, 'in', 'National ID card', 'id_documents/uSbdzLlpt73a69FsMXtvlZOyV5rlp0FSzxfJbq74.png', 'user_photos/7ZOXMICOCWAFbl8qMywb3Ak4fSFTUD46tkTaiPR9.jpg', '2025-08-28 16:39:47', '2025-08-28 16:39:47'),
(60, 143, 'in', 'National ID card', 'id_documents/4SZa28P42hOIJvhzoufmbAr4npggkJZIEvdQjuKx.svg', 'user_photos/n50RHmvKo3f95Ksxja7Y2VB2jccs6FLj19dGaoAm.svg', '2025-08-28 16:58:05', '2025-08-28 16:58:05'),
(62, 148, 'in', 'National ID card', 'id_documents/h2QbVCYxOX8LOMPmIH9duTMjgHskIdlY2W6a9i0o.svg', 'user_photos/qLodCIKKaIoskXBoW3RbzJ4s0MWYqA0SUGBFO3FZ.svg', '2025-08-29 19:25:30', '2025-08-29 19:25:30'),
(63, 149, 'ca', 'National ID card', 'id_documents/wNR2MHh2MuXYbrOa7NYAqdPiFF9OAfErBPcA1Gq1.svg', 'user_photos/HsmzVXTburRNQFMefOeueg9G2VDQ1xMQTO4pg7DR.svg', '2025-08-29 19:34:41', '2025-08-29 19:34:41'),
(66, 155, 'Canada', 'National ID card', 'id_documents/kHuAap6ryFY1iKgjPMHfl4Ms0oDh4BDsVYXf2mcH.png', 'user_photos/1mE5vTeBjuAChX0s0SKiNQDYLaI5LwsxOyXNbCaS.png', '2025-08-30 08:20:42', '2025-08-30 08:20:42'),
(67, 157, 'India', 'National ID card', 'id_documents/QflMYauvjKOwM0BxWiv6Lszxn0mVFheUtkKmCBq4.png', 'user_photos/JD4ykwG4aZACj6p0G9SfewAROgk8UrdGkgWGp4Cy.png', '2025-08-30 12:07:21', '2025-08-30 12:07:21'),
(69, 159, 'India', 'National ID card', 'id_documents/m6nwU0g7FILWjSc75YoVd0nt8xiDgxsTpYHgPtzI.jpg', 'user_photos/b9GAnXsX6DZ8GOZ4VPEIKs5F2Tc6YGpPm2TWVTsW.jpg', '2025-09-01 14:16:41', '2025-09-01 14:16:41'),
(70, 160, 'India', 'National ID card', 'id_documents/8JbLzzO09EByNZ3rizwDp1Qn1yOBInbzReyWoXYj.svg', 'user_photos/p9rO2ZeMjeONc5UwsFWgssOVd50gpoQwPkRVbr1h.svg', '2025-09-01 14:22:36', '2025-09-01 14:22:36'),
(72, 162, 'UK', 'National ID card', 'id_documents/BpJzRVQ2YIP87AjYHiKaHYsrgIp3ouu1rCRzeSVC.svg', 'user_photos/bcYQR39id2lSR7wroiQAmTPVqYKt50JiVihtSIP0.svg', '2025-09-01 17:11:06', '2025-09-01 17:11:06'),
(79, 175, NULL, 'International Passport', 'id_documents/9ldyvR6ewBOGTiNUddSRbV9oRMim8PWdFUyMUyQA.jpg', NULL, '2025-09-03 09:24:27', '2025-09-08 09:51:54'),
(80, 176, 'India', 'National ID card', 'id_documents/BPhGlba0qxuRoU2Nq2xHiBvZsqnmanVQrySzZHY4.jpg', NULL, '2025-09-03 09:37:09', '2025-09-03 09:37:09'),
(81, 177, 'Japan', 'National ID card', 'id_documents/FgBQowcjyfjoX2nYzMMgFnw2pstrL25mNivoO5oM.png', NULL, '2025-09-03 14:18:52', '2025-09-03 14:18:52'),
(84, 180, 'Canada', 'National ID card', 'id_documents/uMmUTpBoOOXJ9gWbRDtCTuWETWE7VnNO0pZuQeSt.png', 'user_photos/Dd3qp31FICyqmaEicGOeC0ulZExSNMtO4bVJOO9K.png', '2025-09-03 14:46:25', '2025-09-03 14:46:25'),
(85, 181, 'Canada', 'National ID card', 'id_documents/Hlq6CB95Uow9LULcqWfH7YnlnPJdSTgZs1HjNMKP.png', 'user_photos/hr2qni99eGmwNsC9a1WcoGkPIFVG0kmawHEWAHjP.png', '2025-09-03 15:27:20', '2025-09-03 15:27:20'),
(86, 182, 'UK', 'National ID card', 'id_documents/keJahyR2cp5UXWg2vazXIlplhIIeO0RkrIA2G2J3.png', 'user_photos/MsaCHnUk0NiqTJl5q4SxAELJHMx1GCV01IAJykdv.png', '2025-09-03 15:39:08', '2025-09-03 15:39:08'),
(93, 189, 'India', 'National ID card', 'id_documents/ONURErtXYw782qdSFG68anhYiruLueCQdzhLF5Ii.jpg', 'user_photos/bS1aBg4LxGWZvZXEme30BZmFOTilGJZ8aZX9fJlM.jpg', '2025-09-06 04:38:19', '2025-09-06 04:38:19'),
(94, 190, NULL, 'International Passport', 'id_documents/d9dvaJlNXj4yIVT7TQLzm0deOHbZt02riVgY4IqP.png', 'user_photos/QOfLQNOZIHwWnZT4GkTBb5kzg9xyfwEjDXg3nNBY.png', '2025-09-06 05:40:01', '2025-09-06 05:44:23'),
(95, 191, 'France', 'Government-issued Driver’s License', 'id_documents/49d3lkXlUWregZOpFBKz1TkEbdCT55SHxZLu9Ldd.jpg', 'user_photos/RCcVu0BX9jiyiFfdSw9gQfiM9zIZYGKHAUlX1J5B.jpg', '2025-09-08 03:21:12', '2025-09-08 03:21:12'),
(96, 192, 'Bangladesh', 'National ID card', NULL, NULL, '2025-09-08 09:54:50', '2025-09-08 09:54:50'),
(97, 194, 'Algeria', 'National ID card', 'id_documents/jbX020678hn2eHRcB085wqgnPlmkG1DZwy4v9CpX.jpg', 'user_photos/3aRfdm4qj9C8bfaPINPUbgtid7hWFPyXbSrLOH7c.jpg', '2025-09-09 06:03:32', '2025-09-09 06:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `liked_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `about_you` text DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `body_type` varchar(255) DEFAULT NULL,
  `eye_color` varchar(255) DEFAULT NULL,
  `hair_color` varchar(255) DEFAULT NULL,
  `sleeping_habits` varchar(255) DEFAULT NULL,
  `love_language` varchar(255) DEFAULT NULL,
  `childrean` varchar(255) DEFAULT NULL,
  `financial_status` varchar(255) DEFAULT NULL,
  `dress_stype` varchar(255) DEFAULT NULL,
  `pets` varchar(255) DEFAULT NULL,
  `zodiac_sign` varchar(255) DEFAULT NULL,
  `vaccinated` varchar(255) DEFAULT NULL,
  `drinking_habits` varchar(255) DEFAULT NULL,
  `smoking_habits` varchar(255) DEFAULT NULL,
  `eating_habits` varchar(255) DEFAULT NULL,
  `communication_style` varchar(255) DEFAULT NULL,
  `workout` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `language_speak` varchar(255) DEFAULT NULL,
  `relationship_status` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `love_goals` varchar(255) DEFAULT NULL,
  `looking_in_partner` text DEFAULT NULL,
  `sports` varchar(255) DEFAULT NULL,
  `entertainment` varchar(255) DEFAULT NULL,
  `my_interests` varchar(255) DEFAULT NULL,
  `iam_looking_for` varchar(255) DEFAULT NULL,
  `iam_seeking` varchar(255) DEFAULT NULL,
  `age_range_in_partner_min` int(11) DEFAULT NULL,
  `age_range_in_partner_max` int(11) DEFAULT NULL,
  `partner_distance_min` int(11) DEFAULT NULL,
  `partner_distance_max` int(11) DEFAULT NULL,
  `partner_height_min` int(11) DEFAULT NULL,
  `partner_height_max` int(11) DEFAULT NULL,
  `partner_body_type` varchar(255) DEFAULT NULL,
  `partner_relationship_status` varchar(255) DEFAULT NULL,
  `partner_eye_color` varchar(255) DEFAULT NULL,
  `partner_hair_color` varchar(255) DEFAULT NULL,
  `partner_smoking_habits` varchar(255) DEFAULT NULL,
  `partner_eating_habits` varchar(255) DEFAULT NULL,
  `partner_drinking_habits` varchar(255) DEFAULT NULL,
  `partner_children` varchar(255) DEFAULT NULL,
  `partner_occupation` varchar(255) DEFAULT NULL,
  `partner_education` varchar(255) DEFAULT NULL,
  `partner_religion` varchar(255) DEFAULT NULL,
  `partner_financial_status` varchar(255) DEFAULT NULL,
  `partner_dress_style` varchar(255) DEFAULT NULL,
  `partner_vaccinated` varchar(255) DEFAULT NULL,
  `partner_pets` varchar(255) DEFAULT NULL,
  `partner_sports` varchar(255) DEFAULT NULL,
  `partner_entertainment` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `gallery_photo1` varchar(255) DEFAULT NULL,
  `gallery_photo2` varchar(255) DEFAULT NULL,
  `gallery_photo3` varchar(255) DEFAULT NULL,
  `gallery_photo4` varchar(255) DEFAULT NULL,
  `gallery_photo5` varchar(255) DEFAULT NULL,
  `gallery_photo6` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `dob`, `age`, `gender`, `about_you`, `height`, `body_type`, `eye_color`, `hair_color`, `sleeping_habits`, `love_language`, `childrean`, `financial_status`, `dress_stype`, `pets`, `zodiac_sign`, `vaccinated`, `drinking_habits`, `smoking_habits`, `eating_habits`, `communication_style`, `workout`, `education`, `occupation`, `language_speak`, `relationship_status`, `religion`, `location`, `love_goals`, `looking_in_partner`, `sports`, `entertainment`, `my_interests`, `iam_looking_for`, `iam_seeking`, `age_range_in_partner_min`, `age_range_in_partner_max`, `partner_distance_min`, `partner_distance_max`, `partner_height_min`, `partner_height_max`, `partner_body_type`, `partner_relationship_status`, `partner_eye_color`, `partner_hair_color`, `partner_smoking_habits`, `partner_eating_habits`, `partner_drinking_habits`, `partner_children`, `partner_occupation`, `partner_education`, `partner_religion`, `partner_financial_status`, `partner_dress_style`, `partner_vaccinated`, `partner_pets`, `partner_sports`, `partner_entertainment`, `profile_photo`, `gallery_photo1`, `gallery_photo2`, `gallery_photo3`, `gallery_photo4`, `gallery_photo5`, `gallery_photo6`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 94, NULL, '2002-08-16', NULL, 'Male', 'Software developer Engineer at Delhi', '180', 'Average', 'Brown', 'Black', 'Night Owl', 'Quality Time', 'I don\'t have children', 'Excellent', 'Casual', 'Dog', 'Scorpio', 'Yes - Fully Vaccinated', 'Never', 'Non-smoker', 'Vegetarian', 'In-person conversations preferred', 'Daily', 'University education', 'Employed', 'English,Other', 'Single', 'Hinduism', 'Urban', 'Long Term', 'Calm and Understanding Nature', 'Skiing,Boxing,Martial Arts,Cycling,Gymnastics', 'Cooking,Music,Nature,Internet,Video Games,Education,Other', 'Friendship,Dating,Intimate encounter', 'Friendship,Dating', 'Man', 18, 22, 0, 20, 122, 175, 'Curvy', 'Single', 'Brown', 'Black', 'Non-smoker', 'Vegetarian', 'Never', 'No children', 'Employed', 'University education', 'Hinduism', 'Average', 'Casual', 'Yes - Fully Vaccinated', 'Dog,Cat', 'Skiing,Hiking,Soccer,Basketball,Tennis,Swimming,Athletics,Boxing', 'Cooking,Travel,Music,Concerts,Nature,Social Media', NULL, 'profile_photos/oyqjYb8ucs2FetxKVktqUhmcyc5daNCinb9QWyi0.jpg', 'profile_photos/GJ5KwyuqVSRynJWCAD5FVfSoxB9s5WhSEoGwy9FV.jpg', 'profile_photos/E62WNEtqlegxKr7HVgUbuDOT2b5gPJPE9ZHyH4uM.jpg', 'profile_photos/WxJhOPMSLWfKrbtn0IZT4PLqrEfMBfYFW3qb36Pd.jpg', NULL, NULL, '2025-07-13 16:43:42', '2025-07-13 17:20:34', NULL),
(30, 97, NULL, '1988-07-14', NULL, 'Male', 'CRM-ERP Experts', '156', 'Average', 'Black', 'Blonde', 'I go to bed late (after midnight)', 'Acts of Service', 'I have and I don\'t want any more', 'Not the best', 'Business', 'I don\'t have a pet', 'Libra', 'Yes - Fully Vaccinated', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'English', 'Single', 'Hinduism', 'Urban', NULL, NULL, NULL, NULL, 'Short term,Date,Intimate encounter', 'Short term,Date,Intimate encounter', 'Man', 18, 90, 0, 150, 140, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile_photos/MO8phbJ1Ca3PisIycAvt6jKwboBX5X4ZUBJsKzhu.jpg', 'profile_photos/anhlu4F7YfwpK4ZBFm2rCZZXGhyTRw8zsmCCjiCg.jpg', 'profile_photos/E9pQ0TthGJBFUq7OH9DGOow94Zpgir1SzzuNJwsk.jpg', NULL, NULL, NULL, NULL, '2025-07-14 07:44:34', '2025-07-14 07:44:34', NULL),
(32, 109, NULL, '1991-04-19', NULL, 'Male', 'Testing', '173', 'Average', 'Black', 'Black', 'I go to bed early (before 10pm)', 'Words of Affirmation', 'Maybe', 'Excellent', 'Casual', 'I don\'t have a pet', 'Scorpio', 'Yes - Fully Vaccinated', 'Never', 'Non-smoker', 'I don\'t want to say ...', 'English', 'A few times a week', 'University education', 'Employed', 'English', 'Single', 'Hinduism', 'Urban', NULL, NULL, NULL, NULL, NULL, NULL, 'Man,Woman', 18, 90, 0, 150, 140, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile_photos/4HHOTsAM63bjnZJGTWTeevC0a5gtds5zR3J0Z8Nm.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-19 10:39:41', '2025-07-19 10:39:41', NULL),
(36, 112, NULL, '2000-07-28', NULL, 'Female', 'test', '179', 'Athletic', 'Black', 'Black', 'I go to bed early (before 10pm)', 'Quality Time', 'I don\'t have children', 'Excellent', 'Trendy', NULL, 'Taurus', 'Yes - Fully Vaccinated', NULL, NULL, 'Vegetarian', NULL, 'A few times a week', 'College', 'Employed', 'English,French,Spanish', 'Single', 'Hinduism', NULL, 'Enjoy together', 'test', NULL, 'Cooking,Travel,Music', 'Friendship,Date', 'Friendship', 'Man,Woman', 18, 90, 0, 150, 140, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile_photos/mnJuydFTGRTUO327C4b6tlLGJBmu8OLp9Q3DJys9.jpg', 'profile_photos/u1xL0vV29A2S7wGX5eXj8kSpMnCWBd80LuexlsnI.jpg', NULL, NULL, NULL, NULL, NULL, '2025-07-19 16:07:58', '2025-09-06 05:36:17', NULL),
(37, 114, NULL, '2003-05-07', NULL, 'Male', 'asdasd', '123', 'Slim', 'Blue', 'Blonde', 'Night Owl', 'Words of Affirmation', 'I have children', 'Very satisfactory', 'Trendy', 'Fish', NULL, NULL, 'Occasionally', 'Occasionally', 'No dietary restrictions', 'Texting throughout the day', 'A few times a week', 'Secondary school', 'Employed', 'French', 'In a Relationship', 'Islam', 'Rural', 'dsadsa', 'sdsad', 'Soccer,Basketball', 'Concerts,Nature', 'Dating,Adventure', 'Dating,Adventure', 'Woman,Couple', 18, 60, 10, 500, 122, 213, 'Athletic', 'In a Relationship', 'Blue', 'Brown', NULL, NULL, 'Occasionally', 'Have children', 'Employed', 'Secondary school', 'Islam', 'Very satisfactory', 'Trendy', 'Yes - Partially Vaccinated', 'Birds,Reptiles,Other animals', 'Hiking,Basketball,Volleyball', 'Music,Art Creation,Film & Television', NULL, 'profile_photos/DEmvLm0TMDDEIAPdKvesZ4RuEgzXTN58neOYPfb3.png', 'profile_photos/qofBl3LeslnPZTkHYxlCA8sb5BTpKvdbGXHO8etB.jpg', NULL, NULL, NULL, NULL, '2025-07-21 09:29:52', '2025-07-21 09:29:52', NULL),
(38, 118, NULL, '2002-07-01', NULL, 'Women', 'test', '176', 'Athletic', 'Black', 'Black', 'Night Owl', 'Quality Time', 'I don\'t have children', 'Excellent', 'Trendy', NULL, 'Aries', 'Yes - Fully Vaccinated', 'Trying to Quit', 'Trying to Quit', 'Vegetarian', 'Long phone calls', 'Daily', 'University education', 'Employed', 'English,Spanish', 'Single', 'Hinduism', 'Urban', 'enjoy together', 'enjoy', NULL, NULL, NULL, NULL, 'Man,Woman', 18, 27, 10, 120, 122, 175, NULL, 'Single', 'Black', 'Black', 'Trying to Quit', 'Vegetarian', 'Trying to Quit', 'No children', 'Employed', 'University education', 'Hinduism', 'Average', 'Trendy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-21 15:51:30', '2025-07-21 15:51:30', NULL),
(39, 120, NULL, '2002-07-01', NULL, 'Women', 'test', '175', 'Athletic', 'Black', 'Black', 'Night Owl', 'Quality Time', 'I don\'t have children', 'Excellent', 'Trendy', NULL, 'Aries', 'Yes - Fully Vaccinated', 'Trying to Quit', 'Trying to Quit', 'Vegetarian', 'Long phone calls', 'Daily', 'University education', 'Employed', 'English,Spanish', 'Single', 'Hinduism', 'Urban', 'enjoy together', 'test', NULL, NULL, 'Friendship,Dating', NULL, 'Man,Woman', 18, 27, 10, 126, 122, 167, 'Athletic', 'Single', 'Black', 'Black', 'Trying to Quit', 'Vegetarian', 'Trying to Quit', 'No children', 'Employed', 'University education', 'Hinduism', 'Excellent', 'Trendy', 'Yes - Fully Vaccinated', 'Dog,Cat', NULL, 'Cooking,Travel,Music', NULL, 'profile_photos/YgE62Xiu4u0ylqTJ57o8rY678TpHb04WXOhTk4X4.jpg', NULL, NULL, NULL, NULL, NULL, '2025-07-21 16:10:10', '2025-07-21 16:10:10', NULL),
(41, 123, NULL, '2007-07-23', NULL, 'Male', 'test', '171', 'Athletic', NULL, NULL, NULL, NULL, 'I don\'t have children', 'Excellent', 'Trendy', NULL, 'Libra', 'Yes - Fully Vaccinated', 'Never', 'Non-smoker', 'Vegetarian', 'English,French', 'Daily', 'University education', 'Employed', 'English,French', 'Single', 'Hinduism', 'Urban', 'Enjoy together', 'test', NULL, 'Cooking,Travel,Music', 'Date', 'Date', 'Woman', 18, 27, 0, 100, 140, 168, 'Curvy', 'Single', 'Black', 'Black', 'Non-smoker', 'Vegetarian', 'Never', 'I don\'t have children', 'Employed', 'University education', 'Hinduism', 'Excellent', 'Trendy', 'Yes - Fully Vaccinated', NULL, NULL, 'Cooking,Travel,Music', 'profile_photos/0FebfnX6eLMAUnIJ66VH2tu3mcKslOwlrPz5Vk4N.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-23 07:23:04', '2025-07-23 07:24:33', NULL),
(42, 124, NULL, '1991-04-19', NULL, 'Male', 'Test', '173', 'Average', NULL, NULL, NULL, NULL, 'Maybe', NULL, NULL, NULL, 'Scorpio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Single', 'Hinduism', 'Urban', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 90, 0, 150, 140, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile_photos/O8qLmVXRtJSB1TXLiuGHbiqUR5eWttyw2ugyEunt.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-27 08:11:44', '2025-07-27 08:11:44', NULL),
(43, 125, NULL, '2025-08-06', NULL, 'Male', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Skiing,Hiking,Soccer,Golf', NULL, 'Friendship', 'Friendship', NULL, 18, 90, 0, 150, 155, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-05 09:36:12', '2025-09-06 05:15:08', NULL),
(45, 127, NULL, '2000-08-23', NULL, 'Male', 'hey, hey 👋👋', '158', 'Average', 'Blue', NULL, NULL, NULL, 'I have children', NULL, NULL, NULL, 'Scorpio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'In a Relationship', 'Hinduism', 'Suburban', 'hey hello', 'hey hello', 'Skiing,Hiking', 'Astrology,Outdoor Activities', 'Friendship', 'Friendship', 'Man,Woman', 18, 90, 0, 180, 140, 200, 'Curvy', 'In a Relationship', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rodents', 'Rugby', 'Art Creation', 'profile_photos/ulByOwME2LWzUAJXkAY2LX2tXqILVqXref7wdZBi.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-07 16:18:14', '2025-09-03 02:23:49', NULL),
(46, 130, NULL, '2007-08-13', NULL, 'Male', 'Kartik dev', '200', 'Muscular', NULL, NULL, NULL, NULL, 'I don\'t have children', NULL, NULL, NULL, 'Leo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Single', 'Hinduism', 'Urban', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 90, 0, 150, 140, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile_photos/ZJreGVyn4fpdR3cU7pXdK1GRqw7YMWLqPxvt6FVy.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-13 12:10:38', '2025-08-13 12:10:38', NULL),
(48, 138, NULL, '2007-08-28', NULL, 'Male', 'happy new year', '122', 'Slim', 'Green', 'Black', 'I need complete silence', 'Acts of Service', 'I don\'t have children', 'Excellent', 'Fine', 'Dogs', 'Leo', 'Yes - Fully Vaccinated', 'Never', 'Non-smoker', 'Vegan', 'English', 'A few times a week', 'College', 'Unemployed', 'English,Spanish,French', 'Single', 'Other', 'Urban', 'happy new year', 'happy new year', 'Skiing,Hiking', 'Cooking', 'Friendship', 'Friendship', 'Woman', 18, 32, 0, 100, 148, 200, NULL, 'Single', 'Black', 'Black', 'Non-smoker', 'Fast food fan', 'Never', 'I don\'t have children', 'Unemployed', 'Elementary school', 'Christianity', 'Excellent', 'Business', 'Yes - Fully Vaccinated', 'Dogs', 'Volleyball,Ice Hockey', 'Art Creation', 'profile_photos/Qv7pfmo8aPoNEqjKkAh3R0eBFnWrGVH9q7Ha3lXr.jpg', 'profile_photos/tjXXmiQgoorYF0KWgVhsZH2uA8aSO0AoKAQ5q0q0.jpg', NULL, NULL, NULL, NULL, NULL, '2025-08-27 17:43:29', '2025-08-27 17:43:29', NULL),
(50, 140, NULL, '2025-08-08', NULL, NULL, 'tes t tes ttest tets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test tes test', 'te tetstst tatsauiiosiiwqiiwewqiiqwi', NULL, NULL, NULL, NULL, NULL, 18, 60, 10, 500, 122, 213, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-29 18:54:58', '2025-09-06 16:12:35', NULL),
(51, 148, NULL, '2025-08-26', NULL, 'male', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 'skinny', 'green', 'brown', 'routine', 'what', NULL, 'excellent', NULL, 'dogs', 'aries', 'vaccinated', 'regularly', 'no', 'no-say', 'long-calls', 'daily', 'elementary', NULL, 'english', 'single', 'kristjan', NULL, 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'skiing', 'cooking', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'friendship', 'man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-29 19:27:56', '2025-08-29 19:27:56', NULL),
(52, 149, NULL, '2025-08-20', NULL, 'male', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 'skinny', 'green', 'brown', 'routine', 'what', NULL, 'excellent', NULL, 'dogs', 'aries', 'vaccinated', 'regularly', 'no', 'no-say', 'long-calls', 'daily', 'elementary', NULL, 'english', 'single', 'kristjan', NULL, 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'skiing', 'cooking', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'friendship', 'man', NULL, NULL, NULL, NULL, NULL, NULL, 'skinny', 'single', 'green', 'brown', 'no', 'no-say', 'regularly', 'no-children', 'unemployed', 'elementary', 'kristjan', 'excellent', 'casual', 'vaccinated', 'dogs', NULL, 'cooking', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-29 19:35:52', '2025-08-29 19:41:33', NULL),
(53, 141, NULL, '2025-07-29', NULL, 'male', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 'skinny', 'green', 'brown', 'routine', 'what', NULL, 'excellent', NULL, 'dogs', 'aries', 'vaccinated', 'regularly', 'no', 'no-say', 'long-calls', 'daily', 'elementary', NULL, 'english', 'single', 'kristjan', NULL, 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'skiing', 'cooking', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'friendship', 'man', NULL, NULL, NULL, NULL, NULL, NULL, 'skinny', 'single', 'green', 'brown', 'no', 'no-say', 'regularly', 'no-children', 'unemployed', 'elementary', 'kristjan', 'excellent', 'casual', 'vaccinated', 'dogs', 'skiing', 'cooking', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-30 06:53:12', '2025-08-30 06:59:09', NULL),
(55, 155, NULL, '2025-08-06', NULL, 'male', 'Necessitatibus possi', NULL, 'extra-pounds', 'grey', 'other', 'meditate', 'service', NULL, 'average', NULL, NULL, 'leo', 'vaccinated', 'regularly', 'quit', 'vegan', 'not-talker', 'rarely', 'secondary', NULL, 'english', 'lover', 'catholic', NULL, 'Pariatur Voluptas a', 'Qui mollit et ipsa', 'skiing', 'playingInstruments', 'Ut id excepturi sunt', 'short_term', 'man', NULL, NULL, NULL, NULL, NULL, NULL, 'average', 'dont-say', 'black', 'red', 'no', 'no-say', 'no', 'have-children', 'temporary', 'college', 'buddhist', 'not-the-best', 'business', 'vaccinated', 'dogs', 'baseball', 'motorboating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-30 08:21:52', '2025-08-30 08:21:52', NULL),
(58, 159, NULL, '2007-09-01', NULL, 'Male', 'new use abc', '123', 'Slim', 'Green', 'Blonde', 'I need complete silence', 'Acts of Service', 'I don\'t know yet ...', 'Average', 'Business', 'Fish', 'Scorpio', 'Yes - Fully Vaccinated', 'Occasionally', 'Occasionally', 'Flexitarian', 'Spanish', 'I prefer outdoor activities', 'University education', 'Temporary', 'French,Mandarin,English', 'Engaged', 'Buddhism', 'Suburban', 'new userv', 'dhhejejejee', 'Swimming,Hiking,Tennis', 'Education,Do It Yourself,Beach & Sea', 'Intimate encounter', 'Intimate encounter', 'Couple', 18, 90, 0, 180, 140, 200, 'Curvy', 'Engaged', 'Blue', 'Blonde', 'Social Smoker', 'Gluten-free', 'Social Drinker', 'Maybe', 'Employed', 'University education', 'Judaism', 'Very satisfactory', 'Alternative', 'Yes - Partially Vaccinated', 'Other animals,Horses', 'Soccer,Badminton', 'Gardening,Art Creation,Cars,Internet,Playing Instruments,Culture', 'profile_photos/tFe1bZKzhk7j7GrLdkkHarBDDdGOwVup4xBVdqlF.jpg', 'profile_photos/gtkiOvuMzjaZU1rsIiOKVdYckKTkh0YX6ht1zAaD.jpg', NULL, NULL, NULL, NULL, NULL, '2025-09-01 14:19:07', '2025-09-01 14:19:07', NULL),
(59, 160, NULL, '2025-09-01', NULL, 'male', 'Brisaffaumayo-2938@', NULL, 'average', 'blue', 'black', 'no-routine', 'words', NULL, 'average', NULL, 'cats', 'sagittarius', 'unvaccinated', 'prefer-not-to-say', 'occasionally', 'gluten-free', 'short-calls', 'just-started', 'secondary', NULL, 'ukrainian', 'complicated', 'jew', NULL, 'happy birthday user', 'happy birthday user', 'hiking', 'videoGames', 'happy birthday user', 'friendship', 'man', NULL, NULL, NULL, NULL, NULL, NULL, 'stronger', 'divorced', 'blue', 'other', 'yes', 'lactose-free', 'no', 'have-children', 'self-employed', 'masters', 'jew', 'excellent', 'alternative', 'prefer-not-to-say', 'birds', 'baseball', 'artCreation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-01 14:26:08', '2025-09-01 14:26:08', NULL),
(61, 162, NULL, '2025-09-01', NULL, 'Male', 'asaasasasasasasassaa', NULL, 'Skinny', 'Green', 'Black', 'Night Owl', 'Words of Affirmation', NULL, 'Excellent', NULL, 'Dog', 'Aries', 'Yes - Fully Vaccinated', 'Occasionally', 'Non-smoker', 'Mostly healthy', 'Long phone calls', 'Daily', 'Elementary school', NULL, 'English', 'Single', 'Christianity', NULL, 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Skiing', 'Cooking', 'lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Friendship', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, 'Skinny', 'Single', 'Green', 'Black', 'Non-smoker', 'Mostly healthy', 'Occasionally', 'I don\'t have children', 'Unemployed', 'Elementary school', 'Christianity', 'Excellent', 'Casual', 'Yes - Fully Vaccinated', 'Dog', 'Skiing', 'Cooking', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-01 18:01:05', '2025-09-01 18:01:05', NULL),
(68, 175, NULL, '2003-04-17', NULL, 'Male', 'sd', '124', NULL, 'Don\'t know', 'Blonde', NULL, 'Acts of Service', 'I don\'t want children', 'Very satisfactory', NULL, 'Birds', 'Cancer', 'Yes - Partially Vaccinated', NULL, 'Occasionally', 'Vegetarian', 'Texting throughout the day', 'A few times a week', 'University education', 'Employed', NULL, NULL, 'Buddhism', 'Suburban', 'kmd', 'ksnd', NULL, 'Art Creation', 'Short term', 'Intimate encounter', 'Couple', 18, 28, 10, 111, 122, 132, 'Athletic,Body Builder,A few extra pounds', 'In a Relationship,Widower,Other', 'Green,Black,Grey', 'Black,Blonde', 'I don\'t smoke,I\'m trying to quit', 'Mostly healthy,Vegan,Keto/Low-carb', 'I don\'t drink alcohol,I drink alcohol occasionally', 'No children,Have children', 'Employed,Temporary,Self-employed', 'Secondary school,College,University education,Doctorate', 'Hinduism,Buddhism,Atheist', 'Excellent,Very satisfactory,Not the best', 'Business,Fashion,Retro', 'Yes - Fully Vaccinated,Yes - Partially Vaccinated', 'Horse', 'Tennis', 'Nature', NULL, 'profile_photos/7zYLQr9Y4wox5tbg2quAfMl0PDUw99ueDB9SgDyI.jpg', 'profile_photos/0hmIXQGHWGZQFGTCAYg4dWHVy1YZCX9Yfm7n9LFb.jpg', NULL, NULL, NULL, NULL, '2025-09-03 09:24:27', '2025-09-08 09:51:54', NULL),
(69, 176, NULL, '2001-06-12', NULL, 'Male', 'dfgf', '137', 'Average', 'Black', 'Blonde', 'Early Bird', 'Receiving Gifts', 'I don\'t want children', 'Average', 'Urban', 'Reptiles', 'Cancer', 'Yes - Partially Vaccinated', 'Social Drinker', 'Occasionally', 'Vegetarian', 'Texting throughout the day', 'Occasionally', 'College', 'Temporary', NULL, 'Married', 'Judaism', 'Rural', 'dsffsd', 'sdf', 'Baseball', 'Social Media', 'Dating', 'Anything', 'Woman', 18, 90, 10, 931, 122, 139, 'Curvy', 'Engaged', 'Black', 'Red', 'Social Smoker', 'Fast food fan', 'Social Drinker', 'Have children', 'Temporary', 'College', 'Hinduism', 'Average', 'Urban', 'Yes - Partially Vaccinated', 'Cat', 'Tennis', 'Art Creation', NULL, 'profile_photos/PMiLVncHrjoQsbtaFWZI5a3odydmjRhraNwrLL7D.jpg', 'profile_photos/r3asO8lJ3j0fiZscx7nCpjWOuKemQhLOW0G13A2I.jpg', 'profile_photos/ma3Jr9JCubOXlyPqk5pQtcsqP76F9i2NyKW0EDqC.jpg', 'profile_photos/e8BxswyMaO3lKj9nAGj6iJ2wVNmwRa1jzsmrWqSg.jpg', 'profile_photos/8QPm1OB2dybKFdarvxK7AQJ9etOsoX6jVSB3iRHh.jpg', 'profile_photos/WkXNPoz0LHqXUJ92X8bh5OJ9ScXH9Xvhe3aAO4wq.png', '2025-09-03 09:37:09', '2025-09-03 09:37:37', NULL),
(70, 177, NULL, '2025-09-01', NULL, 'Male', 'Nippunnudenu@123Nippunnudenu@123', '137', 'Slim', 'Blue', 'Black', 'Night Owl', 'Acts of Service', 'I don\'t know yet ...', 'Excellent', 'Alternative', 'I don\'t have a pet', 'Pisces', 'Yes - Partially Vaccinated', 'Regularly', 'Social Smoker', 'Foodie – I love trying new cuisines', 'I reply when I can', 'I’m just getting started', 'Doctorate', 'Self-employed', 'on', 'Divorced', 'Other', 'Suburban', 'Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123', 'Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123Nippunnudenu@123', 'Skiing', 'Travel', 'Friendship', 'I don\'t know yet ...', 'Man', 18, 60, 10, 500, 122, 213, 'Slim', 'Single', 'Blue', 'White', 'Regularly', 'Foodie – I love trying new cuisines', 'Social Drinker', 'Have children', 'Self-employed', 'University education', 'Other', 'Average', 'Retro', 'No', 'Other animals', 'Athletics', 'Social Media', NULL, 'profile_photos/INQ0gw5QclU2898e3vp6rP7ldzuhjwMLGHPWg0ik.png', NULL, NULL, NULL, NULL, NULL, '2025-09-03 14:18:52', '2025-09-03 14:18:52', NULL),
(73, 180, NULL, '2006-08-30', NULL, 'Male', 'acceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptaccept', NULL, 'Average', 'Don\'t know', 'Shaved', 'Early Bird', 'Quality Time', NULL, 'A hole in the wallet', 'Retro', 'Dog', 'Taurus', 'Yes - Partially Vaccinated', 'Trying to Quit', 'Trying to Quit', 'Organic food lover', 'Long phone calls', 'Fitness is a big part of my life', 'Doctorate', NULL, 'English', 'Engaged', 'Prefer not to say', NULL, 'acceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptaccept', 'acceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptaccept', 'Hiking', 'Books & Literature', 'acceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptacceptaccept', 'I don\'t know yet ...', 'Woman', 59, 70, 50, 93, 135, 180, 'Athletic', 'Widowed', 'Blue', 'Shaved', 'Regularly', 'Fast food fan', 'Regularly', 'I have children', 'Other', 'Master\'s degree', 'Other', 'Not the best', 'Retro', 'Prefer not to say', 'Cat', 'Swimming', 'Books & Literature', 'profile_photos/ny2FwBYjP0JGOVRGt673zLSxGqLcQNKVAODyIvmA.png', 'profile_photos/OZDeGYAxIyckQnjrGZVn5fPzXqTxZqKcfoSpe8YW.png', NULL, NULL, NULL, NULL, NULL, '2025-09-03 14:57:27', '2025-09-03 14:57:27', NULL),
(74, 181, NULL, '2006-09-05', NULL, 'Male', '7714771477147714771477147714771477147714771477147714771477147714', NULL, 'Athletic', 'Don\'t know', 'Other', 'Early Bird', 'Physical Touch', NULL, 'Average', 'Retro', 'Dog', 'Gemini', 'Yes - Fully Vaccinated', 'Never', 'Regularly', 'Home-cooked meals preferred', 'Long phone calls', 'I’m just getting started', 'Doctorate', NULL, 'English', 'Engaged', 'Islam', NULL, '771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714771477147714', '7714771477147714771477147714771477147714771477147714771477147714', 'Skiing', 'Dance', '7714771477147714771477147714771477147714771477147714771477147714', 'Intimate encounter', 'Man', 40, 79, 0, 130, 155, 180, 'Chubby', 'In a Relationship', 'Don\'t know', 'Shaved', 'Non-smoker', 'Gluten-free', 'Trying to Quit', 'I don&#39;t know yet ...', 'Self-employed', 'Other', 'Hinduism', 'A hole in the wallet', 'Retro', 'Prefer not to say', 'Reptiles', 'Swimming', 'Travel', 'profile_photos/GxvRSDZ51Pzg3PylhTNsu6I60jModD9qDuYUQKfU.png', 'profile_photos/y8iR4ncybEWv1Oq2UJAOa2fuHqkgdJTfyopOpeJ6.png', 'profile_photos/Yz3JlfAFK05P4pWtCpZdCd3b8ZPtsrLYsoU72HDF.png', NULL, NULL, NULL, NULL, '2025-09-03 15:30:59', '2025-09-03 15:30:59', NULL),
(75, 182, NULL, '2025-09-01', NULL, 'Male', '9555955595559555955595559555955595559555', NULL, 'Athletic', 'Blue', 'Shaved', 'Night Owl', 'Quality Time', NULL, 'Very satisfactory', 'Alternative', 'I don\'t have a pet', 'Aquarius', 'Yes - Partially Vaccinated', 'Social Drinker', 'Regularly', 'Fast food fan', 'Long phone calls', 'I’m just getting started', 'Secondary school', NULL, 'English', 'Engaged', 'Islam', NULL, '95559555955595559555955595559555955595559555', '95559555955595559555955595559555955595559555', 'Table Tennis', 'Dance', '95559555955595559555955595559555955595559555', 'Friendship', 'Man', 18, 63, 1, 150, 155, 195, NULL, 'In a Relationship', 'Green', 'Other', 'Occasionally', 'Fast food fan', 'Regularly', 'I have and I don&#39;t want any more', 'Employed', 'Doctorate', 'Judaism', 'Very satisfactory', 'Retro', 'Yes - Partially Vaccinated', 'Birds', 'Basketball', 'Cooking', 'profile_photos/Ly8MFQ2XN2SBohwdhm4WR4tKqB58Vwng5xiGOA41.png', 'profile_photos/wnkpldtgN7MJpHJiGbiuWeLi5IulJ8GtNjX6OBmB.png', NULL, NULL, NULL, NULL, NULL, '2025-09-03 15:42:25', '2025-09-03 15:42:25', NULL),
(82, 190, NULL, '2025-09-03', NULL, 'Male', 'Ullam necessitatibus', '122', 'Average', 'Green', NULL, 'I have a bedtime ritual (e.g., reading, listening to music)', 'Words of Affirmation', NULL, 'A hole in the wallet', 'Alternative', 'Other animals', 'Aquarius', 'Prefer not to say', 'I don\'t want to say ...', 'Occasionally', 'Foodie – I love trying new cuisines', 'I’m not much of a talker', 'Fitness is a big part of my life', 'Elementary school', 'Employed', 'German,Spanish', NULL, 'Christianity', NULL, 'Voluptatem reiciendi', 'Ullamco necessitatib', 'Boxing,Rugby,American Football', 'Hobbies,Do It Yourself', NULL, 'Friendship,I don\'t know yet ...', 'Man,Woman', 40, 63, 50, 150, 155, 180, 'Body Builder', 'Divorced', 'Don\'t know', 'Brown', 'Occasionally', 'Keto/Low-carb', 'I don\'t drink alcohol', 'Have children', 'Student', 'Master\'s degree', 'Buddhism', 'Excellent', 'Business', 'Yes - Fully Vaccinated', 'Dog,Birds', 'Baseball,Swimming', 'Cooking,Travel,Photography,Singing,Hobbies,Do It Yourself', 'profile_photos/ijGCIofePdbHSCDxgHko60zvRhMivuz6AkDyr0XK.png', 'profile_photos/vCWiK2Y6mBe3HdEcNnrFbn3S2VaGrfz9pFXeVhZa.png', NULL, NULL, NULL, NULL, NULL, '2025-09-06 05:42:20', '2025-09-06 05:44:23', NULL),
(83, 189, 'India', '1996-03-05', NULL, 'Male', 'Test Mayur', '154', 'Average', 'Brown', 'Black', 'I just fall asleep, no routine', 'Quality Time', 'I don\'t have children', 'Average', 'Alternative', 'I don\'t have a pet', 'Gemini', 'Yes - Fully Vaccinated', 'I don\'t drink alcohol', 'I don\'t smoke', 'Mostly healthy', 'English', 'Occasionally', 'University education', 'Self-employed', 'English', 'Single', 'Hinduism', 'Urban', 'Test Mayur', 'Test Mayur', 'Skiing', 'Social Media,Photography,Theater', 'Friendship,Date,Marriage', 'Friendship,Date,Marriage', 'Woman', 40, 63, 50, 150, 140, 200, NULL, 'Single', 'Don\'t know', 'Brown,Black,Gray', 'I don\'t smoke', 'Health-conscious,Mostly healthy,Vegetarian', 'I don\'t drink alcohol', 'I don\'t have children', 'Self-employed,Employed', 'College,University education', 'Hinduism', 'Average,Very satisfactory,Excellent', 'Business,Casual', 'Yes - Fully Vaccinated,Yes - Partially Vaccinated', 'I don\'t have a pet', 'Skiing,Hiking,Cycling', 'Cooking,Travel,Music,Social Media,Dance,Film & Television', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-06 09:18:21', '2025-09-06 09:18:21', NULL),
(84, 192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 60, 10, 500, 122, 213, 'Athletic,A few extra pounds,Stronger', 'Divorced,Widower,Lover', 'Blue,Black,Grey', 'Brown,Black,Gray', 'I don\'t smoke', 'Vegan,Pescatarian,Flexitarian', 'I drink alcohol regularly,I don\'t drink alcohol,I drink alcohol occasionally', 'No children,Have children', 'Student,Self-employed,Retired', 'Secondary school,College', 'Judaism,Atheist,Agnostic', 'Excellent,Very satisfactory,Average', 'Fine,Urban,Business,Sports,Fashion', 'Yes - Fully Vaccinated,Yes - Partially Vaccinated,No', 'Spiders,Other animals,Rodents', 'Baseball,Swimming,Athletics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-08 09:54:50', '2025-09-08 09:54:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_feed_id_foreign` (`feed_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feeds_user_id_foreign` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `otp_codes`
--
ALTER TABLE `otp_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_foreign` (`user_id`);

--
-- Indexes for table `story_views`
--
ALTER TABLE `story_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_views_story_id_foreign` (`story_id`),
  ADD KEY `story_views_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_actions_user_id_target_user_id_unique` (`user_id`,`target_user_id`);

--
-- Indexes for table `user_blocks`
--
ALTER TABLE `user_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_blocks_user_id_foreign` (`user_id`),
  ADD KEY `user_blocks_blocked_user_id_foreign` (`blocked_user_id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_comments_user_id_foreign` (`user_id`),
  ADD KEY `user_comments_target_user_id_foreign` (`target_user_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_data_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_kyc_infos`
--
ALTER TABLE `user_kyc_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_kyc_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_likes_user_id_foreign` (`user_id`),
  ADD KEY `user_likes_liked_user_id_foreign` (`liked_user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1137;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `story_views`
--
ALTER TABLE `story_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `user_blocks`
--
ALTER TABLE `user_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_kyc_infos`
--
ALTER TABLE `user_kyc_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_feed_id_foreign` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feeds`
--
ALTER TABLE `feeds`
  ADD CONSTRAINT `feeds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `story_views`
--
ALTER TABLE `story_views`
  ADD CONSTRAINT `story_views_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `story_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_blocks`
--
ALTER TABLE `user_blocks`
  ADD CONSTRAINT `user_blocks_blocked_user_id_foreign` FOREIGN KEY (`blocked_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_blocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD CONSTRAINT `user_comments_target_user_id_foreign` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_kyc_infos`
--
ALTER TABLE `user_kyc_infos`
  ADD CONSTRAINT `user_kyc_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_liked_user_id_foreign` FOREIGN KEY (`liked_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
