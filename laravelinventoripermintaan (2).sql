-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2026 at 10:31 AM
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
-- Database: `laravelinventoripermintaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) NOT NULL,
  `kodebarang` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `stok_minimum` int(11) NOT NULL DEFAULT 5,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kodebarang`, `nama`, `kategori`, `satuan`, `stok_minimum`, `stok`) VALUES
(7, 'BRG00007', 'Bayam', 'Sayuran', 'Pcs', 5, 0),
(8, 'BRG00008', 'Bawang', 'Bumbu', 'Pcs', 5, 0),
(9, 'BRG00009', 'ayam', 'Daging', 'Kg', 5, 0),
(10, 'BRG00010', 'Sapi', 'Daging', 'Kg', 5, 0),
(11, 'BRG00011', 'Tomat', 'Sayuran', 'Kg', 5, 0),
(12, 'BRG00012', 'Gula Pasir', 'Bumbu', 'Kg', 5, 0),
(14, 'BRG00014', 'toge', 'Sayuran', 'Pack', 5, 0),
(15, 'BRG00015', 'cabe kering', 'Sayuran', 'Kg', 5, 0),
(16, 'BRG00016', 'masako', 'Bumbu', 'Pcs', 5, 0),
(17, 'BRG00017', 'garam', 'Bumbu', 'Pcs', 5, 0),
(18, 'BRG00018', 'kecap', 'Bumbu', 'Pack', 5, 0),
(19, 'BRG00019', 'nangka', 'Sayuran', 'Pack', 5, 0),
(20, 'BRG00020', 'beras', 'Bahan Pokok', 'Karung', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `nama`) VALUES
(1, 'Cabang Sungai Jawi'),
(2, 'Cabang Siantan'),
(3, 'Cabang M.Sohor'),
(4, 'Cabang Serdam'),
(5, 'Cabang Desa Kapur'),
(6, 'Cabang Ambawang'),
(7, 'Cabang Kota Baru'),
(8, 'Cabang Jeruju');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_15_000003_create_cabang_table', 2),
(6, '2026_06_17_205437_add_barang_id_to_stokkeluardetail_table', 3),
(7, '2026_06_18_035004_add_stok_minimum_to_barang_table', 3);

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
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `cabang_id`, `user_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 'Diterima', NULL, '2026-06-15 17:45:53', '2026-06-15 17:46:31'),
(5, 1, 2, 'Diterima', 'coy', '2026-06-15 22:22:06', '2026-06-15 22:54:31'),
(6, 1, 2, 'Ditolak', 'rrr', '2026-06-15 22:59:43', '2026-06-15 23:00:20'),
(7, 1, 2, 'Diterima', 'ok', '2026-06-16 07:50:27', '2026-06-16 07:51:06'),
(8, 1, 2, 'Diterima', 'ok', '2026-06-16 07:53:21', '2026-06-16 07:53:46'),
(9, 1, 2, 'Diterima', 'boy', '2026-06-17 16:04:38', '2026-06-17 16:05:17'),
(10, 2, 5, 'Diterima', 'boyy', '2026-06-17 16:13:46', '2026-06-17 16:14:17'),
(11, 1, 2, 'Diterima', NULL, '2026-06-17 20:03:51', '2026-06-17 21:44:54'),
(12, 1, 2, 'Diterima', 'oyy cok', '2026-06-17 22:36:10', '2026-06-17 22:56:00'),
(13, 1, 2, 'Ditolak', 'woy', '2026-06-17 22:44:46', '2026-06-17 22:54:19'),
(14, 3, 6, 'Diterima', NULL, '2026-06-18 01:17:26', '2026-06-18 01:20:08'),
(15, 3, 6, 'Diterima', 'makasih', '2026-06-18 01:18:08', '2026-06-18 01:19:03'),
(16, 3, 6, 'Diterima', NULL, '2026-06-18 01:32:30', '2026-06-18 01:32:59'),
(17, 1, 2, 'Diterima', 'pliss', '2026-06-18 03:14:02', '2026-06-18 03:14:51'),
(18, 1, 2, 'Diterima', NULL, '2026-06-18 04:47:10', '2026-06-18 04:50:53'),
(19, 2, 5, 'Ditolak', 'boyyy', '2026-06-18 04:48:13', '2026-06-18 04:50:15'),
(20, 1, 2, 'Ditolak', 'lesgooo', '2026-06-18 10:43:13', '2026-06-19 14:36:26'),
(21, 3, 6, 'Diterima', 'hahah', '2026-06-18 10:44:47', '2026-06-18 13:21:10'),
(22, 1, 2, 'Diterima', 'dd', '2026-06-18 13:33:42', '2026-06-18 13:34:37'),
(23, 1, 2, 'Diterima', 'cepat boy', '2026-06-19 14:56:51', '2026-06-19 19:29:50'),
(24, 1, 2, 'Diterima', 'mintak boy', '2026-06-19 19:32:01', '2026-06-19 19:32:59'),
(25, 1, 2, 'Diterima', 'jjkkk', '2026-06-20 09:40:34', '2026-06-20 09:49:44'),
(26, 2, 5, 'Diterima', 'yaboy', '2026-06-20 09:59:57', '2026-06-20 10:00:33'),
(27, 1, 2, 'Ditolak', 'hah', '2026-06-20 10:05:33', '2026-06-20 10:06:10'),
(28, 1, 2, 'Diterima', 'fff', '2026-06-20 11:07:05', '2026-06-20 11:07:37'),
(29, 3, 6, 'Diterima', 'ya', '2026-06-20 11:54:56', '2026-06-20 11:55:23'),
(30, 1, 2, 'Diterima', 'minta ya boy', '2026-06-20 12:32:08', '2026-06-20 12:32:57'),
(31, 7, 7, 'Diterima', 'kirim ya boy', '2026-06-20 13:39:32', '2026-06-20 13:40:33'),
(32, 7, 7, 'Diterima', 'kirim boy', '2026-06-20 13:59:32', '2026-06-20 14:00:14'),
(33, 7, 7, 'Menunggu Konfirmasi', 'Haloo', '2026-06-21 11:25:02', '2026-06-21 11:25:02'),
(34, 1, 2, 'Ditolak', 'mm', '2026-06-21 15:05:05', '2026-06-21 16:12:43'),
(36, 7, 7, 'Menunggu Konfirmasi', 'pliiss', '2026-06-22 15:33:09', '2026-06-22 15:33:09'),
(37, 7, 7, 'Menunggu Konfirmasi', 'hy', '2026-06-22 15:39:46', '2026-06-22 15:39:46'),
(38, 7, 7, 'Diterima', 'hy', '2026-06-22 15:46:27', '2026-06-22 16:07:26'),
(39, 7, 7, 'Diterima', 'kirim ya boyy', '2026-06-26 14:10:50', '2026-06-26 14:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `permintaandetail`
--

CREATE TABLE `permintaandetail` (
  `id` bigint(20) NOT NULL,
  `permintaan_id` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaandetail`
--

INSERT INTO `permintaandetail` (`id`, `permintaan_id`, `barang_id`, `jumlah`) VALUES
(7, 4, 8, 20),
(8, 4, 7, 20),
(9, 5, 8, 2),
(10, 6, 7, 1),
(11, 7, 9, 50),
(12, 8, 10, 50),
(13, 9, 9, 50),
(14, 10, 9, 300),
(15, 11, 8, 5),
(16, 12, 12, 10),
(17, 13, 12, 10),
(18, 14, 19, 50),
(19, 14, 16, 50),
(20, 15, 9, 10),
(21, 16, 8, 50),
(22, 17, 7, 5),
(23, 18, 11, 50),
(24, 19, 18, 5),
(25, 20, 15, 50),
(26, 20, 12, 20),
(27, 21, 10, 30),
(28, 21, 15, 20),
(29, 21, 11, 20),
(30, 22, 19, 1),
(31, 23, 12, 15),
(32, 24, 10, 500),
(33, 25, 10, 90),
(34, 26, 17, 100),
(35, 26, 14, 50),
(36, 26, 10, 10),
(37, 27, 9, 10),
(38, 28, 9, 5),
(39, 29, 12, 50),
(40, 30, 12, 100),
(41, 30, 16, 100),
(42, 31, 20, 10),
(43, 31, 9, 20),
(44, 32, 10, 100),
(45, 32, 18, 50),
(46, 33, 10, 100),
(47, 33, 16, 30),
(48, 33, 15, 20),
(49, 34, 8, 1),
(50, 35, 16, 100),
(51, 36, 16, 100),
(52, 37, 10, 10),
(53, 38, 12, 5),
(54, 38, 16, 10),
(55, 38, 10, 15),
(56, 39, 10, 10);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('23Egf84wwpbtR0ZiwsEPhxOYiXQluFHfW8qs0EDQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQVRKTU05UjlKNXRuVWRtT21pM2Y4ck8xT0ZSTGQzbTVCVFl5cGZNaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9sYXBvcmFuL3Blcm1pbnRhYW5jYWJhbmcvcGRmIjtzOjU6InJvdXRlIjtzOjI4OiJsYXBvcmFuLnBlcm1pbnRhYW5jYWJhbmcucGRmIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1782193931),
('KNWO3clYHU6dvTB6O3G8u4fbB3iY9qfvndwI3f63', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmVyS0tOc2piYWVmNE1Jc2lpelNERzZrRVNjRW5TQlR5YmR2a3ZFcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9zdG9rY2FiYW5nP2NhYmFuZ19pZD03IjtzOjU6InJvdXRlIjtzOjE2OiJzdG9rY2FiYW5nLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1782121060),
('NFZY5CoEvweaQIy3Geupfz6E97APWAgokqleR1RJ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnV6Y1dtYzFySDhxdm5td29IRXlod1VmWkZncHdWY2VkbDBzdlBoWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9sYXBvcmFuL3N0b2ttYXN1ayI7czo1OiJyb3V0ZSI7czoxNzoibGFwb3Jhbi5zdG9rbWFzdWsiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1782134125),
('qLjKEVyp54GXGdVMGD9SaGDx6mTkWpUlOl95fJzy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3o3eFJvS3Fqek8zT1RHamNtNmNFWER1QXdqZ21zdEdJN3YzbEdwcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9sYXBvcmFuL3Blcm1pbnRhYW5jYWJhbmciO3M6NToicm91dGUiO3M6MjI6InBlcm1pbnRhYW5jYWJhbmcuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1782470443);

-- --------------------------------------------------------

--
-- Table structure for table `stokcabang`
--

CREATE TABLE `stokcabang` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokcabang`
--

INSERT INTO `stokcabang` (`id`, `cabang_id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(7, 1, 7, 15, '2026-06-15 17:44:19', '2026-06-18 03:14:51'),
(8, 2, 7, 0, '2026-06-15 17:44:19', '2026-06-15 17:44:19'),
(9, 1, 8, 17, '2026-06-15 17:44:31', '2026-06-17 21:44:54'),
(10, 2, 8, 0, '2026-06-15 17:44:31', '2026-06-15 17:44:31'),
(11, 1, 9, 105, '2026-06-16 07:40:37', '2026-06-20 11:07:37'),
(12, 2, 9, 300, '2026-06-16 07:40:37', '2026-06-17 16:14:17'),
(13, 3, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(14, 3, 8, 50, '2026-06-16 07:40:37', '2026-06-18 01:32:59'),
(15, 3, 9, 10, '2026-06-16 07:40:37', '2026-06-18 01:19:03'),
(16, 4, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(17, 4, 8, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(18, 4, 9, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(19, 5, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(20, 5, 8, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(21, 5, 9, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(22, 6, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(23, 6, 8, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(24, 6, 9, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(25, 7, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(26, 7, 8, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(27, 7, 9, 0, '2026-06-16 07:40:37', '2026-06-20 13:58:55'),
(28, 8, 7, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(29, 8, 8, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(30, 8, 9, 0, '2026-06-16 07:40:37', '2026-06-16 07:40:37'),
(31, 1, 10, 600, '2026-06-16 07:41:51', '2026-06-20 11:45:48'),
(32, 2, 10, 10, '2026-06-16 07:41:51', '2026-06-20 10:00:33'),
(33, 3, 10, 30, '2026-06-16 07:41:51', '2026-06-18 13:21:10'),
(34, 4, 10, 0, '2026-06-16 07:41:51', '2026-06-16 07:41:51'),
(35, 5, 10, 0, '2026-06-16 07:41:51', '2026-06-16 07:41:51'),
(36, 6, 10, 0, '2026-06-16 07:41:51', '2026-06-16 07:41:51'),
(37, 7, 10, 110, '2026-06-16 07:41:51', '2026-06-26 14:11:30'),
(38, 8, 10, 0, '2026-06-16 07:41:51', '2026-06-16 07:41:51'),
(39, 1, 11, 50, '2026-06-16 07:42:48', '2026-06-18 04:50:53'),
(40, 2, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(41, 3, 11, 20, '2026-06-16 07:42:48', '2026-06-18 13:21:10'),
(42, 4, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(43, 5, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(44, 6, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(45, 7, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(46, 8, 11, 0, '2026-06-16 07:42:48', '2026-06-16 07:42:48'),
(47, 1, 12, 120, '2026-06-16 07:43:23', '2026-06-20 12:32:57'),
(48, 2, 12, 0, '2026-06-16 07:43:23', '2026-06-16 07:43:23'),
(49, 3, 12, 50, '2026-06-16 07:43:23', '2026-06-20 11:55:23'),
(50, 4, 12, 0, '2026-06-16 07:43:23', '2026-06-16 07:43:23'),
(51, 5, 12, 0, '2026-06-16 07:43:23', '2026-06-16 07:43:23'),
(52, 6, 12, 0, '2026-06-16 07:43:23', '2026-06-16 07:43:23'),
(53, 7, 12, 5, '2026-06-16 07:43:23', '2026-06-22 16:07:26'),
(54, 8, 12, 0, '2026-06-16 07:43:23', '2026-06-16 07:43:23'),
(63, 1, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(64, 2, 14, 50, '2026-06-18 00:56:21', '2026-06-20 10:00:33'),
(65, 3, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(66, 4, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(67, 5, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(68, 6, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(69, 7, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(70, 8, 14, 0, '2026-06-18 00:56:21', '2026-06-18 00:56:21'),
(71, 1, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(72, 2, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(73, 3, 15, 20, '2026-06-18 00:56:55', '2026-06-18 13:21:10'),
(74, 4, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(75, 5, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(76, 6, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(77, 7, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(78, 8, 15, 0, '2026-06-18 00:56:55', '2026-06-18 00:56:55'),
(79, 1, 16, 100, '2026-06-18 00:57:43', '2026-06-20 12:32:57'),
(80, 2, 16, 0, '2026-06-18 00:57:43', '2026-06-18 00:57:43'),
(81, 3, 16, 50, '2026-06-18 00:57:43', '2026-06-18 01:20:08'),
(82, 4, 16, 0, '2026-06-18 00:57:43', '2026-06-18 00:57:43'),
(83, 5, 16, 0, '2026-06-18 00:57:43', '2026-06-18 00:57:43'),
(84, 6, 16, 0, '2026-06-18 00:57:43', '2026-06-18 00:57:43'),
(85, 7, 16, 10, '2026-06-18 00:57:43', '2026-06-22 16:07:26'),
(86, 8, 16, 0, '2026-06-18 00:57:43', '2026-06-18 00:57:43'),
(87, 1, 17, 0, '2026-06-18 00:58:09', '2026-06-18 00:58:09'),
(88, 2, 17, 100, '2026-06-18 00:58:09', '2026-06-20 10:00:33'),
(89, 3, 17, 0, '2026-06-18 00:58:09', '2026-06-18 00:58:09'),
(90, 4, 17, 0, '2026-06-18 00:58:10', '2026-06-18 00:58:10'),
(91, 5, 17, 0, '2026-06-18 00:58:10', '2026-06-18 00:58:10'),
(92, 6, 17, 0, '2026-06-18 00:58:10', '2026-06-18 00:58:10'),
(93, 7, 17, 0, '2026-06-18 00:58:10', '2026-06-18 00:58:10'),
(94, 8, 17, 0, '2026-06-18 00:58:10', '2026-06-18 00:58:10'),
(95, 1, 18, 0, '2026-06-18 00:59:11', '2026-06-18 00:59:11'),
(96, 2, 18, 0, '2026-06-18 00:59:11', '2026-06-18 00:59:11'),
(97, 3, 18, 0, '2026-06-18 00:59:11', '2026-06-18 00:59:11'),
(98, 4, 18, 0, '2026-06-18 00:59:12', '2026-06-18 00:59:12'),
(99, 5, 18, 0, '2026-06-18 00:59:12', '2026-06-18 00:59:12'),
(100, 6, 18, 0, '2026-06-18 00:59:12', '2026-06-18 00:59:12'),
(101, 7, 18, 10, '2026-06-18 00:59:12', '2026-06-23 12:23:01'),
(102, 8, 18, 0, '2026-06-18 00:59:12', '2026-06-18 00:59:12'),
(103, 1, 19, 0, '2026-06-18 01:00:14', '2026-06-19 13:49:59'),
(104, 2, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(105, 3, 19, 50, '2026-06-18 01:00:14', '2026-06-18 01:20:08'),
(106, 4, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(107, 5, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(108, 6, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(109, 7, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(110, 8, 19, 0, '2026-06-18 01:00:14', '2026-06-18 01:00:14'),
(111, 1, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(112, 2, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(113, 3, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(114, 4, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(115, 5, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(116, 6, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45'),
(117, 7, 20, 0, '2026-06-20 12:54:45', '2026-06-20 13:58:37'),
(118, 8, 20, 0, '2026-06-20 12:54:45', '2026-06-20 12:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `stokgudang`
--

CREATE TABLE `stokgudang` (
  `id` bigint(20) NOT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokgudang`
--

INSERT INTO `stokgudang` (`id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, 7, 725, '2026-06-15 17:44:19', '2026-06-20 14:02:04'),
(5, 8, 125, '2026-06-15 17:44:31', '2026-06-21 17:07:47'),
(6, 9, 865, '2026-06-16 07:40:37', '2026-06-22 20:08:15'),
(7, 10, 495, '2026-06-16 07:41:51', '2026-06-26 14:11:30'),
(8, 11, 40, '2026-06-16 07:42:48', '2026-06-18 13:21:10'),
(9, 12, 30, '2026-06-16 07:43:23', '2026-06-22 16:07:26'),
(11, 14, 50, '2026-06-18 00:56:21', '2026-06-20 10:00:33'),
(12, 15, 80, '2026-06-18 00:56:55', '2026-06-18 13:21:10'),
(13, 16, 5430, '2026-06-18 00:57:43', '2026-06-22 16:07:26'),
(14, 17, 300, '2026-06-18 00:58:09', '2026-06-20 13:43:25'),
(15, 18, 259, '2026-06-18 00:59:11', '2026-06-20 14:00:14'),
(16, 19, 300, '2026-06-18 01:00:14', '2026-06-21 18:18:49'),
(17, 20, 400, '2026-06-20 12:54:45', '2026-06-23 12:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `stokkeluar`
--

CREATE TABLE `stokkeluar` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `kodekeluar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokkeluar`
--

INSERT INTO `stokkeluar` (`id`, `cabang_id`, `user_id`, `kodekeluar`, `created_at`, `updated_at`, `catatan`) VALUES
(3, 1, 2, 'SK20260615174702', '2026-06-15 17:47:02', '2026-06-15 17:47:02', NULL),
(4, NULL, 1, 'SKG20260617163350', '2026-06-17 16:33:50', '2026-06-17 16:33:50', NULL),
(5, NULL, 1, 'SKG20260617165315', '2026-06-17 16:53:15', '2026-06-17 16:53:15', NULL),
(7, NULL, 1, 'SK-20260617-0003', '2026-06-17 17:12:37', '2026-06-17 17:12:37', 'exp'),
(8, NULL, 1, 'SK-20260617-0004', '2026-06-17 17:22:05', '2026-06-17 17:22:05', 'exp'),
(9, NULL, 1, 'SK-20260617-0005', '2026-06-17 17:56:21', '2026-06-17 17:56:21', 'exp'),
(10, NULL, 1, 'SK-20260618-0001', '2026-06-18 01:01:32', '2026-06-18 01:01:32', 'Exp'),
(11, NULL, 1, 'SK-20260618-0002', '2026-06-18 01:32:59', '2026-06-18 01:32:59', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 16)'),
(12, 1, 2, 'SK202606180003', '2026-06-18 02:38:55', '2026-06-18 02:38:55', 'Dikurangi Kasir via Modal: terjual'),
(13, 1, 2, 'SK202606180004', '2026-06-18 02:39:17', '2026-06-18 02:39:17', 'Dikurangi Kasir via Modal: terjual'),
(14, NULL, 1, 'SK-20260618-0005', '2026-06-18 03:14:51', '2026-06-18 03:14:51', 'Pengeluaran otomatis (Admin) dari permintaan disetujui (ID Permintaan: 17)'),
(15, NULL, 1, 'SK-20260618-0006', '2026-06-18 04:44:47', '2026-06-18 04:44:47', 'EXP'),
(16, NULL, 1, 'SK-20260618-0007', '2026-06-18 04:50:52', '2026-06-18 04:50:52', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 18)'),
(17, NULL, 1, 'SK-20260618-0008', '2026-06-18 13:21:10', '2026-06-18 13:21:10', 'Pengeluaran otomatis (Admin) dari permintaan disetujui (ID Permintaan: 21)'),
(18, NULL, 1, 'SK-20260618-0009', '2026-06-18 13:29:46', '2026-06-18 13:29:46', 'EXP'),
(19, NULL, 1, 'SK-20260618-0010', '2026-06-18 13:34:37', '2026-06-18 13:34:37', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 22)'),
(20, NULL, 1, 'SK-20260619-0001', '2026-06-19 13:39:39', '2026-06-19 13:39:39', 'exp'),
(21, NULL, 1, 'SK-20260619-0002', '2026-06-19 13:40:06', '2026-06-19 13:40:06', 'exp'),
(22, NULL, 1, 'SK-20260619-0003', '2026-06-19 13:40:27', '2026-06-19 13:40:27', 'exp'),
(23, 1, 2, 'SK202606190004', '2026-06-19 13:49:59', '2026-06-19 13:49:59', 'Dikurangi Kasir via Modal: s'),
(24, NULL, 1, 'SK-20260619-0005', '2026-06-19 19:29:50', '2026-06-19 19:29:50', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 23)'),
(25, NULL, 1, 'SK-20260619-0006', '2026-06-19 19:32:59', '2026-06-19 19:32:59', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 24)'),
(26, NULL, 1, 'SK-20260620-0001', '2026-06-20 09:49:44', '2026-06-20 09:49:44', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 25)'),
(27, NULL, 1, 'SK-20260620-0002', '2026-06-20 10:00:33', '2026-06-20 10:00:33', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 26)'),
(28, 1, 2, 'SK202606200003', '2026-06-20 11:05:45', '2026-06-20 11:05:45', 'Dikurangi Kasir via Modal: terjual'),
(29, 1, 1, 'SK-20260620-0004', '2026-06-20 11:07:37', '2026-06-20 11:07:37', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 28)'),
(30, 1, 2, 'SK202606200005', '2026-06-20 11:45:48', '2026-06-20 11:45:48', 'Dikurangi Kasir via Modal: terjual'),
(31, NULL, 1, 'SK-20260620-0006', '2026-06-20 11:52:57', '2026-06-20 11:52:57', 'exp'),
(32, 3, 1, 'SK-20260620-0007', '2026-06-20 11:55:23', '2026-06-20 11:55:23', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 29)'),
(33, 1, 1, 'SK-20260620-0008', '2026-06-20 12:32:57', '2026-06-20 12:32:57', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 30)'),
(34, 7, 1, 'SK-20260620-0009', '2026-06-20 13:40:33', '2026-06-20 13:40:33', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 31)'),
(35, 7, 7, 'SK202606200010', '2026-06-20 13:58:37', '2026-06-20 13:58:37', 'Dikurangi Kasir via Modal: terjual'),
(36, 7, 7, 'SK202606200011', '2026-06-20 13:58:55', '2026-06-20 13:58:55', 'Dikurangi Kasir via Modal: terjual'),
(37, 7, 1, 'SK-20260620-0012', '2026-06-20 14:00:14', '2026-06-20 14:00:14', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 32)'),
(38, NULL, 1, 'SK-20260620-0013', '2026-06-20 14:03:55', '2026-06-20 14:03:55', 'exp'),
(39, NULL, 1, 'SK-20260621-0001', '2026-06-21 18:18:49', '2026-06-21 18:18:49', 'exp'),
(40, 7, 1, 'SK-20260622-0001', '2026-06-22 16:07:26', '2026-06-22 16:07:26', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 38)'),
(41, 7, 7, 'SK202606220002', '2026-06-22 16:32:51', '2026-06-22 16:32:51', 'Dikurangi Kasir via Modal: Barang tidak sampai'),
(42, NULL, 1, 'SK-20260623-0001', '2026-06-23 12:12:56', '2026-06-23 12:12:56', 'EXP'),
(43, 7, 7, 'SK202606230002', '2026-06-23 12:19:37', '2026-06-23 12:19:37', 'Dikurangi Kasir via Modal: Terpakai'),
(44, 7, 7, 'SK202606230003', '2026-06-23 12:23:01', '2026-06-23 12:23:01', 'Dikurangi Kasir via Modal: Terpakai'),
(45, 7, 1, 'SK-20260626-0001', '2026-06-26 14:11:30', '2026-06-26 14:11:30', 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: 39)');

-- --------------------------------------------------------

--
-- Table structure for table `stokkeluardetail`
--

CREATE TABLE `stokkeluardetail` (
  `id` bigint(20) NOT NULL,
  `stokkeluar_id` bigint(20) DEFAULT NULL,
  `stokcabang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokkeluardetail`
--

INSERT INTO `stokkeluardetail` (`id`, `stokkeluar_id`, `stokcabang_id`, `jumlah`, `barang_id`) VALUES
(3, 3, 7, 10, 0),
(4, 3, 9, 10, 0),
(5, 4, 9, 8, 0),
(6, 5, 39, 30, 0),
(7, 7, NULL, 100, 12),
(8, 8, NULL, 10, 11),
(9, 9, NULL, 100, 12),
(10, 10, NULL, 90, 12),
(11, 11, NULL, 50, 8),
(12, 12, 31, 10, 10),
(13, 13, 31, 10, 10),
(14, 14, NULL, 5, 7),
(15, 15, NULL, 95, 18),
(16, 16, NULL, 50, 11),
(17, 17, NULL, 30, 10),
(18, 17, NULL, 20, 15),
(19, 17, NULL, 20, 11),
(20, 18, NULL, 45, 19),
(21, 19, NULL, 1, 19),
(22, 20, NULL, 10, 18),
(23, 21, NULL, 10, 18),
(24, 22, NULL, 1, 18),
(25, 23, 103, 1, 19),
(26, 24, NULL, 15, 12),
(27, 25, NULL, 500, 10),
(28, 26, NULL, 90, 10),
(29, 27, NULL, 100, 17),
(30, 27, NULL, 50, 14),
(31, 27, NULL, 10, 10),
(32, 28, 47, 5, 12),
(33, 29, NULL, 5, 9),
(34, 30, 31, 20, 10),
(35, 31, NULL, 10, 16),
(36, 32, NULL, 50, 12),
(37, 33, NULL, 100, 12),
(38, 33, NULL, 100, 16),
(39, 34, NULL, 10, 20),
(40, 34, NULL, 20, 9),
(41, 35, 117, 10, 20),
(42, 36, 27, 20, 9),
(43, 37, NULL, 100, 10),
(44, 37, NULL, 50, 18),
(45, 38, NULL, 590, 20),
(46, 39, NULL, 4, 19),
(47, 40, NULL, 5, 12),
(48, 40, NULL, 10, 16),
(49, 40, NULL, 15, 10),
(50, 41, 101, 30, 18),
(51, 42, NULL, 100, 20),
(52, 43, 37, 15, 10),
(53, 44, 101, 10, 18),
(54, 45, NULL, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `stokmasuk`
--

CREATE TABLE `stokmasuk` (
  `id` bigint(20) NOT NULL,
  `kodemasuk` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokmasuk`
--

INSERT INTO `stokmasuk` (`id`, `kodemasuk`, `created_at`, `updated_at`) VALUES
(4, 'SM20260615174459', '2026-06-15 17:44:59', '2026-06-15 17:44:59'),
(5, 'SM20260616074813', '2026-06-16 07:48:13', '2026-06-16 07:48:13'),
(6, 'SM20260617160254', '2026-06-17 16:02:54', '2026-06-17 16:02:54'),
(7, 'SM20260618011430', '2026-06-18 01:14:30', '2026-06-18 01:14:30'),
(8, 'SM20260618042900', '2026-06-18 04:29:00', '2026-06-18 04:29:00'),
(9, 'SM20260618043101', '2026-06-18 04:31:01', '2026-06-18 04:31:01'),
(10, 'SM20260618132306', '2026-06-18 13:23:06', '2026-06-18 13:23:06'),
(11, 'SM20260619193053', '2026-06-19 19:30:53', '2026-06-19 19:30:53'),
(12, 'SM20260620094802', '2026-06-20 09:48:02', '2026-06-20 09:48:02'),
(13, 'SM20260620123037', '2026-06-20 12:30:37', '2026-06-20 12:30:37'),
(14, 'SM20260620125525', '2026-06-20 12:55:25', '2026-06-20 12:55:25'),
(15, 'SM20260620134325', '2026-06-20 13:43:25', '2026-06-20 13:43:25'),
(16, 'SM20260620140204', '2026-06-20 14:02:04', '2026-06-20 14:02:04'),
(17, 'SM20260621170747', '2026-06-21 17:07:47', '2026-06-21 17:07:47'),
(18, 'SM20260621171636', '2026-06-21 17:16:36', '2026-06-21 17:16:36'),
(19, 'SM20260622200815', '2026-06-22 20:08:15', '2026-06-22 20:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `stokmasukdetail`
--

CREATE TABLE `stokmasukdetail` (
  `id` bigint(20) NOT NULL,
  `stokmasuk_id` bigint(20) DEFAULT NULL,
  `stokgudang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokmasukdetail`
--

INSERT INTO `stokmasukdetail` (`id`, `stokmasuk_id`, `stokgudang_id`, `jumlah`) VALUES
(5, 4, 4, 100),
(6, 4, 5, 100),
(7, 5, 6, 100),
(8, 5, 7, 100),
(9, 5, 8, 50),
(10, 5, 9, 300),
(11, 6, 6, 500),
(12, 7, 16, 100),
(13, 7, 15, 100),
(14, 7, 14, 100),
(15, 7, 13, 100),
(16, 7, 12, 100),
(17, 7, 9, 100),
(18, 7, 8, 100),
(19, 7, 7, 100),
(20, 7, 6, 100),
(21, 7, 5, 100),
(22, 7, 4, 100),
(23, 8, 10, 100),
(24, 9, 11, 100),
(25, 10, 15, 25),
(26, 11, 7, 1000),
(27, 12, 4, 50),
(28, 13, 9, 100),
(29, 13, 13, 500),
(30, 14, 17, 100),
(31, 15, 14, 300),
(32, 15, 16, 300),
(33, 15, 15, 300),
(34, 16, 4, 500),
(35, 16, 6, 500),
(36, 16, 17, 500),
(37, 17, 5, 10),
(38, 18, 13, 5000),
(39, 19, 6, 100),
(40, 19, 17, 500),
(41, 19, 7, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cabang_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$ZtN9vXyjrGGu/jRTYc7Ta.m5KlWXfE.ExUbuu1lbdRajcUiiO55dS', 'Admin', NULL, NULL, NULL),
(2, 1, 'Usman', 'usman@gmail.com', NULL, '$2y$12$wGc3zbzGm12QAls8k2p02uor0IPfP0am4Kn2MLDc/M1lryYTkR02u', 'Kasir', NULL, '2026-06-14 22:28:31', '2026-06-15 15:56:09'),
(3, NULL, 'Gudang', 'gudang@gmail.com', NULL, '$2y$12$LP1qxuBmHQjjWLiFaxfV3e0F7xhAIq2cjvCs2AWXB/NNjYdwLX/M.', 'Gudang', NULL, '2026-06-14 22:29:17', '2026-06-16 00:44:17'),
(4, 0, 'sandy', 'sandy@gmail.com', NULL, 'sandy123', 'admin', NULL, NULL, NULL),
(5, 2, 'ucup', 'Ucup@gmail.com', NULL, '$2y$12$GG8CfnZEoST9ZXjCsYQNLuTB24PXT7i3qetgt47RWlxBYAqgJReGO', 'Kasir', NULL, '2026-06-16 00:55:55', '2026-06-16 00:55:55'),
(6, 3, 'Yogi', 'Yogi@gmail.com', NULL, '$2y$12$QvcRZOOP3xL.EaHT0cKrhOQhKn/hM1FNnDK2QAJ5qCog2Aus2y0uC', 'Kasir', NULL, '2026-06-16 00:56:56', '2026-06-16 00:56:56'),
(7, 7, 'sandy', 'sandy@rmpuring.com', NULL, '$2y$12$hT6E5r2MeXdOM2hvTpVoPughtzSV8J1v0h0qPog1eZZ6InScPJ90e', 'Kasir', NULL, '2026-06-20 06:34:32', '2026-06-20 06:34:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaandetail`
--
ALTER TABLE `permintaandetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stokcabang`
--
ALTER TABLE `stokcabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokgudang`
--
ALTER TABLE `stokgudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokkeluar`
--
ALTER TABLE `stokkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokkeluardetail`
--
ALTER TABLE `stokkeluardetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokmasuk`
--
ALTER TABLE `stokmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokmasukdetail`
--
ALTER TABLE `stokmasukdetail`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permintaandetail`
--
ALTER TABLE `permintaandetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `stokcabang`
--
ALTER TABLE `stokcabang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `stokgudang`
--
ALTER TABLE `stokgudang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stokkeluar`
--
ALTER TABLE `stokkeluar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `stokkeluardetail`
--
ALTER TABLE `stokkeluardetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `stokmasuk`
--
ALTER TABLE `stokmasuk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stokmasukdetail`
--
ALTER TABLE `stokmasukdetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
