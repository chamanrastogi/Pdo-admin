-- Simple Backup SQL Dump
-- Version 1.0.3
-- https://www.github.com/coderatio/simple-backup/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2020 at 06:20 PM
-- MYSQL Server Version: 5.5.5-10.4.11-MariaDB
-- PHP Version: 7.3.13
-- Developer: Josiah O. Yahaya
-- Copyright: Coderatio

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00"

--
-- Database: `defence_new`
-- Total Tables: 11
--

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
-- Table structure for table `menucat`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menucat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menucat`
--

LOCK TABLES `menucat` WRITE;
/*!40000 ALTER TABLE `menucat` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menucat` VALUES (1,'Page','Active'),(2,'Url','Active'),(3,'External Page','Active'),(4,'Category','Active');
/*!40000 ALTER TABLE `menucat` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menucat` with 4 row(s)
--

--
-- Table structure for table `menus`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menus` VALUES (1,0,'Home','home','1',2,1,'Active'),(2,0,'about','about','1',1,1,'Active');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menus` with 2 row(s)
--

--
-- Table structure for table `menutype`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menutype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menutype`
--

LOCK TABLES `menutype` WRITE;
/*!40000 ALTER TABLE `menutype` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menutype` VALUES (1,'Page','Active'),(2,'Url','Active'),(3,'External Page','Active'),(4,'Category','Active');
/*!40000 ALTER TABLE `menutype` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menutype` with 4 row(s)
--

--
-- Table structure for table `menu_group`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_group`
--

LOCK TABLES `menu_group` WRITE;
/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu_group` VALUES (1,'Main Menu'),(2,'Quick Links'),(3,'Footer Menu');
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu_group` with 3 row(s)
--

--
-- Table structure for table `module`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `link` varchar(100) NOT NULL,
  `text` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `ftext` mediumtext NOT NULL,
  `status` enum('Active','Deactive','','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `module` VALUES (1,'phone','phone','','00 000 123 456','','','Active'),(2,'email','email','','info@identity_art.com','','','Active'),(3,'address','address','','dolor sit amet, consectetur adipisicing elit','','','Active'),(4,'Home About','About Us','about-us','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse minima distinctio facere velit provident? Beatae nulla magni nesciunt sed aut quam, vel dolor, officia sunt numquam deserunt, sequi fugiat libero Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse minima distinctio facere velit provident? Beatae nulla magni nesciunt sed aut quam, vel dolor, officia sunt numquam deserunt, sequi fugiat libero.</p>\r\n','Active'),(5,'Footer About us','About Us','','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae delectus ipsa, ducimus, tempora corporis tenetur a illo perspiciatis. In obcaecati, hic ut at ipsam consequatur.','Koala_2962984.jpg','','Active'),(6,'dss','asd','#','dsfdsfld','','asdasssss---sdas','Active');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `module` with 6 row(s)
--

--
-- Table structure for table `page`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `keyword` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `page` VALUES (1,'2','About Us','About Us','ss','sss','aboutimg.png','<p>sadasd</p>\r\n');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `page` with 1 row(s)
--

--
-- Table structure for table `social`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social`
--

LOCK TABLES `social` WRITE;
/*!40000 ALTER TABLE `social` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `social` VALUES (1,'Facebook','https://www.facebook.com/','facebook','Active'),(2,'Twitter','https://twitter.com/','twitter','Active'),(3,'Youtube','https://youtube.com/','youtube-play','Active'),(4,'Instagram','https://www.instagram.com/','instagram','Active');
/*!40000 ALTER TABLE `social` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `social` with 4 row(s)
--

--
-- Table structure for table `template`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `sitename` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `web_site_logo` varchar(200) NOT NULL,
  `web_site_footer_logo` varchar(255) NOT NULL,
  `fab_icon` varchar(200) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `support_tel` varchar(255) NOT NULL,
  `contact_tel` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `keyword` mediumtext NOT NULL,
  `analytics` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `template` VALUES (1,'#','defencebyte','defencebyte','logo.png','','favicon.png','support@defencebyte.com','','','','','','');
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `template` with 1 row(s)
--

--
-- Table structure for table `test`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_username` varchar(100) NOT NULL,
  `adm_password` varchar(100) NOT NULL,
  `adm_image` varchar(100) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_phone` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `about` mediumtext NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `test` with 0 row(s)
--

--
-- Table structure for table `testimonial`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `text` mediumtext NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial`
--

LOCK TABLES `testimonial` WRITE;
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `testimonial` with 0 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_username` varchar(100) NOT NULL,
  `adm_password` varchar(100) NOT NULL,
  `adm_image` varchar(100) NOT NULL,
  `adm_fullname` varchar(100) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_phone` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `about` mediumtext NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'admin','$2y$04$m4l9Yg6lBcOWKNjiDPGs8OClqmukhfP3nfhFWpWFFcjl9a74ZWope','avtar_8481848.png','Admin','chaman@gmail.com','2342342333','admin','sadasddfdssss','2020-05-12 14:42:23','2020-07-21 12:21:34','Active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 1 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Wed, 22 Jul 2020 18:47:20 +0530
