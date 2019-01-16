-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: your_smaglenko_db
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Vitalia','Smaglenko','VitaliaSmaglenko','vitalia@gmail.com','sadasdsdsa',NULL),(2,'Vitalia','Smaglenko','VitaliaSmaglenko','vitaliasadaa@gmail.com','sadsadas',NULL),(3,'Vitalia','Smaglenko','VitaliaSmaglenko','vitaliasadaasss@gmail.com','fsfsdfsdfsf',NULL),(4,'Vitalia','Smaglenko','VitaliaSmaglenko1','vitaliasadasfdsasss@gmail.com','sdffffsd',NULL),(5,'Vitalia','Smaglenko','VitaliaSmdaglenko1','vsfdsasss@gmail.com','dasdad',NULL),(6,'Vitalia','Smaglenko','VitaliaSmdagldfdddenko1','vsfdfffffffsasss@gmail.com','jjjjjffd',NULL),(7,'Vitalia','Smaglenko','VitaliaSssmdagldfdddenko1','vsfdfffffffsasss@xn--gmail-jwea.com','фвфывфвфвв',NULL),(8,'Vitalia','Smaglenko','VitalidddaSssmdagldfdddenko1','ssssss@xn--gmail-jwea.com','фвфывфвфввs',NULL),(9,'Vitalia','Smaglenko','VitalidddaSddssmdagldfdddenko1','vsfdssssasss@gmail.com','adasdadas',NULL),(10,'Vitalia','Smaglenko','VitalidddddaSddssmdagldfdddenko1','vsfdssssadddsss@gmail.com','sdsdasdadasd',NULL),(11,'vvvvv','vvvv','vvvvfff','v@com.ya','fgdgdgdgd',NULL),(13,'Foxcrime','Dream','DreamFox','fox@gmail.com','foxfoxfox','+380501700086');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-16 17:42:04
