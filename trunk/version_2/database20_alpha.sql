CREATE DATABASE  IF NOT EXISTS `betting_last` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `betting_last`;
-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: betting_last
-- ------------------------------------------------------
-- Server version	5.1.58-1ubuntu1

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
-- Table structure for table `bets`
--

DROP TABLE IF EXISTS `bets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bets` (
  `bets_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bet_name` varchar(250) NOT NULL,
  `groups_id_FK` int(11) unsigned NOT NULL,
  `add_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `bet_active` datetime NOT NULL,
  PRIMARY KEY (`bets_id`),
  KEY `Ref_07` (`groups_id_FK`),
  CONSTRAINT `Ref_07` FOREIGN KEY (`groups_id_FK`) REFERENCES `groups` (`groups_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`groups_id_FK`) REFER `nova_kladionic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bets`
--

LOCK TABLES `bets` WRITE;
/*!40000 ALTER TABLE `bets` DISABLE KEYS */;
INSERT INTO `bets` VALUES (4,'Wolves - Blackburn',95,'2012-05-05 20:54:54','2012-07-28 00:00:00','2012-05-01 00:00:00'),(5,'Bolton - QPR',95,'2012-05-05 20:55:14','2012-07-28 00:00:00','2012-05-01 00:00:00'),(6,'Wigan - Aston Villa',95,'2012-05-05 20:55:30','2012-07-28 00:00:00','2012-05-01 00:00:00'),(7,'Stoke - Norwich',95,'2012-05-05 20:55:51','2012-07-28 00:00:00','2012-05-01 00:00:00'),(8,'David Ferrer - Jo-Wilfried Tsonga',98,'2012-05-05 23:28:37','2012-07-19 01:01:00','2012-05-01 01:00:00'),(9,'Andy Murray - Roger Federer',98,'2012-05-05 23:29:02','2012-07-19 01:01:00','2012-05-01 01:00:00'),(11,'Philadelphia 76ers - New York Knicks',93,'2012-05-05 23:30:37','2012-07-19 01:01:00','2012-05-01 01:00:00'),(12,'New Jersey Nets - Boston Celtics',93,'2012-05-05 23:30:58','2012-07-19 01:01:00','2012-05-01 01:00:00');
/*!40000 ALTER TABLE `bets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bets_type`
--

DROP TABLE IF EXISTS `bets_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bets_type` (
  `bet_types_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_bets_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  `teams_has_bets_id_FK` int(11) unsigned DEFAULT NULL,
  `event_types_value_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY (`bet_types_id`),
  UNIQUE KEY `new_index11` (`event_bets_id_FK`,`event_types_value_id_FK`),
  KEY `Ref_28` (`teams_has_bets_id_FK`),
  KEY `fk_bets_type_1` (`event_types_value_id_FK`),
  CONSTRAINT `fk_bets_type_1` FOREIGN KEY (`event_types_value_id_FK`) REFERENCES `event_types_value` (`event_types_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Ref_28` FOREIGN KEY (`teams_has_bets_id_FK`) REFERENCES `teams_has_bets` (`teams_has_bets_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Ref_29` FOREIGN KEY (`event_bets_id_FK`) REFERENCES `event_bets` (`event_bets_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`teams_has_bets_id_FK`) REFER `nova_k';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bets_type`
--

LOCK TABLES `bets_type` WRITE;
/*!40000 ALTER TABLE `bets_type` DISABLE KEYS */;
INSERT INTO `bets_type` VALUES (74,46,NULL,10),(75,46,NULL,9),(76,46,NULL,8),(78,48,NULL,10),(79,48,NULL,9),(80,48,NULL,8),(81,49,NULL,10),(82,49,NULL,9),(83,49,NULL,8),(84,50,NULL,10),(85,50,NULL,9),(86,50,NULL,8),(87,51,NULL,27),(88,51,NULL,26),(89,52,NULL,27),(90,52,NULL,26),(91,53,NULL,25),(92,53,NULL,24),(93,53,NULL,23),(94,54,NULL,22),(95,54,NULL,21),(96,55,NULL,22),(97,55,NULL,21);
/*!40000 ALTER TABLE `bets_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_status_id_FK` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `mail_validation` varchar(50) DEFAULT NULL,
  `banned` tinyint(4) NOT NULL,
  `email_validated` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unike` (`user_name`),
  UNIQUE KEY `unikeemail` (`email`),
  KEY `Ref_39` (`user_status_id_FK`),
  CONSTRAINT `Ref_39` FOREIGN KEY (`user_status_id_FK`) REFERENCES `user_status` (`user_status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`user_status_id_FK`) REFER `nova_klad';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'goran','f41d3c04a14d075e45843b1be20cc0e97cc445f0','0000-00-00 00:00:00','0000-00-00 00:00:00','gorane','goran','gsambolic@net.hr',1,NULL,0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `groups_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_of_group` varchar(100) NOT NULL,
  `sports_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`groups_id`),
  UNIQUE KEY `group_name` (`name_of_group`,`sports_id_FK`),
  KEY `groups_to_sports` (`sports_id_FK`),
  CONSTRAINT `groups_to_sports` FOREIGN KEY (`sports_id_FK`) REFERENCES `sports` (`sports_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`sports_id_FK`) REFER `nova_kladionic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (98,'ATP Tour',17),(95,'English Premier League',15),(93,'NBA',16);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_type` (
  `transaction_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`transaction_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Admin'),(2,'Bet slip winnings'),(3,'Bet slip cost');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_types_value`
--

DROP TABLE IF EXISTS `event_types_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_types_value` (
  `event_types_value_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_types_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  `event_value_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`event_types_value_id`),
  UNIQUE KEY `unique` (`event_types_id_FK`,`event_value_name`),
  KEY `fk_event_types_value_1` (`event_types_id_FK`),
  CONSTRAINT `fk_event_types_value_1` FOREIGN KEY (`event_types_id_FK`) REFERENCES `event_types` (`event_types_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`event_id_FK`) REFER `nova_kladionica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_types_value`
--

LOCK TABLES `event_types_value` WRITE;
/*!40000 ALTER TABLE `event_types_value` DISABLE KEYS */;
INSERT INTO `event_types_value` VALUES (10,7,'1'),(8,7,'2'),(9,7,'X'),(12,8,'2-5'),(13,8,'6>'),(11,8,'<2'),(22,10,'1'),(21,10,'2'),(26,11,'120<'),(27,11,'120>'),(25,12,'1'),(23,12,'2'),(24,12,'X');
/*!40000 ALTER TABLE `event_types_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_status` (
  `user_status_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (1,'superadmin'),(2,'admin'),(3,'user'),(4,'guest');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bet_slip_odds`
--

DROP TABLE IF EXISTS `bet_slip_odds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bet_slip_odds` (
  `bets_slip_odds` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `odd_value_id_FK` int(11) unsigned NOT NULL,
  `bet_slip_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY (`bets_slip_odds`),
  KEY `Ref_30` (`odd_value_id_FK`),
  KEY `fk_bet_slip_odds_1` (`bet_slip_id_FK`),
  CONSTRAINT `fk_bet_slip_odds_1` FOREIGN KEY (`bet_slip_id_FK`) REFERENCES `bet_slip` (`bet_slip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Ref_30` FOREIGN KEY (`odd_value_id_FK`) REFERENCES `odd_value` (`odd_value_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`bet_types_id_FK`) REFER `nova_kladio';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet_slip_odds`
--

LOCK TABLES `bet_slip_odds` WRITE;
/*!40000 ALTER TABLE `bet_slip_odds` DISABLE KEYS */;
INSERT INTO `bet_slip_odds` VALUES (16,70,8),(17,73,8),(18,70,9),(19,73,9),(20,70,10),(21,79,11),(22,79,12);
/*!40000 ALTER TABLE `bet_slip_odds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(11,2) NOT NULL,
  `date_created` datetime NOT NULL,
  `transaction_type_id_FK` int(11) unsigned NOT NULL,
  `transaction_type_idendifier` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `Ref_31` (`user_id_FK`),
  KEY `fk_transaction_1` (`transaction_type_id_FK`),
  CONSTRAINT `fk_transaction_1` FOREIGN KEY (`transaction_type_id_FK`) REFERENCES `transaction_type` (`transaction_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`user_id_FK`) REFER `nova_kladionica/';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (72,1,'1400.00','2012-05-06 09:37:24',1,NULL),(77,1,'12.00','2012-05-06 14:42:23',3,8),(78,1,'10.00','2012-05-06 14:58:06',3,9),(79,1,'12.00','2012-05-06 14:59:22',3,10),(84,1,'26.76','2012-05-06 15:31:13',2,10),(85,1,'59.88','2012-05-06 15:31:19',2,8),(86,1,'49.90','2012-05-06 15:31:19',2,9),(88,1,'10.00','2012-05-06 15:35:20',3,11),(89,1,'-12.00','2012-05-06 15:50:18',3,12);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `teams_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_name` varchar(100) NOT NULL,
  `groups_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY (`teams_id`),
  UNIQUE KEY `unike` (`team_name`,`groups_id_FK`),
  KEY `teams_to_groups` (`groups_id_FK`),
  CONSTRAINT `teams_to_groups` FOREIGN KEY (`groups_id_FK`) REFERENCES `groups` (`groups_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`groups_id_FK`) REFER `nova_kladionic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (36,'Andy Murray',98),(11,'Arsenal',95),(23,'Aston Villa',95),(27,'Blackburn',95),(26,'Bolton',95),(29,'Boston Celtics',93),(14,'Chelsea',95),(38,'David Ferrer',98),(15,'Everton',95),(17,'Fulham',95),(37,'Jo-Wilfried Tsonga',98),(16,'Liverpool',95),(9,'Man City',95),(10,'Man Utd',95),(30,'New Jersey Nets',93),(31,'New York Knicks',93),(13,'Newcastle',95),(21,'Norwich',95),(33,'Novak Djokovic',98),(32,'Philadelphia 76ers',93),(25,'QPR',95),(34,'Rafael Nadal',98),(35,'Roger Federer',98),(22,'Stoke',95),(19,'Sunderland',95),(20,'Swansea',95),(12,'Tottenham',95),(18,'West Brom',95),(24,'Wigan',95),(28,'Wolves',95);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bet_slip`
--

DROP TABLE IF EXISTS `bet_slip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bet_slip` (
  `bet_slip_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `finished` int(10) unsigned NOT NULL DEFAULT '0',
  `played` int(10) unsigned NOT NULL,
  `user_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY (`bet_slip_id`),
  KEY `fk_bet_slip_1` (`user_id_FK`),
  CONSTRAINT `fk_bet_slip_1` FOREIGN KEY (`user_id_FK`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bet_slip`
--

LOCK TABLES `bet_slip` WRITE;
/*!40000 ALTER TABLE `bet_slip` DISABLE KEYS */;
INSERT INTO `bet_slip` VALUES (8,'2012-05-06 14:42:23',2,2,2,1),(9,'2012-05-06 14:58:06',2,2,2,1),(10,'2012-05-06 14:59:22',2,1,1,1),(11,'2012-05-06 15:35:20',0,0,1,1),(12,'2012-05-06 15:50:18',0,0,1,1);
/*!40000 ALTER TABLE `bet_slip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports` (
  `sports_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_of_sport` varchar(100) NOT NULL,
  `bookhouse_id_FK` int(11) unsigned NOT NULL,
  PRIMARY KEY (`sports_id`),
  UNIQUE KEY `name` (`name_of_sport`,`bookhouse_id_FK`),
  KEY `sports_to_bookhouse` (`bookhouse_id_FK`),
  CONSTRAINT `sports_to_bookhouse` FOREIGN KEY (`bookhouse_id_FK`) REFERENCES `bookhouse` (`bookhouse_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`bookhouse_id_FK`) REFER `nova_kladio';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (16,'Basket Ball',1),(15,'Football',1),(17,'Tennis',1);
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookhouse`
--

DROP TABLE IF EXISTS `bookhouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookhouse` (
  `bookhouse_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `house_name` varchar(100) NOT NULL,
  `default_money_value` decimal(11,2) NOT NULL DEFAULT '0.00',
  `can_user_register` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bookhouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='popis kladionica, u komercijalnoj verziji ograniciti na jeda';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookhouse`
--

LOCK TABLES `bookhouse` WRITE;
/*!40000 ALTER TABLE `bookhouse` DISABLE KEYS */;
INSERT INTO `bookhouse` VALUES (1,'Bookhouse','12.00',1,1);
/*!40000 ALTER TABLE `bookhouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odd_value`
--

DROP TABLE IF EXISTS `odd_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odd_value` (
  `odd_value_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `odd_value` decimal(4,2) NOT NULL,
  `bet_types_id_FK` int(11) unsigned NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `is_correct` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`odd_value_id`),
  KEY `Ref_21` (`bet_types_id_FK`),
  CONSTRAINT `Ref_21` FOREIGN KEY (`bet_types_id_FK`) REFERENCES `bets_type` (`bet_types_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`bet_types_id_FK`) REFER `nova_kladio';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odd_value`
--

LOCK TABLES `odd_value` WRITE;
/*!40000 ALTER TABLE `odd_value` DISABLE KEYS */;
INSERT INTO `odd_value` VALUES (70,'2.23',74,1,1),(71,'3.23',75,1,0),(72,'2.45',76,1,0),(73,'2.76',78,1,1),(74,'3.34',79,1,0),(75,'3.45',80,1,0),(76,'2.76',81,1,NULL),(77,'3.76',82,1,NULL),(78,'2.34',83,1,NULL),(79,'2.36',84,1,NULL),(80,'3.45',85,1,NULL),(81,'2.45',86,1,NULL),(82,'2.67',87,1,NULL),(83,'3.78',88,1,NULL),(84,'2.89',89,1,NULL),(85,'3.56',90,1,NULL),(86,'3.67',91,1,NULL),(87,'4.00',92,1,NULL),(88,'1.20',93,1,NULL),(89,'1.12',94,1,NULL),(90,'3.00',95,1,NULL),(91,'1.70',96,1,NULL),(92,'2.60',97,1,NULL);
/*!40000 ALTER TABLE `odd_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_bets`
--

DROP TABLE IF EXISTS `event_bets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_bets` (
  `event_bets_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bets_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  `event_types_id_FK` int(11) unsigned DEFAULT '0',
  `event_bets_name` varchar(250) NOT NULL,
  `score` varchar(100) DEFAULT NULL,
  `correct_type` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`event_bets_id`),
  UNIQUE KEY `new_index10` (`bets_id_FK`,`event_types_id_FK`),
  KEY `Ref_25` (`event_types_id_FK`),
  KEY `fk_event_bets_1` (`event_types_id_FK`),
  KEY `fk_event_bets_2` (`correct_type`),
  CONSTRAINT `fk_event_bets_1` FOREIGN KEY (`event_types_id_FK`) REFERENCES `event_types` (`event_types_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_bets_2` FOREIGN KEY (`correct_type`) REFERENCES `event_types_value` (`event_types_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Ref_24` FOREIGN KEY (`bets_id_FK`) REFERENCES `bets` (`bets_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`bets_id_FK`) REFER `nova_kladionica/';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_bets`
--

LOCK TABLES `event_bets` WRITE;
/*!40000 ALTER TABLE `event_bets` DISABLE KEYS */;
INSERT INTO `event_bets` VALUES (46,4,7,'Wolves - Blackburn','1:0',10),(48,5,7,'Bolton - QPR','1:0',10),(49,6,7,'Wigan - Aston Villa',NULL,NULL),(50,7,7,'Stoke - Norwich',NULL,NULL),(51,11,11,'Philadelphia 76ers - New York Knicks',NULL,NULL),(52,12,11,'New Jersey Nets - Boston Celtics',NULL,NULL),(53,12,12,'New Jersey Nets - Boston Celtics',NULL,NULL),(54,8,10,'David Ferrer - Jo-Wilfried Tsonga',NULL,NULL),(55,9,10,'Andy Murray - Roger Federer',NULL,NULL);
/*!40000 ALTER TABLE `event_bets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_money_overall`
--

DROP TABLE IF EXISTS `user_money_overall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_money_overall` (
  `user_id_FK` int(10) unsigned NOT NULL,
  `money` float(10,2) NOT NULL,
  KEY `fk_user_money_overall_1` (`user_id_FK`),
  CONSTRAINT `fk_user_money_overall_1` FOREIGN KEY (`user_id_FK`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_money_overall`
--

LOCK TABLES `user_money_overall` WRITE;
/*!40000 ALTER TABLE `user_money_overall` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_money_overall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams_has_bets`
--

DROP TABLE IF EXISTS `teams_has_bets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams_has_bets` (
  `teams_has_bets_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teams_id_FK` int(11) unsigned DEFAULT NULL,
  `bets_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`teams_has_bets_id`),
  UNIQUE KEY `unike` (`teams_id_FK`,`bets_id_FK`),
  KEY `Ref_23` (`bets_id_FK`),
  CONSTRAINT `Ref_22` FOREIGN KEY (`teams_id_FK`) REFERENCES `teams` (`teams_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Ref_23` FOREIGN KEY (`bets_id_FK`) REFERENCES `bets` (`bets_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`teams_id_FK`) REFER `nova_kladionica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams_has_bets`
--

LOCK TABLES `teams_has_bets` WRITE;
/*!40000 ALTER TABLE `teams_has_bets` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams_has_bets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_types`
--

DROP TABLE IF EXISTS `event_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_types` (
  `event_types_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_types_name` varchar(100) NOT NULL,
  `sports_id_FK` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_types_id`),
  UNIQUE KEY `index` (`event_types_name`,`sports_id_FK`),
  KEY `Ref_42` (`sports_id_FK`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`sports_id_FK`) REFER `nova_kladionic';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_types`
--

LOCK TABLES `event_types` WRITE;
/*!40000 ALTER TABLE `event_types` DISABLE KEYS */;
INSERT INTO `event_types` VALUES (7,'1x2',15),(12,'1x2',16),(8,'Goals',15),(11,'Over/Under',16),(10,'Winner',17);
/*!40000 ALTER TABLE `event_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-06 21:13:37
