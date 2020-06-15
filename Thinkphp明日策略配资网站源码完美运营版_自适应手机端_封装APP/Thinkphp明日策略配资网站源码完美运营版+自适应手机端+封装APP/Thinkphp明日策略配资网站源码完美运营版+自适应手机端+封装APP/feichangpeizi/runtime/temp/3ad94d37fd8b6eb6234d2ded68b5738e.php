<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/re_tip.html";i:1540272349;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
		<style type="text/css">
			*{-webkit-user-select: text;user-select: text;}
		</style>
	</head>
<!--个人中心-->
	<body class="person_body">   
		<header class="mui-bar mui-bar-nav bg_fff">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">账户充值</h1>
		</header>
		<div class="mui-content">
		    <div class="pay_title">第一步：请复制或牢记我们的支付宝账号</div>
		    <section class="sec1 bg_fff mui-clearfix">
		    	<img class="mui-pull-left mui-col-xs-2" src="/public/static/home/img/moblie/Apay.png"/>
		    	<div class="text mui-pull-left mui-col-xs-9">
		    		<p>支付账号：<span class="copy" id="copyText">726144318@qq.com</span></p>
		    		<p> 宁波鑫钰网络科技有限公司</p>
		    		<p class="zhuyi">注：请务必在转账备注中填写注册手机号 这样方便我们多重信息确认你的汇款</p>
		    	</div>
		    	
		    </section>
		    <div class="pay_title">第二步：手机打开支付宝，快速转账</div>
		    <section class="sec2 bg_fff">
		    	<img src="/public/static/home/img/moblie/ali-pay.png"/>
		    </section>
		    <p class="over_p mui-text-center bg_fff">完成后，请到个人中心查看<a href="/ucenter/home.html">账户余额</a></p>
			<!--<a type="button" class="ml_btn mui-btn mui-btn-block" href="/">去转账</a>-->
			<p class="mui-text-center font12 re_p1">请按照上面步骤进入支付宝手动转账</p>
			<p class="mui-text-center re_p2">到账时间</p>
			<p class="mui-text-center font12 re_p3">08：45-17:00（30分钟内到账） 17:00以后（次日09:30到账）</br> 如急需到账，请联系QQ： <a href="QQ:806247358" target="_blank">806247358</a></p>
		
		
		
		
		</div>
	
		
		<!---js---->
		<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script src="/public/static/home/js/moblie/clipboard.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})

					var clipboard = new Clipboard('#copy_btn', {
				        text: function() {
				            return '2509137766@qq.com';
				        }
				    });
				
				    clipboard.on('success', function(e) {
				        mui.toast('复制成功！')
				    });
				
				    clipboard.on('error', function(e) {
				        mui.toast('此浏览器不支持自动复制！请手动输入！');
				    });
	


			
    
		</script>
	</body>
</html>
