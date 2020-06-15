<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/withdraw.html";i:1539941828;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
	</head>
<!--个人中心-提现-->
	<body class="withdraw_body">
		<header class="bg_fff mui-bar mui-bar-nav">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">账户提现</h1>
		</header>
		<div class="mui-content">
		   <p class="ml-tip">选择提现到账方式</p>
			<!--<div class="addbank bg_fff mui-text-center">
				<p class="add">添加新银行卡</p>
			</div>-->
			<form class="mui-input-group">
			    <div class="mui-input-row">
			        <label>提现金额</label>
			        <input type="number" id="提现金额i" class="mui-input-clear" placeholder="请输入提现金额">
			    </div>
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
			</form>
			<p class="ml-tip">账户可用余额:<?php echo $usableSum; ?>元，当余额小于10元须全额提现</p>
			<button type="button" id="withdraw_btn" class="ml_btn mui-btn mui-btn-block">确认提现</button>
			<p class="font12 mui-text-center">提现无任何形式手续费</br>上午时段的提款将在12点左右到账</br>下午时段的提款将在16点左右到账</p>
		</div>
		
		
	
		
		<!---js---->
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
			var bankId = "<?php echo $bankcard['id']; ?>";
			$('#withdraw_btn').on('tap',function(){
				if($('#提现金额i').val().length==0){
					mui.alert('请输入提现金额');
					return;
				}
				if(bankId == ''){
					mui.alert("您还未绑定银行卡");
					return;
				}
				$.ajax({
					type:"post",
					url:"/index/ucenter/doWithdraw",
					data:{
						amount:$('#提现金额i').val(),//提现金额
						bankId: bankId,
					},
					dataType:'json',
					success:function(data){
						if(data.code!='0'){
							mui.alert(data.msg);
						}else{
							mui.alert("提现成功");
							location.href='/ucenter/home.html';
						}
					}
				});
			})
		</script>
	</body>
</html>

