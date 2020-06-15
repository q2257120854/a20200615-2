<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/bankcard.html";i:1539941490;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
	</head>
<!--个人中心-银行卡管理-->
	<body class="bankcard_body">
		<header class="bg_fff mui-bar mui-bar-nav">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">银行卡管理</h1>
		</header>
		<div class="mui-content">
		   <p class="ml-tip">银行账户</p>
		   <?php if($bankcard == ''): ?>
			<div class="addbank bg_fff mui-text-center">
				<a href="/ucenter/add_bankcard.html">
					<p class="add">添加新银行卡</p>
				</a>
			</div>
			<?php else: ?>
			<ul class="cardList mui-table-view">
			    <li class="mui-table-view-cell mui-media">
			        <a href="/ucenter/add_bankcard.html">
			            <img class="mui-media-object mui-pull-left" src="/public/static/home/img/moblie/yl.png">
			            <div class="mui-media-body">
			                <span class="bankName"><?php echo $bankcard['branch']; ?></span>
			                <p class="bankNum mui-ellipsis"><?php echo $bankcard['cardNumber']; ?></p>
			            </div>
			        </a>
			    </li>
			</ul>
			<p class="ml-tip">每人最多绑定一张银行卡,点击卡片可修改原银行卡信息</p>
			<?php endif; ?>
		</div>
		
		
	
		
		<!---js---->
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
		</script>
	</body>
</html>

