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