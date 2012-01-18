-- MySQL dump 10.13  Distrib 5.5.19, for Linux (i686)
--
-- Host: localhost    Database: anubis
-- ------------------------------------------------------
-- Server version	5.5.19

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
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'Users'),(2,'Authorised Users'),(3,'Moderator (Training & Ops)'),(4,'Moderator (Special Products)'),(5,'Administrator');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `image_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `image_parent_id` mediumint(8) unsigned DEFAULT NULL,
  `image_name` varchar(128) NOT NULL,
  `image_path` varchar(128) NOT NULL,
  `image_alt` varchar(128) DEFAULT NULL,
  `image_width` smallint(5) unsigned NOT NULL,
  `image_height` smallint(5) unsigned NOT NULL,
  `image_size` double(8,2) DEFAULT NULL,
  `image_position` smallint(5) unsigned NOT NULL,
  `image_type` enum('ORIGINAL','THUMBNAIL') NOT NULL DEFAULT 'ORIGINAL',
  `image_date_created` datetime NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `image_variant_id` (`image_position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `menu_key` varchar(32) NOT NULL,
  `menu_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_key` (`menu_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'header','Header'),(2,'footer','Footer');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_author_id` smallint(5) unsigned NOT NULL,
  `news_title` varchar(256) NOT NULL,
  `news_slug` varchar(256) DEFAULT NULL,
  `news_data_excerpt` text,
  `news_data_full` text NOT NULL,
  `news_date_created` datetime NOT NULL,
  `news_date_updated` datetime DEFAULT NULL,
  `news_date_published` datetime NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `news_author_id` (`news_author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,'Xar is the news article','xar-is-the-news-article','Anubis have been approved as a City & Guilds Centre…','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus quam ut magna pretium a sodales nisi convallis. Ut vel felis in massa porta molestie. Praesent eu magna aliquam lacus pharetra dignissim. Aliquam dictum vehicula neque, a elementum libero blandit ac. Sed dolor tortor, aliquam quis blandit nec, elementum sit amet lorem. Donec placerat, odio et molestie placerat, dolor tellus imperdiet nibh, a congue tellus tortor quis ante. Mauris tempor quam nec nisl pharetra eget bibendum lacus aliquam. Nulla eu libero eu libero cursus elementum. Fusce condimentum bibendum neque, eget lacinia sapien fermentum vitae. Nunc porttitor venenatis purus a blandit.</p>\r\n\r\n<p>Sed sed lectus est, eu venenatis lorem. Nulla non tempor ante. Sed porta, nibh rhoncus pulvinar gravida, metus lectus ornare ligula, id facilisis tellus magna luctus risus. Nunc posuere erat ac quam rhoncus volutpat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc metus purus, placerat ut interdum eu, sollicitudin at ante. Mauris at sapien vitae urna fermentum malesuada nec varius leo. Sed mollis viverra volutpat. Integer consequat tellus lobortis risus pellentesque posuere. Nullam at nisl tellus, et suscipit arcu. Donec vitae lobortis ipsum. Cras in tortor ac dui hendrerit posuere. Morbi gravida lectus eget diam ullamcorper condimentum tincidunt quam congue. Nulla facilisi.</p>','2012-01-10 12:50:59','2012-01-10 17:32:38','2012-01-10 12:50:59'),(2,1,'Example News','example-news',NULL,'<p>\r\n	Making your way in the world today takes everything you’ve got. Taking a break from all your worries, sure would help a lot. Wouldn’t you like to get away? Sometimes you want to go Where everybody knows your name, and they’re always glad you came. You wanna be where you can see, our troubles are all the same You wanna be where everybody knows Your name. You wanna go where people know, people are all the same, You wanna go where everybody knows your name.</p>\r\n','2012-01-11 09:36:04','2012-01-13 15:46:13','2012-01-11 09:36:04');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `page_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `page_author_id` mediumint(8) unsigned NOT NULL,
  `page_name` varchar(128) NOT NULL,
  `page_slug` varchar(128) NOT NULL,
  `page_content` text,
  `page_status` enum('draft','published','deleted') NOT NULL,
  `page_left` mediumint(8) unsigned NOT NULL,
  `page_right` mediumint(8) unsigned NOT NULL,
  `page_date_created` datetime NOT NULL,
  `page_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `page_slug` (`page_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'Home','/','<h1>\n	Welcome to Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry.</p>\n','published',1,2,'2012-01-18 14:10:31',NULL),(2,1,'About Us','/about-us','<h1>\n	About Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry. Anubis personnel work internationally as consultants providing a wide range of security services in many unusual and challenging climates. In addition to our established executive customers, Anubis clients include UK and International Government&rsquo;s armed forces and security services.</p>\n<p>\n	With an experienced team of consultants who are all world experts in their respective fields, Anubis offers training and risk management advice and operational assistance to international corporate, governmental and non-governmental clients.</p>\n<p>\n	Anubis leads the way in the provision of discreet personal protection and security consultancy for business clients. Our knowledge and operational expertise in this area is unrivalled at providing bespoke services to customers in the UK and around the world.</p>\n','published',3,4,'2012-01-18 14:28:40',NULL);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_image`
--

DROP TABLE IF EXISTS `page_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_image` (
  `link_page_id` mediumint(8) unsigned NOT NULL,
  `link_image_id` mediumint(8) unsigned NOT NULL,
  `link_position` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `link_page_id` (`link_page_id`,`link_image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_image`
--

LOCK TABLES `page_image` WRITE;
/*!40000 ALTER TABLE `page_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_meta`
--

DROP TABLE IF EXISTS `page_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_meta` (
  `meta_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `meta_post_id` mediumint(8) unsigned NOT NULL,
  `meta_key` varchar(64) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`meta_id`),
  UNIQUE KEY `meta_post_id` (`meta_post_id`,`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_meta`
--

LOCK TABLES `page_meta` WRITE;
/*!40000 ALTER TABLE `page_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_test`
--

DROP TABLE IF EXISTS `page_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_test` (
  `page_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `page_author_id` mediumint(8) unsigned NOT NULL,
  `page_name` varchar(128) NOT NULL,
  `page_slug` varchar(128) NOT NULL,
  `page_content` text,
  `page_status` enum('draft','published','deleted') NOT NULL,
  `page_left` mediumint(8) unsigned NOT NULL,
  `page_right` mediumint(8) unsigned NOT NULL,
  `page_date_created` datetime NOT NULL,
  `page_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `page_slug` (`page_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_test`
--

LOCK TABLES `page_test` WRITE;
/*!40000 ALTER TABLE `page_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `permission_key` varchar(32) NOT NULL,
  `permission_module` varchar(16) DEFAULT NULL,
  `permission_description` text,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_key` (`permission_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'PAGE_VIEW','page','Can view standard pages.'),(2,'PAGE_VIEW_PROTECTED','page','Can view protected pages.');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `setting_key` varchar(32) NOT NULL,
  `setting_module` varchar(16) DEFAULT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_key`),
  KEY `setting_module` (`setting_module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES ('seo_block_robots',NULL,'1');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `user_password` char(64) NOT NULL,
  `user_title` enum('Mr','Ms','Mrs','Dr') DEFAULT NULL,
  `user_firstname` varchar(32) NOT NULL,
  `user_lastname` varchar(32) NOT NULL,
  `user_company` varchar(80) DEFAULT NULL,
  `user_telephone` varchar(12) DEFAULT NULL,
  `user_marketing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_administrator` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_date_created` datetime NOT NULL,
  `user_date_lastseen` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'technical@creativeinsight.co.uk','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936',NULL,'Creative','Insight',NULL,NULL,1,1,'2011-10-25 17:21:09','2012-01-18 17:28:28');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `link_user_id` mediumint(8) unsigned NOT NULL,
  `link_group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`link_user_id`,`link_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-18 17:28:59
