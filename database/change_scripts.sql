-- 02/01/2019
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;


-- 02/01/2019
ALTER TABLE `groups` ADD `create_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `name`;

-- 03/01/2019
DROP TABLE groups;

-- 04/01/2019
ALTER TABLE `user` ADD `deleted_at` DATETIME NULL DEFAULT NULL AFTER `img`;

-- 10/01/2019
ALTER TABLE `user` ADD `role` INT NOT NULL DEFAULT '0' AFTER `img`;

-- 16/01/2019
ALTER TABLE `user` ADD `key_pass` VARCHAR(255) NOT NULL AFTER `password`;

--19/2/2019
CREATE TABLE `codeigniter`.`product` ( `id_product` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `publishing` INT NOT NULL , `publisher` VARCHAR(255) NOT NULL , `price` FLOAT NOT NULL , `description` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_product`)) ENGINE = MyISAM;

CREATE TABLE `codeigniter`.`category` ( `id_category` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_category`)) ENGINE = MyISAM;

CREATE TABLE `codeigniter`.`author` ( `id_author` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `information` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_author`)) ENGINE = MyISAM;

ALTER TABLE `product` ADD `id_category` INT NOT NULL AFTER `description`;

ALTER TABLE `product` ADD `id_author` INT NOT NULL AFTER `id_category`;

ALTER TABLE `author` CHANGE `information` `information` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `product` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `product` ADD `image` VARCHAR(255) NOT NULL AFTER `id_author`;