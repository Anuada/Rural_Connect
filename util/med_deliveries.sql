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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('4a6458af-448c-4a9c-9681-25e698436b74','ladyglittersmackles@gmail.com','anuada_1990','$2y$12$Lnj2k7m0H1zUUry6SVj1Z.ODuGIqLQhzfGNBsvYKU18POWsh1KR1C','barangay_inc',NULL,'',1,0,NULL),('7594b921-87ea-437e-bd63-03e2809c3fc2','mariah_carey@mailinator.com','therealmariah_carey','$2y$12$woruQtIjGV3R2XmnjO7Q1uY2MFbyapxPeWNEN811k64v8p1z4H9vy','deliveries','02a07aee-d968-4113-85b5-ddcdca5784be','',1,0,NULL),('d95aa0c3-191d-4afc-b61a-49305cae5a88','dominic.sugbodoc@gmail.com','sabrina_carpenter','$2y$12$y.NrKimM44pPGKPAEr8oNefaZZNHsdDL3wLIZhPU3jeFd64oJl26W','barangay_inc','','',1,0,NULL),('eb48b13c-9094-4de4-afc2-786b9dc93f96','christopher_pareyac@mailinator.com','christopher_pareyac','$2y$12$vhCcXotkGrKZ.6cFCnyJKuWSkO86DH4yIaQkkgPbBhBrvg5cCvb3a','city_health',NULL,'',1,0,NULL),('fed03dd0-8db2-4d55-84c7-5b8033f2ab4f','tonya2025@mailinator.com','tonya2025','$2y$12$4z0uQsd4v7JBQG8CI7NPVup16RzbUZor5CWWNdsX41Mp.436tuYD.','barangay_inc','','',1,0,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
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
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_barangay_inc_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_inc`
--

LOCK TABLES `barangay_inc` WRITE;
/*!40000 ALTER TABLE `barangay_inc` DISABLE KEYS */;
INSERT INTO `barangay_inc` VALUES ('4a6458af-448c-4a9c-9681-25e698436b74','Ericson','Anuada','Floptropica','09392019483','../assets/img/profile/barangay_incharge/4a6458af-448c-4a9c-9681-25e698436b74.png'),('d95aa0c3-191d-4afc-b61a-49305cae5a88','Sabrina','Carpenter','Floptropica','09293842918','..assets/img/profile/barangay_incharge/d95aa0c3-191d-4afc-b61a-49305cae5a88.png'),('fed03dd0-8db2-4d55-84c7-5b8033f2ab4f','Tonya','Anuada','Floptropica','09192948284','../assets/img/profile/barangay_incharge/fed03dd0-8db2-4d55-84c7-5b8033f2ab4f.png');
/*!40000 ALTER TABLE `barangay_inc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_health`
--

DROP TABLE IF EXISTS `city_health`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_health` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_city_health_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_health`
--

LOCK TABLES `city_health` WRITE;
/*!40000 ALTER TABLE `city_health` DISABLE KEYS */;
INSERT INTO `city_health` VALUES ('eb48b13c-9094-4de4-afc2-786b9dc93f96','Christopher Jamal','Pareyac','Floptropica','09284928392','../assets/img/profile/deleviries/eb48b13c-9094-4de4-afc2-786b9dc93f96.png');
/*!40000 ALTER TABLE `city_health` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliveries` (
  `accountId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contactNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_verification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`accountId`),
  CONSTRAINT `FK_deliveries_account` FOREIGN KEY (`accountId`) REFERENCES `account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `med_availabilty`
--

LOCK TABLES `med_availabilty` WRITE;
/*!40000 ALTER TABLE `med_availabilty` DISABLE KEYS */;
INSERT INTO `med_availabilty` VALUES (19,'Paracetamol','It is a common over-the-counter medication used to relieve pain and reduce fever. It is often used for headaches, muscle aches, arthritis, backaches, toothaches, colds, and fevers. Paracetamol is generally considered safe when used as directed, but it can be harmful in excessive doses, leading to liver damage. Always follow dosing instructions and consult a healthcare professional if you have any concerns.','1000','2025-03-21 06:43:10','2026-01-01 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_paracetamol_03202025224310.png','Tablet','500 mg','analgesics and antipyretics','eb48b13c-9094-4de4-afc2-786b9dc93f96'),(21,'Grethers Pastilles','Used to soothe throat discomfort and alleviate dry mouth symptoms.','1000','2025-03-21 06:52:56','2026-03-21 00:00:00','../assets/img/med_image/eb48b13c90944de4afc2786b9dc93f96_gretherspastilles_03202025225256.png','Pastille','110000 mg','throat lozenges or cough drops','eb48b13c-9094-4de4-afc2-786b9dc93f96');
/*!40000 ALTER TABLE `med_availabilty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_med`
--

DROP TABLE IF EXISTS `request_med`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_med` (
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
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

-- Dump completed on 2025-03-22 20:18:16
