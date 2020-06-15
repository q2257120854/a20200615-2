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
<meta name="keywords" content="<?=$ecms_gr[keyboard]?>" />
<meta name="description" content="<?=$grpagetitle?>" />
<title><?=$grpagetitle?> - <?=$public_r['add_sitetitle']?></title>
</head>
<body>
<div class="header" style="margin-top: 0;">
<div class="nav_header_bg_2">
	<a href="javascript:history.go(-1);" class="nav_header_back"></a>
		<a href="javascript:void(0)"  class="ico_nav_info" style="float:right;"><em>&equiv;</em></a>	
	<center class="nav_header_center"><?=$public_r['add_sitetitle']?>.<?=$class_r[$ecms_gr[classid]][classname]?></center>
	<div class="clear"></div>
</div>
</div>
	<div class="content">
 <h1><?=$grpagetitle?></h1>
   <div class="headbar">
                <span>文 / <?=$docheckrep[1]?ReplaceBefrom($ecms_gr[befrom]):$ecms_gr[befrom]?></span>
                <div>
                <em class="time"><?=date('Y-m-d H:i',$ecms_gr[newstime])?></em>
				</div>
    </div>
	<div id="contentText">
        <div class="contentText">
			<?=strstr($ecms_gr[newstext],'[!--empirenews.page--]')?'[!--newstext--]':$ecms_gr[newstext]?>
		</div>
		
	</div>
</div>
<div class="share">
<div class="sharelist">
<script type="text/javascript">
if(navigator.userAgent.indexOf('UCBrowser') > -1) {
    var CONFIG = {};
        CONFIG['wx_share_link'] = '<?=$public_r['add_siteurl']?><?=$grtitleurl?>',
        CONFIG['wx_share_title'] = '<?=$grpagetitle?>',
        CONFIG['wx_share_desc'] = '<?=$grpagetitle?>',
        CONFIG['img_url'] = '<?=empty($ecms_gr[titlepic])?$public_r[newsurl].'e/data/images/notimg.gif':$ecms_gr[titlepic]?>';
document.writeln("<span class='ucshare'><a href='javascript:;' class='share-wxtimeline'></a><a href='javascript:;' class='share-wxfriend'></a></span>");
document.writeln('<script type="text/javascript" src="/style/Zepto.js"><'+'/script><script type="text/javascript" src="/style/wx_share.js"><'+'/script>')
}
</script>
<span class="bdsharebuttonbox">				
					<a href="javascript:;" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
					<a href="javascript:;" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
					<a href="javascript:;" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
</span>
</div>
</div>
<div class="cmt">
<div id="SOHUCS" sid="<?=$ecms_gr[id]?>"></div>
<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" 
	src="http://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=<?=$public_r['add_changyan_client_id']?>&conf=<?=$public_r['add_changyanid']?>">
</script>
</div>
<div class="article">
<div class="listsbox boxmt10">
<h2>推荐阅读：</h2>
  <ul class="list_pic" id="content_list">
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('news',5,18,0,'','onclick DESC');
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
						<i><?=$bqr['classname']?></i><em>文 / <?=$bqr['befrom']?></em>
					</dd>
					<dt><img src="<?=$bqr['titlepic']?>"></dt>
				</dl>
			</a>
		</li>
		<?php
}
}
?>
       </ul>

</div>
</div>
<div class="block15"></div>
<div id="back-to-top">
<a class="stop" href="javascript:"><span></span></a>
<a class="scmt" href="javascript:"><span></span></a>
</div>
<div class="full"></div>
<div class="side">
<ul>
<a href="/">首页</a>
 <?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("select classid,classname,bname from {$dbtbpre}enewsclass where showclass!=1 and bclassid=0 order by classid asc limit 19",0,24,0);
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
<a id="sn1" href="<?=$classurl?>"><?=$bqr[classname]?></a>
<?php
}
}
?>
</ul>
</div>

<div style="clear: both;"></div>
<div class="footer_main">Copyright &copy;  2015-2016 <?=$public_r['add_sitetitle']?> 版权所有
<center><?=$public_r['add_tj']?></center>
</div>
</body>
</html>
<script type="text/javascript">
window._bd_share_config = {
		common : {
			bdText : '<?=$grpagetitle?>',	
			bdDesc : '<?=$grpagetitle?>',	
			bdUrl : '<?=$public_r['add_siteurl']?><?=$grtitleurl?>', 	
			bdPic : '<?=empty($ecms_gr[titlepic])?$public_r[newsurl].'e/data/images/notimg.gif':$ecms_gr[titlepic]?>'
		},
		share : [{
			"bdSize" : 32
		}],
}
</script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/show.js"></script>
<script type="text/javascript" src="<?=$public_r['add_wapurl']?>/style/form.js"></script>
<form action="" method="post" id="AjaxShowAll"></form>
<div style="display:none;">
<script src="<?=$public_r['add_wapurl']?>/e/extend/DoTimeRepage/"></script>
<script src="<?=$public_r['add_siteurl']?>/e/public/ViewClick/?classid=<?=$ecms_gr[classid]?>&id=<?=$ecms_gr[id]?>&addclick=1"></script></div>