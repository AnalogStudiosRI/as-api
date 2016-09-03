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
(8, 'Jay St', 'http://d3cpag05e1ba19.cloudfront.net/hosted/images/artists/jay-st.jpg', 'Rock and Roll', 'Fitchburg, MA', 'Analog Studios', null, null, 'Hailing from the basement of the coolest house on the craziest cobblestone hill,  in Fitchburg, MA, Jay St. was the party band of the Fitchburg scene during the years of 2003-2005.  While actively playing out at Hoolingans bar, they were also well known for throwing some of the best parties.  (Even during the winter!)  Even though they are no more, their infamy lives on thanks to their recordings being unearthed and posted for all to enjoy.  So, if the dude abides, then so do we.  Oh yeah, mind if I do a J?', 1);

CREATE TABLE `analogstudios_prod`.`albums` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `description` LONGTEXT NOT NULL COMMENT '',
  `year` INT(4) NULL COMMENT '',
  `imageUrl` LONGTEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  CONSTRAINT `artistId`
    FOREIGN KEY (`id`)
    REFERENCES `analogstudios_prod`.`artists` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);