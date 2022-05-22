-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 03:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xtkj`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_vacines`
--

CREATE TABLE `available_vacines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sinovec` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=tersedia , 0=tidak tersedia',
  `aztrazeneca` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=tersedia , 0=tidak tersedia',
  `prifer` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=tersedia , 0=tidak tersedia',
  `moderna` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=tersedia , 0=tidak tersedia',
  `shinnopharm` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=tersedia , 0=tidak tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `disease_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'riwayat penyakit',
  `current_symptoms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'gejala saat ini',
  `doctor_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'catatan dokter',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2022_05_21_085202_create_relation_consultations', 6),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 7),
(17, '2022_05_21_034316_create_regionals_table', 7),
(18, '2022_05_21_034642_create_societies_table', 7),
(19, '2022_05_21_035841_create_relation_societies', 7),
(20, '2022_05_21_070239_create_doctors_table', 7),
(21, '2022_05_21_075025_create_consultations_table', 7),
(22, '2022_05_21_085914_create_relation_consultations', 7),
(23, '2022_05_21_091522_create_spots_table', 7),
(24, '2022_05_21_092414_create_available_vacines_table', 8),
(25, '2022_05_21_093109_create_relation_spots', 9),
(26, '2022_05_22_033758_create_society_vacinations_table', 10),
(27, '2022_05_22_034357_create_relation_society_vacination', 11);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regionals`
--

CREATE TABLE `regionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'provinsi',
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'daerah',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regionals`
--

INSERT INTO `regionals` (`id`, `province`, `district`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Tengah', 'Pemalang', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `societies`
--

CREATE TABLE `societies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regional_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_card_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'NIK',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `born_date` date DEFAULT NULL COMMENT 'tanggal_lahir',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `societies`
--

INSERT INTO `societies` (`id`, `regional_id`, `id_card_number`, `name`, `born_date`, `gender`, `address`, `token`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, '0987654567898767', 'Rahma', '2006-04-07', 'female', 'Pemalang', NULL, '$2y$10$Z5Wf0XMltRJwv.7cniIEd.PbrVL89RyFE5vMxfQyOiCjCb/KdTznO', '2022-05-21 07:50:09', '2022-05-21 08:26:24'),
(2, 1, '4635475839405733', 'Erik Kusuma Rais', '2005-04-23', 'male', 'Pemalang', '1adf95868940851d051c868952b03e27', '$2y$10$SLCKl5s949fNAmPRuQoB4.draI07y9JnzuB4JIFjMIkUstG.R3M06', '2022-05-21 22:06:10', '2022-05-21 23:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `society_vacinations`
--

CREATE TABLE `society_vacinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `society_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spots`
--

CREATE TABLE `spots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serve` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `capacity` int(11) NOT NULL DEFAULT 10 COMMENT 'kapasitas',
  `date` date NOT NULL DEFAULT '2022-05-21' COMMENT 'tanggal buka',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_vacines`
--
ALTER TABLE `available_vacines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `available_vacines_spot_id_foreign` (`spot_id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `consultations_society_id_foreign` (`society_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `regionals`
--
ALTER TABLE `regionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `societies`
--
ALTER TABLE `societies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `societies_id_card_number_unique` (`id_card_number`),
  ADD UNIQUE KEY `societies_token_unique` (`token`),
  ADD KEY `societies_regional_id_foreign` (`regional_id`);

--
-- Indexes for table `society_vacinations`
--
ALTER TABLE `society_vacinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `society_vacinations_spot_id_foreign` (`spot_id`),
  ADD KEY `society_vacinations_society_id_foreign` (`society_id`);

--
-- Indexes for table `spots`
--
ALTER TABLE `spots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_vacines`
--
ALTER TABLE `available_vacines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regionals`
--
ALTER TABLE `regionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `societies`
--
ALTER TABLE `societies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `society_vacinations`
--
ALTER TABLE `society_vacinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spots`
--
ALTER TABLE `spots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_vacines`
--
ALTER TABLE `available_vacines`
  ADD CONSTRAINT `available_vacines_spot_id_foreign` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`id`);

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `consultations_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`id`);

--
-- Constraints for table `societies`
--
ALTER TABLE `societies`
  ADD CONSTRAINT `societies_regional_id_foreign` FOREIGN KEY (`regional_id`) REFERENCES `regionals` (`id`);

--
-- Constraints for table `society_vacinations`
--
ALTER TABLE `society_vacinations`
  ADD CONSTRAINT `society_vacinations_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`id`),
  ADD CONSTRAINT `society_vacinations_spot_id_foreign` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
