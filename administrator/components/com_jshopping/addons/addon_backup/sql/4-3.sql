ALTER TABLE #__jshopping_products ADD COLUMN product_name_image varchar(255) NOT NULL;
ALTER TABLE #__jshopping_products ADD COLUMN product_full_image varchar(255) NOT NULL;
ALTER TABLE #__jshopping_products ADD COLUMN product_thumb_image varchar(255) NOT NULL;
UPDATE #__jshopping_products SET product_name_image=image;
UPDATE #__jshopping_products SET product_full_image=CONCAT('full_',image);
UPDATE #__jshopping_products SET product_thumb_image=CONCAT('thumb_',image);

ALTER TABLE #__jshopping_products_images ADD COLUMN image_full varchar(255) NOT NULL DEFAULT '';
ALTER TABLE #__jshopping_products_images ADD COLUMN image_thumb varchar(255) NOT NULL DEFAULT '';

UPDATE #__jshopping_products_images SET image_full=CONCAT('full_',image_name);
UPDATE #__jshopping_products_images SET image_thumb=CONCAT('thumb_',image_name);