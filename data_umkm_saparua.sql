-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: data_umkm_saparua
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `koordinat` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokasi`
--

LOCK TABLES `lokasi` WRITE;
/*!40000 ALTER TABLE `lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `lokasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) DEFAULT NULL,
  `harga_menu` int(11) DEFAULT NULL,
  `jenis_menu` varchar(255) DEFAULT NULL,
  `id_umkm` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `fk_menu_umkm` (`id_umkm`),
  CONSTRAINT `fk_menu_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metode_pembayaran`
--

DROP TABLE IF EXISTS `metode_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metode_pembayaran` (
  `id_metode` int(11) NOT NULL AUTO_INCREMENT,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_metode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metode_pembayaran`
--

LOCK TABLES `metode_pembayaran` WRITE;
/*!40000 ALTER TABLE `metode_pembayaran` DISABLE KEYS */;
INSERT INTO `metode_pembayaran` VALUES (1,'Tunai'),(2,'QRIS'),(3,'Transfer Bank'),(4,'E-Wallet'),(5,'Debit Kredit'),(6,'Virtual Account');
/*!40000 ALTER TABLE `metode_pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra`
--

DROP TABLE IF EXISTS `mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mitra` varchar(255) DEFAULT NULL,
  `jenis_mitra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mitra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra`
--

LOCK TABLES `mitra` WRITE;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umkm`
--

DROP TABLE IF EXISTS `umkm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL AUTO_INCREMENT,
  `nama_stand` varchar(255) DEFAULT NULL,
  `nama_penjaga` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `sertifikasi_halal` enum('ada','tidak') DEFAULT 'tidak',
  `id_kategori` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_umkm`),
  KEY `fk_umkm_kategori` (`id_kategori`),
  KEY `fk_umkm_jadwal` (`id_jadwal`),
  KEY `fk_umkm_lokasi` (`id_lokasi`),
  CONSTRAINT `fk_umkm_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_umkm_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_umkm_lokasi` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umkm`
--

LOCK TABLES `umkm` WRITE;
/*!40000 ALTER TABLE `umkm` DISABLE KEYS */;
/*!40000 ALTER TABLE `umkm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umkm_mitra`
--

DROP TABLE IF EXISTS `umkm_mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `umkm_mitra` (
  `id_mitra` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  PRIMARY KEY (`id_mitra`,`id_umkm`),
  KEY `fk_um_umkm` (`id_umkm`),
  CONSTRAINT `fk_um_mitra` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_um_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umkm_mitra`
--

LOCK TABLES `umkm_mitra` WRITE;
/*!40000 ALTER TABLE `umkm_mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `umkm_mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umkm_pembayaran`
--

DROP TABLE IF EXISTS `umkm_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `umkm_pembayaran` (
  `id_umkm` int(11) NOT NULL,
  `id_metode` int(11) NOT NULL,
  PRIMARY KEY (`id_umkm`,`id_metode`),
  KEY `fk_up_metode` (`id_metode`),
  CONSTRAINT `fk_up_metode` FOREIGN KEY (`id_metode`) REFERENCES `metode_pembayaran` (`id_metode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_up_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umkm_pembayaran`
--

LOCK TABLES `umkm_pembayaran` WRITE;
/*!40000 ALTER TABLE `umkm_pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `umkm_pembayaran` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-11 17:34:12
