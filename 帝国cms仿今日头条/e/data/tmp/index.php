<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!doctype html>
<html>
<head>
    <link rel="alternate" media="only screen and (max-width: 640px)" href="<?=$public_r['add_wapurl']?>" >
    <meta charset="gb2312" />
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<script src="http://siteapp.baidu.com/static/webappservice/uaredirect.js" type="text/javascript"></script><script type="text/javascript">uaredirect("<?=$public_r['add_wapurl']?>");</script>
<script src="/e/data/js/ajax.js">
    <script type="text/javascript">
        if(!('console' in window)) {window.console = {log: function(msg) {}};}
    </script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="/style/nbase_cf47e58.css">


    
    
    <title>《今日头条》<?=$public_r['add_ftitle']?> - <?=$public_r['add_shorturl']?></title>
    <meta name="keywords" content="www.dede168.com">
    <meta name="description" content="《今日头条》(TouTiao.com)是一款会自动学习的资讯软件,它会聪明地分析你的兴趣爱好,自动为你推荐喜欢的内容,并且越用越懂你.你关心的,才是头条!">
    
    

    <link rel="stylesheet" type="text/css" href="/style/core_b666bd6.css">
<link rel="stylesheet" type="text/css" href="/style/newindex_b0deca1.css">
<script type="text/javascript" charset="gb2312" src="/style/lib_538033e.js"></script>

<script>
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

<script type="text/javascript" charset="gb2312" src="/style/scrollpagination.js"></script>

</head>
<body class="v2016">
    
    <div id="wrapper" class="index-wrapper">
    <div id="pagelet-nnav" >
	<!--反馈 start-->
<script>
$(function(){
	$('.feedbtn').click(function(){$('.feedback_dialog').toggleClass('on')});
	$('.feedback_dialog .close').click(function(){$('.feedback_dialog').removeClass('on')})
});
function submitfeedback(obj){
  var name='匿名';
var email=$('[name=email]').val();
var lytext=$('[name=lytext]').val();
if(!email){alert('请填写联系方式');return false;}
if(!lytext){alert('您的意见');return false;}

}
</script>
<div class="dialog feedback_dialog">
    <div class="dialog-header">
        <h3>意见反馈</h3>
    </div>
    <div class="dialog-inner" data-node="inner">
        <div class="feedback_panel">
            <form action="/e/enews/index.php" method="post" name="form1" onsubmit="return submitfeedback(this)">
                <ul>
                    <li>
                        <p class="label">联系方式（必填）</p>
                        <div class="input-group">
                            <input class="email" placeholder="您的邮箱" type="text" name="email">
                        </div>
                    </li>
                    <li>
                        <p class="label">您的意见（必填）</p>
                        <div class="input-group">
                            <textarea style="height:100px;" name="lytext" class="content" maxlength="140" placeholder="请填写您的意见，不超过140字"></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                               <input name="name" type="hidden" id="name" value="匿名">
                            <input type="submit" name="Submit3" class="submit-btn" value="提交">
                                <input name="enews" type="hidden" id="enews" value="AddGbook" />
                                <input type="hidden" name="ecmsfrom" value="/">
                            <span class="msg" data-node="msg"></span>
                            <a data-node="close" class="close" href="javascript:;">[关闭]</a>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
<!--反馈 end-->
<div class="topbarWrapper" class="clearfix">
		
		<ul class="left">
			<li class="tb-item"><a class="tb-link" href="/desktop.php?name=<?=$public_r['add_sitetitle']?>" >放到桌面</a></li>
			<li class="tb-item"><a class="tb-link add-favorite" data-node="addToFavorites" ga_event="nav_pin" href="javascript:;"onclick="alert('请按Ctrl+D收藏');">添加到收藏夹</a></li>
		</ul>
		

		<ul class="right">
			<li class="tb-item"><span><script src="/e/member/login/loginjs2.php"></script></span></li>
			<li class="tb-item" id="mth"><a class="tb-link" href="/e/member/login/">媒体号</a></li>
			<li class="tb-item"><a class="tb-link feedbtn" href="javascript:;" js_ga_event="nav_feedback" data-node="navFeedback">反馈</a></li>
			<li class="tb-item right-more" data-node="more">
				<a class="tb-link" href="/about/" ga_event="nav_more">更多</a>
				<div class="layer">
					<ul>
						
	                    <li><a href="<?=$public_r['add_wapurl']?>" class="layer-item">手机版</a></li>
                            
						<li><a href="/about/about.html" class="layer-item">关于我们</a></li>
						<li><a href="/about/join.html" class="layer-item">加入头条</a></li>
						<li><a href="/about/report.html" class="layer-item">媒体报道</a></li>
						<li><a href="/about/media_partners.html" class="layer-item">媒体合作</a></li>
						<li><a href="/about/cooperation.html" class="layer-item">产品合作</a></li>
						<li><a href="/about/media_cooperation.html" class="layer-item">合作说明</a></li>
						<li><a href="/about/contact.html" class="layer-item">联系我们</a></li>
						<li><a href="/about/user_agreement.html" class="layer-item">用户协议</a></li>
						<li><a href="/about/complain.html" class="layer-item">投诉指引</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<!--[if lt IE 9 ]><style>.midbarWrapper{border-bottom:1px solid #e8e8e8;}</style><![endif]-->
	<div class="midbarWrapper">
		<div class="midbar-inner">
			<div class="logo-box">
				<a class="logo-link" href="/" ga_event="nav_icon"><img class="logo" src="/style/logo.png"></a>
			</div>
			<div class="search-box">
				<form action="/e/search/" method="post" data-node="searchForm" target="_blank">
	                <div class="input-group clearfix">
	                    <input autocomplete="off" ga_event="nav_search_input" data-node="searchInput" name="keyboard" type="text" placeholder="搜索我关心的..." value="">
	                    <div class="btn-submit">
                                <input type="hidden" name="show" value="title">
                                <input type="hidden" name="tempid" value="1">
                                <input type="hidden" name="tbname" value="news">
	                        <button ga_event="nav_search" type="submit" href="javascript:;">
	                            <i class="icon icon-search"></i>
	                        </button>
	                    </div>
	                </div>
	            </form>
			</div>
			<div class="user-box" data-node="userbox" >
				
				<div class="username-box clearfix" data-node="username">
					<a ga_event="nav_login" class="nav-login user-item" href="javascript:;" data-node="login">
						<span></span>
					</a>
				</div>
				
			</div>
		</div>
	</div>
	</div>

        <div id="container" class="clearfix">
            <div class="index-left">
                <div id="pagelet-channels" class="">
	<ul class="channel-box" data-node="channelBox">
		<li class="channel-item">
			<a ga_event="news_recommend" class="item item_index " href="/" data-node="category" data-category="__all__"><span class="channel-tag">推荐</span></a>
		</li>
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("select classid,classname,bname from {$dbtbpre}enewsclass where bclassid=0 and showclass=0 order by classid asc limit 0,7",0,24,0);
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
		<?php $classurl=sys_ReturnBqClassname($bqr,9);//取得栏目地址 ?>
		<li class="channel-item">
			<a class="item item_<?=$bqr[classid]?> " href="<?=$classurl?>" data-category="<?=$bqr[bname]?>"><span class="channel-tag <?=$bqr[bname]?>"><?=$bqr[classname]?></span></a>
		</li>
		<?php
}
}
?>

		
		
		<!--<li class="channel-item more-item magic-btn" data-node="foldBox">
			<a ga_event="click_hide_channel" class="item" href="javascript:;" data-node="fold"><span class="channel-tag fold">收起</span></a>
		</li>-->
		</ul>
		<div class="moreBox" data-node="moreBox">
			<a ga_event="click_show_channel" class="moreBtn" href="javascript:;"><span class="channel-tag more">更多</span></a>
			<ul class="more-channels" data-node="moreChannels">
				
				<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("select classid,classname,bname from {$dbtbpre}enewsclass where bclassid=0 and showclass=0 order by classid asc limit 7,12",0,24,0);
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
				<?php $classurl=sys_ReturnBqClassname($bqr,9);//取得栏目地址 ?>
				<li class="channel-item item_<?=$bqr[bname]?>">
					<a class="item " href="<?=$classurl?>"><span class="channel-tag <?=$bqr[bname]?>"><?=$bqr[classname]?></span></a>
				</li>
				<?php
}
}
?>
			</ul>
		</div>
	
</div>
            </div>
<script type="text/javascript">
$(".item_index").addClass("selected");
</script>

            <div class="index-main">
                <div id="pagelet-nfeedlist">
	<div class="feedcomm" data-node="commItem">
		<span class="comm-close" data-node="commClose"></span>
		<a ga_event="click_banner" target="_blank" data-node="commLink"></a>
	</div>
	<p class="alert-msg" data-node="alertMsg">
        <img src="<?=$public_r['add_siteurl']?>/style/loading_50c5e3e.gif">
        <span>推荐数据加载中...</span>
    </p>
	<div class="unread" data-node="unread" ga_event="click_feed_update"><span>您有未读新闻，点击查看</span></div>
	<ul data-node="listBox" class="listBox">
		<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq('news',20,18,0,'','id DESC');
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
		<li class="item clearfix" data-node="item">
	
			<div class="item-inner">
				<?php if(!empty($bqr['titlepic'])){?>
				<div class="lbox left">
					<a href="<?=$bqsr['titleurl']?>" target="_blank">
						<img class="feedimg" src="<?=$bqr['titlepic']?>" onload="this.style.opacity=1;" style="opacity: 1;">
					</a>
				</div>
				<div class="rbox"><!--hold-->
				<?php }?>
					<div class="rbox-inner">
					
						<div class="title-box">
							<a ga_event="click_feed_newstitle" class="link title" href="<?=$bqsr['titleurl']?>" target="_blank" data-node="title">
								<?=$bqr['title']?>
							</a>
						</div>
						<div class="abstract">
							<a ga_event="click_feed_newsabstract" class="link" href="<?=$bqsr['titleurl']?>" target="_blank"><?=$bqr['smalltext']?></a>
						</div>
						<div class="footer clearfix">
							<div class="left lfooter">
								<a class="lbtn source" href="javascript:;"><?=$bqr['befrom']?>&nbsp;</a>
								<span class="lbtn comment"></span>
								<span class="lbtn time"><?=date('m-d H:i',$bqr[newstime])?></span>
							</div>
							<div class="right rfooter">
								<span data-node="likeGroup" class="">
								
									<a class="rbtn bury" href="javascript:;" title="踩" onclick="makeRequest('/e/public/digg?classid=<?=$bqr['classid']?>&id=<?=$bqr['id']?>&dotop=1&doajax=1&ajaxarea=diggnum','EchoReturnedText','GET','');"></a>
									<a class="rbtn digg" href="javascript:;" title="顶" onclick="makeRequest('/e/public/digg?classid=<?=$bqr['classid']?>&id=<?=$bqr['id']?>&dotop=0&doajax=1&ajaxarea=diggnum','EchoReturnedText','GET','');"></a>
								</span>
							</div>
						</div>
					</div>
				<?php if(!empty($bqr['titlepic'])){?>
				</div>
				<?php }?>
			</div>
		</li>
		<?php
}
}
?>
	</ul>
	<a href="javascript:;" class="loadmore" data-node="loadMore">正在为您加载更多...</a>
</div>
            </div>
            <div class="index-right">
                <div id="pagelet-weather">
					 <iframe allowtransparency="true" frameborder="0" width="250" height="98" scrolling="no" src="http://tianqi.2345.com/plugin/widget/index.htm?s=2&z=1&t=1&v=0&d=1&bd=0&k=000000&f=&q=1&e=1&a=1&c=54511&w=250&h=98&align=center"></iframe>
				</div>

                
                <div id="pagelet-commbox">
					<!--<a ga_event="click_banner" class="img-box" target="_blank" data-node="link">
						<img data-node="img" onload="this.style.opacity=1">
					</a>
					<span class="comm-label">推广</span>-->
					<!--广告位 右侧250x250_1 start-->
					<script src="/d/js/acmsd/thea1.js" type="text/javascript"></script>
					<!--广告位 右侧250x250_1 end-->
				</div>

                <div id="pagelet-hotnews">
					<div class="head">
					  实时要闻
					</div>
					<div class="news">
						<?php
$bqno=0;
$ecms_bq_sql=sys_ReturnEcmsLoopBq("news",10,18,0,"date_format(from_UNIXTIME(newstime),'%Y-%m') = date_format(now(),'%Y-%m')","onclick DESC");
if($ecms_bq_sql){
while($bqr=$empire->fetch($ecms_bq_sql)){
$bqsr=sys_ReturnEcmsLoopStext($bqr);
$bqno++;
?>
						<a href="<?=$bqsr['titleurl']?>" target="_blank" title=""><?=$bqr['title']?></a>
						<?php
}
}
?>
					</div>
				</div>

                <div id="pagelet-stock">
				  <div class="stock_head">
					
				  </div>
				</div>

                <div id="pagelet-company">
				  <div class="company" id="toutiaoCompanyWrapper">
					<span class="J-company-name">&#169; 2016 <?=$public_r['add_sitetitle']?> <?=$public_r['add_siteurl']?></span>
					<a href="http://www.12377.cn/" target="_blank" ga_event="click_about">中国互联网举报中心</a>
					<a href="http://www.miibeian.gov.cn/" target="_blank" ga_event="click_about"><?=$public_r['add_beian']?></a>
					<a href="/license/" class="icp" target="_blank">网络文化经营许可证</a>
					<a href="/chengnuoshu/" target="_blank">跟帖评论自律管理承诺书 </a>
					<span>违法和不良信息举报：<?=$public_r['add_jubao']?></span>
					<span style="display:none"><?=$public_r['add_tj']?> </span>
					
				  </div>

				  
				</div>
<link type="text/css" rel="stylesheet" href="/style/loginbox.css">
<div id="bgDiv" style="display:none;"></div> 

<script type="text/javascript">
var IsMousedown,LEFT,TOP,lggood;
	document.getElementById("Mdown").onmousedown=function(e){

	lggood = document.getElementById("lggoodBox");
	IsMousedown = true;
	e = e||event;
	LEFT = e.clientX - parseInt(lggood.style.left);
	TOP = e.clientY - parseInt(lggood.style.top);
	document.onmousemove = function(e){
		e = e||event;
		if (IsMousedown){
			lggood.style.left = e.clientX - LEFT + "px";
			lggood.style.top = e.clientY - TOP + "px";
		}

	}
	document.onmouseup=function(){
		IsMousedown=false;
	}

}
$(function(){
  $('#loginboxbtn').click(function(){
        $('#bgDiv,#lggoodBox').show();
   });
   
})
</SCRIPT>


            </div>
            <div id="pagelet-nfeedback">
				<ul>
					<li>
						<a ga_event="click_feed_newsrefresh" class="refresh" href="javascript:;" data-node="refresh"></a>
						<!--<a ga_event="gotop" class="btn" href="javascript:;" data-node="back">
							<i class="icon icon-back"></i>
						</a>-->
					</li>
					<!--<li>
						<a ga_event="feedback" class="btn" href="javascript:;" data-node="feedback">
							<i class="icon icon-comment"></i>
						</a>
					</li>-->
				</ul>
			</div>
        </div>
    </div>

    <script>
        window.scrollTo(0, 0);

        window.gaqpush = function (ga_action, ga_label){
            ga('send', 'event','/' , ga_action, ga_label);
        };

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-28423340-5', 'auto');
        ga('send', 'pageview');


        $("body").on('click', '[ga_event]', function(e){
             var $this =  $(this);
             var ga_category = $this.attr('ga_category') || '/';
             var ga_action = $this.attr('ga_event');
             var ga_label = $this.attr('ga_label');
             var ga_value = $this.attr('ga_value')||1;

             ga('send', 'event', ga_category, ga_action, ga_label, ga_value);
        });

    </script>
    <script>
        window.scrollTo(0, 0);
		$(document).scroll(function() {
			var scrolltop=$(document).scrollTop();
			if(scrolltop>1200){
				$('#pagelet-commbox').css({'position':'fixed','top':'100px'});
			}else{
				$('#pagelet-commbox').css({'position':'','top':''});
			}
                        if(scrolltop>30){
				$('.topbarWrapper').css({'height':'4px'});
			}else{
				$('.topbarWrapper').css({'height':'24px'});
			}
		});

        
    </script>
    
<script src="/e/extend/DoTimeRepage/"></script>
</body>
</html>
