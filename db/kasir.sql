-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kasir
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id_menu` varchar(5) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES ('KF01','Coffee Espresso',18000),('KF02','Coffee Latte',14000),('KF03','Coffee Americano',12000),('KF04','Coffee Milk',10000),('KF05','Coffee Cappucino',13000),('KF06','Coffee Gula Aren',10000),('KF07','Coffee Arabica',17000),('KF08','Coffee Matcha',15000),('KF09','Coffee Original',8500),('KF10','Coffee Carramel',20000);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(5) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_menu` varchar(5) NOT NULL,
  `qty` int NOT NULL,
  `waktu_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `id_user` (`id_user`),
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES ('T0001','K001','KF02',2,'2025-06-17 03:06:15'),('T0002','K001','KF06',3,'2025-06-17 03:07:49'),('T003','K002','KF05',4,'2025-06-17 03:14:24'),('T0004','K002','KF02',2,'2025-06-17 03:23:54'),('T0005','K001','KF08',1,'2025-06-17 03:24:48'),('T0006','K001','KF07',7,'2025-06-17 03:25:07'),('T0007','K001','KF01',9,'2025-06-17 03:33:39');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('A001','admin','21232f297a57a5a743894a0e4a801fc3',1),('K001','kasir','c7911af3adbd12a035b289556d96470a',3),('K002','kasir2','c7911af3adbd12a035b289556d96470a',3),('M001','manajer','69b731ea8f289cf16a192ce78a37b4f0',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userlog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(5) NOT NULL,
  `userIP` varbinary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlog`
--

LOCK TABLES `userlog` WRITE;
/*!40000 ALTER TABLE `userlog` DISABLE KEYS */;
INSERT INTO `userlog` VALUES (1,'M001',_binary '::1','2025-06-17 03:03:45'),(2,'K001',_binary '::1','2025-06-17 03:07:23'),(3,'A001',_binary '::1','2025-06-17 03:09:04'),(4,'K002',_binary '::1','2025-06-17 03:10:05'),(5,'M001',_binary '::1','2025-06-17 03:26:04'),(6,'K001',_binary '::1','2025-06-17 03:33:07'),(7,'M001',_binary '::1','2025-06-17 03:33:55'),(8,'A001',_binary '::1','2025-06-17 03:34:31'),(9,'K001',_binary '::1','2025-06-17 03:38:39'),(10,'K001',_binary '::1','2025-06-17 03:39:51'),(11,'A001',_binary '::1','2025-06-17 03:40:35'),(12,'A001',_binary '::1','2025-06-17 03:43:21'),(13,'K001',_binary '::1','2025-06-17 03:52:30'),(14,'M001',_binary '::1','2025-06-17 03:52:40'),(15,'K001',_binary '::1','2025-06-17 03:55:04');
/*!40000 ALTER TABLE `userlog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-17 11:10:29
