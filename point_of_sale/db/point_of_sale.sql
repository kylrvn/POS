-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 10:06 AM
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
(33, 'james', 'yap', 'purefoods', '091626262626', 'Bacolod');

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
(57, 44, 24, 17, 10, 800);

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
  `Deadline` datetime NOT NULL,
  `Sewer_assign` varchar(255) NOT NULL,
  `Layout_artist` varchar(255) NOT NULL,
  `Setup_artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`ID`, `Cust_ID`, `Order_note`, `Deadline_notes`, `Act_qty`, `Total_amt`, `Subtotal`, `Discount`, `Freebies`, `Status`, `Book_date`, `Deadline`, `Sewer_assign`, `Layout_artist`, `Setup_artist`) VALUES
(44, 24, 'nothing', 'nothing', 20, 1600, 1700, 100, '1 tshirt', '48', '2023-05-23', '2023-05-31 00:00:00', '', '', '');

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
(14, 'sample', 'user', 'sampleuser', 'e51fb81e833fb5c7b741b90d85901b2ba31c8768', 'jHv/#dQ7R2dn5qPri2>jG$wP#HsbZd*%qd\\rJjYgRIcJ&g&tu<', 'b05900f96ab65520c2dd10084060775c1566f5bc:1897c735dc8225c0aa67d05d7d325f4231255a7c:18082399d3e77e97d27ed990570453b8c6a7efc21', 55, 'Front Desk', 0);

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
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_list`
--
ALTER TABLE `tbl_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
