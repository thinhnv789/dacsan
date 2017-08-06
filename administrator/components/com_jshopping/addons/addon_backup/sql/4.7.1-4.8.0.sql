


ALTER TABLE `#__jshopping_addons`
  ADD INDEX alias (alias);

ALTER TABLE `#__jshopping_addons`
  ADD INDEX name (name);




CREATE TABLE `#__jshopping_attr_groups` (
  id INT(11) NOT NULL AUTO_INCREMENT,
  ordering INT(6) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;




ALTER TABLE `#__jshopping_attr_values`
  ADD INDEX attr_id (attr_id);

ALTER TABLE `#__jshopping_attr_values`
  ADD INDEX value_ordering (value_ordering);




ALTER TABLE `#__jshopping_attr`
  ADD COLUMN `group` TINYINT(4) NOT NULL AFTER cats;

ALTER TABLE `#__jshopping_attr`
  ADD INDEX allcats (allcats);

ALTER TABLE `#__jshopping_attr`
  ADD INDEX attr_ordering (attr_ordering);

ALTER TABLE `#__jshopping_attr`
  ADD INDEX attr_type (attr_type);

ALTER TABLE `#__jshopping_attr`
  ADD INDEX `group` (`group`);

ALTER TABLE `#__jshopping_attr`
  ADD INDEX independent (independent);




ALTER TABLE `#__jshopping_cart_temp`
  ADD INDEX id_cookie (id_cookie);

ALTER TABLE `#__jshopping_cart_temp`
  ADD INDEX type_cart (type_cart);




ALTER TABLE `#__jshopping_categories`
  ADD INDEX access (access);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_add_date (category_add_date);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_ordertype (category_ordertype);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_parent_id (category_parent_id);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_publish (category_publish);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_publish_2 (category_publish, access);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX category_template (category_template);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX products_page (products_page);

ALTER TABLE `#__jshopping_categories`
  ADD INDEX products_row (products_row);




ALTER TABLE `#__jshopping_config_display_prices`
  ADD INDEX display_price (display_price);

ALTER TABLE `#__jshopping_config_display_prices`
  ADD INDEX display_price_firma (display_price_firma);




ALTER TABLE `#__jshopping_config_seo`
  ADD INDEX alias (alias);

ALTER TABLE `#__jshopping_config_seo`
  ADD INDEX ordering (ordering);




ALTER TABLE `#__jshopping_config_statictext`
  ADD INDEX alias (alias);

ALTER TABLE `#__jshopping_config_statictext`
  ADD INDEX use_for_return_policy (use_for_return_policy);




ALTER TABLE `#__jshopping_countries`
  ADD INDEX country_code (country_code);

ALTER TABLE `#__jshopping_countries`
  ADD INDEX country_code_2 (country_code_2);

ALTER TABLE `#__jshopping_countries`
  ADD INDEX country_publish (country_publish);

ALTER TABLE `#__jshopping_countries`
  ADD INDEX ordering (ordering);




ALTER TABLE `#__jshopping_coupons`
  ADD INDEX coupon_code (coupon_code);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX coupon_expire_date (coupon_expire_date);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX coupon_publish (coupon_publish);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX coupon_start_date (coupon_start_date);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX coupon_type (coupon_type);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX finished_after_used (finished_after_used);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX for_user_id (for_user_id);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX tax_id (tax_id);

ALTER TABLE `#__jshopping_coupons`
  ADD INDEX used (used);




ALTER TABLE `#__jshopping_currencies`
  ADD INDEX currency_code_iso (currency_code_iso);

ALTER TABLE `#__jshopping_currencies`
  ADD INDEX currency_code_num (currency_code_num);

ALTER TABLE `#__jshopping_currencies`
  ADD INDEX currency_ordering (currency_ordering);

ALTER TABLE `#__jshopping_currencies`
  ADD INDEX currency_publish (currency_publish);




ALTER TABLE `#__jshopping_languages`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_languages`
  ADD INDEX publish (publish);




ALTER TABLE `#__jshopping_manufacturers`
  ADD INDEX manufacturer_publish (manufacturer_publish);

ALTER TABLE `#__jshopping_manufacturers`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_manufacturers`
  ADD INDEX products_page (products_page);

ALTER TABLE `#__jshopping_manufacturers`
  ADD INDEX products_row (products_row);




ALTER TABLE `#__jshopping_order_history`
  ADD INDEX customer_notify (customer_notify);

ALTER TABLE `#__jshopping_order_history`
  ADD INDEX order_id (order_id);

ALTER TABLE `#__jshopping_order_history`
  ADD INDEX order_status_id (order_status_id);

ALTER TABLE `#__jshopping_order_history`
  ADD INDEX status_date_added (status_date_added);




ALTER TABLE `#__jshopping_order_item`
  ADD INDEX delivery_times_id (delivery_times_id);

ALTER TABLE `#__jshopping_order_item`
  ADD INDEX order_id (order_id);

ALTER TABLE `#__jshopping_order_item`
  ADD INDEX product_id (product_id);

ALTER TABLE `#__jshopping_order_item`
  ADD INDEX vendor_id (vendor_id);




ALTER TABLE `#__jshopping_order_status`
  ADD INDEX status_code (status_code);




ALTER TABLE `#__jshopping_orders`
  ADD COLUMN shipping_params TEXT NOT NULL AFTER payment_params_data,
  ADD COLUMN shipping_params_data TEXT NOT NULL AFTER shipping_params,
  ADD COLUMN product_stock_removed TINYINT(1) NOT NULL AFTER transaction;

ALTER TABLE `#__jshopping_orders`
  ADD INDEX client_type (client_type);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX country (country);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX coupon_id (coupon_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX currency_code_iso (currency_code_iso);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX d_country (d_country);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX d_title (d_title);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX delivery_times_id (delivery_times_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX display_price (display_price);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX lang (lang);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX order_created (order_created);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX order_number (order_number);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX order_status (order_status);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX payment_method_id (payment_method_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX phone (phone);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX shipping_method_id (shipping_method_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX user_id (user_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX vendor_id (vendor_id);

ALTER TABLE `#__jshopping_orders`
  ADD INDEX vendor_type (vendor_type);




ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX payment_code (payment_code);

ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX payment_ordering (payment_ordering);

ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX payment_publish (payment_publish);

ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX payment_type (payment_type);

ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX price_type (price_type);

ALTER TABLE `#__jshopping_payment_method`
  ADD INDEX tax_id (tax_id);




ALTER TABLE `#__jshopping_payment_trx_data`
  ADD INDEX `key` (`key`);

ALTER TABLE `#__jshopping_payment_trx_data`
  ADD INDEX order_id (order_id);

ALTER TABLE `#__jshopping_payment_trx_data`
  ADD INDEX trx_id (trx_id);




ALTER TABLE `#__jshopping_payment_trx`
  ADD INDEX order_id (order_id);

ALTER TABLE `#__jshopping_payment_trx`
  ADD INDEX rescode (rescode);

ALTER TABLE `#__jshopping_payment_trx`
  ADD INDEX status_id (status_id);

ALTER TABLE `#__jshopping_payment_trx`
  ADD INDEX transaction (transaction);




ALTER TABLE `#__jshopping_products_attr`
  ADD INDEX ext_attribute_product_id (ext_attribute_product_id);

ALTER TABLE `#__jshopping_products_attr`
  ADD INDEX product_id (product_id);




ALTER TABLE `#__jshopping_products_attr2`
  ADD INDEX attr_id (attr_id);

ALTER TABLE `#__jshopping_products_attr2`
  ADD INDEX attr_value_id (attr_value_id);

ALTER TABLE `#__jshopping_products_attr2`
  ADD INDEX price_mod (price_mod);

ALTER TABLE `#__jshopping_products_attr2`
  ADD INDEX product_id (product_id);




ALTER TABLE `#__jshopping_products_extra_field_groups`
  ADD INDEX ordering (ordering);




ALTER TABLE `#__jshopping_products_extra_field_values`
  ADD INDEX field_id (field_id);

ALTER TABLE `#__jshopping_products_extra_field_values`
  ADD INDEX ordering (ordering);




ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX allcats (allcats);

ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX `group` (`group`);

ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX group_2 (`group`);

ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX multilist (multilist);

ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_products_extra_fields`
  ADD INDEX type (type);




ALTER TABLE `#__jshopping_products_files`
  ADD INDEX ordering (ordering);




ALTER TABLE `#__jshopping_products_images`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_products_images`
  ADD INDEX product_id (product_id);




ALTER TABLE `#__jshopping_products_option`
  ADD INDEX product_id (product_id);




ALTER TABLE `#__jshopping_products_prices`
  ADD INDEX product_id (product_id);

ALTER TABLE `#__jshopping_products_prices`
  ADD INDEX product_quantity_finish (product_quantity_finish);

ALTER TABLE `#__jshopping_products_prices`
  ADD INDEX product_quantity_start (product_quantity_start);




ALTER TABLE `#__jshopping_products_relations`
  ADD INDEX product_id (product_id, product_related_id);

ALTER TABLE `#__jshopping_products_relations`
  ADD INDEX product_id_2 (product_id);

ALTER TABLE `#__jshopping_products_relations`
  ADD INDEX product_related_id (product_related_id);




ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX ip (ip);

ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX mark (mark);

ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX product_id (product_id);

ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX publish (publish);

ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX user_email (user_email);

ALTER TABLE `#__jshopping_products_reviews`
  ADD INDEX user_id (user_id);




ALTER TABLE `#__jshopping_products_to_categories`
  ADD INDEX product_id_2 (product_id, category_id, product_ordering);

ALTER TABLE `#__jshopping_products_to_categories`
  ADD INDEX product_ordering (product_ordering);




ALTER TABLE `#__jshopping_products_videos`
  ADD INDEX product_id (product_id);

ALTER TABLE `#__jshopping_products_videos`
  ADD INDEX video_id (video_id, product_id);




ALTER TABLE `#__jshopping_products`
  ADD INDEX access (access);

ALTER TABLE `#__jshopping_products`
  ADD INDEX add_price_unit_id (add_price_unit_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX average_rating (average_rating);

ALTER TABLE `#__jshopping_products`
  ADD INDEX basic_price_unit_id (basic_price_unit_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX currency_id (currency_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX delivery_times_id (delivery_times_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX hits (hits);

ALTER TABLE `#__jshopping_products`
  ADD INDEX label_id (label_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX min_price (min_price);

ALTER TABLE `#__jshopping_products`
  ADD INDEX parent_id (parent_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX product_availability (product_availability);

ALTER TABLE `#__jshopping_products`
  ADD INDEX product_ean (product_ean);

ALTER TABLE `#__jshopping_products`
  ADD INDEX product_price (product_price);

ALTER TABLE `#__jshopping_products`
  ADD INDEX product_publish (product_publish);

ALTER TABLE `#__jshopping_products`
  ADD INDEX product_tax_id (product_tax_id);

ALTER TABLE `#__jshopping_products`
  ADD INDEX reviews_count (reviews_count);

ALTER TABLE `#__jshopping_products`
  ADD INDEX unlimited (unlimited);

ALTER TABLE `#__jshopping_products`
  ADD INDEX vendor_id (vendor_id);




ALTER TABLE `#__jshopping_shipping_ext_calc`
  ADD INDEX alias (alias);

ALTER TABLE `#__jshopping_shipping_ext_calc`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_shipping_ext_calc`
  ADD INDEX published (published);




ALTER TABLE `#__jshopping_shipping_method_price_countries`
  ADD INDEX country_id_2 (country_id, sh_pr_method_id);

ALTER TABLE `#__jshopping_shipping_method_price_countries`
  ADD INDEX sh_method_country_id (sh_method_country_id, country_id, sh_pr_method_id);

ALTER TABLE `#__jshopping_shipping_method_price_countries`
  ADD INDEX sh_method_country_id_2 (sh_method_country_id, country_id);




ALTER TABLE `#__jshopping_shipping_method_price_weight`
  ADD INDEX sh_pr_weight_id (sh_pr_weight_id, sh_pr_method_id);




ALTER TABLE `#__jshopping_shipping_method_price`
  ADD INDEX delivery_times_id (delivery_times_id);

ALTER TABLE `#__jshopping_shipping_method_price`
  ADD INDEX package_tax_id (package_tax_id);

ALTER TABLE `#__jshopping_shipping_method_price`
  ADD INDEX shipping_method_id (shipping_method_id);

ALTER TABLE `#__jshopping_shipping_method_price`
  ADD INDEX shipping_tax_id (shipping_tax_id);




ALTER TABLE `#__jshopping_shipping_method`
  ADD INDEX alias (alias);

ALTER TABLE `#__jshopping_shipping_method`
  ADD INDEX ordering (ordering);

ALTER TABLE `#__jshopping_shipping_method`
  ADD INDEX published (published);




ALTER TABLE `#__jshopping_taxes_ext`
  ADD INDEX tax_id (tax_id);




ALTER TABLE `#__jshopping_unit`
  ADD INDEX qty (qty);




ALTER TABLE `#__jshopping_usergroups`
  ADD COLUMN `name_en-GB` VARCHAR(255) NOT NULL AFTER usergroup_is_default,
  ADD COLUMN `name_de-DE` VARCHAR(255) NOT NULL AFTER `name_en-GB`;

ALTER TABLE `#__jshopping_usergroups`
  ADD INDEX usergroup_is_default (usergroup_is_default);

ALTER TABLE `#__jshopping_usergroups`
  ADD INDEX usergroup_name (usergroup_name);




ALTER TABLE `#__jshopping_users`
  ADD COLUMN lang VARCHAR(5) NOT NULL AFTER d_ext_field_3;

ALTER TABLE `#__jshopping_users`
  ADD INDEX client_type (client_type);

ALTER TABLE `#__jshopping_users`
  ADD INDEX email (email);

ALTER TABLE `#__jshopping_users`
  ADD INDEX payment_id (payment_id);

ALTER TABLE `#__jshopping_users`
  ADD INDEX shipping_id (shipping_id);

ALTER TABLE `#__jshopping_users`
  ADD INDEX usergroup_id_2 (usergroup_id);




ALTER TABLE `#__jshopping_vendors`
  ADD INDEX country (country);

ALTER TABLE `#__jshopping_vendors`
  ADD INDEX email (email);

ALTER TABLE `#__jshopping_vendors`
  ADD INDEX main (main);

ALTER TABLE `#__jshopping_vendors`
  ADD INDEX publish (publish);

ALTER TABLE `#__jshopping_vendors`
  ADD INDEX user_id (user_id);