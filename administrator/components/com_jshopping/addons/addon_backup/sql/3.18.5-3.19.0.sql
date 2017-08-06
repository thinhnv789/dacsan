ALTER TABLE `#__jshopping_config` ADD `shop_mode` TINYINT(1) NOT NULL;
ALTER TABLE `#__jshopping_config` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;
ALTER TABLE  #__jshopping_payment_method ADD `scriptname` VARCHAR(100) NOT NULL;

CREATE TABLE IF NOT EXISTS `#__jshopping_payment_trx` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`order_id` INT NOT NULL,
`transaction` VARCHAR( 255 ) NOT NULL,
`rescode` INT NOT NULL,
`status_id` INT NOT NULL,
`date` datetime NOT NULL
) /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/;

CREATE TABLE IF NOT EXISTS `#__jshopping_payment_trx_data` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`trx_id` INT NOT NULL ,
`order_id` INT NOT NULL ,
`key` VARCHAR( 255 ) NOT NULL ,
`value` TEXT NOT NULL
) /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/;
