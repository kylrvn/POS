-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 05:36 PM
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
(1, 'angelo', 'morancil', '', '091234567', 'Bacolod'),
(2, 'kevin', 'daniel', 'sample', '0912378381', 'Bacolod'),
(3, 'sample', 'sample', 'sample', '1232131232', 'Bacolod'),
(4, 'new', 'customer', '', '0932823232', 'Bacolod');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Descr` varchar(255) NOT NULL,
  `Actual_Money` int(10) NOT NULL,
  `Balance` int(10) NOT NULL,
  `Incharge` varchar(255) NOT NULL,
  `expense` int(10) NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`ID`, `Date`, `Descr`, `Actual_Money`, `Balance`, `Incharge`, `expense`, `Branch`, `Image`, `date_created`) VALUES
(1, '2023-08-03', 'sample expense', 200, 0, '17', 200, '', 'papa1.jpg', '2023-08-03 23:06:06'),
(2, '2023-08-03', 'sample 2', 100, -10, '20', 110, '', 'mama.jpg', '2023-08-03 23:08:44'),
(3, '2023-08-16', 'sample3ds', 100, 0, '17', 100, '', '', '2023-08-03 23:11:52'),
(10, '2023-08-14', 'sampke new update', 1222, 922, '17', 300, '', 'underatking1.jpg', '2023-08-14 23:12:39'),
(11, '2023-08-15', 'bago ni sa ', 200, 100, '17', 100, '', 'PayslipJuly15231.png', '2023-08-15 17:10:35'),
(12, '2023-08-15', 'bago ni lwat', 222, 122, '17', 100, '', 'pexels-ono-kosuki-5648103.jpg', '2023-08-15 17:12:37'),
(13, '2023-08-17', 'sample again', 123456, 100224, '17', 23232, '', '367683835_971563704153256_7968492444444433043_n.jpg', '2023-08-17 22:33:59');

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
(79, 1, 1, 14, 5, 1250),
(80, 2, 2, 16, 2, 200),
(81, 3, 3, 23, 2, 200),
(82, 4, 2, 17, 12, 1728),
(83, 5, 2, 10, 2, 110),
(84, 6, 4, 13, 2, 300);

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
(37, 'Job Order - For Layout', 'Status'),
(38, 'On-Layout', 'Status'),
(39, 'On-Approval', 'Status'),
(40, 'With Revision', 'Status'),
(41, 'Client-Waiting Approval', 'Status'),
(42, 'Waiting Downpayment', 'Status'),
(43, 'For Pattern', 'Status'),
(44, 'Pattern Ready', 'Status'),
(45, 'For J.O Receipt # - Proceed Production', 'Status'),
(46, 'Receipt Card - Artist Copy', 'Status'),
(47, 'On Hold / Waiting Payment', 'Status'),
(49, 'Cash', 'Payment'),
(50, 'Online Payment', 'Payment'),
(51, 'Cash On Delivery (COD)', 'Payment'),
(52, 'Terms', 'Payment'),
(53, 'Admin', 'User Role'),
(54, 'Cashier', 'User Role'),
(55, 'Front Desk', 'User Role'),
(56, 'Artist', 'User Role'),
(57, 'Production Manager', 'User Role'),
(58, 'Production Staff', 'User Role'),
(60, 'Bacolod', 'Branch'),
(61, 'Cebu', 'Branch'),
(62, 'iloilo', 'Branch');

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
  `Jo_num` varchar(255) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `Order_note` varchar(500) NOT NULL,
  `Deadline_notes` varchar(500) NOT NULL,
  `Act_qty` int(11) NOT NULL,
  `Total_amt` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Discount` double NOT NULL,
  `Freebies` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT '37',
  `Book_date` date NOT NULL,
  `Deadline` date NOT NULL,
  `Sewer_assign` varchar(255) NOT NULL,
  `Layout_artist` varchar(255) NOT NULL,
  `Setup_artist` varchar(255) NOT NULL,
  `Payment_status` varchar(255) NOT NULL DEFAULT 'UNPAID',
  `Cancelled` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`ID`, `Jo_num`, `Cust_ID`, `Order_note`, `Deadline_notes`, `Act_qty`, `Total_amt`, `Subtotal`, `Discount`, `Freebies`, `Status`, `Book_date`, `Deadline`, `Sewer_assign`, `Layout_artist`, `Setup_artist`, `Payment_status`, `Cancelled`) VALUES
(1, 'JO-001', 1, '', '', 5, 1250, 1250, 0, '', '45', '2023-07-21', '2023-07-21', '19', '21', '', 'PAID', 0),
(2, 'JO-002', 2, '', '', 2, 200, 200, 0, '', '37', '2023-07-27', '2023-07-27', '', '21', '', 'PAID', 0),
(3, 'JO-003', 3, '', '', 2, 200, 200, 0, '', '37', '2023-08-05', '2023-08-05', '', '', '', 'PAID', 0),
(4, 'JO-004', 2, '', '', 12, 1728, 1728, 0, '', '37', '2023-08-14', '2023-08-14', '', '', '', 'DOWN', 0),
(5, 'JO-005', 2, '', '', 2, 110, 110, 0, '', '37', '2023-08-15', '2023-08-25', '', '', '', 'PAID', 0),
(6, 'JO-006', 4, '', '', 2, 300, 300, 0, '', '37', '2023-08-30', '2023-08-30', '', '', '', 'UNPAID', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Amount_paid` double NOT NULL,
  `Amount_rendered` double NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Payment_mode` varchar(255) NOT NULL,
  `Date_paid` datetime NOT NULL,
  `Incharge_ID` int(11) DEFAULT NULL,
  `Receipt_num` varchar(255) NOT NULL,
  `Due_date` date DEFAULT NULL,
  `Void` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`ID`, `Order_ID`, `Amount_paid`, `Amount_rendered`, `Status`, `Payment_mode`, `Date_paid`, `Incharge_ID`, `Receipt_num`, `Due_date`, `Void`) VALUES
(4, 1, 100, 0, '', '49', '2023-07-27 09:23:40', 17, '', NULL, 0),
(5, 2, 100, 0, '', '50', '2023-07-27 09:24:03', 17, '', NULL, 0),
(6, 3, 100, 0, '', '50', '2023-08-05 10:26:25', 17, '', NULL, 0),
(7, 3, 100, 0, '', '49', '2023-08-13 11:47:31', 17, '', NULL, 0),
(8, 4, 100, 0, '', '50', '2023-08-14 22:57:03', 17, '', NULL, 0),
(9, 5, 10, 0, '', '49', '2023-08-15 22:22:35', 17, '8263726', NULL, 0),
(10, 5, 10, 0, '', '50', '2023-08-15 22:23:08', 17, '', NULL, 0),
(22, 4, 0, 0, '', '51', '2023-08-22 21:13:17', 17, '312321312', '2023-08-26', 0),
(25, 4, 100, 0, '', '49', '2023-08-22 21:39:26', 17, '14213131', '0000-00-00', 0),
(29, 4, 0, 0, '', '52', '2023-08-22 22:04:45', 17, '132145421', '2023-09-08', 0),
(30, 4, 500, 0, '', '50', '2023-08-22 22:05:18', 17, '423421', '0000-00-00', 0),
(31, 4, 0, 0, '', '52', '2023-08-22 22:07:40', 17, '', '2023-09-01', 0),
(32, 4, 30, 0, '', '49', '2023-08-24 22:53:26', 17, '1231', '0000-00-00', 1);

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
(2, 2, '1_papa.jpg'),
(3, 3, '1_pexels-ono-kosuki-5648103.jpg'),
(4, 4, ''),
(5, 5, '2_papa.jpg'),
(6, 6, '3_B.png'),
(7, 7, ''),
(8, 8, '4_receipt.jpg'),
(9, 10, '5_photo-1519046904884-53103b34b206.jpg'),
(12, 16, '5_367683835_971563704153256_7968492444444433043_n.jpg'),
(13, 17, '5_367683835_971563704153256_7968492444444433043_n.jpg'),
(14, 18, '5_photo-1519046904884-53103b34b206.jpg'),
(15, 30, '4_underatking.jpg');

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
(2, 2, '2_2_pexels-ivan-samkov-5676679.jpg', 0, ''),
(5, 2, '2_2_Signature.png', 0, ''),
(6, 4, '4_2_photo-1519046904884-53103b34b206.jpg', 0, '');

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
  `Pass_change` int(11) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `FName`, `LName`, `Username`, `Branch`, `Password`, `Locker`, `U_ID`, `Role_ID`, `Role`, `Pass_change`, `Active`) VALUES
(17, 'Super', 'Admin', 'superadmin', '', 'a91430953c0a1bcfb3f59af9c98e348db119fed6', '!it#tze()6QDZ<UGI#W$%<uo\\Cn1I@HRHbYx!1H<Si$6azws.@', '720910dacbdce4695a27a3cbbc85b5f9bd1975b8:bbf461b5e7223da33a1ae3433b2b1548fc8d7cf0:2a6da1c5e31c5da22a56070d310b10d0c79ce5d71', 53, 'Admin', 0, 1),
(19, 'Cebu', 'User', 'cebu_user', 'Cebu', 'ceba418f83ec6b44fc7cbe90554cbbaa0f4bb8f9', '%4(^NY@Md*oVx14#hzP1nYYwMAzDEb?Rw(E)M>)1>IvN*Ky12#', 'db34888ccc79d8fafd19273ffea6aa9bf0eefcbe:8f3bbe4c9a8eefa13d6a2f5994950d5c484b7854:0a69b3262059b7e967bd6ea929581a30b956fcfa1', 53, 'Admin', 0, 1),
(20, 'Bacolod', 'User', 'bacolod_user', 'Bacolod', '1e6d2d9618a7174469025c62084e6e56dbfc58eb', '8UABBh^/3D9Ic>^1DBRBgD)EtI$u?vY&awH&(QMQHw8^6fkZYC', '9d9ad58e688f7ea2268235b9325dd96de8e0b003:36f29d24c8ee8729f9635834d8b48f61ac2620ff:bb2afc7b6bc085f920db0376495f7795141ae1c91', 53, 'Admin', 0, 1),
(21, 'Angelo', 'Morancil', 'gelomorancil', 'Bacolod', 'cfcaf686cb8ae67778844fa3729a1c3702ddee6b', '#aZnqpZO0ixT4At$1LIW1I>Yigymw)PSqQ<(QHWqPv19&>yPOM', '1a958fedebf8dfa6ee786279e827c19a5c7639fc:d2068db76dfa36723a4e125de061bd7dde8d09a9:724f9d7c70e51a1711393e2d747463f7632bd2de1', 56, 'Artist', 0, 1),
(22, 'maria', 'ozawa', 'bacolod_cashier', 'Bacolod', '7c3d858df57355965216783c8beb7acae61306fd', 'Qu^$Xq5$r3Y3ky621JFB>BNm^(yf9wl\\bPItHDR.MKd%HIZa/$', 'a6041a358c106cd25a7cc1c6c2205f332658189c:ad9cf528bf38a13143767b4fa711b7b60d682d73:d7b4ed3cfb8d134b1af45e3d28b415120be287621', 54, 'Cashier', 0, 1),
(23, 'mang', 'kanor', 'bacolod_frontdesk', 'Bacolod', '716ed652bdfbc67c152364c48c413541a89b0c64', 'wc11QNB#\\N!Xwc$!o>A.$o$h6ZgCPD?QC1WC7hy$$J.Qyg^9Mx', 'ecb0064767328759cc2e1393d96974477a9f234b:9e5b740895cd4f0280d631ce4bb1b1b11e1a3f99:8659758313c48da220e4da826e7c79646d4bf7881', 55, 'Front Desk', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_list`
--
ALTER TABLE `tbl_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_proof`
--
ALTER TABLE `tbl_proof`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
