<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewspl_set`;");
E_C("CREATE TABLE `phome_enewspl_set` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pltime` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plsize` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plincludesize` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plkey_ok` tinyint(1) NOT NULL DEFAULT '0',
  `plface` text NOT NULL,
  `plfacenum` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `plgroupid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plclosewords` text NOT NULL,
  `plf` text NOT NULL,
  `plmustf` text NOT NULL,
  `pldatatbs` text NOT NULL,
  `defpltempid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pl_num` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pldeftb` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plurl` varchar(200) NOT NULL DEFAULT '',
  `plmaxfloor` smallint(5) unsigned NOT NULL DEFAULT '0',
  `plquotetemp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewspl_set` values('1','20','500','0','1','||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||','10','0','','','',',1,','1','12','1','/e/pl/','0','<li class=\\\\\"citem clearfix\\\\\">\r\n			<div class=\\\\\"cavatar\\\\\">\r\n				<a href=\\\\\"#\\\\\" target=\\\\\"_blank\\\\\">\r\n		            <img src=\\\\\"[!--titlepic--]\\\\\" onload=\\\\\"this.style.opacity=1;\\\\\"/>\r\n		        </a>\r\n			</div>\r\n			<div class=\\\\\"cbody\\\\\">\r\n				<div class=\\\\\"cuser\\\\\">\r\n					<a class=\\\\\"cname\\\\\" href=\\\\\"/e/space/?userid=[!--userid--]\\\\\" target=\\\\\"_blank\\\\\">[!--username--]</a>\r\n				</div>\r\n				<div class=\\\\\"ctxt\\\\\">[!--pltext--]</div>\r\n				<div class=\\\\\"cinfo clearfix\\\\\">\r\n					<span class=\\\\\"ctime\\\\\">[!--pltime--]</span>\r\n					<div class=\\\\\"c-actions\\\\\">\r\n						<a class=\\\\\"cdigg \\\\\" href=\\\\\"javascript:;\\\\\"><span class=\\\\\"digg-num\\\\\">[!--plnum--]</span><i class=\\\\\"cbtn\\\\\"></i>\r\n						</a>\r\n						<a class=\\\\\"creply\\\\\" href=\\\\\"javascript:;\\\\\"><i class=\\\\\"cbtn\\\\\"></i></a>\r\n						<a class=\\\\\"creport\\\\\" href=\\\\\"javascript:;\\\\\"><i class=\\\\\"cbtn\\\\\"></i></a>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</li>');");

@include("../../inc/footer.php");
?>