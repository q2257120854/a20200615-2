<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/bankcards.html";i:1539941250;s:65:"/www/wwwroot/feichangpeizi/application/index/view/public/top.html";i:1539839495;s:73:"/www/wwwroot/feichangpeizi/application/index/view/public/member_left.html";i:1539845017;s:68:"/www/wwwroot/feichangpeizi/application/index/view/public/footer.html";i:1540301736;}*/ ?>
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

<!--个人中心-首页-->
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
<div id="page_member_bankcard" class="col-main">
    <div class="personal-main">
        
        
        <div class="my-card-wrapper" style="" id="my-bank-cards">
            <h3 class="new-my-card-title">我的银行卡</h3>
            <div class="slide-wrapper new-my-card-slide slide-disabled" data-current="1">
                <ul id="membc_list" class="slides clearfix" style="left: 0px;">
                    <?php if($bankcard != ''): ?>
                	<li class="bank">
                        <div class="bank-card bank-card-gs"><p class="bank-card-end-num"><?php echo $cardEndNO; ?></p>
                        <div class="link-wrapper"><a href="javascript:void(0)" bankid="2281" class="bank_check">查看</a>
                            <a href="javascript:void(0)" bankid="2281" class="bank_delete">删除</a></div></div>
                    </li>
                    <?php else: ?>
                    <li>您暂未绑定银行卡</li>
                    <?php endif; ?>
                </ul>
                <a href="javascript:;" class="link-prev icon icon-chevron-small-left link-prev-disabled"></a>
                <a href="javascript:;" class="link-next icon icon-chevron-small-right link-next-disabled"></a>
            </div>
            <!--/.slide-wrapper-->
        </div>
        <!--/.my-card-wrapper-->

        <div class="add-card-wrapper" id="edit_bank_cards"  >
            <!--<h3 class="new-head"><span class="user-6"></span>请添加银行卡信息</h3>-->
            <form action="#" id="d_bank_add">
                <h3 class="card_title">请添加银行卡<span style="font-size: 12px;color: #999;"> (每人最多绑定一张银行卡)</span></h3>
                <div class="field-row group">
                    <label>开 户 人</label>
                    <div class="field-val openname"><label id="姓名" style="text-align:left;color: #000;font-size: 16px;">请先进行实名认证</label>
                        <a id="a_realname" target="_blank" href="/ucenter/security.html" style="font-size:13px;line-height:40px;color: #dd0000;">(点击这里实名认证)</a>
                    </div>
                </div>
                <div id="realName_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>请先进行实名认证</div>
                </div>
                <div class="field-row group">
                    <label>开户银行</label>

                    <div class="field-val">
                        <select id="银行s" class="long-select" val = "<?php echo $bankcard['bankName']; ?>">
                            <option value="">请选择</option><option value="1">工商银行</option><option value="2">农业银行</option><option value="3">中国银行</option><option value="4">建设银行</option><option value="6">中信银行</option><option value="7">光大银行</option><option value="8">华夏银行</option><option value="10">广发银行</option><option value="11">平安银行</option><option value="12">招商银行</option><option value="13">兴业银行</option><option value="14">上海浦发银行</option><option value="16">浙商银行</option><option value="17">渤海银行</option><option value="18">徽商银行</option><option value="19">邮政储蓄银行</option><optgroup label="暂不支持" disabled="disabled"><option>交通银行</option><option>民生银行</option><option>恒丰银行</option></optgroup>
                        </select>
                    </div>
                    <div class="field-txt" id="银行c"></div>
                </div>
                <div id="bankId_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>暂不支持该银行作为实名认证卡</div></div>
                <div id="khyh_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>未选择银行</div></div>
                <div class="field-row group">
                    <label>开户支行</label>
                    <div class="field-val">
                        <select id="省s" class="mid-select"  onchange="getCity()"  val = "<?php echo $bankcard['province']; ?>">
                            <option value= 0 >北京</option>
                            <option value= 1 >上海</option>
                            <option value= 2 >天津</option>
                            <option value= 3 >重庆</option>
                            <option value= 4 >河北</option>
                            <option value= 5 >山西</option>
                            <option value= 6 >内蒙古</option>
                            <option value= 7 >辽宁</option>
                            <option value= 8 >吉林</option>
                            <option value= 9 >黑龙江</option>
                            <option value= 10 >江苏</option>
                            <option value= 11 >浙江</option>
                            <option value= 12 >安徽</option>
                            <option value= 13 >福建</option>
                            <option value= 14 >江西</option>
                            <option value= 15 >山东</option>
                            <option value= 16 >河南</option>
                            <option value= 17 >湖北</option>
                            <option value= 18 >湖南</option>
                            <option value= 19 >广东</option>
                            <option value= 20 >广西</option>
                            <option value= 21 >海南</option>
                            <option value= 22 >四川</option>
                            <option value= 23 >贵州</option>
                            <option value= 24 >云南</option>
                            <option value= 25 >西藏</option>
                            <option value= 26 >陕西</option>
                            <option value= 27 >甘肃</option>
                            <option value= 28 >宁夏</option>
                            <option value= 29 >青海</option>
                            <option value= 30 >新疆</option>
                            <option value= 31 >香港</option>
                            <option value= 32 >澳门</option>
                            <option value= 33 >台湾</option>
                        </select>
                        <select id="市s" class="mid-select"  val = "<?php echo $bankcard['city']; ?>"><option value="">请选择</option></select>
                    </div>
                    <div class="field-txt" id="市c"></div>
                </div>
                <div id="khzh_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>未选择开户支行</div></div>
                <div class="field-row group">
                    <label>支行名称</label>
                    <div class="field-val"><input type="text" class="text" id="名称i"
                                                  placeholder="如宁波北仑分行/上海浦东分行等" val = "<?php echo $bankcard['branch']; ?>"></div>
                    <div class="field-txt" id="名称c"></div>
                </div>
                <div id="zh_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>未填写支行</div></div>
                <div class="field-row group">
                    <label>银行卡号</label>
                    <div class="field-val"><input type="text" class="text" id="银行卡号i" val = "<?php echo $bankcard['cardNumber']; ?>"></div>
                    <div class="field-txt" id="银行卡号c"></div>
                </div>
                <div id="yhkh_err1" class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>请输入正确银行卡号</div></div>
                <div class="field-row group" style="display:none;">
                    <label>审核状态</label>
                    <div class="field-txt" id="状态c">未审核</div>
                </div>
                <div class="btn-row group">
                    <button id="membcA" type="button" class="btn btn-pri">提 交</button>
                    <a id="card-save" href="javascript:void(0);" class="btn btn-pri" style="display:none">保 存</a>
                </div>
            </form>


            <form action="#" id="d_bank_display" style="display:none;">
                <div class="field-row group">
                    <label>开 户 人</label>
                    <div class="field-val openname"><label style="text-align:left;"><?php echo $bankcard['memberName']; ?></label></div>
                </div>
                <div class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>请先进行实名认证</div></div>
                <div class="field-row group">
                    <label>开户银行</label>
                    <div class="field-txt"><?php echo $bankcard['bankName']; ?></div>
                </div>
                <div class="field-row group">
                    <label>开户支行</label>
                    <div class="field-txt" ><?php echo $bankcard['province']; ?><?php echo $bankcard['city']; ?><?php echo $bankcard['branch']; ?></div>
                </div>
                <div class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>未填写支行</div></div>
                <div class="field-row group">
                    <label>银行卡号</label>
                    <div class="field-txt" ><?php echo $bankcard['cardNumber']; ?></div>
                </div>
                <div class="error-wrapper" style="margin-left:120px; display:none"><div><i class="icon icon-x-altx-alt"></i>请输入正确银行卡号</div></div>
                <div class="field-row group" style="display:none;">
                    <label>审核状态</label>
                    <div class="field-txt" >审核通过</div>
                </div>
                <div class="btn-row group">
                    <a id="membcB" href="javascript:void(0);" class="btn btn-pri" style="display: inline-block;">修 改</a>
                </div>
            </form>



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

<script>
    var USER={
        name:"<?php echo $realName; ?>"
    }
</script>

<script src="/public/static/home/js/backcards.js"></script>
</body>
</html>

