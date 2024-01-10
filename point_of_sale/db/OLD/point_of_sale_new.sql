-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 04:36 PM
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
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `ID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `CNumber` varchar(12) NOT NULL,
  `Branch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`ID`, `FName`, `LName`, `Company`, `CNumber`, `Branch`) VALUES
(1, 'angelo', 'morancil', 'sample company', '09499679169', 'Bacolod'),
(2, 'juan', 'dela cruz', '', '09123456789', 'Bacolod'),
(3, 'dodong', 'cebuano', 'sample', '', 'Cebu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Item_id` int(11) NOT NULL,
  `Item_qty` int(11) NOT NULL,
  `Item_unitprice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`ID`, `Order_ID`, `Customer_ID`, `Item_id`, `Item_qty`, `Item_unitprice`) VALUES
(74, 1, 1, 14, 5, 750),
(75, 1, 1, 6, 10, 1200),
(76, 2, 2, 8, 50, 7500),
(77, 3, 3, 16, 50, 2500),
(78, 3, 3, 17, 25, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list`
--

CREATE TABLE `tbl_list` (
  `ID` int(11) NOT NULL,
  `List_name` varchar(255) NOT NULL,
  `List_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_list`
--

INSERT INTO `tbl_list` (`ID`, `List_name`, `List_category`) VALUES
(6, 'Polo', 'Items'),
(7, 'Long Sleeve and Tshirt', 'Items'),
(8, 'Tshirt', 'Items'),
(9, 'Long Sleeve', 'Items'),
(10, 'Jersey Set', 'Items'),
(11, 'Jersey Upper only', 'Items'),
(12, 'Jersey Short only', 'Items'),
(13, 'Jacket', 'Items'),
(14, 'Hoodie', 'Items'),
(15, 'Jersey set and Upper', 'Items'),
(16, 'Banner', 'Items'),
(17, 'Bike Cycling', 'Items'),
(18, 'Polo Zipper, Polo Shirt, Tshirt', 'Items'),
(19, 'Polo Zipper', 'Items'),
(20, 'Tubemask', 'Items'),
(21, 'Jersey Upper only - NBA Cut', 'Items'),
(23, 'Jersey and Tshirt', 'Items'),
(24, 'Tshirt and Polo', 'Items'),
(25, 'Jersey Upper - Set - Tshirt', 'Items'),
(26, 'Chinese Collar', 'Items'),
(27, 'Polor - Zipper and Chinese Collar', 'Items'),
(28, 'Polo Zipper and Tshirt', 'Items'),
(29, 'Lanyard', 'Items'),
(30, 'Polo V-Neck and 3Fourth Vnech', 'Items'),
(31, 'Jersey Set and Tshirt', 'Items'),
(32, 'Tarpauline', 'Items'),
(33, 'DTF Tshirt Print', 'Items'),
(34, 'DTF Print only', 'Items'),
(35, 'Sticker', 'Items'),
(36, 'Tshirt VNeck', 'Items'),
(37, 'Waiting Pattern', 'Status'),
(38, 'Color Corrention', 'Status'),
(39, 'Waiting Sample', 'Status'),
(40, 'Printing', 'Status'),
(41, 'Sewing', 'Status'),
(42, 'Completed', 'Status'),
(43, 'Released', 'Status'),
(44, 'Partial Release', 'Status'),
(45, 'Waiting Size', 'Status'),
(46, 'Pattern Ready', 'Status'),
(47, 'For Checking', 'Status'),
(48, 'Go for Setup', 'Status'),
(49, 'Cash', 'Payment'),
(50, 'Online Payment', 'Payment'),
(51, 'Cash On Delivery (COD)', 'Payment'),
(52, 'Terms', 'Payment'),
(53, 'Admin', 'User Role'),
(54, 'Cashier', 'User Role'),
(55, 'Front Desk', 'User Role'),
(56, 'Artist', 'User Role'),
(57, 'Production Manager', 'User Role'),
(58, 'Production Staff', 'User Role');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`ID`, `Name`) VALUES
(1, 'Dashboard'),
(2, 'Customer'),
(3, 'Create Order'),
(4, 'Management'),
(5, 'Payment');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `ID` int(11) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `Order_note` varchar(500) NOT NULL,
  `Deadline_notes` varchar(500) NOT NULL,
  `Act_qty` int(11) NOT NULL,
  `Total_amt` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Discount` double NOT NULL,
  `Freebies` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT '48',
  `Book_date` date NOT NULL,
  `Deadline` date NOT NULL,
  `Sewer_assign` varchar(255) NOT NULL,
  `Layout_artist` varchar(255) NOT NULL,
  `Setup_artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`ID`, `Cust_ID`, `Order_note`, `Deadline_notes`, `Act_qty`, `Total_amt`, `Subtotal`, `Discount`, `Freebies`, `Status`, `Book_date`, `Deadline`, `Sewer_assign`, `Layout_artist`, `Setup_artist`) VALUES
(1, 1, '', '', 15, 1950, 1950, 0, '', '48', '2023-07-01', '2023-07-06', '', '', '10'),
(2, 2, '', '', 50, 7500, 7500, 0, '', '48', '2023-07-01', '2023-07-01', '', '', '18'),
(3, 3, '', '', 75, 5000, 5000, 0, '', '48', '2023-07-01', '2023-07-14', '15', '15', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Amount_paid` double NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Payment_mode` varchar(255) NOT NULL,
  `Date_paid` datetime NOT NULL,
  `Incharge_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`ID`, `Order_ID`, `Amount_paid`, `Status`, `Payment_mode`, `Date_paid`, `Incharge_ID`) VALUES
(1, 1, 1000, '', '49', '2023-07-01 10:45:57', 10),
(2, 1, 450, '', '49', '2023-07-01 10:47:41', 10),
(3, 1, 500, '', '50', '2023-07-01 10:48:31', 10),
(4, 2, 3000, '', '49', '2023-07-01 11:12:51', 10),
(5, 3, 2500, '', '49', '2023-07-01 11:29:19', 15),
(6, 3, 2500, '', '50', '2023-07-01 15:20:22', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proof`
--

CREATE TABLE `tbl_proof` (
  `ID` int(11) NOT NULL,
  `Payment_ID` int(11) NOT NULL,
  `Proof_of_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_proof`
--

INSERT INTO `tbl_proof` (`ID`, `Payment_ID`, `Proof_of_payment`) VALUES
(1, 3, '1_papa.jpg'),
(4, 4, ''),
(5, 5, ''),
(6, 6, '3_papa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference`
--

CREATE TABLE `tbl_reference` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Mockup_design` varchar(255) NOT NULL,
  `Payment_ID` int(11) NOT NULL,
  `Payment_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_reference`
--

INSERT INTO `tbl_reference` (`ID`, `Order_ID`, `Mockup_design`, `Payment_ID`, `Payment_proof`) VALUES
(1, 1, '1_1_GRS Virtual Background.jpg', 0, ''),
(2, 2, '2_2_B.png', 0, ''),
(3, 3, '3_3_GRS Virtual Background.jpg', 0, ''),
(4, 3, '3_3_B.png', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Locker` varchar(255) NOT NULL,
  `U_ID` varchar(255) NOT NULL,
  `Role_ID` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Pass_change` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `FName`, `LName`, `Username`, `Branch`, `Password`, `Locker`, `U_ID`, `Role_ID`, `Role`, `Pass_change`) VALUES
(10, 'angelo', 'morancil', 'gelomorancil', 'Bacolod', 'a91430953c0a1bcfb3f59af9c98e348db119fed6', '!it#tze()6QDZ<UGI#W$%<uo\\Cn1I@HRHbYx!1H<Si$6azws.@', 'da1e88b29aec11f69cc7f151146daedeb1a9f7ba:d59eed809bd765ce772290c5c66b25355e35a799:f1b020173d8b249bba2c2deb9ea173165c08da8d1', 53, 'Admin', 0),
(15, 'Test', 'User', 'user', 'Cebu', '8d81556a3628c6eb81b9195571928eaa0f8032fb', 'kp&1#Y@@GB&K3g~ZVuGs*d*$CheY32!v>Out#qw%iz32W)NudG', '063208698ebf5ba74d4fcfef70955ec83e3d7e7a:40cd9fe8e4aecd66ae7b501d8d7a07d91df73d4a:779b781d1d6cb562be277e579ea776adab3e1d421', 53, 'Admin', 0),
(16, 'sample', 'user', 'user2', 'Cebu', '1163149c0a4392747da5736c555c1af84ed56053', 'pvPFaJJXp$lr2ZC*.1TBiIl1iq2&%U/fJRkXV<l>wrJBFi~l?/', '169f2ac7959716e4d253aa5f72c10594da2e0a2f:a4b556f819f56e942e62894afe43da730aef343c:bfda11fa024678fccbf981339216fee8ec07c5ea1', 53, 'Admin', 0),
(17, 'Super', 'Admin', 'superadmin', '', 'a91430953c0a1bcfb3f59af9c98e348db119fed6', '!it#tze()6QDZ<UGI#W$%<uo\\Cn1I@HRHbYx!1H<Si$6azws.@', '720910dacbdce4695a27a3cbbc85b5f9bd1975b8:bbf461b5e7223da33a1ae3433b2b1548fc8d7cf0:2a6da1c5e31c5da22a56070d310b10d0c79ce5d71', 53, 'Admin', 0),
(18, 'artist', 'account', 'artist', 'Bacolod', 'c31b4319be7e73204aa1ec88eb6e5e11c11e58c1', 'iGXed@M>AY2HV886CIW&T(1$(N1pA5TRA1B?b17/~wK<n9buVT', 'f8c88c5dd93a5eec26bab282b71014dc6bf92ea3:81e22c39d8f113980ba6f3fe1e50c0bc6da585c1:2f06d9de3da994b6bfdae43ad65962ed50719cb61', 56, 'Artist', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Order_ID` (`Order_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `tbl_list`
--
ALTER TABLE `tbl_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_proof`
--
ALTER TABLE `tbl_proof`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_list`
--
ALTER TABLE `tbl_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_proof`
--
ALTER TABLE `tbl_proof`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
