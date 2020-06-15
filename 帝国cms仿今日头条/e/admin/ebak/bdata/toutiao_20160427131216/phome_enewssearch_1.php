<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewssearch`;");
E_C("CREATE TABLE `phome_enewssearch` (
  `searchid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `keyboard` varchar(255) NOT NULL DEFAULT '',
  `searchtime` int(10) unsigned NOT NULL DEFAULT '0',
  `searchclass` varchar(255) NOT NULL DEFAULT '',
  `result_num` int(10) unsigned NOT NULL DEFAULT '0',
  `searchip` varchar(20) NOT NULL DEFAULT '',
  `classid` varchar(255) NOT NULL DEFAULT '',
  `onclick` int(10) unsigned NOT NULL DEFAULT '0',
  `orderby` varchar(30) NOT NULL DEFAULT '0',
  `myorder` tinyint(1) NOT NULL DEFAULT '0',
  `checkpass` varchar(32) NOT NULL DEFAULT '',
  `tbname` varchar(60) NOT NULL DEFAULT '',
  `tempid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `iskey` tinyint(1) NOT NULL DEFAULT '0',
  `andsql` text NOT NULL,
  `trueclassid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`searchid`),
  KEY `checkpass` (`checkpass`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewssearch` values('1','女童','1459260633','title','2','127.0.0.1','','1','newstime','0','6a6fc778544f9f7e67ae8a628dd8d0c9','news','1','0',' and ((title LIKE ''%女童%''))','0');");
E_D("replace into `phome_enewssearch` values('2','可怕原由','1459260664','title','1','127.0.0.1','','1','newstime','0','b2d374d3d88f6cb4e6307ec65091a1cc','news','1','0',' and ((title LIKE ''%可怕原由%''))','0');");
E_D("replace into `phome_enewssearch` values('3','炮兵','1459348625','title','1','127.0.0.1','','1','newstime','0','55f5ed3b9a85cd974a81c8b287b5fbef','news','1','0',' and ((title LIKE ''%炮兵%''))','0');");
E_D("replace into `phome_enewssearch` values('4','一下','1459349193','title','2','127.0.0.1','','1','newstime','0','46e9d2b6118e80553eb716587f071e20','news','1','0',' and ((title LIKE ''%一下%''))','0');");
E_D("replace into `phome_enewssearch` values('5','中国','1459354756','title','96','127.0.0.1','','2','newstime','0','2251419ed8e24f31fb92af25d6df3a20','news','1','0',' and ((title LIKE ''%中国%''))','0');");
E_D("replace into `phome_enewssearch` values('6','死亡','1459354746','title','5','127.0.0.1','','1','newstime','0','0624bd63e68601e8b5e143259a2b9b18','news','1','0',' and ((title LIKE ''%死亡%''))','0');");

@include("../../inc/footer.php");
?>