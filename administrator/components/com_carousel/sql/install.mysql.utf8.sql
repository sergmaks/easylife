DROP TABLE IF EXISTS `#__carousel`;

CREATE TABLE IF NOT EXISTS `#__carousel` (
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `ordering` INT(11) NOT NULL , 
    `published` TINYINT(4) NOT NULL , 
    `caption` VARCHAR(1024) NOT NULL , 
    `image` VARCHAR(1024) NOT NULL , 
    `icon` VARCHAR(25) NOT NULL , 
    `date` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;