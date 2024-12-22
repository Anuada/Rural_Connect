-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 05:00 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `med_deliveries`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `isLogin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `isLogin`) VALUES
(18, 'Nat@gmail.com', 'nat123', '$2y$10$AgzkzuGuQAd68rYE2tELjO4ICWWKlJ4tOONQqiMbxce/adG6nKQKW', 'deliveries', 1),
(19, 'jeremy@gmail.com', 'Jeremy', '$2y$10$AgzkzuGuQAd68rYE2tELjO4ICWWKlJ4tOONQqiMbxce/adG6nKQKW', 'Admin', 1),
(20, 'dfs@gmail.com', 'wer', '$2y$10$KJq223QQR3MqQn/ZqV/piO.VtC4/Hk.w37cenr7AJyZNIlGuSYvG2', 'deliveries', 0),
(21, 'bohol@gmail.com', 'Bohol123', '$2y$10$BPfJ5shL4vEXkyQ8GBXprOU7oRWpwPWOxVRAJu/MDRgUp9Qovpw/G', 'barangay_inc', 0),
(22, 'Shanesy@gmail.com', 'Shane12', '$2y$10$ZUiAKQMneiCICCiPZmHiV.I3B73l75gjP80Gq5HZSZ35Xs6Q4A77a', 'city_health', 0),
(23, 'ex@gmail.com', 'ex123', '$2y$10$3wPURXiLXynaLwY0wLd.oOkwk/5kgGS93mf94PtvH7yj1c7gyOahW', 'deliveries', 0),
(24, 'dsdf@gmail.com', 'ex3', '$2y$10$h163WYAfbYQHSOHWhLljPOpGFJY1zzZ.9ZwlJedhUNCwqRFOo8EFW', 'deliveries', 0),
(25, 'jhane@gmail.com', 'jhane45', '$2y$10$7ktE3L4DhjUOuyEzNU9wSueeRkl.8h0R6fXbRoXN8D66CpceYJQgC', 'city_health', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `accountId` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `profileImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`accountId`, `fname`, `lname`, `address`, `DOB`, `contactNo`, `profileImage`) VALUES
(19, 'Jeremy', 'Gamboa', 'Emall St. Cebu city', '2024-12-03', '09695327153', '18.png');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_inc`
--

CREATE TABLE `barangay_inc` (
  `accountId` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `profileImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay_inc`
--

INSERT INTO `barangay_inc` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `profileImage`) VALUES
(21, 'Ericson', 'Anuada', 'Bohol', '09123', '21.png'),
(26, 'sdfs', 'dsfs', 'eeee', '6757', '26.png'),
(27, 'ddddd', 'ddawdWA', 'd', '99', ''),
(28, 'sda', 'sdfsadf', 'dsfsf', '5464', '28.png');

-- --------------------------------------------------------

--
-- Table structure for table `city_health`
--

CREATE TABLE `city_health` (
  `accountId` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `profileImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_health`
--

INSERT INTO `city_health` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `profileImage`) VALUES
(22, 'Shanesy', 'Gabato', 'Mountain St. Cebu City', '093453243', '22.png'),
(25, 'Jhane', 'Heralis', 'Availia St. Cebu City', '90884', '');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `accountId` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `profileImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `profileImage`) VALUES
(18, 'Nathaniel', 'Quezon', 'Lorega', '0987888', '18.png'),
(20, 'Daniel', 'Anuada', 'zapatera', '4564', '20.png'),
(23, 'Exmple', 'sss', 'dkjkad', '44444', ''),
(24, 'ex3', 'Lazaros', 'ff', '4564', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `barangay_inc`
--
ALTER TABLE `barangay_inc`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `city_health`
--
ALTER TABLE `city_health`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`accountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `barangay_inc`
--
ALTER TABLE `barangay_inc`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `city_health`
--
ALTER TABLE `city_health`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_health`
--
ALTER TABLE `city_health`
  ADD CONSTRAINT `city_health_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
