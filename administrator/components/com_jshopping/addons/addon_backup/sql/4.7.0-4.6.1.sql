DROP TABLE `#__jshopping_payment_trx`;

DROP TABLE `#__jshopping_payment_trx_data`;

ALTER TABLE `#__jshopping_config`
  DROP COLUMN shop_mode,
  CHANGE COLUMN id id TINYINT(1) NOT NULL;
  
ALTER TABLE `#__jshopping_payment_method`
  DROP COLUMN scriptname;