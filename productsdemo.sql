-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 12:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productsdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `type_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `type_id`, `attribute_name`, `attribute_value`) VALUES
(25, 'Exotic Lamp Post', 'L0V3LAMP', '45.0000', 3, 'dimension', '10x100x10'),
(26, 'Carbon Fiber Desk', 'CAR80N1SFANCY', '45.0000', 3, 'dimension', '100x80x300'),
(27, 'Redwood Table', 'RDW00DTBL', '45.0000', 3, 'dimension', '200x80x90'),
(28, 'Lego Bookshelf', 'LEGO2EXP4ME', '45.0000', 3, 'dimension', '300x10x300'),
(29, 'History of Heavy Metal', 'KVLTB00K', '45.0000', 2, 'weight', '1'),
(30, 'Dumb Ways To Die: The Book', '0UCH0W00F', '45.0000', 2, 'weight', '2'),
(31, 'I have no idea what I\'m doing. Vol 6', 'M3T00MAN', '45.0000', 2, 'weight', '2'),
(32, 'Half-Life', 'HL3WHEN', '45.0000', 1, 'size', '350'),
(33, 'Grand Theft Auto: Vice City', 'M1AMIV1C3', '45.0000', 1, 'size', '800'),
(34, 'Iron Maiden - Powerslave LP', '1HAV3IT', '45.0000', 1, 'size', '80'),
(36, 'WALL-E', 'WLLE1SGU7', '15.0000', 1, 'size', '3500'),
(37, 'History of Lamps', 'ILUVLAMP', '1.0000', 2, 'weight', '1'),
(38, 'Test Driven Development', 'T3STER', '15.0000', 1, 'size', '900'),
(40, 'Maple Bed Frame', 'SL33PYT1ME', '300.0000', 3, 'dimensions', '60x200x200'),
(43, 'Stone Statue', 'STA7U3', '500.0000', 3, 'dimensions', '400x100x100'),
(44, 'ACME Disk', 'ACM3D1SK', '5.0000', 1, 'size', '700'),
(46, 'Self-Help for Developers', 'PHPMYAGHHH', '19.9900', 2, 'weight', '0.6');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`) VALUES
(1, 'dvd'),
(2, 'book'),
(3, 'furniture');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
