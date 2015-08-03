DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='shop_user' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='shop_user' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_shop_user`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='shop_order' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='shop_order' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_shop_order`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='shop_comments' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='shop_comments' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_shop_comments`;