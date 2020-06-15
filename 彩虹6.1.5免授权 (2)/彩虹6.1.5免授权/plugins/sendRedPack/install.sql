CREATE TABLE `shua_plugin_send_red_pack`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '对应规则id',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT '下单IP',
  `userid` varchar(32) NOT NULL DEFAULT '' COMMENT '用户临时id',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '红包类型 1：随机，2：平均',
  `money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '抵扣金额',
  `is_use` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否使用',
  `trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '使用的订单号',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `ind_rule_id`(`rule_id`) USING BTREE,
  INDEX `ind_userid`(`userid`) USING BTREE,
  INDEX `un_trade_no`(`trade_no`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '红包领取及使用记录表';

CREATE TABLE `shua_plugin_send_red_pack_rule` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `rules` longtext,
  `create_time` int(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '红包领取规则表';

ALTER TABLE `shua_pay`
ADD COLUMN `is_red_pack` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用红包抵扣订单' AFTER `trade_no`,
ADD COLUMN `discount_money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '红包抵扣金额' AFTER `is_red_pack`;