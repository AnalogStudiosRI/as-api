CREATE TABLE `analogstudios_prod`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `title` VARCHAR(100) NOT NULL COMMENT '',
  `summary` LONGTEXT NOT NULL COMMENT '',
  `createdTime` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '');