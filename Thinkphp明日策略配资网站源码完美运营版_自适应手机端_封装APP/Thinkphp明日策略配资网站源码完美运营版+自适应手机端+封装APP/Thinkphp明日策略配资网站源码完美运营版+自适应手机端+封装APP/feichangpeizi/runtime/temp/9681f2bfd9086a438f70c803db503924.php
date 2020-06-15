<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"/www/wwwroot/feichangpeizi/application/index/view/index/mobile/gift.html";i:1539914637;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙谋略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
	</head>
<!--个人中心-资金合作-->
	<body class="addbank_body bankcard_body zijin_body">
		<header class="bg_fff mui-bar mui-bar-nav">
		   <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">资金合作</h1>
		</header>
		<div class="mui-content mui-content-padded">
			<?php echo $d['content']; ?>
		</div>
		<!---js---->
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack:true
			})
		</script>
	</body>
</html>


