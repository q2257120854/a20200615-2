<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/www/wwwroot/feichangpeizi/application/index/view/index/mobile/login.html";i:1540605687;}*/ ?>
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/login.css" rel="stylesheet" />
	</head>
<!--登录-->
	<body class="login_body">
		<header class="ml_header mui-bar mui-bar-nav">
		    <h1 class="mui-title">登录</h1>
		</header>
		<div class="mui-content">
			<div class="fcml_logo">
				<img src="/public/static/home/img/moblie/fcml.png"/>
			</div>
			<form class="login_form mui-input-group">
			    <div class="mui-input-row">
			        <label><i class="icon_username"></i></label>
			        <input type="text" id="username" class="mui-input-clear" placeholder="请输入您的用户名/手机号">
			    </div>
			    <div class="mui-input-row">
			        <label><i class="icon_psw"></i></label>
			        <input type="password" id="psw" class="mui-input-clear" placeholder="请输入您的密码">
			    </div>
			    <a class="forgot_pass" href="/forgot_pass">忘记密码</a>
			    <button type="button" id="login-btn" class="ml_btn mui-btn mui-btn-block">登&nbsp;录</button>
			</form>
			
			<p class="reg_a">还没账号？<a href="/reg">马上注册</a></p>
		</div>
		
		<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script src="/public/static/home/js/moblie/login.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
		</script>
	</body>
</html>