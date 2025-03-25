-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 03:46 AM
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
  `accountId` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `recovery_token` varchar(100) DEFAULT NULL,
  `verify_token` varchar(100) DEFAULT NULL,
  `isVerify` tinyint(4) NOT NULL DEFAULT '0',
  `isLogin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `recovery_token`, `verify_token`, `isVerify`, `isLogin`, `created_at`) VALUES
('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 'ladyglittersmackles@gmail.com', 'anuada_1990', '$2y$12$9V6a/pa7KWygvvHmd/A37eM5F0BHbIvCA.zsGI3C9Zl1TpsQTo.xi', 'barangay_inc', '', '', 1, 0, NULL),
('7594b921-87ea-437e-bd63-03e2809c3fc2', 'mariah_carey@mailinator.com', 'therealmariah_carey', '$2y$12$qvCWyerLwX34QrtnG6SwIebSrazN.KDGsQrbLagqe6CzJWLKtVvrS', 'deliveries', '', '', 1, 0, NULL),
('eb48b13c-9094-4de4-afc2-786b9dc93f96', 'christopher_pareyac@mailinator.com', 'christopher_pareyac', '$2y$12$7W/t1R9Yj5c0EW4IHzVTmOrJCB/8pBfxhrbmAnDM3y6UTy7jz3skW', 'city_health', NULL, '', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay_inc`
--

CREATE TABLE `barangay_inc` (
  `accountId` varchar(100) NOT NULL DEFAULT '',
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay_inc`
--

INSERT INTO `barangay_inc` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 'Mike', 'Lazardos', 'Floptropica St. Mountain Cebu', '09293929301', '../assets/img/profile/barangay_incharge/6c0b0a91-03a3-4614-a6a9-1a46133e8a60.png');

-- --------------------------------------------------------

--
-- Table structure for table `city_health`
--

CREATE TABLE `city_health` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_health`
--

INSERT INTO `city_health` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
('eb48b13c-9094-4de4-afc2-786b9dc93f96', 'Christopher', 'Pareyac', 'Floptropica', '09284928392', '../assets/img/profile/city_health/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `id_verification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
('7594b921-87ea-437e-bd63-03e2809c3fc2', 'Mariah', 'Carey', 'Floptropica', '09284738274', '../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png');

-- --------------------------------------------------------

--
-- Table structure for table `med_availabilty`
--

CREATE TABLE `med_availabilty` (
  `id` int(11) NOT NULL,
  `med_name` varchar(100) NOT NULL,
  `med_description` text NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) NOT NULL,
  `DosageForm` varchar(100) NOT NULL,
  `DosageStrength` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `city_health_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `med_availabilty`
--

INSERT INTO `med_availabilty` (`id`, `med_name`, `med_description`, `quantity`, `date`, `expiry_date`, `med_image`, `DosageForm`, `DosageStrength`, `category`, `city_health_id`) VALUES
(19, 'Paracetamol', 'It is a common over-the-counter medication used to relieve pain and reduce fever. It is often used for headaches, muscle aches, arthritis, backaches, toothaches, colds, and fevers. Paracetamol is generally considered safe when used as directed, but it can be harmful in excessive doses, leading to liver damage. Always follow dosing instructions and consult a healthcare professional if you have any concerns.', '1000', '2025-03-21 06:43:10', '2026-01-01 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_03202025224310.png', 'Tablet', '500 mg', 'analgesics and antipyretics', 'eb48b13c-9094-4de4-afc2-786b9dc93f96'),
(21, 'Grethers Pastilles', 'Used to soothe throat discomfort and alleviate dry mouth symptoms.', '1000', '2025-03-21 06:52:56', '2026-03-21 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_gretherspastilles_03202025225256.png', 'Pastille', '110000 mg', 'throat lozenges or cough drops', 'eb48b13c-9094-4de4-afc2-786b9dc93f96'),
(22, 'Generic (BIOGESIC)', 'A trusted brand of paracetamol, Paracetamol (Biogesic) is a medication that is typically used to relieve mild to moderate pain such as headache, backache, menstrual cramps, muscular strain, minor arthritis pain, toothache, and reduce fevers caused by illnesses such as the common cold and flu', '10000', '2025-03-21 10:05:31', '2025-03-22 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_generic(biogesic)_03212025030531.png', 'table', '500mg', 'Biogesic 50mg Tablet belongs to a class of medicines known as nonsteroidal anti-inflammatory drugs (', 'eb48b13c-9094-4de4-afc2-786b9dc93f96'),
(24, 'para sa opaw', 'sa buhok', '23', '2025-03-21 11:29:37', '9999-09-09 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_parasaopaw_03212025042937.png', 'Tablet, Capsule, Syrup', 'ml', 'Construction', 'eb48b13c-9094-4de4-afc2-786b9dc93f96');

-- --------------------------------------------------------

--
-- Table structure for table `request_med`
--

CREATE TABLE `request_med` (
  `id` int(11) NOT NULL,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `med_avail_Id` int(11) NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_category` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled','') NOT NULL DEFAULT 'Pending',
  `delivery_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_med`
--

INSERT INTO `request_med` (`id`, `city_health_id`, `barangay_inc_id`, `med_avail_Id`, `request_quantity`, `request_category`, `request_DosageForm`, `request_DosageStrength`, `requestStatus`, `delivery_date`) VALUES
(2, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 19, '10000', 'GEN (Biogesic)', 'Tablet', '2500', 'Accepted', '2025-03-20 00:00:00'),
(3, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 21, '10000', '(GEN) Flu', 'Tablet', '250 ML', 'Accepted', '2025-03-26 00:00:00'),
(4, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 22, '30', 'GEN (Biogesic)', 'Syrup', '500ML', 'Accepted', '2025-03-31 00:00:00');

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
-- Indexes for table `med_availabilty`
--
ALTER TABLE `med_availabilty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_health_id` (`city_health_id`);

--
-- Indexes for table `request_med`
--
ALTER TABLE `request_med`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_health_id` (`city_health_id`),
  ADD KEY `barangay_inc_id` (`barangay_inc_id`),
  ADD KEY `med_avail_Id` (`med_avail_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `med_availabilty`
--
ALTER TABLE `med_availabilty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request_med`
--
ALTER TABLE `request_med`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangay_inc`
--
ALTER TABLE `barangay_inc`
  ADD CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_health`
--
ALTER TABLE `city_health`
  ADD CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `med_availabilty`
--
ALTER TABLE `med_availabilty`
  ADD CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_med`
--
ALTER TABLE `request_med`
  ADD CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_med_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
