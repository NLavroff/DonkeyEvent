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
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Event` (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idEvent`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` VALUES (1,'Les Vulves Assassines\r\nPunk rap de l’espace','Quelque part entre Sexy Sushi, Schlaasss, Stupeflip \r\net Salut C’est Cool, les Vulves Assassines distribuent \r\ndes uppercuts contre toutes les formes de dogmes, de bienpensance et d’idées préconçues, machisme et virilisme en tête : \r\nun véritable féminisme de guerre, musical et salvateur, \r\nqui n’a pas fini de faire du bruit.','LesVulvesAssassines.png'),(2,'Céline Dion Courage World Tour','Le Courage World Tour est la quatorzième tournée de concerts de la chanteuse canadienne Céline Dion, en soutien à son album studio anglophone Courage (2019). Il s\'agit de sa première tournée mondiale depuis plus de dix ans, depuis sa tournée mondiale Taking Chances. La tournée a débuté à Québec, au Canada, le 18 septembre 2019.','CelineDion.jpeg'),(3,'88 fois l\'infini','Après treize ans passés sans se voir à la suite d’une rivalité amoureuse, Philippe rend visite à Andrew, son demi-frère, pianiste virtuose et mondialement connu. Il apporte avec lui une vieille valise ayant appartenu à leur père, qui fut écrasant pour Philippe et absent pour Andrew. Il ne sera pourtant pas question de réconciliation entre les deux hommes, les lourds secrets que contient la valise raviveront leur ressentiment, avant de révéler au grand jour les mensonges de toute une vie. Mais à mesure que les masques tomberont, la colère mènera ces deux demi-frères, que tout semble opposer, sur la voie de la reconstruction et du dialogue, tandis que la vérité sur leurs origines, en éclatant, fera se rejoindre la petite et la grande Histoire…','88foislinfini.jpeg');
/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
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
