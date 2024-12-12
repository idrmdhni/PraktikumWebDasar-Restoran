-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 09:19 PM
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
(29, 'Mix Beef Rice', 'mix_beef_rise.jpg', 45454),
(33, 'Avocado Juice', 'guava_juice.jpg', 30909),
(34, 'Chocolate Milkshake', 'chocolate_milkshake.jpg', 33636),
(35, 'Virgin Mojito', 'virgin_mojito.jpg', 22487),
(36, 'Mango Lassi', 'mango_lassi.jpg', 52000);

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
(105, 28, 82, 1, 108181),
(106, 25, 82, 2, 114544),
(107, 26, 82, 4, 214544),
(108, 24, 83, 2, 147272),
(109, 27, 83, 1, 57272),
(110, 24, 84, 3, 220908),
(111, 22, 84, 3, 142605),
(112, 27, 85, 2, 114544);

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
(82, '2024-12-13 03:01:01', 437269, 450000, 12731, 'lunas', 82),
(83, '2024-12-13 03:02:35', 204544, 205000, 456, 'lunas', 91),
(84, '2024-12-13 03:03:35', 363513, 370000, 6487, 'lunas', 90),
(85, '2024-12-13 03:04:40', 114544, 115000, 456, 'lunas', 92);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `akses_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `akses_id`) VALUES
(82, 'admin', '$2y$10$iwZWYtp80UqXiSQGAoytTu7CXLiZ4dPSwZxvMVkprk05lKGd5T9GS', 'Kelompok 6', 'administrator'),
(90, 'kasir', '$2y$10$y/RV.t8aAC1XNop3n2BUe.O2m2zvzTsCrWZJLy2U7O1Ur9Kv4TyoK', 'Kasir', 'kasir'),
(91, 'pelanggan', '$2y$10$GIyxTlOhf0/dvbeliL2sdel2.5eoOw6lZSmNRMXUP.KqQhyo/5KD.', 'Pelanggan', 'pelanggan'),
(92, 'pelayan', '$2y$10$4DPrDKnm34t.KyFSBkedsOwCz0Ao24CK1urhPYiH09BQCNZLhtoyW', 'Pelayan', 'pelayan');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `akses_id` (`akses_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `detail_transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_4` FOREIGN KEY (`menu_id`) REFERENCES `daftar_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_5` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`akses_id`) REFERENCES `master_akses` (`akses_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
