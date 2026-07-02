-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laravelinventoripermintaan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kodebarang` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.barang: ~3 rows (approximately)
DELETE FROM `barang`;
INSERT INTO `barang` (`id`, `kodebarang`, `nama`, `kategori`, `satuan`) VALUES
	(7, 'BRG00007', 'Bayam', 'Sayuran', 'Pcs'),
	(8, 'BRG00008', 'Bawang', 'Bumbu', 'Pcs');

-- Dumping structure for table laravelinventoripermintaan.cabang
CREATE TABLE IF NOT EXISTS `cabang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.cabang: ~2 rows (approximately)
DELETE FROM `cabang`;
INSERT INTO `cabang` (`id`, `nama`) VALUES
	(1, 'Cabang 1'),
	(2, 'Cabang 2');

-- Dumping structure for table laravelinventoripermintaan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table laravelinventoripermintaan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table laravelinventoripermintaan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table laravelinventoripermintaan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table laravelinventoripermintaan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table laravelinventoripermintaan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.migrations: ~3 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table laravelinventoripermintaan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table laravelinventoripermintaan.permintaan
CREATE TABLE IF NOT EXISTS `permintaan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `cabang_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.permintaan: ~0 rows (approximately)
DELETE FROM `permintaan`;
INSERT INTO `permintaan` (`id`, `cabang_id`, `user_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
	(4, 1, 2, 'Diterima', NULL, '2026-06-15 17:45:53', '2026-06-15 17:46:31');

-- Dumping structure for table laravelinventoripermintaan.permintaandetail
CREATE TABLE IF NOT EXISTS `permintaandetail` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `permintaan_id` bigint DEFAULT NULL,
  `barang_id` bigint DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.permintaandetail: ~0 rows (approximately)
DELETE FROM `permintaandetail`;
INSERT INTO `permintaandetail` (`id`, `permintaan_id`, `barang_id`, `jumlah`) VALUES
	(7, 4, 8, 20),
	(8, 4, 7, 20);

-- Dumping structure for table laravelinventoripermintaan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.sessions: ~3 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('B9UTuQ8punGKCXfheSnfA1UR4sE882NROGJwrVC9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRllEYnhBTURZOXFCOE9qNkhLd0VWSHRTdURZQUNUVjZPODFTNW54dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1781520466),
	('H3a7ocx9CKVLZEC0LvMyex9mbfl5Geoawg31AFpo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRW9rNXZwYVg3OFN5ME80QTlTVlRua25OcEJFWEdhdmhsUnU2ZFF1ayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYW5lbCI7czo1OiJyb3V0ZSI7Tjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1781512134),
	('KDFzz14S6BsRMkuifx6VzcAPkcUA76NRvSnAeG6u', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1RFZ3VUcmUzd2ZJQWduVW9uZXRrV1V6QkJ2Q0o3SWx0YkhqbFg5dCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYW5lbCI7czo1OiJyb3V0ZSI7Tjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1781505024);

-- Dumping structure for table laravelinventoripermintaan.stokcabang
CREATE TABLE IF NOT EXISTS `stokcabang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `cabang_id` bigint DEFAULT NULL,
  `barang_id` bigint DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokcabang: ~0 rows (approximately)
DELETE FROM `stokcabang`;
INSERT INTO `stokcabang` (`id`, `cabang_id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(7, 1, 7, 10, '2026-06-15 17:44:19', '2026-06-15 17:47:02'),
	(8, 2, 7, 0, '2026-06-15 17:44:19', '2026-06-15 17:44:19'),
	(9, 1, 8, 10, '2026-06-15 17:44:31', '2026-06-15 17:47:02'),
	(10, 2, 8, 0, '2026-06-15 17:44:31', '2026-06-15 17:44:31');

-- Dumping structure for table laravelinventoripermintaan.stokgudang
CREATE TABLE IF NOT EXISTS `stokgudang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `barang_id` bigint DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokgudang: ~0 rows (approximately)
DELETE FROM `stokgudang`;
INSERT INTO `stokgudang` (`id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(4, 7, 80, '2026-06-15 17:44:19', '2026-06-15 17:46:31'),
	(5, 8, 80, '2026-06-15 17:44:31', '2026-06-15 17:46:31');

-- Dumping structure for table laravelinventoripermintaan.stokkeluar
CREATE TABLE IF NOT EXISTS `stokkeluar` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `cabang_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `kodekeluar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokkeluar: ~0 rows (approximately)
DELETE FROM `stokkeluar`;
INSERT INTO `stokkeluar` (`id`, `cabang_id`, `user_id`, `kodekeluar`, `created_at`, `updated_at`) VALUES
	(3, 1, 2, 'SK20260615174702', '2026-06-15 17:47:02', '2026-06-15 17:47:02');

-- Dumping structure for table laravelinventoripermintaan.stokkeluardetail
CREATE TABLE IF NOT EXISTS `stokkeluardetail` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `stokkeluar_id` bigint DEFAULT NULL,
  `stokcabang_id` bigint DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokkeluardetail: ~0 rows (approximately)
DELETE FROM `stokkeluardetail`;
INSERT INTO `stokkeluardetail` (`id`, `stokkeluar_id`, `stokcabang_id`, `jumlah`) VALUES
	(3, 3, 7, 10),
	(4, 3, 9, 10);

-- Dumping structure for table laravelinventoripermintaan.stokmasuk
CREATE TABLE IF NOT EXISTS `stokmasuk` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kodemasuk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokmasuk: ~0 rows (approximately)
DELETE FROM `stokmasuk`;
INSERT INTO `stokmasuk` (`id`, `kodemasuk`, `created_at`, `updated_at`) VALUES
	(4, 'SM20260615174459', '2026-06-15 17:44:59', '2026-06-15 17:44:59');

-- Dumping structure for table laravelinventoripermintaan.stokmasukdetail
CREATE TABLE IF NOT EXISTS `stokmasukdetail` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `stokmasuk_id` bigint DEFAULT NULL,
  `stokgudang_id` bigint DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laravelinventoripermintaan.stokmasukdetail: ~0 rows (approximately)
DELETE FROM `stokmasukdetail`;
INSERT INTO `stokmasukdetail` (`id`, `stokmasuk_id`, `stokgudang_id`, `jumlah`) VALUES
	(5, 4, 4, 100),
	(6, 4, 5, 100);

-- Dumping structure for table laravelinventoripermintaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cabang_id` bigint unsigned DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravelinventoripermintaan.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `cabang_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 0, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$ZtN9vXyjrGGu/jRTYc7Ta.m5KlWXfE.ExUbuu1lbdRajcUiiO55dS', 'Admin', NULL, NULL, NULL),
	(2, 1, 'Fahrul Adib', 'fahruladib9@gmail.com', NULL, '$2y$12$daGV0oVHDoQeglXbSV5c7O0OxcpNU1Ud/9Pst8pBbC.Iq8kGCuCha', 'Kasir', NULL, '2026-06-14 22:28:31', '2026-06-14 22:28:31'),
	(3, NULL, 'Gudang', 'gudang@gmail.com', NULL, '$2y$12$B4M77obmMQAa55xyZH6CMuwifMgPLTLFIjRwxRJ119sAJJBrsYP7C', 'Gudang', NULL, '2026-06-14 22:29:17', '2026-06-14 22:29:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
