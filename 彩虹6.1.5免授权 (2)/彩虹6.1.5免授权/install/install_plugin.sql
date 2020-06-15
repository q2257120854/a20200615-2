DROP TABLE IF EXISTS `shua_addons`;
CREATE TABLE `shua_addons` (
  `addon_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` datetime NOT NULL COMMENT '安装时间',
  `data_flag` tinyint(4) DEFAULT '1',
  `is_config` tinyint(4) DEFAULT '0',
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`addon_id`),
  UNIQUE INDEX `name` (`name`) USING HASH
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;
DROP TABLE IF EXISTS `shua_hooks`;
CREATE TABLE `shua_hooks` (
  `hook_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `hook_remarks` text NOT NULL COMMENT '描述',
  `hook_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `addons` text,
  PRIMARY KEY (`hook_id`),
  UNIQUE INDEX `name` (`name`) USING HASH
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('afterUserLogin', '用户登录后', 1, '2019-11-19 12:10:25');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('addAdminMenu', '在后台页面增加菜单', 1, '2019-11-28 16:54:01');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('userTabLabel', '用户首页TAB标签', 1, '2019-12-03 16:22:14');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('addClassHandle', '添加商品分类操作', 1, '2019-12-16 14:34:22');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('adminClassPageReady', '商品分类页面加载完成后', 1, '2019-12-17 14:59:01');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('adminAjaxFunction', '调用后台异步函数', 2, '2019-12-17 16:44:56');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('userAjaxFunction', '调用前台异步函数', 2, '2019-12-17 16:46:01');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('publicAjaxFunction', '调用公共异步函数', 2, '2019-12-17 16:47:08');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('homeLoaded', '首页加载后', 1, '2019-12-18 10:30:55');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('beforeOrderSubmit', '订单提交之前', 1, '2019-12-19 14:28:27');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('beforeCartOrderSubmit', '购物车订单提交之前', 1, '2019-12-19 15:19:46');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('productEditDetail', '商品编辑详细信息', 1, '2019-12-19 15:55:56');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('afterProductEdit', '商品编辑之后', 1, '2019-12-19 16:26:28');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('beforeBuyCommodityHome', '首页购买商品之前', 1, '2020-01-17 11:01:46');
INSERT INTO `shua_hooks`(`name`, `hook_remarks`, `hook_type`, `update_time`) VALUES ('beforeOrderCancel', '订单取消之前', 1, '2020-01-17 18:19:53');