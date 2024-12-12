-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 06:35 PM
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
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `user_id` int(11) NOT NULL,
  `akses_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`user_id`, `akses_id`) VALUES
(21, 'administrator'),
(63, 'pelanggan'),
(70, 'pelanggan'),
(72, 'kasir'),
(76, 'pelayan');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_menu`
--

CREATE TABLE `daftar_menu` (
  `menu_id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_menu`
--

INSERT INTO `daftar_menu` (`menu_id`, `nama_menu`, `gambar`, `harga`) VALUES
(22, 'Tomato Canapes', 'tomato_canapes.jpg', 47535),
(23, 'Steak Salmon', 'steak_salmon.jpg', 115454),
(24, 'Battered Dory Fish Regular', 'battered_dory_fish_regular.jpg', 73636),
(25, 'Beef Lasagna', 'beef_lasagna.jpg', 57272),
(26, 'Chicken Pop Corn Butter Rice', 'chicken_pop_corn_butter_rice.jpg', 53636),
(27, 'Fettuccine Carbonara', 'fettuccine_carbonara.jpg', 57272),
(28, 'Lamb Chop NZ', 'lamb_chops_nz.jpg', 108181),
(29, 'Mix Beef Rice', 'mix_beef_rise.jpg', 45454);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `detail_transaksi_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`detail_transaksi_id`, `menu_id`, `transaksi_id`, `jumlah`, `total_harga`) VALUES
(21, 22, 17, 2, 95070),
(22, 23, 17, 1, 115454),
(27, 22, 20, 1, 47535),
(28, 29, 20, 2, 90908),
(29, 25, 21, 2, 114544),
(30, 26, 22, 3, 160908),
(31, 27, 23, 2, 114544),
(45, 23, 35, 2, 230908),
(46, 26, 35, 3, 160908),
(52, 22, 40, 1, 47535),
(57, 23, 45, 1, 115454),
(85, 28, 70, 1, 108181),
(86, 29, 70, 2, 90908),
(93, 29, 75, 2, 90908);

-- --------------------------------------------------------

--
-- Table structure for table `master_akses`
--

CREATE TABLE `master_akses` (
  `akses_id` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_akses`
--

INSERT INTO `master_akses` (`akses_id`, `nama`) VALUES
('administrator', 'Administrator'),
('kasir', 'Kasir'),
('pelanggan', 'Pelanggan'),
('pelayan', 'Pelayan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `total_harga_keseluruhan` int(11) NOT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `status_bayar` enum('lunas','belum bayar') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `waktu_transaksi`, `total_harga_keseluruhan`, `bayar`, `kembalian`, `status_bayar`, `user_id`) VALUES
(17, '2024-12-08 16:32:39', 210524, 215000, 4476, 'lunas', 21),
(20, '2024-12-08 18:19:21', 138443, 150000, 11557, 'lunas', 21),
(21, '2024-12-08 18:33:27', 114544, 115000, 456, 'lunas', 21),
(22, '2024-12-08 18:38:26', 160908, 161000, 92, 'lunas', 21),
(23, '2024-12-09 01:46:16', 114544, 115000, 456, 'lunas', 21),
(35, '2024-12-10 19:17:15', 391816, 400000, 8184, 'lunas', 63),
(40, '2024-12-10 22:05:01', 47535, 50000, 2465, 'lunas', 21),
(45, '2024-12-10 22:51:03', 115454, 120000, 4546, 'lunas', 21),
(70, '2024-12-11 13:23:43', 199089, 200000, 911, 'lunas', 63),
(75, '2024-12-12 16:08:17', 90908, 91000, 92, 'lunas', 63);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`) VALUES
(21, 'admin', '$2y$10$RZJpUek9w5dcXU3PoF7fEew10bXCm36BjDxZ1lFcCFwaq3rm7yN6u', 'Kelompok 6'),
(63, 'user', '$2y$10$u6w3ICucwTKAQKDIhQuQ7eNEwil2z.Z.Q.y54tmsD0mR4Zx24KHEO', 'user'),
(70, 'Bustamin', '$2y$10$6oCsJLVqjAqnRTj4Csi.3uiZi9Qe6qOxOZPs0quypfXxZO2H9rSw2', 'Bustami makan Ayam'),
(72, 'kasir', '$2y$10$s6FjyvHILxHaKdH0tgy4ue.BdDJHlJDHXftwT.0PdOAFbUpSoGUz2', 'Kasir'),
(76, 'pelayan', '$2y$10$fTl38LkNG3VnbdqCg7k4Q.lHAskxCXn.fCLkjBsxFFX/m72oufAau', 'Pelayan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `akses_id` (`akses_id`);

--
-- Indexes for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`detail_transaksi_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `master_akses`
--
ALTER TABLE `master_akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `detail_transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_ibfk_2` FOREIGN KEY (`akses_id`) REFERENCES `master_akses` (`akses_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `daftar_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
