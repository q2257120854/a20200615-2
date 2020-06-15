<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/feichangpeizi/application/index/view/index/mobile/forgot_pass.html";i:1539914672;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/login.css" rel="stylesheet" />
	</head>
<!--找回密码-->
	<body class="forgot_body reg_body">
		<!--标题-->
		<header class="ml_header mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">忘记密码</h1>
		</header>
		<!--主体-->
		<div class="mui-content">
		    <form class="forgot_form reg_form login_form mui-input-group">
			    <div class="mui-input-row">
			        <input type="text" id="mobileno" class="mui-input-clear" placeholder="请输入您的手机号">
			    </div>
			    <div class="mui-input-row">
			        <input type="text" id="txt_valid_code" class="mui-input-clear" placeholder="请输入图片验证码">
			        <img class="reg_img" src="<?php echo captcha_src(); ?>" id="forgot_passImg" />
			    </div>
			    <div class="mobilenoCode_row mui-input-row">
			        <input id="mobilenoCode" type="text" class="mui-input-clear" placeholder="请输入验证码">
			        <a id="mobileno_code_a" href="javascript:void(0);">获取验证码</a>
			    </div>
			    <div class="mui-input-row">
			        <input id="pwd" type="text" class="mui-input-clear" placeholder="请输入密码">
			    </div>
			    <button type="button" id="forgotPass_btn" class="ml_btn mui-btn mui-btn-block">确&nbsp;定</button>	
			</form>
		</div>
		
		
		
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script src="/public/static/home/js/moblie/forgot_moile.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
			forgot_moile.init()
		</script>
	</body>
</html>