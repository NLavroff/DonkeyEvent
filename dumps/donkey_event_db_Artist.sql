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
-- Table structure for table `Artist`
--

DROP TABLE IF EXISTS `Artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Artist` (
  `idArtist` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(2047) DEFAULT NULL,
  PRIMARY KEY (`idArtist`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Artist`
--

LOCK TABLES `Artist` WRITE;
/*!40000 ALTER TABLE `Artist` DISABLE KEYS */;
INSERT INTO `Artist` VALUES (1,'Les Vulves assassines','Les Vulves assassines, c’est DJ Conant, sa grande gueule et ses synthés crasses, MC Vieillard , ses gros muscles au service de son petit sampler, et Sam, véritable génie de la guitare électrique, pour un univers extra-terrestro musical’core. Les Vulves assassines, ça hurle, ça rappe, ça pue et ça laisse Booba sur le bord de la route comme un enfant de chœur paumé. Les Vulves assassines, c’est aussi l’espoir d’un monde meilleur, plus juste, un monde où Pierre Gattaz élèverait tranquillement des chèvres dans le Larzac au lieu de nous pourrir la vie.'),(2,'Céline Dion','Céline Marie Claudette Dion est une chanteuse canadienne. Elle est connue pour sa voix puissante et ses compétences techniques. Sa musique intègre des genres tels que la pop, le rock, le R&B, le gospel et la musique classique. Elle est l\'artiste canadienne la plus vendue, l\'artiste francophone la plus vendue de l\'histoire et l\'artiste féminine contemporaine la plus vendue de tous les temps.'),(3,'Niels Arestrup','Niels Arestrup débute au cinéma dans les années 70, après un passage par le cours de Tania Balachova. Il multiplie les apparitions dans des films d\'auteurs du cinéma français - Chantal Akerman, Alain Resnais -, pour des seconds rôles marquants.\n\nLes années 80 lui ouvrent les rôles principaux des films, tel Le futur est femme de Marco Ferreri. Une envergure de premier qu\'il conserve par la suite.\n\nAprès le succès du film d\'Audiard De battre mon cœur s\'est arrêté, dans lequel il jouait le père de Romain Duris, Niels Arestrup s\'apprête à jouer dans le nouveau film de ce dernier, Un prophète (2009). Niels Arestrup est également passé à la réalisation pour le film Le Candidat sorti en 2007, avec comme acteur phare Yvan Attal. Un artiste complet !');
/*!40000 ALTER TABLE `Artist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-22 17:43:47
