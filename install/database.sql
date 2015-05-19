CREATE DATABASE  IF NOT EXISTS `eop2_db1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eop2_db1`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: eop2_db1
-- ------------------------------------------------------
-- Server version	5.6.14

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
-- Table structure for table `eop_access_log`
--

DROP TABLE IF EXISTS `eop_access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_access_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `body` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_access_log`
--

LOCK TABLES `eop_access_log` WRITE;
/*!40000 ALTER TABLE `eop_access_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_activity_log`
--

DROP TABLE IF EXISTS `eop_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `activity` varchar(45) DEFAULT NULL COMMENT 'create\nedit\ndelete\nother',
  `body` text,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_activity_log`
--

LOCK TABLES `eop_activity_log` WRITE;
/*!40000 ALTER TABLE `eop_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_district`
--

DROP TABLE IF EXISTS `eop_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `screen_name` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `state_val` varchar(8) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) DEFAULT NULL,
  `state_permission` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_district`
--

LOCK TABLES `eop_district` WRITE;
/*!40000 ALTER TABLE `eop_district` DISABLE KEYS */;
INSERT INTO `eop_district` VALUES (1,'first district','f district',NULL,'CAL','2015-05-18 15:00:01',1,NULL);
/*!40000 ALTER TABLE `eop_district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_entity`
--

DROP TABLE IF EXISTS `eop_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `owner` int(32) DEFAULT NULL,
  `parent` int(32) DEFAULT NULL,
  `weight` int(8) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_entity`
--

LOCK TABLES `eop_entity` WRITE;
/*!40000 ALTER TABLE `eop_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_field`
--

DROP TABLE IF EXISTS `eop_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(32) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `weight` int(8) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(45) DEFAULT NULL,
  `body` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_field`
--

LOCK TABLES `eop_field` WRITE;
/*!40000 ALTER TABLE `eop_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_registry`
--

DROP TABLE IF EXISTS `eop_registry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_registry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `value` varchar(128) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_registry`
--

LOCK TABLES `eop_registry` WRITE;
/*!40000 ALTER TABLE `eop_registry` DISABLE KEYS */;
INSERT INTO `eop_registry` VALUES (1,'installed','yes','2015-05-08 19:57:04'),(2,'install_status','completed','2015-05-13 21:33:16'),(3,'dbtype','0','2015-05-13 21:33:16'),(4,'host_level','district','2015-05-13 21:33:16'),(5,'install_status','completed','2015-05-13 21:37:40'),(6,'dbtype','mysqli','2015-05-13 21:37:40'),(7,'host_level','district','2015-05-13 21:37:40'),(8,'install_status','completed','2015-05-14 12:49:28'),(9,'dbtype','mysqli','2015-05-14 12:49:28'),(10,'host_level','district','2015-05-14 12:49:28'),(11,'install_status','completed','2015-05-14 12:57:15'),(12,'dbtype','mysqli','2015-05-14 12:57:15'),(13,'host_level','district','2015-05-14 12:57:15'),(14,'host_state','CAL','2015-05-18 14:37:57'),(15,'state_permission','write','2015-05-19 03:54:25');
/*!40000 ALTER TABLE `eop_registry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_role_permission`
--

DROP TABLE IF EXISTS `eop_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(32) DEFAULT NULL,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `permissions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_role_permission`
--

LOCK TABLES `eop_role_permission` WRITE;
/*!40000 ALTER TABLE `eop_role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_school`
--

DROP TABLE IF EXISTS `eop_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(32) DEFAULT NULL,
  `state_val` varchar(8) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `screen_name` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(32) DEFAULT NULL,
  `state_permission` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_school`
--

LOCK TABLES `eop_school` WRITE;
/*!40000 ALTER TABLE `eop_school` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_state`
--

DROP TABLE IF EXISTS `eop_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val` varchar(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `screen_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `val_UNIQUE` (`val`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_state`
--

LOCK TABLES `eop_state` WRITE;
/*!40000 ALTER TABLE `eop_state` DISABLE KEYS */;
INSERT INTO `eop_state` VALUES (1,'CAL','California','California'),(2,'MD','Maryland','Maryland');
/*!40000 ALTER TABLE `eop_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user`
--

DROP TABLE IF EXISTS `eop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(96) DEFAULT NULL,
  `last_name` varchar(96) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `status` varchar(24) DEFAULT NULL COMMENT 'active\nblocked',
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `read_only` char(1) DEFAULT 'n',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user`
--

LOCK TABLES `eop_user` WRITE;
/*!40000 ALTER TABLE `eop_user` DISABLE KEYS */;
INSERT INTO `eop_user` VALUES (1,1,'ssssss','ssssss','majregor@gmail.com','majregor','7ce8bcd42b1efa29518674ec4a99fa60','1212121212','active','2015-05-13 12:10:13',NULL,'n'),(2,1,'sssss','ssssss','admin1@xgility.com','admin','128e61891b7bf0cfafbbc589a65ce5f6','1212121212','active','2015-05-13 15:53:57',NULL,'n'),(3,1,'ssss','ssssss','admin3@xgility.com','admin3','af15d5fdacd5fdfea300e88a8e253e82','2323','active','2015-05-13 17:20:54',NULL,'n'),(5,1,'sssss','ssssss','gondolf@d.com','admin2','7ce8bcd42b1efa29518674ec4a99fa60','','active','2015-05-14 08:57:15',NULL,'n'),(7,2,'asdasdfhasidhua','asdhfakfdahkdd','ASKHAKSJ@ASKDSJf','majregor1','d785c99d298a4e9e6e13fe99e602ef42','2407056739','active','2015-05-15 16:08:24',NULL,'n'),(11,4,'~~`!@3$%^&*()_+\'{{]}\\\\||\'\'??..>><<&&','~~`!@3$%^&*()_+\'{{]}\\\\||\'\'??..>><<&&','mad@ss.com','majregor2','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-15 16:10:35',NULL,'n'),(13,5,'jlskslkdjfg','klhdkjs1','lkjlk@sds.com','majregor3','7ce8bcd42b1efa29518674ec4a99fa60','2407056739','active','2015-05-15 16:14:21',NULL,'n'),(14,3,'ssss','sssss','sds@dd.com','majregor@glydenet.com','3abf00fa61bfae2fff9133375e142416','2407056739','active','2015-05-19 02:09:12',NULL,'n');
/*!40000 ALTER TABLE `eop_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user2school`
--

DROP TABLE IF EXISTS `eop_user2school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user2school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `sid` int(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user2school`
--

LOCK TABLES `eop_user2school` WRITE;
/*!40000 ALTER TABLE `eop_user2school` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_user2school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user_access`
--

DROP TABLE IF EXISTS `eop_user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL,
  `entity_id` int(32) DEFAULT NULL,
  `field_id` int(32) DEFAULT NULL,
  `permissions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user_access`
--

LOCK TABLES `eop_user_access` WRITE;
/*!40000 ALTER TABLE `eop_user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `eop_user_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eop_user_roles`
--

DROP TABLE IF EXISTS `eop_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eop_user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Super Admin\nState Administrator\nDistrict Administrator\nSchool Administrator\nSchool User\nUser\nAnonymous',
  `screen_name` varchar(32) DEFAULT NULL,
  `description` text,
  `is_locked` char(1) NOT NULL DEFAULT 'n',
  `can_view` char(1) NOT NULL DEFAULT 'y',
  `can_edit` char(1) NOT NULL DEFAULT 'y',
  `create_district` char(1) DEFAULT 'n',
  `edit_district` char(1) DEFAULT 'n',
  `create_school` char(1) DEFAULT 'n',
  `edit_school` char(1) DEFAULT 'n',
  `create_user` char(1) DEFAULT 'y',
  `edit_user` char(1) DEFAULT 'y',
  `alter_state_access` char(1) DEFAULT 'n',
  `edit_entity` char(1) DEFAULT 'y',
  `level` int(8) DEFAULT NULL COMMENT '1 - super admin\n2 - state admin\n3 - district admin\n4 - school admin\n5 - school user',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eop_user_roles`
--

LOCK TABLES `eop_user_roles` WRITE;
/*!40000 ALTER TABLE `eop_user_roles` DISABLE KEYS */;
INSERT INTO `eop_user_roles` VALUES (1,'Super Admin',NULL,'Super Administrator','n','y','y','y','y','n','n','y','y','n','y',1),(2,'State Administrator',NULL,'State Administrator','n','y','y','y','y','n','n','y','y','n','y',2),(3,'District Administrator',NULL,'District Administrator','n','y','y','n','n','n','n','y','y','n','y',3),(4,'School Administrator',NULL,'School Administrator','n','y','y','n','n','n','n','y','y','n','y',4),(5,'School User',NULL,'School User','n','y','y','n','n','n','n','y','y','n','y',5);
/*!40000 ALTER TABLE `eop_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `eop_view_user`
--

DROP TABLE IF EXISTS `eop_view_user`;
/*!50001 DROP VIEW IF EXISTS `eop_view_user`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `eop_view_user` (
  `user_id` tinyint NOT NULL,
  `role_id` tinyint NOT NULL,
  `first_name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `username` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `join_date` tinyint NOT NULL,
  `modified` tinyint NOT NULL,
  `read_only` tinyint NOT NULL,
  `role` tinyint NOT NULL,
  `school` tinyint NOT NULL,
  `school_id` tinyint NOT NULL,
  `district_id` tinyint NOT NULL,
  `district_name` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `eop_view_user`
--

/*!50001 DROP TABLE IF EXISTS `eop_view_user`*/;
/*!50001 DROP VIEW IF EXISTS `eop_view_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `eop_view_user` AS select `A`.`user_id` AS `user_id`,`A`.`role_id` AS `role_id`,`A`.`first_name` AS `first_name`,`A`.`last_name` AS `last_name`,`A`.`email` AS `email`,`A`.`username` AS `username`,`A`.`password` AS `password`,`A`.`phone` AS `phone`,`A`.`status` AS `status`,`A`.`join_date` AS `join_date`,`A`.`modified` AS `modified`,`A`.`read_only` AS `read_only`,`B`.`title` AS `role`,`D`.`name` AS `school`,`D`.`id` AS `school_id`,`D`.`district_id` AS `district_id`,`E`.`name` AS `district_name` from ((((`eop_user` `A` join `eop_user_roles` `B` on((`A`.`role_id` = `B`.`role_id`))) left join `eop_user2school` `C` on((`A`.`user_id` = `C`.`uid`))) left join `eop_school` `D` on((`C`.`sid` = `D`.`id`))) left join `eop_district` `E` on((`D`.`district_id` = `E`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-19  8:22:38
