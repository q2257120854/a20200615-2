<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsdiggips`;");
E_C("CREATE TABLE `phome_enewsdiggips` (
  `classid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `ips` mediumtext NOT NULL,
  KEY `classid` (`classid`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewsdiggips` values('2','2586',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2656',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2654',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2653',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2652',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2645',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2646',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('4','2643',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('2','2581',',127.0.0.1,');");
E_D("replace into `phome_enewsdiggips` values('21','2662',',127.0.0.1,');");

@include("../../inc/footer.php");
?>