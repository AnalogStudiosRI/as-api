CREATE DATABASE  IF NOT EXISTS `analogstudios_prod` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `analogstudios_prod`;
-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: analogstudios.cjcejb2mih8f.us-east-1.rds.amazonaws.com    Database: analogstudios_prod
-- ------------------------------------------------------
-- Server version	5.6.23-log

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `startTime` int(11) NOT NULL,
  `endTime` int(11) NOT NULL,
  `createdTime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Analog @ The Tankard','<p>Analog is playing at <a href=\"https://www.facebook.com/tankedatthetank\" target=\"\">The Tankard</a> this Saturday, with opening act Sean Daley. Â Please come join as we prevew some of the new songs on the album.</p>',1454810400,1454896799,1451789911),(7,'Dave Flamand @ Newport CYCFM','<p><img src=\"http://static.analogstudios.net.s3-website-us-west-2.amazonaws.com/hosted/images/events/dave-flamand-20160521.png\"/><br/></p>',1463873400,1463959799,1462923816);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `summary` longtext NOT NULL,
  `createdTime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Dave Flamand @ The Newport Newport CYCFM','<p>Details available at the <a href=\"http://www.analogstudios.net/#/events/7\" target=\"\">events page</a></p>',1462924501);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `analogstudios_prod`.`artists` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `imageUrl` LONGTEXT NULL COMMENT '',
  `genre` VARCHAR(45) NULL COMMENT '',
  `location` VARCHAR(45) NULL COMMENT '',
  `label` VARCHAR(45) NULL COMMENT '',
  `contactPhone` INT(10) NULL COMMENT '',
  `contactEmail` VARCHAR(100) NULL COMMENT '',
  `bio` LONGTEXT NOT NULL COMMENT '',
  `isActive` INT(1) NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '');

INSERT INTO `artists` (`id`, `name`, `imageUrl`, `genre`, `location`, `label`, `contactPhone`, `contactEmail`, `bio`, `isActive`) VALUES
(1, 'Analog', 'pictures/analog/analog.jpg', 'Rock and Roll', 'Block Island. RI', 'Analog Studios', null, 'dave@analogstudios.net', 'From the smallest town in the smallest state, Analog Studios presents Block Islands very own, Analog! Analog is a local Block Island, Rhode Island band.  Currently the lineup consists of singer\\/songwriter\\/guitarist Dave Flamand, and bassist Morgan Macia. Daves demo CD, \\"Lost Time\\" (available for free download at our music page) provided the framework by which he could start a band to help him bring his songs out to the public in the way that only a band can. We encourage you to go to our MySpace page and check out their debut E.P. \\"When the Media Talks About the Media.\\"', 1),
(2, 'Electro Calrissian', 'pictures/electro_calrissian/ec.jpg', 'Punk Rock', 'North Conway, NH', 'Analog Studios', null, 'electrocalrissian@gmail.com', 'A hard rock band from Conway, NH, Electro Calrissian knows how to crank out the tunes. Once a solid three piece, these days the lineup features songwriter Zack Smith on guitars, bass, and vocals and Nat MacDonald also playing guitar, bass, and singing.  Aside from their usual gigs, Zack can often be found playing down at Open Mic on Mondays at the Red Parka Pub or Matty Bs Pizza. Check out their MySpace page for more up to date info, music, and news, maintained by their good friend and manager, Aldon Miller.', 1),
(3, 'Rory Boyan', 'pictures/rory_boyan/rory.jpg', 'Jam/Instrumental', 'Lowell, MA', 'Analog Studios', null, 'roryboyan@yahoo.com', 'One of my best friends, Rory plays instrumental music in a genre all to his own. Combining elements of blues, reggae, and percussion into his guitar playing, Rory manages to create something unique to him, and him alone. If you like chilled out and inspiring music, then you found your man.', 1),
(4, 'Laurent Bonetto', 'pictures/laurent_bonetto/laurent.jpg', 'Classical', 'Providence. RI', 'Analog Studios', null, 'lbonetto-at-yahoo.com', 'While pursuing a scientific career, Laurent has always kept playing the piano as one of the main occupations of his life; a passion he has had since the age of 5.  Since the age of 15, he has practiced with concert pianist Nathalie Bera-Tagrine, with whom he studies when he returns to France.  Laurent has taken numerous masters classes in Europe and the US, participated in many concerts, and competitions, and has recorded two piano CD''s.', 1),
(5, 'The Silks', 'Silks Picture Here', 'Blues/Rock', 'Providence, RI', null, null, 'T.J.@email.com', 'The Silks are cool jazz rock band originating out of the Providence area.', 1),
(6, 'Dave Flamand', 'pictures/dave_flamand/dave.jpg', 'Acoustic/Rock', 'Block Island, RI', 'Analog Studios', null, 'dave@analogstudios.net', 'Dave Flamand is a talented singer-songwriter from the Block Island area.  Dave is well known on the island for his fun and energetic open mics, where he plays originals as well as covering great acts like Neil Young, the Beatles, Oasis, Blur, and Radiohead.  Dave is also the front man for the rock band Analog and records for both himself and his band.  Check him out live on Block Island or around Providence, RI.  You can keep up with his schedule by following our events page and following Analog Studios social networking sites.', 1),
(7, 'Audio Kickstand', 'pictures/audio_kickstand/audio_kickstand.jpg', 'Jam/Rock', 'Glen, NH', null, null, null, 'A great rock and jam band from Glen, NH, Audio Kickstand really knows how to get you out of your seat and dancing! This band is a prominent fixture down at the Red Parka Pub and you can almost always hear them playing Monday nights there for Open Mic. You can visit their myspace page for more news and info.', 1),
(8, 'Jay St', 'pictures/jay_st/jay_st.jpg', 'Rock and Roll', 'Fitchburg, MA', 'Analog Studios', null, null, 'Hailing from the basement of the coolest house on the craziest cobblestone hill,  in Fitchburg, MA, Jay St. was the party band of the Fitchburg scene during the years of 2003-2005.  While actively playing out at Hoolingans bar, they were also well known for throwing some of the best parties.  (Even during the winter!)  Even though they are no more, their infamy lives on thanks to their recordings being unearthed and posted for all to enjoy.  So, if the dude abides, then so do we.  Oh yeah, mind if I do a J?', 1);

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'astester','452SsQMwMP');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-02 21:47:24
