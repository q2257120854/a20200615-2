DROP TABLE IF EXISTS `shua_tools_pay_type`;
CREATE TABLE `shua_tools_pay_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  `data` varchar(255) NOT NULL DEFAULT '',
  `update_time` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_tid` (`tid`) USING HASH
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;