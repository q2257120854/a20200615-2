#影视网数据库结构
DROP TABLE IF EXISTS `ap_addd`;
CREATE TABLE `ap_addd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ad` (`ad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_adduser`;
CREATE TABLE `ap_adduser` (
  `uid` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `time` char(10) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_advert`;
CREATE TABLE `ap_advert` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_app`;
CREATE TABLE `ap_app` (
  `id` int(1) NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_banner`;
CREATE TABLE `ap_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `img` text NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `del` int(11) DEFAULT '1',
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=434 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_baohe`;
CREATE TABLE `ap_baohe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_caiwumx`;
CREATE TABLE `ap_caiwumx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `type` int(11) NOT NULL,
  `addtype` int(55) NOT NULL,
  `time` int(22) NOT NULL,
  `jinqian` varchar(55) DEFAULT NULL,
  `bf1` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_category`;
CREATE TABLE `ap_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) DEFAULT NULL COMMENT '类名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_count`;
CREATE TABLE `ap_count` (
  `day` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_czlog`;
CREATE TABLE `ap_czlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `jybh` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `kami` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_dianka`;
CREATE TABLE `ap_dianka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dianka` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `y` int(1) NOT NULL,
  `cha` int(11) NOT NULL,
  `yid` int(1) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stime` int(11) DEFAULT NULL,
  `sbh` int(11) NOT NULL,
  PRIMARY KEY (`id`,`dianka`),
  UNIQUE KEY `dianka` (`dianka`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_dlmoneylog`;
CREATE TABLE `ap_dlmoneylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(22) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `jine` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_fxtb`;
CREATE TABLE `ap_fxtb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_haiwai`;
CREATE TABLE `ap_haiwai` (
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL,
  `id` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_jiekou`;
CREATE TABLE `ap_jiekou` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_jilu`;
CREATE TABLE `ap_jilu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `time` varchar(255) NOT NULL,
  `ping` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_jpush`;
CREATE TABLE `ap_jpush` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(128) DEFAULT NULL,
  `secret` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_kai`;
CREATE TABLE `ap_kai` (
  `uid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_login_code`;
CREATE TABLE `ap_login_code` (
  `uid` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_mn`;
CREATE TABLE `ap_mn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` text,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_money_get`;
CREATE TABLE `ap_money_get` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL COMMENT '反钱 级别 1 2  3',
  `u_id` int(11) DEFAULT NULL COMMENT '充值代理的用户',
  `get_u_id` int(11) DEFAULT NULL COMMENT '得到钱的用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '反钱的时间',
  `money` int(11) DEFAULT NULL COMMENT '反钱的金额',
  `order_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_moneylog`;
CREATE TABLE `ap_moneylog` (
  `uid` int(11) NOT NULL,
  `money` decimal(11,2) NOT NULL,
  `cid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_pass_log`;
CREATE TABLE `ap_pass_log` (
  `ip` varchar(50) NOT NULL,
  `ctime` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `old_pass` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `aid` int(11) NOT NULL,
  `web` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_pay`;
CREATE TABLE `ap_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outtrade` varchar(200) NOT NULL,
  `trade` varchar(200) NOT NULL,
  `type` char(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `money` decimal(11,2) NOT NULL,
  `trade_status` varchar(100) NOT NULL,
  `pay_type` tinyint(3) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL,
  `kami` varchar(15) DEFAULT NULL,
  `time` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_pay_type`;
CREATE TABLE `ap_pay_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0是充值类型1是代理',
  `image_path` varchar(128) DEFAULT NULL,
  `money` decimal(16,2) NOT NULL DEFAULT '0.00',
  `name` varchar(32) DEFAULT NULL,
  `str_name` varchar(16) DEFAULT NULL COMMENT '字符串',
  `day` int(8) NOT NULL COMMENT '天数',
  `remark` varchar(256) DEFAULT NULL,
  `create_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_ping`;
CREATE TABLE `ap_ping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pinyin` varchar(255) NOT NULL,
  `orderid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_product`;
CREATE TABLE `ap_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL COMMENT '产品名',
  `price` int(11) NOT NULL COMMENT '单价',
  `type` char(10) NOT NULL DEFAULT 'card' COMMENT '种类',
  `image` varchar(255) NOT NULL COMMENT '图片地址',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `detail` text NOT NULL,
  `old_money` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_product_card`;
CREATE TABLE `ap_product_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '产品id',
  `code` varchar(255) NOT NULL COMMENT '兑换码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '使用状态:0,未使用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_product_card_exchange`;
CREATE TABLE `ap_product_card_exchange` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `product_id` int(11) NOT NULL COMMENT '产品id',
  `product_card_id` int(11) NOT NULL COMMENT '兑换码id',
  `code` char(100) NOT NULL COMMENT '兑换码',
  `user` char(100) NOT NULL COMMENT '用户',
  `product_name` char(100) NOT NULL COMMENT '产品名',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_rebate`;
CREATE TABLE `ap_rebate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` int(11) NOT NULL DEFAULT '0',
  `rebate` int(11) NOT NULL DEFAULT '0',
  `rebate2` int(11) NOT NULL DEFAULT '0',
  `rebate3` int(11) NOT NULL DEFAULT '0',
  `rebate4` int(11) NOT NULL DEFAULT '0',
  `rebate5` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_sad`;
CREATE TABLE `ap_sad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `title` varchar(225) NOT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_share`;
CREATE TABLE `ap_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_share_bg`;
CREATE TABLE `ap_share_bg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(256) DEFAULT NULL COMMENT '本地地址',
  `info` varchar(512) DEFAULT NULL,
  `web_url` varchar(256) NOT NULL COMMENT '生成的网络地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_shezi`;
CREATE TABLE `ap_shezi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `jbday` int(11) NOT NULL,
  `jbmoney` int(11) NOT NULL,
  `dljba` int(11) NOT NULL,
  `dljbb` int(11) NOT NULL,
  `dljbc` int(11) NOT NULL,
  `dljbd` int(11) NOT NULL,
  `dljbe` int(11) NOT NULL,
  `fdljb` int(11) NOT NULL,
  `sharefjb` int(11) NOT NULL,
  `ckfa` int(11) NOT NULL,
  `ckfb` int(11) NOT NULL,
  `ckfc` int(11) NOT NULL,
  `ckfd` int(11) NOT NULL,
  `zcjb` int(11) NOT NULL,
  `zcmoney` int(11) NOT NULL,
  `hyfjb1` int(11) NOT NULL,
  `hyfjb2` int(11) NOT NULL,
  `hyfjb3` int(11) NOT NULL,
  `hyfjb4` int(11) NOT NULL,
  `hyfjb5` int(11) NOT NULL,
  `kajg1` int(11) NOT NULL,
  `kajg2` int(11) NOT NULL,
  `kajg3` int(11) NOT NULL,
  `kajg4` int(11) NOT NULL,
  `tiyan` varchar(11) DEFAULT NULL,
  `yueka` varchar(11) DEFAULT NULL,
  `jika` varchar(11) DEFAULT NULL,
  `bannian` varchar(11) DEFAULT NULL,
  `nianka` varchar(11) DEFAULT NULL,
  `yongjiu` varchar(11) DEFAULT NULL,
  `daili` varchar(11) DEFAULT NULL,
  `ckfe` int(11) DEFAULT NULL,
  `ckff` int(11) DEFAULT NULL,
  `apiurl` varchar(256) DEFAULT NULL,
  `key` varchar(256) DEFAULT NULL,
  `partner` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_stop`;
CREATE TABLE `ap_stop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tanchuang`;
CREATE TABLE `ap_tanchuang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `neirong` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `kaiguan` int(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tc`;
CREATE TABLE `ap_tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `remark` text,
  `url` varchar(256) DEFAULT NULL,
  `show` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_timelog`;
CREATE TABLE `ap_timelog` (
  `uid` int(11) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT NULL,
  `day` varchar(11) DEFAULT NULL,
  `lasttime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tixian`;
CREATE TABLE `ap_tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `moneys` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `money_time` int(11) DEFAULT NULL,
  `state` smallint(5) DEFAULT '1' COMMENT '状态1 2  1为未到账 2为以到账',
  `number` text COMMENT '提现账号',
  `name` varchar(40) DEFAULT NULL COMMENT '体现姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tongji`;
CREATE TABLE `ap_tongji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `os` varchar(255) NOT NULL,
  `imei` varchar(255) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tpay_type`;
CREATE TABLE `ap_tpay_type` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0是充值类型1是代理',
  `image_path` varchar(128) DEFAULT NULL,
  `money` decimal(16,2) NOT NULL DEFAULT '0.00',
  `name` varchar(32) DEFAULT NULL,
  `str_name` varchar(16) DEFAULT NULL COMMENT '字符串',
  `day` int(8) NOT NULL COMMENT '天数',
  `remark` varchar(256) DEFAULT NULL,
  `create_time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tuijian`;
CREATE TABLE `ap_tuijian` (
  `id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_tv`;
CREATE TABLE `ap_tv` (
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_txlog`;
CREATE TABLE `ap_txlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(22) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `jine` int(11) NOT NULL,
  `zfb` text NOT NULL,
  `weixin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_user`;
CREATE TABLE `ap_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Source` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nick_name` varchar(255) NOT NULL DEFAULT '',
  `power` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `ctime` int(11) NOT NULL DEFAULT '0',
  `logintime` int(11) NOT NULL DEFAULT '0',
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00',
  `type` int(1) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `sign` int(11) DEFAULT '0',
  `share_ma` varchar(255) DEFAULT NULL,
  `zfb` text NOT NULL,
  `weichat` varchar(255) DEFAULT NULL,
  `url` text,
  `url1` text,
  `url2` text,
  `url3` text,
  `url4` text,
  `url5` text,
  `url6` text,
  `url7` text,
  `key` varchar(255) DEFAULT NULL,
  `tx` int(111) NOT NULL,
  `txje` int(111) NOT NULL,
  `add_switch` int(1) NOT NULL DEFAULT '0' COMMENT '0：关闭1：开启',
  `cate` varchar(255) DEFAULT NULL,
  `qdtime` varchar(255) DEFAULT NULL,
  `jpush_id` varchar(64) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `qx` int(11) ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_video`;
CREATE TABLE `ap_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` text,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_vlist`;
CREATE TABLE `ap_vlist` (
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_zce`;
CREATE TABLE `ap_zce` (
  `phone` varchar(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ap_zhibo`;
CREATE TABLE `ap_zhibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` text,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `chatnote`;
CREATE TABLE `chatnote` (
  `cn_id` int(10) NOT NULL AUTO_INCREMENT,
  `cn_name` varchar(50) DEFAULT NULL,
  `cn_icon` varchar(255) DEFAULT NULL,
  `cn_type` varchar(10) DEFAULT NULL,
  `cn_text` varchar(255) DEFAULT NULL,
  `cn_time` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`cn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;