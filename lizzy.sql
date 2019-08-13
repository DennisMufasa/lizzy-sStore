-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 11:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lizzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `unitCost` int(11) NOT NULL,
  `retail_cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`productId`, `productName`, `category`, `details`, `unitCost`, `retail_cost`, `quantity`) VALUES
(2, 'khaki trouser', 'khakis', '                                    brown, 34 waits 42 hieght', 2000, 2500, 30),
(3, 'official shirt', 'new_shirts', '                                    brand new ', 1200, 1500, 12),
(4, 'watch', 'accessories', '                                    rolex', 2000, 2500, 3),
(6, 'official shirt L', 'new_shirts', '                                    size large colours: red, blue, checked, stripped', 1200, 1300, 5),
(7, 'official shirt XL', 'new_shirts', '                                  size Extra Large colours:  red, black, blue, green', 1000, 1300, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `unitCost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `loss` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleId`, `productName`, `category`, `unitCost`, `quantity`, `profit`, `loss`, `income`, `timestamp`) VALUES
(1, 'official shirt', 'new_shirts', 1000, 2, 800, 0, 2800, '2019-08-05 15:29:57'),
(2, 'official shirt', 'new_shirts', 1000, 1, 400, 0, 1400, '2019-08-08 09:57:14'),
(3, 'watch', 'accessories', 2000, 1, 200, 0, 2200, '2019-08-08 10:18:56'),
(4, 'watch', 'accessories', 2000, 1, 200, 0, 2200, '2019-08-08 10:23:27'),
(5, 'official shirt XL', 'new_shirts', 1000, 2, 600, 0, 2600, '2019-08-08 10:47:24'),
(6, 'watch', 'accessories', 2000, 3, 1000, 0, 7000, '2019-08-09 12:10:04'),
(9, 'watch', 'accessories', 2000, 1, 0, 200, 1800, '2019-08-09 12:44:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productName` (`productName`),
  ADD UNIQUE KEY `productName_2` (`productName`),
  ADD UNIQUE KEY `productName_3` (`productName`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
