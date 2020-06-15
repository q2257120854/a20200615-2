<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require("../../member/class/user.php");
eCheckCloseMods('member');//关闭模块
eCheckCloseMods('mconnect');//关闭模块
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
eCheckCloseMemberConnect();//验证开启的接口
session_start();
require('../memberconnectfun.php');

$apptype='qq';
$appr=$empire->fetch1("select * from {$dbtbpre}enewsmember_connect_app where apptype='$apptype' and isclose=0 limit 1");
if(!$appr['id'])
{
	printerror2('请选择登录方式','../../../');
}

//应用的APPID
$app_id=$appr['appid'];

//应用的APPKEY
$app_secret=$appr['appkey'];

//成功授权后的回调地址
$ReturnUrlQz=eReturnDomainSiteUrl();
$my_url=$ReturnUrlQz."e/memberconnect/qq/loginend.php";

//----------------- 取得Token -----------------

if(!$_SESSION['state']||$_REQUEST['state']<>$_SESSION['state'])
{
	printerror2('来自的链接不存在','../../../');
}

$code=RepPostVar($_REQUEST['code']);
//拼接URL
$token_url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"."client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code;
$response=@file_get_contents($token_url);
if(strpos($response,"callback")!==false)
{
	$lpos=strpos($response,"(");
	$rpos=strrpos($response,")");
	$response=substr($response,$lpos+1,$rpos-$lpos-1);
	$msg=json_decode($response);
	if(isset($msg->error))
	{
		echo"<h3>error:</h3>".$msg->error;
		echo"<h3>msg  :</h3>".$msg->error_description;
		exit();
	}
}


//----------------- 取得Openid -----------------

$params=array();
parse_str($response,$params);

$params['access_token']=RepPostVar($params['access_token']);
$graph_url="https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];
$str=@file_get_contents($graph_url);
if(strpos($str,"callback")!==false)
{
	$lpos=strpos($str,"(");
	$rpos=strrpos($str,")");
	$str=substr($str,$lpos+1,$rpos-$lpos-1);
}
$user=json_decode($str);
if(isset($user->error))
{
	echo"<h3>error:</h3>".$user->error;
	echo"<h3>msg  :</h3>".$user->error_description;
	exit();
}

$openid=$user->openid;

if(!trim($openid)||!trim($apptype))
{
	printerror2('来自的链接不存在','../../../');
}
$openid=RepPostVar($openid);
$apptype=RepPostVar($apptype);
$_SESSION['openid']=$openid;
$_SESSION['apptype']=$apptype;
$_SESSION['openidkey']=MemberConnect_GetBindKey($apptype,$openid);
//处理登录
MemberConnect_DoLogin($apptype,$openid);

db_close();
$empire=null;
?>