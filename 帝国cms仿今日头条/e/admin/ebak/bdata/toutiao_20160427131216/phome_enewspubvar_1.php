<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewspubvar`;");
E_C("CREATE TABLE `phome_enewspubvar` (
  `varid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `myvar` varchar(60) NOT NULL DEFAULT '',
  `varname` varchar(20) NOT NULL DEFAULT '',
  `varvalue` text NOT NULL,
  `varsay` varchar(255) NOT NULL DEFAULT '',
  `myorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `classid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tocache` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`),
  KEY `classid` (`classid`),
  KEY `tocache` (`tocache`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewspubvar` values('1','sitetitle','网站简称','仿今日头条','网站简称','0','0','1');");
E_D("replace into `phome_enewspubvar` values('2','siteurl','网址地址','http://test.dede168.com/','带http:// , 后边带斜杠 /','0','0','1');");
E_D("replace into `phome_enewspubvar` values('3','beian','备案号','京公网安备 11010802020116号','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('4','jubao','举报邮箱','xxx@xxx.com','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('5','tj','统计代码','统计代码填到这里','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('6','wapurl','手机版地址','http://m.test.dede168.com','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('7','ftitle','副标题','你关心的，才是头条！','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('8','shorturl','不带http://的短域名','TouTiao.com','前边不带http://，后边不带斜杠','0','0','1');");
E_D("replace into `phome_enewspubvar` values('11','changyanid','畅言conf ID','prod_8d01521f822b32f1a30f058371f6eeef','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('12','changyan_client_id','畅言client_id','cys3T11v7','','0','0','1');");

@include("../../inc/footer.php");
?>