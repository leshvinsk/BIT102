-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 02:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `LoyaltyNumber` varchar(20) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Submission` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `UserID`, `FullName`, `LoyaltyNumber`, `Rating`, `Message`, `Submission`) VALUES
(1, 4, 'James', '852484734', 5, 'Good implementation of the system and nice layout', '2024-07-15 00:23:15'),
(2, 4, 'James Chang', '852484734', 3, 'Good system', '2024-07-15 06:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_quantity`, `item_price`) VALUES
(1, 'Arugula Chicken Salad', 48, 11.90),
(2, 'Caesar Salad ', 48, 9.90);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `TransactionID` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `LoyaltyNumber` varchar(255) NOT NULL,
  `Currency` varchar(10) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `Timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `TransactionID`, `UserID`, `FullName`, `LoyaltyNumber`, `Currency`, `Amount`, `Status`, `PaymentMethod`, `Timestamp`) VALUES
(1, 'cs_test_b1ekppsLPjKW1138bL4yl2gHKYuC9yYtbjP1ietlJY2pxld81OVU72G2Vq', 4, 'James Chang', '852484734', 'USD', '77.30', 'Paid', 'Stripe', '2024-07-14 23:32:36'),
(2, 'cs_test_a1zJgKBbrRhN19xiK6zEyUeBcx2Z03cQlkQvoabWJMYIGjbx1nbBnQF8XT', 4, 'James Chang', '852484734', 'USD', '59.50', 'Paid', 'Stripe', '2024-07-14 23:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `LoyaltyNumber` varchar(20) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Username`, `Password`, `Email`, `LoyaltyNumber`, `Role`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'Leshvin', 'leshsk', 'd191fea507912710877abdfe1207bde30d6df9bccd8aba91ed8a7749a24154b2', 'leshvinsk@gmail.com', '968394800', 'Staff', NULL, NULL),
(2, 'Sukesh', 'keshz', '50c684903cad0d64dd4ca72f5520851e7b8ee102f23b1d6fce187268db88209b', 'keshz@gmail.com', '750762008', 'Staff', NULL, NULL),
(3, 'Hwang Eurjin', 'eurjin', '82c0681a780d57e1715473310fe55402d2d48b30d491856eeaa614a8fe14dd9f', 'eurjin@gmail.com', '254159002', 'Staff', NULL, NULL),
(4, 'James Chang', 'james20', '2ab1139569eebf2a743e4f10e58a70e784d6581849ec7f265bdf43d17fbdfeea', 'm-1668785@moe-dl.edu.my', '852484734', 'Customer', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Username` (`Username`),
  ADD KEY `LoyaltyNumber` (`LoyaltyNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
