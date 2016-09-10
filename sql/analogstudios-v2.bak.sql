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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Analog @ The Tankard','<p>Analog is playing at <a href=\"https://www.facebook.com/tankedatthetank\" target=\"\">The Tankard</a> this Saturday, with opening act Sean Daley. Â Please come join as we prevew some of the new songs on the album.</p>',1454810400,1454896799,1451789911),(7,'Dave Flamand @ Newport CYCFM','<p><img src=\"http://d3cpag05e1ba19.cloudfront.net/hosted/images/events/dave-flamand/dave-flamand-20160521-ncyc.png\"/><br/></p>',1463873400,1463959799,1462923816),(8,'Dave Flamand @ Gather','<p><img src=\"http://d3cpag05e1ba19.cloudfront.net/hosted/images/events/dave-flamand/dave-flamand-20160827-gather.png\"/><br/></p>',1472342400,1472428799,1471909848),(9,'Septemberfest 2016','<p><img src=\"https://s3-us-west-2.amazonaws.com/static.analogstudios.net/hosted/images/events/septemberfest/septemberfest-2016-promo001.png\"/><br/></p>',1474664400,1474750799,1472088705),(10,'Septemberfest 2016','<p><img src=\"https://d3cpag05e1ba19.cloudfront.net/hosted/images/events/septemberfest/septemberfest-2016-promo001.png\"/><br/></p>',1474664400,1474750799,1472089750),(11,'Septemberfest 2016','<p><img src=\"https://d3cpag05e1ba19.cloudfront.net/hosted/images/events/septemberfest/septemberfest-2016-promo001.png\"/><br/></p>',1474750800,1474837199,1472089851),(12,'Dave Flamand @ Gather','<p><img src=\"http://d3cpag05e1ba19.cloudfront.net/hosted/images/events/dave-flamand/dave-flamand-20160906-gather.png\"/><br/></p>',1473206400,1473292799,1472603508);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Dave Flamand @ The Newport Newport CYCFM','<p>Details available at the <a href=\"http://www.analogstudios.net/#/events/7\" target=\"\">events page</a></p>',1462924501),(2,'Dave Flamand @ Gather','<p>Come join Dave Flamand at Gather in Newport, this Saturday (the 27th) at 8pm! Â For more info please see our events pageÂ <a href=\"http://www.analogstudios.net/#/events/8\" target=\"\">http://www.analogstudios.net/#/events/8</a></p>',1471959311),(3,'Silent No More Charity 5K','<p><img src=\"https://www.grouprev.com/system/Project/banners/000/007/776/banner/RegistrationBanner.jpg\"/><br/></p><p>Saturday Sept. 18th at 10am, Analog Studios will Â be leading a team in a 5K walk to help fight Ovarian cancer. Â Please join us or contribute and hope to see you down there!</p><p><a href=\"https://www.grouprev.com/meanjeansfightingmachine\" target=\"\">https://www.grouprev.com/meanjeansfightingmachine</a><br/></p>',1471989627),(4,'Septemberfest 2016!','<p>Septemberfest 2016 is almost here! Â Join us for two nights on Block Island for art, music, and films!</p><p><img src=\"https://d3cpag05e1ba19.cloudfront.net/hosted/images/events/septemberfest/septemberfest-2016-promo001.png\"/><br/></p>',1472091258);
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

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'astester','452SsQMwMP');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


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
(1, 'Analog', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/analog.jpg', 'Rock and Roll', 'Block Island. RI', 'Analog Studios', null, 'dave@analogstudios.net', 'From the smallest town in the smallest state, Analog Studios presents Block Islands very own, Analog! Analog is a local Block Island, Rhode Island band.  Currently the lineup consists of singer\\/songwriter\\/guitarist Dave Flamand, and bassist Morgan Macia. Daves demo CD, \\"Lost Time\\" (available for free download at our music page) provided the framework by which he could start a band to help him bring his songs out to the public in the way that only a band can. We encourage you to go to our MySpace page and check out their debut E.P. \\"When the Media Talks About the Media.\\"', 1),
(2, 'Electro Calrissian', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/electro-calrissian.jpg', 'Punk Rock', 'North Conway, NH', 'Analog Studios', null, 'electrocalrissian@gmail.com', 'A hard rock band from Conway, NH, Electro Calrissian knows how to crank out the tunes. Once a solid three piece, these days the lineup features songwriter Zack Smith on guitars, bass, and vocals and Nat MacDonald also playing guitar, bass, and singing.  Aside from their usual gigs, Zack can often be found playing down at Open Mic on Mondays at the Red Parka Pub or Matty Bs Pizza. Check out their MySpace page for more up to date info, music, and news, maintained by their good friend and manager, Aldon Miller.', 1),
(3, 'Rory Boyan', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/rory.jpg', 'Jam/Instrumental', 'Lowell, MA', 'Analog Studios', null, 'roryboyan@yahoo.com', 'One of my best friends, Rory plays instrumental music in a genre all to his own. Combining elements of blues, reggae, and percussion into his guitar playing, Rory manages to create something unique to him, and him alone. If you like chilled out and inspiring music, then you found your man.', 1),
(4, 'Laurent Bonetto', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/laurent-bonetto.jpg', 'Classical', 'Providence. RI', 'Analog Studios', null, 'lbonetto-at-yahoo.com', 'While pursuing a scientific career, Laurent has always kept playing the piano as one of the main occupations of his life; a passion he has had since the age of 5.  Since the age of 15, he has practiced with concert pianist Nathalie Bera-Tagrine, with whom he studies when he returns to France.  Laurent has taken numerous masters classes in Europe and the US, participated in many concerts, and competitions, and has recorded two piano CD''s.', 1),
(5, 'The Silks', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/the-silks.jpg', 'Blues/Rock', 'Providence, RI', null, null, 'T.J.@email.com', 'The Silks are cool jazz rock band originating out of the Providence area.', 1),
(6, 'Dave Flamand', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/dave-flamand.jpg', 'Acoustic/Rock', 'Block Island, RI', 'Analog Studios', null, 'dave@analogstudios.net', 'Dave Flamand is a talented singer-songwriter from the Block Island area.  Dave is well known on the island for his fun and energetic open mics, where he plays originals as well as covering great acts like Neil Young, the Beatles, Oasis, Blur, and Radiohead.  Dave is also the front man for the rock band Analog and records for both himself and his band.  Check him out live on Block Island or around Providence, RI.  You can keep up with his schedule by following our events page and following Analog Studios social networking sites.', 1),
(7, 'Audio Kickstand', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/audio-kickstand.jpg', 'Jam/Rock', 'Glen, NH', null, null, null, 'A great rock and jam band from Glen, NH, Audio Kickstand really knows how to get you out of your seat and dancing! This band is a prominent fixture down at the Red Parka Pub and you can almost always hear them playing Monday nights there for Open Mic. You can visit their myspace page for more news and info.', 1),
(8, 'Jay St', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/jay-st.jpg', 'Rock and Roll', 'Fitchburg, MA', 'Analog Studios', null, null, 'Hailing from the basement of the coolest house on the craziest cobblestone hill,  in Fitchburg, MA, Jay St. was the party band of the Fitchburg scene during the years of 2003-2005.  While actively playing out at Hoolingans bar, they were also well known for throwing some of the best parties.  (Even during the winter!)  Even though they are no more, their infamy lives on thanks to their recordings being unearthed and posted for all to enjoy.  So, if the dude abides, then so do we.  Oh yeah, mind if I do a J?', 1),
(9, 'Various Artists', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/various-artists.jpg', 'Rock and Roll', NULL, 'Analog Studios', NULL, NULL, 'This is a compilation profile for various recordings and musical compilations', 1);

CREATE TABLE `analogstudios_prod`.`albums` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `title` VARCHAR(100) NOT NULL COMMENT '',
  `description` LONGTEXT NOT NULL COMMENT '',
  `year` INT(4) NULL COMMENT '',
  `imageUrl` LONGTEXT NULL COMMENT '',
  `downloadUrl` LONGTEXT NULL COMMENT '',
  `artistId` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `id_idx` (`artistId` ASC)  COMMENT '',
  CONSTRAINT `id`
    FOREIGN KEY (`artistId`)
    REFERENCES `analogstudios_prod`.`artists` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


INSERT INTO `albums` (`id`, `title`, `description`, `year`, `imageUrl`, `downloadUrl`, `artistId`) VALUES
(1, 'Debut CD Release Party (live)', '<p>The songs were played live at the CD Release party for Analog&#39;s debut album, <em>When the Media Talk About The Media</em>&nbsp;at Captain Nick&#39;s on Block Island. These are songs from both the debut album and Dave Flamand&#39;s previous release, <em>Lost Time</em>.</p>', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/analog/analog-debut/analog-debut.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/analog/analog-debut/analog-debut.zip', 1),
(2, 'Lost Time', '<p>The lead singer of Analog, Dave Flamand is from Rhode Island and we are pleased to offer you exclusive downloads of his demo from this site. These songs provided the framework leading up to the creation of Analog, and as such you may recognize most of the songs from <em>When The Media Talks About The Media</em>&nbsp;from these demos. &nbsp;<em>Lost Time</em>&nbsp;was released early 2008 and <em>Spare Time</em>&nbsp;followed shortly thereafter. &nbsp;<em>Lost Time</em>&nbsp;is Dave&#39;s acoustic debut, showcasing his talent as songwriter and versatile musician. The are all of his own original recordings made on Block Island and recorded by himself. Dave not only wrote all the songs, but also played all the instruments himself.</p>', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/dave-flamand/lost-time/lost-time.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/dave-flamand/lost-time/lost-time.zip', 6),
(3, 'Spare Time', '<p>The seven songs that make up <em>Spare Time</em>&nbsp;are sort of like the companion to <em>Lost Time</em>&nbsp;A nice selection of acoustic <em>b-sides</em>, two of these songs make up the remaing tracks off the debut album by Analog, <em>When The Media Talks About The Media</em>.&nbsp;This is an exclusive download available from this website, you can&#39;t get these songs anywhere else.</p>', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/dave-flamand/spare-time/spare-time.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/dave-flamand/spare-time/spare-time.zip', 6),
(4, 'Garage Demo', 'These recordings were done over two sessions form 2008 to 2009 in the Smith''s garage up in New Hampshire.  They are all live takes from the Garage and feature the original lineup of Zack Smith, Nat MacDonald, and Matt Madison.  I recorded the sessions with different equipment so the quality may vary at times.', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/electro-calrissian/garage-demo/garage-demo.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/electro-calrissian/garage-demo/garage-demo.zip', 2),
(5, 'RPM Recordings', '<p>This recording was done in my apartment up in New Hampshire over a two day period. Rory and I intended this for the 2009 RPM Challenge but in the end is just became a cool, live, impromptu reocrding of Rory at his creative and spontaneous self. I apologize for the lack of title, for the next one I&#39;ll make sure Rory titles his songs, heh. Anyway, we recorded all these songs live, maybe with a couple of takes, and cut the results. Hope you enjoy them.</p>', 2009, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/rory-boyan/rpm-recording-challenge/rpm-recording-challenge.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/rory-boyan/rpm-recording-challenge/rpm-recording-challenge.zip', 3),
(6, 'Music Mansion Series vol2', 'This recording came from a charity performance Laurent performed in March of 2010.  The performance consisted of 10 classical selections and was accompanied with a brief discussion of each group of pieces as the evening went on.  (although they are not included here).  It was a very nice evening that I was fortunate to be a part of.', 2010, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol2/music-mansion-series-vol2.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol2/music-mansion-series-vol2.zip', 4),
(7, 'BI Music Fest : Porch Gigs', 'This is a compilation album of all the various artists who performed on the porch of Captain Nick''s on June 11th, 2010 as part of Block Island Music Fest.  The recorded artists were Colby Lasorsa, Glenn Roth, Troubaduo, and Analog.  Hope ya dig.', 2010, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/various-artists/block-island-musicfest-2010/block-island-musicfest-2010.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/various-artists/block-island-musicfest-2010/block-island-musicfest-2010.zip', 9),
(8, 'Brian Lessard Benefit', 'A night dedicated to Brian Lessard, Audio Kickstand brought out the good vibes to help a great member of the community during a time of need.  One of my first recordings, this was done using all the original gear I hadl pre-digital.  Not too shabby if I do say so myself.  Enjoy some of Audio Kickstands originals, one of the first bands I ever recorded back when I was starting out.', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/audio-kickstand/brian-lessard-benefit/brian-lessard-benefit.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/audio-kickstand/brian-lessard-benefit/brian-lessard-benefit.zip', 7),
(9, 'Easy', 'Recorded in the spring of 2005, this basement demo captures a great performance from Jay St.; raw and loose.  With Dave starting to show great command over his song writing chops, he is backed up by his roommates Owen and Neal for a five song demo of things to come.', 2005, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/easy/easy.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/easy/easy.zip', 8),
(10, 'Live - From The Basement (set 1)', 'Check out a group of live recordings of Jay St. and Friends jamming in the basement playing some of the crowd favorites.  If you ever came by the house, maybe you''ll hear your name in the background.  (sorry about the beginning of In My Place, but Neals drumming more than makes up for it)', 2005, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/from-the-basement-live-pt1/from-the-basement-live-pt1.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/from-the-basement-live-pt1/from-the-basement-live-pt1.zip', 8),
(11, 'Live - From The Basement (set 2)', 'Check out a group of live recordings of Jay St. and Friends jamming in the basement playing some of the crowd favorites.  If you ever came by the house, maybe you''ll hear your name in the background.', 2005, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/from-the-basement-live-pt2/from-the-basement-live-pt2.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/jay-st/from-the-basement-live-pt2/from-the-basement-live-pt2.zip', 8),
(12, 'Music Mansion Series vol3', 'In June of 2013, Laurant Bonetto performed his final show at the Music Mansion.  The performance consisted of a number of classical selections from the works of Chopin and was accompanied with a brief discussion of each group of pieces as the show went on.', 2013, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol3/music-mansion-series-vol3.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol3/music-mansion-series-vol3.zip', 4),
(13, 'Music Mansion Series vol1', 'The first in a great series of compelling concerts to come from the partnership of Laurent Bonetto and the Alliance Francaise, we are proud to present Vol. 1 in the Laurent Bonetto Music Mansion Series - Concert "Suite Francaise" -- Scaramouche and Company.  Tracks 4 - 9 are 4-hand pieces performed by Laurent Bonetto and Jacqueline Devillers.', 2008, 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol1/music-mansion-series-vol1.jpg', 'http://d3cpag05e1ba19.cloudfront.net/hosted/albums/laurent-bonetto/music-mansion-series-vol1/music-mansion-series-vol1.zip', 4);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-09 20:28:22
