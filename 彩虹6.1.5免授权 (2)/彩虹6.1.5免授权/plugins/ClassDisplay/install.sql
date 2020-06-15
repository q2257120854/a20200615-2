DROP TABLE IF EXISTS `shua_class_region`;
CREATE TABLE `shua_class_region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned DEFAULT '0' COMMENT '分类',
  `region` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '区域集合',
  `update_time` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ind_cid` (`cid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;