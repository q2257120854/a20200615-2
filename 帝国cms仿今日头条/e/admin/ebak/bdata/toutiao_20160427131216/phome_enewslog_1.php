<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewslog`;");
E_C("CREATE TABLE `phome_enewslog` (
  `loginid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `logintime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `loginip` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(30) NOT NULL DEFAULT '',
  `loginauth` tinyint(1) NOT NULL DEFAULT '0',
  `ipport` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`loginid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewslog` values('1','admin','2016-03-29 19:23:06','127.0.0.1','1','','0','55950');");
E_D("replace into `phome_enewslog` values('2','admin','2016-03-30 01:05:57','127.0.0.1','1','','0','57638');");
E_D("replace into `phome_enewslog` values('3','admin','2016-03-30 18:39:22','127.0.0.1','1','','0','50323');");
E_D("replace into `phome_enewslog` values('4','admin','2016-03-31 18:36:32','127.0.0.1','1','','0','64150');");
E_D("replace into `phome_enewslog` values('5','admin','2016-03-31 20:36:35','127.0.0.1','1','','0','55777');");
E_D("replace into `phome_enewslog` values('6','admin','2016-03-31 23:51:25','127.0.0.1','1','','0','49856');");
E_D("replace into `phome_enewslog` values('7','admin','2016-04-01 00:21:14','127.0.0.1','1','','0','51778');");
E_D("replace into `phome_enewslog` values('8','admin','2016-04-01 00:41:31','127.0.0.1','1','','0','53242');");
E_D("replace into `phome_enewslog` values('9','admin','2016-04-01 18:30:45','127.0.0.1','1','','0','55454');");
E_D("replace into `phome_enewslog` values('10','admin','2016-04-10 20:37:08','127.0.0.1','1','','0','63020');");
E_D("replace into `phome_enewslog` values('11','admin','2016-04-13 18:27:35','127.0.0.1','1','','0','64061');");
E_D("replace into `phome_enewslog` values('12','admin','2016-04-14 19:36:48','127.0.0.1','1','','0','64328');");
E_D("replace into `phome_enewslog` values('13','admin','2016-04-18 19:53:13','127.0.0.1','1','','0','62870');");
E_D("replace into `phome_enewslog` values('14','科技快讯','2016-04-19 23:27:28','127.0.0.1','0','','0','54912');");
E_D("replace into `phome_enewslog` values('15','admin','2016-04-19 23:27:37','127.0.0.1','1','','0','54918');");
E_D("replace into `phome_enewslog` values('16','admin','2016-04-20 18:55:34','127.0.0.1','0','','0','57803');");
E_D("replace into `phome_enewslog` values('17','admin','2016-04-20 18:55:40','127.0.0.1','1','','0','57803');");
E_D("replace into `phome_enewslog` values('18','admin','2016-04-20 19:38:07','127.0.0.1','1','','0','59495');");
E_D("replace into `phome_enewslog` values('19','admin','2016-04-20 19:43:44','127.0.0.1','1','','0','59842');");
E_D("replace into `phome_enewslog` values('20','admin','2016-04-20 20:21:54','127.0.0.1','1','','0','63127');");
E_D("replace into `phome_enewslog` values('21','admin','2016-04-20 22:21:27','127.0.0.1','1','','0','49972');");
E_D("replace into `phome_enewslog` values('22','admin','2016-04-24 20:41:30','127.0.0.1','1','','0','52155');");
E_D("replace into `phome_enewslog` values('23','admin','2016-04-25 18:26:07','127.0.0.1','1','','0','59881');");
E_D("replace into `phome_enewslog` values('24','admin','2016-04-25 19:28:08','127.0.0.1','1','','0','63314');");
E_D("replace into `phome_enewslog` values('25','admin','2016-04-25 20:10:09','127.0.0.1','1','','0','65515');");
E_D("replace into `phome_enewslog` values('26','admin','2016-04-25 20:14:07','127.0.0.1','1','','0','54993');");
E_D("replace into `phome_enewslog` values('27','admin','2016-04-25 20:15:59','127.0.0.1','1','','0','60696');");
E_D("replace into `phome_enewslog` values('28','admin','2016-04-25 20:17:22','127.0.0.1','1','','0','58919');");
E_D("replace into `phome_enewslog` values('29','admin','2016-04-25 20:17:52','127.0.0.1','1','','0','51540');");
E_D("replace into `phome_enewslog` values('30','admin','2016-04-25 20:29:31','127.0.0.1','1','','0','50934');");
E_D("replace into `phome_enewslog` values('31','admin','2016-04-25 20:30:26','127.0.0.1','1','','0','57136');");
E_D("replace into `phome_enewslog` values('32','admin','2016-04-25 20:33:40','127.0.0.1','1','','0','55286');");
E_D("replace into `phome_enewslog` values('33','admin','2016-04-25 20:35:15','127.0.0.1','1','','0','53299');");
E_D("replace into `phome_enewslog` values('34','admin','2016-04-25 20:36:29','127.0.0.1','1','','0','50067');");
E_D("replace into `phome_enewslog` values('35','admin','2016-04-25 20:41:24','127.0.0.1','1','','0','62934');");
E_D("replace into `phome_enewslog` values('36','admin','2016-04-25 20:44:35','127.0.0.1','1','','0','63191');");
E_D("replace into `phome_enewslog` values('37','admin','2016-04-25 22:57:40','127.0.0.1','1','','0','53726');");
E_D("replace into `phome_enewslog` values('38','admin','2016-04-27 12:53:22','127.0.0.1','1','','0','55791');");
E_D("replace into `phome_enewslog` values('39','admin','2016-04-27 13:09:25','127.0.0.1','1','','0','56684');");
E_D("replace into `phome_enewslog` values('40','admin','2016-06-30 20:03:19','127.0.0.1','1','','0','58482');");
E_D("replace into `phome_enewslog` values('41','admin','2016-06-30 20:56:07','127.0.0.1','1','','0','60293');");

@include("../../inc/footer.php");
?>