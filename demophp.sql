-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: demo
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (5,'admin','$2y$12$AlTYXWzu.TNly.kHErzWNuPQYEmLUjvu1WxaJvTjHLxAyAU7dygmC','nam nguyen','admin'),(6,'admin1','$2y$12$LI9cx36dxKkUNxqURPAlfedfjrVQIGYL1AsDx8cDC/yg7lnLhW9ou','nam nguyen','user'),(7,'admin2','$2y$12$lXuCiXfVqsBUUlmklcpEF.ic7XfbU3EkC2S.QP4kSEnpeY62Cuj5e','nam nguyen','admin');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_p_idx` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'trái  caf'),(2,'củ cá');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderdetails` (
  `orderDetailID` int NOT NULL AUTO_INCREMENT,
  `orderID` int NOT NULL,
  `productID` int NOT NULL,
  `soLuong` int NOT NULL,
  `donGia` decimal(10,2) NOT NULL,
  `thanhTien` decimal(10,2) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `orderID` (`orderID`),
  KEY `productID` (`productID`),
  CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`),
  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (64,48,2,3,599.00,1797.00),(65,49,8,6,999.00,5994.00),(66,49,3,12,56565.00,76767.00),(67,49,4,6,8565.00,7676.00),(68,50,4,1,999.00,999.00),(69,51,8,1,999.00,999.00),(70,51,4,1,999.00,999.00),(71,52,8,1,999.00,999.00),(72,52,4,1,999.00,999.00),(73,53,3,1,999.00,999.00),(74,53,4,1,999.00,999.00),(75,54,3,1,999.00,999.00),(76,54,8,1,999.00,999.00);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hoTen` varchar(255) NOT NULL,
  `dienThoai` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` text NOT NULL,
  `ghiChu` text,
  `phuongThucThanhToan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (48,'nam nguyen','0389510507','namnguyen2505021@gmail.com','sdsdsds','','bank_transfer'),(49,'nam nguyen','0389510507','namnguyen2505021@gmail.com','aaaaaaaaaaaaaaaaaa','','cod'),(50,'nam nguyen','0389510507','namnguyen250502@gmail.com','sdsdsds','','bank_transfer'),(51,'nam nguyen','0389510507','namnguyen250502@gmail.com','sdsdsds','test mail','bank_transfer'),(52,'nam nguyen','0389510507','namnguyen250502@gmail.com','sdsdsds','','bank_transfer'),(53,'nam nguyen','0389510507','namnguyen250502@gmail.com','sdsdsds','','bank_transfer'),(54,'nam nguyen','0389510507','knkeniki@gmail.com','sdsdsds','','bank_transfer');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `thumnail` varchar(300) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_c_idx` (`category_id`),
  CONSTRAINT `p_c` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'Nam nguyễn','',823,'public/img/best-product-2.jpg','uploads/1iphone 16.jpg',1),(3,'Xe Mazda CX5 Premium 2.0 AT 2022','Xe Mazda CX5 Premium 2.0 AT 2022',999,'public/img/best-product-3.jpg','uploads/1iphone 16.jpg',1),(4,'Xe BMW 5 Series 528i GT 2014','',999,'public/img/best-product-4.jpg','uploads/1iphone 16.jpg',1),(8,'Xe Mitsubishi Triton 4x4 AT Mivec 2017','Xe Mazda CX5 Premium 2.0 AT 2022',999,'public/img/best-product-6.jpg','uploads/1iphone 16.jpg',2),(11,'namaaa','sdsdsds',45454,'uploads/Screenshot 2024-04-13 113208.png',NULL,1),(12,'43434','434343',434343,'uploads/Screenshot 2024-03-14 144426.png',NULL,1),(13,'\'con gà có mấy cái chân','53543',54545,'uploads/Screenshot 2024-02-21 145118.png',NULL,1),(14,'11111','24242',88888,'uploads/Screenshot 2024-02-23 113356.png',NULL,2),(15,'sdsds','sdsds',435,'uploads/Screenshot 2024-02-28 141848.png',NULL,2),(16,'nam2','1',8,'uploads/Screenshot 2024-02-21 142359.png',NULL,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rvs_idx` (`product_id`),
  CONSTRAINT `rv_p` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'nam','test content',3,'2024-04-11 17:23:48'),(2,'dsdsd','',2,'2024-04-14 10:04:52'),(3,'Cay','',2,'2024-04-14 10:08:07'),(4,'dsds','dsdsds',2,'2024-04-14 10:09:51'),(5,'aaaa','aaaaaa',2,'2024-04-14 10:39:55'),(6,'ngân','dsdsds',2,'2024-04-14 10:47:56');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-14 18:12:40
