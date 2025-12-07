-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 10:40 PM
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
-- Database: `donation_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `CampaignID` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `TargetDana` decimal(15,2) NOT NULL,
  `DanaTerkumpul` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`CampaignID`, `user_id`, `CategoryID`, `Judul`, `Deskripsi`, `ImageURL`, `TargetDana`, `DanaTerkumpul`) VALUES
(1, 4, 1, 'Temani Pejuang Kanker Hingga Sembuh', 'Donasi Anda membantu anak-anak pejuang kanker untuk pulih dan kembali tersenyum.', 'gambar_anak7.jpg', 100000000.00, 1250000.00),
(2, 4, 1, 'Kepala Kecil Ini Menanggung Beban Berat', 'Donasi Anda meringankan beban anak pengidap hidrosefalus dan memberi harapan baru.', 'gambar_anak9.jpg', 100000000.00, 2300000.00),
(3, 4, 1, 'Satu Donasi, Satu Nyawa: Lawan Krisis Gizi Buruk Sekarang', 'Gizi buruk masih banyak terjadi di daerah pinggiran. Kondisi ini mengancam masa depan anak-anak kita. Donasi Anda sangat berarti untuk menyelamatkan mereka.', 'gambar_anak3.jpeg', 100000000.00, 800000.00);

-- --------------------------------------------------------

--
-- Table structure for table `categorycampaign`
--

CREATE TABLE `categorycampaign` (
  `CategoryCampaignID` int(11) NOT NULL,
  `NamaKategoriCampaign` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorycampaign`
--

INSERT INTO `categorycampaign` (`CategoryCampaignID`, `NamaKategoriCampaign`) VALUES
(1, 'Kesehatan'),
(2, 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `categoryfaq`
--

CREATE TABLE `categoryfaq` (
  `CategoryFaqID` int(11) NOT NULL,
  `NamaKategoriFAQ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqID` int(11) NOT NULL,
  `CategoryFaqID` int(11) NOT NULL,
  `Pertanyaan` text NOT NULL,
  `Jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `VideoURL` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` bigint(20) UNSIGNED NOT NULL,
  `CampaignID` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Jumlah` decimal(15,2) NOT NULL,
  `MetodePembayaran` varchar(50) NOT NULL,
  `StatusPembayaran` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `NamaDonatur` varchar(255) DEFAULT NULL,
  `EmailDonatur` varchar(255) DEFAULT NULL,
  `TanggalTransaksi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `CampaignID`, `user_id`, `Jumlah`, `MetodePembayaran`, `StatusPembayaran`, `NamaDonatur`, `EmailDonatur`, `TanggalTransaksi`) VALUES
(2, 1, 4, 250000.00, 'credit_card', 'success', NULL, 'atmint@gmail.com', '2025-12-04 20:03:11'),
(3, 2, 4, 1000000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 20:06:32'),
(4, 2, 4, 1000000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 20:12:50'),
(5, 2, 4, 50000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 21:09:41'),
(6, 2, 4, 250000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 21:28:49'),
(7, 3, 4, 50000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 21:28:57'),
(8, 1, 4, 1000000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 21:29:06'),
(9, 3, 4, 500000.00, 'ewallet', 'success', 'atmint', 'atmint@gmail.com', '2025-12-04 21:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `no_telp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `role`, `no_telp`, `password`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'apa', 'wilsen@gmail.com', 'member', '09988787', '$2y$12$VQTccg4SfAKJ48AEPQ.opeYksvj7SAPpcjFbdFGEcj2kd4ncmLKOS', NULL, NULL, '2025-11-24 05:48:25', '2025-11-24 05:49:19'),
(2, 'rafly', 'rafly@gmail.com', 'member', '12324546578', '$2y$12$IqufltI2WwQpC3owQlFNS.oD5f7VNgd0Q513yJ7.uoaKYXfUx1gxS', NULL, NULL, '2025-12-01 03:11:59', '2025-12-01 04:23:53'),
(3, 'rafly', 'fadlan@gmail.com', 'member', '173131313', '$2y$12$PjtDMC/TOPgsZptPDrbJI.psETngE.g8XQEyLCys/5nQXJLrpqGd2', NULL, NULL, '2025-12-03 22:05:28', '2025-12-03 22:06:23'),
(4, 'atmint', 'atmint@gmail.com', 'admin', '01802192891', '$2y$12$5qcdMXs1CSG2VlglHQ5.p./Oq1ZJDf1tYuehnCUVWsTcExLYUYqiW', NULL, NULL, '2025-12-04 11:56:25', '2025-12-04 11:56:25');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`CampaignID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `fk_campaign_user` (`user_id`);

--
-- Indexes for table `categorycampaign`
--
ALTER TABLE `categorycampaign`
  ADD PRIMARY KEY (`CategoryCampaignID`);

--
-- Indexes for table `categoryfaq`
--
ALTER TABLE `categoryfaq`
  ADD PRIMARY KEY (`CategoryFaqID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqID`),
  ADD KEY `CategoryFaqID` (`CategoryFaqID`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`),
  ADD KEY `fk_news_user` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `fk_transaction_campaign` (`CampaignID`),
  ADD KEY `fk_transaction_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `CampaignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categorycampaign`
--
ALTER TABLE `categorycampaign`
  MODIFY `CategoryCampaignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categoryfaq`
--
ALTER TABLE `categoryfaq`
  MODIFY `CategoryFaqID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categorycampaign` (`CategoryCampaignID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_campaign_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`CategoryFaqID`) REFERENCES `categoryfaq` (`CategoryFaqID`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_transaction_campaign` FOREIGN KEY (`CampaignID`) REFERENCES `campaign` (`CampaignID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_transaction_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
