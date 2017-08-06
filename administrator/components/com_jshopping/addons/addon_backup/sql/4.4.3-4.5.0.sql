alter table #__jshopping_users add column `street_nr` VARCHAR( 16 ) NOT NULL;
alter table #__jshopping_users add column `d_street_nr` VARCHAR( 16 ) NOT NULL;
alter table #__jshopping_orders add column `street_nr` VARCHAR( 16 ) NOT NULL;
alter table #__jshopping_orders add column `d_street_nr` VARCHAR( 16 ) NOT NULL;