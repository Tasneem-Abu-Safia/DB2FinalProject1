-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 03:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartno` int(10) NOT NULL,
  `cno` int(10) NOT NULL,
  `pno` int(5) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cno` int(10) NOT NULL,
  `cname` varchar(30) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `phone` char(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cno`, `cname`, `street`, `city`, `state`, `zip`, `phone`, `email`, `password`) VALUES
(2, 'ali', 'rimal', 'gaza', 'palestine', 12555, '111-111-1111', 'ali@gmail.com', '123123123'),
(14, 'tasneem', 's1', 'c1', 'ss1', 2133, '059999', 'tas@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `odetails`
--

CREATE TABLE `odetails` (
  `ono` int(5) NOT NULL,
  `pno` int(5) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `odetails`
--

INSERT INTO `odetails` (`ono`, `pno`, `qty`) VALUES
(54, 10601, 6),
(54, 15996, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ono` int(5) NOT NULL,
  `cno` int(10) DEFAULT NULL,
  `received` date DEFAULT NULL,
  `shipped` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ono`, `cno`, `received`, `shipped`) VALUES
(54, 14, '2021-12-04', '2021-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `pno` int(5) NOT NULL,
  `pname` varchar(30) DEFAULT NULL,
  `qoh` int(11) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `olevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`pno`, `pname`, `qoh`, `price`, `olevel`) VALUES
(0, 'Snow White', 30, '20.00', 7),
(10012, 'CINDERELLA', 60, '10.00', 9),
(10601, 'Sleeping Beauty', 44, '24.99', 12),
(15896, 'BAMBI', 20, '13.00', 10),
(15996, 'Land Before Time I', 41, '19.99', 16),
(17756, 'Snow White', 30, '20.00', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartno`,`pno`),
  ADD KEY `cno` (`cno`,`pno`),
  ADD KEY `pno` (`pno`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `odetails`
--
ALTER TABLE `odetails`
  ADD PRIMARY KEY (`ono`,`pno`),
  ADD KEY `ono` (`ono`,`pno`),
  ADD KEY `pno` (`pno`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ono`),
  ADD KEY `cno` (`cno`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`pno`),
  ADD UNIQUE KEY `pno` (`pno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ono` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cno`) REFERENCES `customers` (`cno`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `parts` (`pno`);

--
-- Constraints for table `odetails`
--
ALTER TABLE `odetails`
  ADD CONSTRAINT `odetails_ibfk_1` FOREIGN KEY (`ono`) REFERENCES `orders` (`ono`),
  ADD CONSTRAINT `odetails_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `parts` (`pno`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cno`) REFERENCES `customers` (`cno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
