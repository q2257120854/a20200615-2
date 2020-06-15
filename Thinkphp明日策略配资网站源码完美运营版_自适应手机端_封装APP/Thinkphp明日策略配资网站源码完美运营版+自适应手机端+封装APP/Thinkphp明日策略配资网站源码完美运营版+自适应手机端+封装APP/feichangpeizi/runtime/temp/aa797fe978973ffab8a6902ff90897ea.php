<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/mobile/add_bankcard.html";i:1539941481;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>金龙策略</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/public/static/home/css/mui.min.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mobliecom.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mui.picker.css" rel="stylesheet" />
		<link href="/public/static/home/css/moblie/mui.poppicker.css" rel="stylesheet" />
	</head>
<!--个人中心-银行卡管理-->
	<body class="addbank_body bankcard_body">
		<header class="bg_fff mui-bar mui-bar-nav">
		    <a class="color_red mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">添加银行卡</h1>
		</header>
		<div class="mui-content">
		   <p class="ml-tip">选择银行账户</p>
		  	<form class="mui-input-group">
		  	    <ul class="mui-table-view">
		  	            <li class="mui-table-view-cell">
		  	                <a class="">
		  	                    开户人     
		  	            <?php if($realName == ''): ?>
		  	            <a href="/ucenter/user_info.html" id="userName" class="picker_r color_red" style="color:#e60012;margin: 0;">请先实名认证</a>
		  	            <?php else: ?>
		  	            <span id="userName" class="picker_r color_black"><?php echo $realName; ?></span>
		  	            <?php endif; ?>
		  	                </a>
		  	            </li>
		  	            <li class="mui-table-view-cell" id="bankList">
		  	                <a class="mui-navigate-right">
		  	                     开户银行
		  	                     <span id="bankResult" class="picker_r_arr"><?php echo (isset($bankcard['bankName']) && ($bankcard['bankName'] !== '')?$bankcard['bankName']:"请选择银行"); ?></span>
		  	                </a>
		  	            </li>
		  	            <li class="mui-table-view-cell" id="province">
		  	                <a class="mui-navigate-right">
		  	                    所在省份
		  	                    <span id="provinceResult" class="picker_r_arr"><?php echo (isset($bankcard['province']) && ($bankcard['province'] !== '')?$bankcard['province']:"请选择省份"); ?></span>
		  	                </a>
		  	            </li>
		  	            <li class="mui-table-view-cell" id="city">
		  	                <a class="mui-navigate-right">
		  	                    所在城市
		  	                    <span id="cityResult" class="picker_r_arr"><?php echo (isset($bankcard['city']) && ($bankcard['city'] !== '')?$bankcard['city']:"请选择城市"); ?></span>
		  	                </a>
		  	            </li>
		  	            <li class="door mui-table-view-cell cell-input mui-input-row">
							<label>支行名称</label>
							<input class="mui-text-right" id="bankName" type="text" placeholder="请输入所属支行" value = "<?php echo $bankcard['branch']; ?>">
						</li>
						 <li class="door mui-table-view-cell cell-input mui-input-row">
							<label>银行卡号</label>
							<input class="mui-text-right" id="bankNum" type="text" placeholder="请输入银行卡号" value = "<?php echo $bankcard['cardNumber']; ?>">
						</li>
		  	        </ul>
		  	</form>
		  	<p class="pad10 font12">1.绑定银行卡前请先进行实名认证，请务必认真填写真实资料 </br>2.一个身份证只能绑定一个账号 </br>3.如遇问题，请<a href="QQ:806247358" target="_blank">联系客服QQ：806247358</a></p>
		  	<button type="button" id="bankcard_btn" class="ml_btn_bot mui-btn mui-btn-block">提 交</button>
		  
		  
		</div>
		<!---js---->
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.min.js"></script>
		<script src="/public/static/home/js/moblie/mui.picker.js"></script>
		<script src="/public/static/home/js/moblie/mui.poppicker.js"></script>
		<script src="/public/static/home/js/moblie/city.data.js"></script>
		<script src="/public/static/home/js/moblie/city.data-3.js"></script>
		<script type="text/javascript">
			mui.init({
				swipeBack: true //启用右滑关闭功能
			})
			 //银行选择
			 var bankPicker = new mui.PopPicker(); 
                    bankPicker.setData([{
                        value: 'zgbank',
                        text: '中国银行'
                    }, {
                        value: 'zxbank',
                        text: '中信银行'
                    }, {
                        value: 'yzcxbank',
                        text: '邮政储蓄银行'
                    }, {
                        value: 'zsbank',
                        text: '招商银行'
                    }, {
                        value: 'pfbank',
                        text: '浦发银行'
                    }, {
                        value: 'nybank',
                        text: '农业银行'
                    }, {
                        value: 'msbank',
                        text: '民生银行'
                    }, {
                        value: 'jtbank',
                        text: '交通银行'
                    }, {
                        value: 'jsbank',
                        text: '建设银行'
                    }, {
                        value: 'gdbank',
                        text: '光大银行'
                    }, {
                        value: 'gsbank',
                        text: '工商银行'
                    }]);
            var bankList=document.getElementById('bankList')    
            bankList.addEventListener('tap',function(e){
                bankPicker.show(function(items){
//              console.log(items)
                var bankChose = JSON.stringify(items[0].text).replace(/\"/g, "");
                $('#bankResult').html(bankChose);
                })
            });
            
            //省
            var provincePicker=new mui.PopPicker({layer:1});
            provincePicker.setData(cityData3)
            var province=document.getElementById('province')  
            province.addEventListener('tap',function(e){
            	provincePicker.show(function(items){
            		var provinceChose=JSON.stringify(items[0].text).replace(/\"/g,"");
            		$('#provinceResult').html(provinceChose);
            		//传给后台id值
            		var value=JSON.stringify(items[0].value).replace(/\"/g,"");
            		$('#provinceResult').attr('provinceId',value)
					
					
            	})
            })
            //市
            var defaultPro='';
            var cityPicker=new mui.PopPicker({layer:2});
            cityPicker.setData(cityData3);
            var city=document.getElementById('city');
            city.addEventListener('tap',function(e){
            	defaultPro=$('#provinceResult').attr('provinceId');
            	cityPicker.pickers[0].setSelectedValue(defaultPro, 200);
            	cityPicker.show(function(items){
            		var provinceChose=JSON.stringify(items[0].text).replace(/\"/g,"");
            		var cityChose=JSON.stringify(items[1].text).replace(/\"/g,"");
            		$('#provinceResult').html(provinceChose);
            		$('#cityResult').html(cityChose);
            		//传给后台id值
            		var value=JSON.stringify(items[0].value).replace(/\"/g,"");
            		$('#cityResult').attr('cityId',value)
            	})
            })

            //提交
			$("#bankcard_btn").on("tap", function() {
				if(form_validation()){
					$.ajax({
						url: "/index/ucenter/saveBankCardsData",
						data: {
							"bankName": $('#bankResult').html(), //银行名称
							"province": $('#provinceResult').html(), //开户支行省
							"city": $('#cityResult').html(), //开户支行市
							"branch_name": $('#bankName').val(), //支行名称
							"card_no": $("#bankNum").val(), //银行卡号
						},
						type: "post",
						dataType: "json",
						success: function(data) {
							//如果不成功
							if(data.code != '0') {
								mui.alert(data.msg);
							}
							else{		//如果成功
			                    mui.alert("保存成功");
			                    location.href='/ucenter/home.html';
							}
						}
					})
				}				
			});
            function form_validation() {
            	userName=document.getElementById('userName')
				if(userName=='请先实名认证') {
					mui.toast('请先实名认证')
					return false;
				}
				if($('#bankResult').html()=='请选择银行') {
					mui.toast('请选择银行')
					return false;
				}
				if($('#provinceResult').html()=='请选择省份') {
					mui.toast('请选择省份')
					return false;
				}
				if($('#cityResult').html()=='请选择城市') {
					mui.toast('请选择城市')
					return false;
				}
				if($('#bankName').val().length==0) {
					mui.toast('请输入所属支行')
					return false;
				}
				if($('#bankNum').val().length==0) {
					mui.toast('请输入银行卡号')
					return false;
				}else {
					return true;
				}
			}

			
		</script>
	</body>
</html>


