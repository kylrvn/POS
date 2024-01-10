-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 11:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_of_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `ID` int(255) NOT NULL,
  `item_ID` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`ID`, `item_ID`, `item_name`, `quantity`, `type`, `date_created`, `created_by`) VALUES
(13, '17', 'Bike Cycling', '200', 'IN', '2024-01-09 21:42:50', 17),
(14, '17', 'Bike Cycling', '10', 'OUT', '2024-01-09 21:43:21', 17),
(15, '17', 'Bike Cycling', '10', 'OUT', '2024-01-09 21:43:39', 17),
(16, '17', 'Bike Cycling', '10', 'OUT', '2024-01-09 21:43:48', 17),
(17, '17', 'Bike Cycling', '20', 'IN', '2024-01-09 21:43:57', 17),
(18, '17', 'Bike Cycling', '5', 'OUT', '2024-01-09 21:44:01', 17),
(19, '17', 'Bike Cycling', '10', 'IN', '2024-01-09 21:44:06', 17),
(20, '17', 'Bike Cycling', '5', 'OUT', '2024-01-09 21:44:10', 17),
(21, '16', 'Banner', '100', 'IN', '2024-01-09 21:44:31', 17),
(22, '16', 'Banner', '5', 'OUT', '2024-01-09 21:44:34', 17),
(23, '16', 'Banner', '10', 'OUT', '2024-01-09 21:44:37', 17),
(24, '16', 'Banner', '5', 'OUT', '2024-01-09 21:44:43', 17),
(25, '16', 'Banner', '20', 'IN', '2024-01-09 21:44:48', 17),
(26, '16', 'Banner', '30', 'OUT', '2024-01-09 21:44:53', 17),
(27, '17', 'Bike Cycling', '10', 'OUT', '2024-01-09 22:56:23', 17),
(28, '16', 'Banner', '30', 'IN', '2024-01-09 22:56:36', 17),
(29, '14', 'Hoodie', '50', 'IN', '2024-01-09 22:56:42', 17),
(30, '14', 'Hoodie', '10', 'OUT', '2024-01-09 22:57:14', 17),
(31, '26', 'Chinese Collar', '40', 'IN', '2024-01-09 22:57:24', 17),
(32, '25', 'Jersey Upper - Set - Tshirt', '100', 'IN', '2024-01-09 22:57:54', 17),
(34, '32', 'Tarpauline', '10', 'IN', '2024-01-09 23:07:04', 17),
(35, '14', 'Hoodie', '10', 'IN', '2024-01-09 23:08:16', 17),
(36, '14', 'Hoodie', '20', 'OUT', '2024-01-09 23:12:34', 17),
(37, '25', 'Jersey Upper - Set - Tshirt', '30', 'OUT', '2024-01-09 23:12:50', 17),
(38, '17', 'Bike Cycling', '180', 'OUT', '2024-01-10 18:06:03', 17),
(39, '17', 'Bike Cycling', '50', 'IN', '2024-01-10 18:06:23', 17),
(40, '17', 'Bike Cycling', '50', 'OUT', '2024-01-10 18:07:58', 17),
(41, '17', 'Bike Cycling', '70', 'IN', '2024-01-10 18:08:08', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
