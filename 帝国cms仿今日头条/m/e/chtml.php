<?php 
$check= stripslashes($_GET['check']); 

require('./class/connect.php'); //引入数据库配置文件和公共函数文件 
require('./class/db_sql.php'); //引入数据库操作文件 
require("./class/functions.php"); 
require("./class/t_functions.php"); 
require("./data/dbcache/class.php"); 
require("./data/dbcache/MemberLevel.php"); 
require('./class/chtmlfun.php'); 
$link=db_connect(); //连接MYSQL 
$empire=new mysqlquery(); //声明数据库操作类 
$cid = trim(stripslashes($_GET['classid']));

if($cid){
	
	$ccc=$empire->fetch1("select classid from {$dbtbpre}enewsclass where classpath='{$cid}' limit 1");
	// var_dump($ccc);exit;
	$_GET['classid']=$ccc['classid'];
}
if($check=="checkcode"){//checkcode 对应nginx配置的 checkcode 
	ReSingleInfo('1','admin');//你的帝国后台 id 和 用户名 
} 

db_close(); //关闭MYSQL链接 
$empire=null; //注消操作类变量 
?>