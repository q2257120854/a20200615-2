<?php
error_reporting(E_ALL ^ E_NOTICE);

@set_time_limit(10000);

require('../../../class/connect.php');
require('../../../class/db_sql.php');
require('../../../class/functions.php');
$link=db_connect();
$empire=new mysqlquery();
$editor=2;

if($_GET['ecms']=="install")
{
	$doinstall=$_GET['doinstall'];
	if($doinstall=='install')//安装操作
	{
		include('install.php');
		$word='已安装完毕!';
	}
	elseif($doinstall=='uninstall')//卸载操作
	{
		include('uninstall.php');
		$word='已卸载完毕!';
	}
	echo"QQ登录插件 $word";
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>帝国CMS－QQ登录插件安装/卸载程序</title>
<style>
a:link     { COLOR: #000000; TEXT-DECORATION: none }
a:visited   { COLOR: #000000 ; TEXT-DECORATION: none }
a:active   { COLOR: #000000 ; TEXT-DECORATION: underline }
a:hover    { COLOR: #000000 ; TEXT-DECORATION:underline }
.home_top { border-top:2px solid #4798ED; }
.home_path { background:#4798ED; padding-right:10px; color:#F0F0F0; font-size: 11px; }
td, th, caption { font-family:  "宋体"; font-size: 14px; color:#000000;  LINE-HEIGHT: 165%; }
.hrLine{MARGIN: 0px 0px; BORDER-BOTTOM: #807d76 1px dotted;}
</style>
<script>
function CheckUpdate(obj){
	if(confirm('确认操作?'))
	{
		obj.updatebutton.disabled=true;
		return true;
	}
	return false;
}
</script>
</head>
<body>
<form method="GET" action="index.php" name="formupdate" onsubmit="return CheckUpdate(document.formupdate);">
  <br>
  <br>
  <br>
  <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#4FB4DE">
    <tr> 
      <td height="30" colspan="2"> <div align="center"><strong><font color="#FFFFFF">帝国CMS－QQ登录插件安装/卸载程序</font></strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="141" height="36"> 
        <div align="right">选择操作：</div></td>
      <td width="344"> <input name="doinstall" type="radio" value="install" checked>
        安装 
        <input type="radio" name="doinstall" value="uninstall">
        卸载</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="30"> 
        <div align="center"></div></td>
      <td> <input type=submit name=updatebutton value="提交操作"> <input name="ecms" type="hidden" id="ecms" value="install"> 
      </td>
    </tr>
  </table>
  </form>
  </body>
  </html>