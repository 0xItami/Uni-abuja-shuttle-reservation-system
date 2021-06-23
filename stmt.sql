-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2021 at 09:24 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `bus_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ticket_code` varchar(255) DEFAULT NULL,
  `seat_no` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--


-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(11) NOT NULL,
  `bus_id` varchar(255) DEFAULT NULL,
  `seat_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_id`, `seat_no`, `status`, `date`) VALUES
(1, '1', '1', 'taken', '2021-05-28 09:51:01'),
(2, '1', '2', 'free', '2021-05-28 09:56:23'),
(3, '1', '3', 'free', '2021-06-19 09:49:16'),
(4, '1', '4', 'free', '2021-06-19 09:49:16'),
(5, '1', '5', 'free', '2021-06-19 09:49:16'),
(6, '1', '6', 'free', '2021-06-19 09:49:16'),
(7, '2', '1', 'free', '2021-05-28 09:51:01'),
(8, '2', '2', 'free', '2021-05-28 09:56:23'),
(9, '2', '3', 'free', '2021-06-19 09:49:16'),
(10, '2', '4', 'free', '2021-06-19 09:49:16'),
(11, '2', '5', 'free', '2021-06-19 09:49:16'),
(12, '2', '6', 'free', '2021-06-19 09:49:16'),
(13, '3', '1', 'free', '2021-05-28 09:51:01'),
(14, '3', '2', 'free', '2021-05-28 09:56:23'),
(15, '3', '3', 'free', '2021-06-19 09:49:16'),
(16, '3', '4', 'free', '2021-06-19 09:49:16'),
(17, '3', '5', 'free', '2021-06-19 09:49:16'),
(18, '3', '6', 'free', '2021-06-19 09:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `EmailId` varchar(255) NOT NULL,
  `MobileNumber` bigint(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `bus_id` varchar(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Role`, `bus_id` `RegDate`) VALUES
(1, 'Test User', 'user@gmail.com', 9099624342, '1234', 'user', '', '2021-06-19 09:49:16');
(2, 'Test Driver', 'driver1@gmail.com', 9099624342, '1234', 'driver', '1' '2021-06-19 09:49:16');
(3, 'Test Admin', 'admin@gmail.com', 9099624342, '1234', 'admin', '', '2021-06-19 09:49:16');
(4, 'Test Driver2', 'driver1@gmail.com', 9099624342, '1234', 'driver', '2' '2021-06-19 09:49:16');
(5, 'Test Driver'2, 'driver1@gmail.com', 9099624342, '1234', 'driver', '3' '2021-06-19 09:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
