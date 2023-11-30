-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: cityparking
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `distance`
--

DROP TABLE IF EXISTS `distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distance` (
  `ZoneNumber` int NOT NULL,
  `VNumber` int NOT NULL,
  `Distance` int DEFAULT NULL,
  PRIMARY KEY (`ZoneNumber`,`VNumber`),
  KEY `VNumber` (`VNumber`),
  CONSTRAINT `distance_ibfk_1` FOREIGN KEY (`ZoneNumber`) REFERENCES `lot_info` (`ZoneNumber`),
  CONSTRAINT `distance_ibfk_2` FOREIGN KEY (`VNumber`) REFERENCES `venue` (`VNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distance`
--

LOCK TABLES `distance` WRITE;
/*!40000 ALTER TABLE `distance` DISABLE KEYS */;
INSERT INTO `distance` VALUES (1,1,1),(1,2,4),(1,3,3),(2,1,2),(2,2,5),(2,3,4),(3,1,2),(3,2,4),(3,3,2);
/*!40000 ALTER TABLE `distance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lot`
--

DROP TABLE IF EXISTS `lot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lot` (
  `ZoneNumber` int NOT NULL,
  `Date` date NOT NULL,
  `Space` int DEFAULT NULL,
  `Rate` int DEFAULT NULL,
  PRIMARY KEY (`ZoneNumber`,`Date`),
  CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`ZoneNumber`) REFERENCES `lot_info` (`ZoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lot`
--

LOCK TABLES `lot` WRITE;
/*!40000 ALTER TABLE `lot` DISABLE KEYS */;
INSERT INTO `lot` VALUES (1,'2023-11-11',10,2),(1,'2023-12-05',15,2),(2,'2023-11-11',10,2),(2,'2023-11-29',10,2),(2,'2023-12-05',15,2),(3,'2023-12-05',15,2);
/*!40000 ALTER TABLE `lot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lot_info`
--

DROP TABLE IF EXISTS `lot_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lot_info` (
  `ZoneNumber` int NOT NULL AUTO_INCREMENT,
  `ZoneName` char(30) DEFAULT NULL,
  `Capacity` int DEFAULT NULL,
  PRIMARY KEY (`ZoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lot_info`
--

LOCK TABLES `lot_info` WRITE;
/*!40000 ALTER TABLE `lot_info` DISABLE KEYS */;
INSERT INTO `lot_info` VALUES (1,'StateHouse',200),(2,'ShortNorth',100),(3,'NorthMarket',50);
/*!40000 ALTER TABLE `lot_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `ConformationNum` int NOT NULL AUTO_INCREMENT,
  `UNumber` int DEFAULT NULL,
  `ZoneNumber` int DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Rate` int DEFAULT NULL,
  `Status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ConformationNum`),
  KEY `UNumber` (`UNumber`),
  KEY `ZoneNumber` (`ZoneNumber`,`Date`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`UNumber`) REFERENCES `user` (`UNumber`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ZoneNumber`, `Date`) REFERENCES `lot` (`ZoneNumber`, `Date`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1,1,'2023-11-11',2,'Active'),(2,1,1,'2023-11-11',2,'Active'),(3,1,1,'2023-11-11',2,'Active'),(4,2,1,'2023-11-11',2,'Past'),(5,2,2,'2023-11-11',4,'Past'),(6,2,1,'2023-11-11',4,'Past');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `UNumber` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  `Phone` char(10) DEFAULT NULL,
  PRIMARY KEY (`UNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Kevin Lin','6665554321'),(2,'Terry Liu','6665554322');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venue` (
  `VNumber` int NOT NULL AUTO_INCREMENT,
  `VName` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`VNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venue`
--

LOCK TABLES `venue` WRITE;
/*!40000 ALTER TABLE `venue` DISABLE KEYS */;
INSERT INTO `venue` VALUES (1,'Nationwide Arena'),(2,'COSI'),(3,'Huntington Park');
/*!40000 ALTER TABLE `venue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-29 23:02:49
