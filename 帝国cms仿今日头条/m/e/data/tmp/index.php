<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>

<link  href="<?=$public_r['add_wapurl']?>/style/common.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/common.js" ></script>
<meta name="keywords" content="www.dede168.com" />
<meta name="description" content="《今日头条》(TouTiao.com)是一款会自动学习的资讯软件,它会聪明地分析你的兴趣爱好,自动为你推荐喜欢的内容,并且越用越懂你.你关心的,才是头条!" />
<title>《今日头条》<?=$public_r['add_ftitle']?> - <?=$public_r['add_shorturl']?></title>
</head>
<body>

<div class="header">
	
<div class="nav_header_bg">
	<center class="nav_header_center"><?=$public_r['add_sitetitle']?></center>
    <div id="top_menu" class="top_menu">
		<div class="top_menu_list"><a href="/" class="btn cur" scroll-left="0">推荐</a>
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("select classid,classname,bname from {$dbtbpre}enewsclass where showclass!=1 and bclassid=0 order by classid asc limit 19",0,24,0);
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
		<?php $classurl=sys_ReturnBqClassname($bqr,9);//取得栏目地址 ?>
		<a href="<?=$classurl?>" class="btn item_<?=$bqr[classid]?>" scroll-left="0"><?=$bqr[classname]?></a>
		<?php
}
}
?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="focus">
<div id='slider' class='swipe' style="height:100%">
     <ul class='swipe-wrap'>
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('news',5,18,0,'firsttitle=9 and titlepic is not null','id DESC');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
		<li style="display:block;">	
			 <a href="<?=$bqsr['titleurl']?>" title="<?=$bqr['title']?>"><img src="<?=$bqr['titlepic']?>" alt="<?=$bqr['title']?>" /><em></em><span><?=$bqr['title']?></span></a>
		</li>
      	<?php
}
}
?>
      	
    </ul>
 <center class="imgCtrl"> 
         <span class="in current"></span>
 	    <span class="in"></span>
 	    <span class="in"></span>
 	   
	</center>
</div>
</div>
</div>
<div class="block15"></div>
<div class="main">
<div class="listsbox boxmt10">
  <ul class="list_pic" id="content_list">
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('news',20,18,0,'','id DESC');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
       <li class="clear">
			<a href="<?=$bqsr['titleurl']?>" title="<?=$bqr['title']?>">
				<dl>
					<dd>
						<h3><?=$bqr['title']?></h3>
						<i><?=$bqr['befrom']?></i>
					</dd>
<?php if($bqr['titlepic']){?>
					<dt><img src="<?=$bqr['titlepic']?>"></dt>
<?php }?>
				</dl>
			</a>
		</li>
		<?php
}
}
?>
       
   </ul>
<div class="list_more" id="loading">上滑加载更多 &darr;</div>
<div class="list_more" id="nomoreresults" style="display:none">所有内容加载完毕</div>
</div>
</div>
<div class="block15"></div>
<div id="back-to-top">
<a class="stop" href="javascript:"><span></span></a>
</div>
<script type="text/javascript">
$("#sn0").addClass("cut");
var curpage = 2;
var totalpage = <?php $num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_news"); echo $totalpage=ceil($num/10);?>;
var geturl = '/e/extend/list/?classid=<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("select classid from {$dbtbpre}enewsclass order by myorder ASC ",10,24,0);
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?><?=$bqr[classid]?>,<?php
}
}
?>&orderby=newstime&page='; 
</script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/scrollpagination.js"></script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/scriptplugin.js" ></script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/index.js"></script>

<div style="clear: both;"></div>
<div class="footer_main">Copyright &copy;  2015-2016 <?=$public_r['add_sitetitle']?> 版权所有
<center></center>
</div>
<script src="<?=$public_r['add_wapurl']?>/e/extend/DoTimeRepage/"></script>
</body>
</html>