-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 17, 2024 at 05:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starlistdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `storeName1` varchar(50) NOT NULL,
  `netWeight1` decimal(10,2) NOT NULL,
  `totalPrice1` decimal(10,2) NOT NULL,
  `storeName2` varchar(50) NOT NULL,
  `netWeight2` decimal(10,2) NOT NULL,
  `totalPrice2` decimal(10,2) NOT NULL,
  `storeName3` varchar(50) NOT NULL,
  `netWeight3` decimal(10,2) NOT NULL,
  `totalPrice3` decimal(10,2) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT 0,
  `unitType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `userID`, `itemName`, `category`, `unit`, `storeName1`, `netWeight1`, `totalPrice1`, `storeName2`, `netWeight2`, `totalPrice2`, `storeName3`, `netWeight3`, `totalPrice3`, `checked`, `unitType`) VALUES
(3, 17, 'Bananas', 'Produce', 'pound', 'Kroger', 1.00, 2.40, '', 0.00, 0.00, '', 0.00, 0.00, 1, 'weight'),
(7, 17, 'Eggs', 'Dairy', 'pound', 'Kroger', 3.00, 5.00, '', 0.00, 0.00, '', 0.00, 0.00, 0, 'weight'),
(8, 17, 'Ponzu Sauce', 'Condiments', 'fluidOunce', '99', 8.00, 4.25, '', 0.00, 0.00, '', 0.00, 0.00, 0, 'liquid'),
(9, 17, 'Apples', 'Produce', 'pound', 'Jetro', 1.00, 2.50, '', 0.00, 0.00, '', 0.00, 0.00, 0, 'weight'),
(15, 17, '2% Milk', 'Dairy', 'liter', 'Farm', 2.00, 3.99, 'Sunrise Market', 4.00, 4.99, '', 0.00, 0.00, 0, 'liquid'),
(17, 17, 'Bread', 'Bakery', 'gram', '', 0.00, 0.00, '', 0.00, 0.00, '', 0.00, 0.00, 0, 'weight'),
(18, 17, 'Croissants', 'Bakery', 'gram', 'Farm', 2.00, 11.55, '99', 2.00, 7.50, '', 0.00, 0.00, 0, 'weight'),
(19, 17, 'Apple Juice', 'Beverages', 'gram', 'Farm', 2.00, 11.55, '99', 2.00, 7.50, '', 0.00, 0.00, 0, 'weight'),
(20, 17, 'Brown Sugar', 'Baking Supplies', 'gram', 'Farm', 2.00, 11.55, '99', 2.00, 7.50, '', 0.00, 0.00, 0, 'weight'),
(21, 17, 'Ginger', 'Produce', 'gram', 'Farm', 2.00, 11.55, '99', 2.00, 7.50, '', 0.00, 0.00, 0, 'weight');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `username`, `password`) VALUES
(17, 'exmaple@gmail.com', 'tester', '$2y$10$jOOiQSW6PWjRC8Olbo9O7expydro6fk4owdYqwCCjzPwe5K9tQu.i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
