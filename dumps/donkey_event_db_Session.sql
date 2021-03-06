-- MySQL dump 10.13  Distrib 8.0.26, for macos11 (x86_64)
--
-- Host: localhost    Database: donkey_event_db
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Session`
--

DROP TABLE IF EXISTS `Session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Session` (
  `idSession` int NOT NULL AUTO_INCREMENT,
  `Venue_idVenue` int NOT NULL,
  `Event_idEvent` int NOT NULL,
  `price` float DEFAULT NULL,
  `capacity` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idSession`,`Venue_idVenue`,`Event_idEvent`),
  KEY `fk_Session_Venue1_idx` (`Venue_idVenue`),
  KEY `fk_Session_Event1_idx` (`Event_idEvent`),
  CONSTRAINT `fk_Session_Event1` FOREIGN KEY (`Event_idEvent`) REFERENCES `Event` (`idEvent`),
  CONSTRAINT `fk_Session_Venue1` FOREIGN KEY (`Venue_idVenue`) REFERENCES `Venue` (`idVenue`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Session`
--

LOCK TABLES `Session` WRITE;
/*!40000 ALTER TABLE `Session` DISABLE KEYS */;
INSERT INTO `Session` VALUES (1,1,1,20,194,'2021-11-19 20:00:00'),(2,2,1,15,70,'2021-12-10 19:30:00'),(3,3,2,73,40000,'2022-09-16 20:00:00'),(4,3,2,73,40000,'2022-09-17 20:00:00'),(5,3,2,73,40000,'2022-09-20 20:00:00'),(6,3,2,73,40000,'2022-09-21 20:00:00'),(7,3,2,73,40000,'2022-09-23 20:00:00'),(8,3,2,73,40000,'2022-09-24 20:00:00'),(9,4,3,19,600,'2021-11-27 17:30:00'),(10,4,3,19,600,'2021-12-04 17:30:00'),(11,4,3,19,600,'2021-12-11 17:30:00');
/*!40000 ALTER TABLE `Session` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-22 17:43:48
