<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/quick_pay.html";i:1540347314;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
	</head>
<!--个人中心-充值-支付宝-->
	<body class="quick_body payment_body">    
		<header class="bg_fff mui-bar mui-bar-nav">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">网银支付</h1>
		</header>
		<div class="mui-content">
		   <div class="money">账户余额：<span class="balance color_red"><?php echo $usableSum; ?></span>元</div>
			<p class="tip"><img src="/public/static/home/img/moblie/yl2.png">无需开通网银，有银行卡就能支付</p>
			<form class="mui-input-group" action="/index/lianlianauthpay/authllpay_wap" method="get" target="_blank" >
			    <div class="mui-input-row">
			        <label>充值金额</label>
					<div class="bankcard input_r">
			        <input type="text" name="b-pay-amount" class="mui-input-clear" placeholder="最低1000元起充" data-input-clear="1">
					</div>
			    </div>
               <input type="hidden" name="bankCard" value="<?php echo $bankcard['cardNumber']; ?>">
               <input type="hidden" name="realName" value="<?php echo $bankcard['memberName']; ?>">
               <input type="hidden" name="IDCard" >
                <div class="mui-input-row">
			        <label>银行卡</label>
			        <div class="bankcard input_r">
			        	<?php if($bankcard['bankName'] == ''||$bankcard['cardNumber'] == ''): ?>
			        	<p class="bankName">您还没绑定银行卡</p>
			        	<p class="bankNum">请先在银行卡管理中绑定</p>
			        	<?php else: ?>
			        	<p class="bankName"><?php echo $bankcard['bankName']; ?></p>
			        	<p class="bankNum"><?php echo $bankcard['cardNumber']; ?></p>
			        	<?php endif; ?>
			        </div>
			    </div>
				<p class="tip1 font12" style="display:none;">注：单卡单笔限额50000，每日最高100万</p>
				<div class="btn_box" style="background: #efeff4;padding-top: 25px;">
					<button type="submit" class="ml_btn mui-btn mui-btn-block">提交</button>
				</div>
			</form>
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
