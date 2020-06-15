<?php
if(!defined('InEmpireCMS'))
{
	exit();
}

//--------------- 界面参数 ---------------

//会员界面附件地址前缀
$memberskinurl=$public_r['newsurl'].'skin/member/images/';

//LOGO图片地址
$logoimgurl=$memberskinurl.'logo.jpg';

//加减号图片地址
$addimgurl=$memberskinurl.'add.gif';
$noaddimgurl=$memberskinurl.'noadd.gif';

//上下横线背景色
$bgcolor_line='#FF4F3D';

//其它色调可修改CSS部分

//--------------- 界面参数 ---------------


//识别并显示当前菜单
function EcmsShowThisMemberMenu(){
	global $memberskinurl,$noaddimgurl;
	$selffile=eReturnSelfPage(0);
	if(stristr($selffile,'/member/msg'))
	{
		$menuname='menumsg';
	}
	elseif(stristr($selffile,'e/DoInfo'))
	{
		$menuname='menuinfo';
	}
	elseif(stristr($selffile,'/member/mspace'))
	{
		$menuname='menuspace';
	}
	elseif(stristr($selffile,'e/ShopSys'))
	{
		$menuname='menushop';
	}
	elseif(stristr($selffile,'e/payapi')||stristr($selffile,'/member/buygroup')||stristr($selffile,'/member/card')||stristr($selffile,'/member/buybak')||stristr($selffile,'/member/downbak'))
	{
		$menuname='menupay';
	}
	else
	{
		$menuname='menumember';
	}
	// echo'<script>turnit(do'.$menuname.',"'.$menuname.'img");</script>';
	?>
	
	<?php
}

//网页标题
$thispagetitle=$public_diyr['pagetitle']?$public_diyr['pagetitle']:'会员中心';
//会员信息
$tmgetuserid=(int)getcvar('mluserid');	//用户ID
$tmgetusername=RepPostVar(getcvar('mlusername'));	//用户名
$tmgetgroupid=(int)getcvar('mlgroupid');	//用户组ID
$tmgetgroupname='游客';
//会员组名称
if($tmgetgroupid)
{
	$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	if(!$tmgetgroupname)
	{
		include_once(ECMS_PATH.'e/data/dbcache/MemberLevel.php');
		$tmgetgroupname=$level_r[$tmgetgroupid]['groupname'];
	}
}
//会员信息#
$userinfo=$empire->fetch1("select * from {$dbtbpre}enewsmemberadd where userid=$tmgetuserid");

//模型
$tgetmid=(int)$_GET['mid'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<link rel="stylesheet" type="text/css" href="/style/login/common.css">
<title><?=$thispagetitle?></title>
<style type="text/css">
#browser_err{
    display: none;
    background: #FFFF88;
    text-align: center;
    font-size: 20px;
    line-height: 1.8;
    border-bottom: 1px solid #808080;
    padding: 10px 0;
}
#browser_err a{
    color: #4D7CD9;
}
    </style>
</head>
