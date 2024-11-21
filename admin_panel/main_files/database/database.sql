-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2024 at 03:00 PM
-- Server version: 10.6.17-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brandmar_axtro`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `banner_image`, `image`, `signature`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/about-us-2024-07-14-04-57-26-5330.png', 'uploads/website-images/about-us-2023-07-18-04-44-23-6217.png', 'uploads/website-images/about-us-2023-07-18-04-26-26-1714.png', '2022-01-30 12:30:23', '2024-07-14 20:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_languages`
--

CREATE TABLE `about_us_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `header1` varchar(255) DEFAULT NULL,
  `header2` varchar(255) DEFAULT NULL,
  `header3` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desgination` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_languages`
--

INSERT INTO `about_us_languages` (`id`, `about_id`, `lang_code`, `title`, `header1`, `header2`, `header3`, `about_us`, `name`, `desgination`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Welcome to the Axtro marketplace', 'Prepare for the Ultimate Gaming Experience  Unbeatable Deals Await!', 'You’d', 'Business Success.', '<p>There are many variations of passages of Lorem Ipsum available, but the&nbsp;majority have suffered alteration in some form, by injected humour, or a&nbsp;randomised woirds which don\'t look even.</p>\r\n<p>&nbsp;</p>\r\n<p>Going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text</p>', 'Shivang Preet', 'CEO & Founder', NULL, '2024-08-12 09:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_type` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `forget_password_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_type`, `name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `status`, `forget_password_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Doe', 'admin@gmail.com', 'uploads/website-images/john-doe-2024-08-10-05-25-17-9036.png', NULL, '$2y$10$4FHkH9UCXY51PW6yfBM7hODVySNuMKLQ/6vEU99KFe8Z9LU.EZeFG', 'Cbeb9ZJwwmVdXqkiXhNbEy0s9rzVo0CpDL8u3OFsPGja6WUJ8bHn0se53rib', 1, '0P3Wg6Z5eEqxkvcELebLOHUaIrgVQJ5SLmz1LNhpqBTvB8h6Si8DNL91qsk4C1LyQMqnNJwTmFrcahFR6Y9sNvuV3VhP5fLuNYLy', NULL, '2024-08-12 08:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/ad--2024-07-09-10-31-25-5767.png', 'https://codecanyon.net/user/quomodotheme/portfolio', 1, '2023-05-24 07:33:19', '2024-07-31 19:15:56'),
(2, 'uploads/website-images/ad--2024-07-31-02-57-56-1075.png', 'https://codecanyon.net/user/quomodotheme/portfolio', 1, '2023-05-24 07:33:19', '2024-07-31 18:57:56'),
(3, 'uploads/website-images/ad--2024-07-31-02-59-11-1150.png', 'https://codecanyon.net/user/quomodotheme/portfolio', 1, '2023-05-24 07:33:19', '2024-07-31 18:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `bank_payments`
--

CREATE TABLE `bank_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_info` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_payments`
--

INSERT INTO `bank_payments` (`id`, `status`, `account_info`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bank Name: Your bank name\nAccount Number:  Your bank account number\nRouting Number: Your bank routing number\nBranch: Your bank branch name', 'uploads/website-images/bank-2022-09-25-10-06-03-8346.jpg', NULL, '2022-09-25 04:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `banner_location` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `header` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `title`, `description`, `link`, `image`, `button_text`, `banner_location`, `status`, `header`, `created_at`, `updated_at`) VALUES
(1, 'Up To - 35% Off', 'Hot Deals', 'product', 'uploads/website-images/Mega-menu-2022-02-13-07-53-14-1062.png', 'Shop Now', 'Mega Menu Banner', 1, NULL, NULL, '2022-02-13 13:53:14'),
(2, 'Up To -20% Off', 'Hot Deals', 'product', 'uploads/website-images/banner--2022-02-10-10-24-47-2663.jpg', 'Shop Now', 'Home Page One Column Banner', 1, NULL, NULL, '2022-02-13 13:45:52'),
(3, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1335.png', 'Shop Now', 'Home Page First Two Column Banner One', 1, NULL, NULL, '2022-02-13 13:46:01'),
(4, 'Up To -40% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1434.png', 'Shop Now', 'Home Page First Two Column Banner Two', 1, NULL, NULL, '2022-02-13 13:46:01'),
(5, 'Up To -28% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-2862.jpg', 'Shop Now', 'Home Page Second Two Column Banner one', 1, NULL, NULL, '2022-02-13 13:46:15'),
(6, 'Up To -22% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-6995.jpg', 'Shop Now', 'Home Page Second Two Column Banner two', 1, NULL, NULL, '2022-02-13 13:46:15'),
(7, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-57-46-4114.jpg', 'Shop Now', 'Home Page Third Two Column Banner one', 1, NULL, NULL, '2022-02-13 13:46:27'),
(8, 'Up To -15% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-58-43-7437.jpg', 'Shop Now', 'Home Page Third Two Column Banner Two', 1, NULL, NULL, '2022-02-13 13:46:27'),
(9, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-24-44-6895.jpg', 'dd', 'Shopping cart bottom', 1, '', NULL, '2022-02-13 13:47:23'),
(10, 'This is Title', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-25-59-9719.jpg', NULL, 'Shopping cart bottom', 0, NULL, NULL, '2022-02-13 13:47:23'),
(11, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-26-46-8505.jpg', 'dd', 'Campaign page', 1, '', NULL, '2022-02-13 13:47:31'),
(12, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-01-30-06-21-06-4562.png', 'dd', 'Campaign page', 0, '', NULL, '2022-02-13 13:47:31'),
(13, 'This is Tittle', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Shop Now', 'uploads/website-images/banner-2022-02-07-10-48-37-9226.jpg', 'dd', 'Login page', 0, 'Our Achievement', NULL, '2022-02-07 04:48:39'),
(14, 'Black Friday Sale', 'Up To -70% Off', 'product', 'uploads/website-images/banner-2022-02-06-04-24-02-9777.jpg', NULL, 'Product Detail', 1, NULL, NULL, '2022-02-13 13:46:54'),
(15, 'Default Profile Image', NULL, NULL, 'uploads/website-images/default-avatar-2022-02-07-10-10-46-1477.jpg', NULL, 'Default Profile Image', 0, NULL, NULL, '2022-02-07 04:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `show_homepage` int(11) NOT NULL DEFAULT 0,
  `show_featured` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `admin_id`, `slug`, `blog_category_id`, `image`, `views`, `status`, `show_homepage`, `show_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'ai-robot-using-cyber-security-to-protect-information-privacy-nad-make-it-mazing-to-world-best-time', 1, 'uploads/custom-images/blog--2024-08-11-02-48-42-2610.jpg', 0, 1, 0, 0, '2024-07-14 20:13:24', '2024-08-11 08:48:42'),
(2, 1, 'tips-for-selling-online-plugin-updates-case-studies', 2, 'uploads/custom-images/blog--2024-08-11-02-48-23-8231.jpg', 0, 1, 0, 0, '2024-08-10 11:48:28', '2024-08-11 08:48:23'),
(3, 1, 'seller-stories-marketing-tips-platform-updates', 2, 'uploads/custom-images/blog--2024-08-11-02-48-08-8374.jpg', 0, 1, 0, 0, '2024-08-10 12:00:41', '2024-08-11 08:48:08'),
(4, 1, 'creative-assets-selling-digital-products-marketplace-news', 4, 'uploads/custom-images/blog--2024-08-11-02-47-59-4420.jpg', 0, 1, 0, 0, '2024-08-10 12:02:39', '2024-08-11 08:47:59'),
(5, 1, 'ecommerce-tips-digital-product-selling-platform-updates', 3, 'uploads/custom-images/blog--2024-08-11-02-47-49-5838.jpg', 0, 1, 0, 0, '2024-08-10 12:06:09', '2024-08-11 08:47:49'),
(6, 1, 'online-course-creation-marketing-strategies-platform-tips', 2, 'uploads/custom-images/blog--2024-08-11-02-47-38-5343.jpg', 0, 1, 0, 0, '2024-08-10 12:12:11', '2024-08-11 08:47:38'),
(7, 1, 'selling-your-digital-license-heres-what-you-need-to-know', 1, 'uploads/custom-images/blog--2024-08-11-02-47-25-4983.jpg', 0, 1, 0, 0, '2024-08-10 12:13:59', '2024-08-11 08:47:25'),
(8, 1, 'maximizing-profit-tips-for-selling-your-digital-licenses-quickly', 3, 'uploads/custom-images/blog--2024-08-11-02-47-15-9014.jpg', 0, 1, 0, 0, '2024-08-10 12:21:29', '2024-08-11 08:47:15'),
(9, 1, 'the-pros-and-cons-of-buying-preowned-digital-licenses', 2, 'uploads/custom-images/blog--2024-08-11-02-46-54-7212.jpg', 0, 1, 0, 0, '2024-08-10 12:22:48', '2024-08-11 08:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'game', 1, '2024-07-14 19:52:28', '2024-07-14 19:52:28'),
(2, NULL, 'electronics', 1, '2024-08-10 11:05:20', '2024-08-10 11:05:20'),
(3, NULL, 'chatgpt', 1, '2024-08-10 11:05:28', '2024-08-10 11:05:28'),
(4, NULL, 'open-ai', 1, '2024-08-10 11:05:36', '2024-08-10 11:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category_languages`
--

CREATE TABLE `blog_category_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_category_languages`
--

INSERT INTO `blog_category_languages` (`id`, `category_id`, `lang_code`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Game', '2024-07-14 19:52:28', '2024-07-14 19:52:28'),
(2, 2, 'en', 'Electronics', '2024-08-10 11:05:20', '2024-08-10 11:05:20'),
(3, 3, 'en', 'ChatGPT', '2024-08-10 11:05:28', '2024-08-10 11:05:28'),
(4, 4, 'en', 'Open AI', '2024-08-10 11:05:36', '2024-08-10 11:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(6, 9, 'Ibrahim Khalil', 'user@gmail.com', 'There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don&#039;t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be  sure there isn&#039;t anything embarrassing hidden in the middle of text.', 1, '2024-08-10 12:27:18', '2024-08-10 12:27:18'),
(9, 9, 'John Doe', 'client@gmail.com', 'Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.', 1, '2024-08-11 04:11:28', '2024-08-11 04:11:28'),
(10, 9, 'Daniel Paul', 'david@gmail.com', 'Pre-owned digital licenses, buying tips, pros and cons, market trends, investment opportunities, secure transactions, license value, risk assessment, digital assets, online market, ownership transfer, license authenticity, pricing strategy, marketplace selection, digital content.', 1, '2024-08-11 04:11:56', '2024-08-11 04:11:56'),
(11, 8, 'David Miller', 'david@gmail.com', 'Pre-owned digital licenses, buying tips, pros and cons, market trends, investment opportunities, secure transactions, license value, risk assessment, digital assets, online market, ownership transfer, license authenticity, pricing strategy, marketplace selection, digital content', 1, '2024-08-11 04:12:31', '2024-08-11 04:12:31'),
(12, 8, 'John Doe', 'user@gmail.com', 'There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don&#039;t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be  sure there isn&#039;t anything embarrassing hidden in the middle of text.', 1, '2024-08-11 04:12:53', '2024-08-11 04:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `blog_languages`
--

CREATE TABLE `blog_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_languages`
--

INSERT INTO `blog_languages` (`id`, `blog_id`, `lang_code`, `title`, `short_description`, `description`, `tag`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'The Ultimate Guide to Buying and Selling Digital Licenses Online', 'There are many variationtj of our passages Ipsum available, but the majorit', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"game\"},{\"value\":\"text\"},{\"value\":\"node\"},{\"value\":\"php\"},{\"value\":\"laravel\"}]', 'The Ultimate Guide to Buying and Selling Digital Licenses Online', 'The Ultimate Guide to Buying and Selling Digital Licenses Online', '2024-07-14 20:13:24', '2024-08-10 11:23:57'),
(2, 2, 'en', 'Tips for selling online, plugin updates, case studies', 'Digital licenses, secure transactions, online safety, fraud prevention, buying tips, security practices, license authenticity, scam prevention, purchase verification, digital assets, marketplace selection, online investment', '<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"laravel\"},{\"value\":\"php\"},{\"value\":\"envato\"},{\"value\":\"html\"}]', 'Tips for selling online, plugin updates, case studies', 'Tips for selling online, plugin updates, case studies', '2024-08-10 11:48:28', '2024-08-10 12:01:13'),
(3, 3, 'en', 'Seller stories, marketing tips, platform updates', 'Comprehensive guide, digital license market, secure transactions, online assets, investment, selling, buying, ownership, digital assets, authenticity verification, pre-owned licenses, legalities', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"game\"},{\"value\":\"netflix\"},{\"value\":\"laravel\"},{\"value\":\"php\"},{\"value\":\"css\"},{\"value\":\"html\"}]', 'Seller stories, marketing tips, platform updates', 'Seller stories, marketing tips, platform updates', '2024-08-10 12:00:41', '2024-08-10 12:00:41'),
(4, 4, 'en', 'Creative assets, selling digital products, marketplace news', 'Top digital licenses, investment opportunities, valuable licenses, online assets, best buys, market trends, digital license market, profitable investments, asset growth, high-demand licenses, buying guide, digital ownership, secure transactions, pre-owned licenses, investment strategy, digital content, technology trends, licensing options, digital economy, top picks.', '<p>Top digital licenses, investment opportunities, valuable licenses, online assets, best buys, market trends, digital license market, profitable investments, asset growth, high-demand licenses, buying guide, digital ownership, secure transactions, pre-owned licenses, investment strategy, digital content, technology trends, licensing options, digital economy, top picks.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"python\"},{\"value\":\"netflix\"},{\"value\":\"envato\"},{\"value\":\"html\"},{\"value\":\"joomla\"}]', 'Creative assets, selling digital products, marketplace news', 'Creative assets, selling digital products, marketplace news', '2024-08-10 12:02:39', '2024-08-10 12:02:39'),
(5, 5, 'en', 'E-commerce tips, digital product selling, platform updates', 'Digital license ownership, online assets, future trends, digital economy, investment opportunities, digital transformation, asset security, ownership benefits, exclusive content, technology trends, market growth, secure transactions, digital rights, online ownership, blockchain, legal considerations, digital content, market evolution, profitable assets, digital future.', '<p>Digital license ownership, online assets, future trends, digital economy, investment opportunities, digital transformation, asset security, ownership benefits, exclusive content, technology trends, market growth, secure transactions, digital rights, online ownership, blockchain, legal considerations, digital content, market evolution, profitable assets, digital future.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>', '[{\"value\":\"larave\"},{\"value\":\"php\"},{\"value\":\"css\"},{\"value\":\"jquery\"},{\"value\":\"laravel\"}]', 'E-commerce tips, digital product selling, platform updates', 'E-commerce tips, digital product selling, platform updates', '2024-08-10 12:06:09', '2024-08-10 12:06:09'),
(6, 6, 'en', 'Online course creation, marketing strategies, platform tips', 'Authenticity verification, digital licenses, secure purchases, fraud prevention, buying tips, verification methods, license security, pre-owned licenses, online market, digital assets, secure transactions, purchase safety, digital content, investment security, legal considerations, scam prevention, technology tools, ownership verification, secure deals, online safety.', '<p>Authenticity verification, digital licenses, secure purchases, fraud prevention, buying tips, verification methods, license security, pre-owned licenses, online market, digital assets, secure transactions, purchase safety, digital content, investment security, legal considerations, scam prevention, technology tools, ownership verification, secure deals, online safety.</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"laravel\"},{\"value\":\"php\"},{\"value\":\"mysql\"},{\"value\":\"node js\"}]', 'Online course creation, marketing strategies, platform tips', 'Online course creation, marketing strategies, platform tips', '2024-08-10 12:12:11', '2024-08-10 12:12:11'),
(7, 7, 'en', 'Selling Your Digital License? Here’s What You Need to Know', 'Selling digital licenses, online market, license value, selling tips, profit maximization, market trends, secure transactions, legalities, license transfer, digital assets, marketplace selection, selling strategy, digital content, ownership transfer, pre-owned licenses, online selling, secure deals, negotiation tips, pricing strategy, digital economy.', '<p>Selling digital licenses, online market, license value, selling tips, profit maximization, market trends, secure transactions, legalities, license transfer, digital assets, marketplace selection, selling strategy, digital content, ownership transfer, pre-owned licenses, online selling, secure deals, negotiation tips, pricing strategy, digital economy.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"mysql\"},{\"value\":\"node js\"},{\"value\":\"mongodb\"},{\"value\":\"atlas\"}]', 'Selling Your Digital License? Here’s What You Need to Know', 'Selling Your Digital License? Here’s What You Need to Know', '2024-08-10 12:13:59', '2024-08-10 12:13:59'),
(8, 8, 'en', 'Maximizing Profit: Tips for Selling Your Digital Licenses Quickly', 'Profit maximization, selling digital licenses, online market, fast sales, pricing strategy, market trends, license value, secure transactions, selling tips, digital assets, pre-owned licenses, marketplace selection, negotiation tips, ownership transfer, legal considerations, selling strategy, digital content, secure deals, online selling, license demand.', '<p>Profit maximization, selling digital licenses, online market, fast sales, pricing strategy, market trends, license value, secure transactions, selling tips, digital assets, pre-owned licenses, marketplace selection, negotiation tips, ownership transfer, legal considerations, selling strategy, digital content, secure deals, online selling, license demand.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>\r\n<p>Erators on the Internet tend to repeat predefined chunks as necessary, making this our a the first true generator on the Internet. It uses a dictionary of over to ki hoys Latin words, combined with a handful of model sentence structures</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>', '[{\"value\":\"html\"},{\"value\":\"css\"},{\"value\":\"jquery\"},{\"value\":\"javascript\"}]', 'Maximizing Profit: Tips for Selling Your Digital Licenses Quickly', 'Maximizing Profit: Tips for Selling Your Digital Licenses Quickly', '2024-08-10 12:21:29', '2024-08-10 12:21:29'),
(9, 9, 'en', 'The Pros and Cons of Buying Pre-Owned Digital Licenses', 'Pre-owned digital licenses, buying tips, pros and cons, market trends, investment opportunities, secure transactions, license value, risk assessment, digital assets, online market, ownership transfer, license authenticity, pricing strategy, marketplace selection, digital content, secure deals, legal considerations, digital economy, resale value, digital ownership.', '<p>Pre-owned digital licenses, buying tips, pros and cons, market trends, investment opportunities, secure transactions, license value, risk assessment, digital assets, online market, ownership transfer, license authenticity, pricing strategy, marketplace selection, digital content, secure deals, legal considerations, digital economy, resale value, digital ownership.</p>\r\n<p>Sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum genareto erators on the Internet tend to repeat predefined chunks as necessary, making this the this a first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined our with a handful of model sentence structures</p>\r\n<p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p>\r\n<p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p>\r\n<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suf as ered alteration in some form, by injected humour, or randomised words which don\'t look as our a even slightly believable. If you are going to use as a passage of Lorem Ipsum, you need to be &nbsp;sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"value\":\"javascript\"},{\"value\":\"node js\"},{\"value\":\"mongodb\"},{\"value\":\"atlash\"}]', 'The Pros and Cons of Buying Pre-Owned Digital Licenses', 'The Pros and Cons of Buying Pre-Owned Digital Licenses', '2024-08-10 12:22:48', '2024-08-10 12:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(3, 'gaming', 'uploads/custom-images/category-2024-07-09-01-20-57-2054.png', 1, '2024-07-09 17:20:57', '2024-07-09 17:20:57'),
(4, 'video', 'uploads/custom-images/category-2024-07-09-02-12-10-9911.png', 1, '2024-07-09 18:12:10', '2024-07-09 18:12:10'),
(5, 'ewallet', 'uploads/custom-images/category-2024-08-11-10-17-01-3500.png', 1, '2024-08-11 04:17:01', '2024-08-11 04:17:01'),
(6, 'taghian', 'uploads/custom-images/category-2024-08-11-10-17-46-7275.png', 1, '2024-08-11 04:17:46', '2024-08-11 04:17:46'),
(7, 'pulse', 'uploads/custom-images/category-2024-08-11-10-18-45-9975.png', 1, '2024-08-11 04:18:45', '2024-08-11 04:18:45'),
(8, 'others', 'uploads/custom-images/category-2024-08-11-10-19-10-2292.png', 1, '2024-08-11 04:19:10', '2024-08-11 04:19:10'),
(9, 'gift-card', 'uploads/custom-images/category-2024-08-11-10-19-40-7687.png', 1, '2024-08-11 04:19:40', '2024-08-11 04:19:40'),
(10, 'actions', 'uploads/custom-images/category-2024-08-11-10-21-30-8214.png', 1, '2024-08-11 04:21:30', '2024-08-11 04:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `category_languages`
--

CREATE TABLE `category_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_languages`
--

INSERT INTO `category_languages` (`id`, `category_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(3, 3, 'en', 'Gaming', '2024-07-09 17:20:57', '2024-07-09 17:20:57'),
(4, 4, 'en', 'Video', '2024-07-09 18:12:10', '2024-07-09 18:12:10'),
(5, 5, 'en', 'E-Wallet', '2024-08-11 04:17:01', '2024-08-11 04:17:01'),
(6, 6, 'en', 'Taghian', '2024-08-11 04:17:46', '2024-08-11 04:17:46'),
(7, 7, 'en', 'Pulse', '2024-08-11 04:18:45', '2024-08-11 04:18:45'),
(8, 8, 'en', 'Others', '2024-08-11 04:19:10', '2024-08-11 04:19:10'),
(9, 9, 'en', 'Gift Card', '2024-08-11 04:19:40', '2024-08-11 04:19:40'),
(10, 10, 'en', 'Actions', '2024-08-11 04:21:30', '2024-08-11 04:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_pages`
--

CREATE TABLE `contact_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_pages`
--

INSERT INTO `contact_pages` (`id`, `time`, `image`, `email`, `map`, `email2`, `phone`, `phone2`, `created_at`, `updated_at`) VALUES
(1, '09.00am to 10.00pm', 'uploads/website-images/contact_us-2023-08-24-01-21-01-6182.jpg', 'abdur.rohman2004@gmail.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235339.9298486357!2d-74.26252697197236!3d40.72595505926248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e1!3m2!1sen!2sbd!4v1720071081052!5m2!1sen!2sbd', 'abdur.rohman2004@gmail.com', '+4847-150-3587', '+4847-150-3562', '2022-01-30 12:31:58', '2024-08-13 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_page_languages`
--

CREATE TABLE `contact_page_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `off_day` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_page_languages`
--

INSERT INTO `contact_page_languages` (`id`, `contact_id`, `lang_code`, `title1`, `title2`, `time`, `off_day`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Feel Free to Get in Touch', 'Support Time', '09.00am to 10.00pm', 'Friday Off', 'Jackson Heights, 11372, NY, United States', '+4847-150-3587', NULL, '2024-08-13 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_consents`
--

CREATE TABLE `cookie_consents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `border` varchar(255) DEFAULT NULL,
  `corners` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `border_color` varchar(255) DEFAULT NULL,
  `btn_bg_color` varchar(255) DEFAULT NULL,
  `btn_text_color` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `btn_text` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookie_consents`
--

INSERT INTO `cookie_consents` (`id`, `status`, `border`, `corners`, `background_color`, `text_color`, `border_color`, `btn_bg_color`, `btn_text_color`, `message`, `link_text`, `btn_text`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'thin', 'normal', '#184dec', '#c80404', '#0a58d6', '#fffceb', '#222758', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', 'More Info', 'Yes', NULL, NULL, '2024-02-20 11:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AFA', 'Afghan Afghani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ALL', 'Albanian Lek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'DZD', 'Algerian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AOA', 'Angolan Kwanza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ARS', 'Argentine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'AMD', 'Armenian Dram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'AWG', 'Aruban Florin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'AUD', 'Australian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'AZN', 'Azerbaijani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'BSD', 'Bahamian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'BHD', 'Bahraini Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'BDT', 'Bangladeshi Taka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'BBD', 'Barbadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'BYR', 'Belarusian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'BEF', 'Belgian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BZD', 'Belize Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BMD', 'Bermudan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BTN', 'Bhutanese Ngultrum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BTC', 'Bitcoin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BOB', 'Bolivian Boliviano', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BAM', 'Bosnia-Herzegovina Convertible Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BWP', 'Botswanan Pula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BRL', 'Brazilian Real', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'GBP', 'British Pound Sterling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BND', 'Brunei Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BGN', 'Bulgarian Lev', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BIF', 'Burundian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'KHR', 'Cambodian Riel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'CAD', 'Canadian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'CVE', 'Cape Verdean Escudo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'KYD', 'Cayman Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'XOF', 'CFA Franc BCEAO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'XAF', 'CFA Franc BEAC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'XPF', 'CFP Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'CLP', 'Chilean Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'CNY', 'Chinese Yuan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'COP', 'Colombian Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'KMF', 'Comorian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CDF', 'Congolese Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'CRC', 'Costa Rican ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'HRK', 'Croatian Kuna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'CUC', 'Cuban Convertible Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CZK', 'Czech Republic Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'DKK', 'Danish Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'DJF', 'Djiboutian Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'DOP', 'Dominican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'XCD', 'East Caribbean Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'EGP', 'Egyptian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'ERN', 'Eritrean Nakfa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'EEK', 'Estonian Kroon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'ETB', 'Ethiopian Birr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'EUR', 'Euro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'FKP', 'Falkland Islands Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'FJD', 'Fijian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'GMD', 'Gambian Dalasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'GEL', 'Georgian Lari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'DEM', 'German Mark', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'GHS', 'Ghanaian Cedi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'GIP', 'Gibraltar Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'GRD', 'Greek Drachma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'GTQ', 'Guatemalan Quetzal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'GNF', 'Guinean Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'GYD', 'Guyanaese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'HTG', 'Haitian Gourde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'HNL', 'Honduran Lempira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'HKD', 'Hong Kong Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'HUF', 'Hungarian Forint', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ISK', 'Icelandic KrÃ³na', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'INR', 'Indian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'IDR', 'Indonesian Rupiah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'IRR', 'Iranian Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'IQD', 'Iraqi Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'ILS', 'Israeli New Sheqel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'ITL', 'Italian Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'JMD', 'Jamaican Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'JPY', 'Japanese Yen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'JOD', 'Jordanian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'KZT', 'Kazakhstani Tenge', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'KES', 'Kenyan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'KWD', 'Kuwaiti Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'KGS', 'Kyrgystani Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'LAK', 'Laotian Kip', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'LVL', 'Latvian Lats', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'LBP', 'Lebanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'LSL', 'Lesotho Loti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'LRD', 'Liberian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'LYD', 'Libyan Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'LTL', 'Lithuanian Litas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'MOP', 'Macanese Pataca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'MKD', 'Macedonian Denar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'MGA', 'Malagasy Ariary', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'MWK', 'Malawian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'MYR', 'Malaysian Ringgit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'MVR', 'Maldivian Rufiyaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'MRO', 'Mauritanian Ouguiya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'MUR', 'Mauritian Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'MXN', 'Mexican Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'MDL', 'Moldovan Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'MNT', 'Mongolian Tugrik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'MAD', 'Moroccan Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'MZM', 'Mozambican Metical', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'MMK', 'Myanmar Kyat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'NAD', 'Namibian Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'NPR', 'Nepalese Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'ANG', 'Netherlands Antillean Guilder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'TWD', 'New Taiwan Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'NZD', 'New Zealand Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'NIO', 'Nicaraguan CÃ³rdoba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'NGN', 'Nigerian Naira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'KPW', 'North Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'NOK', 'Norwegian Krone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'OMR', 'Omani Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'PKR', 'Pakistani Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'PAB', 'Panamanian Balboa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'PGK', 'Papua New Guinean Kina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'PYG', 'Paraguayan Guarani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'PEN', 'Peruvian Nuevo Sol', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'PHP', 'Philippine Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'PLN', 'Polish Zloty', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'QAR', 'Qatari Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'RON', 'Romanian Leu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'RUB', 'Russian Ruble', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'RWF', 'Rwandan Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'SVC', 'Salvadoran ColÃ³n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'WST', 'Samoan Tala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'SAR', 'Saudi Riyal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'RSD', 'Serbian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'SCR', 'Seychellois Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'SLL', 'Sierra Leonean Leone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'SGD', 'Singapore Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'SKK', 'Slovak Koruna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'SBD', 'Solomon Islands Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'SOS', 'Somali Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'ZAR', 'South African Rand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'KRW', 'South Korean Won', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'XDR', 'Special Drawing Rights', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'LKR', 'Sri Lankan Rupee', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'SHP', 'St. Helena Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'SDG', 'Sudanese Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'SRD', 'Surinamese Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'SZL', 'Swazi Lilangeni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'SEK', 'Swedish Krona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'CHF', 'Swiss Franc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'SYP', 'Syrian Pound', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'STD', 'São Tomé and Príncipe Dobra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'TJS', 'Tajikistani Somoni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'TZS', 'Tanzanian Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'THB', 'Thai Baht', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'TOP', 'Tongan pa\'anga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'TTD', 'Trinidad & Tobago Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'TND', 'Tunisian Dinar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'TRY', 'Turkish Lira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'TMT', 'Turkmenistani Manat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'UGX', 'Ugandan Shilling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'UAH', 'Ukrainian Hryvnia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'AED', 'United Arab Emirates Dirham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'UYU', 'Uruguayan Peso', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'USD', 'US Dollar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'UZS', 'Uzbekistan Som', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'VUV', 'Vanuatu Vatu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'VEF', 'Venezuelan BolÃ­var', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'VND', 'Vietnamese Dong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'YER', 'Yemeni Rial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'ZMK', 'Zambian Kwacha', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency_countries`
--

CREATE TABLE `currency_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `currency_countries`
--

INSERT INTO `currency_countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Andorra', 'AD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Afghanistan', 'AF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Åland Islands', 'AX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Albania', 'AL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Algeria', 'DZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'American Samoa', 'AS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Angola', 'AO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Anguilla', 'AI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antarctica', 'AQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Antigua and Barbuda', 'AG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Argentina', 'AR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Armenia', 'AM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Aruba', 'AW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Australia', 'AU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Austria', 'AT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Azerbaijan', 'AZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahamas', 'BS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bahrain', 'BH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Bangladesh', 'BD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Barbados', 'BB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belarus', 'BY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belgium', 'BE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Belize', 'BZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Benin', 'BJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bermuda', 'BM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bhutan', 'BT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bolivia (Plurinational State of)', 'BO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bosnia and Herzegovina', 'BA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Botswana', 'BW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Bouvet Island', 'BV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brazil', 'BR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'British Indian Ocean Territory', 'IO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Brunei Darussalam', 'BN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Bulgaria', 'BG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Burkina Faso', 'BF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Burundi', 'BI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Cabo Verde', 'CV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cambodia', 'KH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cameroon', 'CM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Canada', 'CA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Cayman Islands', 'KY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Central African Republic', 'CF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Chad', 'TD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Chile', 'CL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'China', 'CN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Christmas Island', 'CX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Cocos (Keeling) Islands', 'CC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Colombia', 'CO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Comoros', 'KM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Congo', 'CG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Congo (Democratic Republic of the)', 'CD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cook Islands', 'CK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Costa Rica', 'CR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Côte d\'Ivoire', 'CI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Croatia', 'HR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Cuba', 'CU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Curaçao', 'CW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Cyprus', 'CY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Czech Republic', 'CZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Denmark', 'DK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Djibouti', 'DJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Dominica', 'DM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Dominican Republic', 'DO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Ecuador', 'EC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Egypt', 'EG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'El Salvador', 'SV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Equatorial Guinea', 'GQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Eritrea', 'ER', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Estonia', 'EE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Ethiopia', 'ET', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Falkland Islands (Malvinas)', 'FK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Faroe Islands', 'FO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Fiji', 'FJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Finland', 'FI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'France', 'FR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'French Guiana', 'GF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'French Polynesia', 'PF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'French Southern Territories', 'TF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Gabon', 'GA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Gambia', 'GM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Georgia', 'GE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Germany', 'DE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Ghana', 'GH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Gibraltar', 'GI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Greece', 'GR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Greenland', 'GL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Grenada', 'GD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guadeloupe', 'GP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guam', 'GU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guatemala', 'GT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Guernsey', 'GG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Guinea', 'GN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Guinea-Bissau', 'GW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Guyana', 'GY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Haiti', 'HT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Heard Island and McDonald Islands', 'HM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Holy See', 'VA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Honduras', 'HN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Hong Kong', 'HK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Hungary', 'HU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iceland', 'IS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'India', 'IN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Indonesia', 'ID', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Iran (Islamic Republic of)', 'IR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Iraq', 'IQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Ireland', 'IE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Isle of Man', 'IM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Israel', 'IL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Italy', 'IT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Jamaica', 'JM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Japan', 'JP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Jersey', 'JE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Jordan', 'JO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Kazakhstan', 'KZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Kenya', 'KE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Kiribati', 'KI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Korea (Democratic People\'s Republic of)', 'KP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Korea (Republic of)', 'KR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Kuwait', 'KW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Kyrgyzstan', 'KG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Lao People\'s Democratic Republic', 'LA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Latvia', 'LV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Lebanon', 'LB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Lesotho', 'LS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Liberia', 'LR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Libya', 'LY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Liechtenstein', 'LI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Lithuania', 'LT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Luxembourg', 'LU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Macao', 'MO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Macedonia (the former Yugoslav Republic of)', 'MK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Madagascar', 'MG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Malawi', 'MW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Malaysia', 'MY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Maldives', 'MV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Mali', 'ML', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Malta', 'MT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Marshall Islands', 'MH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Martinique', 'MQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Mauritania', 'MR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mauritius', 'MU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Mayotte', 'YT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Mexico', 'MX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Micronesia (Federated States of)', 'FM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Moldova (Republic of)', 'MD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Monaco', 'MC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Mongolia', 'MN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Montenegro', 'ME', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Montserrat', 'MS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Morocco', 'MA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Mozambique', 'MZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Myanmar', 'MM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Namibia', 'NA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Nauru', 'NR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Nepal', 'NP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Netherlands', 'NL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'New Caledonia', 'NC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'New Zealand', 'NZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Nicaragua', 'NI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Niger', 'NE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Nigeria', 'NG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Niue', 'NU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Norfolk Island', 'NF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Northern Mariana Islands', 'MP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Norway', 'NO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Oman', 'OM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Pakistan', 'PK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Palau', 'PW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Palestine, State of', 'PS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Panama', 'PA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Papua New Guinea', 'PG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Paraguay', 'PY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Peru', 'PE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Philippines', 'PH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Pitcairn', 'PN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Poland', 'PL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Portugal', 'PT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Puerto Rico', 'PR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Qatar', 'QA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Réunion', 'RE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Romania', 'RO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Russian Federation', 'RU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Rwanda', 'RW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Saint Barthélemy', 'BL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saint Kitts and Nevis', 'KN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Saint Lucia', 'LC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Saint Martin (French part)', 'MF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Saint Pierre and Miquelon', 'PM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Saint Vincent and the Grenadines', 'VC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Samoa', 'WS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'San Marino', 'SM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Sao Tome and Principe', 'ST', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Saudi Arabia', 'SA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Senegal', 'SN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Serbia', 'RS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Seychelles', 'SC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Sierra Leone', 'SL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Singapore', 'SG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Sint Maarten (Dutch part)', 'SX', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Slovakia', 'SK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Slovenia', 'SI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Solomon Islands', 'SB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Somalia', 'SO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'South Africa', 'ZA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'South Georgia and the South Sandwich Islands', 'GS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'South Sudan', 'SS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Spain', 'ES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Sri Lanka', 'LK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Sudan', 'SD', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Suriname', 'SR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Svalbard and Jan Mayen', 'SJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Swaziland', 'SZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Sweden', 'SE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Switzerland', 'CH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Syrian Arab Republic', 'SY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Taiwan, Province of China', 'TW', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Tajikistan', 'TJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Tanzania, United Republic of', 'TZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Thailand', 'TH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Timor-Leste', 'TL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Togo', 'TG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Tokelau', 'TK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Tonga', 'TO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Trinidad and Tobago', 'TT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Tunisia', 'TN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Turkey', 'TR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Turkmenistan', 'TM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Turks and Caicos Islands', 'TC', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Tuvalu', 'TV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Uganda', 'UG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Ukraine', 'UA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'United Arab Emirates', 'AE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'United Kingdom of Great Britain and Northern Ireland', 'GB', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'United States Minor Outlying Islands', 'UM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'United States of America', 'US', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Uruguay', 'UY', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Uzbekistan', 'UZ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Vanuatu', 'VU', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Venezuela (Bolivarian Republic of)', 'VE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'Viet Nam', 'VN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'Virgin Islands (British)', 'VG', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'Virgin Islands (U.S.)', 'VI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'Wallis and Futuna', 'WF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'Western Sahara', 'EH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'Yemen', 'YE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'Zambia', 'ZM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'Zimbabwe', 'ZW', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `custom_paginations`
--

CREATE TABLE `custom_paginations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_paginations`
--

INSERT INTO `custom_paginations` (`id`, `page_name`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Blog Page', 9, NULL, '2024-08-10 12:25:45'),
(4, 'Blog Comment', 4, NULL, '2022-09-15 03:06:58'),
(6, 'Product Page', 12, NULL, '2024-08-11 05:11:37'),
(8, 'Product Review', 10, '2023-06-12 09:44:44', '2023-08-05 05:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `email_configurations`
--

CREATE TABLE `email_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_type` tinyint(4) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_password` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_configurations`
--

INSERT INTO `email_configurations` (`id`, `mail_type`, `mail_host`, `mail_port`, `email`, `email_password`, `smtp_username`, `smtp_password`, `mail_encryption`, `created_at`, `updated_at`) VALUES
(1, 2, 'axtro.minionionbd.com', '465', 'abdur.rohman2003@gmail.com', 'mary+pass@', 'mail@axtro.minionionbd.com', 'dw^MOnFh7mpU', 'tls', NULL, '2024-08-11 05:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', NULL, '2021-12-09 10:06:57'),
(2, 'Contact Email', 'Contact Email', '<p>Name: <b>{{name}}</b></p><p>\r\n\r\nEmail: <b>{{email}}</b></p><p>\r\n\r\nPhone: <b>{{phone}}</b></p><p><span style=\"background-color: transparent;\">Subject: <b>{{subject}}</b></span></p><p>\r\n\r\nMessage: <b>{{message}}</b></p>', NULL, '2021-12-10 23:44:34'),
(3, 'Subscribe Notification', 'Subscribe Notification', '<h2><b>Hi there</b>,</h2><p>\r\nCongratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you won\'t approve this link, after 24hourse your subscription will be denay</p>', NULL, '2021-12-10 23:44:53'),
(4, 'User Verification', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\n</p><p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p>', NULL, '2021-12-10 23:45:25'),
(5, 'Seller Withdraw', 'Seller Withdraw Approval', '<p>Hi <strong>{{seller_name}}</strong>,</p>\r\n<p>Your withdraw Request Approval successfully. Please check your account.</p>\r\n<p>Withdraw method : <strong>{{withdraw_method}}</strong>,</p>\r\n<p>Total Amount :<strong> {{total_amount}}</strong>,</p>\r\n<p>Withdraw charge : <strong>{{withdraw_charge}}</strong>,</p>\r\n<p>Withdraw&nbsp; Amount : <strong>{{withdraw_amount}}</strong>,</p>\r\n<p>Approval Date :<strong> {{approval_date}}</strong></p>', NULL, '2023-06-11 03:54:26'),
(6, 'Order Successfully', 'Order Successfully', '<p>Hi {{user_name}},</p><p> \r\nThanks for your new order. Your order id has been submited .</p><p>Total Amount : {{total_amount}},</p><p>Payment Method : {{payment_method}},</p><p>Payment Status : {{payment_status}},</p><p>Order Status : {{order_status}},</p><p>Order Date: {{order_date}},</p><p>Order Detail: {{order_detail}}</p>', NULL, '2022-01-10 21:37:03'),
(8, 'New Order Mail to Client', 'New Order Mail to Client', '<p>Hi&nbsp;{{name}}, Thanks for your new order. Your order has been placed.</p>\r\n<p>Order Id : {{order_id}}</p>\r\n<p>Amount : {{amount}}</p>', NULL, '2023-06-05 11:49:52'),
(9, 'New Order Mail to Provider', 'New Order Mail to Provider', '<p>Hi&nbsp;{{name}}, A new order has been placed to you .</p>\r\n<p>Order Id : {{order_id}}</p>\r\n<p>Amount : {{amount}}</p>', NULL, '2023-06-05 11:51:00'),
(10, 'User Verification For OTP', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Copy the code and verify your account</p>', NULL, '2021-12-10 23:45:25'),
(11, 'Password Reset For OTP', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\n    <p>Do you want to reset your password? Please copy and past the code</p>', NULL, '2021-12-09 10:06:57'),
(12, 'Contact Author', 'Contact Author', '<h4>Dear Sir,</h4>\r\n<p>A new message for you from the user</p>\r\n<h4><strong>{{message}}</strong></h4>', '2023-06-06 04:48:36', '2023-06-06 05:46:45'),
(13, 'Seller Request Approved', 'Seller Request Approved', '<p>Hi <strong>{{name}}</strong>, Your seller request has been approved, you can add new product and sale to your platform.</p>\r\n<p>To visit your seller panel, click the link below</p>\r\n<p><strong>{{redirect_link}}</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Thank You</p>\r\n<p>QuomodoSoft</p>', NULL, '2024-05-18 12:10:35'),
(14, 'Seller Request Reject', 'Seller Request Reject', '<p>Hi <strong>{{name}}</strong>, Your seller request has been rejected, your provider information is invalid.</p>\r\n<p>&nbsp;</p>\r\n<p>Thank You</p>\r\n<p>QuomodoSoft</p>', NULL, '2024-05-19 05:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `error_pages`
--

CREATE TABLE `error_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_pages`
--

INSERT INTO `error_pages` (`id`, `title`, `button_text`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Sorry, Page Not Found', 'Back To Home', 'uploads/website-images/error-page--2023-09-19-10-39-02-7639.png', '2033-06-19 03:48:00', '2023-09-19 04:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `error_page_languages`
--

CREATE TABLE `error_page_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `error_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_page_languages`
--

INSERT INTO `error_page_languages` (`id`, `error_id`, `lang_code`, `title`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Sorry, Page Not Found', 'Back To Home', NULL, '2023-08-28 09:15:59'),
(13, 1, 'bn', 'দুঃখিত, পৃষ্ঠা পাওয়া যায়নি', 'হোমে ফিরে যাও', '2023-09-09 07:23:05', '2023-09-18 11:56:20'),
(14, 1, 'ar', 'عذرا، لم يتم العثور على الصفحة', 'العودة إلى المنزل', '2023-09-09 07:23:20', '2023-09-18 11:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_pixels`
--

CREATE TABLE `facebook_pixels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `app_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_pixels`
--

INSERT INTO `facebook_pixels` (`id`, `status`, `app_id`, `created_at`, `updated_at`) VALUES
(1, 1, '972911606915059', NULL, '2021-12-13 22:38:44');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-09-23 06:17:14', '2023-09-23 06:17:14'),
(2, 1, '2023-09-23 06:18:08', '2023-09-23 06:18:08'),
(3, 1, '2023-09-23 06:23:03', '2023-09-23 06:23:03'),
(4, 1, '2023-09-23 06:23:30', '2023-09-23 06:23:30'),
(5, 1, '2023-09-23 06:24:04', '2023-09-23 06:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `faq_languages`
--

CREATE TABLE `faq_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_languages`
--

INSERT INTO `faq_languages` (`id`, `faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'How does information technology work?', '<p>There are many variations of passages of Lorem Ipsum available into but the majority have suffered alteration in some form, by injecte find to a humour, or randomised words</p>', '2023-09-23 06:17:14', '2023-09-23 06:17:14'),
(2, 2, 'en', 'How can I become IT manager?', '<p>There are many variations of passages of Lorem Ipsum available into but the majority have suffered alteration in some form, by injecte find to a humour, or randomised words</p>', '2023-09-23 06:18:08', '2023-09-25 05:10:28'),
(3, 3, 'en', 'What are the latest trends in IT?', '<p>There are many variations of passages of Lorem Ipsum available into but the majority have suffered alteration in some form, by injecte find to a humour, or randomised words</p>', '2023-09-23 06:23:03', '2023-09-23 06:23:03'),
(4, 4, 'en', 'How long should a business plan be?', '<p>There are many variations of passages of Lorem Ipsum available into but the majority have suffered alteration in some form, by injecte find to a humour, or randomised words</p>', '2023-09-23 06:23:30', '2023-09-23 06:23:30'),
(5, 5, 'en', 'How work the support policy?', '<p>There are many variations of passages of Lorem Ipsum available into but the majority have suffered alteration in some form, by injecte find to a humour, or randomised words</p>', '2023-09-23 06:24:04', '2023-09-23 06:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `flutterwaves`
--

CREATE TABLE `flutterwaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flutterwaves`
--

INSERT INTO `flutterwaves` (`id`, `public_key`, `secret_key`, `currency_rate`, `country_code`, `currency_code`, `title`, `logo`, `status`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 'FLWPUBK_TEST-5760e3ff9888aa1ab5e5cd1ec3f99cb1-X', 'FLWSECK_TEST-81cb5da016d0a51f7329d4a8057e766d-X', 417.35, 'NG', 'NGN', 'Axtro', 'uploads/website-images/flutterwave-2023-05-11-05-34-35-1898.png', 1, NULL, '2024-08-11 05:41:53', 4);

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `copyright` varchar(191) DEFAULT NULL,
  `payment_image` varchar(191) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `copyright`, `payment_image`, `description`, `created_at`, `updated_at`) VALUES
(1, '©2024 Quomodosoft All rights reserved', 'uploads/website-images/payment-card-2023-08-27-12-11-33-9355.png', 'Axtro is a powerful multivendor platform designed for buying and selling game subscriptions, gift cards, and license keys. Built with the robust Laravel framework and complemented by a MySQL database,', NULL, '2024-08-13 08:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `footer_languages`
--

CREATE TABLE `footer_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `footer_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_languages`
--

INSERT INTO `footer_languages` (`id`, `footer_id`, `lang_code`, `copyright`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '©2024 Quomodosoft All rights reserved', 'Axtro is a powerful multivendor platform designed for buying and selling game subscriptions, gift cards, and license keys. Built with the robust Laravel framework and complemented by a MySQL database,', NULL, '2024-08-13 08:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `footer_social_links`
--

CREATE TABLE `footer_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_social_links`
--

INSERT INTO `footer_social_links` (`id`, `link`, `text`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'https://www.facebook.com/', 'Facebook', 'fab fa-facebook-f', '2024-08-11 05:37:27', '2024-08-11 05:37:27'),
(3, 'https://www.twitter.com/', 'Twitter', 'fab fa-twitter', '2024-08-11 05:37:56', '2024-08-11 05:37:56'),
(4, 'https://www.linkedin.com/', 'LinkedIn', 'fab fa-linkedin', '2024-08-11 05:38:26', '2024-08-11 05:38:26'),
(5, 'https://www.instagram.com/', 'Instagram', 'fab fa-instagram', '2024-08-11 05:38:49', '2024-08-11 05:38:49'),
(6, 'https://www.binance.com/', 'Binance', 'fas fa-binoculars', '2024-08-11 05:40:32', '2024-08-11 05:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `google_analytics`
--

CREATE TABLE `google_analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analytic_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_analytics`
--

INSERT INTO `google_analytics` (`id`, `analytic_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UA-84213520-6', 1, NULL, '2021-12-10 22:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptchas`
--

CREATE TABLE `google_recaptchas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_recaptchas`
--

INSERT INTO `google_recaptchas` (`id`, `site_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, '6LcVO6cbAAAAAOzIEwPlU66nL1rxD4VAS38tjpBX', '6LcVO6cbAAAAALVNrpZfNRfd0Gy_9a_fJRLiMVUI', 0, NULL, '2024-02-20 11:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `homepages`
--

CREATE TABLE `homepages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_one` int(11) DEFAULT 0,
  `trending_categories` text DEFAULT NULL,
  `category_three` int(11) DEFAULT 0,
  `category_four` int(11) DEFAULT 0,
  `about_offer_background` varchar(255) DEFAULT NULL,
  `trending_offer_link` varchar(255) DEFAULT NULL,
  `trending_offer_image` varchar(255) DEFAULT NULL,
  `counter1_value` text DEFAULT NULL,
  `counter2_value` text DEFAULT NULL,
  `counter3_value` text DEFAULT NULL,
  `counter4_value` varchar(255) DEFAULT NULL,
  `counter1_description` text DEFAULT NULL,
  `counter2_description` text DEFAULT NULL,
  `counter3_description` text DEFAULT NULL,
  `counter_item1_title` text DEFAULT NULL,
  `counter_item1_description` text DEFAULT NULL,
  `counter_item1_link` text DEFAULT NULL,
  `counter_item1_icon` text DEFAULT NULL,
  `counter_item2_title` text DEFAULT NULL,
  `counter_item2_description` text DEFAULT NULL,
  `counter_item2_link` text DEFAULT NULL,
  `counter_item2_icon` text DEFAULT NULL,
  `counter_icon1` varchar(255) DEFAULT NULL,
  `counter_icon2` varchar(255) DEFAULT NULL,
  `counter_icon3` varchar(255) DEFAULT NULL,
  `counter_icon4` varchar(255) DEFAULT NULL,
  `counter_icon5` varchar(255) DEFAULT NULL,
  `counter_icon6` varchar(255) DEFAULT NULL,
  `counter_icon7` varchar(255) DEFAULT NULL,
  `counter_icon8` varchar(255) DEFAULT NULL,
  `counter_home1_background` text DEFAULT NULL,
  `counter_home2_background` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepages`
--

INSERT INTO `homepages` (`id`, `category_one`, `trending_categories`, `category_three`, `category_four`, `about_offer_background`, `trending_offer_link`, `trending_offer_image`, `counter1_value`, `counter2_value`, `counter3_value`, `counter4_value`, `counter1_description`, `counter2_description`, `counter3_description`, `counter_item1_title`, `counter_item1_description`, `counter_item1_link`, `counter_item1_icon`, `counter_item2_title`, `counter_item2_description`, `counter_item2_link`, `counter_item2_icon`, `counter_icon1`, `counter_icon2`, `counter_icon3`, `counter_icon4`, `counter_icon5`, `counter_icon6`, `counter_icon7`, `counter_icon8`, `counter_home1_background`, `counter_home2_background`, `created_at`, `updated_at`) VALUES
(1, 4, '[\"4\",\"3\"]', 4, 3, 'uploads/website-images/offer--2023-09-26-10-04-13-4188.jpg', 'https://codecanyon.net/user/quomodotheme/portfolio', 'uploads/website-images/offer--2023-07-20-05-38-11-9548.jpg', '1252', '9892', '1519', '854', 'It is a long established fact that reader late by the reada.', 'It is a long established fact that reader late by the reada.', 'It is a long established fact that reader late by the reada.', 'Speed up Business', 'Purchase one of our digital products from the biggest software directory and boot strap find to the into in a your business spending just bugs.', 'fdsds', 'uploads/website-images/counter--2023-01-22-12-20-12-8534.png', 'Sell Your Goods Here', 'Our long history of ownership has provided find to ahe best inleiment evert to make it best quliss financial reassure,It has also firm continuity.', 'Item_one_link', 'uploads/website-images/counter--2023-01-22-12-24-21-4272.png', 'uploads/website-images/counter--2023-10-09-06-35-26-9429.png', 'uploads/website-images/counter--2023-10-09-06-36-09-7125.png', 'uploads/website-images/counter--2023-10-09-06-35-51-3194.png', 'uploads/website-images/counter--2023-10-09-06-35-51-3044.png', 'uploads/website-images/counter--2023-07-24-12-48-23-4428.jpg', 'uploads/website-images/counter--2023-07-24-12-48-23-4711.jpg', 'uploads/website-images/counter--2023-07-24-12-48-23-5806.jpg', 'uploads/website-images/counter--2023-07-24-12-48-23-3718.jpg', 'uploads/website-images/counter--2023-07-26-01-52-08-8577.jpg', 'uploads/website-images/counter--2023-07-26-01-55-40-1059.jpg', NULL, '2024-07-10 15:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_languages`
--

CREATE TABLE `homepage_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `why_choose_title1` varchar(255) DEFAULT NULL,
  `why_choose_title2` varchar(255) DEFAULT NULL,
  `why_choose_item1_title` varchar(255) DEFAULT NULL,
  `why_choose_item2_title` varchar(255) DEFAULT NULL,
  `why_choose_item3_title` varchar(255) DEFAULT NULL,
  `why_choose_home3_item1_title` varchar(255) DEFAULT NULL,
  `why_choose_home3_item2_title` varchar(255) DEFAULT NULL,
  `why_choose_home3_item3_title` varchar(255) DEFAULT NULL,
  `why_choose_home3_item1_desc` varchar(255) DEFAULT NULL,
  `why_choose_home3_item2_desc` varchar(255) DEFAULT NULL,
  `why_choose_home3_item3_desc` varchar(255) DEFAULT NULL,
  `counter1_title` varchar(255) DEFAULT NULL,
  `counter2_title` varchar(255) DEFAULT NULL,
  `counter3_title` varchar(255) DEFAULT NULL,
  `counter4_title` varchar(255) DEFAULT NULL,
  `offer_title1` varchar(255) DEFAULT NULL,
  `offer_title2` varchar(255) DEFAULT NULL,
  `offer_home3_item1_title` varchar(255) DEFAULT NULL,
  `offer_home3_item2_title` varchar(255) DEFAULT NULL,
  `offer_home3_item1_description` varchar(255) DEFAULT NULL,
  `offer_home3_item2_description` varchar(255) DEFAULT NULL,
  `about_offer_title1` varchar(255) DEFAULT NULL,
  `about_offer_title2` varchar(255) DEFAULT NULL,
  `about_offer_title3` varchar(255) DEFAULT NULL,
  `trending_offer_title1` varchar(255) DEFAULT NULL,
  `trending_offer_title2` varchar(255) DEFAULT NULL,
  `app_title1` varchar(255) DEFAULT NULL,
  `app_title2` varchar(255) DEFAULT NULL,
  `app_title3` varchar(255) DEFAULT NULL,
  `app_description` varchar(255) DEFAULT NULL,
  `app_home2_title` varchar(255) DEFAULT NULL,
  `app_home2_desc` varchar(255) DEFAULT NULL,
  `app_home3_title` varchar(255) DEFAULT NULL,
  `app_home3_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_languages`
--

INSERT INTO `homepage_languages` (`id`, `home_id`, `lang_code`, `why_choose_title1`, `why_choose_title2`, `why_choose_item1_title`, `why_choose_item2_title`, `why_choose_item3_title`, `why_choose_home3_item1_title`, `why_choose_home3_item2_title`, `why_choose_home3_item3_title`, `why_choose_home3_item1_desc`, `why_choose_home3_item2_desc`, `why_choose_home3_item3_desc`, `counter1_title`, `counter2_title`, `counter3_title`, `counter4_title`, `offer_title1`, `offer_title2`, `offer_home3_item1_title`, `offer_home3_item2_title`, `offer_home3_item1_description`, `offer_home3_item2_description`, `about_offer_title1`, `about_offer_title2`, `about_offer_title3`, `trending_offer_title1`, `trending_offer_title2`, `app_title1`, `app_title2`, `app_title3`, `app_description`, `app_home2_title`, `app_home2_desc`, `app_home3_title`, `app_home3_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Save time with pre-installed software.', 'Why Choose Alasmart', '15 days Money Back guarantee', '24/7 live Support & Forum Share', 'Outstanding Simplicity', '15 days Money Back', 'Expert Team Member', 'Outstanding Simplicity', 'There are many variationts of passages Lorem Ipsum available, but the majorit have If you as going to use a passage of Lorem', 'There are many variationts of passages Lorem Ipsum available, but the majorit have If you as going to use a passage of Lorem', 'There are many variationts of passages Lorem Ipsum available, but the majorit have If you as going to use a passage of Lorem', 'Total Items', 'Total Sale', 'Total Clients', 'Ratings', 'Check our software <span>Megapack worth $565 for Only $39.</span>', 'Check our software <span>Megapack worth $565 for Only $39.</span>', 'Speed up Business', 'Sell Your Goods Here', 'Purchase one of our digital products from the biggest as software directory and boot strap find to the into in a your business our spending just bugs.', 'Purchase one of our digital products from the biggest as software directory and boot strap find to the into in a your business our spending just bugs.', 'Get all products for only <span>$59! </span>', '$59!', 'Lifetime update and 6 months support.', 'Lifetime update support.', 'Get All Element For Only $59!', 'Get Our <span> Mobile App</span> It’s Make easy for your life !', 'Mobile App', 'It’s Make easy for your life !', 'Save time with preconfigured environments that alreadyinto into theon the find to find all the prerequisites installed for the news and as you make removes.', 'Get Our Mobile App It’s Make easy for your life !', 'Save time with preconfigured environments that alreadyinto into theon the find to find all the prerequisites installed for the news and as you make removes.', 'Get Our Mobile App It’s Make easy for your life !', 'Save time with preconfigured environments that alreadyinto into theon the find to find all the prerequisites installed for the news and as you make removes.', NULL, '2023-10-02 09:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `instamojo_payments`
--

CREATE TABLE `instamojo_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` text NOT NULL,
  `auth_token` text NOT NULL,
  `currency_rate` varchar(255) NOT NULL DEFAULT '1',
  `account_mode` varchar(255) NOT NULL DEFAULT 'Sandbox',
  `status` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instamojo_payments`
--

INSERT INTO `instamojo_payments` (`id`, `api_key`, `auth_token`, `currency_rate`, `account_mode`, `status`, `image`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 'test_5f4a2c9a58ef216f8a1a688910f', 'test_994252ada69ce7b3d282b9941c2', '74.66', 'Sandbox', 1, 'uploads/website-images/instamojo-2023-05-11-05-36-17-4376.png', NULL, '2023-10-18 06:22:28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `lang_name` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL DEFAULT 'No',
  `status` int(11) NOT NULL DEFAULT 0,
  `lang_direction` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_code`, `lang_name`, `is_default`, `status`, `lang_direction`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'Yes', 1, 'left_to_right', '2023-08-12 10:15:38', '2023-09-30 06:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `maintainance_texts`
--

CREATE TABLE `maintainance_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintainance_texts`
--

INSERT INTO `maintainance_texts` (`id`, `status`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'uploads/website-images/maintainance-mode-2024-07-30-04-30-51-8620.png', 'We are upgrading our site. We will come back soon.', NULL, '2024-08-11 05:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `customer_read_msg` int(11) NOT NULL DEFAULT 0,
  `seller_read_msg` int(11) NOT NULL,
  `send_customer` int(11) NOT NULL DEFAULT 0,
  `send_seller` int(11) NOT NULL DEFAULT 0,
  `order_item_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `seller_id`, `message`, `customer_read_msg`, `seller_read_msg`, `send_customer`, `send_seller`, `order_item_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Account Id : 6523252', 1, 0, 1, 0, 6, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(2, 5, 1, 'this is my account info', 1, 0, 1, 0, 6, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(3, 5, 1, 'Account Id : 349834839434', 1, 0, 1, 0, 6, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(4, 5, 1, 'this is not message', 1, 0, 1, 0, 6, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(5, 5, 1, 'Account Id : 6523252', 1, 0, 1, 0, 7, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(6, 5, 1, 'this is my account info', 1, 0, 1, 0, 7, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(7, 5, 1, 'Account Id : 349834839434', 1, 0, 1, 0, 7, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(8, 5, 1, 'this is not message', 1, 0, 1, 0, 7, '2024-05-07 11:53:49', '2024-05-07 11:53:49'),
(9, 5, 1, 'Account Id : 6523252', 1, 0, 1, 0, 8, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(10, 5, 1, 'this is my account info', 1, 0, 1, 0, 8, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(11, 5, 1, 'Account Id : 349834839434', 1, 0, 1, 0, 8, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(12, 5, 1, 'this is not message', 1, 0, 1, 0, 8, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(13, 5, 1, 'Account Id : 6523252', 1, 0, 1, 0, 9, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(14, 5, 1, 'this is my account info', 1, 0, 1, 0, 9, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(15, 5, 1, 'Account Id : 349834839434', 1, 0, 1, 0, 9, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(16, 5, 1, 'this is not message', 1, 0, 1, 0, 9, '2024-05-07 11:57:41', '2024-05-07 11:57:41'),
(17, 5, 1, 'hello seller, I want to purchase amazon account please help me', 1, 0, 1, 0, 5, '2024-05-07 12:03:11', '2024-05-07 12:03:11'),
(18, 5, 1, 'hello seller, I want to purchase amazon account please help me', 1, 0, 1, 0, 5, '2024-05-07 12:03:17', '2024-05-07 12:03:17'),
(19, 5, 1, 'hello seller, I want to purchase amazon account please help me', 1, 0, 1, 0, 5, '2024-05-07 12:03:19', '2024-05-07 12:03:19'),
(20, 5, 1, 'This is my account id : 93943943943', 1, 0, 1, 0, 5, '2024-05-07 12:07:06', '2024-05-07 12:07:06'),
(21, 5, 1, 'hello seller, I want to purchase amazon account please help me', 0, 1, 0, 1, 5, '2024-05-07 12:03:19', '2024-05-07 12:03:19'),
(22, 5, 1, 'I\'m here,', 0, 1, 0, 1, 5, '2024-05-08 08:14:08', '2024-05-08 08:14:08'),
(23, 5, 1, 'seller, I want to purchase amaz', 0, 1, 0, 1, 5, '2024-05-08 08:14:37', '2024-05-08 08:14:37'),
(24, 5, 1, 'This is my account id : 93943943943', 1, 0, 1, 0, 5, '2024-05-07 12:07:06', '2024-05-07 12:07:06'),
(25, 5, 1, 'Hello how can I help you, please share your account id', 0, 1, 0, 1, 3, '2024-05-08 08:47:11', '2024-05-08 08:47:11'),
(26, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 19, '2024-07-11 19:10:20', '2024-07-11 19:10:20'),
(27, 8, 5, 'adasdas', 1, 0, 1, 0, 19, '2024-07-11 19:10:20', '2024-07-11 19:10:20'),
(28, 8, 5, 'Account Id : 349834839434', 1, 0, 1, 0, 19, '2024-07-11 19:10:21', '2024-07-11 19:10:21'),
(29, 8, 5, 'this is not message', 1, 0, 1, 0, 19, '2024-07-11 19:10:21', '2024-07-11 19:10:21'),
(30, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 20, '2024-07-11 19:10:27', '2024-07-11 19:10:27'),
(31, 8, 5, 'adasdas', 1, 0, 1, 0, 20, '2024-07-11 19:10:27', '2024-07-11 19:10:27'),
(32, 8, 5, 'Account Id : 349834839434', 1, 0, 1, 0, 20, '2024-07-11 19:10:27', '2024-07-11 19:10:27'),
(33, 8, 5, 'this is not message', 1, 0, 1, 0, 20, '2024-07-11 19:10:27', '2024-07-11 19:10:27'),
(34, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 21, '2024-07-11 19:10:55', '2024-07-11 19:10:55'),
(35, 8, 5, 'adasdas', 1, 0, 1, 0, 21, '2024-07-11 19:10:55', '2024-07-11 19:10:55'),
(36, 8, 5, 'Account Id : 349834839434', 1, 0, 1, 0, 21, '2024-07-11 19:10:55', '2024-07-11 19:10:55'),
(37, 8, 5, 'this is not message', 1, 0, 1, 0, 21, '2024-07-11 19:10:55', '2024-07-11 19:10:55'),
(38, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 23, '2024-07-11 19:46:55', '2024-07-11 19:46:55'),
(39, 8, 5, 'adasdas', 1, 0, 1, 0, 23, '2024-07-11 19:46:56', '2024-07-11 19:46:56'),
(40, 8, 5, 'Account Id : asdasd', 1, 0, 1, 0, 23, '2024-07-11 19:46:56', '2024-07-11 19:46:56'),
(41, 8, 5, 'sadasd', 1, 0, 1, 0, 23, '2024-07-11 19:46:56', '2024-07-11 19:46:56'),
(42, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 24, '2024-07-11 19:53:21', '2024-07-11 19:53:21'),
(43, 8, 5, 'adasdas', 1, 0, 1, 0, 24, '2024-07-11 19:53:21', '2024-07-11 19:53:21'),
(44, 8, 5, 'Account Id : 3434343', 1, 0, 1, 0, 24, '2024-07-11 19:53:21', '2024-07-11 19:53:21'),
(45, 8, 5, 'test message', 1, 0, 1, 0, 24, '2024-07-11 19:53:21', '2024-07-11 19:53:21'),
(46, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 25, '2024-07-11 19:56:22', '2024-07-11 19:56:22'),
(47, 8, 5, 'adasdas', 1, 0, 1, 0, 25, '2024-07-11 19:56:22', '2024-07-11 19:56:22'),
(48, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 26, '2024-07-11 19:57:15', '2024-07-11 19:57:15'),
(49, 8, 5, 'adasdas', 1, 0, 1, 0, 26, '2024-07-11 19:57:15', '2024-07-11 19:57:15'),
(50, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 27, '2024-07-11 19:57:49', '2024-07-11 19:57:49'),
(51, 8, 5, 'adasdas', 1, 0, 1, 0, 27, '2024-07-11 19:57:49', '2024-07-11 19:57:49'),
(52, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 28, '2024-07-11 19:59:11', '2024-07-11 19:59:11'),
(53, 8, 5, 'adasdas', 1, 0, 1, 0, 28, '2024-07-11 19:59:11', '2024-07-11 19:59:11'),
(54, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 29, '2024-07-11 20:07:57', '2024-07-11 20:07:57'),
(55, 8, 5, 'adasdas', 1, 0, 1, 0, 29, '2024-07-11 20:07:57', '2024-07-11 20:07:57'),
(56, 8, 5, 'hello doda', 1, 0, 1, 0, 29, '2024-07-11 20:08:10', '2024-07-11 20:08:10'),
(57, 8, 5, 'ki obostha', 1, 0, 1, 0, 29, '2024-07-11 20:08:17', '2024-07-11 20:08:17'),
(58, 8, 5, 'kahini ki ? ki kaj kam koren, khali error mare', 1, 0, 1, 0, 29, '2024-07-11 20:08:32', '2024-07-11 20:08:32'),
(59, 8, 5, 'Account Id : Al Marmu', 1, 0, 1, 0, 30, '2024-07-11 20:09:26', '2024-07-11 20:09:26'),
(60, 8, 5, 'adasdas', 1, 0, 1, 0, 30, '2024-07-11 20:09:26', '2024-07-11 20:09:26'),
(61, 5, 5, 'Account Id : 9856556', 1, 0, 1, 0, 33, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(62, 5, 5, 'Hello seller. I have added the game id above. Please load the balance and let me informed.\r\n\r\nstyle onload=&quot;alert(&#039;site hacked from style element&#039;)&quot;&gt;\r\n        h1 {\r\n            text-align: center;\r\n        }\r\n    &lt;/style&gt;\r\n\r\n        window.location=”https://google.com”\r\n    ', 1, 0, 1, 0, 33, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(63, 5, 5, 'Account Id : 43434', 1, 0, 1, 0, 33, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(64, 5, 5, 'Hello seller. I have added the game id above. Please load the balance and let me informed.\r\n\r\nstyle onload=&quot;alert(&#039;site hacked from style element&#039;)&quot;&gt;\r\n        h1 {\r\n            text-align: center;\r\n        }\r\n    &lt;/style&gt;\r\n\r\n        window.location=”https://google.com”\r\n    ', 1, 0, 1, 0, 33, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(65, 5, 5, 'Account Id : 43434', 1, 0, 1, 0, 34, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(66, 5, 5, 'Hello seller. I have added the game id above. Please load the balance and let me informed.\r\n\r\nstyle onload=&quot;alert(&#039;site hacked from style element&#039;)&quot;&gt;\r\n        h1 {\r\n            text-align: center;\r\n        }\r\n    &lt;/style&gt;\r\n\r\n        window.location=”https://google.com”\r\n    ', 1, 0, 1, 0, 34, '2024-08-11 05:47:10', '2024-08-11 05:47:10'),
(67, 5, 5, 'hello \r\n&lt;style onload=&quot;alert(&#039;site hacked from style element&#039;)&quot;&gt;\r\n        h1 {\r\n            text-align: center;\r\n        }\r\n    &lt;/style&gt;', 1, 0, 1, 0, 32, '2024-08-11 05:57:07', '2024-08-11 05:57:07'),
(68, 5, 5, 'hello', 1, 0, 1, 0, 31, '2024-08-12 05:57:59', '2024-08-12 05:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `message_documents`
--

CREATE TABLE `message_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_message_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_30_035230_create_admins_table', 2),
(6, '2021_11_30_065435_create_email_configurations_table', 3),
(7, '2021_11_30_065508_create_email_templates_table', 3),
(8, '2021_12_01_035206_create_categories_table', 4),
(19, '2021_12_06_054423_create_about_us_table', 10),
(20, '2021_12_06_055028_create_custom_pages_table', 10),
(21, '2021_12_07_030532_create_terms_and_conditions_table', 11),
(22, '2021_12_07_035810_create_blog_categories_table', 12),
(23, '2021_12_07_035822_create_blogs_table', 12),
(24, '2021_12_07_040749_create_popular_posts_table', 12),
(25, '2021_12_07_061613_create_blog_comments_table', 13),
(30, '2021_12_09_095158_create_contact_messages_table', 16),
(31, '2021_12_09_095220_create_subscribers_table', 16),
(32, '2021_12_09_124226_create_settings_table', 17),
(33, '2021_12_11_022207_create_cookie_consents_table', 18),
(34, '2021_12_11_025358_create_google_recaptchas_table', 19),
(37, '2021_12_11_025618_create_google_analytics_table', 19),
(38, '2021_12_11_025712_create_custom_paginations_table', 19),
(39, '2021_12_11_083503_create_faqs_table', 20),
(40, '2021_12_11_094707_create_currencies_table', 21),
(43, '2021_12_13_101056_create_error_pages_table', 23),
(44, '2021_12_13_102725_create_maintainance_texts_table', 24),
(45, '2021_12_13_110144_create_subscribe_modals_table', 25),
(50, '2021_12_14_032937_create_social_login_information_table', 28),
(51, '2021_12_14_042928_create_facebook_pixels_table', 29),
(52, '2021_12_14_054908_create_paypal_payments_table', 30),
(53, '2021_12_14_054922_create_stripe_payments_table', 30),
(54, '2021_12_14_054939_create_razorpay_payments_table', 30),
(55, '2021_12_14_055252_create_bank_payments_table', 30),
(62, '2021_12_22_034106_create_banner_images_table', 35),
(63, '2021_12_22_044839_create_sliders_table', 36),
(67, '2021_12_23_065722_create_paystack_and_mollies_table', 40),
(68, '2021_12_23_085225_create_withdraw_methods_table', 41),
(71, '2021_12_25_172918_create_seller_withdraws_table', 42),
(81, '2021_12_26_054841_create_orders_table', 45),
(88, '2021_12_28_192057_create_contact_pages_table', 47),
(89, '2021_12_28_200846_create_breadcrumb_images_table', 48),
(90, '2021_12_30_032959_create_flutterwaves_table', 49),
(91, '2021_12_30_034716_create_footers_table', 50),
(92, '2021_12_30_035201_create_footer_links_table', 50),
(93, '2021_12_30_035247_create_footer_social_links_table', 50),
(99, '2022_01_12_080218_create_seo_settings_table', 54),
(101, '2022_01_17_122016_create_instamojo_payments_table', 56),
(102, '2022_01_29_055523_create_messages_table', 57),
(103, '2022_01_29_122621_create_pusher_credentails_table', 58),
(104, '2022_08_28_070755_create_how_it_works_table', 59),
(105, '2022_08_29_072358_create_testimonials_table', 60),
(108, '2022_08_31_093322_create_additional_services_table', 62),
(113, '2022_09_05_111413_create_refund_requests_table', 64),
(114, '2022_09_06_054021_create_complete_requests_table', 65),
(115, '2022_09_06_064506_create_provider_client_reports_table', 66),
(118, '2022_09_06_101227_create_message_documents_table', 68),
(119, '2022_09_26_070233_create_section_contents_table', 69),
(120, '2022_09_26_083106_create_section_controls_table', 70),
(121, '2022_09_29_044208_create_provider_client_reports_table', 71),
(123, '2023_01_22_032814_create_homepages_table', 73),
(125, '2023_01_22_083735_create_our_teams_table', 74),
(126, '2023_01_22_090537_create_become_authors_table', 75),
(127, '2023_01_24_085621_create_products_table', 76),
(128, '2023_01_28_101709_create_product_variants_table', 77),
(129, '2023_04_06_041600_create_popular_tags_table', 78),
(130, '2023_04_13_101940_create_coupons_table', 79),
(131, '2023_04_16_050758_create_order_items_table', 80),
(134, '2023_04_26_092807_create_product_comments_table', 81),
(135, '2023_05_08_082722_create_wishlishes_table', 82),
(137, '2023_05_08_090834_create_wishlists_table', 83),
(138, '2023_05_11_100656_create_sslcommerz_payments_table', 84),
(139, '2023_05_24_065207_create_ads_table', 85),
(140, '2023_06_06_064500_create_script_contents_table', 86),
(141, '2023_06_11_053201_create_product_type_pages_table', 87),
(142, '2023_06_11_061315_create_product_items_table', 88),
(143, '2021_12_11_025556_create_tawk_chats_table', 89),
(146, '2023_07_05_101606_create_product_discounts_table', 90),
(147, '2023_07_20_070218_create_templates_table', 91),
(151, '2023_08_12_074310_create_languages_table', 92),
(152, '2023_08_12_121250_create_blog_category_languages_table', 93),
(153, '2023_08_13_060543_create_blog_languages_table', 94),
(155, '2023_08_14_043107_create_category_languages_table', 95),
(156, '2023_08_14_074138_create_product_languages_table', 96),
(157, '2023_08_20_085324_create_section_content_languages_table', 97),
(159, '2023_08_22_045345_create_slider_languages_table', 98),
(161, '2023_08_22_062137_create_homepage_languages_table', 99),
(162, '2023_08_23_041637_create_testimonial_languages_table', 100),
(163, '2023_08_23_063027_create_template_languages_table', 101),
(164, '2023_08_23_083808_create_our_team_languages_table', 102),
(165, '2023_08_23_102009_create_setting_languages_table', 103),
(166, '2023_08_23_113925_create_about_us_languages_table', 104),
(167, '2023_08_24_040039_create_become_author_languages_table', 105),
(168, '2023_08_24_064458_create_contact_page_languages_table', 106),
(169, '2023_08_24_074131_create_terms_and_condition_languages_table', 107),
(170, '2023_08_24_085849_create_privacy_policies_table', 107),
(171, '2023_08_24_090521_create_privacy_policy_languages_table', 107),
(172, '2023_08_24_104123_create_error_page_languages_table', 108),
(173, '2023_08_26_031916_create_faq_languages_table', 109),
(174, '2023_08_26_051231_create_custom_page_languages_table', 110),
(175, '2023_08_26_072702_create_product_discount_languages_table', 111),
(177, '2023_08_26_081730_create_script_content_languages_table', 112),
(178, '2023_08_26_101941_create_product_item_languages_table', 113),
(179, '2023_08_26_113850_create_product_type_page_languages_table', 114),
(180, '2023_08_27_053238_create_footer_languages_table', 115),
(181, '2023_10_12_110032_create_multi_currencies_table', 116),
(182, '2023_10_17_111424_add_currency_id_to_paypal_payments', 116),
(183, '2023_10_17_112628_add_currency_id_to_stripe_payments', 116),
(184, '2023_10_17_113812_add_currency_id_to_razorpay_payments', 116),
(185, '2023_10_17_114304_add_currency_id_to_paystack_and_mollies', 116),
(186, '2023_10_17_114839_add_currency_id_to_flutterwaves', 116),
(187, '2023_10_17_115359_add_currency_id_to_instamojo_payments', 116),
(188, '2023_10_17_115802_add_currency_id_to_sslcommerz_payments', 116),
(189, '2023_10_18_051816_add_app_version_to_settings', 116),
(190, '2023_11_05_154747_create_paymongo_payments_table', 117),
(191, '2023_11_09_154516_create_iyzico_payments_table', 117),
(192, '2023_11_11_085653_create_mercado_pago_payments_table', 117),
(193, '2023_07_31_060838_create_shopping_carts_table', 118),
(194, '2023_11_06_114954_add_two_new_col_to_orders', 118),
(195, '2024_02_20_083058_create_subscription_plans_table', 119),
(196, '2024_02_20_083331_create_purchase_histories_table', 119),
(197, '2024_02_20_084219_create_provider_bank_handcashes_table', 119),
(198, '2024_02_20_084241_create_provider_flutterwaves_table', 119),
(199, '2024_02_20_084310_create_provider_instamojos_table', 119),
(200, '2024_02_20_084340_create_provider_mollies_table', 119),
(201, '2024_02_20_084359_create_provider_paypals_table', 119),
(202, '2024_02_20_084423_create_provider_paystacks_table', 119),
(203, '2024_02_20_084459_create_provider_razorpays_table', 119),
(204, '2024_02_20_084630_create_provider_stripes_table', 119),
(205, '2023_06_19_054429_add_commission_type_to_settings', 120),
(206, '2024_02_24_065805_add_fields_to_subscription_plans_table', 121),
(207, '2024_02_27_114916_add_author_id_to_orders_table', 122),
(209, '2024_05_18_102022_create_seller_requests_table', 123),
(210, '2024_07_07_094606_add_app_url_to_settings', 124);

-- --------------------------------------------------------

--
-- Table structure for table `multi_currencies`
--

CREATE TABLE `multi_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_icon` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL,
  `currency_rate` double NOT NULL,
  `currency_position` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_currencies`
--

INSERT INTO `multi_currencies` (`id`, `currency_name`, `country_code`, `currency_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
(1, '$-USD', 'USD', 'USD', '$', 'Yes', 1, 'left', 1, '2023-10-18 05:27:46', '2023-10-18 05:27:46'),
(2, '৳-BDT', 'BD', 'BDT', '৳', 'No', 110, 'left', 1, '2023-10-18 05:44:31', '2023-10-18 05:44:31'),
(3, '₹-INR', 'IN', 'INR', '₹', 'No', 100, 'left', 1, '2023-10-18 06:06:41', '2023-10-18 06:10:51'),
(4, '₦-NGN', 'NG', 'NGN', '₦', 'No', 10, 'left', 1, '2023-10-18 06:13:25', '2024-07-04 09:55:47'),
(5, '$-CAD', 'CAD', 'CAD', 'C$', 'No', 1.5, 'left', 1, '2023-10-18 06:20:00', '2023-10-18 06:20:00'),
(6, '₱ - PHP', 'PHP', 'PHP', '₱', 'No', 55.75, 'left', 1, '2023-11-15 16:07:14', '2023-11-15 16:07:14'),
(7, '₺-Turkish lira', 'TL', 'TRY', '.₺', 'No', 0.035, 'left', 1, '2023-11-15 16:08:33', '2023-11-15 16:08:33'),
(8, '$-ARS', 'ARS', 'ARS', '$', 'No', 2, 'left', 1, '2023-11-15 16:10:20', '2023-11-15 16:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` double NOT NULL DEFAULT 0,
  `discount_amount` double NOT NULL DEFAULT 0,
  `payable_amount` double NOT NULL DEFAULT 0,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `transection_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `cart_qty` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `total_amount`, `discount_amount`, `payable_amount`, `payment_method`, `payment_status`, `transection_id`, `order_status`, `cart_qty`, `message`, `account_id`, `created_at`, `updated_at`) VALUES
(5, '40777720240711024502', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'undefined', 'undefined', '2024-07-11 18:45:02', '2024-07-11 18:45:02'),
(6, '90793320240711024635', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'undefined', 'undefined', '2024-07-11 18:46:35', '2024-07-11 18:46:35'),
(7, '31685320240711024652', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'undefined', 'undefined', '2024-07-11 18:46:52', '2024-07-11 18:46:52'),
(8, '96925620240711024742', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'undefined', 'undefined', '2024-07-11 18:47:42', '2024-07-11 18:47:42'),
(9, '26045420240711024935', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'asdsad', 'asdasjdlk', '2024-07-11 18:49:35', '2024-07-11 18:49:35'),
(10, '57620620240711025046', 8, 10, 0, 10, 'bank_payment', 'pending', 'undefined', '0', 1, 'asdasd', 'sadasd', '2024-07-11 18:50:46', '2024-07-11 18:50:46'),
(11, '31577620240711025248', 8, 10, 0, 10, 'bank_payment', 'pending', 'dsfsdfsdf', '0', 1, 'sdfsdf sdfsdfsd sdfsdfsdf sdfsdfsdf', 'erwec sdfsdf', '2024-07-11 18:52:48', '2024-07-11 18:52:48'),
(12, '47194720240711025357', 8, 10, 0, 10, 'bank_payment', 'pending', 'xzczxczx', '0', 1, 'sdfsdf sdfsdfsd sdfsdfsdf sdfsdfsdf', 'erwec sdfsdf', '2024-07-11 18:53:57', '2024-07-11 18:53:57'),
(13, '33394920240711025426', 8, 10, 0, 10, 'bank_payment', 'pending', 'saadas', '0', 1, 'sdfsdf sdfsdfsd sdfsdfsdf sdfsdfsdf', 'erwec sdfsdf', '2024-07-11 18:54:26', '2024-07-11 18:54:26'),
(14, '31683520240711025454', 8, 10, 0, 10, 'bank_payment', 'pending', 'dfterwf erfer aqwwqw', '0', 1, 'sddsdfer dfdvre ffgdfrt rewssd trerb', 'adasd asdasd asdas', '2024-07-11 18:54:54', '2024-07-11 18:54:54'),
(15, '56768320240711025609', 8, 10, 0, 10, 'bank_payment', 'pending', 'XXX-XCD-EGHF', '0', 1, 'this is not message', '349834839434', '2024-07-11 18:56:09', '2024-07-11 18:56:09'),
(16, '48588120240711025836', 8, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, 'sddsdfer dfdvre ffgdfrt rewssd trerb', 'adasd asdasd asdas', '2024-07-11 18:58:36', '2024-07-11 18:58:36'),
(17, '16968220240711030402', 8, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, 'this is not message', '349834839434', '2024-07-11 19:04:02', '2024-07-11 19:04:02'),
(18, '91437020240711030658', 8, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, 'this is not message', '349834839434', '2024-07-11 19:06:58', '2024-07-11 19:06:58'),
(19, '14813520240711031020', 8, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, 'this is not message', '349834839434', '2024-07-11 19:10:20', '2024-07-11 19:10:20'),
(20, '63058820240711031027', 8, 10, 0, 10, 'bank_payment', 'pending', 'XXX-XCD-EGHF', '0', 1, 'this is not message', '349834839434', '2024-07-11 19:10:27', '2024-07-11 19:10:27'),
(21, '58344020240711031055', 8, 10, 0, 10, 'bank_payment', 'pending', 'XXX-XCD-EGHF', '0', 1, 'this is not message', '349834839434', '2024-07-11 19:10:55', '2024-07-11 19:10:55'),
(22, '86710820240711031318', 8, 20, 0, 20, 'hand_cash', 'success', 'transection_id', '0', 1, NULL, NULL, '2024-07-11 19:13:18', '2024-07-11 19:13:18'),
(23, '37480520240711034655', 8, 10, 0, 10, 'bank_payment', 'pending', 'sdasdasd', '0', 1, 'sadasd', 'asdasd', '2024-08-04 19:46:55', '2024-07-11 19:46:55'),
(24, '86630620240711035321', 8, 10, 0, 10, 'Razorpay', 'success', 'pay_OXHZYUsyKh8l7V', '0', 1, 'test message', '3434343', '2024-07-11 19:53:21', '2024-07-11 19:53:21'),
(25, '93233020240711035514', 5, 20, 0, 20, 'bank_payment', 'pending', 'fefasdf', '0', 2, NULL, NULL, '2024-08-02 19:55:14', '2024-08-01 19:55:14'),
(26, '85373420240711035622', 8, 10, 0, 10, 'Paypal', 'success', 'PAYID-M2H2YOQ1UY43472TJ575414B', '0', 1, NULL, NULL, '2024-07-11 19:56:22', '2024-07-11 19:56:22'),
(27, '79023020240711035715', 8, 10, 0, 10, 'bank_payment', 'pending', '87787878', '0', 1, NULL, NULL, '2024-07-11 19:57:15', '2024-07-11 19:57:15'),
(28, '47091420240711035749', 8, 10, 0, 10, 'stripe', 'success', 'pi_3PbJkkF56Pb8BOOX0RN7TlLU', '0', 1, NULL, NULL, '2024-08-12 19:57:49', '2024-07-11 19:57:49'),
(29, '52855420240711035911', 8, 10, 0, 10, 'Mollie', 'success', 'tr_dv8nDJiErn', '0', 1, NULL, NULL, '2024-07-11 19:59:11', '2024-07-11 19:59:11'),
(30, '53092320240711040757', 8, 10, 0, 10, 'Paystack', 'success', '3969382648', '0', 1, NULL, NULL, '2024-07-11 20:07:57', '2024-07-11 20:07:57'),
(31, '82286320240711040926', 8, 10, 0, 10, 'Paystack', 'success', '3969385771', '0', 1, NULL, NULL, '2024-07-11 20:09:26', '2024-07-11 20:09:26'),
(32, '10461020240714125534', 5, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, NULL, NULL, '2024-08-13 16:55:34', '2024-07-14 16:55:34'),
(33, '46923420240729092703', 5, 10, 0, 10, 'bank_payment', 'pending', '8775', '0', 1, NULL, NULL, '2024-08-12 13:27:03', '2024-07-29 13:27:03'),
(35, '66456920240811010417', 5, 15, 0, 15, 'Paypal', 'success', 'PAYID-M24GEYA4807505390043305X', '0', 3, NULL, NULL, '2024-08-12 07:04:17', '2024-08-11 07:04:17'),
(36, '21794820240812123420', 5, 10, 0, 10, 'hand_cash', 'success', 'transection_id', '0', 1, NULL, NULL, '2024-08-12 06:34:20', '2024-08-12 06:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_price` double NOT NULL DEFAULT 0,
  `variant_id` int(11) DEFAULT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `approve_by_user` varchar(255) NOT NULL DEFAULT 'pending',
  `has_review` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `author_id`, `user_id`, `option_name`, `option_price`, `variant_id`, `variant_name`, `qty`, `message`, `account_id`, `approve_by_user`, `has_review`, `created_at`, `updated_at`) VALUES
(5, 5, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 18:45:02', '2024-07-13 15:33:20'),
(6, 6, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:46:35', '2024-07-11 18:46:35'),
(7, 7, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:46:52', '2024-07-11 18:46:52'),
(8, 8, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:47:42', '2024-07-11 18:47:42'),
(9, 9, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:49:35', '2024-07-11 18:49:35'),
(10, 10, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:50:46', '2024-07-11 18:50:46'),
(11, 11, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 18:52:48', '2024-07-13 15:35:59'),
(12, 12, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:53:57', '2024-07-11 18:53:57'),
(13, 13, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:54:26', '2024-07-11 18:54:26'),
(14, 14, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 18:54:54', '2024-07-13 15:38:34'),
(15, 15, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:56:09', '2024-07-11 18:56:09'),
(16, 16, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 18:58:37', '2024-07-11 18:58:37'),
(17, 17, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 19:04:02', '2024-07-11 19:04:02'),
(18, 18, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 19:06:58', '2024-07-11 19:06:58'),
(19, 19, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'pending', 'no', '2024-07-11 19:10:20', '2024-07-11 19:10:20'),
(20, 20, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 19:10:27', '2024-08-13 08:32:55'),
(21, 21, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 19:10:55', '2024-07-13 15:32:12'),
(22, 22, 3, 5, 8, 'Yearly', 20, 3, 'GTA vice city', 1, NULL, NULL, 'pending', 'no', '2024-07-11 19:13:18', '2024-07-11 19:13:18'),
(23, 23, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 19:46:55', '2024-07-13 15:30:37'),
(24, 24, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 19:53:21', '2024-07-13 15:29:55'),
(25, 26, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-07-11 19:56:22', '2024-07-13 15:28:11'),
(26, 27, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-08-03 19:57:15', '2024-07-13 15:10:33'),
(27, 28, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'yes', '2024-08-02 19:57:49', '2024-08-13 08:32:24'),
(28, 29, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-08-12 19:59:11', '2024-07-13 15:08:51'),
(29, 30, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-08-12 20:07:57', '2024-07-13 15:05:56'),
(30, 31, 1, 5, 8, 'Regular', 10, 1, 'Subcription', 1, 'adasdas', 'Al Marmu', 'approved', 'no', '2024-08-11 20:09:26', '2024-07-13 14:33:11'),
(31, 32, 3, 5, 5, 'Monthly', 10, 3, 'GTA vice city', 1, NULL, NULL, 'pending', 'no', '2024-08-13 16:55:34', '2024-07-14 16:55:34'),
(32, 33, 3, 5, 5, 'Monthly', 10, 3, 'GTA vice city', 1, NULL, NULL, 'pending', 'no', '2024-08-07 13:27:03', '2024-07-29 13:27:03'),
(35, 35, 2, 5, 5, 'Subscription Monthly', 5, 2, 'Netflix', 3, NULL, NULL, 'pending', 'no', '2024-08-12 07:04:17', '2024-08-11 07:04:17'),
(36, 36, 3, 5, 5, 'Monthly', 10, 4, 'GTA San andreas', 1, NULL, NULL, 'pending', 'no', '2024-08-12 06:34:20', '2024-08-12 06:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `link`, `logo`, `status`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(2, 'https://axtro.vercel.app/products/apple-gift', 'uploads/custom-images/our-partner-2024-07-09-12-14-00-6573.png', 1, '20% Off Get Unlimited Offer', 'unlock surprise game keys at great prices', '2024-07-09 16:14:00', '2024-08-12 09:32:10'),
(3, 'https://axtro.vercel.app/products/udemy-premium', 'uploads/custom-images/our-partner-2024-07-09-12-20-32-4122.png', 1, 'GTA+ Membership', 'Claim the New Överflöd Pipistrello Super Car For Free and a Week Early', '2024-07-09 16:20:33', '2024-08-12 09:31:57'),
(4, 'https://axtro.vercel.app/products/chatgpt-40', 'uploads/custom-images/our-partner-2024-07-09-01-17-24-2124.png', 1, 'GTA+ Members can now easily', 'New Vinewood Club Amenities: Garage Vehicle', '2024-07-09 17:17:24', '2024-08-12 09:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payments`
--

CREATE TABLE `paypal_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `account_mode` varchar(255) DEFAULT NULL,
  `client_id` text DEFAULT NULL,
  `secret_id` text DEFAULT NULL,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_payments`
--

INSERT INTO `paypal_payments` (`id`, `status`, `account_mode`, `client_id`, `secret_id`, `country_code`, `currency_code`, `currency_rate`, `image`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 1, 'sandbox', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', 'US', 'USD', 1, 'uploads/website-images/paypal-2023-05-11-05-35-31-8176.png', NULL, '2023-10-18 06:03:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paystack_and_mollies`
--

CREATE TABLE `paystack_and_mollies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mollie_key` varchar(255) DEFAULT NULL,
  `mollie_status` int(11) NOT NULL DEFAULT 0,
  `mollie_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_public_key` varchar(255) DEFAULT NULL,
  `paystack_secret_key` varchar(255) DEFAULT NULL,
  `paystack_currency_rate` double NOT NULL DEFAULT 1,
  `paystack_status` int(11) NOT NULL DEFAULT 0,
  `mollie_country_code` varchar(191) NOT NULL,
  `mollie_currency_code` varchar(191) NOT NULL,
  `paystack_country_code` varchar(191) NOT NULL,
  `paystack_currency_code` varchar(191) NOT NULL,
  `mollie_image` varchar(255) DEFAULT NULL,
  `paystack_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paystack_currency_id` int(11) DEFAULT NULL,
  `mollie_currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paystack_and_mollies`
--

INSERT INTO `paystack_and_mollies` (`id`, `mollie_key`, `mollie_status`, `mollie_currency_rate`, `paystack_public_key`, `paystack_secret_key`, `paystack_currency_rate`, `paystack_status`, `mollie_country_code`, `mollie_currency_code`, `paystack_country_code`, `paystack_currency_code`, `mollie_image`, `paystack_image`, `created_at`, `updated_at`, `paystack_currency_id`, `mollie_currency_id`) VALUES
(1, 'test_4VDJypzqbsjjHpCJyx3vwjVuurqj3R', 1, 1.27, 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38', 'sk_test_77cb93329abbdc18104466e694c9f720a7d69c97', 417.35, 1, 'AS', 'CAD', 'NG', 'NGN', 'uploads/website-images/mollie-2023-05-11-05-36-00-2447.png', 'uploads/website-images/paystact-2023-05-11-05-36-37-1884.png', NULL, '2023-10-18 06:22:17', 4, 5);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'API TOKEN', '50f3824058a9d0b8a06c2648e89a0d21590fd0f5e33a8c50f585f95e96ee9449', '[\"*\"]', NULL, NULL, '2024-05-14 05:53:35', '2024-05-14 05:53:35'),
(2, 'App\\Models\\User', 5, 'API TOKEN', '02ecd2e05b77cac9879c0b43724b5b02795a51c3f1eca1762566b2ff6f8816cd', '[\"*\"]', NULL, NULL, '2024-05-14 05:57:52', '2024-05-14 05:57:52'),
(3, 'App\\Models\\User', 5, 'API TOKEN', '9c6869f36d18ba26874c51ef5b7be79acbcd9533243805506099ef5da3fd7db8', '[\"*\"]', NULL, NULL, '2024-05-14 06:06:10', '2024-05-14 06:06:10'),
(4, 'App\\Models\\User', 5, 'API TOKEN', 'b4633d2c82f852130596c323dbb8517b3063728831bf1704a38baa39ecb6f55f', '[\"*\"]', NULL, NULL, '2024-05-14 06:14:56', '2024-05-14 06:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy_languages`
--

CREATE TABLE `privacy_policy_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `privacy_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policy_languages`
--

INSERT INTO `privacy_policy_languages` (`id`, `privacy_id`, `lang_code`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '<h4><strong>1. What Are Privacy Policy?</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4><strong>2. Ecommerce Terms and Conditions Examples</strong></h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h4><strong>Features :</strong></h4>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h4><strong>3. Protect Your Property</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h4><strong>05.Pricing and Payment Terms</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', NULL, '2024-08-12 10:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `regular_price` decimal(10,0) DEFAULT NULL,
  `offer_price` decimal(10,0) DEFAULT NULL,
  `thumbnail_image` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approve_by_admin` int(11) NOT NULL DEFAULT 0,
  `popular_item` int(11) NOT NULL DEFAULT 0,
  `trending_item` int(11) NOT NULL DEFAULT 0,
  `featured_item` int(11) NOT NULL DEFAULT 0,
  `average_rating` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `author_id`, `category_id`, `slug`, `regular_price`, `offer_price`, `thumbnail_image`, `tags`, `seo_title`, `seo_description`, `status`, `approve_by_admin`, `popular_item`, `trending_item`, `featured_item`, `average_rating`, `created_at`, `updated_at`) VALUES
(1, 5, 4, 'netflix-subscription', 10, NULL, 'uploads/custom-images/thumb_image-2024-08-12-03-51-34-2313.jpg', '[{\"value\":\"netflix\"},{\"value\":\"zone\"},{\"value\":\"video\"}]', 'Netflix subscription', 'Netflix offers a variety of plans to meet your entertainment needs.', 1, 0, 1, 1, 1, 0, '2024-07-09 18:16:14', '2024-08-12 09:51:34'),
(2, 5, 4, 'netflix-subscription2', 10, 6, 'uploads/custom-images/thumb_image-2024-08-12-03-53-00-1065.jpg', '[{\"value\":\"zone\"},{\"value\":\"netflix\"},{\"value\":\"video\"}]', 'Netflix subscription', 'Netflix offers a variety of plans to meet your entertainment needs.', 1, 0, 1, 1, 1, 0, '2024-07-09 18:28:47', '2024-08-12 09:53:00'),
(3, 5, 3, 'rockstar-games', 10, 7, 'uploads/custom-images/thumb_image-2024-07-10-11-39-52-8155.png', '[{\"value\":\"game\"},{\"value\":\"gta\"}]', 'Rockstar Games', 'Rockstar Games', 1, 0, 1, 1, 1, 0, '2024-07-09 18:36:43', '2024-07-10 15:39:52'),
(4, 5, 5, 'quill-bot', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-20-39-9825.jpg', '[{\"value\":\"quill\"},{\"value\":\"new\"},{\"value\":\"add\"},{\"value\":\"transfer\"}]', 'quill bot subscription', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 04:25:00', '2024-08-11 08:20:39'),
(5, 5, 6, 'linkdin-pro', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-21-15-8550.jpg', '[{\"value\":\"Linkdin\"},{\"value\":\"Pro\"},{\"value\":\"free\"},{\"value\":\"connect\"},{\"value\":\"followers\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 04:29:43', '2024-08-11 08:21:15'),
(6, 5, 7, 'windows-11', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-22-27-7662.jpg', '[{\"value\":\"win\"},{\"value\":\"seven\"},{\"value\":\"eight\"},{\"value\":\"ten\"},{\"value\":\"Operating\"},{\"value\":\"system\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 04:34:28', '2024-08-11 08:22:27'),
(7, 5, 8, 'microsoft-office', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-23-10-1696.jpg', '[{\"value\":\"Microsoft\"},{\"value\":\"Office\"},{\"value\":\"versions\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis', 1, 0, 1, 1, 1, 0, '2024-08-11 04:37:16', '2024-08-11 08:23:10'),
(8, 5, 8, 'true-caller', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-24-22-8570.jpg', '[{\"value\":\"true\"},{\"value\":\"caller\"},{\"value\":\"add\"},{\"value\":\"remove\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit f', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit f', 1, 0, 1, 1, 1, 0, '2024-08-11 04:41:05', '2024-08-11 08:24:22'),
(9, 5, 10, 'spotify-pro', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-25-06-5689.jpg', '[{\"value\":\"subscription\"},{\"value\":\"new\"},{\"value\":\"save\"},{\"value\":\"monthly\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut m', 1, 0, 1, 1, 1, 0, '2024-08-11 04:43:10', '2024-08-11 08:25:06'),
(10, 5, 4, 'gift-box', 12, 7, 'uploads/custom-images/thumb_image-2024-08-12-03-53-53-7732.jpg', '[{\"value\":\"gift\"},{\"value\":\"New\"},{\"value\":\"best\"},{\"value\":\"item\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas v', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis', 1, 0, 1, 1, 1, 0, '2024-08-11 04:57:54', '2024-08-12 09:53:53'),
(11, 5, 4, 'game-gift', 88, 80, 'uploads/custom-images/thumb_image-2024-08-12-03-55-01-3575.jpg', '[{\"value\":\"game\"},{\"value\":\"gift\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiisLorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:00:25', '2024-08-12 09:55:01'),
(12, 5, 4, 'gift-card', 10, 5, 'uploads/custom-images/thumb_image-2024-08-12-03-56-12-1494.jpg', '[{\"value\":\"gift\"},{\"value\":\"card\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:05:35', '2024-08-12 09:56:12'),
(13, 5, 4, 'offer-gift', 10, 5, 'uploads/custom-images/thumb_image-2024-08-12-03-57-07-9726.jpg', '[{\"value\":\"gift\"},{\"value\":\"new\"},{\"value\":\"old\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure\r\n\r\n eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia.\r\n\r\nQuo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:09:55', '2024-08-12 09:57:08'),
(14, 5, 3, 'apple-gift', 11, 6, 'uploads/custom-images/thumb_image-2024-08-11-02-31-56-4677.jpg', '[{\"value\":\"gift\"},{\"value\":\"video\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:14:00', '2024-08-11 08:31:56'),
(15, 5, 3, 'chatgpt-40', 12, 8, 'uploads/custom-images/thumb_image-2024-08-11-02-30-31-6420.jpg', '[{\"value\":\"chat\"},{\"value\":\"gpt\"},{\"value\":\"4.0\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:17:28', '2024-08-11 08:30:31'),
(16, 5, 3, 'udemy-premium', 11, 6, 'uploads/custom-images/thumb_image-2024-08-11-02-29-47-4637.jpg', '[{\"value\":\"udemy\"},{\"value\":\"offer\"},{\"value\":\"gift\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:19:37', '2024-08-11 08:29:47'),
(17, 5, 3, 'netflix-video-game', 10, 5, 'uploads/custom-images/thumb_image-2024-08-11-02-28-52-1807.jpg', '[{\"value\":\"video\"},{\"value\":\"game\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:41:00', '2024-08-11 08:28:52'),
(18, 5, 3, 'play-station-4', 10, 6, 'uploads/custom-images/thumb_image-2024-08-11-02-28-16-8724.jpg', '[{\"value\":\"game\"},{\"value\":\"play\"},{\"value\":\"station\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:44:24', '2024-08-11 08:28:16'),
(19, 5, 3, 'playstore-offer', 13, 9, 'uploads/custom-images/thumb_image-2024-08-11-02-27-15-3167.jpg', '[{\"value\":\"playstore\"},{\"value\":\"store\"},{\"value\":\"game\"}]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', 1, 0, 1, 1, 1, 0, '2024-08-11 05:46:35', '2024-08-11 08:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_languages`
--

CREATE TABLE `product_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `short_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_languages`
--

INSERT INTO `product_languages` (`id`, `product_id`, `lang_code`, `name`, `description`, `short_description`, `created_at`, `updated_at`) VALUES
(1, '1', 'en', 'Storm Reaver', '<p>Netflix offers a variety of plans to meet your entertainment needs.</p>\r\n<p>As a Netflix member, you are charged monthly on the date you signed up.&nbsp;A Netflix account is for people who live together in a single household. Learn more about&nbsp;<a href=\"https://help.netflix.com/en/node/123277\">sharing Netflix</a>.</p>\r\n<p><a href=\"https://www.netflix.com/signup/\">Sign up for Netflix</a>&nbsp;today and choose from several&nbsp;<a href=\"https://help.netflix.com/en/node/116380\">payment options</a>. You can easily change your plan or cancel at any time.</p>', 'Netflix offers a variety of plans to meet your entertainment needs.', '2024-07-09 18:16:14', '2024-08-11 08:41:14'),
(2, '2', 'en', 'Netflix subscription', '<p>Netflix offers a variety of plans to meet your entertainment needs.</p>\r\n<p>As a Netflix member, you are charged monthly on the date you signed up.&nbsp;A Netflix account is for people who live together in a single household. Learn more about&nbsp;<a href=\"https://help.netflix.com/en/node/123277\">sharing Netflix</a>.</p>\r\n<p><a href=\"https://www.netflix.com/signup/\">Sign up for Netflix</a>&nbsp;today and choose from several&nbsp;<a href=\"https://help.netflix.com/en/node/116380\">payment options</a>. You can easily change your plan or cancel at any time.</p>', 'Netflix offers a variety of plans to meet your entertainment needs.', '2024-07-09 18:28:47', '2024-07-09 18:28:47'),
(3, '3', 'en', 'Rockstar Games', '<p>Netflix offers a variety of plans to meet your entertainment needs.</p>\r\n<p>As a Netflix member, you are charged monthly on the date you signed up.&nbsp;A Netflix account is for people who live together in a single household. Learn more about&nbsp;<a href=\"https://help.netflix.com/en/node/123277\">sharing Netflix</a>.</p>\r\n<p><a href=\"https://www.netflix.com/signup/\">Sign up for Netflix</a>&nbsp;today and choose from several&nbsp;<a href=\"https://help.netflix.com/en/node/116380\">payment options</a>. You can easily change your plan or cancel at any time.</p>', 'CircoLoco Records Presents If You Want My Loving from Prospa', '2024-07-09 18:36:43', '2024-07-09 18:36:43'),
(4, '4', 'en', 'Shadow Strike', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil,</p>\r\n<p>eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia.</p>\r\n<p>Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis', '2024-08-11 04:25:00', '2024-08-11 08:20:39'),
(5, '5', 'en', 'Lunar Echo', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum</p>\r\n<p>&nbsp;laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia.</p>\r\n<p>Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:29:43', '2024-08-11 08:21:15'),
(6, '6', 'en', 'Thunder Forge', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil,</p>\r\n<p>&nbsp;eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:34:28', '2024-08-11 08:22:27'),
(7, '7', 'en', 'Mystic Flame', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto</p>\r\n<p>uga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit</p>\r\n<p>sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:37:16', '2024-08-11 08:23:10'),
(8, '8', 'en', 'Phantom Blade', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:41:05', '2024-08-11 08:24:22'),
(9, '9', 'en', 'Iron Vortex', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p><strong>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</strong></p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:43:10', '2024-08-11 08:25:06'),
(10, '10', 'en', 'Savage Dawn', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 04:57:54', '2024-08-11 08:37:51'),
(11, '11', 'en', 'Titan Surge', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem.</p>\r\n<p>&nbsp;Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:00:25', '2024-08-11 08:37:16'),
(12, '12', 'en', 'Night Shade', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:05:35', '2024-08-11 08:36:12'),
(13, '13', 'en', 'Solar Flare', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure</p>\r\n<p>&nbsp;eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia.</p>\r\n<p>Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:09:55', '2024-08-11 08:35:22'),
(14, '14', 'en', 'Vortex Knight', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga?</p>\r\n<p>Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:14:00', '2024-08-11 08:31:56'),
(15, '15', 'en', 'Ember Ghost', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:17:28', '2024-08-11 08:30:31'),
(16, '16', 'en', 'Frost Fang', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:19:37', '2024-08-11 08:29:47'),
(17, '17', 'en', 'Abyss Walker', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint?</p>\r\n<p>Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:41:00', '2024-08-11 08:28:52'),
(18, '18', 'en', 'Crimson Wolf', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga?</p>\r\n<p>&nbsp;Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:44:24', '2024-08-11 08:28:16'),
(19, '19', 'en', 'Nova Core', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis', '2024-08-11 05:46:35', '2024-08-11 08:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `options` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `options`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Subcription', '[{\"title\":\"Regular\",\"price\":\"10\"}]', 'uploads/custom-images/variant-2024-08-12-03-51-42-3763.jpg', '2024-07-09 18:19:07', '2024-08-12 09:51:42'),
(2, 2, 'Netflix', '[{\"title\":\"Subscription Monthly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-12-03-53-09-2447.jpg', '2024-07-09 18:29:28', '2024-08-12 09:53:09'),
(3, 3, 'GTA vice city', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"20\"}]', 'uploads/custom-images/variant-2024-07-09-02-38-23-8517.jpg', '2024-07-09 18:38:23', '2024-07-09 18:38:23'),
(4, 3, 'GTA San andreas', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"yearly\",\"price\":\"20\"}]', 'uploads/custom-images/variant-2024-07-09-02-39-08-5775.jpg', '2024-07-09 18:39:08', '2024-07-09 18:39:08'),
(5, 4, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-21-49-7430.jpg', '2024-08-11 04:25:49', '2024-08-12 09:15:07'),
(6, 4, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-21-54-4370.jpg', '2024-08-11 04:26:17', '2024-08-12 09:15:15'),
(7, 5, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-21-25-4805.jpg', '2024-08-11 04:30:14', '2024-08-12 09:14:34'),
(8, 5, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-21-31-1736.jpg', '2024-08-11 04:30:36', '2024-08-12 09:14:55'),
(9, 6, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-22-35-2930.jpg', '2024-08-11 04:34:54', '2024-08-12 09:13:32'),
(10, 6, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-22-41-9291.jpg', '2024-08-11 04:35:17', '2024-08-12 09:14:01'),
(11, 7, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-23-18-1140.jpg', '2024-08-11 04:37:45', '2024-08-12 09:12:41'),
(12, 7, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-23-24-2605.jpg', '2024-08-11 04:38:15', '2024-08-12 09:13:14'),
(13, 8, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"10\"}]', 'uploads/custom-images/variant-2024-08-11-02-24-32-9899.jpg', '2024-08-11 04:41:26', '2024-08-12 09:11:34'),
(14, 8, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-24-38-6618.jpg', '2024-08-11 04:41:46', '2024-08-12 09:12:01'),
(15, 9, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-25-15-6818.jpg', '2024-08-11 04:43:34', '2024-08-12 09:11:15'),
(16, 9, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-25-21-8558.jpg', '2024-08-11 04:43:59', '2024-08-12 09:11:23'),
(17, 10, 'Package', '[{\"title\":\"Monthly\",\"price\":\"11\"},{\"title\":\"Yearly\",\"price\":\"7\"}]', 'uploads/custom-images/variant-2024-08-12-03-54-01-1049.jpg', '2024-08-11 04:58:42', '2024-08-12 09:54:01'),
(18, 10, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"11\"},{\"title\":\"Yearly\",\"price\":\"7\"}]', 'uploads/custom-images/variant-2024-08-12-03-54-08-1376.jpg', '2024-08-11 04:59:08', '2024-08-12 09:54:08'),
(19, 11, 'Elementor', '[{\"title\":\"Monthly\",\"price\":\"88\"},{\"title\":\"Yearly\",\"price\":\"80\"}]', 'uploads/custom-images/variant-2024-08-12-03-55-08-6417.jpg', '2024-08-11 05:01:00', '2024-08-12 09:55:08'),
(20, 11, 'Elementor Two', '[{\"title\":\"Monthly\",\"price\":\"69\"},{\"title\":\"Yearly\",\"price\":\"80\"}]', 'uploads/custom-images/variant-2024-08-12-03-55-14-8720.jpg', '2024-08-11 05:01:26', '2024-08-12 09:55:14'),
(21, 12, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"20\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-12-03-56-19-8927.jpg', '2024-08-11 05:07:43', '2024-08-12 09:56:19'),
(22, 12, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"11\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-12-03-56-24-2665.jpg', '2024-08-11 05:08:11', '2024-08-12 09:56:24'),
(23, 13, 'Package One', '[{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-12-03-57-15-8471.jpg', '2024-08-11 05:10:34', '2024-08-12 09:57:15'),
(24, 13, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-12-03-57-20-8780.jpg', '2024-08-11 05:11:03', '2024-08-12 09:57:20'),
(25, 14, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"11\"},{\"title\":\"Yearly\",\"price\":\"6\"}]', 'uploads/custom-images/variant-2024-08-11-02-32-17-6117.jpg', '2024-08-11 05:14:25', '2024-08-12 09:08:55'),
(26, 14, 'Package two', '[{\"title\":\"New\",\"price\":\"11\"},{\"title\":\"Old\",\"price\":\"6\"}]', 'uploads/custom-images/variant-2024-08-11-02-32-25-6015.jpg', '2024-08-11 05:14:52', '2024-08-12 09:08:36'),
(27, 15, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"12\"},{\"title\":\"Yearly\",\"price\":\"8\"}]', 'uploads/custom-images/variant-2024-08-11-02-30-39-8835.jpg', '2024-08-11 05:17:51', '2024-08-11 11:29:15'),
(28, 15, 'Package two', '[{\"title\":\"Monthly\",\"price\":\"12\"},{\"title\":\"Yearly\",\"price\":\"8\"}]', 'uploads/custom-images/variant-2024-08-11-02-30-48-7382.jpg', '2024-08-11 05:18:10', '2024-08-11 11:29:33'),
(29, 16, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"11\"},{\"title\":\"Yearly\",\"price\":\"6\"}]', 'uploads/custom-images/variant-2024-08-11-02-29-55-2436.jpg', '2024-08-11 05:20:01', '2024-08-11 11:28:29'),
(30, 16, 'Package two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-30-03-9189.jpg', '2024-08-11 05:38:56', '2024-08-11 11:28:43'),
(31, 17, 'Package', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-29-02-6545.jpg', '2024-08-11 05:41:28', '2024-08-11 11:27:31'),
(32, 17, 'Package two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-29-09-7247.jpg', '2024-08-11 05:43:07', '2024-08-11 11:27:53'),
(33, 18, 'Package', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"5\"}]', 'uploads/custom-images/variant-2024-08-11-02-28-24-7864.jpg', '2024-08-11 05:45:00', '2024-08-11 11:26:57'),
(34, 18, 'Package Two', '[{\"title\":\"Monthly\",\"price\":\"10\"},{\"title\":\"Yearly\",\"price\":\"6\"}]', 'uploads/custom-images/variant-2024-08-11-02-28-30-5529.jpg', '2024-08-11 05:45:30', '2024-08-11 11:27:12'),
(35, 19, 'Package One', '[{\"title\":\"Monthly\",\"price\":\"13\"},{\"title\":\"Yearly\",\"price\":\"9\"}]', 'uploads/custom-images/variant-2024-08-11-02-27-45-4004.jpg', '2024-08-11 05:47:30', '2024-08-11 11:26:17'),
(36, 19, 'Package two', '[{\"title\":\"Monthly\",\"price\":\"13\"},{\"title\":\"Yearly\",\"price\":\"9\"}]', 'uploads/custom-images/variant-2024-08-11-02-27-52-9315.jpg', '2024-08-11 05:48:12', '2024-08-11 11:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `provider_withdraws`
--

CREATE TABLE `provider_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `withdraw_amount` double NOT NULL,
  `withdraw_charge` double NOT NULL,
  `charge_amount` double NOT NULL DEFAULT 0,
  `account_info` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_withdraws`
--

INSERT INTO `provider_withdraws` (`id`, `user_id`, `method`, `total_amount`, `withdraw_amount`, `withdraw_charge`, `charge_amount`, `account_info`, `status`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 5, 'Bank Payment', 10, 9.95, 0.5, 0.05, 'Bank Name: Your bank name\r\nAccount Number:  Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', 1, '2024-08-11', '2024-08-11 06:39:08', '2024-08-11 06:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payments`
--

CREATE TABLE `razorpay_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `country_code` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `razorpay_payments`
--

INSERT INTO `razorpay_payments` (`id`, `status`, `name`, `currency_rate`, `country_code`, `currency_code`, `description`, `image`, `color`, `key`, `secret_key`, `created_at`, `updated_at`, `currency_id`) VALUES
(1, 1, 'Axtro', 74.66, 'IN', 'INR', 'This is description', 'uploads/website-images/razorpay-2023-05-11-05-37-00-6286.png', '#2d15e5', 'rzp_test_K7CipNQYyyMPiS', 'zSBmNMorJrirOrnDrbOd1ALO', NULL, '2024-08-11 05:41:47', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `author_id` int(11) NOT NULL DEFAULT 0,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `order_id`, `variant_id`, `user_id`, `author_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 28, 1, 8, 5, 'Axtro is a powerful multivendor platform designed for buying and selling game subscriptions, gift cards, and license keys. Built with the robust Laravel framework and complemented by a MySQL database, Axtro ensures an efficient and secure experience for  users.', 5, 0, '2024-08-13 08:32:24', '2024-08-13 08:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `seller_requests`
--

CREATE TABLE `seller_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_requests`
--

INSERT INTO `seller_requests` (`id`, `user_id`, `logo`, `company_name`, `email`, `phone`, `address`, `document_type`, `document`, `about_us`, `redirect_url`, `status`, `created_at`, `updated_at`) VALUES
(2, 5, 'uploads/custom-images/quomodosoft-logo-2024-05-19-11-02-20-3453.png', 'QuomodoSoft', 'quomodosoft@gmail.com', '1236547889', 'Mirpur 10', 'NID', 'uploads/custom-images/quomodosoft-2024-05-19-11-02-20-2250.png', NULL, 'http://127.0.0.1:8000/import-country', 'approved', '2024-05-19 05:02:20', '2024-05-19 05:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'Home || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', 'Home || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', NULL, '2024-08-13 08:30:40'),
(2, 'About Us', 'About Us || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', 'About Us || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', NULL, '2024-08-13 08:30:48'),
(3, 'Contact Us', 'Contact Us || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', 'Contact Us || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', NULL, '2024-08-13 08:30:53'),
(5, 'Products', 'Our Product || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', 'Our Product || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', NULL, '2024-08-13 08:30:59'),
(6, 'Blog', 'Blog || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', 'Blog || Axtro - Buy and Sell Games subscriptions, Gift Card & License Key', NULL, '2024-08-13 08:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_mode` int(11) NOT NULL DEFAULT 0,
  `logo` varchar(255) DEFAULT NULL,
  `logo_two` varchar(255) DEFAULT NULL,
  `logo_three` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `contact_email` varchar(191) DEFAULT NULL,
  `enable_subscription_notify` int(11) NOT NULL DEFAULT 1,
  `enable_save_contact_message` int(11) NOT NULL DEFAULT 1,
  `text_direction` varchar(255) NOT NULL DEFAULT 'LTR',
  `timezone` varchar(255) DEFAULT NULL,
  `sidebar_lg_header` varchar(255) DEFAULT NULL,
  `sidebar_sm_header` varchar(255) DEFAULT NULL,
  `topbar_phone` varchar(191) DEFAULT NULL,
  `topbar_email` varchar(191) NOT NULL,
  `topbar_address` varchar(255) DEFAULT NULL,
  `opening_time` varchar(255) DEFAULT NULL,
  `currency_name` varchar(191) DEFAULT NULL,
  `currency_icon` varchar(191) DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT 1,
  `theme_one` varchar(191) NOT NULL,
  `subscriber_image` varchar(255) DEFAULT NULL,
  `subscription_bg` varchar(255) DEFAULT NULL,
  `home2_subscription_bg` varchar(255) DEFAULT NULL,
  `home3_subscription_bg` varchar(255) DEFAULT NULL,
  `blog_page_subscription_image` varchar(255) NOT NULL,
  `default_avatar` varchar(255) DEFAULT NULL,
  `home2_contact_foreground` varchar(255) DEFAULT NULL,
  `home2_contact_background` varchar(255) DEFAULT NULL,
  `home2_contact_call_as` varchar(255) DEFAULT NULL,
  `home2_contact_phone` varchar(255) DEFAULT NULL,
  `home2_contact_available` varchar(255) DEFAULT NULL,
  `home2_contact_form_title` varchar(255) DEFAULT NULL,
  `home2_contact_form_description` text DEFAULT NULL,
  `how_it_work_background` varchar(255) DEFAULT NULL,
  `how_it_work_foreground` varchar(255) DEFAULT NULL,
  `how_it_work_title` varchar(255) DEFAULT NULL,
  `how_it_work_description` text DEFAULT NULL,
  `how_it_work_items` text DEFAULT NULL,
  `selected_theme` int(11) NOT NULL DEFAULT 0,
  `blog_left_right` int(11) DEFAULT 0,
  `theme_one_color` varchar(255) DEFAULT NULL,
  `theme_two_color` varchar(255) DEFAULT NULL,
  `theme_three_color` varchar(255) DEFAULT NULL,
  `login_image` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `footer_logo_two` varchar(255) DEFAULT NULL,
  `footer_logo_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `app_version` varchar(255) NOT NULL DEFAULT '1.1',
  `commission_type` varchar(255) NOT NULL DEFAULT 'commission',
  `frontend_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `maintenance_mode`, `logo`, `logo_two`, `logo_three`, `favicon`, `contact_email`, `enable_subscription_notify`, `enable_save_contact_message`, `text_direction`, `timezone`, `sidebar_lg_header`, `sidebar_sm_header`, `topbar_phone`, `topbar_email`, `topbar_address`, `opening_time`, `currency_name`, `currency_icon`, `currency_rate`, `theme_one`, `subscriber_image`, `subscription_bg`, `home2_subscription_bg`, `home3_subscription_bg`, `blog_page_subscription_image`, `default_avatar`, `home2_contact_foreground`, `home2_contact_background`, `home2_contact_call_as`, `home2_contact_phone`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_background`, `how_it_work_foreground`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `selected_theme`, `blog_left_right`, `theme_one_color`, `theme_two_color`, `theme_three_color`, `login_image`, `footer_logo`, `footer_logo_two`, `footer_logo_three`, `created_at`, `updated_at`, `app_version`, `commission_type`, `frontend_url`) VALUES
(1, 1, 'uploads/website-images/logo-2024-07-08-06-10-39-1406.png', 'uploads/website-images/logo-2023-08-09-09-30-43-8505.png', 'uploads/website-images/logo-2023-08-09-09-30-43-4591.png', 'uploads/website-images/favicon-2024-08-11-01-29-34-8512.png', 'contact@gmail.com', 1, 1, 'ltr', 'Asia/Dhaka', 'Axtro', 'DM', '+1345-785-958', 'axtro.contact@gmail.com', 'Washington, Indiana, Florida City, Florida', '10.00 AM-7.00PM', 'USD', '$', 85.76, '#009bc2', 'uploads/website-images/sub-foreground--2023-01-22-01-32-17-2063.png', 'uploads/website-images/sub-background-2023-10-09-10-31-56-4622.jpg', 'uploads/website-images/sub-background-2023-10-09-10-32-44-4402.jpg', 'uploads/website-images/sub-background-2023-10-09-10-26-45-3495.jpg', 'uploads/website-images/blog-sub-background-2023-07-19-04-43-08-8818.png', 'uploads/website-images/default-avatar-2023-06-06-06-05-18-9960.png', 'uploads/website-images/home2-contact-foreground--2022-12-03-06-08-24-3082.png', 'uploads/website-images/home2-contact-background-2022-09-22-12-08-16-6090.jpg', 'Call as now', '+90 456 789 251', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'uploads/website-images/home3-hiw-background-2022-09-22-12-52-40-5965.jpg', 'uploads/website-images/home3-hiw-foreground--2022-09-29-01-06-00-1394.jpg', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{\"title\":\"Select The Service\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"}]', 0, 1, '#378fff', '#00bf8c', '#2251f2', 'uploads/website-images/login-page-2022-11-06-04-12-11-6638.png', 'uploads/website-images/logo-2023-08-08-05-12-32-2674.png', 'uploads/website-images/logo-2023-08-09-09-30-43-2035.png', 'uploads/website-images/logo-2023-08-09-09-30-43-2579.png', NULL, '2024-08-12 09:04:52', '1.0.0', 'subscription', 'https://axtro.vercel.app');

-- --------------------------------------------------------

--
-- Table structure for table `setting_languages`
--

CREATE TABLE `setting_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `subscriber_title` varchar(255) DEFAULT NULL,
  `subscriber_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_languages`
--

INSERT INTO `setting_languages` (`id`, `setting_id`, `lang_code`, `subscriber_title`, `subscriber_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Subscribe Now', 'Get the updates, offers, tips and enhance your page building experience', NULL, '2023-08-28 09:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL DEFAULT 0,
  `variant_name` varchar(255) DEFAULT NULL,
  `option_name` varchar(255) NOT NULL DEFAULT '0',
  `option_price` double NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `account_id` text DEFAULT NULL,
  `item_type` varchar(255) NOT NULL DEFAULT 'add_to_cart',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `user_id`, `product_id`, `variant_id`, `variant_name`, `option_name`, `option_price`, `qty`, `message`, `account_id`, `item_type`, `created_at`, `updated_at`) VALUES
(21, 7, 1, 1, 'Subcription', 'Regular', 10, 1, 'adsdadd asdad asdad', 'Al Marmu', 'add_to_cart', '2024-07-11 14:50:07', '2024-07-11 14:50:07'),
(22, 8, 1, 1, 'Subcription', 'Regular', 10, 1, 'adasdas', 'Al Marmu', 'add_to_cart', '2024-07-11 18:41:07', '2024-07-11 18:41:07'),
(35, 8, 2, 2, 'Netflix', 'Subscription Monthly', 5, 1, NULL, NULL, 'buy_now', '2024-07-11 19:46:42', '2024-07-11 19:46:42'),
(45, 5, 14, 25, 'Service 1', 'New', 11, 1, NULL, NULL, 'add_to_cart', '2024-08-11 10:08:25', '2024-08-11 10:08:25'),
(46, 5, 15, 27, 'Package One', 'New', 12, 1, NULL, NULL, 'add_to_cart', '2024-08-11 10:09:44', '2024-08-11 10:09:44'),
(49, 5, 19, 35, 'Package One', 'Monthly', 13, 1, NULL, '0000-0', 'add_to_cart', '2024-08-12 05:56:55', '2024-08-12 05:56:55'),
(62, 5, 3, 4, 'GTA San andreas', 'Monthly', 10, 3, NULL, NULL, 'add_to_cart', '2024-08-12 06:34:14', '2024-08-12 10:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(10) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_rate` double NOT NULL,
  `image` text DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stripe_payments`
--

INSERT INTO `stripe_payments` (`id`, `status`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`, `country_code`, `currency_code`, `currency_rate`, `image`, `currency_id`) VALUES
(1, 1, 'pk_test_51JU61aF56Pb8BOOX5ucAe5DlDwAkCZyffqlKMDUWsAwhKbdtuY71VvIzr0NgFKjq4sOVVaaeeyVXXnNWwu5dKgeq00kMzCBUm5', 'sk_test_51JU61aF56Pb8BOOXlz7jGkzJsCkozuAoRlFJskYGsgunfaHLmcvKLubYRQLCQOuyYHq0mvjoBFLzV7d8F6q8f6Hv00CGwULEEV', NULL, '2024-07-04 09:06:39', 'US', 'USD', 1, 'uploads/website-images/stripe-2023-05-11-05-35-11-6150.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `verified_token` text DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `status`, `verified_token`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'aboutkhalil.83@gmail.com', 0, 'm9NcKfUTxELgwMmepRmESWpij', 0, '2024-08-11 05:04:04', '2024-08-11 05:04:04'),
(2, 'e@fa.com', 0, 'o9JvMqAO0acXtbQVxviA3dv50', 0, '2024-08-11 09:36:28', '2024-08-11 09:36:28'),
(3, 'e@fad.com', 0, 'TZWNQFh4Lo9f5KV9QVP7XgEXv', 0, '2024-08-11 09:37:29', '2024-08-11 09:37:29'),
(4, 'faf@fga.com', 0, 'cGPNQIL6ZieAgv1hdD26T8qrT', 0, '2024-08-11 09:37:39', '2024-08-11 09:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `tawk_chats`
--

CREATE TABLE `tawk_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `widget_id` varchar(255) DEFAULT NULL,
  `property_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tawk_chats`
--

INSERT INTO `tawk_chats` (`id`, `chat_link`, `status`, `widget_id`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'https://embed.tawk.to/5a7c31ded7591465c7077c48/default', 1, '612dc781d6e7610a49b2d444', '1fedd6l9m', '2023-06-24 08:37:29', '2023-06-24 09:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `created_at`, `updated_at`) VALUES
(1, '2022-01-30 12:34:53', '2023-06-26 07:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition_languages`
--

CREATE TABLE `terms_and_condition_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `terms_and_condition` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_condition_languages`
--

INSERT INTO `terms_and_condition_languages` (`id`, `terms_id`, `lang_code`, `terms_and_condition`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '<h4><strong>1. What Are Terms and Conditions?</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4><strong>2. Does My Online Service Need Terms and Conditions?</strong></h4>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h4><strong>Features :</strong></h4>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h4><strong>3. Protect Your Property</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h4><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h4><strong>05.Pricing and Payment Terms</strong></h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', NULL, '2023-09-23 06:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/floyd-miles-20240729100246.jpeg', '5', 1, '2024-07-29 14:02:46', '2024-07-29 14:02:46'),
(2, 'uploads/custom-images/abdur-rahman-20240811111949.png', '4', 1, '2024-08-11 05:19:49', '2024-08-11 05:19:49'),
(3, 'uploads/custom-images/david-richard20240811113243.png', '5', 1, '2024-08-11 05:31:17', '2024-08-11 05:32:43'),
(4, 'uploads/custom-images/david-miller20240811113254.png', '4', 1, '2024-08-11 05:32:09', '2024-08-11 05:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_languages`
--

CREATE TABLE `testimonial_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_languages`
--

INSERT INTO `testimonial_languages` (`id`, `testimonial_id`, `lang_code`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Floyd Miles', 'Lead Engineer', 'Customer expect support across into the\r\nvarious channel include chats phone to late social medias helpdesk service', '2024-07-29 14:02:46', '2024-07-29 14:02:46'),
(2, 2, 'en', 'Abdur Rahman', 'CEO & Founder', 'I cannot speak highly enough of the professionalism and expertise demonstrated by Shohel throughout our app development journey', '2024-08-11 05:19:49', '2024-08-11 05:19:49'),
(3, 3, 'en', 'David Richard', 'Web Developer', 'I cannot speak highly enough of the professionalism and expertise demonstrated by Shohel throughout our app development journey.', '2024-08-11 05:31:17', '2024-08-11 05:31:17'),
(4, 4, 'en', 'David Miller', 'Graphic Designer', 'Choosing Axtro for our app development needs was one of the best decisions we made.', '2024-08-11 05:32:09', '2024-08-11 05:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `forget_password_token` varchar(191) DEFAULT NULL,
  `forget_password_otp` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `provider_id` varchar(191) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `provider_avatar` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `is_seller` varchar(10) NOT NULL DEFAULT 'no',
  `verify_token` varchar(191) DEFAULT NULL,
  `otp_mail_verify_token` varchar(255) DEFAULT NULL,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `agree_policy` int(11) DEFAULT 0,
  `designation` varchar(255) DEFAULT NULL,
  `about_me` longtext DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `linkedIn` varchar(255) DEFAULT NULL,
  `dribbble` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `my_skill` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `email_verified_at`, `password`, `remember_token`, `forget_password_token`, `forget_password_otp`, `status`, `provider_id`, `provider`, `provider_avatar`, `image`, `phone`, `country`, `state`, `city`, `zip_code`, `address`, `is_seller`, `verify_token`, `otp_mail_verify_token`, `email_verified`, `agree_policy`, `designation`, `about_me`, `facebook`, `pinterest`, `linkedIn`, `dribbble`, `twitter`, `my_skill`, `created_at`, `updated_at`) VALUES
(5, 'David Richard', 'david-rechard-3u87434343', 'seller@gmail.com', '2024-07-29 19:40:02', '$2y$10$x.g.gICpV0I1LgfJBcuh6eCYzCUsRc7DBHtv/mivKWE3FXTKNVUs.', NULL, NULL, '932003', 1, NULL, NULL, NULL, 'uploads/custom-images/david-richard-2024-08-11-11-48-15-8237.png', '123-874-6548', NULL, NULL, NULL, NULL, 'Jackson Heights, 11372, NY, United States', 'no', NULL, NULL, 1, 0, NULL, 'I\'m a front-end developer focused on developing Javascript-based web applications. I have 4+ years of experience in this Platform. I love to manage everything from complex logic to the awesome layout of a web application. I always like to invest myself in acquiring new skills and I can adapt myself to new technologies in a short time.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-09 18:12:56', '2024-08-13 08:24:47'),
(8, 'John Doe', 'john-deo_457775', 'user@gmail.com', NULL, '$2y$10$x.g.gICpV0I1LgfJBcuh6eCYzCUsRc7DBHtv/mivKWE3FXTKNVUs.', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/john-doe-2024-08-13-02-31-56-3418.png', '545468851', NULL, NULL, NULL, NULL, 'Los Angeles, CA, USA', 'no', NULL, NULL, 1, 0, NULL, 'Axtro is a powerful multivendor platform designed for buying and selling game subscriptions, gift cards, and license keys. Built with the robust Laravel framework and complemented by a MySQL database, Axtro ensures an efficient and secure experience for users.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-11 18:38:45', '2024-08-13 08:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 8, 3, '2024-07-11 21:48:48', '2024-07-11 21:48:48'),
(2, 8, 2, '2024-07-11 21:48:51', '2024-07-11 21:48:51'),
(13, 5, 19, '2024-08-11 06:47:36', '2024-08-11 06:47:36'),
(14, 5, 18, '2024-08-11 06:47:38', '2024-08-11 06:47:38'),
(15, 5, 17, '2024-08-11 06:47:40', '2024-08-11 06:47:40'),
(16, 5, 16, '2024-08-11 06:47:41', '2024-08-11 06:47:41'),
(17, 5, 15, '2024-08-11 06:47:42', '2024-08-11 06:47:42'),
(18, 5, 14, '2024-08-11 06:47:44', '2024-08-11 06:47:44'),
(19, 8, 15, '2024-08-13 08:33:04', '2024-08-13 08:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amount` double NOT NULL DEFAULT 0,
  `max_amount` double NOT NULL DEFAULT 0,
  `withdraw_charge` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank Payment', 1, 20, 0.5, '<p>Bank Name: Your bank name<br>Account Number: &nbsp;Your bank account number<br>Routing Number: Your bank routing number<br>Branch: Your bank branch name</p>', 1, '2024-08-11 05:16:05', '2024-08-11 05:16:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us_languages`
--
ALTER TABLE `about_us_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_payments`
--
ALTER TABLE `bank_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category_languages`
--
ALTER TABLE `blog_category_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_languages`
--
ALTER TABLE `blog_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_languages`
--
ALTER TABLE `category_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_pages`
--
ALTER TABLE `contact_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_page_languages`
--
ALTER TABLE `contact_page_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_countries`
--
ALTER TABLE `currency_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configurations`
--
ALTER TABLE `email_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_pages`
--
ALTER TABLE `error_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_page_languages`
--
ALTER TABLE `error_page_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_languages`
--
ALTER TABLE `faq_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_languages`
--
ALTER TABLE `footer_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_social_links`
--
ALTER TABLE `footer_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_analytics`
--
ALTER TABLE `google_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepages`
--
ALTER TABLE `homepages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_languages`
--
ALTER TABLE `homepage_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintainance_texts`
--
ALTER TABLE `maintainance_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_documents`
--
ALTER TABLE `message_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy_languages`
--
ALTER TABLE `privacy_policy_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_languages`
--
ALTER TABLE `product_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_withdraws`
--
ALTER TABLE `provider_withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_requests`
--
ALTER TABLE `seller_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_languages`
--
ALTER TABLE `setting_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_condition_languages`
--
ALTER TABLE `terms_and_condition_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_languages`
--
ALTER TABLE `testimonial_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_us_languages`
--
ALTER TABLE `about_us_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_payments`
--
ALTER TABLE `bank_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_category_languages`
--
ALTER TABLE `blog_category_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blog_languages`
--
ALTER TABLE `blog_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category_languages`
--
ALTER TABLE `category_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_pages`
--
ALTER TABLE `contact_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_page_languages`
--
ALTER TABLE `contact_page_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cookie_consents`
--
ALTER TABLE `cookie_consents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `currency_countries`
--
ALTER TABLE `currency_countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `custom_paginations`
--
ALTER TABLE `custom_paginations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_configurations`
--
ALTER TABLE `email_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `error_pages`
--
ALTER TABLE `error_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `error_page_languages`
--
ALTER TABLE `error_page_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `facebook_pixels`
--
ALTER TABLE `facebook_pixels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq_languages`
--
ALTER TABLE `faq_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `flutterwaves`
--
ALTER TABLE `flutterwaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_languages`
--
ALTER TABLE `footer_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `footer_social_links`
--
ALTER TABLE `footer_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `google_analytics`
--
ALTER TABLE `google_analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptchas`
--
ALTER TABLE `google_recaptchas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homepages`
--
ALTER TABLE `homepages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homepage_languages`
--
ALTER TABLE `homepage_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `instamojo_payments`
--
ALTER TABLE `instamojo_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `maintainance_texts`
--
ALTER TABLE `maintainance_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `message_documents`
--
ALTER TABLE `message_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `multi_currencies`
--
ALTER TABLE `multi_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paypal_payments`
--
ALTER TABLE `paypal_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paystack_and_mollies`
--
ALTER TABLE `paystack_and_mollies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privacy_policy_languages`
--
ALTER TABLE `privacy_policy_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_languages`
--
ALTER TABLE `product_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `provider_withdraws`
--
ALTER TABLE `provider_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `razorpay_payments`
--
ALTER TABLE `razorpay_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller_requests`
--
ALTER TABLE `seller_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_languages`
--
ALTER TABLE `setting_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tawk_chats`
--
ALTER TABLE `tawk_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_and_condition_languages`
--
ALTER TABLE `terms_and_condition_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonial_languages`
--
ALTER TABLE `testimonial_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
