<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/www/wwwroot/feichangpeizi/application/index/view/index/mobile/reg.html";i:1539914605;}*/ ?>
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
	<body class="reg_body">
		<!--标题-->
		<header class="ml_header mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">注册</h1>
		</header>
		<!--主体-->
		<div class="mui-content">
		    <form class="reg_form login_form mui-input-group">
			    <div class="mui-input-row">
			        <input id="mobileno" type="text" class="mui-input-clear" placeholder="请输入您的手机号">
			    </div>
			    <div class="img_row mui-input-row">
			        <input id="txt_valid_code" type="text" class="mui-input-clear" placeholder="请输入图片验证码">
			        <img class="reg_img" id="forgot_passImg" src="<?php echo captcha_src(); ?>"  />
			    </div>
			    <div class="mobilenoCode_row mui-input-row">
			        <input id="mobilenoCode" type="text" class="mui-input-clear" placeholder="请输入验证码">
			        <a href="javascript:;" id="mobileno_code_a">获取验证码</a>
			    </div>
			    <div class="mui-input-row">
			        <input id="pwd" type="password" class="mui-input-clear" placeholder="请输入密码">
			    </div>
			    <div class="mui-input-row">
			        <input id="mobile" type="text" class="mui-input-clear" placeholder="设置用户名，不小于6位">
			    </div>
			     <div class="mui-input-row">
			        <input id="recommend_code" type="text" class="mui-input-clear" placeholder="请输入机构码">
			    </div>
			    <button type="button" id="reg_btn" class="ml_btn mui-btn mui-btn-block">注&nbsp;册</button>	
			</form>
		</div>
		
		
		<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script src="/public/static/home/js/moblie/reg.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
			reg_moblie.init()
		</script>
	</body>
</html>