-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 04:02 PM
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
(13, 'angelo', 'morancil', '', '0932173871', 'Bacolod'),
(24, 'jerelyn', 'mallo', 'sample', '09324123131', 'Bacolod'),
(25, 'juan', 'dela cruz', 'sample company', '093213898319', 'Bacolod'),
(26, 'sample', 'customer', '', '093217386', 'Bacolod'),
(27, 'Mary Gold', 'Fuentebella', 'Sanag', '09524161516', 'Bacolod'),
(28, 'sample', 'sample', 'sample', '898797889', 'Bacolod'),
(29, 'Loymson', 'Yap JR', 'No 1 Supplier', '12312312321', 'Bacolod'),
(30, 'Resty', 'Morancil', 'Museum', '091725381716', 'Bacolod'),
(31, 'sample', 'sample', 'sample', '09012839', 'Bacolod'),
(32, 'sample', 'customer', 'sample company', '09123456789', 'Bacolod'),
(33, 'james', 'yap', 'purefoods', '091626262626', 'Bacolod'),
(34, 'john christopher', 'magnaye', 'manila', '09231839272', 'Bacolod'),
(35, 'ramon', 'bautista', 'bautista inc', '09321673167', 'Bacolod'),
(36, 'joemarie', 'vagallon', 'printmaxs', '09491137763', 'Bacolod'),
(37, 'hahaha', 'heheheh', 'huhuh', '90913129809', 'Bacolod'),
(38, 'sample', 'new customer', 'sample', '12381923', 'Bacolod');

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
(56, 44, 24, 16, 10, 900),
(57, 44, 24, 17, 10, 800),
(58, 45, 25, 23, 2, 20),
(59, 46, 25, 23, 2, 2),
(60, 46, 25, 7, 5, 10),
(61, 47, 13, 33, 10, 100),
(62, 47, 13, 21, 2, 20),
(63, 48, 24, 17, 10, 1000),
(64, 48, 24, 10, 2, 1000),
(65, 49, 28, 17, 2, 200),
(66, 50, 34, 17, 5, 50),
(67, 50, 34, 29, 10, 200),
(68, 51, 35, 6, 5, 500),
(69, 52, 36, 10, 10, 5000),
(70, 52, 36, 16, 1, 500),
(71, 52, 36, 11, 0, 0),
(72, 52, 36, 15, 0, 0),
(73, 53, 28, 30, 15, 150);

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
(44, 24, 'nothing', 'nothing', 20, 1600, 1700, 100, '1 tshirt', '48', '2023-05-23', '2023-05-31', '', '', ''),
(45, 24, '', '', 2, 20, 20, 0, '', '48', '2023-05-24', '2023-05-31', '', '', ''),
(46, 25, 'sample', 'sample', 7, 11, 12, 1, 'sample', '38', '2023-05-25', '2023-06-17', '13', '12', '11'),
(47, 13, '', '', 12, 119, 120, 1, '', '48', '2023-05-25', '2023-06-02', '', '', ''),
(48, 24, '', '', 12, 1800, 2000, 200, '', '48', '2023-05-25', '2023-05-02', '', '', ''),
(49, 28, 'sample notes', 'another sample note', 2, 200, 200, 0, '', '48', '2023-05-29', '2023-05-29', '', '', ''),
(50, 34, 'sample notes again', 'sample note', 15, 240, 250, 10, '', '48', '2023-05-29', '2023-05-31', '', '', ''),
(51, 35, 'sample order note', 'sample deadline notes', 5, 500, 500, 0, 'none', '39', '2023-05-31', '2023-06-02', '13', '12', '10'),
(52, 36, 'sample booking note update', 'sample deadline note update', 11, 5000, 5500, 500, 'sample freebies update', '48', '2023-05-31', '2023-06-24', '15', '10', '13'),
(53, 28, '', '', 15, 150, 150, 0, '', '48', '2023-06-07', '2023-06-07', '', '', '');

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
(4, 47, 50, '', '49', '2023-05-29 14:51:37', NULL),
(5, 49, 200, '', '49', '2023-05-29 14:57:57', NULL),
(6, 50, 240, '', '49', '2023-05-29 15:21:33', NULL),
(11, 46, 2, '', '49', '2023-05-30 10:03:08', 10),
(12, 46, 9, '', '49', '2023-05-30 10:03:33', 10),
(13, 45, 20, '', '49', '2023-05-30 10:33:54', 10),
(14, 51, 250, '', '49', '2023-05-31 10:00:35', 10),
(15, 51, 250, '', '49', '2023-05-31 10:01:19', 10),
(16, 52, 2500, '', '49', '2023-05-31 14:08:25', 15),
(17, 52, 2500, '', '49', '2023-05-31 14:14:24', 15),
(18, 44, 1600, '', '50', '2023-06-15 14:08:42', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference`
--

CREATE TABLE `tbl_reference` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Mockup_design` varchar(255) NOT NULL,
  `Payment_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_reference`
--

INSERT INTO `tbl_reference` (`ID`, `Order_ID`, `Mockup_design`, `Payment_proof`) VALUES
(1, 0, '__Doc2.pdf', ''),
(2, 0, '_Doc2.pdf', ''),
(3, 0, '_Doc2.pdf', ''),
(4, 0, '_Doc1.docx', ''),
(5, 0, '44_24_Doc2.pdf', ''),
(6, 0, '44_24_Doc2.docx', ''),
(7, 44, '44_24_resmon_docs.pdf', ''),
(8, 44, '44_24_MORANCIL_ANGELO_D_RESUME.pdf', ''),
(9, 44, '44_24_CamScanner-06-16-2023-21.47.pdf', ''),
(10, 44, '44_24_CamScanner-06-16-2023-21.47.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
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

INSERT INTO `tbl_user` (`ID`, `FName`, `LName`, `Username`, `Password`, `Locker`, `U_ID`, `Role_ID`, `Role`, `Pass_change`) VALUES
(10, 'angelo', 'morancil', 'gelomorancil', 'a91430953c0a1bcfb3f59af9c98e348db119fed6', '!it#tze()6QDZ<UGI#W$%<uo\\Cn1I@HRHbYx!1H<Si$6azws.@', 'da1e88b29aec11f69cc7f151146daedeb1a9f7ba:d59eed809bd765ce772290c5c66b25355e35a799:f1b020173d8b249bba2c2deb9ea173165c08da8d1', 53, 'Admin', 0),
(11, 'john', 'doe', 'jdoe', '7c4de0a38fa8279bb7bbadfeff1b23ff8da7d0be', 'SDaDzIMhlh<?~8a7SIpWD1S#NU)MfP<tNuJya1<uDO#S!/UGPl', '0f1dbd8e73ac812fad77e2a0074be0a8cb7e42a2:1fda5465e76afe833d724c919d312276785f3ca3:80c1b882f5ebcb7a411a45876e56ec35668bb32c1', 55, 'Front Desk', 0),
(12, 'juan', 'dela cruz', 'jDcruz', 'b3b27bf21e8a28ea161d448e7ad20b3465f95ada', 'oHob~Xz1G4w41EjTu<((l)&Pm8mz*a.fyZ8il^M5Q3dEuTzIqO', '853090b55cebb495c3862d528727f13ab6f20689:447d06d7f844a25c2146a668efce2015687c188d:343a5cf2f271df0d0da3d76b7f4b9b55d297a8201', 56, 'Artist', 0),
(13, 'karl', 'alons', 'kalobq', '9965d5abde1300dc95a6ae95638cba81c527eaac', 'HSr/$@T##vE$V1prKdfB\\If<sUs3dH11D)q9Ubr(3IwsLa^R1k', '7d889db57590936dfd361f74c594106f49c03a27:7ad07cf711905a26f3c18a05efe69d04e5634b08:714ef53e9b4476bf4f77457f052f29a332d208251', 57, 'Production Manager', 0),
(14, 'sample', 'user', 'sampleuser', 'e51fb81e833fb5c7b741b90d85901b2ba31c8768', 'jHv/#dQ7R2dn5qPri2>jG$wP#HsbZd*%qd\\rJjYgRIcJ&g&tu<', 'b05900f96ab65520c2dd10084060775c1566f5bc:1897c735dc8225c0aa67d05d7d325f4231255a7c:18082399d3e77e97d27ed990570453b8c6a7efc21', 55, 'Front Desk', 0),
(15, 'Test', 'User', 'user', '8d81556a3628c6eb81b9195571928eaa0f8032fb', 'kp&1#Y@@GB&K3g~ZVuGs*d*$CheY32!v>Out#qw%iz32W)NudG', '063208698ebf5ba74d4fcfef70955ec83e3d7e7a:40cd9fe8e4aecd66ae7b501d8d7a07d91df73d4a:779b781d1d6cb562be277e579ea776adab3e1d421', 53, 'Admin', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
