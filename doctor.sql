-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 04:11 PM
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
-- Database: `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `sub_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sub_title`)),
  `mission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mission`)),
  `vision` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vision`)),
  `values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`values`)),
  `goals` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`goals`)),
  `history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`history`)),
  `image` varchar(255) DEFAULT NULL,
  `vision_image` varchar(255) DEFAULT NULL,
  `goal_image` varchar(255) DEFAULT NULL,
  `stats_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stat1_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat1_title`)),
  `stat1_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat1_value`)),
  `stat1_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat1_description`)),
  `stat2_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat2_title`)),
  `stat2_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat2_value`)),
  `stat2_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stat2_description`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `sub_title`, `mission`, `vision`, `values`, `goals`, `history`, `image`, `vision_image`, `goal_image`, `stats_image`, `video_url`, `contact_email`, `contact_phone`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `created_at`, `updated_at`, `stat1_title`, `stat1_value`, `stat1_description`, `stat2_title`, `stat2_value`, `stat2_description`) VALUES
(1, '{\"en\":\"Voluptatibus dolor h\",\"ar\":\"Ea dolore dolores ve\"}', '{\"en\":\"Omnis ex magni volup\",\"ar\":\"A pariatur Quo amet\"}', '{\"en\":null,\"ar\":\"<p>jjjjjjjjjj<\\/p>\"}', '{\"en\":null,\"ar\":\"<p>kkkkkkkkkkkkkk<\\/p>\"}', '{\"en\":\"Ut et facere qui qui\",\"ar\":\"Doloremque ipsum rem\"}', '{\"en\":null,\"ar\":null}', '{\"en\":\"Et ullamco irure ame\",\"ar\":\"Repudiandae dolorem\"}', 'aboutus/cBPkxGC5WXlTbB1B6VaS1tqdUVK5BdannHVo59ZH.png', 'aboutus/bQPoRGFyzJZXHGo0IfiP1u71hx4Uufm63u2xBWSO.png', 'aboutus/3fKZCPtPQ9yAEYDR6cWJWVkdlmsPh1tEAEYGW5Dc.png', 'aboutus/i5WkVYPyIpyQ40DLYRcLdz7EA4Z6PgtAEpMMwSJa.png', 'https://www.tulumacetigeg.tv', 'qorywoj@mailinator.com', '+1 (129) 979-5511', 'Quae minima nisi dol', 'Eu fugiat do quae o', 'Laboris impedit mol', 'Nam ipsum est ea c', 'Dolores qui et autem', '2025-10-02 10:56:03', '2025-10-02 11:01:29', '{\"en\":\"Nihil velit eiusmod\",\"ar\":\"Voluptatem laboriosa\"}', '{\"en\":\"Nobis magnam enim no\",\"ar\":\"Voluptatem facilis\"}', '{\"en\":\"In nulla qui perspic\",\"ar\":\"Aut exercitation et\"}', '{\"en\":\"Quo consequatur ten\",\"ar\":\"Natus a eveniet ape\"}', '{\"en\":\"Duis ut nostrud veli\",\"ar\":\"Aliqua Laborum mini\"}', '{\"en\":\"Eum laboriosam prov\",\"ar\":\"Aut cumque nesciunt\"}');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time DEFAULT NULL,
  `status` enum('pending','confirmed','completed','canceled','no_show') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `service_id`, `preferred_date`, `preferred_time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-08-26', '12:12:00', 'canceled', 'th fgfg ff g', '2025-08-26 15:25:30', '2025-08-26 15:40:04'),
(21, 18, 1, '2025-09-09', '14:00:00', 'pending', NULL, '2025-09-04 12:06:53', '2025-09-04 12:06:53'),
(22, 18, 2, '2025-09-09', '14:00:00', 'pending', NULL, '2025-09-04 12:07:46', '2025-09-04 12:07:46'),
(23, 19, 3, '2025-09-15', '16:00:00', 'pending', NULL, '2025-09-15 00:30:59', '2025-09-15 00:30:59'),
(24, 19, 3, '2025-09-15', '16:00:00', 'pending', NULL, '2025-09-15 00:31:01', '2025-09-15 00:31:01'),
(25, 20, 2, '1987-06-07', '15:00:00', 'pending', 'Здравейте, исках да знам цената ви.', '2025-09-18 00:44:29', '2025-09-18 00:44:29'),
(26, 21, 2, '1983-05-08', '15:00:00', 'pending', 'Greetings, \r\n \r\nHaving some set of links pointing to drsalmabargawi.com might bring 0 value or negative impact for your site. \r\n \r\nIt really doesn’t matter the number of external links you have, what is key is the amount of ranking terms those websites are optimized for. \r\n \r\nThat is the most important factor. \r\nNot the meaningless Moz DA or Domain Rating. \r\nThese can be faked easily. \r\nBUT the volume of ranking keywords the sites that link to you rank for. \r\nThat’s what really matters. \r\n \r\nMake sure these backlinks link to your domain and you will ROCK! \r\n \r\nWe are offering this exclusive offer here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nIn doubt, or want clarification, chat with us here: \r\nhttps://www.strictlydigital.net/whatsapp-us/ \r\n \r\nBest regards, \r\nMike Eric Mercier\r\n \r\nstrictlydigital.net \r\nPhone/WhatsApp: +1 (877) 566-3738', '2025-09-18 07:41:12', '2025-09-18 07:41:12'),
(27, 22, 2, '1985-03-03', '15:00:00', 'pending', 'Hi, \r\nWorried about hidden SEO issues on your website? Let us help — completely free. \r\nRun a 100% free SEO check and discover the exact problems holding your site back from ranking higher on Google. \r\n \r\nRun Your Free SEO Check Now \r\nhttps://www.speed-seo.net/check-site-seo-score/ \r\n \r\nOr chat with us and our agent will run the report for you: https://www.speed-seo.net/whatsapp-with-us/ \r\n \r\nBest regards, \r\n \r\n \r\nMike Johan Girard\r\n \r\nSpeed SEO Digital \r\nEmail: info@speed-seo.net \r\nPhone/WhatsApp: +1 (833) 454-8622', '2025-09-22 11:32:17', '2025-09-22 11:32:17'),
(28, 23, 2, '2025-09-22', '16:00:00', 'pending', NULL, '2025-09-22 14:48:21', '2025-09-22 14:48:21'),
(29, 23, 2, '2025-09-22', '16:00:00', 'pending', NULL, '2025-09-22 14:48:22', '2025-09-22 14:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"تدوين\", \"en\": \"blog\"}', '{\"ar\": null, \"en\": null}', NULL, 0, 1, '2025-08-24 00:42:39', '2025-08-24 01:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `slug`, `logo`, `email`, `phone`, `website`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Denton William\",\"ar\":\"Caldwell Benson\"}', 'Et fugit eum dolore', 'clients/logos/WZxuPaJtrSS5hzdWUE499BqKouPnBw9FOMjAMMuM.png', 'jewu@mailinator.com', '+1 (724) 336-3598', 'https://www.jovehuceser.in', 68, 1, '2025-09-30 09:58:30', '2025-09-30 10:24:07'),
(2, '{\"en\":\"Neil Griffin\",\"ar\":\"Kessie Caldwell\"}', 'Cupiditate enim ut e', 'clients/logos/hUUAcEDW4JLeo4AAocFmbrBjDb93EIuOyvUdjS73.jpg', 'zepu@mailinator.com', '+1 (347) 502-7194', 'https://www.kemupe.ca', 4, 1, '2025-09-30 10:40:57', '2025-09-30 10:43:56'),
(3, '{\"en\":\"Valentine Buchanan\",\"ar\":\"Deirdre Cotton\"}', 'Voluptas consequatur', 'clients/logos/AwZ0zlGuLuRDBCFcjTbb5FVluEZ11ETOnGtAqsK4.jpg', 'firiwyqeh@mailinator.com', '+1 (953) 569-4635', 'https://www.mikykafimuho.co.uk', 27, 1, '2025-09-30 10:43:26', '2025-09-30 10:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `meta`, `attachments`, `is_read`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Radwa', 'qovevetuji@mailinator.com', '+1 (842) 947-1035', 'Appointment Request', 'Laboriosam voluptat', '{\"ip\": \"172.68.234.67\", \"from\": \"appointment_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-08-31 16:51:12', '2025-08-31 16:51:12'),
(2, 'Radwaa', 'cutedugigo@mailinator.com', '+1 (702) 196-8311', 'Appointment: Botox injections', 'Soluta excepteur mag', '{\"ip\": \"162.158.23.227\", \"date\": \"2025-08-31\", \"from\": \"appointment_form\", \"time\": \"13:00\", \"locale\": \"en\", \"service_id\": \"1\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\", \"service_label\": \"Botox injections\"}', '[]', 0, 1, '2025-08-31 17:09:54', '2025-08-31 17:09:54'),
(3, 'Contact_Radwa', 'lusypym@mailinator.com', '+1 (297) 973-4221', 'Asperiores voluptate', 'Qui ratione velit se', '{\"ip\": \"162.158.23.36\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-01 10:48:18', '2025-09-04 10:27:38'),
(8, 'Radwa Amer', 'radwaa.amerr@gmail.com', '01148457576', 'Asperiores voluptate', 'kkk', '{\"ip\": \"172.68.234.143\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-04 12:11:21', '2025-09-04 12:12:06'),
(9, 'UqOdETlyrpga', 'qijudonabo94@gmail.com', '6571512055', 'jvYGqghoowJoqWF', '', '{\"ip\": \"172.71.82.147\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-11 15:18:58', '2025-09-11 15:18:58'),
(10, 'UqOdETlyrpga', 'qijudonabo94@gmail.com', '6571512055', 'jvYGqghoowJoqWF', '', '{\"ip\": \"104.23.175.24\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-11 15:19:01', '2025-09-11 15:19:01'),
(11, 'Brian WRIGHT Eng.', 'newsletter@wexxon.com', '7209248652', 'Can you build a long-lasting relationship, or even a marriage, with your potential mate?', 'Please visit https://wexxon.com/en/home/9-romantic-compatibility.html for more details', '{\"ip\": \"104.23.211.81\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/89.0.4447.51\"}', '[]', 0, 1, '2025-09-11 18:14:05', '2025-09-11 18:14:05'),
(12, 'dlEnQgHD', 'exowonicoq72@gmail.com', '4320740700', 'guLXfZfqF', '', '{\"ip\": \"197.234.243.131\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 09:07:12', '2025-09-12 09:07:12'),
(13, 'dlEnQgHD', 'exowonicoq72@gmail.com', '4320740700', 'guLXfZfqF', '', '{\"ip\": \"172.68.42.83\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 09:07:15', '2025-09-12 09:07:15'),
(14, 'rYQFBNwcBfp', 'urutifeyaq74@gmail.com', '3174475111', 'gOCMPMnvRxm', '', '{\"ip\": \"104.23.251.232\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 10:57:46', '2025-09-12 10:57:46'),
(15, 'rYQFBNwcBfp', 'urutifeyaq74@gmail.com', '3174475111', 'gOCMPMnvRxm', '', '{\"ip\": \"172.70.207.148\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 10:57:48', '2025-09-12 10:57:48'),
(16, 'FEhSDkAtzzkNn', 'teyoripi803@gmail.com', '4305370355', 'VWsilbYzGkJACCN', '', '{\"ip\": \"172.69.176.102\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 14:49:03', '2025-09-12 14:49:03'),
(17, 'FEhSDkAtzzkNn', 'teyoripi803@gmail.com', '4305370355', 'VWsilbYzGkJACCN', '', '{\"ip\": \"162.158.163.105\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 14:49:11', '2025-09-12 14:49:11'),
(18, 'sPmLJFIJfbsuFg', 'xqikcpgiaedfrs@yahoo.com', '3467116000', 'XZNjTmijatvkC', '', '{\"ip\": \"172.71.214.47\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 23:30:26', '2025-09-12 23:30:26'),
(19, 'sPmLJFIJfbsuFg', 'xqikcpgiaedfrs@yahoo.com', '3467116000', 'XZNjTmijatvkC', '', '{\"ip\": \"172.71.219.35\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-12 23:30:31', '2025-09-12 23:30:31'),
(20, 'lgEAeNZwRHNAa', 'beqehame914@gmail.com', '6753957695', 'WkMBEASyA', '', '{\"ip\": \"172.71.214.48\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-13 11:20:51', '2025-09-13 11:20:51'),
(21, 'Brian WRIGHT Eng.', 'newsletter@wexxon.com', '7209248652', 'Can you build a long-lasting relationship, or even a marriage, with your potential mate?', 'Please visit https://wexxon.com/en/home/9-romantic-compatibility.html for more details', '{\"ip\": \"172.71.190.4\", \"from\": \"contact_form\", \"locale\": \"en\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 12_5) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15\"}', '[]', 0, 1, '2025-09-14 10:30:59', '2025-09-14 10:30:59'),
(22, 'ZjkaIMqpnA', 'lecijoro84@gmail.com', '6016195637', 'qmVHMSZviT', '', '{\"ip\": \"108.162.210.248\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-14 18:25:07', '2025-09-14 18:25:07'),
(23, 'ZjkaIMqpnA', 'lecijoro84@gmail.com', '6016195637', 'qmVHMSZviT', '', '{\"ip\": \"172.70.54.152\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-14 18:25:09', '2025-09-14 18:25:09'),
(24, 'eTAcBWPmTBMl', 'baqoman731@gmail.com', '9973217700', 'KqjvIVoSY', '', '{\"ip\": \"172.68.42.83\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-15 00:31:04', '2025-09-15 00:31:04'),
(25, 'eTAcBWPmTBMl', 'baqoman731@gmail.com', '9973217700', 'KqjvIVoSY', '', '{\"ip\": \"197.234.243.131\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-15 00:31:06', '2025-09-15 00:31:06'),
(26, 'Yetta Dennison', 'info@dennison.medicopostura.com', '7956214270', 'الموقع الرسمي للدكتورة سلمى البرقاوي', 'Hey there \r\n\r\nLooking to improve your posture and live a healthier life? Our Medico Postura™ Body Posture Corrector is here to help!\r\n\r\nExperience instant posture improvement with Medico Postura™. This easy-to-use device can be worn anywhere, anytime – at home, work, or even while you sleep.\r\n\r\nMade from lightweight, breathable fabric, it ensures comfort all day long.\r\n\r\nGrab it today at a fantastic 60% OFF: https://medicopostura.com\r\n\r\nPlus, enjoy FREE shipping for today only!\r\n\r\nDon\'t miss out on this amazing deal. Get yours now and start transforming your posture!\r\n\r\nSincerely, \r\n\r\nYetta', '{\"ip\": \"108.162.216.250\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 12_5) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.4 Safari/605.1.15\"}', '[]', 0, 1, '2025-09-15 00:31:30', '2025-09-15 00:31:30'),
(27, 'HCbctpXfY', 'ubehebowik643@gmail.com', '9351050420', 'eSBpcEJO', '', '{\"ip\": \"172.70.199.156\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-16 17:23:29', '2025-09-16 17:23:29'),
(28, 'HCbctpXfY', 'ubehebowik643@gmail.com', '9351050420', 'eSBpcEJO', '', '{\"ip\": \"172.70.199.156\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-16 17:23:32', '2025-09-16 17:23:32'),
(29, 'QCxemITdMuAs', 'osuceyix712@gmail.com', '2980843355', 'SPUWJRVKIwkuH', '', '{\"ip\": \"162.158.116.112\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-16 17:43:31', '2025-09-16 17:43:31'),
(30, 'QCxemITdMuAs', 'osuceyix712@gmail.com', '2980843355', 'SPUWJRVKIwkuH', '', '{\"ip\": \"162.158.116.112\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-16 17:43:32', '2025-09-16 17:43:32'),
(31, 'Brian WRIGHT Eng.', 'newsletter@wexxon.com', '7209248652', 'Discover your romantic compatibility with your partner', 'Please visit https://wexxon.com/en/home/9-romantic-compatibility.html for more details', '{\"ip\": \"162.158.152.176\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-16 18:31:15', '2025-09-16 18:31:15'),
(32, 'KLUBPhhllOZAxX', 'santguidaurxjfkoik@yahoo.com', '4335740650', 'yKPLSeIZed', '', '{\"ip\": \"172.68.19.115\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-17 16:39:27', '2025-09-17 16:39:27'),
(33, 'KLUBPhhllOZAxX', 'santguidaurxjfkoik@yahoo.com', '4335740650', 'yKPLSeIZed', '', '{\"ip\": \"172.69.11.52\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-17 16:39:38', '2025-09-17 16:39:38'),
(34, 'ZXiRqxPgCIHfkVr', 'egwotw6kdqtbxju@yahoo.com', '8936727504', 'sjgmbQkuPLX', '', '{\"ip\": \"162.158.179.155\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-18 05:05:27', '2025-09-18 05:05:27'),
(35, 'ZXiRqxPgCIHfkVr', 'egwotw6kdqtbxju@yahoo.com', '8936727504', 'sjgmbQkuPLX', '', '{\"ip\": \"172.68.211.49\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-18 05:05:30', '2025-09-18 05:05:30'),
(36, 'EDkejQvEIOtmj', 'kuvivoj506@gmail.com', '8798453964', 'jvQWDDbpwsG', '', '{\"ip\": \"172.69.68.82\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-18 14:29:27', '2025-09-18 14:29:27'),
(37, 'EDkejQvEIOtmj', 'kuvivoj506@gmail.com', '8798453964', 'jvQWDDbpwsG', '', '{\"ip\": \"172.70.216.132\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-18 14:29:29', '2025-09-18 14:29:29'),
(38, 'Karen B.', 'outreachseo56@gmail.com', '7759976714', 'Quick Link Partnership?', 'Hi,\r\n\r\nI wanted to see if you\'d be interested in a link exchange for mutual SEO benefits. I can link to your site (drsalmabargawi.com) from a few of our high-authority websites. In return, you would link back to our clients’ sites, which cover niches like health, business services, real estate, consumer electronics, and more.\r\n\r\nIf you\'re interested, let me know — I\'d be happy to share more details!\r\n\r\nThanks for your time,\r\nKaren\r\nSEO Account Manager', '{\"ip\": \"172.70.211.38\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Vivaldi/5.3.2679.68\"}', '[]', 0, 1, '2025-09-19 05:23:55', '2025-09-19 05:23:55'),
(39, 'NcXlvNIg', 'fipepehuxucu19@gmail.com', '5653274594', 'rUglSxWzzo', '', '{\"ip\": \"172.68.213.207\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-22 14:48:24', '2025-09-22 14:48:24'),
(40, 'NcXlvNIg', 'fipepehuxucu19@gmail.com', '5653274594', 'rUglSxWzzo', '', '{\"ip\": \"172.71.15.164\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-22 14:48:25', '2025-09-22 14:48:25'),
(41, 'vZSRiYsKhtg', 'qagicivozi45@gmail.com', '9752152196', 'PtqfeNoHCiFPzb', '', '{\"ip\": \"172.68.42.83\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-23 16:46:52', '2025-09-23 16:46:52'),
(42, 'vZSRiYsKhtg', 'qagicivozi45@gmail.com', '9752152196', 'PtqfeNoHCiFPzb', '', '{\"ip\": \"197.234.243.132\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-23 16:46:57', '2025-09-23 16:46:57'),
(43, 'YZlQrFFjA', 'tedikopixut10@gmail.com', '9042865440', 'mQZtVnpyHRZeoZ', '', '{\"ip\": \"172.69.94.40\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-24 04:23:25', '2025-09-24 04:23:25'),
(44, 'YZlQrFFjA', 'tedikopixut10@gmail.com', '9042865440', 'mQZtVnpyHRZeoZ', '', '{\"ip\": \"172.69.86.246\", \"from\": \"contact_form\", \"locale\": \"ar\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '[]', 0, 1, '2025-09-24 04:23:29', '2025-09-24 04:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `excerpt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`excerpt`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`location`)),
  `image` varchar(255) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `register_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`question`)),
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`answer`)),
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `slug` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `founders`
--

CREATE TABLE `founders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `position` varchar(255) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `speech` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `founders`
--

INSERT INTO `founders` (`id`, `name`, `position`, `short_desc`, `speech`, `image`, `email`, `phone`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Dr. Salma El Barkawy\",\"ar\":\"\\u0627\\u0644\\u062f\\u0643\\u062a\\u0648\\u0631\\u0629 \\u0633\\u0644\\u0645\\u0649 \\u0627\\u0644\\u0628\\u0631\\u0642\\u0627\\u0648\\u064a\"}', '{\"en\":\"Consultant Plastic Surgeon\",\"ar\":\"\\u0627\\u0633\\u062a\\u0634\\u0627\\u0631\\u064a \\u062c\\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644\"}', '{\"en\":null,\"ar\":null}', '{\"en\":\"<p>Dr. Salma Al-Barqawi, a consultant plastic and reconstructive surgeon, holds the American Board of Plastic Surgery and is a member of the International Society of Plastic Surgeons. He has over 15 years of experience in the field. We believe that natural beauty is the goal, so we use the latest global technologies to ensure the best results while preserving a natural and beautiful appearance.<\\/p>\",\"ar\":\"<p>\\u062f. \\u0633\\u0644\\u0645\\u0649 \\u0627\\u0644\\u0628\\u0631\\u0642\\u0627\\u0648\\u064a\\u060c \\u0627\\u0633\\u062a\\u0634\\u0627\\u0631\\u064a \\u062c\\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644 \\u0648\\u0627\\u0644\\u062a\\u0631\\u0645\\u064a\\u0645\\u060c \\u062d\\u0627\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0628\\u0648\\u0631\\u062f \\u0627\\u0644\\u0623\\u0645\\u0631\\u064a\\u0643\\u064a \\u0641\\u064a \\u062c\\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644 \\u0648\\u0639\\u0636\\u0648 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u062f\\u0648\\u0644\\u064a\\u0629 \\u0644\\u062c\\u0631\\u0627\\u062d\\u064a \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644. \\u064a\\u062a\\u0645\\u062a\\u0639 \\u0628\\u062e\\u0628\\u0631\\u0629 \\u062a\\u0632\\u064a\\u062f \\u0639\\u0646 15 \\u0639\\u0627\\u0645\\u064b\\u0627 \\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u062c\\u0627\\u0644. \\u0646\\u062d\\u0646 \\u0646\\u0624\\u0645\\u0646 \\u0628\\u0623\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0637\\u0628\\u064a\\u0639\\u064a \\u0647\\u0648 \\u0627\\u0644\\u0647\\u062f\\u0641\\u060c \\u0648\\u0644\\u0630\\u0644\\u0643 \\u0646\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0627\\u062a \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645\\u064a\\u0629 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u0623\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0646\\u062a\\u0627\\u0626\\u062c \\u0645\\u0639 \\u0627\\u0644\\u062d\\u0641\\u0627\\u0638 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u0637\\u0628\\u064a\\u0639\\u064a \\u0648\\u0627\\u0644\\u062c\\u0645\\u064a\\u0644.<\\/p>\"}', 'founder/obmRBwQ9QNXijwk5NqJhcyovt12PdgBX6OzPgf2D.jpg', 'test@gmail.com', '01126919401', 'https://demo.pixelcave.com/proui/page_ecom_customer_view.php', 'https://demo.pixelcave.com/proui/page_ecom_customer_view.php', 'https://demo.pixelcave.com/proui/page_ecom_customer_view.php', 'https://demo.pixelcave.com/proui/page_ecom_customer_view.php', 'https://demo.pixelcave.com/proui/page_ecom_customer_view.php', '2025-08-31 10:26:17', '2025-10-02 09:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `dir` enum('ltr','rtl') NOT NULL DEFAULT 'ltr',
  `locale` varchar(20) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `dir`, `locale`, `order`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'english', 'en', 'ltr', 'en_US', 0, 1, 0, '2025-08-16 19:30:41', '2025-09-16 11:56:46'),
(2, 'عربى', 'ar', 'rtl', 'as_SA', 0, 1, 1, '2025-08-16 19:31:04', '2025-09-16 11:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `main_sliders`
--

CREATE TABLE `main_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `subtitle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`subtitle`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `background_ar` varchar(255) DEFAULT NULL,
  `background_en` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `overlay_color` varchar(255) DEFAULT NULL,
  `overlay_opacity` decimal(3,2) NOT NULL DEFAULT 0.50,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `button1_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`button1_text`)),
  `button1_link` varchar(255) DEFAULT NULL,
  `button2_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`button2_text`)),
  `button2_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_sliders`
--

INSERT INTO `main_sliders` (`id`, `title`, `subtitle`, `description`, `image`, `background_ar`, `background_en`, `video_url`, `link`, `overlay_color`, `overlay_opacity`, `order`, `status`, `created_at`, `updated_at`, `background_image`, `video`, `button1_text`, `button1_link`, `button2_text`, `button2_link`) VALUES
(1, '{\"ar\": \"نحن نهتم بجمالك\", \"en\": \"We care about your beauty.\"}', '{\"ar\": null, \"en\": null}', '{\"ar\": \"<p>مع د. سلمى البرقاوي، استشاري جراحة التجميل، احصل على أفضل النتائج<br />\\r\\nبتقنيات حديثة وخبرة تمتد لأكثر من 15 عامًا</p>\", \"en\": \"<p>With Dr. Salma El Barkawy, Consultant Plastic Surgeon, achieve the best results with modern techniques and over 15 years of experience.</p>\"}', 'uploads/main_slider/0nrEdFtqXEy8aKmM2nLqgucZ9TSq9H4Mr4huPPu4.png', 'uploads/main_slider/RlmRUitGPD5UMl40vTYyykcoPQRBrxN6V946jpp4.png', 'uploads/main_slider/5KRBrTitbc88JYlFbXUZqY6oVT3k7nUMfPF9a7zR.png', NULL, NULL, '#000000', 0.50, 0, 1, '2025-08-23 15:13:05', '2025-09-10 07:47:17', 'uploads/main_slider/9zqks31kkCDC8NSpBj6E8Rshs6c467yK4IcvvOvF.jpg', NULL, '{\"ar\": \"احجز استشارة\", \"en\": \"Book a consultation\"}', 'https://doctor.corpintech.com/', '{\"ar\": \"تعرف على خدماتنا\", \"en\": \"Discover our services\"}', 'https://doctor.corpintech.com/');

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
(39, 'fill_002_create_patients_table', 1),
(40, 'fill_003_create_time_slots_table', 1),
(41, 'fill_004_create_appointments_table', 1),
(42, '2025_08_15_081147_create_navbar_table', 2),
(44, '2025_08_28_020445_update_site_settings_add_missing_columns', 3),
(45, '2025_08_31_000001_update_main_sliders_add_locale_background', 4),
(46, '2025_09_02_000001_create_video_categories_table', 5),
(47, '2025_09_02_000002_add_category_id_to_videos_table', 6),
(48, '2025_09_02_000100_create_pages_table', 7),
(49, '2025_09_02_000200_add_title_to_pages_table', 8),
(50, '2014_10_12_000000_create_users_table', 9),
(51, '2014_10_12_100000_create_password_reset_tokens_table', 10),
(52, '2019_08_19_000000_create_failed_jobs_table', 11),
(53, '2019_12_14_000001_create_personal_access_tokens_table', 12),
(54, '2025_08_12_202253_add_phone_and_avatar_to_users_table', 13),
(55, '2025_08_14_175229_add_role_id_to_users_table', 14),
(56, '2025_09_04_215017_add_timestamps_to_user_role_table', 15),
(58, '2025_09_30_000001_add_working_days_to_site_settings', 16),
(59, '2025_08_20_000000_create_transformation_table', 17),
(60, '2025_08_20_000001_update_stats_to_json', 18),
(61, '2025_10_02_135806_add_missing_columns_to_about_us', 19);

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE `navbar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `navbar_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`id`, `slug`, `title`, `description`, `icon`, `order`, `navbar_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'home', '{\"ar\": \"الرئيسية\", \"en\": \"Home\"}', NULL, NULL, 1, 0, 1, '2025-08-26 20:42:25', '2025-09-01 06:46:19'),
(2, 'aboutus', '{\"ar\": \"من نحن\", \"en\": \"About us\"}', NULL, NULL, 2, 0, 1, '2025-08-26 20:43:11', '2025-09-01 06:46:34'),
(3, 'faq', '{\"ar\": \"الأسئلة الشائعة\", \"en\": \"FAQ\"}', NULL, NULL, 6, 0, 0, '2025-08-26 20:44:18', '2025-09-01 09:43:34'),
(4, 'blog', '{\"ar\": \"المدونة\", \"en\": \"Blog\"}', NULL, NULL, 5, 0, 1, '2025-08-26 20:45:26', '2025-08-26 21:40:49'),
(5, 'video', '{\"ar\": \"فيديو\", \"en\": \"Video\"}', NULL, NULL, 4, 0, 1, '2025-08-26 21:38:59', '2025-09-01 06:47:01'),
(6, 'services', '{\"ar\": \"الخدمات\", \"en\": \"Services\"}', NULL, NULL, 3, 0, 1, '2025-08-26 21:39:23', '2025-09-01 06:46:52'),
(7, 'contact', '{\"ar\": \"اتصل بنا\", \"en\": \"Contact us\"}', NULL, NULL, 7, 0, 1, '2025-08-26 21:40:42', '2025-08-26 21:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `image`, `slug`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"سياسة الخصوصية\", \"en\": \"Privacy Policy\"}', '{\"ar\": \"<p>ععع</p>\", \"en\": \"<p>kkkkkkllllllll</p>\"}', NULL, 'privacy', 0, 1, '2025-09-03 10:08:27', '2025-09-03 13:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `phone` varchar(32) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `file_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `phone`, `email`, `gender`, `birthdate`, `file_number`, `notes`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"اختبار\", \"en\": \"test\"}', '0123455646', 'a@a.com', 'female', '2026-08-27', '1223', 'dfdf', 1, NULL, '2025-08-26 15:25:04', '2025-08-26 15:25:04'),
(2, '{\"en\": \"Sylvia Knight\"}', '+1 (565) 913-2601', 'varofiru@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:15:04', '2025-09-01 11:07:35', '2025-09-02 12:15:04'),
(3, '{\"en\": \"Sydnee Abbott\"}', '+1 (222) 769-6542', 'sybisyhulu@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:15:00', '2025-09-01 11:13:28', '2025-09-02 12:15:00'),
(4, '{\"en\": \"Patricia Padilla\"}', '+1 (274) 494-9974', 'busyx@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:58', '2025-09-02 10:38:07', '2025-09-02 12:14:58'),
(5, '{\"en\": \"Silas Emerson\"}', '+1 (571) 526-4353', 'fogig@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:56', '2025-09-02 10:52:26', '2025-09-02 12:14:56'),
(6, '{\"en\": \"Anne Atkins\"}', '+1 (945) 652-7062', 'qujocyjim@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:53', '2025-09-02 10:54:50', '2025-09-02 12:14:53'),
(7, '{\"en\": \"Maile Grant\"}', '+1 (101) 371-2273', 'razifik@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:51', '2025-09-02 10:55:33', '2025-09-02 12:14:51'),
(8, '{\"en\": \"Kane Miller\"}', '+1 (759) 424-5675', 'vyjyd@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:48', '2025-09-02 11:10:01', '2025-09-02 12:14:48'),
(9, '{\"en\": \"Basia Haney\"}', '+1 (422) 754-9755', 'puqe@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:46', '2025-09-02 11:16:41', '2025-09-02 12:14:46'),
(10, '{\"ar\": \"Roanna Wong\"}', '+1 (666) 478-7838', 'newa@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:44', '2025-09-02 11:17:16', '2025-09-02 12:14:44'),
(11, '{\"en\": \"Heidi Nunez\"}', '+1 (886) 649-1064', 'fymyc@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:42', '2025-09-02 11:19:40', '2025-09-02 12:14:42'),
(12, '{\"ar\": \"Martha Delaney\"}', '+1 (432) 319-3192', 'viwijyfule@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:40', '2025-09-02 11:19:54', '2025-09-02 12:14:40'),
(13, '{\"ar\": \"Sydney Drake\"}', '+1 (558) 238-2966', 'sahe@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:37', '2025-09-02 11:20:55', '2025-09-02 12:14:37'),
(14, '{\"ar\": \"Curran Harper\"}', '+1 (448) 709-4871', 'rymocope@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:35', '2025-09-02 11:31:03', '2025-09-02 12:14:35'),
(15, '{\"ar\": \"Lillith Cobb\"}', '+1 (814) 297-7283', 'jipe@mailinator.com', NULL, NULL, NULL, NULL, 1, '2025-09-02 12:14:18', '2025-09-02 12:12:31', '2025-09-02 12:14:18'),
(16, '{\"en\": \"Radwa Amer\"}', '01148457576', 'radwaa.amerr@gmail.com', NULL, NULL, NULL, NULL, 1, '2025-09-04 10:27:03', '2025-09-04 10:15:07', '2025-09-04 10:27:03'),
(17, '{\"en\": \"Radwa Amer\"}', '+2011484575766', 'radwaa.amerrr@gmail.com', NULL, NULL, NULL, NULL, 1, '2025-09-04 10:27:00', '2025-09-04 10:16:01', '2025-09-04 10:27:00'),
(18, '{\"en\": \"Radwa Amer\"}', '01148457576', 'radwaa.amerr@gmail.com', NULL, NULL, NULL, NULL, 1, '2025-09-22 10:10:34', '2025-09-04 12:06:53', '2025-09-22 10:10:34'),
(19, '{\"ar\": \"gLpehkFyTy\"}', '3555877382', 'baqoman731@gmail.com', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-15 00:30:59', '2025-09-15 00:30:59'),
(20, '{\"ar\": \"Leerex\"}', '84458583213', 'zekisuquc419@gmail.com', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-18 00:44:29', '2025-09-18 00:44:29'),
(21, '{\"ar\": \"Mike Eric Mercier\"}', '85237997865', 'info@strictlydigital.net', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-18 07:41:12', '2025-09-18 07:41:12'),
(22, '{\"ar\": \"Mike Johan Girard\"}', '85948698935', 'info@speed-seo.net', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-22 11:32:17', '2025-09-22 11:32:17'),
(23, '{\"ar\": \"YcRMjhnar\"}', '7586773533', 'fipepehuxucu19@gmail.com', NULL, NULL, NULL, NULL, 1, NULL, '2025-09-22 14:48:21', '2025-09-22 14:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `module`, `label`, `created_at`, `updated_at`) VALUES
(101, 'blog.categories.view', 'Blog', 'View blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(102, 'blog.categories.create', 'Blog', 'Create blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(103, 'blog.categories.edit', 'Blog', 'Edit blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(104, 'blog.categories.delete', 'Blog', 'Delete blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(105, 'blog.categories.toggle', 'Blog', 'Toggle blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(106, 'blog.categories.order', 'Blog', 'Reorder blog categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(107, 'blog.posts.view', 'Blog', 'View blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(108, 'blog.posts.create', 'Blog', 'Create blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(109, 'blog.posts.edit', 'Blog', 'Edit blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(110, 'blog.posts.delete', 'Blog', 'Delete blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(111, 'blog.posts.toggle', 'Blog', 'Toggle blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(112, 'blog.posts.order', 'Blog', 'Reorder blog posts', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(113, 'clients.view', 'Clients', 'View clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(114, 'clients.create', 'Clients', 'Create clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(115, 'clients.edit', 'Clients', 'Edit clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(116, 'clients.delete', 'Clients', 'Delete clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(117, 'clients.order', 'Clients', 'Reorder clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(118, 'clients.toggle', 'Clients', 'Toggle clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(119, 'contact.view', 'Contact', 'View contact messages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(120, 'contact.update', 'Contact', 'Update contact messages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(121, 'contact.delete', 'Contact', 'Delete contact messages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(122, 'faqs.view', 'Faqs', 'View FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(123, 'faqs.create', 'Faqs', 'Create FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(124, 'faqs.edit', 'Faqs', 'Edit FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(125, 'faqs.delete', 'Faqs', 'Delete FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(126, 'faqs.toggle', 'Faqs', 'Toggle FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(127, 'faqs.order', 'Faqs', 'Reorder FAQ records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(128, 'faqs.categories.view', 'Faqs', 'View FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(129, 'faqs.categories.create', 'Faqs', 'Create FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(130, 'faqs.categories.edit', 'Faqs', 'Edit FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(131, 'faqs.categories.delete', 'Faqs', 'Delete FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(132, 'faqs.categories.toggle', 'Faqs', 'Toggle FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(133, 'faqs.categories.order', 'Faqs', 'Reorder FAQ categories', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(134, 'founder.view', 'Founder', 'View founders', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(135, 'language.view', 'Language', 'View languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(136, 'language.create', 'Language', 'Create languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(137, 'language.edit', 'Language', 'Edit languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(138, 'language.delete', 'Language', 'Delete languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(139, 'language.order', 'Language', 'Reorder languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(140, 'language.toggle', 'Language', 'Toggle languages', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(141, 'mainslider.view', 'MainSlider', 'View main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(142, 'mainslider.create', 'MainSlider', 'Create main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(143, 'mainslider.edit', 'MainSlider', 'Edit main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(144, 'mainslider.delete', 'MainSlider', 'Delete main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(145, 'mainslider.toggle', 'MainSlider', 'Toggle main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(146, 'mainslider.order', 'MainSlider', 'Reorder main slider records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(147, 'media.view', 'Media', 'View photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(148, 'media.create', 'Media', 'Create photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(149, 'media.edit', 'Media', 'Edit photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(150, 'media.delete', 'Media', 'Delete photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(151, 'media.reorder', 'Media', 'Reorder photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(152, 'media.toggle', 'Media', 'Toggle photos', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(153, 'projects.view', 'Projects', 'View projects records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(154, 'projects.create', 'Projects', 'Create projects records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(155, 'projects.edit', 'Projects', 'Edit projects records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(156, 'projects.delete', 'Projects', 'Delete projects records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(157, 'sectionheaders.view', 'SectionHeaders', 'View section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(158, 'sectionheaders.create', 'SectionHeaders', 'Create section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(159, 'sectionheaders.edit', 'SectionHeaders', 'Edit section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(160, 'sectionheaders.delete', 'SectionHeaders', 'Delete section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(161, 'sectionheaders.order', 'SectionHeaders', 'Reorder section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(162, 'sectionheaders.toggle', 'SectionHeaders', 'Toggle section headers', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(169, 'services.view', 'Services', 'View services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(170, 'services.create', 'Services', 'Create services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(171, 'services.edit', 'Services', 'Edit services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(172, 'services.delete', 'Services', 'Delete services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(173, 'services.toggle', 'Services', 'Toggle services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(174, 'services.order', 'Services', 'Reorder services', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(175, 'sitesetting.view', 'SiteSetting', 'View clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(176, 'sitesetting.create', 'SiteSetting', 'Create clients records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(177, 'statistics.view', 'Statistics', 'View statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(178, 'statistics.create', 'Statistics', 'Create statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(179, 'statistics.edit', 'Statistics', 'Edit statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(180, 'statistics.delete', 'Statistics', 'Delete statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(181, 'statistics.order', 'Statistics', 'Reorder statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(182, 'statistics.toggle', 'Statistics', 'Toggle statistics records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(183, 'team.view', 'Team', 'View records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(184, 'team.create', 'Team', 'Create records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(185, 'team.edit', 'Team', 'Edit records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(186, 'team.delete', 'Team', 'Delete records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(187, 'testimonial.view', 'Testimonial', 'View testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(188, 'testimonial.create', 'Testimonial', 'Create testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(189, 'testimonial.edit', 'Testimonial', 'Edit testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(190, 'testimonial.delete', 'Testimonial', 'Delete testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(191, 'testimonial.order', 'Testimonial', 'Reorder testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(192, 'testimonial.toggle', 'Testimonial', 'Toggle testimonials records', '2025-08-22 17:32:20', '2025-08-22 17:32:20'),
(193, 'aboutus.view', 'AboutUs', 'View About Us records', '2025-08-22 19:11:17', '2025-08-22 19:11:17'),
(214, 'appointments.appointments.view', 'Appointments', 'View appointments', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(215, 'appointments.appointments.create', 'Appointments', 'Create appointments', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(216, 'appointments.appointments.edit', 'Appointments', 'Edit appointments', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(217, 'appointments.appointments.delete', 'Appointments', 'Delete appointments', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(218, 'appointments.patients.view', 'Appointments', 'View patients', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(219, 'appointments.patients.create', 'Appointments', 'Create patients', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(220, 'appointments.patients.edit', 'Appointments', 'Edit patients', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(221, 'appointments.patients.delete', 'Appointments', 'Delete patients', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(222, 'appointments.timeslots.manage', 'Appointments', 'Manage time slots', '2025-08-26 14:29:42', '2025-08-26 14:29:42'),
(223, 'navbar.view', 'Navbar', 'View section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(224, 'navbar.create', 'Navbar', 'Create section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(225, 'navbar.edit', 'Navbar', 'Edit section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(226, 'navbar.delete', 'Navbar', 'Delete section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(227, 'navbar.order', 'Navbar', 'Reorder section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(228, 'navbar.toggle', 'Navbar', 'Toggle section headers', '2025-08-26 20:02:15', '2025-08-26 20:02:15'),
(229, 'pages.view', 'Pages', 'View pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(230, 'pages.create', 'Pages', 'Create pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(231, 'pages.edit', 'Pages', 'Edit pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(232, 'pages.delete', 'Pages', 'Delete pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(233, 'pages.reorder', 'Pages', 'Reorder pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(234, 'pages.toggle', 'Pages', 'Toggle pages', '2025-09-04 20:10:45', '2025-09-04 20:10:45'),
(293, 'accesscontrol.users.view', 'AccessControl', 'View users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(294, 'accesscontrol.users.create', 'AccessControl', 'Create users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(295, 'accesscontrol.users.edit', 'AccessControl', 'Edit users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(296, 'accesscontrol.users.delete', 'AccessControl', 'Delete users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(297, 'accesscontrol.roles.view', 'AccessControl', 'View roles', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(298, 'accesscontrol.roles.create', 'AccessControl', 'Create roles', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(299, 'accesscontrol.roles.edit', 'AccessControl', 'Edit roles', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(300, 'accesscontrol.roles.delete', 'AccessControl', 'Delete roles', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(301, 'seo.view', 'Seo', 'View SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(302, 'seo.create', 'Seo', 'Create SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(303, 'seo.edit', 'Seo', 'Edit SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(304, 'seo.delete', 'Seo', 'Delete SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(305, 'seo.toggle', 'Seo', 'Toggle SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(306, 'seo.order', 'Seo', 'Reorder SEO records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(307, 'users.view', 'Users', 'View users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(308, 'users.create', 'Users', 'Create users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(309, 'users.edit', 'Users', 'Edit users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(310, 'users.delete', 'Users', 'Delete users', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(311, 'transformation.view', 'transformation', 'View Transformation records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(312, 'transformation.add', 'transformation', 'Add Transformation records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(313, 'transformation.edit', 'transformation', 'Edit Transformation records', '2025-10-02 06:19:38', '2025-10-02 06:19:38'),
(314, 'transformation.delete', 'transformation', 'Delete Transformation records', '2025-10-02 06:19:38', '2025-10-02 06:19:38');

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

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `author` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`author`)),
  `image` varchar(255) DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `description`, `author`, `image`, `tags`, `category_id`, `order`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"تغيرات الجلد المصاحبة لعمليات التكميم.. أنواعها وتأثيرها\", \"en\": \"Skin Changes Associated with Gastric Sleeve Surgery.. Types and Impact\"}', '{\"ar\": \"<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">اتجه البعض مؤخرا لعمليات تكميم المعدة كحل سريع ونتائجه مضمونة في حالات السمنة، ولكن بعد اتمام العملية عادة ما يعاني البعض من مشكلة ترهل الجلد الزائد، مما يؤثر على المظهر العام،ولكن هل تعرف ان هناك أسباب عديدة تسبب ترهل الجلد؟</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">تقول الدكتورة سلمى يوسف البرقاوي استشاري الأمراض الجلدية والتجميل والليزر بالمملكة العربية السعودية، أن هناك مشكلة نواجهها نحن أطباء الجلدية في حالات التكميم لعدة أسباب:</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;١-تغيرات بسبب نزول الوزن</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;٢- تغيرات بسبب طبيعة الغذاء</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;٣- تغيرات بسبب مضاعفات العملية</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;٤- تغيرات أماكن جروح العملية .</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">أولا:<a class=\\\"kwhd\\\" href=\\\"https://www.masrawy.com/howa_w_hya/Tag/1062831/%D8%AA%D8%BA%D9%8A%D8%B1%D8%A7%D8%AA-%D8%A7%D9%84%D8%AC%D9%84%D8%AF#bodykeywords\\\" style=\\\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); appearance: none; text-decoration-line: none; color: #7b1fa2; transition: all 0.2s ease-in-out 0s; cursor: pointer; position: relative;\\\">&nbsp;تغيرات الجلد&nbsp;</a>بسبب نزول الوزن ينتج عنها</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-ترهل الوجه والرقبة</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">- ضمور الخدود</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-ضمور منطقة الصدغين.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-ترقق الجلد.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-زيادة الهالات حول العين.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-الجلد الزائد المترهل في البطن واليدين والساقين.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">ثانيا:<a class=\\\"kwhd\\\" href=\\\"https://www.masrawy.com/howa_w_hya/Tag/1062831/%D8%AA%D8%BA%D9%8A%D8%B1%D8%A7%D8%AA-%D8%A7%D9%84%D8%AC%D9%84%D8%AF#bodykeywords\\\" style=\\\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); appearance: none; text-decoration-line: none; color: #7b1fa2; transition: all 0.2s ease-in-out 0s; cursor: pointer; position: relative;\\\">&nbsp;تغيرات الجلد&nbsp;</a>بسبب طبيعة الغذاء</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">- طفح الكيتو إذا كانت كميات الأكل قليلة وتحتوي على بروتين فقط.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">- الشد بسبب كثرة الاستفراغ أو الإمساك الشديد قد تسبب نقاط حول العين petechiae.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">-نقص الحديد وفيتامين د يحفز تساقط الشعر .</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">ثالثا: تغيرات بسبب تأثير عملية التكميم تتمثل في</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;-علامات التمدد.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;- السلوليت.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;- ترهل البطن واليدين.</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">&lrm;رابعًا تغيرات أماكن الجروح والعمليات</span></p>\\r\\n\\r\\n<p style=\\\"margin-left:0px; margin-right:0px; text-align:right\\\"><span style=\\\"font-size:12pt\\\">أثر عمليات التجميل لشد البطن واليدين والصدر وندباتها تكون ظاهرة بشكل كبير على الجلد وهي أحد الأنواع التي تسبب الترهل.</span></p>\", \"en\": \"<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Recently, some people have turned to gastric sleeve surgery as a quick solution with guaranteed results for obesity cases. However, after the procedure, some people usually suffer from the problem of excess sagging skin, which affects their overall appearance. But did you know that there are many reasons that cause skin sagging?</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Dr. Salma Yousuf Al-Bargawi, a consultant in dermatology, cosmetics, and laser in Saudi Arabia, says that there is a problem that dermatologists face in cases of gastric sleeve surgery for several reasons:</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Changes due to weight loss</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Changes due to dietary nature</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Changes due to complications of the procedure</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Changes in the location of the operation wounds.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">First: Skin changes due to weight loss resulting in:</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Sagging of the face and neck</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Cheek atrophy</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Atrophy of the cheekbone area</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Skin thinning</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Increased dark circles around the eyes</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Excess sagging skin in the abdomen, hands, and legs.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Second: Skin changes due to the nature of the diet include:</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Keto rash if the amounts of food are low and contain only protein.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Bruising around the eyes (petechiae) due to frequent vomiting or severe constipation.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Iron and vitamin D deficiency can stimulate hair loss.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Third: Changes due to the impact of gastric sleeve surgery include:</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Stretch marks</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Cellulite</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Sagging of the abdomen and hands</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Fourth: Changes in the location of the wounds and surgeries:</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">The effects of cosmetic surgeries to tighten the abdomen, hands, chest, and their scars can significantly appear on the skin and are one of the types that cause sagging.</span></p>\"}', '{\"ar\": \"عمليات التكميم حل سريع للسمنة لكن يسبب ترهل الجلد الزائد، وهناك أسباب أخرى عديدة تؤدي للترهل وتؤثر على المظهر العام.\", \"en\": \"Gastric sleeve helps obesity fast, but often leaves excess sagging skin. Did you know many other factors also cause skin sagging?\"}', '{\"ar\": \"د.سلمى البرقاوي\", \"en\": \"Dr. Salma Al-Bargawi\"}', 'posts/6NpMGDp5PL8P5WHGBLUaGgUrCkTnJv7nYWzk7S38.jpg', NULL, 1, 1, 1, '2023-01-19 06:12:00', '2025-08-24 13:33:36', '2025-09-28 05:22:09'),
(2, '{\"ar\": \"حجر اليشم اكتشاف مذهل لشد الوجه وتحفيز الكولاجين\", \"en\": \"Jade Stone is an amazing discovery for facial tightening and collagen stimulation.\"}', '{\"ar\": \"<p style=\\\"text-align:right\\\">انتشرت مؤخرًا ظاهرة استخدام حجر اليشم &quot;jade stone&quot; في تدليك البشرة لغرض النضارة وشد الوجه وتقليل الترهلات.</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">ما هو حجر اليشم؟</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">قالت الدكتورة سلمى يوسف البرقاوي، استشاري الأمراض الجلدية والتجميل والليزر، إن حجر اليشم &quot;قوا شا Gua Sha&quot; يعتبر من الأحجار الكريمة، التي يزعم الصينيين القدماء، أن لها خصائص سحرية في الشفاء وتخفيف الآلام وتهدئتها .</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">ويتم التسويق لأداة &quot;قوا شاه&quot; على أنها تحسن البشرة وتعالج الجلد وتشد الترهلات وتخفف علامات التقدم في السن.</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">وأضافت البرقاوي، أنه يتزامن ذلك مع قيام العديد من مصنعي مستحضرات العناية للبشرة بارفاق تلك الأداة لمنتجاتها المسؤولة عن العناية بالوجه.</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">ومن خلال عملها كأستاذ مساعد في كلية الطب جامعة الإمام محمد بن سعود بالمملكة العربية السعودية، قالت د.سلمى السؤال هنا هل أداة حجر اليشم &quot;قوا شا &quot;فعالة؟ وهل تستحق العناء؟فوائد حجر اليشم</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">وفقاً للدراسات العلمية فإن &quot;قوا شا&quot; له العديد من المميزات الهامة مثل:</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">١- يحفز الدورة الدموية مما يزيد من كمية الأكسجين والمواد المغذية للجلد مما يمكن أن يحسن صحة الجلد.</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">٢- تحفيز التصريف اللمفاوي وتقليل التورم.</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">كما أن الدراسات لا تزال لم تحسم بعض الفوائد لحجر اليشم &quot;قوا شا&quot; مثل:</p>\\r\\n\\r\\n<ul>\\r\\n\\t<li style=\\\"text-align: right;\\\">تخفيف الآلام المزمنة للعظام او العضلات.</li>\\r\\n\\t<li style=\\\"text-align: right;\\\">&nbsp;تخفيف الالتهابات.</li>\\r\\n</ul>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\"><br />\\r\\nهل حجر اليشم قد يكون بديلا للفيلر؟</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">الجدير بالذكر أن استخدام الضغط بشكل قوي ومتكرر قد يسبب تحفيز بسيط للكولاجين ولكنه لن يعالج مشاكل الترهل التي تحتاج إجراءات مثل شد الوجه ولن يغني عن البوتكس او الفيلر لمن يحتاجه فالحجر بحد ذاته لا يحمل مفعول سحري، ولكنه في الحالات البسيطة يمكن يحل مشكلاتها.</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">ويمكن الحصول على النتائج عبر المساج والروتين، والاستمرار عليه من خلال تحفيز الدورة الدموية، لأن الحجر بحد ذاته لايغني عن الإجراءات التجميلية، ولايعالج أمراض الجلد خاصًة مشاكل البشرة مثل الالتهابات حيث قد يسبب تهيج للبشرة.</p>\", \"en\": \"<p><span style=\\\"font-size:12pt\\\"><span style=\\\"background-color:transparent; color:#222222; font-family:Arial\\\">Recently, the phenomenon of using jade stone in skin massage for the purpose of freshness, facial tightening, and reducing sagging has become widespread. What is a jade stone?</span></span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"font-size:12pt\\\"><span style=\\\"background-color:transparent; color:#222222; font-family:Arial\\\">According to Dr. Salma Youssef Al-Bargawi, a consultant in dermatology, cosmetics, and laser diseases, jade stone &quot;Gua Sha&quot; is considered a precious stone that ancient Chinese people claimed to have magical healing properties and the ability to relieve and calm pain.</span></span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">The &quot;Gua Sha&quot; tool is marketed as improving the skin, treating the skin, tightening sagging, and reducing signs of aging.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Al-Bargawi added that this coincides with many skincare manufacturers attaching this tool to their products responsible for facial care.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Through her work as an assistant professor at the College of Medicine, Imam Muhammad bin Saud University in Saudi Arabia, Dr. Salma asked the question: Is the jade stone &quot;Gua Sha&quot; tool effective?&nbsp;</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">And is it worth the effort?</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Benefits of Jade Stone</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">According to scientific studies, &quot;Gua Sha&quot; has many important benefits, such as:</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">1- Stimulating blood circulation, which increases the amount of oxygen and nutrients to the skin, which may improve skin health.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">2- Stimulating lymphatic drainage and reducing swelling.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Studies have yet to determine some of the benefits of jade stone &quot;Gua Sha,&quot; such as:</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Alleviating chronic bone or muscle pain.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Reducing inflammation.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">Can jade stone be an alternative to fillers?</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">It is worth noting that using strong and repetitive pressure may stimulate collagen to some extent, but it will not treat sagging problems that require procedures such as facelifts, and it will not replace Botox or fillers for those who need them.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">The stone itself does not have a magical effect, but it can solve simple problems. Results can be achieved through massage and routine, and by continuing to stimulate blood circulation.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#222222; font-family:Arial; font-size:12pt\\\">The stone itself does not replace cosmetic procedures, nor does it treat skin diseases, especially skin problems such as inflammation, where it may cause skin irritation.</span></p>\"}', '{\"ar\": \"انتشار استخدام حجر اليشم \\\"Gua Sha\\\" لتدليك البشرة لشد الوجه وتقليل الترهلات، لكنه لا يغني عن البوتوكس أو الفيلر ويعالج مشاكل بسيطة فقط.\", \"en\": \"Jade stone “Gua Sha” is trending for skin massage and tightening, but it only helps simple issues and can’t replace Botox or fillers.\"}', '{\"ar\": \"الدكتورة سلمى البرقاوي\", \"en\": \"Dr. Salma Al-Bargawi\"}', 'posts/aK6LSAE52ShZ3k6lKS27SbcEwfPKjJYPbbEGhbSK.jpg', NULL, 1, 3, 1, '2023-06-30 05:33:00', '2025-08-29 13:32:56', '2025-09-22 12:14:14'),
(3, '{\"ar\": \"موقف اخلاقي من عالم التجميل الدكتورة سلمي برقاوي\", \"en\": \"An ethical stance on the World of cosmetics by Dr. Salma Al-bargawi\"}', '{\"ar\": \"<p style=\\\"text-align:right\\\">!!ان أعمل في مجال التجميل وأتحدث بهذه الطريقة لا يتناقض مع رسالتي &quot;&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">لأننا كأطباء أقسمنا على ان نكون أمينين على مرضانا وأن لا نؤذيهم أو نكون مصدر الشفاء و الراحه نحن لسنا بائعين نريد ان نأخذ أكبر قدر من مال المريض.&quot;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">تقول :الدكتورة سلمى يوسف البرقاوي استشاريه سعوديه في تخصص الجلديه و التجميل والليزر&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">&quot; في عالم أضحى فيه الجمال هوس لتحقيق مقاييس شكلية معينة.. يضيع المعنى الحقيقي للجمال.. حيث معناه و قيمته العاطفيه و الوجدانيه .. ان الجمال قيمه شعوريه و ليس له وحدة قياس ..فهو نسبي .. مفهوم اعتباري .. يختلف من زمن لاخر و من تقافيه لاخري !</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">فمعايير الجمال في الثقافة اليابانية مثلاً تقاس بهدوء المرأة وانخفاض صوتها و اقتراب خطواتها و دقة حجم قدميها.. بينما نجدها في بعض قبائل أفريقيا معتمدة على طول رقبتها.. فتضع الأمهات حلقة بعد حلقة في رقبة المولودة الي ان تكبر ليجبر ذلك جسمها على التكيف وفق هذه المعايير القاسية.. كذلك تضع اليابانيات أقدام فتياتهن في قوالب معدنية صغيرة حتى لا تتعدى القياس المثالي.. و غيرها عبر التاريخ سنجد إجراءات بمثابة الأساطير الخرافية.. تنمط مفهوم الجمال الواسع و تجعل من شكل واحد و مقاييس محددة مثلاً للجميل..!!&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">لذلك ربما ليس غريباً ان يتجه العالم كله الآن لتقليد النموذج الأمريكي للجمال المثالي.. ابتسامة هوليود و شفاه انجلينا و انحناءات كيم كاردشيان.. الخ!!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">أصبحت الوجوه متشابهة.. بينما لا تشبه فقط اصحابها!!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">في هذه الحالة يصبح الجمال شئ قاسي.. يدفع الناس بشكل قهري و هيستيري أحياناً للتخلي عن خصوصية ملامحهم و بالتالي عن ذواتهم الجوهرية&nbsp; و الملامح الآمنة في هذا الغموض المنبعث من هالة الوجه الرباني.. البورتريه الذي اختاره الرب و صوره.. هذا لا يعني ان يتعايش الإنسان مع شئ غير مريح او احتياج ملح للتوازن في النسب او الحصول على انسجام مفتقد لأي سبب.. و لكن القصد هنا قولبة الملامح و الوجوه لتصبح كلها ذات السمت الآلي المصنع نفسه..!!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">وفي العيادة تأتي السيدة تطلب وجهها مثل صورة مشهور او فيلتر من فلاتر السوشيال ميديا!!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">اصبح الجميع يريد ان يصبح مثل الجميع وكأنهم نسخ متكررة من بعضهم البعض..&nbsp; ألا يبدو هذا الأمر مخيفاً؟</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">كيف ألغت الدعاية الرغبات الفردية و مسحت على أدمغة الغالبية بقبول نفس السلعة؟&quot; &rdquo;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">و هي عندما تجد البعض يروج&nbsp; لإجراءات غريبة ويعد الناس انهم سيصبحون مثل أميرات أو دمى محببة أو مثل بعض المشاهير.. تعتبره تنقيص في قدرهم وتنقيص لجمالهم الفريد و ميزتهم الخاصة!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">و تضيف :</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">&quot; يتعين على الطبيب تقييم الموقف النفسي للمراجعين&nbsp; حتى يعرف حاجته الحقيقة و دواخله النفسية التي جعلته يراجع طبيب تجميل ، لا يجدر به اخلاقياً و لا مهنياً ان يستغل هذه المرحلة النفسية الحرجة التي يمر بها البعض&hellip; او اضطراب عدم الرضا عن الشكل.. الديسمورفيا! بحيث يصبح هوس او قلق قهري يتحكم في السلوك و يسيطر بالمخاوف المتعلقة بالشكل و بمواجهة الآخرين.. في هذه الحالة يحتاج الأمر إلى متخصص نفسي..&quot;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">و ترجع هذا التشوه المهني و الأخلاقي في ممارسة مهنة نبيلة إلى :</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">للأسف نجد البعض يعمل في المجال من غير زمالة او تخصص.. و هذه مأساة أخرى و تشكل مخاطر مضافة..</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">و بعد انتشار البوتكس و الفيلر بين مختلف الطبقات و المراحل العمرية حول العالم.. حتى ان الاجراءات لم تعد تعطيهم الاكتفاء وأصبحوا يسعون للمزيد والمزيد مما ادى الى ظهور اشكال مروعة وصادمة!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">لا يرضى أحد عن نتائجها ويظل يبحث عن المزيد دون أن يجد ما يبحث عنه لأنه غير طبيعي و لا يمكن الوصول اليه .</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">وتحت مظلة الديسمورفيا نشأت أمراض جديدة اسمها زووم ديسمورفيا او&nbsp; سناب تشات ديسمورفيا !!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">يجب أن يعرف طبيب التجميل هذه الأمراض النفسية ويتعامل معها بحكمة وذكاء بما يناسب مصلحة المريض..&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">ما اود قوله بوضوح ان عالم التجميل أصبح في متناول الجميع و رغم نبل غايته الا انه للأسف أسيء استخدامه لأغراض الربح السريع والشهرة..&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">علينا جميعاً كأطباء ومراجعين ان نأخذ خطوة للوراء ونتأمل لماذا نريد عمل الإجراء التجميلي؟&nbsp; و ما هو الجمال الحقيقي فينا..؟ هل سيحسن نظرة الشخص لنفسه أم هي صيحة من صيحات الموضة يجب مواكبتها!</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">تظل في اعناقنا أمانة كبيرة في نصح المراجعين وتوجيههم ورفض ما نراه غير مناسب ويمكننا التفاوض وشرح ما نراه مناسباً ..</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">ترفع الدكتورة سلمى شعار المسؤولية الأخلاقية النابعة من الضمير الفردي و التقييم الذاتي من أجل الحفاظ على الشرف المهني و الواجب الإنساني..&nbsp;</p>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">&quot; في الختام أود أن أقول ان الطبيب يقع على عاتقه مسؤولية عظيمة يجب أن يخاف الله فيها ويتحتم عليه أن يرفض ما يراه غير مقبول حتى وان قبله طبيب اخر.. يكفيك شرفاً ان تقول لا وتسمو بخلقك وأدبك واحترام أداب مهنتك وقسمك الذي اقسمته على نفسك ..&quot;</p>\", \"en\": \"<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">I working in the field of cosmetics and speaking in this manner does not contradict with my mission!!</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">As doctors, we have sworn to be honest with our patients and not to harm them or be a source of healing and comfort.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">We are not salespeople who want to take the most money from the patient,&quot; says Dr. Salma Youssef&nbsp; Al-bargawi, a Saudi consultant in dermatology, cosmetics, and lasers.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">&quot;In a world where beauty has become an obsession to achieve certain aesthetic standards, the true meaning of beauty is lost. Its emotional and sentimental value is overlooked. Beauty is a subjective value and does not have a unit of measurement. It is a relative and subjective concept that differs from one era to another and from one culture to another!&quot;</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">In Japanese culture, for example, beauty standards are measured by a woman&#39;s calmness, low voice, small steps, and the precision of the size of her feet. While in some African tribes, it is based on the length of a woman&#39;s neck. Mothers put a ring after another on the newborn&#39;s neck until she grows up, forcing her body to adapt to these harsh standards.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Similarly, Japanese women put their daughters&#39; feet in small metal molds so that they do not exceed the ideal measurement, and throughout history, we find practices that resemble mythical legends. They narrow the wide concept of beauty and make one shape and specific standards, for example, for beauty.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Therefore, it may not be strange that the whole world is now leaning towards imitating the American model of the ideal beauty, with a Hollywood smile, Angelina&#39;s lips, and Kim Kardashian&#39;s curves, etc. Faces have become similar, not just their owners!</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">In this case, beauty becomes something harsh. People are driven in a coercive and sometimes hysterical way to abandon the privacy of their features, and thus their essential selves and safe features in this mystery emanating from the halo of the divine face.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">The portrait that the Lord has chosen and portrayed. This does not mean that a person should live with something uncomfortable or have a salt need for balance in proportions or to achieve harmony for no reason.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">But the intention here is to mold features and faces to make them all the same manufactured mechanical direction!</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">In the clinic, the lady comes asking for her face to be like a famous picture or a filter from social media filters!</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Everyone wants to become like everyone else, as if they are repeated copies of each other. Doesn&#39;t this seem scary?</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">How did advertising cancel individual desires and erase the majority&#39;s minds by accepting the same commodity?</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">When some people promote strange procedures and promise that they will become like princesses, beloved dolls, or some celebrities, it is considered a belittling of their value and a reduction of their unique beauty and special feature!</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">She adds: &quot;The doctor must evaluate the psychological situation of patients to understand their true needs and psychological state that made them seek cosmetic surgery. It is neither ethical nor professional to exploit the critical psychological stage that some people go through, or the dissatisfaction with their appearance&hellip;</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Dysmorphia! To the extent that it becomes an obsession or coercive anxiety that controls behavior and dominates fears related to appearance and facing others... In this case, it requires a psychological specialist.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">The professional and ethical distortion in practicing a noble profession can be attributed to: &quot;Unfortunately, we find some people working in the field without fellowship or specialization... and this is another tragedy and poses additional risks.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">After the spread of Botox and fillers among different age groups and stages around the world... to the extent that the procedures no longer satisfy them, and they seek more and more, which led to the emergence of terrifying and shocking forms!</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">No one is satisfied with the results and they continue to search for more without finding what they are looking for because it is unnatural and unattainable.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Under the umbrella of dysmorphia, new diseases have emerged called Zoom Dysmorphia or Snapchat Dysmorphia!!</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Cosmetic surgeons must be aware of these psychological disorders and deal with them wisely and intelligently in the patient&#39;s best interest.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">What I want to say clearly is that the world of cosmetics has become accessible to everyone, and despite its noble goal, unfortunately, it has been misused for the purpose of quick profit and fame.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">As doctors and patients, we all need to take a step back and reflect on why we want to undergo cosmetic procedures? What is the true beauty within us? Will it improve the person&#39;s self-image, or is it just a trend that we must follow?</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">We all carry a great responsibility in advising and guiding patients, and rejecting what we see as inappropriate. We can negotiate and explain what we see as suitable.</span></p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">Dr. Salma raises the slogan of ethical responsibility stemming from individual conscience and self-evaluation in order to maintain professional honor and human duty.</span></p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p><span style=\\\"background-color:transparent; color:#000000; font-family:Arial; font-size:12pt\\\">&quot;In conclusion, I would like to say that the doctor bears a great responsibility, and he must fear God in it. He must reject what he sees as unacceptable, even if another doctor accepts it. It is enough for you to have the honor to say no and elevate your character, manners, and respect for the ethics of your profession and the oath that you took upon yourself&quot;.&quot;</span></p>\"}', '{\"ar\": \"الجمال قيمة شعورية نسبية، ودور الطبيب حماية المريض من الهوس والتشويه، لا استغلاله؛ المسؤولية الأخلاقية فوق كل ربح.\", \"en\": \"Beauty is a relative feeling; doctors must protect patients from obsession and harm, upholding ethics over profit.\"}', '{\"ar\": \"د.سلمى البرقاوي\", \"en\": \"Dr. Salma Al-Bargawi\"}', 'posts/TslQJ4raWBNqdgcqfrC3MSNrwO6j185XF7PnUMGy.jpg', NULL, 1, 2, 1, '2023-05-28 15:37:00', '2025-08-29 13:38:55', '2025-09-22 12:14:14'),
(4, '{\"ar\": \"تطعيم الورم الحليمي: أهمية الوقاية من السرطان\", \"en\": \"HPV Vaccination: The Importance of Cancer Prevention\"}', '{\"ar\": \"<p>التطعيمات تعتبر واحدة من أعظم الإنجازات في مجال الصحة العامة على مر التاريخ.&nbsp;تطعيم الورم الحليمي البشري (HPV) هو أحد هذه التطعيمات التي توفر وقاية فعالة ضد أنواع محددة من السرطان، ولا سيما سرطان عنق الرحم.&nbsp;</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>&nbsp;ولكن قبل أن نسترسل عن أهمية اللقاح يجب معرفة ما هو الورم الحليمي.</p>\\r\\n\\r\\n<h2>ما هو الورم الحليمي؟</h2>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>هو فيروس ينتقل عموماً عن طريق الاتصال الجنسي، وتوجد منه أنواع عديدة.</p>\\r\\n\\r\\n<p>أنماط الفيروس الضارة:&nbsp;الأنواع 16 و18 من الفيروس الحليمي تعتبر الأكثر خطورة وتسبب سرطان عنق الرحم، السرطانات الفموية والبلعومية.</p>\\r\\n\\r\\n<h2>فعالية التطعيم:</h2>\\r\\n\\r\\n<p>الدراسات العلمية أظهرت فعالية عالية للتطعيم في الوقاية من الأنواع المسببة للسرطان بنسبة تفوق 90%.</p>\\r\\n\\r\\n<p>البلدان التي تبنت برامج تطعيم وطنية شهدت انخفاضاً ملحوظاً في حالات سرطان عنق الرحم، بالإضافة إلى انخفاض انتشار العدوى بالفيروس الحليمي البشري</p>\\r\\n\\r\\n<h2>فوائد التطعيم:</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>وقاية طويلة الأمد:</li>\\r\\n</ul>\\r\\n\\r\\n<p>التطعيم يوفر وقاية طويلة الأمد، غالباً دون الحاجة إلى جرعات تعزيزية.</p>\\r\\n\\r\\n<ul>\\r\\n\\t<li>تقليل التكاليف الصحية</li>\\r\\n</ul>\\r\\n\\r\\n<p>الوقاية من العدوى بالفيروس الحليمي تساهم في تقليل التكاليف المرتبطة بعلاج الأمراض الناتجة عنه، مما يخفض العبء على النظام الصحي.</p>\\r\\n\\r\\n<ul>\\r\\n\\t<li>تحسين جودة الحياة:</li>\\r\\n</ul>\\r\\n\\r\\n<p>&nbsp;الوقاية من السرطان تعني تقليل المعاناة والوفيات المرتبطة به، مما يساهم في تحسين جودة الحياة العامة للأفراد والمجتمع.</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<h2>الآثار الجانبية ومخاوف السلامة:</h2>\\r\\n\\r\\n<p>معظم الآثار الجانبية المرتبطة بتطعيم الورم الحليمي البشري تكون طفيفة ومؤقتة مثل الألم في موقع الحقن أو الحمى الخفيفة.</p>\\r\\n\\r\\n<p>تمت مراقبة سلامة التطعيم من خلال دراسات وأبحاث كبيرة تؤكد أمانه.</p>\\r\\n\\r\\n<h2>التوصيات العالمية:</h2>\\r\\n\\r\\n<p>منظمات الصحة العالمية والعديد من الهيئات الصحية الوطنية توصي بشدة بالتطعيم كوسيلة فعالة للوقاية من سرطان عنق الرحم وأمراض أخرى مرتبطة بالفيروس الحليمي.</p>\\r\\n\\r\\n<p>وختاماً في ضوء الأدلة القوية على الفعالية والسلامة، يجب تشجيع وزيادة الوعي بأهمية تطعيم الورم الحليمي.</p>\\r\\n\\r\\n<p>تكثيف الجهود لدمج هذا التطعيم ضمن الجداول التطعيمية الوطنية والدفع نحو تحقيق معدلات تطعيم أعلى لخلق مجتمع أكثر صحة وأماناً من مخاطر السرطان المرتبط بالفيروس الحليمي البشري.</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>يتضح من هذا السرد أن تطعيم الورم الحليمي البشري هو تطعيم هام جداً في مجال الوقاية من أنواع متعددة من السرطان، ولهذا ينبغي دعمه وتعميمه على مستوى الأفراد والمجتمع لتحقيق أقصى فائدة ممكنة.</p>\", \"en\": \"<div>\\r\\n<div>\\r\\n<div>\\r\\n<p>Vaccinations are considered one of the greatest achievements in public health throughout history. The Human Papillomavirus (HPV) vaccine is one of these vaccinations that provides effective protection against specific types of cancer, particularly cervical cancer.</p>\\r\\n\\r\\n<p>But before we elaborate on the importance of the vaccine, we must understand what HPV is.</p>\\r\\n\\r\\n<h2>What is HPV?</h2>\\r\\n\\r\\n<p>It&#39;s a virus that is generally transmitted through sexual contact, and there are many types of it.</p>\\r\\n\\r\\n<p>Harmful virus types: HPV types 16 and 18 are considered the most dangerous and cause cervical cancer, oral and pharyngeal cancers.</p>\\r\\n\\r\\n<h2>Vaccine effectiveness:</h2>\\r\\n\\r\\n<p>Scientific studies have shown high effectiveness of the vaccine in preventing cancer-causing types, with a rate exceeding 90%. Countries that have adopted national vaccination programs have seen a significant decrease in cervical cancer cases, as well as a decrease in the prevalence of HPV infection.</p>\\r\\n\\r\\n<h2>Benefits of vaccination:</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>Long-term protection: The vaccine provides long-term protection, often without the need for booster doses.</li>\\r\\n\\t<li>Reducing health costs: Preventing HPV infection contributes to reducing costs associated with treating diseases resulting from it, which reduces the burden on the health system.</li>\\r\\n\\t<li>Improving quality of life: Cancer prevention means reducing the suffering and deaths associated with it, which contributes to improving the overall quality of life for individuals and society.</li>\\r\\n</ul>\\r\\n\\r\\n<h2>Side effects and safety concerns:</h2>\\r\\n\\r\\n<p>Most side effects associated with the HPV vaccine are mild and temporary, such as pain at the injection site or mild fever. The safety of the vaccine has been monitored through large studies and research confirming its safety.</p>\\r\\n\\r\\n<h2>Global recommendations:</h2>\\r\\n\\r\\n<p>The World Health Organization and many national health bodies strongly recommend vaccination as an effective means of preventing cervical cancer and other diseases associated with HPV.</p>\\r\\n\\r\\n<p>In conclusion, in light of strong evidence of efficacy and safety, awareness of the importance of HPV vaccination should be encouraged and increased. Intensify efforts to integrate this vaccination into national immunization schedules and push towards achieving higher vaccination rates to create a healthier and safer society from the risks of HPV-related cancer.</p>\\r\\n\\r\\n<p>It is clear from this narrative that the HPV vaccine is a very important vaccination in the field of prevention of multiple types of cancer, and therefore it should be supported and generalized at the individual and community level to achieve the maximum possible benefit.</p>\\r\\n</div>\\r\\n</div>\\r\\n</div>\"}', '{\"ar\": \"لقاح HPV يحمي من سرطان عنق الرحم وأنواع سرطانية أخرى بفعالية تفوق 90%، آمن وآثاره الجانبية بسيطة، ويوصى به عالميًا للوقاية.\", \"en\": \"The HPV vaccine prevents cervical and other cancers with over 90% effectiveness, is safe with mild side effects, and is globally recommended.\"}', '{\"ar\": \"د.سلمى البرقاوي\", \"en\": \"Dr. Salma Al-Bargawi\"}', 'posts/AdrXbcoIs2iKhIZ9Kato3x0fUKlMAp8Z8OmmFDeb.jpg', NULL, 1, 4, 1, '2024-09-05 03:41:00', '2025-08-29 13:42:25', '2025-09-22 12:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `slug` varchar(255) NOT NULL,
  `summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`summary`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `budget` decimal(12,2) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `meta`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '2025-08-22 17:15:21', '2025-08-22 17:15:21'),
(5, 'Sub-Admin', NULL, '2025-09-04 21:56:16', '2025-09-04 21:56:16'),
(7, 'SuperAdmin', NULL, '2025-10-02 06:20:01', '2025-10-02 06:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 214),
(1, 215),
(1, 216),
(1, 217),
(1, 218),
(1, 219),
(1, 220),
(1, 221),
(1, 222),
(1, 223),
(1, 224),
(1, 225),
(1, 226),
(1, 227),
(1, 228),
(1, 311),
(1, 312),
(1, 313),
(1, 314),
(2, 101),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 106),
(2, 108),
(2, 110),
(2, 113),
(2, 114),
(2, 115),
(2, 116),
(2, 117),
(2, 118),
(2, 119),
(2, 120),
(2, 121),
(2, 123),
(2, 125),
(2, 128),
(2, 129),
(2, 130),
(2, 131),
(2, 132),
(2, 133),
(2, 134),
(2, 135),
(2, 136),
(2, 137),
(2, 138),
(2, 139),
(2, 140),
(2, 141),
(2, 142),
(2, 143),
(2, 144),
(2, 145),
(2, 146),
(2, 147),
(2, 148),
(2, 149),
(2, 150),
(2, 151),
(2, 152),
(2, 153),
(2, 154),
(2, 155),
(2, 156),
(2, 157),
(2, 158),
(2, 159),
(2, 160),
(2, 161),
(2, 162),
(2, 163),
(2, 164),
(2, 165),
(2, 166),
(2, 167),
(2, 168),
(2, 169),
(2, 170),
(2, 171),
(2, 172),
(2, 173),
(2, 174),
(2, 175),
(2, 176),
(2, 177),
(2, 178),
(2, 179),
(2, 180),
(2, 181),
(2, 182),
(2, 183),
(2, 184),
(2, 185),
(2, 186),
(2, 187),
(2, 188),
(2, 189),
(2, 190),
(2, 191),
(2, 192),
(2, 193),
(2, 214),
(2, 215),
(2, 216),
(2, 217),
(2, 218),
(2, 219),
(2, 220),
(2, 221),
(2, 223),
(2, 224),
(2, 225),
(2, 226),
(2, 227),
(2, 228),
(2, 229),
(2, 230),
(2, 231),
(2, 232),
(2, 233),
(2, 234),
(3, 101),
(3, 102),
(3, 103),
(3, 104),
(3, 105),
(3, 106),
(3, 108),
(3, 110),
(3, 123),
(3, 125),
(3, 128),
(3, 129),
(3, 130),
(3, 131),
(3, 132),
(3, 133),
(3, 177),
(3, 178),
(3, 179),
(3, 180),
(3, 181),
(3, 182),
(3, 193),
(3, 214),
(3, 215),
(3, 216),
(3, 217),
(3, 218),
(3, 219),
(3, 220),
(3, 221),
(4, 101),
(4, 102),
(4, 103),
(4, 104),
(4, 105),
(4, 106),
(4, 108),
(4, 110),
(4, 113),
(4, 114),
(4, 115),
(4, 116),
(4, 117),
(4, 118),
(4, 119),
(4, 120),
(4, 121),
(4, 123),
(4, 125),
(4, 128),
(4, 129),
(4, 130),
(4, 131),
(4, 132),
(4, 133),
(4, 134),
(4, 135),
(4, 136),
(4, 137),
(4, 138),
(4, 139),
(4, 140),
(4, 141),
(4, 142),
(4, 143),
(4, 144),
(4, 145),
(4, 146),
(4, 147),
(4, 148),
(4, 149),
(4, 150),
(4, 151),
(4, 152),
(4, 193),
(4, 214),
(4, 215),
(4, 216),
(4, 217),
(4, 218),
(4, 219),
(4, 220),
(4, 221),
(4, 222),
(4, 223),
(4, 224),
(4, 225),
(4, 226),
(4, 227),
(4, 228),
(5, 101),
(5, 102),
(5, 103),
(5, 104),
(5, 105),
(5, 106),
(5, 107),
(5, 108),
(5, 109),
(5, 110),
(5, 111),
(5, 112),
(5, 113),
(5, 114),
(5, 115),
(5, 116),
(5, 117),
(5, 118),
(5, 119),
(5, 120),
(5, 121),
(5, 123),
(5, 125),
(5, 128),
(5, 129),
(5, 130),
(5, 131),
(5, 132),
(5, 133),
(5, 134),
(5, 135),
(5, 136),
(5, 137),
(5, 138),
(5, 139),
(5, 140),
(5, 141),
(5, 142),
(5, 143),
(5, 144),
(5, 145),
(5, 146),
(5, 147),
(5, 148),
(5, 149),
(5, 150),
(5, 151),
(5, 152),
(5, 153),
(5, 154),
(5, 155),
(5, 156),
(5, 157),
(5, 158),
(5, 159),
(5, 160),
(5, 161),
(5, 162),
(5, 169),
(5, 170),
(5, 171),
(5, 172),
(5, 173),
(5, 174),
(5, 175),
(5, 176),
(5, 177),
(5, 178),
(5, 179),
(5, 180),
(5, 181),
(5, 182),
(5, 183),
(5, 184),
(5, 185),
(5, 186),
(5, 187),
(5, 188),
(5, 189),
(5, 190),
(5, 191),
(5, 192),
(5, 193),
(5, 214),
(5, 215),
(5, 216),
(5, 217),
(5, 218),
(5, 219),
(5, 220),
(5, 221),
(5, 223),
(5, 224),
(5, 225),
(5, 226),
(5, 227),
(5, 228),
(5, 229),
(5, 230),
(5, 231),
(5, 232),
(5, 233),
(5, 234),
(5, 311),
(5, 312),
(5, 313),
(5, 314),
(7, 311),
(7, 312),
(7, 313),
(7, 314);

-- --------------------------------------------------------

--
-- Table structure for table `section_headers`
--

CREATE TABLE `section_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `eyebrow` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`eyebrow`)),
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_headers`
--

INSERT INTO `section_headers` (`id`, `slug`, `eyebrow`, `title`, `description`, `icon`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'services', '{\"ar\": null, \"en\": null}', '{\"ar\": \"خدماتنا\", \"en\": \"Our Services\"}', '{\"ar\": \"نقدّم لكِ أحدث خدمات التجميل والعناية بالبشرة لنبرز جمالك الطبيعي بثقة وأمان.\", \"en\": \"We offer the latest beauty and skincare treatments to highlight your natural beauty with confidence and safety.\"}', NULL, 0, 1, '2025-08-26 17:15:51', '2025-08-26 17:22:50'),
(3, 'blogs', '{\"ar\": null, \"en\": null}', '{\"ar\": \"أحدث المقالات والأخبار\", \"en\": \"The latest articles and news\"}', '{\"ar\": \"تابع أحدث التطورات في عالم جراحة التجميل والنصائح الطبية من خبرائنا\", \"en\": \"Follow the latest in cosmetic surgery and medical advice from our experts.\"}', NULL, 0, 1, '2025-08-26 18:37:06', '2025-09-10 06:45:14'),
(4, 'testimonials', '{\"ar\": null, \"en\": null}', '{\"ar\": \"آراء عملائنا\", \"en\": \"Client Testimonials\"}', '{\"ar\": \"اكتشف ما يقوله عملاؤنا عن تجربتهم معنا والنتائج المذهلة التي حققناها معاً\", \"en\": \"Discover what our clients say about their experience with us and the amazing results we’ve achieved together.\"}', NULL, 0, 1, '2025-08-26 18:43:28', '2025-08-26 18:43:28'),
(5, 'video', '{\"ar\": null, \"en\": null}', '{\"ar\": \"آخر الفيديوهات من خبرائنا\", \"en\": \"Video\"}', '{\"ar\": \"شاهد أبرز التطورات والنصائح الطبية مباشرة عبر فيديوهاتنا.\", \"en\": \"Watch our videos to learn more about our services and advanced techniques.\"}', NULL, 0, 1, '2025-08-26 18:45:43', '2025-08-30 11:57:19'),
(6, 'appointment', '{\"ar\": null, \"en\": null}', '{\"ar\": \"احجز موعدك الآن\", \"en\": \"Book your appointment now\"}', '{\"ar\": \"احجز استشارتك المجانية معنا وابدأ رحلتك نحو الجمال الطبيعي والثقة بالنفس\", \"en\": \"Book with us and start your journey towards natural beauty and self-confidence.\"}', NULL, 0, 1, '2025-08-27 19:45:36', '2025-08-27 19:45:36'),
(7, 'contact', '{\"ar\": null, \"en\": null}', '{\"ar\": \"تواصل معنا\", \"en\": \"Contact Us\"}', '{\"ar\": \"نحن هنا للإجابة على جميع استفساراتك وتقديم أفضل خدمة ممكنة لك\", \"en\": \"We are here to answer all your inquiries and provide you with the best possible service.\"}', NULL, 0, 1, '2025-09-01 06:28:13', '2025-09-01 19:34:21'),
(8, 'reels', '{\"ar\": null, \"en\": null}', '{\"ar\": \"الريلز\", \"en\": \"Reels\"}', '{\"ar\": \"مقاطع قصيرة عمودية لعرض أبرز اللقطات والنصائح.\", \"en\": \"Short vertical clips showcasing tips and highlights.\"}', NULL, 0, 1, '2025-09-03 16:39:58', '2025-09-03 16:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`meta_title`)),
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_description`)),
  `og_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`og_title`)),
  `og_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`og_description`)),
  `slug` varchar(255) NOT NULL,
  `canonical` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `robots_index` tinyint(1) NOT NULL DEFAULT 1,
  `robots_follow` tinyint(1) NOT NULL DEFAULT 1,
  `robots_extra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`robots_extra`)),
  `twitter_card` varchar(255) NOT NULL DEFAULT 'summary_large_image',
  `schema_type` varchar(255) NOT NULL DEFAULT 'webpage',
  `schema_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_json`)),
  `hreflang` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`hreflang`)),
  `changefreq` varchar(255) DEFAULT NULL,
  `priority` decimal(2,1) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `meta_title`, `meta_description`, `og_title`, `og_description`, `slug`, `canonical`, `og_image`, `robots_index`, `robots_follow`, `robots_extra`, `twitter_card`, `schema_type`, `schema_json`, `hreflang`, `changefreq`, `priority`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"الدكتورة سلمى البرقاوي\", \"en\": \"Dr. Salma El Bargawi\"}', '{\"ar\": \"د. سلمى البرقاوي، استشارية جلدية وليزر وتجميل، أستاذ مساعد بجامعة الإمام محمد بن سعود، بخبرة تفوق 12 عامًا في طب التجميل.\", \"en\": \"Dr. Salma El Bargawi, Dermatology, Laser & Aesthetics Consultant, Assistant Professor at Imam Muhammad Ibn Saud University, with over 12 years of experience in aesthetic medicine.\"}', '{\"ar\": \"الموقع الرسمي للدكتورة سلمى البرقاوي\", \"en\": \"The official website of Dr. Salma El Bargawi\"}', '{\"ar\": \"د. سلمى البرقاوي، استشارية جلدية وليزر وتجميل، أستاذ مساعد بجامعة الإمام محمد بن سعود، بخبرة تفوق 12 عامًا في طب التجميل.\", \"en\": \"Dr. Salma El Bargawi, Dermatology, Laser & Aesthetics Consultant, Assistant Professor at Imam Muhammad Ibn Saud University, with over 12 years of experience in aesthetic medicine.\"}', 'home', NULL, 'seo/7IhxWPY9t5fl8iTaO6zAFeBcciyPBZr5pEegqLGf.jpg', 1, 1, '[]', 'summary_large_image', 'custom', '[]', '[]', NULL, NULL, 0, 1, '2025-08-25 22:22:21', '2025-09-15 16:59:53'),
(2, '{\"ar\": \"المدونة\", \"en\": \"blog\"}', '{\"ar\": \"تابع أحدث التطورات في عالم جراحة التجميل والنصائح الطبية من خبرائنا\", \"en\": \"Follow the latest in cosmetic surgery and medical advice from our experts.\"}', '{\"ar\": \"المدونة\", \"en\": \"blog\"}', '{\"ar\": \"تابع أحدث التطورات في عالم جراحة التجميل والنصائح الطبية من خبرائنا\", \"en\": \"Follow the latest in cosmetic surgery and medical advice from our experts.\"}', 'blog', NULL, 'seo/dYhgDCzrMr341MBiCtSb91ui18GQ6E4zwXvfg2o9.jpg', 1, 1, '[]', 'summary_large_image', 'webpage', NULL, NULL, NULL, NULL, 0, 1, '2025-08-29 23:57:04', '2025-08-29 23:57:04'),
(3, '{\"ar\": \"آخر الفيديوهات من خبرائنا\", \"en\": \"Latest Videos from Our Experts\"}', '{\"ar\": \"شاهد أبرز التطورات والنصائح الطبية مباشرة عبر فيديوهاتنا.\", \"en\": \"Watch the latest developments and medical tips directly through our videos.\"}', '{\"ar\": \"آخر الفيديوهات من خبرائنا\", \"en\": \"Latest Videos from Our Experts\"}', '{\"ar\": \"شاهد أبرز التطورات والنصائح الطبية مباشرة عبر فيديوهاتنا.\", \"en\": \"Watch the latest developments and medical tips directly through our videos.\"}', 'video', NULL, 'seo/BH30HvVKUgUTqDYB22N3SSkgq2LOF4TqPoEI0FYz.jpg', 1, 1, '[]', 'summary_large_image', 'webpage', NULL, NULL, NULL, NULL, 0, 1, '2025-08-30 11:53:36', '2025-08-30 11:53:36'),
(4, '{\"ar\": \"services\", \"en\": \"services\"}', '{\"ar\": \"services\", \"en\": \"services\"}', '{\"ar\": \"services\", \"en\": \"services\"}', '{\"ar\": \"services\", \"en\": \"services\"}', 'services', NULL, 'seo/UF6vslPoeFYL7yTwAtjrU8e62srcYv4FSZQnMkfz.jpg', 1, 1, '[]', 'summary_large_image', 'webpage', NULL, NULL, NULL, NULL, 0, 1, '2025-08-30 13:09:57', '2025-08-30 13:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `icon`, `pdf`, `link`, `features`, `social_links`, `tags`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"حقن البوتوكس\", \"en\": \"Botox injections\"}', '{\"ar\": \"<p>في عيادتنا نؤمن أن الجمال الطبيعي هو سر الثقة بالنفس، لذلك نقدم لك خدمة <strong>حقن البوتوكس</strong> كأحد أحدث الحلول التجميلية غير الجراحية التي تساعد على استعادة نضارة بشرتك ومظهرك الشاب.</p>\\r\\n\\r\\n<p>البوتوكس عبارة عن مادة آمنة معتمدة عالميًا تُحقن في مناطق محددة من الوجه لتقليل انقباض العضلات المسببة لظهور التجاعيد وخطوط التعبير. ومع مرور الوقت، ومع تكرار هذه الانقباضات، تبدأ الخطوط الدقيقة والعميقة في الظهور، مثل:</p>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>التجاعيد بين الحاجبين.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>الخطوط الأفقية في الجبهة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>التجاعيد حول العينين (أقدام الغراب).</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<p>وهنا يأتي دور البوتوكس ليعمل على إرخاء تلك العضلات، فيمنح بشرتك مظهرًا أكثر نعومة، ويقلل من علامات التقدم في العمر، لتستعيدي شبابك وإشراقتك من جديد.</p>\\r\\n\\r\\n<h2>مميزات حقن البوتوكس لدينا:</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>إجراء غير جراحي لا يحتاج إلى وقت طويل أو فترة نقاهة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>جلسة سريعة تستغرق ما بين 10 إلى 20 دقيقة فقط.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>نتائج طبيعية تبدأ في الظهور خلال أيام قليلة وتستمر لعدة أشهر.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>استخدام مواد أصلية وآمنة معتمدة من كبرى الهيئات الطبية العالمية.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>إشراف أطباء متخصصين ذوي خبرة طويلة في مجال التجميل.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2>لماذا تختار عيادتنا؟</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>نهتم أولاً وأخيرًا بسلامتك وراحتك.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>نوفر استشارات شخصية لكل مريض لتحديد المناطق الأنسب للحقن وتحقيق أفضل النتائج.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>نلتزم بالمعايير الطبية العالمية لضمان تجربة آمنة ومرضية.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>نركز على منحك مظهرًا طبيعيًا يعكس جمالك الحقيقي، بعيدًا عن المبالغة.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<p>✨ مع حقن البوتوكس في عيادتنا، ستتمكن من الاستمتاع بمظهر أكثر شبابًا، بشرة ناعمة خالية من التجاعيد، وثقة متجددة بنفسك كل يوم.</p>\\r\\n\\r\\n<p>&nbsp;</p>\", \"en\": \"<p>At our clinic, we believe that natural beauty is the true key to self-confidence. That&rsquo;s why we offer <strong>Botox injections</strong> as one of the latest non-surgical cosmetic solutions that help restore the freshness of your skin and a youthful appearance.</p>\\r\\n\\r\\n<p>Botox is a safe, globally approved substance injected into specific areas of the face to reduce the contraction of muscles responsible for wrinkles and expression lines. Over time, and with repeated contractions, fine and deep lines begin to appear, such as:</p>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>Frown lines between the eyebrows.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>Horizontal forehead lines.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>Crow&rsquo;s feet wrinkles around the eyes.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<p>This is where Botox plays its role&mdash;relaxing those muscles, giving your skin a smoother look, and reducing the signs of aging, helping you regain your youthful glow.</p>\\r\\n\\r\\n<h3>Benefits of Botox Injections with Us:</h3>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>A non-surgical procedure requiring no long recovery time.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>A quick session lasting only 10 to 20 minutes.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>Natural results that appear within a few days and last for several months.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>Use of original, globally approved safe materials.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>Supervised by highly experienced cosmetic doctors.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h3>Why Choose Our Clinic?</h3>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p>Your safety and comfort are always our top priority.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>We provide personalized consultations for every patient to determine the most suitable areas for injection and ensure the best results.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>We adhere to global medical standards to guarantee a safe and satisfying experience.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p>We focus on giving you a natural look that reflects your true beauty&mdash;without exaggeration.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<p>✨ With Botox injections at our clinic, you can enjoy a more youthful appearance, smoother skin free from wrinkles, and renewed confidence every day.</p>\"}', 'services/images/999YzCO38LRzvsQQr9MSLKpa9XCtE4dgbuMjaPOM.png', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2025-08-24 14:04:59', '2025-09-22 12:56:52'),
(2, '{\"ar\": \"حقن الفيلر\", \"en\": \"Filler injection\"}', '{\"ar\": \"<h1 style=\\\"text-align:right\\\">الفيلر: سر الجمال الطبيعي بدون جراحة</h1>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">يُعد الفيلر من أشهر الإجراءات التجميلية غير الجراحية التي لاقت إقبالًا واسعًا في السنوات الأخيرة، نظرًا لنتائجه السريعة وفعاليته العالية في تحسين مظهر البشرة. يعتمد هذا الإجراء على حقن مواد مالئة أسفل الجلد، تعمل على ملء الفراغات واستعادة الحجم المفقود، مما يمنح الوجه مظهرًا أكثر حيوية وشبابًا.</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">ما هو الفيلر؟</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">الفيلر هو عبارة عن مادة آمنة يتم حقنها تحت الجلد لتعبئة الفراغات والتجاعيد الدقيقة والعميقة، إلى جانب تحسين الشكل والتركيبة الجمالية للبشرة..</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">مميزات الفيلر</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>إجراء غير جراحي:</strong> لا يحتاج إلى عمليات جراحية أو فترة نقاهة طويلة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>نتائج فورية:</strong> يمكن ملاحظة الفرق مباشرة بعد الجلسة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>متعدد الاستخدامات:</strong> يُستخدم لتكبير الشفاه، تحديد الفك والخدود، علاج الهالات السوداء، والتقليل من التجاعيد.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>بديل للجراحة:</strong> قد يكون خيارًا مثاليًا بدلًا من بعض الإجراءات التجميلية الجراحية.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">المناطق الشائعة لحقن الفيلر</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\">الشفاه لزيادة الامتلاء وإبراز الشكل.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\">الخدود لإعطائها مظهرًا أكثر امتلاءً وشبابًا.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\">تحت العينين لعلاج الهالات والانتفاخات.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\">خطوط الابتسامة والتجاعيد حول الفم.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">هل الفيلر آمن؟</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">الفيلر من الإجراءات التجميلية الآمنة إذا أُجري على يد طبيب مختص باستخدام مواد معتمدة، إلا أنه قد تظهر بعض الآثار الجانبية البسيطة مثل التورم أو الاحمرار، وغالبًا ما تختفي خلال أيام قليلة.</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">الخلاصة</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">الفيلر هو الحل الأمثل لكل من يبحث عن استعادة ملامح الشباب بشكل طبيعي وسريع وبدون تدخل جراحي. فهو لا يمنح فقط تحسينًا في المظهر، بل يضيف لمسة من الثقة بالنفس والإشراق.</p>\", \"en\": \"<h1>Fillers: The Secret to Natural Beauty Without Surgery</h1>\\r\\n\\r\\n<p>Fillers are among the most popular non-surgical cosmetic procedures that have gained wide popularity in recent years due to their quick results and high effectiveness in enhancing skin appearance. This procedure involves injecting safe filling substances beneath the skin to restore lost volume and smooth out hollows, giving the face a more youthful and refreshed look.</p>\\r\\n\\r\\n<h2>What Are Fillers?</h2>\\r\\n\\r\\n<p>Fillers are safe substances injected under the skin to fill fine and deep wrinkles and restore volume, while also improving the overall shape and aesthetic texture of the skin. The most commonly used type is hyaluronic acid, a natural substance found in the body that helps hydrate the skin and maintain its vitality.</p>\\r\\n\\r\\n<h2>Benefits of Fillers</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p><strong>Non-surgical:</strong> No need for invasive surgery or a long recovery period.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Immediate results:</strong> Visible improvements can be noticed right after the session.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Versatile uses:</strong> Effective for lip augmentation, jawline and cheek contouring, under-eye dark circles, and reducing wrinkles.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Alternative to surgery:</strong> Can be an ideal option instead of certain surgical cosmetic procedures.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2>Common Areas for Filler Injections</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p><strong>Lips:</strong> To enhance fullness and definition.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Cheeks:</strong> To restore volume and create a youthful look.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Under the eyes:</strong> To reduce dark circles and puffiness.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Smile lines and wrinkles:</strong> Around the mouth for smoother skin.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2>Are Fillers Safe?</h2>\\r\\n\\r\\n<p>Fillers are considered safe when performed by a qualified professional using approved materials. However, minor side effects such as swelling or redness may occur, but they usually disappear within a few days.</p>\\r\\n\\r\\n<h2>Conclusion</h2>\\r\\n\\r\\n<p>Fillers are the perfect solution for anyone seeking to restore youthful features naturally, quickly, and without surgery. They not only improve appearance but also add a touch of confidence and radiance.</p>\\r\\n\\r\\n<p>&nbsp;</p>\"}', 'services/images/QG28dwYkNTHHqd51fPBYc5ph1mYZRrfCmoZOu2fD.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2025-08-29 23:22:25', '2025-09-22 12:56:52'),
(3, '{\"ar\": \"ليزر الشعر\", \"en\": \"Hair laser\"}', '{\"ar\": \"<h1 style=\\\"text-align:right\\\">إزالة الشعر بالليزر: الحل العصري للتخلص من الشعر غير المرغوب فيه</h1>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">إزالة الشعر بالليزر تُعتبر من أكثر الإجراءات التجميلية شيوعًا وانتشارًا في السنوات الأخيرة، حيث وفرت للعديد من الأشخاص حلاً فعالًا وطويل الأمد للتخلص من الشعر غير المرغوب فيه. يعتمد هذا الإجراء على توجيه شعاع ليزر مركز نحو بصيلات الشعر، مما يؤدي إلى إضعافها أو تدميرها وبالتالي منع نمو الشعر في المستقبل.</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">كيف تعمل إزالة الشعر بالليزر؟</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">الفكرة الأساسية وراء هذا الإجراء هي استهداف البصيلات المسؤولة عن نمو الشعر باستخدام طاقة ضوئية مركزة. تمتص البصيلة هذه الطاقة مما يعيق قدرتها على النمو من جديد، وبالتالي تقل كثافة الشعر تدريجيًا بعد كل جلسة.</p>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">مميزات إزالة الشعر بالليزر</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>إجراء غير جراحي:</strong> لا يحتاج إلى تدخل جراحي أو فترة نقاهة طويلة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>نتائج طويلة الأمد:</strong> يقل نمو الشعر تدريجيًا حتى الوصول إلى بشرة ناعمة لفترات طويلة.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>دقة عالية:</strong> يمكن استهداف مناطق محددة بدقة مثل الوجه، الإبطين، الساقين أو أي منطقة أخرى.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p style=\\\"text-align:right\\\"><strong>توفير الوقت والجهد:</strong> يقلل الحاجة إلى طرق إزالة الشعر التقليدية مثل الحلاقة أو الشمع.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2 style=\\\"text-align:right\\\">الخلاصة</h2>\\r\\n\\r\\n<p style=\\\"text-align:right\\\">إزالة الشعر بالليزر تُعد خيارًا مثاليًا لكل من يبحث عن حل فعال وآمن للتخلص من الشعر غير المرغوب فيه بشكل طويل الأمد. فهي تمنح البشرة نعومة وإشراقًا، وتوفر راحة أكبر مقارنة بالطرق التقليدية.</p>\", \"en\": \"<h1>Laser Hair Removal: The Modern Solution for Unwanted Hair</h1>\\r\\n\\r\\n<p>Laser hair removal has become one of the most common and widely used cosmetic procedures in recent years, offering many people an effective and long-lasting solution to get rid of unwanted hair. This procedure works by directing a concentrated laser beam at the hair follicles, which weakens or destroys them, preventing future hair growth.</p>\\r\\n\\r\\n<h2>How Does Laser Hair Removal Work?</h2>\\r\\n\\r\\n<p>The basic principle behind this procedure is targeting the follicles responsible for hair growth using concentrated light energy. The follicle absorbs this energy, which disrupts its ability to grow new hair. As a result, hair density gradually decreases with each session.</p>\\r\\n\\r\\n<h2>Benefits of Laser Hair Removal</h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li>\\r\\n\\t<p><strong>Non-surgical procedure:</strong> No need for surgery or extended recovery time.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Long-lasting results:</strong> Hair growth decreases progressively, leading to smooth skin for long periods.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>High precision:</strong> Specific areas can be treated accurately, such as the face, underarms, legs, or any other area.</p>\\r\\n\\t</li>\\r\\n\\t<li>\\r\\n\\t<p><strong>Time and effort saving:</strong> Reduces the need for traditional hair removal methods like shaving or waxing.</p>\\r\\n\\t</li>\\r\\n</ul>\\r\\n\\r\\n<h2>Conclusion</h2>\\r\\n\\r\\n<p>Laser hair removal is an ideal option for anyone seeking a safe and effective long-term solution to unwanted hair. It provides smoother, more radiant skin while offering greater convenience compared to traditional methods.</p>\"}', 'services/images/YpVbvCwTRQ0JWRgY9saJYguoa9pkUUa59DJbfYv8.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-08-29 23:28:48', '2025-09-22 12:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`site_name`)),
  `site_tagline` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`site_tagline`)),
  `site_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`site_description`)),
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `logo_light` varchar(255) DEFAULT NULL,
  `logo_dark` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `social` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social`)),
  `ga4_id` varchar(255) DEFAULT NULL,
  `gtm_id` varchar(255) DEFAULT NULL,
  `fb_pixel_id` varchar(255) DEFAULT NULL,
  `custom_head` longtext DEFAULT NULL,
  `custom_body` longtext DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `working_hours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`working_hours`)),
  `working_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`working_days`)),
  `google_map_embed` longtext DEFAULT NULL,
  `contact_emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contact_emails`)),
  `contact_phones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contact_phones`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_tagline`, `site_description`, `address`, `logo_light`, `logo_dark`, `favicon`, `social`, `ga4_id`, `gtm_id`, `fb_pixel_id`, `custom_head`, `custom_body`, `order`, `status`, `working_hours`, `working_days`, `google_map_embed`, `contact_emails`, `contact_phones`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Dr. Salma Al-Barqawi\",\"ar\":\"\\u0627\\u0644\\u062f\\u0643\\u062a\\u0648\\u0631\\u0629 \\u0633\\u0644\\u0645\\u0649 \\u0627\\u0644\\u0628\\u0631\\u0642\\u0627\\u0648\\u064a\"}', '{\"en\":null,\"ar\":null}', '{\"en\":\"<p>Consultant in Plastic and Reconstructive Surgery, we believe that natural beauty is the goal, and that&rsquo;s why we use the latest global techniques.....<\\/p>\",\"ar\":\"<p>......\\u0627\\u0633\\u062a\\u0634\\u0627\\u0631\\u064a \\u062c\\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644 \\u0648\\u0627\\u0644\\u062a\\u0631\\u0645\\u064a\\u0645\\u060c \\u0646\\u062d\\u0646 \\u0646\\u0624\\u0645\\u0646 \\u0628\\u0623\\u0646 \\u0627\\u0644\\u062c\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0637\\u0628\\u064a\\u0639\\u064a \\u0647\\u0648 \\u0627\\u0644\\u0647\\u062f\\u0641\\u060c \\u0648\\u0644\\u0630\\u0644\\u0643 \\u0646\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0627\\u062a \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645\\u064a\\u0629.<\\/p>\"}', '{\"en\":\"Age Clinics\",\"ar\":\"\\u0639\\u064a\\u0627\\u062f\\u0627\\u062a \\u0627\\u064a\\u062c\"}', 'sitesetting/Py3mngi714v4RvlLM2kRbiD3afPgPQvsA6puOX4Q.png', 'sitesetting/4yqMG8rizTFoMLM2tStVj0a2CfKDFqzEXFbjJLH2.png', 'sitesetting/KGtgyravQz1PuIgmuUf0hpxG7SmrLCuk2X7wSwzo.png', '{\"facebook\":null,\"twitter\":\"https:\\/\\/x.com\\/salmaalbargawi\",\"linkedin\":null,\"instagram\":\"https:\\/\\/www.instagram.com\\/drsalmabargawi\",\"youtube\":\"https:\\/\\/www.youtube.com\\/@drsalmabargawi\",\"tiktok\":\"https:\\/\\/www.tiktok.com\\/@drsalmabargawi\"}', NULL, NULL, NULL, NULL, NULL, 0, 0, '{\"en\":\"Sunday to Thursday from 12 PM to 8 PM\",\"ar\":\"\\u0627\\u0644\\u0627\\u062d\\u062f \\u0627\\u0644\\u0649 \\u0627\\u0644\\u062e\\u0645\\u064a\\u0633 \\u0645\\u0646 12 \\u0638\\u0647\\u0631 \\u0627\\u0644\\u0649 8 \\u0645\\u0633\\u0627\\u0621\"}', '{\"en\":\"30 days\",\"ar\":\"30 \\u064a\\u0648\\u0645\"}', '<iframe src=\"https://maps.google.com/maps?q=عيادات ايج&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=&amp;output=embed\" width=\"100%\" height=\"100%\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '\"drsalmabargawi@gmail.com\"', '\"+966565252737\"', '2025-08-18 15:28:35', '2025-10-02 09:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `job_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`job_title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `short_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`short_description`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `title`, `short_description`, `description`, `image`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \".\", \"en\": \".\"}', '{\"ar\": null, \"en\": null}', '{\"ar\": null, \"en\": null}', 'statistics/jP4WT5gHNIHfSNlC0QzVKtzvehgvGQH8zdJHkqus.jpg', 1, 1, '2025-08-31 11:53:40', '2025-09-08 18:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `statistics_details`
--

CREATE TABLE `statistics_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `statistics_id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL DEFAULT 0,
  `short_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`short_description`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics_details`
--

INSERT INTO `statistics_details` (`id`, `statistics_id`, `number`, `short_description`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(4, 1, 15, '{\"ar\": \"سنة خبرة\", \"en\": \"Years of experience\"}', '[]', 'statistics/icons/k5sJCFpHln28F0eKLChzD6tJ1M6cNETdG4vs0HUu.svg', '2025-08-31 12:57:22', '2025-09-08 18:47:48'),
(5, 1, 98, '{\"ar\": \"رضا العملاء\", \"en\": \"Customer satisfaction\"}', '[]', 'statistics/icons/w0lGIou6mPFqnEnN6zhugglxMXkJRaIyxhTiPQ6A.svg', '2025-08-31 13:03:01', '2025-09-08 18:47:48'),
(6, 1, 50, '{\"ar\": \"جائزة وتكريم\", \"en\": \"Award and honor\"}', '[]', 'statistics/icons/ehMRMfVH1P2HDhjDHWvmk1gjxChWZey9qbXKU1Pc.svg', '2025-08-31 13:06:08', '2025-09-08 18:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `job_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`job_title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `job_title`, `description`, `image`, `email`, `phone`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Paul Winters\",\"ar\":\"Lillian Michael\"}', '{\"en\":\"Et dolore veniam au\",\"ar\":\"Officia cum autem do\"}', '{\"en\":\"<p>jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj<\\/p>\",\"ar\":\"<p>jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj<\\/p>\"}', 'team/TpPr4YBc1NQOGhA7eYkVapBlX1qRxS4dWM8Ut8Qz.jpg', 'mozyly@mailinator.com', '+1 (122) 948-3658', 'https://www.fobezatekumeli.co', 'https://www.limapygo.us', 'https://www.lyla.org.au', 'https://www.dirutebet.info', 'https://www.netewyvukuda.cm', 78, 1, '2025-09-30 09:28:43', '2025-09-30 09:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `job_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`job_title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `service` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`service`)),
  `rating` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `job_title`, `description`, `service`, `rating`, `image`, `email`, `phone`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"نور\", \"en\": \"Noor\"}', '{\"ar\": \"صحفية\", \"en\": \"journalist\"}', '{\"ar\": \"دكتورة سلمى مثال للطبيبة الإنسانية. تعرف تمامًا الإجراء الطبي المناسب في الوقت المناسب، وتساعد المريض بإنصاف على اختيار العلاج الواقعي والمفيد. دائمًا مطلعة على كل ما هو جديد في مجالها، وهي لطيفة، ودودة، عطوفة، ومتعاونة. لا تهتم بالمكسب المادي بقدر ما تهتم بأن تجعل كل مريض مشروع نجاح لنفسه أولًا ثم لها.\", \"en\": \"Dr. Salma is an example of a humane physician. She knows exactly the appropriate medical procedure at the right time and helps the patient impartially choose the realistic and beneficial treatment. She always knows what\'s new in her field, and is kind, friendly, caring, and cooperative. She does not care about financial gain as much as she makes every patient a successful project for themselves first and then for her.\"}', '{\"ar\": \"حقن البوتوكس\", \"en\": \"Botox injections\"}', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '2025-08-23 23:24:19', '2025-09-23 09:19:21'),
(2, '{\"ar\": \"هديل\", \"en\": \"Hadeel\"}', '{\"ar\": \"ربة منزل\", \"en\": \"Housewife\"}', '{\"ar\": \"دكتورة متميزة وصادقة، إذا طلبت إجراء لست بحاجته تخبرك بذلك، وتخبرك إذا إلاجراء ضعيف الفائدة أو عديم الفائدة، اراجع عندها من 6 سنوات ما شفت منها ولا غلطة.\", \"en\": \"An excellent and honest doctor, if you request a procedure that you don\'t need, she will inform you of that, and she will also let you know if a procedure would be of little or no benefit. I have been seeing her for 6 years, and I have not seen a single mistake from her.\"}', '{\"ar\": \"حقن البوتوكس\", \"en\": \"Botox injections\"}', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-08-23 23:59:19', '2025-09-23 09:19:21'),
(3, '{\"ar\": \"فاطمة\", \"en\": \"Fatima\"}', '{\"ar\": \"ربة منزل\", \"en\": \"Housewife\"}', '{\"ar\": \"ممتازة في التشخيص ونوع العلاج والأسباب والوقاية والأسلوب الأكثر من رائع في التعامل والتخاطب مع الأخرين. شكرا للدكتورة.\", \"en\": \"Excellent in diagnosis, treatment type, causes, and prevention, with a superb approach to dealing and communicating with others. Thank you, doctor.\"}', '{\"ar\": \"حقن البوتوكس\", \"en\": \"Botox injections\"}', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2025-09-02 14:15:00', '2025-09-23 09:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `weekday` tinyint(4) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `weekday`, `start_time`, `end_time`, `capacity`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '15:00:00', '16:00:00', 1, 1, '2025-08-26 16:57:34', '2025-08-27 22:34:22'),
(2, 1, '13:00:00', '14:00:00', 1, 1, '2025-08-27 20:44:07', '2025-09-22 10:12:02'),
(3, 3, '14:00:00', '15:00:00', 1, 1, '2025-08-27 21:57:55', '2025-08-27 22:25:10'),
(4, 2, '15:00:00', '16:00:00', 1, 1, '2025-08-27 22:20:28', '2025-08-27 22:20:28'),
(5, 2, '16:00:00', '17:00:00', 1, 1, '2025-08-27 22:21:03', '2025-08-27 22:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `transformations`
--

CREATE TABLE `transformations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`description`)),
  `before_image` varchar(255) NOT NULL,
  `after_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transformations`
--

INSERT INTO `transformations` (`id`, `title`, `description`, `before_image`, `after_image`, `created_at`, `updated_at`) VALUES
(2, '{\"en\":\"Temporibus amet at\",\"ar\":\"Corrupti aut cupidi\"}', '{\"en\":\"Id sed et nobis in\",\"ar\":\"Voluptatem odit corp\"}', 'transformations/hpSNxBqaivkvP9qduW64WZ4gDUa5ZEOS9c686kUb.png', 'transformations/WhZnVYq2yThvGpm4Xd0mYQIvK3F87ScI3oMoIzE0.png', '2025-10-02 06:58:15', '2025-10-02 06:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '+201007997772', 'avatars/QU88FrIxpkYDBjGpqw1xCrvQaG4HC7BOI6nkaAo8.jpg', 1, NULL, '$2y$12$AOjU3F016f/ujSf9ix7JTuHTGxEo0xYCLaQfAfxCMHSVfgVLPDcR.', NULL, '2025-08-16 19:25:45', '2025-08-23 14:08:27'),
(5, 'Sub-Admin', 'subadmin@subadmin.com', 'subadmin@subadmin.com', 'avatars/tlZDv4Dc9Lc2WyVNviykXPMzjqjM30HsOe62HtcZ.jpg', 5, NULL, '$2y$12$RWkSleXTE3P/mGyqt/zHRuDIhYwuIFE5XZqHa/eKD00DA/zveyUTC', NULL, '2025-09-04 21:55:19', '2025-09-04 21:56:31'),
(6, 'Dr Salma', 'amkolaly86@gmail.com', '+201008052920', 'avatars/MDt4ns4iXUnkw3jTap8lETJDReDggYWXIvQQ8NTI.jpg', 1, NULL, '$2y$12$XpBAHMFtlDgndA0XCr.QZeTl0.DGXCmnaMg7b.33y9cnv9AfkBAgq', NULL, '2025-09-08 13:16:35', '2025-09-08 13:18:40'),
(7, 'Dr Salma', 'basma.khairallah@gmail.com', '+201093309941', 'avatars/sbuNotOkepWS9PFnyjsKDzL1XOckCOalz0ES68zE.jpg', NULL, NULL, '$2y$12$I3vtt810bBXQqpdedhly.uVy7n8nGoyr9QOo5tP6L/hhjttcpI3Py', NULL, '2025-09-08 13:29:04', '2025-09-08 13:29:04'),
(8, 'Philip Ramsey', 'fehubetami@mailinator.com', '+1 (204) 844-8836', 'avatars/f9FuoSBtWaSFFfNOHIEVLDSP0LCc1WPqVcP3EglZ.png', NULL, NULL, '$2y$12$opXx1q8EhlxkaSQCq9Jkc.Yo7Yc0SwbD3FgkkCmTZAI13zI.dkjnG', NULL, '2025-10-02 08:45:31', '2025-10-02 08:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(6, 1, '2025-09-08 13:16:35', '2025-09-08 13:16:35'),
(7, 1, '2025-09-08 13:29:04', '2025-09-08 13:29:04'),
(8, 5, '2025-10-02 08:45:31', '2025-10-02 08:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `edition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `video_url` varchar(1024) NOT NULL,
  `image` text DEFAULT NULL,
  `embed_code` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `edition_id`, `title`, `description`, `video_url`, `image`, `embed_code`, `category_id`, `thumbnail`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '{\"ar\": \"ما هي تقنية الأثيرا\", \"en\": \"What is Athera Technology?\"}', '{\"ar\": \"تقنية الأثيرا مع د. سلمى البرقاوي تكشف أحدث تطورات الطب التجميلي غير الجراحي لشد البشرة وتجديد الشباب بأمان وفعالية.\", \"en\": \"Athera Technology with Dr. Salma El Borkawy reveals the latest advances in non-surgical aesthetic medicine for skin tightening and safe, effective rejuvenation.\"}', '#', 'media/videos/covers/6FHxrRm243CrVVcxjHeMbdrUK0yFxEGoKPkgHpOo.png', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/BbU_FPcPhoU\" title=\"ما هي تقنية الأثيرا - مع د. سلمى البرقاوي\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 1, NULL, 3, 1, '2025-08-25 20:24:40', '2025-09-22 13:07:46'),
(2, NULL, '{\"ar\": \"سكارليت واختلاف النتائج من شخص لآخر - د. سلمى البرقاوي\", \"en\": \"Scarlet and the variation of results from one person to another – Dr. Salma El Barkawy\"}', '{\"ar\": \"سكارليت علاج تجميلي يختلف تأثيره من شخص لآخر، حيث تعتمد النتائج على طبيعة البشرة واستجابة الجسم للعلاج.\", \"en\": \"Scarlet is a cosmetic treatment with results that vary from person to person, depending on skin type and the body’s response.\"}', '#', 'media/videos/covers/31AH6fTuxTrk9K3OuZ7lQKrVAHi6VL4ZdmfStHLu.jpg', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/E_LyIpEcfyM\" title=\"سكارليت واختلاف النتائج من شخص لآخر - د. سلمى البرقاوي\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 3, NULL, 3, 1, '2025-08-30 12:13:01', '2025-09-22 13:07:46'),
(3, NULL, '{\"ar\": \"لماذا بعض آراء الاطباء مختلفة؟ - الدكتورة سلمى البرقاوي\", \"en\": \"Why do some doctors’ opinions differ? – Dr. Salma El Barkawy\"}', '{\"ar\": \"تختلف آراء الأطباء أحيانًا بسبب اختلاف الخبرات والتخصصات وظروف كل حالة، ما يجعل الرأي الطبي متنوعًا ومناسبًا لكل مريض.\", \"en\": \"Doctors’ opinions may differ due to variations in expertise, specialties, and patient conditions, ensuring tailored care for each case.\"}', '#', 'media/videos/covers/5bVrO5vshtoKxNEZFdywTpnyAUkLI4KeTPx6mrDK.jpg', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/5KzkaW2b-Po\" title=\"لماذا بعض آراء الاطباء مختلفة؟ - الدكتورة سلمى البرقاوي\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 1, NULL, 2, 1, '2025-08-30 12:17:54', '2025-09-22 13:07:46'),
(4, NULL, '{\"ar\": \"عوامل تجعلك عرضة للدغات البعوض مع د. سلمى البرقاوي\", \"en\": \"Factors that make you prone to mosquito bites with Dr. Salma El Barkawy\"}', '{\"ar\": \"بعض العوامل مثل نوع الدم، رائحة الجسم، والحرارة تجعلك أكثر عرضة للدغات البعوض، اكتشف الأسباب مع د. سلمى البرقاوي.\", \"en\": \"Factors like blood type, body odor, and heat make you more prone to mosquito bites. Learn the reasons with Dr. Salma El Barkawy.\"}', '#', 'media/videos/covers/Iqyn20XVHsOBwCbcBvmZe7ryk8JiGaWZT3aOJt0k.jpg', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/46LEvUDdyHQ\" title=\"عوامل تجعلك عرضة للدغات البعوض مع د. سلمى البرقاوي #صباح_السعودية\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 3, NULL, 1, 1, '2025-08-30 12:19:25', '2025-09-22 13:07:46'),
(5, NULL, '{\"ar\": \"أسباب حكة الأصابع في الشتاء و علاجها مع د. سلمى البرقاوي\", \"en\": \"Causes of finger itching in winter and its treatment with Dr. Salma El Barkawy\"}', '{\"ar\": \"تزداد حكة الأصابع في الشتاء بسبب الجفاف وبرودة الطقس، ويمكن علاجها بالترطيب والعناية اليومية مع نصائح د. سلمى البرقاوي.\", \"en\": \"Finger itching in winter often results from dryness and cold. Relief comes with moisturizing and care tips from Dr. Salma El Barkawy.\"}', '#', 'media/videos/covers/31pIEIf4mfUzPYVSZrbkica7qDayOqD6dPeCncXE.jpg', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/7F30tvX1_0g\" title=\"أسباب حكة الأصابع في الشتاء و علاجها  مع د. سلمى البرقاوي.\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 1, NULL, 1, 1, '2025-08-30 12:23:22', '2025-09-22 13:07:46'),
(6, NULL, '{\"ar\": \"خطر الجمال - الدكتورة سلمى البرقاوي\", \"en\": \"The Danger of Beauty – Dr. Salma El Barkawy\"}', '{\"ar\": \"خلف سعي البعض للجمال قد تكمن مخاطر صحية إذا أُهملت النصائح الطبية، اكتشف مع د. سلمى البرقاوي كيف تحافظ على جمال آمن.\", \"en\": \"Behind the pursuit of beauty may lie health risks if medical advice is ignored. Learn with Dr. Salma El Barkawy how to stay safe.\"}', '#', 'media/videos/covers/Zw7jMyVoUt8jigx46DPmFwbqutEDvrva9zYwZ2Z3.jpg', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/73dYhau1E54\" title=\"خطر الجمال - الدكتورة سلمى البرقاوي\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 3, NULL, 2, 1, '2025-08-30 12:28:18', '2025-09-22 13:07:46'),
(7, NULL, '{\"ar\": \"اسباب و علاج تساقط الشعر - الدكتورة سلمى البرقاوي قناة الاخبارية\", \"en\": \"Causes and treatment of hair loss – Dr. Salma El Barkawy, Al-Ikhbariya Channel\"}', '{\"ar\": \"تساقط الشعر له أسباب متعددة مثل الوراثة والهرمونات وسوء التغذية، وعلاجه يبدأ بالتشخيص الصحيح مع د. سلمى البرقاوي.\", \"en\": \"Hair loss can be caused by genetics, hormones, or poor nutrition. Effective treatment starts with proper diagnosis by Dr. Salma El Barkawy.\"}', '#', 'media/videos/covers/JFIxI988vbegWeLqOOkiRNrCA0fG47m74sFGQ7QK.png', '<iframe width=\"866\" height=\"487\" src=\"https://www.youtube.com/embed/A7t8kzPoiik\" title=\"اسباب و علاج تساقط الشعر - الدكتورة سلمى البرقاوي قناة الاخبارية\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 1, NULL, 4, 1, '2025-08-30 12:32:19', '2025-09-22 13:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `video_categories`
--

CREATE TABLE `video_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_categories`
--

INSERT INTO `video_categories` (`id`, `name`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\": \"مقاطع ريلز\", \"en\": \"Reels\"}', 0, 1, '2025-09-02 14:49:26', '2025-09-02 15:46:22'),
(3, '{\"ar\": \"فيديو\", \"en\": \"Videos\"}', 0, 1, '2025-09-03 15:49:46', '2025-09-03 15:49:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_service_id_foreign` (`service_id`),
  ADD KEY `appointments_preferred_date_status_service_id_index` (`preferred_date`,`status`,`service_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_slug_unique` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_status_is_read_created_at_index` (`status`,`is_read`,`created_at`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_status_start_at_index` (`status`,`start_at`),
  ADD KEY `events_order_index` (`order`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_category_id_foreign` (`category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_categories_slug_unique` (`slug`);

--
-- Indexes for table `founders`
--
ALTER TABLE `founders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `main_sliders`
--
ALTER TABLE `main_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navbar_slug_unique` (`slug`),
  ADD KEY `navbar_status_order_index` (`status`,`order`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_status_order_index` (`status`,`order`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_phone_is_active_index` (`phone`,`is_active`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_key_unique` (`key`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_status_order_index` (`status`,`order`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`),
  ADD KEY `projects_client_id_foreign` (`client_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indexes for table `section_headers`
--
ALTER TABLE `section_headers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_headers_slug_unique` (`slug`),
  ADD KEY `section_headers_status_order_index` (`status`,`order`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_pages_slug_unique` (`slug`),
  ADD KEY `seo_pages_status_order_index` (`status`,`order`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `speakers_status_order_index` (`status`,`order`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics_details`
--
ALTER TABLE `statistics_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistics_details_statistics_id_foreign` (`statistics_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transformations`
--
ALTER TABLE `transformations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_status_order_index` (`status`,`order`),
  ADD KEY `videos_edition_id_index` (`edition_id`),
  ADD KEY `videos_category_id_foreign` (`category_id`);

--
-- Indexes for table `video_categories`
--
ALTER TABLE `video_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_categories_status_order_index` (`status`,`order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `founders`
--
ALTER TABLE `founders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_sliders`
--
ALTER TABLE `main_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `section_headers`
--
ALTER TABLE `section_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `statistics_details`
--
ALTER TABLE `statistics_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transformations`
--
ALTER TABLE `transformations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `video_categories`
--
ALTER TABLE `video_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `statistics_details`
--
ALTER TABLE `statistics_details`
  ADD CONSTRAINT `statistics_details_statistics_id_foreign` FOREIGN KEY (`statistics_id`) REFERENCES `statistics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `video_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
