<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"/www/wwwroot/feichangpeizi/application/index/view/ucenter/member.html";i:1539941405;s:65:"/www/wwwroot/feichangpeizi/application/index/view/public/top.html";i:1539839495;s:73:"/www/wwwroot/feichangpeizi/application/index/view/public/member_left.html";i:1539845017;s:68:"/www/wwwroot/feichangpeizi/application/index/view/public/footer.html";i:1540301736;}*/ ?>
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
<div id="page_member_index" class="col-main">
    <section class="personal-section">
    	<h1 class="per_h1">我的首页</h1>
        <div class="new-section-sub-title">
            <p class="inner-sub-title"><span style="display: block;">账户余额</span><strong class="p-unit" id="账户余额"><?php echo $member['usableSum']; ?></strong>元</p>
        </div>
        <div class="p-money clearfix">
            <p class="diyongquan br-fl"><span class="ticket">我的抵用券</span><span id="diyongquan">0.00</span>元</p>
            
        </div>
        <div class="money_box p-money br-fr">
            	<a id="recharge2" class="btn-1" href="/ucenter/payment.html">充值</a>
            	<a id="withdraw2" class="btn-2" href="/ucenter/withdraw.html">提现</a>
        </div>
    </section>
    <div class="mid-gap">
        <h4>资金明细</h4>
    </div>
    <section class="moneydetails">
        <div class="table-control-bar clearfix">
            <label class="f-left">资金流向：</label>
            <ul class="f-left filter" id="money-flow">
                <li><a href="/ucenter/index.html?recent=<?php echo $_GET['recent']; ?>" <?php if($_GET['flow'] == ''): ?> class="active" <?php endif; ?> >全部</a></li>
                <li><a href="/ucenter/index.html?flow=1&recent=<?php echo $_GET['recent']; ?>" <?php if($_GET['flow'] == '1'): ?> class="active" <?php endif; ?>  >收入</a></li>
                <li><a href="/ucenter/index.html?flow=2&recent=<?php echo $_GET['recent']; ?>" <?php if($_GET['flow'] == '2'): ?> class="active" <?php endif; ?> >支出</a></li>
            </ul>
            <div class="f-right">
                <select id="search-times">
                    <option value="" selected="selected">全部</option>
                    <option value="-7" >最近一周</option>
                    <option value="-30">最近一月</option>
                    <option value="-90">最近三月</option>
                    <option value="-180">最近半年</option>
                    <option value="-360">最近一年</option>
                </select>
            </div>
        </div>
        <table id="asset-details-tbl" class="std-tbl">
            <colgroup>
                <col class="col1">
                <col class="col2">
                <col class="col3">
                <col class="col4">
                <col class="col5">
                <col class="col6">
                <col class="col7">
            </colgroup>
            <thead>
            <tr>
                <th>序号</th>
                <th>时间</th>
                <th>流向</th>
                <th>收入/支出(元)</th>
                <th>余额(元)</th>
                <th>说明</th>
            </tr>
            <?php if(is_array($fundrecord) || $fundrecord instanceof \think\Collection || $fundrecord instanceof \think\Paginator): $i = 0; $__LIST__ = $fundrecord;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr><td class="a-center"><?php echo $i; ?></td><td class="a-center"><?php echo $vo['createTime']; ?></td>
                <td class="a-center"><?php if($vo['flow'] == 1): ?>收入<?php elseif($vo['flow'] == 2): ?>支出<?php else: ?>未知<?php endif; ?></td>
                <td class="a-center">
                    <?php if($vo['flow'] == 2): ?><span class="green">-<?php echo $vo['amount']; ?></span>
                    <?php else: ?><span class="red"><?php echo round($vo['amount'],2); ?></span>
                    <?php endif; ?>
                </td>
                <td class="a-center"><?php echo round($vo['usableSum'], 2); ?></td>
                <td class="a-center"><?php echo $vo['remarks']; ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            </thead>
            <tbody id="member_bh_list" class="std-tbl-tbody"></tbody>
        </table>

        <?php echo $fundrecord->render(); ?>

   
    </section>
    <section id="noPlanSection" class="group personal-section personal-empty hide">
        <p><a href="javascript:void(0);" class="btn btn-pri">我要交易</a>
        </p>
        <p><a href="/freetrial.html">免费体验</a>
        </p>
        <p><a href="/help.html">了解交易</a>
        </p>
    </section>
    <!--/ 交易列表start-->
    <div id="member_index_plan_list">
    </div>
    <!--/交易列表end-->
</div>


    </div>
</section>
	
	
	
	
	
</div>
</div>
<!--Start Pop-ups-->
<div class="mask"></div>
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
<div class="popup" id="popup-yeepay">
    <div id="yeepayPopupContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a id="yeepayNextLink" target="_blank" class="btn btn-pri" href="javascript:；">开设账户</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">暂不充值</a>
        </div>
    </div>
</div>
<div class="popup" id="popup-yeepay-confirm">
    <div id="yeepayConfirmContent" class="popup-header group">
        <h2>提示</h2>
    </div>
    <div class="popup-body group">
        <div class="btn-row group">
            <a class="btn btn-pri js-close-popup" href="javascript:；">是</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">否</a>
        </div>
    </div>
</div>
<div id="popup-p-error" class="popup">
    <div class="popup-header group">
        <h2>提示</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <p id="popup-p-error-msg">提示信息</p>
    </div>
</div>
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
<!--/#popup-feedback-->
<div class="popup" id="popup-id-verify">
    <div class="popup-header group">
        <h2>认证银行卡</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <div class="field-row group" style="text-align:center">
            <ol class="popup-note">
                <li style="text-align:left;">提现和免费体验前必须先绑定一张银行卡</li>
                <li style="text-align:left;">请务必认真填写真实资料</li>
                <li style="text-align:left;">银行卡采用实名认证，一个身份证只能绑定一个账号</li>
                <li style="text-align:left;">如遇到问题，请联系客服 <label id="m_basic_mobile">021-80321818</label></li>
            </ol>
            <p>为了保障您的账户安全，请先绑定银行卡</p>
        </div>
        <div class="btn-row group">
            <a class="btn btn-pri" href="/ucenter/BankCards.html">去绑定</a>
            <a class="btn btn-pri js-close-popup" href="javascript:;">暂不绑定</a>
        </div>
    </div>
</div>
<div class="popup" id="popup-realname-auth">
    <div class="popup-header group">
        <h2>实名认证</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <div class="field-row group" style="text-align:center">
            <ol class="popup-note">
                <li style="text-align:left;">一个身份证对应一个账号</li>
                
                <li style="text-align:left;">如遇到问题，请联系客服 <label id="m_basic_mobile">021-80321818</label></li>
            </ol>
            <p>为了保障您的账户安全，请先进行实名认证</p>
        </div>
        <div class="field-row group">
            <label>真实姓名：</label>
            <div class="field-val"><input id="姓名i" type="text" class="text" onchange="user_updateid_zsxm_valid()"></div>
        </div>
        <div id="zsxm_err1" class="error-wrapper" style="margin-left:100px; display:none"><div><i class="icon icon-x-altx-alt"></i>未填写姓名</div></div>
        <div class="field-row group">
            <label>身份证号：</label>
            <div class="field-val">
                <div class="field-val">
                    <input id="身份证i" type="text" class="text" onchange="user_updateid_sfzh_valid()">
                </div>
            </div>
        </div>
        <div id="sfzh_err1" class="error-wrapper" style="margin-left:100px; display:none"><div><i class="icon icon-x-altx-alt"></i>请填写准确的身份证</div></div>
        <div class="btn-row group">
            <a id="user_UpdateSelfIdA" class="btn btn-pri" href="javascript:void(0)">确认</a>
            <a class="btn btn-sec js-close-popup" href="javascript:;">取消</a>
        </div>
    </div>
</div>
<div class="popup popup-small" id="popup-user-login">
    <div class="popup-header group">
        <h2>账户登录</h2>
        <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
    </div>
    <div class="popup-body group">
        <div class="group section-form" style=" margin-bottom: 0px; margin-top: 10px;" id="popup-login-section">
            <div class="form">
                <div class="field-wrapper">
                    <input type="text" class="text" placeholder="用户名/手机号" name="phone" id="popup_user_login_name">
                </div>
                <div class="error-wrapper" style="display:none; margin-top:5px;"><div><i class="icon icon-x-altx-alt" style="font-size:13px;"></i>用户名不能为空！</div></div>
                <div class="field-wrapper">
                    <input type="password" class="text" placeholder="请输入密码" name="pwd" id="popup_user_login_pwd" onkeydown="if (event.keyCode == 13) { user_Login() }">
                </div>
                <div class="error-wrapper" style="display:none; margin-top:5px;"><div><i class="icon icon-x-altx-alt" style="font-size:13px;"></i>密码不能为空！</div></div>
                <div class="field-wrapper" id="popup-user-login-valid-img" style="display:none;">
                    <input type="text" class="text" style="width:100px; margin-right:5px; float: left;" placeholder="4位验证码" name="txt_valid_code">
                    <img name="img-block" class="captcha-img" alt="">
                    <a name="btn-change-img" style="font-size:13px; line-height:45px;" href="javascript:void(0)">看不清楚？</a>
                </div>
                <div class="error-wrapper" style="display:none; margin-top:5px;"><div><i class="icon icon-x-altx-alt" style="font-size:13px;"></i>验证码错误！</div></div>
                <div class="link-wrapper group">
                    <a href="/forgot_pass.html">忘记密码</a>
                </div>
                <div class="error-wrapper" style="display:none;  margin-top:5px;"><div><i class="icon icon-x-altx-alt" style="font-size:13px;" id="popup_user_login_msg"></i></div></div>
                <div class="btn-wrapper">
                    <a href="javascript:void(0);" id="popup_user_login_submit" class="btn btn-pri">登录</a>
                </div>
            </div>
            <div class="quick-link-wrapper group" style=" padding-bottom:0px;text-align: center;margin-top: 10px;">
                <p>还没账号? <a href="/reg.html" style="color:#d42b2e;">马上注册</a></p>
            </div>
        </div>
    </div>
</div>

<!--/#popup-add-deposit（终止操盘）-->
<div class="popup" id="popup-early" style="display: none; top: 0px;">
        <div class="popup-header group">
            <h2>终止操盘</h2>
            <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
        </div>
        <div class="popup-body group">
            <form action="#">
                <div class="btn-row group">
                    <a id="plan_earlyA" class="btn btn-pri js-close-popup" href="javascript:plan_early_Insert()">确定</a>
                    <a class="btn btn-pri js-close-popup" href="javascript:;">取消</a>
                </div>
            </form>
        </div>
    </div>
<!--/#popup-add-deposit（追加保证金）-->
<div class="popup" id="popup-add-deposit" style="">
        <div class="popup-header group">
            <h2>追加保证金</h2>
            <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
        </div>
        <div class="popup-body group">
            <p class="note-msg">每次追加保证金不能小于当前方案中操盘资金的1%，最低100元，每天可追加或取消保证金的次数为5次。</p>
            <form action="#">
                <div class="field-row group">
                    <label>追加金额：</label>
                    <div class="field-val"><input id="追加金额i" type="text" class="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"><span class="field-note" id="最低添加保证金">最低-元</span></div>
                </div>
                <div class="btn-row group">
                    <a id="plan_addmarginA" class="btn btn-pri" href="javascript:plan_madd_Insert()">立即追加</a>
                </div>
                <p class="chance-count">今日次数: <span>5</span></p>
            </form>
        </div>
    </div>
<!--/#popup-renew（申请续约）-->
<div class="popup" id="popup-renew" style="display: none; top: 0px;">
        <div class="popup-header group">
            <h2>申请续约</h2>
            <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
        </div>
        <div class="popup-body group">
            <p class="note-msg">申请续约后，我们会进行审核，不保证续约一定成功。</p>
            <form action="#">
                <div class="field-row group">
                    <label>续约时间：</label>
                    <div class="field-val">
                        <select id="续约时间s">
                            <option selected="selected" value="1">一个月</option>
                            <option value="2">二个月</option>
                            <option value="3">三个月</option>
                        </select>
                    </div>
                </div>
                <div class="btn-row group">
                    <a id="plan_deferA" class="btn btn-pri js-close-popup" href="javascript:plan_defer_Insert()">确定</a>
                    <a class="btn btn-sec js-close-popup" href="javascript:;">取消</a>
                </div>
            </form>
        </div>
    </div>
<!--/#popup-get-profit（利润提取）-->    
<div class="popup" id="popup-get-profit" style="display: none; top: 0px;">
        <div class="popup-header group">
            <h2>利润提取</h2>
            <a href="javascript:;" class="js-close-popup"><i class="icon icon-close"></i></a>
        </div>
        <div class="popup-body group">
            <p class="note-msg">
                1，当日卖出股票的资金到第二日，资金可用<br>
                2，总利润需保留总操盘资金的10%<br>
                3，单笔最少提3%，最少100元<br>
                4，每周可提取利润两次
            </p>
            <form action="#">
                <div class="field-row group">
                    <label>可提金额：</label>
                    <div class="field-val" id="可提金额">- 元</div>
                </div>
                <div class="field-row group">
                    <label>最少可提：</label>
                    <div class="field-val" id="最少可提">- 元</div>
                </div>
                <div class="field-row group">
                    <label>提取金额：</label>
                    <div class="field-val"><input id="提取金额i" type="text" class="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"><span class="unit">元</span></div>
                </div>
                <div class="btn-row group">
                    <a id="plan_wdA" class="btn btn-pri js-close-popup" href="javascript:plan_withdraw_Insert()">确定</a>
                </div>
            </form>
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
<script src="/public/static/home/js/index.js"></script>
</body>
</html>

<script>
    $(function(){
        var recent = "<?php echo $_GET['recent']; ?>";
        $("#search-times").val(recent);
    });
    $("#search-times").change(function(e){
        var recent = $(this).val();
        location.href = "/ucenter/index.html?recent=" + recent + "&flow=<?php echo $_GET['flow']; ?>";
    });
	
	

</script>



