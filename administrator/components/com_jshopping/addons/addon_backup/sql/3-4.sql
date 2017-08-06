ALTER TABLE #__jshopping_products ADD COLUMN image varchar(255) NOT NULL;
UPDATE #__jshopping_products SET image=product_name_image;

ALTER TABLE #__jshopping_products DROP product_name_image;
ALTER TABLE #__jshopping_products DROP product_thumb_image;
ALTER TABLE #__jshopping_products DROP product_full_image;

ALTER TABLE #__jshopping_products_images DROP image_full;
ALTER TABLE #__jshopping_products_images DROP image_thumb;