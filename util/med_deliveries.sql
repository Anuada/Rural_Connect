-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 04:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `user_type` enum('admin','barangay_inc','city_health','deliveries') NOT NULL,
  `recovery_token` varchar(100) DEFAULT NULL,
  `verify_token` varchar(100) DEFAULT NULL,
  `isVerify` tinyint(4) NOT NULL DEFAULT 0,
  `isLogin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `recovery_token`, `verify_token`, `isVerify`, `isLogin`, `created_at`) VALUES
('66dcf1bd-51e1-45e3-8727-0c343577bdd5', 'ericsonmariebautista@mailinator.com', 'ericsonmariebautista', '$2y$12$MPChjNnPM3fTn2bGJB9W/OzmK3knK4LDRFx5f3C2N7ojr4N4jTh16', 'admin', NULL, NULL, 1, 0, '2025-04-03 22:06:46'),
('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 'ladyglittersmackles@gmail.com', 'anuada_1990', '$2y$12$pzTQcKHz2TtTYxSt9km72u9sloyJtK4hbfA2n2ZTJsNFHaTlzMcfS', 'barangay_inc', '', '', 1, 1, '2025-04-03 17:40:37'),
('74158fcb-d946-4787-b7c5-8ccaa3b30660', 'heroshigonzales@gmail.com', 'heroshi_paro', '$2y$12$siu6lpmvdADUMoO9EH.K3u31kbwFXet8P8ia3vNbcsOotWagX.Ob2', 'admin', '', NULL, 1, 0, '2025-04-03 17:40:35'),
('7594b921-87ea-437e-bd63-03e2809c3fc2', 'mariah_carey@mailinator.com', 'therealmariah_carey', '$2y$12$qvCWyerLwX34QrtnG6SwIebSrazN.KDGsQrbLagqe6CzJWLKtVvrS', 'deliveries', '', '', 1, 0, '2025-04-03 17:40:38'),
('b5b54cf0-da93-401e-a353-2d2917210971', 'mharbenreypude.854@gmail.com', 'mharbenreypude', '$2y$10$MRJGneSncga1iXrV18RFdu/GsLnp2CC944obFOVF38/FgS0v6cnEq', 'admin', NULL, NULL, 1, 0, '2025-04-03 21:50:07'),
('d1b0d961-4460-444a-a7f2-0117347d28d2', 'jerryegamp21@gmail.com', 'jerryegamp21', '$2y$10$GS6uoCetYreZQnAUhyFefefEjK1HgV.TO4pM0.041LDIc7ggnDePC', 'admin', NULL, NULL, 1, 0, '2025-04-03 21:59:17'),
('eb48b13c-9094-4de4-afc2-786b9dc93f96', 'christopher_pareyac@mailinator.com', 'christopher_pareyac', '$2y$12$7W/t1R9Yj5c0EW4IHzVTmOrJCB/8pBfxhrbmAnDM3y6UTy7jz3skW', 'city_health', NULL, '', 1, 1, '2025-04-03 17:40:39'),
('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766', 'dualipa@mailinator.com', 'dualipa', '$2y$12$1s/VeHUvlf.9hF7N9Kh7COkgwB9ZRa8QSsfqQkMMUnhqmtuQVJp92', 'deliveries', NULL, '', 1, 0, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`accountId`, `fname`, `lname`, `address`, `DOB`, `contactNo`, `id_verification`) VALUES
('66dcf1bd-51e1-45e3-8727-0c343577bdd5', 'Ericson Mar', 'Bautista', 'Floptropica, Cebu City', '1990-01-31', '09189389183', '../assets/img/profile/admin/66dcf1bd-51e1-45e3-8727-0c343577bdd5.png'),
('74158fcb-d946-4787-b7c5-8ccaa3b30660', 'Heroshi', 'Paro', 'Curvada, Juan Climaco Sr., Toledo City, Cebu', '2002-01-31', '09293820193', '../assets/img/profile/admin/74158fcb-d946-4787-b7c5-8ccaa3b30660.png'),
('b5b54cf0-da93-401e-a353-2d2917210971', 'Mharben Rey', 'Pude', 'Tres de Abril St., Cebu City, Cebu 6000', '1998-10-16', '09282719482', '../assets/img/profile/admin/b5b54cf0-da93-401e-a353-2d2917210971.png'),
('d1b0d961-4460-444a-a7f2-0117347d28d2', 'Jeremy', 'Gamboa', 'Tinabangay 2 Alaska Mambaling Cebu city, 6000', '2000-12-21', '09193828493', '../assets/img/profile/admin/d1b0d961-4460-444a-a7f2-0117347d28d2.png');

-- --------------------------------------------------------

--
-- Table structure for table `admin_auth_tokens`
--

CREATE TABLE `admin_auth_tokens` (
  `admin_id` varchar(100) NOT NULL,
  `auth_token` varchar(50) DEFAULT NULL,
  `is_authenticated` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_auth_tokens`
--

INSERT INTO `admin_auth_tokens` (`admin_id`, `auth_token`, `is_authenticated`) VALUES
('66dcf1bd-51e1-45e3-8727-0c343577bdd5', '', 0),
('74158fcb-d946-4787-b7c5-8ccaa3b30660', '', 0),
('b5b54cf0-da93-401e-a353-2d2917210971', NULL, 0),
('d1b0d961-4460-444a-a7f2-0117347d28d2', '50196423', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
('7594b921-87ea-437e-bd63-03e2809c3fc2', 'Mariah', 'Carey', 'Floptropica', '09284738274', '../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png'),
('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766', 'Dua', 'Lipa', 'London, Pardo Cebu City', '09939294859', '../assets/img/profile/deleviries/f3e92e97-dcb4-4e41-bfa0-a1b896ee2766.png');

-- --------------------------------------------------------

--
-- Table structure for table `med_availabilty`
--

CREATE TABLE `med_availabilty` (
  `id` int(11) NOT NULL,
  `med_name` varchar(100) NOT NULL,
  `med_description` text NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) NOT NULL,
  `DosageForm` varchar(100) NOT NULL,
  `DosageStrength` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `city_health_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `med_deliveries`
--

CREATE TABLE `med_deliveries` (
  `id` int(11) NOT NULL,
  `request_med_id` int(11) NOT NULL,
  `deliveries_accountId` varchar(100) NOT NULL,
  `date_of_supply` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_deliveries`
--

INSERT INTO `med_deliveries` (`id`, `request_med_id`, `deliveries_accountId`, `date_of_supply`) VALUES
(11, 9, '7594b921-87ea-437e-bd63-03e2809c3fc2', '2025-03-20 00:00:00'),
(12, 10, '7594b921-87ea-437e-bd63-03e2809c3fc2', '2025-05-01 00:00:00'),
(13, 11, '7594b921-87ea-437e-bd63-03e2809c3fc2', '2025-04-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rate_and_feedback`
--

CREATE TABLE `rate_and_feedback` (
  `accountId` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate_and_feedback`
--

INSERT INTO `rate_and_feedback` (`accountId`, `rating`, `feedback`, `created_at`, `updated_at`) VALUES
('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 3, 'ok na to', '2025-04-05 17:03:56', '2025-04-06 12:18:18'),
('7594b921-87ea-437e-bd63-03e2809c3fc2', 5, 'yehey, the service is so much better now, good thing you listen to the feedbacks from the users. keep it up po!!!', '2025-04-05 15:19:45', '2025-04-06 03:24:17'),
('eb48b13c-9094-4de4-afc2-786b9dc93f96', 1, 'ako ay isang (reyna)4x', '2025-04-05 16:24:03', '2025-04-06 03:26:21'),
('f3e92e97-dcb4-4e41-bfa0-a1b896ee2766', 5, 'Gimme chi, gimme purr, gimme meow, gimme her, gimme funds\r\nGimme rights, gimme fight, gimme nerve, gimme cunt, let me', '2025-04-05 19:15:17', '2025-04-05 19:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `request_med`
--

CREATE TABLE `request_med` (
  `id` int(11) NOT NULL,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_avail_Id` int(11) NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled') NOT NULL DEFAULT 'Pending',
  `prescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_med`
--

INSERT INTO `request_med` (`id`, `city_health_id`, `barangay_inc_id`, `med_avail_Id`, `request_quantity`, `request_DosageForm`, `request_DosageStrength`, `requestStatus`, `prescription`) VALUES
(9, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 19, '100', 'Syrup', 'ml', 'Accepted', ''),
(10, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 21, '500', 'Syrup', '2500', 'Accepted', ''),
(11, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 19, '1000', 'Tablet', '2500', 'Accepted', ''),
(14, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 19, '21', '', '250', 'Pending', ''),
(15, 'eb48b13c-9094-4de4-afc2-786b9dc93f96', '6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 19, '8', '', '500', 'Pending', '../assets/img/upload_prescription9b796a75-1fbd-4aff-b495-a4a2bf7373bb.png');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `barangay_id` varchar(100) NOT NULL,
  `receipt` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `admin_auth_tokens`
--
ALTER TABLE `admin_auth_tokens`
  ADD PRIMARY KEY (`admin_id`);

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
-- Indexes for table `med_deliveries`
--
ALTER TABLE `med_deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_accountId` (`deliveries_accountId`),
  ADD KEY `request_med_id` (`request_med_id`);

--
-- Indexes for table `rate_and_feedback`
--
ALTER TABLE `rate_and_feedback`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `request_med`
--
ALTER TABLE `request_med`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_health_id` (`city_health_id`),
  ADD KEY `barangay_inc_id` (`barangay_inc_id`),
  ADD KEY `med_avail_Id` (`med_avail_Id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `med_availabilty`
--
ALTER TABLE `med_availabilty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `med_deliveries`
--
ALTER TABLE `med_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `request_med`
--
ALTER TABLE `request_med`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin_auth_tokens`
--
ALTER TABLE `admin_auth_tokens`
  ADD CONSTRAINT `FK_admin_auth_tokens_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `med_deliveries`
--
ALTER TABLE `med_deliveries`
  ADD CONSTRAINT `FK_med_deliveries_deliveries` FOREIGN KEY (`deliveries_accountId`) REFERENCES `deliveries` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_med_deliveries_request_med` FOREIGN KEY (`request_med_id`) REFERENCES `request_med` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate_and_feedback`
--
ALTER TABLE `rate_and_feedback`
  ADD CONSTRAINT `FK_rate_and_feedback_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_med`
--
ALTER TABLE `request_med`
  ADD CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_med_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
