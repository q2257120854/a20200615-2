<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsclass`;");
E_C("CREATE TABLE `phome_enewsclass` (
  `classid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bclassid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `classname` varchar(50) NOT NULL DEFAULT '',
  `sonclass` text NOT NULL,
  `is_zt` tinyint(1) NOT NULL DEFAULT '0',
  `lencord` smallint(6) NOT NULL DEFAULT '0',
  `link_num` tinyint(4) NOT NULL DEFAULT '0',
  `newstempid` smallint(6) NOT NULL DEFAULT '0',
  `onclick` int(11) NOT NULL DEFAULT '0',
  `listtempid` smallint(6) NOT NULL DEFAULT '0',
  `featherclass` text NOT NULL,
  `islast` tinyint(1) NOT NULL DEFAULT '0',
  `classpath` text NOT NULL,
  `classtype` varchar(10) NOT NULL DEFAULT '',
  `newspath` varchar(20) NOT NULL DEFAULT '',
  `filename` tinyint(1) NOT NULL DEFAULT '0',
  `filetype` varchar(10) NOT NULL DEFAULT '',
  `openpl` tinyint(1) NOT NULL DEFAULT '0',
  `openadd` tinyint(1) NOT NULL DEFAULT '0',
  `newline` int(11) NOT NULL DEFAULT '0',
  `hotline` int(11) NOT NULL DEFAULT '0',
  `goodline` int(11) NOT NULL DEFAULT '0',
  `classurl` varchar(200) NOT NULL DEFAULT '',
  `groupid` smallint(6) NOT NULL DEFAULT '0',
  `myorder` smallint(6) NOT NULL DEFAULT '0',
  `filename_qz` varchar(20) NOT NULL DEFAULT '',
  `hotplline` tinyint(4) NOT NULL DEFAULT '0',
  `modid` smallint(6) NOT NULL DEFAULT '0',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `firstline` tinyint(4) NOT NULL DEFAULT '0',
  `bname` varchar(50) NOT NULL DEFAULT '',
  `islist` tinyint(1) NOT NULL DEFAULT '0',
  `searchtempid` smallint(6) NOT NULL DEFAULT '0',
  `tid` smallint(6) NOT NULL DEFAULT '0',
  `tbname` varchar(60) NOT NULL DEFAULT '',
  `maxnum` int(11) NOT NULL DEFAULT '0',
  `checkpl` tinyint(1) NOT NULL DEFAULT '0',
  `down_num` tinyint(4) NOT NULL DEFAULT '0',
  `online_num` tinyint(4) NOT NULL DEFAULT '0',
  `listorder` varchar(50) NOT NULL DEFAULT '',
  `reorder` varchar(50) NOT NULL DEFAULT '',
  `intro` text NOT NULL,
  `classimg` varchar(255) NOT NULL DEFAULT '',
  `jstempid` smallint(6) NOT NULL DEFAULT '0',
  `addinfofen` int(11) NOT NULL DEFAULT '0',
  `listdt` tinyint(1) NOT NULL DEFAULT '0',
  `showclass` tinyint(1) NOT NULL DEFAULT '0',
  `showdt` tinyint(1) NOT NULL DEFAULT '0',
  `checkqadd` tinyint(1) NOT NULL DEFAULT '0',
  `qaddlist` tinyint(1) NOT NULL DEFAULT '0',
  `qaddgroupid` text NOT NULL,
  `qaddshowkey` tinyint(1) NOT NULL DEFAULT '0',
  `adminqinfo` tinyint(1) NOT NULL DEFAULT '0',
  `doctime` smallint(6) NOT NULL DEFAULT '0',
  `classpagekey` varchar(255) NOT NULL DEFAULT '',
  `dtlisttempid` smallint(6) NOT NULL DEFAULT '0',
  `classtempid` smallint(6) NOT NULL DEFAULT '0',
  `nreclass` tinyint(1) NOT NULL DEFAULT '0',
  `nreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `nrejs` tinyint(1) NOT NULL DEFAULT '0',
  `nottobq` tinyint(1) NOT NULL DEFAULT '0',
  `ipath` varchar(255) NOT NULL DEFAULT '',
  `addreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `haddlist` tinyint(4) NOT NULL DEFAULT '0',
  `sametitle` tinyint(1) NOT NULL DEFAULT '0',
  `definfovoteid` smallint(6) NOT NULL DEFAULT '0',
  `wburl` varchar(255) NOT NULL DEFAULT '',
  `qeditchecked` tinyint(1) NOT NULL DEFAULT '0',
  `wapstyleid` smallint(6) NOT NULL DEFAULT '0',
  `repreinfo` tinyint(1) NOT NULL DEFAULT '0',
  `pltempid` smallint(6) NOT NULL DEFAULT '0',
  `cgroupid` text NOT NULL,
  `yhid` smallint(6) NOT NULL DEFAULT '0',
  `wfid` smallint(6) NOT NULL DEFAULT '0',
  `cgtoinfo` tinyint(1) NOT NULL DEFAULT '0',
  `bdinfoid` varchar(25) NOT NULL DEFAULT '',
  `repagenum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `keycid` smallint(6) NOT NULL DEFAULT '0',
  `allinfos` int(10) unsigned NOT NULL DEFAULT '0',
  `infos` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`),
  KEY `bclassid` (`bclassid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewsclass` values('1','0','热点','','0','25','10','11','0','9','','1','news_hot','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_hot','1','1','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','1','','0','0','0','','0','0','1','1','1459250677');");
E_D("replace into `phome_enewsclass` values('2','0','社会','','0','25','10','11','0','9','','1','news_society','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_society','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','71','71','1459250841');");
E_D("replace into `phome_enewsclass` values('3','0','娱乐','','0','25','10','11','0','9','','1','news_entertainment','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_entertainment','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','56','56','1459252601');");
E_D("replace into `phome_enewsclass` values('4','0','科技','','0','25','10','11','0','9','','1','news_tech','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_tech','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','1','0','0','0','','0','0','0','','0','0','140','140','1459334400');");
E_D("replace into `phome_enewsclass` values('5','0','汽车','','0','25','10','11','0','9','','1','news_car','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_car','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','81','81','1459334418');");
E_D("replace into `phome_enewsclass` values('6','0','体育','','0','25','10','11','0','9','','1','news_sports','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_sports','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','79','79','1459334437');");
E_D("replace into `phome_enewsclass` values('7','0','财经','','0','25','10','11','0','9','','1','news_finance','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_finance','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','82','82','1459334456');");
E_D("replace into `phome_enewsclass` values('8','0','军事','','0','25','10','11','0','9','','1','news_military','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_military','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','81','81','1459334473');");
E_D("replace into `phome_enewsclass` values('9','0','国际','','0','25','10','11','0','9','','1','news_world','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_world','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','67','67','1459334497');");
E_D("replace into `phome_enewsclass` values('10','0','时尚','','0','25','10','11','0','9','','1','news_fashion','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_fashion','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','45','45','1459334518');");
E_D("replace into `phome_enewsclass` values('11','0','旅游','','0','25','10','11','0','9','','1','news_travel','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_travel','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','0','0','1459334539');");
E_D("replace into `phome_enewsclass` values('12','0','探索','','0','25','10','11','0','9','','1','news_discovery','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_discovery','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','11','11','1459334565');");
E_D("replace into `phome_enewsclass` values('13','0','育儿','','0','25','10','11','0','9','','1','news_baby','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_baby','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','85','85','1459334584');");
E_D("replace into `phome_enewsclass` values('14','0','养生','','0','25','10','11','0','9','','1','news_regimen','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_regimen','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','19','19','1459334604');");
E_D("replace into `phome_enewsclass` values('15','0','故事','','0','25','10','11','0','9','','1','news_story','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_story','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','12','12','1459334623');");
E_D("replace into `phome_enewsclass` values('16','0','美文','','0','25','10','11','0','9','','1','news_essay','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_essay','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','15','15','1459334644');");
E_D("replace into `phome_enewsclass` values('17','0','游戏','','0','25','10','11','0','9','','1','news_game','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_game','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','84','84','1459334662');");
E_D("replace into `phome_enewsclass` values('18','0','历史','','0','25','10','11','0','9','','1','news_history','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_history','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','24','24','1459334684');");
E_D("replace into `phome_enewsclass` values('19','0','美食','','0','25','10','11','0','9','','1','news_food','.html','','0','.html','0','0','10','10','10','','0','0','','10','1','1','10','news_food','1','0','1','news','0','1','2','2','id DESC','newstime DESC','','','1','0','0','0','0','1','0',',1,3,2,4,','0','2','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','0','0','','0','0','0','','0','0','54','54','1459334719');");
E_D("replace into `phome_enewsclass` values('21','0','公告(隐藏)','','0','25','10','11','0','9','','1','gonggao','.html','','0','.html','1','1','10','10','10','','0','0','','10','1','1','10','公告','1','0','1','news','0','1','2','2','id DESC','newstime DESC','网站公告','','1','0','0','1','0','1','0',',1,3,2,4,','0','0','0','','9','1','0','0','0','0','','1','0','1','0','','0','0','1','0','','0','0','0','','0','0','1','1','1461240496');");

@include("../../inc/footer.php");
?>