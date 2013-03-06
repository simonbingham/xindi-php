# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.25)
# Database: xindi-php
# Generation Time: 2013-03-06 14:01:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `metagenerated` tinyint(4) NOT NULL,
  `metatitle` varchar(69) NOT NULL,
  `metadescription` varchar(169) NOT NULL,
  `metakeywords` varchar(169) NOT NULL,
  `author` varchar(100) NOT NULL,
  `published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedby` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table enquiries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `enquiries`;

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `enquiries` WRITE;
/*!40000 ALTER TABLE `enquiries` DISABLE KEYS */;

INSERT INTO `enquiries` (`id`, `name`, `email`, `message`, `read`, `created`)
VALUES
	(2,'Simon Bingham','me@simonbingham.me.uk','a message',1,'2012-10-01 13:30:00'),
	(3,'Simon Bingham','me@simonbingham.me.uk','a message',1,'2012-10-01 00:00:00'),
	(4,'Simon Bingham','me@simonbingham.me.uk','a message',1,'2012-10-01 00:00:00'),
	(1,'Simon Bingham','me@simonbingham.me.uk','a message',1,'2012-10-01 00:00:00');

/*!40000 ALTER TABLE `enquiries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `leftvalue` int(11) NOT NULL,
  `rightvalue` int(11) NOT NULL,
  `ancestorid` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `metagenerated` tinyint(4) NOT NULL,
  `metatitle` varchar(69) NOT NULL,
  `metadescription` varchar(169) NOT NULL,
  `metakeywords` varchar(169) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedby` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `slug`, `leftvalue`, `rightvalue`, `ancestorid`, `depth`, `title`, `content`, `metagenerated`, `metatitle`, `metadescription`, `metakeywords`, `created`, `updated`, `updatedby`)
VALUES
	(1,'',1,20,0,0,'Home','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'Home','','','2013-02-01 14:54:44','2013-03-06 14:32:40',''),
	(2,'sample-page-a',2,9,1,1,'Sample Page A','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:30:13','2013-03-06 14:30:13',''),
	(3,'sample-page-b',10,17,1,1,'Sample Page B','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:30:30','2013-03-06 14:30:30',''),
	(4,'sample-page-c',18,19,1,1,'Sample Page C','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:30:43','2013-03-06 14:30:43',''),
	(5,'sample-page-a/sample-page-d',3,4,2,2,'Sample Page D','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:31:13','2013-03-06 14:31:16',''),
	(6,'sample-page-a/sample-page-e',5,6,2,2,'Sample Page E','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:31:31','2013-03-06 14:31:31',''),
	(8,'sample-page-a/sample-page-f',7,8,2,2,'Sample Page F','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:32:05','2013-03-06 14:32:07',''),
	(9,'sample-page-b/sample-page-g',11,12,3,2,'Sample Page G','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:37:10','2013-03-06 14:37:10',''),
	(10,'sample-page-b/sample-page-h',13,14,3,2,'Sample Page H','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:37:23','2013-03-06 14:37:23',''),
	(11,'sample-page-b/sample-page-i',15,16,3,2,'Sample Page I','<p>Cupcake ipsum dolor sit amet toffee sesame snaps oat cake. Halvah tart tootsie roll croissant sesame snaps. Chocolate ice cream candy pudding I love faworki oat cake I love candy canes. I love ice cream liquorice halvah toffee liquorice. Marzipan drag&eacute;e macaroon applicake caramels carrot cake gummi bears bear claw cake. Powder sugar plum pudding icing. Muffin macaroon gingerbread apple pie carrot cake jelly beans. Apple pie cheesecake applicake apple pie I love cheesecake drag&eacute;e cupcake I love. Jelly sesame snaps jujubes tart toffee marzipan apple pie I love. Icing chocolate cake gummies sweet roll faworki applicake jelly pastry fruitcake. Croissant marzipan I love applicake. Danish faworki donut croissant faworki tiramisu brownie oat cake.</p>\n<p>Ice cream carrot cake dessert. Macaroon chocolate bar jelly faworki jelly beans sweet. Bonbon jelly powder pie jelly faworki lollipop biscuit. Cookie marshmallow souffl&eacute; carrot cake. I love biscuit applicake wafer macaroon caramels macaroon gummi bears. Chupa chups chocolate I love tootsie roll liquorice jelly. I love gummies cookie toffee dessert. Croissant toffee caramels candy powder drag&eacute;e. Carrot cake chocolate cake tart cheesecake pastry apple pie candy canes. Jelly beans brownie souffl&eacute; I love muffin chocolate bar. Donut cheesecake liquorice tart bonbon sesame snaps topping cotton candy caramels. Gummies gingerbread wypas wafer oat cake I love. Bear claw topping candy gummi bears lemon drops tart tiramisu toffee.</p>\n<p>Cookie pudding pudding ice cream. Sugar plum bear claw biscuit faworki sugar plum marzipan. Caramels cake jujubes drag&eacute;e. Candy jelly-o lollipop pie lollipop wypas. Marzipan powder chocolate. Croissant powder liquorice cookie. Wypas lollipop sesame snaps candy bear claw. Biscuit tiramisu tiramisu sweet liquorice chocolate bar sugar plum I love donut. Candy canes lemon drops apple pie I love bear claw gingerbread jelly-o. Tart jelly tootsie roll. Sesame snaps powder I love pie. Faworki cupcake cupcake muffin oat cake.</p>',0,'','','','2013-03-06 14:37:36','2013-03-06 14:37:36','');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `created`, `updated`)
VALUES
	(30,'September Zimmerman','cytise@gmail.com','nikew','4a4d993ed7bd7d467b27af52d2aaa800','2012-12-13 13:43:35','2012-12-13 13:44:05'),
	(31,'Rhona Carrillo','xezaj@live.com','xorog','5324e078ff39acf1bfb709a1675c1a86','2012-12-13 13:48:56','2012-12-13 13:48:56'),
	(32,'Kylan Lloyd','birarisire@live.com','kyjuf','','2012-12-21 16:41:58','2012-12-21 16:55:39');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
