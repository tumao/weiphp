CREATE TABLE IF NOT EXISTS `wp_weisite_category` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`title`  varchar(100) NOT NULL  COMMENT '分类标题',
`icon`  int(10) UNSIGNED  NULL  COMMENT '分类图片',
`url`  varchar(255) NOT NULL  COMMENT '外链',
`is_show`  tinyint(2) NOT NULL  DEFAULT 1 COMMENT '显示',
`token`  varchar(100)  NULL  COMMENT 'Token',
`sort`  int(10)  NULL  DEFAULT 0 COMMENT '排序号',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('weisite_category','微官网分类','0','','1','{"1":["title","icon","url","is_show"]}','1:基础','','','','','title:分类标题\r\nicon:分类图片\r\nurl:外链\r\nsort:排序号\r\nis_show|get_name_by_status:显示\r\nid:操作:[EDIT]|编辑,[DELETE]|删除','10','title','','1395987942','1396340374','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','分类标题','varchar(100) NOT NULL','string','','','1','','0','0','1','1395988016','1395988016','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('icon','分类图片','int(10) UNSIGNED  NULL','picture','','','1','','0','0','1','1395988966','1395988966','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('url','外链','varchar(255) NOT NULL','string','','','1','','0','0','1','1395989660','1395989660','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('is_show','显示','tinyint(2) NOT NULL','bool','1','','1','0: 不显示\r\n1: 显示','0','0','1','1395989709','1395989709','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('token','Token','varchar(100)  NULL','string','','','0','','0','0','1','1395989760','1395989760','','3','','regex','get_token','1','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('sort','排序号','int(10)  NULL','num','0','数值越小越靠前','1','','0','0','1','1396340334','1396340334','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;

CREATE TABLE IF NOT EXISTS `wp_weisite_slideshow` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`title`  varchar(255) NULL  COMMENT '标题',
`img`  int(10) UNSIGNED NOT NULL  COMMENT '图片',
`url`  varchar(255) NULL  COMMENT '链接地址',
`is_show`  tinyint(2) NULL  DEFAULT 1 COMMENT '是否显示',
`sort`  int(10) UNSIGNED NULL  DEFAULT 0 COMMENT '排序',
`token`  varchar(100) NULL  COMMENT 'Token',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('weisite_slideshow','幻灯片','0','','1','{"1":["title","img","url","is_show","sort"]}','1:基础','','','','','title:标题\r\nimg:图片\r\nurl:链接地址\r\nis_show|get_name_by_status:显示\r\nsort:排序\r\nid:操作:[EDIT]|编辑,[DELETE]|删除','10','title','','1396098264','1396099200','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','标题','varchar(255) NULL','string','','可为空','1','','0','0','1','1396098316','1396098316','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('img','图片','int(10) UNSIGNED NOT NULL','picture','','','1','','0','1','1','1396098349','1396098349','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('url','链接地址','varchar(255) NULL','string','','','1','','0','0','1','1396098380','1396098380','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('is_show','是否显示','tinyint(2) NULL','bool','1','','1','0:不显示\r\n1:显示','0','0','1','1396098464','1396098464','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('sort','排序','int(10) UNSIGNED NULL','num','0','值越小越靠前','1','','0','0','1','1396098682','1396098682','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('token','Token','varchar(100) NULL','string','','','0','','0','0','1','1396098747','1396098747','','3','','regex','get_token','1','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;

CREATE TABLE IF NOT EXISTS `wp_weisite_footer` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`url`  varchar(255)   NULL  COMMENT '关联URL',
`title`  varchar(50) NOT NULL  COMMENT '菜单名',
`pid`  tinyint(2) NULL  DEFAULT 0 COMMENT '一级菜单',
`sort`  tinyint(4)  NULL  DEFAULT 0 COMMENT '排序号',
`token`  varchar(255) NOT NULL  COMMENT 'Token',
`icon`  int(10) UNSIGNED NULL  COMMENT '图标',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('weisite_footer','底部导航','0','','1','{"1":["pid","title","url","sort"]}','1:基础','','','','','title:菜单名\r\nicon:图标\r\nurl:关联URL\r\nsort:排序号\r\nid:操作:[EDIT]|编辑,[DELETE]|删除','10','title','','1394518309','1396507698','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('url','关联URL','varchar(255)   NULL','string','','','1','','0','0','1','1394519090','1394519090','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','菜单名','varchar(50) NOT NULL','string','','可创建最多 3 个一级菜单，每个一级菜单下可创建最多 5 个二级菜单。编辑中的菜单不会马上被用户看到，请放心调试。','1','','0','0','1','1394519941','1394518988','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('pid','一级菜单','tinyint(2) NULL','select','0','如果是一级菜单，选择“无”即可','1','0:无','0','0','1','1394519296','1394518930','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('sort','排序号','tinyint(4)  NULL','num','0','数值越小越靠前','1','','0','0','1','1394523288','1394519175','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('token','Token','varchar(255) NOT NULL','string','','','0','','0','0','1','1394526820','1394526820','','3','','regex','get_token','1','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('icon','图标','int(10) UNSIGNED NULL','picture','','根据选择的底部模板决定是否需要上传图标','1','','0','0','1','1396506297','1396506297','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;

CREATE TABLE IF NOT EXISTS `wp_product` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`name`  varchar(255) NOT NULL  COMMENT '商品名称',
`unit`  varchar(255) NOT NULL  COMMENT '商品单位',
`img1`  int(10) UNSIGNED NOT NULL  COMMENT '图片1',
`pcode`  varchar(255) NOT NULL  COMMENT '商品编号',
`price`  int(10) NOT NULL  COMMENT '商品价格',
`stockcount`  int(10) NOT NULL  COMMENT '库存',
`cate_id`  int(10) NOT NULL  DEFAULT 0 COMMENT '所属分类',
`img2`  int(10) UNSIGNED NOT NULL  COMMENT '商品图片2',
`img3`  int(10) UNSIGNED NOT NULL  COMMENT '商品图片3',
`token`  varchar(255) NOT NULL  COMMENT 'Token',
`describe`  text NOT NULL  COMMENT '商品描述',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('1','龙岩','千克','000001','1','100','56','370','377','367','gh_b6ff5c2aaf62','龙眼_5千克——广东省外包邮');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('2','水果','个','000023','2','300','55','375','368','367','gh_b6ff5c2aaf62','鹰嘴桃，广东省外包邮（12个装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('3','水果','个','000022','2','300','56','377','0','0','gh_b6ff5c2aaf62','');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('6','火龙果','千克','2202','50','1000','55','377','370','376','gh_b6ff5c2aaf62','');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('5','水果','个','00002','2','300','58','369','367','368','gh_b6ff5c2aaf62','【芳芳庄园】么么桃，江浙沪包邮（18个礼盒装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('7','极品龙岩','千克','989899920000','20','50','55','377','369','375','gh_b6ff5c2aaf62','【芳芳庄园】么么桃，江浙沪包邮（18个装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('8','变异水果','千克','123124124','23','55','56','368','377','376','gh_b6ff5c2aaf62','【芳芳庄园】么么桃，江浙沪包邮（18个装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('9','上等龙岩','千克','0001','30','500','55','372','376','372','gh_b6ff5c2aaf62','【芳芳庄园】么么桃，江浙沪包邮（18个装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('10','荔枝','千克','00908098098','10','100','55','376','370','368','gh_b6ff5c2aaf62','【芳芳庄园】毛毛桃，非江浙沪包邮（8个装）');
INSERT INTO `wp_product` (`id`,`name`,`unit`,`pcode`,`price`,`stockcount`,`cate_id`,`img1`,`img2`,`img3`,`token`,`describe`) VALUES ('11','龙眼','千克','002004','10','200','55','376','368','377','gh_b6ff5c2aaf62','1元秒杀，【芳芳庄园】两万斤龙眼免费送');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('product','商品','0','','1','{"1":["name","pcode","price","stockcount","unit","cate_id","img1","img2","img3"]}','1:基础','','','','','name:商品名称\r\npcode:商品编号\r\nprice:商品价格\r\nstockcount:库存\r\nimg1:商品图片1\r\ncate_id:10%所属分类\r\nid:10%操作:[EDIT]|编辑,[DELETE]|删除','10','name','','1437188014','1437303552','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('name','商品名称','varchar(255) NOT NULL','string','','商品名称','1','','0','1','1','1437188477','1437188477','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('unit','商品单位','varchar(255) NOT NULL','string','','商品单位','1','','0','0','1','1437188562','1437188562','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('img1','图片1','int(10) UNSIGNED NOT NULL','picture','','','1','','0','0','1','1437206153','1437206153','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('pcode','商品编号','varchar(255) NOT NULL','string','','商品编号','1','','0','0','1','1437188670','1437188670','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('price','商品价格','int(10) NOT NULL','num','','商品价格','1','','0','0','1','1437188709','1437188709','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('stockcount','库存','int(10) NOT NULL','num','','库存量','1','','0','0','1','1437188743','1437188743','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('cate_id','所属分类','int(10) NOT NULL','select','0','所属分类','1','0:请选择分类','0','0','1','1437205755','1437205009','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('img2','商品图片2','int(10) UNSIGNED NOT NULL','picture','','','1','','0','0','1','1437206268','1437206268','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('img3','商品图片3','int(10) UNSIGNED NOT NULL','picture','','','1','','0','0','1','1437206286','1437206286','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('token','Token','varchar(255) NOT NULL','string','','token','0','','0','0','1','1437227325','1437207808','','3','','regex','get_token','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('describe','商品描述','text NOT NULL','textarea','','','1','','0','0','1','1437305060','1437305060','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;