<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!doctype html>
<html>
<head>

    <meta charset="gb2312" />
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    
    <link rel="shortcut icon" href="[!--news.url--]favicon.ico" type="image/x-icon">
    

    
    <title>[!--pagetitle--] - <?=$public_r['add_sitetitle']?>(<?=$public_r['add_shorturl']?>)</title>
    <meta name="keywords" content="[!--pagekey--]">
	<meta name="description" content="[!--pagedes--]">

    <link type="text/css" rel="stylesheet" href="[!--news.url--]style/base_627e6bf.css">
    <link type="text/css" rel="stylesheet" href="[!--news.url--]style/about_bcdde3c.css">
    <link type="text/css" rel="stylesheet" href="[!--news.url--]style/core_b666bd6.css">
    <link type="text/css" rel="stylesheet" href="[!--news.url--]style/aboutnav_70173d6.css">
    
	<script type="text/javascript" charset="gb2312" src="[!--news.url--]style/lib_538033e.js"></script>
    


</head>
<body class="">

    <div id="wrapper">
    <div id="pagelet-nav" data-test="">
	<div class="nav-inner clearfix">
        <div class="nav-logo">
            <a href="/" class="logo-box" ga_event="nav_icon">
                <img src="//s0.pstatp.com/resource/toutiao_web/static/style/image/toutiaoweblogo_440dedc.png" class="logo">
            </a>
        </div>
        <div class="nav-title">
            <ul class="clearfix">
                <li>
                    <a data-node="home" ga_event="nav_index" class="btn" href="/">
                        <span>首页</span>
                    </a>
                </li>
                <li>
                    <a data-node="dynamic" ga_event="nav_dynamic" class="btn" href="/updates/">
                        <span>动态</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-subtitle">
            <ul class="nav-list clearfix">
                
                
                <li class="username-box nav-item" data-node="username">
                    <a ga_event="nav_login" class="btn user-head" href="javascript:;" data-node="login">
                        <span>登录</span>
                    </a>
                    <i class="line"></i>
                </li>
                
                <li class="nav-item more-box" data-node="more">
                    <a ga_event="nav_more" class="btn" href="/about/about.html">
                        <span>更多</span>
                    </a>
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
    </div>
    
</div>
	<div id="pagelet-aboutnav">
		<div data-node="toolbarInner" class="inner">
			<div class="toolbar-inner clearfix">
				<ul class="hv-list left clearfix" data-node="curCategory">
					<li class="current">
						<a class="item" data-node="about" href="/about/about.html" ga_event="header" ga_label="about_tab">关于我们</a>
						</li>
					<li>
						<a class="item" data-node="join" href="/about/join.html" ga_event="header" ga_label="about_tab">加入我们</a>
						</li>
					<li>
						<a class="item" data-node="report" href="/about/report.html" ga_event="header" ga_label="about_tab">媒体报道</a>
						</li>
					<li>
						<a class="item" data-node="media_partners" href="/about/media_partners.html" ga_event="header" ga_label="about_tab">媒体合作</a>
						</li>
					<li>
						<a class="item" data-node="cooperation" href="/about/cooperation.html" ga_event="header" ga_label="about_tab">产品合作</a>
						</li>
					<li>
						<a class="item" data-node="media_cooperation" href="/about/media_cooperation.html" ga_event="header" ga_label="about_tab">合作说明</a>
						</li>
					<li>
						<a class="item" data-node="contact" href="/about/contact.html" ga_event="header" ga_label="about_tab">联系我们</a>
						</li>
					<li>
						<a class="item" data-node="user_agreement" href="/about/user_agreement.html" ga_event="header" ga_label="about_tab">用户协议</a>
						</li>
					<li>
						<a class="item" data-node="complain" href="/about/complain.html" ga_event="header" ga_label="about_tab">投诉指引</a>
					</li>
				</ul>
			</div>
			<div class="abs_l">
				<a class="btn back" href="/"></a>
			</div>
		</div>
	</div>
    <div id="container" class="about">
        <div class="inner">
        [!--pagetext--]
        </div>
    </div>
    </div>

    <div class="company" id="toutiaoCompanyWrapper">
        <p>
            <span class="J-company-name">&#169; 2016 <?=$public_r['add_sitetitle']?> <?=$public_r['add_siteurl']?></span>
            <a href="http://www.12377.cn/" target="_blank">中国互联网举报中心</a>
            <a href="http://www.miibeian.gov.cn/" target="_blank"><?=$public_r['add_beian']?></a>
            
        <p>
            <a href="/license/" class="icp" target="_blank">网络文化经营许可证</a>
            <a href="/chengnuoshu/" target="_blank">跟帖评论自律管理承诺书 </a>
            违法和不良信息举报：<?=$public_r['add_jubao']?>
            
        </p>
    </div>
    
    
    <script>
        window.scrollTo(0, 0);
		$(document).scroll(function() {
			var scrolltop=$(document).scrollTop();
			if(scrolltop>100){
				$('.d-union-cell').css({'position':'fixed','top':'0px'});
			}else{
				$('.d-union-cell').css({'position':'','top':''});
			}
		});

        
    </script>
    
    
<span style="display:none"><?=$public_r['add_tj']?> </span>
    

</body>
</html>
