-- MySQL dump 10.13  Distrib 5.7.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: your_smaglenko_db
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `comment` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_user_idx` (`user_id`),
  CONSTRAINT `key_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyers`
--

LOCK TABLES `buyers` WRITE;
/*!40000 ALTER TABLE `buyers` DISABLE KEYS */;
/*!40000 ALTER TABLE `buyers` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'ZTE',1,NULL,NULL),(2,'Xiaomi',1,NULL,NULL),(3,'DOOGEE',1,NULL,NULL),(4,'Fly',1,NULL,NULL),(5,'HomTom',1,NULL,NULL),(6,'Apple',1,'2019-01-26 22:00:00.000000','2019-01-26 22:00:00.000000'),(7,'Meizu',1,'2019-01-26 22:00:00.000000','2019-01-26 22:00:00.000000'),(8,'Samsung',1,'2019-01-26 22:00:00.000000','2019-01-26 22:00:00.000000'),(9,'Huawei',1,'2019-01-26 22:00:00.000000','2019-01-26 22:00:00.000000');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_product`
--

DROP TABLE IF EXISTS `comment_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `text` text,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_product_1_idx` (`id_product`),
  KEY `fk_comment_product_2_idx` (`id_user`),
  CONSTRAINT `fk_comment_product_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comment_product_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_product`
--

LOCK TABLES `comment_product` WRITE;
/*!40000 ALTER TABLE `comment_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites_products`
--

DROP TABLE IF EXISTS `favorites_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites_products` (
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_product`,`id_user`),
  KEY `fk_user_idx` (`id_user`),
  CONSTRAINT `fk_favorites_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites_products`
--

LOCK TABLES `favorites_products` WRITE;
/*!40000 ALTER TABLE `favorites_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nested_comment`
--

DROP TABLE IF EXISTS `nested_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nested_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_comment` int(11) DEFAULT NULL,
  `text` text,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nested_comment_1_idx` (`id_comment`),
  KEY `fk_nested_comment_2_idx` (`id_user`),
  CONSTRAINT `fk_nested_comment_1` FOREIGN KEY (`id_comment`) REFERENCES `comment_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_nested_comment_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nested_comment`
--

LOCK TABLES `nested_comment` WRITE;
/*!40000 ALTER TABLE `nested_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `nested_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buyers` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `total_count` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_orders_1_idx` (`id_buyers`),
  CONSTRAINT `fk_orders_1` FOREIGN KEY (`id_buyers`) REFERENCES `buyers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_idx` (`product_id`),
  CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (2,3,'img/3.jpg'),(3,4,'img/4.jpg'),(4,5,'img/5.jpg'),(5,7,'img/7.jpg'),(6,8,'img/8.jpg'),(7,9,'img/9.jpg'),(8,10,'img/10.jpg'),(9,11,'img/11.jpg'),(10,12,'img/12.jpg'),(11,13,'img/13.jpg'),(12,14,'img/14.jpg'),(13,15,'img/15.jpg'),(14,16,'img/16.jpg'),(15,17,'img/17.jpg'),(16,18,'img/18.jpg'),(17,19,'img/19.jpg'),(18,20,'img/20.jpg'),(19,21,'img/21.jpg');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id_product` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  KEY `fk_product_order_2_idx` (`id_orders`),
  KEY `fk_product_order_1_idx` (`id_product`),
  CONSTRAINT `fk_product_order_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_order_2` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `price` int(11) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `brand` varchar(60) DEFAULT NULL,
  `image` varchar(80) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT '1',
  `update_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `specifications` text,
  `is_new` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_category_idx` (`category_id`),
  CONSTRAINT `id_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Смартфон ORIGINAL DOOGEE X70',3,2179,0,'DOOGEE','img/im3.jpg','Данная модель является отличным представителем практичной и классной серии бюджетных смартфонов Xiaomi. Его принадлежность к Selfie Series лишь подчеркивает крутость устройства.',1,'2019-01-26','2018-01-09','Тип устройства Смартфон; Форм-фактор Моноблок; Стандарт связи GPRS, GSM, 3G (UMTS, HSUPA, HSPA); Кількість підтримуваних SIM-карт 2\r\n                            \r\n                            \r\n                            \r\n                            \r\n                            \r\n                            \r\n                            \r\n                            ',0),(4,'Смартфон FLY FS458 Dual Sim (black)',4,1249,15,'FLY','img/im4.jpg','Смартфон, Дисплей 4.5, TN FWVGA, GSM 900/1800, WCDMA 900/2100, ОС Android 6.0, Процессор MT6570, Processor Dual Core 1.3 GHz, Видеоядро Mali 400 MP1 512MHz2, Память RAM 512MB / ROM 8Gb, Камера 5Mpix осн / 2Mpix фронтальна, Bluetooth, Wi-Fi, jack3.5 mm, батарея 1 750 mAh, цвет Черный',1,'2019-01-29','2018-01-09','Производитель Fly\r\n                            \r\n                            \r\n                            ',0),(5,'Смартфон HomTom HT16 3000мAч',5,1580,15,'HomTom','img/im5.jpg','HomTom HT16 – смартфон с необычным романтическим дизайном и мягкой гаммой цветовых решений. Оптимальный 5-дюмовый HD дисплей, текстурная задняя панель, четырехядерный процессор, 8-мегапиксельная камера Sony, батарея 3000 мАч, Android 6.0 Marshmallow.',1,'2019-01-20','2018-01-09','Производитель Doogee; Тип устройства Мобильный телефон; Форм-фактор Моноблок; Стандарт связи 	GPRS, GSM, 3G (UMTS, HSUPA, HSPA)\r\n                            ',0),(7,'Смартфон Xiaomi Redmi 6 3/32Gb',2,3699,25,'Xiomi',NULL,'Экран (5.45\", IPS, 1440x720)/ MediaTek Helio P22 (2.0 ГГц)/ основная двойная камера: 12 Мп + 5 Мп, фронтальная камера: 5 Мп/ RAM 3 ГБ/ 32 ГБ встроенной памяти + microSD (до 256 ГБ)/ 3G/ LTE/ GPS/ GLONASS/ поддержка 2х SIM-карт (Nano-SIM)/ Android 8.1 (Oreo) / 3000 мА*ч',1,'2019-01-27','2019-01-19','Производитель Xiaomi; Страна производитель	-Китай; Тип устройства - Смартфон;  Стандарт связи GPRS, GSM, 3G (UMTS, HSUPA, HSPA), 4G (LTE)ray;\r\n                            \r\n                            ',1),(8,'Iphone Xs 64 GB Silver (698790)',6,32999,50,'Apple',NULL,'Новый iPhone XS от Apple \r\nПочему стоит выбрать новый iPhone XS? Более мощный процессор, улучшенное распознавание лица, защита корпуса согласно стандарту IP68. Смартфон может полчаса находится на глубине до 2 метров под водой, что позволяет владельцу делать красивые снимки. Новая модель доступна в еще одном цвете - золото, а также в сером и серебристом как и iPhone X. Смартфон оснащен 8 дюймовым OLED-экраном, благодаря которому на дисплее находится яркая и насыщенная картинка. Производительность обеспечивает микросхема A12 Bionic, совместно с оперативной памятью в 4 ГБ. Вы можете выбрать один из доступных объемов памяти от 64 ГБ, 256 и 512. В телефоне установлены стереодинамики, поэтому уровень громкости увеличен в 2 раза за счет использования HDR и Dolby Vision. Более мощный аккумулятор на 2 700 мАч обеспечивает продолжительную работу смартфона. Также вы можете использовать беспроводную станцию для зарядки устройства, за полчаса возможно зарядить на 50% батарею. Многие выбирают Apple благодаря качественной камере на 12 мегапикселей со светосилой f/1.8 и f/2.4. Особенностью камеры новой модели iPhone XS является возможность еще больше размывать фон в режиме “Портрет”, а объект фокусировки получается более четким и детализированным. За счет Smart HDR во время съемки можно регулировать уровень резкости, а также размытие фона.',1,'2019-01-27','2019-01-22','Производитель Apple;  Стандарт связи 4G (LTE);  Сенсорный экран	Да    \r\n                            ',1),(9,'Meizu M6s 3/32GB Gold',2,4097,25,'Meizu',NULL,'Диагональ: 5.7\"Разрешение: 1440 x 720 (18:9 HD+)Контрастность: 1000: 1PPI: 282Яркость: 450 кд/м²',1,'2019-01-27','2019-01-22','Производитель Meizu;  Стандарт связи 4G (LTE); Материал корпуса Металл\r\n                            \r\n                            ',1),(10,'ORIGINAL Xiaomi Redmi Note 5 Black (3Gb/32Gb)',2,4299,72,'Xiomi',NULL,'Продукты китайской корпорации Сиаоми часто становятся международными бестселлерами. Секрет успеха прост: компания входит в то небольшое число разработчиков, способных сочетать в своей продукции конкурентоспособную цену, замечательное качество сборки и превосходные технические характеристики. Великолепным получился и герой сегодняшнего обзора. Сможет ли он продолжить победное шествие предшественников?\r\n\r\nВполне. Пусть черты цельнометаллического корпуса и не были сильно изменены по сравнению с четвертым поколением фаблетов организации, изогнутое стекло дисплея, дактилоскопический датчик и приятный глазу логотип фирмы оставляют если не восторг, то невероятно положительные впечатления. Сам IPS-OGS-экран с разрешением в2160 на 1080 пикселей также выглядит дорого. Невозможно придраться как к эффективности олеофобного покрытия, так и к уровням яркости, контрастности.\r\n\r\nВпечатляет и общая производительность гаджета. Обеспечивается она комбинацией мощного процессора Snapdragon 625, 3/4гб ОЗУ и графического чипа Adreno 506. Подобной связки хватит для ресурсоемких игр на ближайший год. А уж беспокоиться об ограниченности внутреннего хранилища точно не стоит - 32/64гб ПЗУ и MicroSD-слот уместят в себе даже десятки полнометражных кинокартин.',1,'2019-01-27','2019-01-22','Производитель Xiaomi; Тип устройства Смартфон;  Форм-фактор	Моноблок;  Стандарт связи	CDMA, GPRS, GSM, 3G (UMTS, HSUPA, HSPA), 4G (LTE)\r\n                            \r\n                            ',1),(11,'Смартфон HomTom HT16 3000мAч',5,1650,66,'HomTom',NULL,'HomTom HT16 – смартфон с необычным романтическим дизайном и мягкой гаммой цветовых решений. Оптимальный 5-дюмовый HD дисплей, текстурная задняя панель, четырехядерный процессор, 8-мегапиксельная камера Sony, батарея 3000 мАч, Android 6.0 Marshmallow.\r\n\r\nОтличительная особенность Homtom HT16 – дизайн, который производитель назвал изящным, освежающим и романтичным. Задняя крышка Homtom HT16, украшенная текстурой с тиснением под штриховую линию, выпускается в трех цветовых решениях: Macaron Blue (синий), Noble White (белый) и Gentle Black (серый). Также горизонтальное расположение логотипа Homtom  изменено на вертикальное.\r\n\r\nДисплей HomTom HT16 получил оптимальную 5-дюймовую диагональ и разрешение 1280×720 пикселей что, соответственно, физически позволяет управлять ним одной рукой. Кнопки включения и громкости HomTom HT16, в отличии от предыдущей модели, расположены на правильном месте – справа.',1,'2019-01-27','2019-01-27','Производитель Doogee;\r\nТип устройства Мобильный телефон;\r\nФорм-фактор	Моноблок;\r\nСтандарт связи	3G (UMTS, HSUPA, HSPA), GPRS, GSM',1),(12,'Samsung Galaxy J7 2017 16GB Black',8,6300,50,'Samsung',NULL,'в наличии Black. проверка при доставке. c телефона совершен один звонок для активации.\r\n\r\nакселерометр, гироскоп, магнитометр, датчик силы тяжести, датчик частоты, датчик приближения и освещения, датчик линейного ускорения, датчик отпечатка пальца. дисплей отзывчив,на солнце видно хорошо,есть фильтр синего цвета для использования в темноте',1,'2019-01-27','2019-01-27','Производитель Samsung;  Страна производитель Вьетнам;  Тип устройства	Смартфон; Форм-фактор	Моноблок',1),(13,'Xiaomi Mi5 Standard 3 32GB White ',2,7300,66,'Xiomi',NULL,'Xiaomi Mi5 Standard – флагман китайского производителя образца 2016 года. Модель гармонично сочетает в себе умеренную стоимость, максимальную производительность и эффектный дизайн. 5,2-дюймовый смартфон весит всего 129 г, но при этом его корпус вмещает литий-полимерный аккумулятор ёмкостью 3000 мАч с поддержкой технологии быстрой зарядки Quick Charge 3.0. В качестве дисплея задействована 5,2-дюймовая IPS матрица разрешением 1920х1080 точек с плотностью пикселей 428 (ppi). Смартфон работает под управлением операционной системы Android с пользовательской оболочкой MIUI.',1,'2019-01-27','2019-01-27','Производитель  Xiaomi;  Стандарт связи 4G (LTE); Цвет White;',1),(14,'Смартфон Huawei P Smart 3/32Gb Black',9,4500,15,'Huawei',NULL,'Характеристика\r\nТип устройства    смартфон\r\nСтандарты связи    GSM / 3G / 4G (LTE) / VoLTE\r\nОперационная система    Android v 8.0\r\nСлоты для карт    SIM + SIM/microSD\r\nДисплей    5.65 \" / 2160x1080 пикс / 427 ppi / IPS\r\nсенсорный экран / стекло 2.5D\r\nМодель процессора    HiSilicon Kirin 659\r\nЧастота процессора    2.36 ГГц\r\nКол-во ядер процессора    8 / 4 + 4 (2.36 ГГц + 1.7 ГГц) /\r\nГрафический процессор    ARM Mali-T830 MP2\r\nОперативная память    3 ГБ\r\nВстроенная память    32 ГБ\r\nТип основной камеры    2 объектива\r\nОсновная камера    13 МП\r\nСветосила основной камеры    f/2.2\r\nОсновная камера (теле)    2 МП\r\nСъемка HD (720p)    1280x720 пикс\r\nСъемка Full HD (1080p)    1920х1080 пикс\r\nВспышка    \r\nФронтальная камера    8 МП\r\nСветосила фронтальной камеры    f/2.0\r\nКоммуникации    Wi-Fi 4 (802.11n) / Bluetooth v 4.2 / USB хост /NFC-чип\r\nНавигация  aGPS / GPS-модуль / Поддержка ГЛОНАСС    \r\nЦифровой компас    \r\nСканер отпечатка пальца\r\nРасположение сканера    сзади\r\nТип аккумулятора    Li-Pol   3000 мАч    \r\nМатериал рамки/крышки    металл/металл\r\nРазмеры (ВхШхТ)    150x72x7.45 мм    Вес    143 г',1,'2019-01-27','2019-01-27','Производитель  Huawei;  Тип устройства Смартфон; Форм-фактор	Моноблок; Стандарт связи 3G (UMTS, HSUPA, HSPA), 4G (LTE);',1),(15,'Смартфон Samsung Galaxy A6 2018 3/32GB Black',8,6000,33,'Samsung',NULL,'Смартфон Galaxy A6 (2018) является немного уменьшенной версией Samunf Galaxy A6+ и сочетает в себе элегантный дизайн премиум-класса, долговечный алюминиевый корпус и шикарный экран. Его 5.6-дюймовый Infinity Display с матрицей Super AMOLED имеет разрешение 1480 х 720 и соотношение экрана 18,5:9. samsung galaxy a6 a600f 3/32\r\nБлагодаря мощному 8-ядерному процессору Samsung Exynos 7870, графическому чипу Mali-T830 MP1, 3 Гб оперативной памяти и Android 8.0, смартфон отлично справляется со сложными задачами, играми, видео. контро',1,'2019-01-27','2019-01-27','Производитель Samsung; Тип устройства Смартфон; Форм-фактор Моноблок; Количество поддерживаемых SIM-карт	2\r\n                            ',1),(16,'Мобильный телефон Xiaomi Mi A2 Lite',2,5699,15,'Xiomi',NULL,'Бесконечный реализм и высокая детализация картинки. Наслаждайтесь фильмами, играми и общением на огромном 6,26-дюймовом IPS-дисплее с разрешением Full HD+ (2280х1080 пикселей). При соотношении сторон 19:9, он занимает 86% площади лицевой стороны и надежно защищен закалённым 2,5D-стеклом Gorilla Glass. Минимальные рамки, насыщенные цвета и высокая детализация картинки превращают все происходящее на экране в захватывающее зрелище',1,'2019-01-27','2019-01-27','Производитель  Xiaomi;  Страна производитель	Китай',1),(17,'Мобильный телефон ZTE ',1,6233,18,'ZTE',NULL,'Множество людей в современном мире всегда намереваются взобраться на вершину славы посредством технических новинок, которые способны поразить своими способностями. По этой причине мастера создали мобильный телефон ZTE Blade V7, который имеет не только восхитительный дизайн от превосходного бренда, но и функциональность высшего качества. Именно такие особенности являются воплощением представленного смартфона, что стоит на пике технического величия, которое, несомненно, будет поражать людей и дальше. ',1,'2019-01-27','2019-01-27','Производитель ZTE;  Страна производитель Китай; Форм-фактор	Моноблок; Материал корпуса	Металл',1),(18,'Xiaomi Mi A2 4 32GB Black',2,5300,66,'Xiomi',NULL,'Xiaomi Mi A2 - это второе поколение в линейке смартфонов компании на \"чистом Android\", то есть без дополнительных оболочек. Смартфон создан в сотрудничестве с Google по программе Android One. Mi A2 является копией модели Mi6x с точки зрения аппаратных характеристик. Дисплей аппарата выполнен по технологии IPS, его диагональ составляет 5,99 дюйма, а разрешение - FullHD+. В качестве процессора используется Qualcomm Snapdragon 660. Основная камера представлена двумя модулями - на 12 и 20мегапикселей. Фронтальная - 20-мегапиксельным сенсором. Xiaomi Mi A2 оснащен несъемным аккумулятором на 3000 мАч, чего в сочетании с чистым Android должно хватать более чем на сутки активного использования.',1,'2019-01-27','2019-01-27','Производитель  Xiaomi;  Стандарт связи 4G (LTE);  Материал корпуса	Алюминий;  Цвет Black',1),(19,'Смартфон Xiaomi Redmi 6A 4G ',2,2800,9,'Xiomi',NULL,'Xiaomi Redmi 6A\r\nЦвета -Золотой ,Голубой\r\nОсновные характеристики\r\nСмартфон\r\nXiaomi Redmi 6A 5.45 дюйма 4G MIUI 9.0 ( Андроид 8.1 ) MTK6762M 4 ядра \r\n2.0 ГГц 2 ГБ RAM 16 ГБ ROM13.0Mп задняя камера 3000 мАч встроенный \r\n Дисплей: экран 5.45 дюйма 1440 x 720 пикселей\r\nПроцессор:MTK6762M 4 ядра 2.0 ГГц\r\nСистема: MIUI 9.0 ( Андроид 8.1 ) \r\nХранение: 2 ГБ RAM 16 ГБ ROM\r\nКамера: Задняя камера 13.0Mп и передняя камера 5.0Mп\r\nДатчики: Датчик окружающего света, гироскоп, датчик расстояния, электронный компас, G-сенсор Особенности: GPS, Glonass, AGPS\r\nБлютуз: 4.1\r\nSIM-карта:Nano SIM-карта+Nano SIM-карта / Микро карта SD',1,'2019-01-27','2019-01-27','Производитель Xiaomi;  Страна производитель	Китай; Тип устройства	Смартфон; Форм-фактор	Моноблок',1),(20,'Смартфон Xiaomi Mi 8 Lite',2,6444,32,'Xiomi',NULL,'Xiaomi Mi 8 Lite – упрощенная версия флагмана представленного компанией совсем недавно. Модель получила обновленный дизайн, соответствующий современным тенденциям: безрамочность, большой экран с соотношением 19:9, экстравагантные цвета в оформлении. Xiaomi Mi 8 Lite построен на базе производительной и в тоже время энергоэффективной платформы Qualcomm Snapdragon 660. Ее достаточно для спокойного выполнения любых повседневных задач. Экран смартфона имеет диагональ 6,26-дюйма и выполнен по технологии IPS. Дисплей покрывает 82,5% площади передней панели, а его разрешение составляет 2280х1080 точек. Устройство получило сдвоенный модуль камеры, состоящий из сенсоров на 12 и 5 МП. Меньший используется для определения глубины, что позволяет снимать хорошие автопортреты. Аккумулятор Xiaomi Mi 8 Lite имеет емкость 3350 мАч, благодаря чему автономности достаточно для комфортного использования на протяжении дня. ',1,'2019-01-27','2019-01-27','Производитель Xiaomi;  Страна производитель	Китай; Тип устройства	Смартфон; Форм-фактор Моноблок',1),(21,'Doogee X60 Gold',3,2100,16,'Doggee',NULL,'Смартфон Dogee X60 Соотношение сторон 18:9 Дисплей с продуманным соотношением сторон 18:9 позволит взглянуть на мир шире! IPS-дисплей диагональю 5,5\" Благодаря IPS-дисплею 5,5 дюйма, защищенному стеклом 2.5D, смартфон X60 не хочется выпускать из рук, и можно играть в видеоигры или смотреть фильмы бесконечно.Линии корпуса, мягко скрывающие рамку дисплея, создают впечатление полного погружения в мир на экране. 4-ядерный процессор Quad Core Благодаря 4-ядерному процессору и современной ОС, X60 совмещает огромную вычислительную мощность с широкими возможностями многозадачности. Все удобства у вас на ладони Смартфон X60 с безрамочным дисплеем с соотношением сторон 18:9 подарит вам незабываемые ощущения. Ультратонкий корпус с интегрированным сверхпрочным стеклом 2.5D — это сплав красоты и надежности. Взяв его один раз, вы больше не захотите выпускать его из рук.Лучшие воспоминания во всех подробностях 8.0(SW)+5.0 Мп Благодаря сдвоенной камере 8.0(SW)+5.0 Мп. X60 может делать потрясающие панорамные снимки. С таким сочетанием характеристик камеры и качества изображений ваши лучшие воспоминания всегда будут с вами во всех подробностях. 3300 мАч Благодаря аккумулятору емкостью 3300 мАч вы забудете о том, что смартфон может разрядиться в пути. Эффективная система управления ресурсами позволяет потреблять минимум энергии, что делает наш смартфон самым автономным среди конкурентов с аккумуляторами этой же емкости. Мгновенная разблокировка 0.1 с X60 оснащается сканером отпечатков пальцев на задней панели, прикосновение к которому разблокирует смартфон всего за 0,1 с.',1,'2019-01-27','2019-01-27','Производитель  Doogee; Стандарт связи	4G (LTE); Материал корпуса	Пластик',1);
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
  `password` text,
  `phone` varchar(15) DEFAULT NULL,
  `role` varchar(45) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'Fox','Dream','DreamFoxxy','dream@gmail.com','301fdb4ab42afde8b70c0395b507907c','+380501700086','admin');
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

-- Dump completed on 2019-01-30 11:16:09
