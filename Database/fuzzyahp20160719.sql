CREATE DATABASE  IF NOT EXISTS `fuzzyahp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fuzzyahp`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fuzzyahp
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

--/**********************************************************************************************************
-- *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
-- *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
-- *  																									  *
-- *   ELIGERE is free software: you can redistribute it and/or modify									  *
-- *   it under the terms of the GNU General Public License as 											  *
-- *   published by the Free Software Foundation, either version 3 of the 								  *
-- *   License, or (at your option) any later version.													  *
-- *																									  *
-- *   This program is distributed in the hope that it will be useful,									  *
-- *   but WITHOUT ANY WARRANTY; without even the implied warranty of								      *
-- *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
-- *   GNU General Public License for more details.														  *
-- *																										  *
-- *   You should have received a copy of the GNU General Public License									  *
-- *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
-- * 																										  *
-- *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
-- *********************************************************************************************************/



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
-- Table structure for table `alternative`
--

DROP TABLE IF EXISTS `alternative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date_insert` date NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `user_id` char(30) NOT NULL,
  `dir_path` char(50) NOT NULL,
  `dir_path_file` char(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_name_quest` (`name`,`questionnaire_id`),
  KEY `questionnaire_id_2` (`questionnaire_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `alternative_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternative`
--

LOCK TABLES `alternative` WRITE;
/*!40000 ALTER TABLE `alternative` DISABLE KEYS */;
INSERT INTO `alternative` VALUES (43,'Alternative1','Alternative1 Desc','2015-10-29',144,'','media/test/Alternative1','media/test/Alternative1/Prototipo1_render_.jpg'),(44,'Alternative2','Alternative 2 Desc','2015-10-29',144,'','media/test/Alternative2','media/test/Alternative2/Prototipo2_render_.jpg'),(45,'Alternative 3','Alternative 3 Desc ','2015-10-29',144,'','media/test/Alternative 3','media/test/Alternative 3/Prototipo3_render_.jpg'),(46,'Alternative4','Alternative 4 Desc','2015-10-29',144,'','media/test/Alternative4','media/test/Alternative4/Prototipo4_render_.jpg'),(47,'Alternative5','Alternative 5 Desc','2015-10-29',144,'','media/test/Alternative5','media/test/Alternative5/Prototipo5_render_.jpg'),(48,'Alternative6','Alternative 6 Desc ','2015-10-29',144,'','media/test/Alternative6','media/test/Alternative6/Prototipo6_render_.jpg'),(51,'Concept 1','differential','2015-12-09',156,'','media/Sirena_AM/Concept 1','media/Sirena_AM/Concept 1/renderingdiff.JPG'),(52,'Concept 2','articulated','2015-12-09',156,'','media/Sirena_AM/Concept 2','media/Sirena_AM/Concept 2/render01.JPG');
/*!40000 ALTER TABLE `alternative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date_insert` date NOT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_name_quest` (`quest_id`,`name`),
  CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criteria`
--

LOCK TABLES `criteria` WRITE;
/*!40000 ALTER TABLE `criteria` DISABLE KEYS */;
INSERT INTO `criteria` VALUES (23,'C1','Simplicity','2015-10-29',144),(24,'C2','Aesthetic design','2015-10-29',144),(25,'C3','Integrability with sensors and electronics','2015-10-29',144),(26,'Mechanism simplicity','simplicity of the mechanism','2015-12-09',156),(27,'Reliability','reliability of the mechanism','2015-12-09',156),(28,'Maintainability','maintainability of the mechanism','2015-12-09',156);
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criteria_alternative`
--

DROP TABLE IF EXISTS `criteria_alternative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria_alternative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alt1` int(11) NOT NULL,
  `alt2` int(11) NOT NULL,
  `cri_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `linguistic_id` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `unique_index` (`alt1`,`alt2`,`questionnaire_id`,`user_id`,`cri_id`) USING BTREE,
  KEY `questionnaire_id` (`questionnaire_id`),
  KEY `user_id` (`user_id`),
  KEY `alt2` (`alt2`),
  KEY `alt1` (`alt1`),
  KEY `cri_id` (`cri_id`),
  KEY `linguistic_id` (`linguistic_id`),
  CONSTRAINT `criteria_alternative_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`),
  CONSTRAINT `criteria_alternative_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `criteria_alternative_ibfk_4` FOREIGN KEY (`linguistic_id`) REFERENCES `linguistic_scale` (`id`),
  CONSTRAINT `criteria_alternative_ibfk_5` FOREIGN KEY (`cri_id`) REFERENCES `criteria` (`id`),
  CONSTRAINT `criteria_alternative_ibfk_6` FOREIGN KEY (`alt1`) REFERENCES `alternative` (`id`),
  CONSTRAINT `criteria_alternative_ibfk_7` FOREIGN KEY (`alt2`) REFERENCES `alternative` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=610 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criteria_alternative`
--

LOCK TABLES `criteria_alternative` WRITE;
/*!40000 ALTER TABLE `criteria_alternative` DISABLE KEYS */;
INSERT INTO `criteria_alternative` VALUES (289,43,44,23,144,81,'2015-12-01 16:52:57',4),(290,43,44,24,144,81,'2015-12-01 16:52:57',7),(291,43,44,25,144,81,'2015-12-01 16:52:57',4),(292,43,45,23,144,81,'2015-12-01 16:52:57',3),(293,43,45,24,144,81,'2015-12-01 16:52:57',4),(294,43,45,25,144,81,'2015-12-01 16:52:57',3),(295,43,46,23,144,81,'2015-12-01 16:52:57',3),(296,43,46,24,144,81,'2015-12-01 16:52:57',6),(297,43,46,25,144,81,'2015-12-01 16:52:57',4),(298,43,47,23,144,81,'2015-12-01 16:52:57',4),(299,43,47,24,144,81,'2015-12-01 16:52:57',3),(300,43,47,25,144,81,'2015-12-01 16:52:57',2),(301,43,48,23,144,81,'2015-12-01 16:52:57',6),(302,43,48,24,144,81,'2015-12-01 16:52:57',4),(303,43,48,25,144,81,'2015-12-01 16:52:57',2),(304,44,45,23,144,81,'2015-12-01 16:52:57',3),(305,44,45,24,144,81,'2015-12-01 16:52:57',3),(306,44,45,25,144,81,'2015-12-01 16:52:57',4),(307,44,46,23,144,81,'2015-12-01 16:52:58',7),(308,44,46,24,144,81,'2015-12-01 16:52:58',4),(309,44,46,25,144,81,'2015-12-01 16:52:58',6),(310,44,47,23,144,81,'2015-12-01 16:52:58',4),(311,44,47,24,144,81,'2015-12-01 16:52:58',3),(312,44,47,25,144,81,'2015-12-01 16:52:58',4),(313,44,48,23,144,81,'2015-12-01 16:52:58',4),(314,44,48,24,144,81,'2015-12-01 16:52:58',4),(315,44,48,25,144,81,'2015-12-01 16:52:58',3),(316,45,46,23,144,81,'2015-12-01 16:52:58',7),(317,45,46,24,144,81,'2015-12-01 16:52:58',6),(318,45,46,25,144,81,'2015-12-01 16:52:58',4),(319,45,47,23,144,81,'2015-12-01 16:52:58',6),(320,45,47,24,144,81,'2015-12-01 16:52:58',6),(321,45,47,25,144,81,'2015-12-01 16:52:58',3),(322,45,48,23,144,81,'2015-12-01 16:52:58',7),(323,45,48,24,144,81,'2015-12-01 16:52:58',7),(324,45,48,25,144,81,'2015-12-01 16:52:58',3),(325,46,47,23,144,81,'2015-12-01 16:52:58',6),(326,46,47,24,144,81,'2015-12-01 16:52:58',3),(327,46,47,25,144,81,'2015-12-01 16:52:58',4),(328,46,48,23,144,81,'2015-12-01 16:52:58',5),(329,46,48,24,144,81,'2015-12-01 16:52:58',4),(330,46,48,25,144,81,'2015-12-01 16:52:58',3),(331,47,48,23,144,81,'2015-12-01 16:52:58',4),(332,47,48,24,144,81,'2015-12-01 16:52:58',6),(333,47,48,25,144,81,'2015-12-01 16:52:58',4),(334,43,44,23,144,82,'2015-12-01 16:58:03',4),(335,43,44,24,144,82,'2015-12-01 16:58:03',6),(336,43,44,25,144,82,'2015-12-01 16:58:03',4),(337,43,45,23,144,82,'2015-12-01 16:58:03',3),(338,43,45,24,144,82,'2015-12-01 16:58:03',3),(339,43,45,25,144,82,'2015-12-01 16:58:03',3),(340,43,46,23,144,82,'2015-12-01 16:58:03',2),(341,43,46,24,144,82,'2015-12-01 16:58:03',4),(342,43,46,25,144,82,'2015-12-01 16:58:03',4),(343,43,47,23,144,82,'2015-12-01 16:58:03',3),(344,43,47,24,144,82,'2015-12-01 16:58:03',2),(345,43,47,25,144,82,'2015-12-01 16:58:03',4),(346,43,48,23,144,82,'2015-12-01 16:58:03',2),(347,43,48,24,144,82,'2015-12-01 16:58:03',3),(348,43,48,25,144,82,'2015-12-01 16:58:03',3),(349,44,45,23,144,82,'2015-12-01 16:58:04',4),(350,44,45,24,144,82,'2015-12-01 16:58:04',3),(351,44,45,25,144,82,'2015-12-01 16:58:04',5),(352,44,46,23,144,82,'2015-12-01 16:58:04',4),(353,44,46,24,144,82,'2015-12-01 16:58:04',4),(354,44,46,25,144,82,'2015-12-01 16:58:04',6),(355,44,47,23,144,82,'2015-12-01 16:58:04',3),(356,44,47,24,144,82,'2015-12-01 16:58:04',2),(357,44,47,25,144,82,'2015-12-01 16:58:04',6),(358,44,48,23,144,82,'2015-12-01 16:58:04',2),(359,44,48,24,144,82,'2015-12-01 16:58:04',3),(360,44,48,25,144,82,'2015-12-01 16:58:04',4),(361,45,46,23,144,82,'2015-12-01 16:58:04',6),(362,45,46,24,144,82,'2015-12-01 16:58:04',6),(363,45,46,25,144,82,'2015-12-01 16:58:04',6),(364,45,47,23,144,82,'2015-12-01 16:58:04',6),(365,45,47,24,144,82,'2015-12-01 16:58:04',3),(366,45,47,25,144,82,'2015-12-01 16:58:04',6),(367,45,48,23,144,82,'2015-12-01 16:58:04',7),(368,45,48,24,144,82,'2015-12-01 16:58:04',2),(369,45,48,25,144,82,'2015-12-01 16:58:04',5),(370,46,47,23,144,82,'2015-12-01 16:58:04',5),(371,46,47,24,144,82,'2015-12-01 16:58:04',3),(372,46,47,25,144,82,'2015-12-01 16:58:04',5),(373,46,48,23,144,82,'2015-12-01 16:58:04',3),(374,46,48,24,144,82,'2015-12-01 16:58:04',4),(375,46,48,25,144,82,'2015-12-01 16:58:04',3),(376,47,48,23,144,82,'2015-12-01 16:58:04',7),(377,47,48,24,144,82,'2015-12-01 16:58:04',6),(378,47,48,25,144,82,'2015-12-01 16:58:04',4),(379,43,44,23,144,83,'2015-12-01 17:03:18',7),(380,43,44,24,144,83,'2015-12-01 17:03:18',7),(381,43,44,25,144,83,'2015-12-01 17:03:18',6),(382,43,45,23,144,83,'2015-12-01 17:03:18',3),(383,43,45,24,144,83,'2015-12-01 17:03:18',3),(384,43,45,25,144,83,'2015-12-01 17:03:18',3),(385,43,46,23,144,83,'2015-12-01 17:03:18',3),(386,43,46,24,144,83,'2015-12-01 17:03:18',3),(387,43,46,25,144,83,'2015-12-01 17:03:18',3),(388,43,47,23,144,83,'2015-12-01 17:03:18',2),(389,43,47,24,144,83,'2015-12-01 17:03:18',2),(390,43,47,25,144,83,'2015-12-01 17:03:18',3),(391,43,48,23,144,83,'2015-12-01 17:03:18',2),(392,43,48,24,144,83,'2015-12-01 17:03:18',2),(393,43,48,25,144,83,'2015-12-01 17:03:18',3),(394,44,45,23,144,83,'2015-12-01 17:03:18',3),(395,44,45,24,144,83,'2015-12-01 17:03:18',3),(396,44,45,25,144,83,'2015-12-01 17:03:18',3),(397,44,46,23,144,83,'2015-12-01 17:03:18',3),(398,44,46,24,144,83,'2015-12-01 17:03:18',3),(399,44,46,25,144,83,'2015-12-01 17:03:18',3),(400,44,47,23,144,83,'2015-12-01 17:03:18',2),(401,44,47,24,144,83,'2015-12-01 17:03:18',2),(402,44,47,25,144,83,'2015-12-01 17:03:18',2),(403,44,48,23,144,83,'2015-12-01 17:03:18',2),(404,44,48,24,144,83,'2015-12-01 17:03:18',2),(405,44,48,25,144,83,'2015-12-01 17:03:18',2),(406,45,46,23,144,83,'2015-12-01 17:03:18',7),(407,45,46,24,144,83,'2015-12-01 17:03:18',7),(408,45,46,25,144,83,'2015-12-01 17:03:18',4),(409,45,47,23,144,83,'2015-12-01 17:03:18',4),(410,45,47,24,144,83,'2015-12-01 17:03:18',4),(411,45,47,25,144,83,'2015-12-01 17:03:18',4),(412,45,48,23,144,83,'2015-12-01 17:03:18',4),(413,45,48,24,144,83,'2015-12-01 17:03:18',4),(414,45,48,25,144,83,'2015-12-01 17:03:18',4),(415,46,47,23,144,83,'2015-12-01 17:03:18',3),(416,46,47,24,144,83,'2015-12-01 17:03:18',3),(417,46,47,25,144,83,'2015-12-01 17:03:18',3),(418,46,48,23,144,83,'2015-12-01 17:03:18',3),(419,46,48,24,144,83,'2015-12-01 17:03:18',3),(420,46,48,25,144,83,'2015-12-01 17:03:18',3),(421,47,48,23,144,83,'2015-12-01 17:03:18',6),(422,47,48,24,144,83,'2015-12-01 17:03:18',6),(423,47,48,25,144,83,'2015-12-01 17:03:18',6),(424,43,44,23,144,84,'2015-12-01 18:03:01',3),(425,43,44,24,144,84,'2015-12-01 18:03:01',6),(426,43,44,25,144,84,'2015-12-01 18:03:01',7),(427,43,45,23,144,84,'2015-12-01 18:03:01',2),(428,43,45,24,144,84,'2015-12-01 18:03:01',3),(429,43,45,25,144,84,'2015-12-01 18:03:01',6),(430,43,46,23,144,84,'2015-12-01 18:03:01',4),(431,43,46,24,144,84,'2015-12-01 18:03:01',6),(432,43,46,25,144,84,'2015-12-01 18:03:01',6),(433,43,47,23,144,84,'2015-12-01 18:03:01',3),(434,43,47,24,144,84,'2015-12-01 18:03:01',3),(435,43,47,25,144,84,'2015-12-01 18:03:01',8),(436,43,48,23,144,84,'2015-12-01 18:03:01',3),(437,43,48,24,144,84,'2015-12-01 18:03:01',3),(438,43,48,25,144,84,'2015-12-01 18:03:01',8),(439,44,45,23,144,84,'2015-12-01 18:03:01',2),(440,44,45,24,144,84,'2015-12-01 18:03:01',3),(441,44,45,25,144,84,'2015-12-01 18:03:01',6),(442,44,46,23,144,84,'2015-12-01 18:03:01',3),(443,44,46,24,144,84,'2015-12-01 18:03:01',6),(444,44,46,25,144,84,'2015-12-01 18:03:01',6),(445,44,47,23,144,84,'2015-12-01 18:03:01',3),(446,44,47,24,144,84,'2015-12-01 18:03:01',3),(447,44,47,25,144,84,'2015-12-01 18:03:01',7),(448,44,48,23,144,84,'2015-12-01 18:03:02',3),(449,44,48,24,144,84,'2015-12-01 18:03:02',3),(450,44,48,25,144,84,'2015-12-01 18:03:02',7),(451,45,46,23,144,84,'2015-12-01 18:03:02',7),(452,45,46,24,144,84,'2015-12-01 18:03:02',7),(453,45,46,25,144,84,'2015-12-01 18:03:02',6),(454,45,47,23,144,84,'2015-12-01 18:03:02',6),(455,45,47,24,144,84,'2015-12-01 18:03:02',6),(456,45,47,25,144,84,'2015-12-01 18:03:02',7),(457,45,48,23,144,84,'2015-12-01 18:03:02',5),(458,45,48,24,144,84,'2015-12-01 18:03:02',6),(459,45,48,25,144,84,'2015-12-01 18:03:02',7),(460,46,47,23,144,84,'2015-12-01 18:03:02',3),(461,46,47,24,144,84,'2015-12-01 18:03:02',3),(462,46,47,25,144,84,'2015-12-01 18:03:02',6),(463,46,48,23,144,84,'2015-12-01 18:03:02',5),(464,46,48,24,144,84,'2015-12-01 18:03:02',3),(465,46,48,25,144,84,'2015-12-01 18:03:02',6),(466,47,48,23,144,84,'2015-12-01 18:03:02',5),(467,47,48,24,144,84,'2015-12-01 18:03:02',6),(468,47,48,25,144,84,'2015-12-01 18:03:02',5),(469,43,44,23,144,85,'2015-12-01 18:06:04',3),(470,43,44,24,144,85,'2015-12-01 18:06:04',6),(471,43,44,25,144,85,'2015-12-01 18:06:04',5),(472,43,45,23,144,85,'2015-12-01 18:06:04',3),(473,43,45,24,144,85,'2015-12-01 18:06:04',6),(474,43,45,25,144,85,'2015-12-01 18:06:04',5),(475,43,46,23,144,85,'2015-12-01 18:06:04',2),(476,43,46,24,144,85,'2015-12-01 18:06:04',6),(477,43,46,25,144,85,'2015-12-01 18:06:04',5),(478,43,47,23,144,85,'2015-12-01 18:06:04',4),(479,43,47,24,144,85,'2015-12-01 18:06:04',5),(480,43,47,25,144,85,'2015-12-01 18:06:04',4),(481,43,48,23,144,85,'2015-12-01 18:06:04',3),(482,43,48,24,144,85,'2015-12-01 18:06:04',6),(483,43,48,25,144,85,'2015-12-01 18:06:04',4),(484,44,45,23,144,85,'2015-12-01 18:06:04',4),(485,44,45,24,144,85,'2015-12-01 18:06:04',6),(486,44,45,25,144,85,'2015-12-01 18:06:04',5),(487,44,46,23,144,85,'2015-12-01 18:06:04',3),(488,44,46,24,144,85,'2015-12-01 18:06:04',6),(489,44,46,25,144,85,'2015-12-01 18:06:04',5),(490,44,47,23,144,85,'2015-12-01 18:06:04',5),(491,44,47,24,144,85,'2015-12-01 18:06:04',4),(492,44,47,25,144,85,'2015-12-01 18:06:04',4),(493,44,48,23,144,85,'2015-12-01 18:06:04',3),(494,44,48,24,144,85,'2015-12-01 18:06:04',4),(495,44,48,25,144,85,'2015-12-01 18:06:04',4),(496,45,46,23,144,85,'2015-12-01 18:06:04',3),(497,45,46,24,144,85,'2015-12-01 18:06:04',6),(498,45,46,25,144,85,'2015-12-01 18:06:04',5),(499,45,47,23,144,85,'2015-12-01 18:06:04',6),(500,45,47,24,144,85,'2015-12-01 18:06:04',4),(501,45,47,25,144,85,'2015-12-01 18:06:04',4),(502,45,48,23,144,85,'2015-12-01 18:06:04',6),(503,45,48,24,144,85,'2015-12-01 18:06:04',4),(504,45,48,25,144,85,'2015-12-01 18:06:04',4),(505,46,47,23,144,85,'2015-12-01 18:06:05',7),(506,46,47,24,144,85,'2015-12-01 18:06:05',3),(507,46,47,25,144,85,'2015-12-01 18:06:05',4),(508,46,48,23,144,85,'2015-12-01 18:06:05',5),(509,46,48,24,144,85,'2015-12-01 18:06:05',4),(510,46,48,25,144,85,'2015-12-01 18:06:05',4),(511,47,48,23,144,85,'2015-12-01 18:06:05',3),(512,47,48,24,144,85,'2015-12-01 18:06:05',6),(513,47,48,25,144,85,'2015-12-01 18:06:05',5),(514,43,44,23,144,86,'2015-12-01 18:09:12',4),(515,43,44,24,144,86,'2015-12-01 18:09:12',7),(516,43,44,25,144,86,'2015-12-01 18:09:12',4),(517,43,45,23,144,86,'2015-12-01 18:09:12',3),(518,43,45,24,144,86,'2015-12-01 18:09:12',6),(519,43,45,25,144,86,'2015-12-01 18:09:12',4),(520,43,46,23,144,86,'2015-12-01 18:09:12',5),(521,43,46,24,144,86,'2015-12-01 18:09:12',7),(522,43,46,25,144,86,'2015-12-01 18:09:12',5),(523,43,47,23,144,86,'2015-12-01 18:09:12',5),(524,43,47,24,144,86,'2015-12-01 18:09:12',6),(525,43,47,25,144,86,'2015-12-01 18:09:12',4),(526,43,48,23,144,86,'2015-12-01 18:09:12',3),(527,43,48,24,144,86,'2015-12-01 18:09:12',7),(528,43,48,25,144,86,'2015-12-01 18:09:12',3),(529,44,45,23,144,86,'2015-12-01 18:09:13',3),(530,44,45,24,144,86,'2015-12-01 18:09:13',3),(531,44,45,25,144,86,'2015-12-01 18:09:13',4),(532,44,46,23,144,86,'2015-12-01 18:09:13',6),(533,44,46,24,144,86,'2015-12-01 18:09:13',6),(534,44,46,25,144,86,'2015-12-01 18:09:13',6),(535,44,47,23,144,86,'2015-12-01 18:09:13',6),(536,44,47,24,144,86,'2015-12-01 18:09:13',4),(537,44,47,25,144,86,'2015-12-01 18:09:13',6),(538,44,48,23,144,86,'2015-12-01 18:09:13',4),(539,44,48,24,144,86,'2015-12-01 18:09:13',5),(540,44,48,25,144,86,'2015-12-01 18:09:13',4),(541,45,46,23,144,86,'2015-12-01 18:09:13',6),(542,45,46,24,144,86,'2015-12-01 18:09:13',7),(543,45,46,25,144,86,'2015-12-01 18:09:13',7),(544,45,47,23,144,86,'2015-12-01 18:09:13',6),(545,45,47,24,144,86,'2015-12-01 18:09:13',6),(546,45,47,25,144,86,'2015-12-01 18:09:13',6),(547,45,48,23,144,86,'2015-12-01 18:09:13',5),(548,45,48,24,144,86,'2015-12-01 18:09:13',7),(549,45,48,25,144,86,'2015-12-01 18:09:13',4),(550,46,47,23,144,86,'2015-12-01 18:09:13',5),(551,46,47,24,144,86,'2015-12-01 18:09:13',3),(552,46,47,25,144,86,'2015-12-01 18:09:13',3),(553,46,48,23,144,86,'2015-12-01 18:09:13',3),(554,46,48,24,144,86,'2015-12-01 18:09:13',4),(555,46,48,25,144,86,'2015-12-01 18:09:13',3),(556,47,48,23,144,86,'2015-12-01 18:09:13',4),(557,47,48,24,144,86,'2015-12-01 18:09:13',7),(558,47,48,25,144,86,'2015-12-01 18:09:13',4),(559,43,44,23,144,87,'2015-12-01 18:12:45',3),(560,43,44,24,144,87,'2015-12-01 18:12:45',6),(561,43,44,25,144,87,'2015-12-01 18:12:45',7),(562,43,45,23,144,87,'2015-12-01 18:12:45',3),(563,43,45,24,144,87,'2015-12-01 18:12:45',6),(564,43,45,25,144,87,'2015-12-01 18:12:45',4),(565,43,46,23,144,87,'2015-12-01 18:12:45',3),(566,43,46,24,144,87,'2015-12-01 18:12:45',7),(567,43,46,25,144,87,'2015-12-01 18:12:45',7),(568,43,47,23,144,87,'2015-12-01 18:12:45',4),(569,43,47,24,144,87,'2015-12-01 18:12:45',4),(570,43,47,25,144,87,'2015-12-01 18:12:45',6),(571,43,48,23,144,87,'2015-12-01 18:12:45',3),(572,43,48,24,144,87,'2015-12-01 18:12:45',4),(573,43,48,25,144,87,'2015-12-01 18:12:45',7),(574,44,45,23,144,87,'2015-12-01 18:12:45',5),(575,44,45,24,144,87,'2015-12-01 18:12:45',5),(576,44,45,25,144,87,'2015-12-01 18:12:45',3),(577,44,46,23,144,87,'2015-12-01 18:12:45',5),(578,44,46,24,144,87,'2015-12-01 18:12:45',7),(579,44,46,25,144,87,'2015-12-01 18:12:45',4),(580,44,47,23,144,87,'2015-12-01 18:12:45',6),(581,44,47,24,144,87,'2015-12-01 18:12:45',4),(582,44,47,25,144,87,'2015-12-01 18:12:45',5),(583,44,48,23,144,87,'2015-12-01 18:12:45',4),(584,44,48,24,144,87,'2015-12-01 18:12:45',3),(585,44,48,25,144,87,'2015-12-01 18:12:45',6),(586,45,46,23,144,87,'2015-12-01 18:12:45',5),(587,45,46,24,144,87,'2015-12-01 18:12:45',7),(588,45,46,25,144,87,'2015-12-01 18:12:45',5),(589,45,47,23,144,87,'2015-12-01 18:12:46',6),(590,45,47,24,144,87,'2015-12-01 18:12:46',5),(591,45,47,25,144,87,'2015-12-01 18:12:46',4),(592,45,48,23,144,87,'2015-12-01 18:12:46',4),(593,45,48,24,144,87,'2015-12-01 18:12:46',4),(594,45,48,25,144,87,'2015-12-01 18:12:46',7),(595,46,47,23,144,87,'2015-12-01 18:12:46',6),(596,46,47,24,144,87,'2015-12-01 18:12:46',3),(597,46,47,25,144,87,'2015-12-01 18:12:46',5),(598,46,48,23,144,87,'2015-12-01 18:12:46',5),(599,46,48,24,144,87,'2015-12-01 18:12:46',2),(600,46,48,25,144,87,'2015-12-01 18:12:46',6),(601,47,48,23,144,87,'2015-12-01 18:12:46',4),(602,47,48,24,144,87,'2015-12-01 18:12:46',4),(603,47,48,25,144,87,'2015-12-01 18:12:46',7),(604,51,52,26,156,93,'2015-12-09 11:02:23',6),(605,51,52,27,156,93,'2015-12-09 11:02:23',3),(606,51,52,28,156,93,'2015-12-09 11:02:23',4),(607,51,52,26,156,97,'2015-12-09 11:40:21',6),(608,51,52,27,156,97,'2015-12-09 11:40:21',3),(609,51,52,28,156,97,'2015-12-09 11:40:21',4);
/*!40000 ALTER TABLE `criteria_alternative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_score`
--

DROP TABLE IF EXISTS `final_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `alternative` varchar(1000) NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quest_id` (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_score`
--

LOCK TABLES `final_score` WRITE;
/*!40000 ALTER TABLE `final_score` DISABLE KEYS */;
INSERT INTO `final_score` VALUES (77,144,'2016-07-19 13:46:18','43',0.251012802),(78,144,'2016-07-19 13:46:18','44',0.232264757),(79,144,'2016-07-19 13:46:18','45',0.115430325),(80,144,'2016-07-19 13:46:18','46',0.188354835),(81,144,'2016-07-19 13:46:18','47',0.118121475),(82,144,'2016-07-19 13:46:18','48',0.0948157459);
/*!40000 ALTER TABLE `final_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linguistic_scale`
--

DROP TABLE IF EXISTS `linguistic_scale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linguistic_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` char(50) NOT NULL,
  `simbol` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linguistic_scale`
--

LOCK TABLES `linguistic_scale` WRITE;
/*!40000 ALTER TABLE `linguistic_scale` DISABLE KEYS */;
INSERT INTO `linguistic_scale` VALUES (2,'Absolutely more important','+++'),(3,'More important','++'),(4,'Weakly more important','+'),(5,'Equally important','='),(6,'Weakly less important','-'),(7,'Less important','--'),(8,'Absolutely less important','---');
/*!40000 ALTER TABLE `linguistic_scale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_linguistic_scale`
--

DROP TABLE IF EXISTS `question_linguistic_scale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_linguistic_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ling_scale_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_un_ql` (`questions_id`,`user`),
  KEY `questions_id` (`questions_id`),
  KEY `user` (`user`),
  KEY `ling_scale_id` (`ling_scale_id`),
  KEY `quest_id` (`quest_id`),
  CONSTRAINT `question_linguistic_scale_ibfk_1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `question_linguistic_scale_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  CONSTRAINT `question_linguistic_scale_ibfk_3` FOREIGN KEY (`ling_scale_id`) REFERENCES `linguistic_scale` (`id`),
  CONSTRAINT `question_linguistic_scale_ibfk_4` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_linguistic_scale`
--

LOCK TABLES `question_linguistic_scale` WRITE;
/*!40000 ALTER TABLE `question_linguistic_scale` DISABLE KEYS */;
INSERT INTO `question_linguistic_scale` VALUES (76,44,81,6,144),(77,45,81,5,144),(78,46,81,4,144),(79,44,82,4,144),(80,45,82,6,144),(81,46,82,7,144),(82,44,83,4,144),(83,45,83,6,144),(84,46,83,7,144),(85,44,84,3,144),(86,45,84,5,144),(87,46,84,6,144),(88,44,85,4,144),(89,45,85,4,144),(90,46,85,6,144),(91,44,86,4,144),(92,45,86,6,144),(93,46,86,6,144),(94,44,87,4,144),(95,45,87,6,144),(96,46,87,6,144),(97,47,93,5,156),(98,48,93,4,156),(99,49,93,4,156),(100,47,94,4,156),(101,48,94,4,156),(102,49,94,4,156),(109,47,97,5,156),(110,48,97,3,156),(111,49,97,3,156),(112,44,98,2,144),(113,45,98,3,144),(114,46,98,4,144),(118,44,101,2,144),(119,45,101,2,144),(120,46,101,2,144);
/*!40000 ALTER TABLE `question_linguistic_scale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `complete` bit(1) NOT NULL,
  `dir` char(20) NOT NULL,
  `password` char(30) NOT NULL,
  `elaborated` bit(1) NOT NULL,
  `elaboration_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaire`
--

LOCK TABLES `questionnaire` WRITE;
/*!40000 ALTER TABLE `questionnaire` DISABLE KEYS */;
INSERT INTO `questionnaire` VALUES (144,'test','test','2015-10-29 13:32:24','\0','media/test','test','','2016-07-19 13:46:18'),(145,'Sirena','alternatives','2015-11-30 11:54:05','\0','media/Sirena','Sirena','\0','0000-00-00 00:00:00'),(146,'Sirena AJP','Robotics for AM: Selecting alternatives','2015-12-09 10:23:52','\0','media/Sirena AJP','sirenaS','\0','0000-00-00 00:00:00'),(151,'Sirena_AJP','Selecting alternatives in robotics for AM','2015-12-09 10:45:30','\0','media/Sirena_AJP','Sirena_AJP','\0','0000-00-00 00:00:00'),(156,'Sirena_AM','Selecting alternatives in robotics for AJP','2015-12-09 10:50:45','\0','media/Sirena_AM','Sirena_AM','\0','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `questionnaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnarie_user`
--

DROP TABLE IF EXISTS `questionnarie_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionnarie_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `complete` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `quest_id` (`quest_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `questionnarie_user_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`),
  CONSTRAINT `questionnarie_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnarie_user`
--

LOCK TABLES `questionnarie_user` WRITE;
/*!40000 ALTER TABLE `questionnarie_user` DISABLE KEYS */;
INSERT INTO `questionnarie_user` VALUES (66,144,81,'2015-12-01',1),(67,144,82,'2015-12-01',1),(68,144,83,'2015-12-01',1),(69,144,84,'2015-12-01',1),(70,144,85,'2015-12-01',1),(71,144,86,'2015-12-01',1),(72,144,87,'2015-12-01',1),(73,146,89,'2015-12-09',0),(74,156,90,'2015-12-09',0),(77,156,93,'2015-12-09',1),(78,156,94,'2015-12-09',0),(81,156,97,'2015-12-09',1),(82,144,98,'2016-01-30',0),(85,144,101,'2016-03-23',0),(86,144,102,'2016-07-19',0);
/*!40000 ALTER TABLE `questionnarie_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `date` datetime NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire` int(11) NOT NULL,
  `cr1` int(11) NOT NULL,
  `cr2` int(11) NOT NULL,
  `description` char(150) NOT NULL,
  `description_long` char(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_con` (`cr1`,`cr2`,`questionnaire`),
  KEY `questionnaire` (`questionnaire`),
  KEY `cr1` (`cr1`),
  KEY `cr2` (`cr2`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES ('2015-10-29 13:39:45',44,144,23,24,'QP1','How important is the simplicity of the system when it is compared to aesthetic design?'),('2015-10-29 13:39:45',45,144,23,25,'QP2','How important is the simplicity of the system when it is compared to integrability with\r\nsensors and electronics?'),('2015-10-29 13:39:45',46,144,24,25,'QP3','How important is the aesthetic design of the system when it is compared to integrability\r\nwith sensors and electronics?'),('2015-12-09 10:59:56',47,156,26,27,'QS1','Simplicity against Reliability'),('2015-12-09 10:59:56',48,156,26,28,'QS2','Simplicity against Maintainability'),('2015-12-09 10:59:56',49,156,27,28,'QS3','Reliability against Maintainability');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results_preferences`
--

DROP TABLE IF EXISTS `results_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results_preferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `criteria` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `quest_id` int(11) NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quest_id_2` (`quest_id`,`criteria`),
  KEY `criteria` (`criteria`),
  KEY `quest_id` (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results_preferences`
--

LOCK TABLES `results_preferences` WRITE;
/*!40000 ALTER TABLE `results_preferences` DISABLE KEYS */;
INSERT INTO `results_preferences` VALUES (262,0,'2016-07-19 13:46:16',144,0.37191999),(263,1,'2016-07-19 13:46:16',144,0.237380385),(264,2,'2016-07-19 13:46:16',144,0.390699595);
/*!40000 ALTER TABLE `results_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results_suitability`
--

DROP TABLE IF EXISTS `results_suitability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results_suitability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `criteria` int(11) NOT NULL,
  `alternative` varchar(1000) NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quest_id` (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=607 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results_suitability`
--

LOCK TABLES `results_suitability` WRITE;
/*!40000 ALTER TABLE `results_suitability` DISABLE KEYS */;
INSERT INTO `results_suitability` VALUES (589,144,'2016-07-19 13:46:18',0,'0',0.324120134),(590,144,'2016-07-19 13:46:18',0,'1',0.25180003),(591,144,'2016-07-19 13:46:18',0,'2',0.0693411008),(592,144,'2016-07-19 13:46:18',0,'3',0.151545733),(593,144,'2016-07-19 13:46:18',0,'4',0.134602696),(594,144,'2016-07-19 13:46:18',0,'5',0.0685902238),(595,144,'2016-07-19 13:46:18',1,'0',0.199935094),(596,144,'2016-07-19 13:46:18',1,'1',0.263872504),(597,144,'2016-07-19 13:46:18',1,'2',0.122180521),(598,144,'2016-07-19 13:46:18',1,'3',0.24672851),(599,144,'2016-07-19 13:46:18',1,'4',0.0644504204),(600,144,'2016-07-19 13:46:18',1,'5',0.102832928),(601,144,'2016-07-19 13:46:18',2,'0',0.212453172),(602,144,'2016-07-19 13:46:18',2,'1',0.194464371),(603,144,'2016-07-19 13:46:18',2,'2',0.15520294),(604,144,'2016-07-19 13:46:18',2,'3',0.187928125),(605,144,'2016-07-19 13:46:18',2,'4',0.135041788),(606,144,'2016-07-19 13:46:18',2,'5',0.114909634);
/*!40000 ALTER TABLE `results_suitability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` char(30) NOT NULL,
  `role` char(20) NOT NULL,
  `insert_date` datetime NOT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `quest_id` (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (81,'Test1',' ','stanislaograzioso@gmail.com','','2015-12-01 15:13:30',0),(82,'Test2',' ','stanislao.grazioso@unina.it','','2015-12-01 16:54:45',0),(83,'Test3',' ','alessiobalsamo@hotmail.it','','2015-12-01 16:59:07',0),(84,'Test4',' ','man.dimaio@gmail.com','','2015-12-01 18:00:25',0),(85,'Test5',' ','man.dimaio@studenti.unina.it','','2015-12-01 18:03:38',0),(86,'Test6',' ','cdimaio1953@gmail.com','','2015-12-01 18:06:50',0),(87,'Test7',' ','crisd.didato@gmail.com','','2015-12-01 18:09:50',0),(88,'Giuseppe',' ','giuseppe.digironimo@unina.it','','2015-12-02 13:22:57',0),(89,'sta',' ','sg_90@hotmail.it','','2015-12-09 10:28:59',0),(90,'stani',' ','s@gmail.com','','2015-12-09 10:57:09',0),(93,'stanigrazios',' ','sg@gmail.com','','2015-12-09 11:01:16',0),(94,'fff',' ','ff@gmail.com','','2015-12-09 11:18:07',0),(97,'Manuele_tesi',' ','m@gmail.com','','2015-12-09 11:37:14',0),(98,'wwe',' ','pinco@pinwdo.it','','2016-01-30 13:55:53',0),(101,'jjjj',' ','pinco@pinwdoj.it','','2016-03-23 10:17:38',0),(102,'testf',' ','testg@frf.it','','2016-07-19 14:57:37',0);
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

-- Dump completed on 2016-07-19 15:31:11
