<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('CREATE TABLE IF NOT EXISTS `barang` (
  `id` bigint(20) NOT NULL,
  `kodebarang` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `stok_minimum` int(11) NOT NULL DEFAULT 5,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `cabang` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `job_batches` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `permintaan` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `permintaandetail` (
  `id` bigint(20) NOT NULL,
  `permintaan_id` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokcabang` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokgudang` (
  `id` bigint(20) NOT NULL,
  `barang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokkeluar` (
  `id` bigint(20) NOT NULL,
  `cabang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `kodekeluar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokkeluardetail` (
  `id` bigint(20) NOT NULL,
  `stokkeluar_id` bigint(20) DEFAULT NULL,
  `stokcabang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `barang_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokmasuk` (
  `id` bigint(20) NOT NULL,
  `kodemasuk` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `stokmasukdetail` (
  `id` bigint(20) NOT NULL,
  `stokmasuk_id` bigint(20) DEFAULT NULL,
  `stokgudang_id` bigint(20) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        DB::unprepared('CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;');

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `permintaandetail`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokcabang`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokgudang`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokkeluar`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokkeluardetail`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokmasuk`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `stokmasukdetail`
  ADD PRIMARY KEY (`id`);'); } catch (\Exception $e) {}

        // Add Primary Key
        try { DB::unprepared('ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `barang`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `cabang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `permintaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `permintaandetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokcabang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokgudang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokkeluar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokkeluardetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokmasuk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `stokmasukdetail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;'); } catch (\Exception $e) {}

        // Add Auto Increment
        try { DB::unprepared('ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;'); } catch (\Exception $e) {}

    }

    public function down(): void
    {
        // 
    }
};
