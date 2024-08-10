-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 11:28 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asherindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` varchar(5) NOT NULL,
  `custName` varchar(50) NOT NULL,
  `custAddress` varchar(200) NOT NULL,
  `custDelivAddr` varchar(200) NOT NULL,
  `custContactP` varchar(20) NOT NULL,
  `custPhone` varchar(20) NOT NULL,
  `custNPWP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `custName`, `custAddress`, `custDelivAddr`, `custContactP`, `custPhone`, `custNPWP`) VALUES
('A001', 'PT. Armada', 'Laksamana St. No. 324', 'Laksamana St. No. 324', 'AJ', '(+62) 313 2345 078', '023619509761312'),
('NL001', 'CV Narpati Lailasari', 'Psr. Pasir Koja No. 587', 'Ki. Gotong Royong No. 888', 'Brian', '(+62) 812 2077 0346', '635071330481416'),
('W001', 'PT. Winarno', 'Dipenogoro No. 187', 'Barat St. No. 900', 'Hani', '(+62) 860 6300 8611', '366334846759135');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoiceID` varchar(10) NOT NULL,
  `itemID` varchar(5) NOT NULL,
  `itemQty` int(5) NOT NULL,
  `itemPrice` double NOT NULL,
  `itemSubTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoiceID`, `itemID`, `itemQty`, `itemPrice`, `itemSubTotal`) VALUES
('INV002', 'I001', 12, 1000, 12000),
('INV002', 'I002', 1, 33, 33),
('INV005', 'I001', 10, 2000, 20000),
('INV005', 'I002', 11, 750, 8250),
('INV001', 'I001', 10, 15000, 150000),
('INV001', 'C003', 3, 60000, 180000),
('invoice2', 'I001', 10, 20000, 200000),
('invoice2', 'I002', 13, 2323, 30199);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_header`
--

CREATE TABLE `invoice_header` (
  `invoiceID` varchar(10) NOT NULL,
  `invoiceDate` date NOT NULL,
  `custID` varchar(5) NOT NULL,
  `invoiceGrandTotal` double NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_header`
--

INSERT INTO `invoice_header` (`invoiceID`, `invoiceDate`, `custID`, `invoiceGrandTotal`, `note`) VALUES
('INV001', '2023-02-13', 'A001', 330000, 'Please pay before the agreed-upon date.'),
('INV002', '2023-01-29', 'A001', 12033, 'nothing'),
('INV005', '2023-01-29', 'W001', 28250, ''),
('invoice2', '2023-02-03', 'NL001', 230199, '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` varchar(5) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `itemUnit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemUnit`) VALUES
('C003', 'CaCO3', 'kg'),
('I001', 'MgCL', 'kg'),
('I002', 'H2O2', 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

CREATE TABLE `item_details` (
  `itemID` varchar(5) NOT NULL,
  `suppID` varchar(5) NOT NULL,
  `purchasePrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`itemID`, `suppID`, `purchasePrice`) VALUES
('I001', 'P001', 12000),
('I001', 'HM001', 12500),
('I002', 'HM001', 200000),
('I002', 'L001', 220000),
('C003', 'HM001', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` varchar(15) NOT NULL,
  `salesDate` date NOT NULL,
  `custID` varchar(5) NOT NULL,
  `delivAddress` varchar(200) NOT NULL,
  `delivDate` date NOT NULL,
  `grandTotalSellPrice` double NOT NULL,
  `grandTotalMargin` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesID`, `salesDate`, `custID`, `delivAddress`, `delivDate`, `grandTotalSellPrice`, `grandTotalMargin`) VALUES
('SO001', '2023-02-13', 'A001', 'Laksamana St. No. 324', '2023-02-16', 330000, 60000),
('SO002', '2023-02-01', 'A001', 'Laksamana St. No. 324', '2023-02-01', 808000, 164000),
('SO003', '2023-01-27', 'NL001', 'Ki. Gotong Royong No. 888', '2023-02-02', 2790000, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `salesID` varchar(15) NOT NULL,
  `itemID` varchar(5) NOT NULL,
  `itemQty` float NOT NULL,
  `suppID` varchar(5) NOT NULL,
  `purchasePrice` double NOT NULL,
  `subTotalPurchase` double NOT NULL,
  `sellPrice` double NOT NULL,
  `subTotalSell` double NOT NULL,
  `margin` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`salesID`, `itemID`, `itemQty`, `suppID`, `purchasePrice`, `subTotalPurchase`, `sellPrice`, `subTotalSell`, `margin`) VALUES
('SO002', 'C003', 10, 'HM001', 50000, 500000, 64000, 640000, 140000),
('SO002', 'I001', 12, 'P001', 12000, 144000, 14000, 168000, 24000),
('SO003', 'I001', 50, 'HM001', 12500, 625000, 15000, 750000, 125000),
('SO003', 'C003', 20, 'HM001', 45000, 900000, 47000, 940000, 40000),
('SO003', 'I002', 5, 'HM001', 199000, 995000, 220000, 1100000, 105000),
('SO001', 'I001', 10, 'P001', 12000, 120000, 15000, 150000, 30000),
('SO001', 'C003', 3, 'HM001', 50000, 150000, 60000, 180000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `suppID` varchar(5) NOT NULL,
  `suppName` varchar(50) NOT NULL,
  `suppAddress` varchar(200) NOT NULL,
  `suppDelivAddr` varchar(200) NOT NULL,
  `suppContactP` varchar(20) NOT NULL,
  `suppPhone` varchar(20) NOT NULL,
  `suppNPWP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`suppID`, `suppName`, `suppAddress`, `suppDelivAddr`, `suppContactP`, `suppPhone`, `suppNPWP`) VALUES
('HM001', 'CV Halimah Nababan', 'Basuki No. 529', 'Basuki No. 529', 'Janet', '(+62) 8978769809', '124327890123454'),
('L001', 'PT. Lailasari', 'Jayawijaya No. 437', 'Jayawijaya No. 437', 'Julia', '(+62) 827 5803 5258', '386234438974541'),
('P001', 'PT. Palastri', 'M.T. Haryono No. 841', 'Laksamana No. 425', 'Alex', '(+62) 208 8954 9925', '093512392087382');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `password`, `name`, `email`) VALUES
('abcde', 'abcde234ZZZ', 'ABC', 'abcde@gmail.com'),
('user', 'user123', 'User', 'user@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`suppID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
