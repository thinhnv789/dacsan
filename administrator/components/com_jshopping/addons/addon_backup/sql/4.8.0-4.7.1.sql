


ALTER TABLE `#__jshopping_addons`
  DROP INDEX alias,
  DROP INDEX name;

ALTER TABLE `#__jshopping_attr_values`
  DROP INDEX attr_id,
  DROP INDEX value_ordering;

ALTER TABLE `#__jshopping_attr`
  DROP COLUMN `group`,
  DROP INDEX allcats,
  DROP INDEX attr_ordering,
  DROP INDEX attr_type,
  DROP INDEX `group`,
  DROP INDEX independent;

ALTER TABLE `#__jshopping_cart_temp`
  DROP INDEX id_cookie,
  DROP INDEX type_cart;

ALTER TABLE `#__jshopping_categories`
  DROP INDEX access,
  DROP INDEX category_add_date,
  DROP INDEX category_ordertype,
  DROP INDEX category_parent_id,
  DROP INDEX category_publish,
  DROP INDEX category_publish_2,
  DROP INDEX category_template,
  DROP INDEX ordering,
  DROP INDEX products_page,
  DROP INDEX products_row;

ALTER TABLE `#__jshopping_config_display_prices`
  DROP INDEX display_price,
  DROP INDEX display_price_firma;

ALTER TABLE `#__jshopping_config_seo`
  DROP INDEX alias,
  DROP INDEX ordering;


ALTER TABLE `#__jshopping_config_statictext`
  DROP INDEX alias,
  DROP INDEX use_for_return_policy;

ALTER TABLE `#__jshopping_countries`
  DROP INDEX country_code,
  DROP INDEX country_code_2,
  DROP INDEX country_publish,
  DROP INDEX ordering;

ALTER TABLE `#__jshopping_coupons`
  DROP INDEX coupon_code,
  DROP INDEX coupon_expire_date,
  DROP INDEX coupon_publish,
  DROP INDEX coupon_start_date,
  DROP INDEX coupon_type,
  DROP INDEX finished_after_used,
  DROP INDEX for_user_id,
  DROP INDEX tax_id,
  DROP INDEX used;

ALTER TABLE `#__jshopping_currencies`
  DROP INDEX currency_code_iso,
  DROP INDEX currency_code_num,
  DROP INDEX currency_ordering,
  DROP INDEX currency_publish;


ALTER TABLE `#__jshopping_languages`
  DROP INDEX ordering,
  DROP INDEX publish;

ALTER TABLE `#__jshopping_manufacturers`
  DROP INDEX manufacturer_publish,
  DROP INDEX ordering,
  DROP INDEX products_page,
  DROP INDEX products_row;

ALTER TABLE `#__jshopping_order_history`
  DROP INDEX customer_notify,
  DROP INDEX order_id,
  DROP INDEX order_status_id,
  DROP INDEX status_date_added;

ALTER TABLE `#__jshopping_order_item`
  DROP INDEX delivery_times_id,
  DROP INDEX order_id,
  DROP INDEX product_id,
  DROP INDEX vendor_id;

ALTER TABLE `#__jshopping_order_status`
  DROP INDEX status_code;


ALTER TABLE `#__jshopping_orders`
  DROP COLUMN shipping_params,
  DROP COLUMN shipping_params_data,
  DROP COLUMN product_stock_removed,
  DROP INDEX client_type,
  DROP INDEX country,
  DROP INDEX coupon_id,
  DROP INDEX currency_code_iso,
  DROP INDEX d_country,
  DROP INDEX d_title,
  DROP INDEX delivery_times_id,
  DROP INDEX display_price,
  DROP INDEX lang,
  DROP INDEX order_created,
  DROP INDEX order_number,
  DROP INDEX order_status,
  DROP INDEX payment_method_id,
  DROP INDEX phone,
  DROP INDEX shipping_method_id,
  DROP INDEX user_id,
  DROP INDEX vendor_id,
  DROP INDEX vendor_type;

ALTER TABLE `#__jshopping_payment_method`
  DROP INDEX payment_code,
  DROP INDEX payment_ordering,
  DROP INDEX payment_publish,
  DROP INDEX payment_type,
  DROP INDEX price_type,
  DROP INDEX tax_id;

ALTER TABLE `#__jshopping_payment_trx_data`
  DROP INDEX `key`,
  DROP INDEX order_id,
  DROP INDEX trx_id;

ALTER TABLE `#__jshopping_payment_trx`
  DROP INDEX order_id,
  DROP INDEX rescode,
  DROP INDEX status_id,
  DROP INDEX transaction;

ALTER TABLE `#__jshopping_products_attr`
  DROP INDEX ext_attribute_product_id,
  DROP INDEX product_id;

ALTER TABLE `#__jshopping_products_attr2`
  DROP INDEX attr_id,
  DROP INDEX attr_value_id,
  DROP INDEX price_mod,
  DROP INDEX product_id;

ALTER TABLE `#__jshopping_products_extra_field_groups`
  DROP INDEX ordering;

ALTER TABLE `#__jshopping_products_extra_field_values`
  DROP INDEX field_id,
  DROP INDEX ordering;

ALTER TABLE `#__jshopping_products_extra_fields`
  DROP INDEX allcats,
  DROP INDEX `group`,
  DROP INDEX group_2,
  DROP INDEX multilist,
  DROP INDEX ordering,
  DROP INDEX type;

ALTER TABLE `#__jshopping_products_files`
  DROP INDEX ordering;

ALTER TABLE `#__jshopping_products_images`
  DROP INDEX ordering,
  DROP INDEX product_id;

ALTER TABLE `#__jshopping_products_option`
  DROP INDEX product_id;

ALTER TABLE `#__jshopping_products_prices`
  DROP INDEX product_id,
  DROP INDEX product_quantity_finish,
  DROP INDEX product_quantity_start;

ALTER TABLE `#__jshopping_products_relations`
  DROP INDEX product_id,
  DROP INDEX product_id_2,
  DROP INDEX product_related_id;

ALTER TABLE `#__jshopping_products_reviews`
  DROP INDEX ip,
  DROP INDEX mark,
  DROP INDEX product_id,
  DROP INDEX publish,
  DROP INDEX user_email,
  DROP INDEX user_id;

ALTER TABLE `#__jshopping_products_to_categories`
  DROP INDEX product_id_2,
  DROP INDEX product_ordering;

ALTER TABLE `#__jshopping_products_videos`
  DROP INDEX product_id,
  DROP INDEX video_id;

ALTER TABLE `#__jshopping_products`
  DROP INDEX access,
  DROP INDEX add_price_unit_id,
  DROP INDEX average_rating,
  DROP INDEX basic_price_unit_id,
  DROP INDEX currency_id,
  DROP INDEX delivery_times_id,
  DROP INDEX hits,
  DROP INDEX label_id,
  DROP INDEX min_price,
  DROP INDEX parent_id,
--  DROP INDEX product_availability,
  DROP INDEX product_ean,
  DROP INDEX product_price,
  DROP INDEX product_publish,
  DROP INDEX product_tax_id,
  DROP INDEX reviews_count,
  DROP INDEX unlimited,
  DROP INDEX vendor_id;

ALTER TABLE `#__jshopping_shipping_ext_calc`
  DROP INDEX alias,
  DROP INDEX ordering,
  DROP INDEX published;

ALTER TABLE `#__jshopping_shipping_method_price_countries`
  DROP INDEX country_id_2,
  DROP INDEX sh_method_country_id,
  DROP INDEX sh_method_country_id_2;

ALTER TABLE `#__jshopping_shipping_method_price_weight`
  DROP INDEX sh_pr_weight_id;

ALTER TABLE `#__jshopping_shipping_method_price`
  DROP INDEX delivery_times_id,
  DROP INDEX package_tax_id,
  DROP INDEX shipping_method_id,
  DROP INDEX shipping_tax_id;

ALTER TABLE `#__jshopping_shipping_method`
  DROP INDEX alias,
  DROP INDEX ordering,
  DROP INDEX published;

ALTER TABLE `#__jshopping_taxes_ext`
  DROP INDEX tax_id;

ALTER TABLE `#__jshopping_unit`
  DROP INDEX qty;

ALTER TABLE `#__jshopping_usergroups`
  DROP COLUMN `name_en-GB`,
  DROP COLUMN `name_de-DE`,
  DROP INDEX usergroup_is_default,
  DROP INDEX usergroup_name;

ALTER TABLE `#__jshopping_users`
  DROP COLUMN lang,
  DROP INDEX client_type,
  DROP INDEX email,
  DROP INDEX payment_id,
  DROP INDEX shipping_id,
  DROP INDEX usergroup_id_2;

ALTER TABLE `#__jshopping_vendors`
  DROP INDEX country,
  DROP INDEX email,
  DROP INDEX main,
  DROP INDEX publish,
  DROP INDEX user_id;
  
DROP TABLE `#__jshopping_attr_groups`;