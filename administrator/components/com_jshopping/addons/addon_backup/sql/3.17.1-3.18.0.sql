CREATE TABLE IF NOT EXISTS `#__jshopping_products_option` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`product_id` int(11) NOT NULL,
`key` varchar(64) NOT NULL,
`value` text NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `prodkey` (`product_id`,`key`)
) /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/;

alter table #__jshopping_config_statictext add column `use_for_return_policy` int NOT NULL;
alter table `#__jshopping_addons` CHANGE `params` `params` LONGTEXT NOT NULL;