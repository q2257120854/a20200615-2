<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/real_name.html";i:1539941757;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
	</head>
<!--个人中心-实名认证2-->
	<body class="realName_body">
		<header class="bg_fff mui-bar mui-bar-nav">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">实名认证</h1>
		</header>
		<div class="mui-content">
		   <p class="ml-tip color_red">请准确填写身份信息，以便绑定银行卡和提款。</p>
			<form class="mui-input-group">
			    <div class="mui-input-row">
			        <label>真实姓名：</label>
			        <input id="realName" type="text" class="mui-input-clear" placeholder="请输入您的真实姓名">
			    </div>
			    <div class="mui-input-row">
			        <label>身份证号：</label>
			        <input id="idCard" type="text" class="mui-input-clear" placeholder="请输入您的身份证号">
			    </div>
			</form>
			<button type="button" id="realName_btn" class="ml_btn mui-btn mui-btn-block">确  认</button>
		</div>
		
		
	
		
		<!---js---->
		<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
			
			//点击提交真实姓名
	        $("#realName_btn").on('tap',function () {
	        	if($('#realName').val().length==0){
	        		mui.toast('请输入您的真实姓名')
	        		return;
	        	}
	        	if($('#idCard').val().length==0){
	        		mui.toast('请输入您的身份证号')
	        		return;
	        	}
	            $.post("/index/ucenter/doReanNameAuth", {realName:$('#realName').val(), IDNumber:$('#idCard').val()}, function(data){
	                        $("#realName").val('');
	                        $("#idCard").val('');
	                        if(data.code != '0'){
	                            mui.alert(data.msg);
	                        }else{
	                            mui.toast("保存成功");
	                            location.href='/ucenter/home.html';
	                        }
	            }, 'json'); 
	                   
	        });
		</script>
	</body>
</html>


