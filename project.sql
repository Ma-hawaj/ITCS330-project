-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 06:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderdets`
--

CREATE TABLE `orderdets` (
  `order_ID` int(15) NOT NULL,
  `PID` int(15) NOT NULL,
  `qty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderdets`
--

INSERT INTO `orderdets` (`order_ID`, `PID`, `qty`) VALUES
(1, 5, 1),
(1, 4, 1),
(1, 9, 1),
(2, 5, 1),
(2, 4, 2),
(3, 5, 1),
(3, 4, 2),
(4, 6, 1),
(5, 8, 3),
(6, 7, 1),
(6, 10, 1),
(7, 5, 1),
(7, 6, 1),
(7, 7, 1),
(7, 8, 1),
(8, 4, 1),
(8, 8, 1),
(9, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` bigint(20) UNSIGNED NOT NULL,
  `user_ID` int(15) NOT NULL,
  `date` datetime NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `date`, `total_price`) VALUES
(1, 2, '2023-01-03 11:00:02', 67),
(2, 2, '2023-01-03 22:11:27', 85),
(3, 2, '2023-01-03 22:13:39', 85),
(4, 2, '2023-01-03 22:14:39', 23),
(5, 2, '2023-01-03 22:16:12', 39),
(6, 2, '2023-01-03 22:27:12', 27),
(7, 2, '2023-01-03 22:28:45', 81),
(8, 2, '2023-01-03 22:29:41', 38),
(9, 2, '2023-01-03 22:30:14', 200);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `qty` int(5) NOT NULL,
  `category` varchar(25) NOT NULL,
  `image` varchar(40) NOT NULL,
  `description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `name`, `price`, `qty`, `category`, `image`, `description`) VALUES
(1, 'amazon echo with screen', 100, 0, 'Smart switches', 'images/amazon echo show.jpg', '[value-7]'),
(4, 'lockly secure lock', 25, 0, 'Smart switches', 'images/locky.jpg', ''),
(5, 'locky secure pro lock', 35, 1, 'Smart switches', 'images/locky1.jpg', ''),
(6, 'Philips Hue Slim LED', 23, 5, 'Smart lights', 'images/philips light.jpg', ''),
(7, 'Amazon Basics Smart A19 LED', 10, 22, 'Smart lights', 'images/amazon light.jpg', ''),
(8, 'GE CYNC Smart LED', 13, 9, 'Smart lights', 'images/cync light.jpg', ''),
(9, 'GE CYNC Smart LED Light Strip', 7, 42, 'Smart lights', 'images/cync light strip.jpg', ''),
(10, 'Amazon Basics Smart In-Wall Outlet', 17, 21, 'smart plugs', 'images/amazon plug.jpg', ''),
(11, 'GE CYNC Outdoor Smart Plug', 63, 8, 'smart plugs', 'images/sync plug.jpg', ''),
(12, 'tp link smart plug', 26, 22, 'smart plugs', 'images/tp link.jpg', ''),
(14, 'smart plug', 2, 77, 'smart plugs', 'images/11386041.png', ''),
(15, 'amazon echo', 550, 2, 'voice assistants', 'images/amazon echo.jpg', ''),
(16, 'google home', 69, 23, 'voice assistants', 'images/google home.png', ''),
(17, 'sengled bulb', 3, 44, 'Smart lights', 'images/sengled bulb.jpg', ''),
(18, 'one safe fire sensor', 42, 53, 'smart sensors', 'images/fire.jpg', ''),
(19, 'Govee WiFi Water Sensor', 24, 7, 'smart sensors', 'images/wifi.jpg', ''),
(20, 'meon Water Leak Detector', 52, 23, 'smart sensors', 'images/water leek.jpg', ''),
(21, 'energy sensor', 25, 42, 'smart sensors', 'images/swnse.jpg', ''),
(22, 'emrson thermostat', 23, 23, 'smart controllers', 'images/temp.jpg', ''),
(23, 'amazon astro', 333, 1, 'voice assistants', 'images/astro.jpg', ''),
(24, 'LEVOIT Air Purifiers', 69, 21, 'smart controllers', 'images/purifier.jpg', ''),
(25, 'kasa smart light switch', 2, 77, 'Smart switches', 'images/switfch.jpg', ''),
(26, 'Smart Light Switch', 3, 88, 'Smart switches', 'images/ben.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `state`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(8) NOT NULL,
  `block` int(5) DEFAULT NULL,
  `street` int(6) DEFAULT NULL,
  `home` varchar(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `pass`, `name`, `phone`, `block`, `street`, `home`, `admin`) VALUES
(1, 'aliaref', '$2y$10$1nh7JtI/pxq7hKnXk7B86e3qt/mGIXtI8WVMZ2YRRNWXzO0usp2Jm', 'aliaref', 69696969, 6955, 8786, '4646', 1),
(2, 'aliarefthewok', '$2y$10$kl5z8mHJ/HwRLErrfO3KOOMS/1atPyr6W6esI9WMdaLxN18VPiqoi', 'bing', 69696969, 6969, 6969, '6969', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD UNIQUE KEY `order_ID` (`order_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PID`),
  ADD UNIQUE KEY `PID` (`PID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
