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
  `page_name` varchar(64) NOT NULL,
  `page_slug` varchar(64) NOT NULL,
  `page_content` mediumtext NOT NULL,
  `page_status` enum('draft','published','deleted') NOT NULL,
  `page_left` mediumint(8) unsigned NOT NULL,
  `page_right` mediumint(8) unsigned NOT NULL,
  `page_date_created` datetime NOT NULL,
  `page_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'Test','/','<h1>\n	Welcome to Anubis</h1>\n<p>\n	Anubis is a modern, high-quality, professional risk management company with a mix of executive directors who possess diverse but complementary backgrounds. The depth of experience, current operational and training expertise is unrivalled in any one company in the private security industry</p>\n','published',1,2,'2012-01-05 17:11:04','2012-01-09 17:23:28'),(2,1,'About Us','/about','<h1>\n	About Us</h1>\n<p>\n	<strong>Aliquam lectus orci, adipiscing et, sodalesac feugiat non, lacus. Ut dictum velit nec est. Quisque posuere, purus sit amet malesuada blandit, sapien sapien auctor arcu, sed pulvinar felis mi sollicitudin tortor. Maecenas volutpat, nisl et dignissim pharetra, urna lectus ultrices est, vel pretium pede turpis id velit. Aliquam sagittis magna in.</strong></p>\n<p>\n	Quisque facilisis erat a dui. Nam malesuada ornare dolor. Cras gravida, diam sit amet rhoncus ornare, erat elit consectetuer erat, id egestas pede nibh eget odio. Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non aliquet massa pede eu diam. Aliquam iaculis. Fusce et ipsum et nulla tristique facilisis. Donec eget sem sit amet ligula viverra gravida. Etiam vehicula urna vel turpis. Suspendisse sagittis ante a urna. Morbi a est quis orci consequat rutrum. Nullam egestas feugiat felis. Integer adipiscing semper ligula. Nunc molestie, nisl sit amet cursus convallis, sapien lectus pretium metus, vitae pretium enim wisi id lectus. Donec vestibulum. Etiam vel nibh. Nulla facilisi. Mauris lorem pharetra. Donec augue. Fusce ultrices, neque id dignissim ultrices, tellus mauris dictum.</p>\n','published',3,14,'2012-01-10 10:44:48','2012-01-13 16:59:50'),(3,1,'About is my parent','/tester','<p>\n	whatever.</p>\n','published',4,9,'2012-01-11 13:34:27',NULL),(4,1,'going even deeper','/deep-dude','<p>\n	deeeeeep</p>\n','published',5,6,'2012-01-12 11:16:16',NULL),(5,1,'another deep one','/deep1','<p>\n	agassaf</p>\n','published',7,8,'2012-01-12 11:16:27',NULL),(6,1,'More About Us (About Us is parent)','/more-about-us','<p>\n	more.</p>\n','published',10,11,'2012-01-12 11:43:56','2012-01-12 16:31:11'),(7,1,'Another Root!','/rooty','asfnoasofias','published',15,16,'0000-00-00 00:00:00',NULL),(8,1,'Even MORE about us.','/asfkohsahfoias','afsafsasfafsafs','published',12,13,'2012-01-12 12:26:05','2012-01-12 12:26:05'),(9,1,'Testing!!!!!','/afs','<p>\n	afasafs</p>\n','published',17,18,'2012-01-13 16:05:08',NULL);
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
INSERT INTO `user` VALUES (1,'technical@creativeinsight.co.uk','53e89fc7f6132101d6c5068bb0e7073fca2968a80e5f04d79e35dea2f003e936',NULL,'Creative','Insight',NULL,NULL,1,1,'2011-10-25 17:21:09','2012-01-13 17:33:23');
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

-- Dump completed on 2012-01-13 17:34:10
