-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: med_deliveries
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `accountId` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` enum('admin','barangay_inc','city_health','deliveries') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `recovery_token` varchar(100) DEFAULT NULL,
  `verify_token` varchar(100) DEFAULT NULL,
  `isVerify` tinyint NOT NULL DEFAULT '0',
  `isLogin` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','ladyglittersmackles@gmail.com','anuada_1990','$2y$12$9V6a/pa7KWygvvHmd/A37eM5F0BHbIvCA.zsGI3C9Zl1TpsQTo.xi','barangay_inc','','',1,0,NULL),('7594b921-87ea-437e-bd63-03e2809c3fc2','mariah_carey@mailinator.com','therealmariah_carey','$2y$12$qvCWyerLwX34QrtnG6SwIebSrazN.KDGsQrbLagqe6CzJWLKtVvrS','deliveries','','',1,0,NULL),('eb48b13c-9094-4de4-afc2-786b9dc93f96','christopher_pareyac@mailinator.com','christopher_pareyac','$2y$12$7W/t1R9Yj5c0EW4IHzVTmOrJCB/8pBfxhrbmAnDM3y6UTy7jz3skW','city_health',NULL,'',1,0,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_admin_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay_inc`
--

DROP TABLE IF EXISTS `barangay_inc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barangay_inc` (
  `accountId` varchar(100) NOT NULL DEFAULT '',
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_inc`
--

LOCK TABLES `barangay_inc` WRITE;
/*!40000 ALTER TABLE `barangay_inc` DISABLE KEYS */;
INSERT INTO `barangay_inc` VALUES ('6c0b0a91-03a3-4614-a6a9-1a46133e8a60','Mike','Lazardos','Floptropica St. Mountain Cebu','09293929301','../assets/img/profile/barangay_incharge/6c0b0a91-03a3-4614-a6a9-1a46133e8a60.png');
/*!40000 ALTER TABLE `barangay_inc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_health`
--

DROP TABLE IF EXISTS `city_health`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_health` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_health`
--

LOCK TABLES `city_health` WRITE;
/*!40000 ALTER TABLE `city_health` DISABLE KEYS */;
INSERT INTO `city_health` VALUES ('eb48b13c-9094-4de4-afc2-786b9dc93f96','Christopher','Pareyac','Floptropica','09284928392','../assets/img/profile/city_health/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');
/*!40000 ALTER TABLE `city_health` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliveries` (
  `accountId` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `id_verification` varchar(100) NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES ('7594b921-87ea-437e-bd63-03e2809c3fc2','Mariah','Carey','Floptropica','09284738274','../assets/img/profile/deleviries/7594b921-87ea-437e-bd63-03e2809c3fc2.png');
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_availabilty`
--

DROP TABLE IF EXISTS `med_availabilty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_availabilty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `med_name` varchar(100) NOT NULL,
  `med_description` text NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `med_image` varchar(250) NOT NULL,
  `DosageForm` varchar(100) NOT NULL,
  `DosageStrength` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `city_health_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  CONSTRAINT `FK_med_availabilty_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_availabilty`
--

LOCK TABLES `med_availabilty` WRITE;
/*!40000 ALTER TABLE `med_availabilty` DISABLE KEYS */;
INSERT INTO `med_availabilty` VALUES (19,'Paracetamol','It is a common over-the-counter medication used to relieve pain and reduce fever. It is often used for headaches, muscle aches, arthritis, backaches, toothaches, colds, and fevers. Paracetamol is generally considered safe when used as directed, but it can be harmful in excessive doses, leading to liver damage. Always follow dosing instructions and consult a healthcare professional if you have any concerns.','1000','2025-03-21 06:43:10','2026-01-01 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_03202025224310.png','Tablet','500 mg','analgesics and antipyretics','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(21,'Grethers Pastilles','Used to soothe throat discomfort and alleviate dry mouth symptoms.','1000','2025-03-21 06:52:56','2026-03-21 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_gretherspastilles_03202025225256.png','Pastille','110000 mg','throat lozenges or cough drops','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(22,'Generic (BIOGESIC)','A trusted brand of paracetamol, Paracetamol (Biogesic) is a medication that is typically used to relieve mild to moderate pain such as headache, backache, menstrual cramps, muscular strain, minor arthritis pain, toothache, and reduce fevers caused by illnesses such as the common cold and flu','10000','2025-03-21 10:05:31','2025-03-22 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_generic(biogesic)_03212025030531.png','table','500mg','Biogesic 50mg Tablet belongs to a class of medicines known as nonsteroidal anti-inflammatory drugs (','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(24,'para sa opaw','sa buhok','23','2025-03-21 11:29:37','9999-09-09 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_parasaopaw_03212025042937.png','Tablet, Capsule, Syrup','ml','Construction','eb48b13c-9094-4de4-afc2-786b9dc93f96');
/*!40000 ALTER TABLE `med_availabilty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `med_deliveries`
--

DROP TABLE IF EXISTS `med_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `med_deliveries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_med_id` int NOT NULL,
  `deliveries_accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_supply` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_accountId` (`deliveries_accountId`),
  KEY `request_med_id` (`request_med_id`),
  CONSTRAINT `med_deliveries_ibfk_1` FOREIGN KEY (`deliveries_accountId`) REFERENCES `deliveries` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `med_deliveries_ibfk_2` FOREIGN KEY (`request_med_id`) REFERENCES `request_med` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_deliveries`
--

LOCK TABLES `med_deliveries` WRITE;
/*!40000 ALTER TABLE `med_deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `med_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_med`
--

DROP TABLE IF EXISTS `request_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_med` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_health_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `barangay_inc_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `med_avail_Id` int NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `request_category` varchar(100) NOT NULL,
  `request_DosageForm` varchar(100) NOT NULL,
  `request_DosageStrength` varchar(100) NOT NULL,
  `receipt_image` varchar(100) NOT NULL,
  `requestStatus` enum('Pending','Accepted','Cancelled') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pending',
  `paymentStatus` enum('Pending','Approved','Declined') NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_health_id` (`city_health_id`),
  KEY `barangay_inc_id` (`barangay_inc_id`),
  KEY `med_avail_Id` (`med_avail_Id`),
  CONSTRAINT `FK_request_med_barangay_inc` FOREIGN KEY (`barangay_inc_id`) REFERENCES `barangay_inc` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_city_health` FOREIGN KEY (`city_health_id`) REFERENCES `city_health` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_request_med_med_availabilty` FOREIGN KEY (`med_avail_Id`) REFERENCES `med_availabilty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_med`
--

LOCK TABLES `request_med` WRITE;
/*!40000 ALTER TABLE `request_med` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_med` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-31 21:53:16
