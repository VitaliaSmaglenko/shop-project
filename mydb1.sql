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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'ZTE',1,NULL,NULL),(2,'Xiaomi',1,NULL,NULL),(3,'DOOGEE',1,NULL,NULL),(4,'Fly',1,NULL,NULL),(5,'HomTom',1,NULL,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `comment` text,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `products` tinytext,
  PRIMARY KEY (`id`),
  KEY `id_user_idx` (`user_id`),
  KEY `id_product_idx` (`products_id`),
  CONSTRAINT `id_product` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `brand` varchar(60) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT '1',
  `update_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `specifications` text,
  `is_new` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_category_idx` (`category_id`),
  CONSTRAINT `id_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Смартфон ZTE Blade A510 Blue',1,1999,11,'ZTE','img/im1.jpg','Кількість SIM карт2Дисплей \"/розд.здат5,0\" HD(720*1280)ПроцесорMTK6735PПам\"ять вбуд./карта/ОЗУ8GB/to 32 GB/ 1GBКамера13MPОСAndroid MНаявність 3GYes',1,'2018-01-07','2018-01-07','Производитель ZTE',0),(2,'Смартфон Xiaomi Redmi S2 3/32GB',2,3999.6,20,'Xiaomi','img/im2.jpg','Данная модель является отличным представителем практичной и классной серии бюджетных смартфонов Xiaomi. Его принадлежность к Selfie Series лишь подчеркивает крутость устройства.',1,'2018-01-07','2018-01-07','Производитель Xiaomi;  Тип устройства  Смартфон; Форм-фактор Моноблок;  Стандарт связи 	GPRS, GSM, 3G (UMTS, HSUPA, HSPA), 4G (LTE)',0),(3,'Смартфон ORIGINAL DOOGEE X70',3,2179,15,'DOOGEE','img/im3.jpg','Данная модель является отличным представителем практичной и классной серии бюджетных смартфонов Xiaomi. Его принадлежность к Selfie Series лишь подчеркивает крутость устройства.',1,'2018-01-09','2018-01-09','Тип устройства Смартфон; Форм-фактор Моноблок; Стандарт связи GPRS, GSM, 3G (UMTS, HSUPA, HSPA); Кількість підтримуваних SIM-карт 2',0),(4,'Смартфон FLY FS458 Dual Sim (black)',4,1249,16,'FLY','img/im4.jpg','Смартфон, Дисплей 4.5, TN FWVGA, GSM 900/1800, WCDMA 900/2100, ОС Android 6.0, Процессор MT6570, Processor Dual Core 1.3 GHz, Видеоядро Mali 400 MP1 512MHz2, Память RAM 512MB / ROM 8Gb, Камера 5Mpix осн / 2Mpix фронтальна, Bluetooth, Wi-Fi, jack3.5 mm, батарея 1 750 mAh, цвет Черный',1,'2018-01-09','2018-01-09','Производитель Fly',0),(5,'Смартфон HomTom HT16 3000мAч',5,1580,15,'HomTom','img/im5.jpg','HomTom HT16 – смартфон с необычным романтическим дизайном и мягкой гаммой цветовых решений. Оптимальный 5-дюмовый HD дисплей, текстурная задняя панель, четырехядерный процессор, 8-мегапиксельная камера Sony, батарея 3000 мАч, Android 6.0 Marshmallow.',1,'2018-01-09','2018-01-09','Производитель Doogee; Тип устройства Мобильный телефон; Форм-фактор Моноблок; Стандарт связи 	GPRS, GSM, 3G (UMTS, HSUPA, HSPA)',0),(6,'Xiaomi Mi A2 Lite 3/32GB Gold',2,5596,25,'Xiaomi','img/im6.jpg','Данная модель является отличным представителем практичной и классной серии бюджетных смартфонов Xiaomi. Его принадлежность к Selfie Series лишь подчеркивает крутость устройства.',1,'2018-01-09','2018-01-09','Производитель Xiaomi; Цвет	Gold; Стандарт связи 4G (LTE)',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2019-01-16 17:07:23
