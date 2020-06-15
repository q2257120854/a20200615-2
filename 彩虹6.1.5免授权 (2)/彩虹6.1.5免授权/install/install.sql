DROP TABLE IF EXISTS `shua_config`;
CREATE TABLE `shua_config` (
  `k` varchar(32) NOT NULL,
  `v` text NULL,
  PRIMARY KEY  (`k`) USING HASH
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_admin_member`;
CREATE TABLE `shua_admin_member` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(128) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL COMMENT '密码 sha256(sha256(password)+salt)',
  `salt` varchar(6) NOT NULL COMMENT '6位数的散列',
  `whiteUrl` text NULL COMMENT '白名单列表',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  INDEX `username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_article_list`;
CREATE TABLE `shua_article_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(128) NOT NULL COMMENT '文章标题',
  `content` text COMMENT '文章内容',
  `author` varchar(128) NOT NULL COMMENT '作者名称',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文章状态 0 不发布 1 发布',
  `imageUrl` varchar(500) DEFAULT NULL COMMENT '文章缩略图',
  `seoTitle` varchar(255) DEFAULT NULL COMMENT 'SEO 标题',
  `seoKeywords` varchar(255) DEFAULT NULL COMMENT 'SEO 关键词',
  `seoDescription` text COMMENT 'SEO 描述',
  `createTime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`),
  INDEX `status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO `shua_config` VALUES ('cache', '');
INSERT INTO `shua_config` VALUES ('version', '8.7.8');
INSERT INTO `shua_config` VALUES ('admin_user', 'admin');
INSERT INTO `shua_config` VALUES ('admin_pwd', '123456');
INSERT INTO `shua_config` VALUES ('alipay_api', '2');
INSERT INTO `shua_config` VALUES ('tenpay_api', '2');
INSERT INTO `shua_config` VALUES ('qqpay_api', '2');
INSERT INTO `shua_config` VALUES ('wxpay_api', '2');
INSERT INTO `shua_config` VALUES ('style', '1');
INSERT INTO `shua_config` VALUES ('cdnpublic', '1');
INSERT INTO `shua_config` VALUES ('sitename', 'QQ代刷网');
INSERT INTO `shua_config` VALUES ('keywords', 'QQ代刷网,QQ云商城,代刷网,自助下单,网红助手,网红速成');
INSERT INTO `shua_config` VALUES ('description', 'QQ代刷网，专业提供国内网红速方案，帮您走出网红的第一步，我们提供最专业的售前指导，提供最优质的售后服务，给您一个放心的平台！');
INSERT INTO `shua_config` VALUES ('kfqq', '123456789');
INSERT INTO `shua_config` VALUES ('anounce', '<p>
<li class="list-group-item"><span class="btn btn-danger btn-xs">1</span> QQ名片赞日刷上万，超快空间人气日刷百万，球球冰红茶CDK超低价销售</li>
<li class="list-group-item"><span class="btn btn-success btn-xs">2</span> 温馨提示：请勿重复下单哦！必须要等待前面任务订单完成才可以下单！</li>
<li class="list-group-item"><span class="btn btn-info btn-xs">3</span> 下单之前请一定要看完该商品的注意事项再进行下单！</li>
<li class="list-group-item"><span class="btn btn-warning btn-xs">4</span> 所有业务全部恢复，都可以正常下单，欢迎尝试，有问题可以联系客服</li>
<li class="list-group-item"><span class="btn btn-primary btn-xs">5</span> 一般下单后会在1-30分钟内提交到服务器，就让单子来的更猛烈些吧！</li>
<div class="btn-group btn-group-justified">
<a target="_blank" class="btn btn-info" href="http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes"><i class="fa fa-qq"></i>联系客服</a>
<a target="_blank" class="btn btn-warning" href="http://qun.qq.com/join.html"><i class="fa fa-users"></i> 官方Q群</a>
<a target="_blank" class="btn btn-danger" href="./"><i class="fa fa-cloud-download"></i> APP下载</a>
</div></p>');
INSERT INTO `shua_config` VALUES ('kaurl', '');
INSERT INTO `shua_config` VALUES ('modal', '');
INSERT INTO `shua_config` VALUES ('bottom', '<table class="table table-bordered">
<tbody>
<tr height="50">
<td><button type="button" class="btn btn-block btn-warning"><a href="" target="_blank"><span style="color:#ffffff">♚导航♚</span></a></button></td>
<td><button type="button" class="btn btn-block btn-warning"><a href="./" target="_blank"><span style="color:#ffffff">♚导航♚</span></a></button></td>
</tr>
<tr height="50">
<td><button type="button" class="btn btn-block btn-success"><a href="./" target="_blank"><span style="color:#ffffff">♚友链♚</span></a></button></td>
<td><button type="button" class="btn btn-block btn-success"><a href="./" target="_blank"><span style="color:#ffffff">♚友链♚</span></a></button></td>
</tr></tbody>
</table>');
INSERT INTO `shua_config` VALUES ('gg_search', '<span class="label label-primary">待处理</span>说明正在努力提交到服务器！<p></p><p></p><span class="label label-success">已完成</span>并不是刷完了只是开始刷了！<p></p><p></p><span class="label label-warning">处理中</span>已经开始为您开单 请耐心等！<p></p><p></p><span class="label label-danger">有异常</span>下单信息有误，联系客服处理！');
INSERT INTO `shua_config` VALUES ('chatframe', '');
INSERT INTO `shua_config` VALUES ('fenzhan_expiry', '12');
INSERT INTO `shua_config` VALUES ('fenzhan_tixian', '0');
INSERT INTO `shua_config` VALUES ('fenzhan_buy', '1');
INSERT INTO `shua_config` VALUES ('fenzhan_price', '10');
INSERT INTO `shua_config` VALUES ('fenzhan_price2', '20');
INSERT INTO `shua_config` VALUES ('fenzhan_free', '0');
INSERT INTO `shua_config` VALUES ('tixian_rate', '90');
INSERT INTO `shua_config` VALUES ('tixian_min', '10');
INSERT INTO `shua_config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `shua_config` VALUES ('mail_port', '465');
INSERT INTO `shua_config` VALUES ('template', 'simple');
INSERT INTO `shua_config` VALUES ('verify_open', '1');
INSERT INTO `shua_config` VALUES ('user_open', '1');
INSERT INTO `shua_config` VALUES ('gift_open', '0');
INSERT INTO `shua_config` VALUES ('cishu', '3');
INSERT INTO `shua_config` VALUES ('tongji_time', '300');
INSERT INTO `shua_config` VALUES ('ui_background', '3');
INSERT INTO `shua_config` VALUES ('faka_mail', '<b>商品名称：</b> [name]<br/><b>购买时间：</b>[date]<br/><b>以下是你的卡密信息：</b><br/>[kmdata]<br/>----------<br/><b>使用说明：</b><br/>[alert]<br/>----------<br/>QQ代刷网自助下单平台<br/>[domain]');
INSERT INTO `shua_config` VALUES ('qiandao_reward', '0.02');
INSERT INTO `shua_config` VALUES ('qiandao_mult', '1.05');
INSERT INTO `shua_config` VALUES ('qiandao_day', '15');
INSERT INTO `shua_config` VALUES ('pricejk_time', '600');
INSERT INTO `shua_config` VALUES ('shoppingcart', '1');
INSERT INTO `shua_config` VALUES ('search_open', '1');
INSERT INTO `shua_config` VALUES ('captcha_open_free', '1');
INSERT INTO `shua_config` VALUES ('captcha_open_reg', '1');
INSERT INTO `shua_config` VALUES ('epay_notify_verify', '1');

DROP TABLE IF EXISTS `shua_cache`;
create table `shua_cache` (
`k` varchar(32) NOT NULL,
`v` longtext NULL,
PRIMARY KEY  (`k`) USING HASH
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_class`;
CREATE TABLE `shua_class` (
  `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `sort` int(11) NOT NULL DEFAULT 10,
  `name` varchar(255) NOT NULL,
  `shopimg` text DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_tools`;
CREATE TABLE `shua_tools` (
  `tid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `cid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 10,
  `name` varchar(255) NOT NULL,
  `value` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `attr_shield_type` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prid` int(11) NOT NULL DEFAULT 0,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prices` VARCHAR(100) DEFAULT NULL,
  `input` varchar(250) NOT NULL,
  `inputs` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `alert` text DEFAULT NULL,
  `shopimg` text DEFAULT NULL,
  `validate` tinyint(2) NOT NULL DEFAULT 0,
  `permission` tinyint(2) NOT NULL DEFAULT 0,
  `min` int(11) NOT NULL DEFAULT 0,
  `max` int(11) NOT NULL DEFAULT 0,
  `is_curl` tinyint(2) NOT NULL DEFAULT 0,
  `curl` varchar(255) DEFAULT NULL,
  `repeat` tinyint(2) NOT NULL DEFAULT 0,
  `multi` tinyint(1) NOT NULL DEFAULT 0,
  `shequ` int(3) NOT NULL DEFAULT 0,
  `goods_id` int(11) NOT NULL DEFAULT 0,
  `goods_type` int(11) NOT NULL DEFAULT 0,
  `goods_param` varchar(180) DEFAULT NULL,
  `close` tinyint(2) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `uptime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tid`),
  INDEX `cid` (`cid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_price`;
CREATE TABLE `shua_price`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `kind` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 倍数 1 价格',
  `name` varchar(255) NOT NULL,
  `p_0` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_1` decimal(8,2) NOT NULL DEFAULT '0.00',
  `p_2` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_orders`;
CREATE TABLE `shua_orders` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT 0,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `input` varchar(500) NOT NULL,
  `input2` varchar(500) DEFAULT NULL,
  `input3` varchar(500) DEFAULT NULL,
  `input4` varchar(500) DEFAULT NULL,
  `input5` varchar(500) DEFAULT NULL,
  `value` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `djzt` tinyint(2) NOT NULL DEFAULT 0,
  `djorder` varchar(32) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE,
  INDEX `input` (`input`) USING BTREE,
  INDEX `userid` (`userid`) USING BTREE,
  INDEX `tradeno` (`tradeno`) USING BTREE,
  INDEX `id` (`id`) USING BTREE,
  INDEX `tid` (`tid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_kms`;
CREATE TABLE `shua_kms` (
  `kid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(11) UNSIGNED NOT NULL,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `km` varchar(255) NOT NULL,
  `value` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  `money` varchar(32) DEFAULT NULL,
  `orderid` int(11) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`kid`),
  INDEX `tid`(`tid`) USING BTREE,
  INDEX `zid`(`zid`) USING BTREE,
  INDEX `orderid`(`orderid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_faka`;
CREATE TABLE `shua_faka` (
  `kid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(11) UNSIGNED NOT NULL,
  `km` varchar(255) DEFAULT NULL,
  `pw` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `usetime` datetime DEFAULT NULL,
  `orderid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`kid`),
  INDEX `tid`(`tid`) USING BTREE,
  INDEX `orderid`(`orderid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_pay`;
CREATE TABLE `shua_pay` (
  `trade_no` varchar(64) NOT NULL,
  `is_red_pack` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用红包抵扣订单',
  `discount_money` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '红包抵扣金额',
  `type` varchar(20) NULL,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `name` varchar(64) NULL,
  `money` varchar(32) NULL,
  `ip` varchar(20) NULL,
  `userid` varchar(32) DEFAULT NULL,
  `inviteid` int(11) UNSIGNED DEFAULT NULL,
  `domain` varchar(64) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`trade_no`),
  INDEX `tradeNo` (`trade_no`) USING BTREE,
  INDEX `zid`(`zid`) USING BTREE,
  INDEX `tid`(`tid`) USING BTREE
) ENGINE=InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_site`;
CREATE TABLE `shua_site` (
  `zid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `upzid` int(11) unsigned NOT NULL DEFAULT '0',
  `utype` int(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `domain` varchar(50) DEFAULT NULL,
  `domain2` varchar(50) DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `rmb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `point` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) DEFAULT NULL,
  `pay_name` varchar(50) DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `sitename` varchar(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `kaurl` varchar(50) DEFAULT NULL,
  `anounce` text DEFAULT NULL,
  `bottom` text DEFAULT NULL,
  `modal` text DEFAULT NULL,
  `alert` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `iprice` text DEFAULT NULL,
  `ktfz_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_price2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ktfz_domain` text DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `lasttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `template` varchar(64) DEFAULT NULL,
  `msgread` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `class` text,
  PRIMARY KEY (`zid`),
  INDEX `domain` (`domain`) USING BTREE,
  INDEX `domain2` (`domain2`) USING BTREE,
  INDEX `user` (`user`) USING BTREE,
  INDEX `pwd` (`pwd`) USING BTREE,
  INDEX `qq` (`qq`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_tixian`;
CREATE TABLE `shua_tixian` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `pay_account` varchar(50) NOT NULL,
  `pay_name` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE,
  INDEX `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_points`;
CREATE TABLE `shua_points` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '0',
  `action` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bz` varchar(1024) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `orderid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_shequ`;
CREATE TABLE `shua_shequ` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `paypwd` varchar(255) DEFAULT NULL,
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_logs`;
CREATE TABLE `shua_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(32) NOT NULL,
  `param` varchar(255) NOT NULL,
  `result` text DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_gift`;
CREATE TABLE `shua_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `tid` int(11) unsigned NOT NULL,
  `rate` int(3) NOT NULL,
  `ok` tinyint(1) NOT NULL DEFAULT 0,
  `not` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_giftlog`;
CREATE TABLE `shua_giftlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT 0,
  `tid` int(11) unsigned NOT NULL,
  `gid` int(11) unsigned NOT NULL,
  `userid` varchar(32) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `tradeno` varchar(32) DEFAULT NULL,
  `input` varchar(64) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_invite`;
CREATE TABLE `shua_invite`(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `input` text,
  `tid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `qq` varchar(20) NOT NULL DEFAULT '',
  `key` varchar(30) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `date` datetime NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `key` (`key`) USING HASH
) ENGINE=InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '分享推广商品表';

DROP TABLE IF EXISTS `shua_invitelog`;
CREATE TABLE `shua_invitelog`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nid` int(11) UNSIGNED NOT NULL,
  `zid` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `orderid` int(11) unsigned DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_qiandao`;
CREATE TABLE `shua_qiandao`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `qq` VARCHAR(20) DEFAULT NULL,
  `reward` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `continue` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_message`;
CREATE TABLE `shua_message`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `color` VARCHAR(20) DEFAULT NULL,
  `addtime` datetime NOT NULL,
  `count` int(11) unsigned NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_workorder`;
CREATE TABLE `shua_workorder`(
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `type` int(1) unsigned NOT NULL DEFAULT '0',
  `orderid` int(11) unsigned NOT NULL DEFAULT '0',
  `content` TEXT NOT NULL,
  `addtime` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `zid` (`zid`) USING BTREE,
  INDEX `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS `shua_cart`;
CREATE TABLE `shua_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) NOT NULL,
  `zid` int(11) unsigned NOT NULL DEFAULT '1',
  `tid` int(11) NOT NULL,
  `input` text NOT NULL,
  `num` int(11) unsigned NOT NULL DEFAULT '1',
  `money` varchar(32) NULL,
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `userid` (`userid`) USING BTREE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `shua_invite_rules`;
CREATE TABLE `shua_invite_rules` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分享类型：0：下单金额，1：累计访问',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0：关闭，1：开启',
  `is_default` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否默认推广商品，0：否，1：是',
  `rule_value` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '规则的值：type为0：金额，1：累计访问数',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `un_tid` (`tid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '商品分享规则表';

DROP TABLE IF EXISTS `shua_site_attr`;
CREATE TABLE `shua_site_attr`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `zid` int(11) UNSIGNED NOT NULL COMMENT '分站id 也可以称为uid',
  `attrKey` varchar(100) NOT NULL COMMENT '键名',
  `attrValue` text NULL COMMENT '内容',
  `createTime` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `zid`(`zid`, `attrKey`) USING BTREE
);

DROP TABLE IF EXISTS `shua_unusual_ip_log`;
CREATE TABLE `shua_unusual_ip_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `attrKey` varchar(100) NOT NULL COMMENT '键值',
  `ip` varchar(48) NOT NULL COMMENT 'Ipv4 或 Ipv6',
  `count` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '计数',
  `updateTime` int(11) UNSIGNED NOT NULL COMMENT '最后保存时间',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `search1`(`attrKey`, `ip`) USING BTREE
);