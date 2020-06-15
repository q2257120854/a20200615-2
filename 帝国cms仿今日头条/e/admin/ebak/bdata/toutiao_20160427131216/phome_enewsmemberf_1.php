<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsmemberf`;");
E_C("CREATE TABLE `phome_enewsmemberf` (
  `fid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `f` varchar(30) NOT NULL DEFAULT '',
  `fname` varchar(30) NOT NULL DEFAULT '',
  `fform` varchar(20) NOT NULL DEFAULT '',
  `fhtml` mediumtext NOT NULL,
  `fzs` varchar(255) NOT NULL DEFAULT '',
  `myorder` smallint(6) NOT NULL DEFAULT '0',
  `ftype` varchar(30) NOT NULL DEFAULT '',
  `flen` varchar(20) NOT NULL DEFAULT '',
  `fvalue` text NOT NULL,
  `fformsize` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewsmemberf` values('1','truename','真实姓名','text','\r\n<input name=\"truename\" type=\"text\" id=\"truename\" value=\"<?=\$ecmsfirstpost==1?\"\":htmlspecialchars(stripSlashes(\$addr[truename]))?>\">\r\n','','1','VARCHAR','20','','');");
E_D("replace into `phome_enewsmemberf` values('2','oicq','QQ号码','text','<input name=\\\\\"oicq\\\\\" type=\\\\\"text\\\\\" id=\\\\\"oicq\\\\\" value=\\\\\"<?=\$ecmsfirstpost==1?\\\\\"\\\\\":htmlspecialchars(stripSlashes(\$addr[oicq]))?>\\\\\">\r\n','','5','VARCHAR','25','','');");
E_D("replace into `phome_enewsmemberf` values('4','mycall','联系电话','text','<input name=\\\\\"mycall\\\\\" type=\\\\\"text\\\\\" id=\\\\\"mycall\\\\\" value=\\\\\"<?=\$ecmsfirstpost==1?\\\\\"\\\\\":htmlspecialchars(stripSlashes(\$addr[mycall]))?>\\\\\">\r\n','','2','VARCHAR','30','','');");
E_D("replace into `phome_enewsmemberf` values('5','phone','手机','text','<input name=\\\\\"phone\\\\\" type=\\\\\"text\\\\\" id=\\\\\"phone\\\\\" value=\\\\\"<?=\$ecmsfirstpost==1?\\\\\"\\\\\":htmlspecialchars(stripSlashes(\$addr[phone]))?>\\\\\">\r\n','','4','VARCHAR','30','','');");
E_D("replace into `phome_enewsmemberf` values('6','address','联系地址','text','<input name=\\\\\"address\\\\\" type=\\\\\"text\\\\\" id=\\\\\"address\\\\\" value=\\\\\"<?=\$ecmsfirstpost==1?\\\\\"\\\\\":htmlspecialchars(stripSlashes(\$addr[address]))?>\\\\\" size=\\\\\"50\\\\\">\r\n','','9','VARCHAR','255','','');");
E_D("replace into `phome_enewsmemberf` values('9','homepage','网址','text','\r\n<input name=\"homepage\" type=\"text\" id=\"homepage\" value=\"<?=\$ecmsfirstpost==1?\"\":htmlspecialchars(stripSlashes(\$addr[homepage]))?>\">\r\n','','7','VARCHAR','200','','');");
E_D("replace into `phome_enewsmemberf` values('10','saytext','简介','textarea','<textarea name=\\\\\"saytext\\\\\" cols=\\\\\"65\\\\\" rows=\\\\\"10\\\\\" id=\\\\\"saytext\\\\\"><?=\$ecmsfirstpost==1?\\\\\"\\\\\":stripSlashes(\$addr[saytext])?></textarea>\r\n','','11','TEXT','','','');");
E_D("replace into `phome_enewsmemberf` values('11','company','公司名称','text','<input name=\\\\\"company\\\\\" type=\\\\\"text\\\\\" id=\\\\\"company\\\\\" value=\\\\\"<?=\$ecmsfirstpost==1?\\\\\"\\\\\":htmlspecialchars(stripSlashes(\$addr[company]))?>\\\\\" size=\\\\\"38\\\\\">\r\n','','0','VARCHAR','255','','');");
E_D("replace into `phome_enewsmemberf` values('13','userpic','会员头像','img','<input type=\\\\\"file\\\\\" name=\\\\\"userpicfile\\\\\">&nbsp;&nbsp;\r\n<?=empty(\$addr[userpic])?\\\\\"\\\\\":\\\\\"<img src=\\\\''\\\\\".htmlspecialchars(stripSlashes(\$addr[userpic])).\\\\\"\\\\'' border=0>\\\\\"?>','','8','VARCHAR','200','','');");

@include("../../inc/footer.php");
?>