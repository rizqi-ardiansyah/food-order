-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 12:39 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(17, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(10) NOT NULL,
  `id_table` varchar(3) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Olahan Daging', 'Food_Category_830.jpg', 'Yes', 'Yes'),
(10, 'Olahan Nasi', 'Food_Category_994.jpg', 'Yes', 'Yes'),
(11, 'Minuman', 'Food_Category_982.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `stock`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(5, 'Bakso', 'Diolah dari daging sapi pilihan', 17, '5000.00', 'Food-Name-4481.jpg', 1, 'Yes', 'Yes'),
(6, 'Nasi Goreng', 'Digoreng dengan minyak pilihan dan dilengkapi sayur mayur				', 19, '7000.00', 'Food-Name-5441.jpg', 10, 'Yes', 'Yes'),
(7, 'Nasi Pecel', 'Dicampur dengan sambal yang pedas\r\n						', 20, '5000.00', 'Food-Name-8290.jpg', 10, 'Yes', 'Yes'),
(8, 'Ayam Geprek', 'Renyahnya hingga ke dalam\r\n						', 20, '7000.00', 'Food-Name-279.jpg', 1, 'Yes', 'Yes'),
(9, 'Teh', 'Dicampur dengan gula yang pas	', 18, '2000.00', 'Food-Name-8970.jpg', 11, 'Yes', 'Yes'),
(10, 'Kopi', ' Penenang hidup dan teman diskusi\r\n						', 20, '2000.00', 'Food-Name-205.jpg', 11, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meja`
--

CREATE TABLE `tbl_meja` (
  `id_table` varchar(3) NOT NULL,
  `password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_meja`
--

INSERT INTO `tbl_meja` (`id_table`, `password`) VALUES
('M1', 'meja1'),
('M2', 'meja2'),
('M3', 'meja3'),
('M4', 'meja4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_table` varchar(3) DEFAULT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `delivered_date` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `id_table`, `food`, `price`, `qty`, `total`, `order_date`, `delivered_date`, `timeout`, `status`, `customer_name`, `customer_contact`, `customer_address`) VALUES
(7, 'M1', 'Kopi', '2000.00', 1, '2000.00', '2021-06-25 10:44:03', '2021-07-14 09:11:35', '2021-07-14 09:40:35', 'Delivered', 'Ardiansyah', '085123456783', 'Jalan Gajah Mada'),
(26, 'M2', 'Bakso', '5000.00', 1, '5000.00', '2021-07-13 21:37:05', '2021-07-13 21:58:05', '2021-07-13 22:27:05', 'Delivered', 'Muhammad Rizqi Ardiansyah', '085648224202', 'Jalan Gajah Mada'),
(102, 'M2', 'Bakso', '5000.00', 1, '5000.00', '2021-07-15 05:27:11', NULL, NULL, 'Delivered', 'Ilham Sinatrio Gumelar', '085648224202', 'Jalan Gajah Mada'),
(103, 'M2', 'Teh', '2000.00', 2, '4000.00', '2021-07-15 05:27:11', '2021-07-15 05:28:15', '2021-07-15 05:57:15', 'Delivered', 'Ilham Sinatrio Gumelar', '085648224202', 'Jalan Gajah Mada'),
(105, 'M2', 'Bakso', '5000.00', 1, '5000.00', '2021-07-15 05:32:27', '2021-07-15 05:32:42', '2021-07-15 06:01:42', 'Delivered', 'Ilham Sinatrio Gumelar', '085648224202', 'Jalan Gajah Mada'),
(106, 'M3', 'Bakso', '5000.00', 1, '5000.00', '2021-07-15 05:34:29', NULL, NULL, 'Delivered', 'Jorgy Fauzi Kusuma', '085648224202', 'Blitar, Indonesia'),
(107, 'M3', 'Nasi Goreng', '7000.00', 1, '7000.00', '2021-07-15 05:34:29', '2021-07-15 05:34:54', '2021-07-15 06:03:54', 'Delivered', 'Jorgy Fauzi Kusuma', '085648224202', 'Blitar, Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_table` (`id_table`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meja`
--
ALTER TABLE `tbl_meja`
  ADD PRIMARY KEY (`id_table`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_table` (`id_table`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`id_table`) REFERENCES `tbl_meja` (`id_table`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`id_table`) REFERENCES `tbl_meja` (`id_table`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
