-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table med_deliveries.account
CREATE TABLE IF NOT EXISTS `account` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recovery_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verify_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isVerify` tinyint NOT NULL DEFAULT '0',
  `isLogin` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.account: ~3 rows (approximately)
INSERT INTO `account` (`accountId`, `email`, `username`, `password`, `user_type`, `recovery_token`, `verify_token`, `isVerify`, `isLogin`, `created_at`) VALUES
	('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 'ladyglittersmackles@gmail.com', 'anuada_1990', '$2y$12$9V6a/pa7KWygvvHmd/A37eM5F0BHbIvCA.zsGI3C9Zl1TpsQTo.xi', 'barangay_inc', '', '', 1, 1, NULL),
	('7594b921-87ea-437e-bd63-03e2809c3fc2', 'mariah_carey@mailinator.com', 'therealmariah_carey', '$2y$12$qvCWyerLwX34QrtnG6SwIebSrazN.KDGsQrbLagqe6CzJWLKtVvrS', 'deliveries', '', '', 1, 0, NULL),
	('eb48b13c-9094-4de4-afc2-786b9dc93f96', 'christopher_pareyac@mailinator.com', 'christopher_pareyac', '$2y$12$7W/t1R9Yj5c0EW4IHzVTmOrJCB/8pBfxhrbmAnDM3y6UTy7jz3skW', 'city_health', NULL, '', 1, 1, NULL);

-- Dumping structure for table med_deliveries.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.admin: ~0 rows (approximately)

-- Dumping structure for table med_deliveries.barangay_inc
CREATE TABLE IF NOT EXISTS `barangay_inc` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.barangay_inc: ~1 rows (approximately)
INSERT INTO `barangay_inc` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	('6c0b0a91-03a3-4614-a6a9-1a46133e8a60', 'Ericson', 'Anuada', 'Floptropica', '09293929394', '../assets/img/profile/barangay_incharge/6c0b0a91-03a3-4614-a6a9-1a46133e8a60.png');

-- Dumping structure for table med_deliveries.city_health
CREATE TABLE IF NOT EXISTS `city_health` (
  `accountId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.city_health: ~1 rows (approximately)
INSERT INTO `city_health` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	('eb48b13c-9094-4de4-afc2-786b9dc93f96', 'Christopher', 'Pareyac', 'Floptropica', '09284928392', '../assets/img/profile/city_health/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');

-- Dumping structure for table med_deliveries.deliveries
CREATE TABLE IF NOT EXISTS `deliveries` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.deliveries: ~1 rows (approximately)
INSERT INTO `deliveries` (`accountId`, `fname`, `lname`, `address`, `contactNo`, `id_verification`) VALUES
	('7594b921-87ea-437e-bd63-03e2809c3fc2', 'Mariah', 'Carey', 'Floptropica', '09284738274', '../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png');

-- Dumping structure for table med_deliveries.med_availabilty
CREATE TABLE IF NOT EXISTS `med_availabilty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DosageForm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `DosageStrength` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table med_deliveries.med_availabilty: ~2 rows (approximately)
INSERT INTO `med_availabilty` (`id`, `med_name`, `med_description`, `quantity`, `date`, `expiry_date`, `med_image`, `DosageForm`, `DosageStrength`, `category`, `city_health_id`) VALUES
	(19, 'Paracetamol', 'It is a common over-the-counter medication used to relieve pain and reduce fever. It is often used for headaches, muscle aches, arthritis, backaches, toothaches, colds, and fevers. Paracetamol is generally considered safe when used as directed, but it can be harmful in excessive doses, leading to liver damage. Always follow dosing instructions and consult a healthcare professional if you have any concerns.', '1000', '2025-03-21 06:43:10', '2026-01-01 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_03202025224310.png', 'Tablet', '500 mg', 'analgesics and antipyretics', 'eb48b13c-9094-4de4-afc2-786b9dc93f96'),
	(21, 'Grethers Pastilles', 'Used to soothe throat discomfort and alleviate dry mouth symptoms.', '1000', '2025-03-21 06:52:56', '2026-03-21 00:00:00', '../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_gretherspastilles_03202025225256.png', 'Pastille', '110000 mg', 'throat lozenges or cough drops', 'eb48b13c-9094-4de4-afc2-786b9dc93f96');

-- Dumping structure for table med_deliveries.request_med
CREATE TABLE IF NOT EXISTS `request_med` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `med_avail_Id` int NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_category` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  KEY `barangay_inc_id` (`barangay_inc_id`),
  KEY `med_avail_Id` (`med_avail_Id`),
  CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table med_deliveries.request_med: ~1 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
