-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 12:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_users`, `nama`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(2, 2, 'Konsolidasi', 'Jl. Magnum A2 H', '08987654321', '2023-12-20 14:19:05', '2023-12-20 14:19:05'),
(3, 4, 'Siman Yoro', 'Jl. M dadsdad', '0891919191', '2023-12-20 08:25:36', '2023-12-20 15:37:18'),
(6, 1, 'Admin', 'jfsd fdsa fsda', '089876783232', '2023-12-20 15:52:54', '2023-12-20 15:52:54'),
(7, 7, 'Kono Mae', 'dsf fsafs', '09878900987', '2023-12-20 09:00:15', '2023-12-20 16:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice`
--

CREATE TABLE `detail_invoice` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_invoice` int(11) UNSIGNED NOT NULL,
  `id_produk` int(11) UNSIGNED NOT NULL,
  `jml_produk` smallint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_invoice`
--

INSERT INTO `detail_invoice` (`id`, `id_invoice`, `id_produk`, `jml_produk`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 12, '2023-12-20 06:11:39', '2023-12-20 06:11:39'),
(5, 2, 2, 10, '2023-12-20 06:25:09', '2023-12-20 06:25:09'),
(6, 3, 4, 1, '2023-12-20 06:47:19', '2023-12-20 06:47:19'),
(7, 3, 4, 8, '2023-12-20 06:47:19', '2023-12-20 06:47:19'),
(8, 4, 4, 3, '2023-12-20 07:45:09', '2023-12-20 07:45:09'),
(9, 5, 2, 1, '2023-12-20 08:54:36', '2023-12-20 08:54:36'),
(10, 5, 4, 3, '2023-12-20 08:54:36', '2023-12-20 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) UNSIGNED NOT NULL,
  `jml_harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `jml_harga`, `diskon`, `created_at`, `updated_at`) VALUES
(2, 100000, 1000, '2023-12-19 07:05:37', '2023-12-19 07:05:37'),
(3, 200000, 10000, '2023-12-20 11:56:31', '2023-12-20 11:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) UNSIGNED NOT NULL,
  `faktur_pembelian` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL DEFAULT current_timestamp(),
  `id_diskon` int(11) UNSIGNED DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_users` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `faktur_pembelian`, `tgl_pembelian`, `id_diskon`, `total`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'KRO20231220998097', '2023-12-20', 2, 179000, 1, '2023-12-20 06:11:39', '2023-12-20 06:11:39'),
(2, 'KRO20231220975559', '2023-12-20', 2, 149000, 1, '2023-12-20 06:25:09', '2023-12-20 06:25:09'),
(3, 'KRO20231220118283', '2023-12-20', 3, 215000, 1, '2023-12-20 06:47:19', '2023-12-20 06:47:19'),
(4, 'KRO20231220241496', '2023-12-20', NULL, 75000, 1, '2023-12-20 07:45:09', '2023-12-20 07:45:10'),
(5, 'KRO20231220613012', '2023-12-20', NULL, 90000, 2, '2023-12-20 08:54:35', '2023-12-20 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(3, 'Minuman', '2023-12-13 00:15:01', '2023-12-13 00:15:42'),
(4, 'Snack', '2023-12-13 03:25:28', '2023-12-13 03:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `id_kategori`, `nama_produk`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
(2, 'A001', 3, 'Yanmanto', 12000, 15000, 99, '2023-12-13 01:01:48', '2023-12-20 08:54:36'),
(4, 'A002', 4, 'Sia', 20000, 25000, 94, '2023-12-13 07:10:59', '2023-12-20 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$OvY67NDBPvGmO6HAQLTEk.Y0nyJ5/r9avcVG9sl8QnXOd9M6UE092', 2, '2023-12-20 15:23:52', '2023-12-20 15:23:52'),
(2, 'pemilik', '$2y$10$5rs5ORbPNCRTOrw6rh//dO3QXWUAlXEGTBrzbC/.a03bYe4HbhIf6', 1, '2023-12-20 15:23:52', '2023-12-20 15:23:52'),
(4, 'Siman', '$2y$12$8r12dJgOwLtZXxqghln0.uK2lKVwwzNDd4X52shli9h.P1X7mB6Ii', 2, '2023-12-20 08:25:36', '2023-12-20 08:25:36'),
(7, 'kono', '$2y$12$fNQyCWq8VLGPupLT4y3LRO7vtjbsYeYcn9LLivqu2JPEuNQNrXIm.', 2, '2023-12-20 09:00:15', '2023-12-20 09:00:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faktur_pembelian` (`faktur_pembelian`),
  ADD KEY `id_diskon` (`id_diskon`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD CONSTRAINT `detail_invoice_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `detail_invoice_ibfk_2` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`id_diskon`) REFERENCES `diskon` (`id`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
