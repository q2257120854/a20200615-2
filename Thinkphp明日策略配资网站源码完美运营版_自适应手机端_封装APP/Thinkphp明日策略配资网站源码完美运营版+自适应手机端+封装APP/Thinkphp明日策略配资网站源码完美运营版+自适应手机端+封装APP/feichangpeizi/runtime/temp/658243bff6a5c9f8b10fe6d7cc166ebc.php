<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/payment.html";i:1541154375;s:65:"/www/wwwroot/feichangpeizi/application/index/view/public/top.html";i:1539839495;s:73:"/www/wwwroot/feichangpeizi/application/index/view/public/member_left.html";i:1539845017;s:68:"/www/wwwroot/feichangpeizi/application/index/view/public/footer.html";i:1540301736;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>金龙策略</title>
</head>
<body class="membercenter logged-in">
<title><?php echo config('web_site_title'); ?></title>

<meta name="keywords" content="<?php echo config('web_site_keywords'); ?>">
<meta name="description" content="<?php echo config('web_site_description'); ?>">
<link rel="stylesheet" type="text/css" href="/public/static/home/css/common.css"/>
<!--头部-->
<header class="ml_header br-w100">
    <div class="h_top br-w100">
        <div class="w1024 br-clearfix">
            <!--<div class="h_topL br-fl">
                服务热线：<?php echo $phone; ?>
                <a id="qqicon" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $QQ; ?>&amp;site=qq&amp;menu=yes"></a>
            </div>-->


            <div id="page_shared_layout_login" class="h_topR br-fr" <?php if($_SESSION['member'] != ''): ?> style="display: none;" <?php endif; ?> >
                <a class="login" href="javascript:;">登录</a>
                <a class="register" href="/reg.html">注册</a>
            </div>

            <ul id="page_shared_layout_unlogin" class="top-links f-right" <?php if($_SESSION['member'] == ''): ?> style="display: none;" <?php endif; ?>>
                <!--<li class="show-logout" style="display: list-item;"><a href="javascript:_hmt.push(['_trackEvent', 'login', 'click', 'head-login',1]);" name="popup-user-login-click">登录</a></li>-->
                <!--<li class="show-logout sep" style="display: list-item;">|</li>-->
                <!--<li class="show-logout" style="display: list-item;"><a href="/user/reg">注册</a></li>-->
                <li class="show-login" style="display: block;">您好，&nbsp;</li>
                <li class="show-login top-user-wrapper" style="display: block;">
                    <span class="top-username">
                    	<a id="page_shared_layout_login_name" href="/ucenter/index"><?php echo $_SESSION['member']['username']; ?></a>
                    	<i class="icon icon-arrow-drop-down"></i>
                    </span>
                    <div class="overlay-account">
                        <div class="group account-group">
                            <span class="f-left">可用<b class="account-val" id="shared_header_mb"><?php echo $usableSum; ?></b></span>
                            <a name="realnameAuth" class="f-right" href="/ucenter/payment.html">充值</a>
                        </div>
                        <div class="account-links group">
                            <a class="f-left" href="/ucenter/index.html">个人中心</a>
                            <span class="f-left sep">|</span>


                            <a class="f-right js-logout" href="/index/index/logout.html">安全退出</a>
                        </div>
                    </div>
                    <!--/.overlay-account-->
                </li>

            </ul>

        </div>
    </div>
    <div class="h_bot br-w100">
        <div class="w1024 br-clearfix">
            <div class="h_botL br-fl">
                <a href="/"><img src="/public/static/home/img/logo.png" style="height:60px; " /></a>
            </div>
            <div class="h_botR br-fr">
                <ul class="br-clearfix" id="menu-ul">
                    <li class="br-fl"><a href="/index.html" class="active">首页</a></li>
                    <li class="br-fl"><a href="/buy.html">A股点买</a></li>
                    <li class="br-fl"><a href="/freetrial.html">免费体验</a></li>
                    <li class="br-fl"><a href="/mobile.html">手机版</a></li>
                    <li class="br-fl help_box">
                    	<a href="/guild.html">帮助中心</a>
                    	<ul class="new-sub-nav hide">
                            <li class=""><a href="/guild.html">新手教学</a></li>
                            <li class=""><a href="/help.html">常见问题</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>


<script src="/public/static/libs/jquery-2.2.0/jquery-2.2.0.min.js"></script>
<script src="/public/static/home/js/general.js"></script>

<script>
    //自动选中active
    $(function(){
        var menuArr = [];
        menuArr[0] = ["index.html"  ];
        menuArr[1] = ["buy.html", "sell.html", "history.html" ];
        menuArr[2] = ["freetrial.html", "freetrialSell.html", "freetrialHistory.html"  ];
        menuArr[3] = ["mobile.html",  ];
        menuArr[4] = [ "guild.html" ,"help.html" ];
        for(var i = 0 ; i < menuArr.length; i++ ){
            for(var j = 0 ; j < menuArr[i].length; j++){
                if(location.href.indexOf(menuArr[i][j]) > 0){
                    $("#menu-ul > li a").removeClass("active");
                    $("#menu-ul > li").eq(i).find("a").eq(0).addClass("active");
                    $("#menu-ul > li").eq(i).find("a").eq(j+1).addClass("active");
					//console.log(i+'------'+j);
                    return;
                }
            }
        }
       

    });


</script>
<link rel="stylesheet" type="text/css" href="/public/static/home/css/buy.css"/>
<link rel="stylesheet" type="text/css" href="/public/static/home/css/member.css"/>

<!--个人中心-充值-->
<div class="br-content">
<div class="w1200">
	<!--主体-->
<section class="page-main page-personal">
    <div class="container clearfix">
    	<!--public左边-->
    	
        <aside class="col-left">
            <div class="userinfo">
            	<form name="user_head" id="user_head">
					<input type="file" name="myfile222" id="img_upload" />
					<div class="img_download">
						<img class="user-pic" id="headImg" src="<?php echo (isset($member['headImg']) && ($member['headImg'] !== '')?$member['headImg']:'/public/static/home/img/user.png'); ?>" >
					</div>
				</form>
                <!--<img src="/public/static/home/img/user.png" alt="" class="user-pic">-->
                <p class="user-info">Hi，<strong id="shared_layout_mem_lnm"><?php echo $_SESSION['member']['username']; ?></strong></p>
                <div class="iconrow">
                   <a href="/ucenter/security.html"><span class="user-2"></span></a>
                    <a href="/ucenter/security.html"><span class="user-3"></span></a>
                    <a href="/ucenter/security.html"><span class="user-4"></span></a>
                </div>
            </div>
            <h4 class="new-head-line"><span class="user-5"></span>会员中心</h4>
            <nav id="personal-nav" class="left-nav">
                <ul>

                    <li class=""><a href="/ucenter/index.html">我的首页&nbsp;<span class="mem_gt">&gt;</span></a></li>
                    
                    <li class=""><a href="/ucenter/bankcards.html">银行卡管理&nbsp;<span class="mem_gt">&gt;</span></a></li>
                    <li class=""><a href="/ucenter/security.html">账户安全&nbsp;<span class="mem_gt">&gt;</span></a></li>
					<li class=""><a href="/ucenter/payment.html">充值&nbsp;<span class="mem_gt">&gt;</span></a></li>
					<li class=""><a href="/ucenter/withdraw.html">提现&nbsp;<span class="mem_gt">&gt;</span></a></li>
                    <li class=""><a href="/ucenter/agent.html" style="display: none;">推广赚钱&nbsp;<span class="mem_gt">&gt;</span></a></li>
                </ul>
            </nav>
        </aside>
<script src="/public/static/home/js/moblie/jquery.ajaxfileupload.js"></script>
<script type="text/javascript">
	
	$(function() {
		/**
		 * active
		 */
			//console.log(window.location.pathname)
		$('#personal-nav li').removeClass('active');

		//遍历
		$('#personal-nav li>a').each(function () {
			if ($($(this))[0].getAttribute('href') == String(window.location.pathname)) {
				$(this).parent().addClass('active');
			}
		});
		
		
		/**
		 * 上传头像
		 */
        $('#img_upload').AjaxFileUpload({
			//处理文件上传操作的服务器端地址
			//上传图片，返回图片地址
			action: '/index/index/doImgUpload',
			onComplete: function(filename, resp) { //服务器响应成功时的处理函数
				if(resp.code == '0') {
					$('#headImg').attr('src', resp.(resp.code == '0') {
					$('#headImg').attr('src', resp.data);
					var params = {};
					params['headImg'] = resp.data;
					//保存图片到数据库，分两个地址是为了在很多地方公用
					$.post("/index/ucenter/savePeopleImg", params, function(data) {
						if(data.code == '0') {
							tool.popup_err_msg("修改成功");
						} else {
							tool.popup_err_msg(data.msg);
						}
					}, 'json');
				} else {
					tool.popup_err_msg(resp.msg );
				}
			}
		});
		
		
		
	});

</script>
        <!--右边-->
<div id="page_member_payment" class="col-main page-member-payment">
    <div class="tabs-wrapper" id="pay-method-tabs">
        <nav>
            <ul class="clearfix">
                 <li class="active"><a href="javascript:;" id="pm4">银行转账</a></li>
                <li><a href="javascript:;" id="pm3">支付宝转账</a></li>
                <!--<li><a href="javascript:;" id="pm2">微信转账</a></li>-->
                <li><a href="javascript:;" id="pm1">网银支付 </a></li>

            </ul>
        </nav>
        <div class="tabs">
                <div class="tab-item hide" id="tab-pm1">
                    <form action="/index/lianlianpay/doPay" id="payForm" target="_blank">
                        <div class="field-row group">
                            <label>可用资金:</label>
                            <div class="input-wrapper">
                                <span class="acount-val"><strong id="账户余额">0</strong><span class="unit">元</span></span>
                            </div>
                        </div>
                        <div class="field-row group">
                            <label>充值金额:</label>
                            <div class="input-wrapper">
                                <input type="text" class="text  b-pay-amount" name="b-pay-amount"  onafterpaste="this.value=this.value.replace(/\D/g,'')">
                            </div>
                        </div>
                        <div class="btn-row group">
                            <button id="bankRecharge" type="button" class="btn btn-pri">提 交</button>
                        </div>
                        <div id="bankRecharge_rmk" class="field-row group" style="display: none">
                            <label>特别说明:</label>
                            <div class="input-wrapper">
                                <span class="acount-val"></span>
                            </div>
                        </div>
                    </form>

                    <div class="bank-notes">
                        <h3>温馨提示</h3>
                        <ol>
                            <li>为了您的资金安全，请务必牢记账号密码；</li>
                            <li>充值前请注意您的银行卡充值限制，以免造成不便；</li>
                            <li>禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用；</li>
                            <li>为了您的资金安全，建议充值前进行实名认证、手机绑定；</li>
                            <li>如果充值遇到任何问题，请联系客服QQ：<label id="m_basic_mobile">806247358</label>。</li>
                        </ol>
                    </div>
                </div>
         
            <!--/.tab-item -->

            <div class="tab-item hide" id="tab-pm3">
                <div class="alipay-trans-wrapper">
                    <form action="#">
                        <input type="hidden" id="tab-pm1-bank" name="tab-pm1-bank" value="">
                        
                        <img src="/public/static/home/img/alipay.png" style="width:250px;margin-left:140px; display:block; margin-bottom:20px;">
                        <p>
                            <span style="color: red">请扫码充值，并务必在转账备注中填写注册手机号，这样方便我们多重信息确认您的汇款。</span><br>
                            转账成功后，请联系客服QQ：<label id="m_basic_mobile">806247358</label>以便我们及时帮您处理
                            <br>
                            <br>户名：宁波鑫钰网络科技有限公司
                        </p>
                    </form>
                    <div class="bank-notes">
                        <p>如需马上到帐或长时间未到帐，请联系客服QQ：<label id="m_basic_mobile">806247358</label><br>08：30- 17：00 （30分钟内到账）<br>17:00以后 （次日09：00前到账）
                        </p>
                    </div>
                </div>
            </div>
            <!--/.tab-item -->
            <!--<div class="tab-item hide" id="tab-pm2">
                <div class="alipay-trans-wrapper">
                    <form action="#">
                        <input type="hidden" id="tab-pm1-bank" name="tab-pm1-bank" value="">
                        
                        <img src="/public/static/home/img/wxpay.png" style="width:250px;margin-left:140px; display:block; margin-bottom:20px;">
                        <p>请用微信扫描二维码</p>
                        <p>
                            <span style="color: red">请扫码充值，并务必在转账备注中填写注册手机号，这样方便我们多重信息确认您的汇款。</span><br>
                            转账成功后，请联系客服QQ：<label id="m_basic_mobile">806247358</label>以便我们及时帮您处理
                            <br>账号：黑马策略
                            <!--<br>户名：杭州鼎蓝商贸有限公司‍-->
                       <!--</p>
                    </form>
                    <div class="bank-notes">
                        <p>如需马上到帐或长时间未到帐，请联系客服QQ：<label id="m_basic_mobile">806247358</label><br>08：30- 17：00 （30分钟内到账）<br>17:00以后 （次日09：00前到账）
                        </p>
                    </div>
                </div>
            </div>
            <!--/.tab-item -->
            <div class="tab-item " id="tab-pm4">

                <h3><strong>您可以通过网上银行、银行柜台或ATM机向<label id="m_basic_netName">我们</label>转账（手续费单笔最高50元）</strong>
                </h3>
                <p>请务必联系客户QQ：806247358 索取转账银行账户，在转账备注中填写注册手机号，这样方便我们多重信息确认您的汇款。<br>转账成功后，请告知客服QQ：<label id="m_basic_mobile">806247358</label>以便我们及时帮您处理
                </p>


               <!--   <table class="simple-tbl">
                    <colgroup>
                        <col class="col1">
                        <col class="col2">
                    </colgroup>
                    <tbody>
                    <tr>
                       <td><span class="bank-logo bank-logo-cmb" style="background-image: url(/public/static/home/img/bbb.png);width:150px;background-size:contain;background-position:center"></span></td>
                        <td>帐号：<label id="m_basic_bankNo">33050161668000000115</label><br>户名：<label id="m_basic_bankOn">杭州鼎蓝商贸有限公司</label><br>开户行：<label id="m_basic_bankNm">建设银行杭州城站支行</label></td>
                    </tr>
                    </tbody>
                </table>

                <div class="group upload-screenshot-wrapper">
                    <div class="col-12">
                        <p>用户网银转账之后，请务必保留网银转账成功时的截图，并在资金或者转账用途中备注清自己要转入的<label id="m_basic_netName">黑马策略</label>用户名，将回单发到QQ客服，以便尽快到账！
                        </p>

                        <div class="btn-wrapper" style="text-align: center">
                            <a id="m_basic_qq2" target="_blank" href="/" class="aside-support">
                                <i class="icon trans-04 icon-float_02"></i>
                                <span class="trans-04">在线咨询</span>
                            </a>
                        </div>
                    </div>-->
                    

                </div>
            </div>
            <!--/.tab-item -->
            <!--/.tabs-->
        </div>
    </div>
</div>

    </div>
</section>
	
	
	
	
	
</div>
</div>


<!--底部-->
<footer class="br-w100">
    <div class="footer_top">
        <a href="/company.html">关于我们</a>
        <a href="/contact.html">联系我们</a>
    </div>
    <div class="footer_bot">
        <div class="w1024 br-clearfix">
            <div class="bot_l br-fl">
                <p>宁波鑫钰网络科技有限公司<br>客服QQ ：806247358<br>客服服务时间工作日：9:00-18:00</p></div>
            <div class="bot_r br-fr br-text-center">
                <div class="bot_r_img br-clearfix ">
                    <span class="br-fl"><img src="/public/static/home/img/f1.png"/></span>
                    <span class="br-fr"><img src="/public/static/home/img/f2.png"/></span>
                </div>
                <p>版权所有 © 宁波鑫钰网络科技有限公司  </p>
                <p>浙ICP备17030011号  投资有风险 入市需谨慎</p>
            </div>
        </div>
    </div>
</footer>
<!--Start Pop-ups-->
<!--遮罩层-->
<div class="mask"></div>
<!--确认，取消提示框-->
<div class="popup" id="popup-p-confirm">
    <div class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a class="btn btn-pri js-close-popup" href="javascript:popup_confirm_go()">确定</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">取消</a>
        </div>
    </div>
</div>
<!--开设账户提示-->
<div class="popup" id="popup-yeepay">
    <div id="yeepayPopupContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a id="yeepayNextLink" target="_blank" class="btn btn-pri" href="javascript:;">开设账户</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">暂不充值</a>
        </div>
    </div>
</div>
<!--是，否提示框-->
<div class="popup" id="popup-yeepay-confirm" >
    <div id="yeepayConfirmContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a class="btn btn-pri js-close-popup" href="javascript:;">是</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">否</a>
        </div>
    </div>
</div>
<!--提示信息提示框-->
<div id="popup-p-error" class="popup">
    <div class="popup-header group">
        <h2>提示</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <p id="popup-p-error-msg">提示信息</p>
    </div>
</div>
<!--意见反馈提示框-->
<div class="popup" id="popup-feedback">
    <div class="popup-header group">
        <h2>意见反馈</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <form action="#">
            <div class="field-row group">
                <label>留言类型：</label>
                <div class="field-val">
                    <select id="留言类型s">
                        <option value="">请选择留言类型</option>
                        <option value="1">交易问题</option>
                        <option value="2">充值/提款问题</option>
                        <option value="3">交易问题</option>
                        <option value="4">我要投诉</option>
                        <option value="5">意见反馈</option>
                        <option value="6">其它</option>
                    </select>
                </div>
            </div>
            <div class="field-row group show-logout">
                <label>手机/邮箱：</label>
                <div class="field-val"><input type="text" class="text" placeholder="请输入手机号或邮箱"></div>
            </div>
            <div class="field-row group">
                <label>&nbsp;</label>
                <div class="field-val">
                    <textarea id="留言内容i" placeholder="请填写留言内容" class="textarea"></textarea>
                </div>
            </div>
            <div class="btn-row group">
                <a class="btn btn-pri" href="javascript:feedback_Insert()">提交</a>
            </div>
        </form>
    </div>
</div>
<!--账户登录提示框-->
<div class="popup popup-small" id="popup-user-login">
    <div class="popup-header group">
        <h2>账户登录</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group" style="padding-bottom:10px">
        <div class="group section-form" style="margin: 0px;" id="popup-login-section">
            <div class="form">
                <div class="field-wrapper">
                    <input type="text" class="text" placeholder="用户名/手机号" name="phone" id="popup_user_login_name">
                </div>
                <div id="error_name" class="error-wrapper" style="display:none; margin-top:5px;"><div>用户名不能为空！</div></div>
                <div class="field-wrapper">
                    <input type="password" class="text" placeholder="请输入密码" name="pwd" id="popup_user_login_pwd">
                </div>
                <div id="error_psw" class="error-wrapper" style="display:none; margin-top:5px;"><div>密码不能为空！</div></div>
                <div class="field-wrapper" id="popup-user-login-valid-img" style="display:none;">
                    <input type="text" class="text" style="width:100px; margin-right:5px; float: left;" placeholder="4位验证码" name="txt_valid_code">
                    <img name="img-block" class="captcha-img" alt="">
                    <a name="btn-change-img" style="font-size:13px; line-height:45px;" href="javascript:void(0)">看不清楚？</a>
                </div>
                <div class="error-wrapper" style="display:none; margin-top:5px;"><div>验证码错误！</div></div>
               
                <!--<div class="error-wrapper" style="display:none;  margin-top:5px;"><div></div></div>-->
               
                <div class="btn-wrapper">
                    <a href="javascript:void(0);" id="popup_user_login_submit" class="btn btn-pri">登录</a>
                </div>
                <div class="link-wrapper group clearfix" style="margin-top:10px;">
                    <a href="/forgot_pass.html" class="f-left">忘记密码</a><a href="/reg.html" class="f-right">马上注册</a>
                </div>
            </div>
           
            
        </div>
    </div>
</div>
<!-- 浮窗
<ul class="side-pannel">
				<li class="wechat">
					<i class="icon-kf"></i>
					<span>微信客服</span>
					<div class="wechat" style="top: 0px; height: 30px; line-height: 30px; color: rgb(249, 89, 86); display: none;">
						客服微信号：y1572440627
						<img src="/public/static/home/img/kfwx.jpg" style="width:100%">
					</div>
				</li>
				<li>
					<a href="javascript:void(0);" onclick="window.open('tencent://message/?uin=<?php echo $QQ; ?>&amp;Site=qq&amp;Menu=yes');">						
						<i class="icon-qq"></i>
						<span>QQ客服</span>
					</a>
				</li> -->
			
				
</ul>
			<script>
				$(".side-pannel>li.wechat").hover(function(){
					$(this).children("div.wechat").show();
				},function(){
					$(this).children("div.wechat").hide();
				});
			</script>
<script type="text/javascript">
	$('#bankRecharge').click(function(){
		var _val=$('input[name="b-pay-amount"]').val();
        if( _val == 0 ){
            tool.popup_err_msg("请输入充值金额");
            return false;
        }
        var a=/^[0-9]*(\.[0-9]{1,2})?$/;
        if(!a.test(_val)) {
            tool.popup_err_msg("充值金额格式不正确");
            return false;
        }
		$("#payForm").submit();
	});
</script>
</body>
</html>
