<?php
require("../../class/connect.php");
eCheckCloseMods('pl');//关闭模块
$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
$num=(int)$_GET['num'];
if($num<1||$num>80)
{
	$num=10;
}
$doaction=$_GET['doaction']=='dozt'?'dozt':'';
require("../../class/db_sql.php");
require("../../class/q_functions.php");
$link=db_connect();
$empire=new mysqlquery();
//专题
if($doaction=='dozt')
{
	if(empty($classid))
	{
		exit();
	}
	//信息
	$infor=$empire->fetch1("select ztid,restb from {$dbtbpre}enewszt where ztid='$classid' limit 1");
	if(!$infor['ztid'])
	{
		exit();
	}
	$pubid='-'.$classid;
}
else
{
	if(empty($id)||empty($classid))
	{
		exit();
	}
	include("../../data/dbcache/class.php");
	if(empty($class_r[$classid]['tbname']))
	{
		exit();
	}
	//信息
	$infor=$empire->fetch1("select classid,restb from {$dbtbpre}ecms_".$class_r[$classid]['tbname']." where id='$id' limit 1");
	if(!$infor['classid']||$infor['classid']!=$classid)
	{
		exit();
	}
	$pubid=ReturnInfoPubid($classid,$id);
}
//排序
$addorder='plid desc';
$myorder=(int)$_GET['myorder'];
if($myorder==1)
{
	$addorder='plid';
}
$p=$_GET['p']?$_GET['p']:1;
$start=($p-1)*$num;

$sql=$empire->query("select * from {$dbtbpre}enewspl_".$infor['restb']." where id='$id' and checked=0 order by ".$addorder." limit ".$start.",".$num);

while($r=$empire->fetch($sql))
{
	$plusername=$r[username];
	if(empty($r[username]))
	{
		$plusername='匿名';
	}
	$userpic=array();
	if($r[userid])
	{	
		$plusername="$r[username]";
		$sql2=$empire->query("select userpic from {$dbtbpre}enewsmemberadd where userid='{$r[userid]}' limit 1");
		$userpic = $empire->fetch($sql2);
		
	}
	$saytime=date('Y-m-d H:i:s',$r['saytime']);
	//ip
	$sayip=ToReturnXhIp($r[sayip]);
	$saytext=str_replace("\r\n","",$r['saytext']);
	$saytext=addslashes(RepPltextFace(stripSlashes($saytext)));//替换表情
	if($r['userid']){
		
		echo "<li class=\"citem clearfix\"><div class=\"cavatar\"><a href=\"/e/space/?userid=$r[userid]\" target=\"_blank\"><img src=\"$userpic[0][userpic]\" onload=\"this.style.opacity=1;\"/></a></div><div class=\"cbody\">	<div class=\"cuser\"><a class=\"cname\" href=\"/e/space/?userid=$r[userid]\" target=\"_blank\">$plusername</a></div><div class=\"ctxt\">$saytext</div><div class=\"cinfo clearfix\"><span class=\"ctime\">$saytime</span><div class=\"c-actions\"><a class=\"cdigg \" href=\"javascript:;\"><span class=\"digg-num\">$r[zcnum]</span><i class=\"cbtn\"></i></a></div></div></div></li>\r\n\r\n\r\n";
	}else{
		echo "<li class=\"citem clearfix\"><div class=\"cavatar\"><a href=\"javascript:;\"><img src=\"\" onload=\"this.style.opacity=1;\"/></a></div><div class=\"cbody\">	<div class=\"cuser\"><a class=\"cname\" href=\"javascript:;\" >$plusername</a></div><div class=\"ctxt\">$saytext</div><div class=\"cinfo clearfix\"><span class=\"ctime\">$saytime</span><div class=\"c-actions\"><a class=\"cdigg \" href=\"javascript:;\"><span class=\"digg-num\">$r[zcnum]</span><i class=\"cbtn\"></i></a></div></div></div></li>\r\n\r\n\r\n";
	}
	
}

?>

<?php
db_close();
$empire=null;
?>