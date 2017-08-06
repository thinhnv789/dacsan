ALTER TABLE `#__jshopping_users` ADD `lang` VARCHAR(5) NOT NULL;
ALTER TABLE `#__jshopping_usergroups` ADD `name_en-GB` varchar(255) NOT NULL;
ALTER TABLE `#__jshopping_usergroups` ADD `name_de-DE` varchar(255) NOT NULL;
ALTER TABLE `#__jshopping_orders` ADD `shipping_params` text NOT NULL;
ALTER TABLE `#__jshopping_orders` ADD `shipping_params_data` text NOT NULL;
ALTER TABLE `#__jshopping_orders` ADD `product_stock_removed` tinyint(1) NOT NULL;
ALTER TABLE `#__jshopping_attr` ADD `group` tinyint(4) NOT NULL;
ALTER TABLE `#__jshopping_attr` ADD INDEX(`group`);
ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`group`);

CREATE TABLE IF NOT EXISTS `#__jshopping_attr_groups`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`ordering` int(6) NOT NULL,
PRIMARY KEY (`id`)
) /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/;

ALTER TABLE `#__jshopping_addons` ADD INDEX(`alias`);
ALTER TABLE `#__jshopping_addons` ADD INDEX(`name`);

ALTER TABLE `#__jshopping_attr` ADD INDEX(`attr_ordering`);
ALTER TABLE `#__jshopping_attr` ADD INDEX(`attr_type`);
ALTER TABLE `#__jshopping_attr` ADD INDEX(`independent`);
ALTER TABLE `#__jshopping_attr` ADD INDEX(`allcats`);

ALTER TABLE `#__jshopping_attr_values` ADD INDEX(`attr_id`);
ALTER TABLE `#__jshopping_attr_values` ADD INDEX(`value_ordering`);

ALTER TABLE `#__jshopping_cart_temp` ADD INDEX(`id_cookie`);
ALTER TABLE `#__jshopping_cart_temp` ADD INDEX(`type_cart`);

ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_parent_id`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_publish`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_ordertype`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_template`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`ordering`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_add_date`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`products_page`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`products_row`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`access`);
ALTER TABLE `#__jshopping_categories` ADD INDEX(`category_publish`, `access`);

ALTER TABLE `#__jshopping_config_display_prices` ADD INDEX(`display_price`);
ALTER TABLE `#__jshopping_config_display_prices` ADD INDEX(`display_price_firma`);

ALTER TABLE `#__jshopping_config_seo` ADD INDEX(`alias`);
ALTER TABLE `#__jshopping_config_seo` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_config_statictext` ADD INDEX(`alias`);
ALTER TABLE `#__jshopping_config_statictext` ADD INDEX(`use_for_return_policy`);

ALTER TABLE `#__jshopping_countries` ADD INDEX(`country_publish`);
ALTER TABLE `#__jshopping_countries` ADD INDEX(`ordering`);
ALTER TABLE `#__jshopping_countries` ADD INDEX(`country_code`);
ALTER TABLE `#__jshopping_countries` ADD INDEX(`country_code_2`);

ALTER TABLE `#__jshopping_coupons` ADD INDEX(`coupon_type`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`coupon_code`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`tax_id`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`used`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`for_user_id`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`coupon_publish`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`coupon_start_date`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`coupon_expire_date`);
ALTER TABLE `#__jshopping_coupons` ADD INDEX(`finished_after_used`);

ALTER TABLE `#__jshopping_currencies` ADD INDEX(`currency_code_iso`);
ALTER TABLE `#__jshopping_currencies` ADD INDEX(`currency_code_num`);
ALTER TABLE `#__jshopping_currencies` ADD INDEX(`currency_ordering`);
ALTER TABLE `#__jshopping_currencies` ADD INDEX(`currency_publish`);

ALTER TABLE `#__jshopping_languages` ADD INDEX(`publish`);
ALTER TABLE `#__jshopping_languages` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_manufacturers` ADD INDEX(`manufacturer_publish`);
ALTER TABLE `#__jshopping_manufacturers` ADD INDEX(`products_page`);
ALTER TABLE `#__jshopping_manufacturers` ADD INDEX(`products_row`);
ALTER TABLE `#__jshopping_manufacturers` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_order_history` ADD INDEX(`order_id`);
ALTER TABLE `#__jshopping_order_history` ADD INDEX(`order_status_id`);
ALTER TABLE `#__jshopping_order_history` ADD INDEX(`status_date_added`);
ALTER TABLE `#__jshopping_order_history` ADD INDEX(`customer_notify`);

ALTER TABLE `#__jshopping_order_item` ADD INDEX(`order_id`);
ALTER TABLE `#__jshopping_order_item` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_order_item` ADD INDEX(`delivery_times_id`);
ALTER TABLE `#__jshopping_order_item` ADD INDEX(`vendor_id`);

ALTER TABLE `#__jshopping_order_status` ADD INDEX(`status_code`);

ALTER TABLE `#__jshopping_orders` ADD INDEX(`order_number`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`user_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`currency_code_iso`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`order_status`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`order_created`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`shipping_method_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`delivery_times_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`payment_method_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`coupon_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`client_type`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`country`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`phone`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`d_title`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`d_country`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`display_price`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`vendor_type`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`vendor_id`);
ALTER TABLE `#__jshopping_orders` ADD INDEX(`lang`);

ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`payment_code`);
ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`payment_publish`);
ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`payment_ordering`);
ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`payment_type`);
ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`price_type`);
ALTER TABLE `#__jshopping_payment_method` ADD INDEX(`tax_id`);

ALTER TABLE `#__jshopping_payment_trx` ADD INDEX(`order_id`);
ALTER TABLE `#__jshopping_payment_trx` ADD INDEX(`transaction`);
ALTER TABLE `#__jshopping_payment_trx` ADD INDEX(`rescode`);
ALTER TABLE `#__jshopping_payment_trx` ADD INDEX(`status_id`);

ALTER TABLE `#__jshopping_payment_trx_data` ADD INDEX(`trx_id`);
ALTER TABLE `#__jshopping_payment_trx_data` ADD INDEX(`order_id`);
ALTER TABLE `#__jshopping_payment_trx_data` ADD INDEX(`key`);

ALTER TABLE `#__jshopping_products` ADD INDEX(`parent_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`product_ean`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`unlimited`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`product_availability`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`product_publish`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`product_tax_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`currency_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`product_price`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`min_price`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`add_price_unit_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`average_rating`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`reviews_count`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`delivery_times_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`hits`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`basic_price_unit_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`label_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`vendor_id`);
ALTER TABLE `#__jshopping_products` ADD INDEX(`access`);

ALTER TABLE `#__jshopping_products_attr` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_attr` ADD INDEX(`ext_attribute_product_id`);

ALTER TABLE `#__jshopping_products_attr2` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_attr2` ADD INDEX(`attr_id`);
ALTER TABLE `#__jshopping_products_attr2` ADD INDEX(`attr_value_id`);
ALTER TABLE `#__jshopping_products_attr2` ADD INDEX(`price_mod`);

ALTER TABLE `#__jshopping_products_extra_field_groups` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_products_extra_field_values` ADD INDEX(`field_id`);
ALTER TABLE `#__jshopping_products_extra_field_values` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`allcats`);
ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`type`);
ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`multilist`);
ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`group`);
ALTER TABLE `#__jshopping_products_extra_fields` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_products_files` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_products_images` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_images` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_products_option` ADD INDEX(`product_id`);

ALTER TABLE `#__jshopping_products_prices` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_prices` ADD INDEX(`product_quantity_start`);
ALTER TABLE `#__jshopping_products_prices` ADD INDEX(`product_quantity_finish`);

ALTER TABLE `#__jshopping_products_relations` ADD INDEX(`product_id`, `product_related_id`);
ALTER TABLE `#__jshopping_products_relations` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_relations` ADD INDEX(`product_related_id`);

ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`product_id`);
ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`user_id`);
ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`user_email`);
ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`mark`);
ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`publish`);
ALTER TABLE `#__jshopping_products_reviews` ADD INDEX(`ip`);

ALTER TABLE `#__jshopping_products_to_categories` ADD INDEX(`product_id`, `category_id`, `product_ordering`);
ALTER TABLE `#__jshopping_products_to_categories` ADD INDEX(`product_ordering`);

ALTER TABLE `#__jshopping_products_videos` ADD INDEX(`video_id`, `product_id`);
ALTER TABLE `#__jshopping_products_videos` ADD INDEX(`product_id`);

ALTER TABLE `#__jshopping_shipping_ext_calc` ADD INDEX(`alias`);
ALTER TABLE `#__jshopping_shipping_ext_calc` ADD INDEX(`published`);
ALTER TABLE `#__jshopping_shipping_ext_calc` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_shipping_method` ADD INDEX(`alias`);
ALTER TABLE `#__jshopping_shipping_method` ADD INDEX(`published`);
ALTER TABLE `#__jshopping_shipping_method` ADD INDEX(`ordering`);

ALTER TABLE `#__jshopping_shipping_method_price` ADD INDEX(`shipping_method_id`);
ALTER TABLE `#__jshopping_shipping_method_price` ADD INDEX(`shipping_tax_id`);
ALTER TABLE `#__jshopping_shipping_method_price` ADD INDEX(`package_tax_id`);
ALTER TABLE `#__jshopping_shipping_method_price` ADD INDEX(`delivery_times_id`);

ALTER TABLE `#__jshopping_shipping_method_price_countries` ADD INDEX(`sh_method_country_id`, `country_id`, `sh_pr_method_id`);
ALTER TABLE `#__jshopping_shipping_method_price_countries` ADD INDEX(`country_id`, `sh_pr_method_id`);
ALTER TABLE `#__jshopping_shipping_method_price_countries` ADD INDEX(`sh_method_country_id`, `country_id`);

ALTER TABLE `#__jshopping_shipping_method_price_weight` ADD INDEX( `sh_pr_weight_id`, `sh_pr_method_id`);

ALTER TABLE `#__jshopping_taxes_ext` ADD INDEX(`tax_id`);

ALTER TABLE `#__jshopping_unit` ADD INDEX(`qty`);

ALTER TABLE `#__jshopping_usergroups` ADD INDEX(`usergroup_name`);
ALTER TABLE `#__jshopping_usergroups` ADD INDEX(`usergroup_is_default`);

ALTER TABLE `#__jshopping_users` ADD INDEX(`usergroup_id`);
ALTER TABLE `#__jshopping_users` ADD INDEX(`payment_id`);
ALTER TABLE `#__jshopping_users` ADD INDEX(`shipping_id`);
ALTER TABLE `#__jshopping_users` ADD INDEX(`client_type`);
ALTER TABLE `#__jshopping_users` ADD INDEX(`email`);

ALTER TABLE `#__jshopping_vendors` ADD INDEX(`country`);
ALTER TABLE `#__jshopping_vendors` ADD INDEX(`user_id`);
ALTER TABLE `#__jshopping_vendors` ADD INDEX(`email`);
ALTER TABLE `#__jshopping_vendors` ADD INDEX(`main`);
ALTER TABLE `#__jshopping_vendors` ADD INDEX(`publish`);

DELETE FROM `#__jshopping_languages`;
update `#__jshopping_usergroups` set `name_en-GB`=`usergroup_name`, `name_de-DE`=`usergroup_name`;
update `#__jshopping_orders` set `product_stock_removed`=1 where order_created=1 and order_status not in (3, 4);